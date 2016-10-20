<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: upload.php,v 1.3 2009/03/06 19:04:20 tredman Exp $
 */

include("header.inc.php");
?>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery-validate/additional-methods.js"></script>

<script>
  $(document).ready(function(){
    $("#uploadForm").validate({ 
        rules: 
        { 
            name: "required", 
            company: "required",             
            email: 
            { 
                required: true, 
                email: true                 
            }, 
            phone:
            {
            	required: true             	             	
            },
            uploadFile: "required"
        },
        messages:
        { 
            name: "Name is required", 
            company: "Company is required",             
            email: 
            { 
                required: "Email is required", 
                email: "Invalid email format"                 
            }, 
            phone:
            {
             	required: "Phone is required"
            },
            uploadFile: "File is required"
        }
	});
  });
</script>


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

<script type="text/javascript">
function reset_form_indicators() {
	var form_fields = new Array("name", "company", "email", "phone", "upload");
	for (i = 0; i < form_fields.length; i++) {
		group = document.getElementsByName(form_fields[i]);
		if (group.length > 0) {
			//group[0].parentNode.parentNode.style.backgroundColor = "#7C9ABA";
			//group[0].parentNode.parentNode.style.border = "solid 1px #84A5C7";
			//group[0].style.border = "normal";
		}
	}
}

function validate_form()
{
	var form_fields = new Array("name", "company", "email", "phone", "upload");
	var form_descr = new Array("Name", "Company", "Email", "Phone", "upload");
	var i, j, group, selflag, alarm;

	reset_form_indicators();
	alarm = false;



	for (i = 0; i < form_fields.length; i++) {
		group = document.getElementsByName(form_fields[i]);
		if (group.length > 0) {
			selflag = false;
			for (j = 0; j < group.length; j++) {
				if (group[j].value != "") selflag = true;
// 				if (parseInt(group[j].value) > 0) selflag = true;
			}
			if (!selflag) {
				group[0].style.backgroundColor = "#BA595B";
				//group[0].style.border = "solid 3px #BA595B";
				alarm = true;
			}
		}
	}
	if (alarm) {
		alert("One or more required fields on the above form are incomplete.  These have been highlighted for you.  Please correct any errors to continue.");
		return false;
	} else {
		return true;
	}
}
</script>

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
	<form id="uploadForm" method="post" action="upload_process.php" enctype="multipart/form-data">
  <table width="600" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <tr>
    <td colspan="2" bgcolor="#DCDCED">
      <div align="center">
          <font size="3"><strong><span class="style_upload_header">Upload Your Files</span></strong></font></div></td>
      </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><p class="style_upload_text">Use this quick and easy FTP upload if you have forgotten to upload your files for an already submitted order, or if you have made mistakes on a previously uploaded file. We will contact you to ensure the files you upload here are correct.</p>
      <p align="center" class="style_upload_text"><font size="1" face="Arial, Helvetica, sans-serif"><strong>Maximum File Size:
          20mb</strong></font></p>
      <table border="0" width="100%" align="" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
        <tr>
	    	<td width="30%"><div align="right" class="style_upload_text">Your Name</div></td>
	        <td><input name="name" type="text" id="name" size="25" ></td>
	    </tr>
		<tr>
	    	<td width="30%"><div align="right" class="style_upload_text">Your Company</div></td>
	        <td ><input name="company" type="text" id="company" size="25" ></td>
		</tr>
	    <tr>
	    	<td><div align="right" class="style_upload_text">Your Email</div></td>
	        <td><input name="email" type="text" id="email" size="25" ></td>
		</tr>
		<tr>
	    	<td><div align="right" class="style_upload_text">Your Phone #</div></td>
	        <td><input name="phone" type="text" id="phone" size="25" ></td>
		</tr>
		<tr>
			<td><div align="right" class="style_upload_text">File</div></td>
          	<td><input name="uploadFile" type="file" size="25"></td>
       </tr>
      </table>
        <div align="center"><br>
          <input name="submit" type="submit" value="Upload File">
          <br>
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