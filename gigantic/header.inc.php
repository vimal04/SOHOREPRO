<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: header.inc.php,v 1.13 2009-11-08 07:27:41 tredman Exp $
 */
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/pqp.php");

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user_status.class.php");

$user = new User(intval($_SESSION["USER"]));
$logged_in = $user->id > 0 ? true : false;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SoHo Reprographics - Plotting, Architectural Copies, Copy Shop, Offset, Scanning - New York City</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="js/mm.js"></script>
<script type="text/javascript" src="js/check_fields.js"></script>
<script type="text/javascript" src="js/clearField.js"></script>
<script type="text/javascript" src="js/deladdr.js"></script>
<script type="text/javascript" src="js/tableutil.js"></script>
<link href="css/soho.css" rel="stylesheet" type="text/css">
<style>
BODY { background-repeat: repeat-x; background-image: url(images/bkg<?php echo(basename($_SERVER["PHP_SELF"]) == "index.php" || basename($_SERVER["PHP_SELF"]) == "service_select.php" || basename($_SERVER["PHP_SELF"]) == "pwsend.php" || basename($_SERVER["PHP_SELF"]) == "change_process.php" || basename($_SERVER["PHP_SELF"]) == "view_cart.php" || basename($_SERVER["PHP_SELF"]) == "credapp.php" || basename($_SERVER["PHP_SELF"]) == "credapp_confirm.php" ? "" : "2"); ?>.jpg); }
</style>
</head>
<body>
<div id="all">
	<div id="logo">
		<a href="index.php"><img src="images/spacer.gif" alt="Home" width="172" height="122" border="0"></a>
	</div>
	<div id="topImage"></div>
	<div id="topNav">
		<span class="style6">
			<a href="about.php">About Us</a>&nbsp; | &nbsp;
			<a href="order_supplies.php">Order Supplies</a>&nbsp; | &nbsp;
			<a href="locations.php">Locations</a>&nbsp; | &nbsp;
			<a href="downloads.php">Downloads</a>&nbsp; | &nbsp;
			<a href="contact.php">Contact Us</a>
		</span>
	</div>
	<div id="loginStatus">
		<div id="loginStatusText" align="right">
<?php
$user_status = new User_Status($user->id);
printf("%s", $user_status->status_message);
?>
		</div>
	</div>
	<div id="middleNav">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="950">
			<tr>
				<td><a href="services.php?svc=1" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('plotting_but','','images/plotting_but_f2.jpg',1);"><img name="plotting_but" src="images/plotting_but<?php if ($_REQUEST["svc"] == '1') echo '_f2';?>.jpg" width="84" height="28" border="0" alt=""></a></td>
				<td><a href="services.php?svc=2" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('arch_copies_but','','images/arch_copies_but_f2.jpg',1);"><img name="arch_copies_but" src="images/arch_copies_but<?php if ($_REQUEST["svc"] == '2') echo '_f2';?>.jpg" width="142" height="28" border="0" alt=""></a></td>
				<td><a href="services.php?svc=3" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('signs_but','','images/signs_but_f2.jpg',1);"><img name="signs_but" src="images/signs_but<?php if ($_REQUEST["svc"] == '3') echo '_f2';?>.jpg" width="118" height="28" border="0" alt=""></a></td>
				<td><a href="services.php?svc=4" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('offset_but','','images/offset_but_f2.jpg',1);"><img name="offset_but" src="images/offset_but<?php if ($_REQUEST["svc"] == '4') echo '_f2';?>.jpg" width="118" height="28" border="0" alt=""></a></td>
				<td><a href="services.php?svc=5" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('copy_shop_but','','images/copy_shop_but_f2.jpg',1);"><img name="copy_shop_but" src="images/copy_shop_but<?php if ($_REQUEST["svc"] == '5') echo '_f2';?>.jpg" width="94" height="28" border="0" alt=""></a></td>
				<td><a href="services.php?svc=6" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('scanning_but','','images/scanning_but_f2.jpg',1);"><img name="scanning_but" src="images/scanning_but<?php if ($_REQUEST["svc"] == '6') echo '_f2';?>.jpg" width="94" height="28" border="0" alt=""></a></td>
				<td><a href="services.php?svc=7" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('mounting_but','','images/mounting_but_f2.jpg',1);"><img name="mounting_but" src="images/mounting_but<?php if ($_REQUEST["svc"] == '7') echo '_f2';?>.jpg" width="162" height="28" border="0" alt=""></a></td>
				<td><a href="planroom.php"	 onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('dig_plan_but','','images/dig_plan_but_f2.jpg',1);"><img name="dig_plan_but" src="images/dig_plan_but<?php if ($_SERVER['PHP_SELF']=='/planroom.php') echo '_f2'; ?>.jpg" width="138" height="28" border="0" alt=""></a></td>
			</tr>
		</table>
	</div>
	<div id="leftNav<?php echo(basename($_SERVER["PHP_SELF"]) == "index.php" || basename($_SERVER["PHP_SELF"]) == "service_select.php" || basename($_SERVER["PHP_SELF"]) == "pwsend.php" || basename($_SERVER["PHP_SELF"]) == "change_process.php" || basename($_SERVER["PHP_SELF"]) == "view_cart.php" || basename($_SERVER["PHP_SELF"]) == "credapp.php" || basename($_SERVER["PHP_SELF"]) == "credapp_confirm.php" ? "Home" : ""); ?>">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="172">

			<tr><td><a href="upload.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('upload_tab','','images/upload_tab_f2.jpg',1);"><img name="upload_tab" src="images/upload_tab.jpg" width="172" height="66" border="0" alt=""></a></td></tr>
			<tr><td><a href="order_supplies.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('order_tab','','images/order_tab_f2.jpg',1);"><img name="order_tab" src="images/order_tab.jpg" width="172" height="66" border="0" alt=""></a></td></tr>
		</table>
	</div>
	<?php //var_dump(basename($_SERVER["PHP_SELF"])); ?>
