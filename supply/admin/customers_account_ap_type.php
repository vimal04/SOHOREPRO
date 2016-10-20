<?php 
include './config.php';

if(isset($_POST['comp_id']) && $_POST['comp_id'] != '')
{
    $company_id         = $_POST['comp_id'];
    $customer_id        = $_POST['cust_id'];
    $type               = $_POST['account_ap_type'];
    $update_exist_user  = "UPDATE sohorepro_customers SET ap_user = '0' WHERE cus_compname = '".$company_id."' ";
    mysql_query($update_exist_user);
    $update_new_user    = "UPDATE sohorepro_customers SET ap_user = '".$type."' WHERE cus_id = '".$customer_id."' ";
    mysql_query($update_new_user);
    $query              = "select * from sohorepro_customers where cus_id ='".$customer_id."' AND cus_compname ='".$company_id."' "; 
    $res                = mysql_query($query);
    $object             = mysql_fetch_assoc($res);
    $cus_type           = $object['cus_manager'];
    $ap_type            = $object['ap_user'];
    $cus_status         = ($type == '1') ? '<span style="color:green;font-size: 13px;">This user as a AP user</span>' : '<span style="color:red;font-size: 13px;">This user not a AP user</span>';
    echo $cus_status.'~';
}
?>
<!--<div id="msg_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" class="cus_adm_succ"></div>-->
<table border="0" width="100%" class="cust_edit_tab">
            <?php if (mysql_num_rows($res) > 0) { ?>
                <tr>
                <span class="main_id" id="<?php echo $company_id; ?>_<?php echo $customer_id; ?>"></span>
                <td width="30%" class="inf">First Name</td>
                <td align="left" width="70%">
                    <span class="edit_fname cus_fname_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_fname_<?php echo $company_id; ?>_<?php echo $customer_id; ?>"><?php echo $object['cus_fname']; ?></span>
                    <input type="text" class="inline-text-cus none inline_height cus_fname_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_fname_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" value="<?php echo $object['cus_fname']; ?>" />
                    <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="fnupdate fn_update_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div>
                    <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="fncancel fn_cancel_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div></td>
                </td>
                </tr>
                <tr>
                    <td class="inf">Last Name</td>
                    <td align="left">
                        <span class="edit_lname cus_lname_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_lname_<?php echo $company_id; ?>_<?php echo $customer_id; ?>"><?php echo $object['cus_lname']; ?></span>
                        <input type="text" class="inline-text-cus none cus_lname_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_lname_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" value="<?php echo $object['cus_lname']; ?>" />
                        <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="lnupdate ln_update_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div>
                        <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="lncancel ln_cancel_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div></td>
                    </td>
                </tr>
                <tr>
                    <td class="inf">Email</td>
                    <td align="left">
                        <span class="edit_email cus_email_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_email_<?php echo $company_id; ?>_<?php echo $customer_id; ?>"><?php echo wordwrap($object['cus_email'],15,"<br>\n",TRUE);?></span>
                        <input type="text" class="inline-text-cus none cus_email_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_email_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" value="<?php echo $object['cus_email']; ?>" />
                        <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="emupdate em_update_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div>
                        <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="emcancel em_cancel_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div></td>
                    </td>
                </tr>
                <tr>
                    <td class="inf">Password</td>
                    <td align="left">
                        <span class="edit_password cus_password_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_password_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="cursor: pointer;"><?php echo $object['cus_pass']; ?></span><span onclick="return resend_cred('<?php echo $company_id; ?>','<?php echo $customer_id; ?>');"  id="cus_resend_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="cursor: pointer;display: inline;background: #03803E;float: right;padding: 2px 5px;color: #FFF;font-weight: bold;font-size: 11px;border-radius: 5px;">RESEND</span>
                        <input type="text" class="inline-text-cus none cus_password_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_password_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" value="<?php echo $object['cus_pass']; ?>" />
                        <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="passwordupdate password_update_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div>
                        <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="passwordcancel password_cancel_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div></td>
                    </td>
                </tr>
                <tr>
                    <td class="inf">Phone</td>
                    <td align="left">
                        <span class="edit_phone cus_phone_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_phone_<?php echo $company_id; ?>_<?php echo $customer_id; ?>"><?php echo $object['cus_contact_phone']; ?></span>
                        <input type="text" class="phone inline-text-cus none cus_phone_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" id="cus_phone_txt_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" value="<?php echo $object['cus_contact_phone']; ?>" />
                        <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="phupdate ph_update_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div>
                        <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="phcancel ph_cancel_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="display: none;"/></div></td>
                    </td>
                </tr>
                <tr>
                <td class="inf">Admin</td>                
                <td align="left">
                    <span class="copm_id none" id="<?php echo $company_id; ?>"></span>
                    <span class="customer_id none" id="<?php echo $id_comp; ?>"></span>
                    <input type="checkbox" name="manager" id="manager" class="manager manager_input" value="1" <?php if ($cus_type == '1') {echo 'checked=checked';} ?>></td>
                </tr>
                <tr>
                <td class="inf">AP</td>                
                <td align="left">
                    <span class="copm_id none" id="<?php echo $company_id; ?>"></span>
                    <span class="customer_id none" id="<?php echo $id_comp; ?>"></span>
                    <input type="checkbox"  name="manager_ap" id="manager_ap" class="manager_ap manager_ap_input" value="1" <?php if ($ap_type == '1') {echo 'checked=checked';} ?>>
                </td>
                </tr>
                <tr>
                    <td class="inf" colspan="2">
                        <span onclick="return delete_ind_user('<?php echo $company_id; ?>','<?php echo $customer_id; ?>');"  id="cus_resend_<?php echo $company_id; ?>_<?php echo $customer_id; ?>" style="cursor: pointer;display: inline;background: #d3412c;float: left;padding: 2px 5px;color: #FFF;font-weight: bold;font-size: 11px;border-radius: 5px;">DELETE USER</span>
                    </td>
                </tr>
                
            <?php } else { ?>
                <tr>
                    <td class="inf" colspan="2" align="center">Select customer name.</td>        
                </tr>
    <?php } ?>
        </table>


<script language="javascript" src="js/customer.js"></script>