<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: setup_confirm.php,v 1.1 2007/07/25 01:58:57 tredman Exp $
 */

require_once("include/user.class.php");

$user = new User();
$user->load_by_hash($_REQUEST["c"]);
$result = false;
if ($user->id > 0) {
	$user->status = true;
	$user->save();
	$result = true;
}

require_once("header.inc.php");
?>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
			<td width="350">
				<span class="style1">ACCOUNT CONFIRMATION</span><br>
				<span class="style5"></span>
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
<?php
if ($result) {
?>
<div id="mainContent" class="bodyWhite">
	Your account has been activated.  Please enjoy our site.  Click here to return to the home page to sign on.
</div>
<?php
} else {
?>
<div id="mainContent" class="bodyWhite">
	There was a problem activating your account. Please contact SoHo Reprographics.
</div>
<?php
}
require_once("footer.inc.php");
?>