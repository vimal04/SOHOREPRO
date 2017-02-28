<?php
$current_host = $_SERVER['HTTP_HOST'];
if ($current_host == 'sohorepro.com') {
    header("Location:http://supply.sohorepro.com/web/");
}

include './admin/config.php';
include './admin/db_connection.php';
include './admin/include/class.phpmailer.php';
error_reporting(0);

if(!isset($_SESSION['sohorepro_userid']))
{
    header("Location:index.php");
}

if (isset($_REQUEST['login_submit'])) {
    unset($_SESSION['sohorepro_userid']);
    unset($_SESSION['sohorepro_companyid']);
    unset($_SESSION['sohorepro_username']);
    $emailid = mysql_real_escape_string($_POST['email_id']);
    $pass = mysql_real_escape_string($_POST['password']);

    $user_login = UserLogin($emailid, $pass);
    $chk_cus_status = CheckCusStatus($user_login[0]['cus_compname']);
    print_r($user_login); exit;

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
        header("Location:index.php");
    } else {
        header("Location:index.php?err=incorrect");
    }
}

if (isset($_REQUEST['pass_submit'])) {
    $userinfo = UserDtls($_SESSION['sohorepro_userid']);
    extract($_POST);
    //print_r($old_pass); exit;
    if($userinfo[0]['cus_pass'] == $old_pass)
    {
        $updateuser = "update sohorepro_customers set cus_pass = '$new_pass' WHERE cus_id = '".$_SESSION['sohorepro_userid']."'";
        $updates = mysql_query($updateuser);
        header("Location:change_password.php?error=success");
    }
    else
    {
        header("Location:change_password.php?error=old");
    }
}

