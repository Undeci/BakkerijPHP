<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="View/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form class="columnflex autoflex" id="toonbank" action="bestelcontroller.php" method="POST">

            <?php
            foreach ($_SESSION["produkten"] as $produkt) {
                $id = $produkt["produktid"];
                ?>
                <div><span> <?php echo $produkt["naam"] . " (" . $produkt["prijs"] . " €)" ?> </span><label>#</label><input type="number" name="<?php echo $id ?>" min="0" max="99" value="<?php echo $aanpas ? $_SESSION["bestelling"]["$id"] : 0 ?>"></div>
            <?php } ?>
            <input type="submit" name="bestelling" value="Bestel">
            <input type="submit" value="lopende bestellingen" name="lopende">
        </form>
    </body>
</html>
