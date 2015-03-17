<?php

function logIn($email,$password)
	{
		if(($email == 'admin')&&($password == 'password'))
			{
			setcookie("LoginOK",$_POST["password"]);
			setcookie("login", $_POST["login"]);
			header( 'Location: /index.php?adm=1', true);
			}
		else
			{
			header( 'Location: /index.php?err=1', true);
			}			
	}  
	
	


function logOut ()
	{
	setcookie("LoginOK","", 1);
	setcookie("login","", 1);
	header( "Location: /index.php", true, 307);
	}
	
	
	
	
?>