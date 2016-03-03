<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (session_status() != 1)
session_destroy();
session_start();
require 'Autoloader.php';

use Model\Business\BestelService;
use Model\Business\KlantService;

if (isset($_GET["wachtwoord"])) {    
    include_once 'View/header.php';
    echo '<p class="alert">Je wachtwoord is ' . $_SESSION["wachtwoord"] . '</p>';
    include_once 'View/wachtwoord.php';
}
if (isset($_POST["nieuwwachtwoord"])) {
    $service = new KlantService();
    $service->updatewachtwoord(sha1($_POST["nieuwwachtwoord"]), $_COOKIE["email"]);
}
if (isset($_POST["registreer"])) {
    $service = new KlantService();
    $nieuweklant = $service->setKlant();
    if ($nieuweklant)
        header("location: klantcontroller.php?wachtwoord");
    else {       
        $service = new KlantService();
        $postcodes = $service->getcities();
        include_once 'View/header.php';
         echo '<p class="alert">Reeds geregistreerd bij BakkerijPHP</p>';
        include_once 'View/Aanmelden.php';
    }
} elseif (isset($_POST["aanmelden"])) {
    $service = new KlantService();
    $service->verifieerklant($_POST);
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