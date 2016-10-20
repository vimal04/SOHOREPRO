<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: changepw.php,v 1.1 2007/07/25 01:58:57 tredman Exp $
 */

require_once("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");

$user = new User($_SESSION["USER"]);
?>
<script type="text/javascript">
function check_fields(frm)
{
	var passwd1, passwd2;
	var i, j;
	var flds = new Array("pworig", "passwd1", "passwd2", "pwhint");
	var desc = new Array("Original Password", "New Password", "New Password Confirmation", "Password Hint");
	for (i = 0; i < frm.elements.length; i++) {
		for (j = 0; j < flds.length; j++) {
			if (frm.elements[i].name == flds[j] && frm.elements[i].value == "") {
				alert(desc[j] + " is a required field.");
				return false;
			}
		}
		if (frm.elements[i].name == "passwd1") passwd1 = frm.elements[i].value;
		if (frm.elements[i].name == "passwd2") passwd2 = frm.elements[i].value;
	}
	
	if (passwd1 != passwd2) {
		alert("Password and confirmation do not match.");
		return false;
	}
	
	return true;
}
</script>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
			<td width="350">
				<span class="style1">CHANGE PASSWORD</span><br>
				<span class="style5">Change your account password below.</span>
			</td>
			<td width="430">
				<span class="style4">
					<ul>
						<li>Fast and easy ordering when you sign up for a free account.</li>
						<li>Secure information</li>
						<li>Help save trees.</li>
					</ul>
				</span>
			</td>
		</tr>
	</table>
</div>
<div id="mainContent">
	<div id="mainLoginTable">
		<div id="loginSignIn">Change Your Password</div> 
		<div id="loginInfo">
			<p class="bodyWhite">
				Required fields are indicated with an asterisk (*).
			</p>
			<form method="POST" action="change_process.php">
				<input type="hidden" name="email" value="<?php echo($user->login_email); ?>">
				<table border="0" cellspacing="2" cellpadding="0">
					<tr>
						<td width="200"><div align="right"><span class="captionbutton">Email Address*</span></div></td>
						<td>
							<div align="left"><img src="images/spacer.gif" width="10" height="20" />
								<?php printf("%s %s &lt;%s&gt;", $user->fname, $user->lname, $user->login_email); ?>
							</div>					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Enter Your Current Password</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="passwd0" type="password" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Enter Your New Password</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="passwd1" type="password" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Confirm Your New Password</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="passwd2" type="password" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Create A New Password Hint</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="pwhint" type="text" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><img src="images/spacer.gif" width="83" height="20" /></td>
						<td><img src="images/spacer.gif" width="207" height="20" /></td>
					</tr>
				</table>
		<div id="loginBottomDottedSingle"><div align="right"><input class="bodyLink" type="submit" name="Submit" value="Change" /></div></div>
			</form>
		</div>
	</div>
</div>
<?php
require_once("header.inc.php");
?>