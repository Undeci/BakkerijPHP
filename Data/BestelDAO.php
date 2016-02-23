<?php

namespace Data;
use PDO;

class BestelDAO {

    public function bestel($klantid, $afhaaldatum, $bestelling) {


        $bedrag = $bestelling["totaal"];

        $sql = "insert into bestelling (klantid, afhaaldatum, bedrag) values (:klantid, :afhaaldatum, :bedrag)";
        $sql2 = "insert into bestelregel (aantal, bestelnr, produktid) values (:aantal, :bestelnr, :produktid)";

        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid, ':afhaaldatum' => $afhaaldatum, ':bedrag' => $bedrag));
        $bestelnr = $dbh->lastInsertId();

        $stmt2 = $dbh->prepare($sql2);

        for ($i = 1; $i < 7; $i++) {
            if ($bestelling[$i] != 0)
                $stmt2->execute(array(':aantal' => $bestelling[$i], ':bestelnr' => $bestelnr, ':produktid' => $i));
        }
    }

    public function getafhaaldatabyklantid($klantid) {

        $sql = "select afhaaldatum from bestelling where klantid = :klantid and afhaaldatum >= CURDATE() ";
        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid));
        $afhaaldata = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $afhaaldata;
    }

    public function getbestelling($klantid) {

        $sql = "select bestelnr, bedrag from bestelling where klantid = :klantid and afhaaldatum >= CURDATE()";
        $sql2 = "select naam, aantal from bestelregel inner join produkten on bestelregel.produktid = produkten.produktid where bestelnr = :bestelnr";

        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klantid' => $klantid));

        $stmt2 = $dbh->prepare($sql2);

        $bestelling = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $overzicht = array();

        foreach ($bestelling as $value) {
            $stmt2->execute(array(':bestelnr' => $value['bestelnr']));
            $overzicht[$value["bedrag"]] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }

        return $overzicht;
    }
    
    public function annuleer($afhaaldatum) {
        
        $klantid = $_SESSION["klant"]["klantid"];
        $sql = "delete bestelling.*, bestelregel.* from bestelling inner join bestelregel on bestelling.bestelnr = bestelregel.bestelnr where (afhaaldatum = :afhaaldatum and klantid = :klantid)";
        $dbh = new PDO("mysql:host=localhost;dbname=bakkerij;charset=utf8", "root", "");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':afhaaldatum' => $afhaaldatum, ':klantid' => $klantid));
    }

}
