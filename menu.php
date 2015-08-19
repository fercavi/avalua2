
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
	require 'conf.php';  
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();
	$user=$_SESSION["USUARI"];		
	$questionaris = $user->getQuestionaris();		
	for($i=0;$i<count($questionaris);$i++){
		$q = $questionaris[$i];
		echo "<a href='veure_questionari.php?q=".$q->getId()."'>".$q->getNom()."</a><br/>";
	}

?>
<hr/>

<?php
global $lang;
if ($user->esAdmin()){
echo "<a href='taulerdecontrol.php'>".$lang["TAULERCONTROL"]."</a>";;
}
?>
<hr/>
<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
</body>
</html>