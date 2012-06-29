<?php

/*!
 * proxy-mod for shim v0.1
 *
 * Copyright (c) 2012 Dave Olsen, http://dmolsen.com
 * Licensed under the MIT license
 *
 * This is very much a quick hack. Please do not judge me 
 * based on this craptastic, non-error checking, insecure bit of code.
 *
 */

// standard vars
$l = $b = $c = "";
$posted = false;
$lArray = array("200","400","600","800","1000");                         // in milliseconds
$bArray = array("edge"=>"59","3g"=>"1706","4g"=>"12500","lte"=>"21625"); // in kilobytes per second
$fName  = "proxy-mods.sh";
$config = file_get_contents($fName);

// logic
if (isset($_POST["submit"])) {
	if (isset($_POST["latency"]) && in_array($_POST["latency"],$lArray)) {
		$l = "delay ".$_POST["latency"]."ms ";
	}
	if (isset($_POST["network"]) && array_key_exists($_POST["network"],$bArray)) {
		$b = "bw ".$bArray[$_POST["network"]]."KByte/s ";
	}
	if (($l != "") || ($b != "")) {
		$c = "sudo ipfw add 02000 pipe 1 out via en1\n";
		$c .= "sudo ipfw pipe 1 config ".$l.$b;
	}
	file_put_contents($fName,$c);
	if (!shell_exec("sudo ../configure_proxy.sh")) {
		print "didn't run shell command";
	}
	$posted = true;
	include("views/config.inc.php");
} else {
	// read in the current config
	include("views/config.inc.php");
}

?>