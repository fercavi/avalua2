<?php
if(isset($_GET["action"])){
    $action = $_GET["action"];
     if($action=="tancarSessio"){
        session_start();        
        session_destroy( );           
    }
 }
?>
<!DOCTYPE html>
<html lang="ca">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .form-signin {
          max-width: 330px;
          padding: 15px;
          margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
          margin-bottom: 10px;
        }
        .form-signin .checkbox {
          font-weight: normal;
        }
        .form-signin .form-control {
          position: relative;
          height: auto;
          -webkit-box-sizing: border-box;
             -moz-box-sizing: border-box;
                  box-sizing: border-box;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    </style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script>    	
    	function doLogin(){
            usuari = $('#inputUser').val();            
            pass=$('#inputPassword').val();
    		var peticio = {
    			url:'servidor/login.php',
    			type:'GET',
    			data:'accio=login&usuari='+usuari+'&pass='+pass,
    			success:function(result){ 
                    data = JSON.parse(result);
                    if(data.Error==0)
    				    window.location='menu.php'
                    else{
                        alert('invalid login');
                    }
    			}
    		}
            $.ajax(peticio);
    	}
    </script>
</head>
  <body>
  <div class='container'>
<form class="form-signin">
        <h2 class="form-signin-heading">Login</h2>
        <label for="inputUser" class="sr-only">Usuari:</label>
        <input id="inputUser" class="form-control" placeholder="Usuari" required="" autofocus="" type="text">
        <label for="inputPassword" class="sr-only">Contrasenya</label>
        <input id="inputPassword" class="form-control" placeholder="Contrasenya" required="" type="password">
        <!--div class="checkbox">
          label>
            <input value="remember-me" type="checkbox"> Remember me
          </label>
        </div-->
        <button class="btn btn-lg btn-primary btn-block" type="button" onClick='doLogin()'>Entrar</button>
      </form>
</div>
<script src="js/jquery.min.js"></script>    
 <script src="js/bootstrap.min.js"></script>
</body>
</html>