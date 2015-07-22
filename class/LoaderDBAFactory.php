<?php
if (file_exists('../conf.php'))
	require_once '../conf.php';
else
	require_once 'conf.php';
class LoaderDBAMysql{
	function loadDataFromDBA($userlogin){		
	    $result = array();
	    $Questionaris = $this->loadQuestionaris($userlogin);	
	    $result["QUESTIONARIS"]=$Questionaris;

	    return $result;
	}
	function loadQuestionaris($userlogin){
		global $connexio;
	    $PDOQuestionaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
		$query = "select Q.* from questionaris Q, permisos P, usuaris U where P.lectura=1 and U.login='$userlogin' and U.id=P.idusuari and P.camp='questionaris' and P.idorige=Q.id";		
		$files=$PDOQuestionaris->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);		
		$questionaris = array();
		while ($fila){
			$idquestionari=$fila["id"];
			$questionaris[]= new Questionari($idquestionari,$fila["descripcio"],array());//$this->crearQuestionari($idquestionari);
			$fila=$files->fetch(PDO::FETCH_BOTH);
		}

		return $questionaris;

	}
	function crearQuestionari($idquestionari){

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