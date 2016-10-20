<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: pickup.php,v 1.2 2009/03/06 19:04:20 tredman Exp $
 */

include("header.inc.php");
?>
<style type="text/css">
<!--
.style_upload_header {font-family: arial; color: #666666; }
.style_upload_text {
	font-family:Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
}
-->
</style>

<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172" valign="middle"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
		  <td width="350" valign="middle">
				<span class="style1"> Soho Repro FTP UPLOAD: </span><br>
				<span class="style5">Send us your file today! </span>			</td>
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
<div id="mainContent">
	<div class="bodyWhite" id="mainAboutTable">
	<form method="post" action="pickup_process.php" enctype="multipart/form-data">
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <tr>
    <td colspan="2" bgcolor="#DCDCED">
      <div align="center">
          <font size="3"><strong><span class="style_upload_header">Schedule a Pickup or Delivery</span></strong></font></div></td>
      </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF">

	  <table width="69%" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">





		<tr>
          <td width="38%"><div align="center" class="style_upload_text">Your Name</div></td>
          <td width="62%"><input name="Name" type="text" id="Name" size="25"style="font-family:Arial, Helvetica, sans-serif; font-size:14; color:#333333;"></td>
        </tr>


		 <tr>
          <td width="38%"><div align="center" class="style_upload_text">Your Company</div></td>
          <td width="62%"><input name="Name" type="text" id="Name" size="25"style="font-family:Arial, Helvetica, sans-serif; font-size:14; color:#333333;"></td>
        </tr>
        <tr>
          <td><div align="center" class="style_upload_text">Your Email</div></td>
          <td><input name="email" type="text" id="email2" size="25" style="font-family:Arial, Helvetica, sans-serif; font-size:14; color:#333333;"></td>
        </tr>

		 <tr>
          <td><div align="center" class="style_upload_text">Your Phone #</div></td>
          <td>
          	<input name="email" type="text" id="phone2" size="25" style="font-family:Arial, Helvetica, sans-serif; font-size:14; color:#333333;">
          </td>
        </tr>


        <tr>
          <td colspan="2"><div align="center">
	        <p>
	          <select class="style4" name="select">
	            <option selected="selected">::Please Choose Type ::</option>
	            <option>Pickup</option>
	            <option>Delivery</option>
	            </select>
	          <br />
	          <br />
	          <span class="style_upload_text">Location:<br />
	          <textarea name="textarea" cols="40" rows="4"></textarea>
	          </span> <br />
	          <input  class="style4" type="submit" name="Submit" value="Submit Request" />
	          <br />
	          <br />
	          </p>
	        </div></td>
        </tr>

      </table>
        <div align="center"><br>
        </div></td>
  </tr>
</table>
  <div align="center">

  </div>
</form>
	</div>
</div>
<?php include("footer.inc.php"); ?>