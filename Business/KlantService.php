<?php
namespace Business;
//require_once 'C:/xampp/htdocs/Bakkerij/Data/KlantenDAO.php';

use Data\KlantenDAO;

class KlantService {
    
    public function getCities() {
        $klantDAO = new KlantenDAO();
        $gemeentes = $klantDAO->getcities();
        return $gemeentes;
    }
    
    public function setKlant($adres, $email, $familienaam, $voornaam, $postcodeid, $wachtwoord) {
        
       $klantDAO = new KlantenDAO();
       $klantDAO->setklant($adres, $email, $familienaam, $voornaam, $postcodeid, $wachtwoord);
              
    }
    
    public function blockklant($klantid) {
        $klantDAO = new KlantenDAO();
        $klantDAO->blockklant($klantid);
    }
    
    public function verifieerklant($email, $wachtwoord) {
        $klantDAO = new KlantenDAO();
        $klant = $klantDAO->verifieerklant($email, $wachtwoord);
        return $klant;
    }
    public function updatewachtwoord($nieuwwachtwoord, $email) {
        $klantDAO = new KlantenDAO();
        $klantDAO->updatewachtwoord($nieuwwachtwoord, $email);
    }
}