$result = '';
if(isset($_REQUEST['error']))
{
    $result = $_REQUEST['error'];
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
                                                <link rel="stylesheet" href="store_files/style_002.css" type="text/css" media="screen">
                                                <!-- <link rel="stylesheet" href="store_files/kendo.css" type="text/css" media="screen"> 
                                                    <link rel="stylesheet" href="store_files/kendo_002.css" type="text/css" media="screen"> 
                                                         --> 
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
                                                            <!-- <script language="javascript" src="store_files/kendo.js"></script> 
                                                            <script language="javascript" src="store_files/script.js"></script> 
                                                            <script language="javascript" src="store_files/storecart.js"></script> 
                                                            <script language="javascript" src="store_files/interface.js"></script> -->

  <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->


                                                                <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
                                                                    <!--[if IE 7]>
                                                                    <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
                                                                    <![endif]-->



                                                                    <!-- Validation script starts here -->

                                                                    <style type="text/css">
                                                                        label.error{
                                                                            color: red !important; 
                                                                            float:left;
                                                                            clear: both;
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
                                                                        
                                                                        
                                                                        .section_week .week_buttons a{display:inline; float:left; text-align:center;max-width:100px; border:1px solid #ccc;
                                                                        padding:4px;width:100%;text-decoration: none;color:#5f5f5f;}
                                                                        .section_week{width:100%;float:left; margin-bottom: 20px;}
                                                                        .section_week .week_buttons a:hover{background:#ff7e00 none repeat scroll 0 0;color:#fff;}
                                                                    </style>
                                                                    <script src="js/jquery.js" type="text/javascript" ></script>
                                                                    <script src="js/jquery.validate.js" type="text/javascript" ></script>
                                                                    <script src="js/jquery.maskedinput.js" type="text/javascript" ></script>

                                                                    <!--scroll set to top--->
                                                                    <script type="text/javascript">
                                                                //STICKY NAV
                                                                $(document).ready(function() {
                                                                    var top = $('#top_header').offset().top - parseFloat($('#top_header').css('marginTop').replace(/auto/, 100));
                                                                    $(window).scroll(function(event) {
                                                                        // what the y position of the scroll is
                                                                        var y = $(this).scrollTop();

                                                                        // whether that's below the form
                                                                        if (y > top) {
                                                                            // if so, ad the fixed class
                                                                            $('.sticky-navigation').addClass('top_header_css');
                                                                        } else {
                                                                            // otherwise remove it
                                                                            $('.sticky-navigation').removeClass('top_header_css');
                                                                        }
                                                                    });
                                                                });
                                                                    </script>

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
                                                                            /*box-shadow: 0 2px 4px rgba(0, 0, 0, .2);*/
                                                                            z-index: 1;
                                                                        }
                                                                        .top_header_css{
                                                                            box-shadow: 0 2px 4px rgba(0, 0, 0, .2);
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
                                                                        
                                                                        .active-period {
                                                                            background: #ff7e00 none repeat scroll 0 0;
                                                                            color: #fff !important;
                                                                        }
                                                                        
                                                                        .pass_form td { height: 45px; vertical-align: middle; }
                                                                        .pass_form .passfield{ border: solid 1px #ccc; float:left;}
                                                                        
                                                                        .btn_shopping{background:url(images/button.jpg) no-repeat right; width:154px; height:28px; float: right; font-family:Arial; font-size:11px; font-weight:bold; color:#ffffff; border:0px; cursor:pointer; text-transform:uppercase;}
                                                                    </style>
                                                                    <script type="text/javascript">

                                                                        $(document).ready(function() {



                                                                            var validation_obj = {
                                                                                rules: {
                                                                                    old_pass: {
                                                                                        required: true,
//                                                                                        equalTo: '#old_pass_confirm'
                                                                                    },
                                                                                    new_pass: {
                                                                                        required: true
                                                                                    },
                                                                                    confirm_pass: {
                                                                                        required: true,
                                                                                        equalTo: "#new_pass"
                                                                                    }
                                                                                },
                                                                                messages: {
                                                                                    old_pass: {
                                                                                        required: 'Please enter the old password',
                                                                                        equalTo : 'Old Password is wrong'
                                                                                    },
                                                                                    new_pass: {
                                                                                        required: 'Please enter the new password'
                                                                                    },
                                                                                    confirm_pass: {
                                                                                        required: 'Please enter the confirm password',
                                                                                        equalTo : 'New and Confirm Password should be same'
                                                                                    }

                                                                                }
                                                                            };


                                                                            $("#change_password").validate(validation_obj);

                                                                        });

                                                                    </script>
                                                                    <!-- Validation script ends here --> 


                                                                    </head>
                                                                    <body >
                                                                        <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                                                                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                                                                        <div id="body_container">

                                                                            <div id="body_content" class="body_wrapper">
                                                                                <div id="body_content-inner" class="body_wrapper-inner">
                                                                                    <div class="responsive_container"> 
                                                                                        <?php// include "includes/header_sidebar.php"; ?>

                                                                                        <div id="content_output">



                                                                                            <div id="content_output-data" style="margin-bottom:20px;">  

                                                                                                <!-- Header Start --> 

                                                                                                <div id="top_header" style="float:left;width: 100%;">
                                                                                                    <?php include "includes/top_nav.php"; ?>
                                                                                                </div>
                                                                                                
                                                                                                 <div id="content_output-data" style="margin-bottom:20px;">
                                                                                                <!--- TABLE START -->
                                                                                                <div id="cart_tabl">
                                                                                                    <?php
                                                                                                    if ($result == "success") {
                                                                                                        ?>
                                                                                                        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Password Updated Successfully</div>
                                                                                                        <?php
                                                                                                    } elseif ($result == "old") {
                                                                                                        ?>
                                                                                                        <div style="color:#F00; text-align:center; padding-bottom:10px;">Old Password is Wrong</div>      
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?> 

                                                                                                        <div style="float: left;width: 100%;">
                                                                                                            <div style="color: #ff7e00 !important;margin-bottom: 20px;"><h2 style="color: #ff7e00 !important;">Change Password</h2></div>
                                                                                                            <div style="color: #007F2A !important;margin-bottom: 20px;display: none;" id="feed_succ">Successfully submitted your question.</div>

                                                                                                            <?php
                                                                                                            if ($_GET['success'] == "1") {
                                                                                                            ?>
                                                                                                            <div style="color: #007F2A !important;margin-bottom: 20px;" id="feed_succ">Successfully submitted your question.</div>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>

                                                                                                            <input type="hidden" name="succ_id" id="succ_id" value="<?php echo $_GET['success']; ?>" />

                                                                                                            <span id="errmsg"></span>
                                                                                                            <form name="change_password" id="change_password" method="post" action="">  
                                                                                                                <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $comp_id; ?>" /> 
                                                                                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
                                                                                                              
                                                                                                                <table width="740" class="pass_form">
                                                                                                                    <tr>
                                                                                                                        <td valign="top" width="30%"><span style="font-weight: bold;">Old Password</span><span style="color: red;">*</span></td>
                                                                                                                        <td width="70%">
                                                                                                                            <input intvalue="Old Password" class="required passfield" name="old_pass" id="old_pass" type="password" placeholder="Old Password" />
<!--                                                                                                                            <input intvalue="Old Password" class="required passfield" name="old_pass_confirm" id="old_pass_confirm" type="hidden" placeholder="Old Password Confirm" value="<?php echo $userinfo[0]['cus_pass']; ?>" />-->
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td valign="top" width="30%"><span style="font-weight: bold;">New Password</span><span style="color: red;">*</span></td>
                                                                                                                        <td width="70%">
                                                                                                                            <input intvalue="Old Password" class="required passfield" name="new_pass" id="new_pass" type="password" placeholder="New Password" />
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                        <td valign="top" width="30%"><span style="font-weight: bold;">Confirm Password</span><span style="color: red;">*</span></td>
                                                                                                                        <td width="70%">
                                                                                                                            <input intvalue="Old Password" class="required passfield" name="confirm_pass" id="confirm_pass" type="password" placeholder="Confirm Password" />
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <tr style="padding: 10px;">
                                                                                                                        <td></td>
                                                                                                                        <td>
                                                                                                                            <input type="submit" name="pass_submit" class="btn_shopping" style="margin-top: 20px;float: left !important;" value="Submit" />
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                </div>





                                                                                                <!-----TABLE END--->     
                                                                                                 </div>
                                                                                                
                                                                                               

                                                                                            </div>

                                                                                            <div class="clear"></div>
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

                                                                   