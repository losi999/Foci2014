<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Regisztráció</title>
		<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-2" />
	</head>
	<body>
		<div class="wrapper">
		<div class="menu"><ul>
			<li><a href="bejelentkezes.php">Bejelentkezés</a></li>
			<li><a href="regisztracio.php">Regisztráció</a></li>
		</ul></div>
		<div class="main">
			<form  method="post" action="regist.php" accept-charset="iso-8859-2">
	  
			<table border="1">
	  		<tr>
	  			<td><label for="nev">Felhasználónév:</label></td>
	  			<td><input type="text" name="nev" id="nev"/></td>
	  		</tr>
	  		<tr>
	  			<td><label for="jelszo">Jelszó:</label></td>
	  			<td><input type="password" name="jelszo" id="jelszo" /></td>
	  		</tr>
			<tr>
	  			<td><label for="jelszo2">Jelszó ismét:</label></td>
	  			<td><input type="password" name="jelszo2" id="jelszo2" /></td>
	  		</tr>
			</table> 
	      
			<p>  
			<input name="submit" type="submit" value="Regisztráció" />
			</p>
			</form>

		</div>
		</div>
	</body>
</html>

