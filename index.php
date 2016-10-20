<?php


include './admin/config.php';
include './admin/db_connection.php';
include './admin/include/class.phpmailer.php';
error_reporting(0);

$Super = getSuperCategory();

if (isset($_REQUEST['forgot_submit'])) {
    //print_r($_REQUEST);
    $emailid = mysql_real_escape_string($_POST['email_id']);

    $check_user_count = mysql_query("select * from sohorepro_customers where cus_email='" . $emailid . "' ");

    if (mysql_num_rows($check_user_count) > 0) {
        $check_fth_user = mysql_fetch_array($check_user_count);
        $message = '<link href="mail_css.css" media="screen" rel="stylesheet" type="text/css" />';
        $message .= '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
        $message .= '<table width="550" border="0" cellspacing="0" cellpadding="0">';
        $message .= '<tr bgcolor="#ff7e00">';
        $message .= '<td width="10" height="10" align="left" valign="top"></td>';
        $message .= '<td height="10" align="left" valign="top"></td>';
        $message .= '<td width="10" height="10" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="10" align="left" valign="top" bgcolor="#ff7e00"></td>';
        $message .= '<td align="left" valign="top"><table width="530" border="0" cellspacing="0" cellpadding="0">';
        $message .= '<tr>';
        $message .= '<td width="20" height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td width="20" height="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '<td align="left" valign="top"><table width="490" border="0" cellspacing="0" cellpadding="0">';
        $message .= '<tr>';
        $message .= '<td width="140" align="left" valign="top"><img src="' . $base_url . '/store_files/soho_logo.jpg" width="126" height="115" alt=""/></td>';
        $message .= '<td align="left" valign="top"><table width="200" border="0" cellspacing="0" cellpadding="0">';
        $message .= '<tr>';

        $message .= '</table></td>';
        $message .= '</tr>';
        $message .= '</table></td>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '<td align="left" valign="top">';
        $message .= '<table width="490" border="0" cellspacing="0" cellpadding="0" style="margin-right:-1px;">';

        $message .="<tr>
 <td height='25' align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#ff7e00; font-weight:bold;'>Dear " . ucfirst($check_fth_user['cus_fname'] . " " . $check_fth_user['cus_lname']) . ",</td>
 </tr>";
        $message .="<tr>
 <td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444'> Please note down the login details for your account. <span style='color:#0b7abf; text-decoration:underline;'></span></td>
 </tr>";

        $message .="<tr>
 <td height='25' align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#5f5f5f; font-weight:bold; padding-top:20px;'>Email id : " . ($check_fth_user['cus_email']) . "</td>
 </tr>";

        $message .="<tr>
 <td height='25' align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#5f5f5f; font-weight:bold; padding-top:20px; padding-bottom:10px;'>Password : " . $check_fth_user['cus_pass'] . "</td>
 </tr>";

        $message .="<tr>
 <td height='30' align='left' valign='middle' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444'><a href='" . $base_url . "/index.php' style='color:#0b7abf; text-decoration:underline;' target='_blank'>Click here </a>to login into our SohoRepro System.</td>
 </tr>";

        $message .="<tr><td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444; padding-top:10px;'>Thanks,</td></tr><tr><td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#444444'>The SohoRepro Team</td></tr>";

        $message .= '</table></td>';
        $message .= '<td width="20" align="left" valign="top"></td>';
        $message .= '</tr>';
        $message .= '<tr>';
        $message .= '<td height="20" align="left" valign="top"></td>';
        $message .= '<td height="20" align="left" valign="top"></td>';
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

        //echo $message;
        // exit;
// $to = $check_fth_user['cus_email'];
// $subject = 'SohoRepro - Login credentials';
// $headers = 'From: "SohoRepro" <no-reply@sohorepro.com>' . "\r\n";
// // Always set content-type when sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// 
// $forgot_result = mail($to, $subject, $message, $headers);
        $to = $check_fth_user['cus_email'];
        $mail = new PHPMailer();
        $mail->SetFrom('noreply@new-sohorepro.com', "SohoRepro");
        $mail->AddAddress($to, $to);
        $mail->Subject = 'SohoRepro - Login credentials';
        $mail->IsHTML(true);
        $mail->Body = $message;
        $forgot_result = $mail->Send();


        if ($forgot_result) {
            header("Location:index.php?for_succ=1");
        }
    } else {
        header("Location:index.php?for_err=1");
        exit;
    }
}

if($_SESSION['sohorepro_companyid'] != ''){  

    header("Location:service_plotting.php");
}


