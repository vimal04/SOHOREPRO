<?php

include './admin/config.php';
include './admin/mail_template.php';

if (isset($_REQUEST['order_val']) == '1') {
    extract($_POST);
    $cus_contact_name = $reg_fname.' '.$reg_lname;
    $sql = "INSERT INTO sohorepro_customers SET
             cus_fname = '" . $reg_fname . "',             
             cus_lname = '" . $reg_lname . "',
             cus_email = '" . $reg_email_id . "',
             cus_pass = '" . $reg_password . "',
             cus_compname = '" . $customer_id_new . "',
             cus_contact_name = '" . $cus_contact_name . "',
             cus_contact_email = '" . $reg_email_id . "',
             cus_contact_phone = '" . $reg_user_phone . "',             
             cus_status   = '1' ";    
    mysql_query($sql);
    
    $notifi_to_iser = CreateUsrNoti($customer_id_new, $reg_contactname);
    //Check If Added the product in Guest
    $chk_prf_guest  = ChkPrdGuest();
    if(count($chk_prf_guest) > 0)
    {    
    //Check User Login
    $user_login = UserLogin($reg_email_id,$reg_password);
        if(count($user_login) > 0){
            $_SESSION['sohorepro_userid']      =$user_login[0]['cus_id'];
            $_SESSION['sohorepro_companyid']   =$user_login[0]['cus_compname'];
            $_SESSION['sohorepro_username']    =$user_login[0]['cus_contact_name'];
            header("Location:shoppingcart.php?ref=".$new_usr_ref);   
        }  else {
            echo 'Credentials In-Correct';
        }           
    }  else {
    header("Location:existing_customer.php?new_user=succ&cus_id=" . $customer_id_new);    
    }
}

