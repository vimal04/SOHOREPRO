<?php
include './include/class.phpmailer.php';

function mail_exist($mail)
{
    $select_mail = "SELECT * FROM sohorepro_users WHERE email = '".$mail."' AND status = '1'";
    $mail        = mysql_query($select_mail);
    $object      = mysql_fetch_assoc($mail);
    $mail_id     = $object['email']; 
    return $mail_id;
}

function mail_exist_ap($mail)
{
    $select_mail = "SELECT * FROM sohorepro_customers WHERE cus_email = '".$mail."' AND cus_status = '1'";
    $mail        = mysql_query($select_mail);
    $object      = mysql_fetch_assoc($mail);
    $mail_id     = $object['cus_email']; 
    return $mail_id;
}

function Crederntials($mail_id) {
    $select_details  = "SELECT * FROM sohorepro_users WHERE email = '$mail_id'";
    $details            = mysql_query($select_details);
    while ($object = mysql_fetch_assoc($details)):
        $value[] = $object;
    endwhile;
    return $value;
}

function CrederntialsAP($mail_id) {
    $select_details  = "SELECT * FROM sohorepro_customers WHERE cus_email = '$mail_id'";
    $details            = mysql_query($select_details);
    while ($object = mysql_fetch_assoc($details)):
        $value[] = $object;
    endwhile;
    return $value;
}


function forgot_mail_ap($mail_id)
{
    $details    = CrederntialsAP($mail_id);
    $user_name  = $details[0]['cus_email'];
    $pass       = $details[0]['cus_pass'];
    $type       = 'A/P User';
    
    $message  ='<html>';
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
    $message .='<td width="100" align="left" valign="top"><img src="http://cipldev.com/soho-repro/supply.sohorepro.com/store_files/soho_logo.jpg" width="126" height="115" alt=""/></td>';
    $message .='<td width="40" align="left" valign="top"></td>';
    $message .='<td width="350" align="left" valign="top">';
    $message .='<table width="350" border="0" cellspacing="0" cellpadding="0" style="margin-right:-1px;">';
    $message .='<tr>';
    $message .='<td height="25" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;">Dear '.$type.',</br></td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">';
    $message .='<table>';
    $message .='<tr>';
    $message .='<td>Username : </td>';
    $message .='<td><span style="font-family:Arial, Helvetica, sans-serif;font-weight:bold;">'.$user_name.'</span></td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td>Password :</td>';
    $message .='<td><span style="font-family:Arial, Helvetica, sans-serif;font-weight:bold;">'.$pass.'</span></br></td>';
    $message .='</tr>';
    $message .='</table>';
    $message .='</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444; padding-top:10px;">Thanks</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">The SohoRepro Team</td>';
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
        
    $subject = 'SohoRepro - Login credentials';
    $headers = 'From: "SohoRepro" <no-reply@sohorepro.com>' . "\r\n";
    // Always set content-type when sending HTML email
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";    
    $result = mail($mail_id, $subject, $message, $headers);
    
    if($result){
        return '1';
    }  else {
    return  '0';
    }
    
}


function forgot_mail($mail_id)
{
    $details    = Crederntials($mail_id);
    $user_name  = $details[0]['user_name'];
    $pass       = base64_decode($details[0]['password']);
    $type       = ($details[0]['type'] == '2') ? 'Staff User' : 'User';
    
    $message  ='<html>';
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
    $message .='<td width="100" align="left" valign="top"><img src="http://cipldev.com/soho-repro/supply.sohorepro.com/store_files/soho_logo.jpg" width="126" height="115" alt=""/></td>';
    $message .='<td width="40" align="left" valign="top"></td>';
    $message .='<td width="350" align="left" valign="top">';
    $message .='<table width="350" border="0" cellspacing="0" cellpadding="0" style="margin-right:-1px;">';
    $message .='<tr>';
    $message .='<td height="25" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;">Dear '.$type.',</br></td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">';
    $message .='<table>';
    $message .='<tr>';
    $message .='<td>Username : </td>';
    $message .='<td><span style="font-family:Arial, Helvetica, sans-serif;font-weight:bold;">'.$user_name.'</span></td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td>Password :</td>';
    $message .='<td><span style="font-family:Arial, Helvetica, sans-serif;font-weight:bold;">'.$pass.'</span></br></td>';
    $message .='</tr>';
    $message .='</table>';
    $message .='</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444; padding-top:10px;">Thanks</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">The SohoRepro Team</td>';
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
        
    $subject = 'SohoRepro - Login credentials';
    $headers = 'From: "SohoRepro" <no-reply@sohorepro.com>' . "\r\n";
    // Always set content-type when sending HTML email
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";    
    $result = mail($mail_id, $subject, $message, $headers);
    
    if($result){
        return '1';
    }  else {
    return  '0';
    }
    
}



