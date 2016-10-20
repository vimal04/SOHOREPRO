<?php
include './config.php';
include './auth.php';
$Email = getEmail();

if ($_REQUEST['new_mail'] == '1') {
    extract($_POST);
    $sql = "INSERT INTO sohorepro_email
			SET     name = '" . $name . "',
                                email_id = '" . $email . "',
				status = '" . $status . "' ";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success";
    } else {
        $result = "failure";
    }
}

if ($_GET['delete_id']) {

    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM sohorepro_email WHERE id = " . $delete_id . " ";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_del";
    } else {
        $result = "failure_del";
    }
}

//Delete Start
if ($_GET['delete_staff_id']) {

    $delete_id = $_GET['delete_staff_id'];
    $sql = "DELETE FROM sohorepro_users WHERE id = " . $delete_id . " ";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_del";
    } else {
        $result = "failure_del";
    }
}
//Delete End

if ($_GET['status_id']) {

    $change_status = ($_GET['change_id'] == 1) ? '0' : '1';
    $status_id = $_GET['status_id'];
    $sql = "UPDATE sohorepro_email
			SET     status     = '" . $change_status . "' WHERE id= '" . $status_id . "'";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_status";
    } else {
        $result = "failure_status";
    }
}

//Status Change Start
if ($_GET['status_id_staff']) {

    $change_status = ($_GET['change_id'] == 1) ? '0' : '1';
    $status_id = $_GET['status_id'];
    $sql = "UPDATE sohorepro_users
			SET     status     = '" . $change_status . "' WHERE id= '" . $status_id . "'";

    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success_status";
    } else {
        $result = "failure_status";
    }
}
//Status Change End

$sql_order_sequence = mysql_query("SELECT id,order_sequence FROM sohorepro_order_master ORDER BY id DESC LIMIT 1");
$object_order_sequence = mysql_fetch_assoc($sql_order_sequence);
$sequence_id = $object_order_sequence['id'];
$sequence = $object_order_sequence['order_sequence'];