if (isset($_REQUEST['login_submit'])) {
    unset($_SESSION['sohorepro_userid']);
    unset($_SESSION['sohorepro_companyid']);
    unset($_SESSION['sohorepro_username']);
    $emailid = mysql_real_escape_string($_POST['email_id']);
    $pass = mysql_real_escape_string($_POST['password']);

    $user_login = UserLogin($emailid, $pass);
    $chk_cus_status = CheckCusStatus($user_login[0]['cus_compname']);

//    
//   
//    
//    foreach ($user_login as $login_pre){
//        $check_status[] =  StatusCheckComp($login_pre['cus_compname']);
//    }
//    
//    
//    $cus_details = CustomerDetails($check_status[0]);

    if ((count($user_login) > 0)) {
        $_SESSION['sohorepro_userid'] = $user_login[0]['cus_id'];
        $_SESSION['sohorepro_companyid'] = $user_login[0]['cus_compname'];
        $_SESSION['sohorepro_username'] = $user_login[0]['cus_contact_name'];
        
//        echo '<pre>';    
//        print_r($_SESSION);
//        echo '</pre>';
//        exit;
        
        
        header("Location:service_plotting.php");
    } else {
        header("Location:index.php?err=incorrect");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:44:50 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
            <title> SohoRepro </title>

            <!-- base href="http://soho.thinkdesign.com/" -->

            <link rel="stylesheet" href="store_files/style.css" type="text/css" media="screen"> 
                <link rel="stylesheet" href="style/pulse.css" type="text/css" media="screen"> 
                    <link rel="stylesheet" href="store_files/theme.css" type="text/css" media="screen"> 
                        <link rel="stylesheet" href="store_files/jquery.css" type="text/css" media="screen"> 
                            <link rel="stylesheet" href="store_files/tiptip.css" type="text/css" media="screen"> 
                                <link rel="stylesheet" href="store_files/ajaxLoader.css" type="text/css" media="screen"> 
                                    <link rel="stylesheet" href="store_files/flexigrid.css" type="text/css" media="screen"> 
                                        <link rel="stylesheet" href="store_files/ui.css" type="text/css" media="screen"> 
                                            <link rel="stylesheet" href="store_files/slick.css" type="text/css" media="screen"> 
                                                <link rel="stylesheet" href="store_files/kendo.css" type="text/css" media="screen"> 
                                                    <link rel="stylesheet" href="store_files/kendo_002.css" type="text/css" media="screen"> 
                                                        <link rel="stylesheet" href="store_files/style_002.css" type="text/css" media="screen"> 
                                                            <script language="javascript" src="store_files/jquery_003.js"></script> 
                                                            <script language="javascript" src="store_files/ui_002.js"></script> 
                                                            <script language="javascript" src="store_files/jgrowl.js"></script> 
                                                            <script language="javascript" src="store_files/jquery_005.js"></script> 
                                                            <script language="javascript" src="store_files/ajaxLoader.js"></script> 
                                                            <script language="javascript" src="store_files/flexigrid.js"></script> 
                                                            <script language="javascript" src="store_files/maskedinput.js"></script> 
                                                            <script language="javascript" src="store_files/gps.js"></script> 
                                                            <script language="javascript" src="store_files/jquery_004.js"></script> 
                                                            <script language="javascript" src="store_files/ui.js"></script> 
                                                            <script language="javascript" src="store_files/slick_010.js"></script> 
                                                            <script language="javascript" src="store_files/slick_008.js"></script> 
                                                            <script language="javascript" src="store_files/slick_003.js"></script> 
                                                            <script language="javascript" src="store_files/slick.js"></script> 
                                                            <script language="javascript" src="store_files/slick_004.js"></script> 
                                                            <script language="javascript" src="store_files/slick_011.js"></script> 
                                                            <script language="javascript" src="store_files/slick_007.js"></script> 
                                                            <script language="javascript" src="store_files/slick_006.js"></script> 
                                                            <script language="javascript" src="store_files/slick_002.js"></script> 
                                                            <script language="javascript" src="store_files/jquery.js"></script> 
                                                            <script language="javascript" src="store_files/slick_009.js"></script> 
                                                            <script language="javascript" src="store_files/slick_005.js"></script> 
                                                            <script language="javascript" src="store_files/jquery_002.js"></script> 
                                                            <script language="javascript" src="store_files/sohorepro.js"></script> 
                                                            <script language="javascript" src="store_files/kendo.js"></script> 
                                                            <script language="javascript" src="store_files/script.js"></script> 
                                                            <script language="javascript" src="store_files/storecart.js"></script> 
                                                            <script language="javascript" src="store_files/interface.js"></script> 

  <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->


                                                            <script type="text/javascript" src="store_files/scripts.js"></script>
                                                            <script src="store_files/jquery.min.js"></script>
                                                            <script type="text/javascript" src="jquery.sticky.js"></script>
                                                            <script>
                                                                $(window).load(function() {
                                                                    $("#supply_hdr").sticky({topSpacing: 0});
                                                                });
                                                            </script>
                                                            <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $(".super_cat").click(function() {
                                                                        $(this).next(".sub_cat").slideToggle("slow");
                                                                    });

                                                                });
                                                                
                                                                function mask_show()
                                                                {
                                                                    $(".mask").fadeIn();
                                                                }
                                                            </script>

                                                            <link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">
                                                                <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
                                                                    <!--[if IE 7]>
                                                                    <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
                                                                    <![endif]-->



                                                                    <!-- Validation script starts here -->

                                                                    <style type="text/css">
                                                                        label.error{
                                                                            color: red !important; 
                                                                        }
                                                                        .super_cat{
                                                                            margin: 15px;
                                                                        }

                                                                        input.error,select.error{
                                                                            border: 1px solid red !important;
                                                                        }
                                                                        .cat_products span:hover {font-size: 16px; cursor: pointer;}
                                                                        #search span:hover {font-size: 16px; cursor: pointer;}
                                                                        .fixed_1{border-style:solid;border-width:0px; position: fixed; width: 740px; top: 0; z-index: 1; background: #fff;}
                                                                        #to_tal{ display:block !important;}
                                                                        .pointer{cursor: pointer;}
                                                                        .ref_div{
                                                                            float:right;margin-top:-63px;position: relative;
                                                                        }
                                                                        .ref_span{
                                                                            font-size:22px; font-weight:bold;
                                                                        }

                                                                        .ref_div_star{
                                                                            color:red; margin-top: -5px;font-size: 16px;font-weight: bold;
                                                                        }
                                                                        .favorites{float: left;font-size: 16px;font-weight: bold;cursor:pointer;}
                                                                    </style>
                                                                    <script src="js/jquery.js" type="text/javascript" ></script>
                                                                    <script src="js/jquery.validate.js" type="text/javascript" ></script>
                                                                    <script src="js/jquery.maskedinput.js" type="text/javascript" ></script>

                                                                    <!--scroll set to top--->
                                                                    <!--<script type="text/javascript"> 
                                                                    //STICKY NAV
                                                                    $(document).ready(function () {  
                                                                      var top = $('#supply_hdr').offset().top - parseFloat($('#supply_hdr').css('marginTop').replace(/auto/, 100));
                                                                      $(window).scroll(function (event) {
                                                                        // what the y position of the scroll is
                                                                        var y = $(this).scrollTop();
                                                                    
                                                                        // whether that's below the form
                                                                        if (y >= top) {
                                                                          // if so, ad the fixed class
                                                                          $('#supply_hdr').addClass('fixed_1');
                                                                        } else {
                                                                          // otherwise remove it
                                                                          $('#supply_hdr').removeClass('fixed_1');
                                                                        }
                                                                      });
                                                                    });
                                                                    </script>-->

                                                                    <script src="waypoints.js"></script>
                                                                    <script src="waypoints-sticky.js"></script>
                                                                    <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $('.sticky-navigation').waypoint('sticky');
                                                                });
                                                                    </script>
                                                                    <style>
                                                                        .sticky-navigation
                                                                        {
                                                                            padding: 10px;
                                                                            background: #FFF;   
                                                                            font-size: 18px;
                                                                            width: 720px;   
                                                                        }
                                                                        .sticky-navigation.stuck
                                                                        {
                                                                            position: fixed;
                                                                            top: 0;
                                                                            box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
                                                                            z-index: 1;
                                                                        }

                                                                        #result_ref
                                                                        {
                                                                            position: absolute;
                                                                            width: 185px;
                                                                            padding: 10px;
                                                                            display: none;
                                                                            margin-top: 2px;
                                                                            border-top: 0px;
                                                                            overflow: hidden;
                                                                            background-color: #F3f3f3;
                                                                            box-shadow: 0px 0px 5px #ccc;
                                                                            position: absolute;
                                                                            right: 2px;
                                                                        }

                                                                        .auto_reference{
                                                                            cursor: pointer;
                                                                            list-style-type: none;
                                                                        }

                                                                        .auto_reference li:hover
                                                                        {
                                                                            background:#FF7E00;
                                                                            color:#FFF;
                                                                            cursor:pointer;
                                                                        }
                                                                        .auto_reference li
                                                                        {
                                                                            border-bottom: 1px #999 dashed;
                                                                        }
                                                                        .auto_reference span{
                                                                            font-size: 18px;
                                                                        }

                                                                        .tot_cart{
                                                                            text-align: right;color:#5C5C5C;font-size:18px;font-weight:bold;
                                                                        }
                                                                        .tot_cart_spm{
                                                                            text-align: right;color:#5C5C5C;font-size:18px;font-weight:bold;
                                                                        }
                                                                        .curr_tot_div{
                                                                            color:#5C5C5C;font-weight:bold;font-size:18px;padding-right:0px;padding-bottom: 0px;;
                                                                        }
                                                                        .curr_tot_div1
                                                                        {
                                                                            color:#5C5C5C;font-weight:bold;font-size:18px;margin-top:10px;padding-right:0px;
                                                                        }
                                                                        .curr_ord_tot{
                                                                            font-size: 18px;font-weight:bold;
                                                                        }
                                                                        .mask{
                                                                            position: absolute;
                                                                            width: 50%;
                                                                            float: left;
                                                                            background: rgba(157, 157, 157, .8);
                                                                            height: 610px;                                                                            
                                                                            margin-top: 60px;
                                                                            z-index: 1;
                                                                            display: none;
                                                                        }
                                                                        .inside_mask{
                                                                            float: left;
                                                                            width: 65%;
                                                                            height: 325px;                                                                            
                                                                            position: relative;
                                                                            top: 20%;
                                                                            left: 16%;
                                                                            background-color: #FFF;
                                                                            border-radius: 5px;
                                                                        }
                                                                        .mask_content{
                                                                            margin: auto;
                                                                            width: 90%;
                                                                            border-bottom: 10px solid #000;
                                                                            border-top: 10px solid #000;
                                                                            height: 250px;
                                                                            margin-top: 30px;
                                                                        }
                                                                        .mask_text{
                                                                            margin: auto;
                                                                            width: 90%;
                                                                            margin-top: 30px;
                                                                            font-weight: bold;
                                                                            text-align: justify;
                                                                            font-size: 30px;
                                                                        }
                                                                    </style>
                                                                    <script type="text/javascript">

                                                                        $(document).ready(function() {



                                                                            var validation_obj = {
                                                                                rules: {email_id: {
                                                                                        required: true,
                                                                                        email: true
                                                                                    }},
                                                                                messages: {
                                                                                    email_id: {
                                                                                        required: '',
                                                                                        email: true
                                                                                    },
                                                                                    password: {
                                                                                        required: ''

                                                                                    }

                                                                                }
                                                                            };


                                                                            $("#login_form").validate(validation_obj);



                                                                            var validation_reg = {
                                                                                rules: {reg_email_id: {
                                                                                        required: true,
                                                                                        email: true
                                                                                    },
                                                                                    reg_password: {
                                                                                        required: true,
                                                                                        rangelength: [6, 8]
                                                                                    }},
                                                                                messages: {
                                                                                    reg_name: {
                                                                                        required: ''

                                                                                    },
                                                                                    reg_email_id: {
                                                                                        required: '',
                                                                                        email: true
                                                                                    },
                                                                                    reg_password: {
                                                                                        required: ''

                                                                                    },
                                                                                    reg_cpassword: {
                                                                                        required: ''

                                                                                    }

                                                                                }
                                                                            };


                                                                            $("#reg_form").validate(validation_reg);


                                                                            var validation_forgot = {
                                                                                rules: {email_id: {
                                                                                        required: true,
                                                                                        email: true
                                                                                    }},
                                                                                messages: {
                                                                                    email_id: {
                                                                                        required: '',
                                                                                        email: true
                                                                                    }

                                                                                }
                                                                            };


                                                                            $("#forgot_form").validate(validation_forgot);



                                                                        });


                                                                        function show_reg(str)
                                                                        {
                                                                            if (str == 0)
                                                                            {
                                                                                $("#reg_form").show();
                                                                                $("#login_form").hide();
                                                                            }
                                                                            else
                                                                            {
                                                                                $("#reg_form").hide();
                                                                                $("#login_form").show();
                                                                            }
                                                                        }


                                                                        function show_forgot(str)
                                                                        {
                                                                            if (str == 0)
                                                                            {
                                                                                $("#forgot_form").show();
                                                                                $("#login_form").hide();
                                                                            }
                                                                            else
                                                                            {
                                                                                $("#forgot_form").hide();
                                                                                $("#login_form").show();
                                                                            }
                                                                        }


                                                                        function change_txt(tid, val)
                                                                        {
                                                                            var txt_val = $(tid).val();
                                                                            //alert(txt_val);
                                                                            if (txt_val == val)
                                                                            {
                                                                                $(tid).val('');
                                                                            }
                                                                        }

                                                                        function change_dtxt(tid, val)
                                                                        {
                                                                            var txt_val = $(tid).val();
                                                                            //alert(txt_val);

                                                                            if (txt_val == '')
                                                                            {
                                                                                $(tid).val('');
                                                                            }
                                                                        }

                                                                    </script>
                                                                    <!-- Validation script ends here --> 


                                                                    </head>
                                                                    <body onload="return clear_cach_index();" >
                                                                        <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                                                                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                                                                        <div id="body_container">

                                                                            <div id="body_content" class="body_wrapper">
                                                                                <div id="body_content-inner" class="body_wrapper-inner">
                                                                                    <div class="responsive_container"> 
                                                                                        <?php include "includes/header_sidebar_mask.php"; ?>

                                                                                        <div id="content_output">

                                                                                            <?php include "includes/top_nav_mask.php"; ?>
                                                                                            <div class="mask">
                                                                                            
                                                                                                <div class="inside_mask">
                                                                                                    <div class="mask_content">
                                                                                                        <div class="mask_text">
                                                                                                            <div style="float: left;width: 100%;font-size: 25px;font-weight: bold;line-height: 35px;margin-bottom: 20px;">
                                                                                                                Please login on the left or use the links to access an Existing Account or Request a New Account 
                                                                                                            </div>
                                                                                                        <!--<img src="images/landing.png" style="border: 0px;width: 100%;" />-->
                                                                                                        </div>
                                                                                                        <div style="text-align: center;font-weight: bold;font-size: 25px;margin-top: 10px;">
                                                                                                            To continue as a Guest, <a href="https://www.hightail.com/u/sohoreproplot" target="_blank" style="text-align: center;font-weight: bold;font-size: 25px;">click here</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            
                                                                                            </div>
                                                                                            <?php include "./service_nav_mask.php"; ?>
                                                                                            <div id="content_output-data" onclick="return mask_show();">  
                                                                                                <!--- TABLE START -->
                                                                                                
                                                                                                <div id="orderWapper">
                                                                                                    <!-- 
                                                                                                  <div class="orderBreadCrumb">
                                                                                                  </div>
                                                                                                    -->

                                                                                                    <h2 class="headline-interior orange" style="text-transform: uppercase;">
                                                                                                        PLOTTING & ARCHITECTURAL COPIES 


                                                                                                    </h2>
                                                                                                    <div class="bkgd-stripes-orange">
                                                                                                        &nbsp;
                                                                                                    </div>   
                                                                                                    <div id="succ_msg" style="color:#007F2A; text-align:center; padding-bottom:10px;display: none;">Set Added Successfully</div>

                                                                                                    <div id="go_set" style="width: 100%;float: left;display: none;">
                                                                                                        <span style="float: right;color: #ff7e00;cursor: pointer;text-decoration: none;" onclick="return go_set_form();">GO FORM</span>
                                                                                                    </div>
                                                                                                    <div id="set_form">
                                                                                                        <div id="plotting" action="" method="post" class="systemForm orderform">
                                                                                                            <input type="hidden" name="plotting_set" value="0" />
                                                                                                            <ul>
                                                                                                                <li class="clear">
                                                                                                                    <label style="font-weight: bold;" for="jobref" class="optional">
                                                                                                                        Job Reference<span class="ref_div_star">*</span>
                                                                                                                    </label>
                                                                                                                    <div style="position: relative;">                        
                                                                                                                        <input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input dec" style="padding:3px;width: 195px;text-transform: uppercase;" name="jobref" id="jobref" type="text" value="<?php echo $_SESSION['ref_val']; ?>" />
                                                                                                                        <div id="result_ref" class="records_reference"></div>
                                                                                                                        <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                                                                                                                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                                                                                                                        <input type="hidden" name="jobref_id" id="jobref_id" value="" />
                                                                                                                        <input type="hidden" name="company_id" id="company_id" value="" />   
                                                                                                                        <input type="hidden" name="drop_off_select_val" id="drop_off_select_val" value="" />
                                                                                                                        <input type="hidden" name="continue_ok" id="continue_ok" value="0" />
                                                                                                                    </div>
                                                                                                                </li>
                                                                                                                <div  id="set">
                                                                                                                    <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                                                                                                                    <li class="clear">
                                                                                                                        <!-- FOR EACH START -->  
                                                                                                                        <?php
                                                                                                                        $user_id_add_set = $_SESSION['sohorepro_userid'];
                                                                                                                        $company_id_view_plot = $_SESSION['sohorepro_companyid'];
                                                                                                                        $check_plotting = PlottingSetWithoutOrderId($company_id_view_plot, $user_id_add_set);
                                                                                                                        $check_plotting_needed = PlottingNeededSetWithoutOrderId($company_id_view_plot, $user_id_add_set);
                                                                                                                        $check_plotting_files = UploadFileExist($company_id_view_plot, $user_id_add_set);
                                                                                                                        if (count($check_plotting) > 0) {
                                                                                                                            $delete_empty = "DELETE FROM sohorepro_plotting_set WHERE company_id = '" . $company_id_view_plot . "' AND user_id = '" . $user_id_add_set . "' AND order_id = '0'";
                                                                                                                            mysql_query($delete_empty);
                                                                                                                        }

                                                                                                                        if (count($check_plotting_needed) > 0) {
                                                                                                                            $delete_empty = "DELETE FROM sohorepro_sets_needed WHERE comp_id = '" . $company_id_view_plot . "' AND usr_id = '" . $user_id_add_set . "' AND order_id = '0'";
                                                                                                                            mysql_query($delete_empty);
                                                                                                                        }

                                                                                                                        if (count($check_plotting_files) > 0) {
                                                                                                                            $delete_sql = "DELETE FROM sohorepro_upload_files_set WHERE comp_id = '" . $company_id_view_plot . "' AND user_id = '" . $user_id_add_set . "' AND order_id = '0' ";
                                                                                                                            mysql_query($delete_sql);
                                                                                                                        }

