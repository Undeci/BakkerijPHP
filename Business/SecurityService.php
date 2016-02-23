<?php

namespace Business;

//require_once 'Business/KlantService.php';

use Business\KlantService;

class SecurityService {

    public function clean($array) {

        foreach ($array as $key => $value) {
            if (in_array(">", str_split($value)) or in_array("<", str_split($value))) {
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