$sql_tax_rate = mysql_query("SELECT tax_rate FROM sohorepro_tax_rate");
$object_tax_rate = mysql_fetch_assoc($sql_tax_rate);
$tax_rate = $object_tax_rate['tax_rate'];
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Soho-repro</title>
        <link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>

        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="js/jquery.fancybox.css?v=2.1.5" media="screen" />

        <link rel="stylesheet" href="../js/jquery-ui.css" />
        <script src="../js/jquery-ui_service.js"></script>
        
        <style>
            .error_clas{
                border: 1px solid #F00;
            }
        </style>
        
        <script type="text/javascript">
            $(document).ready(function() {
                /**  Simple image gallery. Uses default settings*/
                $('.fancybox').fancybox();

                /**  Different effects */
            });
            
            $(function() {
            var all_exist_date       = $("#all_exist_date").val();
            var split_element        = all_exist_date.split(","); 
            var disabledSpecificDays = [split_element[0],split_element[1],split_element[2],split_element[3],split_element[4],split_element[5],split_element[6],split_element[7],split_element[8],split_element[8],split_element[9],split_element[10],split_element[11],split_element[12],split_element[13],split_element[14],split_element[15],split_element[16],split_element[17],split_element[18],split_element[19]];
            
            function disableSpecificDaysAndWeekends(date) {
            var m = date.getMonth();
            var d = date.getDate();
            var y = date.getFullYear();

            for (var i = 0; i < disabledSpecificDays.length; i++) {
            if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays) != -1 ) {
            return [false];
            }
            }

            var noWeekend = $.datepicker.noWeekends(date);
            return !noWeekend[0] ? noWeekend : [true];
            }
            $( "#date_off" ).datepicker({minDate: 0,
            dateFormat: 'm/d/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends});
            });
            
            function set_off_days()
            {
               var date_off = $("#date_off").val();
               if(date_off != ''){                   
                    $.ajax
                    ({
                        type: "POST",
                        url: "days_off_set.php",
                        data: "off_day_insert=" + date_off,
                        beforeSend: loadStart,
                        complete: loadStop,
                        success: function(option)
                            {
                                if(option != ''){
                                 var all_offdate_list = option.split("~"); 
                                 $('#days_off_succ').html(all_offdate_list[0]);
                                 $('#view_days_off').html(all_offdate_list[1]);
                                 $('#insert_days_off').html(all_offdate_list[2]);
                                 $('#days_off_succ').fadeOut(1000);
                                }else{
                                    alert("That date already set;");
                                }
                            }
                        });               
               }else{
                   alert('Select the date.');
                   $("#date_off").focus();
               }
            }
            
            function off_days_delete(ID)
            {
                var ok_to_proceed = confirm('Are you sure?');
                if(ok_to_proceed == true){
                $.ajax
                    ({
                        type: "POST",
                        url: "days_off_delete.php",
                        data: "off_day_delete_id=" + ID,
                        beforeSend: loadStart,
                        complete: loadStop,
                        success: function(option)
                            {
                                if(option != ''){
                                 var all_offdate_list = option.split("~"); 
                                 $('#days_off_succ').html(all_offdate_list[0]);
                                 $('#view_days_off').html(all_offdate_list[1]);
                                 $('#insert_days_off').html(all_offdate_list[2]);
                                 $('#days_off_succ').fadeOut(1000);
                                }else{
                                    alert("That date already set;");
                                }
                            }
                        }); 
                }else{
                    return false;
                }
            }
            
            function for_staff()
            {
                var type_set = $("#type_set").val();
                if(type_set == '2'){
                    $("#for_staff").fadeIn();
                }else{
                    $("#for_staff").fadeOut();
                }
            }
            
            
            function save_user_admin()
            {
                var user_name_set   = $("#user_name_set").val();
                var mail_id_set     = $("#mail_id_set").val();
                var type_set        = $("#type_set").val();
                var password_set    = $("#password_set").val();
                var ini_set         = $("#ini_set").val();
                var status_set      = $("#status_set").val();
                
                if(user_name_set == ''){
                    $("#user_name_set").addClass('error_clas')
                    $("#user_name_set").focus();
                    return flase;
                }else{
                    $("#user_name_set").removeClass('error_clas');
                    
                }
                
                if(mail_id_set == ''){
                    $("#mail_id_set").addClass('error_clas')
                    $("#mail_id_set").focus();
                    return flase;
                }else{
                    $("#mail_id_set").removeClass('error_clas');
                   
                }
                
                var atpos   =   mail_id_set.indexOf("@");
                var dotpos  =   mail_id_set.lastIndexOf(".");
                if (atpos<1 || dotpos<atpos+2 || dotpos+2>=mail_id_set.length)
                {
                    $("#mail_id_set").addClass('error_clas')
                    $("#mail_id_set").focus();
                    return flase;
                }else{
                    $("#mail_id_set").removeClass('error_clas');
                  
                }
                if(type_set == '2'){
                    
                    if(password_set == ''){
                        $("#password_set").addClass('error_clas')
                        $("#password_set").focus();
                        return flase;
                    }else{
                        $("#password_set").removeClass('error_clas');
                       
                    }
                    
                    if(ini_set == ''){
                        $("#ini_set").addClass('error_clas')
                        $("#ini_set").focus();
                        return flase;
                    }else{
                        $("#ini_set").removeClass('error_clas');
                       
                    }
                    
                }
                if(mail_id_set != ''){
                $.ajax
                    ({
                        type: "POST",
                        url: "get_child.php",
                        data: "admin_users=1&user_name_set="+user_name_set+"&mail_id_set="+mail_id_set+"&type_set="+type_set+"&password_set="+password_set+"&ini_set="+ini_set+"&status_set="+status_set,
                        beforeSend: loadStart,
                        complete: loadStop,
                        success: function(option)
                            {
                               // alert(option);
                                if(option == true){
                                    window.location = "email_settings.php?val=A"; 
                                }else{
                                    window.location = "email_settings.php?val=S"; 
                                }
                                
                            }
                        }); 
                }
            }
        </script>
        <!--End -->
        <style>
            .pointer{
                cursor: pointer;
            }
            .none{
                display: none;
            }
            .picker_icon{
            background : #FFFFFF url(../images/datepicker-20.png) no-repeat 4px 4px;
            padding: 5px 5px 5px 25px;
            height:18px;
            cursor: pointer;
            }
            .services_items{
                float: left;
                width: 99.5%;
                border: 2px solid #f99b3e;
            }
            #supply_setting{
                width:90%;
                float: left;
                margin: 10px 0px 5px 30px;               
            }
            #supply_curve{
                width:28%;
                background-color: #EEEEEE;
                float: left;
                margin-left: 10px;
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 5px;
            }
            #supply_check{
                float:right;
                border: 1px solid #7E7E7E;
                width: 14px;
                height: 14px;
                border-radius: 3px;
            }
            #supply_check_inside{
                float: left;
                width: 12px;
                height: 12px;
                border-radius: 2px;
                cursor: pointer;               
                border: 1px solid #FFF;
                transition: background-color 0.6s ease;
            }
            #supply_check_inside:hover{
                background-color: #34A853;
            }
            
            #service_inner{
                width:90%;
                float: left;
                margin: 10px 0px 5px 30px;
            }
            #service_curve{
                width:45%;
                background-color: #EEEEEE;
                float: left;
                margin-left: 10px;
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 5px;
            }
            #service_check{
                float:left;
                border: 1px solid #7E7E7E;
                width: 14px;
                height: 14px;
                border-radius: 3px;
                margin-right: 10px;
            }
            #service_check_inside{
                float: left;
                width: 12px;
                height: 12px;
                border-radius: 2px;
                cursor: pointer;               
                border: 1px solid #FFF;
                transition: background-color 0.6s ease;
            }
