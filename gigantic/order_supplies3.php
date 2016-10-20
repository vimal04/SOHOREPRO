<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_supplies3.php,v 1.10 2009/03/06 19:04:20 tredman Exp $
 */

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/session.class.php");

$_SESSION["scart_meta"]["reference"] = $_REQUEST["reference"];
$_SESSION["scart_meta"]["deliver_by"] = $_REQUEST["deliver_by"];
$_SESSION["scart_meta"]["instructions"] = $_REQUEST["instructions"];

$fields = array("company", "attention", "address1", "address2", "city", "state", "zip", "phone_ac", "phone_pr", "phone_su", "phone_ex");

foreach ($fields as $f) {
	if ($_REQUEST["shipto_" . $f] != "") {
		$_SESSION["scart_meta"]["shipto_" . $f] = $_REQUEST["shipto_" . $f];
	}
}

$_SESSION["scart_meta"]["shipto_phone"] = sprintf(
	"%03d%03d%04d%06",
	$_REQUEST["shipto_phone_ac"],
	$_REQUEST["shipto_phone_pr"],
	$_REQUEST["shipto_phone_su"],
	$_REQUEST["shipto_phone_ex"]
);

header("Location: view_cart.php");
?>
