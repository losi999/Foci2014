<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="Viewport" content="width=device-width, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>VB tippjáték</title>
    </head>
    <body>
        <div class="wrapper">
            <?php
            if (isset($_SESSION['nev'])) {
                echo '<div class="menu">
                    <ul>';
                if($_SESSION['admin']==0) {
			echo'<li><a href="merkozesek.php">Tippelés</a></li>
			<li><a href="ranglista.php">Ranglista</a></li>
			<li><a href="tippek.php">Mérkőzések</a></li>';
                }
                else {
                    	echo'<li><a href="admin.php">Admin</a></li>';
                }
                    echo'</ul>
		</div>';

                echo '<div class="loggedin">Üdv, ' . $_SESSION["nev"] . '!</br>'
                        . '<a href="kijelentkezes.php">Kijelentkezés</a>'
                    . '</div>';
            } else {
                echo '<div class="menu">
                    <ul>
			<li><a href="bejelentkezes.php">Bejelentkezés</a></li>
			<li><a href="regisztracio.php">Regisztráció</a></li>
                    </ul>
		</div>';
            }
            ?>

            <div class="main">
            </div>

    </body>
</html>
