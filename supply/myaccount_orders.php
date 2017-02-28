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
                                                                                                
                                                                                                if($userinfo[0]['ap_user'] == 1 || $invoiceTab!= 'invoice')
                                                                                                {
                                                                                                    $Orders = getMyOrders($_SESSION['sohorepro_userid'],$_SESSION['sohorepro_companyid'],$ordersort,$sort,$sorttype);
                                                                                                    $rows = count(myOrdersCount($_SESSION['sohorepro_userid'],$_SESSION['sohorepro_companyid'],$ordersort,$sort,$sorttype));                                                                                                
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    $Orders = array();
                                                                                                    $rows = array();
                                                                                                }
                                                                                                
                                                                                                $sort_date_img1 = 'up';
                                                                                                $sort_date_img2 = 'up';
                                                                                                $sort_date_img3 = 'up';
                                                                                                $sort_date_img4 = 'up';
                                                                                                $sort_date_img5 = 'up';
                                                                                                
                                                                                                if($sorttype == 'order_number' && $sort == 'asc')
                                                                                                {
                                                                                                    $sort_date_img1 = 'down';
                                                                                                }elseif($sorttype == 'created_date' && $sort == 'asc')
                                                                                                {
                                                                                                    $sort_date_img2 = 'down';
                                                                                                }elseif($sorttype == 'customer_company_name' && $sort == 'asc')
                                                                                                {
                                                                                                    $sort_date_img3 = 'down';
                                                                                                }elseif($sorttype == 'order_id' && $sort == 'asc')
                                                                                                {
                                                                                                    $sort_date_img4 = 'down';
                                                                                                }elseif($sorttype == 'invoice_type' && $sort == 'asc')
                                                                                                {
                                                                                                    $sort_date_img5 = 'down';
                                                                                                }
                                                                                                
                                                                                                if($_REQUEST['order_sort']){
                                                                                                    $order_sort = "order_sort=".$_REQUEST['order_sort']."&";
                                                                                                }
                                                                                                //print_r($Orders); exit;

                                                                                                ?>


                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                    <tr>
                                                                                                        <td colspan="6" class="billing_container">
                                                                                                            <div class="section_week">
                                                                                                                <div style="clear:both; font-weight: bold; margin-bottom: 10px; font-size: 22px;">Orders</div>
                                                                                                                <div class="week_buttons">
                                                                                                                    <a <?php if ($_GET['order_sort'] == "all" || !isset($_GET['order_sort'])) { ?> class="active-period" <?php } ?> href="myaccount_orders.php?order_sort=all">All</a>
                                                                                                                    <a <?php if ($_GET['order_sort'] == "open") { ?> class="active-period" <?php } ?> href="myaccount_orders.php?order_sort=open">Open</a>
                                                                                                                    <a <?php if ($_GET['order_sort'] == "closed") { ?> class="active-period" <?php } ?> href="myaccount_orders.php?order_sort=closed">Closed</a>
                                                                                                                    <a <?php if ($_GET['order_sort'] == "invoice") { ?> class="active-period" <?php } ?> href="myaccount_orders.php?order_sort=invoice" <?php if($userinfo[0]['ap_user'] != 1) {?> style="display:none;"<?php } ?>>Invoiced</a>
                                                                                                                </div>
                                                                                                                <?php $cl = closedOrderBillable($_GET['feq_sort']);
                                                                                                                ?>

                                                                                                            </div></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" valign="top"><table width="880" border="0" cellspacing="0" cellpadding="0">
                                                                                                                
                                                                                                                <tr>
                                                                                                                    <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="myaccount_orders.php?<?php echo $order_sort?><?php echo $orderbysort?>sorttype=order_number">ORDER NUMBER&nbsp;<img src="admin/images/<?php echo $sort_date_img1; ?>.png"  alt="" width="10px" height="5px"/></a></td>
                                                                                                                    <td width="120" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="myaccount_orders.php?<?php echo $order_sort?><?php echo $orderbysort?>sorttype=created_date">DATE &nbsp;<img src="admin/images/<?php echo $sort_date_img2; ?>.png"  alt="" width="10px" height="5px"/></a></td>                
