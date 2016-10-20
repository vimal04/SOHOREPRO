<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: view_cart.php,v 1.15 2009-11-08 07:27:41 tredman Exp $
 */

include("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/service.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/size.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/store_product.class.php");

$level = intval($_REQUEST["L"]);
if ($level == 1) $hash = $_REQUEST["H"];

if ($hash != "") {
	$user = new User();
	$user->load_by_hash($hash);
}

$_SESSION["REFER"] = "";

?>
<script type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/base64.js"></script>
<script type="text/javascript">
function remindpw()
{
	var email = document.getElementById("email");
	if (email.value == "") {
		alert("You must provide a E-mail address to receive your password hint.");
	} else {
		document.location = "index.php?L=1&H="+hex_md5(email.value.toLowerCase())+"&c="+Base64.encode(email.value);
	}
}

function resetpw()
{
	var email = document.getElementById("email");
	if (email.value == "") {
		alert("You must provide a E-mail address to receive your password.");
	} else {
		document.location = "pwsend.php?H="+hex_md5(email.value.toLowerCase());
	}
}

function drop_cart_item(k)
{
	var dropItem = confirm("Are you sure you want to remove that item from your cart?");
	if (dropItem) {
		document.location = "update_cart.php?del="+k;
	}
}

function drop_scart()
{
	var dropItem = confirm("This removes all items from your supply order.  Are you sure you want to do this?");
	if (dropItem) {
		document.location = "update_cart.php?sdel=1";
	}
}

function clearCart()
{
	var clr = confirm("Are you sure you want to remove all items from your cart?");
	if (clr) {
		document.location = "update_cart.php?clr=1";
	}
}

function submitCart()
{
	var sbmt = confirm("Are you ready to submit your orders to Soho Reprographics?");
	if (sbmt) {
		document.location = "order_process.php";
	}
}

function addService()
{
	if (document.getElementById("svc").value == "") {
		return false;
	} else {
		return true;
	}
}
</script>
<div id="middleImage">
	<table id="indexLoginTable" width="950" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<td width="224" valign="top">
				<div align="center">
