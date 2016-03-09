<!--alain.urlings-->
<?php
require 'Model/Business/Errorhandler.php';
require 'Model/Business/Autoloader.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

if (session_status() != 1)
    session_destroy();
session_start();

use Model\Business\BestelService;
use Model\Business\KlantService;
use Model\Business\SecurityService;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $security = new SecurityService();
    $clean = $security->clean($_REQUEST);
}
if (isset($_GET["wachtwoord"])) {
    include_once 'View/header.php';
    echo '<p class="alert">Je wachtwoord is ' . $_SESSION["wachtwoord"] . '</p>';
    include_once 'View/wachtwoord.php';
}
if (isset($clean["nieuwwachtwoord"])) {

    $service = new KlantService();
    $service->updatewachtwoord(sha1($clean["nieuwwachtwoord"]), $_COOKIE["email"]);
}
if (isset($clean["registreer"])) {

    $service = new KlantService();
    $nieuweklant = $service->setKlant($clean);
    if ($nieuweklant)
        header("location: klantcontroller.php?wachtwoord");
    else {
        $service = new KlantService();
        $postcodes = $service->getcities();
        include_once 'View/header.php';
        echo '<p class="alert">Reeds geregistreerd bij BakkerijPHP</p>';
        include_once 'View/Aanmelden.php';
    }
} elseif (isset($clean["aanmelden"])) {

    $service = new KlantService();
    $service->verifieerklant($clean);
    $bestel = new BestelService();
    $bestel->getafhaaldata();
    if (count($_SESSION["vrijedata"]) == 0) {
        $overzicht = $bestel->getbestelling();
        include_once 'View/header.php';
        echo '<p class="alert">U kan geen extra bestellingen plaatsen!</p>';
        include_once 'View/lopendebestelling.php';
    } elseif ($_SESSION["klant"]["voornaam"] && $_SESSION["klant"]["block"] == 0) {
        $service = new BestelService();
        $service->getprodukten();
        $aanpas = false;
        include_once 'View/header.php';
        echo '<p class="alert">Welkom ' . htmlentities($_SESSION["klant"]["voornaam"]) . '</p>';
        include 'View/toonbank.php';
    } elseif (!$_SESSION["klant"]["voornaam"]) {
        $service = new KlantService();
        $postcodes = $service->getcities();
        include_once 'View/header.php';
        echo '<p class="alert">Fout bij het aanmelden</p>';
        include 'View/Aanmelden.php';
    } elseif ($_SESSION["klant"]["block"] == 1)
        include_once 'View/Block.php';
} else {
    $service = new KlantService();
    $postcodes = $service->getcities();
    include_once 'View/header.php';
    include 'View/Aanmelden.php';
}


    