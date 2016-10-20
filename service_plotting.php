<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);
if($_SESSION['sohorepro_companyid']  == '')
{
  header("Location:index.php");
  exit;
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

 
 <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
 <!--<link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">-->
 <link rel="stylesheet" type="text/css" href="store_files/style_layout.css" />
 <!--[if IE 7]>
 <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
 <![endif]-->
 <script src="store_files/jquery.min.js"></script>
 <script type="text/javascript" src="js/popup_script.js"></script>
 <script type="text/javascript" src="js/jquery.timepicker.js"></script>
 <link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" media="screen" />
 <script type="text/javascript" src="js/jquery.sticky.js"></script>
 
<script src="waypoints.js"></script>
<script src="waypoints-sticky.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
         $(".sticky-navigation").removeClass("pre_class");
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
.inactive_menu:hover{
    color: red !important;
}

  
 </style>
 
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


</script>
<!--<script src="jquery.js"></script>-->
<script src="jquery.form.js"></script>
<script>
 function upload_file(ID)
{
    
    var upload_val = $('#uploadedfile_'+ID).val();
    if(upload_val != '') {
    var bar = $('#bar_'+ID);
    var percent = $('#percent_'+ID);
    var status = $('#status_'+ID);

    $('#upload_file_'+ID).ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            bar.width("100%");
            percent.html("100%");
            status.html(xhr.responseText);
        }
    });
    }else{
        alert("please select the file.");
        return false;
    }
}

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

</script>

<script>
function sendFileToServer(formData,status)
{
    var uploadURL ="upload.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            status.setProgress(100);
            //alert(data);
            //$("#status1").append("File upload Done<br>");         
        }
    }); 
 
    status.setAbort(jqXHR);
    status.setRemove(jqXHR);
}
 
var rowCount=0;
function createStatusbar(obj)
{
     rowCount++;
     var row="odd";
     if(rowCount %2 ==0) row ="even";
     var james = 'jass';
     this.statusbar = $("<div class='statusbar "+row+"'></div>");
     this.filename = $("<div class='filename' id='filename_"+row+"'></div>").appendTo(this.statusbar);
     this.size = $("").appendTo(this.statusbar);
     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
     this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
     this.done = $("<div class='done-progress' onclick='return delete_upload_file();'>Remove</div>").appendTo(this.statusbar);
     obj.after(this.statusbar);
 
    this.setFileNameSize = function(name,size)
    {
        var sizeStr="";
        var sizeKB = size/1024;
        if(parseInt(sizeKB) > 1024)
        {
            var sizeMB = sizeKB/1024;
            sizeStr = sizeMB.toFixed(2)+" MB";
        }
        else
        {
            sizeStr = sizeKB.toFixed(2)+" KB";
        }
 
        this.filename.html(name);
        this.size.html(sizeStr);
    }
    this.setProgress = function(progress)
    {       
        var progressBarWidth =progress*this.progressBar.width()/ 100;  
        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
        if(parseInt(progress) >= 100)
        {
            this.abort.hide();
            this.done.show();
        }
    }
    this.setAbort = function(jqxhr)
    {
        var sb = this.statusbar;
        this.abort.click(function()
        {
            jqxhr.abort();
            sb.hide();
        });
    }
    
    this.setRemove = function(jqxhr)
    {
        var sb = this.statusbar;
        this.done.click(function()
        {           
            jqxhr.done();
            sb.hide();
        });
    }
}
function handleFileUpload(files,obj)
{
   for (var i = 0; i < files.length; i++) 
   {
        var fd = new FormData();
        fd.append('file', files[i]);
 
        var status = new createStatusbar(obj); //Using this we can set progress.
        status.setFileNameSize(files[i].name,files[i].size);
        sendFileToServer(fd,status);
 
   }
}
$(document).ready(function()
{
var obj = $("#dragandrophandler");
obj.on('dragenter', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '2px solid #0B85A1');
});
obj.on('dragover', function (e) 
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on('drop', function (e) 
{
 
     $(this).css('border', '2px dotted #0B85A1');
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
 
     //We need to send dropped files to Server
     handleFileUpload(files,obj);
});
$(document).on('dragenter', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e) 
{
  e.stopPropagation();
  e.preventDefault();
  obj.css('border', '2px dotted #0B85A1');
});
$(document).on('drop', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});
 
});


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

var rowCount=0;
function delete_upload_file()
{ 
    rowCount++;
     var row = "even";
     if(rowCount %2 ==0) row ="odd";  
     //alert(row);
     var mb = $('#filename_'+row).text();
     //alert("Value of div is: " + mb); 
        $.ajax
        ({
        type: "POST",
        url: "get_recipients.php",
        data: "delete_upload_files=9&file_name="+mb,
        success: function(option)
        {

        }
        });
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

function edit_job_type(ID)
{
    $("#job_type_"+ID).hide();
    $("#job_type_drop_"+ID).show();
}

function update_job_type(ID)
{
    var job_type_drop = $("#job_type_drop_"+ID).val();
    
    if(job_type_drop != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_job_type=1&job_type_drop="+encodeURIComponent(job_type_drop)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                 
                $("#job_type_drop_"+ID).hide();
                $("#job_type_"+ID).html(option);
                $("#job_type_"+ID).show();
            }
        }); 
    }
}

function edit_original_option(ID)
{
    $("#original_p_"+ID).hide();
    $("#original_txt_"+ID).show();
    $("#action_original_"+ID).fadeIn();
}



function cancel_original(ID)
{
    $("#action_original_"+ID).fadeOut(); 
    $("#original_p_"+ID).show();
    $("#original_txt_"+ID).hide();       
}

function update_original(ID)
{
    var original_val = $("#original_txt_"+ID).val();
    
    if(original_val != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_original=1&original_val="+encodeURIComponent(original_val)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                $("#original_p_"+ID).html(option);
                $("#original_p_"+ID).show();
                $("#original_txt_"+ID).hide();
                $("#action_original_"+ID).fadeOut();                
            }
        }); 
    }  
    
}

function edit_poe_option(ID)
{
    $("#poe_p_"+ID).hide();
    $("#poe_txt_"+ID).show();
    $("#action_poe_"+ID).fadeIn();
}

function cancel_poe(ID)
{
    $("#action_poe_"+ID).fadeOut(); 
    $("#poe_p_"+ID).show();
    $("#poe_txt_"+ID).hide();       
}

function update_poe(ID)
{
    var poe_val = $("#poe_txt_"+ID).val();
    
    if(poe_val != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_poe=1&poe_val="+encodeURIComponent(poe_val)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                $("#poe_p_"+ID).html(option);
                $("#action_poe_"+ID).fadeOut(); 
                $("#poe_p_"+ID).show();
                $("#poe_txt_"+ID).hide();                 
            }
        }); 
    } 
}

