<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);

if ($_POST['delete_offset_file'] == '1') {
    
    $user_id    =   $_POST['user_id'];
    $comp_id    =   $_POST['comp_id'];
    
    $delete_sql     =   "DELETE FROM sohorepro_upload_files_set_off_set WHERE comp_id = '" . $comp_id . "' AND user_id = '".$user_id."' AND order_id = '0' ";
    $delete_done    =   mysql_query($delete_sql);
    
    if($delete_done){
        echo '1';
    }
}

if ($_POST['delete_offset_file'] == '2') {
     echo '1';
}

if ($_POST['off_set_form_submit'] == '1') {
       
    
    $ask_your_question  = mysql_real_escape_string($_POST['ask_your_question']);
    $ftp_link           =   $_POST['ftp_link'];
    $ftp_user_name      =   $_POST['user_name'];
    $ftp_pass_word      =   $_POST['pass_word'];
    $user_mail          =   $_POST['email'];
    
    $user_id_add_set        = $_SESSION['sohorepro_userid'];
    $company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
    
    $sql_order_sequence = mysql_query("SELECT * FROM sohorepro_offset_order ORDER BY id DESC LIMIT 1");
    $object_order_sequence = mysql_fetch_assoc($sql_order_sequence);
    $sequence_id = $object_order_sequence['id'];

    $new_sequence = (count($sequence_id) > 0) ? $sequence_id+1 : '1';
    
    $query_update_files = "UPDATE sohorepro_upload_files_set_off_set
			SET     order_id         = '" . $new_sequence . "' WHERE order_id = '0' AND comp_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' ";
    mysql_query($query_update_files);
    
    $query = "INSERT INTO sohorepro_offset_order
			SET     com_id                  = '" . $_SESSION['sohorepro_companyid'] . "',
                                user_id                 = '" . $_SESSION['sohorepro_userid'] . "',
                                order_id                = '" . $new_sequence . "',
                                question                = '" . $ask_your_question . "',
                                ftp_link                = '" . $ftp_link."',
                                ftp_user_name           = '" . $ftp_user_name."',
                                ftp_pass_word           = '" . $ftp_pass_word."',
                                entered_date            = now()";
    $sql_result = mysql_query($query);

    $order_id_offset = mysql_insert_id();  
    
    
    $customer_details       = customerName($user_id_add_set);
    $Date                   = date('m-d-Y h:i A', time());
    $comp_name              = getCompName($company_id_view_plot);

    $offset_data            = OffsetData($order_id_offset);
    
    $offset_msg  = '<div style="float:left;width: 40%;border: 1px solid #CCCCCC;">';
    $offset_msg  .= '<div style="float:left;width: 100%;background-color: #CCCCCC;text-align:center;font-weight:bold;font-size:16px;line-height:40px;">OFFSET PRINTING REQUEST</div>';
    $offset_msg  .= '<div style="width:100%;float: left;margin-top: 10px;">';
    $offset_msg  .= '<ul style="width:100%;list-style: none;float: left;">';
    $offset_msg  .= '<li style="width:100%;float:left;"><label style="float:left;width:20%;margin-bottom:5px;font-weight:bold;">Date :</label>'. $Date .'</li>';
    $offset_msg  .= '<li style="width:100%;float:left;"><label style="float:left;width:20%;margin-bottom:5px;font-weight:bold;">Name :</label>'.$customer_details[0]['cus_fname'].'&nbsp;'.$customer_details[0]['cus_lname'].'</li>';
    $offset_msg  .= '<li style="width:100%;float:left;"><label style="float:left;width:20%;margin-bottom:5px;font-weight:bold;">Company :</label>'.$comp_name.'</li>';
    $offset_msg  .= '<li style="width:100%;float:left;"><label style="float:left;width:20%;margin-bottom:5px;font-weight:bold;">Email :</label>'.$customer_details[0]['cus_contact_email'].'</li>';
    $offset_msg  .= '<li style="width:100%;float:left;"><label style="float:left;width:20%;margin-bottom:5px;font-weight:bold;">Phone :</label>'.$customer_details[0]['cus_contact_phone'].'</li>';
    $offset_msg  .= '</ul></div>';


    $offset_msg  .= '<div style="float: left;width: 90%;border: 1px solid #CCCCCC;margin-left: 25px;margin-bottom: 10px;border-radius: 3px;line-height: 25px;">';
    $offset_msg  .= '<div style="width: 100%;float: left;background-color: #CCCCCC;font-weight: bold;text-transform: uppercase;text-align: center;">file options</div>';
   
    if($offset_data[0]['ftp_link'] != '0'){    
        
        $ftp_user_name      =   ($offset_data[0]['ftp_user_name'] != '0') ? $offset_data[0]['ftp_user_name'] : '';
        $ftp_password       =   ($offset_data[0]['ftp_pass_word'] != '0') ? $offset_data[0]['ftp_pass_word'] : '';
        
    $offset_msg  .= '<div style="width: 90%;float: left;margin-left: 10px;margin-top: 10px;">';
    $offset_msg  .= '<ul style="width: 100%;list-style: none;float: left;padding: 0;"><li>';  
    $offset_msg  .= '<div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">';
    $offset_msg  .= '<label style="width: 40%;float: left;margin-left: 5px;">FTP Link:</label><span style="width: 55%;float: left;">'.$offset_data[0]['ftp_link'].'</span>';
    $offset_msg  .= '</div>';
    $offset_msg  .= '</li>';
    $offset_msg  .= '<li>';
    $offset_msg  .= '<div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">';
    $offset_msg  .= '<label style="width: 40%;float: left;margin-left: 5px;">User Name:</label><span style="width: 55%;float: left;">'.$ftp_user_name.'</span>';
    $offset_msg  .= '</div>';
    $offset_msg  .= '</li>';
    $offset_msg  .= '<li>';
    $offset_msg  .= '<div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">';
    $offset_msg  .= '<label style="width: 40%;float: left;margin-left: 5px;">Password:</label><span style="width: 55%;float: left;">'.$ftp_password.'</span>';
    $offset_msg  .= '</div>';
    $offset_msg  .= '</li>';
    $offset_msg  .= '</ul>';             
    $offset_msg  .= '</div>';                
    }else{
    $offset_msg  .= '<div style="width: 90%;float: left;margin-left: 10px;margin-top: 10px;">';
    $offset_msg  .= '<ul style="width: 100%;list-style: none;float: left;padding: 0;">';
    $off_set_files      =   OffsetFiles($order_id_offset);
    foreach ($off_set_files as $files){
    $offset_msg  .= '<li>';
    $offset_msg  .= '<div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">';
    $offset_msg  .= '<label style="width: 80%;float: left;margin-left: 5px;">'.$files['file_name'].'</label><span style="width: 18%;float: left;"><a href="http://cipldev.com/supply-new.sohorepro.com/upload_offset/' . $files['file_name'] . '" target="_blank">Download</a></span>';
    $offset_msg  .= '</div></li>';
    }                  
    $offset_msg  .= '</ul></div>';
    }
    
    $offset_msg  .= '<div style="width: 90%;float: left;margin-left: 25px;">';
    $offset_msg  .= '<span style="float: left;width: 100%;font-weight: bold;">My Question:</span>';
    $offset_msg  .= '<span style="float: left;width: 100%;text-align: justify;">'.$offset_data[0]['question'].'</span>';
    $offset_msg  .= '</div>';
    $offset_msg  .= '</div>';
    $offset_msg  .= '</div>';
    
    
    
    $mail_id = getActiveOffset();
    foreach ($mail_id as $to) {
        $result[] = $to['email_id'] . ',';
    }
    array_push($result,$customer_details[0]['cus_contact_email'].',');
    $to_address = implode("", $result);
//    foreach ($mail_id as $to) {
    $subject = "OFFSET PRINTING REQUEST";
    $headers = 'From: ' . $user_mail . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-Type: text/html; charset=utf-8\r\n' . "X-Mailer: PHP";
    $headers .= 'Content-Transfer-Encoding: 8bit\r\n\r\n';
    $result = mail($to_address, stripslashes($subject), stripslashes($offset_msg), $headers);
//    }

    if ($result) {
        echo '1';
    } else {
        echo '0';
    }
    
    
}
