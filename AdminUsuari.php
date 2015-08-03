<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <script>   
      function mostraUsuaris(data){         
        usuaris = JSON.parse(data);
        var html =  "<ol>";
        for(var i=0;i<usuaris.length;i++){
         html+= "<li>uid:"+usuaris[i].uid + ";nom:"+usuaris[i].nom + ";login:"+usuaris[i].login+"</li>";
        }
        html +="</ol>";        
        $(".container").html(html+$(".container").html());
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
  <div class='container'>
<?php


?>


<a href='index.php?action=tancarSessio'>Tacar Sessio</a>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
</body>
</html>