<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        <h2>Afrekenen</h2>
        <form action="bestelcontroller.php" method="POST">
            Gewenste afhaaldatum: 
            <select name="afhaaldatum">
                  
            <?php 
            
            foreach ($afhaaldata["vrijedata"] as $datum)
                echo '<option value="'. $datum .'">' . $datum . '</option>';
            ?>
                </select> 

        <input type="submit" value="Bevestigen" name="bevestigen">
        
        </form>
        
    </body>
</html>
