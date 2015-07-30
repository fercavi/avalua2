<?php
if (file_exists('../conf.php'))
	require_once '../conf.php';
else
	require_once 'conf.php';
  
class SaverDBAMysql{
  public function guardarRespostes($uid,$iditem,$respostes){
    global $connexio;
    for($i=0;$i<count($respostes);$i++){
      $queryDelete = "delete from respostes where iditem_instancia=$iditem and idusuari=$uid";
      $PDO = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
      $prep = $PDO->prepare($queryDelete); 	
      $prep->execute(); 
      $queryInsert = "insert into respostes(idusuari,iditem_instancia,resposta) values($uid,$iditem,'".utf8_encode($respostes[$i])."')";
      $prep = $PDO->prepare($queryInsert); 	
      $prep->execute();     
      
    }
  }
  
}


abstract class SaverDBA{  
  abstract function guardarRespostes($uid,$iditem,$respostes);
}

class SaverDBAFactory{
	const SaverDBAMysqlType =0;
	static function getDBASaver($type){
		$saver=null;
		switch ($type) {
			case 0:
				$saver= new SaverDBAMysql();
				break;
			
			default:
				# code...
				break;
		}
		return $saver;

	}

}
?>