function ExtraProductsInOrder($Order_Id,$shipp_add_id)
{       
        $sql_order_id_mail      = mysql_query("SELECT id,order_id,created_date,order_number,customer_name,customer_company,deleivery_date,order_comment FROM sohorepro_order_master WHERE id = '".$Order_Id."' ORDER BY id DESC LIMIT 1");
        $object                 = mysql_fetch_assoc($sql_order_id_mail);
        $user_mail              = UserMail($object['customer_name']);
        $user_name              = UserName($object['customer_name']);
        $company_name           = companyName($object['customer_company']);
        $phone                  = companyphone($object['customer_company']);
        $shipp_address          = CompanyAddressMail($shipp_add_id);
        $prop                   = PropTest($shipp_add_id);
        $id                     = $Order_Id;
        $Order_id               = $object['order_id'];
        $Order_number           = $object['order_number'];
        $deleivery_date         = $object['deleivery_date'];
        $comp_id                = $object['customer_company'];
        $order_comm             = $object['order_comment'];
        //$current_time           = date("Y-m-d h:i:s");
        $current_time = $object['created_date'];
        $datew = new DateTime($current_time, new DateTimeZone('America/New_York'));
        date_default_timezone_set('America/New_York');
        $temp_times =  date("Y-m-d h:iA", $datew->format('U'));
        $Date = date("m-d-Y", strtotime($object['created_date'])). ' ' .date("h:iA",strtotime("-180 minutes",strtotime($temp_times)));
        //$Date                   = date('m-d-y').' '.$datetime_from;                              
        $view_orders            = viewOrders($id);
        $pick_up                = $view_orders[0]['shipping_add_id'];
        $mail_id                = getActiveEmail();
        $customer_email         = CompanyMail($comp_id);
        $comment                = 'Comment :';
        
        $mail = new PHPMailer();

        $message  ='<html>';
        $message .='<head>';
        $message .='<title></title>';
        $message .='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        $message .='<style type="text/css">';
        $message .='div, p, a, li, td { -webkit-text-size-adjust:none; }';        
        $message .='</style>';
        $message .='</head>';
        $message .='<body>';
        $message .= '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
        $message .= '<table width="780" border="0" cellspacing="0" cellpadding="0" class="padd">';
        $message .= '<tr bgcolor="#ff7e00">';
        $message .= '<td width="10" height="10" align="left" valign="top"></td>';
        $message .= '<td height="10" align="left" valign="top"></td>';
        $message .= '<td width="10" height="10" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .= '<td align="left" valign="top"><table width="760" border="0" cellspacing="0" cellpadding="0">';
        $message .= '<tr>';
        $message .= '<td width="20" height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td width="20" height="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '<td align="left" valign="top"><table width="740" border="0" cellspacing="0" cellpadding="0">';
        $message .= '<tr>';
        $message .= '<td>Your Soho Repro graphics order has been received and will be processed promptly.</br></br></td>';
        $message .= '</tr>';
        $message .= '<tr height="25px">';
        $message .= '<td><span style="font-weight:bold;">Date :</span> '.$Date.'</td>';
        $message .= '</tr>';
        $message .= '<tr height="25px">';
        $message .= '<td><span style="font-weight:bold;">Name :</span> '.$user_name.'</td>';
        $message .= '</tr>';
        $message .= '<tr height="25px">';
        $message .= '<td><span style="font-weight:bold;">Company :</span> ' .$company_name. '</td>';
        $message .= '</tr>';
        $message .= '<tr height="25px">';
        $message .= '<td><span style="font-weight:bold;">Email :</span> ' .$user_mail. '</td>';
        $message .= '</tr>';
        $message .= '<tr height="25px">';
        $message .= '<td><span style="font-weight:bold;">Phone :</span> ' .$phone. '</td>';
        $message .= '</tr>';
        if($pick_up == 'P'){
        $message .= '<tr height="30px">';
        $message .= '<td><span style="font-weight:bold;">Pickup Address: </span></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td style="padding-bottom:7px;">Soho Reprographics<br>381 Broome Street<br>New York, NY 10013</td>';
        $message .= '</tr>';
        }else{
        $message .= '<tr height="30px">';
        $message .= '<td><span style="font-weight:bold;">Billing Address: </span></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td style="padding-bottom:7px;">'.$shipp_address['address_1'].'<br>'.$shipp_address['address_2'].'<br>'.$shipp_address['address_3'].'<br>'.$shipp_address['city'].','.StateName($shipp_address['state']).','.$shipp_address['zip'].'</td>';
        $message .= '</tr>';
        $message .= '<tr height="25px">';
        $message .= '<td><span style="font-weight:bold;">Shipping Address: </span></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td>'.$shipp_address['address_1'].'<br>'.$shipp_address['address_2'].'<br>'.$shipp_address['address_3'].'<br>'.$shipp_address['city'].','.StateName($shipp_address['state']).','.$shipp_address['zip'].'</td>';
        $message .= '</tr>';    
        }
        $message .= '<tr height="30px">';
        $message .= '<td><span style="font-weight:bold;">Customer Reference :</span> ' . $Order_id . '</td>';
        $message .= '</tr>';
        $message .= '<tr height="30px">';
        $message .= '<td><span style="font-weight:bold;">Deleivery Date :</span> ' . $deleivery_date . '</td>';
        $message .= '</tr>';
        $message .= '</table></td>';
        $message .= '<td height="25" width="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '<td align="left" valign="top">';
        $message .= '<table width="740" border="0" cellspacing="0" cellpadding="0" style="margin-right:-1px;">';
        $message .= '<tr style="color:#fff; text-transform:uppercase;">';
        $message .= '<td width="40" align="center" valign="middle" bgcolor="#f68210" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;">Item</td>';
        $message .= '<td width="400" align="center" valign="middle" bgcolor="#f68210" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;">Description</td>';
        $message .= '<td width="80" align="center" valign="middle" bgcolor="#f68210" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;">Quantity</td>';
        $message .= '<td width="100" align="center" valign="middle" bgcolor="#f68210" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;">Unit Price</td>';
        $message .= '<td width="110" align="center" valign="middle" bgcolor="#f68210" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;">Total</td>';
        $message .= '</tr>';
        $total = 0;
        $i = 1;
        foreach ($view_orders as $ord) {
            $rowColor   = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
            $rowColor1  = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
            $prod_id    = $ord['product_id'];
            $shipping   = SelectAllAddress($ord['shipping_add_id']);
            $id = $ord['id'];    
        $message .= '<tr>';
        $message .= '<td width="40" align="left" valign="middle" bgcolor="'.$rowColor1.'" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-left:20px;">'.$i.'</td>';
        $message .= '<td width="400" align="center" valign="middle" bgcolor="'.$rowColor.'" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;">'.getorderProd($prod_id).'</td>';
        $message .= '<td width="80" align="right" valign="middle" bgcolor="'.$rowColor1.'" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;">'.$ord['product_quantity'].'</td>';
        $message .= '<td width="100" align="right" valign="middle" bgcolor="'.$rowColor.'" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;">'.'$' . $ord['product_price'].'</td>';
        $message .= '<td width="110" align="right" valign="middle" bgcolor="'.$rowColor1.'" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;">'.'$' . ($ord['product_quantity'] * $ord['product_price']).'</td>';
        $message .= '</tr>';
        $sub_tot = $ord['product_quantity'] * $ord['product_price'];
        $tax_status = getTaxStatusChk($comp_id);
        if($tax_status == '1')
        {
        $tax_line = '0';    
        }  else {
        $tax_line = '8.875';       
        }
        $total = $total + $sub_tot;
        $tax         = ($tax_line * ($total/100));
        $i++;
        }
        $message .= '<tr>';
        $message .= '<td colspan="2" rowspan="3" bgcolor="#eeeeee" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;"><span style="font-weight:bold;">'.$comment.'</span><br>'.$order_comm.'</td>';
        $message .= '<td colspan="2" align="right" bgcolor="#eeeeee" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;"><span style="font-weight:bold;">Subtotal</span></td>';
        $message .= '<td bgcolor="#eeeeee" align="right" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;">'.'$' .number_format($total, 2, '.', '').'</td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td colspan="2" align="right" bgcolor="#dfdfdf" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;"><span style="font-weight:bold;">Tax</span></td>';
        $message .= '<td bgcolor="#dfdfdf" align="right" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;">'.'$' .number_format($tax, 2, '.', '').'</td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td colspan="2" align="right" bgcolor="#eeeeee" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;"><span style="font-weight:bold;">Total*</span></td>';
        $message .= '<td bgcolor="#eeeeee" align="right" style="border-right:1px solid #fff; border-bottom:1px solid #fff; padding:7px 0px;padding-right:15px;">'.'$' .number_format(($total + $tax), 2, '.', '').'</td>';
        $message .= '</tr>';
        $message .= '</table></td>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="20" height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td width="20" height="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top" style="padding-bottom:5px;font-size:12px;">*Delivery charges to be applied as necessary</td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= ' </tr>';
        $message .= '</table></td>';
        $message .= '<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .= '</tr>';
        $message .= '<tr bgcolor="#ff7e00">';
        $message .= '<td width="10" height="10" align="left" valign="top"></td>';
        $message .= '<td height="10" align="left" valign="top"></td>';
        $message .= '<td width="10" height="10" align="left" valign="top"></td>';
        $message .= ' </tr>';
        $message .= '</table>';
        $message .='</table>';
        $message .='</body>';
        $message .='</html>';
        
//        foreach ($mail_id as $to){
//        $subject    = "Soho Reprographic Order Acknowledgement with Extra Products";
//        $headers    = 'From: "SohoRepro" <no-reply@sohorepro.com>' . "\r\n";
//        $headers   .= 'MIME-Version: 1.0' . "\n";
//        $headers   .= 'Content-Type: text/html; charset=utf-8\r\n';
//        $headers   .= 'Content-Transfer-Encoding: 8bit\r\n\r\n';        
//        $to         = $to['email_id'];
//        //echo $to, $subject, $message, $headers;
//        $result = mail($to, $subject, $message, $headers);
//        }
        
        $mail->AddAddress($user_mail, $user_mail);  
        $mail->AddAddress($customer_email, $customer_email);
        foreach ($mail_id as $to){
        $mail->SetFrom('no-reply@sohorepro.com', "SohoRepro");
        $mail->AddAddress($to['email_id'], $to['name']);
        $mail->Subject = 'Order Changed by Admin for Job:'.$Order_id;
        $mail->IsHTML(true);
        $mail->Body = $message;
        $result = $mail->Send();
        }
//        $mail->SetFrom('no-reply@sohorepro.com', "SohoRepro");
//        $mail->AddAddress($user_mail, $user_mail);        
//        $mail->Subject = 'Soho Reprographic Order Acknowledgement with Extra Products';
//        $mail->IsHTML(true);
//        $mail->Body = $message;
//        $mail->Send();
        
        //mail($user_mail, $subject, $message, $headers);
        if($result){
        return '1';
        }  else {
        return  '0';
        }
}



function AdminAlert($reg_compname,$reg_contactname)
{
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
    $message .='<td height="25" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;">Dear Admin,</br></td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444">';
    $message .='<table>';
    $message .='<tr>';
    $message .='<td>Company Name : '.$reg_compname.'</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td>Contact Name : '.$reg_contactname.'</td>';
    $message .='</tr>';
    $message .='<tr>';
    $message .='<td><a href="http://supply.sohorepro.com/admin/new_accounts.php" target="_blank">http://supply.sohorepro.com/admin/new_accounts.php</a></td>';
    $message .='</tr>';
    $message .='</table>';
    $message .='</td>';
    $message .='</tr>';    
    $message .='</table>';
    $message .='</td>';
    $message .='</tr>';
    $message .='</table>';
    $message .='</td>';
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

    $mail_id  = getActiveEmail();
    foreach ($mail_id as $to){
    $subject = 'New Account Created by '.$reg_compname;
    $headers = 'From: "SohoRepro" <no-reply@sohorepro.com>' . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $to = $to['email_id'];
    //$mail_id = 'n.mohamedjassim@gmail.com';
    $result_mail = mail($to, $subject, $message, $headers);
    }
    if($result_mail){
        return '1';
    }  else {
        return  '0';
    }
}

?>