function edit_size_option(ID)
{
    $("#size_p_"+ID).hide();
    $("#size_drop_"+ID).show();
}

function edit_output_option(ID)
{
    $("#output_p_"+ID).hide();
    $("#output_drop_"+ID).show();
}

function update_output(ID)
{
    var output_drop = $("#output_drop_"+ID).val();
    if(ID != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_output=1&output_drop="+encodeURIComponent(output_drop)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {    
                $("#output_p_"+ID).html(option);
                $("#output_p_"+ID).show();
                $("#output_drop_"+ID).hide();
            }
        }); 
    }
}

function edit_media_option(ID)
{
    $("#media_p_"+ID).hide();
    $("#media_drop_"+ID).show();
}

function update_media(ID)
{
    var media_drop = $("#media_drop_"+ID).val();
    if(ID != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_media=1&media_drop="+encodeURIComponent(media_drop)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {    
                $("#media_p_"+ID).html(option);
                $("#media_p_"+ID).show();
                $("#media_drop_"+ID).hide();
            }
        }); 
    }
}

function edit_binding_option(ID)
{
    $("#binding_p_"+ID).hide();
    $("#binding_drop_"+ID).show();
}

function update_binding(ID)
{
    var binding_drop = $("#binding_drop_"+ID).val();
    if(ID != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_binding=1&binding_drop="+encodeURIComponent(binding_drop)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {    
                $("#binding_p_"+ID).html(option);
                $("#binding_p_"+ID).show();
                $("#binding_drop_"+ID).hide();
            }
        }); 
    }
}

function edit_folding_option(ID)
{
    $("#folding_p_"+ID).hide();
    $("#folding_drop_"+ID).show();
}

function update_folding(ID)
{
    var folding_drop = $("#folding_drop_"+ID).val();
    if(ID != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_folding=1&folding_drop="+encodeURIComponent(folding_drop)+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {    
                $("#folding_p_"+ID).html(option);
                $("#folding_p_"+ID).show();
                $("#folding_drop_"+ID).hide();
            }
        }); 
    }
}

function update_size(ID)
{
    var size_drop = $("#size_drop_"+ID).val();
    if(size_drop != "Custom"){
        $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "get_custome_element_option=1&option_id="+ID+"&size_drop="+size_drop,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                $("#size_p_"+ID).html(size_drop);
                $("#size_p_"+ID).show();
                $("#size_drop_"+ID).hide();
            }
        });        
    }else{        
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "get_custome_element=1&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                $("#custome_details_"+ID).html(option);
                $("#custome_details_"+ID).show(); 
                $("#custome_dtls_"+ID).hide();
                $("#cust_dtls_txt_"+ID).show();
                $("#cust_dtls_txt_"+ID).focus();
                $("#action_cust_dtls_"+ID).show();
            }
        });
    }        
}

function edit_custome(ID)
{
    $("#custome_dtls_"+ID).hide();
    $("#cust_dtls_txt_"+ID).show();
    $("#action_cust_dtls_"+ID).show();
}


function cancel_cust_dtls(ID)
{
    $("#custome_dtls_"+ID).show();
    $("#cust_dtls_txt_"+ID).hide();
    $("#action_cust_dtls_"+ID).hide();
}

function update_cust_details(ID)
{
    var cust_dtls = $("#cust_dtls_txt_"+ID).val();
    var size_drop = $("#size_drop_"+ID).val();
    if(cust_dtls != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_cust_dtls=1&cust_dtls="+encodeURIComponent(cust_dtls)+"&size_drop="+size_drop+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                //var option_split = option.split("~");
                $("#custome_dtls_"+ID).html(option);
                $("#custome_dtls_"+ID).show();
                $("#cust_dtls_txt_"+ID).hide();
                $("#action_cust_dtls_"+ID).hide(); 
                $("#size_p_"+ID).html(size_drop);
                $("#size_p_"+ID).show();
                $("#size_drop_"+ID).hide();
            }
        }); 
    }
}


function edit_custome_page(ID)
{
    $("#custome_page_dtls_"+ID).hide();
    $("#cust_page_dtls_txt_"+ID).show();
    $("#action_cust_page_dtls_"+ID).show();
}