<?php
if ($logged_in) {
	$scart_count = 0;
	if (is_array($_SESSION["scart"]) && count($_SESSION["scart"]) > 0) {
		foreach ($_SESSION["scart"] as $scart) {
			list($id, $qty) = $scart;
			$scart_count += $qty;
		}
	}
	$cart_count = intval(count($_SESSION["cart"])) + $scart_count;
?>
					<form method="POST" action="logout_process.php" onsubmit="return confirm('Are you sure you want to sign off?');">
						<table id="indexLoginTableSmall"  width="211" height="119" border="0" cellpadding="0" cellspacing="1">
							<tr><td class="white14pt">LOGGED IN</td></tr>
							<tr><td width="95"><div align="left"><span class="style11">Email Address: </span></div></td></tr>
							<tr><td><span class="style2"><?php echo($user->login_email); ?></span></td>
							</tr>
							<tr><td><span class="style11">User Name:</span></td></tr>
							<tr><td><span class="style2"><?php echo($user->fname . " " . $user->lname); ?></span></td></tr>
							<tr><td><span class="style11">Company:</span></td></tr>
							<tr><td><span class="style2"><?php echo($user->company); ?></span></td></tr>
							<tr><td><span class="style11"><?php printf("You have <span class=\"style3\">%d</span> item%s in your cart.", $cart_count, ($cart_count == 1 ? "" : "s")); ?> <a href="view_cart.php" style="background-color:rgb(255,128,128)">&nbsp;VIEW&nbsp;</a></span></td></tr>
							<tr><td><input type="submit" name="Submit" value="Log Out"></td></tr>
						</table>
					</form>
<?php
} else {
?>
					<form method="POST" action="login_process.php" onsubmit="return check_fields(this)">
						<input name="try" type="hidden" value="1">
						<input name="page" type="hidden" value="0">
						<table id="indexLoginTableSmall"  width="211" height="119" border="0" cellpadding="0" cellspacing="1">
							<tr><td class="white14pt">&nbsp;&nbsp;LOGIN </td></tr>
							<tr><td width="95"><div align="left"><span class="style11">Email Address: </span></div></td></tr>
							<tr>
								<td>
									<div align="left"><input class="bodyLink" id="email" name="email" type="text" size="22" maxlength="25" <?php echo($_REQUEST["c"] == "" ? "" : "value=\"" . base64_decode($_REQUEST["c"]) . "\" "); ?>/></div>
								</td>
							</tr>
							<tr><td><span class="style11">Password:</span></td></tr>
							<tr><td><input class="bodyLink" id="passwd" name="passwd" type="password" size="22" maxlength="22" /></td></tr>
							<tr><td><input type="submit" name="Submit" value="Submit"></td></tr>
							<tr>
								<td>
									<div align="center">
										<span class="style11">
<?php
if ($level == 0) {
?>
											<a href="javascript:remindpw()">Forgot Password?</a> |
<?php
} elseif ($level == 1) {
?>
											<a href="javascript:resetpw()">More Help</a> |
<?php
}
?>
											<a href="account.php">Create Account</a></span>
									</div>
								</td>
							</tr>
<?php
if ($level == 1 && $user->id > 0) {
?>
							<tr>
								<TD class="style11" align="center">Hint: <b><?php echo($user->pwhint); ?></b></TD>
							</tr>
<?php
}
?>
						</table>
					</form>
<?php
}
?>
				</div>
			</td>
			<td width="430"><img name="home_feature" src="images/home_feature.jpg" width="430" height="166" border="0" alt=""></td>
			<td width="296">
				<table align="left" border="0" cellpadding="0" cellspacing="0" width="240">
					<tr><td><a href="javascript:;" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('account_home','','images/account_home_f2.jpg',1);"><img name="account_home" src="images/account_home.jpg" width="240" height="81" border="0" alt=""></a></td></tr>
					<tr><td><a href="digital_planroom.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('planroom','','images/planroom_f2_new.jpg',1);"><img name="planroom" src="images/planroom.jpg" width="240" height="85" border="0" alt=""></a></td></tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div id="mainContentHome">
	<p class="bodyWhite">
		<span class="style8">Cart Contents - Reference <b style="color:yellow"><?php echo($_SESSION["refnumber"]); ?></b></span>
		<p class="bodyWhite">There are <b style="color:yellow"><?php echo($cart_count); ?></b> item<?php echo($cart_count == 1 ? "" : "s"); ?> in your cart.</p>
