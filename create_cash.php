<?php

include './admin/config.php';

include './admin/mail_template.php';


if (isset($_REQUEST['new_company_add']) == '1') {
    extract($_POST);
    $_SESSION['reg_contactmail'] = $reg_contactmail;
    $comp_name_exist = checkcomp($reg_compname);
    
        move_uploaded_file($_FILES["file"]["tmp_name"], "tax_form/" . $_FILES["file"]["name"]);
        $tax_file_name = $_FILES["file"]["name"];
        $sql = "INSERT INTO sohorepro_company SET 
             comp_contact_name = '" . mysql_real_escape_string($reg_contactname) . "',
             comp_contact_email = '" . mysql_real_escape_string($reg_contactmail) . "',
             comp_name = '" . mysql_real_escape_string($reg_contactname) . "',   
             comp_contact_phone = '" . mysql_real_escape_string($reg_contphone1) . "',
             comp_contact_fax   = '". mysql_real_escape_string($reg_busifax) ."',
             comp_business_address1 = '" . mysql_real_escape_string($address1) . "',
             comp_business_address2 = '" . mysql_real_escape_string($address2) . "',
             comp_business_address3 = '" . mysql_real_escape_string($address3) . "',
             comp_room = '" . mysql_real_escape_string($reg_busiroom) . "',
             comp_suite = '" . mysql_real_escape_string($reg_busisuite) . "',
             comp_floor = '" . mysql_real_escape_string($reg_busifloor) . "',
             comp_city = '" . mysql_real_escape_string($reg_busicity) . "',
             comp_state = '" . mysql_real_escape_string($state) . "',
             comp_zipcode = '" . mysql_real_escape_string($reg_busizip) . "',
             comp_zipcode_ext   =   '" . mysql_real_escape_string($reg_busizip_ext) . "',    
             comp_phone1 = '" . mysql_real_escape_string($reg_phone1) . "',
             comp_phone2 = '" . mysql_real_escape_string($reg_phone2) . "',
             comp_phone3 = '" . mysql_real_escape_string($reg_phone3) . "',
             comp_phone4 = '" . mysql_real_escape_string($reg_phone4) . "',
             tax_form_resale = '" . mysql_real_escape_string($tax_file_name) . "',   
             tax_exe  = '" . mysql_real_escape_string($reg_tax) . "',
             cus_type  = '2' ";
        $result = mysql_query($sql);        

        //Insert the Primari Billing address for New Company Start

        $comp_id = mysql_insert_id();
        $_SESSION['com_id_last'] = $comp_id;
        $shipp_state_id = StateId($state);
        if($del_address1 != ''){
        $shipp_sql = "INSERT INTO sohorepro_address SET 
             comp_id = '" . $comp_id . "',
             company_name = '" . mysql_real_escape_string($reg_contactname) . "',
             contact_name = '" . mysql_real_escape_string($reg_contactname) . "', 
             address_1 = '" . mysql_real_escape_string($del_address1) . "',
             address_2 = '" . mysql_real_escape_string($del_address2) . "',
             suite = '" . mysql_real_escape_string($reg_busiroom) ."',            
             city = '" . mysql_real_escape_string($del_busicity) . "',
             state = '" . mysql_real_escape_string($del_state) . "',
             zip = '" . mysql_real_escape_string($del_busizip) . "',
             phone = '" . mysql_real_escape_string($del_phone) . "',
             attention_to = '" . mysql_real_escape_string($reg_contactname) . "',
             type = '1',
             prop = '0'";
        mysql_query($shipp_sql);             
        }  else {
        $shipp_sql = "INSERT INTO sohorepro_address SET 
             comp_id = '" . $comp_id . "',
             company_name = '" . mysql_real_escape_string($reg_contactname) . "',
             contact_name = '" . mysql_real_escape_string($reg_contactname) . "', 
             address_1 = '" . mysql_real_escape_string($address1) . "',
             address_2 = '" . mysql_real_escape_string($address2) . "',
             suite = '" . mysql_real_escape_string($reg_busiroom) ."',            
             city = '" . mysql_real_escape_string($reg_busicity) . "',
             state = '" . mysql_real_escape_string($shipp_state_id) . "',
             zip = '" . mysql_real_escape_string($reg_busizip) . "',
             zip_ext = '". mysql_real_escape_string($reg_busizip_ext) ."',
             phone = '" . mysql_real_escape_string($reg_contphone1) . "',
             attention_to = '" . mysql_real_escape_string($reg_contactname) . "',
             type = '1',
             prop = '0'";
        mysql_query($shipp_sql);     
        }
               
        
        //Insert the Primari Billing address for New Company End
        
        //Insert teh Service Address Start//
        if($del_address1 != ''){
        $shipp_sql_services = "INSERT INTO sohorepro_address_service SET 
             comp_id = '" . $_SESSION['com_id_last'] . "',
             company_name = '" . mysql_real_escape_string($reg_contactname) . "',
             contact_name = '" . mysql_real_escape_string($reg_contactname) . "', 
             address_1 = '" . mysql_real_escape_string($del_address1) . "',
             address_2 = '" . mysql_real_escape_string($del_address2) . "',
             suite = '" . mysql_real_escape_string($reg_busiroom) ."',            
             city = '" . mysql_real_escape_string($del_busicity) . "',
             state = '" . mysql_real_escape_string($del_state) . "',
             zip = '" . mysql_real_escape_string($del_busizip) . "',
             phone = '" . mysql_real_escape_string($del_phone) . "',
             attention_to = '" . mysql_real_escape_string($reg_contactname) . "',
             type = '1',
             prop = '0'";
        mysql_query($shipp_sql_services); 
        }else{
        $shipp_sql_services = "INSERT INTO sohorepro_address_service SET 
             comp_id = '" . $_SESSION['com_id_last'] . "',
             company_name = '" . mysql_real_escape_string($reg_contactname) . "',
             contact_name = '" . mysql_real_escape_string($reg_contactname) . "', 
             address_1 = '" . mysql_real_escape_string($address1) . "',
             address_2 = '" . mysql_real_escape_string($address2) . "',
             suite = '" . mysql_real_escape_string($reg_busiroom) ."',            
             city = '" . mysql_real_escape_string($reg_busicity) . "',
             state = '" . mysql_real_escape_string($shipp_state_id) . "',
             zip = '" . mysql_real_escape_string($reg_busizip) . "',
             zip_ext = '". mysql_real_escape_string($reg_busizip_ext) ."',
             phone = '" . mysql_real_escape_string($reg_contphone1) . "',
             attention_to = '" . mysql_real_escape_string($reg_contactname) . "',
             type = '1',
             prop = '0'";
        mysql_query($shipp_sql_services);
        }
        //Insert teh Service Address End//
        
        
    
    $sql_user_create = "INSERT INTO sohorepro_customers SET
             cus_fname = '" . mysql_real_escape_string($reg_firstname) . "', 
             cus_lname = '" . mysql_real_escape_string($reg_lastname) . "',
             cus_email = '" .  mysql_real_escape_string($reg_contactmail) . "',
             cus_pass = '" . $reg_password . "',
             cus_compname = '" . mysql_real_escape_string($_SESSION['com_id_last']) . "',
             cus_contact_name = '" . mysql_real_escape_string($reg_contactname) . "',
             cus_contact_email = '" . mysql_real_escape_string($reg_contactmail) . "',
             cus_contact_phone = '" . mysql_real_escape_string($reg_contphone1) . "', 
             cus_status   = '0' ";    

    mysql_query($sql_user_create);
    
    $usr_id = mysql_insert_id();
    
    $message    = 'Hi '.$reg_firstname.'&nbsp;'.$reg_lastname.',<br><br>';
    $message   .= 'Please <a href="'.$base_url.'/supply-new.sohorepro.com/activate_msg.php?activate_comp='.$_SESSION['com_id_last'].'&activate_usr='.$usr_id.'" target="_blank">CLICK HERE</a> to activate your account<br><br><br>';
    $message   .= 'Thank you.<br>';
    $message   .= 'Soho Reprographics<br><br>';
    $message   .= '381 Broome Street<br>';
    $message   .= 'New York, NY 10013<br>';
    $message   .= '(212) 925-7575<br>';    
    
    $subject = 'Activate Your Account - SohoRepro';
    $headers = 'From: "SohoRepro" <noreply@sohorepro.com>' . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $mail_id = $reg_contactmail;
    //$mail_id = 'n.mohamedjassim@gmail.com';
    $result_mail = mail($mail_id, $subject, $message, $headers);
    //$admin_alert = AdminAlert($reg_compname,$reg_contactname);
    
     

        if ($result_mail) {
           header("Location:activate_msg.php?initiate=1");
        }

}



