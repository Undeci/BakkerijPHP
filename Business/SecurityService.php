<?php

namespace Business;

//require_once 'Business/KlantService.php';

use Business\KlantService;

class SecurityService {

    public function clean($array) {

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

}
