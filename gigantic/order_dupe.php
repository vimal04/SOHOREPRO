<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_dupe.php,v 1.7 2009-11-08 07:27:41 tredman Exp $
 */

$order_id = intval($_REQUEST["id"]);
if ($order_id == 0) {
	header("Location: index.php");
	die();
}

require_once("include/config.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order_master.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order_prop.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order_line.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/size.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/binding.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/delivery.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/format.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/laminate.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/mounting.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/paper.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/scandpi.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/scantype.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/source.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/address.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/delivery_count.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/service.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/schedule.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/media.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/duplex.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/paper_color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/store_product.class.php");

function file_gc()
{
	$dir = opendir($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads");
	while (($fh = readdir($dir)) !== false) {
		if (!preg_match("/^2/", $fh)) continue;
		$fhs = stat($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $fh);
		$current = mktime();
		if ($current - $fhs["ctime"] > 86400) {
			unlink($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $fh);
		}
	}
}

$tmp = array();

$order = new Order($order_id);
if ($order->id == 0) {
	header("Location: index.php");
	die();
}

if ($order->service_id > 0) {

	$tmp["svc"] = $order->service_id;
	$tmp["deliver_by"] = $order->deliver_by;
	$tmp["instructions"] = $order->instructions;
	$tmp["reference"] = $order->reference;

	foreach ($order->lines->items as $line) {
			$tmp["originals"][] = $line->originals;
			$tmp["duplicates"][] = $line->duplicates;
			$size = new Size($line->size_id);
			$tmp["sizes"][] = $size->code;
	}

	$class_names = array(
		"color" => "Color",
		"duplex" => "Duplex",
		"paper_color" => "Paper_Color",
		"format" => "Format",
		"laminate" => "Laminate",
		"mounting" => "Mounting",
		"paper" => "Paper",
		"media" => "Media",
		"scandpi" => "Scandpi",
		"scantype" => "Scantype",
		"source" => "Source"
	);

	foreach ($order->properties->items as $op) {
		if ($op->name == "binding") {
			$prop = new Binding($op->value);
			$tmp[$op->name][] = $prop->code;
		} else {
			$prop = new $class_names[$op->name]($op->value);
			$tmp[$op->name] = $prop->code;
		}
	}

	$fields = array("company", "attention", "address1", "address2", "city", "state", "zip", "phone");

	for ($i = 0; $i < count($order->addresses->items); $i++) {
		foreach ($fields as $f) {
			$tmp["shipto_" . $f][$i] = $order->addresses->items[$i]->$f;
		}
		for ($j = 0; $j < count($order->addresses->items[$i]->delivery_counts->items); $j++) {
			$tmp["shipto_copies_" . $j][$i] = $order->addresses->items[$i]->delivery_counts->items[$j]->copy_count;
		}
	}

	$schedules = new Schedules(0);
	$schedules->get_pickups_by_order($order->id);

	$_SESSION["cart"][] = $tmp;
	header("Location: order_form.php?svc=" . $order->service_id . "&edit=" . (count($_SESSION["cart"]) - 1));
	
} else {

	$_SESSION["scart"] = array();
	$_SESSION["scart_meta"] = array();

	foreach ($order->supplies->items as $s) {
		$tmp = array($s->product_id, $s->qty);
		$_SESSION["scart"][] = $tmp;
		$_SESSION["scart_meta"]["deliver_by"] = $order->deliver_by;
		$_SESSION["scart_meta"]["instructions"] = $order->instructions;
		$_SESSION["scart_meta"]["reference"] = $order->reference;
	
		$fields = array("company", "attention", "address1", "address2", "city", "state", "zip", "phone");

		for ($i = 0; $i < count($order->addresses->items); $i++) {
			foreach ($fields as $f) {
				$_SESSION["scart_meta"]["shipto_" . $f] = $order->addresses->items[$i]->$f;
			}
		}
	}

	header("Location: order_supplies.php");

}

?>