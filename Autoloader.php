<?php



function mijnautoloader($klasNaam) {
//	$klasNaamOnderdelen = explode('\\', $klasNaam);
//	$laatsteDeel = end($klasNaamOnderdelen);
	$volledigeKlasNaam = $klasNaam . ".php";
	require_once($volledigeKlasNaam);
}

spl_autoload_register("mijnautoloader");

