
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="Presentation/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        
        <table border="1">
            <caption>Winkelmandje</caption>
            <tr>
                <th>Produkt</th>
                <th>Eenheidsprijs</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
        <?php 
        foreach ($_SESSION["produkten"]  as $key => $produkt) {
        ?>
            <tr><td> <?php echo $produkt["naam"] ?></td><td><?php echo $produkt["prijs"]?></td><td><?php echo $_SESSION["bestelling"][$key + 1] ?></td><td><?php echo $produkt["prijs"] * $_SESSION["bestelling"][$key +1] . ' €'?></td></tr>';
                       
          <?php  
        }
?>
            <tr>
                <td colspan="3">Totaal</td>
                <td><?php echo $_SESSION["bestelling"]["totaal"]  . ' €'?></td>
            </tr>
            </table>

    </body>
</html>
