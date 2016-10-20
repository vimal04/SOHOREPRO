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
        
         <script src="store_files/jquery.min.js"></script>
 <script type="text/javascript" src="js/jquery.timepicker.js"></script>
 <link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" media="screen" />
 <link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-ui_service.js"></script>

        <script>
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
                                                
                                        <li class="clear"><span>
                                                <div class="serviceOrderSetHolder">
                                                    <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                                                        <div class="serviceOrderSetWapperInternal">
                                                            <div class="serviceOrderSetDIV">
                                                                <div>
                                                                    <label>Originals<span class="ref_div_star">*</span></label>
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
                                                                    <div style="clear:both;"><label>Mounting<span id="mounting_req" style="color: red;display: none;">*</span></label>
                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                        <div style="float:left;margin-right:0px;">
                                                                            <select class="order_0_set1_0_mounting kdSelect " style="width:150px;" id="mounting_select" name="mounting_select" onchange="return restrict_number();">
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
                                                                                <option value="11">Illustration Board 1/8 White</option>
                                                                                <option value="22">Illustration Board 1/8 Black</option>                                                                                
                                                                            </select>
                                                                        </div>
                                                                        <div class="dropdown_selector">
                                                                            
                                                                        </div>
                                                                            
                                                                    </div>
                                                                        
                                                                </div>
                                                                <div>
                                                                    <label>Lamination<span id="laminating_req" style="color: red;display: none;">*</span></label>
                                                                    <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                                                        <div style="float:left;margin-right:0px;">
                                                                            <select class="order_0_set1_0_lamination kdSelect " style="width:150px;" id="lamination_select" onchange="return lamination_value_change();" name="lamination_select">
                                                                                <option value="none" selected="selected">None</option>
                                                                                <option value="3317">Lamination Pouch,7mil 9x12 Gloss</option>
                                                                                <option value="3317">Lamination Pouch,7mil 12x18 Gloss</option>
                                                                                <option value="3319">Lamination, 3mil Satin</option>
                                                                                <option value="3320">Lamination, 3mil Gloss</option>                                                                               
                                                                            </select>
                                                                        </div>                                                                        
                                                                    </div>                                                                            
                                                                </div>
                                                                <div>
                                                                    <label style="margin-left: 35px;">Dimensions</label>
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
                                <div style="width: 34%;float: left;margin-top: 10px;"> 

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;margin-bottom: 0px !important;">
                                        <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                    </div>

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;margin-bottom: 5px !important;">
                                        <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_reveal();" />
                                        <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
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
                                                <input class="addproductActionLink" onclick = "return continue_mounting();"  value="Continue" style="cursor: pointer;float:right;font-size:12px; padding:1.5px; width: 100px;margin-right:14px;margin-top:15px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="submit">
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
        $("#width_values").val('');
        $("#errmsg").html("Cannot be exceed "+max_val).show().fadeOut(1500);
        return false;
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
        $("#length_values").val('');
        $("#errmsg").html("Cannot be exceed "+max_val).show().fadeOut(1500);
        return false;
        }
        }
        
   }
   
   function active_mount()
   {
       $("#lamination_select").attr('disabled', true);
       $("#mounting_select").attr('disabled', false);
       $("#mounting_req").show();
       $("#laminating_req").hide();
   }
   
   function active_lamin()
   {   
       $("#mounting_select").attr('disabled', true);
       $("#lamination_select").attr('disabled', false);
       $("#mounting_req").hide();
       $("#laminating_req").show();
   }
   
    function active_both()
   {   
       $("#mounting_select").attr('disabled', false);
       $("#lamination_select").attr('disabled', false);
       $("#mounting_req").show();
       $("#laminating_req").show();
   }
   
   function lamination_value_change()
   {
       $("#width_values").val("");
       $("#length_values").val("");
       var lamination_value = $("#lamination_select").val();
       if(lamination_value == "3319"){
           $("#width_values").attr("max","40");
           $("#length_values").attr("max","");
           
           $("#width_val_set").val("40");
           $("#length_val_set").val("");
           
       }else if(lamination_value == "3320"){
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
       var mounting_value = $("#mounting_select").val();
       if((mounting_value == "11") || (mounting_value == "22")){
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
   
  function validate_plotting()
  {  
   $("body").append("<div class='modal-overlay'></div>");  
    var jobreference        = document.getElementById("jobref").value;
    
    var check_val           = document.getElementById("plotting_check").checked;
    var check_val_0         = document.getElementById("plotting_check_0").checked;
    //var plotting_check_jk   = document.getElementsByName("plotting_check").checked;
    
    var plotting_check      = (check_val == true) ? '1' : '0';
    
    var original            = document.getElementById("original").value;
    var print_ea            = document.getElementById("print_ea").value;
    var size                = document.getElementById("size").value;
    var output              = document.getElementById("output").value;
    var media               = document.getElementById("media").value;
    var binding             = document.getElementById("binding").value;
    var folding             = document.getElementById("folding").value;
    var special_instruction = document.getElementById("special_instruction").value;
    var size_custom         = document.getElementById("size_custom").value;
    var output_both         = document.getElementById("output_both").value;
    
    var date_for_alt        = document.getElementById("date_for_alt").value;
    var date_for_alt_arc    = document.getElementById("date_for_alt_arc").value;
    if(date_for_alt != ''){
        var date_for_alt_val    = date_for_alt;
    }else if(date_for_alt_arc != ''){
        var date_for_alt_val    = date_for_alt_arc;
    }else{
        var date_for_alt_val    = '0';
    }
    
    var time_for_alt        =  document.getElementById("time_for_alt").value;
    var time_for_alt_arc    =  document.getElementById("time_for_alt_arc").value;
    if(time_for_alt != ''){
        var time_for_alt_val    =  time_for_alt;
    }else if(time_for_alt_arc != ''){
        var time_for_alt_val    =  time_for_alt_arc;
    }else{
        var time_for_alt_val    =  '0';
    }
    
    var drop_chk_val_0          =   document.getElementById("drop_val").value;
    var drop_chk_val_1          =   document.getElementById("drop_val_1").value;
    
    var drop_chk_arc_val_0      =   document.getElementById("drop_val_arc").value;
    var drop_chk_arc_val_1      =   document.getElementById("drop_val_arc_1").value;
    
    var drop_chk_1          =   document.getElementById("drop_val").checked;
    var drop_chk_2          =   document.getElementById("drop_val_1").checked;
    var drop_chk_arc_1      =   document.getElementById("drop_val_arc").checked;
    var drop_chk_arc_2      =   document.getElementById("drop_val_arc_1").checked;
    
    var drop_off_select_val =   document.getElementById("drop_off_select_val").value;
    
    if(drop_off_select_val == '1'){
        if(drop_chk_1 == true){
            var drop_val            =   drop_chk_val_0;
        }else if(drop_chk_2 == true){
            var drop_val            =   drop_chk_val_1;
        }else if(drop_chk_arc_1 == true){
            var drop_val            =   drop_chk_arc_val_0;
        }else if(drop_chk_arc_2 == true){
            var drop_val            =   drop_chk_arc_val_1;
        }
    }else{
            var drop_val            =   '0';
    }
    
    var ftp_link            =   document.getElementById("ftp_link").value;
    var user_name           =   document.getElementById("user_name").value;
    var password            =   document.getElementById("pass_word").value;
    
    var ftp_link_val        =   (ftp_link != '') ? ftp_link : '0';
    var user_name_val       =   (user_name != '') ? user_name : '0';
    var password_val        =   (password != '') ? password : '0';
        
    var size_custom_val     =  (size_custom != '') ? size_custom : '0';
    var output_both_val     =  (output_both != '') ? output_both : '0';
    
    var size_custom         = (size == 'Custom') ? document.getElementById("size_custom").value : '0';
    
    if(jobreference == ''){
        alert('Please enter the Job Reference');
        document.getElementById("jobref").focus();
        return false;
    }
    
    if($('input[name=plotting_check]:checked').length<=0)
    {
        alert('Please select the job option');
        document.getElementById("plotting_check").focus();
        return false;
    }
    
    if(print_ea == ''){
        alert('Please enter the Print');
        document.getElementById("print_ea").focus();
        return false;
    }  
//    if(output == 'Both'){
//        if(special_instruction == ''){
//        alert('Please enter the special instructions');
//        document.getElementById("special_instruction").focus();
//        return false;  
//        }      
//    }
    if(size == 'Custom'){
       if(size_custom == ''){
        alert('Please enter the custom size');
        document.getElementById("size_custom").focus();
        return false;  
        }      
    }
    if (jobreference != '')
    {
        $.ajax
                ({
                    type: "POST",
                    url: "add_plotting_sets.php",
                    data: "service_plotting_add=1&job_reference="+encodeURIComponent(jobreference)+
                          "&original="+encodeURIComponent(original)+"&print_ea="+encodeURIComponent(print_ea)+
                          "&size="+encodeURIComponent(size)+"&output="+encodeURIComponent(output)+
                          "&media="+encodeURIComponent(media)+
                          "&binding="+encodeURIComponent(binding)+"&folding="+encodeURIComponent(folding)+
                          "&plot_arch="+encodeURIComponent(plotting_check)+"&special_instruction="+encodeURIComponent(special_instruction)+
                          "&size_custom_val="+encodeURIComponent(size_custom_val)+"&output_both_val="+encodeURIComponent(output_both_val)+
                          "&pickup_date="+encodeURIComponent(date_for_alt_val)+"&pickup_time="+encodeURIComponent(time_for_alt_val)+
                          "&drop_val="+encodeURIComponent(drop_val)+"&ftp_link_val="+encodeURIComponent(ftp_link_val)+
                          "&user_name_val="+encodeURIComponent(user_name_val)+"&password_val="+encodeURIComponent(password_val)+"&size_custom="+encodeURIComponent(size_custom),
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                           
                        $('#sets_all').slideDown();
                        $('#sets_all').html(option);
                        $('#continue_ok').val('1');
                        $( ".modal-overlay" ).remove();
                    }
                });
    }
    
  }   

function validate_binding_cont()
{    
    var jobref                          = document.getElementById("jobref").value;
    
    var binding_main_option             = document.getElementById("binding_main_option").value;
    var binding_child_option            = document.getElementById("binding_child_option").value;
    
    var front_main_option               = document.getElementById("front_main_option").value;
    var binding_child_option_front      = document.getElementById("binding_child_option_front").value;
    
    var back_main_option                = document.getElementById("back_main_option").value;
    var binding_child_option_back       = document.getElementById("binding_child_option_back").value;
    
    var nob                             = document.getElementById("nob").value;
    
    var cutting_option                  = document.getElementById("cutting_option").value;
    var special_instruction_cutting     = document.getElementById("special_instruction_cutting").value;
    
       
    var custome_instruction             = document.getElementById("custome_instruction").value;
    
    var special_instruction             = document.getElementById("special_instruction").value;
    
    
    var size_1                          = document.getElementById("size_1").checked;
    var size_1_val                      = (size_1 == true) ? document.getElementById("size_1").value : "0";
    
    var size_2                          = document.getElementById("size_2").checked;
    var size_2_val                      = (size_2 == true) ? document.getElementById("size_2").value : "0";
    
    var size_3                          = document.getElementById("size_3").checked;
    var size_3_val                      = (size_3 == true) ? document.getElementById("size_3").value : "0";
    
    var size_4                          = document.getElementById("size_4").checked;
    var size_4_val                      = (size_4 == true) ? custome_instruction : "0";
   
    if (jobref != '')
    {
         $.ajax
                ({
                    type: "POST",
                    url: "add_cutting_sets.php",
                    data: "service_cutting_add=1&job_reference="+encodeURIComponent(jobref)+
                          "&binding_main_option="+encodeURIComponent(binding_main_option)+"&binding_child_option="+encodeURIComponent(binding_child_option)+
                          "&front_main_option="+encodeURIComponent(front_main_option)+"&binding_child_option_front="+encodeURIComponent(binding_child_option_front)+
                          "&back_main_option="+encodeURIComponent(back_main_option)+
                          "&binding_child_option_back="+encodeURIComponent(binding_child_option_back)+"&nob="+encodeURIComponent(nob)+
                          "&cutting_option="+encodeURIComponent(cutting_option)+"&special_instruction_cutting="+encodeURIComponent(special_instruction_cutting)+
                          "&custome_instruction="+encodeURIComponent(custome_instruction)+"&special_instruction="+encodeURIComponent(special_instruction)+
                          "&size_1_val="+encodeURIComponent(size_1_val)+"&size_2_val="+encodeURIComponent(size_2_val)+
                          "&size_3_val="+encodeURIComponent(size_3_val)+"&size_4_val="+encodeURIComponent(size_4_val),
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {         
                        if(option == true){
                        window.location = "add_recipients_binding.php";
                        }
                    }
                });
    }else{
        alert('Please enter reference value');
        $("#jobref").focus();
        return false;
    }
}


function loadStart() {
$('#loading').show();
}

function loadStop() {
$('#loading').hide();
}

function use_same_set()
{   
    var use_same = document.getElementById('use_same_check_box').checked;     
    if(use_same == true){
    $("#use_same").slideDown(1000);
    $(".check").slideUp();
    $("#options_arch").slideUp();
    }else{
    $(".check").slideDown();
    $("#options_arch").slideUp();
    }
}

function ready_now(){
    alert("All orders placed online are assumed to be for today and available for collection immediately.  If you wish to       place an order for another date and time, or for today but       at a later time, please check the box at the left and then enter below a date and time for collection.");
}


function delete_added_job(ID)
{
     var ok_to_proceed = confirm('Are you sure?');
    
    if(ok_to_proceed == true){     
    $.ajax
                ({
                    type: "POST",
                    url: "add_plotting_sets.php",
                    data: "service_plotting_add=0&delete_set_id=" + ID,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                            
                        $('#sets_all').slideDown();
                        $('#sets_all').html(option);
                    }
                });
            }else{
                return false;
            }
}

function delete_option(ID)
{
    var ok_to_proceed = confirm('Are you sure?');
    
    if(ok_to_proceed == true){        
    $.ajax
                ({
                    type: "POST",
                    url: "get_recipients.php",
                    data: "recipients=delete_set&delete_set_id=" + ID,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                            
                        window.location = "service_plotting.php";

                    }
                });
            }else{
                return false;
            }
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
    
function view_plot_values()
{
    $('#set_form').hide(750);
    $('#set_values').show(750);
    $("#view_butt").hide(150); 
    $("#go_set").show(150); 
}

function go_set_form()
{    
    $("#view_butt").show(150); 
    $("#go_set").hide(150);
    $('#set_form').show(750);
    $('#set_values').hide(750);
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

function active_plot()
{
    $("#options_plott").slideDown();
    $("#options_arch").slideUp();
    $("#alt_ops").slideDown();
    $("#pick_ops").slideUp();  
    $("#use_same_check_box").slideDown();
    $("#use_same_check_box_spn").slideDown();
}

function active_plot_new()
{
    var use_same_check_box = document.getElementById("use_same_check_box").checked;
    if(use_same_check_box != true){
    $("#options_plott").slideDown();
    }
    $("#options_arch").slideUp();
    $("#alt_ops").slideDown();
    $("#pick_ops").slideUp();  
    $("#use_same_check_box").slideDown();
    $("#use_same_check_box_spn").slideDown();
}

function active_arch()
{
    $("#options_arch").slideDown();
    $("#options_plott").slideUp();
    $("#alt_ops").slideUp();
    $("#pick_ops").slideDown();
    $("#use_same_check_box").slideUp();
    $("#use_same_check_box_spn").slideUp();
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

function get_child_option()
{
    var binding_main_option = $("#binding_main_option").val();   
    var default_option      = '<option value="N/A">N/A</option>';  
    $.ajax
        ({
        type: "POST",
        url: "get_binding_option.php",
        data: "binding_main_option="+binding_main_option,
        success: function(option)
        {
            if(option != ''){
            $("#binding_child_option").html(option);
            }else{
            $("#binding_child_option").html(default_option);    
            }
        }
    });
    
}

function get_child_option_front()
{
    var binding_main_option = $("#front_main_option").val();   
    var default_option      = '<option value="N/A">N/A</option>'; 
    $.ajax
        ({
        type: "POST",
        url: "get_binding_option.php",
        data: "binding_main_option="+binding_main_option,
        success: function(option)
        {
            if(option != ''){
            $("#binding_child_option_front").html(option);
            }else{
            $("#binding_child_option_front").html(default_option);    
            }
        }
    });    
}

function get_child_option_back()
{
    var binding_main_option = $("#back_main_option").val();   
    var default_option      = '<option value="N/A">N/A</option>'; 
    $.ajax
        ({
        type: "POST",
        url: "get_binding_option.php",
        data: "binding_main_option="+binding_main_option,
        success: function(option)
        {
            if(option != ''){
            $("#binding_child_option_back").html(option);
            }else{
            $("#binding_child_option_back").html(default_option);    
            }
        }
    });
    
}


function cutting_spl_inc()
{
    var cutting_option = $("#cutting_option").val();
       
    if(cutting_option == '1'){
        $("#cutting_spl_instructions").slideDown();
        $("#special_instruction_cutting").focus();
    }else{
        $("#cutting_spl_instructions").slideUp();
    }
    
    
}

function custome_size()
{    
    var custom_size_check = document.getElementById("size_4").checked;
    if(custom_size_check == true){
        $("#custome_size_instruction").slideDown();
        $("#custome_instruction").focus();
    }else{
        $("#custome_size_instruction").slideUp();
    }
}

function custome_size_1()
{
    var custom_size_1 = document.getElementById("size_1").checked;
    if(custom_size_1 == true){
        $("#fron_back").fadeIn();
    }else{
        $("#fron_back").fadeOut();
    }
}

function custome_size_2()
{
    var custom_size_2 = document.getElementById("size_2").checked;
    if(custom_size_2 == true){
        $("#fron_back").fadeIn();
        $(".black_f").show();
        $(".white_f").show();
        $(".black_b").show();
        $(".white_b").show();
    }else{        
        $(".black_f").hide();
        $(".white_f").hide();
        $(".black_b").hide();
        $(".white_b").hide();
        $("#fron_back").fadeOut();
    }
}


function custome_size_3()
{
    var custom_size_3 = document.getElementById("size_3").checked;
    if(custom_size_3 == true){
        $("#fron_back").fadeIn();
        $(".black_f").show();
        $(".white_f").show();
        $(".black_b").show();
        $(".white_b").show();
        
        $(".two_f").hide();
        $(".three_f").hide();
        $(".four_f").hide();
        $(".five_f").hide();
        
        $(".two_b").hide();
        $(".three_b").hide();
        $(".four_b").hide();
        $(".five_b").hide();
    }else{        
        $(".black_f").hide();
        $(".white_f").hide();
        $(".black_b").hide();
        $(".white_b").hide();
        
        $(".two_f").show();
        $(".three_f").show();
        $(".four_f").show();
        $(".five_f").show();
        
        $(".two_b").show();
        $(".three_b").show();
        $(".four_b").show();
        $(".five_b").show();
        $("#fron_back").fadeOut();        
    }
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



function continue_mounting()
    {
        var job_reference       =   $("#jobref").val();
        
        var original_lam        =   $("#original_lam").val();
        var all_books           =   $("#all_books").val();
        var mounting            =   $("#mount_lam_check").val();
        var laminating          =   $("#mount_lam_check_0").val();
        var mount_lam_both      =   $("#mount_lam_check_1").val();
        
        var mounting_select     =   $("#mounting_select").val();
        var lamination_select   =   $("#lamination_select").val();
        
        var width_values        =   $("#width_values").val();
        var length_values       =   $("#length_values").val();
        var grommets            =   $("#grommets").val();        
        var mount_lam_spl       =   $("#mount_lam_spl").val();
        
        var pick                =   $("#pick").val();
        var dropoff             =   $("#dropoff").val();
        
        var pickup_date         =   $("#date_for_alt").val();
        var pickup_time         =   $("#time_for_alt").val();
        
        
         if (job_reference != '')
        {
        $.ajax
                ({
                    type: "POST",
                    url: "add_mounting_sets.php",
                    data: "all_mounting_sets=1",
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                           
                        console.log(option);
                    }
                });
        }
        
        }

 </script>
</html>
