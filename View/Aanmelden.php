<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="View/Bakkerij.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <div class="columnflex wrapflex autoflex Aanmelden">


            <form class="flex" action="klantcontroller.php" name="aanmelden" method="post">
                <fieldset>
                    <legend>Aanmelden</legend>
                    <div class="wrapflex autoflex" id="aanmelden">
                    <label for="email">Email: </label>
                    <?php
                    if (isset($_COOKIE["email"])) {
                        echo '<input type="email" name="email" value="' . $_COOKIE["email"] . '" pattern=".+@.+\..+" required>';
                    } else
                        echo '<input type="email" name="email" pattern=".+@.+[\.].+" required>';
                    ?>

                    <label for="wachtwoord">Paswoord: </label>
                    <input type="password" name="wachtwoord" maxlength="40" required>
                    <input type="submit" name="aanmelden" value="Aanmelden">
                    </div>
                </fieldset>
            </form>
            <form class="flex"  action="klantcontroller.php" name="registreer" method="post">
                <fieldset class="flex">
                    <legend>Registreren</legend>
                    <div  class="wrapflex autoflex" id="registreer">
                        <label for="email">Email: </label>
                        <input type="email" name="email" id="email" pattern=".+@.+\..+"  maxlength="40" required/> 
                        <label for="voornaam">Voornaam: </label>
                        <input type="text" name="voornaam" id="voornaam" maxlength="40" required /> 
                        <label for="naam">Naam: </label>
                        <input type="text" name="naam" id="naam" maxlength="40" required /> 
                        <label for="adres">Adres: </label>
                        <input type="text" name="adres" id="adres" maxlength="40" required /> 
                        <label for="postcodeid">Gemeente: </label>
                        <select name="postcodeid">

                            <?php
                            foreach ($postcodes as $value) {

                                echo '<option value="' . $value["ID"] . '">' . $value["Name"] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" name="registreer" value="Registreer">
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>
