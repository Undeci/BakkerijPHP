<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require 'Autoloader.php';
//require_once 'Business/BestelService.php';
//require_once 'Business/SecurityService.php';
//require_once 'debugger.php';

use Business\SecurityService;
use Business\BestelService;



if (isset($_POST["bestelling"])) {

    $security = new SecurityService();
    $clean = $security->clean($_POST);
    
    for ($i = 1; $i < 7; $i++)
        $_SESSION["bestelling"][$i] = $clean["$i"];

    $_SESSION["bestelling"]["totaal"] = 2.5 * $_SESSION["bestelling"]["1"] + 2 * $_SESSION["bestelling"]["2"] + $_SESSION["bestelling"]["3"] + $_SESSION["bestelling"]["4"] + 1.2 * $_SESSION["bestelling"]["5"] + 1.2 * $_SESSION["bestelling"]["6"];

    include 'Presentation/winkelmandje.php';
    include 'Presentation/winkelmandform.php';
    include 'Presentation/Home.html';
}

if (isset($_POST["afrekenen"])) {
    
    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);

    include_once 'Presentation/winkelmandje.php';
//    include_once 'Presentation/winkelmandform.php';
    include_once 'Presentation/Afrekenen.php';
    include 'Presentation/Home.html';
}

if (isset($_POST["aanpassen"])) {

    include_once 'Presentation/toonbank.php';
    include 'Presentation/Home.html';
}

if (isset($_POST["bevestigen"])) {
    
    $security = new SecurityService();
    $clean = $security->clean($_POST);
    
    $bestel = new BestelService();
    $bestel->bestel($_SESSION["klant"]["klantid"], $clean["afhaaldatum"], $_SESSION["bestelling"]);  
    
    $afhaaldata = $bestel->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);
    
    $overzicht = $bestel->getbestelling($_SESSION["klant"]["klantid"]);
    
//    include_once 'Presentation/winkelmandje.php';
    include 'Presentation/Home.html';
    include_once 'Presentation/lopendebestelling.php';
    
}
if (isset($_POST["lopende"])) {
    $bestel = new BestelService();
    $afhaaldata = $bestel->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);   
    $overzicht = $bestel->getbestelling($_SESSION["klant"]["klantid"]);
    include_once 'Presentation/lopendebestelling.php';
    include_once 'Presentation/Home.html';
}

if (isset($_POST["annuleer"])) {
    
    $bestel = new BestelService();
    $bestel->annuleer($_POST["annuleer"]);
    
    echo 'Bestelling van ' . $_POST["annuleer"] . ' geannuleerd.';
    
    $afhaaldata = $bestel->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);
    
    $overzicht = $bestel->getbestelling($_SESSION["klant"]["klantid"]);
    include_once 'Presentation/lopendebestelling.php';
    include 'Presentation/Home.html';
    
}
