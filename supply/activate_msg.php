<?php
include './admin/config.php';

include './admin/db_connection.php';

include './admin/include/class.phpmailer.php';



if(isset($_REQUEST['login_submit']))

{ 

    unset($_SESSION['sohorepro_userid']);

    unset($_SESSION['sohorepro_companyid']);

    unset($_SESSION['sohorepro_username']); 

    $emailid= mysql_real_escape_string($_POST['email_id']);

    $pass= mysql_real_escape_string($_POST['password']);

    $rememberme= mysql_real_escape_string($_POST['rememberme']);



    $user_login = UserLogin($emailid,$pass); 

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

   

    if((count($user_login) > 0)){       

        $_SESSION['sohorepro_userid']      =$user_login[0]['cus_id'];

        $_SESSION['sohorepro_companyid']   =$user_login[0]['cus_compname'];

        $_SESSION['sohorepro_username']    =$user_login[0]['cus_contact_name'];

        header("Location:index.php"); 

    }  else {

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

            <title> SohoRepro </title>



            <!-- base href="http://soho.thinkdesign.com/" -->



            <link rel="stylesheet" href="store_files/style.css" type="text/css" media="screen"> 

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


                                                        <script>
                                                            function activate_status(COMP_ID, USR_ID)
                                                            {
                                                                $("#default").hide();
                                                                $.ajax
                                                                ({
                                                                    type: "POST",
                                                                    url: "activate_customer.php",
                                                                    data: "activate_comp="+COMP_ID+"&activate_usr="+USR_ID,
                                                                    beforeSend: loadStart,
                                                                    complete: loadStop,
                                                                    success: function(option)
                                                                    {  
                                                                        if(option == true){
                                                                        $("#succ_message").fadeIn();
                                                                        setTimeout("location.href=\'activate_msg.php?activated=1\'", 1000);
                                                                        }
                                                                    }
                                                                });
                                                            }    
                                                            
                                                             function loadStart() {
                                                                $('#loading').show();
                                                            }

                                                            function loadStop() {
                                                                $('#loading').hide();
                                                            }
                                                        </script>




                                                        <script type="text/javascript" src="store_files/scripts.js"></script>
                                                        <style>
                                                            .none{
                                                                display:none;
                                                            }
                                                        </style>




                                                        <link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">

                                                            <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">

                                                              </head>

                                                                <body>
                                                                    <div id="loading" class="none"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1002;">
                                                                        <img src="admin/images/loading_rainbow.gif" border="0" style="width: 200px;height: 200px;" />
                                                                    </div>

                                                                    <div id="body_container">

                                                                        <div id="body_content" class="body_wrapper">

                                                                            <div id="body_content-inner" class="body_wrapper-inner">



                                                                                <?php include "includes/header_sidebar.php"; ?>



                                                                                <div id="content_output">



                                                                                    <?php include "includes/top_nav.php"; ?>

                                                                                    <div id="content_output-data" style="margin-bottom:20px;">




                                                                                        <?php if($_GET['activate_comp'] != ''){ ?>
                                                                                        <input type="hidden" name="activate_comp" value="<?php echo $_GET['activate_comp']; ?>" />
                                                                                        <input type="hidden" name="activate_usr" value="<?php echo $_GET['activate_usr']; ?>" />
                                                                                        <script>
                                                                                                  activate_status(<?php echo $_GET['activate_comp']; ?>, <?php echo $_GET['activate_usr']; ?>);                                                                                      
                                                                                        </script>
                                                                                            <div style="float: left;margin-left: 30px;margin-top: 50px;height: 428px;">
                                                                                                <h2 id="succ_message" style="color: #009D59;text-align: center;display:none;">Your account has been created. Use your email and password to log in.</h2>                                                                                                
                                                                                            </div>
                                                                                        
                                                                                        <?php } ?>
                                                                                        <?php if($_GET['activated'] == '1'){ ?>
                                                                                            <div style="float: left;margin-left: 30px;margin-top: 50px;height: 428px;">
                                                                                                <h2 id="succ_message" style="color: #009D59;text-align: center;">Your account has been created. Use your email and password to log in.</h2>
                                                                                            </div>                                                                                        
                                                                                        <?php }elseif ($_GET['initiate'] == '1'){ ?>

                                                                                        <div id="default" style="float: left;margin-left: 30px;margin-top: 50px;height: 428px;">
                                                                                                <h2 style="color: #009D59;text-align: center;">We have emailed you an activation link. You must click this to activate your account.</h2>                                                                                                
                                                                                            </div>
                                                                                        <?php } ?>


                                                                                        

                                                                                        <!--<div class="bkgd-stripes-orange">&nbsp;</div>-->



                                                                                        <!--<div style="margin-bottom:0;" class="bkgd-stripes-orange">&nbsp;</div>-->

                                                                                        <div style="clear:both;"></div>





                                                                                        <!--</form> -->

                                                                                        <div style="clear:both;"></div>



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



                                                                    <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>













                                                                    <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-helper-hidden-accessible"></div><ul style="z-index: 4; top: 0px; left: 0px; display: none;" aria-activedescendant="ui-active-menuitem" role="listbox" class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all"></ul></body>

                                                                <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->

                                                                </html>



