<?php

require 'Autoloader.php';
session_start();


use Business\SecurityService;
use Business\BestelService;

if (isset($_POST["bestelling"])) {    
    $service = new BestelService();
    $service->maakbestelling();
    include 'Presentation/winkelmandje.php';
    include 'Presentation/winkelmandform.php';
    include 'Presentation/Home.html';
}

if (isset($_POST["afrekenen"])) {    
    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldata();
    include_once 'Presentation/winkelmandje.php';
    include_once 'Presentation/Afrekenen.php';
    include 'Presentation/Home.html';
}

if (isset($_POST["aanpassen"])) {
    include_once 'Presentation/toonbank.php';
    include 'Presentation/Home.html';
}
if (isset($_POST["bevestigen"])) { 
    $bestel = new BestelService();
    $bestel->bestel();
    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldata();   
    $overzicht = $bestel->getbestelling();
    include 'Presentation/Home.html';
    include_once 'Presentation/lopendebestelling.php';   
}
if (isset($_POST["lopende"])) {
    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldata();   
    $overzicht = $bestel->getbestelling();
    include_once 'Presentation/lopendebestelling.php';
    include_once 'Presentation/Home.html';
}
if (isset($_POST["annuleer"])) {    
    $bestel = new BestelService();
    $bestel->annuleer($_POST["annuleer"]);    
    echo 'Bestelling van ' . htmlentities($_POST["annuleer"]) . ' geannuleerd.';    
    $afhaaldata = $bestel->getafhaaldata();    
    $overzicht = $bestel->getbestelling();
    include_once 'Presentation/lopendebestelling.php';
    include 'Presentation/Home.html';   
}
