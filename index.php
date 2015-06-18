<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script>
    	function doAnterior(){
			window.location='?action=anterior';
    	}
    	function anterior(){
    		guardarResultats(doAnterior);   		
    	}
    	function doSeguent(){
			window.location='?action=seguent';
    	}
    	function seguent(){
    		guardarResultats(doSeguent);			
    	}
    	function guardarResultats(callback){
    		var Respostes = [];
    		$('form ').each(function(){
    			Resposta = [];    	    			
    			$('#'+$(this).attr('id') +" input[type='radio']:checked").each(
    			 function() {
    				Resposta.push($(this).attr('resposta'));
    			});
    			Respostes.push(Resposta);
    			//Respostes.push($('#'+$(this).attr('id') +" input[type='radio']:checked").attr('id'));
    			});    		
			var peticio = {
    			url:'servidor/OperacionsQuestionari.php',
    			type:'GET',
    			data:'accio=guardarRespostes&respostes='+JSON.stringify(Respostes),
    			success:function(result){    				
    				callback();
    			}
    		}
            $.ajax(peticio);
    	}
    </script>
</head>
  <body>
  <div class='container'>
<?php
require_once 'conf.php';
require_once 'class/fake_servidor.php';

$Questionari = getQuestionari();
if(isset($_GET["action"])){
	$action = $_GET["action"];
	if($action=="seguent"){
		$Questionari->seguent();
	}
	if ($action=="anterior"){
		$Questionari->anterior();	
	}
	if($action=="tancarSessio"){
		session_destroy( );
		$Questionari = getQuestionari();
	}
}

echo $Questionari->generateHTML();

?>
<a href='?action=tancarSessio'>Tacar Sessio</a>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
</body>
</html>