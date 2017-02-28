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
?>
<?php
if ($_GET['status_id']) {

    $change_status = ($_GET['change_id'] == 1) ? '0' : '1';
    $status_id = $_GET['status_id'];
    $sql = "UPDATE sohorepro_customers
			SET     cus_status     = '" . $change_status . "' WHERE cus_id= '" . $status_id . "'";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_status";
    } else {
        $result = "failure_status";
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


                                                            <script type="text/javascript" src="store_files/scripts.js"></script>
                                                            <script src="store_files/jquery.min.js"></script>
                                                            <script type="text/javascript" src="jquery.sticky.js"></script>
                                                            <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $(".super_cat").click(function() {
                                                                        $(this).next(".sub_cat").slideToggle("slow");
                                                                    });

                                                                });
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
                                                                        
                                                                        .td_brdr {
                                                                            border-bottom: 1px solid #fff;
                                                                            color: #fff;
                                                                            font-size: 14px;
                                                                            text-transform: uppercase;
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
                                                                    <body onload="return clear_cach_index();">
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
                                                                                                
                                                                                                <?php 
                                                                                                //print_r($_SESSION); exit;
                                                                                                
                                                                                                $page = 1; //Default page
                                                                                                $limit = 25; //Records per page
                                                                                                $start = 0; //starts displaying records from 0
                                                                                                if (isset($_GET['page']) && $_GET['page'] != '') {
                                                                                                    $page = $_GET['page'];
                                                                                                }
                                                                                                $start = ($page - 1) * $limit;
                                                                                                if ($_GET['limite']) {
                                                                                                    $limit = $_GET['limite'];
                                                                                                }
                                                                                                
                                                                                                $ordersort = '';
                                                                                                if(isset($_REQUEST['order_sort']))
                                                                                                {
                                                                                                    $ordersort = $_REQUEST['order_sort'];
                                                                                                }
                                                                                                
                                                                                                
                                                                                                
                                                                                                $sorttype = ($_REQUEST['sorttype'] == '') ? 'order_id' : $_REQUEST['sorttype'];
                                                                                                $sort = ($_REQUEST['sort'] == '') ? 'asc' : $_REQUEST['sort'];
                                                                                                
                                                                                                $sortnew = ($sort == 'asc') ? 'desc' : 'asc';
                                                                                                $orderbysort= "sort=$sortnew&";
                                                                                                if($_REQUEST['sort']){
                                                                                                    $orderbysort= "sort=".$sortnew."&";
                                                                                                }
                                                                                                
                                                                                                $userinfo = UserDtls($_SESSION['sohorepro_userid']);
                                                                                                $invoiceTab = ($_GET['order_sort']) ? $_GET['order_sort']:'';
                                                                                                
                                                                                                $usersList = getMyUserList($_SESSION['sohorepro_userid'],$_SESSION['sohorepro_companyid']);
                                                                                                $rows = count($usersList);                                                                                                
                                                                                                
                                                                                                $sort_date_img1 = 'up';
                                                                                                
                                                                                                if($sorttype == 'order_number' && $sort == 'asc')
                                                                                                {
                                                                                                    $sort_date_img1 = 'down';
                                                                                                }
                                                                                                //print_r($Orders); exit;

                                                                                                ?>
                                                                                                
                                                                                                <?php
                                                                                                    if ($result == "success_status") {
                                                                                                        ?>
                                                                                                        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">User Status Updated Successfully</div>
                                                                                                <?php } ?> 
                                                                                                
                                                                                                <h2 style="color: #ff7e00 !important; margin-bottom: 10px;">Company User List</h2>    
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                    <tr>
                                                                                                        <td align="left" valign="top">
                                                                                                            <table width="880" border="0" cellspacing="0" cellpadding="0">
                                                                                                                <tr>
                                                                                                                    <td width="80" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">S.no</td>
                                                                                                                    <td width="200" colspan="2" valign="middle" height="28" bgcolor="#f99b3e" align="left" class="td_brdr pad_lft">User Name&nbsp;</td>
                                                                                                                    <td width="239" colspan="2" valign="middle" height="28" bgcolor="#f99b3e" align="left" class="td_brdr pad_lft">Email&nbsp;</td>
                                                                                                                    <td width="239" colspan="2" valign="middle" height="28" bgcolor="#f99b3e" align="left" class="td_brdr pad_lft">Phone&nbsp;</td>
                                                                                                                    <td width="100" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">Status</td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                             <table width="880" border="0" cellspacing="0" cellpadding="0" class="tbl_repeat">
                                                                                                                <?php
                                                                                                                $i = 1;
                                                                                                                if (count($usersList) > 0) {
                                                                                                                    foreach ($usersList as $newUser) {
                                                                                                                        $rowColor = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                                                                                        $rowColor1 = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                                                                                        $id = $newUser['cus_id'];
                                                                                                                        $name = $newUser['cus_fname']." ".$newUser['cus_lname'];
                                                                                                                        $email = $newUser['cus_email'];
                                                                                                                        $phone = $newUser['cus_contact_phone'];
                                                                                                                        $status = ($newUser['cus_status'] == 1) ? 'active' : 'de-active';
                                                                                                                        ?>
                                                                                                                        <tr  style="font-size: 14px;" id="order_<?php echo $id; ?>">
                                                                                                                            <td width="80" height="36" align="center" bgcolor="<?php echo $rowColor; ?>" valign="middle"><?php echo $i; ?></td>
                                                                                                                            <td width="200" colspan="2" height="36" bgcolor="<?php echo $rowColor1; ?>" align="left" class="pad_lft" valign="middle"><?php echo $name; ?></td>                
                                                                                                                            <td width="239" colspan="2" height="36" bgcolor="<?php echo $rowColor1; ?>" align="left" class="pad_lft" valign="middle"><?php echo $email; ?></td>                
                                                                                                                            <td width="239" colspan="2" height="36" bgcolor="<?php echo $rowColor1; ?>" align="left" class="pad_lft" valign="middle"><?php echo $phone; ?></td>                
                                                                                                                            <td width="100" height="36" align="center" bgcolor="<?php echo $rowColor; ?>" valign="middle"><a href="company_userlist.php?status_id=<?php echo $id; ?>&change_id=<?php echo $newUser['cus_status']; ?>" onclick="return confirm('Are you change the status in this user?');"><img src="admin/images/<?php echo $status; ?>.png" width="22" height="22"  alt="Status" title="Status"/></a></td>                                                                                                                            
                                                                                                                        </tr>
                                                                                                                        <?php
                                                                                                                        $i++;
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    ?>
                                                                                                                    <tr  bgcolor="<?php echo $rowColor; ?>">
                                                                                                                        <td colspan="4" align="center">There is no Users</td>
                                                                                                                    </tr>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </table></td>
                                                                                                    </tr>
                                                                                                </table>

                                                                                                <?php
                                                                                                $state_all = StateAll();
                                                                                                ?>
                                                                                                <!--<div style="margin-bottom:0;" class="bkgd-stripes-orange">&nbsp;</div>-->

                                                                                                <div class="login_loader"></div>
                                                                                                <div id="backgroundPopup"></div>                                                                                                

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
                                                                        </div>

                                                                        <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>






                                                                        <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-helper-hidden-accessible"></div><ul style="z-index: 4; top: 0px; left: 0px; display: none;" aria-activedescendant="ui-active-menuitem" role="listbox" class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all"></ul></body>
                                                                    <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
                                                                    </html>

                                                                    <script type="text/javascript">
                                                                        $(document).ready(function()
                                                                        {
                                                                            $("div.close").hover(
                                                                                    function() {
                                                                                        $('span.ecs_tooltip').show();
                                                                                    },
                                                                                    function() {
                                                                                        $('span.ecs_tooltip').hide();
                                                                                    }
                                                                            );

                                                                            $("div.close").click(function() {
                                                                                disablePopup();  // function close pop up
                                                                            });

                                                                            $(this).keyup(function(event) {
                                                                                if (event.which == 27) { // 27 is 'Ecs' in the keyboard
                                                                                    disablePopup();  // function close pop up
                                                                                }
                                                                            });

                                                                            $("div#backgroundPopup").click(function() {
                                                                                disablePopup();  // function close pop up
                                                                            });
                                                                            
                                                                            $('.trigger').click(function()
                                                                            {
                                                                                var val = $(this).attr('id');
                                                                                if ($(this).is(':visible'))
                                                                                {
                                                                                    $(this).next(".test_" + val).fadeToggle('slow').siblings(".test_" + val).hide();
                                                                                }
                                                                            });

                                                                        });


                                                                        function loading_supply() {
                                                                            $("#login_window").fadeOut("normal");
                                                                            $("#backgroundPopup").css("opacity", "0.7");
                                                                            $("div.login_loader").show();
                                                                        }

                                                                        function loading() {
                                                                            $("div.login_loader").show();
                                                                        }

                                                                        function loginPopup() {
                                                                            closeloading(); // fadeout loading
                                                                            $("#login_window").fadeIn(0500); // fadein popup div
                                                                            $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
                                                                            $("#backgroundPopup").fadeIn(0001);
                                                                        }

                                                                        function loginShippPopup() {
                                                                            closeloading(); // fadeout loading
                                                                            $("#login_shipp_window").fadeIn(0500); // fadein popup div
                                                                            $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
                                                                            $("#backgroundPopup").fadeIn(0001);
                                                                        }

                                                                        function closeloading() {
                                                                            $("div.login_loader").fadeOut('normal');
                                                                        }

                                                                        function disablePopup() {
                                                                            $("#login_window").fadeOut("normal");
                                                                            $("#login_shipp_window").fadeOut("normal");
                                                                            $("#backgroundPopup").fadeOut("normal");
                                                                        }


                                                                        function set_val(str) {
                                                                            //alert(str);
                                                                            $(".set_val").val(str);

                                                                        }

                                                                        function dummy_reference()
                                                                        {
                                                                            var jobref = document.getElementById('jobref').value;
                                                                            $("#dummy_reference").val(jobref);
                                                                        }

                                                                        function clear_cach_index()
                                                                        {
                                                                            $("#email_id").val('');
                                                                            $("#password").val('');
                                                                        }

                                                                        function search_test()
                                                                        {
                                                                            var search_prod = document.getElementById("search_val").value;
                                                                            window.location = "index.php?search=" + search_prod;

                                                                        }

                                                                    </script>
                                                                    <script>
                                                                        function help_box_logged()
                                                                        {
                                                                            alert('Logged Help Box');
                                                                        }

                                                                        function help_box()
                                                                        {
                                                                            alert('Help Box');
                                                                        }
                                                                    </script>