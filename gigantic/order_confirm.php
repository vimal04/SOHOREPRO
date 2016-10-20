<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_confirm.php,v 1.24 2009-11-08 07:27:41 tredman Exp $
 */
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/pqp.php");
include("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/service.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/delivery.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/size.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/paper.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/binding.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/mounting.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/laminate.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/source.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/scantype.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/scandpi.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/format.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/address.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/media.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/duplex.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/paper_color.class.php");

function file_gc()
{
	$dir = opendir($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads");
	while (($fh = readdir($dir)) !== false) {
		if (!preg_match("/^2/", $fh)) continue;
		$fhs = stat($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $fh);
		$current = mktime();
		if ($current - $fhs["ctime"] > 86400) {
			unlink($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $fh);
		}
	}
}

function show_confirm_block($field_name, $service_header, $yesno = false, $class = "")
{
	if ($class == "") $class = ucfirst($field_name);
	if (is_array($_REQUEST[$field_name])) {
		printf("<tr><td width=\"790\" class=\"order_heading\">%s</td></tr>", $service_header);
		printf("<tr>");
		printf("<td class=\"order_detail\">");
		if ($_REQUEST[$field_name . "Other"] != "") {
			printf("<input type=\"hidden\" name=\"%sOther\" value=\"%s\">", $field_name, $_REQUEST[$field_name . "Other"]);
		}
		$class_name = $class . "s";
		$target = new $class_name(0);
		$target->fetch_by_code($_REQUEST[$field_name]);
		$tmp = array();
		foreach ($target->items as $t) {
			$tmp[] = $t->descr;
			printf("<input type=\"hidden\" name=\"%s[]\" value=\"%s\">", $field_name, $t->code);
		}
		echo(implode(", ", $tmp));
		printf("</td>");
		printf("</tr>");
	} elseif ($_REQUEST[$field_name] == "") {
		return;
	} elseif ($yesno) {
		printf("<tr><td width=\"790\" class=\"order_heading\">%s</td></tr>", $service_header);
		printf("<tr><td class=\"order_detail\"><input type=\"hidden\" name=\"%s\" value=\"%s\">%s",
			$field_name,
			$_REQUEST[$field_name],
			($_REQUEST[$field_name] == "Y" ? "YES" : "NO"));
		printf("</td>");
		printf("</tr>");
	} else {
		$target = new $class(0, $_REQUEST[$field_name]);
		printf("<tr><td width=\"790\" class=\"order_heading\">%s</td></tr>", $service_header);
		printf("<tr><td class=\"order_detail\"><input type=\"hidden\" name=\"%s\" value=\"%s\">%s",
			$field_name,
			$_REQUEST[$field_name],
			$target->descr);
		if ($_REQUEST[$field_name . "Other"] != "" && $_REQUEST[$field_name] == "O") {
			printf("<input type=\"hidden\" name=\"%sOther\" value=\"%s\"> (%s)",
				$field_name,
				$_REQUEST[$field_name . "Other"],
				$_REQUEST[$field_name . "Other"]);
		}
		printf("</td>");
		printf("</tr>");
	}
}

function show_text_block($field_name, $header_text, $aux_text, $long_answer = false)
{
	if ($_REQUEST[$field_name] == "") return;
	printf("<tr><td width=\"790\" class=\"order_heading\">%s</td></tr>", $header_text);
	printf("<tr>");
	printf("<td class=\"order_detail\">");
	if ($aux_text != "") printf("%s<br>", $aux_text);
	printf("%s", $_REQUEST[$field_name]);
	printf("<input name=\"%s\" type=\"hidden\" value=\"%s\">", $field_name, $_REQUEST[$field_name]);
	printf("</td>");
	printf("</tr>");
}

function package_addresses($idx, $cart)
{
	if ($idx < 0) return array();
	if (count($cart) == 0) return array();
	$ret = array();
	$cnt = 0;
	for ($i = 0; $i < count($cart[$idx]["shipto_address1"]); $i++) {
		$ret[$cnt]["shipto_company"] = $cart[$idx]["shipto_company"][$i];
		$ret[$cnt]["shipto_attention"] = $cart[$idx]["shipto_attention"][$i];
		$ret[$cnt]["shipto_address1"] = $cart[$idx]["shipto_address1"][$i];
		$ret[$cnt]["shipto_address2"] = $cart[$idx]["shipto_address2"][$i];
		$ret[$cnt]["shipto_city"] = $cart[$idx]["shipto_city"][$i];
		$ret[$cnt]["shipto_state"] = $cart[$idx]["shipto_state"][$i];
		$ret[$cnt]["shipto_zip"] = $cart[$idx]["shipto_zip"][$i];
		$ret[$cnt]["shipto_company"] = $cart[$idx]["shipto_company"][$i];
		$ret[$cnt]["shipto_phone"] = $cart[$idx]["shipto_phone"][$i];
		$ret[$cnt]["shipto_phone_ac"] = $cart[$idx]["shipto_phone_ac"][$i];
		$ret[$cnt]["shipto_phone_pr"] = $cart[$idx]["shipto_phone_pr"][$i];
		$ret[$cnt]["shipto_phone_su"] = $cart[$idx]["shipto_phone_su"][$i];
		$ret[$cnt]["shipto_phone_ex"] = $cart[$idx]["shipto_phone_ex"][$i];
		$ci = 0;
		while (isset($cart[$idx]["shipto_copies_" . $ci])) {
			$ret[$cnt]["shipto_copies"][$ci] = $cart[$idx]["shipto_copies_" . $ci][$i];
			$ci++;
		}
		$cnt++;
	}
	return $ret;
}

$_SESSION["REFER"] = "order_form.php?svc=" . $_REQUEST["svc"];
$upload_exists = false;
if ($_REQUEST["edit"] != "") {
	$_SESSION["REFER"] .= "&edit=" . intval($_REQUEST["edit"]);
	if ($_SESSION["cart"][$_REQUEST["edit"]]["attachment"] != "") {
		$upload_exists = true;
	}
}

$idx = 0;

if (!is_array($_REQUEST["delivery"])) $_REQUEST["delivery"] = array();
foreach ($_REQUEST["delivery"] as $k => $v) {

	if ($v == "X") {
		$files["attachment"][$k] = $files["attachment"][$k - 1];
		$files["original"][$k] = $files["original"][$k - 1];
	}

	if ($v != "U") continue;

	if ($_FILES["delfile"]["name"][$idx] != "") {

		$upload_name = $_FILES["delfile"]["name"][$idx];
		$upload_tmp_name = $_FILES["delfile"]["tmp_name"][$idx];
		$upload_error = $_FILES["delfile"]["error"][$idx];

		switch ($upload_error) {
			case UPLOAD_ERR_OK :
				$upload_msg = "Your file was received successfully.";
				$tmpfile = explode(".", $upload_name);
				$upload_ext = $tmpfile[count($tmpfile) - 1];
				$local_name = sprintf("%s%04X.%s", date("YmdHis"), rand(0, 65535), $upload_ext);
				move_uploaded_file($upload_tmp_name, $_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $local_name);
				file_gc();
				$files["attachment"][$k] = $local_name;
				$files["original"][$k] = $upload_name;
				break;
			case UPLOAD_ERR_INI_SIZE :
				$upload_msg = "There was an error receiving your file.  It was too large.  Uploaded files are limited to 16 megabytes in size.";
				break;
			case UPLOAD_ERR_FORM_SIZE :
				$upload_msg = "There was an error receiving your file.  It was too large.  Uploaded files are limited to 16 megabytes in size.";
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

	} else {

		$files["attachment"][$k] = $_SESSION["cart"][$edit]["attachment"];
		$files["original"][$k] = $_SESSION["cart"][$edit]["original"];

	}

}

?>
<script type="text/javascript">
var upload_exists = <?php echo($upload_exists ? "true" : "false"); ?>;
var copy_count = new Array();
var copy_sizes = new Array();
var copy_method = new Array();
<?php
for ($i = 0; $i < count($_REQUEST["duplicates"]); $i++) {
	if (intval($_REQUEST["duplicates"][$i]) > 0) {
		$size = new Size(0, $_REQUEST["sizes"][$i]);
		printf("copy_count[%d] = %d;\n", $i, $_REQUEST["duplicates"][$i]);
		printf("copy_sizes[%d] = '%s';\n", $i, $size->descr);
		$upload_index = 0;
		switch ($_REQUEST["delivery"][$i]) {
			case "B" :
			case "D" : $method = "originals being delivered to Soho"; break;
			case "E" : $method = "originals being E-mailed to Soho"; break;
			case "Y" : $method = "originals being sent via YouSendIt.com"; break;
			case "F" : $method = "originals being provided via FTP"; break;
			case "S" : $method = "originals being picked up by Soho"; break;
			case "U" : $method = "original uploaded to Soho as " . $_FILES["delfile"]["name"][$upload_index++]; break;
			case "X" : break;
			case "O" :
			default : $method = "unspecified delivery method";
		}
		printf("copy_method[%d] = '%s';\n", $i, $method);
	}
}
?>

function asap(obj)
{
	if (obj.checked) {
		document.getElementById("earliest_month").disabled = true;
		document.getElementById("earliest_day").disabled = true;
		document.getElementById("earliest_year").disabled = true;
	} else {
		document.getElementById("earliest_month").disabled = false;
		document.getElementById("earliest_day").disabled = false;
		document.getElementById("earliest_year").disabled = false;
	}
}

function call_number(obj) {
	if (obj.checked) {
		document.getElementById("phone_number_ac").disabled = false;
		document.getElementById("phone_number_ac").style.backgroundColor = "#FFFFFF";
		document.getElementById("phone_number_pr").disabled = false;
		document.getElementById("phone_number_pr").style.backgroundColor = "#FFFFFF";
		document.getElementById("phone_number_su").disabled = false;
		document.getElementById("phone_number_su").style.backgroundColor = "#FFFFFF";
		document.getElementById("phone_number_ex").disabled = false;
		document.getElementById("phone_number_ex").style.backgroundColor = "#FFFFFF";
	} else {
		document.getElementById("phone_number_ac").disabled = true;
		document.getElementById("phone_number_ac").style.backgroundColor = "#CCCCCC";
		document.getElementById("phone_number_pr").disabled = true;
		document.getElementById("phone_number_pr").style.backgroundColor = "#CCCCCC";
		document.getElementById("phone_number_su").disabled = true;
		document.getElementById("phone_number_su").style.backgroundColor = "#CCCCCC";
		document.getElementById("phone_number_ex").disabled = true;
		document.getElementById("phone_number_ex").style.backgroundColor = "#CCCCCC";
	}
}

function reset_form_indicators() {
	var form_fields = new Array("shipto_company[]", "shipto_attention[]", "shipto_address1[]", "shipto_address2[]", "shipto_city[]", "shipto_state[]", "shipto_zip[]", "shipto_phone_ac[]", "shipto_phone_pr[]", "shipto_phone_su[]", "shipto_phone_ex[]", "shipto_phone[]");
	for (i = 0; i < form_fields.length; i++) {
		group = document.getElementsByName(form_fields[i]);
		if (group.length > 0) {
			group[0].parentNode.parentNode.style.backgroundColor = "#7C9ABA";
			group[0].parentNode.parentNode.style.border = "solid 1px #84A5C7";
		}
	}
	form_fields = new Array("originals[]", "duplicates[]");
	for (i = 0; i < form_fields.length; i++) {
		group = document.getElementsByName(form_fields[i]);
		if (group.length > 0) {
			group[0].parentNode.parentNode.parentNode.parentNode.parentNode.style.backgroundColor = "#7C9ABA";
			group[0].parentNode.parentNode.parentNode.parentNode.parentNode.style.border = "solid 1px #84A5C7";
		}
	}
}

function validate_form()
{
	var form_fields = new Array("shipto_company[]", "shipto_attention[]", "shipto_address1[]", "shipto_city[]", "shipto_state[]", "shipto_zip[]", "shipto_phone_ac[]", "shipto_phone_pr[]", "shipto_phone_su[]");
	var form_descr = new Array("Company", "Attention", "Address", "City", "State", "ZIP", "Phone", "", "");
	var i, j;

	reset_form_indicators();

	for (i = 0; i < form_fields.length; i++) {
		group = document.getElementsByName(form_fields[i]);
		if (group.length > 0) {
			selflag = false;
			for (j = 0; j < group.length; j++) {
				if (group[j].value != "") selflag = true;
			}
			if (!selflag) {
				group[0].parentNode.parentNode.style.backgroundColor = "#BA9ABA";
				group[0].parentNode.parentNode.style.border = "solid 1px #C7A5C7";
				alert("You have not filled in one of the '"+form_descr[i]+"' fields under Delivery Addresses.  This field has been highlighted for you.  Please complete that section and click \"Place Order\" to proceed.");
				return false;
			}
		}
	}

	return check_totals();
}
function tabTo(objID, dest) {
	//var ndx = obj.id.substr(obj.id.length - 2, 2);
	//var nxt = document.getElementById(dest+ndx);
	var obj = document.getElementById(objID);
	var nxt = document.getElementById(dest);
	if (obj.value.length >= obj.size) {
		nxt.focus();
	}
}
</script>
<?php
if ($user->id == 0) {
?>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
			<td width="350">
				<div class="style1">LOGIN PAGE</div>
				<div class="style5">Log In below to order your products.</div>
			</td>
			<td width="430" class="style4">
				<ul>
					<li>Fast and easy ordering when you sign up for a free account.</li>
					<li>Secure information.</li>
					<li>Help save trees.</li>
				</ul>
			</td>
		</tr>
	</table>
</div>
<div id="mainContent">
	<div id="mainLoginTable">
		<div class="style8" id="loginSignIn">Sign In</div>
		<div id="loginLeftInfo" class="style7a">
			<span class="cartCategory style9">Returning Customers</span><br /><br />
			<span class="bodyGray">Please sign in before continuing for access to convenient features and quick online ordering.</span><br><br>
			<form method="POST" action="login_process.php" onsubmit="return check_fields(this)">
				<input name="try" type="hidden" value="1">
				<table width="330" border="0" cellspacing="2" cellpadding="0">
					<tr>
						<td width="95" align="right" class="style7a">Email Address:</td>
						<td width="229" align="left" style="padding-left:10px">
							<input class="bodyLink" name="email" value="" type="text" size="25" maxlength="128" />
						</td>
					</tr>
					<tr>
						<td align="right" class="style7a">Password:</td>
						<td style="padding-left:10px"><input class="bodyLink" name="passwd" type="password" size="25" maxlength="32" />	</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="style7a">I forgot my password.</td>
					</tr>
				</table>
				<div id="loginBottomDotted" align="right"><input type="submit" name="Submit" value="Sign In" /></div>
			</form>
		</div>
		<div id="loginRightInfo">
			<p>
				<span class="cartCategory style9 style10">New Customers</span><br />
				<span class="style11">
					<br />
					<span class="style7a">Register with Soho Repro to use convenient features and quick online ordering.</span>
				</span>
			</p>
			<form method="POST" action="#">
				<table width="352" border="0" cellspacing="2" cellpadding="0">
					<tr>
						<td width="109" align="right" class="style7a">Email Address:</td>
						<td width="243" align="left">
							<img src="images/spacer.gif" width="20" height="20" />
							<input class="bodyLink"  name="email" type="text" size="25" />
						</td>
					</tr>
				</table>
				<div id="loginBottomDotted" align="right">
					<input type="submit" name="Submit2" value="Register" />
				</div>
			</form>
		</div>
	</div>
</div>
<?php
} else {
	$service = new Service($_REQUEST["svc"]);
?>
<script type="text/javascript">
var address_id = new Array();
var company = new Array();
var attention = new Array();
var address1 = new Array();
var address2 = new Array();
var city = new Array();
var state = new Array();
var zip = new Array();
var phone = new Array();
var phone_ac = new Array();
var phone_pr = new Array();
var phone_su = new Array();
var phone_ex = new Array();

<?php
$user->get_addresses();
$i = 0;
foreach ($user->addresses->items as $a) {
	if ($a->address1 != "") {
		printf("address_id[%d] = \"%s\";\n", $i, addslashes($a->id));
		printf("company[%d] = \"%s\";\n", $i, addslashes($a->company));
		printf("attention[%d] = \"%s\";\n", $i, addslashes($a->attention));
		printf("address1[%d] = \"%s\";\n", $i, addslashes($a->address1));
		printf("address2[%d] = \"%s\";\n", $i, addslashes($a->address2));
		printf("city[%d] = \"%s\";\n", $i, addslashes($a->city));
		printf("state[%d] = \"%s\";\n", $i, addslashes($a->state));
		printf("zip[%d] = \"%s\";\n", $i, addslashes($a->zip));
		printf("phone[%d] = \"%s\";\n", $i, addslashes($a->phone));
		printf("phone_ac[%d] = \"%s\";\n", $i, intval(substr($a->phone, 0, 3)));
		printf("phone_pr[%d] = \"%s\";\n", $i, intval(substr($a->phone, 3, 3)));
		printf("phone_su[%d] = \"%s\";\n", $i, intval(substr($a->phone, 6, 4)));
		printf("phone_ex[%d] = \"%s\";\n", $i, intval(substr($a->phone, 10, 6)));
		printf("\n");
		$i++;
	}
}
?>

function fillin_address(obj)
{
	for (i = 0; i < company.length; i++) {
		if (address_id[i] == obj.value) {
			idx = obj.id.substr(obj.id.length - 2, 2);
			document.getElementById("shipto_company"+idx).value = company[i];
			document.getElementById("shipto_attention"+idx).value = attention[i];
			document.getElementById("shipto_address1"+idx).value = address1[i];
			document.getElementById("shipto_address2"+idx).value = address2[i];
			document.getElementById("shipto_city"+idx).value = city[i];
			document.getElementById("shipto_state"+idx).value = state[i];
			document.getElementById("shipto_zip"+idx).value = zip[i];
			document.getElementById("shipto_phone"+idx).value = phone[i];
			document.getElementById("shipto_phone_ac"+idx).value = phone_ac[i];
			document.getElementById("shipto_phone_pr"+idx).value = phone_pr[i];
			document.getElementById("shipto_phone_su"+idx).value = phone_su[i];
			document.getElementById("shipto_phone_ex"+idx).value = phone_ex[i];
		}
	}
}
</script>
<div id="middleImage">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172">
				<img src="images/login-warehouse.jpg" width="175" height="80"/>
			</td>
			<td width="300">
				<span class="style1"><?php echo($service->title); ?></span><br>
				<span class="style5"><?php echo($service->subtitle); ?></span>
			</td>
<?php
	$pts = explode("\n", $service->points);
	$k = 0;
	for ($i = 0; $i < $service->cols; $i++) {
		printf("<td class=\"style4\"><ul>");
		for ($j = 0; $j < ceil(count($pts) / $service->cols); $j++) {
			printf("<li>%s</li>", $pts[$k++]);
		}
		printf("</ul></td>");
	}
?>
		</tr>
	</table>
</div>
<div id="mainContent">
	<form id="form_main" action="order_add.php" method="POST" onsubmit="return validate_form()" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
		<input type="hidden" name="svc" value="<?php echo($_REQUEST["svc"]); ?>">
		<input type="hidden" name="edit" value="<?php echo($_REQUEST["edit"]); ?>">
<?php
if (!is_array($files["attachment"])) $files["attachment"] = array();
foreach ($files["attachment"] as $k => $v) {
	printf("\t\t<input type=\"hidden\" name=\"attachment[%d]\" value=\"%s\">\n", $k, $v);
	printf("\t\t<input type=\"hidden\" name=\"original[%d]\" value=\"%s\">\n", $k, $files["original"][$k]);
}
?>
		<table border="0" cellpadding="2" cellspacing="2" class="bodyWhite">
			<tr>
				<td colspan="2" class="style21">ORDER CONFIRMATION</td>
			</tr>
<?php
show_text_block("refnumber", "Your Reference Number", "", false, $_SESSION["refnumber"]);
show_confirm_block("color", "Color Option");
show_confirm_block("duplex", "Siding Option", false);

if ($_REQUEST["originals"] != "") {

	printf("<tr><td class=\"order_heading\">Size Option</td></tr>");
	printf("<td class=\"order_detail\">");
	printf("<table width=\"100%%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">");
	printf("<tr><th>DELIVERY</th><th>ORIGINALS</th><th>DUPLICATES</th><Th>SIZES</Th></tr>");

	for ($i = 0; $i < count($_REQUEST["originals"]); $i++) {
		if (intval($_REQUEST["originals"][$i]) > 0) {
			printf("<tr><td align=\"center\">");
			printf("<input type=\"hidden\" name=\"delivery[]\" value=\"%s\">", $_REQUEST["delivery"][$i]);
			printf("<input type=\"hidden\" name=\"originals[]\" value=\"%s\">", $_REQUEST["originals"][$i]);
			printf("<input type=\"hidden\" name=\"duplicates[]\" value=\"%s\">", $_REQUEST["duplicates"][$i]);
			printf("<input type=\"hidden\" name=\"sizes[]\" value=\"%s\">", $_REQUEST["sizes"][$i]);
			printf("<input type=\"hidden\" name=\"ftpurl[]\" value=\"%s\">", $_REQUEST["delivery"][$i] == "F" ? $_REQUEST["delfile"][$i] : "");
			switch ($_REQUEST["delivery"][$i]) {
				case "B" :
				case "D" : $method = "DELIVERING TO SOHO"; break;
				case "E" : $method = "EMAILING TO SOHO"; break;
				case "Y" : $method ="SENDING VIA YOUSENDIT.COM"; break;
				case "F" : $method = "CLIENT FTP"; break;
				case "S" : $method = "PICKUP BY SOHO"; break;
				case "U" : $method = "FILE UPLOADED"; break;
				case "X" : break;
				case "O" :
				default : $method = "OTHER";
			}
			printf("%s</td>", $method);
			printf("<td align=\"center\">%s</td>", $_REQUEST["originals"][$i]);
			printf("<td align=\"center\">%s</td>", $_REQUEST["duplicates"][$i]);
			$size = new Size(0, $_REQUEST["sizes"][$i]);
			printf("<td align=\"center\">%s</td>", $size->descr);
			printf("</tr>");
			printf("<tr><td colspan=\"4\"><i>%s</i></td></tr>", $_REQUEST["delfile"][$i]);
		}
	}

	printf("</table></td></tr>");

}
show_confirm_block("paper", "Paper Option");
show_confirm_block("paper_color", "Paper Color Option", false, "Paper_Color");
show_confirm_block("mounting", "Mounting Option");
show_confirm_block("collate", "Finishing - Collate Option", true);
show_confirm_block("binding", "Finishing - Binding Option");
show_confirm_block("laminate", "Laminating");
show_confirm_block("media", "Media");
show_confirm_block("source", "Scan Source");
show_confirm_block("scantype", "Scan Type");
show_confirm_block("scandpi", "Scan DPI");
show_confirm_block("format", "File Format");
show_text_block("scanfilename", "Scanned File Name", "");
show_text_block("deliver_by", "Deliver By", "");
show_text_block("instructions", "Special Instructions", "");
?>
		</table>
<?php
if (!is_array($_REQUEST["delivery"])) $_REQUEST["delivery"] = array();
$uniq = array_unique($_REQUEST["delivery"]);

foreach ($uniq as $u) {
	switch ($u) {
		case "E" :
	?>
			<div class="order_heading">Sending Original Documents Electronically via E-Mail</div>
			<div class="order_detail">
				<p>You have indicated that you want to send one or more of your documents via E-mail. 
					Please send the file to <a href="mailto:plot@sohorepro.com">plot@sohorepro.com</a> and be 
					sure to reference your order number in the subject line.    
				</p>
				
				<p>	
					Please note that your Internet Service Provider may have limits on how large an E-mail may be. 
					If this is the case, and your document exceeds that limit, contact the plotting 
					department at 212 925 7575, ext. 112.
				</p>
			</div>
	<?php
			break;
		case "Y" :
	?>
			<div class="order_heading">Sending Original Documents Electronically via YouSendIt.com</div>
			<div class="order_detail">
				<p>
					You have indicated that you want to send one or more of your documents via the file transfer
					service YouSendIt.com. In the forms provided at <a href="http://yousendit.com" target="_blank">YouSendIt.com</a>,
					use the E-mail address <b><?php echo(htmlentities(USI_EMAIL)); ?></b> in the field marked <b>To:</b>,
					and be sure to reference your order number in the subject line.  Note that if you do not already have an
					account set up with YouSendIt.com, you may be asked to register in order to send your documents.
				</p>
				
				<p>Click here to go to &nbsp;<a href="http://yousendit.com" target="_blank"><img src="images/yousendit_button.jpg" /></a></p>
			</div>
	<?php
			break;
		case "B" :
		case "D" :
	?>
			<div class="order_heading">Order Delivery</div>
			<div class="order_detail">
				<p>
					You have indicated that you want to deliver one or more of your document to our office.
				</p>
				<p>
					TODO:  Please insert delivery instructions here.
				</p>
			</div>
	<?php
			break;
		case "S" :
	?>
			<div class="order_heading">Order Pickup</div>
			<div class="order_detail">
				<p>
					You have indicated that you would like for us to pick up one or more of your originals.
				</p>
				<p>
					<input type="checkbox" name="earliest_asap" id="earliest_asap" value="1" onchange="asap(this)" checked>&nbsp;As Soon As Possible
				</p>
				<p>	
					Earliest date we can pick up:
					<select name="earliest_month" id="earliest_month" disabled='disabled'>
	<?php
			for ($i = 1; $i <= 12; $i++) {
				printf("<option value=\"%02d\" %s>%s</option>", $i, ($i == intval(date("m")) ? "selected" : ""), date("F", mktime(0, 0, 0, $i, 1, 2000)));
			}
	?>
					</select>&nbsp;
					<select name="earliest_day" id="earliest_day" disabled>
	<?php
			for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, 1, intval(date("Y"))); $i++) {
				printf("<option value=\"%02d\" %s>%02d</option>", $i, ($i == intval(date("d")) ? "selected" : ""), $i);
			}
	?>
					</select>&nbsp;
					<select name="earliest_year" id="earliest_year" disabled>
	<?php
			printf("<option value=\"%1\$04d\" selected>%1\$04d</option>", intval(date("Y")));
			printf("<option value=\"%1\$04d\">%1\$04d</option>", intval(date("Y")) + 1);
	?>
					</select>&nbsp;
					
				</p>
				<p>
					What are you business hours?
					<select name="earliest_time" id="earliest_time">
	<?php
			for ($i = 0; $i < 24; $i++) {
				printf("<option value=\"%02d00\" %s>%s</option>", $i, ($i == 9 ? "selected" : ""), date("g:i A", mktime($i, 0)));
				printf("<option value=\"%02d30\">%s</option>", $i, date("g:i A", mktime($i, 30)));
			}
	?>
					</select>&nbsp;
					to&nbsp;
					<select name="latest_time" id="latest_time">
	<?php
			for ($i = 0; $i < 24; $i++) {
				printf("<option value=\"%02d00\" %s>%s</option>", $i, ($i == 18 ? "selected" : ""), date("g:i A", mktime($i, 0)));
				printf("<option value=\"%02d30\">%s</option>", $i, date("g:i A", mktime($i, 30)));
			}
	?>
					</select>&nbsp;
				</p>
				<p>
					<input type="checkbox" name="call_ahead" id="call_ahead" value="1" onclick="call_number(this)">&nbsp;
					Call 30-60 minutes prior to pickup to confirm.
				</p>
				<p>
					Contact Phone Number:&nbsp;
					(<input type="text" name="phone_number" id="phone_number_ac" value="" size="3" class="disabled" disabled='disabled' maxlength="3" onkeyup="if(this.value.length==3)document.getElementById('phone_number_pr').focus();">)
					<input type="text" name="phone_number" id="phone_number_pr" value="" size="3" class="disabled" disabled='disabled' maxlength="3" onkeyup="if(this.value.length==3)document.getElementById('phone_number_su').focus();">-
					<input type="text" name="phone_number" id="phone_number_su" value="" size="4" class='disabled' disabled='disabled' maxlength="4" onkeyup="if(this.value.length==4)document.getElementById('phone_number_ex').focus();">
					Ext. <input type="text" name="phone_number" id="phone_number_ex" value="" size="6"  class='disabled' disabled='disabled' maxlength="6" >
					<input type="hidden" name="phone_number" id="phone_number" value="" size="20" maxlength="20" class='disabled' disabled='disabled'>
				</p>
			</div>
	<?php
			break;
	}
}
?>
		<div class="order_heading">Delivery Addresses</div>
		<div class="order_detail">
			<table id="addr_table" cellpadding="2" cellspacing="2" border="0" class="bodyWhite">
<?php
if ($_REQUEST["edit"] != "") {
	$addr = package_addresses(intval($_REQUEST["edit"]), $_SESSION["cart"]);
	for ($i = 0; $i < count($addr); $i++) {
		printf("<tbody>");
		if ($i > 0) {
			printf("<tr><TD colspan=\"2\"><hr></TD></tr>");
			printf("<tr><TD colspan=\"2\"><input type=\"button\" value=\"REMOVE THIS ADDRESS\" onclick=\"rem_addr(event)\"></TD></tr>");
		}
		printf("<tr>");
		printf("<td>Previous Address</td>");
		printf("<td><select name=\"shipto_select\" id=\"shipto_select%02d\" onchange=\"fillin_address(this)\">", $i);
		printf("<option value=\"\">*** SELECT ONE ***</option>");
		foreach ($user->addresses->items as $a) {
			if ($a->address1 != "") {
				printf("\t\t\t\t\t<option value=\"%d\">%s, Attn: %s</option>\n", $a->id, $a->address1, $a->attention);
			}
		}
		printf("</select></td></tr>");
		printf("<tr><td>Company</td><td><input type=\"text\" name=\"shipto_company[]\" id=\"shipto_company%02d\" value=\"%s\" size=\"32\" maxlength=\"64\"></td></tr>", $i, $addr[$i]["shipto_company"]);
		printf("<tr><td>Attention</td><td><input type=\"text\" name=\"shipto_attention[]\" id=\"shipto_attention%02d\" value=\"%s\" size=\"32\" maxlength=\"64\"></td></tr>", $i, $addr[$i]["shipto_attention"]);
		printf("<tr><td>Address</td><td><input type=\"text\" name=\"shipto_address1[]\" id=\"shipto_address1%02d\" value=\"%s\" size=\"32\" maxlength=\"64\"></td></tr>", $i, $addr[$i]["shipto_address1"]);
		printf("<tr><td>&nbsp;</td><td><input type=\"text\" name=\"shipto_address2[]\" id=\"shipto_address2%02d\" value=\"%s\" size=\"32\" maxlength=\"64\"></td></tr>", $i, $addr[$i]["shipto_address2"]);
		printf("<tr><td>City</td><td><input type=\"text\" name=\"shipto_city[]\" id=\"shipto_city%02d\" value=\"%s\" size=\"32\" maxlength=\"64\"></td></tr>", $i, $addr[$i]["shipto_city"]);
		printf("<tr><td>State</td><td><input type=\"text\" name=\"shipto_state[]\" id=\"shipto_state%02d\" value=\"%s\" size=\"2\" maxlength=\"2\"></td></tr>", $i, $addr[$i]["shipto_state"]);
		printf("<tr><td>ZIP</td><td><input type=\"text\" name=\"shipto_zip[]\" id=\"shipto_zip%02d\" value=\"%s\" size=\"10\" maxlength=\"10\"></td></tr>", $i, $addr[$i]["shipto_zip"]);
		printf("<tr>");
		printf("<td>Phone</td>");
		printf("<td>");
		printf("(<input type=\"text\" name=\"shipto_phone_ac[]\" id=\"shipto_phone_ac%02d\" value=\"%03d\" size=\"3\" maxlength=\"3\" onkeyup=\"tabTo(this, 'shipto_phone_pr')\">)", $i, intval($addr[$i]["shipto_phone_ac"]));
		printf("<input type=\"text\" name=\"shipto_phone_pr[]\" id=\"shipto_phone_pr%02d\" value=\"%03d\" size=\"3\" maxlength=\"3\" onkeyup=\"tabTo(this, 'shipto_phone_su')\">-", $i, intval($addr[$i]["shipto_phone_pr"]));
		printf("<input type=\"text\" name=\"shipto_phone_su[]\" id=\"shipto_phone_su%02d\" value=\"%04d\" size=\"4\" maxlength=\"4\" onkeyup=\"tabTo(this, 'shipto_phone_ex')\">", $i, intval($addr[$i]["shipto_phone_su"]));
		printf("Ext. <input type=\"text\" name=\"shipto_phone_ex[]\" id=\"shipto_phone_ex%02d\" value=\"%06d\" size=\"6\" maxlength=\"6\">", $i, intval($addr[$i]["shipto_phone_ex"]));
		printf("<input type=\"hidden\" name=\"shipto_phone[]\" id=\"shipto_phone%02d\" value=\"%s\" size=\"16\" maxlength=\"16\">", $i, $addr[$i]["shipto_phone"]);
		printf("</td>");
		printf("</tr>");
		printf("<tr><td>Copies</td><td>");
		$upload_index = 0;
		for ($j = 0; $j < count($_REQUEST["sizes"]); $j++) {
			$size = new Size(0, $_REQUEST["sizes"][$j]);
			switch ($_REQUEST["delivery"][$j]) {
				case "B" :
				case "D" : $method = "originals being delivered to Soho"; break;
				case "E" : $method = "originals being E-mailed to Soho"; break;
				case "S" : $method = "originals being picked up by Soho"; break;
				case "U" : $method = "original uploaded to Soho as " . $_FILES["delfile"]["name"][$upload_index++]; break;
				case "X" : break;
				case "O" :
				default : $method = "unspecified delivery method";
			}
			printf("\t\t\t\t\t<input type=\"text\" id=\"shipto_copies_%d_0\" name=\"shipto_copies_%d[]\" value=\"%d\" size=\"6\" maxlength=\"6\">&nbsp;&nbsp;%s (%s)<br>\n", $j, $j, $addr[$i]["shipto_copies"][$j], $size->descr, $method);
		}
		printf("</td></tr></tbody>");
	}
} else {
?>
					<tr><td>Previous Address</td><td><select name="shipto_select" id="shipto_select00" onchange="fillin_address(this)">
						<option value="">*** SELECT ONE ***</option>
<?php
foreach ($user->addresses->items as $a) {
	if ($a->address1 != "") {
		printf("\t\t\t\t\t<option value=\"%d\">%s, Attn: %s</option>\n", $a->id, $a->address1, $a->attention);
	}
}
?>
					</select></td></tr>
					<tr><td>Company</td><td><input type="text" name="shipto_company[]" id="shipto_company00" value="<?php echo($user->default_address->company); ?>" size="32" maxlength="64"></td></tr>
					<tr><td>Attention</td><td><input type="text" name="shipto_attention[]" id="shipto_attention00" value="<?php echo($user->default_address->attention); ?>" size="32" maxlength="64"></td></tr>
					<tr><td>Address</td><td><input type="text" name="shipto_address1[]" id="shipto_address100" value="<?php echo($user->default_address->address1); ?>" size="32" maxlength="64"></td></tr>
					<tr><td>&nbsp;</td><td><input type="text" name="shipto_address2[]" id="shipto_address200" value="<?php echo($user->default_address->address2); ?>" size="32" maxlength="64"></td></tr>
					<tr><td>City</td><td><input type="text" name="shipto_city[]" id="shipto_city00" value="<?php echo($user->default_address->city); ?>" size="32" maxlength="64"></td></tr>
					<tr><td>State</td><td><input type="text" name="shipto_state[]" id="shipto_state00" value="<?php echo($user->default_address->state); ?>" size="2" maxlength="2"></td></tr>
					<tr><td>ZIP</td><td><input type="text" name="shipto_zip[]" id="shipto_zip00" value="<?php echo($user->default_address->zip); ?>" size="10" maxlength="10"></td></tr>
					<tr>
						<td>Phone</td>
						<td>
							(<input type="text" name="shipto_phone_ac[]" id="shipto_phone_ac00" value="<?php echo(substr($user->default_address->phone, 0, 3)); ?>" size="3" maxlength="3" onkeyup="tabTo('shipto_phone_ac00', 'shipto_phone_pr00')">)
							<input type="text" name="shipto_phone_pr[]" id="shipto_phone_pr00" value="<?php echo(substr($user->default_address->phone, 3, 3)); ?>" size="3" maxlength="3" onkeyup="tabTo('shipto_phone_pr00', 'shipto_phone_su00')">-
							<input type="text" name="shipto_phone_su[]" id="shipto_phone_su00" value="<?php echo(substr($user->default_address->phone, 6, 4)); ?>" size="4" maxlength="4" onkeyup="tabTo('shipto_phone_su00', 'shipto_phone_ex00')">
							Ext. <input type="text" name="shipto_phone_ex[]" id="shipto_phone_ex00" value="<?php echo(substr($user->default_address->phone, 10, 6)); ?>" size="6" maxlength="6">
							<input type="hidden" name="shipto_phone[]" id="shipto_phone00" value="<?php echo($user->default_address->phone); ?>" size="16" maxlength="16">
						</td>
					</tr>
					<tr><td>Copies</td><td>
<?php
	$upload_index = 0;
	for ($i = 0; $i < count($_REQUEST["sizes"]); $i++) {
		if (intval($_REQUEST["originals"][$i]) > 0) {
			$size = new Size(0, $_REQUEST["sizes"][$i]);
			switch ($_REQUEST["delivery"][$i]) {
				case "B" :
				case "D" : $method = "originals being delivered to Soho"; break;
				case "E" : $method = "originals being E-mailed to Soho"; break;
				case "S" : $method = "originals being picked up by Soho"; break;
				case "U" : $method = "original uploaded to Soho as " . $_FILES["delfile"]["name"][$upload_index++]; break;
				case "X" : break;
				case "O" :
				default : $method = "unspecified delivery method";
			}
			printf("\t\t\t\t\t<input type=\"text\" id=\"shipto_copies_%d_0\" name=\"shipto_copies_%d[]\" value=\"%d\" size=\"6\" maxlength=\"6\">&nbsp;&nbsp;%s (%s)<br>\n", $i, $i, $_REQUEST["duplicates"][$i], $size->descr, $method);
		}
	}
?>
					</td></tr>
<?php
}
?>
				</tbody>
				<tfoot><tr><td colspan="2"><input type="button" value="ADD ANOTHER ADDRESS" onclick="cloneLast(document.getElementById('addr_table'))"></td></tr></tfoot>
			</table>
		</div>
		<div class="order_heading"></div>
		<div class="order_detail">
			<input type="submit" value="<?php echo($_REQUEST["edit"] == "" ? "ADD TO CART" : "UPDATE CART"); ?>">&nbsp;&nbsp;
			<input type="button" value="RETURN TO ORDER FORM" onclick="f=document.getElementById('form_main');f.action='order_form.php';f.submit()">
		</div>
	</form>
</div>
<?php
}

include("footer.inc.php");
?>
