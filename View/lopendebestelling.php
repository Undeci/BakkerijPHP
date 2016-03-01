<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="View/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <h1>volgende bestellingen aktief:</h1>
        <div class="autoflex wrapflex" id="lopende">
        <?php
        $now = date("Y-m-d", strtotime("today"));
        $i = 0;

        foreach ($overzicht as $key => $value) {

        echo '<div class="lopende columnflex"><p>' . $afhaaldata["afhaal"][$i] . '</p>';
        echo '<p>' . $key . ' €';
        foreach ($value as $bestelling) {
        echo '<p>' . $bestelling["naam"] . ': ' .  $bestelling["aantal"] . '</p>';
        }
        if ($afhaaldata["afhaal"][$i] != $now) {
           echo '<form id="annuleer" action="bestelcontroller.php" method="POST"><input type="text" name="annuleer" value="' . $afhaaldata["afhaal"][$i] . '" hidden><input type="submit" value="annuleer"></form>';
            }
            echo '</div>';
            $i++;
        }        
        ?>
        </div>
    </body>
</html>
