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
        <script src="anytime.5.0.1-1403131246.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="anytime.5.0.1-1403131246.css" />
        <title>VB tippjáték</title>
        <script>
            function ok_click(i) {
                console.log("ok_" + i);

                if (document.getElementsByName('hazai_csapat_' + i)[0].value != "" &&
                        document.getElementsByName('vendeg_csapat_' + i)[0].value != "" &&
                        document.getElementsByName('datum_' + i)[0].value != "")
                {
                    /*var most = Math.floor(new Date().getTime() / 1000);
                     var dateString = document.getElementsByName('datum_' + i)[0].value;
                     var date = new Date(dateString);
                     var meccs = date.getTime() / 1000;
                     if (meccs >= most) {*/
                    $(".admin_edit_" + i).hide();
                    $(".admin_fix_" + i).show();
                    $("#admin_csapatok_" + i).html(document.getElementsByName('hazai_csapat_' + i)[0].value + " - " + document.getElementsByName('vendeg_csapat_' + i)[0].value);
                    $("#admin_idopont_" + i).html(
                            document.getElementsByName('datum_' + i)[0].value +
                            '<input type="hidden" name="merkozes_' + i + '" value="1">');
                    if (document.getElementsByName('hazai_' + i)[0].value != "" &&
                            document.getElementsByName('vendeg_' + i)[0].value != "") {
                        $("#admin_eredmeny_" + i).html(document.getElementsByName('hazai_' + i)[0].value + "-" + document.getElementsByName('vendeg_' + i)[0].value +
                                '<input type="hidden" name="eredmeny_' + i + '" value="1">');
                    }
                    console.log("ww");
                    $("#mentes").show();
                    //}
                }
            }

            function edit_click(i) {
                console.log("edit_" + i);
                $(".admin_fix_" + i).hide();
                $(".admin_edit_" + i).show();
            }

            function new_click(i) {
                console.log("uj" + i);
                /*var elem = document.getElementById("tabla");*/
                $("#tabla").append('<div class="sor sor_' + i + '"></div>')
                $(".uj").hide();
                $(".sor_" + i).html('<div class="col_1 col">' +
                        '<div id="admin_csapatok_' + i + '" class="admin_fix admin_fix_' + i + '">' +
                        '</div>' +
                        '<div class="admin_edit admin_edit_' + i + '">' +
                        '<input type="text" name="hazai_csapat_' + i + '" size="25" maxlength="30" value=""/>' +
                        '-' +
                        '<input type="text" name="vendeg_csapat_' + i + '" size="25" maxlength="30" value=""/>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col_2 col">' +
                        '<div id="admin_idopont_' + i + '" class="admin_fix admin_fix_' + i + '">' +
                        '</div>' +
                        '<div class="admin_edit admin_edit_' + i + '">' +
                        '<input name="datum_' + i + '" type="text" id="datepicker_' + i + '" size="15" value=""/>' +
                        '<script>AnyTime.picker("datepicker_' + i + '");<\/script>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col_3 col">' +
                        '<div id="admin_eredmeny_' + i + '" class="admin_fix admin_fix_' + i + '">' +
                        '</div>' +
                        '<div class="admin_edit admin_edit_' + i + '">' +
                        '<input id="szam" type="text" name="hazai_' + i + '" size="1" maxlength="2" value=""/>' +
                        '-' +
                        '<input id="szam" type="text" name="vendeg_' + i + '" size="1" maxlength="2" value=""/>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col_4 col">' +
                        '<div class="admin_fix admin_fix_' + i + '">' +
                        '<img onclick="edit_click(' + i + ')" src="edit.png"/>' +
                        '</div>' +
                        '<div class="admin_edit admin_edit_' + i + '">' +
                        '<img onClick="ok_click(' + i + ')" src="ok.png"/>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col_5 col">' +
                        '<div id="remove_' + i + '" class="remove">' +
                        '<img onClick="remove_click(' + i + ')" src="remove.png"/>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col_6 col">' +
                        '<div class="uj">' +
                        '<img onClick="new_click(' + (i + 1) + ')" src="add.png"/>' +
                        '</div>' +
                        '</div>');

                $("#max").html('<input type="hidden" name="max" value="' + i + '">');
                $(".admin_fix_" + i).hide();
                $(".admin_edit_" + i).show();
            }

            function remove_click(i) {
                /*alert("Törölni akarok ezt a mérkőzést?\n" + $("#admin_csapatok_" + i).html());*/
                $(".sor_" + i).hide();
                $("#remove_" + i).hide();
                $("#remove_" + i).append('<input type="hidden" name="torol_' + i + '" value="' + i + '">');
                $("#mentes").show();
            }
        </script>
    </head>
    <body >
        <div class = "wrapper">
            <div class = "menu">
                <ul>
                    <li> <a href = "admin.php" > Admin </a></li >
                </ul>
            </div>
            <?php
            echo '<div class="loggedin">Üdv, ' . $_SESSION["nev"] . '!</br><a href="kijelentkezes.php">Kijelentkezés</a></div>';

            include("install.php");
            header("Content-type: text/html; charset=utf-8");

            mysql_query("SET NAMES UTF8");
            mysql_query("set character set UTF8");
            mysql_query("set collation_connection='utf8_unicode_ci'");

            $sql = "SELECT * FROM merkozes ORDER BY merkozes_id";
            if ($_GET['submit'] == "Mentés") {
                for ($i = 1; $i <= $_GET["max"]; $i++) {
                    if (isset($_GET['merkozes_' . $i])) {
//                        echo "merkozes_" . $i . " " . $_GET["merkozes_" . $i] . "</br>";
//                        echo "hazai_csapat_" . $i . " " . $_GET["hazai_csapat_" . $i] . "</br>";
//                        echo "vendeg_csapat_" . $i . " " . $_GET["vendeg_csapat_" . $i] . "</br>";
//                        echo "datum_" . $i . " " . $_GET["datum_" . $i] . "</br>";
//                        echo "eredmeny_" . $i . " " . $_GET["eredmeny_" . $i] . "</br>";

                        $date = new DateTime('now');
                        $date->setTimezone(new DateTimeZone(TIMEZONE));
                        $str_server_now = $date->format('U');
//                        echo $str_server_now . " ";


                        $date = new DateTime($_GET["datum_" . $i]);
                        $ts = $date->format('U');
                        if ($ts > $str_server_now) {
                            $replace = "REPLACE INTO merkozes (merkozes_id, hazai_csapat, vendeg_csapat, idopont) "
                                    . "VALUES (" . $i . ", '" . $_GET["hazai_csapat_" . $i] . "', '" . $_GET["vendeg_csapat_" . $i] . "', " . $ts . ");";
                        } else {
                            if (isset($_GET['eredmeny_' . $i])) {
//                                echo "hazai_" . $i . " " . $_GET["hazai_" . $i] . "</br>";
//                                echo "vendeg_" . $i . " " . $_GET["vendeg_" . $i] . "</br></br>";
                                $replace = "REPLACE INTO merkozes (merkozes_id, hazai_csapat, vendeg_csapat, idopont, hazai_gol, vendeg_gol) "
                                        . "VALUES (" . $i . ", '" . $_GET["hazai_csapat_" . $i] . "', '" . $_GET["vendeg_csapat_" . $i] . "', " . $ts . "," . $_GET["hazai_" . $i] . "," . $_GET["vendeg_" . $i] . ");";
                                $tippek = "SELECT * FROM tipp WHERE merkozes_id=" . $i;
                                $tippek_res = mysql_query($tippek);
                                while ($tippek_row = mysql_fetch_array($tippek_res)) {
                                    $pont = 0;
                                    if (($tippek_row["hazai"] - $tippek_row["vendeg"] < 0 && $_GET["hazai_" . $i] - $_GET["vendeg_" . $i] < 0) ||
                                            ($tippek_row["hazai"] - $tippek_row["vendeg"] > 0 && $_GET["hazai_" . $i] - $_GET["vendeg_" . $i] > 0)) {
                                        $pont++;
                                    }
                                    if ($tippek_row["hazai"] - $tippek_row["vendeg"] == $_GET["hazai_" . $i] - $_GET["vendeg_" . $i]) {
                                        $pont++;
                                    }
                                    if (($tippek_row["hazai"] == $_GET["hazai_" . $i]) && ($tippek_row["vendeg"] == $_GET["vendeg_" . $i])) {
                                        $pont = 3;
                                    }
                                    //echo $tippek_row["felhasznalonev"] . " " . $pont . " </br>";
                                    $update = "UPDATE tipp SET pont=" . $pont . " WHERE felhasznalonev='" . $tippek_row["felhasznalonev"] . "' AND merkozes_id=" . $i;
                                    mysql_query($update);
                                    //echo $update . "</br>";
                                }
                            }
                        }

                        mysql_query($replace);
                        //echo $replace . '</br>';
                        //echo $date->format('U');
                    }

                    if (isset($_GET["torol_" . $i])) {
                        mysql_query("DELETE FROM merkozes WHERE merkozes_id=" . $i);
                        mysql_query("DELETE FROM tipp WHERE merkozes_id=" . $i);
                    }
                }
            }
            ?>
            <div class = "main" >
                <form action = "" id = 'myform' >
                    <div id="tabla" >
                        <div class="header sor">
                            <div class="col_1 h_col">
                                Mérkőzés    
                            </div>
                            <div class="col_2 h_col">
                                Időpont
                            </div>
                            <div class="col_3 h_col">
                                Eredmény
                            </div>
                        </div>
                        <?php
                        $max = mysql_fetch_array(mysql_query("SELECT MAX(merkozes_id) AS max FROM merkozes;"));

                        $res = mysql_query($sql);
                        while ($row = mysql_fetch_array($res)) {
                            $mid = $row["merkozes_id"];
                            echo'<div class="sor sor_' . $mid . '">				
                        <div class="col_1 col">
                            <div id="admin_csapatok_' . $mid . '" class="admin_fix admin_fix_' . $mid . '">' . $row["hazai_csapat"] . ' - ' . $row["vendeg_csapat"] . '</div>
                            <div class="admin_edit admin_edit_' . $mid . '">
                                <input type="text" name="hazai_csapat_' . $mid . '" size="25" maxlength="30" value="' . $row["hazai_csapat"] . '"/>
                                -
                                <input type="text" name="vendeg_csapat_' . $mid . '" size="25" maxlength="30" value="' . $row["vendeg_csapat"] . '"/>
                            </div>
                        </div>
                        <div class="col_2 col">';
                            $meccs = $row['idopont'];
                            $date = new DateTime("@$meccs");
                            $date->setTimezone(new DateTimeZone(TIMEZONE));
                            //$date->format('Y-m-d H:i:s');

                            echo'<div id="admin_idopont_' . $mid . '" class="admin_fix admin_fix_' . $mid . '">' . $date->format('Y-m-d H:i:s') . '
                            </div>
                            <div class="admin_edit admin_edit_' . $mid . '">
                                <input name="datum_' . $mid . '" type="text" id="datepicker_' . $mid . '" size="15" value="' . $date->format('Y-m-d H:i:s') . '"/>
                                <script>AnyTime.picker("datepicker_' . $mid . '");</script>
                            </div>
                        </div>
                        <div class="col_3 col">
                            <div id="admin_eredmeny_' . $mid . '" class="admin_fix admin_fix_' . $mid . '">' . $row["hazai_gol"] . '-' . $row["vendeg_gol"] . '
                            </div>';

                            $date = new DateTime('now');
                            $date->setTimezone(new DateTimeZone(TIMEZONE));
                            $str_server_now = $date->format('U');
                            //echo $str_server_now . " ";
                            if ($meccs < $str_server_now) {
                                echo'<div class="admin_edit admin_edit_' . $mid . '">
                                <input id="szam" type="text" name="hazai_' . $mid . '" size="1" maxlength="2" value="' . $row["hazai_gol"] . '"/>
                                -
                                <input id="szam" type="text" name="vendeg_' . $mid . '" size="1" maxlength="2" value="' . $row["vendeg_gol"] . '"/>
                            </div>';
                            }
                            echo'</div>
                        <div class="col_4 col">
                            <div class="admin_fix admin_fix_' . $mid . '">
                                <img onclick="edit_click(' . $mid . ')" src="edit.png"/>
                            </div>
                            <div class="admin_edit admin_edit_' . $mid . '">
                                <img onClick="ok_click(' . $mid . ')" src="ok.png"/>
                            </div>
                        </div>
                        <div class="col_5 col">
                            <div id="remove_' . $mid . '" class="remove">
                                <img onClick="remove_click(' . $mid . ')" src="remove.png"/>
                            </div>
                        </div>';
                            if ($mid == $max["max"]) {
                                $mid++;
                                echo'<div class="col_6 col">
                                <div class="uj">
                                    <img onClick="new_click(' . $mid . ')" src="add.png"/>
                                </div>
                            </div>';
                            }

                            echo'</div>';
                        }
                        echo'</div>';
                        echo '<div id = "mentes" >
                                    <div id="max">
                                        <input type="hidden" name="max" value="' . ($mid - 1) . '"/>
                                    </div>
                                    <input name = "submit" type = "submit" value = "Mentés" />
                                    <input name = "submit" type = "submit" value = "Mégse" />
                                </div>';
                        ?>
                </form>
            </div>	
        </div>
    </body>
</html>
