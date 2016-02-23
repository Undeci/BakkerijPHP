
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
        <?php
        echo 'Welkom ' . $_SESSION["klant"]["voornaam"];
        if (isset($_POST["aanpassen"]))
            $aanpas = true;
        else $aanpas = false;
        ?>
        
        <form id="toonbank" action="bestelcontroller.php" method="POST">
            <div>
            <span> Volkorenbrood (2,5 €)</span> <label>Aantal: </label> <input type="number" name="1" min="0"  value="<?php echo $aanpas ? $_SESSION["bestelling"]["1"] : 0  ?>">
            </div>
            <div>
            <span>Wit brood (2,0 €)</span> <label>Aantal: </label> <input type="number" name="2" min="0" value="<?php echo $aanpas ? $_SESSION["bestelling"]["2"] : 0  ?>">
            </div>
            <div>
            <span> Croissant (1,0 €)</span><label>Aantal: </label><input type="number" name="3" min="0" value="<?php echo $aanpas ? $_SESSION["bestelling"]["3"] : 0  ?>">
            </div>
            <div>
            <span>Boterkoek (1,0 €)</span><label>Aantal: </label><input type="number" name="4" min="0" value="<?php echo $aanpas ? $_SESSION["bestelling"]["4"] : 0  ?>">
            </div>
            <div>
            <span>Frangipane (1,2 €)</span><label>Aantal: </label><input type="number" name="5" min="0" value="<?php echo $aanpas ? $_SESSION["bestelling"]["5"] : 0  ?>">
            </div>
            <div>
            <span>Eclair (1,2 €)</span> <label>Aantal: </label><input type="number" name="6" min="0" value="<?php echo $aanpas ? $_SESSION["bestelling"]["6"] : 0  ?>">
            </div>
            <input type="submit" name="bestelling" value="Bestel">
            
        </form>
        
        <form action="bestelcontroller.php" method="POST">
            <input type="submit" value="lopende bestellingen bekijken" name="lopende">
        </form>
        
    </body>
</html>
