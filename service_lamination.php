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
        <title>Lamination - Services</title>

        <link rel="stylesheet" href="store_files/style.css" type="text/css" media="screen">

        <link rel="stylesheet" href="store_files/theme.css" type="text/css" media="screen">

        <link rel="stylesheet" href="store_files/jquery.css" type="text/css" media="screen">

        <link rel="stylesheet" href="store_files/tiptip.css" type="text/css" media="screen">

        <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
        
        <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
        
         <script src="store_files/jquery.min.js"></script>
 
         <script type="text/javascript" src="js/jquery.timepicker.js"></script>
            <link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" media="screen" />
            <link rel="stylesheet" href="js/jquery-ui.css" />
           <script src="js/jquery-ui_service.js"></script>
           <script src="js/jquery-ui_service.js"></script>
        <script src="waypoints.js"></script>
        <script src="waypoints-sticky.js"></script>
        <script type="text/javascript">
             $(document).ready(function() {
                 $('.sticky-navigation').waypoint('sticky');
             });


               $(document).ready(function () {  
                var top = $('.sticky-navigation').offset().top - parseFloat($('.sticky-navigation').css('marginTop').replace(/auto/, 100));
                $(window).scroll(function (event) {
                  // what the y position of the scroll is
                  var y = $(this).scrollTop();

                  // whether that's below the form
                  if (y > top) {
                    // if so, ad the fixed class
                    $('.sticky-navigation').addClass('fixed_1');
                  } else {
                    // otherwise remove it
                    $('.sticky-navigation').removeClass('fixed_1');
                  }
                });
              });

        </script>
        
        <script src="js/jquery.maskedinput.js" type="text/javascript" ></script>


