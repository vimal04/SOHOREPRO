<?php

$filename = "extensions.txt";
$handle = fopen($filename, "r");
$extensions = fread($handle, filesize($filename));
fclose($handle);


/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: contact.php,v 1.3 2009/03/05 03:14:33 tredman Exp $
 */

include("header.inc.php");
?>
<script type="text/javascript" src="instantedit.js"></script>

<style type="text/css">
<!--
.style_contact_header {
	font-size: 16px;
	color: #CCCCCC;
	font-family: Arial, Helvetica, sans-serif;
}
.style_contact_text {
	font-size: 14px;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>

<link href="css/soho.css" rel="stylesheet" type="text/css" />
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td width="172" valign="middle"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
		  <td width="350" valign="middle">
			  <span class="style1"> Soho Repro Contact Information </span><br></td>
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
	<div class="contact13" id="mainAboutTable">
		<div class="contactAll">
		 <p align="left" class="style_contact_header"><span class="bodyWhite">381 Broome St.  New York, NY  10013<br />
Tel  212.925.7575<br />
Fax  212.925.9741<br />
<a href="mailto:info@sohorepro.com" class="bodylink">info@sohorepro.com</a></span><br /></p>
<br />
<span class="style_contact_text">Phone Extensions:	    </span>
<p align="left" class="style_contact_text">
		<span id="extensions" class="editText">
<?PHP echo $extensions;?>
		</span></p>
	
	    <p align="left" class="style_contact_header">&nbsp;</p>
	    <p align="left" class="style15"><br>
		</p>
	  </div>
  </div>
</div>
<?php include("footer.inc.php"); ?>
