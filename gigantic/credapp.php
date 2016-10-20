<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: credapp.php,v 1.3 2009-11-08 07:27:41 tredman Exp $
 */

include("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/user.class.php");

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
</script>
<div id="middleImage">
	<table id="indexLoginTable" width="950" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<td width="224" valign="top">
				<div align="center">
<?php
if ($logged_in) {
	$scart_count = 0;
	if (is_array($_SESSION["scart"])) {
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
					<tr><td><a href="credapp.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('account_home','','images/account_home_f2.jpg',1);"><img name="account_home" src="images/account_home.jpg" width="240" height="81" border="0" alt=""></a></td></tr>
					<tr><td><a href="http://mysohoplanroom.com" target="_blank" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('planroom','','images/planroom_f2_new.jpg',1);"><img name="planroom" src="images/planroom.jpg" width="240" height="85" border="0" alt=""></a></td></tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div id="mainContentApp">
	<p class="bodyWhite">
<?php require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/credapp_form.inc.php"); ?>
	</p>
</div>
<?php include("footer.inc.php"); ?>