<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);


if ($_POST['use_thesame_file'] == '1') {
    
    $comp_id        =   $_SESSION['sohorepro_companyid'];
    $user_id        =   $_SESSION['sohorepro_userid'];
    
    
//upload_file
//ftp_link
//ftp_user_name
//ftp_password
//schedule_pickup
//schedule_place
//drop_off_381
//use_same_alt
    
    
    $last_date      =   LastFileOptionEnteredLFP($comp_id, $user_id);
    $use_the_same   =   LastFileOptionEnteredSame($comp_id, $user_id);
    if(count($last_date) != 0){    
    $_SESSION['upload_file']        =   $last_date[0]['upload_file'];
    $_SESSION['ftp_link']           =   $last_date[0]['ftp_link'];
    $_SESSION['user_name']          =   $last_date[0]['ftp_user_name'];
    $_SESSION['password']           =   $last_date[0]['ftp_password']; 
    
    $_SESSION['schedule_pickup']    =   $last_date[0]['schedule_pickup'];
    $_SESSION['schedule_place']     =   $last_date[0]['schedule_place'];
    $_SESSION['drop_off_381']       =   $last_date[0]['drop_off_381'];
    
    $_SESSION['use_the_same']       =   $last_date[0]['option_id'];
    echo '1';
    }
    
    
}elseif ($_POST['use_thesame_file'] == '2') {
    
    $_SESSION['upload_file']        =   '';
    $_SESSION['ftp_link']           =   '';
    $_SESSION['user_name']          =   '';
    $_SESSION['password']           =   '';
    
    $_SESSION['schedule_pickup']    =   '';
    $_SESSION['schedule_place']     =   '';
    $_SESSION['drop_off_381']       =   '';
    
    $_SESSION['use_the_same']       =   '';
    echo '1';
    
}

