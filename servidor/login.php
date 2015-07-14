<?php
require '../conf.php';
$login = $_GET["usuari"];
$pass = $_GET["pass"];
$user = new Usuari($login);
$result = array("Error"=>"1","Name"=>"Ok");
if($user->login($pass)){
	$result = array("Error"=>"0","Name"=>"Ko");
}
else{
	session_destroy();
}
echo json_encode($result);
?>