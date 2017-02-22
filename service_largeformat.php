<?php
include './admin/config.php';
include './admin/db_connection.php';

if($_SESSION['sohorepro_companyid']  == '')
{
  header("Location:index.php");
  exit;
}

//if($_SESSION['cart_count']  == '1')
//{
//  header("Location:service_largeformat.php");
////  //exit;
//    
////    print_r($_SESSION);
////    exit;
//}

if($_GET['lfp']  == '1'){
header("Location:service_largeformat.php");    
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
       <link rel="stylesheet" href="js/jquery-ui.css" />
      <script src="js/jquery-ui_service.js"></script>
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
    $("#drop_off").slideUp(1000);
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

function close_asap()
{
    $(".modal-overlay").fadeOut();
    $("#asap_popup").slideUp("slow"); 
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
            //$("#add_mount_lam").addClass("border_gle");
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



// Mount and Laminating Script Start


   function width_value_restriction()
   {
        var width_values    = $("#width_values").val();
        var width_val_se    = $("#width_val_set").val();
        
        var max_val         = Number(width_val_se);
        if(width_values == '0'){
        $("#width_values").val('');
        $("#errmsg_mount").html("Cannot be 0").show().fadeOut(1500);
        return false;
        }
        
        if(width_val_se != ""){
            if(width_values > max_val){
            $("#errmsg_mount").html("Cannot be exceed "+max_val).show();
            return false;
            }else{
            $("#errmsg_mount").html("Cannot be exceed "+max_val).hide();
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
        $("#errmsg_mount").html("Cannot be 0").show().fadeOut(1500);
        return false;
        }
        
        if(length_val_set != ""){
            if(length_values > max_val){
            $("#errmsg_mount").html("Cannot be exceed "+max_val).show();
            return false;
            }else{
            $("#errmsg_mount").html("Cannot be exceed "+max_val).hide();
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



// Mounting and Laminating Script End
</script>
<script src="jquery.form.js"></script>
<script>
    function upload_file(ID) {

        var upload_val = $('#uploadedfile_' + ID).val();
        if (upload_val != '') {
            var bar = $('#bar_' + ID);
            var percent = $('#percent_' + ID);
            var status = $('#status_' + ID);

            $('#upload_file_' + ID).ajaxForm({
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
        } else {
            alert("please select the file.");
            return false;
        }
    }

    function sendFileToServer(formData, status) {
        var uploadURL = "upload_LFP.php"; //Upload URL
        var extraData = {}; //Extra Data.
        var jqXHR = $.ajax({
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
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: function(data) {
                status.setProgress(100);
                //alert(data);
                //$("#status1").append("File upload Done<br>");         
            }
        });

        status.setAbort(jqXHR);
        status.setRemove(jqXHR);
    }

    var rowCount = 0;

    function createStatusbar(obj) {
        rowCount++;
        var row = "odd";
        if (rowCount % 2 == 0) row = "even";
        var james = 'jass';
        this.statusbar = $("<div class='statusbar " + row + "'></div>");
        this.filename = $("<div class='filename' id='filename_" + row + "'></div>").appendTo(this.statusbar);
        this.size = $("").appendTo(this.statusbar);
        this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
        this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
        this.done = $("<div class='done-progress' onclick='return delete_upload_file();'>Remove</div>").appendTo(this.statusbar);
        obj.after(this.statusbar);

        this.setFileNameSize = function(name, size) {
            var sizeStr = "";
            var sizeKB = size / 1024;
            if (parseInt(sizeKB) > 1024) {
                var sizeMB = sizeKB / 1024;
                sizeStr = sizeMB.toFixed(2) + " MB";
            } else {
                sizeStr = sizeKB.toFixed(2) + " KB";
            }

            this.filename.html(name);
            this.size.html(sizeStr);
        }
        this.setProgress = function(progress) {
            var progressBarWidth = progress * this.progressBar.width() / 100;
            this.progressBar.find('div').animate({
                width: progressBarWidth
            }, 10).html(progress + "% ");
            if (parseInt(progress) >= 100) {
                this.abort.hide();
                this.done.show();
            }
        }
        this.setAbort = function(jqxhr) {
            var sb = this.statusbar;
            this.abort.click(function() {
                jqxhr.abort();
                sb.hide();
            });
        }

        this.setRemove = function(jqxhr) {
            var sb = this.statusbar;
            this.done.click(function() {
                jqxhr.done();
                sb.hide();
            });
        }
    }

    function handleFileUpload(files, obj) {
        for (var i = 0; i < files.length; i++) {
            var fd = new FormData();
            fd.append('file', files[i]);

            var status = new createStatusbar(obj); //Using this we can set progress.
            status.setFileNameSize(files[i].name, files[i].size);
            sendFileToServer(fd, status);

        }
    }
    $(document).ready(function() {
        var obj = $("#dragandrophandler");
        obj.on('dragenter', function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).css('border', '2px solid #0B85A1');
        });
        obj.on('dragover', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });
        obj.on('drop', function(e) {

            $(this).css('border', '2px dotted #0B85A1');
            e.preventDefault();
            var files = e.originalEvent.dataTransfer.files;

            //We need to send dropped files to Server
            handleFileUpload(files, obj);
        });
        $(document).on('dragenter', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });
        $(document).on('dragover', function(e) {
            e.stopPropagation();
            e.preventDefault();
            obj.css('border', '2px dotted #0B85A1');
        });
        $(document).on('drop', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });

    });

    var rowCount = 0;

    function delete_upload_file() {
        rowCount++;
        var row = "even";
        if (rowCount % 2 == 0) row = "odd";
        //alert(row);
        var mb = $('#filename_' + row).text();
        //alert("Value of div is: " + mb); 
        $.ajax({
            type: "POST",
            url: "get_recipients.php",
            data: "delete_upload_files=9&file_name=" + mb,
            success: function(option) {

            }
        });
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
#errmsg_mount
{
color: red; 
width: 100%;
float: left;
text-align: center;

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
.dim_mount label{
    text-align: center;
}
.grom_mount{
    text-align: center;
}
.border_gle {
    border-bottom: 1px solid #e5e5e5;
    background: #fff;
    white-space: nowrap;
    box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
    -webkit-box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
}

.serviceOrderSetWapper{
    width: 860px !important;
}

//LFP New Set Start

 .lfp_sets_container{
        width: 100% !important;
        float: left !important;
        border: 1px #FF7E00 solid;
        margin-bottom: 20px;
    }
    .lfp_sets_header{
        width: 95%;
        margin: auto;
        margin-top: 10px;
    }    
    .lfp_sets_header .left{
        float: left;
        width: 40%;
        font-weight: bold;
    }
    .lfp_sets_header .right{
        float: right;
        width: 40%;
        text-align: right;
    }
    .lfp_delete_button{
        background: #D84B36;
        color: #FFF;
        padding: 2px 8px;
        border-radius: 5px;
        margin-top: 3px;
        font-weight: bold;
    }
    .lfp_sets_body{
        width: 90%;
        margin: auto;
        margin-top: 50px;
        margin-bottom: 10px;
    }
    .lfp_sets_body > ul{
        list-style: none;
    }
    .lfp_sets_body > ul > li{
        width: 100%;
    }
    .lfp_sets_body > ul > li > label{
        width: 30%;
        float: left;
        font-weight: bold;
    }
    .file_option{
        width: 95%;
        margin: auto;
        margin-top: 10px;
        font-weight: bold;
    }
    .file_option_content{
        width: 90%;
        margin: auto;
        margin-top: 10px;
        text-decoration: underline;
        margin-bottom: 10px;
    }
    .file_option_content_source{
        width: 90%;
        margin: auto;
        margin-bottom: 10px;
    }
    .file_option_content_sc_pick{
        width: 90%;
        margin: auto;
        margin-bottom: 10px;
    }
    
    .file_option_content_sc_upload{
        width: 90%;
        margin: auto;
        margin-bottom: 10px;
    }
//LFP New Set End

 
 </style>
    </head>
    <body>
        <div id="loading"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1002;display: none;">
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
            <div style="width: 100%;float: left;font-weight: bold;font-size: 35px;line-height: 35px;">Continue Session?</div>
            <div style="width: 100%;float: left;font-weight: bold;font-size: 22px;line-height: 70px;">
                Jump to:
                <select id="all_services">
                    <option value="PAC">PLOTTING & ARCHITECTURAL COPIES</option>
                    <option value="LFP">LARGE FORMAT COLOR & BW</option>
                    <option value="FAP" selected="selected">FINE ART PRINTING</option>
                    <option value="ML">MOUNTING & LAMINATING</option>
                    <option value="BIN">BINDING</option>
                    <option value="OFP">OFFSET PRINTING</option>
                    <option value="SCN">SCANNING</option>
                    <option value="CPS">COPY SHOP</option>                    
                </select>
                <span class="all_services_go" onclick="return go_to_other_service();">GO</span>
            </div>
            <div class="chechout_btn_main">
                <div class="chechout_btn_main_cont" onclick="return go_to_cart();">
                    <div class="chechout_btn" style="line-height: 28px;">Checkout</div>
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
<!--                        <span style="font-weight: bold;color: #ff7e00;font-size: 14px;">Disclaimer:</span>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.-->
                    </div> 
                 </div>
                <?php
                $user_id_add_set        = $_SESSION['sohorepro_userid'];
                $company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
                $check_plotting         = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);
                $check_plotting_needed  = LFPNeededSetWithoutOrderId($company_id_view_plot, $user_id_add_set);   
                $check_plotting_files   = UploadFileExist($company_id_view_plot, $user_id_add_set);                
                ?>
                  
                <ul>                  
                    <div  id="set">
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                  <li class="clear">
                      <!-- FOR EACH START -->  
                <?php 
                if($_GET['set_existed'] == "1"){ 
                $enteredLFPPrimay = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);
                $count_option = count($enteredLFPPrimay) + 1;  
                ?>
                <div  id="sets_all">
                    <?php       
                    if(count($enteredLFPPrimay) > 0){
                    $i = 1;
                    foreach ($enteredLFPPrimay as $lfp) {
                        ?>
                        <div class="plot_container" style="width: 860px;float: left;border: 1px #FF7E00 solid;margin-bottom: 20px;">
                            <div class="lfp_sets_header">
                                <div class="left">
                                    Job Option - <?php echo $i; ?>
                                </div>
                                <div class="right">
                                    <span class="lfp_delete_button">DELETE</span>
                                </div>
                            </div>

                            <div class="lfp_sets_body">
                                <ul>
                                    <li>
                                        <label>Originals:</label><?php echo $lfp['original']; ?>
                                    </li>
                                    <li>
                                        <label>Prints of Each:</label><?php echo $lfp['print_of_each']; ?>
                                    </li>
                                    <li>
                                        <label>Size:</label><?php echo $lfp['size']; ?>
                                    </li>
                                    <?php if ($lfp['size_custom'] != '0') { ?>
                                        <li>
                                            <label>Custom Size Details:</label><?php echo $lfp['size_custom']; ?>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <label>Output:</label><?php echo $lfp['output']; ?>
                                    </li>
                                    <?php if ($lfp['output_both_page'] != '0') { ?>
                                        <li>
                                            <label>Color Page Number:</label><?php echo $lfp['output_both_page']; ?>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <label>Media:</label><?php echo $lfp['media']; ?>
                                    </li>
                                    <li>
                                        <label>Binding:</label><?php echo $lfp['binding']; ?>
                                    </li>
                                </ul>                        
                            </div>


                            <?php
                            if ($lfp['ftp_link'] != '0') {
                                $ftp_link = ($lfp['ftp_link'] != "0") ? $lfp['ftp_link'] : "";
                                $ftp_user = ($lfp['ftp_user_name'] != "0") ? $lfp['ftp_user_name'] : "";
                                $ftp_pass = ($lfp['ftp_password'] != "0") ? $lfp['ftp_password'] : "";
                                ?>
                                <div class="file_option">
                                File Options:
                                </div>
                                <div class="file_option_content">
                                    Provide Link to File:
                                </div>
                                <div class="file_option_content_source">
                                    FTP Link: <?php echo $ftp_link . '<br>'; ?>
                                    User Name: <?php echo $ftp_user . '<br>'; ?>
                                    Password: <?php echo $ftp_pass . '<br>'; ?>
                                </div>
                            <?php } ?>   
                            <?php
                            if ($lfp['schedule_pickup'] != '0') {
                                ?>
                                <div class="file_option">
                                    File Options:
                                </div>
                                <div class="file_option_content_sc_pick">
                                    Schedule a pick up Date/Time: <?php echo $lfp['schedule_pickup']; ?>
                                </div>            
                            <?php
                            if ($lfp['schedule_place'] != '0') {

                                $address_dtls = SelectLastEnteredAddress($lfp['schedule_place']);
                                $address_2 = ($address_dtls[0]['address_2'] != '') ? $address_dtls[0]['address_2'] . '<br>' : '';
                                $address_3 = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'] . '<br>' : '';
                                $address_string = $address_dtls[0]['company_name'] . '<br>' . $address_dtls[0]['address_1'] . '<br>' . $address_2.$address_3.$address_dtls[0]['city'] . ',&nbsp;' . StateName($address_dtls[0]['state']) . '&nbsp;' . $address_dtls[0]['zip'];

                                $option_sechdule = ($lfp['schedule_place'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>' . $address_string;
                                ?>
                <!--                <div class="file_option">
                                    File Options:
                                </div>-->
                                <div style="width: 95%;margin: auto;margin-top: 7px;margin-bottom: 95px;">                    
                                    <div style="float: left;width: 22%;margin-top: 5px;font-weight: bold;">Schedule a pick-up Option:</div>
                                    <div style="float: left;width: 50%;margin-top: 5px;">                        
                                        <div style="float: left;width: 100%;margin-bottom: 10px;"><?php echo $option_sechdule; ?></div>
                                    </div> 
                                </div>
                            <?php } } ?>
                             <?php
                            if ($lfp['drop_off_381'] != '0') {               
                                ?>           
                                <div class="file_option">
                                    File Options:
                                </div>
                                <div class="file_option_content_source">
                                    Drop off at Soho Repro: <?php echo $lfp['drop_off_381']; ?>                    
                                </div>
                            <?php } ?>

                            <?php
                            if ($lfp['special_inc'] != '0') {               
                                ?>           
                                <div class="file_option">
                                    Special Instructions:
                                </div>
                                <div class="file_option_content_source">
                                    <?php echo $lfp['special_inc']; ?>                    
                                </div>
                            <?php } ?>
                             <?php
                            if ($lfp['ml_active'] != '0') {               
                                ?>   
                            <div class="ml_container border_gle_ml">
                                <div class="ml_header">Mounting / Laminating:</div>

                                <div class="lfp_sets_ml_body">
                                <ul>
                                    <li>
                                        <label>Originals:</label><?php echo $lfp['ml_originals']; ?>
                                    </li>
                                    <li>
                                        <?php
                                        if($lfp['ml_type'] == "M"){
                                            $type_ml        =   "Mounting";    
                                        }elseif ($lfp['ml_type'] == "L") {
                                            $type_ml        =   "Laminating";           
                                        }elseif ($lfp['ml_type'] == "Both") {
                                            $type_ml        =   "Both";         
                                        }
                                        ?>
                                        <label>Type:</label><?php echo $type_ml; ?>
                                    </li>
                                    <?php
                                    if($lfp['ml_mounting'] != "none"){
                                    ?>
                                    <li>
                                        <label>Mounting:</label><?php echo $lfp['ml_mounting']; ?>
                                    </li>
                                    <?php 
                                    }
                                    ?>
                                    <?php
                                    if($lfp['ml_laminating'] != "none"){
                                    ?>
                                    <li>
                                        <label>Lamination:</label><?php echo $lfp['ml_laminating']; ?>
                                    </li>
                                    <?php 
                                    }
                                    ?>
                                    <li>
                                        <label>Dimensions:</label><?php echo "Width:&nbsp;".$lfp['ml_width'].'&nbsp;&nbsp;Length:&nbsp;'.$lfp['ml_length']; ?>
                                    </li>
                                    <li>
                                        <label>Grommets:</label><?php echo $lfp['ml_grommets']; ?>
                                    </li>
                                    <?php
                                    if($lfp['mal_splns'] != ""){
                                    ?>
                                    <li>
                                        <label>Special Instructions:</label><?php echo $lfp['mal_splns']; ?>
                                    </li>                 
                                    <?php } ?>
                                </ul>
                                </div>                
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                    <!--New Job Add Start -->
    <div class="serviceOrderSetHolder">
        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
            Job Options - <?php echo $count_option; ?>            
<!--            <div style="float:right;font-weight: bold;">
                Option                
            </div>-->
            <input type="hidden" name="optint_count_check" id="optint_count_check" value="0" />
            <input type="hidden" name="optint_count_check_i" id="optint_count_check_i" value="<?php echo $added_cart_count_session; ?>" />
        </label>  
        <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
            <div class="serviceOrderSetWapperInternal">
                <div class="serviceOrderSetDIV">
                    <div style="width: 880px;float: left;padding-top: 10px;margin-bottom: 0px !important;">  


                                <!--JASSIM-->                        
                                <input type="checkbox"  style="width: 2%;margin-bottom: 20px;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set();" /><span id="use_same_check_box_spn">Use the same File as in Job Option <?php echo ($count_option - 1); ?></span>
                                <!--End-->

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
                                    <input class="order_0_set1_0_original" style="width:50px;padding: 3px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                    <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;padding: 3px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
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
                                                <option value="Bond Paper">Bond Paper</option>
                                                <option value="Heavy Weight Bond">Heavy Weight Bond</option>
                                                <option value="Satin Photo">Satin Photo</option>
                                                <option value="Gloss Photo">Gloss Photo</option>
                                                <option value="Transparency">Transparency</option>
                                                <option value="Self Adhesive Fabric">Self Adhesive Fabric</option>
                                                <option value="Stick 2, Polypropylene">Stick 2, Polypropylene</option>
                                                <option value="Banner / Scrim Vinyl">Banner / Scrim Vinyl</option>
                                                <option value="Vellum">Vellum</option>
                                                <option value="Mylar">Mylar</option>
                                                <option value="Bond">Bond</option>
                                                <option value="Presentation Bond - BW Laser Only">Presentation Bond - BW Laser Only</option>
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

            <!--                    <input type="checkbox"  style="display: none;width: 2%;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set('1');" />-->
                                <div id="options_plott" class="check" style="width:860px;margin-bottom: 0px;">
                                    <label id="alt_ops" style="font-weight: bold;height:15px;    border-bottom: 1px solid #FF7E00;">
                                        File Options<span style="color: red;">*</span>
                                    </label>
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
                                    <?php
                                    $all_days_off = AllDayOff();
                                    foreach ($all_days_off as $days_off_split) {
                                        $all_days_in[] = $days_off_split['date'];
                                    }
                                    $all_date = implode(",", $all_days_in);
                                    $all_date_exist = str_replace("/", "-", $all_date);
                                    ?>
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
                                                <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" checked="checked" value="my_office" />My Office
                                            </div>
                                            <div style="float: left;width: 40%;border: 0px #F99B3E solid;margin-top: 30px;">
                                                <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                                <select  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
                                                    <option value="0">Address Book</option>
                                                    <?php
                                                    $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                                    foreach ($address_book as $address) {
                                                        ?>                                                                                        
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
                                    <div id="sp_inst" style="margin-top:10px;margin-bottom: 0px;">
                                        <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                                            Special Instructions
                                        </label>
                                        <br>
                                        <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="min-width: 370px;min-height: 60px;max-height: 60px;max-width: 370px;"><?php echo $entered['spl_instruction']; ?></textarea>
                                    </div>
                                </div>
                                <!--Special Instruction End-->

                                <div class="border_gle" style="width: 100%;float: left;font-weight: bold;font-size: 13px;">&nbsp;</div>

                                <div id="add_mount_lam" class="" style="float:left;width: 775px;border: 0px solid #ccc;margin-bottom: 0px;">
                                    <div style="float:left;width: 25%;padding: 5px;background-color: #EFEFEF;border-radius: 5px;border: 2px solid #000;padding: 10px;color: #000;font-weight: bold;margin-left: 5px;margin-top: 5px;">
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
                <!--New Job Add End-->
                </div>
                <?php }else{ ?>
                    <div  id="sets_all">
                                <?php                    
                                if(count($check_plotting) > 0){
                                    $delete_empty = "DELETE FROM sohorepro_service_lfp WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                                    mysql_query($delete_empty);
                                }

                                if(count($check_plotting_needed) > 0){
                                    $delete_empty1 = "DELETE FROM sohorepro_service_lfp_sets_needed WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                                    mysql_query($delete_empty1);
                                }

            //                    if(count($check_plotting_files) > 0){
            //                        $delete_sql = "DELETE FROM sohorepro_upload_files_set WHERE comp_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0' ";
            //                        mysql_query($delete_sql);
            //                    }

            //                    if(count($check_plotting) > 0){
            //                        echo 'IS THERE';
            //                    }  else {
            //                        echo 'Not There';
            //                    }
                                ?>

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
                                        <div style="width: 880px;float: left;padding-top: 10px;margin-bottom: 0px !important;">  

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
                                                <input class="order_0_set1_0_original" style="width:50px;padding: 3px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                                <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;padding: 3px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
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
                                                    <option value="Bond Paper">Bond Paper</option>
                                                    <option value="Heavy Weight Bond">Heavy Weight Bond</option>
                                                    <option value="Satin Photo">Satin Photo</option>
                                                    <option value="Gloss Photo">Gloss Photo</option>
                                                    <option value="Transparency">Transparency</option>
                                                    <option value="Self Adhesive Fabric">Self Adhesive Fabric</option>
                                                    <option value="Stick 2, Polypropylene">Stick 2, Polypropylene</option>
                                                    <option value="Banner / Scrim Vinyl">Banner / Scrim Vinyl</option>
                                                    <option value="Vellum">Vellum</option>
                                                    <option value="Mylar">Mylar</option>
                                                    <option value="Bond">Bond</option>
                                                    <option value="Presentation Bond - BW Laser Only">Presentation Bond - BW Laser Only</option>
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
                                <div id="options_plott" class="check" style="width:860px;border-top: 1px solid #FF7E00;margin-top:-13px;margin-bottom: 0px;">
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
                                        <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro();" />
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
                                   <?php 
                                        $all_days_off = AllDayOff();                                                        
                                        foreach ($all_days_off as $days_off_split){
                                            $all_days_in[]  = $days_off_split['date'];
                                        }                                                        
                                        $all_date  = implode(",", $all_days_in);                                                        
                                        $all_date_exist = str_replace("/", "-", $all_date);
                                    ?>
                                  <div id="date_time" style="width: 99%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
                                            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                            <div style="width: 34%;float: left;margin-right: 6px;margin-bottom: 0px;"> 

                                                <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;margin-bottom: 0px;">
                                                    <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                                </div>

                                                <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: auto;">
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
                                                        <div class="alt_new_address_container_ftr">
                                                            <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                            <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                                        </div>
                                                    </div>
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
                            <input type="hidden" name="optint_count_check_i" id="optint_count_check_i" value="0" />
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

                             <div class="border_gle" style="width: 100%;float: left;font-weight: bold;font-size: 13px;">&nbsp;</div>

                            <div id="add_mount_lam" class="" style="float:left;width: 775px;border: 0px solid #ccc;margin-bottom: 0px;">
                                <div style="float:left;width: 25%;padding: 5px;background-color: #EFEFEF;border-radius: 5px;border: 2px solid #000;padding: 10px;color: #000;font-weight: bold;margin-left: 5px;margin-top: 5px;">
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
               <?php } ?>
                    
                    
                </div>
                <?php }else{?>
                <div  id="sets_all">
                    <?php                    
                    if(count($check_plotting) > 0){
                        $delete_empty = "DELETE FROM sohorepro_service_lfp WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                        mysql_query($delete_empty);
                    }
                    
                    if(count($check_plotting_needed) > 0){
                        $delete_empty = "DELETE FROM sohorepro_service_lfp_sets_needed WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0'";
                        mysql_query($delete_empty);
                    }
                    
//                    if(count($check_plotting_files) > 0){
//                        $delete_sql = "DELETE FROM sohorepro_upload_files_set WHERE comp_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0' ";
//                        mysql_query($delete_sql);
//                    }
                    
//                    if(count($check_plotting) > 0){
//                        echo 'IS THERE';
//                    }  else {
//                        echo 'Not There';
//                    }
                    ?>
                
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
                            <div style="width: 880px;float: left;padding-top: 10px;margin-bottom: 0px !important;">  
                                
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
                                    <input class="order_0_set1_0_original" style="width:50px;padding: 3px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                                    <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;padding: 3px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
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
                                        <option value="Bond Paper">Bond Paper</option>
                                        <option value="Heavy Weight Bond">Heavy Weight Bond</option>
                                        <option value="Satin Photo">Satin Photo</option>
                                        <option value="Gloss Photo">Gloss Photo</option>
                                        <option value="Transparency">Transparency</option>
                                        <option value="Self Adhesive Fabric">Self Adhesive Fabric</option>
                                        <option value="Stick 2, Polypropylene">Stick 2, Polypropylene</option>
                                        <option value="Banner / Scrim Vinyl">Banner / Scrim Vinyl</option>
                                        <option value="Vellum">Vellum</option>
                                        <option value="Mylar">Mylar</option>
                                        <option value="Bond">Bond</option>
                                        <option value="Presentation Bond - BW Laser Only">Presentation Bond - BW Laser Only</option>
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
                    <div id="options_plott" class="check" style="width:860px;border-top: 1px solid #FF7E00;margin-top:-13px;margin-bottom: 0px;">
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
                            <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro();" />
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
                       <?php 
                            $all_days_off = AllDayOff();                                                        
                            foreach ($all_days_off as $days_off_split){
                                $all_days_in[]  = $days_off_split['date'];
                            }                                                        
                            $all_date  = implode(",", $all_days_in);                                                        
                            $all_date_exist = str_replace("/", "-", $all_date);
                        ?>
                      <div id="date_time" style="width: 99%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                <div style="width: 34%;float: left;margin-right: 6px;margin-bottom: 0px;"> 

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;margin-bottom: 0px;">
                                        <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                    </div>

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: auto;">
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
                                            <div class="alt_new_address_container_ftr">
                                                <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                            </div>
                                        </div>
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
                <input type="hidden" name="optint_count_check_i" id="optint_count_check_i" value="0" />
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
                 
                 <div class="border_gle" style="width: 100%;float: left;font-weight: bold;font-size: 13px;">&nbsp;</div>
                
                <div id="add_mount_lam" class="" style="float:left;width: 775px;border: 0px solid #ccc;margin-bottom: 0px;">
                    <div style="float:left;width: 25%;padding: 5px;background-color: #EFEFEF;border-radius: 5px;border: 2px solid #000;padding: 10px;color: #000;font-weight: bold;margin-left: 5px;margin-top: 5px;">
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
                <?php
                }
                ?>
                 
               
               <!-- FOR EACH END -->     
                  
             
<!--              <div style="float: left;width: 99%;border-top: 1px solid #CCC;"></div>      -->
              <div style="float:left;width:100%;text-align:right;margin-top: 10px;">                  
                  <input class="addproductActionLink" value="Save to Cart and Continue" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 180px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -1px !important;" type="button" onclick="return validate_lfp_cont_pre();" />
                  <input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-right: 10px;" type="button" onclick="return validate_lfp();" />
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
                
                <script> 
                    
                    function validate_lfp()
                    {
                       var reference            =       $("#jobref").val();
                       var original             =       $("#original").val();
                       var print_ea             =       $("#print_ea").val(); 
                       
                       var size                 =       $("#size").val();
                       var size_custom_pre      =       $("#size_custom").val();
                       var size_custom          =       (size == "Custom") ? size_custom_pre : "0";
                       
                       var output               =       $("#output").val();                       
                       var output_both_pre      =       $("#output_both").val();
                       var output_both          =       (output == "Both") ? output_both_pre : "0";
                       
                       var media                =       $("#media").val();
                       
                       var binding              =       $("#binding").val();
                       
                       var drop_file_check      =       document.getElementById("drop_file").checked;
                       var drop_file            =       (drop_file_check == true) ? "1" : "0";
                       
                       var link                 =       document.getElementById("link").checked;
                       var ftp_link_pre         =       $("#ftp_link").val();
                       var ftp_user_pre         =       $("#user_name").val();
                       var ftp_pass_pre         =       $("#pass_word").val();
                       
                       var ftp_link             =       (link == true) ? ftp_link_pre : "0";
                       var ftp_user             =       (link == true) ? ftp_user_pre : "0";
                       var ftp_pass             =       (link == true) ? ftp_pass_pre : "0";
                       
                       var pick                 =       document.getElementById("pick").checked;
                       var my_office            =       document.getElementById("my_office").checked;
                       var address_book_se      =       $("#address_book_se").val();
                       var date_for_alt         =       $("#date_for_alt").val();
                       var time_for_alt         =       $("#time_for_alt").val();
                       
                       var schedule_pickup_dt   =       (pick == true) ? date_for_alt+"&nbsp;"+time_for_alt : '0';
                       var schedule_place       =       (my_office == true) ? "my_office" : address_book_se;
                       
                       var dropoff_pre          =       document.getElementById("dropoff").checked;
                       var dropoff              =       (dropoff_pre == true) ? "381 Broome Street" : "0";
                       
                       var special_ins_pre      =       $("#special_instruction").val();
                       var special_instruction  =       (special_ins_pre != "") ? special_ins_pre : "0";
                       
                       //Additional Mounting & Laminating Start
                       var add_ml               =       document.getElementById("add_ml").checked;
                       var add_ml_val           =       (add_ml == true) ? "1" : "0";
                       var original_lam_pre     =       $("#original_lam").val();
                       
                       
                       
                       var original_lam         =       (add_ml == true) ? original_lam_pre : "0";
                       
                       if(add_ml == true)                       {
                          
                       var mount_lam_1          =       document.getElementById("mount_lam_check").checked;
                       var mount_lam_2          =       document.getElementById("mount_lam_check_0").checked;
                       var mount_lam_3          =       document.getElementById("mount_lam_check_1").checked;
                       var grommets_pre         =       document.getElementById("grommets").checked;
                       
                       
                       if(mount_lam_1 == true){
                            var mount_lam            =       "M";
                           }else if(mount_lam_2 == true){
                            var mount_lam            =       "L";
                           }else if(mount_lam_3 == true){
                            var mount_lam            =       "Both";
                           }
                        }
                        
                       var mounting_select_pre   =       $("#mounting_select").val();
                       var lamination_select_pre =       $("#lamination_select").val();
                       var width_values_pre      =       $("#width_values").val();
                       var length_values_pre     =       $("#length_values").val();
                       
                       var splins_pre            =       $("#splins").val();
                       
                       var mount_lam_val         =       (add_ml == true) ? mount_lam : "0";
                       var mounting_select       =       (add_ml == true) ? mounting_select_pre : "0"; 
                       var lamination_select     =       (add_ml == true) ? lamination_select_pre : "0"; 
                       var width_values          =       (add_ml == true) ? width_values_pre : "0"; 
                       var length_values         =       (add_ml == true) ? length_values_pre : "0"; 
                       var grommets              =       (grommets_pre == true) ? "Grommets" : "0";
                       var splins                =       (add_ml == true) ? splins_pre : "0";
                       var validate_imp          =        $("#validate_imp").val();
                       //Additional Mounting & Laminating End
                       
                       
                       if(reference == ''){
                           alert("Please enter the job reference.");
                           document.getElementById('jobref').focus();
                           return false;
                       }                       
//                            if(original == ''){
//                                alert("Please enter the original.");
//                                document.getElementById('original').focus();
//                                return false;
//                            }                       
                       if(print_ea == ''){
                           alert("Please enter the Prints of Each.");
                           document.getElementById('print_ea').focus();
                           return false;
                       }    
                       
                       if(validate_imp == ''){
                            alert('Please select the file option');
                            $(".spl_option").css("background-color", "#FFFF00");
                            return false;
                        }else{
                            $(".spl_option").css("background-color", "#FFFF");    
                        }
                       
                        if (reference != '')
                            {
                                $.ajax
                                        ({
                                            type: "POST",
                                            url: "add_lfp_sets.php",
                                            data: "service_lfp_add=1&reference="+encodeURIComponent(reference)+"&original="+original+
                                                  "&print_ea="+print_ea+"&size="+size+"&size_custom="+size_custom+"&output="+output+
                                                  "&output_both="+output_both+"&media="+media+"&binding="+binding+"&drop_file="+drop_file+"&ftp_link="+ftp_link+
                                                  "&ftp_user="+ftp_user+"&ftp_pass="+ftp_pass+"&schedule_pickup_dt="+schedule_pickup_dt+
                                                  "&schedule_place="+schedule_place+"&dropoff="+dropoff+"&special_instruction="+special_instruction+
                                                  "&add_ml_val="+add_ml_val+"&original_lam="+original_lam+"&mount_lam="+mount_lam_val+
                                                  "&mounting_select="+mounting_select+"&lamination_select="+lamination_select+"&width_values="+width_values+
                                                  "&length_values="+length_values+"&grommets="+grommets+"&ml_splins="+splins,
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
                    
                    
                    
                    function validate_lfp_cont_pre()
                    {
                        var validate_imp            =   $("#validate_imp").val();
                        var optint_count_check_pre  =   $("#optint_count_check_i").val();
                        var cart_count              =   $("#cart_count").html();
                        var cart_count_val          =   (cart_count != null) ? (Number(cart_count)+Number(1)) : "1";
                         
                        
                        var reference            =       $("#jobref").val();
                       var original             =       $("#original").val();
                       var print_ea             =       $("#print_ea").val(); 
                       
                       var size                 =       $("#size").val();
                       var size_custom_pre      =       $("#size_custom").val();
                       var size_custom          =       (size == "Custom") ? size_custom_pre : "0";
                       
                       var output               =       $("#output").val();                       
                       var output_both_pre      =       $("#output_both").val();
                       var output_both          =       (output == "Both") ? output_both_pre : "0";
                       
                       var media                =       $("#media").val();
                       
                       var binding              =       $("#binding").val();
                       
                       var drop_file_check      =       document.getElementById("drop_file").checked;
                       var drop_file            =       (drop_file_check == true) ? "1" : "0";
                       
                       var link                 =       document.getElementById("link").checked;
                       var ftp_link_pre         =       $("#ftp_link").val();
                       var ftp_user_pre         =       $("#user_name").val();
                       var ftp_pass_pre         =       $("#pass_word").val();
                       
                       var ftp_link             =       (link == true) ? ftp_link_pre : "0";
                       var ftp_user             =       (link == true) ? ftp_user_pre : "0";
                       var ftp_pass             =       (link == true) ? ftp_pass_pre : "0";
                       
                       var pick                 =       document.getElementById("pick").checked;
                       var my_office            =       document.getElementById("my_office").checked;
                       var address_book_se      =       $("#address_book_se").val();
                       var date_for_alt         =       $("#date_for_alt").val();
                       var time_for_alt         =       $("#time_for_alt").val();
                       
                       var schedule_pickup_dt   =       (pick == true) ? date_for_alt+"&nbsp;"+time_for_alt : '0';
                       var schedule_place       =       (my_office == true) ? "my_office" : address_book_se;
                       
                       var dropoff_pre          =       document.getElementById("dropoff").checked;
                       var dropoff              =       (dropoff_pre == true) ? "381 Broome Street" : "0";
                       
                       var special_ins_pre      =       $("#special_instruction").val();
                       var special_instruction  =       (special_ins_pre != "") ? special_ins_pre : "";
                       
                       //Additional Mounting & Laminating Start
                       var add_ml               =       document.getElementById("add_ml").checked;
                       var add_ml_val           =       (add_ml == true) ? "1" : "0";
                       var original_lam_pre     =       $("#original_lam").val();
                       
                       
                       
                       var original_lam         =       (add_ml == true) ? original_lam_pre : "0";
                       
                       if(add_ml == true)                       {
                          
                       var mount_lam_1          =       document.getElementById("mount_lam_check").checked;
                       var mount_lam_2          =       document.getElementById("mount_lam_check_0").checked;
                       var mount_lam_3          =       document.getElementById("mount_lam_check_1").checked;
                       var grommets_pre         =       document.getElementById("grommets").checked;
                       
                       
                       if(mount_lam_1 == true){
                            var mount_lam            =       "M";
                           }else if(mount_lam_2 == true){
                            var mount_lam            =       "L";
                           }else if(mount_lam_3 == true){
                            var mount_lam            =       "Both";
                           }
                        }
                        
                       var mounting_select_pre   =       $("#mounting_select").val();
                       var lamination_select_pre =       $("#lamination_select").val();
                       var width_values_pre      =       $("#width_values").val();
                       var length_values_pre     =       $("#length_values").val();
                       
                       var splins_pre            =       $("#splins").val();
                       
                       var mount_lam_val         =       (add_ml == true) ? mount_lam : "0";
                       var mounting_select       =       (add_ml == true) ? mounting_select_pre : "0"; 
                       var lamination_select     =       (add_ml == true) ? lamination_select_pre : "0"; 
                       var width_values          =       (add_ml == true) ? width_values_pre : "0"; 
                       var length_values         =       (add_ml == true) ? length_values_pre : "0"; 
                       var grommets              =       (grommets_pre == true) ? "Grommets" : "0";
                       var splins                =       (add_ml == true) ? splins_pre : "0";
                       var validate_imp          =        $("#validate_imp").val();
                        
                        
                        if(reference == ''){
                           alert("Please enter the job reference.");
                           document.getElementById('jobref').focus();
                           return false;
                       }                       
//                            if(original == ''){
//                                alert("Please enter the original.");
//                                document.getElementById('original').focus();
//                                return false;
//                            }                       
                       if(print_ea == ''){
                           alert("Please enter the Prints of Each.");
                           document.getElementById('print_ea').focus();
                           return false;
                       }    
                       
                       if(validate_imp == ''){
                            alert('Please select the file option');
                            $(".spl_option").css("background-color", "#FFFF00");
                            return false;
                        }else{
                            $(".spl_option").css("background-color", "#FFFF");    
                        }
                       
                        if (reference != '')
                            { 
                         $.ajax
                        ({
                            type: "POST",
                            url: "save_and_continue.php",
                            data: "save_and_continue_lfp=1&&reference="+encodeURIComponent(reference)+"&original="+original+
                                                  "&print_ea="+print_ea+"&size="+size+"&size_custom="+size_custom+"&output="+output+
                                                  "&output_both="+output_both+"&media="+media+"&binding="+binding+"&drop_file="+drop_file+"&ftp_link="+ftp_link+
                                                  "&ftp_user="+ftp_user+"&ftp_pass="+ftp_pass+"&schedule_pickup_dt="+encodeURIComponent(schedule_pickup_dt)+
                                                  "&schedule_place="+schedule_place+"&dropoff="+dropoff+"&special_instruction="+special_instruction+
                                                  "&add_ml_val="+add_ml_val+"&original_lam="+original_lam+"&mount_lam="+mount_lam_val+
                                                  "&mounting_select="+mounting_select+"&lamination_select="+lamination_select+"&width_values="+width_values+
                                                  "&length_values="+length_values+"&grommets="+grommets+"&ml_splins="+splins,
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
//                      var validate_imp        =   $("#validate_imp").val();
//                      if(validate_imp != ""){
//                      validate_lfp_cont();
//                      }else{
                      window.location = "add_recipients.php";    
//                      }
                    }
                    
                    function go_to_other_service()
                    {
                        var all_services = $("#all_services").val();
                        
                        if(all_services == "PAC"){
                            //validate_lfp();
                            window.location = "service_plotting.php?set_existed=1";
                        } 

                        if(all_services == "FAP"){
                            //validate_lfp();
                            window.location = "service_finearts.php?set_existed=1";
                        }

                        if(all_services == "ML"){
                            //validate_lfp();
                            window.location = "service_lamination.php";
                        }

                        if(all_services == "BIN"){
                            //validate_lfp();
                            window.location = "service_binding.php";
                        }

                        if(all_services == "OFP"){
                            //validate_lfp();
                            window.location = "service_offset.php";
                        }

                        if(all_services == "SCN"){
                            //validate_lfp();
                            window.location = "service_scanning.php";
                        } 

                        if(all_services == "CPS"){
                            //validate_lfp();
                            window.location = "service_copyshop.php";
                        }      
                        
                          if(all_services == "LFP"){
                          //validate_plotting();
                          window.location = "service_largeformat.php";
                          }
                    }
                    
                    function validate_lfp_cont()
                    {
                       var reference            =       $("#jobref").val();
                       var original             =       $("#original").val();
                       var print_ea             =       $("#print_ea").val(); 
                       
                       var size                 =       $("#size").val();
                       var size_custom_pre      =       $("#size_custom").val();
                       var size_custom          =       (size == "Custom") ? size_custom_pre : "0";
                       
                       var output               =       $("#output").val();                       
                       var output_both_pre      =       $("#output_both").val();
                       var output_both          =       (output == "Both") ? output_both_pre : "0";
                       
                       var media                =       $("#media").val();
                       
                       var binding              =       $("#binding").val();
                       
                       var drop_file_check      =       document.getElementById("drop_file").checked;
                       var drop_file            =       (drop_file_check == true) ? "1" : "0";
                       
                       var link                 =       document.getElementById("link").checked;
                       var ftp_link_pre         =       $("#ftp_link").val();
                       var ftp_user_pre         =       $("#user_name").val();
                       var ftp_pass_pre         =       $("#pass_word").val();
                       
                       var ftp_link             =       (link == true) ? ftp_link_pre : "0";
                       var ftp_user             =       (link == true) ? ftp_user_pre : "0";
                       var ftp_pass             =       (link == true) ? ftp_pass_pre : "0";
                       
                       var pick                 =       document.getElementById("pick").checked;
                       var my_office            =       document.getElementById("my_office").checked;
                       var address_book_se      =       $("#address_book_se").val();
                       var date_for_alt         =       $("#date_for_alt").val();
                       var time_for_alt         =       $("#time_for_alt").val();
                       
                       var schedule_pickup_dt   =       (pick == true) ? date_for_alt+"&nbsp;"+time_for_alt : '0';
                       var schedule_place       =       (my_office == true) ? "my_office" : address_book_se;
                       
                       var dropoff_pre          =       document.getElementById("dropoff").checked;
                       var dropoff              =       (dropoff_pre == true) ? "381 Broome Street" : "0";
                       
                       var special_ins_pre      =       $("#special_instruction").val();
                       var special_instruction  =       (special_ins_pre != "") ? special_ins_pre : "0";
                       
                       //Additional Mounting & Laminating Start
                       var add_ml               =       document.getElementById("add_ml").checked;
                       var add_ml_val           =       (add_ml == true) ? "1" : "0";
                       var original_lam_pre     =       $("#original_lam").val();
                       var validate_imp         =       $("#validate_imp").val();
                       
                       
                       var original_lam         =       (add_ml == true) ? original_lam_pre : "0";
                       
                       if(add_ml == true)                       {
                          
                       var mount_lam_1          =       document.getElementById("mount_lam_check").checked;
                       var mount_lam_2          =       document.getElementById("mount_lam_check_0").checked;
                       var mount_lam_3          =       document.getElementById("mount_lam_check_1").checked;
                       var grommets_pre         =       document.getElementById("grommets").checked;
                       
                       
                       if(mount_lam_1 == true){
                            var mount_lam            =       "M";
                           }else if(mount_lam_2 == true){
                            var mount_lam            =       "L";
                           }else if(mount_lam_3 == true){
                            var mount_lam            =       "Both";
                           }
                        }
                        
                       var mounting_select_pre   =       $("#mounting_select").val();
                       var lamination_select_pre =       $("#lamination_select").val();
                       var width_values_pre      =       $("#width_values").val();
                       var length_values_pre     =       $("#length_values").val();
                       
                       var splins_pre            =       $("#splins").val();
                       
                       var mount_lam_val         =       (add_ml == true) ? mount_lam : "0";
                       var mounting_select       =       (add_ml == true) ? mounting_select_pre : "0"; 
                       var lamination_select     =       (add_ml == true) ? lamination_select_pre : "0"; 
                       var width_values          =       (add_ml == true) ? width_values_pre : "0"; 
                       var length_values         =       (add_ml == true) ? length_values_pre : "0"; 
                       var grommets              =       (grommets_pre == true) ? "Grommets" : "0";
                       var splins                =       (add_ml == true) ? splins_pre : "0";
                       
                       //Additional Mounting & Laminating End
                       
                       
                       if(reference == ''){
                           alert("Please enter the job reference.");
                           document.getElementById('jobref').focus();
                           return false;
                       }                       
//                            if(original == ''){
//                                alert("Please enter the original.");
//                                document.getElementById('original').focus();
//                                return false;
//                            }                       
                       if(print_ea == ''){
                           alert("Please enter the Prints of Each.");
                           document.getElementById('print_ea').focus();
                           return false;
                       }     
                       
                       if(validate_imp == ''){
                            alert('Please select the file option');
                            $(".spl_option").css("background-color", "#FFFF00");
                            return false;
                        }else{
                            $(".spl_option").css("background-color", "#FFFF");    
                        }
                        if (reference != '')
                            {
                                $.ajax
                                        ({
                                            type: "POST",
                                            url: "add_lfp_sets.php",
                                            data: "service_lfp_add=1&reference="+encodeURIComponent(reference)+"&original="+original+
                                                  "&print_ea="+print_ea+"&size="+size+"&size_custom="+size_custom+"&output="+output+
                                                  "&output_both="+output_both+"&media="+media+"&binding="+binding+"&drop_file="+drop_file+"&ftp_link="+ftp_link+
                                                  "&ftp_user="+ftp_user+"&ftp_pass="+ftp_pass+"&schedule_pickup_dt="+schedule_pickup_dt+
                                                  "&schedule_place="+schedule_place+"&dropoff="+dropoff+"&special_instruction="+special_instruction+
                                                  "&add_ml_val="+add_ml_val+"&original_lam="+original_lam+"&mount_lam="+mount_lam_val+
                                                  "&mounting_select="+mounting_select+"&lamination_select="+lamination_select+"&width_values="+width_values+
                                                  "&length_values="+length_values+"&grommets="+grommets+"&ml_splins="+splins,
                                            beforeSend: loadStart,
                                            complete: loadStop,
                                            success: function(option)
                                            {                           
                                                 window.location = "add_recipients.php";
                                            }
                                        });
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
                                    $("#jobref").val(auto_ref);
                                    $("#jobref_id").val(ID);
                                    $("#company_id").val(COMP_ID);
                                    $("#result_ref").hide();                    
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

function use_same_set()
{   
    var use_same = document.getElementById('use_same_check_box').checked;     
    if(use_same == true){            
     $.ajax
        ({
            type: "POST",
            url: "use_the_same_file_lfp.php",
            data: "use_thesame_file=1",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                if(option == true){
                $("#use_same").slideDown(1000);
                $("#options_plott").slideUp();
                $("#validate_imp").val('1');
                }
            }
        });     
    }else{
        $.ajax
        ({
            type: "POST",
            url: "use_the_same_file_lfp.php",
            data: "use_thesame_file=2",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {   
                if(option == true){                
                $("#use_same").slideUp(1000);
                $("#options_plott").slideDown();
                $("#validate_imp").val('');
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
    </body>
</html>
