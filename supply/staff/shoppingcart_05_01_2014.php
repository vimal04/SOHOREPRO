<?php
include './admin/config.php';
include './admin/db_connection.php';
$_SESSION['job'] = $_REQUEST['jobref'];
$_SESSION['qty'] = $_REQUEST['quantity'];
$job_reference   = $_REQUEST['jobref'];
$user_id         = $_SESSION['sohorepro_userid'];
$company_id      = $_SESSION['sohorepro_companyid'];
$shipping_address = ShippingAddressAll($company_id);
$shipping_size    = count($shipping_address);
$primary_shipping = PrimaryShipping($company_id);
$comp_name = companyName($company_id);
$address_shipp = ($shipping_size == 1) ? $shipping_address[0]['id'] : '0' ;


if ($_REQUEST['order_val'] == '1') {   
//$sql = "DELETE FROM sohorepro_checkout WHERE user_id = " . $user_id . " ";
//mysql_query($sql);
for ($i = 0; $i < count($_REQUEST['product_id']); $i++) {
    if ($_REQUEST['quantity'][$i] != '') {
        $chk_pid = checkPid($_REQUEST['product_id'][$i], $user_id);
        if (count($chk_pid) < 1) {
            $query = "INSERT INTO sohorepro_checkout SET product_id     = '" . $_REQUEST['product_id'][$i] . "', quantity = '" . $_REQUEST['quantity'][$i] . "', unit_price = '" . $_REQUEST['price'][$i] . "', user_id = '" . $user_id . "', company_id = '" . $company_id . "', reference = '" . $job_reference . "', shipping_add_id = '" . $address_shipp . "'   ";
            mysql_query($query);
        }
    }
}

}
?>


