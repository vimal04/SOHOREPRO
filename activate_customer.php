<?php
include './admin/config.php';

include './admin/mail_template.php';


if (isset($_REQUEST['activate_comp']) != '') {
    
    $activate_comp          = $_POST['activate_comp'];
    $activate_usr           = $_POST['activate_usr'];
    
    $query_customer         = "UPDATE sohorepro_company SET status = '1'  WHERE comp_id = '" . $activate_comp . "' ";
    $sql_result_customer    = mysql_query($query_customer);
    
    $query_user             = "UPDATE sohorepro_customers SET cus_status = '1'  WHERE cus_id = '" . $activate_usr . "' ";
    $sql_result_user        = mysql_query($query_user);
    
    $reg_compname           = getCompName($activate_comp);
    $reg_contactname        = getCompContName($activate_comp);  
    $reg_contactmail        = getCompContMail($activate_comp);
    $reg_fname_lname        = getCompContFLName($activate_comp);
    
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
    $message .='<td height="25" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;">Dear ' . $reg_fname_lname . ',</br></td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">';
    $message .='<table>';
    $message .='<tr>';
    $message .='<td>Thank you for applying for a new account. It can take up to 3 business days to process your request. Once approved, a representative will contact you to inform you of your account status. In the interim, you may use this account.</td>';
    $message .='</tr>';
    $message .='</table>';
    $message .='</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444; padding-top:10px;">Thanks,</td>';
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
    $result_mail = mail($mail_id, $subject, $message, $headers);
    $admin_alert = AdminAlertActive($reg_compname,$reg_fname_lname, $activate_comp);
    
    
    
    if($admin_alert){
        echo '1';
    }
    
}

