<?php

include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);


if ($_POST['save_and_continue'] == '1') {

    $user_id_add_set = $_SESSION['sohorepro_userid'];
    $company_id_view_plot = $_SESSION['sohorepro_companyid'];
    
    
    $job_reference              = $_POST['job_reference'];
    $original                   = $_POST['original'];
    $print_ea                   = $_POST['print_ea'];
    $size                       = strtoupper($_POST['size']);
    $output                     = strtoupper($_POST['output']);
    $media                      = strtoupper($_POST['media']);
    $binding                    = strtoupper($_POST['binding']);
    $folding                    = strtoupper($_POST['folding']);
    $plot_arch                  = $_POST['plot_arch'];
    $special_instruction        = $_POST['special_instruction'];
    $size_custom_val            = $_POST['size_custom_val'];
    $output_both_val            = $_POST['output_both_val'];
    $my_office_alt              = $_POST['my_office_alt'];
    
    if($my_office_alt == "alternate"){
    $address_book_se_val        = $_POST['address_book_se_val'];
    }else{
    $address_book_se_val        = "0";   
    }
    
    if($_SESSION['use_the_same'] != ''){
    $uploadedfile_option        = $_SESSION['upload_file'];
    
    $pickup_date                = $_SESSION['pick_up'];
    $pickup_time                = $_SESSION['pick_up_time'];
    
    $drop_val                   = $_SESSION['drop_off'];
    
    $ftp_link_val               = $_SESSION['ftp_link'];
    $user_name_val              = $_SESSION['user_name'];
    $password_val               = $_SESSION['password']; 
    $use_same_alt               = $_SESSION['use_the_same'];
    }  else {        
    $uploadedfile_option        = ($_POST['uploadedfile_option'] != "undefined") ? $_POST['uploadedfile_option'] : '';
    
    $pickup_date                = $_POST['pickup_date'];
    $pickup_time                = $_POST['pickup_time'];
    
    $drop_val                   = ($_POST['drop_val'] == 'undefined') ? '0' : $_POST['drop_val'];
    
    $ftp_link_val               = $_POST['ftp_link_val'];
    $user_name_val              = $_POST['user_name_val'];
    $password_val               = $_POST['password_val'];    
    $use_same_alt               = '0';
    }
    
    
    
    
    $size_custom                = $_POST['size_custom'];
    
    
    
    $sql_option_id = mysql_query("SELECT options FROM sohorepro_plotting_set WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0' ORDER BY options DESC LIMIT 1");
    $object_option = mysql_fetch_assoc($sql_option_id);

        if (count($object_option['options']) > 0) {
            $options = ($object_option['options'] + 1);
        } 
        else{
            $options = '1';
        }
    

    $query = "INSERT INTO sohorepro_plotting_set
			SET     referece_id     = '" . $job_reference . "',
                                origininals     = '" . $original . "',
                                options         = '" . $options ."',  
                                print_ea        = '" . $print_ea . "',
                                size            = '" . $size . "',
                                custome_details = '" . $size_custom . "',    
                                output          = '" . $output . "',
                                media           = '" . $media . "',
                                binding         = '" . $binding . "',
                                folding         = '" . $folding . "',
                                plot_arch       = '" . $plot_arch . "',
                                spl_instruction = '" . $special_instruction . "',
                                custom_size     = '" . $size_custom_val . "',
                                output_both     = '" . $output_both_val . "',
                                upload_file     = '" . $uploadedfile_option . "',
                                pick_up         = '" . $pickup_date . "', 
                                pick_up_time    = '" . $pickup_time . "',
                                drop_off        = '" . $drop_val . "',
                                ftp_link        = '" . $ftp_link_val . "', 
                                user_name       = '" . $user_name_val . "',
                                password        = '" . $password_val . "',
                                company_id      = '" . $company_id_view_plot . "',
                                user_id         = '" . $user_id_add_set . "',
                                my_office_alt   = '" . $my_office_alt. "',
                                address_book_id = '" . $address_book_se_val. "',
                                use_same_alt    = '" . $use_same_alt ."'     ";
    $sql_result = mysql_query($query);
    if($sql_result){
                                $_SESSION['upload_file']    =   '';
                                $_SESSION['pick_up']        =   '';
                                $_SESSION['pick_up_time']   =   '';
                                $_SESSION['drop_off']       =   '';
                                $_SESSION['ftp_link']       =   '';
                                $_SESSION['user_name']      =   '';
                                $_SESSION['password']       =   '';
                                $_SESSION['use_the_same']   =   '';
    }
    

    $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
    $enteredLFPPrimay = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);
    $enteredFineSets = EnteredPlotttingFineArts($company_id_view_plot, $user_id_add_set);

    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
    $added_cart_count_session     =     "3";      
    }elseif ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $added_cart_session = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_session = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_session = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $added_cart_session = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $added_cart_session = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $added_cart_session = "1";
    } 

    
    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count']     =     "3";      
    }else if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $_SESSION['cart_count'] = "1";
    }  
    
     $_SESSION['ref_val'] = $_POST['job_reference'];
    
    echo $added_cart_session;
    
}

