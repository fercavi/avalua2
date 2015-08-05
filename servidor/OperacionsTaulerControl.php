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
  if ($accio=='getRols'){
    $result=getRols();
  }
  if ($accio=='aplicarPlantillaRolUsuari'){
      $idplantilla=$_GET["idplantilla"];
      $idusuari = $_GET["idusuari"];
      $result = aplicarPlantillaRolUsuari($idplantilla,$idusuari);
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
      $query = "update usuaris set estat=-1 where id=$id";      
      $sentencia = $PDOUsuaris->prepare($query);            
      $sentencia->execute();
      return array();
  }
  function aplicarPlantillaRolUsuari($idplantilla,$idusuari){
      global $connexio;
      $PDOPlantilles = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $queryEsborrar ="delete from permisos where idusuari=$idusuari";
      $sentencia = $PDOPlantilles->prepare($queryEsborrar);            
      $sentencia->execute();      
      $query = "insert into permisos(idusuari,lectura,escriptura,camp,idorige)  (select $idusuari,lectura,escriptura,camp,idorige from plantilles_rol where idrol=$idplantilla) ";
      $sentencia = $PDOPlantilles->prepare($query);            
      error_log($query);
      $sentencia->execute();     
      return "OK";
      
  }
  function getRols(){
      global $connexio;
      $PDORols = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from rols";
      $files=$PDORols->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $rols=array();
      while($fila){
        $rols[] = array("id"=>$fila["id"],"descripcio"=>$fila["descripcio"]);
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $rols;
  
  }


?>