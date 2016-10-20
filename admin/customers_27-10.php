<?php
include './config.php';
include './auth.php';

//$sort_pn            = ($_REQUEST['sort'] == 'pna') ? 'pnd' : 'pna';
//$sort_pn_img        = ($_REQUEST['sort'] == 'pna') ? 'down' : 'up';

$sort_sku = ($_REQUEST['sort'] == 'pea') ? 'ped' : 'pea';
$sort_sku_img = ($_REQUEST['sort'] == 'pea') ? 'down' : 'up';

$sort_price = ($_REQUEST['sort'] == 'pda') ? 'pdd' : 'pda';
$sort_price_img = ($_REQUEST['sort'] == 'pda') ? 'down' : 'up';


$page = 1; //Default page
$limit = 25; //Records per page
$start = 0; //starts displaying records from 0
if (isset($_GET['page']) && $_GET['page'] != '') {
    $page = $_GET['page'];
}
$start = ($page - 1) * $limit;
if ($_GET['limite']) {
    $limit = $_GET['limite'];
}

$users = getusers_list_temp($_REQUEST['sort'], $start, $limit);

//$rows= '4273';
$rows = count(CustomersCount());
$last_element = $_GET['page'];

if ($_GET['delete_id']) {

    $delete_id = $_GET['delete_id'];
    $sql = "UPDATE sohorepro_company
			SET     status = '0',
                        archive = '1' 
                        WHERE comp_id= '" . $delete_id . "' ";
    $sql_result = mysql_query($sql);
    $sql_user = "UPDATE sohorepro_customers SET cus_status = '0' WHERE cus_compname = '".$delete_id."' ";    
    mysql_query($sql_user);
    if ($sql_result) {
        $result = "success_del";
    } else {
        $result = "failure_del";
    }
}

if ($_GET['delete_product_id']) {

    $delete_id = $_GET['delete_product_id'];
    $sql = "DELETE FROM sohorepro_special_pricing WHERE sp_id = " . $delete_id . " ";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_del_cus";
    } else {
        $result = "failure_del_cus";
    }
}
?>
<?php
if ($_GET['status_id']) {

    $change_status = ($_GET['change_id'] == 1) ? '0' : '1';
    $status_id = $_GET['status_id'];
    $sql = "UPDATE sohorepro_company
			SET    status     = '" . $change_status . "' WHERE comp_id= '" . $status_id . "'";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_status";
    } else {
        $result = "failure_status";
    }
}
?>

