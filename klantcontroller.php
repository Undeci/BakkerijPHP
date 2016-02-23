<?php

session_start();
require 'Autoloader.php';

//require_once 'C:/xampp/htdocs/Bakkerij/Business/KlantService.php';
//require_once 'Business/BestelService.php';
//require_once 'Business/SecurityService.php';

use Business\BestelService;
use Business\KlantService;
use Business\SecurityService;

if (isset($_GET["wachtwoord"])) {
    echo 'Je wachtwoord is ' . $_SESSION["wachtwoord"];
    include_once 'Presentation/wachtwoord.php';
}
if (isset($_POST["nieuwwachtwoord"])) {
    $service = new KlantService();
    $service->updatewachtwoord(sha1($_POST["nieuwwachtwoord"]), $_COOKIE["email"]);
}

if (isset($_POST["registreer"])) {
    $wachtwoord = "";
    $values = str_split("ABCDEFGHIJKLNOPQRSTUVWXYZ0123456789");
    for ($i = 0; $i < 6; $i++) {
        $wachtwoord = $wachtwoord . $values[array_rand($values, 1)];
        $wachtwoordsha1 = sha1($wachtwoord);
        $_SESSION["wachtwoord"] = $wachtwoord;
    }

    $security = new SecurityService();
    $clean = $security->clean($_POST);

    $service = new KlantService();
    $service->setKlant($clean["adres"], $clean["email"], $clean["naam"], $clean["voornaam"], $clean["postcodeid"], $wachtwoordsha1);
    setcookie("email", $clean["email"], time() + 3600 * 24 * 365);
    header("location: klantcontroller.php?wachtwoord");
} elseif (isset($_POST["aanmelden"])) {

    $security = new SecurityService();
    $clean = $security->clean($_POST);

    $service = new KlantService();
    $_SESSION["klant"] = $service->verifieerklant($clean["email"], sha1($clean["wachtwoord"]));
    setcookie("email", $clean["email"], time() + 3600 * 24 * 365);

    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);

    $tomorrow = date("Y-m-d", strtotime("tomorrow"));
    $tomorrowplusone = date("Y-m-d", strtotime("+2 Days"));
    $maxafhaal = date("Y-m-d", strtotime("+3 Days"));

    $afhaal = array();
    $afhaal = array_diff(array($tomorrow, $tomorrowplusone, $maxafhaal), $afhaaldata);


    if (count($afhaal) == 0) {
        echo 'U kan geen extra bestellingen plaatsen!';
        $afhaaldata = $bestel->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);
        $overzicht = $bestel->getbestelling($_SESSION["klant"]["klantid"]);
        include_once 'Presentation/lopendebestelling.php';
        include_once 'Presentation/Home.html';
    } elseif ($_SESSION["klant"]["voornaam"] && $_SESSION["klant"]["block"] == 0) {
        include 'Presentation/toonbank.php';
        include 'Presentation/Home.html';
    } elseif (!$_SESSION["klant"]["voornaam"]) {
        echo 'Fout bij het aanmelden';
        include 'Presentation/Aanmelden.php';
    } elseif ($_SESSION["klant"]["block"] == 1) {
        include_once 'Presentation/Block.php';
    }
} else {
    include 'Presentation/Aanmelden.php';
}