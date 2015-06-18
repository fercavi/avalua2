<?php
require '../conf.php';
if (isset($_GET["accio"])){
	session_start();	
	$accio = $_GET["accio"];
	if ($accio='guardarRespostes'){
		$respostes = json_decode($_GET["respostes"]);
		guardarRespostes($respostes);
	}
}
function guardarRespostes($respostes){
	$questionari = $_SESSION["QUESTIONARI"];
	$questionari->setRespostesEstimulActiu($respostes);
	$_SESSION["QUESTIONARI"] = $questionari;
}
?>