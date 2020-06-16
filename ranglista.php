<?php 
  session_start();   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Viewport" content="width=device-width, user-scalable=no" />
<script src="jquery-1.11.0.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>VB tippjáték</title>
</head>
<body>
		<div class="wrapper">
			<div class="menu">
			<ul>
				<li><a href="merkozesek.php">Tippelés</a></li>
				<li><a href="ranglista.php">Ranglista</a></li>
				<li><a href="tippek.php">Mérkőzések</a></li>
			</ul>
			</div>
			<?php
				echo '<div class="loggedin">Üdv, '.$_SESSION["nev"].'!</br><a href="kijelentkezes.php">Kijelentkezés</a></div>';
				
				include("install.php");
				header("Content-type: text/html; charset=utf-8");
				
				mysql_query("SET NAMES UTF8");
				mysql_query("set character set UTF8");
				mysql_query("set collation_connection='utf8_unicode_ci'");
			?>
		<div class="main">
			<form action="" id='myform'>
			<table>
				<tr>
					<th class="col1">Név</th>
					<th class="col2">Pontszám</th>
				</tr>
				<?php
				$sql="SELECT felhasznalonev, sum(pont) AS pt FROM tipp GROUP BY felhasznalonev ORDER BY pt DESC";
				$res=mysql_query($sql);
				while($row=mysql_fetch_array($res)) {
					echo '<tr><td>'.$row['felhasznalonev'].'</td>';
					echo '<td>'.$row['pt'].' pont</td></tr>';
				}
				?>
				<tr id="mentes">
				<td colspan="3">
					<input name="submit" type="submit" value="Mentés" />
				</td>
				</tr>
			</table>
			</form>
		</div>	
		</div>

</body>
</html>
