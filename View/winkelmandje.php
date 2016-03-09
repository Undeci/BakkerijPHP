<!--alain.urlings-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="View/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Winkelmandje</h1>        
        <table>
            <tr>
                <th>Produkt</th>
                <th>Eenheidsprijs</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
            <?php
            foreach ($_SESSION["produkten"] as $key => $produkt) {
                ?>
                <tr><td> <?php echo $produkt["naam"] ?></td><td><?php echo $produkt["prijs"] . ' €'; ?></td><td><?php echo $_SESSION["bestelling"][$key + 1] ?></td><td><?php echo $produkt["prijs"] * $_SESSION["bestelling"][$key + 1] . ' €' ?></td></tr>                       
                <?php
            }
            ?>
            <tr>
                <th colspan="3">Totaal</th>
                <th><?php echo $_SESSION["bestelling"]["totaal"] . ' €' ?></th>
            </tr>
        </table>
    </body>
</html>
