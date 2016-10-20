<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: change_process.php,v 1.3 2009/01/12 03:57:38 tredman Exp $
 */

require_once("include/user.class.php");

$user = new User(0, $_REQUEST["email"]);
if ($user->check_password($_REQUEST["passwd0"])) {
	if ($_REQUEST["passwd1"] == $_REQUEST["passwd2"]) {
		$user->set_password($_REQUEST["passwd1"]);
		$user->pwhint = $_REQUEST["pwhint"];
		$user->save();
		$result = true;
	} else {
		$result = false;
	}
} else {
	$result = false;
}

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
							<tr><td class="white14pt">LOGGED IN </td></tr>
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
	Your password has been changed.
</div>
<?php
} else {
?>
<div id="mainContentHome" class="bodyWhite">
	There was a problem changing your password.  Usually this is because you typed
	in your current password incorrectly, or yofile:///home/tredman/work/soho/change_process.phpur new password and the confirmation did
	not match.  Please click <a href="changepw.php">here</a> to try again, or click
	CHANGE PASSWORD in the left hand menu.
</div>
<?php
}
require_once("footer.inc.php");
?>