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
        <link href="Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php

        $tomorrow = date("Y-m-d", strtotime("tomorrow"));
        $tomorrowplusone = date("Y-m-d", strtotime("+2 Days"));
        $maxafhaal = date("Y-m-d", strtotime("+3 Days"));
        
        $afhaal = array();
        $afhaal =  array_diff(array($tomorrow, $tomorrowplusone, $maxafhaal), $afhaaldata);
    
        ?>
        
        <h2>Afrekenen</h2>
        <form action="bestelcontroller.php" method="POST">
            Gewenste afhaaldatum: 
            <select name="afhaaldatum">
                  
            <?php 
            
            foreach ($afhaal as $datum)
                echo '<option value="'. $datum .'">' . $datum . '</option>';
            ?>
                </select> 

        <input type="submit" value="Bevestigen" name="bevestigen">
        
        </form>
        
    </body>
</html>
