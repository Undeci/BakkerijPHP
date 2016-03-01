<?php

namespace Model\Business;

require_once 'Model/Business/KlantService.php';

use Model\Business\KlantService;

class SecurityService {

    public function clean($array) {

        $array = cleanXS($array);
        switch (end($array)) {
            case "Registreer": $clean = cleanRegistreer($array);
                break;
            case "Bevestigen": $clean = cleanBevestigen($array);
                break;
            case "Aanmelden": $clean = cleanAanmelden($array);
                break;
            case "Bestel": $clean = cleanBestel($array);
                break;
            case "Aanpassen": $clean = cleanWachtwoord($array);
                break;
        }
    }

      public function cleanXS($array) {

            foreach ($array as $key => $value) {
                if (preg_match("/<script>/i", $value)) {
                    if (isset($_SESSION["klant"]["klantid"])) {
                        $service = new KlantService();
                        $service->blockklant($_SESSION["klant"]["klantid"]);
                    }
                    header('location: Presentation/Block.php');
                    exit(0);
                } else {
                    $clean[$key] = $value;
                }
            }
            return $clean;
        }

        public function cleanRegistreer($array) {

            include_once 'test.php';
            exit();

//        $array[]
        }

        function cleanBevestigen($array) {
            
        }

        function cleanAanmelden($array) {
            
        }

        function cleanBestel($array) {
            
        }

        function cleanAanpassen($array) {
            
        }

        
    }
    return $clean;

}
