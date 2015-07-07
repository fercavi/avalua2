<?php
function getQuestionari($id){
	session_start();	
	if (isset($_SESSION)){
		if (!isset($_SESSION["QUESTIONARI"])){
			$Estimuls = array();
			$items = array();
			$items[] = new ItemRadioButton(0,"<b>Pregunta0</b>",array("Opcio1","Opcio2"),array());
			$items[] = new ItemRadioButton(1,"<b>Pregunta1</b>",array("Opcio3","Opcio4"),array());
			$Estimuls[] = new Estimul(0,$items);
			$items = array();
			$items[] = new ItemRadioButton(2,"<b>Pregunta2</b>",array("Opcio1","Opcio2"),array());
			$items[] = new ItemRadioButton(3,"<b>Pregunta3</b>",array("Opcio3","Opcio4"),array());
			$Estimuls[] = new Estimul(1,$items);
			$items = array();
			$items[] = new ItemRadioButton(4,"<b>Pregunta4</b>",array("Opcio1","Opcio2"),array());
			$items[] = new ItemRadioButton(5,"<b>Pregunta5</b>",array("Opcio3","Opcio4"),array());
			$Estimuls[] = new Estimul(2,$items);	
			$Questionari = new Questionari(0,$Estimuls);
			$_SESSION["QUESTIONARI"] = $Questionari;
		}
		else{
			$Questionari = $_SESSION["QUESTIONARI"];
		}
	}
	return $Questionari;
}

?>