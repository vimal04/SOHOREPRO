<?php
include './config.php';
include './auth.php';
$sort_date      = ($_REQUEST['sort'] == 'a') ? 'd' : 'a';
$sort_date_img  = ($_REQUEST['sort'] == 'a') ? 'down' : 'up';

$sort_jrn   = ($_REQUEST['sort'] == 'jna') ? 'jnd' : 'jna';
$sort_jrn_img  = ($_REQUEST['sort'] == 'jna') ? 'down' : 'up';

$sort_prc   = ($_REQUEST['sort'] == 'pa') ? 'pd' : 'pa';
$sort_prc_img  = ($_REQUEST['sort'] == 'pa') ? 'down' : 'up';

$Orders = getOrdersAll($_REQUEST['sort']);



if ($_GET['tax_status']) {

    $tax_id = $_GET['tax_status'];
    $sql = "UPDATE sohorepro_product_master SET tax_status = '0' WHERE order_id = " . $tax_id . " ";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_tax";
    } else {
        $result = "failure_tax";
    }
}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Soho-repro</title>
<link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<style>
.fancybox-inner{ width:644px !important; float:left !important; height:500px !important;}
.fancybox-wrap {left: 360px !important;}
.fancyboxc-inner{ width:300px !important; float:left !important; height:260px !important;}
.fancyboxc-wrap {left: 360px !important;}
.fancyboxc-skin {
border: 3px solid #F99B3E !important;
-webkit-border-radius: 5px !important;
-moz-border-radius: 5px !important;
border-radius: 5px !important;
}
.pad_lft_j{ padding-left:20px; }
.pad_rght_j{ padding-right:15px; }
.brdr1{ border:1px solid #e1e1e1;}
.brdr-top_j{ border-top:0px !important;}
.brdr-lft_j{ border-left:0px !important;}
.add_pro{font-size: 14px;color: #ff9600;font-weight: bold;text-decoration: none;}
.close_order {
	-moz-box-shadow: 0px 0px 0px 0px #3dc21b;
	-webkit-box-shadow: 0px 0px 0px 0px #3dc21b;
	box-shadow: 0px 0px 0px 0px #3dc21b;
	background-color:#44c767;
	-moz-border-radius:11px;
	-webkit-border-radius:11px;
	border-radius:11px;
	border:1px solid #18ab29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:17px;
	font-weight:bold;
	padding:5px 24px;
	text-decoration:none;
	text-shadow:1px 2px 2px #2f6627;
        float: right;
        margin-top: 25px;
}
.close_order:hover {
	background-color:#5cbf2a;
}
.close_order:active {
	position:relative;
	top:1px;
}
.pointer{cursor: pointer;}
/* .trail:hover {font-size: 16px; cursor: pointer;} */
</style>
</head>
<body>
    <?php
if($_GET['ord_id'] != ''){
    $order_id = $_GET['ord_id'];
    ?>
<input type="hidden" name="ord_id" id="ord_id" value="<?php echo $order_id; ?>" />
<script type="text/javascript">
$(document).ready(function()
{   
    var val  = document.getElementById('ord_id').value; 
    $(".trigger").next(".test_"+val).fadeToggle('slow').siblings(".test_"+val).hide();
});
</script>
<?php    
}         
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <table width="960" border="0" cellspacing="0" cellpadding="0" style="min-width:760px;">
      <tr>
        <td width="198" align="left" valign="top" bgcolor="#464646"><table width="198" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="181" align="left" valign="top"><img src="images/logo.jpg" width="198" height="181"  alt=""/></td>
          </tr>
          <tr>
            <td align="left" valign="top">
                <?php include "sidebar_menu.php"; ?>
            </td>
          </tr>
          <tr>
            <td align="left" valign="middle" style="min-height:280px; float:left;"></td>
          </tr>
        </table></td>
        <td width="3" align="left" valign="top" bgcolor="#FFFFFF"></td>
        <td width="759" align="left" valign="top" bgcolor="#FFFFFF"><table width="759" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="48" align="center" valign="middle" bgcolor="#5f5f5f" class="heading">
            ADMINISTRATOR PAGE
            </td>
          </tr>
          <tr>
            <td height="38" align="center" valign="middle" bgcolor="#8b8b8b" class="sub_heading">
                OPEN ORDERS
                <span style="float: right;padding-right: 5px;">Welcome <?php if($_SESSION['admin_user_type'] == '1'){echo 'admin';} if($_SESSION['admin_user_type'] == '2'){echo 'Staff User';}?> |<a href="logout.php" style="text-decoration:none;color:#fff;">&nbsp;Logout</a></span>
            </td>
          </tr>
          <tr>
              <td>
                  <?php
                  
                    if ($_GET['delete_id']) {
                    $delete_id = $_GET['delete_id'];
                    $ord_id = $_GET['ord_id'];
                    $sql = "DELETE FROM sohorepro_product_master WHERE id = " . $delete_id . " ";
                    $sql_result = mysql_query($sql);
                    if ($sql_result) {
                        $result = "success_del";
                    } else {
                        $result = "failure_del";
                    }
                    if ($result == "success_del") {
                        ?>
                        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Deleted Successfully</div>
                        <script>setTimeout("location.href=\'open_orders.php?ord_id=<?php echo $delete_id; ?>&ord_id=<?php echo $ord_id; ?>\'", 1000);</script>
                        <?php
                    } elseif ($result == "failure_del") {
                        ?>
                        <div style="color:#F00; text-align:center; padding-bottom:10px;">Not Deleted</div>
                        <script>setTimeout("location.href=\'open_orders.php?ord_id=<?php echo $delete_id; ?>&ord_id=<?php echo $ord_id; ?>\'", 1000);</script>       
                        <?php
                    }
                    
                    }
                    ?>
                      <?php
                    if ($result == "success_tax") {
                        ?>
                        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Tax has been removed in this order</div>
                        <script>setTimeout("location.href=\'open_orders.php\'", 1000);</script>
                        <?php
                    } elseif ($result == "failure_tax") {
                        ?>
                        <div style="color:#F00; text-align:center; padding-bottom:10px;">Tax has been not removed in this order</div>
                        <script>setTimeout("location.href=\'open_orders.php\'", 1000);</script>       
                        <?php
                    }
                    ?>
              </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table width="759" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="open_orders.php?sort=<?php echo $sort_jrn; ?>">ORDER NUMBER&nbsp;<img src="images/<?php echo $sort_jrn_img ; ?>.png"  alt="" width="10px" height="5px"/></a></td>
                <td width="120" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="open_orders.php?sort=<?php echo $sort_date; ?>">DATE &nbsp;<img src="images/<?php echo $sort_date_img ; ?>.png"  alt="" width="10px" height="5px"/></a></td>                
                <td width="189" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="open_orders.php?sort=<?php echo $sort_prc; ?>">Customer&nbsp;<img src="images/<?php echo $sort_prc_img ; ?>.png"  alt="" width="10px" height="5px"/></a></td>
                <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="open_orders.php?sort=<?php echo $sort_jrn; ?>">JOB REFERENCE&nbsp;<img src="images/<?php echo $sort_jrn_img ; ?>.png"  alt="" width="10px" height="5px"/></a></td>                
              </tr>
              <?php
               $i = 1;
               if(count($Orders) > 0){
               foreach ($Orders as $order){
               $rowColor = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
               $rowColor1 = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
               $id = $order['id'];
               $id_shipp    = $order['id'];
               $order_id = $order['order_id'];
               $order_numer = $order['order_number'];
               //$date = date("m-d-Y h:m A", strtotime($order['created_date']));
               $shipping_price = $order['shipping_price'];
               $current_time = $order['created_date'];
               $datew = new DateTime($current_time, new DateTimeZone('America/New_York'));
               date_default_timezone_set('America/New_York');
               $temp_times =  date("Y-m-d h:iA", $datew->format('U'));
               $date = date("m-d-Y", strtotime($order['created_date'])). ' ' .date("h:iA",strtotime("-180 minutes",strtotime($temp_times)));               
               $customer = (companyName($order['customer_company']) != '') ? companyName($order['customer_company']) : 'Guest User';
               $price = getPrice($id);
               $tax_status = getTaxStatusChk($order['customer_company']);
               $cas_customer = $order['cash_customer'];
               if($tax_status == '1')
               {
               $tax_line = '8.875';    
               }
               elseif($cas_customer == '1')
                {
                 $tax_line = '8.875';      
                 }
                 else 
                {
                 $tax_line = '0';       
                 }
               $tax         = ($tax_line * ($price[0]['sub_total']/100));
               $grand_tot   = ($price[0]['sub_total'] + $tax);               
               
          ?>
             
              <tr class="trigger"  id="<?php echo $id; ?>">               
                <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor;  ?>"   valign="middle"><?php echo $order_numer; ?></td>             
                <td width="176" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>"  valign="middle"><?php echo $date; ?></td>                                    
                <td width="109" height="36" align="center" bgcolor="<?php echo $rowColor;  ?>"   valign="middle"><?php echo $customer; ?></td>                
                <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>"  valign="middle"><span class="refj_<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $order_id; ?></span></td>
              </t>
                <?php
              $toggle_id = viewOrders($id);             
              $ord_id = $toggle_id[0]['order_id'];             
              ?>           
              <tr class="toggle test_<?php echo $ord_id; ?>">
                <td colspan="4" align="center">                     
                        <table width="755" align="center" cellspacing="0" cellpadding="0" style="margin:10px 0px; padding: 10px; border: 2px solid #F99B3E;">
                            <?php
                            $sql_id         = mysql_query("SELECT id,order_id,created_date,order_number,customer_name,customer_company,staff_id,cash_customer FROM sohorepro_order_master WHERE id = '".$ord_id."'");
                            $object         = mysql_fetch_assoc($sql_id);
                            $Order_id       = $object['order_id'];
                            $ref_serial     = $object['id'];
                            $Order_number   = $object['order_number'];
                            $cust_dtls      = customerName($object['customer_name']);
                            $staf_init      = CusInit($object['staff_id']);
                            $company_name   = companyName($cust_dtls[0]['cus_compname']);
                            $cus_name       = $cust_dtls[0]['cus_contact_name'];
                            $cash_customer  = $object['cash_customer'];
                            
                            $cus_add_1      = ($cust_dtls[0]['cus_bill_address1'] != '') ? $cust_dtls[0]['cus_bill_address1'] : '';
                            $cus_add_2      = ($cust_dtls[0]['cus_bill_address2'] != '') ? $cust_dtls[0]['cus_bill_address2'] : '';
                            $cus_city       = ($cust_dtls[0]['cus_bill_city'] != '') ? $cust_dtls[0]['cus_bill_city'].',&nbsp;' : '';
                            $cus_state      = (StateName($cust_dtls[0]['cus_bill_state']) != '') ? StateName($cust_dtls[0]['cus_bill_state']).'&nbsp;' : '';
                            $cus_zip        = ($cust_dtls[0]['cus_bill_zipcode'] != '0') ? $cust_dtls[0]['cus_bill_zipcode'] : '';
                            $cus_mail       = ($cust_dtls[0]['cus_email'] != '') ? $cust_dtls[0]['cus_email'] : '';
                            $cus_phone      = ($cust_dtls[0]['cus_contact_phone'] != '') ? $cust_dtls[0]['cus_contact_phone'] : '';
                            
                            $current_timne = $object['created_date'];
                            $dateF = new DateTime($current_timne, new DateTimeZone('America/New_York'));
                            date_default_timezone_set('America/New_York');
                            $temp_time1 =  date("Y-m-d h:iA", $dateF->format('U'));
                            $Date = date("m-d-Y", strtotime($object['created_date'])). ' ' .date("h:iA",strtotime("-180 minutes",strtotime($temp_time1)));
                            
                            //$Date           = date("m-d-Y h:m A", strtotime($object['created_date']));                           
                            ?>
                            <tr>
                                <td>
<table width="755" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="310" align="left" valign="top"><table width="280" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table cellpadding="0" border="0" align="left" cellspacing="0">
          <tbody>
            <tr> 
                <span class="jass2" id="<?php echo $id; ?>" style="display: none;"></span>                            
                <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">Job Ref</td>   
                <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">:</td>   
                <td align="left" valign="middle" style="color:#202020;"><span class="reference ref_<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $Order_id; ?></span>
                    <div style="float: left;"><input type="text" class="inline-text-prod-ref reference_txt_<?php echo $id; ?>" id="reference_txt_<?php echo $id; ?>" value="<?php echo $Order_id; ?>" style="display: none;"></div>
                    <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="refupdate ref_update_<?php echo $id; ?>" style="display: none;"/></div>
                    <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="refcancel ref_cancel_<?php echo $id; ?>" style="display: none;"/></div></td>
            </tr>
            <tr>                            
                <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">Order Number</td>                            
                <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">:</td>
                <td align="left" valign="middle" style="color:#202020;"><?php echo $Order_number; ?></td>
            </tr>
            <tr>
                <td align="left"  valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">Date/Time</td>                            
                <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">:</td>
                <td  align="left" valign="middle" style="color:#202020;"><?php echo $Date; ?></td>
                </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td height="10" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top">
        <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td align="left" valign="top"><span style="font-size:14px; color:#ff9600; text-transform:uppercase;">Ship to:</span></td>
            </tr>
            <tr>
                <?php
                $AddressDetaisl = ShippingAddressAllForGuest($ref_serial);                
                $add1 = ($AddressDetaisl[0]['address_1'] != '') ? $AddressDetaisl[0]['address_1'].'</br>' : 'Click here to edit the shipping address.';
                $add2 = ($AddressDetaisl[0]['address_2'] != '') ? $AddressDetaisl[0]['address_2'].'</br>' : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $add3 = ($AddressDetaisl[0]['address_3'] != '') ? $AddressDetaisl[0]['address_3'].'</br>' : '';
                $city = ($AddressDetaisl[0]['city'] != '') ? $AddressDetaisl[0]['city']:'';
                $state = ($AddressDetaisl[0]['state'] != '') ? $AddressDetaisl[0]['state']:'';
                $zip = ($AddressDetaisl[0]['zip'] != '') ? $AddressDetaisl[0]['zip']:'';
                ?>               
                <td class="pointer"><a style="text-decoration: none;color: #000;" class="fancybox fancybox.iframe"  href="edit_guest_add.php?comp_id=<?php echo $object['customer_name']; ?>&acc_id=<?php echo $id; ?>" ><?php echo $add1.$add2.$add3.$city.'</br>'.StateName($state).'</br>'.$zip; ?></a></td>
            </tr>           
          </tbody>
        </table></td>
      </tr>
    </table></td>
    
    <td align="left" valign="top"><span style="font-size:14px; color:#ff9600; text-transform:uppercase;">Order Entered by:</span><?php echo $staf_init[0]['initials']; ?></td>
    
    <td align="left" valign="top"><table cellpadding="0" border="0" align="left" cellspacing="0">
      <tbody>
        <tr>
          <td>
              <span style="font-size:14px; color:#ff9600; text-transform:uppercase;">Order placed by:</span>
              <?php if($cash_customer == '') { ?>
              <a style="font-size: 11px;text-decoration: none;color: #2a9be3;" class="fancyboxc fancyboxc.iframe"  href="change_customer_user.php?comp_id=<?php echo $object['customer_company']; ?>&user_id=<?php echo $cust_dtls[0]['cus_id']; ?>&acc_id=<?php echo $id; ?>" >Edit User/Customer</a>
              <?php } ?>
          </td>
        </tr>
        <?php if(($cash_customer != '') && ($object['customer_company'] == '0')) { 
        $cash_header = ($cash_customer == '1') ? 'Cash (Taxable)' : 'Cash (Exempt)';    
        ?>       
        <tr> 
            <td><?php echo $cash_header; ?></td>
        </tr>
        <?php
        $cc_contact = CashContact($ref_serial);
        $cc_name    = ($cc_contact['name'] != '') ? $cc_contact['name'] : 'Click here to add name';
        $cc_email   = ($cc_contact['email'] != '') ? $cc_contact['email'] : 'Click here to add email';
        $cc_name_txt_val = ($cc_name == 'Click here to add name') ? '' : $cc_name;
        $cc_email_txt_val = ($cc_email == 'Click here to add email') ? '' : $cc_email;
        ?>
        <tr> 
            <td>
                <span class="pointer" id="cc_name_<?php echo $ref_serial; ?>_<?php echo $id; ?>" onclick="return cc_name('<?php echo $ref_serial; ?>','<?php echo $id; ?>');"><?php echo $cc_name; ?></span>
                <input type="text" class="cc_txt_name_<?php echo $ref_serial; ?>_<?php echo $id; ?>" id="cc_txt_name_<?php echo $ref_serial; ?>_<?php echo $id; ?>" value="<?php echo $cc_name_txt_val; ?>" style="display: none;width: 115px;" />
                <img src="images/like_icon.png"  alt="Update" title="Update" width="18" height="18" class="update_cc_name_<?php echo $ref_serial; ?>_<?php echo $id; ?>" onclick="return update_cc_name('<?php echo $ref_serial; ?>','<?php echo $id; ?>');" style="display: none;float: right;"/>
            </td>
        </tr>
        <tr> 
            <td>
                <span class="pointer" id="cc_email_<?php echo $ref_serial; ?>_<?php echo $id; ?>" onclick="return cc_email('<?php echo $ref_serial; ?>','<?php echo $id; ?>');"><?php echo $cc_email; ?></span>
                <input type="text" class="cc_txt_email_<?php echo $ref_serial; ?>_<?php echo $id; ?>" id="cc_txt_email_<?php echo $ref_serial; ?>_<?php echo $id; ?>" value="<?php echo $cc_email_txt_val; ?>" style="display: none;width: 108px;" />
                <img src="images/like_icon.png"  alt="Update" title="Update" width="18" height="18" class="update_cc_email_<?php echo $ref_serial; ?>_<?php echo $id; ?>" onclick="return update_cc_email('<?php echo $ref_serial; ?>','<?php echo $id; ?>');" style="display: none;float: right;"/>
            </td>
        </tr>
        <?php }if($object['customer_company'] != '0'){ ?>
         <tr> 
            <td><?php echo $company_name; ?></td>
        </tr> 
        <tr> 
            <td><?php echo $cus_name; ?></td>
        </tr>  
        <tr> 
            <td><?php echo $cus_mail; ?></td>
        </tr> 
        <tr> 
            <td><?php echo $cus_add_1; ?></td>
        </tr> 
        <tr> 
            <td><?php echo $cus_add_2; ?></td>
        </tr>                            
        <tr> 
            <td><?php echo $cus_city.$cus_state.$cus_zip; ?></td>
        </tr> 
        <tr> 
            <td><?php echo $cus_phone; ?></td>
        </tr> 
        <?php
        }
        ?>        
      </tbody>
    </table></td>
  </tr>
</table> </td>
                                
                            </tr>
                            
                            <tr><td align="left" valign="top" style="padding-top:10px">
                        <div id="inline_edit"> 
                        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" >
                            <tr style="color:#fff;">                               
                                <td width="60%" align="left" valign="middle" bgcolor="#f68210" class="brdr pad_lft">Product Detail</td>
                                <td width="10%" align="center" valign="middle" bgcolor="#f68210"  class="brdr">Quantity</td>
                                <td width="10%" align="center" valign="middle" bgcolor="#f68210"  class="brdr pad_rght">Unit Cost</td>
                                <td width="10%" align="center" valign="middle" bgcolor="#f68210" class="brdr pad_rght">Line Cost</td>                                
                                <td width="10%" align="center" valign="middle" bgcolor="#f68210"  class="brdr pad_rght">Action</td>
                            </tr>
            <?php
              $view_orders = viewOrders($id);
               $j=1;
               foreach ($view_orders as $ord) {
                $rowColor = ($j % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                $rowColor1 = ($j % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                $prod_id = $ord['product_id'];
                $id = $ord['id'];
                $ord_id_t           = $ord['order_id'];
                $super_id           = getsuper($ord['product_id']);
                $cat_id             = getcat($ord['product_id']);
                $sub_id             = getsub($ord['product_id']);
                $super_name         = (getsuperN($super_id) != '') ? getsuperN($super_id).' >> ':'';
                $cat_name           = (getcatN($cat_id) != '') ? getcatN($cat_id) : '';
                $sub_name           = (getsubN($sub_id) != '') ? ' >>'.getsubN($sub_id):'';
              ?>
                            <tr class="inline" id="<?php echo $id; ?>" >
                                <span class="jass" id="<?php echo $id; ?>" style="display: none;"></span>
                                <span class="order_id_t_<?php echo $id; ?>" id="<?php echo $ord_id_t; ?>" style="display: none;"></span>
                                <input type="text" id="h_<?php echo $id; ?>" style="display: none;" value="<?php echo getpid($prod_id,$ord_id); ?>" />                                
                                <td width="60%" align="left" valign="middle" bgcolor="<?php echo $rowColor1; ?>" class="brdr pad_lft">
                                    <span class="product_<?php echo $id; ?>"><?php echo $ord['product_name']; ?></span><input type="text" class="inline-text-prod product_txt_<?php echo $id; ?>" id="product_txt_<?php echo $id; ?>" value="<?php echo htmlentities($ord['product_name']); ?>" style="display: none;width: 325px;"/></br>
                                    <span class="trail" style="font-size: 11px;color: #2a9be3;"><?php echo $super_name.$cat_name.$sub_name;  ?></span>
                                </td>
                                <td width="10%" align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>"><span class="quantity_<?php echo $id; ?>"><?php echo $ord['product_quantity']; ?></span><input type="text" class="inline-text quantity_txt_<?php echo $id; ?>" id="quantity_txt_<?php echo $id; ?>" value="<?php echo $ord['product_quantity']; ?>" style="display: none;"/></td>
                                <td width="10%" align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>"><span class="price_<?php echo $id; ?>"><?php echo '$' . $ord['product_price']; ?></span><input type="text" class="inline-text price_txt_<?php echo $id; ?>" id="price_txt_<?php echo $id; ?>" value="<?php echo $ord['product_price']; ?>" style="display: none;"/></td>                                
                                <td width="10%" align="left" valign="middle" bgcolor="<?php echo $rowColor; ?>"><span class="line_cost_<?php echo $id; ?>"><?php echo '$' . number_format(($ord['product_quantity'] * $ord['product_price']), 2, '.', ''); ?></span></td>                                                                                                
                                <td width="10%" align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="mar_lft updater update_<?php echo $id; ?>" style="display: none; margin-left: 0px;"/><a href="open_orders.php?delete_id=<?php echo $id; ?>&ord_id=<?php echo $ref_serial; ?>" onclick="return confirm('Are you delete this product of this order?');"><img src="images/del.png" class="delete_<?php echo $id; ?>"  alt="Delete Product" title="Delete Product" width="22" height="22" class="mar_lft"/></a></td>
                            </tr> 
                                    
                                    
               <?php 
               $j++;
               } 
               
               ?> 
                            <!-- Add Product  Button Start -->
                            <tr> 
                                <td colspan="5" style="padding-top: 5px;"><a class="add_pro" href="aptor.php?ord_id=<?php echo $ref_serial; ?>" style="cursor: pointer;"><b>+</b>Add Products</a></td> 
                            </tr>                            
                            <!-- Add Product  Button End -->
                            <!---TAX START-->
                            <tr>
                                <td height="35" colspan="6" align="center">
                                    <div class="error" style="color:#FF0000;padding-left:35px;font-size: 12px;"></div>
                                    <div class="msg" style="color:#007F2A; font-size: 13px;"></div>
                                </td>
                                
                            </tr>
                            <tr>
                            <span id="order_closed_alert" class="order_closed_alert" style="color:#007F2A;"></span>
                                <td align="center" class="close_order_1">
                                    <!--<span onclick="return close_order('<?php // echo $ref_serial; ?>');" title="click here to close the order" alt="click here to close the order">Close Order</span>-->
                                </td>
                                <td>&nbsp;</td>                               
                                <td height="20" align="right"  colspan="3" valign="top">
                                            
                                            <table align="right" width="240" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="30" align="left" valign="middle" class="pad_lft_j brdr1">Shipping</td>
                                                <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1  brdr-lft_j">
                                                    <span class="shipp_price_<?php echo $id_shipp; ?>" onclick="return shipp_edit('<?php echo $id_shipp; ?>');"><?php echo '$'.$shipping_price; ?></span>
                                                    <input type="text" name="shipp_txt_val_<?php echo $id_shipp; ?>" class="shipp_txt_val_<?php echo $id_shipp; ?>" id="shipp_txt_val_<?php echo $id_shipp; ?>" value="<?php echo $shipping_price; ?>" style="display: none;width: 35px;" />
                                                    <img src="images/like_icon.png"  alt="Update" title="Update" width="18" height="18" class="update_shipp_<?php echo $id_shipp; ?>" onclick="return update_shipp('<?php echo $id_shipp; ?>');" style="display: none;float: right;"/>
                                                </td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td height="30" align="left" valign="middle" class="pad_lft_j brdr1">Sub Total</td>
                                                <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1  brdr-lft_j"><span class="line_<?php echo $id; ?>" ><?php echo '$'.number_format($price[0]['sub_total'], 2, '.', ''); ?></span></td>
                                                <td>&nbsp;
                                                    <input type="hidden" name="sub_tot_dummy_<?php echo $id_shipp; ?>" id="sub_tot_dummy_<?php echo $id_shipp; ?>" value="<?php echo number_format($price[0]['sub_total'], 2, '.', ''); ?>" />
                                                    <input type="hidden" name="tax_dummy_<?php echo $id_shipp; ?>" id="tax_dummy_<?php echo $id_shipp; ?>" value="<?php echo number_format($tax, 2, '.', ''); ?>" />
                                                </td>
                                              </tr>
                                              <tr>
                                                <td height="30" align="left" valign="middle" class="pad_lft_j brdr1 brdr-top_j">Tax</td>
                                                <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1 brdr-top_j brdr-lft_j"><span class="tax_<?php echo $id; ?>"><?php echo '$' .number_format($tax, 2, '.', ''); ?></span></td>
                                                <td><?php if($tax_status == '1'){ ?><a href="open_orders.php?tax_status=<?php echo $ord_id; ?>" onclick="return confirm('Are you remove the tax in this order?');"><img src="images/del.png"  alt="Remove Tax" title="Remove Tax" width="22" height="22" class="mar_lft"/></a><?php } ?></td>
                                              </tr>
                                              <tr>
                                                <td height="30" align="left" valign="middle" class="pad_lft_j brdr1 brdr-top">Total</td>
                                                <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1 brdr-top_j brdr-lft_j"><span class="lineJassim_<?php echo $id; ?>"><span class="shipp_grand_<?php echo $id_shipp; ?>"><?php echo '$' . number_format(($price[0]['sub_total'] + $tax + $shipping_price), 2, '.',''); ?></span></span></td>
                                                <td>&nbsp;</td>
                                              </tr>
                                            </table>
                                </td> 
                                
                            </tr>
                             <!---TAX START-->
                            
                            </table>
                                  </div>  
                                </td>
                            </tr>
                        </table>                        
                    </td>
              </tr>  
              
          <?php              
                 $i++;
               }
               }
            else {
               ?>
              <tr  bgcolor="<?php echo $rowColor; ?>">
            <td colspan="4" align="center">There is no orders</td>
            </tr>              
            <?php } ?>
              
              </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
  <td style="background:#464646; text-align:center; color:#fff; line-height:30px;" height="30p">© <?php echo date('Y'); ?> sohorepro.com</td>
  </tr>
</table>
</body>
</html>
<script type="text/javascript">
$(document).ready(function()
{
    $('.trigger').click(function()
    {        
        var val  = $(this).attr('id');       
        if ($(this).is(':visible')) 
        {               
            $(this).next(".test_"+val).fadeToggle('slow').siblings(".test_"+val).hide(); 
        }
    });
    
    $('.inline').click(function()
    {
        var ID      =$(this).attr('id'); 
        $(".product_"+ID).hide(); 
        $(".quantity_"+ID).hide(); 
        $(".price_"+ID).hide(); 
        $(".delete_"+ID).hide();        
        $(".product_txt_"+ID).show(); 
        $(".quantity_txt_"+ID).show(); 
        $(".price_txt_"+ID).show(); 
        $(".update_"+ID).show();         
        $(".jass").attr("id",ID);        
    });
    
    $(document).mouseup(function()
    {
        var ID = $('.jass').attr('id');
        $(".product_"+ID).show(); 
        $(".quantity_"+ID).show(); 
        $(".price_"+ID).show(); 
        $(".delete_"+ID).show();  
        $(".product_txt_"+ID).hide(); 
        $(".quantity_txt_"+ID).hide(); 
        $(".price_txt_"+ID).hide(); 
        $(".update_"+ID).hide(); 
    });
    
    $('.reference').click(function()
    {               
        var OR_ID   = $(this).attr('id');        
        $(".ref_"+OR_ID).hide(); 
        $(".reference_txt_"+OR_ID).show();
        $(".ref_update_"+OR_ID).show();
        $(".ref_cancel_"+OR_ID).show();
        $(".jass2").attr("id",OR_ID);
    });
    
    $('.refcancel').click(function()
    {               
        var OR_ID   = $('.jass2').attr('id');       
        $(".ref_"+OR_ID).show(); 
        $(".reference_txt_"+OR_ID).hide();
        $(".ref_update_"+OR_ID).hide();
        $(".ref_cancel_"+OR_ID).hide();
    });
    
    $(function () {
        var ID = $('.jass').attr('id');    
        $("#quantity_txt_"+ID).keydown(function (event) {

            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });
    
    $(function () {
        var ID = $('.jass').attr('id');    
        $("#price_txt_"+ID).keydown(function (event) {

            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });
    
    


});

function close_order(ID)
{
    var order_close = confirm('Are you sure?');
    if (!order_close)
        {
            return false;
        }
        else
        {            
            $.ajax
                    ({
                        type: "POST",
                        url: "get_child.php",
                        data: "close_oder_id=" + ID,
                        success: function(option)
                        {
                         if(option == '1')
                             {                                
                                 $(".order_closed_alert").html("Order has been closed."); 
                                 setTimeout(function () { window.location='open_orders.php'; }, 1000);
                             }
                             else
                             {                                
                                 $("#order_closed_alert").html("Order has been not closed."); 
                             }
                        }
                    });
        }
}

function Edit_Address()
{
    alert("Edit Address");
}

</script>

<script type="text/javascript">
$(document).ready(function()
{   
  $('.updater').click(function()
    {
       
        var ID                   = $('.jass').attr('id');          
        var order_id             = $('.order_id_t_'+ID).attr('id');
        var IID                  = document.getElementById('h_'+ID).value;        
        var product              = document.getElementById('product_txt_'+ID).value;
        var qty                  = document.getElementById('quantity_txt_'+ID).value;
        var price                = document.getElementById('price_txt_'+ID).value;
        
                if(price != '' && qty != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "get_child.php",
		 data: "product="+product+"&qty="+qty+"&price="+price+"&id="+ID+"&iid="+IID+"&order_id="+order_id,
		 success: function(option)
		 {
		     var myarr = option.split("~");
                     
                     var line = (myarr[1] * myarr[2]);
                     $(".product_"+ID).html(myarr[0]); 
                     $(".quantity_"+ID).html(myarr[1]); 
                     $(".price_"+ID).html("$"+myarr[2]); 
                     $(".tax_"+ID).html("$"+myarr[5]); 
                     $(".line_cost_"+ID).html(myarr[7]); 
                     $(".line_"+ID).html("$"+myarr[6]);
                     $(".lineJassim_"+ID).html("$"+myarr[4]); 
                     $(".jassim_"+order_id).html("$"+myarr[4]); 
		 }
	  });
	 }
	 else
	 {
	   $(".error").html("Please fill the all fields"); 
	 }
	return false;
        
    });
  
  
  $('.refupdate').click(function()
    {
        var ID                      = $('.jass2').attr('id');  
        var reference               = document.getElementById('reference_txt_'+ID).value;
       
         if(reference != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "get_child.php",
		 data: "reference="+reference+"&id="+ID,
		 success: function(option)
		 {
                    $(".ref_"+ID).html(option); 
                    $(".refj_"+ID).html(option); 
                    $(".ref_"+ID).show(); 
                    $(".reference_txt_"+ID).hide();
                    $(".ref_update_"+ID).hide();
                    $(".ref_cancel_"+ID).hide();
		 }
	  });
	 }
	 else
	 {
	   $(".error").html("Please fill the all fields"); 
	 }
	return false;
        
    });
  
  
});

function shipp_edit(ID){
//alert(ID);
$(".shipp_price_"+ID).css('display','none');
$(".shipp_txt_val_"+ID).css('display','inline-block');
$(".update_shipp_"+ID).css('display','inline-block');
}

function update_shipp(ID){
    var shipp_price = document.getElementById('shipp_txt_val_'+ID).value;
    var sub_total   = document.getElementById('sub_tot_dummy_'+ID).value;
    var tax         = document.getElementById('tax_dummy_'+ID).value;
    if(shipp_price != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "get_child.php",
		 data: "shipp_price_admin="+shipp_price+
                       "&id="+ID+"&shipp_sub_tot="+sub_total+
                       "&shipp_sub_tax="+tax,
		 success: function(option)
		 {
                      var myarr = option.split("~");
                      $(".shipp_price_"+ID).css('display','inline-block');
                      $(".shipp_price_"+ID).html(myarr[0]);
                      $(".shipp_grand_"+ID).html(myarr[1]);
                      $(".shipp_txt_val_"+ID).css('display','none');
                      $(".update_shipp_"+ID).css('display','none');
		 }
	  });
	 }
	 else
	 {
	   alert("Please fill the all fields"); 
	 }
    
}

function no_num(event){
    if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();
}


function cc_name(order_id,cc_id)
{    
    $("#cc_name_"+order_id+'_'+cc_id).css('display','none');
    $("#cc_txt_name_"+order_id+'_'+cc_id).css('display','inline-block'); 
    $(".update_cc_name_"+order_id+'_'+cc_id).css('display','inline-block');     
}

function cc_email(order_id,cc_id)
{
    $("#cc_email_"+order_id+'_'+cc_id).css('display','none');
    $("#cc_txt_email_"+order_id+'_'+cc_id).css('display','inline-block'); 
    $(".update_cc_email_"+order_id+'_'+cc_id).css('display','inline-block')
}

function update_cc_name(order_id,cc_id)
{
    var cc_name = document.getElementById('cc_txt_name_'+order_id+'_'+cc_id).value;
    if(cc_name != '')  
      {
       $.ajax
       ({
          type: "POST",
              url: "get_child.php",
              data: "cc_name="+cc_name+
                    "&order_id="+order_id+"&cc_id="+cc_id,
              success: function(option)
              {     
                  if(option == '1'){
                    $("#cc_name_"+order_id+'_'+cc_id).css('display','inline-block');
                    $("#cc_name_"+order_id+'_'+cc_id).html(cc_name);
                    $("#cc_txt_name_"+order_id+'_'+cc_id).css('display','none'); 
                    $(".update_cc_name_"+order_id+'_'+cc_id).css('display','none');  
                  }
              }
       });
      }
      else
      {
            alert('Name should not be empty.');
            document.getElementById("cc_name_"+order_id+'_'+cc_id).focus();
      }
}

function update_cc_email(order_id,cc_id)
{
    var cc_email = document.getElementById('cc_txt_email_'+order_id+'_'+cc_id).value;
    if(cc_email != '')  
      {
       $.ajax
       ({
          type: "POST",
              url: "get_child.php",
              data: "cc_email="+cc_email+
                    "&order_id="+order_id+"&cc_id="+cc_id,
              success: function(option)
              {     
                  if(option == '1'){
                    $("#cc_email_"+order_id+'_'+cc_id).css('display','inline-block');
                    $("#cc_email_"+order_id+'_'+cc_id).html(cc_email);
                    $("#cc_txt_email_"+order_id+'_'+cc_id).css('display','none'); 
                    $(".update_cc_email_"+order_id+'_'+cc_id).css('display','none');  
                  }
              }
       });
      }
      else
      {
            alert('Email should not be empty.');
            document.getElementById("cc_email_"+order_id+'_'+cc_id).focus();
      }
}

</script>