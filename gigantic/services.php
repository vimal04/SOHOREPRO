<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: services.php,v 1.9 2009-11-08 07:27:41 tredman Exp $
 */
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/pqp.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST["keyword"])) {
		header(sprintf("Location: http://%s.mysohoplanroom.com", $_POST["keyword"]));
		exit;
	}
}

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/service.class.php");
$service = new Service(intval($_REQUEST["svc"]));

if ($service->id == 0) {
	header("Location: service_select.php");
	die();
}

include("header.inc.php");
?>
<div id="middleImage">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172" valign="middle"><img src="images/<?php echo($service->icon_image); ?>" width="175" height="80"/></td>
			<td width="300" valign="middle">
				<span class="style1"><?php echo($service->title); ?></span><br>
				<span class="style5"><?php echo($service->subtitle); ?></span>
			</td>
			<td valign="middle">
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
			</td>
		</tr>
	</table>
</div>
<div id="mainContent">
<?php
if ($service->id == 8) {
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="bodyWhite" target="_blank">
Enter your Company Planroom below and select Go!<br />
<input type="text" id="keyword" name="keyword" />.mysohoplanroom.com <input type="submit" value="  Go!  " />
</form>
<br>
<br>
<img src="images/planroom1.jpg"><br>
<img src="images/planroom2.jpg">
<?php
} else {
	echo($service->content);
}
?>
	<?php if ($service->id != 8) { ?><div id="orderBtn"><a href="order_form.php?svc=<?php echo($service->id); ?>"><img src="images/spacer.gif" width="378" height="69" border="0"></a>	</div><?php } ?>
</div>
<?php include("footer.inc.php"); ?>