<?php
if ($cart_count > 0) {
?>
		<table border="0" cellpadding="2" cellspacing="2" width="100%" style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10px">
			<tr>
				<th>&nbsp;</th>
				<th>SERVICE</th>
				<th>PO REF</th>
				<th>DELIVER BY</th>
				<th>ORIG</th>
				<th>DUPL</th>
				<th>SIZES</th>
				<th>ATTACHMENT</th>
			</tr>
<?php
	if (is_array($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
		$graybar = "even";
		foreach ($_SESSION["cart"] as $key => $cart) {
			$service = new Service($cart["svc"]);
			printf("<tr>");
			printf("<td class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"drop_cart_item(%d)\"><img src=\"images/cancel.png\"></td>", $graybar, $graybar, $graybar, $key);
			printf("<td class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, $service->title);
			printf("<td class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, $cart["reference"]);
			printf("<td align=\"center\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, $cart["deliver_by"]);
			if (!is_array($cart["originals"])) $cart["originals"] = array();
			if (!is_array($cart["duplicates"])) $cart["duplicates"] = array();
			printf("<td align=\"center\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, implode("<br>", $cart["originals"]));
			printf("<td align=\"center\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, implode("<br>", $cart["duplicates"]));
			$x = array();
			if (!is_array($cart["sizes"])) $cart["sizes"] = array();
			foreach ($cart["sizes"] as $size) {
				$tmp = new Size();
				$tmp->load_by_code($size);
				$x[] = $tmp->descr;
			}
			printf("<td align=\"center\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, implode("<br>", $x));
			$highwater = 0;
			$method = "&nbsp;";
			for ($i = 0; $i < count($cart["originals"]); $i++) {
				if (!isset($cart["original"][$i]) || $cart["original"][$i] == "") {
					switch ($cart["delivery"][$i]) {
						case "B" : $method = "to be delivered"; break;
						case "D" : $method = "to be delivered"; break;
						case "E" : $method = "to be E-mailed"; break;
						case "F" : $method = "client FTP"; break;
						case "S" : $method = "to be picked up"; break;
						case "O" : $method = "other"; break;
						case "X" : break;
						default : $method = "&nbsp;";
					}
					$cart["original"][$i] = $method;
				}
			}
			if (is_array($cart["original"])) {
				ksort($cart["original"]);
			} else {
				$cart["original"] = array();
			}
			printf("<td align=\"center\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_form.php?svc=%d&edit=%d'\">%s</td>", $graybar, $graybar, $graybar, $cart["svc"], $key, implode("<br>", $cart["original"]));
			printf("</tr>");
			$graybar = ($graybar == "even" ? "odd" : "even");
		}
	} else {
		printf("<tr><td colspan=\"2\">No service orders to display.</td></tr>");
	}
?>
		</table>
		<hr>
		<table border="0" cellpadding="2" cellspacing="2" width="100%" style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10px">
			<tr>
				<th>&nbsp;</th>
				<th>DESCRIPTION</th>
				<th>PO REF</th>
				<th>QUANTITY</th>
				<th>AMOUNT</th>
			</tr>
<?php
	if (is_array($_SESSION["scart"]) && count($_SESSION["scart"]) > 0) {
		$graybar = "even";
		$quantity = 0;
		$amount = 0;
		foreach ($_SESSION["scart"] as $key => $cart) {
			$product = new Store_Product($cart[0]);
			$quantity += $cart[1];
			$amount += ($cart[1] * $product->price);
		}
		printf("<tr>");
		printf("<td class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"drop_scart()\"><img src=\"images/cancel.png\"></td>", $graybar, $graybar, $graybar);
		printf("<td align=\"left\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_supplies.php'\">SUPPLY ORDER</td>", $graybar, $graybar, $graybar);
		printf("<td align=\"left\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_supplies.php'\">%s</td>", $graybar, $graybar, $graybar, $_SESSION["scart_meta"]["reference"]);
		printf("<td align=\"right\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_supplies.php'\">%d</td>", $graybar, $graybar, $graybar, $quantity);
		printf("<td align=\"right\" class=\"%s\" onmouseover=\"focus_row(this, '%s')\" onmouseout=\"blur_row(this, '%s')\" onclick=\"document.location='order_supplies.php'\">\$%0.2f</td>", $graybar, $graybar, $graybar, $amount);
		printf("</tr>");
		$graybar = ($graybar == "even" ? "odd" : "even");
	} else {
		printf("<tr><td colspan=\"2\">No supply orders to display.</td></tr>");
	}
?>
		</table>
	</p>
	<div>
		<ul class="bodyWhite">
			<li>Click on an order to edit it.</li>
			<li>Click the red icon to the left to delete that item from your cart.</li>
		</ul>
	</div>
	<div class="bodyWhite">
		<form name="addsvc_form" method="GET" action="order_form.php" onsubmit="return addService()">
			Add To Order:&nbsp;
			<select id="svc" name="svc">
				<option value="">*** SELECT ONE ***</option>
<?php
	$services = new Services();
	foreach ($services->items as $s) {
		printf("<option value=\"%d\">%s</option>", $s->id, $s->title);
	}
?>
			</select>&nbsp;<input type="submit" value="ADD">
		</form>
	</div>
	<p>
<?php
	if (is_array($_SESSION["scart"]) && count($_SESSION["scart"]) > 0 && ($_SESSION["scart_meta"]["reference"] == "" || $_SESSION["scart_meta"]["shipto_address1"] == "" || $_SESSION["scart_meta"]["shipto_city"] == "" || $_SESSION["scart_meta"]["shipto_state"] == "" || $_SESSION["scart_meta"]["shipto_zip"] == "" || $_SESSION["scart_meta"]["shipto_phone"] == "")) {
		printf("You are missing delivery information in your order.  Please click on the supply order shown above, make sure you click the Checkout button and enter all delivery information.</p><p>");
	} else {
?>
		<input type="button" value="SUBMIT ORDER" onclick="submitCart()">&nbsp;
<?php
	}
?>
		<input type="button" value="CLEAR CART" onclick="clearCart()">
	</p>
<?php
}
?>
</div>
<?php include("footer.inc.php"); ?>
