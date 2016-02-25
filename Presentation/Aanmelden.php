<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Bakkerij PHP</h1>
        <form action="klantcontroller.php" id="registreer" name="registreer" method="post">
            <fieldset>
                <legend>Registreren</legend>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required/> 
                <label for="voornaam">Voornaam: </label>
                <input type="text" name="voornaam" id="voornaam" required /> 
                <label for="naam">Naam: </label>
                <input type="text" name="naam" id="naam" required /> 
                <label for="adres">Adres: </label>
                <input type="text" name="adres" id="adres" required /> 

                <label for="gemeente">Gemeente: </label>

                <select name="postcodeid" form="registreer">

                    <?php
                    foreach ($postcodes as $value) {

                        echo '<option value="' . $value['ID'] . '">' . $value["Name"] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="registreer" value="Registreer">
            </fieldset>
        </form>

        <form action="klantcontroller.php" id="aanmelden" name="aanmelden" method="post">
            <fieldset>
                <legend>Aanmelden</legend>
                <label for="email">Email: </label>
             <?php   if (isset($_COOKIE["email"])) {
                 echo '<input type="email" name="email" value="' . $_COOKIE["email"] . '" required>';
             } else echo '<input type="email" name="email" required>';
                     ?>
                
                <label for="wachtwoord">Paswoord: </label>
                <input type="password" name="wachtwoord" required>
                <input type="submit" name="aanmelden" value="Aanmelden">
            </fieldset>
        </form>
        <?php

        ?>
    </body>
</html>
