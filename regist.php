<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="print.css" media="print" />
		<title>Regisztr�ci�</title>

<?php

include ("install.php");

if($_POST["nev"]=="") {
	echo'
		<meta http-equiv="Refresh" content="3;url=regisztracio.php" />
		</head>

		<body>
		<div class="wrapper">
		<div class="menu"><ul>
			<li><a href="bejelentkezes.php">Bejelentkez�s</a></li>
			<li><a href="regisztracio.php">Regisztr�ci�</a></li>
		</ul></div>';
	echo "<div class=\"main\">Hi�nyzik a felhaszn�l�n�v!<br />";
	echo 'Kattints <a href="regisztracio.php">ide</a>, ha nem ir�ny�t automatikusan vissza!</div>';
	echo '</div>';
}
else {
	if($_POST["jelszo"]=="" || $_POST["jelszo2"]=="") {
		echo'
		<meta http-equiv="Refresh" content="3;url=regisztracio.php" />
		</head>

		<body>
		<div class="wrapper">
		<div class="menu"><ul>
			<li><a href="bejelentkezes.php">Bejelentkez�s</a></li>
			<li><a href="regisztracio.php">Regisztr�ci�</a></li>
		</ul></div>';
		echo "<div class=\"main\">Hi�nyzik a jelsz�!<br />";
		echo 'Kattints <a href="regisztracio.php">ide</a>, ha nem ir�ny�t automatikusan vissza!</div>';
		echo '</div>';
	}
	else {
		$sql="select count(*) from felhasznalo where nev='".$_POST["nev"]."'";
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		if($row[0]!=0) {
			echo'
			<meta http-equiv="Refresh" content="3;url=regisztracio.php" />
			</head>
				<body>
				<div class="wrapper">
				<div class="menu"><ul>
				<li><a href="bejelentkezes.php">Bejelentkez�s</a></li>
				<li><a href="regisztracio.php">Regisztr�ci�</a></li>
			</ul></div>';
			echo "<div class=\"main\">Foglalt felhaszn�l�n�v!<br />";
			echo 'Kattints <a href="regisztracio.php">ide</a>, ha nem ir�ny�t automatikusan vissza!</div>';
			echo '</div>';
		}
			else {
				if($_POST["jelszo"]!=$_POST["jelszo2"]) {
					echo'
					<meta http-equiv="Refresh" content="3;url=regisztracio.php" />
					</head>

					<body>
					<div class="wrapper">
					<div class="menu"><ul>
						<li><a href="bejelentkezes.php">Bejelentkez�s</a></li>
						<li><a href="regisztracio.php">Regisztr�ci�</a></li>
					</ul></div>';
				echo "<div class=\"main\">Nem egyeznek a jelszavak!<br />";
				echo 'Kattints <a href="regisztracio.php">ide</a>, ha nem ir�ny�t automatikusan vissza!</div>';
				echo '</div>';
				}
				else {
					$sql="insert into felhasznalo (nev, jelszo) values ( '".$_POST["nev"]."', '".md5($_POST["jelszo"])."');";
					
					mysql_query($sql);
					echo'
					<meta http-equiv="Refresh" content="3;url=bejelentkezes.php" />
					</head>

					<body>
					<div class="wrapper">
					<div class="menu"><ul>
						<li><a href="bejelentkezes.php">Bejelentkez�s</a></li>
						<li><a href="regisztracio.php">Regisztr�ci�</a></li>
					</ul></div>';
				echo "<div class=\"main\">Sikeres regisztr�ci�!<br />";
				echo 'Kattints <a href="bejelentkezes.php">ide</a>, ha nem ir�ny�t automatikusan tov�bb!</div>';
				echo '</div>';
				}
			}
		}
	}

?>
	</body>

</html>