<!--                                                                                                                    <td width="189" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="myaccount_orders.php?<?php echo $order_sort?><?php echo $orderbysort?>sorttype=customer_company_name">Customer&nbsp;<img src="admin/images/<?php echo $sort_date_img3; ?>.png"  alt="" width="10px" height="5px"/></a></td>-->
                                                                                                                    <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="myaccount_orders.php?<?php echo $order_sort?><?php echo $orderbysort?>sorttype=order_id">JOB REFERENCE&nbsp;<img src="admin/images/<?php echo $sort_date_img4; ?>.png"  alt="" width="10px" height="5px"/></a></td>      
                                                                                                                    <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="myaccount_orders.php?<?php echo $order_sort?><?php echo $orderbysort?>sorttype=invoice_type">INVOICE FREQUENCY&nbsp;<img src="admin/images/<?php echo $sort_date_img5; ?>.png"  alt="" width="10px" height="5px"/></a></td>     
                                                                                                                </tr>
                                                                                                                <?php
                                                                                                                $i = 1;
                                                                                                                if (count($Orders) > 0 && $_REQUEST['order_sort'] != 'invoice') {
                                                                                                                    foreach ($Orders as $order) {
                                                                                                                        $rowColor = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                                                                                        $rowColor1 = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                                                                                        $id = $order['id'];
                                                                                                                        $orderser_id = $order['id'];
                                                                                                                        $order_id = $order['order_id'];
                                                                                                                        $order_numer = $order['order_number'];
                                                                                                                        //$date = date("m-d-Y h:m A", strtotime($order['created_date']));
                                                                                                                        $order_close_status = $order['closed_status'];
                                                                                                                        $current_time = $order['created_date'];
                                                                                                                        $datew = new DateTime($current_time, new DateTimeZone('America/New_York'));
                                                                                                                        date_default_timezone_set('America/New_York');
                                                                                                                        $temp_times = date("Y-m-d h:iA", $datew->format('U'));
                                                                                                                        $date = date("m/d/Y", strtotime($order['created_date'])) . ' ' . date("h:iA", strtotime("-0 minutes", strtotime($temp_times)));
                                                                                                                        $customer = ($order['customer_company_name'] != '') ? $order['customer_company_name'] : 'Guest User';
                                                                                                                        $price = getPrice($id);
                                                                                                                        $tax_status = getTaxStatusChk($order['customer_company']);
                                                                                                                        $cas_customer = $order['cash_customer'];
                                                                                                                        $tax_value = TaxValue();
                                                                                                                        if ($tax_status == '1') {
                                                                                                                            $tax_line = '0';
                                                                                                                        }
                                                                                                                        //               elseif($cas_customer == '1')
                                                                                                                        //                {
                                                                                                                        //                 $tax_line = '8.875';      
                                                                                                                        //                 }
                                                                                                                        else {

                                                                                                                            $tax_line = $tax_value;
                                                                                                                        }
                                                                                                                        $tax = ($tax_line * ($price[0]['sub_total'] / 100));
                                                                                                                        $grand_tot = ($price[0]['sub_total'] + $tax);

                                                                                                                        $invoice_freq = getInvoiceFreq($order['customer_company']);
                                                                                                                        if($invoice_freq[0]['invoice_type']=="14"){
                                                                                                                            $invoice_period= "Bi-Monthly";
                                                                                                                        }
                                                                                                                        else if($invoice_freq[0]['invoice_type']=="30"){
                                                                                                                             $invoice_period = "Monthly";
                                                                                                                        }
                                                                                                                        else{
                                                                                                                             $invoice_period = "Weekly";
                                                                                                                        }
                                                                                                                   //     print_r($invoice_freq);
                                                                                                                        ?>

                                                                                                                        <tr class="trigger"  id="<?php echo $id; ?>"> 
                                                                                                                            <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor; ?>"   valign="middle"><?php echo $order_numer; ?></td>             
                                                                                                                            <td width="176" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>"  valign="middle"><?php echo $date; ?></td>                                    
<!--                                                                                                                            <td width="109" height="36" align="center" bgcolor="<?php echo $rowColor; ?>"   valign="middle"><span id="customer_name_<?php echo $id; ?>"><?php echo $customer; ?></span></td>                -->
                                                                                                                            <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>"  valign="middle"><span class="refj_<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $order_id; ?></span></td>
                                                                                                                            <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor; ?>"  valign="middle"><span class="refj_<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $invoice_period; ?></span></td>
                                                                                                                            </tr>
                                                                                                                            <?php
                                                                                                                            $toggle_id = viewOrders($id);
                                                                                                                            $ord_id = $toggle_id[0]['order_id'];
                                                                                                                            ?>           
                                                                                                                        <tr class="toggle test_<?php echo $ord_id; ?>" style="display:none;">
                                                                                                                            <td colspan="5" align="center">                      
                                                                                                                                <table width="755" align="center" cellspacing="0" cellpadding="0" style="margin:10px 0px; padding: 10px; border: 2px solid #F99B3E;">
                                                                                                                                    <?php
                                                                                                                                    $sql_id = mysql_query("SELECT id,order_id,created_date,order_number,customer_name,customer_company,staff_id,cash_customer FROM sohorepro_order_master WHERE id = '" . $ord_id . "'");
                                                                                                                                    $object = mysql_fetch_assoc($sql_id);
                                                                                                                                    
                                                                                                                                    $allOrderId = '';
                                                                                                                                    $orderidQry = mysql_query("SELECT order_number FROM sohorepro_order_master WHERE order_id = '" . $order_id . "'");
                                                                                                                                    while ($newOrder = mysql_fetch_assoc($orderidQry)):
                                                                                                                                        $allOrderId[] = $newOrder['order_number'];
                                                                                                                                    endwhile;
                                                                                                                                    
                                                                                                                                    $allOrderId = implode(",", $allOrderId);
                                                                                                                                    
                                                                                                                                    $Order_id = $object['order_id'];
                                                                                                                                    $ref_serial = $object['id'];
                                                                                                                                    $Order_number = $object['order_number'];
                                                                                                                                    $cust_dtls = customerName($object['customer_name']);
                                                                                                                                    $staf_init = CusInit($object['staff_id']);
                                                                                                                                    $company_name = companyName($cust_dtls[0]['cus_compname']);
                                                                                                                                    $cus_name = $cust_dtls[0]['cus_contact_name'];
                                                                                                                                    $cash_customer = $object['cash_customer'];

                                                                                                                                    $cus_add_1 = ($cust_dtls[0]['cus_bill_address1'] != '') ? $cust_dtls[0]['cus_bill_address1'] : '';
                                                                                                                                    $cus_add_2 = ($cust_dtls[0]['cus_bill_address2'] != '') ? $cust_dtls[0]['cus_bill_address2'] : '';
                                                                                                                                    $cus_city = ($cust_dtls[0]['cus_bill_city'] != '') ? $cust_dtls[0]['cus_bill_city'] . ',&nbsp;' : '';
                                                                                                                                    $cus_state = (StateName($cust_dtls[0]['cus_bill_state']) != '') ? StateName($cust_dtls[0]['cus_bill_state']) . '&nbsp;' : '';
                                                                                                                                    $cus_zip = ($cust_dtls[0]['cus_bill_zipcode'] != '0') ? $cust_dtls[0]['cus_bill_zipcode'] : '';
                                                                                                                                    $cus_mail = ($cust_dtls[0]['cus_email'] != '') ? $cust_dtls[0]['cus_email'] : '';
                                                                                                                                    $cus_phone = ($cust_dtls[0]['cus_contact_phone'] != '') ? $cust_dtls[0]['cus_contact_phone'] : '';

                                                                                                                                    $current_timne = $object['created_date'];
                                                                                                                                    $dateF = new DateTime($current_timne, new DateTimeZone('America/New_York'));
                                                                                                                                    date_default_timezone_set('America/New_York');
                                                                                                                                    $temp_time1 = date("Y-m-d h:iA", $dateF->format('U'));
                                                                                                                                    $Date = date("m/d/Y", strtotime($object['created_date'])) . ' ' . date("h:iA", strtotime("-0 minutes", strtotime($temp_time1)));
                                                                                                                                    ?>
                                                                                                                                    <tr>
                                                                                                                                        <td>
                                                                                                                                            <table width="755" border="0" align="center" cellspacing="0" cellpadding="0" >
                                                                                                                                                <tr align="left">
                                                                                                                                                    <td width="35%">
                                                                                                                                                        <table align="center" cellspacing="0" cellpadding="0" >
                                                                                                                                                            <tr> 
                                                                                                                                                            <span class="jass2" id="<?php echo $id; ?>" style="display: none;"></span>
                                                                                                                                                            <?php
                                                                                                                                                            $Order_id_trim = trim($Order_id);
                                                                                                                                                            $inline_edit_ref = ($Order_id_trim != '') ? $Order_id : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                                                                                                            ?>
                                                                                                                                                            <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">Job Ref</td>   
                                                                                                                                                            <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">:</td>   
                                                                                                                                                            <td align="left" valign="middle" style="color:#202020;"><span class="reference ref_<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $inline_edit_ref; ?></span>
                                                                                                                                                                <div style="float: left;"><input type="text" class="inline-text-prod-ref reference_txt_<?php echo $id; ?>" id="reference_txt_<?php echo $id; ?>" value="<?php echo $inline_edit_ref; ?>" style="display: none; text-transform: uppercase;width: 70px;"></div>
                                                                                                                                                                <div style="float: left; margin-left: 5px;"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="refupdate ref_update_<?php echo $id; ?>" style="display: none; cursor: pointer;"/></div>
                                                                                                                                                                <div style="float: left; margin-left: 5px;"><img src="images/cancel_icon.png"  alt="Cancel" title="Cancel" width="22" height="22" class="refcancel ref_cancel_<?php echo $id; ?>" style="display: none; cursor: pointer;"/></div></td>
                                                                                                                                                </tr>

                                                                                                                                                <tr>                            
                                                                                                                                                    <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">Order Number</td>                            
                                                                                                                                                    <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">:</td>
                                                                                                                                                    <td align="left" valign="middle" style="color:#202020;"><?php echo $Order_number; ?></td>
                                                                                                                                                </tr>

                                                                                                                                                <tr>
                                                                                                                                                    <td align="left"  valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">Date/Time</td>                            
                                                                                                                                                    <td align="left" valign="middle" style="font-size:14px; color:#ff9600; text-transform:uppercase;">:</td>
                                                                                                                                                    <td  align="left" valign="middle" style="color:#202020;"><?php echo $Date; ?></td>
                                                                                                                                                </tr>                            
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                        <td width="30%" align="center">
                                                                <!--                                                                        <span style="cursor: pointer;background: #F99B3E;color: #FFF;float: left;padding: 5px 20px;margin-top: 5px;border-radius: 5px;text-decoration: none;margin-right: 15px;margin-left: 5px;" onclick="return change_customer('<?php// echo $object['id']; ?>');">
                                                                                                                                                CHANGE COMPANY
                                                                                                                                        </span>-->
                                                                                                                                        </td>
                                                                                                                                        <td width="35%">
                                                                                                                                            <span style="font-size:14px; color:#ff9600; text-transform:uppercase;">Order placed by:</span>
                                                                                                                                            <table align="center" cellspacing="0" cellpadding="0" >
                                                                                                                                                <tr> 
                                                                                                                                                    <td><?php echo $cus_name; ?></td>
                                                                                                                                                </tr>                            
                                                                                                                                                <tr> 
                                                                                                                                                    <td><?php echo $cus_phone; ?></td>
                                                                                                                                                </tr>                            
                                                                                                                                                <tr> 
                                                                                                                                                    <td><?php echo $cus_mail; ?></td>
                                                                                                                                                </tr>                           
                                                                                                                                            </table>

                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </table>  
                                                                                                                            </td>

                                                                                                                        </tr>

                                                                                                                        <tr><td align="left" valign="top" style="padding-top:10px">
                                                                                                                                <div id="inline_edit">                                        
                                                                                                                                    <table width="735" align="center" cellspacing="0" cellpadding="0" border="0">
                                                                                                                                        <tr style="color:#fff;">                               
                                                                                                                                            <td colspan="2" width="285" align="left" valign="middle" bgcolor="#f68210" class="brdr pad_lft">Product Detail</td>
                                                                                                                                            <td width="50" align="center" valign="middle" bgcolor="#f68210"  class="brdr">Quantity</td>
                                                                                                                                            <td width="75" align="center" valign="middle" bgcolor="#f68210"  class="brdr pad_rght">Unit Cost</td>
                                                                                                                                            <td width="85" align="center" valign="middle" bgcolor="#f68210" class="brdr pad_rght">Line Cost</td>                                
                                                                <!--                                                                            <td width="15" align="center" valign="middle" bgcolor="#f68210"  class="brdr pad_rght">Action</td>-->
                                                                                                                                        </tr>
                                                                                                                                        <?php
                                                                                                                                        $view_orders = viewOrders($id);
                                                                                                                                        $j = 1;
                                                                                                                                        foreach ($view_orders as $ord) {
                                                                                                                                            $rowColor = ($j % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                                                                                                            $rowColor1 = ($j % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                                                                                                            $prod_id = $ord['product_id'];
                                                                                                                                            $id = $ord['id'];
                                                                                                                                            $ord_id_t = $ord['order_id'];
                                                                                                                                            $ship_id = $ord['shipping_add_id'];
                                                                                                                                            $super_id = getsuper($ord['product_id']);
                                                                                                                                            $cat_id = getcat($ord['product_id']);
                                                                                                                                            $sub_id = getsub($ord['product_id']);
                                                                                                                                            $super_name = (getsuperN($super_id) != '') ? getsuperN($super_id) : '';
                                                                                                                                            $cat_name_pre = (getcatN($cat_id) != '') ? getcatN($cat_id) : '';
                                                                                                                                            $cat_name = ($cat_name_pre != '') ? '>>' . $cat_name_pre : $cat_name_pre;
                                                                                                                                            $sub_name_pre = (getsubN($sub_id) != '') ? getsubN($sub_id) : '';
                                                                                                                                            $sub_name = ($sub_name != '') ? '>>' . $sub_name_pre : $sub_name_pre;
                                                                                                                                            ?>
                                                                                                                                            <tr class="inline" id="<?php echo $id; ?>" >
                                                                                                                                            <span class="jass" id="<?php echo $id; ?>" style="display: none;"></span>
                                                                                                                                            <span class="order_id_t_<?php echo $id; ?>" id="<?php echo $ord_id_t; ?>" style="display: none;"></span>
                                                                                                                                            <input type="text" id="h_<?php echo $id; ?>_<?php echo $ord_id; ?>" style="display: none;" value="<?php echo getpid($prod_id, $ord_id); ?>" />                                
                                                                                                                                            <td colspan="2" width="285" align="left" valign="middle" bgcolor="<?php echo $rowColor1; ?>" class="brdr pad_lft">
                                                                                                                                                <span class="product_<?php echo $id; ?>_<?php echo $ord_id; ?>"><?php echo $ord['product_name']; ?></span><input type="text" class="inline-text-prod product_txt_<?php echo $id; ?>_<?php echo $ord_id; ?>" id="product_txt_<?php echo $id; ?>_<?php echo $ord_id; ?>" value="<?php echo str_replace('"', "''", $ord['product_name']); ?>" style="display: none;" /></br>
                                                                                                                                                <span class="trail" style="font-size: 11px;color: #2a9be3;"><?php echo $super_name . $cat_name . $sub_name; ?></span>
                                                                                                                                            </td>
                                                                                                                                            <td width="50" align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>"  class="brdr"><span class="quantity_<?php echo $id; ?>_<?php echo $ord_id; ?>"><?php echo $ord['product_quantity']; ?></span><input type="text" class="inline-text quantity_txt_<?php echo $id; ?>_<?php echo $ord_id; ?>" id="quantity_txt_<?php echo $id; ?>_<?php echo $ord_id; ?>" value="<?php echo $ord['product_quantity']; ?>" style="display: none;"/></td>
                                                                                                                                            <td width="75" align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>"  class="brdr pad_rght"><span class="price_<?php echo $id; ?>_<?php echo $ord_id; ?>"><?php echo '$' . $ord['product_price']; ?></span><input type="text" class="inline-text price_txt_<?php echo $id; ?>_<?php echo $ord_id; ?>" id="price_txt_<?php echo $id; ?>_<?php echo $ord_id; ?>" value="<?php echo $ord['product_price']; ?>" style="display: none;"/></td>                                
                                                                                                                                            <td width="85" align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>" class="brdr pad_rght"><span class="line_cost_<?php echo $id; ?>_<?php echo $ord_id; ?>"><?php echo '$' . number_format(($ord['product_quantity'] * $ord['product_price']), 2, '.', ''); ?></span></td>                                                                                                
                                                                                                                                            <?php /*<td width="15" align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>"  class="brdr pad_rght"><img src="images/like_icon.png"  alt="Update" title="Update" width="22" height="22" class="mar_lft updater update_<?php echo $id; ?>_<?php echo $ord_id; ?>" onclick="return update_dedails('<?php echo $id; ?>', '<?php echo $ord_id; ?>');"  style="display: none; margin-left: 0px;"/><a href="supply_closed_order.php?delete_id=<?php echo $id; ?>&ord_id=<?php echo $ref_serial; ?>" onclick="return confirm('Are you delete this product of this order?');"><img src="images/del.png" class="delete_<?php echo $id; ?>_<?php echo $ord_id; ?>"  alt="Delete Product" title="Delete Product" width="22" height="22" class="mar_lft"/></a></td> */?>
                                                                                                                                            </tr> 


                                                                                                                                            <?php
                                                                                                                                            $j++;
                                                                                                                                        }
                                                                                                                                        ?> 
                                                                                                                                        <!-- Add Product  Button Start -->
                                                                <!--                                                                        <tr> 
                                                                                                                                            <td colspan="5" style="padding-top: 5px;"><a class="add_pro" href="aptor.php?ord_id=<?php //echo $ref_serial; ?>&ship_id=<?php echo $ship_id ?>" style="cursor: pointer;"><b>+</b>Add Products</a></td> 
                                                                                                                                        </tr>                            -->
                                                                                                                                        <!-- Add Product  Button End -->
                                                                                                                                        <!---TAX START-->
                                                                                                                                        <tr>
                                                                                                                                            <td height="35" colspan="6" align="center">
                                                                                                                                                <div class="error" style="color:#FF0000;padding-left:35px;font-size: 12px;"></div>
                                                                                                                                                <div class="msg" style="color:#007F2A; font-size: 13px;"></div>
                                                                                                                                            </td>

                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <!-- Comments Table Start -->
                                                                                                                                            <?php
                                                                                                                                            $comment = OrderComment($ref_serial);
                                                                                                                                            ?>
                                                                                                                                            <td colspan="3" valign="top">
                                                                <!--                                                                                <table style="width: 100%;">
                                                                                                                                                    <tr>
                                                                                                                                                        <td class="add_cmmt">
                                                                                                                                                            Customer Comment
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                    <tr>
                                                                                                                                                        <td>
                                                                                                                                                            <table style="padding: 10px;border: 2px solid #F99B3E;width: 100%;height: 75px;" align="center" cellspacing="0" cellpadding="0" >
                                                                                                                                                                <tr onclick="return edit_commt('<?php echo $customer_id; ?>', '<?php echo $Order_id; ?>');">
                                                                                                                                                                    <td>
                                                                                                                                                                        <span id="cus_commt_span_<?php echo $customer_id; ?>" class="cus_commt_span_<?php echo $customer_id; ?>_<?php echo $Order_id; ?>"><?php echo $comment[0]['order_comment']; ?></span>
                                                                                                                                                                        <textarea name="cus_commt_txt_<?php echo $customer_id; ?>_<?php echo $Order_id; ?>" id="cus_commt_txt_<?php echo $customer_id; ?>_<?php echo $Order_id; ?>"  class="cus_commt_txt_<?php echo $customer_id; ?>_<?php echo $Order_id; ?>" autofocus="autofocus" style="width: 96%;padding: 5px;height: 35px;display: none;"><?php echo $comment[0]['comment']; ?></textarea>
                                                                                                                                                                    </td>
                                                                                                                                                                </tr>
                                                                                                                                                                <tr align="right">
                                                                                                                                                                    <td>
                                                                                                                                                                        <input style="display: none;" id="cus_commt_upt_<?php echo $customer_id; ?>_<?php echo $Order_id; ?>"  class="cus_commt_upt_<?php echo $customer_id; ?>_<?php echo $Order_id; ?>" type="button" name="update_commt" id="cus_commt_upt_<?php echo $customer_id; ?>" value="Update" onclick="return update_commt('<?php echo $customer_id; ?>','<?php echo $Order_id; ?>')" />
                                                                                                                                                                    </td>
                                                                                                                                                                </tr>
                                                                                                                                                            </table>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </table>                                    -->
                                                                                                                                            </td>                    
                                                                                                                                            <!-- Comments Table End -->
                                                                                                                                            <td>&nbsp;</td>
                                                                                                                                            <td height="20" align="right" valign="top">

                                                                                                                                                <table align="right" width="240" border="0" cellspacing="0" cellpadding="0">
                                                                                                                                                    <tr>
                                                                                                                                                        <td height="30" align="left" valign="middle" class="pad_lft_j brdr1">Sub Total</td>
                                                                                                                                                        <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1  brdr-lft_j"><span class="line_<?php echo $ord_id; ?>" ><?php echo '$' . number_format($price[0]['sub_total'], 2, '.', ''); ?></span></td>
                                                                                                                                                        <td>&nbsp;</td>
                                                                                                                                                    </tr>
                                                                                                                                                    <tr>
                                                                                                                                                        <td height="30" align="left" valign="middle" class="pad_lft_j brdr1 brdr-top_j">Tax</td>
                                                                                                                                                        <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1 brdr-top_j brdr-lft_j"><span class="tax_<?php echo $ord_id; ?>"><?php echo '$' . number_format($tax, 2, '.', ''); ?></span></td>
                                                                                                                                                        <td><?php if ($tax_status == '1') { ?><a href="supply_closed_order.php?tax_status=<?php echo $ord_id; ?>" onclick="return confirm('Are you remove the tax in this order?');"><img src="images/del.png"  alt="Remove Tax" title="Remove Tax" width="22" height="22" class="mar_lft"/></a><?php } ?></td>
                                                                                                                                                    </tr>
                                                                                                                                                    <tr>
                                                                                                                                                        <td height="30" align="left" valign="middle" class="pad_lft_j brdr1 brdr-top">Total</td>
                                                                                                                                                        <td width="100" height="30" align="right" valign="middle" bgcolor="#FAFAFA" class="pad_rght_j brdr1 brdr-top_j brdr-lft_j"><span class="lineJassim_<?php echo $ord_id; ?>"><?php echo '$' . number_format(($price[0]['sub_total'] + $tax), 2, '.', ''); ?></span></td>
                                                                                                                                                        <td>&nbsp;</td>
                                                                                                                                                    </tr>
                                                                                                                                                </table>
                                                                                                                                            </td> 
                                                                                                                                            <td>&nbsp;</td>
                                                                                                                                        </tr>
                                                                                                                                        <!---TAX START-->
                                                                                                                                        <tr>
                                                                <!--                                                                            <td colspan="6">
                                                                                                                                                <div style="width:100%;float:left;">
                                                                                                                                                <span style="cursor: pointer;background: #F99B3E;color: #FFF;float: left;padding: 5px 20px;margin-top: 5px;border-radius: 5px;" onclick="return send_mail_update_order('<?php echo $ref_serial; ?>', '<?php echo $ship_id; ?>');">Email Updated Order</span>
                                                                                                                                                <span class="confirm_mail_<?php echo $ref_serial; ?> none" id="mail_to_<?php echo $ref_serial; ?>" style="float: left;margin-top: 10px;margin-left: 10px;color: #029F5A;"><a href="" class="mail_to_<?php echo $ref_serial; ?>" >Go to Email Application</a></span>
                                                                                                                                                <span class="confirm_mail_<?php echo $ref_serial; ?> none" id="confirm_mail_<?php echo $ref_serial; ?>" style="float: left;margin-top: 10px;margin-left: 10px;color: #029F5A;">New order email sent..</span>

                                                                                                                                                <a class="fancybox fancybox.iframe fav_button" href="view_sets.php?order_id=<?php echo $ref_serial; ?>" style="cursor: pointer;background: #F99B3E;color: #FFF;float: left;padding: 5px 20px;margin-top: 5px;border-radius: 5px;text-decoration: none;margin-right: 15px;margin-left:5px;">View Sets</a>                                    

                                                                                                                                                <span onclick="return open_invoice_type('<?php echo $ref_serial; ?>');" style="cursor: pointer;background: #F99B3E;color: #FFF;float: right;padding: 5px 20px;margin-top: 5px;border-radius: 5px;text-decoration: none;margin-right: 15px;margin-left:5px;margin-bottom: 15px;">Close Order</span>
                                                                                                                                                <?php 
                                                                                                                                                $close_lable    = ($order_close_status == '1') ? 'Ready to Invoice' : 'Close Order';
                                                                                                                                                $close_lable_bg = ($order_close_status == '1') ? 'background: #DA4530;' : 'background: #F99B3E;';                                                                                
                                                                                                                                                ?>
                                                                                                                                                <span id="close_status_<?php echo $ref_serial; ?>" onclick="return close_order_now('<?php echo $ref_serial; ?>');" style="<?php echo $close_lable_bg; ?>;cursor: pointer;color: #FFF;float: right;padding: 5px 20px;margin-top: 5px;border-radius: 5px;text-decoration: none;margin-right: 15px;margin-left:5px;margin-bottom: 15px;font-weight: bold;"><?php echo $close_lable; ?></span>


                                                                                                                                                </div>

                                                                                                                                                <div id="invoice_section_<?php echo $ref_serial; ?>" onchange="return gererate_invoice('<?php echo $ref_serial; ?>','<?php echo $order['customer_company'] ?>');" style="float: right;margin-right: 30px;margin-top: -10px;display:none;">
                                                                                                                                                    <select name="invoice_freq" class="invoice_freq_type" id="invoice_freq_<?php echo $ref_serial; ?>">
                                                                                                                                                        <option value="0">Select Type</option>
                                                                                                                                                        <option value="week">Weekly</option>
                                                                                                                                                        <option value="semi">Semi-Weekly</option>
                                                                                                                                                        <option value="month">Monthly</option>
                                                                                                                                                    </select>                                                                                           
                                                                                                                                                </div>                                                                                
                                                                                                                                            </td>                                                                            -->
                                                                                                                                        </tr>
                                                                                                                                    </table>
                                                                                                                                </div>  
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </table>                        
                                                                                                                </td>
                                                                                                            </tr>  

                                                                                                            <?php
                                                                                                            $i++;
                                                                                                        }
                                                                                                    } else {
                                                                                                        ?>
                                                                                                        <tr  bgcolor="<?php echo $rowColor; ?>">
                                                                                                            <td colspan="4" align="center">There is no orders</td>
                                                                                                        </tr>              
                                                                                                    <?php } ?>

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