//                    if(count($check_plotting) > 0){
//                        echo 'IS THERE';
//                    }  else {
//                        echo 'Not There';
//                    }
                                                                                                                        ?>
                                                                                                                        <div  id="sets_all">               

                                                                                                                            <div class="serviceOrderSetHolder">
                                                                                                                                <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
                                                                                                                                    Job Options 
                                                                                                                                    <div style="float:right;font-weight: bold;">
                                                                                                                                        Option - 1                           
                                                                                                                                    </div>
                                                                                                                                </label>  
                                                                                                                                <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                                                                                                                                    <div class="serviceOrderSetWapperInternal">
                                                                                                                                        <div class="serviceOrderSetDIV">
                                                                                                                                            <div style="width: 100%;float: left;padding-top: 10px;">  

                                                                                                                                                <!--Check Box Start-->
                                                                                                                                                <div style="float:left;width:100%;">
                                                                                                                                                    <ul class="arch_radio">
                                                                                                                                                        <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
                                                                                                                                                        <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" onclick="return active_arch();" /><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">ARCHITECTURAL COPIES</span></li>
                                                                                                                                                    </ul>
                                                                                                                                                    <span id="errmsg"></span>
                                                                                                                                                </div>
                                                                                                                                                <!--Check Box End-->

                                                                                                                                                <!--Originals Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Originals
                                                                                                                                                    </label>
                                                                                                                                                    <input class="order_0_set1_0_original k-input kdText " style="width:50px;" id="original" name="original" type="text" value="" />
                                                                                                                                                </div>
                                                                                                                                                <!--Originals End-->

                                                                                                                                                <!--POE Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Prints of Each<span style="color: red;">*</span>
                                                                                                                      <!--                                  <span style="font-weight:bold;color:#cc0000">
                                                                                                                                                          *
                                                                                                                                                        </span>-->
                                                                                                                                                    </label>
                                                                                                                                                    <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;" id="print_ea" name="print_ea" type="text" value="" />
                                                                                                                                                </div>
                                                                                                                                                <!--POE End-->

                                                                                                                                                <!--Size Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Size<span style="color: red;">*</span>
                                                                                                                                                    </label>
                                                                                                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                                                                                                        <div style="float:left;margin-right:0px;">
                                                                                                                                                            <select class="order_0_set1_0_size kdSelect" style="width: 135px;" id="size" name="size" onchange="return custome_size();">                            
                                                                                                                                                                <option value="FULL">FULL</option>
