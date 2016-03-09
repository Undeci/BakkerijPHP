<?php
namespace Model\Data;
//alain.urlings
require_once 'DBConfig.php';

use DBConfig;
use PDO;

class KlantenDAO {
        
    public function getcities() {
        
        $sql = "select * from cities";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);        
	$stmt->execute();  
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbh = null;
        
        return $resultset;        
    }
    
    public function setklant($adres, $email, $familienaam, $voornaam, $postcodeid, $wachtwoord) {
        $sql2 ="select email from klanten where email = :email";        
        $sql = "insert into klanten (adres, email, familienaam, voornaam, postcodeid, wachtwoord) values (:adres, :email, :familienaam, :voornaam, :postcodeid, :wachtwoord ) ";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
       
        $stmt2 = $dbh->prepare($sql2);
        $stmt2->execute(array(':email' => $email));
        $resultset = $stmt2->fetch();
        
        $nieuweklant = false;
        if (empty($resultset)) {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':adres' => $adres, ':email' => $email, ':familienaam' => $familienaam, ':voornaam' => $voornaam, ':postcodeid' => $postcodeid, ':wachtwoord' => $wachtwoord));
        $nieuweklant = true;
        }
        
        $dbh = null;
        
        return $nieuweklant;
    }
    
    public function blockklant($klantid) {
        
        $sql = "update klanten set block = 1 where klantid = :klantid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid));
        $dbh = null;
    }
    public function updatewachtwoord($nieuwwachtwoord, $email) {
             
        $sql = "update klanten set wachtwoord = ? where email = ?";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($nieuwwachtwoord, $email));
        $dbh = null;
    }
    
   public function verifieerklant($email, $wachtwoord) {
       
       $sql = "select klantid, voornaam, block from klanten where email = :email and wachtwoord = :wachtwoord";
       $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
       $stmt = $dbh->prepare($sql);
       $stmt->execute(array(':email' => $email, ':wachtwoord' => $wachtwoord));
       $klant = $stmt->fetch(PDO::FETCH_ASSOC);
       $dbh = null;
       
       return $klant;
   }
    
}