
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
  <a href="javascript: history.go(-1)"> Tornar</a>
<?php
  require 'conf.php';
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();
	$user=$_SESSION["USUARI"];
  
?>
<ul>
<li><a href='AdminUsuari.php'>Administració Usuaris</a></li>
<li><a href='AdminQuestionaris.php'>Administrar Qüestionaris</a></li>
<li><a href='AdminPlantilles.php'>Administrar Plantilles d''usuaris</a></li>
<li><a href='Paperera.php'>Paperera</a></li>

</ul>
<hr>
<a href='index.php?action=tancarSessio'>Tacar Sessio</a>
</div>

<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
