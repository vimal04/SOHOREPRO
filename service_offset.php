<?php
include './admin/config.php';
include './admin/db_connection.php';

//if($_SESSION['sohorepro_companyid']  == '')
//{
//  header("Location:index.php");
//  exit;
//}


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
        
//        echo '<pre>';    
//        print_r($_SESSION);
//        echo '</pre>';
//        exit;
        
        
        header("Location:service_offset.php");
    } else {
        header("Location:index.php?err=incorrect");
    }
}




$user_id_add_set        = $_SESSION['sohorepro_userid'];
$company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
$customer_details       = customerName($user_id_add_set);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Offset - Services</title>

        <link rel="stylesheet" href="services_support/style.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/theme.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/jquery.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/tiptip.css" type="text/css" media="screen">

        <link rel="stylesheet" type="text/css" href="services_support/style_layout.css">
        
        <link rel="stylesheet" type="text/css" href="style/red.css">
        
        <link rel="stylesheet" href="services_support/style.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/theme.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/jquery.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/tiptip.css" type="text/css" media="screen">

        <link rel="stylesheet" type="text/css" href="services_support/style_layout.css">
        <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
        <script src="store_files/jquery.min.js"></script>
 <!--<link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">-->
 <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
 <!--[if IE 7]>
 <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
 <![endif]-->
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
        <style>
            #link{
                /*width: 100%;*/
                text-align: center; 
                display: none;
            }
            #drop{
                width: 100%;
                text-align: center;                 
                display: none;
                /*height: 110px;*/
            }
            #link li{
                margin-bottom: 3px;                
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
            height: 100px;
            line-height: 40px;
            margin-top: 5px;
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
              width: 93%;
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
   
                #status1{
                    float: left;
                    width: 100%;
                    margin-bottom: 10px;
                }
                .none{
                    display: none;
                }
                .btn-custom{
                    color: #fff;
                    background-color: #ff7e00;
                    border-color: #ff7e00;
                }
                .btn-custom:hover{
                    background-color: #ff7e00;
                    color: #000;
                    border-color: #ff7e00;
                }
                
                .spl_option > div
                {
                   float:left;
                   padding:10px 20px;
                   margin: 6px 5px 6px 0px;
                   background: #EFEFEF;
                   border-radius: 3px;
                   width: 48%;
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
        </style>
        
        
        
        <script>
        function offset_form()
        {
            $("#offset_form").slideDown();
        }
        
       
        
        function drop_click(){
            
            var ftp_link        =   $("#ftp_link").val();
            var user_name       =   $("#user_name").val();
            var pass_word       =   $("#pass_word").val();
                         
            $.ajax
            ({
                type: "POST",
                url: "delete_offset_upload_files.php",
                data: "delete_offset_file=2",
                beforeSend: loadStart,
                complete: loadStop,
                success: function(option)
                {   
                    if(option == true){
                        $("#ftp_link").val('');
                        $("#user_name").val('');
                        $("#pass_word").val('');

                        $("#link").slideUp();
                        $("#drop").slideDown();
                    }
                }
            });
                
        }
        
        function link_click(){ 
            
            var user_id = $("#user_id").val();
            var comp_id = $("#comp_id").val();

            $.ajax
            ({
                type: "POST",
                url: "delete_offset_upload_files.php",
                data: "delete_offset_file=1&user_id="+encodeURIComponent(user_id)+"&comp_id="+comp_id,
                beforeSend: loadStart,
                complete: loadStop,
                success: function(option)
                {   
                    if(option == true){
                    $("#drop").slideUp();
                    $("#link").slideDown();
                    $(".statusbar").hide();
                    }
                }
            });
        }
        
        function off_set_form_submit()
        {
            var full_name           =   $("#full_name").val();
            var email               =   $("#email").val();
            var phone               =   $("#phone").val();
            var ask_your_question   =   $("#ask_your_question").val();
            
            var ftp_link_pre        =   $("#ftp_link").val();
            var user_name_pre       =   $("#user_name").val();
            var pass_word_pre       =   $("#pass_word").val();
            
            var ftp_link            =   (ftp_link_pre != '') ? ftp_link_pre : '0';
            var user_name           =   (user_name_pre != '') ? user_name_pre : '0';
            var pass_word           =   (pass_word_pre != '') ? pass_word_pre : '0';
            
            if(ask_your_question == ''){
                $("#ask_your_question").focus();
                return false;
            }
            
            if(ask_your_question != '')
            {                 
                $.ajax
                ({
                    type: "POST",
                    url: "delete_offset_upload_files.php",
                    data: "off_set_form_submit=1&full_name="+encodeURIComponent(full_name)+
                            "&email="+encodeURIComponent(email)+"&phone="+encodeURIComponent(phone)+
                            "&ask_your_question="+encodeURIComponent(ask_your_question)+
                            "&ftp_link="+encodeURIComponent(ftp_link)+
                            "&user_name="+encodeURIComponent(user_name)+
                            "&pass_word="+encodeURIComponent(pass_word),
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {   
                        if(option == true){
                            
                            $("#ftp_link").val('');
                            $("#user_name").val('');
                            $("#pass_word").val('');
                            $("#ask_your_question").val('');
                            
                            $("#drop").slideUp();
                            $("#link").slideDown();
                            $(".statusbar").hide();
                            
                            $("#success").slideDown(1000);
                            $("#success").slideUp(1000);
                        }
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
        </script>
        
       
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
        
        function sendFileToServer(formData,status)
{
    var uploadURL ="upload_off_set_files.php"; //Upload URL
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


        </script>
    </head>
    <body>
        <div id="loading" class="none"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1000;">
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
                            <div id="orderWapper">
                                <h2 class="headline-interior orange" style="text-transform: uppercase;">Offset Printing</h2>
                                
                                <div style="margin-bottom:10px!important;text-align: justify;float: left;width: 100%;line-height: 20px;font-size: 16px;margin-top: 10px;">
                                    One of the most important functions in the printing process is prepress production. This stage makes

                                    sure that all files are correctly processed in preparation for printing. This includes converting to the

                                    proper CMYK color model, finalizing the files, and creating plates for each color of the job to be run

                                    on the press.<br><br>

                                    Compared to other printing methods, offset printing is best suited for economically producing large

                                    volumes of high quality prints.

                                    Advantages of offset printing compared to other printing methods include:
                                <ul style="margin-left: 25px;margin-top: 6px;">
                                        <li>
                                            consistent high image quality. Offset printing produces sharp and clean images and type.
                                        </li>                                                                    
                                        <li>
                                        cost. Offset printing is the cheapest method for producing high quality prints in commercial printing quantities.
                                        </li>
                                    </ul>
                                    
                                To discuss your project and/or to receive a quote, <a style="color: #1833CC;cursor: pointer;" onclick="return offset_form();">kindly email</a> or call (212) 925-7575 x211.
                                </div>
                                <div id="success" style="float: left;width: 100%;text-align: center;color: #007F2A;font-weight: bold;display: none;">
                                    Your request sent successfully.
                                </div>
                                <div style="float: left;width: 100%;">
                                <?php
                                $user_id_add_set        = $_SESSION['sohorepro_userid'];
                                $company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
                                ?>
                                    <div id="offset_form" style="display: none;">
                                                                                
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                                    <input type="hidden" name="comp_id" id="comp_id" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                                    
                                    <div style="width: 100%;float: left;border: 1px solid #ff7e00;border-top: 0px;border-right: 0px;border-left: 0px;font-weight: bold;margin-bottom: 7px;">
                                        File Options (Optional)
                                    </div>
                                    
                                    <div style="width: 96%;float: left;margin-left: 20px;">
                                        
                                        <div class="spl_option">
                                            <div>
                                                <input class="filetrigger" name="alt_file_option" value="dropOff" id="drop_file"  type="radio" onclick="return link_click();" />
                                                <label for="drop" >                                                  
                                                  Provide Link to File
                                                </label>                    
                                            </div>

                                            <div>
                                                  <input class="filetrigger" name="alt_file_option" value="dropOff"  type="radio" onclick="return drop_click();" />
                                                <label for="drop" >
                                                  Upload File
                                                </label>                    
                                            </div> 
                                        </div>                                      
                                        
                                    </div>
                                    
                                    <div style="width: 96%;float: left;margin-left: 20px;margin-bottom: 10px;">
                                        <div id="link" style="width: 99%;float: left;border: 1px solid rgb(255, 126, 0);">
                                            <ul  style="margin: auto;width: 60%;list-style: none;margin-top: 10px;margin-bottom: 10px;">                                                
                                                <li><input type="text" name="ftp_link" id="ftp_link" placeholder="FTP Link" style="border: 1px solid #ccc;width: 250px;"></li>
                                                <li><input type="text" name="user_name" id="user_name" placeholder="User Name" style="border: 1px solid #ccc;width: 250px;"></li>
                                                <li><input type="text" name="password" id="pass_word" placeholder="Password" style="border: 1px solid #ccc;width: 250px;"></li>
                                            </ul>                               
                                        </div>
                                        <div id="drop" style="width: 99%;float: left;border: 1px solid rgb(255, 126, 0);">
                                            <div>
                                                <input type="hidden" name="uploadedfile" id="uploadedfile" value=""> 
                                                <div id="dragandrophandler">Drag &amp; Drop Files Here</div>                                                
                                                <div id="status1"></div>                                             
                                            </div>
                                        </div>
                                    </div>
                                    
<!--                                    <div style="width: 96%;float: left;border: 1px solid #ccc;margin-bottom: 15px;border-radius: 4px;margin-left: 15px;">
                                        <div id="link_click" onclick="return link_click();" style="width: 100%;text-align: center;background-color: #CCC;cursor: pointer;height: 30px;margin-bottom: 3px;font-size: 18px;color: #ff7e00;">Provide Link to File</div>
                                            <ul id="link" style="margin: auto;width: 60%;list-style: none;">                                                
                                                <li><input type="text" name="ftp_link" id="ftp_link" placeholder="FTP Link" style="border: 1px solid #ccc;width: 250px;"></li>
                                                <li><input type="text" name="user_name" id="user_name" placeholder="User Name" style="border: 1px solid #ccc;width: 250px;"></li>
                                                <li><input type="text" name="password" id="pass_word" placeholder="Password" style="border: 1px solid #ccc;width: 250px;"></li>
                                            </ul>
                                        <div id="drop_click" onclick="return drop_click();" style="width: 100%;text-align: center;background-color: #CCC;cursor: pointer;height: 30px;font-size: 18px;color: #ff7e00;">Upload File</div>
                                            <div id="drop">
                                                <input type="hidden" name="uploadedfile" id="uploadedfile" value=""> 
                                                <div id="dragandrophandler">Drag &amp; Drop Files Here</div>                                                
                                                <div id="status1"></div>                                             
                                            </div>
                                    </div>-->
                                <div>
                                    <?php
                                    $full_name = ($customer_details[0]['cus_fname'] != '') ? $customer_details[0]['cus_fname'].'&nbsp;'.$customer_details[0]['cus_lname'] : '';
                                    ?>
                                <div class="col-md-5 col-sm-5 col-xs-12 animated slideInLeft visible" data-animation="slideInLeft">
                                    <div class="form-group"><input class="form-control input-lg" name="author" id="full_name" type="text" placeholder="Full Name" data-fieldid="0" value="<?php echo $full_name; ?>"></div>
                                    <div class="form-group"><input class="form-control input-lg" name="email" id="email" required="" type="email" placeholder="Email" data-fieldid="1" value="<?php echo $customer_details[0]['cus_contact_email']; ?>"></div>
                                    <div class="form-group"><input class="form-control input-lg" name="phone" id="phone" type="text" placeholder="Phone" data-fieldid="2" value="<?php echo $customer_details[0]['cus_contact_phone']; ?>"></div>
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12 animated slideInRight visible" data-animation="slideInRight">
                                <div class="form-group">
                                    <textarea class="form-control input-lg" style="height: 165px;" name="message" id="ask_your_question" required="" placeholder="Ask your Question" data-fieldid="3"></textarea></div>
                                </div>
                                </div>
                                    <p style="text-align: right;margin-right: 15px;"><input class="btn btn-custom up animated fadeInUpBig visible" onclick="return off_set_form_submit();" type="submit" value="Send Message" data-animation="fadeInUpBig"></p>
                                </div>  
                                </div>
                            </div>

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
</html>
