<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_supplies2.php,v 1.12 2009-11-08 07:27:41 tredman Exp $
 */

require_once("storeheader.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/store_product.class.php");

$_SESSION["REFER"] = "order_supplies.php?svc=" . $_REQUEST["svc"];

$cart_item = array();
$cart_qty = array();

foreach ($_SESSION["scart"] as $t) {
	list($id, $qty) = $t;
	if ($qty > 0) {
		$cart_item[] = new Store_Product($id);
		$cart_qty[] = $qty;
	}
}

if ($user->id == 0) {
?>
<div id="mainLoginTable">
<?php include($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/login_table.inc.php"); ?>
</div>
<?php
} else {
?>
<style type="text/css">
#content {
	position: absolute;
	top: 265px;
	left: 215px;
	width: 740px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: rgb(128,128,128);
}

#content #cart {
	position: relative;
	background-color: rgb(241,246,250);
}

.corner_nw {  position: absolute; top: 0px; left: 0px; }
.corner_ne { position: absolute; top: 0px; right: 0px; }
.corner_sw { position: absolute; bottom: 0px; left: 0px; }
.corner_se { position: absolute; bottom: 0px; right: 0px; }

#content #cart #cart_header {
	width: 100%;
	border-bottom: solid 1px rgb(87,122,160);
}

#content #cart #cart_header #cart_title {
	font-weight: bold;
	font-size: 16px;
	color: rgb(181,197,213);
	font-weight: bold;
	padding: 10px;
}

#content #cart #cart_header .cart_links {
	float: right;
	line-height: 35px;
	vertical-align: bottom;
}

#content #cart #cart_header .cart_links A {
	color: rgb(96,96,96);
	text-decoration: none;
}

#content #cart #cart_header .cart_links A:hover {
	color: rgb(128,64,64);
	text-decoration: none;
}

#content #cart #cart_content {
	width: 90%;
	padding: 20px;
}

#content #cart #cart_content TABLE {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	color: rgb(128,128,128);
	width: 100%;
}

#content #cart #cart_content TH {
	font-weight: bold;
	text-align: center;
}

#content #address {
	position: relative;
	background-color: rgb(241,246,250);
	top: 10px;
}

#content #address #addr_header {
	width: 100%;
	border-bottom: solid 1px rgb(87,122,160);
}

#content #address #addr_header #addr_title {
	font-weight: bold;
	font-size: 16px;
	color: rgb(181,197,213);
	font-weight: bold;
	padding: 10px;
}

#content #address #addr_content {
	width: 90%;
	padding: 20px;
}

#content #address #addr_content TABLE {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	color: rgb(128,128,128);
	width: 100%;
}

#content #address #addr_content TH {
	font-weight: bold;
	text-align: center;
}

#content #other {
	position: relative;
	background-color: rgb(241,246,250);
	top: 20px;
}

#content #other #other_header {
	width: 100%;
	border-bottom: solid 1px rgb(87,122,160);
}

#content #other #other_header #other_title {
	font-weight: bold;
	font-size: 16px;
	color: rgb(181,197,213);
	font-weight: bold;
	padding: 10px;
}

#content #other #other_content {
	width: 90%;
	padding: 20px;
}

#content #other #other_content TABLE {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	color: rgb(128,128,128);
	width: 100%;
}

#content #other #other_content TH {
	font-weight: bold;
	text-align: center;
}

#form_submit {
	position: relative;
	background-color: rgb(241,246,250);
	top: 30px;
}

#submit_content {
	width: 90%;
	padding: 20px;
}
</style>
<script type="text/javascript">
var address_id = new Array();
var company = new Array();
var attention = new Array();
var address1 = new Array();
var address2 = new Array();
var city = new Array();
var state = new Array();
var zip = new Array();
var phone = new Array();
var phone_ac = new Array();
var phone_pr = new Array();
var phone_su = new Array();
var phone_ex = new Array();

