<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_details.php,v 1.9 2009/03/06 19:04:20 tredman Exp $
 */

include("header.inc.php");

require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/order.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/binding.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/service.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/nav.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/order_line.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/order_prop.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/size.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/duplex.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/delivery.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/format.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/laminate.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/mounting.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/paper.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/paper_color.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/scandpi.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/scantype.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/source.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/config.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/store_product.class.php");

$page = (intval($_REQUEST["page"]) == 0 ? 1 : $_REQUEST["page"]);
$order_number = intval($_REQUEST["order_number"]);

$user->get_open_orders();
$nav = new Nav(count($user->open_orders->items), $page);
if ($_REQUEST["h"] == 1) {
	$history = true;
} else {
	$history = false;
}
?>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172" valign="middle"><img src="images/copy_shop.jpg" width="175" height="80"/></td>
			<td width="350" valign="middle">
<?php
if ($history) {
?>
				<span class="style1">Closed Orders</span><br>
				<span class="style5">Past order history.</span>
<?php
} else {
?>
				<span class="style1">Open Orders</span><br>
				<span class="style5">Current orders pending fulfillment.</span>
<?php
}
?>
			</td>
			<td valign="middle">&nbsp;</td>
		</tr>
	</table>
</div>
<?php
if ($order_number > 0) {
	printf("<DIV ID=\"mainContent\">");
	$order = new Order($order_number);
	$order_master = new Order_Master($order->master_id);
	$user = new User($order_master->customer_id);
	if ($order->service_id < 0) {
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		printf("<tr><th>ORDER NUMBER</th><th>BILL TO</th><th>CONTACT</th><th>SERVICE</th></tr>");
		printf("<tr><td>WEB-%06d</td><td>%s</td><td>%s %s</td><td>Supply Order</td></tr>", $order->id, $user->company, $user->fname, $user->lname);
		printf("<tr><th colspan=\"2\">REFERENCE NUMBER</th><th colspan=\"2\">DELIVER BY</th></tr>");
		printf("<tr><td colspan=\"2\">%s</td><td colspan=\"2\">%s</td></tr>", $order->reference, $order->deliver_by);
		printf("<tr><th colspan=\"4\">SPECIAL INSTRUCTIONS</th></tr>");
		printf("<tr><td colspan=\"4\">%s</td></tr>", $order->instructions == "" ? "None" : $order->instructions);
		printf("</table><br>");
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		printf("<tr><th>PRODUCT</th><th>QTY</th><th>EACH</th><th>EXTENDED</th></tr>");
		$subtotal = 0;
		foreach ($order->supplies->items as $s) {
			$p = new Store_Product($s->product_id);
			printf("<tr><td align=\"left\">%s</td><td align=\"right\">%d</td><td align=\"right\">\$%0.2f</td><td align=\"right\">\$%0.2f</td></tr>", $p->descr, $s->qty, $p->price, $s->qty * $p->price);
			$subtotal += ($p->price * $s->qty);
		}
		printf("<tr><th colspan=\"3\">TOTAL</th><td align=\"right\">\$%0.2f</td></tr>", $subtotal);
		printf("</table><br>");
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		printf("<tr><th colspan=\"2\">DELIVERY ADDRESS</th></tr>");
		foreach ($order->addresses->items as $address) {
			printf("<tr><td>%s<br>Attn: %s<br>%s%s%s<br>%s, %s %s<br>%s</td>",
				$address->company,
				$address->attention,
				$address->address1,
				($address->address2 == "" ? "" : "<BR>"),
				$address->address2,
				$address->city,
				$address->state,
				$address->zip,
				$address->sphone);
			printf("</table></td></tr>");
		}
		printf("</table><br>");
		printf("<input type=\"button\" value=\"RETURN\" onclick=\"document.location='order_details.php?h=%d&page=%d&'\">", $history ? 1 : 0, $page);
		printf("&nbsp;<input type=\"button\" value=\"DUPLICATE THIS ORDER\" onclick=\"if(confirm('Are you sure you want to duplicate this order?')) document.location='order_dupe.php?id=%d'\">", $order->id);
		printf("</DIV>");
	} else {
		$service = new Service($order->service_id);
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		printf("<tr><th>ORDER NUMBER</th><th>BILL TO</th><th>CONTACT</th><th>SERVICE</th></tr>");
		printf("<tr><td>WEB-%06d</td><td>%s</td><td>%s %s</td><td>%s</td></tr>", $order->id, $user->company, $user->fname, $user->lname, $service->title);
		printf("<tr><th colspan=\"2\">REFERENCE NUMBER</th><th colspan=\"2\">DELIVER BY</th></tr>");
		printf("<tr><td colspan=\"2\">%s</td><td colspan=\"2\">%s</td></tr>", $order->reference, $order->deliver_by);
		printf("<tr><th colspan=\"4\">SPECIAL INSTRUCTIONS</th></tr>");
		printf("<tr><td colspan=\"4\">%s</td></tr>", $order->instructions == "" ? "None" : $order->instructions);
		printf("</table><br>");
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		foreach ($order->properties->items as $props) {
			$objname = ucfirst($props->name);
			$obj = new $objname($props->value);
			printf("<tr><th align=\"right\">%s</th><td>%s</td>", strtoupper($props->name), $obj->descr);
		}
		printf("</table><br>");
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		printf("<tr><th>Originals</th><th>Duplicates</th><th>Size</th><th>Attachment</th></tr>");
		$offset = $order->lines->items[0]->id;
		foreach ($order->lines->items as $lines) {
			$size = new Size($lines->size_id);
			$dir = opendir($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/uploads");
			$attachment = "";
			while (($file = readdir($dir)) !== false) {
				if (substr($file, 0, 13) == sprintf("WEB-%06d-%02d", $order->id, $lines->id - $offset)) {
					$attachment = $file;
				}
			}
			printf("<tr><td align=\"center\">%d</td><td align=\"center\">%d</td><td align=\"center\">%s</td><td align=\"center\"><a class=\"darklink\" href=\"uploads/%s\" target=\"_blank\">%s</a></td></tr>", $lines->originals, $lines->duplicates, $size->descr, $attachment, $attachment);
		}
		printf("</table><br>");
		printf("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"600\" class=\"order_table\">");
		printf("<tr><th colspan=\"2\">DELIVERY ADDRESSES</th></tr>");
		foreach ($order->addresses->items as $address) {
			printf("<tr><td>%s<br>Attn: %s<br>%s%s%s<br>%s, %s %s<br>%s</td>",
				$address->company,
				$address->attention,
				$address->address1,
				($address->address2 == "" ? "" : "<BR>"),
				$address->address2,
				$address->city,
				$address->state,
				$address->zip,
				$address->sphone);
			printf("<td align=\"right\"><table cellpadding=\"2\" cellspacing=\"2\" border=\"0\"><tr><td width=\"150\"><b>SIZE</b></td><td width=\"150\"><b>QTY</b></td></tr>");
			foreach ($address->delivery_counts->items as $delivery_count) {
				$size = new Size($delivery_count->size_id);
				printf("<tr><td>%s</td><td>%d</td></tr>", $size->descr, $delivery_count->copy_count);
			}
			printf("</table></td></tr>");
		}
		printf("</table><br>");
		printf("<input type=\"button\" value=\"RETURN\" onclick=\"document.location='order_details.php?h=%d&page=%d&'\">", $history ? 1 : 0, $page);
		printf("&nbsp;<input type=\"button\" value=\"DUPLICATE THIS ORDER\" onclick=\"if(confirm('Are you sure you want to duplicate this order?')) document.location='order_dupe.php?id=%d'\">", $order->id);
		printf("</DIV>");
	}
} else {
?>
<div id="mainContent">
<?php
	printf("%s", $nav->to_string());
?>
	<table width="800" cellpadding="2" cellspacing="2" border="0" class="order_table">
		<tr>
			<th>MASTER ORDER</th>
			<th>ORDER NUMBER</th>
			<th>PLACED</th>
			<th>SERVICE</th>
			<th>REFERENCE</th>
		</tr>
<?php
	if ($history) {
		$user->get_closed_orders($page);
		$order_list = $user->closed_orders;
	} else {
		$user->get_open_orders($page);
		$order_list = $user->open_orders;
	}
	$graybar = "rgb(224,224,255)";
	foreach ($order_list->items as $oo) {
		$order_master = new Order_Master($oo->master_id);
		printf("<tr>");
		printf("<td align=\"center\" style=\"background-color:%s\">SOHO-%06d</td>", $graybar, $order_master->id);
		printf("<td align=\"center\" style=\"background-color:%s\"><b><a href=\"order_details.php?h=%d&order_number=%d&page=%d\" class=\"order_link\">WEB-%06d</a></b></td>", $graybar, $history ? 1 : 0, $oo->id, $page, $oo->id);
		printf("<td align=\"center\" style=\"background-color:%s\">%s</td>", $graybar, str_replace("|", "<br>", date("m/d/Y|g:i A", strtotime($order_master->order_date))));
		$service = new Service($oo->service_id);
		printf("<td align=\"center\" style=\"background-color:%s\">%s</td>", $graybar, ($service->title == "" ? "Supply Order" : $service->title));
		printf("<td align=\"center\" style=\"background-color:%s\">%s</td>", $graybar, $oo->reference);
		printf("</tr>");
		if ($graybar == "rgb(224,224,255)") {
			$graybar = "rgb(224,224,224)";
		} else {
			$graybar = "rgb(224,224,255)";
		}
	}
?>
	</table>
</div>
<?php
}

include("footer.inc.php");
?>