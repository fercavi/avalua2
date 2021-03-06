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
      $result["UID"]= $this->uid;
      $result["ADMINISTRADOR"] = $this->getAdministrador($this->uid);
	    return $result;
	}
  function getAdministrador($uid){
		global $connexio;
	  $PDOAdministrador = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
    $query="select count(*) as compte from permisos where camp='Administrador' and idusuari=$uid and lectura=1 and escriptura=1";
    $result = false;
		$files=$PDOAdministrador->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);	
    if ($fila["compte"]!=0)
      $result = true;
    return $result;    
  }
	function loadQuestionaris($userlogin){
		global $connexio;
	  $PDOQuestionaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
    $PDO2 = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
		$query = "select U.id as uid,Q.id,Q.descripcio from  permisos P, usuaris U, questionaris Q  where P.lectura=1 and U.login='$userlogin' and U.id=P.idusuari and P.camp='questionaris' and P.idorige=Q.id AND Q.estat<>-1";		        
		$files=$PDOQuestionaris->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);		
		$questionaris = array();
    $this->uid=$fila["uid"];
		while ($fila){
			$idquestionari=$fila["id"];
      $nomQuestionari = $fila["descripcio"];
      $query = "select C.text from cadenes C where C.idorige=$idquestionari and C.taulaorige='questionaris' and C.camporige='nom' and C.idioma=".$this->idioma;        
      $files2=$PDO2->query($query);
      $fila2=$files2->fetch(PDO::FETCH_BOTH);
      if ($fila2) //si existeix traducció posem el text, si no la descripció de la taula questionaris
        $nomQuestionari = $fila2["text"];
			$questionaris[]= $this->crearQuestionari($idquestionari,$nomQuestionari);
			$fila=$files->fetch(PDO::FETCH_BOTH);
		}
		return $questionaris;
	}
  
	function crearQuestionari($idquestionari,$nom){
    $Estimuls = $this->getEstimulsQuestionaris($idquestionari);
    $Q = new Questionari($idquestionari,$nom,$Estimuls);
    return $Q;
	}
  private function getOpcions($idItem){
     global $connexio; 
     $PDOItems = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );  
     $query = "select C.text from cadenes C,opcions O where C.idorige=O.id and O.iditem=$idItem and C.taulaorige='opcions' and C.camporige='valor' and C.idioma='".$this->idioma ."' order by ordre";     
     $files=$PDOItems->query($query);
		 $fila=$files->fetch(PDO::FETCH_BOTH);		
     $result = array();
     while($fila){
      $result[] = utf8_encode($fila["text"]);
      $fila=$files->fetch(PDO::FETCH_BOTH);		
     }     
     return $result;
  }
  private function getRespostes($iditem){
    global $connexio;
    $PDORespostes = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );  
    $queryRespostes = "Select resposta from respostes where iditem_instancia=$iditem and idusuari=".$this->uid;
    $respostes = array();
    $files=$PDORespostes->query($queryRespostes);
		$fila=$files->fetch(PDO::FETCH_BOTH);
    while($fila){
      $respostes[]=$fila["resposta"];
      $fila=$files->fetch(PDO::FETCH_BOTH);	
    }
    return $respostes;
  }
  
  private function getItems($idEstimulInstancia){
    global $connexio;    
    $PDOItems = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );  
    //TODO: falta enllaçar correctament els items amb els permisos i estímuls
    $queryEnunciat =  "select I.tipus,IE.iditem,IE.id,C.text as enunciat,P.lectura,P.escriptura from cadenes C, item_instancia IE,estimul_instancia EQ, permisos P,items I ";
    $queryEnunciat .= " where P.idusuari=".$this->uid." and P.camp='items' and P.idorige=IE.id and IE.idestimul_instancia=EQ.id AND ";
    $queryEnunciat .= " EQ.id=$idEstimulInstancia and C.idioma='".$this->idioma."' and C.taulaorige='items' and C.camporige='enunciat' and C.idorige=IE.iditem AND I.id=IE.iditem";
    $Items = array();
    $files=$PDOItems->query($queryEnunciat);
		$fila=$files->fetch(PDO::FETCH_BOTH);		
    while($fila){
      $opcions = $this->getOpcions($fila["iditem"]);      
      $respostes = $this->getRespostes($fila["id"]);
      $lectura = false;
      if ($fila["lectura"]=="1")
        $lectura = true;
      $escriptura = false;
      if ($fila["escriptura"]=="1")
        $escriptura = true;
      if ($fila["tipus"]==1)
        $Items[] = new ItemRadioButton($fila["id"],utf8_encode($fila["enunciat"]),$opcions,$respostes,$escriptura,$lectura);
      $fila=$files->fetch(PDO::FETCH_BOTH);	
    }
    //$Items[] = new ItemRadioButton(0,"<b>Pregunta0</b>",array("Opcio1","Opcio2"),array(0));
    return $Items;
  }
  private function getEstimulsQuestionaris($idquestionari){
    global $connexio;
    $PDOEstimuls = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );  
    $subqueryTitol = "select C1.text from cadenes C1   WHERE";
    $subqueryTitol .= " C1.idorige=E.id AND C1.taulaorige='estimuls' and C1.camporige='titol' AND EQ.idquestionari='$idquestionari'";
    $subqueryTitol .= " AND E.id=EQ.idestimul and C1.idioma='". $this->idioma ."'";
    $queryEnunciat = "select (".$subqueryTitol.") as Titol,EQ.id as EIID,E.id,C.text from estimuls E,estimul_instancia EQ,cadenes C, permisos P WHERE ";
    $queryEnunciat .= " C.idorige=E.id and C.taulaorige='estimuls' and C.camporige='enunciat' AND EQ.idquestionari='$idquestionari' ";    
    $queryEnunciat .= " AND E.id=EQ.idestimul and C.idioma='".$this->idioma."'  ";    
    $queryEnunciat .= " AND P.lectura=1 AND P.idorige=EQ.id AND P.idusuari='".$this->uid."' AND P.camp='estimuls'";
    
    
    $files=$PDOEstimuls->query($queryEnunciat);
    $fila=$files->fetch(PDO::FETCH_BOTH);
    $Estimuls = array();
    while ($fila){
      $idestimul = $fila["id"];
      $idestimulinstancia = $fila["EIID"];
      $Items = $this->getItems($idestimulinstancia);
      $Estimuls[]=new Estimul($idestimul,utf8_encode($fila["Titol"]),utf8_encode($fila["text"]),$Items);
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