<?php
$user->get_addresses();
$i = 0;
foreach ($user->addresses->items as $a) {
	if ($a->address1 != "") {
		printf("address_id[%d] = \"%s\";\n", $i, addslashes($a->id));
		printf("company[%d] = \"%s\";\n", $i, addslashes($a->company));
		printf("attention[%d] = \"%s\";\n", $i, addslashes($a->attention));
		printf("address1[%d] = \"%s\";\n", $i, addslashes($a->address1));
		printf("address2[%d] = \"%s\";\n", $i, addslashes($a->address2));
		printf("city[%d] = \"%s\";\n", $i, addslashes($a->city));
		printf("state[%d] = \"%s\";\n", $i, addslashes($a->state));
		printf("zip[%d] = \"%s\";\n", $i, addslashes($a->zip));
		printf("phone[%d] = \"%s\";\n", $i, addslashes($a->phone));
		printf("phone_ac[%d] = \"%s\";\n", $i, intval(substr($a->phone, 0, 3)));
		printf("phone_pr[%d] = \"%s\";\n", $i, intval(substr($a->phone, 3, 3)));
		printf("phone_su[%d] = \"%s\";\n", $i, intval(substr($a->phone, 6, 4)));
		printf("phone_ex[%d] = \"%s\";\n", $i, intval(substr($a->phone, 10, 6)));
		printf("\n");
		$i++;
	}
}
?>

function fillin_address(obj)
{
	for (i = 0; i < company.length; i++) {
		if (address_id[i] == obj.value) {
			idx = obj.id.substr(obj.id.length - 2, 2);
			$("shipto_company").value = company[i];
			$("shipto_attention").value = attention[i];
			$("shipto_address1").value = address1[i];
			$("shipto_address2").value = address2[i];
			$("shipto_city").value = city[i];
			$("shipto_state").value = state[i];
			$("shipto_zip").value = zip[i];
			$("shipto_phone").value = phone[i];
			$("shipto_phone_ac").value = phone_ac[i];
			$("shipto_phone_pr").value = phone_pr[i];
			$("shipto_phone_su").value = phone_su[i];
			$("shipto_phone_ex").value = phone_ex[i];
		}
	}
}

function validate()
{
	var req_fields = new Array("shipto_company", "shipto_address1", "shipto_city", "shipto_state", "shipto_zip", "shipto_phone_ac", "shipto_phone_pr", "shipto_phone_su", "reference");
	var chk_result = new Array(0, 0, 0, 0, 0, 0, 0);
	var i, invalid = false;
	for (i = 0; i < req_fields.length; i++) {
		$(req_fields[i]).style.backgroundColor = "white";
		if ($(req_fields[i]).value == "") {
			chk_result[i] = 1;
			invalid = true;
			$(req_fields[i]).style.backgroundColor = "yellow";
		}
	}
	if (invalid) {
		alert("Some fields are required.  These have been highlighted for you.  Please fill this information in to continue.");
		for (i = 0; i < req_fields.length; i++) {
			if (chk_result == 1) {
				$(req_fields[i]).focus();
				break;
			}
		}
		return false;
	} else {
		return true;
	}
}
function tabTo(obj, dest) {
	var nxt = document.getElementById(dest);
	if (obj.value.length >= obj.size) {
		nxt.focus();
	}
}
</script>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172" valign="middle">
				<img src="store_images/store_side_graphic.jpg" width="175" height="80" />
			</td>
			<td width="350" valign="middle">
				<span class="style1"> Soho Repro Store: </span><br>
				<span class="style5">Get all you need at the store. </span>			</td>
			<td width="430" valign="middle">
				<span class="style4">
					<ul>
						<li>Fast and easy ordering when you sign up for a free account.</li>
						<li>Secure information.</li>
						<li>Help save trees.</li>
					</ul>
				</span>
			</td>
		</tr>
	</table>
</div>
<div id="content">
	<form action="order_supplies3.php" method="POST" id="formMain" name="formMain" onsubmit="return validate()">
		<input type="hidden" name="c" value="<?php echo($_REQUEST["c"]); ?>">
		<div id="cart">
			<img class="corner_nw" src="store_images/nw.jpg">
			<img class="corner_ne" src="store_images/ne.jpg">
			<img class="corner_sw" src="store_images/sw.jpg">
			<img class="corner_se" src="store_images/se.jpg">
			<div id="cart_header">
				<div class="cart_links">
					<a href="order_supplies.php">Return to Store</a>&nbsp;&nbsp;&nbsp;
				</div>
				<div id="cart_title">YOUR CART</div>
			</div>
			<div id="cart_content">
				<table width="100%" border="0" cellpadding="3" cellspacing="3">
					<tr>
						<th>&nbsp;</th>
						<th>Item</th>
						<th>Qty</th>
						<th>Price</th>
						<th>Extended</th>
					</tr>