function update_cust_page_details(ID){
    
    var cust_page_dtls  = $("#cust_page_dtls_txt_"+ID).val();
    var output_drop     = $("#output_drop_"+ID).val();
    if(cust_page_dtls != ''){
    $.ajax
        ({
            type: "POST",
            url: "inline_edit_entered_option.php",
            data: "edit_cust_page_dtls=1&cust_page_dtls="+encodeURIComponent(cust_page_dtls)+"&output_drop="+output_drop+"&option_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                //var option_split = option.split("~");
                $("#custome_page_dtls_"+ID).html(option);
                $("#custome_page_dtls_"+ID).show();
                $("#cust_page_dtls_txt_"+ID).hide();
                $("#action_cust_page_dtls_"+ID).hide(); 
            }
        }); 
    }
}
</script>

 </head>
 <body>
    <div id="loading" class="none"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1000;">
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
     
     <div id="are_you_continue" style="display: none;font-size: 15px;position: fixed;top: 25%;left: 40%;padding: 5px;z-index: 10;z-index: 1000;width: 35%;background: white;border-bottom: 1px solid #aaa;border-radius: 4px;box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);border: 1px solid rgba(0, 0, 0, 0.1);background-clip: padding-box;">
        <div style="width: 96%;padding: 2%;float: left;font-size: 14px;line-height: 18px;text-align: center;">
            <!--<div class="close" onclick="close_cart_prompt();"></div>-->
            <span class="ecs_tooltip" style="right: -47px !important;top: -35px !important;font-weight: bold !important;">Close <span class="arrow"></span></span>
            <div style="width: 100%;float: left;font-weight: bold;font-size: 35px;">Continue Session?</div>
            <div style="width: 100%;float: left;font-weight: bold;font-size: 22px;line-height: 50px;">
                Jump to:
                <select id="all_services">
                    <option value="PAC">PLOTTING & ARCHITECTURAL COPIES</option>
                    <option value="LFP" selected="selected">LARGE FORMAT COLOR & BW</option>
                    <option value="FAP">FINE ART PRINTING</option>
                    <option value="ML">MOUNTING & LAMINATING</option>
                    <option value="BIN">BINDING</option>
                    <option value="OFP">OFFSET PRINTING</option>
                    <option value="SCN">SCANNING</option>
                    <option value="CPS">COPY SHOP</option>                    
                </select>
                <span class="all_services_go" onclick="return go_to_other_service();">GO</span>
                <!--<span class="all_services_go" onclick="return go_to_cart();">GO</span>-->
            </div>
            <div class="chechout_btn_main">
                <div class="chechout_btn_main_cont" onclick="return go_to_cart();">
                    <div class="chechout_btn">Checkout</div>
                    <div class="chechout_btn_logo"><img src="images/shopping-cart.png" /></div>
                </div>                
            </div>
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
                    $user_id_add_set        = $_SESSION['sohorepro_userid'];
                    $company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
                    $check_plotting         = PlottingSetWithoutOrderId($company_id_view_plot, $user_id_add_set);
                    $check_plotting_needed  = PlottingNeededSetWithoutOrderId($company_id_view_plot, $user_id_add_set);   
                    $check_plotting_files   = UploadFileExist($company_id_view_plot, $user_id_add_set);
                    
                    ?>
                      <input type="hidden" name="cart_count_pac" id="cart_count_pac" value="<?php echo count($cart_count_pac); ?>" />
                <!-- Entered Sets Start -->
                <?php
                if($_GET['set_existed'] == "1"){
                $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
                $count_option = count($enteredPlotPrimay) + 1;
                ?>
                <div  id="sets_all">
                <?php
                if(count($enteredPlotPrimay) > 0){
                $i = 1;                
                foreach ($enteredPlotPrimay as $plot) {
                    $job_type = ($plot['plot_arch'] == '1') ? 'Plotting' : 'Architectural Copies';
                    $file_upload_exist = UploadFileExist($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid']);
                    $output = ($plot['output'] == 'Both') ? $plot['output'].' <b>B&W and COLOR</b>' : $plot['output'];
                ?>                    
                    <div class="plot_container" style="width: 100%;float: left;border: 1px #FF7E00 solid;margin-bottom: 20px;">
                                <div class="plot_wrap" style="padding: 5px;">
                                    <div style="width: 100%;float: left;margin-bottom: 10px;">
                                        <div style="float: left;width: 45%;font-weight: bold;">Job Option - <?php echo $i; ?></div>
                                        <div style="float: left;width: 50%;font-weight: bold;text-align: right;cursor: pointer;" onclick="return delete_added_job(<?php echo $plot['id']; ?>);"><span style="background: #D84B36;color: #FFF;padding: 2px 8px;border-radius: 5px;margin-top: 3px;font-weight: bold;">Delete</span></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <label>Job Type: </label>
                                            <p id="job_type_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_job_type('<?php echo $plot['id']; ?>');"><?php echo $job_type; ?></p>
                                            <select class="none" id="job_type_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_job_type('<?php echo $plot['id']; ?>');">
                                                <option <?php if($plot['plot_arch'] == '1'){ ?> selected="selected" <?php } ?> value="1">Plotting</option>
                                                <option <?php if($plot['plot_arch'] == '0'){ ?> selected="selected" <?php } ?> value="0">Architectural Copies</option>
                                            </select>
                                        </li>
                                        <li>
                                            <label>Originals:</label>
                                            <p id="original_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_original_option('<?php echo $plot['id']; ?>');"><?php echo $plot['origininals']; ?></p>                        
                                            <input type="text" name="original_txt_<?php echo $plot['id']; ?>" id="original_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['origininals']; ?>" class="none" style="width: 40px;float: left;" />
                                            <div id="action_original_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                                                <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_original('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                                <img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_original('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                            </div>                        
                                        </li>
                                        <li>
                                            <label>Prints of Each:</label>
                                            <p id="poe_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_poe_option('<?php echo $plot['id']; ?>');"><?php echo $plot['print_ea']; ?></p>
                                            <input type="text" name="poe_txt_<?php echo $plot['id']; ?>" id="poe_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['print_ea']; ?>" class="none" style="width: 40px;float: left;" />
                                            <div id="action_poe_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                                                <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_poe('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                                <img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_poe('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                            </div>
                                        </li>
                                        <li>
                                            <label>Size:</label>
                                            <p id="size_p_<?php echo $plot['id']; ?>" onclick="return edit_size_option('<?php echo $plot['id']; ?>');" style="cursor: pointer;"><?php echo $plot['size']; ?></p>
                                            <select class="none" id="size_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_size('<?php echo $plot['id']; ?>');">
                                                <option <?php if($plot['size'] == strtoupper('FULL')){ ?> selected="selected" <?php } ?> value="FULL" >FULL</option>
                                                <option <?php if($plot['size'] == strtoupper('HALF')){ ?> selected="selected" <?php } ?> value="HALF">HALF</option>
                                                <option <?php if($plot['size'] == strtoupper('Reduce To 11 X 17')){ ?> selected="selected" <?php } ?> value="Reduce to 11 X 17">Reduce to 11 X 17</option>
                                                <option <?php if($plot['size'] == strtoupper('Custom')){ ?> selected="selected" <?php } ?> value="Custom">Custom</option>  
                                            </select>
                                        </li>
                                        <li>
                                            <label>Output:</label>
                                            <p id="output_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_output_option('<?php echo $plot['id']; ?>');"><?php echo $output; ?></p>
                                            <select class="none" id="output_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_output('<?php echo $plot['id']; ?>');">
                                                <option <?php if($output == strtoupper('B/W')){ ?> selected="selected" <?php } ?>  value="B/W">B/W</option>
                                                <option <?php if($output == strtoupper('Color')){ ?> selected="selected" <?php } ?> value="Color">Color</option>
                                                <option <?php if($output == strtoupper('Both')){ ?> selected="selected" <?php } ?> value="Both">Both</option>
                                            </select>
                                        </li>
                                        <li>
                                            <label>Media:</label>
                                            <p id="media_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_media_option('<?php echo $plot['id']; ?>');"><?php echo $plot['media']; ?></p>
                                            <select class="none" id="media_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_media('<?php echo $plot['id']; ?>');">
                                                <option <?php if($plot['media'] == strtoupper('Bond')){ ?> selected="selected" <?php } ?>  value="Bond">Bond</option>
                                                <option <?php if($plot['media'] == strtoupper('Vellum')){ ?> selected="selected" <?php } ?> value="Vellum">Vellum</option>
                                                <option <?php if($plot['media'] == strtoupper('Mylar')){ ?> selected="selected" <?php } ?> value="Mylar">Mylar</option>       
                                            </select>
                                        </li>
                                        <li>
                                            <label>Binding:</label>
                                            <p id="binding_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_binding_option('<?php echo $plot['id']; ?>');"><?php echo $plot['binding']; ?></p>
                                            <select class="none" id="binding_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_binding('<?php echo $plot['id']; ?>');">
                                                <option <?php if($plot['binding'] == strtoupper('none')){ ?> selected="selected" <?php } ?> value="none">None</option>                                      
                                                <option <?php if($plot['binding'] == strtoupper('Bind All')){ ?> selected="selected" <?php } ?> value="Bind All">Bind All</option>                          
                                                <option <?php if($plot['binding'] == strtoupper('Bind by Discipline')){ ?> selected="selected" <?php } ?> value="Bind by Discipline">Bind by Discipline</option>
                                                <option <?php if($plot['binding'] == strtoupper('Screw Post')){ ?> selected="selected" <?php } ?> value="Screw Post">Screw Post</option>     
                                            </select>
                                        </li>
                                        <li>
                                            <label>Folding:</label>
                                            <p id="folding_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_folding_option('<?php echo $plot['id']; ?>');"><?php echo $plot['folding']; ?></p>
                                            <select class="none" id="folding_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_folding('<?php echo $plot['id']; ?>');">
                                                <option <?php if($plot['folding'] == strtoupper('None')){ ?> selected="selected" <?php } ?> value="None">None</option>
                                                <option <?php if($plot['folding'] == strtoupper('Yes')){ ?> selected="selected" <?php } ?> value="Yes">Yes</option>    
                                            </select>
                                        </li>
                                    </ul>
                                    <ul style="margin-left: 20px;">
                                        <div id="custome_details_<?php echo $plot['id']; ?>">
                                        <?php
                                        if ($plot['size'] == strtoupper('Custom')) {
                                            ?>

                                            <li>
                                                <label>Custom Size Details: </label>
                                                <p style="cursor: pointer;" id="custome_dtls_<?php echo $plot['id']; ?>" onclick="return edit_custome('<?php echo $plot['id']; ?>');"><?php echo $plot['custome_details']; ?></p>
                                                <input type="text" name="cust_dtls_txt_<?php echo $plot['id']; ?>" id="cust_dtls_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['custome_details']; ?>" class="none" style="width: 60px;float: left;" />
                                                <div id="action_cust_dtls_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                                                    <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_cust_details('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                                    <!--<img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_cust_dtls('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">-->
                                                </div>
                                            </li>                        
                                        <?php } ?>
                                        </div>
                                    </ul>
                                    <ul id="color_page_dtls_<?php echo $plot['id']; ?>">
                                        <?php
                                        if ($plot['output'] == strtoupper('Both')) { ?>
                                        <li>
                                            <label>Color Page Number:</label>
                                            <p style="cursor: pointer;" id="custome_page_dtls_<?php echo $plot['id']; ?>" onclick="return edit_custome_page('<?php echo $plot['id']; ?>');"><?php echo $plot['output_both']; ?></p>
                                            <input type="text" name="cust_page_dtls_txt_<?php echo $plot['id']; ?>" id="cust_page_dtls_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['output_both']; ?>" class="none" style="width: 60px;float: left;" />
                                            <div id="action_cust_page_dtls_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                                                <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_cust_page_details('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                                <!--<img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_cust_dtls('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">-->
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <div style="width: 100%;float: left;margin-top: 5px;">
                                        <?php if(($file_upload_exist[0]['job_id'] != '') || ($plot['ftp_link'] != '0') || ($plot['pick_up'] != '0') || ($plot['drop_off'] != '0')){ ?>
                                        <div style="float: left;width: 100%;margin-top: 5px;font-weight: bold;">File Options</div>
                                        <?php } ?>
                                        <?php
                                        if($plot['use_same_alt'] == '0'){
                                        if ($plot['upload_file'] != '') {
                                            ?>
                                            <div style="float: left;width: 100%;">
                                                <div style="float: left;width: 100%;text-decoration: underline;">Upload File</div>                            
                                                <div style="float: left;width: 100%;"><?php echo $plot['upload_file']; ?></div>                               
                                            </div>
                                        <?php } elseif ($plot['ftp_link'] != '0') {
                                                $link       = ($plot['ftp_link'] != '0') ? $plot['ftp_link'] : '';
                                                $user_name  = ($plot['user_name'] != '0') ? $plot['user_name'] : '';
                                                $password   = ($plot['password'] != '0') ? $plot['password'] : '';
                                            ?>
                                            <div style="float: left;width: 100%;">
                                                <div style="float: left;width: 100%;text-decoration: underline;">Provide Link to File</div>
                                                <div style="float: left;width: 100%;">FTP Link  : <?php echo $link; ?></div>
                                                <div style="float: left;width: 100%;">User Name : <?php echo $user_name; ?></div>
                                                <div style="float: left;width: 100%;">Password  : <?php echo $password; ?></div>
                                            </div>
                                        <?php } elseif ($plot['pick_up'] != '0') {
                                                if(($plot['pick_up'] == 'ASAP') && ($plot['pick_up_time'] == 'ASAP')){
                                              ?>
                                                <div style="float: left;width: 100%;">
                                                      <div style="float: left;width: 100%;">Schedule a pick up Date/Time: <?php echo $plot['pick_up']; ?></div>
                                                      <!--<div style="float: left;width: 100%;">Pickup Date : <?php echo $plot['pick_up']; ?></div>-->
                    <!--                                  <div style="float: left;width: 100%;">Pickup Time  : <?php //echo $plot['pick_up_time']; ?></div>-->
                                                </div>
                                              <?php
                                                }else{
                                            ?>
                                            <div style="float: left;width: 100%;">
                                                <div style="float: left;width: 100%;margin-bottom: 10px;">Schedule a pick up Date/Time: <?php echo $plot['pick_up'].'&nbsp;'.$plot['pick_up_time']; ?></div>
                    <!--                            <div style="float: left;width: 100%;">Pickup Date : <?php //echo $plot['pick_up']; ?></div>
                                                <div style="float: left;width: 100%;">Pickup Time  : <?php //echo $plot['pick_up_time']; ?></div>-->
                                            </div>
                                                <?php }} elseif ($plot['drop_off'] != '0') { ?>
                                            <div style="float: left;width: 100%;">
                                                <div style="float: left;width: 100%;text-decoration: underline;">Drop off at Soho Repro</div>                       
                                                <div style="float: left;width: 100%;margin-bottom: 10px;">Drop off at : <?php echo $plot['drop_off']; ?></div>
                                            </div>   
                                        <?php
                                        }
                                        }else{
                                        ?>
                                        <div style="float: left;width: 100%;">
                                            <div style="float: left;width: 100%;margin-bottom: 10px;">Use the Same File as in Job Option <?php echo ($plot['use_same_alt']); ?></div>
                                        </div>   
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <?php if($plot['my_office_alt'] != '0'){ 

                                        $address_dtls    = SelectLastEnteredAddress($plot['address_book_id']);
                                        $address_2       = ($address_dtls[0]['address_2'] != '') ? $address_dtls[0]['address_2'].'<br>' : '';
                                        $address_3       = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'].'<br>' : '';
                                        $address_string  = $address_dtls[0]['company_name'].'<br>'.$address_dtls[0]['address_1'].'<br>'.$address_2.$address_3.$address_dtls[0]['city'].',&nbsp;'.StateName($address_dtls[0]['state']).'&nbsp;'.$address_dtls[0]['zip'];

                                        $option_sechdule = ($plot['my_office_alt'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>'.$address_string;

                                        ?>
                                    <div style="width: 100%;float: left;margin-top: 7px;">                    
                                        <div style="float: left;width: 22%;margin-top: 5px;font-weight: bold;">Schedule a pick-up Option:</div>
                                        <div style="float: left;width: 50%;margin-top: 5px;">                        
                                            <div style="float: left;width: 100%;"><?php echo $option_sechdule; ?></div>
                                        </div> 
                                    </div>
                                        <?php } ?>


                                        <?php if($plot['spl_instruction'] != ''){ ?>
                                    <div style="width: 100%;float: left;margin-top: 7px;">                    
                                        <div style="float: left;width: 100%;margin-top: 5px;font-weight: bold;">Special Instructions</div>
                                        <div style="float: left;width: 100%;">                        
                                            <div style="float: left;width: 100%;"><?php echo $plot['spl_instruction']; ?></div>
                                        </div> 
                                    </div>
                                        <?php } ?>

                                </div>
                            </div>
                <?php  
                $i++;
                }                
                ?>
                 <!-- Entered Sets End -->
                 <!--New Job Add Start -->
                            <div class="serviceOrderSetHolder">
                                <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
                                    Job Option - <?php echo $count_option; ?>
                                    <div style="float:right;font-weight: bold;">                                          
                                    </div>
                                </label>  
                                <input type="hidden" name="optint_count_check" id="optint_count_check" value="<?php echo count($enteredPlotPrimay); ?>" />
                                <input type="hidden" name="optint_count_check_i" id="optint_count_check_i" value="<?php echo $added_cart_session; ?>" />

                                <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                                    <div class="serviceOrderSetWapperInternal">
                                        <div class="serviceOrderSetDIV">
                                            <div style="width: 100%;float: left;padding-top: 10px;">  

                                                <!--JASSIM-->                        
                                                <input type="checkbox"  style="width: 2%;margin-bottom: 20px;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set();" /><span id="use_same_check_box_spn">Use the same File as in Job Option <?php echo ($count_option - 1); ?></span>
                                                <!--End-->

                                                <!--Check Box Start-->
                                                <div style="float:left;width:100%;">
                                                    <ul class="arch_radio">
                                                        <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot_new();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
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
                                                    <input class="order_0_set1_0_original k-input kdText " style="width:50px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                                                <option value="Reduce to 11 X 17">Reduce to 11 X 17</option>
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
                                                                <option value="B/W">B/W</option>
                                                                <option value="Color">Color</option>
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
                                                            <select class="order_0_set1_0_media kdSelect " style="width: 70px;" id="media" name="media">
                                                                <option value="Bond">Bond</option>
                                                                <option value="Vellum">Vellum</option>
                                                                <option value="Mylar">Mylar</option>                          
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
                                                            <select class="order_0_set1_0_binding kdSelect " style="width: 130px;" id="binding" name="binding">
                                                                <option value="none">None</option>                                      
                                                                <option value="Bind All">Bind All</option>                          
                                                                <option value="Bind by Discipline">Bind by Discipline</option>
                                                                <option value="Screw Post">Screw Post</option>
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
                                                            <select class="order_0_set1_0_folding kdSelect " style="width: 100px;" id="folding" name="folding">
                                                                <option value="none">None</option>
                                                                <option value="Yes">Yes</option>                          
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
                                                <label>Please Specify Custom Details : </label><textarea name="size_custom" id="size_custom" rows="3" cols="18" style="width: 201px;" placeholder="Custom Size"></textarea>
                                            </div>
                                            <!--Custom Details End-->
                                            <!--Page Number Details Start-->
                                            <div id="output_both_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                                                <label>Enter page numbers that are in COLOR (separated by a comma) :</label>
                                                <input type="text" name="output_both" id="output_both" style="width: 200px;" />
                                            </div>
                                            <!--Page Number Details End-->

                                            <div style="width:730px;border-bottom: 1px solid #CCCCCC;float: left;">

                        <!--                        <label style="font-weight: bold;height:28px">
                                                    Alternative File Options<span style="color: red;">*</span>
                                                </label>
                                                <input type="checkbox"  style="width: 2%;margin-bottom: 20px;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set();" /><span id="use_same_check_box_spn">Use the same File Option as in Job Option <?php echo ($count_option - 1); ?></span>-->
                                                <div id="options_plott" class="check" style="/*margin-top: 5px;*/">
                                                    <label id="alt_ops" style="font-weight: bold;">
                                                        File Options<span style="color: red;">*</span>
                                                    </label>
                                                    <div style="width:730px;border-top: 1px solid #FF7E00;">                                
                                                    </div>
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
                                                                <span>If providing an FTP link, please include username and password.</span>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                    <!--FTP Details Start-->

                                                    <!--Pickup Details Start-->
                                                    <div id="date_time" style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
                                                        <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                                        <div style="width: 34%;float: left;"> 

                                                            <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;">
                                                                <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                                            </div>

                                                            <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                                                <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_revele();" />
                                                                <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                                            </div>

                                                        </div>

                                                        <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: auto;">
                                                            <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                                                <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" value="my_office" />My Office
                                                            </div>
                                                            <div style="float: left;width: 45%;border: 0px #F99B3E solid;margin-top: 30px;">
                                                                <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                                                <select style="margin-bottom: 10px;"  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
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
                                                                <div style="float: left;width: 40%;border: 0px #F99B3E solid;">&nbsp;</div>
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
                                                                    <div class="alt_new_address_container_ftr">
                                                                        <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                                        <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--Pickup Details End-->

                                                    <!--Drop off Details Start-->
                                                    <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off">
                                                        <div style="margin: auto;width: 60%;">
                                                            <div style="margin: auto;width: 75%;float:right;">
                                                                <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broome Street" />381 Broome Street
                                                                <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
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
                            <!--New Job Add End-->                 
                 </div>
                <?php }else{ ?>
                    
                    <div  id="sets_all">               
                    <?php
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
                    
                    if(count($check_plotting) > 0){
                        $delete_empty = "DELETE FROM sohorepro_service_lfp WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                        mysql_query($delete_empty);
                    }
                                        
                    $delete_empty_fap = "DELETE FROM sohorepro_fine_arts_sets WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."'";
                    mysql_query($delete_empty_fap);
                    ?>
                    <div class="serviceOrderSetHolder">
                        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
                        Job Options - Option 1 
                        <div style="float:right;font-weight: bold;">&nbsp;</div>
                        <input type="hidden" name="optint_count_check" id="optint_count_check" value="0" />
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
                                    <input class="order_0_set1_0_original k-input kdText " style="width:50px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                            <option value="Reduce to 11 X 17">Reduce to 11 X 17</option>
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
                                        <option value="B/W">B/W</option>
                                        <option value="Color">Color</option>
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
                                      <select class="order_0_set1_0_media kdSelect " style="width: 70px;" id="media" name="media">
                                        <option value="Bond">Bond</option>
                                        <option value="Vellum">Vellum</option>
                                        <option value="Mylar">Mylar</option>                          
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
                                      <select class="order_0_set1_0_binding kdSelect " style="width: 130px;" id="binding" name="binding">
                                        <option value="none">None</option>                                      
                                        <option value="Bind All">Bind All</option>                          
                                        <option value="Bind by Discipline">Bind by Discipline</option>
                                        <option value="Screw Post">Screw Post</option>
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
                                      <select class="order_0_set1_0_folding kdSelect " style="width: 100px;" id="folding" name="folding">
                                        <option value="None">None</option>
                                        <option value="Yes">Yes</option>                          
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
                                foreach ($all_days_off as $days_off_split){
                                    $all_days_in[]  = $days_off_split['date'];
                                }                                                        
                                $all_date  = implode(",", $all_days_in);                                                        
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
                      
                      <div id="date_time" style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
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
                                
                                <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: auto;">
                                    <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" value="my_office" />My Office
                                    </div>
                                    <div style="float: left;width: 45%;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                        <select style="margin-bottom: 10px;"  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
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
                                        <div style="float: left;width: 40%;border: 0px #F99B3E solid;">&nbsp;</div>
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
                                            <div class="alt_new_address_container_ftr">
                                                <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                            </div>
                                        </div>
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
                
                
                <?php } }else{
                ?>
                <div  id="sets_all">               
                    <?php
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
                    
                    if(count($check_plotting) > 0){
                        $delete_empty = "DELETE FROM sohorepro_service_lfp WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                        mysql_query($delete_empty);
                    }
                    
                    $delete_empty_fap = "DELETE FROM sohorepro_fine_arts_sets WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."'";
                    mysql_query($delete_empty_fap);
                    ?>
                    <script>
                        $(document).ready(function(){
                            $('#cart_count').hide();
                            
                        });
                        </script>
                    <div class="serviceOrderSetHolder">
                        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
                        Job Options - Option 1 
                        <div style="float:right;font-weight: bold;">&nbsp;</div>
                        <input type="hidden" name="optint_count_check" id="optint_count_check" value="0" />
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
                                    <input class="order_0_set1_0_original k-input kdText " style="width:50px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                            <option value="Reduce to 11 X 17">Reduce to 11 X 17</option>
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
                                        <option value="B/W">B/W</option>
                                        <option value="Color">Color</option>
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
                                      <select class="order_0_set1_0_media kdSelect " style="width: 70px;" id="media" name="media">
                                        <option value="Bond">Bond</option>
                                        <option value="Vellum">Vellum</option>
                                        <option value="Mylar">Mylar</option>                          
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
                                      <select class="order_0_set1_0_binding kdSelect " style="width: 130px;" id="binding" name="binding">
                                        <option value="none">None</option>                                      
                                        <option value="Bind All">Bind All</option>                          
                                        <option value="Bind by Discipline">Bind by Discipline</option>
                                        <option value="Screw Post">Screw Post</option>
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
                                      <select class="order_0_set1_0_folding kdSelect " style="width: 100px;" id="folding" name="folding">
                                        <option value="None">None</option>
                                        <option value="Yes">Yes</option>                          
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
                                foreach ($all_days_off as $days_off_split){
                                    $all_days_in[]  = $days_off_split['date'];
                                }                                                        
                                $all_date  = implode(",", $all_days_in);                                                        
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
                      
                      <div id="date_time" style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
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
                                
                                <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: auto;">
                                    <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" value="my_office" />My Office
                                    </div>
                                    <div style="float: left;width: 45%;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                        <select style="margin-bottom: 10px;"  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
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
                                        <div style="float: left;width: 40%;border: 0px #F99B3E solid;">&nbsp;</div>
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
                                            <div class="alt_new_address_container_ftr">
                                                <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                            </div>
                                        </div>
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
            <?php
            }
            ?>
               <!-- FOR EACH END -->     
                  
             
                    
              <div style="float:left;width:100%;text-align:right;margin-top: 10px;">                  
                  <input class="addproductActionLink" value="Save to Cart and Continue" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 180px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -1px !important;" type="button" onclick="return validate_plotting_cont_pre();" />
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
            .set_ul{
                list-style: none;
                width: 90%;
                margin: 0 auto;
                margin-top: 10px;   
            }
            .set_ul li{               
                width: 100%;
                float: left;
                padding: 5px;                
            }
            .head_plat{
                background: #ff7e00 !important;
                padding: 5px;
            }
            .head_plat span{
                font-size: 14px !important;
                font-weight: bold;           
            }
            .set_ul li span{              
                width: 33%;
                text-align: center;
                float: left;                
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
<div class="clear"></div>


 </div>

 <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>

 
 <script>
     
  function validate_plotting()
  {  
   //$("body").append("<div class='modal-overlay'></div>");  
    var jobreference        =   document.getElementById("jobref").value;
    var optint_count_check  =   document.getElementById("optint_count_check").value;
    
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
    var uploadedfile_pre    = $(".filename").html();
    var uploadedfile_option = (uploadedfile_pre != "") ? uploadedfile_pre : '';
    
    var date_for_alt        = document.getElementById("date_for_alt").value;
    var date_for_alt_arc    = document.getElementById("date_for_alt_arc").value;
    if(date_for_alt != ''){
        var date_for_alt_val    = date_for_alt;
    }else if(date_for_alt_arc != ''){
        var date_for_alt_val    = date_for_alt_arc;
    }else{
        var date_for_alt_val    = '0';
    }
    
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
    
    
    var uploadedfile        =   $("#filename_odd").html();   
    var dropoff             =   $("#dropoff").val();
    var drop_file           =   document.getElementById("drop_file").checked;
    var link                =   document.getElementById("link").checked;
   
    var validate_imp        =   $("#validate_imp").val();
    //alert(validate_imp);
    
    
    if(jobreference == ''){
        alert('Please enter the Job Reference');
        document.getElementById("jobref").focus();
        $("#jobref").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#jobref").css("background-color", "#FFF");
        //validate_plotting_cont();
    }
    
    if(optint_count_check >= '1'){
        if(print_ea == ''){       
           window.location = "add_recipients.php";
           return true;      
        }
    }
    
    if($('input[name=plotting_check]:checked').length<=0)
    {
        alert('Please select a job type');
        document.getElementById("plotting_check").focus();
        $("#plotting_check_spn").css("background-color", "#FFFF00");
        $("#plotting_check_0_spn").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#plotting_check_spn").css("background-color", "#FFF");
        $("#plotting_check_0_spn").css("background-color", "#FFF");
    }
    
    if(print_ea == ''){
        alert('Please enter Prints of Each');
        document.getElementById("print_ea").focus();
        $("#print_ea").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#print_ea").css("background-color", "#FFF");
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
        $("#size_custom").css("background-color", "#FFFF00");
        return false;  
        }else{
        $("#size_custom").css("background-color", "#FFFF");    
        }        
    }
    //(dropoff == '') ||
    //|| (ftp_link == '')
    if(validate_imp == ''){
        alert('Please select the file option');
        $(".spl_option").css("background-color", "#FFFF00");
        return false;
    }else{
        $(".spl_option").css("background-color", "#FFF");
    }
    
    if(alternate_1 == true){
        if(address_book_se == '0'){
        alert('Please select the address');
        $("#address_book_se").css("border","1px solid red");
        return false;
        }else{
        $("#address_book_se").css("border","1px solid #CCC");
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
                          "&user_name_val="+encodeURIComponent(user_name_val)+"&password_val="+encodeURIComponent(password_val)+
                          "&size_custom="+encodeURIComponent(size_custom)+"&uploadedfile_option="+encodeURIComponent(uploadedfile_option)+
                          "&my_office_alt="+encodeURIComponent(my_office_alt)+"&address_book_se_val="+encodeURIComponent(address_book_se_val),
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                              
                        $('#sets_all').slideDown();
                        $('#sets_all').html(option);
                        $('#continue_ok').val('1');
                        $( ".modal-overlay" ).remove();
                        $("#validate_imp").val('');
                        var optint_count_check_pre = $("#optint_count_check_i").val();
                        $("#cart_count").css("display","inline-block");
                        $("#cart_count").html(optint_count_check_pre);
                    }
                });
    }
    
  }   
  
  
  function validate_plotting_cont_pre()
  {
    var validate_imp            =   $("#validate_imp").val();
    var optint_count_check_pre  =   $("#optint_count_check").val();
    var cart_count              =   $("#cart_count").html();
    var cart_count_val          =   (cart_count != null) ? (Number(cart_count)+Number(1)) : "1";
    
    
    var jobreference        =   document.getElementById("jobref").value;
    var optint_count_check  =   document.getElementById("optint_count_check").value;
    
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
    var uploadedfile_pre    = $(".filename").html();
    var uploadedfile_option = (uploadedfile_pre != "") ? uploadedfile_pre : '';
    
    var date_for_alt        = document.getElementById("date_for_alt").value;
    var date_for_alt_arc    = document.getElementById("date_for_alt_arc").value;
    if(date_for_alt != ''){
        var date_for_alt_val    = date_for_alt;
    }else if(date_for_alt_arc != ''){
        var date_for_alt_val    = date_for_alt_arc;
    }else{
        var date_for_alt_val    = '0';
    }
    
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
    
    
    var uploadedfile        =   $("#filename_odd").html();   
    var dropoff             =   $("#dropoff").val();
    var drop_file           =   document.getElementById("drop_file").checked;
    var link                =   document.getElementById("link").checked;
   
    var validate_imp        =   $("#validate_imp").val();
    
    if(jobreference == ''){
        alert('Please enter the Job Reference');
        document.getElementById("jobref").focus();
        $("#jobref").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#jobref").css("background-color", "FFF");
    }
    
    if($('input[name=plotting_check]:checked').length<=0)
    {
        alert('Please select a job type');
        document.getElementById("plotting_check").focus();
        $("#plotting_check_spn").css("background-color", "#FFFF00");
        $("#plotting_check_0_spn").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#plotting_check_spn").css("background-color", "#FFF");
        $("#plotting_check_0_spn").css("background-color", "#FFF");
    }  
        if(validate_imp == ''){
        alert('Please select the file option');
        $(".spl_option").css("background-color", "#FFFF00");
        return false;
        }else{
        $(".spl_option").css("background-color", "#FFFF");    
        }
    
    if(continue_ok != '1'){
    if(print_ea == ''){
        alert('Please enter Prints of Each');
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
        $("#size_custom").css("background-color", "#FFFF00");
        return false;  
        }else{
        $("#size_custom").css("background-color", "#FFFF");    
        }   
    }
    }
    
    if(alternate_1 == true){
        if(address_book_se == '0'){
        alert('Please select the address');
        $("#address_book_se").css("border","1px solid red");
        return false;
        }else{
        $("#address_book_se").css("border","1px solid #CCC");
        }
    }
    if (jobreference != '')
    {
     $.ajax
        ({
            type: "POST",
            url: "save_and_continue.php",
            data: "save_and_continue=1&job_reference="+encodeURIComponent(jobreference)+
                          "&original="+encodeURIComponent(original)+"&print_ea="+encodeURIComponent(print_ea)+
                          "&size="+encodeURIComponent(size)+"&output="+encodeURIComponent(output)+
                          "&media="+encodeURIComponent(media)+
                          "&binding="+encodeURIComponent(binding)+"&folding="+encodeURIComponent(folding)+
                          "&plot_arch="+encodeURIComponent(plotting_check)+"&special_instruction="+encodeURIComponent(special_instruction)+
                          "&size_custom_val="+encodeURIComponent(size_custom_val)+"&output_both_val="+encodeURIComponent(output_both_val)+
                          "&pickup_date="+encodeURIComponent(date_for_alt_val)+"&pickup_time="+encodeURIComponent(time_for_alt_val)+
                          "&drop_val="+encodeURIComponent(drop_val)+"&ftp_link_val="+encodeURIComponent(ftp_link_val)+
                          "&user_name_val="+encodeURIComponent(user_name_val)+"&password_val="+encodeURIComponent(password_val)+
                          "&size_custom="+encodeURIComponent(size_custom)+"&uploadedfile_option="+encodeURIComponent(uploadedfile_option)+
                          "&my_office_alt="+encodeURIComponent(my_office_alt)+"&address_book_se_val="+encodeURIComponent(address_book_se_val),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                if(option != ""){
                    if((validate_imp == "") && (optint_count_check_pre == "0")){
                        validate_plotting_cont();
                    }else if((optint_count_check_pre == "0") && (validate_imp == "1")){
                        $("#cart_count").show();
                        $("#cart_count").html(option);
                        $("body").append("<div class='modal-overlay js-modal-close'></div>");
                        $("#are_you_continue").fadeIn("slow");
                    }else if((optint_count_check_pre != "0") && (validate_imp == "1")){
                        $("#cart_count").show();
                        $("#cart_count").html(option);
                        $("body").append("<div class='modal-overlay js-modal-close'></div>");
                        $("#are_you_continue").fadeIn("slow");
                    }else if((optint_count_check_pre != "0") && (validate_imp == "")){
                        $("#cart_count").show();
                        $("#cart_count").html(option);
                        $("body").append("<div class='modal-overlay js-modal-close'></div>");
                        $("#are_you_continue").fadeIn("slow");
                    }
                }
            }
        });
    }
  }
  
  function go_to_cart()
  {
//    var validate_imp        =   $("#validate_imp").val();
//    if(validate_imp != ""){
//    validate_plotting_cont();
//    }else{
    window.location = "add_recipients.php";    
//    }
  }
  
  function go_to_other_service()
  {
      var all_services = $("#all_services").val();
      
      if(all_services == "LFP"){
          //validate_plotting();
          window.location = "service_largeformat.php?set_existed=1";
      }
      
      if(all_services == "FAP"){
          validate_plotting();
          window.location = "service_finearts.php";
      }
      
      if(all_services == "ML"){
          validate_plotting();
          window.location = "service_lamination.php";
      }
      
      if(all_services == "BIN"){
          validate_plotting();
          window.location = "service_binding.php";
      }
      
      if(all_services == "OFP"){
          validate_plotting();
          window.location = "service_offset.php";
      }
      
      if(all_services == "SCN"){
          validate_plotting();
          window.location = "service_scanning.php";
      } 
      
      if(all_services == "CPS"){
          validate_plotting();
          window.location = "service_copyshop.php";
      } 
      
      if(all_services == "PAC"){
          window.location = "service_plotting.php?set_existed=1";
      } 
  }
  
  function close_cart_prompt()
  {
    $(".modal-overlay").fadeOut();
    $("#are_you_continue").fadeOut("slow"); 
  }

function validate_plotting_cont()
{
    //$("body").append("<div class='modal-overlay'></div>");  
    var jobreference        = document.getElementById("jobref").value;
    var continue_ok         = document.getElementById("continue_ok").value;  
    var check_val           = document.getElementById("plotting_check").checked;
    var check_val_0         = document.getElementById("plotting_check_0").checked;
    var plotting_check      = (check_val == true) ? '1' : '0';
    var continue_ok         =   $('#continue_ok').val;
    
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
    var uploadedfile_pre    = $(".filename").html();
    var uploadedfile_option = (uploadedfile_pre != "") ? uploadedfile_pre : '';
    
    var validate_imp        =   $("#validate_imp").val();
    
    if(continue_ok == '1'){
    var use_same            = document.getElementById('use_same_check_box').checked;  
    }
    var same_file           = (use_same == true) ? '1' : '0';
    
    var date_for_alt        = document.getElementById("date_for_alt").value;
    var date_for_alt_arc    = document.getElementById("date_for_alt_arc").value;
    if(date_for_alt != ''){
        var date_for_alt_val    = date_for_alt;
    }else if(date_for_alt_arc != ''){
        var date_for_alt_val    = date_for_alt_arc;
    }else{
        var date_for_alt_val    = '0';
    }
    
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
        $("#jobref").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#jobref").css("background-color", "FFF");
    }
    
    if($('input[name=plotting_check]:checked').length<=0)
    {
        alert('Please select a job type');
        document.getElementById("plotting_check").focus();
        $("#plotting_check_spn").css("background-color", "#FFFF00");
        $("#plotting_check_0_spn").css("background-color", "#FFFF00");
        return false;
    }else{
        $("#plotting_check_spn").css("background-color", "#FFF");
        $("#plotting_check_0_spn").css("background-color", "#FFF");
    }  
        if(validate_imp == ''){
        alert('Please select the file option');
        $(".spl_option").css("background-color", "#FFFF00");
        return false;
        }else{
        $(".spl_option").css("background-color", "#FFFF");    
        }
    
    if(continue_ok != '1'){
    if(print_ea == ''){
        alert('Please enter Prints of Each');
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
        $("#size_custom").css("background-color", "#FFFF00");
        return false;  
        }else{
        $("#size_custom").css("background-color", "#FFFF");    
        }   
    }
    }
    
    if(alternate_1 == true){
        if(address_book_se == '0'){
        alert('Please select the address');
        $("#address_book_se").css("border","1px solid red");
        return false;
        }else{
        $("#address_book_se").css("border","1px solid #CCC");
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
                          "&user_name_val="+encodeURIComponent(user_name_val)+"&password_val="+encodeURIComponent(password_val)+
                          "&size_custom="+encodeURIComponent(size_custom)+"&same_file="+same_file+"&uploadedfile_option="+encodeURIComponent(uploadedfile_option)+
                          "&my_office_alt="+encodeURIComponent(my_office_alt)+"&address_book_se_val="+encodeURIComponent(address_book_se_val),
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {      
//                        var optint_count_check  =   document.getElementById("optint_count_check").value;
//                        if(optint_count_check != 0){
//                            $("body").append("<div class='modal-overlay js-modal-close'></div>");
//                            $("#are_you_continue").slideDown("slow");
//                        }else{
                            window.location = "add_recipients.php";
//                        }
                        
                    }
                });
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
     $.ajax
        ({
            type: "POST",
            url: "use_the_same_file.php",
            data: "use_thesame_file=1",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                if(option == true){
                $("#use_same").slideDown(1000);
                $(".check").slideUp();
                $("#options_arch").slideUp();
                $("#validate_imp").val('1');
                }
            }
        });     
    }else{
        $.ajax
        ({
            type: "POST",
            url: "use_the_same_file.php",
            data: "use_thesame_file=2",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                if(option == true){
                $(".check").slideDown();
                $("#options_arch").slideUp();
                $("#validate_imp").val('');
                }
            }
        }); 
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
    $("#asap_status").removeClass(current_status);
    $("#asap_status").addClass(change_status);
    
    $("#date_for_alt").val("ASAP");
    $("#time_for_alt").val("ASAP");
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
    $.ajax
        ({
            type: "POST",
            url: "use_the_same_file.php",
            data: "use_thesame_file=2",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                if(option == true){                    
                    $("#options_arch").slideDown();
                    $("#options_plott").slideUp();
                    $("#alt_ops").slideUp();
                    $("#pick_ops").slideDown();
                    $("#use_same_check_box").slideUp();
                    $("#use_same_check_box_spn").slideUp();
                    $("#validate_imp").val('');
                }
            }
        }); 
}
 
function select_alternate()
{
    var address_book_se = $("#address_book_se").val();
    if(address_book_se != '0'){
        $("#alternate").attr("checked", true);
        $("#address_book_se").css("border", "1px solid #ccc");
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
 </script>




 </body>
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
 </html>
