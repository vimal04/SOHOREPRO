<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: pwsend.php,v 1.2 2009/01/12 04:03:02 tredman Exp $
 */

require_once("include/user.class.php");

$user = new User();
$user->load_by_hash($_REQUEST["H"]);

$headers = sprintf("From: %s\r\n", ADM_EMAIL);
$full_email = sprintf("%s %s <%s>", $user->fname, $user->lname, $user->login_email);

$newpw = array();
for ($i = 0; $i < 3; $i++) {
	$newpw[$i] = chr(rand(65, 90));
}
for ($i = 3; $i < 6; $i++) {
	$newpw[$i] = chr(rand(48, 57));
}

$user->set_password(implode("", $newpw));
$user->save();

$msg = sprintf("Dear %s,\n\n", $user->fname);
$msg .= sprintf("You recently submitted a request to our web site to have your password reset.");
$msg .= sprintf("Your new password is:\n\n%s\n\n", implode("", $newpw));
$msg .= sprintf("You may use the following link to sign on to the web site with your new password.\n\n");
$msg .= sprintf("http://%s%s?c=%s\n\n",
	$_SERVER["SERVER_NAME"], 
	preg_replace("/pwsend/", "index", $_SERVER["PHP_SELF"]),
	base64_encode($user->login_email));

$result = mail($full_email, "[SoHo Reprographics] New Password Request", wordwrap($msg), $headers);

$sent_to = $user->login_email;

require_once("header.inc.php");
?>
<div id="middleImage">
	<table id="indexLoginTable" width="950" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<td width="224" valign="top">
				<div align="center">
<?php
if ($logged_in) {
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
<?php
if ($result) {
?>
<div id="mainContentHome" class="bodyWhite">
	A new password has been sent to <b><?php echo($sent_to); ?></b>.
	Please read the instructions in that email to activate your account.
</div>
<?php
} else {
?>
<div id="mainContentHome" class="bodyWhite">
	There was a problem sending your password to <b><?php echo($sent_to); ?></b>.
	Please contact SoHo Reprographics.
</div>
<?php
}
require_once("footer.inc.php");
?>