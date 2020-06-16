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
<script>	
function slideToggle(i) {
	$("#"+i).slideToggle("slow", function() {});
}
</script
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
			<?php
				$res=mysql_query("SELECT * FROM merkozes");
				while($row=mysql_fetch_array($res)) {
					echo'<div class="meccs" onClick="slideToggle(\'tipp_'.$row["merkozes_id"].'\');">
							'.$row["hazai_csapat"].' - '.$row["vendeg_csapat"].'
						</div>';
					$sql2="SELECT COUNT(*) AS db FROM tipp WHERE felhasznalonev='".$_SESSION["nev"]."' AND merkozes_id=".$row['merkozes_id'];
					//echo $sql2;
					$res2=mysql_query($sql2);
					$row2=mysql_fetch_array($res2);
					if($row2["db"]==0) {
						echo'<div id="tipp_'.$row["merkozes_id"].'" class="tippek">Nem láthatod a tippeket, amíg nem tippeltél</div>';
					}
					else {
						echo'
						<div id="tipp_'.$row["merkozes_id"].'" class="tippek">
							<table>';
							$res3=mysql_query("SELECT * FROM felhasznalo WHERE admin=0");
							while($row3=mysql_fetch_array($res3)) {
								echo '<tr><td>'.$row3["nev"].'</td>';
								$sql4="SELECT * FROM tipp WHERE felhasznalonev='".$row3["nev"]."' AND merkozes_id=".$row['merkozes_id'];
								$res4=mysql_query($sql4);
								$row4=mysql_fetch_array($res4);
								if($row4["hazai"]=="") {
									echo '<td>Nincs tipp!</td></tr>';
								}
								else {
									echo '<td>'.$row4["hazai"].'-'.$row4["vendeg"].'</td></tr>';
								}
							}
						
						echo'</table></div>';
					}
				}
			?>
		</div>	
		</div>

</body>
</html>
