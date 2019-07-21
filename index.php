<?php

if(isset($_GET['idsearch'])){
    
    $link = mysqli_connect("localhost", "mtlaprnb_hakaton","gCRc4wK%", "mtlaprnb_hakaton");
    $recomend_uslugi = mysqli_fetch_all(mysqli_query($link,"SELECT r.usluga_id, u.name FROM recomend_uslugi r, uslugi u WHERE r.usluga_id = u.usluga_id AND r.user_id = ".$_GET['idsearch']),MYSQLI_ASSOC);
    $use_uslugi = mysqli_fetch_all(mysqli_query($link,"SELECT usluga_id, name FROM uslugi_user WHERE user_id = ".$_GET['idsearch']),MYSQLI_ASSOC);
}

?>
<!doctype html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  	<div id="header">
  		<span id="heading">Региональный портал государственных и муниципальных услуг</span>
  	</div>
  	<!-- статистический анализ -->
  	<div class="container-fluid">
  		<div id="space">
		</div>
  		<div id="idSearch">
  		<form method="get">
			<label class="search" for="idsearch">ID клента:</label>
			<input class="search" type="text" name="idsearch" />
			<input class="search" type="submit" name="id" value="Показать" />
		</form>
  		</div>
  		<div id="space">
		</div>
		<div class="row">
			<div class="showWindow">
<h4>Рекомендуемые услуги:</h4>
			    <?php if($recomend_uslugi){ foreach($recomend_uslugi as $recomend_usluga) { ?>
				<div style="padding: 5px;" id="<?php echo $recomend_usluga['usluga_id']; ?>"><?php echo $recomend_usluga['name']; ?></div>
				<?php } }else{ ?>
				<div>Нет рекомендованных услуг</div>
				<?php } ?>
			</div>
			
			<div class="showWindow">
<h4>Ранее оказанные услуги:</h4>
			    <?php if($use_uslugi){ foreach($use_uslugi as $use_usluga) { ?>
				<div style="padding: 5px;"  id="<?php echo $use_usluga['usluga_id']; ?>"><?php echo $use_usluga['name']; ?></div>
				<?php } }else{ ?>
				<div>Пользователь не пользовался услугами</div>
				<?php } ?>
			</div>
		</div>
	</div>

    <div id="footer">

    </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </body>
</html>