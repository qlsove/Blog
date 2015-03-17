<!DOCTYPE html>
<html>
   <head>
		<meta charset="utf-8"/>
		<title>Personal Blog</title>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
   </head>
   <body>
		<div class="wrapper">

			<?php 
			//error_reporting(0); 
			include ($_SERVER["DOCUMENT_ROOT"]."/app/model/configs/init.php");
			include ($_SERVER["DOCUMENT_ROOT"]."/app/view/header.php");
			?>

			<div class="content">
				<?php 
				require_once("app/controllers/action.php");        
				?>
			</div>
		
		</div>
	</body>
</html>