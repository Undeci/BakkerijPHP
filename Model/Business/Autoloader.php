<!--alain.urlings-->
<?php
function mijnautoloadervdab($klasNaam) {
	$volledigeKlasNaam = $klasNaam . ".php";
	require_once($volledigeKlasNaam);
}

function mijnautoloaderthuis($klasNaam)
{
    $klasNaam = str_replace('\\', DIRECTORY_SEPARATOR, $klasNaam);

    include $klasNaam . '.php';
}

spl_autoload_register("mijnautoloadervdab");

