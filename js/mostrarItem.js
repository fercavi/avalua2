var idiomaText;
var Opcions;
function mostrarItem(tipus,id,idiomatext){
  if (tipus==1){
    mostrarItemRadioButton(id,idiomatext);
  }
}
function modificaIdiomaRadioButton(idItem,idIdioma){
        var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getOpcioIdioma&id='+idItem+"&idioma="+idIdioma,
    			success:function(result){            
            result = JSON.parse(result);
            opcio = result.OPCIO;            
            BootstrapDialog.show({
              title:idiomaText.opcio,
              message:"<h3>"+idiomaText.opcio+"</h3><div id='contenedorOpcio'></div>",              
              onshown: function(dialogItself){                      
                  $('#contenedorOpcio').html("<textarea id='textAreaOpcions'>"+decodeURIComponent(opcio)+"</textarea>");
                  tinymce.init({selector: "#textAreaOpcions",  entity_encoding : "raw" });               
                },
              onhide: function(){ eliminarEditorMCE();},
              buttons:[
              {
                label:idiomaText.ok,
                action: function(dialogItself){                                            
                      var opcions=tinyMCE.editors[0].getContent({format : 'raw'});                      
                      opcions = encodeURIComponent(opcions);                      
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=guardarIdiomaOpcio&id='+idItem+'&idioma='+idIdioma + "&opcio="+opcions,
                          success:function(result){ 
                              
                          }               
                      }
                      $.ajax(peticio);                      
                      eliminarEditorMCE();
                      dialogItself.close();
                     }
            },
            {
               label:idiomaText.cancelar,
               action: function(dialogItself){eliminarEditorMCE();dialogItself.close(); }
            }
            ]
          });
             
              
            }
    			}    		    			    		
            $.ajax(peticio);
      }
function AfegirOpcioRadioButton(id){
  var descripcio = $('#novaopcio').val();
  var nouordre = $('#nouordre').html();  
  idopcio=-1;
  Opcio = {
    id:idopcio,
    descripcio:descripcio,
    ordre:nouordre,
  }
  Opcions.push(Opcio);
  html = mostraTaulaRadioButtonOpcions(id,Idiomatext);
  $('#contenedorOpcions').html(html);  
}
function canviaNomOpcionsRadioButton(id,nom){
  var trobat = false;
  for(var i=0;(i<Opcions.length)&&!(trobat);i++){
      if(Opcions[i].id==id){
        trobat = true;
        Opcions[i].descripcio=nom;
      }  
  }
}
function modificarOpcioRadioButton(id,descripcio){
        BootstrapDialog.show({
            title:Idiomatext.nom+':',
            message:"<input type='text' value='"+descripcio+"' id='nomOpcioacanviar'></input>",
            buttons:[
            {
              label:'ok',
              action: function(dialogItself){
                      nom = $('#nomOpcioacanviar').val();
                      var peticio = {
                          url:'servidor/OperacionsTaulerControl.php',
                          type:'GET',
                          data:'accio=canviarDescripcioOpcio&id='+id+'&descripcio='+nom,
                          success:function(result){ 
                              
                          }               
                      }
                      s$.ajax(peticio);
                      $('#nomOpcio_'+id).text(nom);
                      canviaNomOpcionsRadioButton(id,nom);
                      dialogItself.close();
                     }
            },
            {
               label:Idiomatext.cancelar,
               action: function(dialogItself){dialogItself.close();}
            }
            ]
          });        
}
function mostraTaulaRadioButtonOpcions(id,idiomatext){
    var ultimordre=0;
    Idiomatext=idiomatext;
    var html = "<table class='table table-hover table-condensed table-striped'><thead><tr><th>id</th><th>"+idiomatext.nom+"</th><th>"+idiomatext.accions+"</th><th>"+idiomatext.ordre+"</th></tr></thead> ";
    for(var i=0;i<Opcions.length;i++){
       html+= "<tr><td>"+Opcions[i].id + "</td><td id='nomOpcio_"+Opcions[i].id+"'>"+Opcions[i].descripcio + "</td><td><div class='glyphicon glyphicon-minus' style='cursor: pointer;' onclick='esborrarOpcio("+Opcions[i].id+")'></div>&nbsp;<div class='glyphicon glyphicon-edit' style='cursor: pointer;' onclick='modificarOpcioRadioButton("+Opcions[i].id+",&apos;"+Opcions[i].descripcio+"&apos;)'></div>";
       for(var j=0;j<idiomes.length;j++){
          html+="&nbsp;<img src='"+idiomes[j].flag+"' onclick='modificaIdiomaRadioButton("+Opcions[i].id+","+idiomes[j].id+")' style='cursor: pointer;' ></img>"
       }
    html +=" </td><td>"+Opcions[i].ordre+"</td></tr>";    
     ultimordre=Opcions[i].ordre;
    }
    ultimordre++;
    html += "<tr><td>&nbsp;</td><td><input id='novaopcio'></input></td><td><div class='glyphicon glyphicon-plus' style='cursor: pointer;' onclick='AfegirOpcioRadioButton("+id+")'></div></td><td id='nouordre'>"+ultimordre+"</td></tr>";
    html +="</table>";
    return html;
}
function mostrarItemRadioButton(id,idiomatext){
 var peticio = {
    			url:'servidor/OperacionsTaulerControl.php',
    			type:'GET',
    			data:'accio=getOpcions&iditem='+id,
    			success:function(result){            
            Opcions=JSON.parse(result);
            html = "<div id='contenedorOpcions'></div>";           
            BootstrapDialog.show({
              title:idiomatext.opcions,
              message:html,                            
              onshown: function(){
                  html = mostraTaulaRadioButtonOpcions(id,idiomatext);
                  $('#contenedorOpcions').html(html);
              },
              buttons:[
              {
                label:idiomatext.ok,
                action: function(dialogItself){                      
                      dialogItself.close();                      
                     }
            }   
            ]
          });
    			}
    		}
        $.ajax(peticio);
}