<!--                                                                                                                                                                <option value="HALF">HALF</option>
                                                                                                                                                                <option value="Reduce to 11 X 17">Reduce to 11 X 17</option>
                                                                                                                                                                <option value="Custom">Custom</option>                          -->
                                                                                                                                                            </select>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="dropdown_selector">
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <!--Size End-->

                                                                                                                                                <!--Output Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Output<span style="color: red;">*</span>
                                                                                                                                                    </label>
                                                                                                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                                                                                                        <div style="float:left;margin-right:0px;">
                                                                                                                                                            <select disabled class="order_0_set1_0_output kdSelect " style="width: 65px;" id="output" name="output" onchange="return custome_output();">
                                                                                                                                                                <option value="B/W">B/W</option>
<!--                                                                                                                                                                <option value="Color">Color</option>
                                                                                                                                                                <option value="Both">Both</option>-->
                                                                                                                                                            </select>

                                                                                                                                                        </div>
                                                                                                                                                        <div class="dropdown_selector">
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <!--Size End-->

                                                                                                                                                <!--Media Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Media<span style="color: red;">*</span>
                                                                                                                                                    </label>
                                                                                                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                                                                                                        <div style="float:left;margin-right:0px;">
                                                                                                                                                            <select disabled class="order_0_set1_0_media kdSelect " style="width: 70px;" id="media" name="media">
                                                                                                                                                                <option value="Bond">Bond</option>