<?php
$i = 1;
$cart_total_qty = 0;
$cart_total_price = 0;
foreach ($cart_item as $k => $v) {
	$cart_total_qty += $cart_qty[$k];
	$cart_total_price += ($v->price * $cart_qty[$k]);
	printf("<tr>");
	printf("<td align=\"center\">%d</td>", $i++);
	printf("<td align=\"left\">%s</td>", $v->descr);
	printf("<td align=\"right\">%d</td>", $cart_qty[$k]);
	printf("<td align=\"right\">\$%0.2f</td>", $v->price);
	printf("<td align=\"right\">\$%0.2f</td>", ($v->price * $cart_qty[$k]));
}
?>
					<tr>
						<td>&nbsp;</td>
						<td align="left"><b>TOTAL</b></td>
						<td align="right"><b><?php echo($cart_total_qty); ?></b></td>
						<td>&nbsp;</td>
						<td align="right"><b><?php printf("\$%0.2f", $cart_total_price); ?></b></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="address">
			<img class="corner_nw" src="store_images/nw.jpg">
			<img class="corner_ne" src="store_images/ne.jpg">
			<img class="corner_sw" src="store_images/sw.jpg">
			<img class="corner_se" src="store_images/se.jpg">
			<div id="addr_header">
				<div id="addr_title">DELIVERY ADDRESS</div>
			</div>
			<div id="addr_content">
				<table id="addr_table" cellpadding="2" cellspacing="2" border="0" class="bodyWhite">
					<tbody>
						<tr><td>Previous Address</td><td><select name="shipto_select" id="shipto_select00" onchange="fillin_address(this)">
							<option value="" style="font-weight:bold">*** SELECT ONE ***</option>
							<option value="<?php echo($user->default_address->id); ?>" style="font-weight:bold">*** USE DEFAULT ADDRESS ***</option>
<?php
foreach ($user->addresses->items as $a) {
	if ($a->address1 != "") {
		printf("\t\t\t\t\t<option value=\"%d\">%s, %s, Attn: %s</option>\n", $a->id, $a->company, $a->address1, $a->attention);
	}
}
?>
						</select></td></tr>
