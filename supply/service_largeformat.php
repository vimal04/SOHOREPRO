<?php
include './admin/config.php';
include './admin/db_connection.php';

if($_SESSION['sohorepro_companyid']  == '')
{
  header("Location:index.php");
  exit;
}












?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Large Format - Services</title>

        <link rel="stylesheet" href="services_support/style.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/theme.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/jquery.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/tiptip.css" type="text/css" media="screen">

        <link rel="stylesheet" type="text/css" href="services_support/style_layout.css">
        
         
<link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-ui_service.js"></script>

 
 <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
 <!--<link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">-->
 <link rel="stylesheet" type="text/css" href="store_files/style_layout.css" />
 <!--[if IE 7]>
 <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
 <![endif]-->
 <script src="store_files/jquery.min.js"></script>
 <script type="text/javascript" src="js/jquery.timepicker.js"></script>
 <link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" media="screen" />
<script> 
function dtls_reveal(ID)
{
    var slide_up = $("#slide_id").val();
    $("#plotting_details_"+ID).slideToggle();
    if(slide_up != ID){
    $("#plotting_details_"+slide_up).slideUp();
    }
    $("#slide_id").val(ID);
}

function delete_plot(ID)
{
    //alert(ID);
}
</script>
<script>
    
    
    $(document).ready(function () {
    
  //called when key is pressed in textbox
  $(".order_0_set1_0_original").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   $(".order_0_set1_0_printOfEach").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   }); 
   
   $('.order_0_set1_0_printOfEach').bind("cut copy paste",function(e) {
          e.preventDefault();
          $("#errmsg").html("Disable the cut,copy and paste fetures ").show().fadeOut(2000);
   });
   
   $('.order_0_set1_0_original').bind("cut copy paste",function(e) {
          e.preventDefault();
          $("#errmsg").html("Disable the cut,copy and paste fetures ").show().fadeOut(2000);
   });
   
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
  $( "#date_for_alt").datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends}); 
        
   $( ".date_for_alt").datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends}); 
   
   
}); 

function date_revele()
{
    $("#date_for_alt").focus();
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
    
   $( "#date_for_alt").datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends}); 
}

function date_picker_jas(ID)
{  
   $("#date_for_alt_"+ID).datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']});  
 
}

function show_date_picker(ID)
{  
    $('#bar').css('width','0%');
    $('#percent').html('');
    $('#status').html('');
    $("#up_form").slideUp(1000);
    $("#date_for_alt").show();
    $("#date_for_alt").focus();
    $("#date_time").slideDown(1000);
    $("#provide_link").slideUp(1000);
    $("#drop_off").slideUp(1000);
    $("#drop_off_select_val").val('0');
    $("#validate_imp").val('1');
    
    $("#ftp_link").val('');
    $("#user_name").val('');
    $("#pass_word").val('');
    
    $("#drop_val").val('');
    $("#drop_val_1").val('');
    
    $(".filename").html('');
    
    $("#date_for_alt").val('');
    $("#time_for_alt").val(''); 
}

function show_date_picker_arch()
{    
    $("#date_time_arch").slideDown(1000);    
    $("#drop_off_arch").slideUp(1000);
    $("#validate_imp").val('1');
    
    $("#date_for_alt_arc").val('');
    $("#time_for_alt_arc").val(''); 
    
    $("#drop_val_arc").val('0');
    $("#drop_val_arc_1").val('0');
}


function drop_sohorepro()
{   
    $('#uploadedfile').val('');   
    //$('#bar_'+ID).css('width','0%');
    $('#percent').html('');
    $('#status').html('');   
    $("#up_form").slideUp(1000);
    $("#date_time").slideUp(1000);
    $("#date_for_alt").hide();
    $("#provide_link").slideUp(1000);
    $("#drop_off").slideDown(1000);
    document.getElementById("drop_val").checked = true;
    $("#drop_off_select_val").val('1');
    $("#validate_imp").val('1');
    
    $("#ftp_link").val('');
    $("#user_name").val('');
    $("#pass_word").val('');
    
    $("#date_for_alt").val('0');
    $("#time_for_alt").val('0'); 
    
    $(".filename").html('');
    
    $("#drop_val").val('381 Broome Street');
    $("#drop_val_1").val('307 7th Ave, 5th Floor');
}


function drop_sohorepro_arch()
{      
    $( "#date_time_arch").slideUp(1000);
    $("#drop_off_arch").slideDown(1000);
    document.getElementById("drop_val_arc").checked = true;
    $("#drop_off_select_val").val('1');  
    $("#validate_imp").val('1');
    
    $("#date_for_alt_arc").val('');
    $("#time_for_alt_arc").val(''); 
    
    $("#drop_val_arc").val('381 Broome Street');
    $("#drop_val_arc_1").val('307 7th Ave, 5th Floor');
}


