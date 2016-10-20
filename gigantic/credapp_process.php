<?php
/*
 * (c) 2009 Gigantic, Inc., All Rights Reserved
 * $Id: credapp_process.php,v 1.2 2009-11-08 07:27:41 tredman Exp $
 */

require_once("include/credapp_fields.inc.php");

$msg = sprintf("The following application for credit was sent at %s on %s.\n", date("g:i A T"), date("l, F jS, Y"));
$readlist = array();

foreach ($field_list as $fl) {
	foreach ($fl as $td) {
		switch ($td[TYPE]) {
			case "heading" :
				$msg .= sprintf("\n[%s]\n", strtoupper($td[LABEL]));
				break;
			case "subheading" :
				break;
			case "text" :
				$msg .= sprintf("%s: %s\n", strtoupper($td[LABEL]), $_POST["ca-" . $td[NAME]]);
				break;
			case "checkbox" :
			case "radio" :
				if (!in_array($td[NAME], $readlist)) {
					$readlist[] = $td[NAME];
					$val = $$td[NAME];
					$msg .= sprintf("%s: %s\n", strtoupper($td[NAME]), $val[$_POST["ca-" . $td[NAME]]]);
				}
				break;
		}
	}
}

$msg .= sprintf("Submitted by: %s\n", $_POST["ca-submitted-by"]);

mail("babi <ayanpal@gmail.com>", "Soho Reprographics Credit Application", $msg, "From: Soho Reprographics Web Site <Harvey@sohorepro.com>");
//mail("Harvey <Harvey@sohorepro.com>", "Soho Reprographics Credit Application", $msg, "From: Soho Reprographics Web Site <Harvey@sohorepro.com>");
header("Location: credapp_confirm.php");
?>