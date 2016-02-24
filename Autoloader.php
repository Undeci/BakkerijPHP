<?php



function mijnautoloader($klasNaam) {
	$volledigeKlasNaam = $klasNaam . ".php";
	require_once($volledigeKlasNaam);
}

spl_autoload_register("mijnautoloader");

