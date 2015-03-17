<?php 

function error($GET)
	{
	$errors = array('Неправильний логін або пароль','Файл не є картинкою');
	$err=(int)$GET['err'];
	echo $errors[$err-1];
	}

?> 
