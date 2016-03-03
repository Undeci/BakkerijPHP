<?php
require 'Autoloader.php';
session_start();
use Model\Business\SecurityService;
use Model\Business\BestelService;

if (isset($_POST["bestelling"])) {
    $service = new BestelService();
    $service->maakbestelling();
    if ($_SESSION["bestelling"]["totaal"] > 0) {
        include_once 'View/header.php';
        include 'View/winkelmandje.php';
        include 'View/winkelmandform.php';
    } else {        
        include_once 'View/header.php';
        echo '<p class="alert">Je kan geen lege bestelling plaatsen!</p>';
        include 'View/toonbank.php';
    }
}
if (isset($_POST["afrekenen"])) {
    $bestel = new BestelService();
    $bestel->getafhaaldata();
    include_once 'View/header.php';
    include_once 'View/Afrekenen.php';
}
if (isset($_POST["aanpassen"])) {
    $aanpas = true;
    include_once 'View/header.php';
    include_once 'View/toonbank.php';
}
if (isset($_POST["bevestigen"])) {
    $bestel = new BestelService();
    $bestel->bestel();
    $bestel = new BestelService();
    $bestel->getafhaaldata();
    $overzicht = $bestel->getbestelling();
    include_once 'View/header.php';
    include_once 'View/lopendebestelling.php';
}
if (isset($_POST["lopende"])) {
    $bestel = new BestelService();
    $bestel->getafhaaldata();
    $overzicht = $bestel->getbestelling();
    include_once 'View/header.php';
    include_once 'View/lopendebestelling.php';
}
if (isset($_POST["annuleer"])) {
    $bestel = new BestelService();
    $bestel->annuleer($_POST["annuleer"]);    
    $bestel->getafhaaldata();
    $overzicht = $bestel->getbestelling();
    include_once 'View/header.php';
    echo '<p class="alert">Bestelling van ' . htmlentities($_POST["annuleer"]) . ' geannuleerd</p>';
    include_once 'View/lopendebestelling.php';
}
