<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: login.php,v 1.2 2007/07/25 02:01:09 tredman Exp $
 */

require_once("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");

$level = intval($_REQUEST["L"]);
if ($level == 1) $hash = $_REQUEST["H"];

if ($hash != "") {
	$user = new User();
	$user->load_by_hash($hash);
}

?>
<script type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript">
function remindpw()
{
	var email = document.getElementById("email");
	if (email.value == "") {
		alert("You must provide a E-mail address to receive your password hint.");
	} else {
		document.location = "login.php?L=1&H="+hex_md5(email.value.toLowerCase());
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
<!-- main table div -->
<div id="mainLoginTable">
	<div id="loginSignIn">Sign In</div> 
	<div id="loginLeftInfo">
		<p>
			<span class="cartCategory">Returning Customers</span><br />
			<br />
			<span class="bodyGray">Please sign in before continuing for access to convenient features and quick checkout.</span>	  </p>
		<form method="POST" action="login_process.php">
			<table width="330" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td width="95"><div align="right"><span class="captionbutton">Email Address: </span></div></td>
					<td width="229">
						<div align="left"><img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" id="email" name="email" type="text" size="25" maxlength="128" <?php echo($_REQUEST["c"] == "" ? "" : "value=\"" . base64_decode($_REQUEST["c"]) . "\" "); ?>/>
						</div>
					</td>
				</tr>
				<tr>
					<td><div align="right"><span class="captionbutton">Password:</span></div></td>
					<td>
						<img src="images/spacer.gif" width="10" height="20" />
						<input class="bodyLink" name="passwd" type="password" size="25" maxlength="32" />
					</td>
				</tr>
<?php
if ($level == 1) {
?>
				<tr>
					<td><div align="right"><span class="captionbutton">Password Hint:</span></div></td>
					<td>
						<img src="images/spacer.gif" width="10" height="20" />
						<span class="bodyLink"><?php echo($user->pwhint); ?></span>
					</td>
				</tr>
<?php
} else {
?>
				<tr>
					<td><img src="images/spacer.gif" width="83" height="20" /></td>
					<td><img src="images/spacer.gif" width="207" height="20" /></td>
				</tr>
<?php
}
?>
				<tr>
					<td>&nbsp;</td>
<?php
if ($level == 0) {
?>
					<td><span class="captionbutton"><a href="javascript:remindpw()">I forgot my password</a></span></td>
<?php
} elseif ($level == 1) {
?>
					<td><span class="captionbutton"><a href="javascript:resetpw()">I still can't remember my password.</a></span></td>
<?php
}
?>
				</tr>
			</table>
			<div id="loginBottomDotted"><div align="right"><input type="submit" name="Submit" value="Sign In" /></div></div>
		</form>
	</div>
	<div id="loginRightInfo">
	  <p>
			<span class="cartCategory">New Customers</span><br />
			<br />
		  <span class="bodyGray">Register with Fresh Surface to use convenient features and quick checkout..</span>		</p>
		<form method="POST" action="new_user.php">
			<table width="352" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td width="109"><div align="right"><span class="captionbutton">Email Address: </span></div></td>
					<td width="243">
						<div align="left">
							<img src="images/spacer.gif" width="20" height="20" />
							<input class="bodyLink"  name="email" type="text" size="25" />
						</div>
					</td>
				</tr>
				<tr>
					<td><div align="right"></div></td>
					<td><img src="images/spacer.gif" width="20" height="20" /></td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" width="109" height="20" /></td>
					<td><img src="images/spacer.gif" width="207" height="20" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="loginBottomDotted"><div align="right"><input type="submit" name="Submit2" value="Register" /></div></div>
		</form>
	</div>
</div>
<?php
require_once("header.inc.php");
?>