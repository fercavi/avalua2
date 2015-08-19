<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <script> 
    Questionaris = [
<?php
   
  require_once 'conf.php';
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();
  $user=$_SESSION["USUARI"];		
	$questionaris = $user->getQuestionaris();		
  for($i=0;$i<count($questionaris);$i++){
    $q = $questionaris[$i];
    echo "{id:".$q->getId().",nom:'".$q->getNom()."' },";  
  }
?> 
   ];
      function esborrarQuestionari(id){
        var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=eliminarQuestionari&id='+id,
    			success:function(result){
            var trobat = false;
            for(var i=0;(i<Questionaris.length)&&(!trobat);i++){
              if(Questionaris[i].id==id){                
                trobat = true;
                Questionaris.splice(i,1);                
                carregaTaulaQuestionaris();
              }
            }
    			}
    		}
            $.ajax(peticio);
      }
      function getNomQuestionari(id){
        var nom = "";        
        for(var i=0;(i<Questionaris.length)&&(nom=="");i++){
          if (Questionaris[i].id==id)
            nom=Questionaris[i].nom;
        }
        return nom;
      }
      function modificarQuestionari(id){
      
        nom = getNomQuestionari(id);        
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
                          data:'accio=canviaNomQuestionari&id='+id+'&nom='+nom,
                          success:function(result){ 
                              
                          }               
                      }
                      $.ajax(peticio);
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
      function mostraTaula(questionaris){
        tornar = " <a href='javascript: history.go(-1)'> <?php echo $lang["TORNAR"]?></a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>";        
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<questionaris.length;i++){
         html+= "<tr><td>"+questionaris[i].id + "</td><td>"+questionaris[i].nom + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarQuestionari("+questionaris[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-user' style='cursor: pointer;' onclick='modificarQuestionari("+questionaris[i].id+")'> </td></tr>";
        }
      
         html +="</table>";
        
         $(".container").html(tornar+html+tancarSessio);

      }
      function carregaTaulaQuestionaris(){        
        mostraTaula(Questionaris);
      }
    </script>


</head>
  <body onLoad='carregaTaulaQuestionaris()'>  
  <div class='container' width="60%">
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
 <script src="js/md5.js"></script>
</body>
</html>