<?php
if (isset($_SESSION["scart_meta"]["shipto_address1"])) {
?>
						<tr><td>Company</td><td><input type="text" name="shipto_company" id="shipto_company" value="<?php echo($_SESSION["scart_meta"]["shipto_company"]); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>Attention</td><td><input type="text" name="shipto_attention" id="shipto_attention" value="<?php echo($_SESSION["scart_meta"]["shipto_attention"]); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>Address</td><td><input type="text" name="shipto_address1" id="shipto_address1" value="<?php echo($_SESSION["scart_meta"]["shipto_address1"]); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>&nbsp;</td><td><input type="text" name="shipto_address2" id="shipto_address2" value="<?php echo($_SESSION["scart_meta"]["shipto_address2"]); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>City</td><td><input type="text" name="shipto_city" id="shipto_city" value="<?php echo($_SESSION["scart_meta"]["shipto_city"]); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>State</td><td><input type="text" name="shipto_state" id="shipto_state" value="<?php echo($_SESSION["scart_meta"]["shipto_state"]); ?>" size="2" maxlength="2"></td></tr>
						<tr><td>ZIP</td><td><input type="text" name="shipto_zip" id="shipto_zip" value="<?php echo($_SESSION["scart_meta"]["shipto_zip"]); ?>" size="10" maxlength="10"></td></tr>
						<tr>
							<td>Phone</td>
							<td>
								<input type="text" name="shipto_phone_ac" id="shipto_phone_ac" value="<?php echo($_SESSION["scart_meta"]["shipto_phone_ac"]); ?>" size="3" maxlength="3" onkeyup="tabTo(this, 'shipto_phone_pr')">
								<input type="text" name="shipto_phone_pr" id="shipto_phone_pr" value="<?php echo($_SESSION["scart_meta"]["shipto_phone_pr"]); ?>" size="3" maxlength="3" onkeyup="tabTo(this, 'shipto_phone_su')">
								<input type="text" name="shipto_phone_su" id="shipto_phone_su" value="<?php echo($_SESSION["scart_meta"]["shipto_phone_su"]); ?>" size="4" maxlength="4" onkeyup="tabTo(this, 'shipto_phone_ex')">
								<input type="text" name="shipto_phone_ex" id="shipto_phone_ex" value="<?php echo($_SESSION["scart_meta"]["shipto_phone_ex"]); ?>" size="6" maxlength="6">
								<input type="hidden" name="shipto_phone" id="shipto_phone" value="<?php echo($_SESSION["scart_meta"]["shipto_phone"]); ?>" size="16" maxlength="16">
							</td>
						</tr>
<?php
} else {
?>
						<tr><td>Company</td><td><input type="text" name="shipto_company" id="shipto_company" value="<?php echo($user->default_address->company); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>Attention</td><td><input type="text" name="shipto_attention" id="shipto_attention" value="<?php echo($user->default_address->attention); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>Address</td><td><input type="text" name="shipto_address1" id="shipto_address1" value="<?php echo($user->default_address->address1); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>&nbsp;</td><td><input type="text" name="shipto_address2" id="shipto_address2" value="<?php echo($user->default_address->address2); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>City</td><td><input type="text" name="shipto_city" id="shipto_city" value="<?php echo($user->default_address->city); ?>" size="32" maxlength="64"></td></tr>
						<tr><td>State</td><td><input type="text" name="shipto_state" id="shipto_state" value="<?php echo($user->default_address->state); ?>" size="5" maxlength="5"></td></tr>
						<tr><td>ZIP</td><td><input type="text" name="shipto_zip" id="shipto_zip" value="<?php echo($user->default_address->zip); ?>" size="10" maxlength="10"></td></tr>
						<tr>
							<td>Phone</td>
							<td>
								<input type="text" name="shipto_phone_ac" id="shipto_phone_ac" value="<?php printf("%03d", intval(substr($user->default_address->phone, 0, 3))); ?>" size="3" maxlength="3" onkeyup="tabTo(this, 'shipto_phone_pr')">
								<input type="text" name="shipto_phone_pr" id="shipto_phone_pr" value="<?php printf("%03d", intval(substr($user->default_address->phone, 3, 3))); ?>" size="3" maxlength="3" onkeyup="tabTo(this, 'shipto_phone_su')">
								<input type="text" name="shipto_phone_su" id="shipto_phone_su" value="<?php printf("%04d", intval(substr($user->default_address->phone, 6, 4))); ?>" size="4" maxlength="4" onkeyup="tabTo(this, 'shipto_phone_ex')">
								<input type="text" name="shipto_phone_ex" id="shipto_phone_ex" value="<?php printf("%06d", intval(substr($user->default_address->phone, 10, 6))); ?>" size="6" maxlength="6">
								<input type="hidden" name="shipto_phone" id="shipto_phone" value="<?php echo($user->default_address->phone); ?>" size="16" maxlength="16">
							</td>
						</tr>
<?php
}
?>
					</tbody>
				</table>
			</div>
		</div>
		<div id="other">
			<img class="corner_nw" src="store_images/nw.jpg">
			<img class="corner_ne" src="store_images/ne.jpg">
			<img class="corner_sw" src="store_images/sw.jpg">
			<img class="corner_se" src="store_images/se.jpg">
			<div id="other_header">
				<div id="other_title">OTHER INFORMATION</div>
			</div>
			<div id="other_content">
				<table id="other_table" cellpadding="2" cellspacing="2" border="0">
					<tr><td>Reference Number</td><td><input type="text" name="reference" id="reference" value="<?php echo($_SESSION["scart_meta"]["reference"]); ?>" size="32"></td></tr>
					<tr><td>Deliver By</td><td><input type="text" name="deliver_by" value="<?php echo($_SESSION["scart_meta"]["deliver_by"]); ?>" size="32"></td></tr>
					<tr><td>Special Instructions</td><td><textarea name="instructions" rows="10" cols="64"><?php echo($_SESSION["scart_meta"]["instructions"]); ?></textarea></td></tr>
				</table>
			</div>
		</div>
		<div id="form_submit">
			<img class="corner_nw" src="store_images/nw.jpg">
			<img class="corner_ne" src="store_images/ne.jpg">
			<img class="corner_sw" src="store_images/sw.jpg">
			<img class="corner_se" src="store_images/se.jpg">
			<div id="submit_content">
				<input type="submit" value="ADD SUPPLY ORDER TO MASTER ORDER">&nbsp;&nbsp;
				<input type="button" value="RETURN TO SUPPLY STORE" onclick="f=$('formMain');f.action='order_supplies.php';f.submit();">
			</div>
		</div>
	</form>
</div>
<?
}
include("footer.inc.php");
?>
