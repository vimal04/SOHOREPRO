<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_add.php,v 1.11 2009/03/11 04:42:57 tredman Exp $
 */

require_once("include/config.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/session.class.php");

$tmp = array();

if ($_REQUEST["edit"] != "") {
	$edit = intval($_REQUEST["edit"]);
} else {
	$edit = -1;
}

$tmp["svc"] = $_REQUEST["svc"];
$tmp["deliver_by"] = $_REQUEST["deliver_by"];
$tmp["instructions"] = $_REQUEST["instructions"];
$tmp["reference"]	 = $_REQUEST["refnumber"];

for ($i = 0; $i < count($_REQUEST["originals"]); $i++) {
	if (intval($_REQUEST["originals"][$i]) > 0) {
		$tmp["delivery"][$i] = $_REQUEST["delivery"][$i];
		$tmp["originals"][$i] = $_REQUEST["originals"][$i];
		$tmp["duplicates"][$i] = $_REQUEST["duplicates"][$i];
		$tmp["sizes"][$i] = $_REQUEST["sizes"][$i];
		$tmp["ftpurl"][$i] = $_REQUEST["ftpurl"][$i];
	}
}

$fields = array("binding");

foreach ($fields as $f) {
	if (is_array($_REQUEST[$f])) {
		foreach ($_REQUEST[$f] as $rf) {
			$tmp[$f][] = $rf;
		}
	}
}

$fields = array("color", "duplex", "paper_color", "format", "laminate", "mounting", "paper", "media", "scandpi", "scantype", "source");
$class = array("Color", "Duplex", "Paper_Color", "Format", "Laminate", "Mounting", "Paper", "Media", "Scandpi", "Scantype", "Source");

for ($i = 0; $i < count($fields); $i++) {
	if ($_REQUEST[$fields[$i]] != "") {
		$tmp[$fields[$i]] = $_REQUEST[$fields[$i]];
	}
}

$addresses = array();

for ($i = 0; $i < count($_REQUEST["shipto_company"]); $i++) {
	$fields = array("company", "attention", "address1", "address2", "city", "state", "zip", "phone_ac", "phone_pr", "phone_su", "phone_ex");
	foreach ($fields as $f) {
		if ($_REQUEST["shipto_" . $f][$i] != "") {
			$tmp["shipto_" . $f][$i] = $_REQUEST["shipto_" . $f][$i];
		}
	}
	$fields = array();
	for ($j = 0; $j < count($_REQUEST["sizes"]); $j++) {
		if ($_REQUEST["shipto_copies_" . $j][$i] != "") {
			$tmp["shipto_copies_" . $j][$i] = $_REQUEST["shipto_copies_" . $j][$i];
		}
	}
	$tmp["shipto_phone"][$i] = sprintf(
		"%03d%03d%04d%06d",
		intval($_REQUEST["phone_ac"]),
		intval($_REQUEST["phone_pr"]),
		intval($_REQUEST["phone_su"]),
		intval($_REQUEST["phone_ex"])
	);
}

$tmp["earliest_asap"] = $_REQUEST["earliest_asap"];
$tmp["earliest_year"] = $_REQUEST["earliest_year"];
$tmp["earliest_month"] = $_REQUEST["earliest_month"];
$tmp["earliest_day"] = $_REQUEST["earliest_day"];
$tmp["earliest_time"] = $_REQUEST["earliest_time"];
$tmp["latest_time"] = $_REQUEST["latest_time"];
$tmp["call_ahead"] = $_REQUEST["call_ahead"];
$tmp["phone_number"] = sprintf(
	"%03d%03d%04d%06d",
	intval($_REQUEST["phone_number_ac"]),
	intval($_REQUEST["phone_number_pr"]),
	intval($_REQUEST["phone_number_su"]),
	intval($_REQUEST["phone_number_ex"])
);

if (!is_array($_REQUEST["attachment"])) $_REQUEST["attachment"] = array();
foreach ($_REQUEST["attachment"] as $k => $v) {
	$tmp["attachment"][$k] = $_REQUEST["attachment"][$k];
	$tmp["original"][$k] = $_REQUEST["original"][$k];
}

/*
$dir = opendir($_SERVER["DOCUMENT_ROOT"]. "/uploads");
$attachment = "";
while (($file = readdir($dir)) !== false) {
	if (substr($file, 0, 10) == sprintf("WEB-%06d", $order->id)) {
		$msg .= sprintf("\nYou also sent us your original in digital format.  You can find it online on our site here:\n");
		$msg .= sprintf("http://%s/uploads/%s\n\n", $_SERVER["SERVER_NAME"], $file);
	}
}
*/

if ($edit >= 0) {
	$_SESSION["cart"][$edit] = $tmp;
} else {
	$_SESSION["cart"][] = $tmp;
}
header("Location: view_cart.php");
?>