function upload_soho()
{     
    $( "#date_for_alt").hide();
    $("#up_form").slideDown(1000);
    $( "#date_time").slideUp(1000);
    $("#provide_link").slideUp(1000);
    $("#drop_off").slideUp(1000);
    $("#drop_off_select_val").val('0');
    $("#validate_imp").val('1');
    
    $("#ftp_link").val('');
    $("#user_name").val('');
    $("#pass_word").val('');
    
    $(".filename").html('');
    
    $("#date_for_alt").val('0');
    $("#time_for_alt").val('0'); 
    
    $("#drop_val").val('');
    $("#drop_val_1").val('');    
    
}

function provide_link()
{   
    $("#date_for_alt").hide();
    $("#up_form").slideUp(1000);
    $("#date_time").slideUp(1000);
    $("#provide_link").slideDown(1000);
    $("#drop_off").slideUp(1000);
    $("#drop_off_select_val").val('0');
    $("#validate_imp").val('1');
    
    $("#date_for_alt").val('0');
    $("#time_for_alt").val('0'); 
    
    $("#drop_val").val('0');
    $("#drop_val_1").val('0');
    
    $(".filename").html('');
    
    $("#ftp_link").val('');
    $("#user_name").val('');
    $("#pass_word").val('');
}

$(function() {
    $('.time_picker_icon').timepicker({
        'minTime': '8:00am',
        'maxTime': '7:00pm',
        'showDuration': true
    });
});

function custome_size()
{
    var cus_size = $("#size").val();
    if(cus_size == "Custom"){
        $("#size_custom_div").slideDown(1000);
        //$("#output_both_div").slideUp(1000);
        $("#size").focus;
    }else{
        $("#size_custom_div").slideUp(1000);
        $("#size_custom").val("");
    }
}

function custome_output()
{
    var both_out = $("#output").val();
    if(both_out == "Both"){        
        $("#output_both_div").slideDown(1000);
        //$("#size_custom_div").slideUp(1000);
        $("#output").focus;
    }else{
        $("#output_both_div").slideUp(1000);
        $("#output_both").val("");
    }
}




function not_allow_original()
{
    var original = $("#original").val();
    if(original == '0'){
    $("#original").val('');
    $("#errmsg").html("Cannot be 0").show().fadeOut(1200);
    return false;
    }
}

function not_allow_poe()
{
    var print_ea    = $("#print_ea").val();
    if(print_ea == '0'){
    $("#print_ea").val('');
    $("#errmsg").html("Cannot be 0").show().fadeOut(1200);
    return false;
    }
}

function add_mount_lam()
{
    var add_ml = document.getElementById("add_ml").checked;
    if(add_ml == true){  
        $.ajax
        ({
        type: "POST",
        url: "new_add_mount_form.php",
        data: "new_add_mount_form=1",
        beforeSend: loadStart,
        complete: loadStop,
        success: function(option)
        {
            $("#add_mount_lam").addClass("border_gle");
            $("#new_add_mount_form").html(option);
            $("#new_add_mount_form").slideDown();
        }
        });
        
    }else{
        $("#new_add_mount_form").slideUp();
        $("#new_add_mount_form").html("");           
        $("#add_mount_lam").removeClass("border_gle");
    }
    
}

function loadStart() {
$('#loading').show();
}

function loadStop() {
$('#loading').hide();
}


