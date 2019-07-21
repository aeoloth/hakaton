<?php
set_time_limit ( 1000000000 );
$link = mysqli_connect("localhost", "mtlaprnb_hakaton","gCRc4wK%", "mtlaprnb_hakaton");

mysqli_query($link,"TRUNCATE `recomend_uslugi`");
//Рекомендации на основе критериев услуг
$uslugi = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM uslugi WHERE conditions IS NOT NULL"), MYSQLI_ASSOC);
$recomend_query = "INSERT INTO `recomend_uslugi` (`id`, `usluga_id`, `user_id`) VALUES ";
foreach ($uslugi as $usluga){

    $users = mysqli_fetch_all(mysqli_query($link, "SELECT u.* FROM users u WHERE u.id NOT IN ( SELECT user_id FROM uslugi_user uu WHERE uu.usluga_id = ".$usluga["usluga_id"]." ) AND ( ".$usluga["conditions"] . " )"), MYSQLI_ASSOC);

    foreach ($users as $user){
        $recomend_query .= "(NULL, ".$usluga['usluga_id'].", ".$user['id']."),";
    }
}
$recomend_query = substr($recomend_query,0,-1);
$recomend_query .= ";";
mysqli_query($link,$recomend_query);




//рекомендации на основе смежных услуг
$dop_uslugi = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM tree"), MYSQLI_ASSOC);

$recomend_query2 = "INSERT INTO `recomend_uslugi` (`id`, `usluga_id`, `user_id`) VALUES ";

foreach($dop_uslugi as $dop_usluga){
    $uslugi_users = mysqli_fetch_all(mysqli_query($link, "SELECT user_id FROM uslugi_user WHERE usluga_id = ".$dop_usluga['usluga_id']." AND user_id NOT IN ( SELECT user_id FROM uslugi_user WHERE usluga_id = ".$dop_usluga['dop_usluga_id']." ) ;"), MYSQLI_ASSOC);
    
    foreach($uslugi_users as $uslugi_user){
        $recomend_query2 .= "(NULL, ".$dop_usluga['dop_usluga_id'].", ".$uslugi_user['user_id']."),";
    }
    
}
$recomend_query2 = substr($recomend_query2,0,-1);
$recomend_query2 .= ";";



mysqli_close($link);

