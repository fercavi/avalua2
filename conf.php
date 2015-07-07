<?php
function __autoload($class_name) {
    include 'class/'.$class_name . '.php'; 	
}

//Mysql
$loaderType = LoaderDBAFactory::LoaderDBAMysqlType;



$connexio = array(
	"SERVIDOR"=>"localhost",
	"USER"=>"root",
	"PASSWORD"=>"lliurex",
	"DBA"=>"avalua3"
	);

?>