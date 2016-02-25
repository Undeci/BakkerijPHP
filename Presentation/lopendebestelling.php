<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="Presentation/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        volgende bestellingen aktief:
        <?php
        $now = date("Y-m-d", strtotime("today"));
        $i = 0;

        foreach ($overzicht as $key => $value) {

        echo '<p style="font-weight: bold;">' . $afhaaldata["afhaal"][$i] . '</p>';
        echo '<p>Bedrag: ' . $key . ' €';
        foreach ($value as $bestelling) {
        echo '<p>' . $bestelling["naam"] . ' aantal: ' . $bestelling["aantal"] . '</p>';
        }
        if ($afhaaldata["afhaal"][$i] != $now) {
           echo '<form action="bestelcontroller.php" method="POST"><input type="text" name="annuleer" value="' . $afhaaldata["afhaal"][$i] . '" hidden><input type="submit" value="annuleer"></form>';
            }
            $i++;
        }
        
        ?>
    </body>
</html>
