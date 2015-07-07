<?php

class LoaderDBAMysql{
	function loadDataFromDBA(){
			
	}
}
abstract class LoaderDBA{
	abstract function loadDataFromDBA();
	abstract function loadDataUser($login);
	abstract function loadQuestinaris($login);
	abstract function loadPermisos($login);
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