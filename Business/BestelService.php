<?php

namespace Business;

//require_once 'Data/BestelDAO.php';

use Data\BestelDAO;
use Business\SecurityService;

class BestelService {

    public function maakbestelling() {

        $security = new SecurityService();
        $clean = $security->clean($_POST);

        
        
        
        
        for ($i = 1; $i < 7; $i++)
            $_SESSION["bestelling"][$i] = $clean["$i"];

        $_SESSION["bestelling"]["totaal"] = 2.5 * $_SESSION["bestelling"]["1"] + 2 * $_SESSION["bestelling"]["2"] + $_SESSION["bestelling"]["3"] + $_SESSION["bestelling"]["4"] + 1.2 * $_SESSION["bestelling"]["5"] + 1.2 * $_SESSION["bestelling"]["6"];
    }

    public function bestel($array) {

        $security = new SecurityService();
        $clean = $security->clean($array);

        $besteldao = new BestelDAO();
        $besteldao->bestel($_SESSION["klant"]["klantid"], $clean["afhaaldatum"], $_SESSION["bestelling"]);
    }

    public function getafhaaldata() {

        $bestelDAO = new BestelDAO();
        $afhaal = $bestelDAO->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);

        $afhaaldata["afhaal"] = $afhaal;

        $tomorrow = date("Y-m-d", strtotime("tomorrow"));
        $tomorrowplusone = date("Y-m-d", strtotime("+2 Days"));
        $maxafhaal = date("Y-m-d", strtotime("+3 Days"));

        $afhaaldata["vrijedata"] = array_diff(array($tomorrow, $tomorrowplusone, $maxafhaal), $afhaaldata["afhaal"]);

        return $afhaaldata;
    }

    public function getbestelling() {

        $besteldao = new BestelDAO();
        $bestelling = $besteldao->getbestelling($_SESSION["klant"]["klantid"]);

        return $bestelling;
    }

    public function annuleer($afhaaldatum) {

        $besteldao = new BestelDAO();
        $besteldao->annuleer($afhaaldatum);
    }

}
