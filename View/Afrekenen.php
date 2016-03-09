<!--alain.urlings-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="View/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Afrekenen</h1>
        <div class="flex">
<div id="bestelling" class="columnflex autoflex">
    <div>Bakker PHP</div>
        <?php
        
        foreach ($_SESSION["bestelling"] as $key => $item) {
            if ($item != "0" && $key != "totaal") {
                echo '<div class="flex lijn"><div>' . $_SESSION["produkten"][$key - 1]["naam"] . ': '. $item . '</div><div>' . $_SESSION["produkten"][$key - 1]["prijs"] * $item . ' €</div></div>';
            }
        }
        
        ?>
    <div>---------</div>
     <div class="flex"><div>Totaal: </div><div><?php echo $_SESSION["bestelling"]["totaal"]?> €</div></div>
</div>
        </div>
        

        <form action="bestelcontroller.php" method="POST">
            <div class="flex">
                <div class="autoflex" id="afrekenen">
                    <label>Gewenste afhaaldatum: </label>
                    <select name="afhaaldatum">

<?php
foreach ($_SESSION["vrijedata"] as $datum)
    echo '<option value="' . $datum . '">' . $datum . '</option>';
?>
                    </select> 

                    <input type="submit" value="Bevestigen" name="bevestigen">
                </div>
            </div>
        </form>


    </body>
</html>