<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <title>Soho-repro</title>

    </head>
    <link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="style/customer-css.css" rel="stylesheet" type="text/css" media="all" />
    <link href="style/pagination.css" rel="stylesheet" type="text/css" media="all" />
    <style type="text/css">            
        option.select_customer1 { font-weight: bold !important;}
        .subcat {  
            color: #000000;
        }
    </style>
    <script src="../js/jquery.js" type="text/javascript" ></script>
    <script language="javascript" src="../store_files/script.js"></script> 
    <script type="text/javascript" src="../store_files/scripts.js"></script>
    <script language="javascript" src="js/value.js"></script>
    <script language="javascript" src="js/customer.js"></script>
    <script language="javascript" src="js/phnovalid.js"></script>
    <script>
        jQuery(function($) {
            //var ID = $(".main_id").attr("id");
            $(".comp_phone").mask("999-999-9999");
            $(".comp_fax").mask("999-999-9999");
            $(".comp_zip").mask("99999");
        });
    </script>
    <body>
        <div id="loading" class="none"  style="position: fixed;top: 35%;left: 48%;padding: 5px;z-index: 10;">
            <img src="images/login_loader.gif" border="0" />
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" valign="top">
                    <table width="960" border="0" cellspacing="0" cellpadding="0" style="min-width:760px;">
                        <tr>
                            <td width="198" align="left" valign="top" bgcolor="#464646"><table width="198" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="185" align="left" valign="top"><img src="images/logo.jpg" width="198" height="181"  alt=""/></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <?php include "sidebar_menu.php"; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="middle" style="height:280px; float:left;"></td>
                                    </tr>
                                </table></td>
                            <td width="3" align="left" valign="top" bgcolor="#FFFFFF"></td>
                            <td width="759" align="left" valign="top" bgcolor="#FFFFFF">
                                <table width="759" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="48" align="center" valign="middle" bgcolor="#5f5f5f" class="heading">
                                            ADMINISTRATOR PAGE
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="38" align="center" valign="middle" bgcolor="#8b8b8b" class="sub_heading">
                                            CUSTOMERS
                                            <span style="float: right;padding-right: 5px;">Welcome <?php
                                                if ($_SESSION['admin_user_type'] == '1') {
                                                    echo 'admin';
                                                } if ($_SESSION['admin_user_type'] == '2') {
                                                    echo 'Staff User';
                                                }
                                                ?> |<a href="logout.php" style="text-decoration:none;color:#fff;">&nbsp;Logout</a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="14" align="left" valign="middle"></td>
                                    </tr> 
                                    <tr>
                                        <td align="right" valign="top">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td height="38" align="left" valign="middle" class="add_title">Search</td>
                                                </tr>
                                                <tr>
                                                    <td height="60" align="left" valign="top" bgcolor="#f6f6f6" class="form_bg">
                                                        <form name="new_supercategory" id="new_supercategory" method="post" action=""  onsubmit="return load_userinfo()" >
                                                            <input type="hidden" name="search_cus" value="1" />
                                                            <input type="hidden" name="new_cat" value="1" />       
                                                            <table width="600" border="0" cellspacing="0" cellpadding="0" >
                                                                <tr style="float:left;">
                                                                    <td width="160" height="60" align="right" valign="middle">
                                                                        <input class="input_text" type="text" name="search_val" id="search_val" type="text" value="<?php echo $_REQUEST['search_val']; ?>" placeholder="Company Name/Email ID" style="width:300px !important; margin-left: 25px;" >
                                                                    </td>
                                                                    <td width="250" height="60" align="center" valign="middle" style="padding-left: 10px;">
                                                                        <input type="submit" name="search" class="search_cus" value="Search" />
                                                                        <?php if ($_REQUEST['search_cus'] != '') { ?>
                                                                            <span class="search_cus" style="margin-left: 20px;" onclick="return reset_filter();">Reset</span>
<?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="9" style="color:#F00; text-align:center; font-size: 12px;">
                                                                        <?php
                                                                        if ($result == "success") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Inserted Successfully</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Not Successfully</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>       
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($result == "success_del") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Deleted Successfully</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure_del") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Not Deleted</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>       
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($result == "success_del_cus") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Deleted Successfully</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure_del_cus") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Not Deleted</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>       
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($result == "success_status") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Status change successfully</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure_status") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Status change not successfully</div>
                                                                            <script>setTimeout("location.href=\'customers.php\'", 1000);</script>       
                                                                            <?php
                                                                        }
                                                                        ?>   
                                                                        <div id="msg1" style="color:#FF0000;padding-left:35px;font-size: 12px;"></div>
                                                                        <div id="msg2" style="color:#FF0000;padding-left:35px;font-size: 12px; display: none;"></div>
                                                                        <div id="msg" style="color:#007F2A; font-size: 13px;"></div>
                                                                        <span class="check" style="color:#FF0000;padding-left:35px;font-size: 12px;"  ></span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </form>   
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="45" align="right" valign="middle" style="padding: 5px;"><a href="import_customers.php" style="float: right;"><img src="images/btn_import_customer.png" style="cursor:pointer;" alt="Import Customers" title="Import Customers"/></a><span style="width: 215px;float: right;margin-right: 10px;font-size: 12px;text-align: left;">Please use this Excel file as a template or else your import may not work <a href="excel_template/customer_template.xls">Download Template</a></span></td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">                                            


                                            <div id="load_userdata">
                                                <?php
                                                //Search Results
                                                if ($_REQUEST['search_cus'] != '') {
                                                    $search_val = $_REQUEST['search_val'];
                                                    $users_search_pre = getusers_list_search_user($_REQUEST['sort'], $start, $limit, $search_val);
                                                    if(count($users_search_pre) > 0){
                                                    $users_search = getusers_list_search_user($_REQUEST['sort'], $start, $limit, $search_val);   
                                                    }else{
                                                    $search_val_com_id = getCompId($_REQUEST['search_val']);
                                                    if(count($search_val_com_id) > 0){
                                                    foreach ($search_val_com_id as $comp_val){
                                                        $search_by_comp = getCompNameStatus($comp_val['cus_compname']);
                                                    }
                                                    }
                                                    if(count($search_by_comp) > 0){
                                                    $search_by_usr_comp = trim($search_by_comp);
                                                    //$search_by_comp = getCompName($search_val_com_id);
                                                    $users_search = getusers_list_search_user_cus($_REQUEST['sort'], $start, $limit, $search_by_usr_comp);   
                                                    }
                                                    }
                                                    ?>
                                                    <table width="759" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="36" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">NO.</td>                                                        
                                                            <td width="100" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="customers.php?sort=<?php echo $sort_sku; ?>">Company Name&nbsp;<img src="images/<?php echo $sort_sku_img; ?>.png"  alt="" width="10px" height="5px"/></a></td>                                                                                                                
                                                            <?php if ($_SESSION['admin_user_type'] == '1') { ?>
                                                                <td width="64" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">action</td>
                                                        <?php } ?>
                                                        </tr>                                                
                                                        <?php
                                                        $i = 1;
                                                        if (count($users_search) > 0) {
                                                            if ($last_element != '') {
                                                                $i = ((($last_element * 25) - 25) + 1);
                                                            } else {
                                                                $i = 1;
                                                            }
                                                            foreach ($users_search as $Prod) {
                                                                $rowColor = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                                $rowColor1 = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                                $id = $Prod['cus_id'];
                                                                $cumpony_id = $Prod['comp_id'];
                                                                $cus_email = $Prod['cus_email'];
                                                                $cus_regdate = date("m-d-Y", strtotime($Prod['cus_regdate']));
                                                                $company_name = $Prod['comp_name'];
                                                                $user_address1 = $Prod['comp_business_address1'];
                                                                $user_address2 = $Prod['comp_business_address2'];
                                                                $user_address3 = $Prod['comp_business_address3'];
                                                                $company_phone = $Prod['comp_contact_phone'];
                                                                $company_fax = $Prod['comp_contact_fax'];
                                                                $company_city = $Prod['comp_city'];
                                                                $state_abbr = $Prod['comp_state'];
                                                                $company_zip = $Prod['comp_zipcode'];
                                                                $tax_excempt_number= $Prod['tax_exempt_number'];
                                                                $tax = ($Prod['tax_exe'] == 1) ? 'Yes' : 'No';
                                                                $status = ($Prod['status'] == 1) ? 'active' : 'de-active';
                                                                $deleivery_address = ShippingAddressAll($cumpony_id);
                                                                if (($_SESSION['admin_user_type'] == '2') && ($Prod['status'] == 1)) {
                                                                    $staff_prev = '';
                                                                } else {
                                                                    $staff_prev = 'status';
                                                                }
                                                                ?>                                                
                                                                <tr class="trigger" id="<?php echo $id; ?>">
                                                                    <td width="49"  align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>" class="pad_btm"><?php echo $i; ?></td>                                                                
                                                                    <td width="100" align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>"  class="pad_btm"><span class="company_name_<?php echo $cumpony_id; ?>"><?php echo $company_name; ?></span></td>                                                                
            <?php if ($_SESSION['admin_user_type'] == '1') { ?>
                                                                        <td width="80"  align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>" class="pad_btm">
                                                                            <a href="#edit_user.php?id=<?php echo $id; ?>"><img src="images/edit.png"  alt="Edit" title="Edit" width="22" height="22"/></a>
                                                                            <a href="customers.php?delete_id=<?php echo $cumpony_id; ?>" onclick="return confirm('Are you sure?');"><img src="images/del.png"  alt="Delete" title="Delete" width="22" height="22" class="mar_lft"/></a></td>
            <?php } ?>
                                                                </tr>
                                                                <tr class="test_<?php echo $id; ?>" style="display: none;">
                                                                    <td colspan="<?php echo ($_SESSION['admin_user_type'] == '1') ? '3' : '2'; ?>">
                                                                        <table width="100%" border="0">
                                                                            <tr>
                                                                                <td colspan="3" align="center">
                                                                                    <span id="succ_resend_<?php echo $cumpony_id; ?>" style="color:#007F2A;"></span>
                                                                                    <span id="fail_alert_<?php echo $cumpony_id; ?>" style="color:#F00;"></span> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr align="left">
                                                                                <td width="33%" class="inf" style="font-weight: bold;padding-left: 3px;">Business Info</td>
                                                                                <td width="33%" class="inf" style="font-weight: bold;padding-left: 3px;">Delivery Info</td>
                                                                                <td width="34%" class="inf" style="font-weight: bold;padding-left: 2px;">User Info</td>
                                                                            </tr>
                                                                            <tr>                                                                           
                                                                                <!--Business Table Start-->
                                                                                <td align="left" width="250">
                                                                                <table border="0" width="250">
                                                                                    <tr>                                                                                        
                                                                                        <td width="200">
                                                                                            <span class="cus_id" id="<?php echo $cumpony_id; ?>"></span>
                                                                                            <span style="cursor: pointer;" class="bus_inline bus_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $company_name; ?></span>
                                                                                            <input style="float:left;" type="text" class="none bus_inline_txt_<?php echo $cumpony_id; ?>" id="bus_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $company_name; ?>" />
                                                                                            <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="cn_update cn_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                            <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="cn_cancel cn_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>                                                                                       
                                                                                        <td>
                                                                                            <span style="cursor: pointer;" class="bus_add1_inline bus_add1_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $user_address1; ?></span>
                                                                                            <input style="float:left;" type="text" class="none bus_add1_inline_txt_<?php echo $cumpony_id; ?>" id="bus_add1_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $user_address1; ?>" />
                                                                                            <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="ad1_update ad1_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                            <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="ad1_cancel ad1_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left">
                                                                                            <span style="cursor: pointer;" class="bus_add2_inline bus_add2_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $user_address2; ?></span>
                                                                                            <input style="float:left; width: 150px;" type="text" class="none bus_add2_inline_txt_<?php echo $cumpony_id; ?>" id="bus_add2_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $user_address2; ?>" />
                                                                                            <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="ad2_update ad2_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                            <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="ad2_cancel ad2_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>                                                                                             
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>                                                                                       
                                                                                        <td>
                                                                                            <span style="cursor: pointer;" class="bus_add3_inline bus_add3_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $user_address3; ?></span>
                                                                                            <input style="float:left;" type="text" class="none bus_add3_inline_txt_<?php echo $cumpony_id; ?>" id="bus_add3_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $user_address1; ?>" />
                                                                                            <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="ad3_update ad3_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                            <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="ad3_cancel ad3_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>                                                                                        
                                                                                        <td align="left" width="420">
                                                                                            <table>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <span style="cursor: pointer;" class="bus_city_inline bus_city_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $company_city; ?></span>,
                                                                                                        <input style="float:left; width: 60px;" type="text" class="none bus_city_inline_txt_<?php echo $cumpony_id; ?>" id="bus_city_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $company_city; ?>" />
                                                                                                        <span style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="city_update city_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                        <span style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="city_cancel city_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                        <span style="cursor: pointer;margin-left: -2px;" class="bus_stat_inline bus_stat_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $state_abbr; ?></span>&nbsp;
                                                                                                        <select name="state" id="<?php echo $cumpony_id; ?>" class="none bus_state bus_stat_inline_txt_<?php echo $cumpony_id; ?>" >                    
                                                                                                            <?php
                                                                                                            $state = StateAll();
                                                                                                            foreach ($state as $state_val) {
                                                                                                                if ($state_val['state_abbr'] == $state_abbr) {
                                                                                                                    ?>
                                                                                                                    <option value="<?php echo $state_val['state_abbr'] ?>" selected="selected"><?php echo $state_val['state_abbr']; ?></option>
                                                                                                                <?php } else { ?>
                                                                                                                    <option value="<?php echo $state_val['state_abbr']; ?>"><?php echo $state_val['state_abbr']; ?></option>
                                                                                                                    <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                        <span style="cursor: pointer;margin-left: -5px;" class="bus_zip_inline bus_zip_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $company_zip; ?></span>
                                                                                                        <input style="width: 40px;" type="text" class="none comp_zip bus_zip_inline_txt_<?php echo $cumpony_id; ?>" id="bus_zip_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $company_zip; ?>" />
                                                                                                        <span style="float:right; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="zip_update zip_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                        <span style="float:right;  margin: 0 0px 0 -10px;"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="zip_cancel zip_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table> 
                                                                                        </td>
                                                                                    </tr>                                                                                     
                                                                                    <tr>                                                                                        
                                                                                        <td>
                                                                                            <span class="bus_phone_head_inline_span_<?php echo $cumpony_id; ?>"><strong>P : </strong></span>
                                                                                            <span style="cursor: pointer;" class="bus_phone_inline bus_phone_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $company_phone; ?></span>
                                                                                            <input style="width: 80px;" type="text" class="none comp_phone bus_phone_inline_txt_<?php echo $cumpony_id; ?>" id="bus_phone_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $company_phone; ?>" />
                                                                                            <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="phone_update phone_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                            <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="phone_cancel phone_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                        </td>
                                                                                    </tr> 
                                                                                    <tr>                                                                                        
                                                                                        <td>                                                                                           
                                                                                            <span class="bus_fax_head_inline_span_<?php echo $cumpony_id; ?>"><strong>F : </strong></span>                                                                                            
                                                                                            <span style="cursor: pointer;" class="bus_fax_inline bus_fax_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $company_fax; ?></span>
                                                                                            <input style="width: 80px;" type="text" class="none comp_fax bus_fax_inline_txt_<?php echo $cumpony_id; ?>" id="bus_fax_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $company_fax; ?>" />
                                                                                            <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="fax_update fax_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                            <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="fax_cancel fax_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                        </td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <td class="inf">Tax Exemption&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                                                            
                                                                                            <span style="cursor: pointer;" class="bus_tax_inline bus_tax_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $tax; ?></span>
                                                                                            <select name="tax" id="<?php echo $cumpony_id; ?>" class="none bus_tax bus_tax_inline_txt_<?php echo $cumpony_id; ?>" >                                                                                                                   
                                                                                                <option value="1" <?php if ($tax == 'Yes') { ?> selected="selected" <?php } ?>>Yes</option>                                                                                                    
                                                                                                <option value="0" <?php if ($tax == 'No') { ?> selected="selected" <?php } ?>>No</option>                                                                                                    
                                                                                            </select>

                                                                                        </td>                                                                                            
                                                                                    </tr>
                                                                                    <?php if($Prod['tax_exe'] == '1'){ ?>                                                                                        
                                                                                                <tr class="tax_exempt_number_row_view_<?php echo $cumpony_id; ?>">
                                                                                                    <td>Tax ID : &nbsp;
                                                                                                        <span class="tax_exempt_number_span_<?php echo $cumpony_id ?>"><?php echo $tax_excempt_number; ?></span>                                                                                                
                                                                                                    </td>                                                                                             
                                                                                                </tr> 
                                                                                                <?php } ?>
                                                                                                 <tr class="none tax_exempt_number_row_<?php echo $cumpony_id; ?>">
                                                                                                    <td>
                                                                                                        <span style="float: left;">Tax ID : &nbsp;</span>
                                                                                                        <span class="tax_exempt_number_span_<?php echo $cumpony_id ?>"><?php  //echo $tax_excempt_number; ?></span>
                                                                                                        <input type="text" name="tax_exempt_number" class="tax_exempt_number_<?php echo $cumpony_id; ?>" id="tax_exempt_number_<?php echo $cumpony_id; ?>" style="float: left;width: 90px;" autofocus="autofocus" value="<?php echo $tax_form_excempt; ?>" />
                                                                                                        <div style="float:left; margin:0 4px">
                                                                                                            <img src="images/like_icon.png" style="margin-top:-3px;" alt="Update" title="Update" width="22" height="22" class="tax_exempt_update tax_exempt_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" />
                                                                                                        </div>
                                                                                                    </td>                                                                                             
                                                                                                </tr>
                                                                                    <tr>                                                                                        
                                                                                        <td>&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>                                                                                        
                                                                                        <td>&nbsp;</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                    <!--Business Table Start-->
                                                                    <!--Delivery Address Start-->
                                                                    <td width="240">
                                                                        <table border="0" width="240">
                                                                            <tr>                                                                                        
                                                                                <td width="200">
                                                                                    <span class="cus_id" id="<?php echo $cumpony_id; ?>"></span>
                                                                                    <span style="cursor: pointer;" class="del_inline del_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $deleivery_address[0]['company_name']; ?></span>                                                                                                                                                                        
                                                                                    <input style="float:left;" type="text" class="none del_inline_txt_<?php echo $cumpony_id; ?>" id="del_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['company_name']; ?>" />
                                                                                    <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="cn_del_update cn_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                    <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="cn_del_cancel cn_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>                                                                                       
                                                                                <td>
                                                                                    <span style="cursor: pointer;" class="del_add1_inline del_add1_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $deleivery_address[0]['address_1']; ?></span>                                                                                                                                                                        
                                                                                    <input style="float:left;" type="text" class="none del_add1_inline_txt_<?php echo $cumpony_id; ?>" id="del_add1_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['address_1']; ?>" />
                                                                                    <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="ad1_del_update ad1_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                    <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="ad1_del_cancel ad1_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left">
                                                                                    <span style="cursor: pointer;" class="del_add2_inline del_add2_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $deleivery_address[0]['address_2']; ?></span>                                                                                                                                                                        
                                                                                    <input style="float:left; width: 150px;" type="text" class="none del_add2_inline_txt_<?php echo $cumpony_id; ?>" id="del_add2_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['address_2']; ?>" />
                                                                                    <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="ad2_del_update ad2_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                    <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="ad2_del_cancel ad2_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>                                                                                             
                                                                                </td>
                                                                            </tr>
                                                                            <tr>                                                                                       
                                                                                <td>
                                                                                    <span style="cursor: pointer;" class="del_add3_inline del_add3_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $deleivery_address[0]['address_3']; ?></span>                                                                                                                                                                        
                                                                                    <input style="float:left;" type="text" class="none del_add3_inline_txt_<?php echo $cumpony_id; ?>" id="del_add3_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['address_3']; ?>" />
                                                                                    <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="ad3_del_update ad3_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                    <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="ad3_del_cancel ad3_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>                                                                                        
                                                                                <td align="left" width="420">
                                                                                    <table align="left">
                                                                                        <tr align="left">
                                                                                            <td align="left">
                                                                                                <span style="cursor: pointer;" class="del_city_inline del_city_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $deleivery_address[0]['city']; ?></span>,
                                                                                                <input style="float:left; width: 60px;" type="text" class="none del_city_inline_txt_<?php echo $cumpony_id; ?>" id="del_city_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['city']; ?>" />
                                                                                                <span style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="city_del_update city_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                <span style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="city_del_cancel city_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                                                                                                               
                                                                                                <span style="cursor: pointer;margin-left: -2px;" class="del_stat_inline del_stat_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo StateName($deleivery_address[0]['state']); ?></span>&nbsp;
                                                                                                        <select name="state" id="<?php echo $cumpony_id; ?>" class="none del_state del_stat_inline_txt_<?php echo $cumpony_id; ?>" >                    
                                                                                                            <?php
                                                                                                            $state = StateAll();
                                                                                                            foreach ($state as $state_val) {
                                                                                                                if ($state_val['state_abbr'] == $state_abbr) {
                                                                                                                    ?>
                                                                                                                    <option value="<?php echo $state_val['state_abbr'] ?>" selected="selected"><?php echo $state_val['state_abbr']; ?></option>
                                                                                                                <?php } else { ?>
                                                                                                                    <option value="<?php echo $state_val['state_abbr']; ?>"><?php echo $state_val['state_abbr']; ?></option>
                                                                                                                    <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                <span style="cursor: pointer;margin-left: -5px;" class="del_zip_inline del_zip_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $deleivery_address[0]['zip']; ?></span>
                                                                                                <input style="width: 40px;" type="text" class="none del_comp_zip del_zip_inline_txt_<?php echo $cumpony_id; ?>" id="del_zip_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['zip']; ?>" />
                                                                                                <span style="float:right; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="zip_del_update zip_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                <span style="float:right;  margin: 0 0px 0 -10px;"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="zip_del_cancel zip_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></span>
                                                                                                
                                                                                                
                                                                                                <?php //echo $deleivery_address[0]['city'].','.StateName($deleivery_address[0]['state']).'&nbsp;'.$deleivery_address[0]['zip']; ?>                                                                                                
                                                                                            </td> 
                                                                                        </tr>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>                                                                                     
                                                                            <tr>                                                                                        
                                                                                <td>
                                                                                    <?php $del_phone = ($deleivery_address[0]['phone'] == '') ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : $deleivery_address[0]['phone']; ?>
                                                                                    <span class="del_phone_head_inline_span_<?php echo $cumpony_id; ?>"><strong>P : </strong></span>
                                                                                    <span style="cursor: pointer;" class="del_phone_inline del_phone_inline_span_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $del_phone; ?></span>
                                                                                    <input style="width: 80px;" type="text" class="none comp_phone del_phone_inline_txt_<?php echo $cumpony_id; ?>" id="del_phone_inline_txt_<?php echo $cumpony_id; ?>" value="<?php echo $deleivery_address[0]['phone']; ?>" />
                                                                                    <div style="float:left; margin:0 4px"><img src="images/like_icon.png" style="margin-top:-3px;display: none;" alt="Update" title="Update" width="22" height="22" class="phone_del_update phone_del_update_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                    <div style="float:left;  margin:0 4px"><img src="images/cancel_icon.png"  style="margin-top:-4px;display: none;"  alt="Cancel" title="Cancel" width="22" height="22" class="phone_del_cancel phone_del_cancel_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>" /></div>
                                                                                </td>
                                                                            </tr> 
<!--                                                                            <tr>                                                                                        
                                                                                <td>                                                                                           
                                                                                    <span class="<?php echo $cumpony_id; ?>"><strong>F : </strong></span>                                                                                            
                                                                                    <span style="cursor: pointer;" class="bus_fax_inline_span_del_<?php echo $cumpony_id; ?>" id="<?php echo $cumpony_id; ?>"><?php echo $company_fax; ?></span>                                                                                    
                                                                                </td>
                                                                            </tr>-->
                                                                            <tr>                                                                                        
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>                                                                                        
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>                                                                                        
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <!--Delivery Address End -->                              