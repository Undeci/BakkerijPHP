<!--alain.urlings-->
<?php
require 'Model/Business/Errorhandler.php';
require 'Model/Business/Autoloader.php';
session_start();
use Model\Business\SecurityService;
use Model\Business\BestelService;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
     $security = new SecurityService();
     $clean = $security->clean($_POST);
}
if (isset($clean["bestelling"])) {
    $service = new BestelService();
    $service->maakbestelling($clean);
    if ($_SESSION["bestelling"]["totaal"] > 0) {
        include_once 'View/header.php';
        include 'View/winkelmandje.php';
        include 'View/winkelmandform.php';
    } else {    
        $aanpas = false;
        include_once 'View/header.php';
        echo '<p class="alert">Je kan geen lege bestelling plaatsen!</p>';
        include 'View/toonbank.php';
    }
}
if (isset($clean["afrekenen"])) {    
    $bestel = new BestelService();
    $bestel->getafhaaldata();   
    include_once 'View/header.php';
    include_once 'View/Afrekenen.php';
}
if (isset($clean["aanpassen"])) {
    $aanpas = true;
    include_once 'View/header.php';
    include_once 'View/toonbank.php';
}
if (isset($clean["bevestigen"])) {
    $bestel = new BestelService();
    $bestel->bestel($clean);
    $bestel = new BestelService();
    $bestel->getafhaaldata();
    $overzicht = $bestel->getbestelling();
    include_once 'View/header.php';
    include_once 'View/lopendebestelling.php';
}
if (isset($clean["lopende"])) {
    
    $bestel = new BestelService();
    $bestel->getafhaaldata();
    $bestel = new BestelService();
    $overzicht = $bestel->getbestelling();
    include_once 'View/header.php';
    include_once 'View/lopendebestelling.php';
}
if (isset($clean["annuleer"])) {   
    $bestel = new BestelService();
    $bestel->annuleer($clean["annuleer"]);    
    $bestel->getafhaaldata();
    $overzicht = $bestel->getbestelling();
    include_once 'View/header.php';
    echo '<p class="alert">Bestelling van ' . htmlentities($clean["annuleer"]) . ' geannuleerd</p>';
    include_once 'View/lopendebestelling.php';
}
