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
            function ok_click(i) {
                console.log("ok_" + i);
                if (document.getElementsByName('hazai_' + i)[0].value != "" &&
                        document.getElementsByName('vendeg_' + i)[0].value != "")
                {
                    $(".tipp_" + i).hide();
                    $(".eredmeny_" + i).show();
                    $("#eredmeny_" + i).html(document.getElementsByName('hazai_' + i)[0].value + "-" + document.getElementsByName('vendeg_' + i)[0].value +
                            '<input type="hidden" name="tipp_' + i + '" value="1">');
                    $("#mentes").show();
                }
            }

            function edit_click(i) {
                console.log("edit" + i);
                $(".eredmeny_" + i).hide();
                $(".tipp_" + i).show();
                $("#mentes").hide();
                $(".eredmeny").each(function(index, element) {
                    if (window.getComputedStyle(element).display != 'none') {
                        $("#mentes").show();
                    }
                });
            }
        </script>
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
            if ($_POST['tipp_8'] == 1) {

            }

            echo '<div class="loggedin">Üdv, ' . $_SESSION["nev"] . '!</br><a href="kijelentkezes.php">Kijelentkezés</a></div>';

            include("install.php");

            mysql_query("SET NAMES UTF8");
            mysql_query("set character set UTF8");
            mysql_query("set collation_connection='utf8_unicode_ci'");

            $datetime = new DateTime();
            date_default_timezone_set('Europe/Budapest');
            $most = $datetime->format('U') + 900;
            //echo $timestamp;

            $sql = "SELECT * FROM merkozes ORDER BY idopont";
            $res = mysql_query($sql);
            while ($row = mysql_fetch_array($res)) {
                if (isset($_GET["tipp_" . $row[0]])) {

                $file = 'people.txt';

                $current = file_get_contents($file);

                $current .= "gdfgdfgsdfgdfgf";

                file_put_contents($file, $current);
                    //echo $row["idopont"].">".$timestamp;
                    if ($row["idopont"] > $most) {
                        $sql2 = "INSERT INTO tipp (felhasznalonev, merkozes_id, hazai, vendeg) VALUES ('" . $_SESSION["nev"] . "'," . $row[0] . "," .
                                $_GET["hazai_" . $row[0]] . "," . $_GET["vendeg_" . $row[0]] . ");";
                        //echo $sql2;
                        $res2 = mysql_query($sql2);
                    }
                }
            }
            ?>
            <div class="main">
                <form action="" id='myform'>
                    <div id="tabla" >
                        <div class="header sor">
                            <div class="col_1 h_col">Mérkőzés</div>
                            <div class="col_2 h_col">Időpont</div>
                            <div class="col_3 h_col">
                                <div class="tipp">Tipp</div>
                                <div class="eredmeny">Eredmény</div>
                            </div>
                        </div>
                        <?php
                        $res = mysql_query($sql);
                        while ($row = mysql_fetch_array($res)) {
                            $mid = $row['merkozes_id'];
                            $sql2 = "SELECT hazai, vendeg FROM tipp WHERE felhasznalonev='" . $_SESSION['nev'] . "' AND merkozes_id=" . $mid . "";
                            //echo $sql2;
                            $res2 = mysql_query($sql2);
                            $row2 = mysql_fetch_array($res2);

                            echo'<div class="sor sor_' . $mid . '">';
                            echo'   <div class="col_1 col">' . $row["hazai_csapat"] . ' - ' . $row["vendeg_csapat"] . '</div>';

                            $meccs = $row['idopont'];
                            $date = new DateTime("@$meccs");
                            $date->setTimezone(new DateTimeZone(TIMEZONE));

                            echo'<div class="col_2 col">' . $date->format('Y-m-d H:i:s') . '</div>';
                            echo'<div class="col_3 col">';

                            //$date2 = new DateTime("@$timestamp");
                            //$date2->setTimezone(new DateTimeZone(TIMEZONE));
                            //echo "meccs:". $date->format('Y-m-d H:i:s').">most+15perc:".$date2->format('Y-m-d H:i:s');
                            if ($row2['hazai'] != "") {
                                echo '<div id="eredmeny_' . $mid . '" class="eredmeny_' . $mid . '">' . $row2["hazai"] . '-' . $row2["vendeg"] . '</div>';
                            } else {
                                if ($row["idopont"] > $most) {
                                    echo'<div class="tipp tipp_' . $mid . '">';
                                    echo'   <input id="szam" type="text" name="hazai_' . $mid . '" size="1" maxlength="2"/>';
                                    echo'   -';
                                    echo'   <input id="szam" type="text" name="vendeg_' . $mid . '" size="1" maxlength="2"/>';
                                    echo'</div>';
                                    echo'<div id="eredmeny_' . $mid . '" class="eredmeny eredmeny_' . $mid . '">';
                                    echo'</div>';
                                } else {
                                    echo '<div id="eredmeny_' . $mid . '" class="eredmeny_' . $mid . '">Lezárva!</div>';
                                }
                            }
                            echo '</div>';
                            if ($row2['hazai'] == "" && $row["idopont"] > $most) {
                                echo '<div class="col_4 col">
							<div class="tipp tipp_' . $mid . '">
								<img onClick="ok_click(' . $mid . ')" src="ok.png"/>
							</div>
							<div class="eredmeny eredmeny_' . $mid . '">
								<img onclick="edit_click(' . $mid . ')" src="edit.png"/>
							</div>
						</div>';
                            }
                            echo '</div>';
                        }
                        ?>
                        <div id="mentes">
                            <div colspan="3">
                                <input name="submit" type="submit" value="Mentés" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>	
        </div>

    </body>
</html>
