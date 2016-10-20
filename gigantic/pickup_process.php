<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: pickup_process.php,v 1.1 2007/08/17 03:15:51 tredman Exp $
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
    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
      <table width="69%" height="150" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
        <tr>
          <td width="38%"><div align="center" class="style_upload_text"><span class="style_upload_header">Thank you... Your information is being processed.<br />
            Someone will contact you shortly about your request. </span></div></td>
        </tr>
      </table>
      <br>
        </div></td>
  </tr>
</table>
  <div align="center"> 
  
  </div>
</form>
	</div>
</div>
<?php include("footer.inc.php"); ?>