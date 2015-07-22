<?php

class LoginLDAP extends Login{
	public function doLogin($user,$pass){

	}	
}
class LoginDBA extends Login {
	public function doLogin($user,$pass){

	}
}

abstract class Login{
	const LoginDBAType =0;
	const LoginLDAPType =1;
	abstract function doLogin($user,$pass);
	

}


?>