<!--                                                                                                                                                                <option value="Vellum">Vellum</option>
                                                                                                                                                                <option value="Mylar">Mylar</option>                          -->
                                                                                                                                                            </select>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="dropdown_selector">
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <!--Media End-->

                                                                                                                                                <!--Binding Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Binding
                                                                                                                                                    </label>
                                                                                                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                                                                                                        <div style="float:left;margin-right:0px;">
                                                                                                                                                            <select disabled class="order_0_set1_0_binding kdSelect " style="width: 130px;" id="binding" name="binding">
                                                                                                                                                                <option value="none">None</option>                                      
<!--                                                                                                                                                                <option value="Bind All">Bind All</option>                          
                                                                                                                                                                <option value="Bind by Discipline">Bind by Discipline</option>
                                                                                                                                                                <option value="Screw Post">Screw Post</option>-->
                                                                                                                                                            </select>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="dropdown_selector">
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <!--Binding End-->

                                                                                                                                                <!--Folding Start-->
                                                                                                                                                <div>
                                                                                                                                                    <label>
                                                                                                                                                        Folding
                                                                                                                                                    </label>
                                                                                                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                                                                                                        <div style="float:left;margin-right:0px;">
                                                                                                                                                            <select disabled class="order_0_set1_0_folding kdSelect " style="width: 100px;" id="folding" name="folding">
                                                                                                                                                                <option value="None">None</option>
