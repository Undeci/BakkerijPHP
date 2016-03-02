<?php

namespace Model\Business;

require_once 'Model/Business/KlantService.php';

use Model\Business\KlantService;
use Model\Business\SecurityService;

class SecurityService {

    public function clean($array) {

        $clean = cleanXS($array);
        switch (end($clean)) {
            case "Registreer": $clean = cleanRegistreer($clean);
                break;
            case "Bevestigen": $clean = cleanBevestigen($clean);
                break;
            case "Aanmelden": $clean = cleanAanmelden($clean);
                break;
            case "Bestel": $clean = cleanBestel($clean);
                break;
            case "Aanpassen": $clean = cleanWachtwoord($clean);
                break;
        }

        return $clean;
    }
}

function cleanXS($array) {

    foreach ($array as $key => $value) {
        if (preg_match("/<script>/i", $value)) {
            if (isset($_SESSION["klant"]["klantid"])) {
                $service = new KlantService();
                $service->blockklant($_SESSION["klant"]["klantid"]);
            }
            header('location: View/Block.php');
            exit(0);
        } else {
            $clean[$key] = $value;
        }
    }
    return $clean;
}

function cleanRegistreer($clean) {

    
    
    
    $filter = array(
        'email' => FILTER_VALIDATE_EMAIL,
        'postcodeid' => array('filter' => FILTER_VALIDATE_INT,
            'options' => array('min_range' => 1,
                'max_range' => 2904)
        ),
    );
    if (in_array(False, filter_var_array($clean, $filter))) {
        header('location: View/Block.php');
        exit(0);
    }
    $clean = array_replace($clean, filter_var_array($clean, $filter));

    return $clean;
}

function cleanBevestigen($clean) {

    return $clean;
}

function cleanAanmelden($clean) {
    
    $clea["email"] = filter_var($clean["email"], FILTER_VALIDATE_EMAIL);
    

    return $clean;
}

function cleanBestel($clean) {

    return $clean;
}

function cleanAanpassen($clean) {

    return $clean;
}