/*            #service_check_inside:hover{
                background-color: #34A853;
            } */
            .active_settings{
                background-color: #34A853;
            }
            .mask{
                position: absolute;
                width: 42%;
                float: left;
                background-color: rgba(157, 157, 157, .8);
                -webkit-transition: background-color 1000ms linear;
                -moz-transition: background-color 1000ms linear;
                -o-transition: background-color 500ms linear;
                -ms-transition: background-color 1000ms linear;
                transition: background-color 1000ms linear;
                height: 238px;
                margin-top: 10px;
                z-index: 1;                
                margin-left: 38px;
                border-radius: 5px;
            }  
            .cursor{
                cursor: pointer;
            }
            .textbox{border:1px solid #aeaeae; width:100px; height:30px; float:left; background:#fff; -webkit-border-radius: 5px}
            .textbox_initals{border:1px solid #aeaeae; width:35px; height:30px; text-transform: uppercase; float:left; background:#fff; -webkit-border-radius: 5px}
            .select_text_box{ border:1px solid #aeaeae; width:100px; height:30px; float:left; background:#fff; -webkit-border-radius: 5px;}
        </style>
    </head>

    <body>
        <div id="loading" class="none"  style="position: fixed;top: 35%;left: 48%;padding: 5px;z-index: 10;">
            <img src="images/login_loader.gif" border="0" />
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" valign="top">
                    <table width="960" border="0" cellspacing="0" cellpadding="0" style="min-width:760px;">
                        <tr>
                            <td width="198" align="left" valign="top" bgcolor="#464646"><table width="198" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="185" align="left" valign="top"><img src="images/logo.jpg" width="198" height="181"  alt=""/></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <?php include "sidebar_menu.php"; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="middle" style="height:280px; float:left;"></td>
                                    </tr>
                                </table></td>
                            <td width="3" align="left" valign="top" bgcolor="#FFFFFF"></td>
                            <td width="759" align="left" valign="top" bgcolor="#FFFFFF"><table width="759" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="48" align="center" valign="middle" bgcolor="#5f5f5f" class="heading">
                                            ADMINISTRATOR PAGE
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="38" align="center" valign="middle" bgcolor="#8b8b8b" class="sub_heading">
                                            SETTINGS
                                            <span style="float: right;padding-right: 5px;">Welcome <?php
                                                if ($_SESSION['admin_user_type'] == '1') {
                                                    echo 'admin';
                                                } if ($_SESSION['admin_user_type'] == '2') {
                                                    echo 'Staff User';
                                                }
                                                ?> |<a href="logout.php" style="text-decoration:none;color:#fff;">&nbsp;Logout</a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="14" align="left" valign="middle"></td>
                                    </tr>                                    
                                    <tr>
                                        <td align="right" valign="top">
                                            <table width="759" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td height="38" align="left" valign="middle" class="add_title">Add email id's</td>
                                                </tr>
                                                <tr>
                                                    <td height="60" align="right" valign="top" bgcolor="#f6f6f6" class="form_bg">
                                                        <form name="new_email" id="new_subcategory" method="post" action=""  onsubmit="return validate();" >

                                                            <input type="hidden" name="new_mail" value="1" />  
                                                            <input type="hidden" name="mail_temp" id="mail_temp" value="0" />  
                                                            <table width="759" border="0" cellspacing="0" cellpadding="0">
<!--                                                                <tr>
                                                                    <td width="125" height="60" align="right" style="font-size:12px;" valign="middle">Enter Name</td>
                                                                    <td width="160" height="60" align="right" valign="middle"><input type="text" autocomplete="off" name="name" id="name" class="input_text" ></td>
                                                                    <td width="172" height="60" align="left" valign="middle"><input type="text" autocomplete="off" name="email" id="email" value="Enter email id" onfocus="if (this.value == 'Enter email id') {
                                                                                this.value = '';
                                                                            }" onblur="if (this.value == '') {
                                                                                        this.value = 'Enter email id';
                                                                                    }" class="input_text" ></td>
                                                                    <td width="60" height="60" align="right" style="font-size:12px;" valign="middle">Status&nbsp;</td>
                                                                    <td width="20" height="60" align="left" valign="middle"><input type="radio" name="status" value="1" checked="checked" ></td>
                                                                    <td width="50" height="60" align="left" style="font-size:12px;" valign="middle">Active</td>
                                                                    <td width="20" height="60" align="left"  valign="middle"><input type="radio" name="status" value="0"  ></td>
                                                                    <td width="70" height="60" align="left" style="font-size:12px;" valign="middle">InActive</td>
                                                                    <td width="90" height="60" align="left" valign="middle"><input type="submit" value="" id="submit" class="add_btn"></td>
                                                                </tr>                                                                 -->
                                                                <tr>
                                                                    <td style="font-size:12px;width: 100%;" valign="middle">
                                                                        <div style="float: left;width: 100%;margin-top: 10px;margin-left: 10px;">
                                                                            <div style="float: left;width: 16%;margin-right: 5px;">
                                                                                <label style="width: 100%;float: left;color: #5f5f5f;font-weight: bold;">User Name:</label>
                                                                                <input style="width: 90%;" class="textbox" type="text" name="user_name_set" id="user_name_set" />
                                                                            </div>
                                                                            <div style="float: left;width: 16%;">
                                                                                <label style="width: 100%;float: left;color: #5f5f5f;font-weight: bold;">Mail ID:</label>
                                                                                <input style="width: 90%;" class="textbox" type="text" name="mail_id_set" id="mail_id_set" />
                                                                            </div>
                                                                            <div style="float: left;width: 15%;">
                                                                                <label style="width: 100%;float: left;color: #5f5f5f;font-weight: bold;">Status:</label>
                                                                                <select name="status_set" id="status_set" class="select_text_box"> 
                                                                                    <option value="1">Active</option>
                                                                                    <option value="0">In-Active</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float: left;width: 15%;">
                                                                                <label style="width: 100%;float: left;color: #5f5f5f;font-weight: bold;">Type:</label>
                                                                                <select name="type_set" id="type_set" onchange="return for_staff();" class="select_text_box">                                                                                    
                                                                                    <option value="1">Admin</option>
                                                                                    <option value="2">Staff</option>
                                                                                </select>
                                                                            </div>
                                                                            <div id="for_staff" style="display: none;">
                                                                            <div style="float: left;width: 10%;">
                                                                                <label style="width: 100%;float: left;color: #5f5f5f;font-weight: bold;">Password:</label>
                                                                                <input style="width: 90%;" type="text" name="password_set" id="password_set" class="textbox" />
                                                                            </div>
                                                                            <div style="float: left;width: 10%;">
                                                                                <label style="width: 100%;float: left;color: #5f5f5f;font-weight: bold;">Initial:</label>
                                                                                <input style="width: 40%;text-transform: uppercase;" maxlength="3" class="textbox_initals" type="text" name="ini_set" id="ini_set" />
                                                                            </div>
                                                                            </div>
                                                                            <div style="float: left;width: 10%;margin-top: 10px;">
                                                                                <input type="button" value="" id="submit" class="add_btn" onclick="return save_user_admin();">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="9" height="38" style="color:#F00; text-align:center; padding-bottom:10px; font-size: 12px;">

                                                                        <?php
                                                                        if ($result == "success") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Email id inserted successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Email id insert not successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>       
                                                                            <?php
                                                                        }


                                                                        if ($_GET['val'] == "success") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Email id inserted successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Email id insert not successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>       
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($result == "success_del") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Deleted successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure_del") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Not deleted</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>       
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($result == "success_status") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Status change successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>
                                                                            <?php
                                                                        } elseif ($result == "failure_status") {
                                                                            ?>
                                                                            <div style="color:#F00; text-align:center; padding-bottom:10px;">Status change not successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>       
                                                                            <?php
                                                                        }
                                                                        
                                                                        if ($_GET['val'] == "S") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Staff user inserted successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>
                                                                            <?php
                                                                        } 
                                                                        if ($_GET['val'] == "A") {
                                                                            ?>
                                                                            <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Admin User inserted successfully</div>
                                                                            <script>setTimeout("location.href=\'email_settings.php\'", 2000);</script>
                                                                            <?php
                                                                        } 
                                                                        ?>                                                                            


                                                                        <div id="msg1" style="color:#FF0000;padding-left:12px;font-size: 12px;"></div>
                                                                        <div id="msg2" style="color:#FF0000;padding-left:12px;font-size: 12px;"></div>
                                                                        <div id="msg3" style="color:#FF0000;padding-left:12px;font-size: 12px;"></div>
                                                                        <div id="msg4" style="color:#FF0000;padding-left:12px;font-size: 12px;"></div>
                                                                        <span id="msg5" style="color:#FF0000;padding-left:12px;font-size: 12px;"></span>
                                                                        <span id="msg6" style="color:#007F2A;padding-left:12px;font-size: 12px;"></span>
                                                                        <span class="check" style="color:#FF0000;padding-left:12px;font-size: 12px; display: none;"  ></span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            <table width="759" border="0" cellspacing="0" cellpadding="0">

                                                <tr>
                                                    <td width="736" align="left" valign="middle" style="padding-left:20px;"> 

                                                    </td>
                                                    <td height="25" align="right" valign="middle">                                                        
                                                    </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">                                           

                                            <!-- Products Start -->
                                            <table width="759" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td class="add_title"  height="38" colspan="5">ADMIN USER</td>
                                                </tr>
                                                <tr>
                                                    <td width="20" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">S.no</td>
                                                    <td width="150" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">Name</td>
                                                    <td width="120" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">Email id</td>
                                                    <td width="40" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">status</td>
