<?php

namespace Model\Business;

use Model\Data\KlantenDAO;
use Model\Business\SecurityService;

class KlantService {

    public function getCities() {
        $klantDAO = new KlantenDAO();
        $gemeentes = $klantDAO->getcities();
        return $gemeentes;
    }

    public function setKlant() {

        $wachtwoord = "";
        $values = str_split("ABCDEFGHIJKLNOPQRSTUVWXYZ0123456789");
        for ($i = 0; $i < 6; $i++) {
            $wachtwoord = $wachtwoord . $values[array_rand($values, 1)];
            $wachtwoordsha1 = sha1($wachtwoord);
            $_SESSION["wachtwoord"] = $wachtwoord;
        }

        $security = new SecurityService();
        $clean = $security->clean($_POST);

        $klantDAO = new KlantenDAO();
        $nieuweklant = $klantDAO->setklant($clean["adres"], $clean["email"], $clean["naam"], $clean["voornaam"], $clean["postcodeid"], $wachtwoordsha1);

        setcookie("email", $clean["email"], time() + 3600 * 24 * 365);
        
        return $nieuweklant;
    }

    public function blockklant($klantid) {
        $klantDAO = new KlantenDAO();
        $klantDAO->blockklant($klantid);
    }

    public function verifieerklant($array) {

        $security = new SecurityService();
        $clean = $security->clean($_POST);
        $klantDAO = new KlantenDAO();
        $_SESSION["klant"] = $klantDAO->verifieerklant($clean["email"], sha1($clean["wachtwoord"]));
        setcookie("email", $clean["email"], time() + 3600 * 24 * 365);
    }

    public function updatewachtwoord($nieuwwachtwoord, $email) {
        $klantDAO = new KlantenDAO();
        $klantDAO->updatewachtwoord($nieuwwachtwoord, $email);
    }

}