<!--                                                                                                                                                                <option value="Yes">Yes</option>                          -->
                                                                                                                                                            </select>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="dropdown_selector">
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <!--Folding End-->
                                                                                                                                            </div>
                                                                                                                                            <!--Custom Details Start-->
                                                                                                                                            <div id="size_custom_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                                                                                                                                                <label style="font-weight: bold;">Please Specify Custom Details : </label><textarea name="size_custom" id="size_custom" rows="3" cols="18" style="width: 201px;" placeholder="Custom Size"></textarea>
                                                                                                                                            </div>
                                                                                                                                            <!--Custom Details End-->
                                                                                                                                            <!--Page Number Details Start-->
                                                                                                                                            <div id="output_both_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                                                                                                                                                <label style="font-weight: bold;">Enter page numbers that are in COLOR (separated by a comma) :</label>
                                                                                                                                                <input type="text" name="output_both" id="output_both" style="width: 200px;" placeholder="Enter page numbers" />
                                                                                                                                            </div>
                                                                                                                                            <!--Page Number Details End-->

                                                                                                                                            <div style="width:730px;border-bottom: 1px solid #CCCCCC;float: left;">
                                                                                                                                                <label id="alt_ops" style="font-weight: bold;height:28px">
                                                                                                                                                    File Options<span style="color: red;">*</span>
                                                                                                                                                </label>

                                                                                                                                                <label id="pick_ops" style="font-weight: bold;height:28px;display: none;">
                                                                                                                                                    Pickup Options<span style="color: red;">*</span>
                                                                                                                                                </label>
                                                                                                                            <!--                    <input type="checkbox"  style="display: none;width: 2%;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set('1');" />-->
                                                                                                                                                <div id="options_plott" class="check" style="width:730px;border-top: 1px solid #FF7E00;margin-top:-13px;">
                                                                                                                                                    <div class="spl_option" style="float: 100%;">
                                                                                                                                                        <div>
                                                                                                                                                            <input class="filetrigger" name="alt_file_option" value="dropOff" id="drop_file"  type="radio" onclick="return upload_soho();" />
                                                                                                                                                            <label for="drop" >
                                                                                                                                                                Upload File
                                                                                                                                                            </label>                    
                                                                                                                                                        </div>

                                                                                                                                                        <div>
                                                                                                                                                            <input class="filetrigger" name="alt_file_option" value="dropOff" id="link"  type="radio" onclick="return provide_link();" />
                                                                                                                                                            <label for="drop" >
                                                                                                                                                                Provide Link to File
                                                                                                                                                            </label>                    
                                                                                                                                                        </div>   

                                                                                                                                                        <div>
                                                                                                                                                            <input class="filetrigger" name="alt_file_option" value="pickUp" id="pick"  type="radio" onclick="return show_date_picker();" />
                                                                                                                                                            <label for="pick" >
                                                                                                                                                                Schedule a pick up
                                                                                                                                                            </label></br>
                                                                                                                                                            <?php
                                                                                                                                                            $all_days_off = AllDayOff();
                                                                                                                                                            foreach ($all_days_off as $days_off_split) {
                                                                                                                                                                $all_days_in[] = $days_off_split['date'];
                                                                                                                                                            }
                                                                                                                                                            $all_date = implode(",", $all_days_in);
                                                                                                                                                            $all_date_exist = str_replace("/", "-", $all_date);
                                                                                                                                                            ?>

                                                                                                                                                        </div>

                                                                                                                                                        <div>
                                                                                                                                                            <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro();" />
                                                                                                                                                            <label for="drop" >
                                                                                                                                                                Drop off at Soho Repro
                                                                                                                                                            </label>                    
                                                                                                                                                        </div>                               
                                                                                                                                                    </div>
                                                                                                                                                    <br>

                                                                                                                                                        <!--File Upload Details Start-->
                                                                                                                                                        <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="up_form">
                                                                                                                                                            <input type="hidden" name="uploadedfile" id="uploadedfile" value="" /> 
                                                                                                                                                            <div id="dragandrophandler">Drag & Drop Files Here</div>
                                                                                                                                                            <br><br>
                                                                                                                                                                    <div id="status1"></div> 
                                                                                                                                                                    </div>
                                                                                                                                                                    <!--File Upload Details End-->

                                                                                                                                                                    <!--FTP Details Start-->
                                                                                                                                                                    <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="provide_link">
                                                                                                                                                                        <div style="margin: auto;width: 60%;">
                                                                                                                                                                            <div style="margin: auto;width: 60%;float:right;">
                                                                                                                                                                            <!--<textarea name="provide_link" id="provide_link_text" rows="3" cols="18" style="width: 201px;"></textarea>-->
                                                                                                                                                                                <input type="text" name="ftp_link" id="ftp_link" placeholder="FTP Link" />
                                                                                                                                                                                <input type="text" name="user_name" id="user_name" placeholder="User Name" />
                                                                                                                                                                                <input type="text" name="password" id="pass_word" placeholder="Password" />
                                                                                                                                                                            </div>
                                                                                                                                                                            <div style="margin: auto;width: 60%;float:right;padding-top: 5px;">
                                                                                                                                                                            <!--<span>If providing an FTP link, please include username and password.</span> -->
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>   
                                                                                                                                                                    </div>
                                                                                                                                                                    <!--FTP Details Start-->

                                                                                                                                                                    <!--Pickup Details Start-->

                                                                                                                                                                    <div id="date_time" style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;display:none;">
                                                                                                                                                                        <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                                                                                                                                                        <div style="width: 34%;float: left;"> 

                                                                                                                                                                            <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;">
                                                                                                                                                                                <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                                                                                                                                                            </div>

                                                                                                                                                                            <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                                                                                                                                                                <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_reveal();" />
                                                                                                                                                                                <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                                                                                                                                                            </div>

                                                                                                                                                                        </div>
                                                                                                                                                                    </div>

                                                                                                                                                                    <!--                        <div id="date_time" style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;float: left;width: 30%;padding-bottom: 10px;display:none;">
                                                                                                                                                                                                <div style="width: 100%;">
                                                                                                                                                                                                    <input style="margin-left: 75px;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" name="ready_now" value="READY NOW" id="ready_now" onclick="return ready_now();" />
                                                                                                                                                                                                </div>                      
                                                                                                                                                                    
                                                                                                                                                                                                <div style="border: 1px #CCC solid;width: 95%;margin-left: 5px;margin-bottom: 10px;"></div>
                                                                                                                                                                    - JASSIM DATE 
                                                                                                                                                                                                <div style="padding: 5px;">
                                                                                                                                                                                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
                                                                                                                                                                                                <input type="text" name="dahe_for_alt" id="date_for_alt" style="width: 30%;margin-left: 5px;" class="date_for_alt picker_icon" />                        
                                                                                                                                                                    
                                                                                                                                                                                                <input id="time_for_alt" type="text" style="width: 30%;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" />
                                                                                                                                                                                                </div>                        
                                                                                                                                                                                                
                                                                                                                                                                                                
                                                                                                                                                                    
                                                                                                                                                                                            </div>-->
                                                                                                                                                                    <!--Pickup Details End-->

                                                                                                                                                                    <!--Drop off Details Start Plotting -->
                                                                                                                                                                    <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off">
                                                                                                                                                                        <div style="margin: auto;width: 60%;">
                                                                                                                                                                            <div style="margin: auto;width: 75%;float:right;">
                                                                                                                                                                                <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broome Street" />381 Broome Street
                                                                                                                                                                                <input style="width: 10% !important;margin-left: 35px !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                                                                                                                                                                            <!-- <select disabled id="drop_val">
                                                                                                                                                                                    <option value="" selected="selected">Select</option>
                                                                                                                                                                                    <option value="381 Broom">381 Broome St</option>
                                                                                                                                                                                    <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                                                                                                                                                                </select> -->
                                                                                                                                                                            </div>                            
                                                                                                                                                                        </div>   
                                                                                                                                                                    </div>
                                                                                                                                                                    <!--Drop off Details End-->

                                                                                                                                                                    </div> 
                                                                                                                                                                    <div id="options_arch" class="check none" style="width:730px;border-top: 1px solid #FF7E00;">
                                                                                                                                                                        <div class="spl_option" style="float: 100%;">
                                                                                                                                                                            <div>
                                                                                                                                                                                <input class="filetrigger" name="alt_file_option" value="pickUp" id="pick"  type="radio" onclick="return show_date_picker_arch();" />
                                                                                                                                                                                <label for="pick" >
                                                                                                                                                                                    Schedule a pick up
                                                                                                                                                                                </label></br>
                                                                                                                                                                                <?php
                                                                                                                                                                                $all_days_off = AllDayOff();
                                                                                                                                                                                foreach ($all_days_off as $days_off_split) {
                                                                                                                                                                                    $all_days_in[] = $days_off_split['date'];
                                                                                                                                                                                }
                                                                                                                                                                                $all_date = implode(",", $all_days_in);
                                                                                                                                                                                $all_date_exist = str_replace("/", "-", $all_date);
                                                                                                                                                                                ?>

                                                                                                                                                                            </div>

                                                                                                                                                                            <div>
                                                                                                                                                                                <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro_arch();" />
                                                                                                                                                                                <label for="drop" >
                                                                                                                                                                                    Drop off at Soho Repro
                                                                                                                                                                                </label>                    
                                                                                                                                                                            </div>                               
                                                                                                                                                                        </div>
                                                                                                                                                                        <br>

                                                                                                                                                                            <!--Pickup Details Start-->

                                                                                                                                                                            <div id="date_time_arch" style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;display:none;">
                                                                                                                                                                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                                                                                                                                                                <div style="width: 34%;float: left;"> 

                                                                                                                                                                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;">
                                                                                                                                                                                        <span id="asap_status_arch" class="asap_orange" onclick="return asap_arc();">READY NOW</span>
                                                                                                                                                                                    </div>

                                                                                                                                                                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                                                                                                                                                                        <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt_arc" style="width: 75px;" onclick="return date_reveal();" />
                                                                                                                                                                                        <input id="time_for_alt_arc" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                                                                                                                                                                    </div>

                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                            <!--Pickup Details End-->

                                                                                                                                                                            <!--Drop off Details Start-->
                                                                                                                                                                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off_arch">
                                                                                                                                                                                <div style="margin: auto;width: 60%;">
                                                                                                                                                                                    <div style="margin: auto;width: 75%;float:right;">
                                                                                                                                                                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val_arc" value="381 Broome Street" />381 Broome Street
                                                                                                                                                                                        <input style="width: 10% !important;margin-left: 35px !important;" type="radio" name="drop_val" id="drop_val_arc_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                                                                                                                                                                                    <!-- <select disabled id="drop_val">
                                                                                                                                                                                            <option value="" selected="selected">Select</option>
                                                                                                                                                                                            <option value="381 Broom">381 Broome St</option>
                                                                                                                                                                                            <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                                                                                                                                                                        </select> -->
                                                                                                                                                                                    </div>                            
                                                                                                                                                                                </div>   
                                                                                                                                                                            </div>
                                                                                                                                                                            <!--Drop off Details End-->

                                                                                                                                                                    </div>


                                                                                                                                                                    <!--Special Instruction Start-->
                                                                                                                                                                    <input type="hidden" name="validate_imp" id="validate_imp" value="" />
                                                                                                                                                                    <div style="float: left;width: 100%;margin-top: 15px;">
                                                                                                                                                                        <div id="sp_inst" style="margin-top:10px;">
                                                                                                                                                                            <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                                                                                                                                                                                Special Instructions
                                                                                                                                                                            </label>
                                                                                                                                                                            <br>
                                                                                                                                                                                <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"><?php echo $entered['spl_instruction']; ?></textarea>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <!--Special Instruction End-->
                                                                                                                                                                    </div>
                                                                                                                                                                    </div>

                                                                                                                                                                    </div>              




                                                                                                                                                                    </div>
                                                                                                                                                                    </div>

                                                                                                                                                                    </div>    

                                                                                                                                                                    <!-- FOR EACH END -->     



                                                                                                                                                                    <div style="float:left;width:100%;text-align:right;margin-top: 10px;">                  
                                                                                                                                                                        <input class="addproductActionLink" value="Save and Continue" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -1px !important;" type="button" onclick="return validate_plotting_cont();" />
                                                                                                                                                                        <input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-right: 10px;" type="button" onclick="return validate_plotting();" />
                                                                                                                                                                    </div> 
                                                                                                                                                                    </span>
                                                                                                                                                                    </li>
                                                                                                                                                                    <li class="clear">
                                                                                                                                                                        <span>
                                                                                                                                                                            <div style="height:29px;">
                                                                                                                                                                                &nbsp;
                                                                                                                                                                            </div>

                                                                                                                                                                            <div style="clear:both">
                                                                                                                                                                            </div>
                                                                                                                                                                        </span>
                                                                                                                                                                    </li>
                                                                                                                                                                    </ul>

                                                                                                                                                                    </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <style>
                                                                                                                                                                        #result_ref
                                                                                                                                                                        {
                                                                                                                                                                            background-color: #f3f3f3;
                                                                                                                                                                            border-top: 0 none;
                                                                                                                                                                            box-shadow: 0 0 5px #ccc;
                                                                                                                                                                            display: none;
                                                                                                                                                                            margin-top: 0;
                                                                                                                                                                            overflow: hidden;
                                                                                                                                                                            padding: 10px;
                                                                                                                                                                            position: absolute;
                                                                                                                                                                            /*right: 0;*/
                                                                                                                                                                            text-align: left;
                                                                                                                                                                            top: 24px;
                                                                                                                                                                            width: 185px;
                                                                                                                                                                        }

                                                                                                                                                                        .auto_reference{
                                                                                                                                                                            cursor: pointer;
                                                                                                                                                                            /*list-style-type: none !important;*/
                                                                                                                                                                            list-style: none !important;
                                                                                                                                                                        }

                                                                                                                                                                        .auto_reference li:hover
                                                                                                                                                                        {
                                                                                                                                                                            background:#FF7E00;
                                                                                                                                                                            color:#FFF;
                                                                                                                                                                            cursor:pointer;
                                                                                                                                                                        }
                                                                                                                                                                        .auto_reference li
                                                                                                                                                                        {
                                                                                                                                                                            border-bottom: 1px #999 dashed;
                                                                                                                                                                        }
                                                                                                                                                                        .auto_reference span{
                                                                                                                                                                            font-size: 18px;
                                                                                                                                                                        }
                                                                                                                                                                        .none{
                                                                                                                                                                            display: none;
                                                                                                                                                                        }
                                                                                                                                                                        .dec:focus #result_ref{
                                                                                                                                                                            display: block !important;
                                                                                                                                                                        }
                                                                                                                                                                        /*.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
                                                                                                                                                                        .bar { background-color: #F99B3E; width:0%; height:20px; border-radius: 3px; }
                                                                                                                                                                        .percent { position:absolute; display:inline-block; top:3px; left:48%; }
                                                                                                                                                                        .upload_file_prog{
                                                                                                                                                                        width: 30% !important;
                                                                                                                                                                        padding: 1.5px;
                                                                                                                                                                        -webkit-border-radius: 5px;
                                                                                                                                                                        border: 1px solid #8f8f8f !important;
                                                                                                                                                                        }*/
                                                                                                                                                                        .arch_radio li{
                                                                                                                                                                            list-style: none;
                                                                                                                                                                            padding: 0px !important;
                                                                                                                                                                            padding-left: 0px !important;
                                                                                                                                                                            padding-bottom: 0px !important;
                                                                                                                                                                        }


                                                                                                                                                                        #dragandrophandler
                                                                                                                                                                        {
                                                                                                                                                                            border:2px dotted #FF7E00;
                                                                                                                                                                            width: 93%;
                                                                                                                                                                            color: #92AAB0;
                                                                                                                                                                            text-align: center;
                                                                                                                                                                            vertical-align: middle;
                                                                                                                                                                            padding: 20px 10px;
                                                                                                                                                                            margin-bottom: 10px;
                                                                                                                                                                            font-size: 200%;
                                                                                                                                                                            margin: 5px 2%;
                                                                                                                                                                            height: 40px;
                                                                                                                                                                            line-height: 40px;
                                                                                                                                                                        }
                                                                                                                                                                        .progressBar {
                                                                                                                                                                            width: 200px;
                                                                                                                                                                            height: 22px;
                                                                                                                                                                            border: 1px solid #ddd;
                                                                                                                                                                            border-radius: 5px; 
                                                                                                                                                                            overflow: hidden;
                                                                                                                                                                            display:inline-block;
                                                                                                                                                                            margin:0px 10px 5px 5px;
                                                                                                                                                                            vertical-align:top;
                                                                                                                                                                        }

                                                                                                                                                                        .progressBar div {
                                                                                                                                                                            height: 100%;
                                                                                                                                                                            color: #fff;
                                                                                                                                                                            text-align: right;
                                                                                                                                                                            line-height: 22px; /* same as #progressBar height if we want text middle aligned */
                                                                                                                                                                            width: 0;
                                                                                                                                                                            background-color: #0ba1b5; border-radius: 3px; 
                                                                                                                                                                        }
                                                                                                                                                                        .statusbar
                                                                                                                                                                        {
                                                                                                                                                                            /* border-top: 1px solid #A9CCD1; */
                                                                                                                                                                            min-height: 25px;
                                                                                                                                                                            width: 95%;
                                                                                                                                                                            vertical-align: top;
                                                                                                                                                                            margin: 0px 2%;
                                                                                                                                                                            padding: 5px;
                                                                                                                                                                            float: left;
                                                                                                                                                                        }

                                                                                                                                                                        .statusbar.even {
                                                                                                                                                                            background: rgba(255, 126, 0, 0.1);
                                                                                                                                                                        }

                                                                                                                                                                        .statusbar:nth-child(odd){
                                                                                                                                                                            background:#EBEFF0;
                                                                                                                                                                        }
                                                                                                                                                                        .filename
                                                                                                                                                                        {
                                                                                                                                                                            display: inline-block;
                                                                                                                                                                            vertical-align: top;
                                                                                                                                                                            width: 250px;
                                                                                                                                                                            color: #000;
                                                                                                                                                                            font-size: 16px;
                                                                                                                                                                        }
                                                                                                                                                                        .filesize
                                                                                                                                                                        {
                                                                                                                                                                            display:inline-block;
                                                                                                                                                                            vertical-align:top;
                                                                                                                                                                            color:#30693D;
                                                                                                                                                                            width:100px;
                                                                                                                                                                            margin-left:10px;
                                                                                                                                                                            margin-right:5px;
                                                                                                                                                                        }
                                                                                                                                                                        .abort{
                                                                                                                                                                            background-color:#A8352F;
                                                                                                                                                                            -moz-border-radius:4px;
                                                                                                                                                                            -webkit-border-radius:4px;
                                                                                                                                                                            border-radius:4px;display:inline-block;
                                                                                                                                                                            color:#fff;
                                                                                                                                                                            font-family:arial;font-size:13px;font-weight:normal;
                                                                                                                                                                            padding:4px 15px;
                                                                                                                                                                            cursor:pointer;
                                                                                                                                                                            vertical-align:top
                                                                                                                                                                        }

                                                                                                                                                                        .done-progress{
                                                                                                                                                                            background-color:#1B71EF;
                                                                                                                                                                            -moz-border-radius:4px;
                                                                                                                                                                            -webkit-border-radius:4px;
                                                                                                                                                                            border-radius:4px;display:inline-block;
                                                                                                                                                                            color:#fff;
                                                                                                                                                                            font-family:arial;font-size:13px;font-weight:normal;
                                                                                                                                                                            padding:4px 15px;
                                                                                                                                                                            cursor:pointer;
                                                                                                                                                                            vertical-align:top;
                                                                                                                                                                            display: none;
                                                                                                                                                                            float: right;
                                                                                                                                                                        }


                                                                                                                                                                        .picker_icon{
                                                                                                                                                                            background : #FFFFFF url(images/datepicker-20.png) no-repeat 4px 4px;
                                                                                                                                                                            padding: 5px 5px 5px 25px;
                                                                                                                                                                            height:18px;
                                                                                                                                                                            cursor: pointer;
                                                                                                                                                                        }
                                                                                                                                                                        .time_picker_icon {
                                                                                                                                                                            background: #FFFFFF url(images/clock.png) no-repeat 4px 4px;
                                                                                                                                                                            padding: 5px 5px 5px 30px;
                                                                                                                                                                            height: 18px;
                                                                                                                                                                            cursor: pointer;
                                                                                                                                                                            width: 50px;
                                                                                                                                                                        }
                                                                                                                                                                        #errmsg
                                                                                                                                                                        {
                                                                                                                                                                            color: red;
                                                                                                                                                                        }
                                                                                                                                                                        .spl_option > div
                                                                                                                                                                        {
                                                                                                                                                                            float:left;
                                                                                                                                                                            padding:10px 20px;
                                                                                                                                                                            margin: 6px 5px 6px 0px;
                                                                                                                                                                            background: #EFEFEF;
                                                                                                                                                                            border-radius: 3px;
                                                                                                                                                                        }
                                                                                                                                                                        .spl_option > div input{
                                                                                                                                                                            float:left;
                                                                                                                                                                            margin:1px 5px 0px 0px !important;
                                                                                                                                                                            width:auto;   
                                                                                                                                                                        }
                                                                                                                                                                        .spl_option > div label{
                                                                                                                                                                            float:left;
                                                                                                                                                                            margin:0px 5px 0px 0px;

                                                                                                                                                                        }
                                                                                                                                                                        .plot_wrap ul > li{
                                                                                                                                                                            width:94%;
                                                                                                                                                                            float:left;
                                                                                                                                                                            line-height: 20px;
                                                                                                                                                                            padding:2px 3%; 
                                                                                                                                                                        }
                                                                                                                                                                        .plot_wrap ul li label{
                                                                                                                                                                            float:left;
                                                                                                                                                                            width: 20%;
                                                                                                                                                                        }
                                                                                                                                                                        .plot_wrap ul li p{
                                                                                                                                                                            float:left;
                                                                                                                                                                            text-transform: uppercase;
                                                                                                                                                                        }

                                                                                                                                                                        .modal-overlay {
                                                                                                                                                                            opacity: 0.7;
                                                                                                                                                                            filter: alpha(opacity=0);
                                                                                                                                                                            position: fixed;
                                                                                                                                                                            top: 0;
                                                                                                                                                                            left: 0;
                                                                                                                                                                            z-index: 900;
                                                                                                                                                                            width: 100%;
                                                                                                                                                                            height: 100%;
                                                                                                                                                                            background: rgba(0, 0, 0, 0.3) !important;
                                                                                                                                                                        }
                                                                                                                                                                        .ref_div_star{
                                                                                                                                                                            color:red; margin-top: -5px;font-size: 16px;font-weight: bold;
                                                                                                                                                                        }

                                                                                                                                                                        .asap_orange{
                                                                                                                                                                            cursor: pointer;
                                                                                                                                                                            display: inline-block;
                                                                                                                                                                            background: #F99B3E;
                                                                                                                                                                            color: #FFF;
                                                                                                                                                                            padding: 5px 20px;
                                                                                                                                                                            border-radius: 5px;
                                                                                                                                                                            margin-top: 3px;
                                                                                                                                                                            font-weight: bold;
                                                                                                                                                                        }

                                                                                                                                                                        .asap_green{
                                                                                                                                                                            cursor: pointer;
                                                                                                                                                                            display: inline-block;
                                                                                                                                                                            background: #019E59;
                                                                                                                                                                            color: #FFF;
                                                                                                                                                                            padding: 5px 20px;
                                                                                                                                                                            border-radius: 5px;
                                                                                                                                                                            margin-top: 3px;
                                                                                                                                                                            font-weight: bold;
                                                                                                                                                                        }
                                                                                                                                                                    </style>

                                                                                                                                                                    </div>


                                                                                                                                                                    <div class="login_loader"></div>
                                                                                                                                                                    <div id="backgroundPopup"></div>

                                                                                                                                                                    <?php
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';  
                                                                                                                                                                    ?>

                                                                                                                                                                    <!-----TABLE END--->     
                                                                                                                                                                    </div>
                                                                                                                                                                    <div class="clear"></div>

                                                                                                                                                                    <div class="footerSRwapper" style="margin:auto;height:61px;">
                                                                                                                                                                        <div id="body_footer-inner" class="body_wrapper-inner">
                                                                                                                                                                            <ul class="navigation footer">
                                                                                                                                                                                <li><a href="#"><span>About SohoRepro</span></a></li>
                                                                                                                                                                                <li><a href="#"><span>FAQs</span></a></li>
                                                                                                                                                                                <li><a href="#"><span>Privacy Policy</span></a></li>
                                                                                                                                                                                <li><a href="#"><span>Security</span></a></li>
                                                                                                                                                                                <li><a href="#"><span>Terms of Use</span></a></li>
                                                                                                                                                                                <li><a href="#"><span>Contact</span></a></li>
                                                                                                                                                                                <div class="clear"></div>
                                                                                                                                                                            </ul>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>

                                                                                                                                                                    </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <div class="clear"></div>


                                                                                                                                                                    </div>
                                                                                                                                                                    </div>

                                                                                                                                                                    <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>






                                                                                                                                                                    <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-helper-hidden-accessible"></div><ul style="z-index: 4; top: 0px; left: 0px; display: none;" aria-activedescendant="ui-active-menuitem" role="listbox" class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all"></ul></body>
                                                                                                                                                                    <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
                                                                                                                                                                    </html>