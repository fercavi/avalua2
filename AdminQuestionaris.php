<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <script> 
    
<?php   
  require_once 'conf.php';
	session_start();	
	if (!isset($_SESSION["USUARI"])) die();  
  $user=$_SESSION["USUARI"];		
  if(!$user->esAdmin()) die();
?>    
     var idiomes = <?php echo $idiomes ?>; 
     var assignacioEstimuls=[];
     var Estimuls;
     function eliminarEditorMCE(){
        tinymce.editors=[];
     }
      function afegirQuestionari(){
        var nom=$('#NomNou').val();
        var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=afegirQuestionari&nom='+nom,
    			success:function(result){
            result = JSON.parse(result);
            id = result.ID;
            q = {
              id: id,
              nom:nom,
            }            
            Questionaris.push(q);
            mostraTaula(Questionaris);
          }
        }
        $.ajax(peticio);
      }
      function modificaIdioma(idQuestionari,idIdioma){
          var camp='nom';
          var taula='questionaris';          
          var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getCadena&id='+idQuestionari+"&taula=questionaris&camp=nom&idioma="+idIdioma,
    			success:function(result){
            result = JSON.parse(result);
            BootstrapDialog.show({
              title:'<?php echo $lang["ENUNCIAT"]?>',
              message:"<div id='contenedorEnunciat'><div>",
              onshown: function(dialogItself){    
                  $('#contenedorEnunciat').html("<textarea id='textAreaEnunciat'>"+decodeURIComponent(result)+"</textarea>");
                  tinymce.init({selector: "#textAreaEnunciat" });        
                },
              buttons:[
              {
                label:'ok',
                action: function(dialogItself){                      
                      var text=tinyMCE.activeEditor.getContent({format : 'raw'});
                      text = encodeURIComponent(text);                      
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=setCadena&taula=questionaris&camp=nom&id='+idQuestionari+'&idioma='+idIdioma + "&text="+text,
                          success:function(result){ 
                              
                          }               
                      }
                      $.ajax(peticio);
                      eliminarEditorMCE();
                      dialogItself.close();
                     }
            },
            {
               label:'<?php echo $lang["CANCELAR"]?>',
               action: function(dialogItself){eliminarEditorMCE();dialogItself.close(); }
            }
            ]
          }); 
            }
    			}    		    			    		
            $.ajax(peticio);
      }
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
      function buscaEstimul(){
        var filtre =$('#filtreEstimul').val();
        var estimulsFiltrats = [];        
        if (filtre=="")
          estimulsFiltrats=Estimuls;
        else{
          for(var i=0;i<Estimuls.length;i++){
            if(Estimuls[i].descripcio.search(filtre)!=-1){
              estimulsFiltrats.push(Estimuls[i]);
            }
          }
        }
        html=creaTaulaBuscadorEstimuls(estimulsFiltrats);        
        $('#contenedorBuscador').html(html);
        
      }
      function afegirEstimulBuscador(idquestionari,id,descripcio){
        var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=afegirAssignacioQuestionariEstimul&idquestionari='+idquestionari+"&idestimul="+id,
                          success:function(result){ 
                            var Nid = JSON.parse(result).ID;
                            var AE = {
                              id:Nid,
                              idestimul:id,
                              estimul_descripcio:descripcio,
                            }
                            assignacioEstimuls.push(AE);
                            html=crearTaulaAssignacio(idquestionari,assignacioEstimuls);
                            $('#contenedorAssignacio').html(html);                            
                          } 
                      }
        $.ajax(peticio);        
      }
      function creaTaulaBuscadorEstimuls(idQuestionari,estimuls){
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th><?php echo $lang["IDESTIMUL"]?></th><th><?php echo $lang["DESCRIPCIOESTIMUL"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<estimuls.length;i++){
          html+="<tr><td>"+estimuls[i].id+"</td><td>"+estimuls[i].descripcio+"</td><td><div class='glyphicon glyphicon-ok-circle' style='cursor: pointer;' onClick='afegirEstimulBuscador("+idQuestionari+","+estimuls[i].id+",&apos;"+estimuls[i].descripcio+"&apos;)'></div></td></tr>";
        }
        html += "<tr><td colspan=2></td><td><div class='input-group'> <input id='filtreEstimul' type='text' class='form-control'></input><span class='input-group-addon'><div class='glyphicon glyphicon glyphicon-search' onClick='buscaEstimul()' style='cursor: pointer;' ></div></div></td></tr>";
        html +="</table>";
        return html;
      }
      function buscarEstimul(idQuestionari){          
          var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=getEstimuls',
                          success:function(result){ 
                                Estimuls=JSON.parse(result);
                                html = "<div id='contenedorBuscador'>"+creaTaulaBuscadorEstimuls(idQuestionari,Estimuls)+"</div>";
                                BootstrapDialog.show({
                                    title:'<?php echo $lang["BUSCADOR"]?>',
                                    message:html,
                                    buttons:[
                                      {
                                        label:'ok',
                                        action: function(dialogItself){                      
                                        dialogItself.close();
                                      }
                                    }]
                                    });
                          }               
                      }
                      $.ajax(peticio);
      }
      function crearTaulaAssignacio(idQuestionari,assignacioEstimuls){
         var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["IDESTIMUL"]?></th><th><?php echo $lang["DESCRIPCIOESTIMUL"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
         for(var i=0;i<assignacioEstimuls.length;i++){
                html +="<tr><td>"+assignacioEstimuls[i].id+"</td><td>"+assignacioEstimuls[i].idestimul+"</td><td>"+assignacioEstimuls[i].estimul_descripcio+"</td>";
                html +="<td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarAssignacio("+idQuestionari+","+i+")'></div></td>";
                html +="</tr>";
         }
         html += "<tr><td colspan=3></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onClick='buscarEstimul("+idQuestionari+")'></div></td></tr>"
         html +="</table>";
         return html;        
      }
      function esborrarAssignacio(idquestionari,index){        
         var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=esborrarAssignacioQuestionariEstimul&id='+assignacioEstimuls[index].id,
    			success:function(result){              
              html="<div id='contenedorAssignacio'>"+crearTaulaAssignacio(idquestionari,assignacioEstimuls)+"</div>";
              assignacioEstimuls.splice(index,1);
              html = crearTaulaAssignacio(idquestionari,assignacioEstimuls);
              $('#contenedorAssignacio').html(html);
            }
    			}
          $.ajax(peticio);
      }
      function gestionaEstimuls(idQuestionari,nomQuestionari){         
         var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getEstimulsQuestionaris&id='+idQuestionari,
    			success:function(result){              
              assignacioEstimuls= JSON.parse(result);
              html="<div id='contenedorAssignacio'>"+crearTaulaAssignacio(idQuestionari,assignacioEstimuls)+"</div>";
              BootstrapDialog.show({
            title:nomQuestionari,
            message:html,
            buttons:[
            {
              label:'ok',
              action: function(dialogItself){                      
                      dialogItself.close();
                     }
            }]
              });
            }
    			}
          $.ajax(peticio);
    		}
         
      
      
      function mostraTaula(questionaris){
        tornar = " <a href='javascript: history.go(-1)'> <?php echo $lang["TORNAR"]?></a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>";        
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<questionaris.length;i++){
         html+= "<tr><td>"+questionaris[i].id + "</td><td>"+questionaris[i].nom + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarQuestionari("+questionaris[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-user' style='cursor: pointer;' onclick='modificarQuestionari("+questionaris[i].id+")'></div>";         
          for(var j=0;j<idiomes.length;j++){
            html+="&nbsp;<img src='"+idiomes[j].flag+"' onclick='modificaIdioma("+questionaris[i].id+","+idiomes[j].id+")' style='cursor: pointer;' ></img>"
          }
          html +="&nbsp;<div class='glyphicon glyphicon-list' onclick='gestionaEstimuls("+questionaris[i].id+",&apos;"+questionaris[i].nom+"&apos;)' style='cursor: pointer;'></div>";
         html +="</td></tr>";         
          }
          html +="<tr><td>&nbsp;</td><td><input type='text' id='NomNou'></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='afegirQuestionari()'></div></td></tr>"         
         html +="</table>";
        
         $(".container").html(tornar+html+tancarSessio);

      }
      function carregaTaulaQuestionaris(){   
       var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=getQuestionaris&userLogin=<?php echo $user->getLogin() ?>',
                          success:function(result){ 
                            Questionaris=JSON.parse(result);
                            mostraTaula(Questionaris);
                          }               
                      }
                      $.ajax(peticio);        
      }
    </script>


</head>
  <body onLoad='carregaTaulaQuestionaris()'>  
  <div class='container' width="60%">
</div>
<script src="js/jquery.min.js"></script>    
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
 <script src='js/jquery.base64.js'></script>
 <script src="js/md5.js"></script>
</body>
</html>