<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_process.php,v 1.23 2009-11-08 07:27:41 tredman Exp $
 */

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order_master.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order_prop.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/order_line.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/size.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/binding.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/delivery.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/format.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/laminate.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/mounting.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/paper.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/scandpi.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/scantype.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/source.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/session.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/address.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/delivery_count.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/service.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/schedule.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/media.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/duplex.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/paper_color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF  . "/include/store_product.class.php");

if (count($_SESSION["cart"]) > 0) {
	$order_master = new Order_Master();
	$order_master->customer_id = $_SESSION["USER"];
	$order_master->order_date = date("Y-m-d H:i:s");
	$order_master->reference = $_SESSION["refnumber"];
	$order_master->save();

	if ($order_master->id == 0) {
		die("Could not save order master.");
	}

	if (is_array($_SESSION["cart"])) {
		foreach ($_SESSION["cart"] as $cart) {
			$order = new Order();
			$order->master_id = $order_master->id;
			$order->service_id = $cart["svc"];
			$order->deliver_by = $cart["deliver_by"];
			$order->instructions = $cart["instructions"];
			$order->reference = $cart["reference"];
			$order->save();

			if ($order->id == 0) {
				die("Could not save order.");
			}

			for ($i = 0; $i < count($cart["originals"]); $i++) {
				if (intval($cart["originals"][$i]) > 0) {
					$order_line = new Order_Line();
					$order_line->order_id = $order->id;
					$order_line->originals = $cart["originals"][$i];
					$order_line->duplicates = $cart["duplicates"][$i];
					$size = new Size(0, $cart["sizes"][$i]);
					$order_line->size_id = $size->id;
					$order_line->ftpurl = $cart["ftpurl"][$i];
					$order_line->save();
					if ($order_line->id == 0) {
						die("Could not save order line.");
					}
				}
			}

			$fields = array("binding");

			foreach ($fields as $f) {
				if (is_array($cart[$f])) {
					foreach ($cart[$f] as $rf) {
						$order_prop = new Order_Prop();
						$order_prop->order_id = $order->id;
						$order_prop->name = $f;
						$objname = ucfirst($f);
						$obj = new $objname(0, $rf);
						$order_prop->value = $obj->id;
						$order_prop->save();
					}
				}
			}

			$fields = array("color", "duplex", "paper_color", "format", "laminate", "mounting", "paper", "media", "scandpi", "scantype", "source");
			$class = array("Color", "Duplex", "Paper_Color", "Format", "Laminate", "Mounting", "Paper", "Media", "Scandpi", "Scantype", "Source");

			for ($i = 0; $i < count($fields); $i++) {
				if ($cart[$fields[$i]] != "") {
					$order_prop = new Order_Prop();
					$order_prop->order_id = $order->id;
					$order_prop->name = $fields[$i];
					$objname = $class[$i];
					$obj = new $objname(0, $cart[$fields[$i]]);
					$order_prop->value = $obj->id;
					$order_prop->data = ($cart[$fields[$i]] == "O" ? $cart[$fields[$i] . "Other"] : "");
					$order_prop->save();
				}
			}

			$addresses = array();

			for ($i = 0; $i < count($cart["shipto_company"]); $i++) {
				$addresses[$i] = new Address();
				$addresses[$i]->order_id = $order->id;
				$addresses[$i]->customer_id = $order_master->customer_id;
				$fields = array("company", "attention", "address1", "address2", "city", "state", "zip", "phone");
				foreach ($fields as $f) {
					if ($cart["shipto_" . $f][$i] != "") {
						$addresses[$i]->$f = $cart["shipto_" . $f][$i];
					}
				}
				$addresses[$i]->save();
				if ($addresses[$i]->id == 0) {
					die("Could not save address line.");
				}
				$fields = array();
				for ($j = 0; $j < count($cart["sizes"]); $j++) {
					if ($cart["shipto_copies_" . $j][$i] != "") {
						$delivery_count = new Delivery_Count();
						$delivery_count->order_id = $order->id;
						$delivery_count->address_id = $addresses[$i]->id;
						$size = new Size(0, $cart["sizes"][$j]);
						$delivery_count->size_id = $size->id;
						$delivery_count->copy_count = $cart["shipto_copies_" . $j][$i];
						$delivery_count->save();
						if ($delivery_count->id == 0) {
							die("Could not save delivery count.");
						}
					}
				}
			}

			if ($cart["delivery"] == "Y" || $cart["delivery"] == "P") {
				$schedule = new Schedule();
				$schedule->order_id = $order->id;
				if ($cart["earliest_asap"] == "1") {
					$schedule->pickup_asap = true;
				} else {
					$year = $cart["earliest_year"];
					$month = $cart["earliest_month"];
					$day = $cart["earliest_day"];
					if ($day > cal_days_in_month(CAL_GREGORIAN, $month, $year)) {
						$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
						$pickup_date = date("Y-m-d", strtotime("+1 day", mktime(0, 0, 0, $month, $day, $year)));
					} else {
						$pickup_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
					}
					$schedule->pickup_date = $pickup_date;
				}
				$schedule->earliest_time = date("H:i:s", mktime(intval(substr($cart["earliest_time"], 0, 2)), intval(substr($cart["earliest_time"], 2, 2)), 0));
				$schedule->latest_time = date("H:i:s", mktime(intval(substr($cart["latest_time"], 0, 2)), intval(substr($cart["latest_time"], 2, 2)), 0));
				if ($cart["call_ahead"] == "1") {
					$schedule->call_flag = true;
					$schedule->phone_number = $_SESSION["cart"]["phone_number"];
				}
				$schedule->save();
			}

			if (!is_array($cart["attachment"])) $cart["attachment"] = array();
			foreach ($cart["attachment"] as $k => $v) {
				if ($v != "") {
					$tmp = explode(".", $v);
					$upload_ext = $tmp[count($tmp) - 1];
					$local_name = sprintf("WEB-%06d-%02d.%s", $order->id, $k, $upload_ext);
					rename(
						$_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $v,
						$_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads/" . $local_name
					);
				}
			}

			$order->load($order->id);
			$service = new Service($order->service_id);
			$subject = "Soho Repro Online Order";
			$headers = sprintf("From: %1\$s\r\nReply-To: %1\$s\r\n", ($service->contact_email == "" ? ADM_EMAIL : $service->contact_email));
			if ($service->contact_email != "") {
				$headers .= sprintf("Cc: %1\$s\r\n", ADM_EMAIL);
			}
			$msg = "Below is an online order sent from the Soho Repro Online Form\n\n";
			$user = new User($order_master->customer_id);
			$msg .= sprintf("%s %s submitted the following order:\n\n", $user->fname, $user->lname);
			$msg .= sprintf("ORDER NUMBER: WEB-%06d\n", $order->id);
			$msg .= sprintf("BILL TO: %s\n", $user->company);
			$msg .= sprintf("CONTACT: %s %s\n", $user->fname, $user->lname);
			$service = new Service($order->service_id);
			$msg .= sprintf("SERVICE: %s\n", $service->title);
			$msg .= sprintf("REFERENCE NUMBER: %s\n", $order->reference);
			$msg .= sprintf("DELIVER BY: %s\n", $order->deliver_by);
			$msg .= sprintf("SPECIAL INSTRUCTIONS: %s\n\n", $order->instructions);

			foreach ($order->properties->items as $props) {
				$objname = ucfirst($props->name);
				$obj = new $objname($props->value);
				$msg .= sprintf("%s: %s\n", strtoupper($props->name), $obj->descr);
			}

			$msg .= "\n";

			foreach ($order->lines->items as $lines) {
				$size = new Size($lines->size_id);
				$msg .= sprintf("%s: %s original%s, %s duplicate%s\n", $size->descr, $lines->originals, $lines->originals == 1 ? "" : "s", $lines->duplicates, $lines->duplicates == 1 ? "" : "s");
			}

			$msg .= "\n";

			if ($cart["delivery"] == "P") {
				$msg .= sprintf("You have requested that we pick up your originals.\n");
				if ($schedule->pickup_asap) {
					$msg .= sprintf("PICKUP DATE:  ASAP\n");
				} else {
					$msg .= sprintf("PICKUP DATE: %s\n", date("l, F jS, Y", strtotime($schedule->pickup_date)));
				}
				$msg .= sprintf("BUSINESS HOURS: %s - %s\n", date("g:i A", strtotime($schedule->earliest_time)), date("g:i A", strtotime($schedule->latest_time)));
				$msg .= sprintf("CALL AHEAD: %s %s\n", ($schedule->call_flag ? "YES" : "NO"), ($schedule->call_flag ? "(" . $schedule->phone_number . ")" : ""));
				$msg .= sprintf("\n");
			}

			if ($cart["delivery"] == "E") {
				$msg .= sprintf("You have indicated that you want to send one or more of your documents in E-mail.\n");
				$msg .= sprintf("Please send the file to %s and be sure to reference your\n", ADM_EMAIL);
				$msg .= sprintf("order number in the subject line.\n\n");
				$msg .= sprintf("Please note that your Internet Service Provider may have limits on how large an E-mail may be.\n");
				$msg .= sprintf("If this is the case, and your document exceed that limit, you can still contact one of our customer\n");
				$msg .= sprintf("service representatives and arrange 	for an alternate delivery method.\n");
			}

			if ($cart["delivery"] == "Y") {
				$msg .= sprintf("You have indicated that you want to send one or more of your documents via the file transfer\n");
				$msg .= sprintf("service YouSendIt.com. In the forms provided at http://yousendit.com,\n");
				$msg .= sprintf("use the E-mail address %s in the field marked <b>To:</b>,\n", USI_EMAIL);
				$msg .= sprintf("and be sure to reference your order number in the subject line.  Note that if you do not already have an\n");
				$msg .= sprintf("account set up with YouSendIt.com, you may be asked to register in order to send your documents.\n\n");
				$msg .= sprintf("YouSendIt.com is an external, third-party service, and as such, you never need to provide\n");
				$msg .= sprintf("them with your login information for the Soho Reprographics Web Site.  Their registration process is\n");
				$msg .= sprintf("completely separate from your user account here.\n\n");
			}

			foreach ($order->addresses->items as $address) {
				$msg .= sprintf("DELIVER TO: %s, Attn: %s, %s%s%s, %s, %s %s, %s\n",
					$address->company,
					$address->attention,
					$address->address1,
					($address->address2 == "" ? "" : "<BR>"),
					$address->address2,
					$address->city,
					$address->state,
					$address->zip,
					$address->phone_string($address->phone));
				foreach ($address->delivery_counts->items as $delivery_count) {
					$size = new Size($delivery_count->size_id);
					$msg .= sprintf("RECEIVING: Quantity %d of %s\n", $delivery_count->copy_count, $size->descr);
				}
				$msg .= "\n";
			}

			$dir = opendir($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads");
			$attachment = "";
			while (($file = readdir($dir)) !== false) {
				if (substr($file, 0, 10) == sprintf("WEB-%06d", $order->id)) {
					$msg .= sprintf("\nYou also sent us your original in digital format.  You can find it online on our site here:\n");
					$msg .= sprintf("http://%s/uploads/%s\n\n", $_SERVER["SERVER_NAME"], $file);
				}
			}

			$msg .= sprintf("If you are experiencing any problems with this online order process, please email your service contact at %s.\n",
				($service->contact_email == "" ? ADM_EMAIL : $service->contact_email));
			$msg .= sprintf("\nIf your originals are being picked up by Soho, please remember to include a printout of this order with the package.\n");

			mail($user->login_email, $subject, $msg, $headers);

			$subject = "Soho Repro Online Order Merchant Copy";

			$msg .= sprintf("\nNOTE TO ADMINISTRATOR:\n");
			$msg .= sprintf("You can examine this order at:\n");
			$msg .= sprintf("http://%s%s/admin/index.php?table=order&status=0&id=%d\n",
				$_SERVER["SERVER_NAME"],
				dirname($_SERVER["PHP_SELF"]),
				$order->id);
			$msg .= sprintf("This link will be valid for as long as the order is still pending.\n");

			mail($service->contact_email == "" ? ADM_EMAIL : $service->contact_email, $subject, $msg, $headers);

		}

		$order_master->get_orders();
		unset($_SESSION["cart"]);
	}
}

if (count($_SESSION["scart"]) > 0) {

	$order_master = new Order_Master();
	$order_master->customer_id = $_SESSION["USER"];
	$order_master->order_date = date("Y-m-d H:i:s");
	$order_master->reference = $_SESSION["scart_meta"]["reference"];
	$order_master->save();

	if ($order_master->id == 0) {
		die("Could not save order master.");
	}

	$order = new Order();
	$order->master_id = $order_master->id;
	$order->service_id = -1;
	$order->deliver_by = $_SESSION["scart_meta"]["deliver_by"];
	$order->instructions = $_SESSION["scart_meta"]["instructions"];
	$order->reference = $_SESSION["scart_meta"]["reference"];
	$order->save();

	if ($order->id == 0) {
		die("Could not save order.");
	}

	for ($i = 0; $i < count($_SESSION["scart"]); $i++) {
		if (intval($_SESSION["scart"][$i][1]) > 0) {
			$order_supply = new Order_Supply();
			$order_supply->order_id = $order->id;
			$order_supply->product_id = $_SESSION["scart"][$i][0];
			$order_supply->qty = $_SESSION["scart"][$i][1];
			$order_supply->qty_inv = 0;
			$order_supply->save();
			if ($order_supply->id == 0) {
				die("Could not save order line.");
			}
		}
	}

	$addresses = array();

	for ($i = 0; $i < count($_SESSION["scart_meta"]["shipto_company"]); $i++) {
		$addresses[$i] = new Address();
		$addresses[$i]->order_id = $order->id;
		$addresses[$i]->customer_id = $order_master->customer_id;
		$fields = array("company", "attention", "address1", "address2", "city", "state", "zip", "phone");
		foreach ($fields as $f) {
			if ($_SESSION["scart_meta"]["shipto_" . $f] != "") {
				$addresses[$i]->$f = $_SESSION["scart_meta"]["shipto_" . $f];
			}
		}
		$addresses[$i]->save();
		if ($addresses[$i]->id == 0) {
			die("Could not save address line.");
		}
	}

	$order->load($order->id);
	$subject = "Soho Repro Supply Order";
	$headers = sprintf("From: %1\$s\r\nReply-To: %1\$s\r\nCC: %1\$s\r\n", ADM_EMAIL);
	$msg = "Below is an online order sent from the Soho Repro Online Form\n\n";
	$user = new User($order_master->customer_id);
	$msg .= sprintf("%s %s submitted the following order:\n\n", $user->fname, $user->lname);
	$msg .= sprintf("ORDER NUMBER: WEB-%06d\n", $order->id);
	$msg .= sprintf("BILL TO: %s\n", $user->company);
	$msg .= sprintf("CONTACT: %s %s\n", $user->fname, $user->lname);
	$msg .= sprintf("REFERENCE NUMBER: %s\n", $order->reference);
	$msg .= sprintf("DELIVER BY: %s\n", $order->deliver_by);
	$msg .= sprintf("SPECIAL INSTRUCTIONS: %s\n\n", $order->instructions);

	$msg .= "\n";

	$msg .= sprintf("%-40s  %-4s  %-10s  %-10s\n", "PRODUCT", "QTY", "PRICE", "EXTENDED");
	$total_ext = 0;

	foreach ($order->supplies->items as $supplies) {
		$p = new Store_Product($supplies->product_id);
		$msg .= sprintf("%-40s  %4d  \$%9.2f  \$%9.2f\n", substr($p->descr, 0, 40), $supplies->qty, $p->price, ($p->price * $supplies->qty));
		$total_ext += ($p->price * $supplies->qty);
	}

	$msg .= sprintf("%-40s  %-4s  %-10s  \$%9.2f\n", "TOTAL", "", "", $total_ext);
	$msg .= "\n";

	$msg .= sprintf("If you are experiencing any problems with this online order process, please email the administrator at %s.\n",
		ADM_EMAIL);

	mail($user->login_email, $subject, wordwrap($msg), $headers);

	$subject = "Soho Repro Supply Order Merchant Copy";

	$msg .= sprintf("\nNOTE TO ADMINISTRATOR:\n");
	$msg .= sprintf("You can examine this order at:\n");
	$msg .= sprintf("http://%s%s/admin/index.php?table=supply&status=0&id=%d\n",
		$_SERVER["SERVER_NAME"],
		dirname($_SERVER["PHP_SELF"]),
		$order->id);
	$msg .= sprintf("This link will be valid for as long as the order is still pending.\n");

	mail("sid@sohorepro.com, harvey@sohorepro.com, pudel@sohorepro.com", $subject, $msg, $headers);

	unset($_SESSION["scart"]);
	unset($_SESSION["scart_meta"]);

}

include("header.inc.php");
?>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
			<td width="350">
				<span class="style1">Order Confirmation	</span><br>
				<span class="style5">Below is your confirmation of your recent order.</span><br>
				<br>
			</td>
			<td width="430">
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
	<div id="mainOrderTable">
		<div id="setupInfo">
			<div align="center" class="style16">
				<br><br><br>
			  <span class="style21">
					Thank you for your order.<br>
				  It is being processed and you will receive a confirmation email soon.				</span>
				<br />
				<br />

				<br>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.inc.php");
?>