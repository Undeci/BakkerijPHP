<?php

namespace Data;

use PDO;

class KlantenDAO {
    
    
    public function getcities() {
        
        $sql = "select * from cities";
        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);        
	$stmt->execute();  
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultset;
        
    }
    
    public function setklant($adres, $email, $familienaam, $voornaam, $postcodeid, $wachtwoord) {
        
        $sql = "insert into klanten (adres, email, familienaam, voornaam, postcodeid, wachtwoord) values (:adres, :email, :familienaam, :voornaam, :postcodeid, :wachtwoord ) ";
        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':adres' => $adres, ':email' => $email, ':familienaam' => $familienaam, ':voornaam' => $voornaam, ':postcodeid' => $postcodeid, ':wachtwoord' => $wachtwoord));
        
    }
    
    public function blockklant($klantid) {
        
        $sql = "update klanten set block = 1 where klantid = :klantid";
        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid));
        
    }
    public function updatewachtwoord($nieuwwachtwoord, $email) {
        
       
        $sql = "update klanten set wachtwoord = ? where email = ?";
        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($nieuwwachtwoord, $email));
        
    }
    
   public function verifieerklant($email, $wachtwoord) {
       
       $sql = "select klantid, voornaam, block from klanten where email = :email and wachtwoord = :wachtwoord";
       $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
       $stmt = $dbh->prepare($sql);
       $stmt->execute(array(':email' => $email, ':wachtwoord' => $wachtwoord));
       $klant = $stmt->fetch(PDO::FETCH_ASSOC);
       
       return $klant;
   }
    
}