</script>
        
        
        <style>  
    [tooltip]:before {            
    position : absolute;
    top:5px;
    background-color:#FFF;
    color:#EA4335;
    border-radius:3px;
    content : attr(tooltip);
    opacity : 0;
    padding: 2px;
    box-shadow: 2px 1px 7px 3px rgba(0,0,0,.1);
    -webkit-box-shadow: 2px 1px 7px 3px rgba(0,0,0,.1);
    -webkit-transition: opacity 0.5s;
    -moz-transition:  opacity 0.5s;
    -ms-transition: opacity 0.5s;
    -o-transition:  opacity 0.5s;
    transition:  opacity 0.5s;
    font-size: 12px;
    }
    
    [tooltip]:hover:before {        
    opacity : 1;
    }
    
    [tooltip]:not([tooltip-persistent]):before {
    pointer-events: none;
    }
     
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
   padding:10px 8px;
   margin: 6px 3px 6px 0px;
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
.inactive_menu:hover{
    color: red !important;
}
.serviceOrderSetDIV div {    
    margin-bottom: 5px;
}
 </style>
    </head>
    <body>
        <div id="loading"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1002;display: none;">
            <img src="admin/images/loading_rainbow.gif" border="0" style="width: 200px;height: 200px;" />
        </div>
        <div id="body_container">
            <div id="body_content" class="body_wrapper">
                <div id="body_content-inner" class="body_wrapper-inner">

                    <?php include "includes/header_sidebar.php"; ?>

                    <div id="content_output">

                        <?php include "includes/top_nav.php"; ?>

                        <div id="content_output-data" style="margin-bottom:20px;">  
                            <!--- TABLE START -->
                            <?php include "./service_nav.php"; ?>
                            <div id="set_form">
            <div id="plotting" action="" method="post" class="systemForm orderform">
                  <input type="hidden" name="plotting_set" value="0" />
                  <h2 class="headline-interior orange" style="text-transform: uppercase;">
                        LARGE FORMAT COLOR & BW
                    </h2>
                    <div class="bkgd-stripes-orange">
                      &nbsp;
                    </div>
                  
                  <div style="float:left;width: 100%;margin-bottom: 10px;">
                      <div style="float:left;width: 35%;margin-top: 13px;">
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
                        </div>
                    <div style="width: 60%;float:left;text-align: justify;">
                        <span style="font-weight: bold;color: #ff7e00;font-size: 14px;">Disclaimer:</span>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </div> 
                 </div>
                    
                  
                <ul>                  
                    <div  id="set">
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                  <li class="clear">
                      <!-- FOR EACH START -->  
                    <?php
                    $user_id_add_set        = $_SESSION['sohorepro_userid'];
                    $company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
                    $check_plotting         = PlottingSetWithoutOrderId($company_id_view_plot, $user_id_add_set);
                    $check_plotting_needed  = PlottingNeededSetWithoutOrderId($company_id_view_plot, $user_id_add_set);   
                    $check_plotting_files   = UploadFileExist($company_id_view_plot, $user_id_add_set);
                    if(count($check_plotting) > 0){
                        $delete_empty = "DELETE FROM sohorepro_plotting_set WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                        mysql_query($delete_empty);
                    }
                    
                    if(count($check_plotting_needed) > 0){
                        $delete_empty = "DELETE FROM sohorepro_sets_needed WHERE comp_id = '".$company_id_view_plot."' AND usr_id = '".$user_id_add_set."' AND order_id = '0'";
                        mysql_query($delete_empty);
                    }
                    
                    if(count($check_plotting_files) > 0){
                        $delete_sql = "DELETE FROM sohorepro_upload_files_set WHERE comp_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0' ";
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
                        <input type="hidden" name="optint_count_check" id="optint_count_check" value="0" />
                        </label>  
                        <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                            <div class="serviceOrderSetWapperInternal">
                            <div class="serviceOrderSetDIV">
                            <div style="width: 100%;float: left;padding-top: 10px;margin-bottom: 0px !important;">  
                                
                                <!--Check Box Start-->
                                <div style="float:left;width:100%;">
<!--                                    <ul class="arch_radio">
                                        <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
                                        <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" onclick="return active_arch();" /><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">ARCHITECTURAL COPIES</span></li>
                                    </ul>-->
                                    <span id="errmsg"></span>
                                </div>
                                <!--Check Box End-->
                                
                                <!--Originals Start-->
                                <div>
                                    <label>
                                      Originals
                                    </label>
                                    <input class="order_0_set1_0_original" style="width:50px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                    <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
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
                                            <option value="HALF">HALF</option>
                                            <option value="Custom">Custom</option>                          
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
                                      <select class="order_0_set1_0_output kdSelect " style="width: 65px;" id="output" name="output" onchange="return custome_output();">
                                         <option value="Color">Color</option>
                                         <option value="B/W">B/W</option>
                                        <option value="Both">Both</option>
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
                                      <select class="order_0_set1_0_media kdSelect " style="width: 245px;" id="media" name="media">
                                        <option value="00001">Bond Paper</option>
                                        <option value="00002">Heavy Weight Bond</option>
                                        <option value="00015">Satin Photo</option>
                                        <option value="00020">Gloss Photo</option>
                                        <option value="00025">Transparency</option>
                                        <option value="00030">Self Adhesive Fabric</option>
                                        <option value="00050">Stick 2, Polypropylene</option>
                                        <option value="00055">Banner / Scrim Vinyl</option>
                                        <option value="00005">Vellum</option>
                                        <option value="00010">Mylar</option>
                                        <option value="00105">Bond</option>
                                        <option value="00121">Presentation Bond - BW Laser Only</option>
                                      </select>
                                    </div>
                                    <div class="dropdown_selector">
                                    </div>
                                  </div>
                                </div>
                                <!--Media End-->
                               
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
                                
                <div style="">
                    <label id="alt_ops" style="font-weight: bold;height:28px">
                      File Options<span style="color: red;">*</span>
                    </label>
                    
                    <label id="pick_ops" style="font-weight: bold;height:28px;display: none;">
                      Pickup Options<span style="color: red;">*</span>
                    </label>
<!--                    <input type="checkbox"  style="display: none;width: 2%;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set('1');" />-->
                    <div id="options_plott" class="check" style="width:775px;border-top: 1px solid #FF7E00;margin-top:-13px;margin-bottom: 0px;">
                    <div class="spl_option">
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
                                foreach ($all_days_off as $days_off_split){
                                    $all_days_in[]  = $days_off_split['date'];
                                }                                                        
                                $all_date  = implode(",", $all_days_in);                                                        
                                $all_date_exist = str_replace("/", "-", $all_date);
                                ?>

                            </div>
                    
                        <div>
                            <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro_();" />
                          <label for="drop" >
                            Drop off at Soho Repro - 381 Broome Street
                          </label>                    
                        </div>                               
                    </div>
                  <br>
                      
                      <!--File Upload Details Start-->
                      <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 99%;padding-bottom: 10px;" id="up_form">
                        <input type="hidden" name="uploadedfile" id="uploadedfile" value="" /> 
                        <div id="dragandrophandler">Drag & Drop Files Here</div>
                        <br><br>
                        <div id="status1"></div> 
                      </div>
                      <!--File Upload Details End-->
                      
                      <!--FTP Details Start-->
                      <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 99%;padding-bottom: 10px;" id="provide_link">
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
                      
                      <div id="date_time" style="width: 99%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                <div style="width: 34%;float: left;margin-right: 6px;margin-bottom: 0px;"> 

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;margin-bottom: 0px;">
                                        <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                    </div>

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                        <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_reveal();" />
                                        <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                    </div>

                                </div>
                                <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: 85px;">
                                    <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" value="my_office" />My Office
                                    </div>
                                    <div style="float: left;width: 40%;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                        <select  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
                                            <option value="0">Address Book</option>
                                            <?php
                                            $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                            foreach ($address_book as $address) { ?>                                                                                        
                                            <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                      

                      <!--Pickup Details End-->
                      
                      <!--Drop off Details Start Plotting -->
                      <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 99%;padding-bottom: 10px;" id="drop_off">
                        <div style="margin: auto;width: 60%;">
                            <div style="margin: auto;width: 75%;float:right;">
                                <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broome Street" />381 Broome Street
                                <input style="width: 10% !important;margin-left: 35px !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                            <!-- <select id="drop_val">
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
                            foreach ($all_days_off as $days_off_split){
                                $all_days_in[]  = $days_off_split['date'];
                            }                                                        
                            $all_date  = implode(",", $all_days_in);                                                        
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
                        <!-- <select id="drop_val">
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
                <div style="float: left;width: 100%;">
                    <div id="sp_inst" style="margin-top:10px;margin-bottom: 0px;">
                      <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                        Special Instructions
                      </label>
                      <br>
                      <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="min-width: 370px;min-height: 60px;max-height: 60px;max-width: 370px;"><?php echo $entered['spl_instruction']; ?></textarea>
                    </div>
                </div>
                 <!--Special Instruction End-->
                 
                 <div style="width: 775px;float: left;font-weight: bold;font-size: 13px;border-bottom: 1px solid #FF7E00;">&nbsp;</div>
                
                <div id="add_mount_lam" class="" style="float:left;width: 775px;border: 0px solid #ccc;margin-bottom: 0px;">
                    <div style="float:left;width: 25%;padding: 5px;background-color: #EFEFEF;border-radius: 5px;border: 2px solid #000;padding: 10px;color: #000;font-weight: bold;">
                        <input type="checkbox" name="add_ml" id="add_ml" value="1" style="width: 15px;margin-bottom: 5px !important;margin-top: 5px !important;" onclick="return add_mount_lam();" />    
                    Add Mounting / Laminating
                    </div>
                </div>                                                 
                                                                    
                <div id="new_add_mount_form" style="display: none;">
                    
                </div>
                 
              </div>
              </div>
                            
              </div>              
                            
              
                            
              
              </div>
              </div>
                    
            </div>    
               
               <!-- FOR EACH END -->     
                  
             
               <div style="float: left;width: 99%;border-top: 1px solid #CCC;"></div>      
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
                        <!-- Main Content End -->
                        <div class="clear">
                        </div>
                    </div>
                    <div class="clear">
                    </div>

                    <!-- Footer Start -->
<?php include "./service_footer.php"; ?>
                    <!-- Footer End -->
                </div>
            </div>
            <div class="clear">
            </div>



        </div>
    </body>
</html>
