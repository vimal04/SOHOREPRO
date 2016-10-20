<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: account.php,v 1.3 2009-11-08 07:27:41 tredman Exp $
 */

require_once("header.inc.php");
?>
<script type="text/javascript">
function check_fields(frm)
{
	var passwd1, passwd2;
	var i, j;
	var flds = new Array("email", "pwhint", "fname", "lname", "passwd1", "passwd2", "company");
	var desc = new Array("E-Mail Address", "Password Hint", "First Name", "Last Name", "Password", "Password Confirmation", "Company Name");
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
				<span class="style1">CREATE AN ACCOUNT</span><br>
				<span class="style5">Create your new account below.</span>
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
		<div id="loginSignIn">Create An Account</div> 
		<div id="loginInfo">
			<p>
			<span class="bodyWhite">When you create an account with SoHo Reprographics, you'll enjoy many great benefits that will
					make shopping faster and easier -- such as the ability to store frequently used address and billing information.			
				<p class="bodyWhite">
				Required fields are indicated with an asterisk (*).			</p>
			</span></p>
			<form method="POST" action="setup_process.php" onsubmit="return check_fields(this)">
				<table border="0" cellspacing="2" cellpadding="0">
					<tr>
						<td width="200"><div align="right"><span class="captionbutton">Email Address*</span></div></td>
						<td>
							<div align="left"><img src="images/spacer.gif" width="10" height="20" />
								<input class="bodyLink" name="email" type="text" size="25" maxlength="128" value="<?php echo($_REQUEST["email"]); ?>" />
							</div>					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Create a Password*</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="passwd1" type="password" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Retype Password*</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="passwd2" type="password" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Create a Password Hint*</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="pwhint" type="text" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">First Name*</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="fname" type="text" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Last Name*</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="lname" type="text" size="25" maxlength="32" />					</td>
					</tr>
					<tr>
						<td><div align="right"><span class="captionbutton">Company*</span></div></td>
						<td>
							<img src="images/spacer.gif" width="10" height="20" />
							<input class="bodyLink" name="company" type="text" size="25" maxlength="64" />					</td>
					</tr>
					<tr>
						<td><img src="images/spacer.gif" width="83" height="20" /></td>
						<td><img src="images/spacer.gif" width="207" height="20" /></td>
					</tr>
				</table>
		<div id="loginBottomDottedSingle"><div align="right"><input class="bodyLink" type="submit" name="Submit" value="Sign In" /></div></div>
			</form>
		</div>
	</div>
</div>
<?php
require_once("header.inc.php");
?>