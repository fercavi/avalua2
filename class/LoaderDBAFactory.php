<?php
if (file_exists('../conf.php'))
	require_once '../conf.php';
else
	require_once 'conf.php';
class LoaderDBAMysql{
  private $idioma;
  private $uid;
	function loadDataFromDBA($userlogin,$idioma){
      $this->idioma = $idioma;
	    $result = array();
	    $Questionaris = $this->loadQuestionaris($userlogin);	
	    $result["QUESTIONARIS"]=$Questionaris;
	    return $result;
	}
	function loadQuestionaris($userlogin){
		global $connexio;
	  $PDOQuestionaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
		$query = "select U.id as uid,C.text,Q.id from questionaris Q, permisos P, usuaris U,cadenes C where P.lectura=1 and U.login='$userlogin' and U.id=P.idusuari and P.camp='questionaris' and P.idorige=Q.id And C.idorige=Q.id and C.taulaorige='questionaris' and C.camporige='nom' and C.idioma='".$this->idioma."'";		    
		$files=$PDOQuestionaris->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);		
		$questionaris = array();
    $this->uid=$fila["uid"];
		while ($fila){
			$idquestionari=$fila["id"];
			$questionaris[]= $this->crearQuestionari($idquestionari,$fila["text"]);
			$fila=$files->fetch(PDO::FETCH_BOTH);
		}
		return $questionaris;
	}
  
	function crearQuestionari($idquestionari,$nom){
    $Estimuls = $this->getEstimulsQuestionaris($idquestionari);
    $Q = new Questionari($idquestionari,$nom,$Estimuls);
    return $Q;
	}
  private function getItems($idEstimul){
    global $connexio;    
    $PDOItems = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );  
    $queryEnunciat =  "select C.text as enunciat,P.lectura,P.escriptura from cadenes C, items_estimuls IE,permisos P ";
    $queryEnunciat .= " where "
    $Items = array();
    $Items[] = new ItemRadioButton(0,"<b>Pregunta0</b>",array("Opcio1","Opcio2"),array(0));
    return $Items;
  }
  private function getEstimulsQuestionaris($idquestionari){
    global $connexio;
    $PDOEstimuls = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );  
    $subqueryTitol = "select C1.text from cadenes C1   WHERE";
    $subqueryTitol .= " C1.idorige=E.id AND C1.taulaorige='estimuls' and C1.camporige='titol' AND EQ.idquestionari='$idquestionari'";
    $subqueryTitol .= " AND E.id=EQ.idestimul and C1.idioma='". $this->idioma ."'";
    $queryEnunciat = "select (".$subqueryTitol.") as Titol,EQ.id as EQID,E.id,C.text from estimuls E,estimul_questionari EQ,cadenes C, permisos P WHERE ";
    $queryEnunciat .= " C.idorige=E.id and C.taulaorige='estimuls' and C.camporige='enunciat' AND EQ.idquestionari='$idquestionari' ";    
    $queryEnunciat .= " AND E.id=EQ.idestimul and C.idioma='".$this->idioma."'  ";    
    $queryEnunciat .= " AND P.lectura=1 AND P.idorige=E.id AND P.idusuari='".$this->uid."' AND P.camp='estimuls'";
    $files=$PDOEstimuls->query($queryEnunciat);
    $fila=$files->fetch(PDO::FETCH_BOTH);
    $Estimuls = array();
    while ($fila){
      $Items = $this->getItems();
      $Estimuls[]=new Estimul($fila["id"],utf8_encode($fila["Titol"]),utf8_encode($fila["text"]),$Items);
      $fila=$files->fetch(PDO::FETCH_BOTH);
    }
    return $Estimuls;
  }
}

abstract class LoaderDBA{  
	abstract function loadDataFromDBA($userlogin);
	abstract function loadDataUser($userlogin);
	abstract function loadQuestionaris($userlogin);
	abstract function loadPermisos($userlogin);
}

class LoaderDBAFactory{
	const LoaderDBAMysqlType =0;
	static function getDBALoader($type){
		$loader=null;
		switch ($type) {
			case 0:
				$loader= new LoaderDBAMysql();
				break;
			
			default:
				# code...
				break;
		}
		return $loader;

	}

}
?>