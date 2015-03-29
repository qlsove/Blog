<?php


	switch (true) 
	{
		case (isset($_POST['in'])):
		logIn ($_POST["login"], $_POST["password"]);
		break;

		case (isset($_GET['out'])):
		logOut ();
		break;

		case (isset($_GET['err'])):
		error ($_GET);
		break;

		case (isset($_GET['adm']) && !empty($_COOKIE['LoginOK'])):
		admin ($_GET, $categories, $links, $target_dir);
		break;
	
		case (isset($_GET['delId']) && !empty($_COOKIE['LoginOK'])):
		deletePost ($_GET);
		break;

		case (isset($_GET['delImg']) && !empty($_COOKIE['LoginOK'])):
		deleteImg ($_GET);
		break;

		case (!empty($_COOKIE['userLoginOK']) && (isset($_GET['chgId']) || isset($_POST['chgId']))):
		changePost ($_POST, $_GET, $_FILES, $categories, $links);
		break;

		case (isset($_POST['insId']) && !empty($_COOKIE['LoginOK'])):
		insertPost ($_POST, $_GET, $_FILES);
		break;

		case (isset($_GET['id']) || isset($_GET['tag']) || isset($_POST['searchData'])):
		viewPost ($_POST, $_GET, $categories, $links, $target_dir); 
		break;

		default:
		viewPost ($_POST, $_GET, $categories, $links, $target_dir); 		
		break;
	}







	
?> 