<!--                                                    <td width="40" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">Type</td>
                                                    <td width="40" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">Initial</td>-->
                                                    <td width="40" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">action</td>
                                                </tr>
                                                <?php
//                                                echo '<pre>';
//                                                print_r($Email);
//                                                echo '</pre>';
                                                
                                                $i = 1;
                                                if (count($Email) > 0) {
                                                    foreach ($Email as $Mail) {
                                                        $rowColor = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                        $rowColor1 = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                        $status = ($Mail['status'] == 1) ? 'active' : 'de-active';
                                                        $id = $Mail['id'];
                                                        ?>
                                                        <input type="hidden" name="status_current_id_<?php echo $id; ?>" id="status_current_id_<?php echo $id; ?>" value="<?php echo $Mail['status']; ?>" />
                                                        <input type="hidden" name="temp_acc_id" id="temp_acc_id" value="" />
                                                        
                                                        <tr onclick="return accordion_settings('<?php echo $id; ?>');" class="cursor">
                                                            <td width="49"  align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>" class="pad_btm"><?php echo $i; ?></td>
                                                            <td width="150" align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>" class="pad_btm"><?php echo $Mail['name']; ?></td>
                                                            <td width="60" align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>"  class="pad_btm"><?php echo $Mail['email_id']; ?></td>
                                                            <td width="60"  align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>" class="pad_btm"><img id="status_change_<?php echo $id; ?>" src="images/<?php echo $status; ?>.png" width="22" height="22" onclick="return change_status('<?php echo $id; ?>');"  alt="" style="cursor: pointer;"/></td>
                                                            <!--<td width="60"  align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>" class="pad_btm"><a href="email_settings.php?status_id=<?php echo $id; ?>&change_id=<?php echo $Mail['status']; ?>" onclick="return confirm('Are you sure?');"><img src="images/<?php echo $status; ?>.png" width="22" height="22"  alt=""/></a></td>-->
<!--                                                            <td align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>">Type</td>
                                                            <td align="center" valign="middle" bgcolor="<?php echo $rowColor1; ?>">Initial</td>-->
                                                            <td width="80"  align="center" valign="middle" bgcolor="<?php echo $rowColor; ?>" class="pad_btm">
                                                                <a class="fancybox fancybox.iframe" href="edit_email.php?id=<?php echo $id; ?>"><img src="images/edit.png"  alt="" width="22" height="22"/></a><a href="email_settings.php?delete_id=<?php echo $id; ?>" onclick="return confirm('Are you sure?');"><img src="images/del.png"  alt="" width="22" height="22" class="mar_lft"/></a>
                                                            </td>
                                                        </tr>
                                                        <tr >
                                                            <td colspan="5">
                                                                <div class="services_items none" id="service_<?php echo $id; ?>">
                                                                    
                                                                    <div class="mask_general" id="mask_content_<?php echo $id; ?>"></div>
                                                                    
                                                                    <div id="supply_setting">
                                                                        <div id="supply_curve">
                                                                            <label>SUPPLIES</label>
                                                                            <div id="service_check" onclick="return change_services_status('<?php echo $id; ?>','orders')">
                                                                                <div class="service_check_inside_<?php echo $id; ?>_orders <?php if($Mail['orders'] == '1'){ ?>active_settings<?php } ?>" id="service_check_inside"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="supply_curve">
                                                                            <label>ACCOUNTS</label>
                                                                            <div id="service_check" onclick="return change_services_status('<?php echo $id; ?>','accounts')">
                                                                                <div class="service_check_inside_<?php echo $id; ?>_accounts <?php if($Mail['accounts'] == '1'){ ?>active_settings<?php } ?>" id="service_check_inside"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="supply_curve" style="width: 29.5%;">
                                                                            <label>HELP BOX</label>
                                                                            <div id="service_check" onclick="return change_services_status('<?php echo $id; ?>','help')">
                                                                                <div class="service_check_inside_<?php echo $id; ?>_help <?php if($Mail['help'] == '1'){ ?>active_settings<?php } ?>" id="service_check_inside"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                    <div id="service_inner">
                                                                        <?php 
                                                                        $services_items = ServicesItems();    
                                                                        foreach ($services_items as $items){
                                                                        $comp_id_status       = CheckStatusEmailSettingsService($id, $items['int']); 
                                                                        ?>
                                                                        <div id="service_curve">
                                                                            <label><?php echo $items['services_name']; ?></label>
                                                                            <div id="service_check" onclick="return change_services_status('<?php echo $id; ?>','<?php echo $items['int']; ?>')">
                                                                                <div id="service_check_inside" class="service_check_inside_<?php echo $id; ?>_<?php echo $items['int']; ?> <?php if($comp_id_status == '1'){ ?>active_settings<?php } ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>                                                            
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                } else {
                                                    ?>
                                                    <tr align="center">
                                                        <td colspan="8">There is no mail id's</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                            </table>
                                        
                                            <table width="759" border="0" cellspacing="0" cellpadding="0" class="usr_tbl" style="margin-top: 30px;">
                                                <tr>
                                                    <td class="add_title"  height="38" colspan="9">staff user</td>
                                                </tr>
                                                <tr>
                                                    <td width="80" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">S.no</td>
                                                    <td width="339" colspan="2" valign="middle" height="28" bgcolor="#f99b3e" align="left" class="td_brdr pad_lft">User Name&nbsp;</td>
                                                    <td width="200" colspan="2" valign="middle" height="28" bgcolor="#f99b3e" align="left" class="td_brdr pad_lft">Initials&nbsp;</td>
                                                    <td width="339" colspan="2" valign="middle" height="28" bgcolor="#f99b3e" align="left" class="td_brdr pad_lft">User Type&nbsp;</td>
                                                    <td width="100" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">status</td>
                                                    <td width="140" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">action</td>
                                                </tr>
                                                <?php
                                                $all_users  = AllUsers();
                                                $i = 1;
                                                if(count($all_users) > 0){
                                                foreach ($all_users as $users)
                                                {
                                                    $rowColor   = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                    $rowColor1  = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                    $id         = $users['id'];
                                                    $init       = $users['initials'];;
                                                    $name       = $users['user_name'];
                                                    $type       = $users['type'];
                                                    $status     = ($users['status'] == 1) ? 'active' : 'de-active';
                                                        ?>
                                                        <tr>
                                                            <td width="80" height="36" align="center" bgcolor="<?php echo $rowColor; ?>" valign="middle"><?php echo $i; ?></td>
                                                            <td width="339" colspan="2" height="36" bgcolor="<?php echo $rowColor1; ?>" align="left" class="pad_lft" valign="middle"><?php echo $name; ?></td>
                                                            <td width="200" colspan="2" height="36" bgcolor="<?php echo $rowColor; ?>" align="left" class="pad_lft" valign="middle"><?php echo $init; ?></td>
                                                            <td width="339" colspan="2" height="36" bgcolor="<?php echo $rowColor1; ?>" align="left" class="pad_lft" valign="middle"><?php if($type == '2'){echo 'Staff User';} ?></td>
                                                            <td width="100" height="36" align="center" bgcolor="<?php echo $rowColor; ?>" valign="middle"><a href="email_settings.php?status_id_staff=<?php echo $id; ?>&change_id=<?php echo $users['status']; ?>" onclick="return confirm('Are you sure?');"><img src="images/<?php echo $status; ?>.png" width="22" height="22"  alt="Status" title="Status"/></a></td>
                                                            <td width="140" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>" valign="middle">
                                                                <a class="fancybox fancybox.iframe" href="usr_edit.php?id=<?php echo $id; ?>"><img src="images/edit.png"  alt="Edit" title="Edit" width="22" height="22"/></a><a style="text-decoration: none;color:#000;" href="email_settings.php?delete_staff_id=<?php echo $id; ?>" onclick="return confirm('Are you sure?');"><img src="images/del.png"  alt="Delete" title="Delete" width="22" height="22" class="mar_lft"/></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                }
                                                }  else {                                                    
                                                    ?>
                                                    <tr>
                                                        <td bgcolor="#dfdfdf" colspan="9" align="center">There is no users</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </table>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <!--<a href="settings_update.php"><span class="upt_sett" style="float:left; margin-left: 5px;margin-top: 5px;">Notification Settings</span></a>-->
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                                    <td height="38" align="left" valign="middle" class="add_title">Change Order Number Sequence</td>
                                                </tr>
                                                <tr>
                                                    <td height="60" align="right" valign="top" bgcolor="#f6f6f6" class="form_bg">
                                                        <form name="new_email" id="new_subcategory" method="post" action="">

                                                            <input type="hidden" name="new_mail" value="1" />  
                                                            <input type="hidden" name="mail_temp" id="mail_temp" value="0" />  
                                                            <table width="759" border="0" cellspacing="0" cellpadding="0">                                                                 
                                                                <tr>
                                                                    <td width="125" height="60" align="right" style="font-size:12px;" valign="middle">Order Number Sequence</td>
                                                                    <td width="160" height="60" align="right" valign="middle"><input type="text" autocomplete="off" name="sequence_id" id="sequence_id" class="input_text" value="<?php echo $sequence; ?>" ></td>                                                                    
                                                                    <td width="172"><img src="images/btn_setorder.png" title="Set Order Sequence" alt="Set Order Sequence" onclick="return order_seq(<?php echo $sequence_id; ?>);" style="cursor: pointer;margin-left: 10px;" /></td>                                                                    
                                                                </tr>                                                                
                                                            </table>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="38" align="left" valign="middle" class="add_title">Tax Configurations</td>
                                                </tr>
                                                <tr>
                                                    <td height="60" align="right" valign="top" bgcolor="#f6f6f6" class="form_bg">
                                                        <form name="new_email" id="new_subcategory" method="post" action="">

                                                            <input type="hidden" name="new_mail" value="1" />  
                                                            <input type="hidden" name="mail_temp" id="mail_temp" value="0" />  
                                                            <table width="759" border="0" cellspacing="0" cellpadding="0">                                                                 
                                                                <tr>
                                                                    <td width="125" height="60" align="right" style="font-size:12px;" valign="middle"> NYC Tax Rate</td>
                                                                    <td width="160" height="60" align="right" valign="middle"><input type="text" autocomplete="off" name="tax_id" id="tax_id" class="input_text" value="<?php echo $tax_rate; ?>" ></td>                                                                    
                                                                    <td width="172"><span class="upt_sett" style="float:left; margin-left: 5px;margin-top: 5px;" onclick="return tax_rate('<?php echo $tax_rate; ?>');">SET TAX RATE</span></td>                                                                    
                                                                </tr>                                                                
                                                            </table>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="38" align="left" valign="middle" class="add_title">Define Weekdays Off</td>
                                                </tr>
                                                <tr>
                                                    <td><div id="days_off_succ" style="color:#007F2A;"></div></td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#f6f6f6" class="form_bg">
                                                        <?php
                                                        $all_days_off = AllDayOff();
                                                        
                                                        foreach ($all_days_off as $days_off_split){
                                                            $all_days_in[]  = $days_off_split['date'];
                                                        }    
//                                                        echo '<pre>';
//                                                        print_r($all_days_in);
//                                                        echo '</pre>';
                                                        $all_date  = implode(",", $all_days_in);                                                        
                                                        $all_date_exist = str_replace("/", "-", $all_date);
                                                        ?>
                                                        <table style="width:100%;height: 100px;" border="0" >
                                                            <tr>
                                                                <td style="width:50%;" valign="top">
                                                                    <div id="insert_days_off">
                                                                    <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
                                                                    <div style="float:left;width:100%;font-weight: bold;">Pick the Date for Off:</div>
                                                                    <div style="float:left;width:100%;"><input type="text" name="date_off" id="date_off" class="picker_icon" /></div>
                                                                    <div style="float:left;width:100%;margin-top:5px;"><span name="submit_off" style="background: none repeat scroll 0 0 #f99b3e;border-radius: 5px;color: #fff;cursor: pointer;float: left;padding: 2px 8px;" onclick="return set_off_days();" />Set Days Off</span></div>
                                                                    </div>
                                                                </td>
                                                                <td style="width:50%;" valign="top">
                                                                     <div style="float:left;width:100%;font-weight: bold;">Date Show :</div>
                                                                     <div id="view_days_off">
                                                                     <?php  
                                                                     $n = 1;
                                                                     foreach ($all_days_off as $days_off){
                                                                     ?>
                                                                     <div style="float:left;width:100%;padding-top: 3px;">
                                                                         <div style="float: left;width: 5%;"><?php echo $n.'.'; ?></div>
                                                                         <div style="float: left;width: 20%;"><?php echo $days_off['date']; ?></div>
                                                                         <div style="float: left;width: 20%;"><span style="background: none repeat scroll 0 0 #f99b3e;border-radius: 3px;color: #fff;cursor: pointer;padding: 0px 5px;" onclick="return off_days_delete('<?php echo $days_off['id']; ?>');">Delete</span></div>
                                                                     </div>
                                                                     <?php $n++;} ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td height="38" align="left" valign="middle" class="add_title">Specials Button settings</td>
                                                </tr>
                                                <tr>
                                                    <td><div id="days_off_succ" style="color:#007F2A;"></div></td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#f6f6f6" class="form_bg">
                                                        <?php 
                                                            $specials       = Specials('3');
                                                            $close_lable    = ($specials == '1') ? 'SPECIALS ON' : 'SPECIALS OFF';
                                                            $close_lable_bg = ($specials == '1') ? 'background: #009D59;' : 'background: #D3412C;';                                                                                
                                                        ?>
                                                        <span id="special_status_3" onclick="return specials_on_off('3');" style="<?php echo $close_lable_bg; ?>;cursor: pointer;color: #FFF;float: left;padding: 5px 20px;margin-top: 10px;border-radius: 5px;text-decoration: none;margin-right: 15px;margin-left:5px;margin-bottom: 15px;font-weight: bold;"><?php echo $close_lable; ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                </table></td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td style="background:#464646; text-align:center; color:#fff; line-height:30px;" height="30p">© <?php echo date('Y'); ?> sohorepro.com</td>
            </tr>
        </table>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#category_name").change(function()
        {
            var pc_id = $(this).val();
            if (pc_id != '0')
            {
                $.ajax
                        ({
                            type: "POST",
                            url: "get_child.php",
                            data: "pc_id=" + pc_id,
                            success: function(option)
                            {
                                $("#subcategory_name").html(option);
                            }
                        });
            }
            else
            {
                $("#subcategory_name").html("<option value=''>-- No subcategory selected --</option>");
            }
            return false;
        });
    });

    $(document).ready(function() {
        /**  Simple image gallery. Uses default settings*/
        $('.fancybox').fancybox();

        /**  Different effects */
        $("div.close").hover(
                function() {
                    $('span.ecs_tooltip').show();
                },
                function() {
                    $('span.ecs_tooltip').hide();
                }
        );
        $("div.close").click(function() {
            disablePopup(); // function close pop up
        });

        $("div#backgroundPopup").click(function() {
            disablePopup(); // function close pop up
        });

        $(this).keyup(function(event) {
            if (event.which == 27) { // 27 is 'Ecs' in the keyboard
                disablePopup(); // function close pop up
            }
        });
    });

    function get_info(ID)
    {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            Update_Info_Popup(); // function show popup 
        }, 500); // .5 second 
        $.ajax
                ({
                    type: "POST",
                    url: "get_customer_informations.php",
                    data: "customer_id=" + ID,
                    beforeSend: loading,
                    complete: closeloading,
                    success: function(option)
                    {
                        var res = option.split("~");
                        $('#Contact_Name').html(res[0]);
                        $('#Contact_Email').html(res[1]);
                        $('#Company_Name').html(res[2]);
                        $('#Company_Phone').html(res[3]);
                        $('#Address_1').html(res[4]);
                        $('#Address_2').html(res[5]);
                        $('#Room').html(res[6]);
                        $('#City').html(res[7]);
                        $('#State').html(res[8]);
                        $('#Zip').html(res[9]);
                        $('#Phone_1').html(res[10]);
                        $('#Phone_2').html(res[11]);
                        $('#Phone_3').html(res[12]);
                        $('#Phone_4').html(res[13]);
                        $('#resale_certificate').html(res[14]);
                        $('#exempt_use_certificate').html(res[15]);
                    }
                });
    }

    function Update_Info_Popup() {
        closeloading(); // fadeout loading
        $("#update_info").fadeIn(0500); // fadein popup div
        $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
        $("#backgroundPopup").fadeIn(0001);
    }

    function disablePopup() {
        $("#update_info").fadeOut("normal");
        $("#backgroundPopup").fadeOut("normal");
        $('#Contact_Name').html("");
        $('#Contact_Email').html("");
        $('#Company_Name').html("");
        $('#Company_Phone').html("");
        $('#Address_1').html("");
        $('#Address_2').html("");
        $('#Room').html("");
        $('#City').html("");
        $('#State').html("");
        $('#Zip').html("");
        $('#Phone_1').html("");
        $('#Phone_2').html("");
        $('#Phone_3').html("");
        $('#Phone_4').html("");
        $('#resale_certificate').html("");
        $('#exempt_use_certificate').html("");
    }

    function loading() {
        $("div.login_loader").show();
    }

    function closeloading() {
        $("div.login_loader").fadeOut('normal');
    }
