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
        tornar = " <a href='javascript: history.go(-1)'> Tornar</a>";
        var tancarSessio = "<a href='index.php?action=tancarSessio'>Tacar Sessio</a>";
        var html = "<h2>Usuaris</h2>";
        html +=  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>uid</th><th>nom</th><th>login</th><th>accions</th></tr></thead> ";        
        for(var i=0;i<Usuaris.length;i++){
         html+= "<tr><td>"+Usuaris[i].uid + "</td><td>"+Usuaris[i].nom + "</td><td>"+Usuaris[i].login+"</td><td><div class='glyphicon glyphicon-transfer' style='cursor: pointer;' onclick='recuperarUsuari("+Usuaris[i].uid+")'></div></tr>";
        }        
        html +="</table>";                        
        html += "<h2>Rols</h2>";
        html +=  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th>nom</th><th>accions</th></tr></thead> ";
        for(var i=0;i<Rols.length;i++){
          html+= "<tr><td>"+Rols[i].id + "</td><td>"+Rols[i].descripcio + "</td><td><div class='glyphicon glyphicon-transfer' style='cursor: pointer;' onclick='recuperarRol("+Rols[i].id+")'> </td></tr>";
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
                              //questionaris,items,rols...
                              carregarTaula();
                          }               
                      }
            $.ajax(peticio);
        }
    </script>
    <body onLoad="carregaInicial()">
  <div class='container'>
<?php


?>


<hr/>
<a href='index.php?action=tancarSessio'>Tacar Sessio</a>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
</body>
</html>