if (isset($_REQUEST['new_company_add']) == '1') {
    
    
    
    extract($_POST);

    $comp_name_exist = checkcomp($reg_compname);

    if (count($comp_name_exist) > 0) {
        $message = '<html>';
        $message .='<head>';
        $message .='<title></title>';
        $message .='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        $message .='</head>';
        $message .='<body>';
        $message .='<table width="550" border="0" cellspacing="0" cellpadding="0">';
        $message .='<tr bgcolor="#ff7e00">';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='<td height="10" align="left" valign="top"></td>';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .='<td align="left" valign="top">';
        $message .='<table width="530" border="0" cellspacing="0" cellpadding="0">';
        $message .='<tr>';
        $message .='<td width="20" height="20" align="left" valign="top"></td>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='<td width="20" height="20" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td width="20" align="left" valign="top"></td>';
        $message .='<td align="left" valign="top">';
        $message .='<table width="490" border="0" cellspacing="0" cellpadding="0">';
        $message .='<tr>';
        $message .='<td width="100" align="left" valign="top"><img src="http://supply.sohorepro.com/store_files/soho_logo.jpg" width="126" height="115" alt=""/></td>';
        $message .='<td width="40" align="left" valign="top"></td>';
        $message .='<td width="350" align="left" valign="top">';
        $message .='<table width="350" border="0" cellspacing="0" cellpadding="0" style="margin-right:-1px;">';
        $message .='<tr>';
        $message .='<td height="25" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;">Dear ' . $reg_contactname . ',</br></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">';
        $message .='<table>';
        $message .='<tr>';
        $message .='<td>You have entered company name <b>'.$reg_compname.'</b> is already exist please try another name.</td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444; padding-top:10px;">Thanks';
        $message .='</td></tr><tr>';
        $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">SohoRepro';
        $message .='</td></tr></table></td></tr></table></td>';      
        $message .='<td width="20" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</td>';
        $message .='<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .='</tr>';
        $message .='<tr bgcolor="#ff7e00">';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='<td height="10" align="left" valign="top"></td>';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</body>';
        $message .='</html>';

        $subject = 'Company name '.$reg_compname.' is already exist - SohoRepro';
        $headers = 'From: "SohoRepro" <noreply@new-sohorepro.com>' . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $mail_id = $reg_contactmail;
        $result_mail = mail($mail_id, $subject, $message, $headers);
        if ($result_mail) {
           header("Location:success.php");
        }
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "tax_form/" . $_FILES["file"]["name"]);
        $tax_file_name = $_FILES["file"]["name"];
        $sql = "INSERT INTO sohorepro_company SET            
             comp_contact_name = '" . $reg_contactname . "',
             comp_contact_email = '" . $reg_contactmail . "',
             comp_name = '" . $reg_compname . "',             
             comp_contact_phone = '" . $reg_contphone1 . "',
             comp_contact_fax   = '".$reg_busifax."',
             comp_business_address1 = '" . $address1 . "',
             comp_business_address2 = '" . $address2 . "',
             comp_room = '" . $reg_busiroom . "',
             comp_suite = '" . $reg_busisuite . "',
             comp_floor = '" . $reg_busifloor . "',
             comp_city = '" . $reg_busicity . "',
             comp_state = '" . $state . "',
             comp_zipcode = '" . $reg_busizip . "',
             comp_phone1 = '" . $reg_phone1 . "',
             comp_phone2 = '" . $reg_phone2 . "',
             comp_phone3 = '" . $reg_phone3 . "',
             comp_phone4 = '" . $reg_phone4 . "',
             tax_form_resale = '" . $tax_file_name . "',    
             tax_exe  = '" . $reg_tax . "' ";
        $result = mysql_query($sql);
        
        //Insert the Primari Billing address for New Company Start
        $comp_id = mysql_insert_id();
        $shipp_state_id = StateId($state);
        $shipp_sql = "INSERT INTO sohorepro_address SET            
             comp_id = '" . $comp_id . "',
             company_name = '" . $reg_compname . "',
             contact_name = '" . $reg_contactname . "',             
             address_1 = '" . $address1 . "',
             address_2 = '" . $address2 . "',
             address_3 = '" . $reg_busiroom.' '.$reg_busisuite .' '.$reg_busifloor. "',            
             city = '" . $reg_busicity . "',
             state = '" . $shipp_state_id . "',
             zip = '" . $reg_busizip . "',
             phone = '" . $reg_contphone1 . "',
             attention_to = '" . $reg_contactname . "',
             type = '1',
             prop = '0'";
        mysql_query($shipp_sql);        
        //Insert the Primari Billing address for New Company End

        $message = '<html>';
        $message .='<head>';
        $message .='<title></title>';
        $message .='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        $message .='</head>';
        $message .='<body>';
        $message .='<table width="550" border="0" cellspacing="0" cellpadding="0">';
        $message .='<tr bgcolor="#ff7e00">';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='<td height="10" align="left" valign="top"></td>';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .='<td align="left" valign="top">';
        $message .='<table width="530" border="0" cellspacing="0" cellpadding="0">';
        $message .='<tr>';
        $message .='<td width="20" height="20" align="left" valign="top"></td>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='<td width="20" height="20" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td width="20" align="left" valign="top"></td>';
        $message .='<td align="left" valign="top">';
        $message .='<table width="490" border="0" cellspacing="0" cellpadding="0">';
        $message .='<tr>';
        $message .='<td width="100" align="left" valign="top"><img src="http://supply.sohorepro.com/store_files/soho_logo.jpg" width="126" height="115" alt=""/></td>';
        $message .='<td width="40" align="left" valign="top"></td>';
        $message .='<td width="350" align="left" valign="top">';
        $message .='<table width="350" border="0" cellspacing="0" cellpadding="0" style="margin-right:-1px;">';
        $message .='<tr>';
        $message .='<td height="25" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;">Dear ' . $reg_contactname . ',</br></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">';
        $message .='<table>';
        $message .='<tr>';
        $message .='<td>Thank you for your request, your application is under review. You will be contacted by a representative after your application has been approved.</td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444; padding-top:10px;">Thanks</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">SohoRepro</td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</td>';
        $message .='<td width="20" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='<td height="20" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</td>';
        $message .='<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .='</tr>';
        $message .='<tr bgcolor="#ff7e00">';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='<td height="10" align="left" valign="top"></td>';
        $message .='<td width="10" height="10" align="left" valign="top"></td>';
        $message .='</tr>';
        $message .='</table>';
        $message .='</body>';
        $message .='</html>';


        $subject = 'New Account Created - SohoRepro';
        $headers = 'From: "SohoRepro" <no-reply@sohorepro.com>' . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $mail_id = $reg_contactmail;
        //$mail_id = 'n.mohamedjassim@gmail.com';
        $result_mail = mail($mail_id, $subject, $message, $headers);
        $admin_alert = AdminAlert($reg_compname,$reg_contactname);

        //echo $admin_alert;
        if ($result_mail) {
            header("Location:success.php");
        }
    }
}

