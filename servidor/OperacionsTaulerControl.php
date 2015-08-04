<?php

require '../conf.php';

  session_start();	
	if (!isset($_SESSION["USUARI"])) die();
	$user=$_SESSION["USUARI"];
  $accio = $_GET["accio"];
  if ($accio=='llistatUsuaris')
    $result = llistatUsuaris();
  if($accio=='crearUsuari'){
    $nom=$_GET["nom"];
    $login = $_GET["login"];
    $pass=$_GET["pass"];
    $result=creaUsuari($nom,$login,$pass);
  }
  if($accio=='esborrarUsuari'){
    $uid=$_GET["uid"];
    $result = esborrarUsuari($uid);
  }
  
  echo(json_encode($result));
  
  
  function llistatUsuaris(){
    global $connexio;
	  $PDOUsuaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
		$query = "select id, login, nom from usuaris where estat=0";
		$files=$PDOUsuaris->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);		
    $usuaris = array();
    while ($fila){
      $usuaris[]= array(
        "nom"=>utf8_encode($fila["nom"]),
        "uid"=>$fila["id"],
        "login"=>utf8_encode($fila["login"]),
      );      
      $fila=$files->fetch(PDO::FETCH_BOTH);		
    }    
    return $usuaris;
  }
  function creaUsuari($nom,$login,$pass){
      global $connexio;
	    $PDOUsuaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );      
      $nom=utf8_encode($nom);
      $login=utf8_encode($login);
      $query = "insert into usuaris(login,nom,password) values('$login','$nom','$pass')";
      $sentencia = $PDOUsuaris->prepare($query);      
      $sentencia->execute();
      return array ("id"=>$PDOUsuaris->lastInsertId());
  }
  function esborrarUsuari($id){
      global $connexio;
	    $PDOUsuaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "update usuaris set estat=-1 where id=$id)";      
      $sentencia = $PDOUsuaris->prepare($query);      
      error_log(var_export($sentencia,true));
      $sentencia->execute();
      return array();
  }


?>