</script>

<script language="javascript">
    function validate()
    {
        var mail_name = document.getElementById('name').value;
        var input_mail = document.getElementById('email').value;    
        //alert(mail_name);
        if (mail_name == '')
        {
            document.getElementById("msg1").innerHTML = "Enter the name";
            document.getElementById('name').focus();
            return false;
        }
        else
        {
            document.getElementById("msg1").innerHTML = "";
        }
        if (input_mail == 'Enter email id')
        {
            document.getElementById("msg2").innerHTML = "Enter the email id";
            document.getElementById('email').focus();
            return false;
        }
        else
        {
            document.getElementById("msg2").innerHTML = "";
        }

        var input = document.getElementById('email').value;
        var expr = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!expr.test(input))
        {
            document.getElementById("msg3").innerHTML = "Enter the valid email id";
            document.getElementById('email').focus();
            return false;
        }
        else
        {
            document.getElementById("msg3").innerHTML = "";
        }
            
        if (input_mail != '')
        {
            $.ajax
                    ({
                        type: "POST",
                        url: "get_child.php",
                        data: "mail_id=" + input_mail + "&mail_name=" + mail_name,
                        success: function(option)
                        {
                            if (option == 'EXIST') {
                                document.getElementById("msg4").innerHTML = "Email id already exist.";
                                document.getElementById('email').focus();
                            } else {
                                document.getElementById("msg4").innerHTML = "";
                                window.location = "email_settings.php?val=success";
                            }
                        }

                    });
            return false;
        }
        return true;

    }


    function order_seq(sequence_id)
    {
        var sequence = document.getElementById('sequence_id').value;
        if (sequence != '')
        {
            $.ajax
                    ({
                        type: "POST",
                        url: "get_child.php",
                        data: "sequence_id=" + sequence_id + "&sequence=" + sequence,
                        success: function(option)
                        {
                            var order_result = option.split("~");
                            $("#sequence_id").val(order_result[1]);
                            document.getElementById("msg6").innerHTML = order_result[0];
                            $('#msg6').hide(3000);
                        }
                    });
        }
        else
        {
            document.getElementById("msg5").innerHTML = "Order number should not be empty";
        }

    }


    function tax_rate(tax_val)
    {
        var tax_id = document.getElementById('tax_id').value;
      
        if (tax_id != '')
        {
            $.ajax
                    ({
                        type: "POST",
                        url: "get_child.php",
                        data: "tax_val_fix=" + tax_id,
                        beforeSend: loadStart,
                        complete: loadStop,
                        success: function(option)
                        {
                            var order_result = option.split("~");
                            $("#tax_id").val(order_result[1]);
                            document.getElementById("msg6").innerHTML = order_result[0];
                            $('#msg6').hide(3000);
                        }
                    });
        }
        else
        {
            document.getElementById("msg5").innerHTML = "Tax rate should not be empty";
        }

    }
    
    function loadStart() {
$('#loading').show();
}

