
<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <script>
      var rols = [];
      function esborrarRol(id){
          var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=esborrarRol&idrol='+id,
                          success:function(result){ 
                              var trobat = false;                              
                              for(var i=0;(i<rols.length) && !(trobat) ;i++){                              
                                if(rols[i].id==id){                                  
                                    rols.splice(i,1);
                                    trobat = true;
                                    carregarTaulaRols(rols);
                                  }
                              }
                          }               
                      }
        $.ajax(peticio);

      }
      function canviarRol(id){
          var trobat = false;
          var nom = "";
          for(var i=0;(i<rols.length) && !(trobat);i++){      
            if (id==rols[i].id){
               nom=rols[i].descripcio;
               trobat=true;
            }
          }
          BootstrapDialog.show({          
          title:'Introduix nou nom',
          message:"<input id='nouNom' type='text' value='"+nom+"'></input>",
          buttons:[           {          
          label:'Ok',
          action: function(dialogItself){
                    var trobat = false;
                    for(var i=0;(i<rols.length) && !(trobat);i++){
                      if (id==rols[i].id){
                        var nouNom = $('#nouNom').val();
                        rols[i].descripcio=nouNom;
                        var peticio = {
                            url:'servidor/OperacionsTaulerControl.php',
                            type:'GET',
                            data:'accio=canviarNomRol&idrol='+id+"&nom="+nouNom,
                            success:function(){                                 
                                carregarTaulaRols(rols);
                            }               
                        }
                        $.ajax(peticio);                     
                      }
                    }
                    dialogItself.close();
                  }
          },
          {
          label:'Cancelar',
          action: function(dialogItself){
                  dialogItself.close();
                  }
          }
          ]
          });
          
      }
      function carregarTaulaRols(dataRols){        
        tancarSessio = "<a href='index.php?action=tancarSessio'>Tacar Sessio</a>";
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th>nom</th><th>accions</th></tr></thead> ";
        for(var i=0;i<dataRols.length;i++){
         html+= "<tr><td>"+dataRols[i].id + "</td><td>"+dataRols[i].descripcio + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarRol("+dataRols[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-user' style='cursor: pointer;' onclick='canviarRol("+dataRols[i].id+")'> </td></tr>";
        }
        html+= "<tr><td></td><td><input id='descripcioNou' type='text'/></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='afegirUsuari()'></div></td></tr>";
        html +="</table>";        
        $(".container").html(html+tancarSessio);
      }
      function carregaInicial(){
         var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=getRols',
                          success:function(result){ 
                              rols = JSON.parse(result);
                              carregarTaulaRols(rols);
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