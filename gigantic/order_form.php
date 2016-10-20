<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_form.php,v 1.19 2009-11-08 07:27:41 tredman Exp $
 */
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/pqp.php");
include("header.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/service.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/association.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/order_form.inc.php");

$_SESSION["REFER"] = "order_form.php?svc=" . $_REQUEST["svc"];
if ($_REQUEST["edit"] != "") {
	$_SESSION["REFER"] .= "&edit=" . intval($_REQUEST["edit"]);
}

if ($_POST["refnumber"] != "") {
	$_SESSION["refnumber"] = $_POST["refnumber"];
}

if (isset($_SESSION["cart"])) {
	foreach ($_SESSION["cart"] as $cart) {
		if ($cart["reference"] != "") {
			$_SESSION["refnumber"] = $cart["reference"];
		}
	}
}

if ($user->id == 0)
{

		$user = new User();

		if ($_REQUEST["H"] != "") {
			$user->load_by_hash($_REQUEST["H"]);
		}

	?>
	<script type="text/javascript" src="js/md5.js"></script>
	<script type="text/javascript">
	function remindpw()
	{
		var email = document.getElementById("email");
		if (email.value == "") {
			alert("You must provide a E-mail address to receive your password hint.");
		} else {
			document.location = "order_form.php?L=1&H="+hex_md5(email.value.toLowerCase());
		}
	}

	function resetpw()
	{
		var email = document.getElementById("email");
		if (email.value == "") {
			alert("You must provide a E-mail address to receive your password.");
		} else {
			document.location = "pwsend.php?H="+hex_md5(email.value.toLowerCase());
		}
	}
	</script>
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
	<?php include($_SERVER["DOCUMENT_ROOT"]. "/include/login_table.inc.php"); ?>
	</div>
	<?php
}
elseif ($_SESSION["refnumber"] == "")
{
		$service = new Service($_REQUEST["svc"]);
	?>
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
		<form action="order_form.php" method="POST">
			<input type="hidden" name="svc" value="<?php echo($_REQUEST["svc"]); ?>">
			<input type="hidden" name="edit" value="<?php echo($_REQUEST["edit"]); ?>">
			<table width="790" height="27" border="0" cellpadding="2" cellspacing="0">
	<?php
		show_text_block("refnumber", "Job Reference", "Since this is the first item in your cart, please let us know what your reference number is for this order.", false, $_SESSION["refnumber"]);
	?>
			</table>
			<p><input type="submit" value="Continue"></p>
		</form>
	</div>
	<?php
}
else
{
		if ($_POST["refnumber"] != "") $_SESSION["refnumber"] = $_POST["refnumber"];
		if (!isset($_SESSION["cart"])) $_SESSION["cart"] = array();
		$service = new Service($_REQUEST["svc"]);
	?>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript">
	function reset_form_indicators() {
		var form_fields = new Array("color", "duplex", "paper_color", "source", "scantype", "scandpi", "format", "mounting", "binding[]", "laminate", "media");
		for (i = 0; i < form_fields.length; i++) {
			group = document.getElementsByName(form_fields[i]);
			if (group.length > 0) {
				group[0].parentNode.parentNode.style.backgroundColor = "#7C9ABA";
				group[0].parentNode.parentNode.style.border = "solid 1px #84A5C7";
			}
		}
		form_fields = new Array("delivery[]", "originals[]", "duplicates[]");
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
		var form_fields = new Array("color", "duplex", "paper_color", "source", "scantype", "scandpi", "format", "mounting", "binding[]", "laminate", "media");
		var form_descr = new Array("Color Options", "Siding", "Paper Color", "What Are We Scanning?", "What type of scan do you need?", "Resolution (DPI)", "What Format Would You Prefer?", "Mounting Options", "Finishing - Binding Options", "Laminate Options", "Type Of Media");
		var i, j, group, selflag, alarm;

		reset_form_indicators();
		alarm = false;

		for (i = 0; i < form_fields.length; i++) {
			group = document.getElementsByName(form_fields[i]);
			if (group.length > 0) {
				selflag = false;
				for (j = 0; j < group.length; j++) {
					if (group[j].checked) selflag = true;
				}
				if (!selflag) {
					group[0].parentNode.parentNode.style.backgroundColor = "#BA595B";
					group[0].parentNode.parentNode.style.border = "solid 1px #C7A5C7";
					alarm = true;
				}
			}
		}

		var delfiles = document.getElementsByName("delfile[]");
		var delhosts = document.getElementsByName("delhost[]");
		var delusers = document.getElementsByName("deluser[]");
		var delpasses = document.getElementsByName("delpass[]");
		var delspecs = document.getElementsByName("delspec[]");
		var deliveries = document.getElementsByName("delivery[]");

		for (i = 0; i < deliveries.length; i++) {
			if (deliveries[i].value != "F") break;
			delfiles[i].value = "ftp://"+delusers[i].value+":"+delpasses[i].value+"@"+delhosts[i].value+"/"+delspecs[i].value;
		}

		form_fields = new Array("delivery[]", "delfile[]");
		form_descr = new Array("Delivery Options", "File To Upload");

		for (i = 0; i < form_fields.length; i++) {
			group = document.getElementsByName(form_fields[i]);
			if (group.length > 0) {
				selflag = false;
				for (j = 0; j < group.length; j++) {
					if (group[j].value != "") selflag = true;
	// 				if (parseInt(group[j].value) > 0) selflag = true;
				}
				if (!selflag) {
					group[0].parentNode.parentNode.parentNode.parentNode.parentNode.style.backgroundColor = "#BA595B";
					group[0].parentNode.parentNode.parentNode.parentNode.parentNode.style.border = "solid 1px #C7A5C7";
					alarm = true;
				}
			}
		}

		form_fields = new Array("originals[]", "duplicates[]");
		form_descr = new Array("Duplicating Options", "Duplicating Options");

		for (i = 0; i < form_fields.length; i++) {
			group = document.getElementsByName(form_fields[i]);
			if (group.length > 0) {
				selflag = false;
				for (j = 0; j < group.length; j++) {
					if (parseInt(group[j].value) > 0) selflag = true;
				}
				if (!selflag) {
					group[0].parentNode.parentNode.parentNode.parentNode.parentNode.style.backgroundColor = "#BA595B";
					group[0].parentNode.parentNode.parentNode.parentNode.parentNode.style.border = "solid 1px #C7A5C7";
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
	<?php
		if ($_REQUEST["svc"] == "4" || $_REQUEST["svc"] == "8") {
	?>
	<div id="mainContent">
		That service is not available at this time.
	</div>
	<?php
		} else {
	?>
	<div id="mainContent">
		<form name="mainform" id="mainform" action="order_confirm.php" method="POST" onsubmit="return validate_form()" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
			<input type="hidden" name="edit" value="<?php echo($_REQUEST["edit"]); ?>">
			<input type="hidden" name="svc" value="<?php echo($_REQUEST["svc"]); ?>">
	<?php
	if ($_REQUEST["edit"] != "") {
	?>
			<input type="hidden" name="edit" value="<?php echo($_REQUEST["edit"]); ?>">
	<?php
	}
	?>
			<table width="790" height="27" border="0" cellpadding="2" cellspacing="0">
	<?php
			show_text_block("refnumber", "Job Reference", "Please let us know what your reference number is for this order, or accept the default from the previous order.", false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["reference"] : $_SESSION["refnumber"]));
	// 		show_text_literal("refnumber", "Job Reference", "Your internal job name or reference number", $_SESSION["refnumber"]);
	// 		show_order_block("delivery", "Delivery Options", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["delivery"] : ""));
			show_order_block("color", "Color Options", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["color"] : "BW"));
			show_order_block("duplex", "Siding", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["duplex"] : "1"));

			switch ($_REQUEST["svc"])
			{
				case 1 :
				case 2 :
				case 3 :
				case 5 :
					show_dupe_block(package_dupes($_REQUEST["edit"], $_SESSION["cart"], $_REQUEST));
				default :  break;
			}

			switch ($_REQUEST["svc"])
			{
				case 6 :
				case 7 :
					show_doc_sub_block(package_dupes($_REQUEST["edit"], $_SESSION["cart"], $_REQUEST));
				default :  break;
			}

			show_order_block("media", "Type Of Media", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["media"] : ""));
			show_order_block("mounting", "Mounting Options", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["mounting"] : "N"));
			show_order_block("laminate", "Laminating Options", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["laminate"] : "N"));
			show_order_block("paper_color", "Paper Color", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["paper_color"] : "SW"));
			show_order_block("source", "What Type of Scan Do You Need?", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["source"] : ""));
			//show_order_block("scantype", "What type of scan do you need? - (11 x 17 limitation)", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["scantype"] : ""));
			show_order_block("scandpi", "Resolution (DPI)", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["scandpi"] : ""));
			show_order_block("format", "What Format Would You Prefer?", false, false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["format"] : ""));
			show_order_block("binding", "Finishing - Binding Options", false, true, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["binding"] : (is_array($_REQUEST["binding"]) ? $_REQUEST["binding"] : array())));

			switch ($_REQUEST["svc"]) {
				case 1 :
				case 2 :
				case 5 : show_text_block("instructions", "Special Instructions", "", true, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["instructions"] : "")); break;
				case 6 :
				default : show_text_block("instructions", "Special Instructions", "", true, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["instructions"] : "")); break;
			}

			switch ($_REQUEST["svc"]) {
				case 1 :
				case 2 :
				case 5 : show_text_block("deliver_by", "Order Delivery", "When do you need your order delivered by?", false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["deliver_by"] : "")); break;
				case 6 :
					show_text_block("scanfilename", "Finished Digital File", "Would you like us to name the digital file anything in particular?", false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["scanfilename"] : ""));
					show_text_block("deliver_by", "Order Delivery", "When do you need your order delivered by?", false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["deliver_by"] : ""));
					break;
				default : show_text_block("deliver_by", "Order Delivery", "When do you need your order delivered by?", false, ($_REQUEST["edit"] != "" ? $_SESSION["cart"][intval($_REQUEST["edit"])]["deliver_by"] : ""));
			}



	?>
				<tr>
					<td class="order_heading"><input class="bodyLink" type="submit" name="Submit" value="Continue with Order" /></td>
				</tr>
			</table>
		</form>
	</div>
	<?php
		}
}

include("footer.inc.php");
?>