<?php
$checkout_product = checkOut($user_id);
$reference        = $checkout_product[0]['reference'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:44:50 GMT -->
 <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
 <head>
 <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
 <title> SohoRepro </title>

 <!-- base href="http://soho.thinkdesign.com/" -->

 <link rel="stylesheet" href="store_files/style.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/theme.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/jquery.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/tiptip.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/ajaxLoader.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/flexigrid.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/ui.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/slick.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/kendo.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/kendo_002.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/style_002.css" type="text/css" media="screen">
 <script type="text/javascript" src="store_files/scripts.js"></script>
 <script src="store_files/jquery.min.js"></script>
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="tooltip/core.js"></script>
 <script type="text/javascript" src="tooltip/csscoordinates.js"></script>
 <script type="text/javascript" src="tooltip/displaycontroller.js"></script>
 <script type="text/javascript" src="tooltip/placementcalculator.js"></script>
 <script type="text/javascript" src="tooltip/tooltipcontroller.js"></script>
 <script type="text/javascript" src="tooltip/utility.js"></script>
<link rel="stylesheet" type="text/css" href="tooltip/jquery.powertip.css" />
 <style type="text/css">
.btn_shopping{background:url(images/button.jpg) no-repeat right; width:154px; height:28px; float: right; font-family:Arial; font-size:11px; font-weight:bold; color:#ffffff; border:0px; cursor:pointer; text-transform:uppercase;}
.product_table{font-family:Arial; font-size:13px; line-height:20px; color:#59432d; border:1px solid #ffc68f; border-right:0px;}
.product_table td{ padding:5PX;}
.product_table .h1{ color:#fff; font-size:14px; text-transform:uppercase;}
.product_table input[type="text"]{ width:20px; height:20px; line-height:20px; padding:0px 5px; border:1px solid #999999; color:#59432d;}
.product_table .brdr_1{ border-top:1px solid #fff; border-right:1px solid #ffc68f;}
.product_table .brdr_2{ border-right:1px solid #ffc68f;}
.product_table .brdr_3{ border-top:1px solid #ffc68f; border-right:1px solid #ffc68f;}
.product_table input[type="button"]{ background:url(images/remove_btn1.png) no-repeat center; width:72px; height:23px; border:0px; 
font-size:0px; cursor:pointer; line-height:16px;}
.first{font-family:Arial; font-size:14px; line-height:26px; color:#0b0b0b;}
.first .brdr_4{ padding-right:20px;}
.product_table .pad_none{ padding:2px !important;}
.product_table .pad_none td{ padding:3px 5px !important;}
.last_btn{width:250px; border-right:1px solid #ffc68f;}
.last_btn input[type="button"]{ background:url(images/placeholder.png) no-repeat; width:123px; height:28px; border:0px; color:#ffffff; font-size:11px;}
.clearart{font-family:Arial; font-size:11px; font-weight:bold; color:#ffffff; border:0px; cursor:pointer; text-transform:uppercase;}
.first .grand_total{ padding-left:20px !important;}
.increse_act{width: 12px;float: right;}
.increse_act img{width: 12px;float: left;}
.none{display: none;}
.order_placing{border: 1px solid #64911c; /* stroke */
background-color: #94cc3a; /* color overlay */
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
padding:4px 8px;
float:left;
height:22px;
line-height:22px;
color:#fff;
font-size: 16px;
}
.order_placing p{ float: left; margin-right: 50px; line-height:22px;font-size: 17px;font-weight: bold;color: #FF0000;}
.pointer{cursor: pointer;}
</style>

 <link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">
 <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
 <!--[if IE 7]>
 <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
 <![endif]-->
 <script type="text/javascript">
		$(function() {			
                    $('.south').powerTip({ placement: 's' });			
		});
	</script>
 </head>
 <body>
 <div id="body_container">
 <div id="body_content" class="body_wrapper">
 <div id="body_content-inner" class="body_wrapper-inner">

<?php include "includes/header_sidebar.php"; ?>
 
 <div id="content_output">

<?php include "includes/top_nav.php"; ?>
 
 <div id="content_output-data" style="margin-bottom:20px;">  
<!--- TABLE START -->
<div id="cart_tabl">
<table width="740" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td align="left" valign="middle" height="55" >
          <span id="loading" class="none"><img src="images/loading.gif" /></span>
          <div class="none order_placing" id="order_placing"><p>Order has been successfully placed</p><a href="index.php"><img src="images/btn_ok.png" title="OK" alt="OK"/></a></div>
          <input type="button" onclick="return continue_shopping('<?php echo $user_id; ?>');" class="btn_shopping" value="Contiune Shopping" />
      </td>
  </tr>
  <tr>
  <td align="left" valign="top">
  <table width="740" border="0" cellspacing="0" cellpadding="0" class="product_table" >
  <tr bgcolor="#ff7e00" class="h1">    
      <input type="hidden" name="ref" id="ref" value="<?php echo $reference; ?>" />
    <td width="46" align="center" valign="middle" class="brdr_2" >SKU Id</td>
    <td width="200" align="left" valign="middle" class="brdr_2">Product Name</td>
    <td width="78" align="center" valign="middle" class="brdr_2">Unit Price</td>
    <td width="50" align="center" valign="middle" class="brdr_2">Qty</td>
    <td width="76" align="center" valign="middle" class="brdr_2">Line Price</td>
    <td width="183" align="left" valign="middle" class="brdr_2">Shipping Address</td>
    <td width="90" align="center" valign="middle" class="brdr_2">Option</td>
  </tr>
      <?php
            $i = 1;
            if (count($checkout_product) > 0) {
                foreach ($checkout_product as $chk) {
                    $rowColor   = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                    $id         = $chk['id'];
                    $user_id    = $chk['user_id'];
                    $comp_id    = COMPID($user_id);
                    $super_id = getsuper($chk['product_id']);
                    $cat_id = getcat($chk['product_id']);
                    $sub_id = getsub($chk['product_id']);
                    $super_name = getsuperN($super_id);
                    $cat_name = getcatN($cat_id);
                    $sub_name = getsubN($sub_id);
                    $product_id = $chk['product_id'];
                    $_SESSION['product_id'] = $chk['product_id'];
                    $sku_id = getSku($chk['product_id']);
                    $product_name = getProName($chk['product_id']);
                    $tail         = $product_name;
                    $quantity = $chk['quantity'];
                    $unit_price = $chk['unit_price'];
                    $price = getPriceCkt($user_id);
                    $cart_val = totalCart($user_id);
                    $tax_status = getTaxStatusChk($comp_id);
                    if($tax_status == '1')
                    {
                    $tax_line = '8.875';    
                    }  else {
                    $tax_line = '0';       
                    }
                    $tax         = ($tax_line * ($price[0]['sub_total']/100));
                    $grand_tot   = ($price[0]['sub_total'] + $tax);                     
                    ?>
  <tr bgcolor="<?php echo $rowColor; ?>">
    <span class="user_id" id="<?php echo $user_id; ?>" style="display: none;"></span>
    <span class="product_id" id="<?php echo $product_id; ?>" style="display: none;"></span>    
    <td width="46" align="center" valign="top" class="brdr_1"><?php echo $sku_id; ?></td>
    <td width="200" align="left" valign="top" class="brdr_1"><span class="pointer south" title="<?php echo $super_name.'->'.$cat_name.'->'.$sub_name.'->';  ?><?php echo str_replace('"',"'",$tail); ?>" alt="<?php echo $super_name.'->'.$cat_name.'->'.$sub_name;  ?>"><?php echo $product_name; ?></span></td>
    <td width="78" align="right" valign="top" class="brdr_1"><?php echo $unit_price; ?></td>
    <td width="50" align="center" valign="top" class="brdr_1"><input type="text" class="qty_txt" id="qty_val_<?php echo $id; ?>" value="<?php echo $quantity; ?>"><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $id; ?>','<?php echo $unit_price; ?>','<?php echo $price[0]['sub_total']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $id; ?>','<?php echo $unit_price; ?>','<?php echo $price[0]['sub_total']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div>
    <td width="76" align="right" valign="top" class="brdr_1"><span id="line_prc_<?php echo $id; ?>"><?php echo number_format(($quantity * $unit_price), 2, '.', ''); ?></span></td>
    <td width="183" align="left" valign="top" class="brdr_1">
        <select name="shipping" id="shipping_<?php echo $product_id ?>" class="add_select shipping_<?php echo $product_id ?>" onchange="select_address('<?php echo $product_id ?>','<?php echo $user_id ?>');">
            <option value="0" >Select Shipping Address</option>
            <?php foreach ($shipping_address as $address) { 
                if($shipping_size == 1){ ?>
                  <option value="<?php echo $address['id'] ?>" selected="selected"><?php echo $address['company_name']; ?></option>  
                <?php }  else {    
                if ($address['id'] == $chk['shipping_add_id']) {
                ?>
                <option value="<?php echo $address['id'] ?>" selected="selected"><?php echo $address['company_name']; ?></option>
            <?php }else{ ?>
                <option value="<?php echo $address['id'] ?>" ><?php echo $address['company_name']; ?></option>
            <?php 
            }            
                }                
            } 
            ?><option value="N" >Enter a new address</option>
        </select></br>   
        <?php $select_address = SelectIdAddress($chk['shipping_add_id']);
        if(count($select_address) == '1'){
        echo $select_address[0]['company_name'].'</br>'.$select_address[0]['attention_to'].'</br>'.$select_address[0]['address_1'].'</br>'.$select_address[0]['address_2'].'</br>'.$select_address[0]['address_3'].'</br>'.$select_address[0]['city'].',  '.StateName($select_address[0]['state']).',  '.$select_address[0]['zip']; 
        }
        ?>
        <!--<span id="shipping_select_<?php echo $product_id ?>" class="jass none shipping_select_<?php echo $product_id ?>"><?php //echo $comp_name.'</br>'.$primary_shipping[0]['attention_to'].'</br>'.$primary_shipping[0]['address_1'].'</br>'.$primary_shipping[0]['address_2'].'</br>'.$primary_shipping[0]['address_3'].'</br>'.$primary_shipping[0]['city'].',  '.StateName($primary_shipping[0]['state']).',  '.$primary_shipping[0]['zip']; ?></span>-->        
    </td>
    <td width="90" align="center" valign="top" class="brdr_1"><input type="button" onclick="delete_product(<?php echo $product_id; ?>,<?php echo $user_id; ?>);" /></td>
  </tr>
  <?php
                    $i++;
                }
            }
 else {         ?>
      <tr align="center" bgcolor="#fff6f0">
          <td colspan="7" class="brdr_1">No Products Found</td>
      </tr> 
 <?php } ?>
  <tr bgcolor="#ffeee1">    
    <td colspan="5" align="right" valign="top" class="brdr_3 pad_none">
        <table width="210" border="0" cellspacing="0" cellpadding="0" class="first">
      <tr>
            <td width="85" valign="top" align="right" >Sub Total</td>
            <td width="40" align="right" class="brdr_4 pad_none"><span id="sub_total"><?php echo '$'.number_format($price[0]['sub_total'], 2, '.', ''); ?></span><input type="hidden" id="sub_total_txt" value="<?php echo number_format($price[0]['sub_total'], 2, '.', ''); ?>" /></td>
     </tr>
      <tr>
            <td width="40" valign="top" align="right" bgcolor="" class="tax">Tax</td>
            <td width="20" align="right" class="new"><span id="tax"><?php echo '$' .number_format($tax, 2, '.', ''); ?></span></td>
        </tr>
     <tr>
        <td width="74" valign="top" align="right" bgcolor="">Grand Total</td>
        <td width="40" align="right" class="grand_total" align="center"><span id="grand"><?php echo '$' . number_format(($price[0]['sub_total'] + $tax), 2, '.',''); ?></span></td>
      </tr>
    </table></td>
    <td colspan="2" align="center" valign="center" class="brdr_3 last_btn">
    <input type="button" class="clearart" value="Clear Cart" onclick="clear_cart(<?php echo $product_id; ?>,<?php echo $user_id; ?>);" />
    <input type="button" class="clearart cartattr" value="Checkout" onclick="finalize('<?php echo $user_id; ?>','<?php echo $comp_id; ?>','<?php echo $reference; ?>');" />   
    <!--<a href="test_cart.php?user_cart_id=<?php //echo $user_id; ?>&company_id=<?php //echo $comp_id; ?>&reference=<?php //echo $job_reference; ?>">Test Cart</a>-->
    <input type="hidden" name="cart_val" id="cart_val" value="<?php echo $cart_val; ?>"/>
    </td>
    </tr>
    </table>
</td>
  </tr>
</table>
</div>


     
     
     
<!-----TABLE END--->     
 </div>

 <div class="clear"></div>
 </div>
 <div class="clear"></div>

 <div class="footerSRwapper" style="margin:auto;height:61px;">
 <div id="body_footer-inner" class="body_wrapper-inner">
 <ul class="navigation footer">
 <li><a href="#"><span>About SohoRepro</span></a></li>
 <li><a href="#"><span>FAQs</span></a></li>
 <li><a href="#"><span>Privacy Policy</span></a></li>
 <li><a href="#"><span>Security</span></a></li>
 <li><a href="#"><span>Terms of Use</span></a></li>
 <li><a href="#"><span>Contact</span></a></li>
 <div class="clear"></div>
 </ul>
 </div>
 </div>

 </div>
 </div>
 <div class="clear"></div>



 </div>

 <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>






 <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-helper-hidden-accessible"></div><ul style="z-index: 4; top: 0px; left: 0px; display: none;" aria-activedescendant="ui-active-menuitem" role="listbox" class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all"></ul></body>
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
 </html>
<script>
            function delete_product(product_id, user_id)
            {

                var con = confirm("Are you sure?");
                if (con == true)
                {
                    $.ajax
                            ({
                                type: "POST",
                                url: "delete_check_prod.php",
                                data: "product_id=" + product_id + "&user_id=" + user_id,
                                success: function(option)
                                {
                                    var myarr       = option.split("~");                                    
                                    $('#remove_product').html(myarr[0]);
                                    $('#cart_tabl').html(myarr[1]);                                    
                                }
                            });


                }
            }

            function clear_cart(product_id, user_id)
            {

                var con = confirm("Are you sure?");
                if (con == true)
                {
                    $.ajax
                            ({
                                type: "POST",
                                url: "clear_cart_prod.php",
                                data: "product_id_clear=" + product_id + "&user_id_clear=" + user_id,
                                success: function(option)
                                {

                                    var myarr       = option.split("~");                                    
                                    $('#remove_product').html(myarr[0]);
                                    $('#cart_tabl').html(myarr[1]);  
                                }
                            });


                }
            }


       function increase_qty(id,unit_prc,sub_total)
            {
            var counter = $('#qty_val_'+id).val();
//            var inc     = confirm('Are you sure you want to increase this quantity?');
//            if (!inc)
//                {
//                    return false;
//                }
//            else
//                {
                    counter++ ;
                    $('#qty_val_'+id).val(counter);                    
                    var line    = (Number(unit_prc)*Number(counter));
                    var sub_tot = ((Number(sub_total)+Number(line)) - Number(unit_prc));
                    
                     $.ajax
                            ({
                                type: "POST",
                                url: "quantity_increase.php",
                                data: "id=" + id + "&quantity=" + counter,
                                success: function(option)
                                {
                                    var myarr       = option.split("~");
                                    $('#line_prc_'+id).html(myarr[0]);
                                    $('#sub_total').html(myarr[1]);
                                    $('#tax').html(myarr[2]);
                                    $('#grand').html(myarr[3]);
                                    $('#sub_total_txt').val(sub_tot.toFixed(2));
                                    $('#cart_val').val(myarr[4]);                                    
                                }
                            });
                    
                    
                //}
            }
            
        function decrease_qty(id,unit_prc,sub_total)
            {
            var counter  = $('#qty_val_'+id).val();
            var sub_temp = document.getElementById('sub_total_txt').value;
//            var dec     = confirm('Are you sure you want to decrease this quantity?');
//            if(!dec)
//                {
//                    return false;
//                }
//            else
//                {
                    counter-- ;
                    if(counter != '0')
                    {
                    $('#qty_val_'+id).val(counter);
                    var line    = (Number(unit_prc)*Number(counter));
                    var sub_tot = (Number(sub_temp)-Number(unit_prc));
                    
                     $.ajax
                            ({
                                type: "POST",
                                url: "quantity_increase.php",
                                data: "id=" + id + "&quantity=" + counter,
                                success: function(option)
                                {
                                    var myarr       = option.split("~");
                                    $('#line_prc_'+id).html(myarr[0]);
                                    $('#sub_total').html(myarr[1]);
                                    $('#tax').html(myarr[2]);
                                    $('#grand').html(myarr[3]);
                                    $('#sub_total_txt').val(sub_tot.toFixed(2)); 
                                    $('#cart_val').val(myarr[4]);     
                                }
                            });
                    
                    }   
                //}
            }


function finalize(user_id,company_id,reference)
            {
                
                $(".cartattr").attr('disabled', 'disabled');
                //var con = confirm("Are you sure?");
//                if (con == true)
//                {
//                    //alert(user_id);
                    $.ajax
                            ({
                                type: "POST",
                                url: "cart_order.php",
                                data: "user_cart_id=" + user_id+"&company_id="+company_id+"&reference="+reference,
                                beforeSend: loadStart,
                                complete: loadStop,
                                success: function(option)
                                {                                      
                                      if(option == '0'){                                          
                                          $('#order_placing').css("display","inline-block");                                          
                                      }                            
                                }
                            });


               // }
            }

function loadStart() {
  $('#loading').show();
}

function loadStop() {
  $('#loading').hide();
}

function select_address(id,user_id)
{
    var shipping_id = $("#shipping_"+id).val();
    if (shipping_id != '0')
            {
            $.ajax
                ({
                    type: "POST",
                    url: "quantity_increase.php",
                    data: "address_id=" + shipping_id+"&product_id="+id+"&user_id="+user_id,
                    success: function(option)
                    {     
                        var myarr       = option.split("~");
                        $("#shipping_select_"+id).css("display","inline-block");
                        $("#shipping_select_"+id).html(myarr[0]); 
                        //$(".jass").html(myarr[0]); 
                        window.location = "shoppingcart.php";
                        
                    }
                });
            }
          if (shipping_id == 'N'){
          window.location = "add_address.php";
          }  
            else
            {       $("#shipping_primary_"+id).css("display","inline-block");
                    $("#shipping_select_"+id).css("display","none");
            }
}

function continue_shopping(id)
{
    var sub_tot = document.getElementById('sub_total_txt').value;
    var cart_tot = document.getElementById('cart_val').value; 
    var ref = document.getElementById('ref').value; 
    window.location = "index.php?id="+id+"&sub="+sub_tot+"&cart="+cart_tot+"&refere="+ref;
}


function show_forgot(str)
 {
 if(str==0)
 {
 $("#forgot_form").show();
 $("#login_form").hide();
 }
 else
 {
 $("#forgot_form").hide();
 $("#login_form").show();
 }
 }

</script>