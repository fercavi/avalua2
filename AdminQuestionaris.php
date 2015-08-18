<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">   
    <script> 
      var Questionaris = [];
      function mostraTaula(questionaris){
        tornar = " <a href='javascript: history.go(-1)'> Tornar</a>";
        tancarSessio = "<a href='index.php?action=tancarSessio'>Tacar Sessio</a>";
        
        
        
         $(".container").html(tornar+html+tancarSessio);

      }
      function carregaTaulaQuestionaris(){
        Questionaris = [
           {
             id:0,
             nom:'Questionari 1'
           },
           {
            id:1,
            nom:'Questionaris 2'
           }
        ]  
        mostraTaula(Questionaris);
      }
    </script>
<?php



?>

</head>
  <body>  
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