<?php
/*
 * (c) 2008 Gigantic, Inc., All Rights Reserved
 * $Id: update_cart.php,v 1.3 2008/09/26 04:06:55 tredman Exp $
 */

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/session.class.php");

if (isset($_REQUEST["del"])) {
	$del = intval($_REQUEST["del"]);
	$tmp = array();
	foreach ($_SESSION["cart"] as $k => $v) {
		if ($k != $del) {
			$tmp[] = $v;
		}
	}
	$_SESSION["cart"] = $tmp;
	header("Location: view_cart.php");
}

if (isset($_REQUEST["sdel"])) {
	$_SESSION["scart"] = array();
	$_SESSION["scart_meta"] = array();
	header("Location: view_cart.php");
}

if (isset($_REQUEST["clr"])) {
	$_SESSION["cart"] = array();
	$_SESSION["scart"] = array();
	$_SESSION["scart_meta"] = array();
	header("Location: view_cart.php");
}
