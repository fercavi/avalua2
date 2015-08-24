
<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
  <body>  
  <div class='container'>  
<?php
  require_once 'conf.php';  
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();
	$user=$_SESSION["USUARI"];
  
?>
<a href="javascript: history.go(-1)"> <?php echo $lang["TORNAR"]?></a>
<ul>
<li><a href='AdminUsuari.php'><?php echo $lang["ADMINISTRACIOUSUARIS"]?></a></li>
<li><a href='AdminQuestionaris.php'><?php echo  $lang["ADMINISTRACIOQUESTIONARIS"]?></a></li>
<li><a href='AdminEstimuls.php'><?php echo  $lang["ADMINISTRACIOESTIMULS"]?></a></li>
<li><a href='AdminItems.php'><?php echo  $lang["ADMINISTRACIOITEMS"]?></a></li>
<li><a href='AdminPlantilles.php'><?php echo  $lang["ADMINISTRACIÓPLANTILLESUSUARIS"]?></a></li>
<li><a href='Paperera.php'><?php echo  $lang["PAPERERA"]?></a></li>

</ul>
<hr>
<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>
</div>

<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
