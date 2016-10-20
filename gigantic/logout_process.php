<?php
/*
 * (c) 2007 Gigantic, Inc.,All Rights Reserved
 * $Id: logout_process.php,v 1.3 2008/09/25 00:37:43 tredman Exp $
 */

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");

$user = new User(intval($_SESSION["USER"]));
unset($_SESSION["USER"]);

if ($user->id > 0) {
	$_SESSION["STATUS"] = sprintf("%s has logged out.", $user->login_email);
	$_SESSION["VSTATUS"] = 0;
	unset($_SESSION["cart"]);
	unset($_SESSION["scart"]);
} else {
	$_SESSION["STATUS"] == "";
	$_SESSION["VSTATUS"] = 0;
	unset($_SESSION["cart"]);
	unset($_SESSION["scart"]);
}

header("Location: index.php");
?>
