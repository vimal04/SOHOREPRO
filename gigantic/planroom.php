<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST["keyword"])) {
		header(sprintf("Location: http://%s.mysohoreproplanroom.com", $_POST["keyword"]));
		exit;
	}
}

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/pqp.php");
include("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");



?>

<div id="middleImage">
    <table border="0" cellpadding="0" cellspacing="0">
		<tr>
            <td width="172" valign="middle"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
			<td width="300" valign="middle">
				<span class="style1">Digital Planroom</span><br>
				<span class="style5">Manage Your Workflow</span>
			</td>
		</tr>
	</table>
</div>
<div id="mainContent">

	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="bodyWhite" style="width:558px; padding:15px; background-color: #fff; color: #000;" >
		To access your Planroom, type your account name below:<br /><br />
		<input type="text" id="keyword" name="keyword" /><strong>.mysohoreproplanroom.com</strong> <input type="submit" value="  Go!  " />
		<br /><br />
		For more information on how you can use the Soho Repro Planroom, <br />
		contact Harvey Klapper at 212 925-7575 x120.
	</form>
	
	<br>
	<img src="images/planroom1.jpg"><br>
	<img src="images/planroom2.jpg">

</div>

<?php include("footer.inc.php"); ?>