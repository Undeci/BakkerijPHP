<?php
namespace Model\Business;
//alain.urlings
use Model\Business\KlantService;
use Model\Business\SecurityService;

class SecurityService {
    
    public function clean($array) {

        $acceptableposts = array("Registreer", "Aanmelden", "Bevestigen", "annuleer", "Bestel", "lopende bestellingen", "Aanpassen", "aanpassen", "afrekenen");

        if (!in_array(end($array), $acceptableposts))
            $clean = False;
        else {
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
                case "Aanpassen":
                    break;
                case "annuleer": $clean = cleanAnnuleer($clean);
                    break;
            }
        }

        if ($clean === False) {
            if (isset($_SESSION["klant"]["klantid"])) {
                $service = new KlantService();
                $service->blockklant($_SESSION["klant"]["klantid"]);
            }
            header('location: View/Block.php');
            exit(0);
        } else
            return $clean;
    }
}

function cleanXS($array) {

    foreach ($array as $key => $value) {
        if (preg_match("/<script>/i", $value) || strlen($value) > 40) {
            $clean = False;
            break;
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
    if (!in_array(False, filter_var_array($clean, $filter)))
        $clean = array_replace($clean, filter_var_array($clean, $filter));
    else
        $clean = false;

    return $clean;
}

function cleanBevestigen($clean) {

    if (!in_array($clean["afhaaldatum"], $_SESSION["vrijedata"]))
        $clean = False;

    return $clean;
}

function cleanAanmelden($clean) {

    if (filter_var($clean["email"], FILTER_VALIDATE_EMAIL)) {
        $clean["email"] = filter_var($clean["email"], FILTER_VALIDATE_EMAIL);
    } else
        $clean = False;

    return $clean;
}

function cleanBestel($clean) {

    for ($i = 1; $i < count($clean); $i++) {
        $clean[$i] = filter_var((int) $clean[$i], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 99)));
        if ($clean[$i] === False) {
            $clean = False;
            break;
        }
    }

    return $clean;
}

function cleanAnnuleer($clean) {

    if (!in_array($clean["annuleer"], $_SESSION["afhaaldata"]))
        $clean = False;

    return $clean;
}