function loadStop() {
$('#loading').hide();
}


function change_status(status_id)
{
    var confirm_status  = confirm("Are you sure?");
    var temp_acc_id = $("#temp_acc_id").val();     
    $(".mask_general").removeClass('mask');
    if(temp_acc_id != status_id){
    $(".services_items").slideUp(300); 
    }
    if(confirm_status == true){
    if (status_id != '') 
    {
        $.ajax
            ({
                type: "POST",
                url: "suspend.php",
                data: "status_change_id=" + status_id,
                beforeSend: loadStart,
                complete: loadStop,
                success: function(option)
                {
                    var split_element        = option.split("~"); 
                    $('#status_change_'+status_id).attr("src",split_element[0]);
                    $("#status_current_id_"+status_id).val(split_element[1]);
                    if(split_element[1] == '0'){
                        $("#mask_content_"+status_id).addClass('mask');
                    }else{
                        $("#mask_content_"+status_id).removeClass('mask');
                    }                    
                }
            });
    }
    }else{
        return false;
    }
}

function accordion_settings(ID)
{
    var status_id   = $("#status_current_id_"+ID).val();
    var temp_acc_id = $("#temp_acc_id").val();     
    $(".mask_general").removeClass('mask');
    if(temp_acc_id != ID){
    $(".services_items").slideUp(300); 
    }
    $("#temp_acc_id").val(ID);
    $("#service_"+ID).slideDown(300);
    if(status_id == '0'){
    $("#mask_content_"+ID).addClass('mask');
    }
}

