<?php

namespace Business;

//require_once 'Data/BestelDAO.php';

use Data\BestelDAO;
use Business\SecurityService;

class BestelService {

    public function getprodukten() {

        $bestelDAO = new BestelDAO();
        $produkten = $bestelDAO->getprodukten();
    }

    public function maakbestelling() {

        $security = new SecurityService();
        $clean = $security->clean($_POST);
        $_SESSION["bestelling"]["totaal"] = 0;

        for ($i = 1; $i < count($_SESSION["produkten"]) + 1; $i++) {
            $_SESSION["bestelling"][$i] = $clean["$i"];
            $_SESSION["bestelling"]["totaal"] += $_SESSION["bestelling"][$i] * $_SESSION["produkten"][$i - 1]["prijs"];
        }
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
