    <div class="header">
        <div class="logo"><a href="index.php"><img src="images/site/logo.png"></a></div>              
        <div class="login">
			<?php 
			if(empty($_COOKIE['LoginOK']))
				{
			?>
				<form name = "Login" action="index.php" method = "POST" >
					<input class="login-input" type="text" name="login" placeholder="enter username">
					<input class="login-input" type="password" name="password" placeholder="enter password">
					<input class="login-btn" type="submit" value="Вхід на сайт!" formmethod="post">
					<input type="hidden" name="in">
				</form>
				<?php 
				}

			else
				{ 
				?>
				<a class="logout" href="index.php?out">Вийти</a>
				<div class="hello">
				Привіт, <?=$_COOKIE['login'].'!'?>
				</div>    
				<?php 
				} 
				
				?>
        </div>  
        
        <div class="nav">  
			<div class="search">
				<form name = "search" action="/index.php" method = "POST" >
					<input class="search-input" type="text" name="searchData" required placeholder="search">
					<input class="search-btn" type="submit" value="Пошук" formmethod="post">
				</form>
			</div>
			<?php 
				for ($x=0; $x<=count($links) -1; $x++) 
					echo ($x!=0)?'<a href="index.php?id='.$x.'">'.$links[$x].'</a>':'<a href="index.php">'.$links[$x].'</a>';
				//'.((isset($_GET['id']) && $x==$_GET['id'])?'class="active-link"':"").'
				if(!empty($_COOKIE['LoginOK']))
					echo '<a class="menu" href="index.php?adm=1">МЕНЮ</a>';
			?> 
        </div>      
    
    </div>
	