if ($_POST['save_and_continue_lfp'] == '1') {
    
    $user_id_add_set = $_SESSION['sohorepro_userid'];
    $company_id_view_plot = $_SESSION['sohorepro_companyid'];

    $job_reference = strtoupper($_POST['reference']);
    $original = $_POST['original'];
    $print_ea = $_POST['print_ea'];
    $size = strtoupper($_POST['size']);
    $size_custom = strtoupper($_POST['size_custom']);
    $output = strtoupper($_POST['output']);
    $output_both = strtoupper($_POST['output_both']);
    $media = strtoupper($_POST['media']);
    $binding = strtoupper($_POST['binding']);
    $special_instruction = $_POST['special_instruction'];
    
    if($_SESSION['use_the_same'] != ''){
    $drop_file          =   $_SESSION['upload_file'];    
    $ftp_link           =   $_SESSION['ftp_link'];
    $ftp_user           =   $_SESSION['user_name'];
    $ftp_pass           =   $_SESSION['password'];
    $schedule_pickup    =   $_SESSION['schedule_pickup'];
    $schedule_place     =   $_SESSION['schedule_place'];
    $dropoff            =   $_SESSION['drop_off_381'];
    }  else {
    $drop_file          = $_POST['drop_file'];    
    $ftp_link           = $_POST['ftp_link'];
    $ftp_user           = $_POST['ftp_user'];
    $ftp_pass           = $_POST['ftp_pass'];
    $schedule_pickup    = $_POST['schedule_pickup_dt'];
    $schedule_place     = $_POST['schedule_place'];
    $dropoff            = $_POST['dropoff'];
    $use_same_alt       = '0';  
    }
    
    

    $add_ml_val = $_POST['add_ml_val'];
    $original_lam = $_POST['original_lam'];
    $mount_lam = $_POST['mount_lam'];
    $mounting_select = $_POST['mounting_select'];
    $lamination_select = $_POST['lamination_select'];
    $width_values = $_POST['width_values'];
    $length_values = $_POST['length_values'];
    $grommets = $_POST['grommets'];
    $ml_splins = $_POST['ml_splins'];

    $sql_option_id = mysql_query("SELECT option_id FROM sohorepro_service_lfp WHERE company_id = '" . $company_id_view_plot . "' AND user_id = '" . $user_id_add_set . "' AND order_id = '0' ORDER BY option_id DESC LIMIT 1");
    $object_option = mysql_fetch_assoc($sql_option_id);

    if (count($object_option['option_id']) > 0) {
        $option_id = ($object_option['option_id'] + 1);
    } else {
        $option_id = '1';
    }

    $query = "INSERT INTO sohorepro_service_lfp
			SET     company_id               = '" . $company_id_view_plot . "',
                                user_id                  = '" . $user_id_add_set . "',
                                option_id                = '" . $option_id . "',
                                original                 = '" . $original . "',
                                print_of_each            = '" . $print_ea . "', 
                                size                     = '" . $size . "', 
                                size_custom              = '" . $size_custom . "', 
                                output                   = '" . $output . "', 
                                output_both_page         = '" . $output_both . "', 
                                media                    = '" . $media . "', 
                                binding                  = '" . $binding . "', 
                                upload_file              = '" . $drop_file . "',
                                ftp_link                 = '" . $ftp_link . "',
                                ftp_user_name            = '" . $ftp_user . "',    
                                ftp_password             = '" . $ftp_pass . "',
                                schedule_pickup          = '" . $schedule_pickup . "',
                                schedule_place           = '" . $schedule_place . "',
                                drop_off_381             = '" . $dropoff . "',
                                use_same_alt             = '" . $use_same_alt . "',
                                special_inc              = '" . $special_instruction . "',
                                reference                = '" . $job_reference . "',
                                ml_active                = '" . $add_ml_val . "',
                                ml_originals             = '" . $original_lam . "',    
                                ml_type                  = '" . $mount_lam . "',
                                ml_mounting              = '" . $mounting_select . "',
                                ml_laminating            = '" . $lamination_select . "',    
                                ml_width                 = '" . $width_values . "',
                                ml_length                = '" . $length_values . "',
                                ml_grommets              = '" . $grommets . "',    
                                mal_splns                = '" . $ml_splins . "' ";
    $sql_result = mysql_query($query);
    
    if($sql_result){
                                $_SESSION['upload_file']        =   '';
                                $_SESSION['ftp_link']           =   '';
                                $_SESSION['user_name']          =   '';
                                $_SESSION['password']           =   '';

                                $_SESSION['schedule_pickup']    =   '';
                                $_SESSION['schedule_place']     =   '';
                                $_SESSION['drop_off_381']       =   '';

                                $_SESSION['use_the_same']       =   '';
    }
    
    
    $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
    $enteredLFPPrimay = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);
    $enteredFineSets = EnteredPlotttingFineArts($company_id_view_plot, $user_id_add_set);
    
     
