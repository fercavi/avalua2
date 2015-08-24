
<?php

 require_once 'conf.php';  
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();
	$user=$_SESSION["USUARI"];
  if(!$user->esAdmin()) die();
  
  
?>
<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <script>  
      var Items=[];
      function esborrarItem(id){
        esborrat = false;
        for(var i=0;(i<Items.length) && (!esborrat);i++){
          if(Items[i].id==id){
            var peticio = {
                url:'servidor/OperacionsTaulerControl.php',
                type:'GET',
                data:'accio=esborrarItem&id='+id,
            }
            $.ajax(peticio);
            Items.splice(i,1);
            mostraTaula();
            esborrat=true;          
          }
        }
      }
      function mostraTaula(){        
        tornar = " <a href='javascript: history.go(-1)'> <?php echo $lang["TORNAR"]?></a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>";        
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<Items.length;i++){
         html+= "<tr><td>"+Items[i].id + "</td><td id='nom_"+Items[i].id+"'>"+Items[i].descripcio + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarItem("+Items[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-user' style='cursor: pointer;' onclick='modificarItem("+Items[i].id+")'> </td></tr>";
        }
      
         html +="</table>";
        
         $(".container").html(tornar+html+tancarSessio);

      }
      function carregaTaulaItems(callback){     
       var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getItems',
    			success:function(result){            
            Items=JSON.parse(result);
    				if (callback)
    					callback();
    			}
    		}
            $.ajax(peticio);
        
      }
         function getNomItem(id){
        var nom = "";        
        for(var i=0;(i<Items.length)&&(nom=="");i++){
          if (Items[i].id==id)
            nom=Items[i].descripcio;
        }
        return nom;
      }
      function canviaNom(id,nom){
        trobat = false;
        for(var i=0;(i<Items.length) && (!trobat);i++){
            if(Items[i].id==id){
              Items[i].descripcio=nom;
              trobat = true;
            }            
        }
      }
      function modificarItem(id){
        nom = getNomItem(id);
        html = "<input id='nouNom' type='text' value='"+nom+"'></input>";
        BootstrapDialog.show({
            title:'<?php echo $lang["NOM"]?>:',
            message:html,
            buttons:[
            {
              label:'ok',
              action: function(dialogItself){
                      nom = $('#nouNom').val();
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=canviaNomItem&id='+id+'&nom='+nom,
                          success:function(result){ 
                              
                          }               
                      }
                      $.ajax(peticio);
                      $('#nom_'+id).text(nom);
                      canviaNom(id,nom);
                      dialogItself.close();
                     }
            },
            {
               label:'<?php echo $lang["CANCELAR"]?>',
               action: function(dialogItself){dialogItself.close();}
            }
            ]
          });        
        
      }
    </script>
</head>
  <body onload='carregaTaulaItems(mostraTaula)'>  
  <div class='container' width="60%">

</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
 <script src="js/md5.js"></script>
</body>
</html>