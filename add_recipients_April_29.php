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
 <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
 <!--[if IE 7]>
 <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
 <![endif]-->
 <script src="store_files/jquery.min.js"></script>
 <script type="text/javascript" src="js/jquery.timepicker.js"></script>
 <link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-ui_service.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" media="screen" />
<script>
function show_time()
{
    $('#time_picker_icon').timepicker({
        'minTime': '8:00am',
        'maxTime': '7:00pm',
        'showDuration': true
    });
}
    
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

 $(document).ready(function() {
var top = $('#fixed_header').offset().top - parseFloat($('#fixed_header').css('marginTop').replace(/auto/, 100));
$(window).scroll(function(event) {
    // what the y position of the scroll is
    var y = $(this).scrollTop();

    // whether that's below the form
    if (y >= top) {
        // if so, ad the fixed class
        $('#fixed_header').addClass('fixed_1');
    } else {
        // otherwise remove it
        $('#fixed_header').removeClass('fixed_1');
    }
});

});
</script>
 <style>
     .fixed_1{border-style:solid;border-width:0px; position: fixed; width: 761px; top: 0; z-index: 1; background: #DFDFDF;}
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
    right: 0;
    text-align: left;
    top: 19px;
    width: 185px;
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
.none{
    display: none;
}
.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #F99B3E; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
.upload_file_prog{
width: 30% !important;
padding: 1.5px;
-webkit-border-radius: 5px;
border: 1px solid #8f8f8f !important;
}
.arch_radio li{
list-style: none;
padding: 0px !important;
padding-left: 0px !important;
padding-bottom: 0px !important;
}
.increse_act{width: 12px;float: left;}
.increse_act img{width: 12px;float: left;}

.time_picker_icon {
    background: #FFFFFF url(images/clock.png) no-repeat 4px 4px;
    padding: 5px 5px 5px 30px;
    height: 18px;
    cursor: pointer;
    width: 50px;
}

 </style>
 
 </head>
 <body>
    <div id="loading" class="none"  style="position: fixed;top: 35%;left: 48%;padding: 5px;z-index: 10;">
         <img src="admin/images/login_loader.gif" border="0" />
    </div>
 <div id="body_container">
 <div id="body_content" class="body_wrapper">
 <div id="body_content-inner" class="body_wrapper-inner">

<?php include "includes/header_sidebar.php"; ?>
 
 <div id="content_output">

<?php include "includes/top_nav.php"; ?>
 
 <div id="content_output-data" style="margin-bottom:20px;">  
<!--- TABLE START -->
<?php // include "./service_nav.php"; ?>
<div id="orderWapper">
  <!-- 
<div class="orderBreadCrumb">
</div>
-->

  <h2 class="headline-interior orange">
	Delivery Job Reference: <?php echo $_SESSION['ref_val']; ?>
  </h2>
  <div class="bkgd-stripes-orange">
    &nbsp;
  </div>
    <?php
    if ($result == "success_plotting") {
        ?>
        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Set Added Successfully</div>
        <script>setTimeout("location.href=\'service_plotting.php\'", 1000);</script>
        <?php
    } elseif ($result == "failure_plotting") {
        ?>
        <div style="color:#F00; text-align:center; padding-bottom:10px;">Set Added Not Successfully</div>
        <script>setTimeout("location.href=\'service_plotting.php\'", 1000);</script>       
        <?php
    }  elseif($_GET['save_set'] == "1") { ?>
        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Set Added Successfully</div>
        <script>setTimeout("location.href=\'service_plotting.php\'", 1000);</script>
    <?php
    }
    ?>
    
        <div id="set_form">
            <div id="plotting" action="" method="post" class="systemForm orderform">
                    <!--<form id="plotting" action="" method="post" class="systemForm orderform" >-->
                        
                  <input type="hidden" name="plotting_set" value="0" />
                  <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                        <input type="hidden" name="jobref_id" id="jobref_id" value="" />
                        <input type="hidden" name="company_id" id="company_id" value="" />  
                <ul>
                  
                    <div  id="set_1">
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                  <li class="clear">
                  
                      <div class="serviceOrderSetHolder">
                          
                          <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">                            
                            <div style="padding-top: 10px;">
                                <input type="radio" name="del_type" id="everything_return" value="1" style="width: 15% !important;" onclick="return everything_return();" /><span style="text-transform: uppercase;font-weight: bold;">Return everything to my office</span>
                            </div>
<!--                            <div>
                                <input type="radio" name="del_type" id="send_everything_to" value="1" style="width: 15% !important;" onclick="return send_everything_to();" /><span style="text-transform: uppercase;font-weight: bold;">Send everything to :</span>                                
                                <select  name="address_book" id="address_book" style="width: 20% !important;">
                                    <option value="0">Address Book</option>
                                    <?php
                                    $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                                    foreach ($address_book as $address) { ?>                                                                                        
                                    <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                &nbsp;&nbsp; <span style="text-transform: uppercase;"><a href="#" style="color: #0001fc;" >Add entry</a> to address book</span>
                            </div>-->
                            <div>
                                <input type="radio" name="del_type" id="del_type_multi" value="1" style="width: 15% !important;" onclick="return multiple_recipient();"  /><span style="text-transform: uppercase;font-weight: bold;">Distribute to one or more locations</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="pickup_soho" value="1" style="width: 15% !important;" onclick="return pickup_soho();" /><span style="text-transform: uppercase;font-weight: bold;">Will pick up from SoHo</span>                                
                                <select style="width: 20% !important;">
                                    <option value="381 Broom" selected="selected">381 Broome St</option>
                                    <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                </select>
                            </div>
                        </div>
                          <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                            <div id="multi_recipients">

                            </div>

                            <div style="margin-top: 10px;">
                                <input id="add_recipients" value="Add Recipient" style="display: none;float:left;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return add_recipients();" />
                            </div>
                          </div>
                          
                          
              </div>
                      
           
              <div style="float:left;width:100%;text-align:right;">
                  <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                  <input class="addproductActionLink" value="Continue" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button" onclick="return continue_recipient();" />
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
            .picker_icon{
                background : #FFFFFF url(images/datepicker-20.png) no-repeat 4px 4px;
                padding: 5px 5px 5px 25px;
                height:18px;
                cursor: pointer;
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



 </div>

 <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>


 <script>
 function multiple_recipient()
 {
     var multi = document.getElementById('del_type_multi').checked;
     if(multi == true){ 
          $.ajax
                ({
                    type: "POST",
                    url: "get_recipients.php",
                    data: "recipients=1",
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideDown();
                    }
                });
     }else{
         alert('Mohamed');
     }
 }
 
 function everything_return()
 {
     var everything_return = document.getElementById('everything_return').checked;
     if(everything_return == true){
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function send_everything_to()
 {
     var send_everything_to = document.getElementById('send_everything_to').checked;
     if(send_everything_to == true){
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function pickup_soho()
 {
     var pickup_soho = document.getElementById('pickup_soho').checked;
     if(pickup_soho == true){
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function add_recipients(){
     
     var shipping_id            = $("#address_book_rp").val();
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == true) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == true) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == true)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("shipp_comp_3").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=9&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
 }
 
 
 function continue_recipient(){
     
     var shipping_id            = $("#address_book_rp").val();
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == true) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == true) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == true)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("shipp_comp_3").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=9&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                window.location = "view_all_recipients.php";
            }
        });
 }
 
 
 
 function increase_qty(ID){
     
     var need_sets      =   $("#need_sets_"+ID).val();
     var avl_sets       =   $("#avl_sets_"+ID).val();
     
        need_sets++;
        if(need_sets <= avl_sets){
        $('#need_sets_'+ID).val(need_sets);
        }
 }
 
 function decrease_qty(ID)
 {
     var need_sets      =   $("#need_sets_"+ID).val();
     var avl_sets       =   $("#avl_sets_"+ID).val();
     
        need_sets--;
        if(need_sets != '0')
        {
        $('#need_sets_'+ID).val(need_sets);
        }
 }
 
 function increase_qty_avl(ID,USR_ID,COMP_ID,TYPE,REC_ID)
{   
    var avl_sets       =   $("#avl_sets_"+ID).val();
    var need_sets_1    =   $("#need_sets_1").val();
    var need_sets_2    =   $("#need_sets_2").val();
    avl_sets++;
    if(avl_sets != '0'){    
        $('#avl_sets_'+ID).val(avl_sets);
        $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=5&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE+"&inc_avl_rec_id="+REC_ID+"&need_sets_current_1="+need_sets_1+"&need_sets_current_2="+need_sets_2+"&need_sets_avl_sets="+avl_sets,
                success: function(option)
                {                    
                    $('#sets_grid_new').html(option);                             
                }
            });
    }
}
 
 function increase_qty_avl_copies(ID,USR_ID,COMP_ID,TYPE)
 {
     var avl_sets       =   $("#avl_sets_"+ID).val();
    avl_sets++;
    if(avl_sets != '0'){    
        $('#avl_sets_'+ID).val(avl_sets);
        $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=55&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE,
                success: function(option)
                {                    
                    $('#sets_grid_new').html(option);                             
                }
            });
    }
 }
 
 function increase_qty_avl_plot(ID,USR_ID,COMP_ID,TYPE)
 {
     var avl_sets       =   $("#avl_sets_"+ID).val();
    avl_sets++;
    if(avl_sets != '0'){    
        $('#avl_sets_'+ID).val(avl_sets);
        $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=55&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE,
                success: function(option)
                {                    
                    $('#sets_grid_new').html(option);                             
                }
            });
    }
     
 }
 
 function decrease_qty_avl(ID,USR_ID,COMP_ID,TYPE,REC_ID)
 {
     var avl_sets       =   $("#avl_sets_"+ID).val();
     var need_sets_1    =   $("#need_sets_1").val();
     var need_sets_2    =   $("#need_sets_2").val();
     
        avl_sets--;
        if(avl_sets != '0')
        {
            $('#avl_sets_'+ID).val(avl_sets);
            $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=4&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE+"&inc_avl_rec_id="+REC_ID+"&need_sets_current_1="+need_sets_1+"&need_sets_current_2="+need_sets_2+"&decrese_avl_sets="+avl_sets,
                success: function(option)
                {                    
                    $('#sets_grid_new').html(option);                             
                }
            });
        
        }
 }
 
 function delete_recipient(ID)
 {  
    var are_you_sure           = confirm("Are you sure.");    
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val(); 
     
    if(are_you_sure == true){
    $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=8&delete_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
    }
 } 
 
 function edit_recipient(ID)
 {    
    var are_you_sure           = confirm("Are you sure.");    
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val(); 
     
    if(are_you_sure == true){
    $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=7&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
    }
 }
 
 
 function update_recipient(ID)
 {
     var shipping_id            = $("#address_book_rp").val();
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     var folding_sets_1         = $("#folding_sets_1").val();
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == true) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == true) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == true)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("shipp_comp_3").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=6&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&edit_recipient_id="+ID+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
 }
 
 function uncheck_delivery()
 {
     var arrange_del = document.getElementById('arrange_del').checked;     
     if(arrange_del == true){          
     $('#delivery_info').slideDown();     
    }else{
     $('#delivery_info').slideUp();        
    }
    
 }
 
 function delete_recipient_empty()
 {
     alert('Empty');
 }
 
 function loadStart() {
$('#loading').show();
}

