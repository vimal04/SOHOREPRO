<?php
$page_names=explode("/",$_SERVER['SCRIPT_NAME']);

$pagename_pos = count($page_names)-1;

$page_name_new= $page_names[$pagename_pos];
$user_id         = $_SESSION['sohorepro_userid'];
$totoal_cart     = totalCart($user_id);
$comp_name       = getCompName($_SESSION['sohorepro_companyid']);

            $original_service_pac    = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
            $original_service_lfp    = EnteredLFPPrimary($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid']);
            $original_service_fap    = EnteredPlotttingFineArts($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid']);
               if((count($original_service_pac) >"0") OR (count($original_service_lfp) >"0") OR (count($original_service_fap) >"0")){
                //  print_r($_SESSION);
                   // echo $_SESSION['cart_count'];
               }
               else{
                    //echo "no cart";
                   $_SESSION['cart_count'] = 0;
                   $_SESSION['ref_val'] ="";
               }
?>
<?php if (isset($_SESSION['sohorepro_userid'])) { ?>
<div id="" class="sticky-navigation"  style="float:left;width: 100%;z-index: 100;">
<div style="float: left;width: 30%;">
    <ul class="navigation primary" style="float:left !important;width: 100%;">
            <li class="navLargeFormat" style=" border-bottom: none !important;">
                <a <?php if(($page_name_new == 'service_plotting.php') || ($page_name_new == 'add_recipients.php') || ($page_name_new == 'view_all_recipients.php')) { ?>id="french"<?php } ?> href="supplies.php" style="<?php if($page_name_new=='index.php') { echo "font-weight: bold;"; } ?>">SUPPLIES</a>
                <!--<a onclick="<?php if(($page_name_new == 'service_plotting.php') || ($page_name_new == 'add_recipients.php') || ($page_name_new == 'view_all_recipients.php')) { ?>return please_proceed();<?php } ?>" href="supplies.php" style="<?php if($page_name_new=='index.php') { echo "font-weight: bold;"; } ?>">SUPPLIES</a>-->
            </li>
            <li class="navLargeFormat" style=" border-bottom: none !important;">
                <a href="service_plotting.php" style="<?php if($page_name_new=='service_plotting.php') { echo "font-weight: bold;"; } ?>">SERVICES</a>
            </li>
        </ul>
</div>  
<div style="float: right;width: 70%;">        
        <ul class="navigation primary" style="float:right !important;">
            <li class="navPlotting" style=" border-bottom: none !important;">
                <a href="index.php" style="font-weight: bolder;color: #F00 !important;">WELCOME <?php echo strtoupper($_SESSION['sohorepro_username']); ?></a>
                <div style="float: left;width: 100%;padding: 0px;margin-top: -10px;"><?php echo $comp_name; ?></div>
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
}  ?>                                                                                                                    

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
    <?php// echo $_SESSION['sohorepro_userid'];?>
</div><style>
    .ui-dialog .ui-dialog-titlebar-close span {
    display: block;
    margin: -8px;
}
.ui-dialog-titlebar {
    background: #F99B3E none repeat scroll 0 0 !important;
}
    </style>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css" type="text/css" />
<script src="js/jquery.easy-confirm-dialog.js"></script>

<script>
    
 $("#french").easyconfirm({locale: {
	title: 'Are you Sure?',
	text: 'Proceeding to the Supply Store prior to checking out will result in losing any entered information.',
	button: ['Cancel',' Proceed'],
        closeText: 'Close'
}});
$("#french").click(function() {
	//alert("Je vous remercie de votre soumission!");
        window.location.href="http://cipldev.com/supply-new.sohorepro.com/supply?redirect_supply=<?php echo $_SESSION['sohorepro_userid']; ?>";
});
function please_proceed()
{
    alert("You must complete your transaction and checkout BEFORE proceeding to the Supply Store.");
    return false;
}
</script>
