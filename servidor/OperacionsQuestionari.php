<?php
require '../conf.php';
if (isset($_GET["accio"])){
	session_start();	
	$accio = $_GET["accio"];
	if ($accio=='guardarRespostes'){
		$respostes = json_decode($_GET["respostes"]);
		guardarRespostes($respostes);
	}
	if ($accio=='guardarRespostesBaseDeDades'){
		guardarRespostesBaseDeDades();
	}
}
function guardarRespostes($respostes){
	$questionari = $_SESSION["QUESTIONARI"];
	$questionari->setRespostesEstimulActiu($respostes);
	$_SESSION["QUESTIONARI"] = $questionari;	
}
function guardarRespostesBaseDeDades(){
  $user = $_SESSION["USUARI"];  
  $uid = $user->getUid();
	$questionari = $_SESSION["QUESTIONARI"];
	$Estimuls = $questionari->getEstimuls();
	for($i=0;$i<count($Estimuls);$i++){
		$Estimul =$Estimuls[$i];
		for($j=0;$j<count($Estimul->Items);$j++){
			$Item=$Estimul->Items[$j];
			//error_log(var_export($Item->getRespostes(),true));
      global $saverType;
		  $saver = SaverDBAFactory::getDBASaver($saverType);
      $saver->guardarRespostes($uid,$Item->getId(),$Item->getRespostes());
      
		}
	}	
}
?>