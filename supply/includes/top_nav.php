<?php
$page_names=explode("/",$_SERVER['SCRIPT_NAME']);

$pagename_pos = count($page_names)-1;

$page_name_new= $page_names[$pagename_pos];
$user_id         = $_SESSION['sohorepro_userid'];
$totoal_cart     = totalCart($user_id);
$comp_name       = getCompName($_SESSION['sohorepro_companyid']);

$pagefilename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
?>
<?php if (isset($_SESSION['sohorepro_userid'])) { ?>
<div id="" class="sticky-navigation"  style="float:left;width: <?php if($pagefilename != 'myaccount_orders') { echo "60%"; } else { echo "72%;"; } ?>; max-width: 976px;z-index: 100;">
<div style="float: left;width: 30%;">
    <ul class="navigation primary" style="float:left !important;width: 100%;">
            <li class="navLargeFormat" style=" border-bottom: none !important;">
                <a onclick="<?php if(($page_name_new == 'service_plotting.php') || ($page_name_new == 'add_recipients.php') || ($page_name_new == 'view_all_recipients.php')) { ?>return please_proceed();<?php } ?>" href="index.php" style="<?php if($page_name_new=='index.php') { echo "font-weight: bold;"; } ?>">SUPPLIES</a>
            </li>
            <li class="navLargeFormat" style=" border-bottom: none !important;">
                <a href="service_plotting.php" style="<?php if($page_name_new=='service_plotting.php') { echo "font-weight: bold;"; } ?>">SERVICES</a>
            </li>
        </ul>
</div>  
<div style="float: right;width: 70%;">        
        <ul class="navigation primary" style="float:right !important;">
            <li class="navPlotting" style=" border-bottom: none !important;">
                <a href="myaccount_orders.php" style="font-weight: bolder;color: #F00 !important;">WELCOME <?php echo strtoupper($_SESSION['sohorepro_username']); ?></a>
                <div style="float: left;width: 100%;padding: 0px;margin-top: -10px;"><?php echo $comp_name; ?></div>
                <?php if(isset($user_id) && $user_id != '') { ?>
                <div style="width: 100%;padding: 0px;margin-top: -10px; clear: both;"><a href="myaccount_orders.php" style="font-weight: bolder;color: #4788ef !important; overflow: visible;">My Account</a></div>
                <?php } ?>
            </li>
            <li class="navLargeFormat" style=" border-bottom: none !important;"><a href="service_address_book.php" style="<?php if($page_name_new=='service_address_book.php') { echo "font-weight: bold;"; } ?>">ADDRESS BOOK</a></li>
            <li class="navLargeFormat" id="cart_li" style=" border-bottom: none !important;width: 64px;"><a href="add_recipients.php" style="<?php if($page_name_new=='shoppingcart.php') { echo "font-weight: bold;"; } ?>">CART</a><div style="<?php if($_SESSION['cart_count'] == ''){ ?>display: none;<?php } ?>" id="cart_count"><?php echo $_SESSION['cart_count']; ?></div></li>
            <li class="navLargeFormat" style=" border-bottom: none !important;"><a href="help_box_logged.php" style="color:  #007F2A !important;<?php if($page_name_new=='help_box_logged.php') { echo "font-weight: bold;"; } ?>">HELP BOX</a></li>            
            <li class="navLargeFormat" style=" border-bottom: none !important;"><a href="logout.php">LOGOUT</a></li>            
        </ul>
        <div style="clear:both"></div> 
    </div>  
</div>
<?php }  else {
 ?>
<div style="float: right;">        
        <ul class="navigation primary" style="float:right !important;width: 100%;">            
            <li class="navLargeFormat" style=" border-bottom: none !important;"><a href="help_box.php" style="cursor: pointer;color:  #007F2A !important;">HELP BOX</a></li>            
        </ul>
        <div style="clear:both"></div> 
</div>   
<?php
} ?>                                                                                                                    

<div id="content_output-navigation">
<!--    <ul class="navigation primary"><li class="navPlotting"><a href="#" class=" ">PLOTTING &amp; ARCHITECTURAL COPIES</a></li>
        <li class="navLargeFormat"><a href="#" class=" ">LARGE FORMAT COLOR &amp; BW</a></li>
        <li class="navFineArts"><a href="#" class=" ">FINE ART PRINTING</a></li>
        <li class="navCopyshop"><a href="#" class=" ">COPY SHOP</a></li>
        <li class="navMounting"><a href="#" class=" ">MOUNTING &amp; LAMINATING</a></li>
        <li class="navBinding"><a href="#" class=" ">BINDING</a></li>
        <li class="navScanning"><a href="#" class=" ">SCANNING</a></li>
        <li class="navOffset"><a href="#" class=" ">OFFSET PRINTING</a></li>
    </ul>-->
    <div style="clear:both"></div>                                        				
</div>
<script>
function please_proceed()
{
    alert("You must complete your transaction and checkout BEFORE proceeding to the Supply Store.");
    return false;
}
</script>
