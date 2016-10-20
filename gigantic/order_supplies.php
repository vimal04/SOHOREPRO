<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: order_supplies.php,v 1.9 2009/03/09 00:54:59 tredman Exp $
 */
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/pqp.php");
include("storeheader.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"]. SOHO_BASE_HREF . "/include/store_product.class.php");

$_SESSION["REFER"] = $_SERVER["PHP_SELF"];
?>
<script type="text/javascript">
var base_href="";
function uc() { alert("This function is under construction and not available."); }
</script>


<script type="text/javascript" src="js/base64.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/supplies.js"></script>




<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172" valign="middle">
				<img src="store_images/store_side_graphic.jpg" width="175" height="80" />
			</td>
			<td width="350" valign="middle">
				<span class="style1"> Soho Repro Store: </span><br>
				<span class="style5">Get all you need at the store. </span>			</td>
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
<?php
if ($user->id == 0) {
?>
<div id="mainContent">
<?php include($_SERVER["DOCUMENT_ROOT"]. "/include/login_table.inc.php"); ?>
</div>
<?php
} else {
	$user->get_orders(1);
	$last_supply_order = intval($user->all_orders->items[0]->id);
	$items = 0;
	$extended = 0.00;
	
	if (isset($_SESSION["scart"])) {
		foreach ($_SESSION["scart"] as $c) {
			$p = new Store_Product($c[0]);
			if ($p->id > 0) {
				$extended += ($p->price * $c[1]);
				$items += $c[1];
			}
		}
	}
?>
<div id="mainContent_store" >

	<!--
	<div id="current_opt"></div>
	<div id="diazo_opt" class="storeNavSelected" onclick="select_current(1); this.className ='storeNavSelected'" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">DIAZO REPRODUCTION</span></div>
	<div id="ilford_opt" onclick="select_current(6)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">OUTR&Eacute; COLOR IMAGING</span></div>
	<div id="binding_opt" onclick="select_current(4)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">BINDING SUPPLIES</span></div>
	<div id="color_opt" onclick="select_current(2)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">COLOR PRINTERS</span></div>
	<div id="inkjet_opt" onclick="select_current(7)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">INKJET SUPPLIES</span></div>
	<div id="copier_opt" onclick="select_current(8)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">COPIER SUPPLIES</span></div>
	<div id="plotter_opt" onclick="select_current(5)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">ENGINEERING PRINTER/PLOTTER</span></div>
	<div id="addn_opt" onclick="select_current(3)" onmouseover="this.style.backgroundColor='rgb(224,224,252)';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='transparent';this.style.cursor='auto'"><span style="margin-left:15px;">ADDITIONAL PRODUCTS</span></div>
	-->
<!--
	<div class="supplies_home_cat" id="inkjet_btn" onclick="select_current(7)" ><span>INKJET SUPPLIES</span></div>
	<div class="supplies_home_cat" id="engineering_btn" onclick="select_current(5)" ><span>ENGINEERING PRINTER/PLOTTER</span></div>
	<div class="supplies_home_cat" id="copier_btn" onclick="select_current(8)" ><span>COPIER SUPPLIES</span></div>
	<div class="supplies_home_cat" id="binding_btn" onclick="select_current(4)"><span>BINDING SUPPLIES</span></div>
	<div class="supplies_home_cat" id="diazo_btn" onclick="select_current(1)" ><span >DIAZO REPRODUCTION</span></div>
	<div class="supplies_home_cat" id="foam_btn" onclick="select_current()" ><span >Foam Board/Sketch Paper</span></div>
	<div class="supplies_home_cat" id="vellum_btn" onclick="select_current()" ><span >Vellum/Mylar Applique Film</span></div>
	<div class="supplies_home_cat" id="preprinted_btn" onclick="select_current()" ><span >Pre-Printed Title Sheets Custom Appliques</span></div>
	<div class="supplies_home_cat" id="kraft_btn" onclick="select_current()" ><span >Kraft Wrapping Paper/Letterhead Storage Boxes</span></div>
	<div class="supplies_home_cat" id="equipment_btn" onclick="select_current()" ><span >Equipment: HP Plotters KIP Printer/Copier/Scanner</span></div>
-->
	<ul class="storeNav" id="storeNav">
		<li><a href="order_supplies.php"  class="navHeader"><span>SOHO REPRO STORE</span></a></li>
		<li><a  onclick="select_current(7); highlightNav(); this.className = 'storeNavSelected';"><span>INKJET SUPPLIES</span></a></li>
		<li><a  onclick="select_current(5); highlightNav(); this.className = 'storeNavSelected';"><span>ENGINEERING PRINTER/PLOTTER</span></a></li>
		<li><a  onclick="select_current(8); highlightNav(); this.className = 'storeNavSelected';"><span>COPIER SUPPLIES</span></a></li>
		<li><a  onclick="select_current(4); highlightNav(); this.className = 'storeNavSelected';"><span>BINDING SUPPLIES</span></a></li>
		<li><a  onclick="select_current(1); highlightNav(); this.className = 'storeNavSelected';"><span >DIAZO REPRODUCTION</span></a></li>
		<li><a  onclick="select_current(); highlightNav(); this.className = 'storeNavSelected';"><span >Foam Board/Sketch Paper</span></a></li>
		<li><a  onclick="select_current(); highlightNav(); this.className = 'storeNavSelected';"><span >Vellum /Mylar /Applique Film</span></a></li>
		<li><a  onclick="select_current(); highlightNav(); this.className = 'storeNavSelected';"><span >Pre-Printed Title Sheets</span></a></li>
		<li><a  onclick="select_current(); highlightNav(); this.className = 'storeNavSelected';"><span >Kraft Wrapping /Letter Boxes</span></a></li>
		<li><a  onclick="select_current(); highlightNav(); this.className = 'storeNavSelected';"><span >Equipment: Plotters, Etc,</span></a></li>
	</ul>
</div>
<div id="mainContent_selection">
	<img id="corner_nw" src="store_images/nw.jpg">
	<img id="corner_ne" src="store_images/ne.jpg">
	<img id="corner_sw" src="store_images/sw.jpg">
	<img id="corner_se" src="store_images/se.jpg">
	<div id="selection_header">
		<div class="selection_links">					
			<!--<button onclick="location.href= 'order_details.php?h=0&amp;order_number=<?php echo($last_supply_order); ?>&amp;page=1';" class="rounded"><span>View Previous Order</span></button> -->
			<button onclick="order_hist();  highlightButton('orderHistoryButton')" class="rounded" id="orderHistoryButton"><span>Order History</span></button>
			<button onclick="view_cart(); highlightButton('viewCartButton');" class="rounded" id="viewCartButton"><span>View Cart</span></button>
			<button onclick="checkout()" class="rounded" id="checkoutButton"><span>Checkout</span></button>
		</div>
		
		<p>Welcome back, <?php echo($user->fname . " " . $user->lname); ?></p>
	</div>
	<div id="selection_content">
		
		<div id="selection_title"></div>
		
		<div id="supplies_home">			
			<div id="supplies_categories">
				<div class="supplies_home_cat" id="inkjet_btn" onclick="select_current(7)" ><span>INKJET SUPPLIES</span></div>
				<div class="supplies_home_cat" id="engineering_btn" onclick="select_current(5)" ><span>ENGINEERING PRINTER/PLOTTER</span></div>
				<div class="supplies_home_cat" id="copier_btn" onclick="select_current(8)" ><span>COPIER SUPPLIES</span></div>
				<div class="supplies_home_cat" id="binding_btn" onclick="select_current(4)"><span>BINDING SUPPLIES</span></div>
				<div class="supplies_home_cat" id="diazo_btn" onclick="select_current(1)" ><span >DIAZO REPRODUCTION</span></div>
				<div class="supplies_home_cat" id="foam_btn" onclick="select_current()" ><span >Foam Board/Sketch Paper</span></div>
				<div class="supplies_home_cat" id="vellum_btn" onclick="select_current()" ><span >Vellum/Mylar Applique Film</span></div>
				<div class="supplies_home_cat" id="preprinted_btn" onclick="select_current()" ><span >Pre-Printed Title Sheets Custom Appliques</span></div>
				<div class="supplies_home_cat" id="kraft_btn" onclick="select_current()" ><span >Kraft Wrapping Paper/Letterhead Storage Boxes</span></div>
				<div class="supplies_home_cat" id="equipment_btn" onclick="select_current()" ><span >Equipment: HP Plotters KIP Printer/Copier/Scanner</span></div>
				
				
			</div>	
					
			<div id="store_specials">	
				<p>			
					<span class="specials-header">Personalized Calendars</span>
					<span class="specials-item"> - Single Photo Calendar.</span>
				 	<span class="specials-item"> - 12 Monthly Photos.</span>
					<span class="specials-emphasis"> High-quality calendars made from your photos or digital images.</span>
				</p>				
				<p>
					<span class="specials-header">Your Plotter Paper has never been Cheaper</span>
					<span class="specials-item"> - All Brands Available Today. </span>
					<span class="specials-item"> - Fast Delivery. </span>
				 </p>				 
				 <p>
				 	<span class="specials-header">Looking to Purchase a Plotter for Your Office:</span>
					<span class="specials-emphasis"> Soho can help you build a custom solution for your office.</span> 
					<span class="specials-emphasis">Call us for full details.</span>
	 			</p>
			</div>		
		</div>
	</div>
	<div id="selection_footer">
		<div class="selection_links">
			<a href="index.php">Home</a> | <a href="contact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;
		</div>
		<div id="selection_cart"><?php printf("You have %d item%s in your cart totaling $%0.2f", $items, ($items == 1 ? "" : "s"), $extended); ?></div>
	</div>
</div>
 
<?php
}

include("footer.inc.php");
?>
