<?php 
  session_start();   
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>VB tippj�t�k</title>
		<?php
			unset($_SESSION['nev']);
		?>
		<meta http-equiv="Refresh" content="3; url=bejelentkezes.php" />
	</head>

	<body>
		<div class="wrapper">
			<div class="menu"><ul>
				<li><a href="bejelentkezes.php">Bejelentkez�s</a></li>
				<li><a href="regisztracio.php">Regisztr�ci�</a></li>
			</ul></div>
			<div class="main">
				Sikeres kijelentkez�s!
			</div>

		</div>		
	</body>

</html>
<?php 
  session_destroy();   
?>
