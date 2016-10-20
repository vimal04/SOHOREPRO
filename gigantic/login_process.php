<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: login_process.php,v 1.9 2008/07/11 00:54:53 tredman Exp $
 */

require_once("include/config.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/order_master.class.php");

$username = $_POST["email"];
$password = $_POST["passwd"];

//var_dump($_REQUEST);

$user = new User(0, $username);
if ($user->id > 0 && $user->check_password($password) && $user->status) {
	$_SESSION["USER"] = $user->id;
	$_SESSION["VSTATUS"] = 1;
} else {
	unset($_SESSION["USER"]);
	$_SESSION["VSTATUS"] = 0;
}

if ($_SESSION["REFER"] != "") {
	header("Location: " . $_SESSION["REFER"]);
} else {
	header("Location: index.php");
}
?>