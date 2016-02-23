
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

        <table border="1">
            <caption>Winkelmandje</caption>
            <tr>
                <th>Produkt</th>
                <th>Eenheidsprijs</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
            <tr>
                <td>Volkorenbrood</td>
                <td>2,5 €</td>
                <td><?php echo $_SESSION["bestelling"]["1"] ?></td>
                <td><?php echo 2.5 * $_SESSION["bestelling"]["1"] . ' €'?></td>
            </tr>
            <tr>
                <td>Wit brood</td>
                <td>2,0 €</td>
                <td><?php echo $_SESSION["bestelling"]["2"] ?></td>
                <td><?php echo 2 * $_SESSION["bestelling"]["2"] . ' €'?></td>
            </tr>

            <tr>
                <td>Croissant</td>
                <td>1,0 €</td>
                <td> <?php echo $_SESSION["bestelling"]["3"] ?></td>
                <td> <?php echo $_SESSION["bestelling"]["3"] . ' €'?></td>
            </tr>
            <tr>
                <td>Boterkoek</td>
                <td>1,0 €</td>
                <td><?php echo $_SESSION["bestelling"]["4"] ?></td>
                <td><?php echo $_SESSION["bestelling"]["4"] . ' €'?></td>
            </tr>
            <tr>
                <td>Frangipane</td>
                <td>1,2 €</td>
                <td><?php echo $_SESSION["bestelling"]["5"] ?></td>
                <td><?php echo 1.2 * $_SESSION["bestelling"]["5"] . ' €'?></td>
            </tr>
            <tr>
                <td>Eclair</td>
                <td>1,2 €</td>
                <td><?php echo $_SESSION["bestelling"]["6"] ?></td>
                <td><?php echo 1.2 * $_SESSION["bestelling"]["6"] . ' €'?></td>
            </tr>

            <tr>
                <td colspan="3">Totaal</td>
                <td><?php echo $_SESSION["bestelling"]["totaal"]  . ' €'?></td>
            </tr>


        </table>

        <?php
        // put your code here
        ?>
    </body>
</html>