function change_services_status(ID, SER_ID)
{    
    if (SER_ID != '') 
    {
        $.ajax
            ({
                type: "POST",
                url: "suspend.php",
                data: "service_id="+SER_ID+"&rec_id="+ID,
                beforeSend: loadStart,
                complete: loadStop,
                success: function(option)
                {
                    if(option == true){
                       $(".service_check_inside_"+ID+"_"+SER_ID).addClass("active_settings");
                    }else{
                       $(".service_check_inside_"+ID+"_"+SER_ID).removeClass("active_settings"); 
                    }
                }
            });
    }
}

 function specials_on_off(SPL_ID){
        var ays         =  confirm('Are you sure?');
        if(ays == true){
        if(SPL_ID != ''){
        $.ajax
               ({
                   type: "POST",
                   url: "get_child.php",
                   data: "specials_on_off="+SPL_ID,
                   beforeSend: loadStart,
                   complete: loadStop,
                   success: function(option)
                   {    
                       //alert(option);
                       if(option == true){
                        $("#special_status_"+SPL_ID).html("SPECIALS ON");
                        $("#special_status_"+SPL_ID).css("background", "#009D59");                      
                        }else{
                        $("#special_status_"+SPL_ID).html("SPECIALS OFF");
                        $("#special_status_"+SPL_ID).css("background", "#D3412C");     
                        }
                   }
               }); 
        }
        }else{
            return false;
        }
    }
</script>