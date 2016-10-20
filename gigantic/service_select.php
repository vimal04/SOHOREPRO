<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: service_select.php,v 1.3 2009/01/12 04:03:10 tredman Exp $
 */

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/service.class.php");

include("header.inc.php");
?>
<script type="text/javascript">
function validate_services()
{
	var flds = document.getElementsByName("svc");
	var chk = false;
	for (i = 0; i < flds.length; i++) {
		if (flds[i].checked) chk = true;
	}
	return chk;
}
</script>
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
									<div align="left"><input class="bodyLink" name="email" type="text" size="22" maxlength="25" /></div>
								</td>
							</tr>
							<tr><td><span class="style11">Password:</span></td></tr>
							<tr><td><input class="bodyLink" name="passwd" type="password" size="22" maxlength="22" /></td></tr>
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
<div id="mainContentHome" class="bodyWhite">
	<form name="form_services" action="order_form.php" method="POST" onsubmit="return validate_services()">
		<h1>Please select from one of the following services:</h1>
<?php
$services = new Services();
foreach ($services->items as $s) {
	printf("<input type=\"radio\" id=\"svc_%d\"name=\"svc\" value=\"%d\">&nbsp;<b>%s</b> - %s<br>", $s->id, $s->id, $s->title, $s->subtitle);
}
?>
		<p><input type="submit" value="Continue"></p>
	</form>
</div>
<?php include("footer.inc.php"); ?>