//    if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
//        $added_cart_session = "2";
//    }elseif (count($enteredLFPPrimay) >= "1") {
//        $added_cart_session = "1";
//    }elseif (count($enteredPlotPrimay) >= "1") {
//        $added_cart_session = "1";
//    } 
//
//    
//    if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
//        $_SESSION['cart_count'] = "2";
//    }elseif (count($enteredLFPPrimay) >= "1") {
//        $_SESSION['cart_count'] = "1";
//    }elseif (count($enteredPlotPrimay) >= "1") {
//        $_SESSION['cart_count'] = "1";
//    } 
    
    
    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_session     =     "3";      
    }elseif ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $added_cart_session = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_session = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_session = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $added_cart_session = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $added_cart_session = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $added_cart_session = "1";
    } 

    
    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count']     =     "3";      
    }else if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $_SESSION['cart_count'] = "1";
    }  
    
    
    $_SESSION['ref_val'] = $_POST['reference'];
    
    echo $added_cart_session;
}

if ($_POST['add_fine_arts_services'] == '99') {
    
     $user_id_add_set = $_SESSION['sohorepro_userid'];
    $company_id_view_plot = $_SESSION['sohorepro_companyid'];
    $job_reference = $_POST['job_reference'];
     $option = $_POST['option'];
    $original = $_POST['original'];
    $print_ea = $_POST['print_ea'];
    $size = $_POST['size'];
    $output = $_POST['output'];
    $order_0_set1_0_media = $_POST['order_0_set1_0_media'];


    $size_custom = ($_POST['size_custom'] != '') ? $_POST['size_custom'] : '0';
    $output_both = ($_POST['output_both'] != '') ? $_POST['output_both'] : '0';

    $dropoff_val = $_POST['dropoff_val'];
    $ftp_link_val = $_POST['ftp_link_val'];
    $user_name_val = $_POST['user_name_val'];
    $pass_word_val = $_POST['pass_word_val'];

    $time_for_alt = ($_POST['time_for_alt'] != '') ? $_POST['time_for_alt'] : '0';
    $date_for_alt = ($_POST['date_for_alt'] != '') ? $_POST['date_for_alt'] : '0';

    $special_instruction = $_POST['special_instruction'];

    $query = "INSERT INTO sohorepro_fine_arts_sets
			SET     original        = '" . $original . "',
                                poe             = '" . $print_ea . "',
                                size            = '" . $size . "',  
                                output          = '" . $output . "',
                                option_id       = '" . $option . "',   
                                media           = '" . $order_0_set1_0_media . "',
                                size_custom     = '" . $size_custom . "',    
                                output_both     = '" . $output_both . "',
                                reference     = '" . $job_reference . "',   
                                dropoff_val     = '" . $dropoff_val . "',
                                ftp_link_val    = '" . $ftp_link_val . "',
                                user_name_val   = '" . $user_name_val . "',
                                pass_word_val   = '" . $pass_word_val . "',
                                pick_up         = '" . $date_for_alt . "', 
                                pick_up_time    = '" . $time_for_alt . "',
                                special_instruction =   '" . $special_instruction . "',
                                company_id      = '" . $company_id_view_plot . "',
                                user_id         = '" . $user_id_add_set . "' ";

    $sql_result = mysql_query($query);

    $enteredFineSets = EnteredPlotttingFineArts($company_id_view_plot, $user_id_add_set);
    $enteredLFPPrimay = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);
    $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
    
    $count_option = count($enteredFineSets) + 1;
    
    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_count_session     =     "3";      
    }elseif ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $added_cart_count_session = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_count_session = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_count_session = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $added_cart_count_session = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $added_cart_count_session = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $added_cart_count_session = "1";
    } 

    
    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count']     =     "3";      
    }else if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $_SESSION['cart_count'] = "1";
    } 
    
    $_SESSION['ref_val'] = $_POST['job_reference'];
    echo $added_cart_count_session;
}