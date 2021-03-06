Cutting Special Instructions<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);




?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Binding - Services</title>

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
                                <!--  <div class="orderBreadCrumb">binding</div>-->
                                <h2 class="headline-interior orange" style="text-transform: uppercase;">
                                    Binding
                                </h2>
                                <div class="bkgd-stripes-orange">&nbsp;</div>
                                <form id="binding" enctype="application/x-www-form-urlencoded" action="service/binding/" method="post" class="systemForm orderform"><ul>
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
                   
                  <div style="width:100%;float:left;font-size: 13px !important;font-weight: bold;">Job Options</div>
                  <div style="width:730px;border-bottom: 1px solid #FF7E00;float: left;margin-top:5px;"></div>
                  
                  <!-- Drop Down Section Start --->
                  
                  <div style="width:100%;float:left;margin-top: 5px;">
                      
                      <div style="width:29%;float:left;">
                          <label>Binding</label>
                          <select class="order_0_set1_0_binding kdSelect " style="width:150px;" id="binding_main_option" name="" onchange="return get_child_option();">
                            <option value="N">------</option>
                            <option value="1">Wire-O</option>
                            <option value="2">Perfect</option>
                            <option value="3">Screw Post</option>
                            <option value="4">ACCO</option>
                            <option value="5">Staple</option>
                            <option value="6">GBC</option>
                            <option value="7">Velo Binding </option>
                            <option value="8">FastBack</option>
                            <option value="9">Coil</option>
                         </select>
                          
                          <label style="margin-top: 10px;">Front Cover</label>
                          <select class="order_0_set1_0_binding kdSelect " style="width:150px;" id="front_main_option" name="" onchange="return get_child_option_front();">
                            <option value="N">------</option>
                            <option value="101">Clear Cover</option>
                            <option value="102">Opaque Cover</option>
                            <option value="103">Frosted Cover</option>
                            <option value="104">Illustration Board</option>
                            <option value="105">Chipboard</option>
                         </select>
                          
                          <label style="margin-top: 10px;">Back Cover</label>
                          <select class="order_0_set1_0_binding kdSelect " style="width:150px;" id="back_main_option" name="" onchange="return get_child_option_back();">
                            <option value="N">------</option>
                            <option value="201">Clear Cover</option>
                            <option value="202">Opaque Cover</option>
                            <option value="203">Frosted Cover</option>
                            <option value="204">Illustration Board</option>
                            <option value="205">Chipboard</option>
                         </select>
                      </div>
                      
                      <div style="width:24%;float:left;">
                            <label>Binding Option</label>
                            <select class="order_0_set1_0_bindingVariation kdSelect " style="width:120px;" id="binding_child_option" name="">
                                <option value="0">None</option>
                                <option value="N/A">N/A</option>
                             </select>
                            
                            <label style="margin-top: 10px;">&nbsp;</label>
                            <select class="order_0_set1_0_bindingVariation kdSelect " style="width:120px;" id="binding_child_option_front" name="">
                                <option value="0">None</option>
                                <option value="N/A">N/A</option>
                             </select>
                            
                            <label style="margin-top: 10px;">&nbsp;</label>
                            <select class="order_0_set1_0_bindingVariation kdSelect " style="width:120px;" id="binding_child_option_back" name="">
                                <option value="0">None</option>
                                <option value="N/A">N/A</option>
                             </select>
                      </div>
                      
                      <div style="width:24%;float:left;">
                          <label>Number of Books to Bind</label>
                          <input type="text" style="width:50px;" name="nob" id="nob" />
                          
                          <label style="margin-top: 10px;">Sizes</label>
                            <input style="width: 10% !important;" type="checkbox" name="size" value="8.5x11">8.5x11
                            <input style="width: 10% !important;" type="checkbox" name="size" value="12x18">12x18<br> 
                            <input style="width: 10% !important;" type="checkbox" name="size" value="8.5x14">8.5x14                          
                      </div>
                      
                      <div style="width:20%;float:left;">
                          <label>Cutting</label>
                          <select class="order_0_set1_0_bindingVariation kdSelect " style="width:120px;" id="cutting_option" name="cutting_option" onchange="return cutting_spl_inc();" >
                                <option value="0">None</option>
                                <option value="1">Yes</option>
                             </select>
                      </div>
                      
                  </div>
                  
                  <!--- Drop Down Section End --->                  
                  <div id="cutting_spl_instructions" style="width: 100%;float:left;border: 1px solid #FF7E00;margin-top: 10px;display: none;">
                      <div id="sp_inst" style="margin-top:10px;text-align: center;">
                      <label style="font-weight: bold;">
                        Cutting Instructions
                      </label>
                      <br>
                      <textarea name="special_instruction_cutting" class="splins" id="special_instruction_cutting" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"><?php echo $entered['spl_instruction']; ?></textarea>
                    </div>
                  </div>
                      
                  <div style="width:730px;border-bottom: 1px solid #FF7E00;float: left;margin-top:5px;"></div>
                <!--Special Instruction Start-->
                <div style="float: left;width: 100%;margin-top: 5px;">
                    <div id="sp_inst" style="margin-top:10px;">
                      <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                        Special Instructions
                      </label>
                      <br>
                      <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"><?php echo $entered['spl_instruction']; ?></textarea>
                    </div>
                </div>
                 <!--Special Instruction End-->
                 <div style="width:730px;border-bottom: 1px solid #FF7E00;float: left;margin-top:15px;"></div> 
                 <div style="float:left;width:100%;text-align:right;margin-top: 10px;">                  
                  <input class="addproductActionLink" value="Save and Continue" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -1px !important;" type="button" onclick="return validate_plotting_cont();">                  
              </div>
              </div>

                                                                    
                                                                           <!--        Add <select name="redirect_to" id="redirect_to">
                                                                <option value="copyshop">Copy Shop Services</option>
                                                                <option value="view/store">Supplies</option>
                                                                <option value="service/scanning">Scanning</option>
                                                            </select> to my order &nbsp;&nbsp;&nbsp;
                                                            <input class="continute_service_shopping_link" type="submit" value="Go >" style="cursor: pointer;font-size:12px; padding:1.5px; width: 50px;margin-right:14px;margin-top:5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;"/>               
                                                        </div>
                                                    </div> -->



                                <!-- #######modified #######-->

                                <input id="action" value="qq" type="hidden">
                                <div id="terms" style="display:none;margin-left: -20px;margin-top: -37px;">

                                    <div style="margin-top:2px;width:300px;height:177px;background-color:#F9F2DE;padding:5px 34px 0px 34px;">
                                        <img id="closeit" style="height:15px;margin-left: 305px;margin-top:-30px;" src="SohoRepro-binding_files/rr.png"><br><br>
                                        <h2 class="headline-interior orange">
                                            REGISTER
                                        </h2>

                                        <hr style="margin-top:10px;margin-bottom: 4px;" color="#FF7E00">

                                        <!--<form style="padding-top: 12px;" id="signup" enctype="application/x-www-form-urlencoded" method="post" action="user/sortregistration">-->
                                        <form style="padding-top: 5px;" id="chkuserregister" enctype="application/x-www-form-urlencoded"> 

                                            <label style="padding:0px 2px 2px 0;">               
                                                <span style="font-size:11px;">Are you from :</span>
                                            </label><br><br>
                                            <label style="padding:2px 2px 2px 0;">               
                                                <span id="userchk" style="font-size:16px;font-weight:bold;" tvalue=""> </span>
                                            </label><br>

                                            <span>                
                                                <input id="cls_yes" class="subNewOrderSet1" style="margin-left:245px;cursor: pointer;font-size:12px; padding:1.5px; width: 60px;margin-top:24px;margin-right:25px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" value="Yes" type="submit">
                                            </span>
                                            <div style="margin-top:-28px;">                
                                                <input id="cls_no" class="subNewOrderSet1" style="margin-left:172px;cursor: pointer;font-size:12px; padding:1.5px; width: 60px;margin-top:8px;margin-right:15px;; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" value="No" type="submit">
                                            </div>
                                            <input id="list" name="list" value="" type="hidden">

                                        </form>


                                    </div>    

                                </div>
                                <!--- No --->

                                <div id="optionno" style="display:none;margin-left: -20px;margin-top: -37px;">

                                    <div style="margin-top:2px;width:302px;height:558px;background-color:#F9F2DE;padding:5px 34px 0px 34px;">
                                        <img id="closeit" style="height:15px;margin-left: 305px;margin-top:-30px;" src="SohoRepro-binding_files/rr.png"><br><br>
                                        <h2 class="headline-interior orange">
                                            REGISTER
                                        </h2>

                                        <hr style="margin-top:10px;margin-bottom: 4px;" color="#FF7E00">

                                        <form style="padding-top: 5px;" id="chkuserregister" enctype="application/x-www-form-urlencoded" method="post" action="user/sortregistration"> 

                                            <ul style="list-style: none">
                                                <li>
                                                    <input id="status" name="status" value="long" type="hidden">
                                                </li>
                                                <li>
                                                    <input id="phoneno" name="phoneno" value="" type="hidden">
                                                </li>
                                                <li>
                                                    <label style="padding:2px 2px 2px 0;">               
                                                        <span style="font-sixe:16px;">Name</span>
                                                    </label><br>
                                                    <span>
                                                        <input id="firstname" class="ui-autocomplete-input" name="name" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text">
                                                    </span>
                                                </li>

                                                <li>
                                                    <label style="padding:2px 2px 2px 0;">               
                                                        <span style="font-sixe:16px;">Email</span>
                                                    </label><br>
                                                    <span>
                                                        <input id="email" class="ui-autocomplete-input" name="email" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text">
                                                    </span>
                                                </li>
                                                <li>
                                                    <label style="padding:2px 2px 2px 0;">               
                                                        <span style="font-sixe:16px;">Company Name</span>
                                                    </label><br>
                                                    <span>
                                                        <input id="companyname" class="ui-autocomplete-input" name="companyname" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text">
                                                    </span>
                                                </li>
                                                <li class="clear">
                                                    <label>
                                                        Address
                                                        <span style="font-sixe:16px;font-weight:bold;"></span>
                                                    </label>
                                                    <span>
                                                        <br>
                                                        <label style="padding-left:0;padding-right:0;font-weight:normal;font-size:10px;font-family:arial;">Street Address Line 1</label><br>
                                                        <input id="addressLineOne" name="address[lines][0]" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text"><br>
                                                        <label style="padding-left:0;padding-right:0;font-weight:normal;font-size:10px;font-family:arial;">Street Address Line 2</label><br>
                                                        <input id="addressLineTwo" name="address[lines][1]" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text">
                                                        <label style="padding-left:0;padding-right:0;margin-right:4%;font-weight:normal;font-size:10px;font-family:arial;width:46%;float:left;">City</label>
                                                        <input id="addressCity" name="address[city]" style="margin-top:5px;width:65%;height:20px;float:left;margin-right:4%;border:1px solid #CCCCCC;" type="text">
                                                        <br>	    
                                                        <label style="padding-left:0;padding-right:0;font-weight:normal;font-size:10px;font-family:arial;width:45%;float:left;">State</label>
                                                        <input id="addressState" name="address[state]" style="margin-top:5px;width:65%;height:20px;float:left;border:1px solid #CCCCCC;" type="text">
                                                        <div style="clear:both"></div>
                                                        <br>
                                                        <label style="padding-left:0;padding-right:0;margin-right:4%;font-weight:normal;font-size:10px;font-family:arial;width:46%;float:left;">Zip/Postal Code</label>
                                                        <input id="addressZipCode" name="address[pin]" style="margin-top:5px;width:65%;height:20px;float:left;margin-right:4%;border:1px solid #CCCCCC;" type="text">
                                                        <br>
                                                        <label style="padding-left:0;padding-right:0;font-weight:normal;font-size:10px;font-family:arial;width:45%;float:left;">Country </label>
                                                        <input id="addressCountry" name="address[country]" style="margin-top:5px;width:65%;height:20px;float:left;border:1px solid #CCCCCC;" type="text">

                                                        <div style="clear:both"></div>
                                                    </span>
                                                </li>
                                                <li>
                                                    <input class="submitnobutton" style="margin-left:156px;cursor: pointer;font-size:12px; padding:1.5px; width: 60px;margin-top:16px;margin-right:15px;; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" value="Submit" type="submit">

                                                </li>
                                            </ul>  

                                        </form>

                                    </div>    

                                </div>
                                <!--- Yes --->


                                <div id="optionyes" style="display:none;margin-left: -20px;margin-top: -37px;">

                                    <div style="margin-top:2px;width:302px;height:230px;background-color:#F9F2DE;padding:5px 34px 0px 34px;">
                                        <img id="closeit1" class="closeit" style="height:15px;margin-left: 305px;margin-top:-30px;" src="SohoRepro-binding_files/rr.png"><br><br>
                                        <h2 class="headline-interior orange">
                                            REGISTER
                                        </h2>

                                        <hr style="margin-top:10px;margin-bottom: 4px;" color="#FF7E00">


                                        <form style="padding-top: 5px;" id="chkuserregister" enctype="application/x-www-form-urlencoded" method="post" action="user/sortregistration"> 

                                            <ul style="list-style: none">
                                                <li>
                                                    <input id="status1" name="status" value="short" type="hidden">
                                                </li>
                                                <li>
                                                    <input id="phoneno1" name="phoneno" value="" type="hidden">
                                                </li>
                                                <li>
                                                    <label style="padding:2px 2px 2px 0;">               
                                                        <span style="font-sixe:16px;">Name</span>
                                                    </label><br>
                                                    <span>
                                                        <input id="firstname1" class="ui-autocomplete-input" name="name" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text">
                                                    </span>
                                                </li>

                                                <li>
                                                    <label style="padding:2px 2px 2px 0;">               
                                                        <span style="font-sixe:16px;">Email</span>
                                                    </label><br>
                                                    <span>
                                                        <input id="email1" class="ui-autocomplete-input" name="email" style="border:1px solid #CCCCCC;margin-top:8px; width: 65%;margin-bottom:6px;height:20px;" type="text">
                                                    </span>
                                                </li>	    

                                                <li>
                                                    <input class="submityesbutton" style="margin-left:156px;cursor: pointer;font-size:12px; padding:1.5px; width: 60px;margin-top:16px;margin-right:15px;; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" value="Submit" type="submit">

                                                </li>
                                            </ul>  

                                        </form>

                                    </div>    

                                </div>
                                <div style="clear:both;"></div>

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
<script>
     
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

function validate_plotting_cont()
{
    $("body").append("<div class='modal-overlay'></div>");  
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
    
//    if($('input[name=plotting_check]:checked').length<=0)
//    {
//        alert('Please select the job option');
//        document.getElementById("plotting_check").focus();
//        return false;
//    }   
    
    
    if(continue_ok != '1'){
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
                          "&user_name_val="+encodeURIComponent(user_name_val)+"&password_val="+encodeURIComponent(password_val)+"&size_custom="+encodeURIComponent(size_custom)+"&same_file="+same_file,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {                            
                        window.location = "add_recipients.php";
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
 </script>