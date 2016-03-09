<!--alain.urlings-->
<?php
use Model\Business\KlantService;

function myErrorHandler() {

//    log $errno,$errstr,$errfile,$errline,$errcontext

    if (isset($_SESSION["klant"]["klantid"])) {
        $service = new KlantService();
        $service->blockklant($_SESSION["klant"]["klantid"]);
    }
//    else log IP
    
    header('location: View/Block.php');
    exit(0);
}

set_error_handler("myErrorHandler");
