<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="Presentation/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php

        echo 'Welkom ' . htmlentities($_SESSION["klant"]["voornaam"]);
        if (isset($_POST["aanpassen"]))
            $aanpas = true;
        else
            $aanpas = false;
        ?>

        <form id="toonbank" action="bestelcontroller.php" method="POST">

            <?php
            foreach ($_SESSION["produkten"] as $produkt) {
                $id = $produkt["produktid"];
                ?>
                <div><span> <?php echo $produkt["naam"] . " (" .  $produkt["prijs"] . " €)" ?> </span><label>Aantal: </label><input type="number" name="<?php echo $id ?>" min="0" value="<?php echo $aanpas ? $_SESSION["bestelling"]["$id"] : 0 ?>"></div>
<?php } ?>
            <input type="submit" name="bestelling" value="Bestel">
        </form>
        <form  action="bestelcontroller.php" method="POST">
            <input type="submit" value="lopende bestellingen bekijken" name="lopende">
        </form>
    </body>
</html>
