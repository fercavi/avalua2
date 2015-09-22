<?php
function __autoload($class_name) {
    include 'class/'.$class_name . '.php'; 	
}

//Mysql
$loaderType = LoaderDBAFactory::LoaderDBAMysqlType;
$saverType = SaverDBAFactory::SaverDBAMysqlType;

//Operacions que fa el Servidor amb la BDA
const DBAServerTypeMysql=0;
$DBAServerType = DBAServerTypeMysql;


require_once('lang/val.php');



$connexio = array(
	"SERVIDOR"=>"localhost",
	"USER"=>"root",
	"PASSWORD"=>"lliurex",
	"DBA"=>"avalua3"
	);

  
$idiomes = "[{id:0,descripcio:'valencià',flag:'img/valencia.png',codi:'val'}]";
?>