<?php
session_start();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Bejelentkezés</title>
        <?php
        include ("install.php");

        if ($_GET["nev"] == "") {
            echo
            '<meta http-equiv="Refresh" content="3;url=bejelentkezes.php" />
		</head>

		<body>
		<div class="wrapper">
		<div class="menu"><ul>
			<li><a href="bejelentkezes.php">Bejelentkezés</a></li>
			<li><a href="regisztracio.php">Regisztráció</a></li>
		</ul></div>';
            echo "<div class=\"main\">Hiányzik a felhasználónév!<br />";
            echo 'Kattints <a href="bejelentkezes.php">ide</a>, ha nem irányít automatikusan vissza!</div>';
            echo '</div>';
        } else {
            if ($_GET["jelszo"] == "") {
                echo'
		<meta http-equiv="Refresh" content="3;url=bejelentkezes.php" />
		</head>

		<body> 
		<div class="wrapper">
		<div class="menu"><ul>
			<li><a href="bejelentkezes.php">Bejelentkezés</a></li>
			<li><a href="regisztracio.php">Regisztráció</a></li>
		</ul></div>';
                echo "<div class=\"main\">Hiányzik a jelszó!<br />";
                echo 'Kattints <a href="bejelentkezes.php">ide</a>, ha nem irányít automatikusan vissza!</div>';
                echo '</div>';
            } else {
                $sql = "SELECT * FROM felhasznalo WHERE nev='" . $_GET["nev"] . "'";
                $res = mysql_query($sql);
                $row = mysql_fetch_array($res);
                if (md5($_GET["jelszo"]) == $row["jelszo"]) {
                    $_SESSION['nev'] = $_GET['nev'];
                    if ($row["admin"] == 1) {
                        $_SESSION['admin'] = 1;
                        echo '<meta http-equiv="Refresh" content="3;url=admin.php" />'; 
                    } else {
                        $_SESSION['admin'] = 0;
                        echo '<meta http-equiv="Refresh" content="3;url=merkozesek.php" />';
                    }
                    echo '</head>

			<body>
			<div class="wrapper">
			<div class="menu"><ul>';
                    if ($row["admin"] == 1) {
                        echo '<li><a href="admin.php">Admin</a></li>';
                    } else {
                        echo '<li><a href="merkozesek.php">Tippelés</a></li>
				<li><a href="ranglista.php">Ranglista</a></li>
				<li><a href="tippek.php">Mérkőzések</a></li>';
                    }
                    echo '</ul></div>';
                    echo "<div class=\"main\"><div id=\"bejelentkezett\">Üdv, " . $_SESSION['nev'] . "!</div>";
                    echo "Sikeres bejelentkezés!<br />";
                    if ($row["admin"] == 1) {
                        echo 'Kattints <a href="admin.php">ide</a>, ha nem irányít automatikusan tovább!</div>';
                    } else {
                        echo 'Kattints <a href="merkozesek.php">ide</a>, ha nem irányít automatikusan tovább!</div>';
                    }
                    echo '</div>';
                } else {
                    echo
                    '<meta http-equiv="Refresh" content="3;url=bejelentkezes.php" />
			</head>

			<body>
			<div class="wrapper">
			<div class="menu"><ul>
				<li><a href="bejelentkezes.php" >Bejelentkezés</a></li>
				<li><a href="regisztracio.php">Regisztráció</a></li>
			</ul></div>';
                    echo "<div class=\"main\">Hibás felhasználónév vagy jelszó!<br />";
                    echo 'Kattints <a href="bejelentkezes.php">ide</a>, ha nem irányít automatikusan vissza!</div>';
                    echo '</div>';
                }
            }
        }
        ?>
        </body>

</html>