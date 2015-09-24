
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
      var Estimuls=[];
      var assignacioItems=[];
      var idiomes = <?php echo $idiomes ?>;
      var idioma = <?php echo $user->getIdioma(); ?>;
      var Items = [];
      function eliminarEditorMCE(){
        tinymce.editors=[];
      }      
      function buscaItem(idEstimul){
        var filtre =$('#filtreEstimul').val();
        var itemsFiltrats = [];        
        if (filtre=="")
          itemsFiltrats=Items;
        else{
          for(var i=0;i<Items.length;i++){
            if(Items[i].descripcio.search(filtre)!=-1){
              itemsFiltrats.push(Items[i]);
            }
          }
        }
        html=creaTaulaBuscadorItems(idEstimul,itemsFiltrats);        
        $('#contenedorBuscador').html(html);
      }
      function afegirItemBuscador(idEstimulInstancia,id,descripcio){
        var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=afegirAssignacioEstimulItem&idestimul='+idEstimul+"&idItem="+id,
                          success:function(result){ 
                            var Nid = JSON.parse(result).ID;
                            var AI = {
                              id:Nid,
                              iditem:id,
                              item_descripcio:descripcio,
                            }
                            assignacioEstimuls.push(AI);
                            html=crearTaulaAssignacio(idEstimul,assignacioItems);
                            $('#contenedorAssignacio').html(html);                            
                          } 
                      }
        $.ajax(peticio);        
      }
      function creaTaulaBuscadorItems(idEstimulInstancia,items){
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th><?php echo $lang["IDITEM"]?></th><th><?php echo $lang["DESCRIPCIOITEM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<items.length;i++){
          html+="<tr><td>"+items[i].id+"</td><td>"+items[i].descripcio+"</td><td><div class='glyphicon glyphicon-ok-circle' style='cursor: pointer;' onClick='afegirItemBuscador("+idEstimulInstancia+","+items[i].id+",&apos;"+items[i].descripcio+"&apos;)'></div>&nbsp; <div class='glyphicon glyphicon-eye-open'style='cursor: pointer;' onClick='veureItem("+items[i].id+")'></div></td></tr>";
        }
        html += "<tr><td colspan=2></td><td><div class='input-group'> <input id='filtreEstimul' type='text' class='form-control'></input><span class='input-group-addon'><div class='glyphicon glyphicon glyphicon-search' onClick='buscaItem("+idEstimul+")' style='cursor: pointer;' ></div></div></td></tr>";
        html +="</table>";
        return html;
      }
       function buscarItems(idEstimulInstancia){          
          var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=getItems',
                          success:function(result){ 
                                Items = JSON.parse(result);
                                html = "<div id='contenedorBuscador'>"+creaTaulaBuscadorItems(idEstimulInstancia,Items)+"</div>";
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
      function veureItem(idItem){
        var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getHtmlItem&id='+idItem+"&idioma="+idioma,
    			success:function(result){
           html = JSON.parse(result);
           BootstrapDialog.show({
            title:'',
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
      function esborrarAssignacio(idEstimul,index){
        idAEsborrar=assignacioItems[index].id;
        alert(idAEsborrar);
      }
      function crearTaulaAssignacio(idEstimul,assignacioItems){
         var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["IDITEM"]?></th><th><?php echo $lang["DESCRIPCIOITEM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
         for(var i=0;i<assignacioItems.length;i++){
                html +="<tr><td>"+assignacioItems[i].id+"</td><td>"+assignacioItems[i].iditem+"</td><td>"+assignacioItems[i].item_descripcio+"</td>";
                html +="<td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarAssignacio("+idEstimul+","+i+")'></div>&nbsp;<div class='glyphicon glyphicon-eye-open'style='cursor: pointer;' onClick='veureItem("+assignacioItems[i].iditem+")' ></div></td>";
                html +="</tr>";
         }
         html += "<tr><td colspan=3></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onClick='buscarItems("+idEstimul+")'></div></td></tr>"
         html +="</table>";
         return html;        
      }
      function afegirEstimul(){
        var nom=$('#NomNou').val();
        var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=afegirEstimul&nom='+nom,
    			success:function(result){
            result = JSON.parse(result);
            id = result.ID;
            E = {
              id: id,
              descripcio:nom,
            }            
            Estimuls.push(E);
            mostraTaula();
          }
        }
        $.ajax(peticio);
      }
      function esborrarEstimul(id){
        esborrat = false;
        for(var i=0;(i<Estimuls.length) && (!esborrat);i++){
          if(Estimuls[i].id==id){
            var peticio = {
                url:'servidor/OperacionsTaulerControl.php',
                type:'GET',
                data:'accio=esborrarEstimul&id='+id,
            }
            $.ajax(peticio);
            Estimuls.splice(i,1);
            mostraTaula();
            esborrat=true;          
          }
        }
      }      
      function modificaIdioma(idEstimul,idIdioma){                  
          var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getDadesEstimul&id='+idEstimul+"&idioma="+idIdioma,
    			success:function(result){
            result = JSON.parse(result);
            enunciat = result.ENUNCIAT;
            titol = result.TITOL;
            BootstrapDialog.show({
              title:'<?php echo $lang["ESTIMUL"]?>',
              message:"<h3><?php echo $lang["TITOL"]?></h3><div id='contenedorTitol'></div><h3><?php echo $lang["ENUNCIAT"]?></h3><div id='contenedorEnunciat'></div>",              
              onshown: function(dialogItself){    
                  $('#contenedorTitol').html("<textarea id='textAreaTitol'>"+decodeURIComponent(titol)+"</textarea>");
                  $('#contenedorEnunciat').html("<textarea id='textAreaEnunciat'>"+decodeURIComponent(enunciat)+"</textarea>");
                  tinymce.init({selector: "#textAreaTitol",  entity_encoding : "numeric" }); 
                  tinymce.init({selector: "#textAreaEnunciat",  entity_encoding : "numeric", });                          
                },
              buttons:[
              {
                label:'ok',
                action: function(dialogItself){                      
                      var titol=tinyMCE.editors[0].getContent({format : 'raw'});
                      var enunciat=tinyMCE.editors[1].getContent({format : 'raw'});
                      titol = encodeURIComponent(titol);                      
                      enunciat = encodeURIComponent(enunciat);                      
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=guardarDadesEstimul&id='+idEstimul+'&idioma='+idIdioma + "&titol="+titol+'&enunciat='+enunciat,
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
      function gestionaItems(idEstimul, nom){        
         var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getItemsEstimul&id='+idEstimul,
    			success:function(result){            
            assignacioItems = JSON.parse(result);            
            html = "<div id='contenedorAssignacio'>"+crearTaulaAssignacio(idEstimul,assignacioItems)+"</div>";
            BootstrapDialog.show({
            title:nom,
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
      function mostraTaula(){        
        tornar = " <a href='javascript: history.go(-1)'> <?php echo $lang["TORNAR"]?></a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'><?php echo $lang["TANCARSESSIO"]?></a>";        
        var html =  "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th><?php echo $lang["NOM"]?></th><th><?php echo $lang["ACCIONS"]?></th></tr></thead> ";
        for(var i=0;i<Estimuls.length;i++){
          html+= "<tr><td>"+Estimuls[i].id + "</td><td id='nom_"+Estimuls[i].id+"'>"+Estimuls[i].descripcio + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarEstimul("+Estimuls[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-user' style='cursor: pointer;' onclick='modificarEstimul("+Estimuls[i].id+")'></div> ";
          for(var j=0;j<idiomes.length;j++){
            html+="&nbsp;<img src='"+idiomes[j].flag+"' onclick='modificaIdioma("+Estimuls[i].id+","+idiomes[j].id+")' style='cursor: pointer;' ></img>"
          }  
         html +="&nbsp;<div class='glyphicon glyphicon-list' onclick='gestionaItems("+Estimuls[i].id+",&apos;"+Estimuls[i].descripcio+"&apos;)' style='cursor: pointer;'></div>";
         html+="</td></tr>";
        }
          
        html +="<tr><td>&nbsp;</td><td><input type='text' id='NomNou'></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='afegirEstimul()'></div></td></tr>"
        html +="</table>";
        
         $(".container").html(tornar+html+tancarSessio);

      }
      function carregaTaulaEstimuls(callback){     
       var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getEstimuls',
    			success:function(result){            
            Estimuls=JSON.parse(result);
    				if (callback)
    					callback();
    			}
    		}
            $.ajax(peticio);
        
      }
       function getNomEstimul(id){
        var nom = "";        
        for(var i=0;(i<Estimuls.length)&&(nom=="");i++){
          if (Estimuls[i].id==id)
            nom=Estimuls[i].descripcio;
        }
        return nom;
      }
      function canviaNom(id,nom){
        trobat = false;
        for(var i=0;(i<Estimuls.length) && (!trobat);i++){
            if(Estimuls[i].id==id){
              Estimuls[i].descripcio=nom;
              trobat = true;
            }            
        }
      }
      function modificarEstimul(id){
        nom = getNomEstimul(id);
        html = "<input id='nouNom' type='text' value='"+nom+"'></input>";
        BootstrapDialog.show({
            title:'<?php echo $lang["NOM"]?>:',
            message:html,
            buttons:[
            {
              label:'ok',
              action: function(dialogItself){
                      nom = $('#NouNom').val();
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=canviaNomEstimul&id='+id+'&nom='+nom,
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
  <body onload='carregaTaulaEstimuls(mostraTaula)'>  
  <div class='container' width="60%">

</div>
<script src="js/jquery.min.js"></script>    
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-dialog.js"></script>
 <script src="js/md5.js"></script>
</body>
</html>