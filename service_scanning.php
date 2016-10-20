<?php
include './admin/config.php';
include './admin/db_connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Scanning - Services</title>

        <link rel="stylesheet" href="services_support/style.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/theme.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/jquery.css" type="text/css" media="screen">

        <link rel="stylesheet" href="services_support/tiptip.css" type="text/css" media="screen">

        <link rel="stylesheet" type="text/css" href="services_support/style_layout.css">
        <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
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
        
    </head>
    <body>
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
                                <h2 class="headline-interior orange" style="text-transform: uppercase;">Scanning</h2>
                                <div class="bkgd-stripes-orange">&nbsp;</div>
<!--                                <p style="margin-bottom:10px!important;">
                                    Large Format or Vector Scanning:<br>
                                    Our 36â&#8364;&#157; scanner can convert your drawing to a raster format: PDF or TIFF format. This electronic
                                    file can be burned to a CD, placed onto your USB drive or emailed...(more)

                                </p>-->

                                <form id="scanning" enctype="application/x-www-form-urlencoded" action="service/scanning/" method="post" class="systemForm validate orderform"><ul>
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
                                          
                                          <div style="float:left;width:100%;">
                                            <ul class="arch_radio">
                                                <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;text-transform: uppercase;">Scanning</span></li>
                                                <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" onclick="return active_arch();" /><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;text-transform: uppercase;">Vectorizing</span></li>
                                            </ul>
                                            <span id="errmsg"></span>
                                        </div>
                                          
                                        <li class="clear"><span>
                                                <div class="serviceOrderSetHolder"><div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0"><div class="serviceOrderSetWapperInternal"><div class="serviceOrderSetDIV"><div><label>File Format</label><div class="drop" style="margin-right:0px;margin-left:0px;height:2px;"><div style="float:left;margin-right:0px;"><select class="order_0_set1_0_format kdSelect " style="width:260px;" id="order_0_set1_0_format" name="order[0][set1][0][format]"><option selected="selected" value="JPG">JPG</option><option value="TIFF">TIFF</option><option value="PDF">PDF</option><option value="AutoCAD DWG">AutoCAD DWG</option><option value="VectorWorks MCD">VectorWorks MCD</option> </select></div><div class="dropdown_selector"></div></div></div><div><label>AutoCAD/ VectorWorks Version #</label><input class="order_0_set1_0_Version  k-input kdText " style="width:290px;" id="order_0_set1_0_Version #" name="order[0][set1][0][Version]" type="text"></div><div><label>Scan Type</label><div class="drop" style="margin-right:0px;margin-left:0px;height:2px;"><div style="float:left;margin-right:0px;"><select class="order_0_set1_0_ScanType kdSelect " style="width:400px;" id="order_0_set1_0_ScanType" name="order[0][set1][0][ScanType]"><option selected="selected" value="Architectural Drawing (Convert to Vector File)">Architectural Drawing (Convert to Vector File)</option><option value="Flat Art">Flat Art</option><option value="4 x 5 Chrome">4 x 5 Chrome</option><option value="2 1/4 Chrome">2 1/4 Chrome</option><option value="35 mm Slide">35 mm Slide</option><option value="Other">Other</option> </select></div><div class="dropdown_selector"></div></div></div><div><label>Resolution (DPI)</label><input class="order_0_set1_0_resolution k-input kdText " style="width:130px;" id="order_0_set1_0_resolution" name="order[0][set1][0][resolution]" type="text"></div><div><label>Name of Scanned File</label><input class="ymlrequired order_0_set1_0_filename k-input kdText " style="width:350px;" id="order_0_set1_0_filename" name="order[0][set1][0][filename]" type="text"></div></div></div><div style="clear:both;"></div></div></div><div style="width:auto;text-align:right"><input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px;margin-right:130px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="submit"></div>
                                                </span></li>
                                        <li class="clear"><label for="emailaddress" class="optional">Mail Scanned File To</label>
                                            <span>
                                                <input name="emailaddress" id="emailaddress" style="width:350px;height:25px;" type="text"></span></li>
                                        <li class="clear"><label for="instruction" class="optional">Special Instructions</label>
                                            <span>
                                                <textarea name="instruction" id="instruction" cols="60" rows="4"></textarea></span></li>
                                        <li class="clear"><span>
                                                <div style="height:29px;">&nbsp;</div><input class="addproductActionLink" value="Save to Cart" style="cursor: pointer;float:right;font-size:12px; padding:1.5px; width: 100px;margin-right:14px;margin-top:15px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="submit"><div style="clear:both"></div></span></li></ul></form>         
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
