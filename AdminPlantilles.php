
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
      function guardarPermis(id){
        var lectura = $("#lectura_"+id).is(':checked') ? 1 : 0;         
        var escriptura = $("#escriptura_"+id).is(':checked') ? 1 : 0;    
        var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=canviarPermisRol&id='+id+"&lectura="+lectura +"&escriptura="+escriptura,
                          success:function(result){ 
                     
                          }               
                      }
          $.ajax(peticio);      
        
        
      }
      function afegirPermis(idrol){
        var lectura = $("#lectura_Nou").is(':checked') ? 1 : 0;         
        var escriptura = $("#escriptura_Nou").is(':checked') ? 1 : 0;    
        var idorige = $('#idorige_Nou').val();
        var camp = $('#camp_Nou').val();
        
         var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=insertNouPermisRol&idrol='+idrol+"&lectura="+lectura+"&escriptura="+escriptura+"&camp="+camp+"&idorige="+idorige,
                          success:function(result){ 
                            var slectura = "";
                            var sescriptura = "";
                            if (lectura==1)
                                slectura = " checked ";
                            if(escriptura==1)
                                sescriptura =" checked ";

                            data = JSON.parse(result);
                            idNou=data.id;
                            var files = $('#taulapermisosAfegir tr').length;                            
                            $('#taulapermisosAfegir tr').last().before("<tr><td>"+idNou+"</td><td><input id='lectura_"+idNou+"' type='checkbox'"+ slectura+"></input></td><td><input id='escriptura_"+idNou+"' type='checkbox'"+sescriptura+"></input></td><td>"+camp+"</td><td>"+idorige+"</td><td><div class='glyphicon glyphicon-floppy-disk' style='cursor: pointer;' onclick='guardarPermis("+idNou+")'></div></td></tr>");
                            $("#lectura_Nou").prop('checked', false);
                            $("#escriptura_Nou").prop('checked', false);
                            $('#idorige_Nou').val("");
                            $('#camp_Nou').val("Administrador");
                          }               
                      }
          $.ajax(peticio);
      }
      function esborrarPermis(idPermis){
        $('#taulapermisosAfegir tr').each(function(i,row){
            row = $(row);
            id=$(row).find('td').first().text();
            if (id==idPermis){
              var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=eliminaPermisRol&idpermis='+idPermis,
                          success:function(result){ 
                    
                          }               
                      }
              $.ajax(peticio);            
              row.remove();   
            }
        })
      }

      function callBackModificarPermisos(permisos,nomRol){
      html = "<table id='taulapermisosAfegir' class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["LECTURA"] ?></th><th><?php echo $lang["ESCRIPTURA"] ?></th><th><?php echo $lang["CAMP"] ?></th><th><?php echo $lang["IDORIGE"] ?></th><th><?php echo $lang["ACCIONS"] ?></th></tr></thead>";
      var idrol=0;
      for(var i=0;i<permisos.length;i++){
        var lectura = "";
        var escriptura = "";
        idrol=permisos[i].idrol;
        if (permisos[i].lectura==1)
          lectura = " checked ";
        if(permisos[i].escriptura==1)
          escriptura =" checked ";
        
        html += "<tr><td>"+permisos[i].id+"</td><td><input id='lectura_"+permisos[i].id+"' type='checkbox'"+ lectura+"></input></td><td><input id='escriptura_"+permisos[i].id+"' type='checkbox'"+ escriptura+"></input></td><td>"+permisos[i].camp+"</td><td>"+permisos[i].idorige+"</td><td><div class='glyphicon glyphicon-floppy-disk' style='cursor: pointer;' onclick='guardarPermis("+permisos[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarPermis("+permisos[i].id+")'></div></td></tr>";
      }
      html +="<tr><td>&nbsp;</td><td><input id='lectura_Nou' type='checkbox'></input></td><td><input id='escriptura_Nou' type='checkbox'></input></td><td><select id='camp_Nou'><option value='Administrador'>Administrador</option><option value='questionaris'>questionaris</option><option value='estimuls'>estimuls</option><option value='items'>items</option></select></td><td><input type='text' id='idorige_Nou'></input></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='afegirPermis("+idrol+")'></div></td></tr>";
      html += "</table>";
        BootstrapDialog.show({          
          title:nomRol,
          message:html,
          buttons:[
            {
              label:'Ok',
              action: function(dialog){
                dialog.close();
              }
            }
          ]
          });
      }
      function modificarPermisos(id,nomRol){
        var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=getPermisosRol&id='+id,
                          success:function(result){ 
                              permisos = JSON.parse(result);
                              callBackModificarPermisos(permisos,nomRol);        
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
          title:'<?php echo $lang["INTRODUIXNOUNOM"]?>',
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
        tornar = " <a href='javascript: history.go(-1)'> <?php echo $lang["TORNAR"] ?></a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"] ?></a>";
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"] ?></th><th><?php echo $lang["ACCIONS"] ?></th></tr></thead> ";
        for(var i=0;i<dataRols.length;i++){
         html+= "<tr><td>"+dataRols[i].id + "</td><td>"+dataRols[i].descripcio + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarRol("+dataRols[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-pencil' style='cursor: pointer;' onclick='canviarRol("+dataRols[i].id+")'></div> &nbsp; <div class='glyphicon glyphicon-list-alt' style='cursor: pointer;' onclick='modificarPermisos("+dataRols[i].id+",\""+dataRols[i].descripcio+"\")'></div> </td></tr>";
        }
        html+= "<tr><td></td><td><input id='descripcioNou' type='text'/></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='afegirUsuari()'></div></td></tr>";
        html +="</table>";        
        $(".container").html(tornar+html+tancarSessio);
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
  


<hr/>
<a href='index.php?action=tancarSessio'>Tacar Sessio</a>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
</body>
</html>