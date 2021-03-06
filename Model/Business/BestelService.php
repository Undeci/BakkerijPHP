<?php
namespace Model\Business;
//alain.urlings
use Model\Data\BestelDAO;
use Model\Business\SecurityService;

class BestelService {

    public function getprodukten() {

        $bestelDAO = new BestelDAO();
        $produkten = $bestelDAO->getprodukten();
    }

    public function maakbestelling($clean) {

        $_SESSION["bestelling"]["totaal"] = 0;

        for ($i = 1; $i < count($_SESSION["produkten"]) + 1; $i++) {
            $_SESSION["bestelling"][$i] = $clean["$i"];
            $_SESSION["bestelling"]["totaal"] += $_SESSION["bestelling"][$i] * $_SESSION["produkten"][$i - 1]["prijs"];
        }
    }

    public function bestel($clean) {

        $besteldao = new BestelDAO();
        $besteldao->bestel($_SESSION["klant"]["klantid"], $clean["afhaaldatum"], $_SESSION["bestelling"]);
    }

    public function getafhaaldata() {

        $bestelDAO = new BestelDAO();
        $bestelDAO->getafhaaldatabyklantid($_SESSION["klant"]["klantid"]);

        $tomorrow = date("Y-m-d", strtotime("tomorrow"));
        $tomorrowplusone = date("Y-m-d", strtotime("+2 Days"));
        $maxafhaal = date("Y-m-d", strtotime("+3 Days"));
        
        $_SESSION["vrijedata"] = array_diff(array($tomorrow, $tomorrowplusone, $maxafhaal), $_SESSION["afhaaldata"]);
    }

    public function getbestelling() {

        $besteldao = new BestelDAO();
        $bestelling = $besteldao->getbestelling($_SESSION["klant"]["klantid"]);

        return $bestelling;
    }

    public function annuleer($annul) {
      
        $besteldao = new BestelDAO();
        $besteldao->annuleer($annul);

    }
}
