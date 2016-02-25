<?php

namespace Data;
require_once 'DBConfig.php';
use DBConfig;
use PDO;

class BestelDAO {
    
    public function getprodukten() {
        
        $sql = "select * from produkten";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $_SESSION["produkten"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
    }

    public function bestel($klantid, $afhaaldatum, $bestelling) {

        $bedrag = $bestelling["totaal"];

        $sql = "insert into bestelling (klantid, afhaaldatum, bedrag) values (:klantid, :afhaaldatum, :bedrag)";
        $sql2 = "insert into bestelregel (aantal, bestelnr, produktid) values (:aantal, :bestelnr, :produktid)";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid, ':afhaaldatum' => $afhaaldatum, ':bedrag' => $bedrag));
        $bestelnr = $dbh->lastInsertId();

        $stmt2 = $dbh->prepare($sql2);

         for ($i = 1; $i < count($bestelling); $i++) {
            if ($bestelling[$i] != 0)
                $stmt2->execute(array(':aantal' => $bestelling[$i], ':bestelnr' => $bestelnr, ':produktid' => $i));
        }

        $dbh = null;
    }

    public function getafhaaldatabyklantid($klantid) {

        $sql = "select afhaaldatum from bestelling where klantid = :klantid and afhaaldatum >= CURDATE() ";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid));
        $afhaaldata = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $dbh = null;

        return $afhaaldata;
    }

    public function getbestelling($klantid) {

        $sql = "select bestelnr, bedrag from bestelling where klantid = :klantid and afhaaldatum >= CURDATE()";
        $sql2 = "select naam, aantal from bestelregel inner join produkten on bestelregel.produktid = produkten.produktid where bestelnr = :bestelnr";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid));

        $stmt2 = $dbh->prepare($sql2);

        $bestelling = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $overzicht = array();

        foreach ($bestelling as $value) {
            $stmt2->execute(array(':bestelnr' => $value['bestelnr']));
            $overzicht[$value["bedrag"]] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }
        $dbh = null;

        return $overzicht;
    }
    
    public function annuleer($afhaaldatum) {
        
        $klantid = $_SESSION["klant"]["klantid"];
        $sql = "delete bestelling.*, bestelregel.* from bestelling inner join bestelregel on bestelling.bestelnr = bestelregel.bestelnr where (afhaaldatum = :afhaaldatum and klantid = :klantid)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':afhaaldatum' => $afhaaldatum, ':klantid' => $klantid));
        $dbh = null;
    }

}
