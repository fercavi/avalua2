<?php
require '../conf.php';
  function getPDO(){
    $PDO = null;
    global $DBAServerType;    
    if ($DBAServerType==DBAServerTypeMysql){
      global $connexio;
      $PDO = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );
    }
    return $PDO;
  }
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
  if ($accio=='getOpcions'){
    $id=$_GET["iditem"];
    $result = getOpcions($id);
  }
  if ($accio=='getOpcioIdioma'){
    $id=$_GET["id"];
    $idioma=$_GET["idioma"];
    $result=getOpcioIdioma($id,$idioma);
  }
  if ($accio=='canviarDescripcioOpcio'){
    $idopcio=$_GET["id"];
    $descripcio=$_GET["descripcio"];
    $result=canviarDescripcioOpcio($idopcio,$descripcio);
  }
  if ($accio=='guardarIdiomaOpcio'){
    $idOpcio= $_GET["id"];
    $text = $_GET["opcio"];
    $idioma=$_GET["idioma"];
    $result = guardarIdiomaOpcio($idOpcio,$text,$idioma);
  }
  if ($accio=='updateOrdresDosOpcions'){
    $idopcio1=$_GET["id1"];
    $idopcio2=$_GET["id2"];
    $ordre1=$_GET["ordre1"];
    $ordre2=$_GET["ordre2"];
    $result = updateOrdresDosOpcions($idopcio1,$ordre1,$idopcio2,$ordre2);
  }
  if ($accio=='afegirQuestionari'){
    $nom=$_GET["nom"];
    $result = afegirQuestionari($nom);
  }
  if ($accio=='afegirEstimul'){
    $nom=$_GET["nom"];
    $result = afegirEstimul($nom);
  }
  if ($accio=='getQuestionaris'){
    $userLogin= $_GET["userLogin"];
    $result=getQuestionaris($userLogin);
  }
  if ($accio=='afegirItem'){
    $nom=$_GET["nom"];
    $tipus = $_GET["tipus"];
    $result = afegirItem($nom,$tipus);
  }
  if ($accio=='getEstimulsQuestionaris'){
    $id=$_GET["id"];
    $result = getEstimulsQuestionaris($id);
  }
  if ($accio=='getItemsEstimul'){
    $id=$_GET["id"];
    $result = getItemsEstimul($id);
  }
  if ($accio=='esborrarAssignacioQuestionariEstimul'){
    $id=$_GET["id"];
    $result=esborrarAssignacioQuestionariEstimul($id);
  }
  if ($accio=='afegirAssignacioQuestionariEstimul'){
    $idquestionari = $_GET["idquestionari"];
    $idestimul = $_GET["idestimul"];
    $result = afegirAssignacioQuestionariEstimul($idquestionari,$idestimul);
  }
  if ($accio=='getHtmlItem'){
    $id=$_GET["id"];
    $idioma = $_GET["idioma"];
    $result = getHtmlItem($id,$idioma);
  }
  if ($accio == 'getHTMLEstimul'){
    $id=$_GET["id"];
    $idioma=$_GET["idioma"];
    $result = getHTMLEstimul($id,$idioma);
  }
  //actualitzem les dades
  $user->reloadData();
  $_SESSION["USUARI"] = $user;
  echo(json_encode($result));
  
  
  function llistatUsuaris(){
    $PDOUsuaris = getPDO();
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
	    $PDOUsuaris = getPDO();
      $nom=utf8_encode($nom);
      $login=utf8_encode($login);
      $query = "insert into usuaris(login,nom,password) values('$login','$nom','$pass')";
      $sentencia = $PDOUsuaris->prepare($query);      
      $sentencia->execute();
      return array ("id"=>$PDOUsuaris->lastInsertId());
  }
  function esborrarUsuari($id){      
	    $PDOUsuaris = getPDO();
      $query = "update usuaris set estat=-1 where id=$id";      
      $sentencia = $PDOUsuaris->prepare($query);            
      $sentencia->execute();
      return array();
  }
  function aplicarPlantillaRolUsuari($idplantilla,$idusuari){      
      $PDOPlantilles = getPDO();
      $queryEsborrar ="delete from permisos where idusuari=$idusuari";
      $sentencia = $PDOPlantilles->prepare($queryEsborrar);            
      $sentencia->execute();      
      $query = "insert into permisos(idusuari,lectura,escriptura,camp,idorige)  (select $idusuari,lectura,escriptura,camp,idorige from plantilles_rol where idrol=$idplantilla) ";
      $sentencia = $PDOPlantilles->prepare($query);                  
      $sentencia->execute();     
      return "OK";
      
  }
  function getRols(){      
      $PDORols = getPDO();
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
	    $PDORol = getPDO();
      $query = "update rols set estat=-1 where id=$id";      
      $sentencia = $PDORol->prepare($query);            
      $sentencia->execute();
      return "OK";
  }
  function canviarNomRol($id,$nom){      
	    $PDORol = getPDO();
      $nom=utf8_encode($nom);
      $query = "update rols set descripcio='$nom' where id=$id";      
      $sentencia = $PDORol->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function recuperarDeTaula($id,$taula){      
	    $PDOTaula = new PDO('mysql:host='.$connexio["SERVIDOR"].';dbname='.$connexio["DBA"], $connexio["USER"], $connexio["PASSWORD"] );            
      $query = "update $taula set estat=0 where id=$id";      
      $sentencia = $PDOTaula->prepare($query);            
      $sentencia->execute();
      return "OK";
  }
  function getUsuarisEsborrats(){       
	  $PDOUsuaris = getPDO();
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
      $PDORols = getPDO();
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
      $PDOEstimuls = getPDO();
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
      $PDOItems = getPDO();
      $query = "select id,descripcio,tipus from items  where estat =-1";
      $files=$PDOItems->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $items=array();
      while($fila){
        $items[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]),"tipus"=>$fila["tipus"]);
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
      $PDOPermisos = getPDO();
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
	    $PDOPermisos = getPDO();
      $query = "update plantilles_rol set lectura=$lectura, escriptura=$escriptura where id=$id";      
      $sentencia = $PDOPermisos->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function insertNouPermisRol($idrol,$lectura,$escriptura,$camp,$idorige){      
	    $PDOPermisos = getPDO();
      $query = "insert into plantilles_rol(idrol,lectura,escriptura,camp,idorige) values($idrol,$lectura,$escriptura,'$camp',$idorige)";
      $sentencia = $PDOPermisos->prepare($query);            
      $sentencia->execute();
      $result = array("id"=>$PDOPermisos->lastInsertId());
      return $result;
  }
  function eliminaPermisRol($id){      
	    $PDOEliminaPermis = getPDO();
      $query = "delete from plantilles_rol where id=$id";      
      $sentencia = $PDOEliminaPermis->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function eliminarQuestionari($id){      
	    $PDOQuestionari = getPDO();
      $query = "update questionaris set estat=-1 where id=$id";      
      $sentencia = $PDOQuestionari->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function getQuestionarisEsborrats(){      
      $PDOQuestionaris = getPDO();
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
	    $PDOQuestionari = getPDO();
      $query = "update questionaris set descripcio='$nom' where id=$id";      
      $sentencia = $PDOQuestionari->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
   function canviaNomEstimul($id,$nom){      
	    $PDOEstimul =  getPDO();
      $query = "update estimuls set descripcio='$nom' where id=$id";      
      $sentencia = $PDOEstimul->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
   function canviaNomItem($id,$nom){      
	    $PDOItem =  getPDO();
      $query = "update items  set descripcio='$nom' where id=$id";      
      $sentencia = $PDOItem->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
   function getItems(){      
      $PDOItems =  getPDO();
      $query = "select id,descripcio,tipus from items where estat <>-1";
      $files=$PDOItems->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);		
      $Items=array();
      while($fila){
        $Items[] = array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]),"tipus"=>$fila["tipus"]);
        $fila=$files->fetch(PDO::FETCH_BOTH);		
      }      
      return $Items;  
  }
  function getEstimuls(){      
      $PDOEstimuls =  getPDO();
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
	    $PDOItem =  getPDO();
      $query = "update items set estat = -1 where id=$id";                
      $sentencia = $PDOItem->prepare($query);            
      $sentencia->execute();
      return "OK";    
  }
  function getCadena($id,$taula,$camp,$idioma){
      $cadena = '';      
	    $PDOCadena =  getPDO();
      $query = "select text from cadenes where idorige=$id and taulaorige='$taula' and camporige='$camp' and idioma=$idioma";      
      $files=$PDOCadena->query($query);
		  $fila=$files->fetch(PDO::FETCH_BOTH);
      if ($fila) $cadena = utf8_encode($fila["text"]);
      return $cadena;
  }
  function setCadena($id,$taula,$camp,$idioma,$text){         
      $text = utf8_decode($text);      
      $text = str_replace("'",'&apos;',$text);
	    $PDOCadena =  getPDO();
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
    $PDOOpcions =  getPDO();
    $query = "select O.id,C.text,O.ordre from opcions O, cadenes C where iditem=$idItem and C.idorige=O.id and C.idioma=$idioma and C.taulaorige='opcions' and C.camporige='valor' order by ordre" ;    
    $files=$PDOOpcions->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);    
    $opcions = "";
    while($fila){      
      $opcions .=utf8_encode($fila["text"])."<br/>";
      $fila=$files->fetch(PDO::FETCH_BOTH);
    }
    
    return $opcions;
  }
  function getDadesItem($id,$idioma){
    $enunciat =getCadena($id,'items','enunciat',$idioma);    
    return array ("ENUNCIAT"=>$enunciat);
  }

  
  function guardarDadesItem($id,$idioma,$enunciat,$opcions){
     setCadena($id,'items','enunciat',$idioma,$enunciat);     
     return "OK";
  }
  function getOpcions($idItem){    
    $PDOOpcions =  getPDO();
    $query = "select id,descripcio,ordre from opcions where iditem=$idItem";    
    $files=$PDOOpcions->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);
    $opcions = array();
    while($fila){
      $opcions[]=array("id"=>$fila["id"],"descripcio"=>utf8_encode($fila["descripcio"]),"ordre"=>$fila["ordre"]);
      $fila=$files->fetch(PDO::FETCH_BOTH);
    }
    return $opcions;
  }
  function afegirOpcio($idItem,$descripcio,$ordre){    
    $PDOOpcions =  getPDO();
    $query = "insert into opcions (iditem,descripcio,ordre) values($idItem,'$descripcio',$ordre)";
    $sentencia = $PDOOpcions->prepare($query);            
    $sentencia->execute();
    $idinsert = $PDOOpcions->lastInsertId();
    return array("ID"=>$idinsert);    
  }
  function canviarDescripcioOpcio($idopcio,$descripcio){    
    $PDOOpcions =  getPDO();
    $query = "update opcions set descripcio='$descripcio' where id=$idopcio";
    $sentencia = $PDOOpcions->prepare($query);            
    $sentencia->execute();
    return array("OK");
  }
  function getOpcioIdioma($idOpcio,$idIdioma){
    return array ("OPCIO" =>getCadena($idOpcio,'opcions','valor',$idIdioma));
  }
  function guardarIdiomaOpcio($idOpcio,$text,$idioma){
    setCadena($idOpcio,"opcions",'valor',$idioma,$text);
    return array("OK");
  }
  function updateOrdresDosOpcions($idopcio1,$ordre1,$idopcio2,$ordre2){    
    $PDOOpcions =  getPDO();
    $query = "update opcions set ordre='$ordre1' where id=$idopcio1";
    $sentencia = $PDOOpcions->prepare($query);            
    $sentencia->execute();
    $query = "update opcions set ordre='$ordre2' where id=$idopcio2";
    $sentencia = $PDOOpcions->prepare($query);            
    $sentencia->execute();
    return array("OK");    
  }
  function getQuestionaris($userlogin){    
    $PDOQuestionaris =  getPDO();
    $query = $query = "select Q.id,Q.descripcio from  permisos P, usuaris U, questionaris Q  where P.lectura=1 and U.login='$userlogin' and U.id=P.idusuari and P.camp='questionaris' and P.idorige=Q.id AND Q.estat<>-1";		            
    $sentencia = $PDOQuestionaris->prepare($query);
    $questionaris = array();
    $files=$PDOQuestionaris->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);
    while($fila){
      $questionaris[]=array("id"=>$fila["id"],"nom"=>utf8_encode($fila["descripcio"]),);
      $fila=$files->fetch(PDO::FETCH_BOTH);      
    }
    return $questionaris;
  }
  function afegirQuestionari($nom){    
    $PDOQuestionari =  getPDO();
    $query = utf8_decode("insert into questionaris (descripcio) values ('$nom')");        
    $sentencia = $PDOQuestionari->prepare($query);            
    $sentencia->execute();
    $idinsert = $PDOQuestionari->lastInsertId();
    return array("ID"=>$idinsert);    
  }
  function afegirEstimul($nom){    
    $PDOEstimul =  getPDO();
    $query = utf8_decode("insert into estimuls (descripcio) values ('$nom')");    
    $sentencia = $PDOEstimul->prepare($query);            
    $sentencia->execute();
    $idinsert = $PDOEstimul->lastInsertId();
    return array("ID"=>$idinsert);    
  }
  function afegirItem($nom,$tipus){
    $PDOItem =  getPDO();
    $query = utf8_decode("insert into items (descripcio,tipus) values ('$nom',$tipus)");    
    $sentencia = $PDOItem->prepare($query);            
    $sentencia->execute();
    $idinsert = $PDOItem->lastInsertId();
    return array("ID"=>$idinsert);    
  }
  function getEstimulsQuestionaris($idQuestionari){
    $PDOEstimuls = getPDO();
    $query = "select EI.id,EI.idestimul,E.descripcio as estimul_descripcio,EI.idquestionari,Q.descripcio as questionari_descripcio from estimul_instancia EI, estimuls E, questionaris Q Where ";
    $query .= " Q.id=EI.idquestionari AND E.id=EI.idestimul and Q.id=$idQuestionari and E.estat<>-1";
    $estimuls = array();
    $files=$PDOEstimuls->query($query);
		$fila=$files->fetch(PDO::FETCH_BOTH);
    while($fila){
      $estimuls[]=array(
                  "id"=>$fila["id"],
                  "idestimul"=>$fila["idestimul"],
                  "idquestionari"=>$fila["idquestionari"],
                  "questionari_descripcio"=>utf8_encode($fila["questionari_descripcio"]),
                  "estimul_descripcio"=>utf8_encode($fila["estimul_descripcio"]),);
      $fila=$files->fetch(PDO::FETCH_BOTH);      
    }
    return $estimuls;
  }
  function esborrarAssignacioQuestionariEstimul($id){
      $PDOEstimul = getPDO();
      $queryEsborrar ="delete from estimul_instancia where id=$id";
      $sentencia = $PDOEstimul->prepare($queryEsborrar);            
      $sentencia->execute();      
      return "OK";
  }
  function afegirAssignacioQuestionariEstimul($idQuestionari,$idEstimul){
    $PDOEstimuls = getPDO();
    $query = "insert into estimul_instancia(idestimul,idquestionari) values ($idEstimul,$idQuestionari)";
    $sentencia = $PDOEstimuls->prepare($query);            
    $sentencia->execute();
    $idinsert = $PDOEstimuls->lastInsertId();
    return array("ID"=>$idinsert);    
  }
  function afegirAssignacioEstimulItem($idEstimul,$idItem){
    $PDOItems = getPDO();
    $query = "insert into item_instancia(idestimul,idquestionari) values ($idEstimul,$idQuestionari)";
    //$sentencia = $PDOEstimuls->prepare($query);            
    $sentencia->execute();
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $idinsert = $PDOEstimuls->lastInsertId();
    return array("ID"=>$idinsert);    
  }
  function getItemsEstimul($id){
    $PDOItems = getPDO();
    $query = "select II.id,II.idestimul_instancia,II.iditem,I.descripcio as item_descripcio from item_instancia II, items I, estimul_instancia EI  Where ";
    $query .= "EI.idestimul=$id and EI.id=II.idestimul_instancia and II.iditem=I.id and I.estat <>-1 ";    
    $items = array();
    $files=$PDOItems->query($query);
    
		$fila=$files->fetch(PDO::FETCH_BOTH);
    while($fila){
      $items[]=array(
                  "id"=>$fila["id"],
                  "idestimul_instancia"=>$fila["idestimul_instancia"],
                  "iditem"=>$fila["iditem"],
                  "item_descripcio"=>utf8_encode($fila["item_descripcio"]),);
      $fila=$files->fetch(PDO::FETCH_BOTH);      
    }
    return $items;

  }
    function getHTMLEstimul($idEstimul,$idioma){
      $PDOEnunciat = getPDO();
      $query = "select iditem from item_instancia II, estimul_instancia EI where EI.idestimul=$idEstimul and EI.id=II.idestimul_instancia";
      $PDOEnunciat->query($query);
      $files=$PDOEnunciat->query($query);
      $fila=$files->fetch(PDO::FETCH_BOTH);
      
      $titol = getCadena($idEstimul,'estimuls','titol',$idioma);
      $enunciat = getCadena($idEstimul,'estimuls','enunciat',$idioma);
      
      $html = "<div  name='Estimul_".$idEstimul."'><h3>".$titol."</h3><p>".$enunciat."</p>";
      while($fila){
        $html.= getHtmlItem($fila["iditem"],$idioma);
        $fila=$files->fetch(PDO::FETCH_BOTH);
      }
      $html .='</div>';      
      return $html;
  }
  function getOpcionsClasseItem($idItem,$idioma){     
     $PDOItems = getPDO();
     $query = "select C.text from cadenes C,opcions O where C.idorige=O.id and O.iditem=$idItem and C.taulaorige='opcions' and C.camporige='valor' and C.idioma='".$idioma ."' order by ordre";     
     $files=$PDOItems->query($query);
		 $fila=$files->fetch(PDO::FETCH_BOTH);		
     $result = array();
     while($fila){
      $result[] = utf8_encode($fila["text"]);
      $fila=$files->fetch(PDO::FETCH_BOTH);		
     }     
     return $result;
  }
  function getHtmlItem($idItem,$idioma){
    $PDOItem = getPDO();
    $opcions =getOpcionsClasseItem($idItem,$idioma);
    $respostes = array();
    $escriptura = true;
    $lectura = true;
    $queryEnunciat =  "select I.id,I.tipus,C.text as enunciat from cadenes C,items I ";    
    $queryEnunciat .= "  where C.idioma='".$idioma."' and C.taulaorige='items' and C.camporige='enunciat' and C.idorige=$idItem AND I.id=$idItem";    
    $files=$PDOItem->query($queryEnunciat);
    $fila=$files->fetch(PDO::FETCH_BOTH);		    
    $Item = new ItemRadioButton($fila["id"],utf8_encode($fila["enunciat"]),$opcions,$respostes,$escriptura,$lectura);
    return $Item->generateHTML();    
  }
?>