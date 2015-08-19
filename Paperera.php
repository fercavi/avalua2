
<?php

 require_once 'conf.php';  
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();
	$user=$_SESSION["USUARI"];
  
  
?>
<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    
    <script>
      Usuaris = [];
      Questionaris = [];
      Estimuls= [];
      Items = [];
      Rols = [];
      function recuperarUsuari(id){
        var trobat = false;            
        for(var i=0;(i<Usuaris.length)&&(!trobat);i++){
          if(id==Usuaris[i].uid){            
            trobat = true;
            Usuaris.splice(i,1);
          }
        }
        recuperarTaula(id,'usuaris');        
      }
      function recuperarRol(id){
        var trobat = false;
        for(var i=0;(i<Rols.length)&&(!trobat);i++){
          if(id==Rols[i].id){
            trobat = true;
            Rols.splice(i,1);
          }
        }
        recuperarTaula(id,'rols');        
      }
      function recuperarQuestionari(id){
        var trobat = false;
        for(var i=0;(i<Questionaris.length)&&(!trobat);i++){
          if(id==Questionaris[i].id){
            trobat = true;
            Questionaris.splice(i,1);
          }
        }
        recuperarTaula(id,'questionaris');        
      }
      function recuperarTaula(id,taula){
            var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=recuperarDeTaula&id='+id+"&taula="+taula,
                          success:function(result){ 
                              carregarTaula();
                          }               
                      }
            $.ajax(peticio);
        
      }
      function carregarTaula(){
        tornar = " <a href='javascript: history.go(-1)'> <?php echo $lang["TORNAR"]?></a>";
        var tancarSessio = "<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>";
        //Usuaris
        var html = "<h2><?php echo $lang["USUARIS"]?></h2>";
        html +=  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>uid</th><th><?php echo $lang["NOM"]?></th><th>Login</th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";        
        for(var i=0;i<Usuaris.length;i++){
         html+= "<tr><td>"+Usuaris[i].uid + "</td><td>"+Usuaris[i].nom + "</td><td>"+Usuaris[i].login+"</td><td><div class='glyphicon glyphicon-transfer' style='cursor: pointer;' onclick='recuperarUsuari("+Usuaris[i].uid+")'></div></tr>";
        }        
        html +="</table>";
        //Rols
        html += "<h2><?php echo $lang["ROLS"]?></h2>";
        html +=  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<Rols.length;i++){
          html+= "<tr><td>"+Rols[i].id + "</td><td>"+Rols[i].descripcio + "</td><td><div class='glyphicon glyphicon-transfer' style='cursor: pointer;' onclick='recuperarRol("+Rols[i].id+")'> </td></tr>";
        }        
        html +="</table>";      
        //Questionaris
        html += "<h2><?php echo $lang["QUESTIONARIS"]?></h2>";
        html +=  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<Questionaris.length;i++){
          html+= "<tr><td>"+Questionaris[i].id + "</td><td>"+Questionaris[i].descripcio + "</td><td><div class='glyphicon glyphicon-transfer' style='cursor: pointer;' onclick='recuperarQuestionari("+Questionaris[i].id+")'> </td></tr>";
        }        
        html +="</table>";      
        
        
        
        
        
        
        $(".container").html(tornar+html+tancarSessio);
      }
      function carregaInicial(){      
            var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=carregaDadesPaperera',
                          success:function(result){ 
                              dades = JSON.parse(result);
                              Usuaris = dades.USUARIS;
                              Rols = dades.ROLS;
                              Questionaris = dades.QUESTIONARIS;
                              //questionaris,items,rols...
                              carregarTaula();
                          }               
                      }
            $.ajax(peticio);
        }
    </script>
    <body onLoad="carregaInicial()">
  <div class='container'>


<hr/>
<a href='index.php?action=tancarSessio'>Tacar Sessio</a>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
</body>
</html>