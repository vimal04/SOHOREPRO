<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: upload_process.php,v 1.1 2007/08/17 03:16:42 tredman Exp $
 */

include("header.inc.php");

if ($_FILES["uploadFile"]["name"]!= "") 
{
	
	

	
	$upload_name = $_FILES["uploadFile"]["name"];
	$upload_tmp_name = $_FILES["uploadFile"]["tmp_name"];
	$upload_error = $_FILES["uploadFile"]["error"];

	switch ($upload_error) {
		case UPLOAD_ERR_OK :
			$upload_msg = "Your file was received successfully.";
			$tmpfile = explode(".", $upload_name);
			$upload_ext = $tmpfile[count($tmpfile) - 1];
			$local_name = sprintf("%s%04X.%s", date("YmdHis"), rand(0, 65535), $upload_ext);
			move_uploaded_file($upload_tmp_name, $_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $local_name);
			//file_gc();
			$files["attachment"][$k] = $local_name;
			$files["original"][$k] = $upload_name;
			break;
		case UPLOAD_ERR_INI_SIZE :
			$upload_msg = sprintf("There was an error receiving your file.  It was too large.  Uploaded files are limited to 16 megabytes in size. Please email %s.", ADM_EMAIL);
			break;
		case UPLOAD_ERR_FORM_SIZE :
			$upload_msg = sprintf("There was an error receiving your file.  It was too large.  Uploaded files are limited to 16 megabytes in size. Please email %s.", ADM_EMAIL);
			break;
		case UPLOAD_ERR_PARTIAL :
			$upload_msg = sprintf("There was an error receiving your file.  It was not transferred completely.  Please send the document via email to %s.", ADM_EMAIL);
			break;
		case UPLOAD_ERR_NO_FILE :
			$upload_msg = "There was an error receiving your file.  No file was specified for transfer.";
			break;
		case UPLOAD_ERR_NO_TMP_DIR :
			$upload_msg = sprintf("There was an error receiving your file.  The server was not set up to receive your document.  Please resend it via email to %s.", ADM_EMAIL);
			break;
		case UPLOAD_ERR_CANT_WRITE :
			$upload_msg = sprintf("There was an error receiving your file.  The server didn't have permission to receive the document.  Please resend it via email to %s.", ADM_EMAIL);
			break;
		case UPLOAD_ERR_EXTENSION :
			$upload_msg = sprintf("There was an error receiving your file.  The server canceled the upload.  Please resend the document via email to %s.", ADM_EMAIL);
			break;
	}
	
	
	//send the email
	if ($upload_error == UPLOAD_ERR_OK)
	{
		$msg = 	"A file was uploaded: \n\r".
				"Name:".$_POST['name']."\n\r".
				"Company: ".$_POST['company']."\n\r".
				"Email: ".$_POST['email']."\n\r".
				"Phone: ".$_POST['phone']."\n\r".
				"File: ".$_SERVER['HTTP_HOST']."/uploads/".	$local_name;			
		
		
		mail('Harvey@sohorepro.com', 'FTP File Upload', $msg);
		//mail('ayanpal@gmail.com', 'FTP File Upload', $msg);
	}
} 




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
	
		<?php //var_dump($_FILES); ?>
		<?php //var_dump($_POST); ?>
		
	  	<table width="500" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
	    <tr> 
	    	<td colspan="2" bgcolor="#DCDCED"> 
	      		<div align="center"> <font size="3"><strong><span class="style_upload_header">Upload Your Files</span></strong></font></div>
	      	</td>
		</tr>
	  	<tr> 
	    	<td colspan="2" bgcolor="#FFFFFF">
	    		<table width="69%" height="150" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
	    		<tr> 
	    			<td width="38%">
	    				<div align="center" class="style_upload_text">
	    					<span class="style_upload_header"><?php echo $upload_msg; ?><br />
								Someone will contact you shortly about your files. 
							</span>
						</div>
					</td>
				</tr>
				</table>
    
    			<div align="center"><br></div>
    		</td>
  		</tr>
		</table>
  		
	</div>
</div>
<?php include("footer.inc.php"); ?>