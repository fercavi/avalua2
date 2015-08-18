<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <script>   
      var Usuaris;
      function esborrarUsuari(uid){
        esborrat = false;
        for(var i=0;(i<Usuaris.length) && (!esborrat);i++){
          if(Usuaris[i].uid==uid){
            var peticio = {
                url:'servidor/OperacionsTaulerControl.php',
                type:'GET',
                data:'accio=esborrarUsuari&uid='+uid,
            }
            $.ajax(peticio);
            Usuaris.splice(i,1);
            doMostraUsuaris(Usuaris);
            esborrat=true;          
          }
        }
        
      }
      function callBackAfegirUsuari(data){          
          id = JSON.parse(data);
          id = id.id;
          usuari = { 
            uid:id ,
            nom:nom,
            login:login
          };          
          Usuaris.push(usuari);
          doMostraUsuaris(Usuaris);                
      }
      
      function callBackCanviarRols(result,uid){
          var rols = JSON.parse(result);
          var selectHTML = "<select id='selectRol'>";
          for(var i=0;i<rols.length;i++){
            selectHTML +="<option value='"+rols[i].id+"'>" + rols[i].descripcio + "</option>";
          }
          selectHTML +="</select>";
          
          BootstrapDialog.show({
            title:'Selecciona Rol',
            message:selectHTML,
            buttons:[
            {
              label:'ok',
              action: function(dialogItself){
                      idplantilla=$('#selectRol').val();
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=aplicarPlantillaRolUsuari&idusuari='+uid+'&idplantilla='+idplantilla,
                          success:function(result){ 
                              
                          }               
                      }
                      $.ajax(peticio);
                      dialogItself.close();
                     }
            },
            {
               label:'Cancelar',
               action: function(dialogItself){dialogItself.close();}
            }
            ]
          });
      }
      
      function canviarRol(uid){
        var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=getRols',
                          success:function(result){ 
                              callBackCanviarRols(result,uid);
                          }               
                      }
        $.ajax(peticio);
      }
      function afegirUsuari(){
        BootstrapDialog.show({
          title:'Introduix contrasenya',
          message:"<input id='nouPass' type='password'></input>",
          buttons:[ 
          {
            label:'Ok',
            action: function(dialogItself){
                      nom = $('#nomNou').val();
                      login = $('#loginNou').val();
                      pass = $('#nouPass').val();     
                      pass = calcMD5(pass);
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=crearUsuari&login='+login+"&nom="+nom+"&pass="+pass,
                          success:function(result){ 
                              callBackAfegirUsuari(result);
                          }
                      }
                      $.ajax(peticio);
                      dialogItself.close();
            }
          },
          {
            label:'Cancelar',
            action:function(dialogItself){ dialogItself.close()}
          }
          ]
        });
      }
      
      function doMostraUsuaris(usuaris){
        tornar = " <a href='javascript: history.go(-1)'> Tornar</a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'>Tacar Sessio</a>";
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>uid</th><th>nom</th><th>login</th><th>accions</th></tr></thead> ";
        for(var i=0;i<usuaris.length;i++){
         html+= "<tr><td>"+usuaris[i].uid + "</td><td>"+usuaris[i].nom + "</td><td>"+usuaris[i].login+"</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarUsuari("+usuaris[i].uid+")'></div>&nbsp;<div class='glyphicon glyphicon-user' style='cursor: pointer;' onclick='canviarRol("+usuaris[i].uid+")'> </td></tr>";
        }
        html+= "<tr><td></td><td><input id='nomNou' type='text'/></td><td><input id='loginNou' type='text'/></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='afegirUsuari()'></div></td></tr>";
        html +="</table>";        
        $(".container").html(tornar+html+tancarSessio);
      }
      function mostraUsuaris(data){         
        Usuaris = JSON.parse(data);        
        doMostraUsuaris(Usuaris);
      }
      function carregaUsuaris(callback){
        var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=llistatUsuaris',
    			success:function(result){    				
    				if (callback)
    					callback(result);
    			}
    		}
            $.ajax(peticio);
      }
      
    </script>
</head>
  <body onload='carregaUsuaris(mostraUsuaris)'>  
  <div class='container' width="60%">
<?php


?>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
 <script src="js/md5.js"></script>
</body>
</html>