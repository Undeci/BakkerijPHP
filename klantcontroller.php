<?php

session_start();
require 'Autoloader.php';

use Business\BestelService;
use Business\KlantService;

if (isset($_GET["wachtwoord"])) {
    echo 'Je wachtwoord is ' . $_SESSION["wachtwoord"];
    include_once 'Presentation/wachtwoord.php';
}
if (isset($_POST["nieuwwachtwoord"])) {
    $service = new KlantService();
    $service->updatewachtwoord(sha1($_POST["nieuwwachtwoord"]), $_COOKIE["email"]);
}
if (isset($_POST["registreer"])) {
    $service = new KlantService();
    $nieuweklant = $service->setKlant($_POST);

    if ($nieuweklant)
        header("location: klantcontroller.php?wachtwoord");
    else {
        echo 'Reeds geregistreerd bij BakkerijPHP';
        include_once 'Presentation/Aanmelden.php';   
    }
} elseif (isset($_POST["aanmelden"])) {
    $service = new KlantService();
    $service->verifieerklant($_POST);

    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldata();

    if (count($afhaaldata["vrijedata"]) == 0) {
        echo 'U kan geen extra bestellingen plaatsen!';
        $overzicht = $bestel->getbestelling();
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