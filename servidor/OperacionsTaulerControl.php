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
  if($accio=='esborrarRol'){
    $idRol = $_GET["idrol"];
    $result=esborrarRol($idRol);
  }
  if($accio=='canviarNomRol'){
    $idRol = $_GET["idrol"];
    $nom = $_GET["nom"];
    $result= canviarNomRol($idRol,$nom);    
  }
  if($accio=='getUsuarisEsborrats'){
    $result = getUsuarisEsborrats();
  }
  if ($accio=='carregaDadesPaperera'){
    $result = carregaDadesPaperera();
  }
  if ($accio=='recuperarDeTaula'){    
    $id = $_GET["id"];
    $taula = $_GET["taula"];    
    $result =recuperarDeTaula($id,$taula);
  }
  if ($accio =='getPermisosRol'){
    $id=$_GET["id"];
    $result = getPermisosRol($id);
  }
  if ($accio=='canviarPermisRol'){
    $id=$_GET["id"];
    $lectura=$_GET["lectura"];
    $escriptura=$_GET["escriptura"];
    $result = canviarPermisRol($id,$lectura,$escriptura);
  }
  if ($accio=='insertNouPermisRol'){
    $idrol=$_GET["idrol"];
    $lectura=$_GET["lectura"];
    $escriptura=$_GET["escriptura"];
    $camp=$_GET["camp"];
    $idorige=$_GET["idorige"];
    $result=insertNouPermisRol($idrol,$lectura,$escriptura,$camp,$idorige);    
  }
  if ($accio=='eliminaPermisRol'){
    $idPermis = $_GET["idpermis"];
    $result =eliminaPermisRol($idPermis);
  }
  if ($accio=='eliminarQuestionari'){
    $idQuestionari = $_GET["id"];
    $result = eliminarQuestionari($idQuestionari);
  }
  if ($accio =='canviaNomQuestionari'){
    $idQuestionari = $_GET["id"];
    $nom = utf8_decode($_GET["nom"]);
    $result = canviaNomQuestionari($idQuestionari,$nom);
  }
  if ($accio =='canviaNomEstimul'){
    $idQuestionari = $_GET["id"];
    $nom = utf8_decode($_GET["nom"]);
    $result = canviaNomEstimul($idQuestionari,$nom);
  }
  if ($accio =='canviaNomItem'){
    $idQuestionari = $_GET["id"];
    $nom = utf8_decode($_GET["nom"]);
    $result = canviaNomItem($idQuestionari,$nom);
  }
  if ($accio=='getEstimuls'){
    $result=getEstimuls();
  }
  if ($accio=='esborrarEstimul'){
    $id = $_GET["id"];
    $result=esborrarEstimul($id);
  }
  if ($accio=='getItems'){
    $result=getItems();
  }
  if ($accio=='esborrarItem'){
    $id = $_GET["id"];
    $result=esborrarItem($id);
  }
  if ($accio=='getCadena'){
     $id = $_GET["id"];
     $taula = $_GET["taula"];
     $camp = $_GET["camp"];
     $idioma = $_GET["idioma"];
     $result = getCadena($id,$taula,$camp,$idioma);
     
  }
  if ($accio=='setCadena'){
     $id = $_GET["id"];
     $taula = $_GET["taula"];
     $camp = $_GET["camp"];
     $idioma = $_GET["idioma"];
     $text = $_GET["text"];
     $result = setCadena($id,$taula,$camp,$idioma,$text);     
  }
  if ($accio=='getDadesEstimul'){
    $id = $_GET["id"];
    $idioma = $_GET["idioma"];
    $result = getDadesEstimul($id,$idioma);
  }
  if  ($accio=='guardarDadesEstimul'){
    $id = $_GET["id"];
    $idioma = $_GET["idioma"];
    $titol = $_GET["titol"];
    $enunciat = $_GET["enunciat"];
    $result = guardarDadesEstimul($id,$idioma,$enunciat,$titol);
  }
  if ($accio=='getDadesItem'){
    $id = $_GET["id"];
    $idioma = $_GET["idioma"];
    $result = getDadesItem($id,$idioma);
  }
   if  ($accio=='guardarDadesItem'){
    $id = $_GET["id"];
    $idioma = $_GET["idioma"];
    $opcions = $_GET["opcions"];
    $enunciat = $_GET["enunciat"];
    $result = guardarDadesItem($id,$idioma,$enunciat,$opcions);
  }
  //actualitzem les dades
  $user->reloadData();
  $_SESSION["USUARI"] = $user;
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
      $sentencia->execute();     
      return "OK";
      
  }
  function getRols(){
      global $connexio;
      $PDORols = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from rols where estat <>-1";
      $files=$PDORols->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $rols=array();
      while($fila){
        $rols[] = array("id"=>$fila["id"],"descripcio"=>$fila["descripcio"]);
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $rols;
  
  }
  function esborrarRol($id){
      global $connexio;
	    $PDORol = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "update rols set estat=-1 where id=$id";      
      $sentencia = $PDORol->prepare($query);            
      $sentencia->execute();
      return "OK";
  }
  function canviarNomRol($id,$nom){
      global $connexio;
	    $PDORol = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $nom=utf8_encode($nom);
      $query = "update rols set descripcio='$nom' where id=$id";      
      $sentencia = $PDORol->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function recuperarDeTaula($id,$taula){
      global $connexio;      
	    $PDOTaula = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "update $taula set estat=0 where id=$id";      
      $sentencia = $PDOTaula->prepare($query);            
      $sentencia->execute();
      return "OK";
  }
  function getUsuarisEsborrats(){   
    global $connexio;
	  $PDOUsuaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
		$query = "select id, login, nom from usuaris where estat=-1";
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
  function getRolsEsborrats(){
      global $connexio;
      $PDORols = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from rols where estat =-1";
      $files=$PDORols->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $rols=array();
      while($fila){
        $rols[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]));
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $rols;  
  }
  function getEstimulsEsborrats(){
   global $connexio;
      $PDOEstimuls = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from estimuls  where estat =-1";
      $files=$PDOEstimuls->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $estimuls=array();
      while($fila){
        $estimuls[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]));
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $estimuls;  
  }
  function getItemsEsborrats(){
   global $connexio;
      $PDOItems = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from items  where estat =-1";
      $files=$PDOItems->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $items=array();
      while($fila){
        $items[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]));
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $items;  
  }
  function carregaDadesPaperera(){
    $result = array(
      "USUARIS"=>getUsuarisEsborrats(),
      "ROLS"=>getRolsEsborrats(),
      "QUESTIONARIS"=>getQuestionarisEsborrats(),
      "ESTIMULS" => getEstimulsEsborrats(),
      "ITEMS"=>getItemsEsborrats(),
    );
    return $result;
  }
  function getPermisosRol($id){
      global $connexio;
      $PDOPermisos = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,lectura,escriptura,camp,idorige,idrol from plantilles_rol where idrol =$id";
      $files=$PDOPermisos->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $permisos=array();
      while($fila){
        $permisos[] = array("id"=>$fila["id"],"lectura"=>$fila["lectura"],"escriptura"=>$fila["escriptura"],"camp"=>$fila["camp"],"idorige"=>$fila["idorige"],"idrol"=>$fila["idrol"]);
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $permisos;    
  }
  function canviarPermisRol($id,$lectura,$escriptura){
      global $connexio;
	    $PDOPermisos = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update plantilles_rol set lectura=$lectura, escriptura=$escriptura where id=$id";      
      $sentencia = $PDOPermisos->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function insertNouPermisRol($idrol,$lectura,$escriptura,$camp,$idorige){
      global $connexio;
	    $PDOPermisos = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                            
      $query = "insert into plantilles_rol(idrol,lectura,escriptura,camp,idorige) values($idrol,$lectura,$escriptura,'$camp',$idorige)";
      $sentencia = $PDOPermisos->prepare($query);            
      $sentencia->execute();
      $result = array("id"=>$PDOPermisos->lastInsertId());
      return $result;
  }
  function eliminaPermisRol($id){
      global $connexio;
	    $PDOEliminaPermis = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "delete from plantilles_rol where id=$id";      
      $sentencia = $PDOEliminaPermis->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function eliminarQuestionari($id){
      global $connexio;
	    $PDOQuestionari = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update questionaris set estat=-1 where id=$id";      
      $sentencia = $PDOQuestionari->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function getQuestionarisEsborrats(){
      global $connexio;
      $PDOQuestionaris = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from questionaris where estat =-1";
      $files=$PDOQuestionaris->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $questionaris=array();
      while($fila){
        $questionaris[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]));
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }
      return $questionaris;  
  }
  function canviaNomQuestionari($id,$nom){
      global $connexio;
	    $PDOQuestionari = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update questionaris set descripcio='$nom' where id=$id";      
      $sentencia = $PDOQuestionari->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
   function canviaNomEstimul($id,$nom){
      global $connexio;
	    $PDOEstimul = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update estimuls set descripcio='$nom' where id=$id";      
      $sentencia = $PDOEstimul->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
   function canviaNomItem($id,$nom){
      global $connexio;
	    $PDOItem = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update items  set descripcio='$nom' where id=$id";      
      $sentencia = $PDOItem->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
   function getItems(){
      global $connexio;
      $PDOItems = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from items where estat <>-1";
      $files=$PDOItems->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $Items=array();
      while($fila){
        $Items[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]));
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }      
      return $Items;  
  }
  function getEstimuls(){
      global $connexio;
      $PDOEstimuls = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "select id,descripcio from estimuls where estat <>-1";
      $files=$PDOEstimuls->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $Estimuls=array();
      while($fila){
        $Estimuls[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]));
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }      
      return $Estimuls;  
  }
    function esborrarEstimul($id){
      global $connexio;
	    $PDOEstimul = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update estimuls set estat = -1 where id=$id";          
      $sentencia = $PDOEstimul->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
    function esborrarItem($id){
      global $connexio;
	    $PDOItem = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "update items set estat = -1 where id=$id";                
      $sentencia = $PDOItem->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function getCadena($id,$taula,$camp,$idioma){
      $cadena = '';
      global $connexio;
	    $PDOCadena = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $query = "select text from cadenes where idorige=$id and taulaorige='$taula' and camporige='$camp' and idioma=$idioma";      
      $files=$PDOCadena->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);
      if ($fila) $cadena = utf8_encode($fila["text"]);
      return $cadena;
  }
  function setCadena($id,$taula,$camp,$idioma,$text){   
      global $connexio;      
      $text = utf8_decode($text);
      //$text = str_replace("'",'&#8217;',$text);
      $text = str_replace("'",'&apos;',$text);
	    $PDOCadena = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );                        
      $queryUpdate = "update cadenes set text='$text' where idorige=$id and taulaorige='$taula' and camporige='$camp' and idioma=$idioma";      
      $queryInsert = "insert into cadenes (idorige,taulaorige,camporige,idioma,text) values ($id,'$taula','$camp',$idioma,'$text')";
      $query = "Select count(*) as compte from cadenes where idorige=$id and taulaorige='$taula' and camporige='$camp' and idioma=$idioma";      
      $files=$PDOCadena->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);
      $compte=$fila["compte"];
      //Comprovem si existeix la cadena per insertar o fer update
      //S'ha de fer la comprovació per que mysql torna 0 si fas un update amb els mateixos valors del camp. Així qeu replicaria registres'
      $query = $queryUpdate;
      if ($fila["compte"]==0) 
        $query = $queryInsert;
      $sentencia = $PDOCadena->prepare($query);            
      $sentencia->execute();
      
      return "OK";
  }
  function getDadesEstimul($id,$idioma){    
      $enunciat = getCadena($id,'estimuls','enunciat',$idioma);
      $titol = getCadena($id,'estimuls','titol',$idioma);
      return array("ENUNCIAT"=>$enunciat,"TITOL"=>$titol);
  }
  function guardarDadesEstimul($id,$idioma,$enunciat,$titol){
      setCadena($id,'estimuls','titol',$idioma,$titol);  
      setCadena($id,'estimuls','enunciat',$idioma,$enunciat);     
  }
  function getOpcionsItem($idItem,$idioma){
  return array();
  }
  function getDadesItem($id,$idioma){
    $enunciat =getCadena($id,'items','enunciat',$idioma);    
    return array ("ENUNCIAT"=>$enunciat,"OPCIONS"=>getOpcionsItem($id,$idioma));
  }
  function guardarDadesItem($id,$idioma,$enunciat,$opcions){
     setCadena($id,'items','enunciat',$idioma,$enunciat);
     return "OK";
  }
?>