function loadStop() {
$('#loading').hide();
}

function show_address()
{
    var shipping_id     = $("#address_book_rp").val();
    {
        $.ajax
            ({
                type: "POST",
                url: "shipping_address_rec.php",
                data: "shipping_id_rp=" + shipping_id,
                success: function(option)
                {  
                    $("#show_address").html(option);
                }
            });
    }
}


$(function() {
    var all_exist_date_needed      = $("#all_exist_date").val();
    var split_element_needed       = all_exist_date_needed.split(","); 
    var disabledSpecificDays_needed = [split_element_needed[0],split_element_needed[1],split_element_needed[2],split_element_needed[3],split_element_needed[4],split_element_needed[5],split_element_needed[6],split_element_needed[7],split_element_needed[8],split_element_needed[8],split_element_needed[9],split_element_needed[10],split_element_needed[11],split_element_needed[12],split_element_needed[13],split_element_needed[14],split_element_needed[15],split_element_needed[16],split_element_needed[17],split_element_needed[18],split_element_needed[19]];

    function disableSpecificDaysAndWeekends(date) {
    var m = date.getMonth();
    var d = date.getDate();
    var y = date.getFullYear();

    for (var i = 0; i < disabledSpecificDays_needed.length; i++) {
    if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays_needed) != -1 ) {
    return [false];
    }
    }

    var noWeekend = $.datepicker.noWeekends(date);
    return !noWeekend[0] ? noWeekend : [true];
    } 
}); 

function date_reveal()
{    
    var all_exist_date_needed      = $("#all_exist_date").val();
    var split_element_needed       = all_exist_date_needed.split(","); 
    var disabledSpecificDays_needed = [split_element_needed[0],split_element_needed[1],split_element_needed[2],split_element_needed[3],split_element_needed[4],split_element_needed[5],split_element_needed[6],split_element_needed[7],split_element_needed[8],split_element_needed[8],split_element_needed[9],split_element_needed[10],split_element_needed[11],split_element_needed[12],split_element_needed[13],split_element_needed[14],split_element_needed[15],split_element_needed[16],split_element_needed[17],split_element_needed[18],split_element_needed[19]];

    function disableSpecificDaysAndWeekends(date) {
    var m = date.getMonth();
    var d = date.getDate();
    var y = date.getFullYear();

    for (var i = 0; i < disabledSpecificDays_needed.length; i++) {
    if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays_needed) != -1 ) {
    return [false];
    }
    }

    var noWeekend = $.datepicker.noWeekends(date);
    return !noWeekend[0] ? noWeekend : [true];
    } 
$("#date_needed").datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends}); 
$("#date_needed").focus();
}


 </script>




 </body>
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
 </html>