<script> 
    
    jQuery(function($) {
        $("#alt_new_comp_phone").mask("999-999-9999");
        $("#alt_new_comp_zip").mask("99999");  
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
    
    $("#drop_val_arc").val('381 Broome Street');
    $("#drop_val_arc_1").val('307 7th Ave, 5th Floor');
}

$(function() {
    $('.time_picker_icon').timepicker({
        'minTime': '8:00am',
        'maxTime': '7:00pm',
        'showDuration': true
    });
});

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
</script>
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
width: 233%;
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
width: 100%;
float: left;
text-align: center;
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

.serviceOrderSetDIV div {    
    margin-bottom: 10px !important;
}

.border_gle{
    border-bottom: 1px solid #e5e5e5;
    background: #fff;
    white-space: nowrap;
    box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
    -webkit-box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
}
.grom input {
float: none;
display: inline-block;
width: 17px;
}
.grom{
    text-align:center;
}
        </style>
    </head>
    <body>
        <div id="loading" class="none"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1002;">
            <img src="admin/images/loading_rainbow.gif" border="0" style="width: 200px;height: 200px;" />
        </div>
        <div id="asap_popup" style="display: none;font-size: 15px;position: fixed;top: 35%;left: 35%;padding: 5px;z-index: 10;z-index: 1000;width: 45%;background: white;border-bottom: 1px solid #aaa;border-radius: 4px;box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);border: 1px solid rgba(0, 0, 0, 0.1);background-clip: padding-box;">
            <div style="width: 96%;padding: 2%;float: left;font-size: 14px;line-height: 18px;text-align: justify;">
                All orders placed online are assumed to be ready for today and available for collection immediately. Requests placed outside of our normal business hours will be fulfilled on the next business day.
            If you wish to place an order for another date and time, or for today but at a later time, 
            please edit the date and time for collection.
            </div>
            <div style="float: right;width: 98%;background-color: #EEE;padding: 1%;">
                <!--<span style="float: left;color: #000;font-weight: bold;margin-top: 5px;margin-left: 15px;">Note: All orders placed after hours will be picked up on the next business day.</span>-->
                <span style="float: right;border: 1px solid #BBB;padding: 3px 10px;border-radius: 3px;cursor: pointer;" onclick="return close_asap();">Close</span>
            </div>
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
                            <div id="orderWapper">
                                <h2 class="headline-interior orange" style="text-transform: uppercase;">Mounting &amp; Laminating</h2>                               
                                <div id="lamination" enctype="application/x-www-form-urlencoded" action="" method="post" class="systemForm validate orderform" >
                                    
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
                  <!--                        <span style="font-weight: bold;color: #ff7e00;font-size: 14px;">Disclaimer:</span>
                                          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.-->
                                      </div> 
                                   </div>
                                    
                                    <ul>      
                                        <li class="clear"><span>
                                                <div class="serviceOrderSetHolder">
                                                    <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                                                        <div class="serviceOrderSetWapperInternal">
                                                            <div class="serviceOrderSetDIV">
                                                                
                                                                <div>
                                                                    <label>Original<span class="ref_div_star">*</span></label>
                                                                    <input class="order_0_set1_0_original k-input kdText " style="width:70px;" id="original_lam" name="original_lam" type="number" min="1">
                                                                </div>
                                                                <div style="width: 100%;float: left;">
                                                                    <input type="checkbox" name="all_books" id="all_books" checked="checked" style="width: 2% !important;" onclick="get_all_booklet();" />All Originals to be Mounted / Laminated alike
                                                                </div>
                                                                
                                                                <div style="width: 100%;float: left;">
                                                                    <div style="float:left;width:100%;">
                                                                        <ul class="arch_radio">
                                                                            <li><input type="radio" name="mount_lam_check" id="mount_lam_check" style="width:2% !important;" value="1" onclick="return active_mount();"><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">Mounting</span></li>
                                                                            <li><input type="radio" name="mount_lam_check" id="mount_lam_check_0" style="width:2% !important;" value="0" onclick="return active_lamin();"><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">Laminating</span></li>
                                                                            <li><input type="radio" name="mount_lam_check" id="mount_lam_check_1" style="width:2% !important;" value="0" onclick="return active_both();"><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">Both</span></li>
                                                                        </ul>
                                                                        <span id="errmsg"></span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div id="ass_option" style="width: 100%;float: left;background-color: #F6F2F2;padding: 5px;">
                                                                  
                                                                    <div style="clear:both;"><label>Mounting<span class="mounting_req" style="color: red;display: none;">*</span></label>
                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                        <div style="float:left;margin-right:0px;">
                                                                            <select class="mounting_select_f kdSelect " style="width:150px;" id="mounting_select" name="mounting_select" onchange="return restrict_number();">
                                                                                <option value="none" selected="selected">None</option>
                                                                                        <option value="3308">FoamBoard 3/16 White</option>
                                                                                        <option value="3309">FoamBoard 3/16 Black</option>
                                                                                        <option value="3315">FoamBoard 1/2 White</option>
                                                                                        <option value="3316">FoamBoard 1/2 Black</option>
                                                                                        <option value="3311">GatorBoard 3/16 White</option>
                                                                                        <option value="3312">GatorBoard 3/16 Black</option>
                                                                                        <option value="3317">GatorBoard 1/2 White</option>
                                                                                        <option value="3318">GatorBoard 1/2 Black</option>
                                                                                        <option value="3319">Plasti-Cor  WHITE</option>
                                                                                        <option value="3313">Illustration Board 1/8 White</option>
                                                                                        <option value="3313">Illustration Board 1/8 Black</option>                                                                                
                                                                            </select>
                                                                        </div>
                                                                        <div class="dropdown_selector">
                                                                            
                                                                        </div>
                                                                            
                                                                    </div>
                                                                        
                                                                </div>
                                                                <div>
                                                                    <label>Lamination<span class="laminating_req" style="color: red;display: none;">*</span></label>
                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                        <div style="float:left;margin-right:0px;">
                                                                            <select class="lamination_select_f kdSelect " style="width:150px;" id="lamination_select" onchange="return lamination_value_change();" name="lamination_select">
                                                                                <option value="none" selected="selected">None</option>
                                                                                <option value="3317">Lamination Pouch,7mil 9x12 Gloss</option>
                                                                                <option value="3317">Lamination Pouch,7mil 12x18 Gloss</option>
                                                                                <option value="3319">Lamination, 3mil Satin</option>
                                                                                <option value="3319">Lamination, 3mil Gloss</option>                                                                                 
                                                                            </select>
                                                                        </div>                                                                        
                                                                    </div>                                                                            
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <label>Dimensions ( " )</label>
                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                        <div style="float:left;margin-right:0px;">
                                                                            <input type="hidden" name="width_val_set" id="width_val_set" value="48" />
                                                                            <input class="order_0_set1_0_original k-input kdText " style="width: 40px;margin-left: 10px;padding: 3px;" id="width_values" onkeyup="return width_value_restriction();" min="1" max="48" name="width_values" type="number"> 
                                                                           <span style="margin-right: 10px;">W</span>  
                                                                        </div>  
                                                                        <div style="float:left;margin-right:0px;">
                                                                            <input type="hidden" name="length_val_set" id="length_val_set" value="96" />
                                                                            <input class="order_0_set1_0_original k-input kdText " style="width: 40px;padding: 3px;" id="length_values" onkeyup="return length_value_restriction();" min="1" max="96" name="width_values"  type="number">                                                                            
                                                                           <span>L</span>  
                                                                        </div> 
                                                                    </div>                                                                            
                                                                </div>
                                                                
                                                                    <div class="grom">
                                                                    <label>Grommets</label>                                                                   
                                                                    <input type="checkbox" id="grommets" name="grommets" value="grommets" style="margin-top: 5px !important;">                                                                                                                                                 
                                                                </div>
                                                                </div>
                                                                
                                                                <div id="booklet" style="width: 100%;float: left;">
                      
                                                                </div>
                                                                <div style="width: 100%;float: left;font-weight: bold;font-size: 13px;border-bottom: 1px solid #FF7E00;">
                                                                    Special Instructions
                                                                </div>
                                                                <div id="sp_inst" style="margin-top:10px;">
                                                                            
                                                                    <textarea class="splins" id="mount_lam_spl" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"></textarea>
                                                                        </div> 
                                                                
<!--                                                                <div style="width: 100%;float: left;font-weight: bold;font-size: 13px;border-bottom: 1px solid #FF7E00;">
                                                                    File Options
                                                                </div>-->
                                                                
                                                                <div style="width:728px;">                                                                    
                                                                    
                                                                    
                                                                    <div style="width:730px;">
                                                                        <div class="spl_option" style="width: 100%;">
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
                        Drop off at Soho Repro - 381 Broome Street
                      </label>                    
                    </div>                               
                </div>
              <br>

                  <!--Pickup Details Start-->

                  <div id="date_time_arch" style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                <div style="width: 34%;float: left;/*margin-top: 10px;*/"> 

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 45px;border-bottom: 0px;text-align: center;margin-bottom: 0px !important;">
                                        <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                    </div>

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;margin-bottom: 5px !important;">
                                        <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_reveal();" />
                                        <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                    </div>

                                </div>
                                
                                <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: auto;">
                                    <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" checked="checked" value="my_office" />My Office
                                    </div>
                                    <div style="float: left;width: 40%;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                        <select  name="address_book_se" id="address_book_se" class="remove_current" onchange="return select_alternate();" style="margin-bottom: 15px;">
                                            <option value="0">Address Book</option>
                                            <option value="N" style="border-bottom: 1px solid #000;">Add New Address</option>
                                            <option value="NL" style="width: 100%;" disabled>---------------------------</option>
                                            <?php
                                            $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                            foreach ($address_book as $address) { ?>                                                                                        
                                            <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div id="alt_new_address_main" style="float: left;width: 100%;display: none;">
                                        <div style="float: left;width: 35%;border: 0px #F99B3E solid;">&nbsp;</div>
                                        <div style="float: left;width: 55%;border: 1px #F99B3E solid;margin-top: 5px;margin-bottom: 5px;">
                                            <div class="alt_new_address_container_hdr">
                                                Add New Address
                                            </div>
                                            <div class="alt_new_address_container">
                                                <ul>
                                                    <li><label>Company Name:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_name" class="alt_new_address_container_val" /></li>
                                                    <li><label>Attention_To:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_att" class="alt_new_address_container_val" /></li>
                                                    <li><label>Address 1:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_add1" class="alt_new_address_container_val" /></li>
                                                    <li><label>Address 2:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_add2" class="alt_new_address_container_val" /></li>
                                                    <li><label>Address 3:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_add3" class="alt_new_address_container_val" /></li>
                                                    <li><label>City:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_city" class="alt_new_address_container_val" /></li>
                                                    <li>
                                                        <label>State:</label>
                                                        <select name="state" id="alt_new_comp_state" class="required reginput comp_det_view" style="width: 50px;" tabindex="12" >
                                                            <option value="">----</option>
                                                            <?php
                                                            $sel_state = mysql_query("select * from sohorepro_states");
                                                            while ($fth_states = mysql_fetch_array($sel_state)) {
                                                                ?>
                                                            <option value="<?php echo $fth_states['state_abbr']; ?>" <?php if($fth_states['state_abbr'] == "NY"){ ?>selected="selected"<?php } ?>><?php echo $fth_states['state_abbr']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </li>
                                                    <li><label>Zip:</label><input type="text" name="alt_new_comp_zip" id="alt_new_comp_zip" class="alt_new_address_container_val" /></li>
                                                    <li><label>Phone:</label><input type="text" name="alt_new_comp_phone" id="alt_new_comp_phone" class="alt_new_address_container_val" /></li>
                                                </ul>
                                            </div>
                                            <div class="alt_new_address_container_ftr" style="margin-bottom: 0px !important;">
                                                <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                            </div>
                                        </div>
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
                        </div>                            
                    </div>   
                  </div>
                  <!--Drop off Details End-->
                </div>
            
                
                
                
<div style="width: 775px;float: left;font-weight: bold;font-size: 13px;border-bottom: 1px solid #CCCCCC;">&nbsp;</div>
                                                                    </div>
                                                                
                                                            </div>
                                                            
                                                        
                                                        </div>
                                                        
                                                        <div style="clear:both;"></div>
                                                            
                                                    </div>
                                                        
                                                </div>
                                            </span>
                                        </li>
                                        
                                                                    <li class="clear">
                                                                        <span>
                
                                                <div style="height:29px;">&nbsp;</div>
                                                <input class="addproductActionLink" onclick = "return continue_mounting();"  value="Save to Cart" style="cursor: pointer;float:right;font-size:12px; padding:1.5px; width: 100px;margin-right:14px;margin-top:15px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="submit">
                                                <div style="clear:both"></div>
                                                                        </span>
                                                                    </li>
                            </ul>
                                </div>            </div>

                            <div style="clear:both;">
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
    <script>
        
    
        
        
     function get_all_booklet()
   {
       var all_books = document.getElementById("all_books").checked;
       var nob = $("#original_lam").val();
       if(all_books == true){
           $('#booklet').html('');
           $('#ass_option').show();
       }else{
           $.ajax
         ({
             type: "POST",
             url: "laminate_increase.php",
             data: "number_of_booklet="+nob,
             beforeSend: loadStart,
             complete: loadStop,
             success: function(option)
             {                         
                $('#ass_option').hide();
                $('#booklet').html(option);
                $("#size_custom_div").hide();
             }
         });
       }
   }
   
   
   function width_value_restriction()
   {
        var width_values    = $("#width_values").val();
        var width_val_se    = $("#width_val_set").val();
        
        var max_val         = Number(width_val_se);
        if(width_values == '0'){
        $("#width_values").val('');
        $("#errmsg").html("Cannot be 0").show().fadeOut(1500);
        return false;
        }
        
        if(width_val_se != ""){
        if(width_values > max_val){
        $("#errmsg").html("Cannot be exceed "+max_val).show();
        return false;
        }else{
        $("#errmsg").html("Cannot be exceed "+max_val).hide();    
        }
        }
        
   }
   
   function length_value_restriction()
   {
        var length_values    = $("#length_values").val();
        var length_val_set   = $("#length_val_set").val();
        
        var max_val          = Number(length_val_set);
        if(length_values == '0'){
        $("#length_values").val('');
        $("#errmsg").html("Cannot be 0").show().fadeOut(1500);
        return false;
        }
        
        if(length_val_set != ""){
        if(length_values > max_val){
        $("#errmsg").html("Cannot be exceed "+max_val).show();
        return false;
        }else{
        $("#errmsg").html("Cannot be exceed "+max_val).hide();   
        }
        }
        
   }
   
   
  
   
   



function loadStart() {
$('#loading').show();
}

function loadStop() {
$('#loading').hide();
}



function ready_now(){
    alert("All orders placed online are assumed to be for today and available for collection immediately.  If you wish to       place an order for another date and time, or for today but       at a later time, please check the box at the left and then enter below a date and time for collection.");
}


    
 $(function() {
$("#jobref").keyup(function()
{
    var searchid = $(this).val();
    var user_id = document.getElementById("user_session").value;
    var comp_id = document.getElementById("user_session_comp").value;
    if(searchid == ''){
    $(".records_reference").hide();    
    }
    var dataString = 'search=' + searchid + '&user_id=' + user_id + '&comp_id=' + comp_id;
    if (searchid != '')
    {
        $.ajax({
            type: "POST",
            url: "auto_reference_plotting.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                if (html != '') {                   
                    $(".records_reference").show();
                    $(".records_reference").html(html);
                } else {
                    $(".records_reference").hide();
                }
            }
        });
    }
    return false;
});
 });
 
function get_reference(auto_ref,ID,COMP_ID)
    {
        //alert(auto_ref);
        $("#jobref").val(auto_ref);
        $("#jobref_id").val(ID);
        $("#company_id").val(COMP_ID);
        $("#result_ref").hide();
//        $.ajax
//        ({
//        type: "POST",
//        url: "admin/get_child.php",
//        data: "referece_set_fav=" + auto_ref,
//        success: function(option)
//        {
//
//        }
//        });
    }
    


function asap()
{
    var current_status  =   $("#asap_status").attr('class');
    var change_status   =   (current_status == "asap_orange") ? 'asap_green' : 'asap_orange';
    var date_time_alt_pre    =   (current_status == "asap_green") ? '' : 'ASAP';
       
    $("#asap_status").removeClass(current_status);
    $("#asap_status").addClass(change_status);
    
    $("#date_for_alt").val(date_time_alt_pre);
    $("#time_for_alt").val(date_time_alt_pre);
    $("#date_for_alt_arc").val("ASAP");
    $("#time_for_alt_arc").val("ASAP");
    $("body").append("<div class='modal-overlay js-modal-close'></div>");
    $("#asap_popup").slideDown("slow");
}

function asap_arc()
{   
    
    var current_status  =   $("#asap_status_arch").attr('class');
    var change_status   =   (current_status == "asap_orange") ? 'asap_green' : 'asap_orange';
    $("#asap_status_arch").removeClass(current_status);
    $("#asap_status_arch").addClass(change_status);
    
    $("#date_for_alt_arc").val("ASAP");
    $("#time_for_alt_arc").val("ASAP");
    $("body").append("<div class='modal-overlay js-modal-close'></div>");
    $("#asap_popup").slideDown("slow");
}

function close_asap()
{
    $(".modal-overlay").fadeOut();
    $("#asap_popup").slideUp("slow"); 
}






 
 function show_date_picker(ID)
{  
    $('#bar').css('width','0%');
    $('#percent').html('');
    $('#status').html('');
    //$("#up_form").slideUp(1000);
    $("#date_for_alt").show();
    $("#date_for_alt").focus();
    $("#date_time").slideDown(1000);
    $("#provide_link").slideUp(1000);
    $("#drop_off").slideUp(1000);
    $("#drop_off_select_val").val('0');
}

function drop_sohorepro()
{   
    //$('#uploadedfile').val('');   
    //$('#bar_'+ID).css('width','0%');
    $('#percent').html('');
    $('#status').html('');   
    //$("#up_form").slideUp(1000);
    $("#date_time").slideUp(1000);
    $("#date_for_alt").hide();
    $("#provide_link").slideUp(1000);
    $("#drop_off").slideDown(1000);
    document.getElementById("drop_val").checked = true;
    $("#drop_off_select_val").val('1');
}



function show_date_picker_arch()
{    
    $("#date_time_arch").slideDown(1000);    
    $("#drop_off_arch").slideUp(1000);
    $("#validate_imp").val('1');
    
    $("#date_for_alt_arc").val('');
    $("#time_for_alt_arc").val(''); 
    
    $("#drop_val_arc").val('381 Broome Street');
    $("#drop_val_arc_1").val('307 7th Ave, 5th Floor');
}




function drop_sohorepro_arch()
{      
    $( "#date_time_arch").slideUp(1000);
    //$("#drop_off_arch").slideDown(1000);
    document.getElementById("drop_val_arc").checked = true;
    $("#drop_off_select_val").val('1');  
    $("#validate_imp").val('1');
    
    $("#date_for_alt_arc").val('');
    $("#time_for_alt_arc").val(''); 
    
    $("#drop_val_arc").val('381 Broome Street');
    $("#drop_val_arc_1").val('307 7th Ave, 5th Floor');
}

function active_mount()
   {
       $('.lamination_select option[value="none"]').prop('selected', 'selected');
        
       $(".lamination_select").attr('disabled', true);
       $(".mounting_select").attr('disabled', false);
        
       $("#lamination_select").attr('disabled', true);
       $("#mounting_select").attr('disabled', false);
       
       $(".mounting_req").show();
       $(".laminating_req").hide();
   }
   
   function active_lamin()
   {   $('.mounting_select option[value="none"]').prop('selected', 'selected');
       
       $(".mounting_select").attr('disabled', true);
       $(".lamination_select").attr('disabled', false);
       
        $("#mounting_select").attr('disabled', true);
       $("#lamination_select").attr('disabled', false);
       
       $(".mounting_req").hide();
       $(".laminating_req").show();
   }
   
    function active_both()
   {   
       $(".mounting_select").attr('disabled', false);
       $(".lamination_select").attr('disabled', false);
       
       $("#mounting_select").attr('disabled', false);
       $("#lamination_select").attr('disabled', false);
       
       $(".mounting_req").show();
       $(".laminating_req").show();
   }
   
   function lamination_value_change()
   { 
       $("#width_values").val("");
       $("#length_values").val("");
       var lamination_value_f = $(".lamination_select").val();
       var lamination_value = $("#lamination_select").val();
       if((lamination_value == "3319") || (lamination_value_f == "3319")){
           $("#width_values").attr("max","40");
           $("#length_values").attr("max","");
           
           $("#width_val_set").val("40");
           $("#length_val_set").val("");  
           
       }else if((lamination_value == "3320") || (lamination_value_f == "3320")){
           $("#width_values").attr("max","40");
           $("#length_values").attr("max","");
           
           $("#width_val_set").val("40");
           $("#length_val_set").val("");
       }else{
           $("#width_values").attr("max","48");
           $("#length_values").attr("max","96");
           
           $("#width_val_set").val("48");
           $("#length_val_set").val("96");
       }
   }
   
 function restrict_number()
   {
       $("#width_values").val("");
       $("#length_values").val("");
       var mounting_value_f = $("#mounting_select").val();
         var mounting_value = $(".mounting_select").val();
       if((mounting_value == "11") || (mounting_value == "22") || (mounting_value_f == "11") || (mounting_value_f == "22")){
           $("#width_values").attr("max","30");
           $("#length_values").attr("max","40");
           
           $("#width_val_set").val("30");
           $("#length_val_set").val("40");
       }else{
           $("#width_values").attr("max","48");
           $("#length_values").attr("max","96");
           
           $("#width_val_set").val("48");
           $("#length_val_set").val("96");
       }
   }
function continue_mounting()
    {
        var job_reference       =   $("#jobref").val();
        
        var original_lam        =   $("#original_lam").val();
        var all_books           =   $("#all_books").val();
        
        var mount_lam_1          =       document.getElementById("mount_lam_check").checked;
        var mount_lam_2          =       document.getElementById("mount_lam_check_0").checked;
        var mount_lam_3          =       document.getElementById("mount_lam_check_1").checked;
        
         if(mount_lam_1 == true){
                            var mount_lam            =       "M";
                           }else if(mount_lam_2 == true){
                            var mount_lam            =       "L";
                           }else if(mount_lam_3 == true){
                            var mount_lam            =       "Both";
                           }
                        
       // var org_count = $("#mount_count").val();
    
     //  alert(org_count);
       //var i;
       var mount_data = [];
   $(".mounting_select option:selected").each(function(){
      
      var v = $(this).text();
       //console.log(v);
       mount_data = ({mount_name: $(this).text(), value: $(this).val()});
       //alert(v);
   });
  // var ser_mount = $.param(mount_data);
  mount_data = $.map(mount_data);
   console.log(mount_data);
        var mounting_select     =   $("#mounting_select_1 option:selected").text();
        var lamination_select   =   $("#lamination_select_1 option:selected").text();
        
        var width_values        =   $("#width_values").val();
        var length_values       =   $("#length_values").val();
        var grommets            =   $("#grommets").val();      
        
     
        var mount_lam_spl       =   $("#mount_lam_spl").val();
     
        
        var pickup_date         =   $("#date_for_alt").val();
        var pickup_time         =   $("#time_for_alt").val();
        
         var my_office           = document.getElementById("my_office").value;
         var alternate           = document.getElementById("alternate").value;
         var address_book_se     = document.getElementById("address_book_se").value;  
         var my_office_1         = document.getElementById("my_office").checked;
         var alternate_1         = document.getElementById("alternate").checked;
    
    if(my_office_1 == true){
        var my_office_alt       = my_office;
        var address_book_se_val = "0"; 
    }else if(alternate_1 == true){
        var my_office_alt   = alternate;
        var address_book_se_val = address_book_se; 
    }else{
        var my_office_alt   = "0";
        var address_book_se_val = "0"; 
    }
    
    
    
         if (job_reference != '')
        {
        $.ajax
                ({
                    type: "POST",
                    url: "add_mounting_sets.php",
                    data: "all_mounting_sets=1&job_reference="+encodeURIComponent(job_reference)+
                           "&mount_data="+mount_data,
                           
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                           
                        console.log(option);
                    }
                });
        }
        
        }


function my_office()
{
    $("#address_book_se").val('0');
    $("#address_book_se").css("border","1px solid #ccc");
}

function alternate()
{
    $("#address_book_se").css("border","1px solid red");
    $("#address_book_se").trigger("onclick");
}
function select_alternate()
{
    var address_book_se = $("#address_book_se").val();
    if(address_book_se != '0'){
        $("#alternate").attr("checked", true);
    }
    if(address_book_se == "N"){
        $("#alt_new_address_main").slideDown();
        //$("#alt_new_comp_name").focus();
    }else{
        $("#alt_new_address_main").slideUp();
    }
}


function save_alt(){
    
    var alt_new_comp_name       =   $("#alt_new_comp_name").val();
    var alt_new_comp_att        =   $("#alt_new_comp_att").val();
    var alt_new_comp_add1       =   $("#alt_new_comp_add1").val();
    var alt_new_comp_add2       =   $("#alt_new_comp_add2").val();
    var alt_new_comp_add3       =   $("#alt_new_comp_add3").val();
    var alt_new_comp_city       =   $("#alt_new_comp_city").val();
    var alt_new_comp_state      =   $("#alt_new_comp_state").val();
    var alt_new_comp_zip        =   $("#alt_new_comp_zip").val();
    var alt_new_comp_phone      =   $("#alt_new_comp_phone").val();
    
    if(alt_new_comp_name == ""){
        $("#alt_new_comp_name").focus();
        return false;
    }
    
    if(alt_new_comp_add1 == ""){
        $("#alt_new_comp_add1").focus();
        return false;
    }
    
    if(alt_new_comp_name != "")    {
    $.ajax
        ({
            type: "POST",
            url: "alt_address_save.php",
            data: "alt_address_save=1&alt_new_comp_name="+encodeURIComponent(alt_new_comp_name)+
                  "&alt_new_comp_att="+encodeURIComponent(alt_new_comp_att)+
                  "&alt_new_comp_add1="+encodeURIComponent(alt_new_comp_add1)+
                  "&alt_new_comp_add2="+encodeURIComponent(alt_new_comp_add2)+
                  "&alt_new_comp_add3="+encodeURIComponent(alt_new_comp_add3)+
                  "&alt_new_comp_city="+encodeURIComponent(alt_new_comp_city)+
                  "&alt_new_comp_state="+encodeURIComponent(alt_new_comp_state)+
                  "&alt_new_comp_zip="+encodeURIComponent(alt_new_comp_zip)+
                  "&alt_new_comp_phone="+encodeURIComponent(alt_new_comp_phone),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                var option_split = option.split("~");
                if(option_split[0] == true){ 
                    $("#address_book_se").html(option_split[1]);
                    $("#alt_new_address_main").slideUp();  
                }
            }
        });
    }
    
}

function can_alt(){
    $("#alt_new_address_main").slideUp();   
    $("#address_book_se").val('0');
}
 </script>
</html>
