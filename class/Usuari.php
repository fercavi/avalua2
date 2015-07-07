<?php
if (file_exists('conf.php'))
	require_once('conf.php');
else
	require_once('../conf.php');
class Usuari{
	private $username;	
	private $nom;
	private $permisos;
	private $questionaris;

	public function  __construct($username){
		//loaderType: variable global en conf.php
		session_start(); //per a poder guardar l'usuari
		global $loaderType;
		//$loader = LoaderDBAFactory::getDBALoader($loaderType);
		//$loader->loadDataFromDBA();
		$this->loadDataFromDBA();
		$_SESSION["USUARI"]= $this;
	}
	private function loadDataFromDBA(){
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
			$Questionari = new Questionari(0,"Questionari 1",$Estimuls);		
			$this->questionaris= array($Questionari);
	}

	public function getQuestionaris(){
		return $this->questionaris;
	}
	public function getQuestionari($id){
		$q = null;
		for($i=0;$i<count($this->questionaris);$i++){
			if($this->questionaris[$i]->getId()==$id){
				$q=$this->questionaris[$i];
			}
		}
		return $q;
	}
}

?>