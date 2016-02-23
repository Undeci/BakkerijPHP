<?php

namespace Business;

//require_once 'Data/BestelDAO.php';

use Data\BestelDAO;

class BestelService {
    
    
    public function bestel($klantid, $afhaaldatum, $bestelling) {
        
        $besteldao = new BestelDAO();
        $besteldao->bestel($klantid, $afhaaldatum, $bestelling);
        
    }
    
    public function getafhaaldatabyklantid($klantid) {
        
        $besteldao = new BestelDAO();
        $afhaaldata = $besteldao->getafhaaldatabyklantid($klantid);
        
        return $afhaaldata;
    }
    public function getbestelling($klantid) {
        
        $besteldao = new BestelDAO();
        $bestelling = $besteldao->getbestelling($klantid);
        
        return $bestelling;
        
    }
    public function annuleer($afhaaldatum) {
        
        $besteldao = new BestelDAO();
        $besteldao->annuleer($afhaaldatum);
    }
}