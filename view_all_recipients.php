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
<script src="js/jquery.maskedinput.js" type="text/javascript" ></script>


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
.bar { background-color: #BFC5CD; width:0%; height:20px; border-radius: 3px; }
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
.picker_icon{
    background : #FFFFFF url(images/datepicker-20.png) no-repeat 4px 4px;
    padding: 5px 5px 5px 25px;
    height:18px;
    cursor: pointer;
    }
.shaddows{
        background: white;
        border-radius: 10px;
        -webkit-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
        -moz-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
        box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
        position: relative;
        z-index: 90;
        margin-bottom: 10px;
}

/* Ribbon Style */

#ribbon_final{
  position: absolute !important;
  left: -5px !important; 
  top: -5px !important;
  z-index: 1 !important;
  overflow: hidden !important;
  width: 75px !important;
  height: 75px !important;
  text-align: right !important;  
}

.ribbon {
  position: absolute !important;
  left: -5px !important; 
  top: -5px !important;
  z-index: 1 !important;
  overflow: hidden !important;
  width: 75px !important;
  height: 75px !important;
  text-align: right !important;
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  width: 100px;
  display: block;
  /*background: #79A70A;*/
  background: linear-gradient(#BFC5CD 0%, #83878C 100%);
  background: -moz-linear-gradient(#BFC5CD 0%, #83878C 100%);
  background: -ms-linear-gradient(#BFC5CD 0%, #83878C 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; left: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #83878C;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #83878C;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #83878C;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #83878C;
}

.details_div{
    float: left;
}
#multi_recipients{
      border-top: 2px solid;
    float: left;
    margin-top: 5px;
    width: 100%;
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

#asap_popup{
    display: none;
    font-size: 15px;
    position: fixed;
    top: 150px;
    left: 35%;
    padding: 5px;
    z-index: 10;
    position: absolute;
    z-index: 1000;
    width: 45%;
    background: white;
    border-bottom: 1px solid #aaa;
    border-radius: 4px;
    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(0, 0, 0, 0.1);
    background-clip: padding-box;
}


.asap_orange{
    cursor: pointer;
    display: inline-block;
    background: #BFC5CD;
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
<!--    <div id="loading" class="none"  style="position: fixed;top: 35%;left: 48%;padding: 5px;z-index: 10;">
         <img src="admin/images/login_loader.gif" border="0" />
    </div>-->
    <div id="loading" class="none"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1002;">
         <img src="admin/images/loading_rainbow.gif" border="0" style="width: 200px;height: 200px;" />
    </div> 
    <div id="asap_popup">
        <div style="width: 96%;padding: 2%;float: left;font-size: 14px;line-height: 18px;text-align: justify;">
            All orders placed online are assumed to be for today and available for collection immediately.
        If you wish to place an order for another date and time, or for today but at a later time, 
        please check the box at the left and then enter below a date and time for collection.
        </div>
        <div style="float: right;width: 98%;background-color: #EEE;padding: 1%;">
            <span style="float: right;border: 1px solid #BBB;padding: 3px 10px;border-radius: 3px;cursor: pointer;" onclick="return close_asap();">Close</span>
        </div>
    </div>
 <div id="body_container">
 <div id="body_content" class="body_wrapper">
 <div id="body_content-inner" class="body_wrapper-inner">

<?php include "includes/header_sidebar.php"; ?>
 
 <div id="content_output">

<?php include "includes/top_nav.php"; ?>
 
<?php
$user_session_comp      = $_SESSION['sohorepro_companyid'];
$user_session            = $_SESSION['sohorepro_userid'];
$entered_needed_sets     = NeededSets($user_session_comp, $user_session);
$entered_needed_sets_lfp = NeededSetsLFP($user_session_comp, $user_session);
$entered_needed_sets_fap = NeededSetsFAP($user_session_comp, $user_session);
$total_sets              = SetsOrderedFinalizeCountOfSetsCustomer($user_session_comp, $user_session);
$upload_file_exist       = UploadFileExist($user_session_comp, $user_session);
?>
     <?php //echo $user_session_comp."dsfd".$user_session;//pirnt_r($entered_needed_sets); ?>
<div style="float: left;width: 100%;margin-top: 10px;">
    <?php include "./service_nav.php"; ?>
</div>     
<div style="float:left;width: 100%;">
    <div style="float: left;">
        <h2 class="headline-interior orange" style="text-transform: uppercase;">Job Reference: <?php echo $_SESSION['ref_val']; ?></h2>
    </div>
    <div style="float: right;">
        <input class="addproductActionLink" value="Checkout" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button" onclick="return finalize_recipients();" />    
    </div>
</div>
     
 <div id="content_output-data" style="margin-bottom:20px;">  
<!--- TABLE START -->
<?php // include "./service_nav.php"; ?>
<div id="orderWapper">
  <!-- 
<div class="orderBreadCrumb">
</div>
-->
<?php
 $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
 $number_of_lfp          = EnteredLFPPrimary($user_session_comp, $user_session);
 $number_of_fap          = EnteredPlotttingFineArts($user_session_comp, $user_session);
?>



<?php
if(count($cust_original_order) > "0"){
?>
<div style="float: left;margin-top: 12px;margin-bottom: 20px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span style="background: #79A70A !important;">PAC</span></div>
                        <div style="width: 100%;float: left;margin-top: 25px;margin-bottom: 10px;">
                <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Customer Details: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $cust_add = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add[0]['comp_name'] . '<br>' . $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . ',&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                
                 <!-- Customer User Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">User Details: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $cust_user_add  = UserLoginDtls($user_session);
                    $cust_user_name = $cust_user_add[0]['cus_fname'].'&nbsp;'.$cust_user_add[0]['cus_lname'];
                    $cust_mail_id   = $cust_user_add[0]['cus_email'];
                    $cust_phone_num = $cust_user_add[0]['cus_contact_phone'];
                    echo $cust_user_name . '<br>' . $cust_mail_id . '<br>' . $cust_phone_num. '<br>Date: '. date('m-d-Y h:i A', time());                    
                    ?>                   
                </div>                
                <!-- Customer User Details End --> 
                
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: PLOTTING & ARCHITECTURAL COPIES</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                
                <?php
                            //$enteredPlot = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);
                            $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                            $i = 1;
                            foreach ($enteredPlot as $entered) {
                                $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                $binding = strtoupper($entered['binding']);
                                $folding = strtoupper($entered['folding']);
                                $order_type = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                                $type = ($entered['plot_arch'] == '1') ? '1' : '0';
                                $available_order = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                $needed_sets = ($entered['plot_arch'] == '1') ? PlotSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']) : ArchSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']);
                                $plot_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1');
                                $copy_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                
                                //if (($entered['spl_instruction'] != '') OR  ($entered['size'] == 'Custom') OR ($entered['output'] == 'Both') OR ($entered['drop_off'] != '0') OR ($entered['pick_up_time'] != '0')){
                                ?>
                                
                    <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $entered['options']; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">   
                        <?php
                        if ($entered['size'] == 'CUSTOM') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px; margin-top:5px">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Custom Size Details
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="size_custom_details" id="size_custom_details" value="<?php echo $entered['custome_details']; ?>" />
                                    <?php echo $entered['custome_details']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['output'] == 'BOTH') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px; margin-top:5px">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Color Page Numbers
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="output_page_details" id="output_page_details" value="<?php echo $entered['output_both']; ?>" />
                                    <?php echo $entered['output_both']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['spl_instruction'] != '') {
                            ?> 
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px; margin-top:5px">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['spl_instruction']; ?>" />
                                    <?php echo $entered['spl_instruction']; ?>
                                </div>
                            </div>
                            <?php
                        }//if ($entered['plot_arch'] == '0') {
                            if ($entered['pick_up_time'] != '0') {
                                $pickup_option = ($entered['pick_up'] == "ASAP") ? $entered['pick_up'] : $entered['pick_up'] . ' ' . $entered['pick_up_time'];
                                if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px; margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pickup
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        <?php echo $pickup_option; ?>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px; margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pickup
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>
                            <?php } } ?>
                            <?php if($entered['my_office_alt'] != ''){ 
                                
                                $address_dtls    = SelectLastEnteredAddress($entered['address_book_id']);
                                $address_3       = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'].'<br>' : '';
                                $address_string  = $address_dtls[0]['company_name'].'<br>'.$address_dtls[0]['address_1'].'<br>'.$address_dtls[0]['address_2'].'<br>'.$address_3.$address_dtls[0]['city'].',&nbsp;'.StateName($address_dtls[0]['state']).'&nbsp;'.$address_dtls[0]['zip'];

                                $option_sechdule = ($entered['my_office_alt'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>'.$address_string;
                                if($entered['use_same_alt'] == '1'){
                                ?>   
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px; margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>                                
                            <?php }
                            if($entered['my_office_alt'] == 'my_office'){
                            ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        <?php echo $option_sechdule; ?>
                                    </div>
                                </div>
                            <?php } else{ ?>
                        <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        <?php echo $option_sechdule; ?>
                                    </div>
                                </div>
                            <?php }} ?>
                            <?php if ($entered['drop_off'] != '0') {
                                     if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off']; ?>" />
                                        <?php echo $entered['drop_off']; ?>
                                    </div>
                                </div>
                            <?php }  else {?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-top:5px">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off']; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>
                            <?php }}if ($entered['ftp_link'] != '0') {
                                $link       = ($entered['ftp_link'] != '0') ? $entered['ftp_link'] : '';
                                $user_name  = ($entered['user_name'] != '0') ? $entered['user_name'] : '';
                                $password   = ($entered['password'] != '0') ? $entered['password'] : '';
                                if($entered['use_same_alt'] == '0'){
                            ?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Provide Link to File
                                    </div>
                                    <div style="margin-left: 10px;">
                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        FTP Link : <?php echo $link; ?>
                                    </div>

                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        User Name : <?php echo $user_name; ?>
                                    </div>

                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        Password : <?php echo $password; ?>
                                    </div>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Provide Link to File
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="float: left;width: 65%;margin-top: 5px;">
                                            Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                        </div>
                                    </div>
                                </div>
                        
                            <?php }   }if($entered['upload_file'] != ''){
                                 if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">File Options</div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 7px;text-decoration: underline;">Upload File: </div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 5px;">
                                        <a href="http://cipldev.com/supply-new.sohorepro.com/uploads/<?php echo $entered['upload_file']; ?>" target="_blank"><?php echo $entered['upload_file']; ?></a>
                                    </div>                
                                </div>
                            <?php }else{?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">File Options</div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 7px;">Use same file as Option <?php echo $entered['use_same_alt']; ?></div>                                                    
                                </div>
                           <?php }} ?>
                        </div>
                        <?php
                               // }
                            }
                            ?>
                </div>
                </div>
            </div>
<?php }if(count($number_of_lfp) > "0"){ ?>
<!-- LFP Original Start -->
        
    <div style="float: left;margin-top: 6px;margin-bottom: 20px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span style="background: #4285F4 !important;">LFP</span></div>
                        <div style="width: 100%;float: left;margin-top: 25px;margin-bottom: 10px;">
                <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Customer Details:</div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $cust_add = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add[0]['comp_name'] . '<br>' . $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . ',&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                
                 <!-- Customer User Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">User Details: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $cust_user_add  = UserLoginDtls($user_session);
                    $cust_user_name = $cust_user_add[0]['cus_fname'].'&nbsp;'.$cust_user_add[0]['cus_lname'];
                    $cust_mail_id   = $cust_user_add[0]['cus_email'];
                    $cust_phone_num = $cust_user_add[0]['cus_contact_phone'];
                    echo $cust_user_name . '<br>' . $cust_mail_id . '<br>' . $cust_phone_num. '<br>Date: '. date('m-d-Y h:i A', time());                    
                    ?>                   
                </div>                
                <!-- Customer User Details End --> 
                
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: LARGE FORMAT COLOR & BW</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_lfp as $original){
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                $binding      = $original['binding'];                           
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><span id="available_<?php echo $original['options']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                
                <?php
                            //$enteredPlot = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);
                          //  $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                            $i = 0;
                          //  print_r($number_of_lfp);
                            foreach ($number_of_lfp as $entered) {  $i++;
                                $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                $binding = strtoupper($entered['binding']);
                                $folding = strtoupper($entered['folding']);
                                $order_type = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                                $type = ($entered['plot_arch'] == '1') ? '1' : '0';
                                $available_order = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                $needed_sets = ($entered['plot_arch'] == '1') ? PlotSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']) : ArchSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']);
                                $plot_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1');
                                $copy_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                
                                //if (($entered['spl_instruction'] != '') OR  ($entered['size'] == 'Custom') OR ($entered['output'] == 'Both') OR ($entered['drop_off'] != '0') OR ($entered['pick_up_time'] != '0')){
                                ?>
                                
                    <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $i; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">   
                        <?php
                        if ($entered['size'] == 'CUSTOM') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Custom Size Details
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="size_custom_details" id="size_custom_details" value="<?php echo $entered['custome_details']; ?>" />
                                    <?php echo $entered['size_custom']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['output'] == 'BOTH') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Color Page Numbers
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="output_page_details" id="output_page_details" value="<?php echo $entered['output_both_page']; ?>" />
                                    <?php echo $entered['output_both_page']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['special_inc'] != '') {
                            ?> 
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['special_inc']; ?>" />
                                    <?php echo $entered['special_inc']; ?>
                                </div>
                            </div>
                            <?php
                        }//if ($entered['plot_arch'] == '0') {
                            if ($entered['schedule_pickup'] != '0') {
                                 $pickup_option = ($entered['schedule_pickup'] == "ASAP") ? $entered['schedule_pickup'] : $entered['schedule_pickup'] . ' ' . $entered['pick_up_time'];
                                if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pickup
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        <?php echo $pickup_option; ?>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pickup
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>
                            <?php } } ?>
                            <?php if($entered['my_office_alt'] != ''){ 
                                
                                $address_dtls    = SelectLastEnteredAddress($entered['address_book_id']);
                                $address_3       = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'].'<br>' : '';
                                $address_string  = $address_dtls[0]['company_name'].'<br>'.$address_dtls[0]['address_1'].'<br>'.$address_dtls[0]['address_2'].'<br>'.$address_3.$address_dtls[0]['city'].',&nbsp;'.StateName($address_dtls[0]['state']).'&nbsp;'.$address_dtls[0]['zip'];

                                $option_sechdule = ($entered['my_office_alt'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>'.$address_string;
                                if($entered['use_same_alt'] == '1'){
                                ?>   
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>                                
                            <?php }
                            if($entered['my_office_alt'] == 'my_office'){
                            ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        <?php echo $option_sechdule; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($entered['drop_off_381'] != '0') {
                                     if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off_381']; ?>" />
                                        <?php echo $entered['drop_off_381']; ?>
                                    </div>
                                </div>
                            <?php }  else {?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off_381']; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>
                            <?php }}if ($entered['ftp_link'] != '0') {
                                $link       = ($entered['ftp_link'] != '0') ? $entered['ftp_link'] : '';
                                $user_name  = ($entered['user_name'] != '0') ? $entered['user_name'] : '';
                                $password   = ($entered['password'] != '0') ? $entered['password'] : '';
                                if($entered['use_same_alt'] == '0'){
                            ?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Provide Link to File
                                    </div>
                                    <div style="margin-left: 10px;">
                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        FTP Link : <?php echo $link; ?>
                                    </div>

                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        User Name : <?php echo $user_name; ?>
                                    </div>

                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        Password : <?php echo $password; ?>
                                    </div>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Provide Link to File
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="float: left;width: 65%;margin-top: 5px;">
                                            Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                        </div>
                                    </div>
                                </div>
                        
                            <?php }   }if($entered['upload_file'] != '0'){
                                 if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">File Options</div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 7px;text-decoration: underline;">Upload File: </div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 5px;">
                                        <a href="http://cipldev.com/supply-new.sohorepro.com/uploads/<?php echo $entered['upload_file']; ?>" target="_blank"><?php echo $entered['upload_file']; ?></a>
                                    </div>                
                                </div>
                            <?php }else{?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">File Options</div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 7px;">Use same file as Option <?php echo $entered['use_same_alt']; ?></div>                                                    
                                </div>
                            <?php }  }?>
                        </div> <?php }  ?>
                    
                    <!--------------Mounting--------------------->
                     <?php
              foreach ($original_service_lfp as $original){ if($original['ml_active']==1){ $title_lfp ="1"; }}?>
                    <?php if($title_lfp>0){ ?>
                      <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: MOUNTING & LAMINATING</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                          <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        $i = 1; $j=1;
                    foreach ($original_service_lfp as $original){ if($original['ml_active']==1){
                       if($j==1){ 
                       
                        ?>
                        <tr bgcolor="#BFC5CD">
                          <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
<!--                        <td style="font-weight: bold;">Like Originals</td> -->
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">L</td>
                         <td style="font-weight: bold;">W</td>
                       <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?> <td style="font-weight: bold;">Mounting</td><?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?>  <td style="font-weight: bold;">Lamination</td><?php }?>
                        <td style="font-weight: bold;">Grommets</td>
                        </tr>
                      <?php }
                      
                      
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                
                                $binding      = $original['binding']; 
                                 if($original['ml_type']=="M"){
                            $ml_type="Mounting";
                            
                        }
                        elseif($original['ml_type']=="L"){
                             $ml_type="Lamination";
                        }
                        else{
                            $ml_type="Both";
                        }
                      
                      ?>
                      
                      
                      
                        <tr bgcolor="#F8F8F8">
                           <td><?php echo $original['option_id']; ?></td>
                        <td><?php echo $original['ml_originals']; ?></td>
<!--                        <td><?php // if($original['ml_originals']=="1"){ echo "Yes";} else{"No";} ?></td>-->
                        <td><?php echo $ml_type;?></td>                            
                        <td><?php echo $original['ml_width']; ?></td>
                        <td><?php echo $original['ml_length']; ?></td>
                        <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?>   <td><?php echo $original['ml_mounting']; ?></td> <?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?> <td><?php echo $original['ml_laminating'];?></td> <?php }?>
                        <td><?php  if($original['ml_grommets']=="0") echo "No"; else echo "Yes"; ?></td>
                        </tr>
                       <?php 
                    $i++;
                    $j=2;
                        } }         
                    ?>
                    </table>
                      </div>
              <?php
              //  $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                foreach($original_service_lfp as $entered){
                         if ($entered['mal_splns'] != '') { ?>
                       <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $entered['option_id']; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['mal_splns']; ?>" />
                                    <?php echo $entered['mal_splns']; ?>
                                </div>
                            </div>
                    
                    </div>
                        <?php
                } } ?> 
                       <?php     }
                            ?>
                        </div> 
                </div>
                </div>
           

<!-- LFP Original End -->
<?php }   if(count($number_of_fap) > "0"){ ?>

<!-- FAP Original Start -->
        
    <div style="float: left;margin-top: 6px;margin-bottom: 20px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span style="background: #FBBC05 !important;">FAP</span></div>
                        <div style="width: 100%;float: left;margin-top: 25px;margin-bottom: 10px;">
                <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Customer Details:</div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $cust_add = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add[0]['comp_name'] . '<br>' . $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . ',&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                
                 <!-- Customer User Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">User Details: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $cust_user_add  = UserLoginDtls($user_session);
                    $cust_user_name = $cust_user_add[0]['cus_fname'].'&nbsp;'.$cust_user_add[0]['cus_lname'];
                    $cust_mail_id   = $cust_user_add[0]['cus_email'];
                    $cust_phone_num = $cust_user_add[0]['cus_contact_phone'];
                    echo $cust_user_name . '<br>' . $cust_mail_id . '<br>' . $cust_phone_num. '<br>Date: '. date('m-d-Y h:i A', time());                    
                    ?>                   
                </div>                
                <!-- Customer User Details End --> 
                
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: FINE ART PRINTING</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td>                         
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                        </tr>
                        <?php
//                        echo '<pre>';
                       // print_r($number_of_fap);
//                        echo '</pre>';
                         $i=1;
                        foreach ($number_of_fap as $original){
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['poe'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                $binding      = $original['binding'];                        
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><span id="available_<?php echo $original['options']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                        </tr>
                        <?php
                   $i++;     }
                        ?>
                    </table>
                   
                </div>
                
                
                <?php
                            //$enteredPlot = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);
                           // $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                            $i = 1;
                            foreach ($number_of_fap as $entered) {
                                $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                $binding = strtoupper($entered['binding']);
                                $folding = strtoupper($entered['folding']);
                                $order_type = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                                $type = ($entered['plot_arch'] == '1') ? '1' : '0';
                                $available_order = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                $needed_sets = ($entered['plot_arch'] == '1') ? PlotSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']) : ArchSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']);
                                $plot_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1');
                                $copy_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                
                                //if (($entered['spl_instruction'] != '') OR  ($entered['size'] == 'Custom') OR ($entered['output'] == 'Both') OR ($entered['drop_off'] != '0') OR ($entered['pick_up_time'] != '0')){
                                ?>
                                
                    <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $i; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">   
                        <?php
                        if ($entered['size'] == 'Custom') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Custom Size Details
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="size_custom_details" id="size_custom_details" value="<?php echo $entered['custome_details']; ?>" />
                                    <?php echo $entered['size_custom']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['output'] == 'Both') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Color Page Numbers
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="output_page_details" id="output_page_details" value="<?php echo $entered['output_both']; ?>" />
                                    <?php echo $entered['output_both']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['special_instruction'] != '') {
                            ?> 
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['spl_instruction']; ?>" />
                                    <?php echo $entered['special_instruction']; ?>
                                </div>
                            </div>
                            <?php
                        }//if ($entered['plot_arch'] == '0') {
                            if ($entered['pick_up_time'] != '0') {
                                $pickup_option = ($entered['pick_up'] == "ASAP") ? $entered['pick_up'] : $entered['pick_up'] . ' ' . $entered['pick_up_time'];
                                if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pickup
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        <?php echo $pickup_option; ?>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pickup
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>
                            <?php } } ?>
                            <?php if($entered['my_office_alt'] != ''){ 
                                
                                $address_dtls    = SelectLastEnteredAddress($entered['address_book_id']);
                                $address_3       = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'].'<br>' : '';
                                $address_string  = $address_dtls[0]['company_name'].'<br>'.$address_dtls[0]['address_1'].'<br>'.$address_dtls[0]['address_2'].'<br>'.$address_3.$address_dtls[0]['city'].',&nbsp;'.StateName($address_dtls[0]['state']).'&nbsp;'.$address_dtls[0]['zip'];

                                $option_sechdule = ($entered['my_office_alt'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>'.$address_string;
                                if($entered['use_same_alt'] == '1'){
                                ?>   
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                    </div>
                                </div>                                
                            <?php }
                            if($entered['my_office_alt'] == 'my_office'){
                            ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 5px;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Schedule a Pick-up Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php //echo $option_sechdule; ?>" />
                                        <?php echo $option_sechdule; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($entered['dropoff_val'] != '0') {
                                    
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['dropoff_val']; ?>" />
                                        <?php echo $entered['dropoff_val']; ?>
                                    </div>
                                </div>
                            <?php }  if ($entered['ftp_link_val'] != '0') {
                                $link       = ($entered['ftp_link_val'] != '0') ? $entered['ftp_link_val'] : '';
                                $user_name  = ($entered['user_name_val'] != '0') ? $entered['user_name_val'] : '';
                                $password   = ($entered['pass_word_val'] != '0') ? $entered['pass_word_val'] : '';
                                if($entered['use_same_alt'] == '0'){
                            ?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Provide Link to File
                                    </div>
                                    <div style="margin-left: 10px;">
                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        FTP Link : <?php echo $link; ?>
                                    </div>

                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        User Name : <?php echo $user_name; ?>
                                    </div>

                                    <div style="float: left;width: 65%;margin-top: 5px;">
                                        Password : <?php echo $password; ?>
                                    </div>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Provide Link to File
                                    </div>
                                    <div style="margin-left: 10px;">
                                        <div style="float: left;width: 65%;margin-top: 5px;">
                                            Use same file as Option <?php echo $entered['use_same_alt']; ?>
                                        </div>
                                    </div>
                                </div>
                        
                            <?php }   }if($entered['upload_file'] != ''){
                                 if($entered['use_same_alt'] == '0'){
                                ?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">File Options</div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 7px;text-decoration: underline;">Upload File: </div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 5px;">
                                        <a href="http://cipldev.com/supply-new.sohorepro.com/uploads/<?php echo $entered['upload_file']; ?>" target="_blank"><?php echo $entered['upload_file']; ?></a>
                                    </div>                
                                </div>
                            <?php }else{?>
                                <div style="width: 45%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">File Options</div>  
                                    <div style="float: left;width: 65%;margin-left: 10px;margin-top: 7px;">Use same file as Option <?php echo $entered['use_same_alt']; ?></div>                                                    
                                </div>
                           <?php }} ?>
                        </div>
                        <?php
                               // }
                            }
                            ?>
                </div>
                </div>
            </div>

<!-- FAP Original End -->

<?php } ?>
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
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                        <div style="border-top: 1px solid #FF7E00;"></div>    
                <ul> 
                    
                    
                    <li> 
                    <div id="multi_recipients">
                        <div style="float:left; width:100%;font-size:17px; margin: 10px 15px 13px 0;">
                       <?php  
                       
                       if($entered_needed_sets){
                       if($entered_needed_sets[0]['delivery_type_option'] == '1'){ 
                           echo "RETURN EVERYTHING TO MY OFFICE";
                       }
                       elseif($entered_needed_sets[0]['delivery_type_option'] == '2'){
                           echo " SEND EVERYTHING TO";
                       }
                       elseif($entered_needed_sets[0]['delivery_type_option']== '3'){
                         
                               $cust_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                               echo "WILL PICKUP FROM SOHO REPRO - ". $cust_add[0]['caption'];
                      }
                       
                       }elseif($number_of_lfp){
                           if($number_of_lfp[0]['delivery_type_option'] == '1'){ 
                           echo "RETURN EVERYTHING TO MY OFFICE";
                       }
                       elseif($number_of_lfp[0]['delivery_type_option'] == '2'){
                           echo " SEND EVERYTHING TO";
                       }
                       elseif($number_of_lfp[0]['delivery_type_option']== '3'){
                         
                               $cust_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                               echo "WILL PICKUP FROM SOHO REPRO - ". $cust_add[0]['caption'];
                      }
                       }
                            ?>
                        </div>
                          <?php
                        
                        if($entered_needed_sets[0]['delivery_type_option'] == '1'){
                         ?>
                        <div>
                            <h2 style="color: #79A70A; font-size: 15px;">PLOTTING & ARCHITECTURAL COPIES</h2>
                        </div>
                  
                        <div style="float: left;margin-top: 6px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_1('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                RETURN EVERYTHING TO MY OFFICE
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($entered_needed_sets[0]['shipp_id'] != 'P1') && ($entered_needed_sets[0]['shipp_id'] != "P2")){
                    $cust_add = getCustomeInfo($entered_needed_sets[0]['shipp_id']);
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';
                    $attention_ev   =   ($_SESSION['attention_every'] != '') ? 'Attention:&nbsp;'.$_SESSION['attention_every'].'<br>' : '';
                    $tel_eve       =   ($_SESSION['tel_every'] != '') ? 'Tel:&nbsp;'.$_SESSION['tel_every'].'<br>' : '';
                    echo $cust_add[0]['comp_name'] . '<br>' .$attention_ev.$tel_eve. $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . '&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    }else{
                    $pic_address = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                    echo $pic_address[0]['address'];
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                
                <?php /*
                            //$enteredPlot = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);
                            $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                            $i = 1;
                            foreach ($enteredPlot as $entered) {
                                $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                $binding = strtoupper($entered['binding']);
                                $folding = strtoupper($entered['folding']);
                                $order_type = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                                $type = ($entered['plot_arch'] == '1') ? '1' : '0';
                                $available_order = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                $needed_sets = ($entered['plot_arch'] == '1') ? PlotSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']) : ArchSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']);
                                $plot_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1');
                                $copy_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                
                               // if (($entered['spl_instruction'] != '') OR  ($entered['size'] == 'Custom') OR ($entered['output'] == 'Both') OR ($entered['drop_off'] != '0') OR ($entered['pick_up_time'] != '0')){
                                ?>
                                
                    <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $entered['options']; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">   
                        <?php
                        if ($entered['size'] == 'Custom') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Custom Size Details
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="size_custom_details" id="size_custom_details" value="<?php echo $entered['custome_details']; ?>" />
                                    <?php echo $entered['custome_details']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['output'] == 'Both') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Color Page Numbers
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="output_page_details" id="output_page_details" value="<?php echo $entered['output_both']; ?>" />
                                    <?php echo $entered['output_both']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['spl_instruction'] != '') {
                            ?> 
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['spl_instruction']; ?>" />
                                    <?php echo $entered['spl_instruction']; ?>
                                </div>
                            </div>
                            <?php
                        }//if ($entered['plot_arch'] == '0') {
                            if ($entered['pick_up_time'] != '0') {
                                $pickup_option = ($entered['pick_up'] == "ASAP") ? $entered['pick_up'] : $entered['pick_up'] . ' ' . $entered['pick_up_time'];
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Pickup Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        <?php echo $pickup_option; ?>
                                    </div>
                                </div>
                            <?php }if ($entered['drop_off'] != '0') { ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off']; ?>" />
                                        <?php echo $entered['drop_off']; ?>
                                    </div>
                                </div>
                            <?php
                            }
                        //}
                        ?>
                        </div>
                        <?php
                              //  }
                            }
                            */
                            ?>
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_needed_sets[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_needed_sets[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_needed_sets[0]['shipp_comp_1'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_1'];
                        $ship_type_2 = ($entered_needed_sets[0]['shipp_comp_2'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_2'];
                        $ship_type_3 = ($entered_needed_sets[0]['shipp_comp_3'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_needed_sets[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_needed_sets[0]['spl_inc'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets[0]['spl_inc']; ?>
                    </div>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                    
                </div>
                        </div>
                    </div>
                    <?php  
                        }elseif ($entered_needed_sets[0]['delivery_type_option'] == '2') {
                            if(($entered_needed_sets[0]['shipp_id'] == 'P1') && ($entered_needed_sets[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_needed_sets[0]['shipp_id']);  
                            }
                    ?>   <div>
                            <h2 style="color:#79A70A;; font-size: 15px;">PLOTTING & ARCHITECTURAL COPIES</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_2('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                SEND EVERYTHING TO
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($entered_needed_sets[0]['shipp_id'] != 'P1') && ($entered_needed_sets[0]['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($entered_needed_sets[0]['attention_to'] != "undefined") ? '<br>Attention:  '.$entered_needed_sets[0]['attention_to'] : '';
                    $phone  = ($entered_needed_sets[0]['contact_ph'] != "") ? '<br>'.'Tel:  '.$entered_needed_sets[0]['contact_ph'] : '';
                    //$phone      =   ($phone_pre != '') ? $phone_pre : '';
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3. $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                
                <?php
                            //$enteredPlot = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);
                            $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                            /*
                            $i = 1;
                            foreach ($enteredPlot as $entered) {
                                $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                $binding = strtoupper($entered['binding']);
                                $folding = strtoupper($entered['folding']);
                                $order_type = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                                $type = ($entered['plot_arch'] == '1') ? '1' : '0';
                                $available_order = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                $needed_sets = ($entered['plot_arch'] == '1') ? PlotSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']) : ArchSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']);
                                $plot_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1');
                                $copy_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                
                                if (($entered['spl_instruction'] != '') OR  ($entered['size'] == 'Custom') OR ($entered['output'] == 'Both') OR ($entered['drop_off'] != '0') OR ($entered['pick_up_time'] != '0')){
                                ?>
                                
                    <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $entered['options']; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">   
                        <?php
                        if ($entered['size'] == 'Custom') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Custom Size Details
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="size_custom_details" id="size_custom_details" value="<?php echo $entered['custome_details']; ?>" />
                                    <?php echo $entered['custome_details']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['output'] == 'Both') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Color Page Numbers
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="output_page_details" id="output_page_details" value="<?php echo $entered['output_both']; ?>" />
                                    <?php echo $entered['output_both']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['spl_instruction'] != '') {
                            ?> 
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['spl_instruction']; ?>" />
                                    <?php echo $entered['spl_instruction']; ?>
                                </div>
                            </div>
                            <?php
                        }//if ($entered['plot_arch'] == '0') {
                            if ($entered['pick_up_time'] != '0') {
                                $pickup_option = ($entered['pick_up'] == "ASAP") ? $entered['pick_up'] : $entered['pick_up'] . ' ' . $entered['pick_up_time'];
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Pickup Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        <?php echo $pickup_option; ?>
                                    </div>
                                </div>
                            <?php }if ($entered['drop_off'] != '0') { ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off']; ?>" />
                                        <?php echo $entered['drop_off']; ?>
                                    </div>
                                </div>
                            <?php
                            }
                        //}
                        ?>
                        </div>
                        <?php
                                }
                            }
                            */
                            ?>
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_needed_sets[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_needed_sets[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_needed_sets[0]['shipp_comp_1'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_1'];
                        $ship_type_2 = ($entered_needed_sets[0]['shipp_comp_2'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_2'];
                        $ship_type_3 = ($entered_needed_sets[0]['shipp_comp_3'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_needed_sets[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_needed_sets[0]['spl_inc'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets[0]['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>  
                    <?php
                        }elseif ($entered_needed_sets[0]['delivery_type_option'] == '3') {                       
                         if(($entered_needed_sets[0]['shipp_id'] == 'P1') && ($entered_needed_sets[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_needed_sets[0]['shipp_id']);  
                            }
                            
                            $cust_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                    ?>   <div>
                            <h2 style="color: #79A70A; font-size: 15px;">PLOTTING & ARCHITECTURAL COPIES</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">    
                            
                          
                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_3('<?php echo $entered_needed_sets[0]['shipp_id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                WILL PICKUP FROM SOHO REPRO - <?php echo $cust_add[0]['caption']; ?>
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Pickup By: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php                   
                    //$cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    //echo $cust_add[0]['address'];
                    $cust_add_p = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add_p[0]['comp_business_address2'] != '') ? $cust_add_p[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add_p[0]['comp_name'] . '<br>' . $cust_add_p[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add_p[0]['comp_city'] . ',&nbsp;' . $cust_add_p[0]['comp_state'] . '&nbsp;' . $cust_add_p[0]['comp_zipcode'].'<br>'.$cust_add_p[0]['comp_contact_phone'];
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                
                <?php
                            //$enteredPlot = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);
                            $enteredPlot = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
                            /*
                            $i = 1;
                            foreach ($enteredPlot as $entered) {
                                $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                $binding = strtoupper($entered['binding']);
                                $folding = strtoupper($entered['folding']);
                                $order_type = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                                $type = ($entered['plot_arch'] == '1') ? '1' : '0';
                                $available_order = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                $needed_sets = ($entered['plot_arch'] == '1') ? PlotSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']) : ArchSetsNeededNew($company_id_view_plot, $user_id_add_set, $entered['options']);
                                $plot_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '1');
                                $copy_exist = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set, '0');
                                
                               // if (($entered['spl_instruction'] != '') OR  ($entered['size'] == 'Custom') OR ($entered['output'] == 'Both') OR ($entered['drop_off'] != '0') OR ($entered['pick_up_time'] != '0')){
                                ?>
                                
                    <div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;margin-left: 30px;"> OPTION <?php echo $entered['options']; ?></div>
                    <div style="width: 90%;float: left;border: 1px solid #BFC5CD;padding: 5px;margin-left: 30px;">   
                        <?php
                        if ($entered['size'] == 'Custom') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Custom Size Details
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="size_custom_details" id="size_custom_details" value="<?php echo $entered['custome_details']; ?>" />
                                    <?php echo $entered['custome_details']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['output'] == 'Both') {
                            ?>
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Color Page Numbers
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="output_page_details" id="output_page_details" value="<?php echo $entered['output_both']; ?>" />
                                    <?php echo $entered['output_both']; ?>
                                </div>
                            </div>
                            <?php
                        }
                        if ($entered['spl_instruction'] != '') {
                            ?> 
                            <div style="width: 22%;float: left;border: 1px solid #BFC5CD;margin-right: 10px;">
                                <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                    Special Instructions
                                </div>
                                <div style="padding-top: 3px;width: 100%;float: left;">
                                    <input type="hidden" name="spl_instruction" id="spl_instruction" value="<?php echo $entered['spl_instruction']; ?>" />
                                    <?php echo $entered['spl_instruction']; ?>
                                </div>
                            </div>
                            <?php
                        }if ($entered['plot_arch'] == '0') {
                            if ($entered['pick_up_time'] != '0') {
                                $pickup_option = ($entered['pick_up'] == "ASAP") ? $entered['pick_up'] : $entered['pick_up'] . ' ' . $entered['pick_up_time'];
                                ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Pickup Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="pick_up_time" id="pick_up_time" value="<?php echo $entered['pick_up_time']; ?>" />
                                        <?php echo $pickup_option; ?>
                                    </div>
                                </div>
                            <?php }if ($entered['drop_off'] != '0') { ?>
                                <div style="width: 22%;float: left;border: 1px solid #BFC5CD;">
                                    <div style="padding-top: 3px;font-weight: bold;width: 100%;float: left;background-color: #BFC5CD;color: #5C5C5C;text-align: center;">
                                        Drop-off Option
                                    </div>
                                    <div style="padding-top: 3px;width: 100%;float: left;">
                                        <input type="hidden" name="drop_off" id="drop_off" value="<?php echo $entered['drop_off']; ?>" />
                                        <?php echo $entered['drop_off']; ?>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                        </div>
                        <?php
                                //}
                            }
                            */
                            ?>
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php if($entered_needed_sets[0]['spl_inc'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets[0]['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php
                        }else{    
                            if($entered_needed_sets){
                    ?>
                        <div class="def_class" style=";margin-bottom: 10px;margin-top: 10px;color: #4285F4;font-weight: bold; font-size: 17px;">
                PLOTTING &amp; ARCHITECTURAL COPIES
            </div>
                    <?php                        
                       
                        $r = 1;
                        foreach ($entered_needed_sets as $entered_sets){
                            if(($entered_sets['shipp_id'] == 'P1') && ($entered_sets['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_sets['shipp_id']);  
                            }
                        $needed_options  =   $entered_sets['option_id'];
                        $needed_sets  = ($entered_sets['plot_needed'] != '0') ? $entered_sets['plot_needed'] : $entered_sets['arch_needed'];
                        $order_type   = ($entered_sets['arch_needed'] != '0') ? 'Architectural Copies' : 'Plotting on Bond';
                        $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
                        $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
                        $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
                        $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
                        $size         = ($entered_sets['size'] == 'undefined') ? $entered_sets['arch_size'] : $entered_sets['size'];
                        $output       = ($entered_sets['output'] == 'undefined') ? $entered_sets['arch_output'] : $entered_sets['output'];
                        $media        = ($entered_sets['media'] == 'undefined') ? $entered_sets['arch_media'] : $entered_sets['media'];
                        $binding      = ($entered_sets['binding'] == 'undefined') ? $entered_sets['arch_binding'] : $entered_sets['binding'];
                        $folding      = ($entered_sets['folding'] == 'undefined') ? $entered_sets['arch_folding'] : $entered_sets['folding'];
                    ?> 
                            
                        <div style="float: left;" id="option_4_<?php echo $entered_sets['id']; ?>" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT <?php echo $r; ?></span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_4('<?php echo $entered_sets['id']; ?>', '<?php echo $r; ?>');">Edit</span>                               
                            </div>
                            <div class="details_div">
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to: </div>
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php
                    if(($entered_sets['shipp_id'] != 'P1') && ($entered_sets['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($entered_sets['attention_to'] != "undefined") ? '<br>Attention:  '.$entered_sets['attention_to'] : '';
                    $phone  = ($entered_sets['contact_ph'] != "") ? '<br>'.'Tel:  '.$entered_sets['contact_ph'] : '';
                    //$phone      =   ($phone_pre == "Tel:") ? $phone_pre : "";
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3 . $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>
                <!-- Address Show End -->

                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $needed_options; ?></td>
                            <td><?php echo $needed_sets; ?></td>
                            <td><?php echo $order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucwords(strtolower($binding)); ?></td>
                            <td><?php echo ucwords(strtolower($folding)); ?></td>
                        </tr>
                    </table>
                    
                    <!--   1. <?php // echo $entered_sets['plot_needed'] . '&nbsp;Sets Plotting on Bond,' . $entered_sets['size'] . ',' . $entered_sets['output'] . $plot_binding . $plot_folding; ?></br>-->
                    <!--   2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding;   ?> -->
                </div>
                
                <?php 
                if($entered_sets['size'] == 'Custom'){
                ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    <div style="font-weight: bold;width: 100%;float: left;">
                        Custom Size Details: 
                    </div>
                    <div style="padding-top: 3px;">                    
                        <?php echo $entered_sets['custome_details']; ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php 
                if($entered_sets['output'] == 'Both'){
                ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    <div style="font-weight: bold;width: 100%;float: left;">
                        Color Page Number:
                    </div>
                    <div style="padding-top: 3px;">                    
                        <?php echo $entered_sets['output_page_number']; ?>
                    </div>
                </div>
                <?php } ?>
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_sets['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_sets['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_sets['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_sets['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_sets['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_sets['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_sets['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_sets['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
                        $ship_type_2 = ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
                        $ship_type_3 = ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_sets['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_sets['spl_inc'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_sets['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php 
                    $r++;
                    } 
                        } }
                    ?>
                    


    <!-- LFP Recipients Start -->
        <?php
                    if(count($number_of_lfp) > '0'){
                        
                        if($number_of_lfp[0]['delivery_type_option'] == '1'){
                         ?>
                        <div>
                            <h2 style="color: #4285F4; font-size: 15px;">LARGE FORMAT COLOR & BW</h2>
                        </div>
                        <div style="float: left;margin-top: 6px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_1('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                RETURN EVERYTHING TO MY OFFICE
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($number_of_lfp[0]['shipp_id'] != 'P1') && ($number_of_lfp[0]['shipp_id'] != "P2")){
                   $cust_add = getCustomeInfo($number_of_lfp[0]['shipp_id']);
                  
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';
                    $attention_ev   =   ($_SESSION['attention_every'] != '') ? 'Attention:&nbsp;'.$_SESSION['attention_every'].'<br>' : '';
                    $tel_eve       =   ($_SESSION['tel_every'] != '') ? 'Tel:&nbsp;'.$_SESSION['tel_every'].'<br>' : '';
                    echo $cust_add[0]['comp_name'] . '<br>' .$attention_ev.$tel_eve. $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . '&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    }else{
                    $pic_address = AddressBookPickupSohoCap($number_of_lfp[0]['shipp_id']);
                    echo $pic_address[0]['address'];
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Outputs</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_lfp as $original){
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                $binding      = $original['binding'];                           
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><span id="available_<?php echo $original['option_id']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                  <!--------------Mounting--------------------->
                   <?php
              foreach ($original_service_lfp as $original){ if($original['ml_active']==1){ $title_lfp ="1"; }}?>
                    <?php if($title_lfp>0){ ?>
                      <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: Mounting & Lamination</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                          <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                         $j=1;
                        foreach ($number_of_lfp as $original){ 
                        if($original['ml_active']==1){ $title_lfp ="1"; }}
                     if($title_lfp>0){ 
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                
                                $binding      = $original['binding']; 
                                 if($original['ml_type']=="M"){
                            $ml_type="Mounting";
                            
                        }
                        elseif($original['ml_type']=="L"){
                             $ml_type="Lamination";
                        }
                        else{
                            $ml_type="Both";
                        }
                        ?>
                        <tr bgcolor="#BFC5CD">
                          <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
<!--                        <td style="font-weight: bold;">Like Originals</td> -->
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">L</td>
                         <td style="font-weight: bold;">W</td>
                       <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?> <td style="font-weight: bold;">Mounting</td><?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?>  <td style="font-weight: bold;">Lamination</td><?php }?>
                        <td style="font-weight: bold;">Grommets</td>
                        </tr>
                      
                        <tr bgcolor="#F8F8F8">
                           <td><?php echo $original['option_id']; ?></td>
                        <td><?php echo $original['ml_originals']; ?></td>
<!--                        <td><?php // if($original['ml_originals']=="1"){ echo "Yes";} else{"No";} ?></td>-->
                        <td><?php echo $ml_type;?></td>                            
                        <td><?php echo $original['ml_width']; ?></td>
                        <td><?php echo $original['ml_length']; ?></td>
                        <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?>   <td><?php echo $original['ml_mounting']; ?></td> <?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?> <td><?php echo $original['ml_laminating'];?></td> <?php }?>
                        <td><?php  if($original['ml_grommets']=="0") echo "No"; else echo "Yes"; ?></td>
                        </tr>
                       <?php 
                    $i++;
                    $j=2;
                    }         
                    ?>
                    </table>
                   
                </div>
                 <?php  
                    }
                        ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($number_of_lfp[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $number_of_lfp[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $number_of_lfp[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($number_of_lfp[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($number_of_lfp[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($number_of_lfp[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($number_of_lfp[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($number_of_lfp[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($number_of_lfp[0]['shipp_comp_1'] == '0') ? '' : $number_of_lfp[0]['shipp_comp_1'];
                        $ship_type_2 = ($number_of_lfp[0]['shipp_comp_2'] == '0') ? '' : $number_of_lfp[0]['shipp_comp_2'];
                        $ship_type_3 = ($number_of_lfp[0]['shipp_comp_3'] == '0') ? '' : $number_of_lfp[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_needed_sets[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($number_of_lfp[0]['spl_inc_delivery'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $number_of_lfp[0]['spl_inc_delivery']; ?>
                    </div>
                        <?php } ?>
                        </div>
                       
                   
                   
                </div> </div>
    
    
                    <?php }elseif ($number_of_lfp[0]['delivery_type_option'] == '2') {
                            if(($number_of_lfp[0]['shipp_id'] == 'P1') && ($number_of_lfp[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($number_of_lfp[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($number_of_lfp[0]['shipp_id']);  
                            }
                    ?>   <div>
                            <h2 style="color:#79A70A;; font-size: 15px;">LARGE FORMAT COLOR & BW</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_2('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                SEND EVERYTHING TO
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($number_of_lfp[0]['shipp_id'] != 'P1') && ($number_of_lfp[0]['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($number_of_lfp[0]['attention_to'] != "undefined") ? '<br>Attention:  '.$number_of_lfp[0]['attention_to'] : '';
                    $phone  = ($number_of_lfp[0]['contact_ph'] != "") ? '<br>'.'Tel:  '.$number_of_lfp[0]['contact_ph'] : '';
                    //$phone      =   ($phone_pre != '') ? $phone_pre : '';
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3. $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($number_of_lfp[0]['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
               <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Outputs</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_lfp as $original){
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                $binding      = $original['binding'];                           
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><span id="available_<?php echo $original['option_id']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                  <!--------------Mounting--------------------->
                   <?php
              foreach ($original_service_lfp as $original){ if($original['ml_active']==1){ $title_lfp ="1"; }}?>
                    <?php if($title_lfp>0){ ?>
                      <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: Mounting & Lamination</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                          <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                         $j=1;
                        foreach ($number_of_lfp as $original){ 
                        if($original['ml_active']==1){ $title_lfp ="1"; }}
                     if($title_lfp>0){ 
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                
                                $binding      = $original['binding']; 
                                 if($original['ml_type']=="M"){
                            $ml_type="Mounting";
                            
                        }
                        elseif($original['ml_type']=="L"){
                             $ml_type="Lamination";
                        }
                        else{
                            $ml_type="Both";
                        }
                        ?>
                        <tr bgcolor="#BFC5CD">
                          <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
<!--                        <td style="font-weight: bold;">Like Originals</td> -->
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">L</td>
                         <td style="font-weight: bold;">W</td>
                       <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?> <td style="font-weight: bold;">Mounting</td><?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?>  <td style="font-weight: bold;">Lamination</td><?php }?>
                        <td style="font-weight: bold;">Grommets</td>
                        </tr>
                      
                        <tr bgcolor="#F8F8F8">
                           <td><?php echo $original['option_id']; ?></td>
                        <td><?php echo $original['ml_originals']; ?></td>
<!--                        <td><?php // if($original['ml_originals']=="1"){ echo "Yes";} else{"No";} ?></td>-->
                        <td><?php echo $ml_type;?></td>                            
                        <td><?php echo $original['ml_width']; ?></td>
                        <td><?php echo $original['ml_length']; ?></td>
                        <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?>   <td><?php echo $original['ml_mounting']; ?></td> <?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?> <td><?php echo $original['ml_laminating'];?></td> <?php }?>
                        <td><?php  if($original['ml_grommets']=="0") echo "No"; else echo "Yes"; ?></td>
                        </tr>
                       <?php 
                    $i++;
                    $j=2;
                    }         
                    ?>
                    </table>
                   
                </div>
                 <?php  
                    }
                        ?>
              
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($number_of_lfp[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $number_of_lfp[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $number_of_lfp[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($number_of_lfp[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($number_of_lfp[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($number_of_lfp[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($number_of_lfp[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($number_of_lfp[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($number_of_lfp[0]['shipp_comp_1'] == '0') ? '' : $number_of_lfp[0]['shipp_comp_1'];
                        $ship_type_2 = ($number_of_lfp[0]['shipp_comp_2'] == '0') ? '' : $number_of_lfp[0]['shipp_comp_2'];
                        $ship_type_3 = ($number_of_lfp[0]['shipp_comp_3'] == '0') ? '' : $number_of_lfp[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $number_of_lfp[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($number_of_lfp[0]['spl_inc'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $number_of_lfp[0]['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>  
                    <?php
                        }elseif ($number_of_lfp[0]['delivery_type_option'] == '3') {                       
                         if(($number_of_lfp[0]['shipp_id'] == 'P1') && ($number_of_lfp[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($number_of_lfp[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($number_of_lfp[0]['shipp_id']);  
                            }
                            
                            $cust_add = AddressBookPickupSohoCap($number_of_lfp[0]['shipp_id']);
                    ?>   <div>
                            <h2 style="color: #79A70A; font-size: 15px;">LARGE FORMAT COLOR & BW</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">    
                            
                          
                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_3('<?php echo $entered_needed_sets[0]['shipp_id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                WILL PICKUP FROM SOHO REPRO - <?php echo $cust_add[0]['caption']; ?>
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Pickup By: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php                   
                    //$cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    //echo $cust_add[0]['address'];
                    $cust_add_p = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add_p[0]['comp_business_address2'] != '') ? $cust_add_p[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add_p[0]['comp_name'] . '<br>' . $cust_add_p[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add_p[0]['comp_city'] . ',&nbsp;' . $cust_add_p[0]['comp_state'] . '&nbsp;' . $cust_add_p[0]['comp_zipcode'].'<br>'.$cust_add_p[0]['comp_contact_phone'];
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Outputs</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_lfp as $original){
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                $binding      = $original['binding'];                           
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><span id="available_<?php echo $original['option_id']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
                  <!--------------Mounting--------------------->
                   <?php
              foreach ($original_service_lfp as $original){ if($original['ml_active']==1){ $title_lfp ="1"; }}?>
                    <?php if($title_lfp>0){ ?>
                      <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: Mounting & Lamination</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                          <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                         $j=1;
                        foreach ($number_of_lfp as $original){ 
                        if($original['ml_active']==1){ $title_lfp ="1"; }}
                     if($title_lfp>0){ 
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                
                                $binding      = $original['binding']; 
                                 if($original['ml_type']=="M"){
                            $ml_type="Mounting";
                            
                        }
                        elseif($original['ml_type']=="L"){
                             $ml_type="Lamination";
                        }
                        else{
                            $ml_type="Both";
                        }
                        ?>
                        <tr bgcolor="#BFC5CD">
                          <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
<!--                        <td style="font-weight: bold;">Like Originals</td> -->
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">L</td>
                         <td style="font-weight: bold;">W</td>
                       <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?> <td style="font-weight: bold;">Mounting</td><?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?>  <td style="font-weight: bold;">Lamination</td><?php }?>
                        <td style="font-weight: bold;">Grommets</td>
                        </tr>
                      
                        <tr bgcolor="#F8F8F8">
                           <td><?php echo $original['option_id']; ?></td>
                        <td><?php echo $original['ml_originals']; ?></td>
<!--                        <td><?php // if($original['ml_originals']=="1"){ echo "Yes";} else{"No";} ?></td>-->
                        <td><?php echo $ml_type;?></td>                            
                        <td><?php echo $original['ml_width']; ?></td>
                        <td><?php echo $original['ml_length']; ?></td>
                        <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?>   <td><?php echo $original['ml_mounting']; ?></td> <?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?> <td><?php echo $original['ml_laminating'];?></td> <?php }?>
                        <td><?php  if($original['ml_grommets']=="0") echo "No"; else echo "Yes"; ?></td>
                        </tr>
                       <?php 
                    $i++;
                    $j=2;
                    }         
                    ?>
                    </table>
                   
                </div>
                 <?php  
                    }
                        ?>
              
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($number_of_lfp[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $number_of_lfp[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php if($number_of_lfp[0]['spl_inc'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $number_of_lfp[0]['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php
                        }else{                             
                                         
                       ?>
                           <div class="def_class" style=";margin-bottom: 10px;margin-top: 10px;color: #34A853;font-weight: bold; font-size: 17px;">
                LARGE FORMAT COLOR &amp; BW
            </div>
                           <?php
                        $r = 1;
                        foreach ($entered_needed_sets_lfp as $entered_sets){
                            if(($entered_sets['shipp_id'] == 'P1') && ($entered_sets['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_sets['shipp_id']);  
                            }
                        $needed_options  =   $entered_sets['option_id'];
                        $needed_sets  = ($entered_sets['plot_needed'] != '0') ? $entered_sets['plot_needed'] : $entered_sets['arch_needed'];
                        $order_type   = ($entered_sets['arch_needed'] != '0') ? 'Architectural Copies' : 'Plotting on Bond';
                        $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
                        $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
                        $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
                        $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
                        $size         = ($entered_sets['size'] == 'undefined') ? $entered_sets['arch_size'] : $entered_sets['size'];
                        $output       = ($entered_sets['output'] == 'undefined') ? $entered_sets['arch_output'] : $entered_sets['output'];
                        $media        = ($entered_sets['media'] == 'undefined') ? $entered_sets['arch_media'] : $entered_sets['media'];
                        $binding      = ($entered_sets['binding'] == 'undefined') ? $entered_sets['arch_binding'] : $entered_sets['binding'];
                        $folding      = ($entered_sets['folding'] == 'undefined') ? $entered_sets['arch_folding'] : $entered_sets['folding'];
                    ?> 
                            
                        <div style="float: left;" id="option_4_<?php echo $entered_sets['id']; ?>" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT <?php echo $r; ?></span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_4('<?php echo $entered_sets['id']; ?>', '<?php echo $r; ?>');">Edit</span>                               
                            </div>
                            <div class="details_div">
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to: </div>
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php
                    if(($entered_sets['shipp_id'] != 'P1') && ($entered_sets['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($entered_sets['attention_to'] != "undefined") ? '<br>Attention:  '.$entered_sets['attention_to'] : '';
                    $phone  = ($entered_sets['contact_ph'] != "") ? '<br>'.'Tel:  '.$entered_sets['contact_ph'] : '';
                    //$phone      =   ($phone_pre == "Tel:") ? $phone_pre : "";
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3 . $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>
                <!-- Address Show End -->

              <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Outputs</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        //foreach ($entered_needed_sets_lfp as $original){
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $entered_sets['print_of_need'];
                                $cust_order_type        = "LFP";  
                                $size         = $entered_sets['size'];
                                $output       = $entered_sets['output'];
                                $media        = $entered_sets['media'];
                                $binding      = $entered_sets['binding'];                           
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $entered_sets['option_id']; ?></td>
                            <td><?php echo $entered_sets['original']; ?></td>
                            <td><span id="available_<?php echo $entered_sets['option_id']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                        </tr>
                        <?php
                   //     }
                        ?>
                    </table>
                   
                </div>
                
                  <!--------------Mounting--------------------->
                   <?php
              foreach ($original_service_lfp as $original){ if($original['ml_active']==1){ $title_lfp ="1"; }}?>
                    <?php if($title_lfp>0){ ?>
                      <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: Mounting & Lamination</div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                          <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                         $j=1;
                        foreach ($number_of_lfp as $original){ 
                        if($original['ml_active']==1){ $title_lfp ="1"; }}
                     if($title_lfp>0){ 
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_each'];
                                $cust_order_type        = "LFP";  
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                
                                $binding      = $original['binding']; 
                                 if($original['ml_type']=="M"){
                            $ml_type="Mounting";
                            
                        }
                        elseif($original['ml_type']=="L"){
                             $ml_type="Lamination";
                        }
                        else{
                            $ml_type="Both";
                        }
                        ?>
                        <tr bgcolor="#BFC5CD">
                          <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
<!--                        <td style="font-weight: bold;">Like Originals</td> -->
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">L</td>
                         <td style="font-weight: bold;">W</td>
                       <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?> <td style="font-weight: bold;">Mounting</td><?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?>  <td style="font-weight: bold;">Lamination</td><?php }?>
                        <td style="font-weight: bold;">Grommets</td>
                        </tr>
                      
                        <tr bgcolor="#F8F8F8">
                           <td><?php echo $original['option_id']; ?></td>
                        <td><?php echo $original['ml_originals']; ?></td>
<!--                        <td><?php // if($original['ml_originals']=="1"){ echo "Yes";} else{"No";} ?></td>-->
                        <td><?php echo $ml_type;?></td>                            
                        <td><?php echo $original['ml_width']; ?></td>
                        <td><?php echo $original['ml_length']; ?></td>
                        <?php if($original['ml_type']=="M" OR $original['ml_type']=="Both" ){?>   <td><?php echo $original['ml_mounting']; ?></td> <?php }?>
                        <?php if($original['ml_type']=="L" OR $original['ml_type']=="Both" ){?> <td><?php echo $original['ml_laminating'];?></td> <?php }?>
                        <td><?php  if($original['ml_grommets']=="0") echo "No"; else echo "Yes"; ?></td>
                        </tr>
                       <?php 
                    $i++;
                    $j=2;
                    }         
                    ?>
                    </table>
                   
                </div>
                 <?php  
                    }
                        ?>
                
                <?php 
                if($entered_sets['size'] == 'CUSTOM'){
                ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    <div style="font-weight: bold;width: 100%;float: left;">
                        Custom Size Details: 
                    </div>
                    <div style="padding-top: 3px;">                    
                        <?php echo $entered_sets['size_custom']; ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php 
                if($entered_sets['output'] == 'BOTH'){
                ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    <div style="font-weight: bold;width: 100%;float: left;">
                        Color Page Number:
                    </div>
                    <div style="padding-top: 3px;">                    
                        <?php echo $entered_sets['output_both_page']; ?>
                    </div>
                </div>
                <?php } ?>
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_sets['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_sets['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_sets['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_sets['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_sets['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_sets['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_sets['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_sets['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
                        $ship_type_2 = ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
                        $ship_type_3 = ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_sets['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_sets['spl_inc_delivery'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_sets['spl_inc_delivery']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php 
                    $r++;
                    } 
                        }
                    }
                    
                        
                        ?>
              
 
 
                    
               
    <!--- FAP START --->
       <?php
                    if(count($number_of_fap) > '0'){
                        
      if($number_of_fap[0]['delivery_type_option'] == '1'){
                         ?>
                        <div>
                            <h2 style="color: #79A70A; font-size: 15px;">FINE ART PRINTING</h2>
                        </div>
                  
                        <div style="float: left;margin-top: 6px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_1('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                RETURN EVERYTHING TO MY OFFICE
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($number_of_fap[0]['shipp_id'] != 'P1') && ($number_of_fap[0]['shipp_id'] != "P2")){
                    $cust_add = getCustomeInfo($number_of_fap[0]['shipp_id']);
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';
                    $attention_ev   =   ($_SESSION['attention_every'] != '') ? 'Attention:&nbsp;'.$_SESSION['attention_every'].'<br>' : '';
                    $tel_eve       =   ($_SESSION['tel_every'] != '') ? 'Tel:&nbsp;'.$_SESSION['tel_every'].'<br>' : '';
                    echo $cust_add[0]['comp_name'] . '<br>' .$attention_ev.$tel_eve. $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . '&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    }else{
                    $pic_address = AddressBookPickupSohoCap($number_of_fap[0]['shipp_id']);
                    echo $pic_address[0]['address'];
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                           
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_fap as $original){                            
                                                       
             
                                             
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><?php echo $original['poe'];  ?></td>
                                                    
                            <td><?php echo $original['size']; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $original['output']; ?></td>
                            <td><?php echo $original['media']; ?></td>
                           
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
             
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($number_of_fap[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $number_of_fap[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $number_of_fap[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($number_of_fap[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($number_of_fap[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($number_of_fap[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($number_of_fap[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($number_of_fap[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($number_of_fap[0]['shipp_comp_1'] == '0') ? '' : $number_of_fap[0]['shipp_comp_1'];
                        $ship_type_2 = ($number_of_fap[0]['shipp_comp_2'] == '0') ? '' : $number_of_fap[0]['shipp_comp_2'];
                        $ship_type_3 = ($number_of_fap[0]['shipp_comp_3'] == '0') ? '' : $number_of_fap[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $number_of_fap[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($number_of_fap[0]['spl_inc_delivery'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $number_of_fap[0]['spl_inc_delivery']; ?>
                    </div>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                    
               
                    <?php  
                        }
                        elseif ($number_of_fap[0]['delivery_type_option'] == '2') {
                            if(($number_of_fap[0]['shipp_id'] == 'P1') && ($number_of_fap[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($number_of_fap[0]['shipp_id']);  
                            }
                    ?>   <div>
                            <h2 style="color:#79A70A;; font-size: 15px;">FINE ART PRINTING</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_2('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                SEND EVERYTHING TO
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($number_of_fap[0]['shipp_id'] != 'P1') && ($number_of_fap[0]['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($number_of_fap[0]['attention_to'] != "undefined") ? '<br>Attention:  '.$number_of_fap[0]['attention_to'] : '';
                    $phone  = ($number_of_fap[0]['contact_ph'] != "") ? '<br>'.'Tel:  '.$number_of_fap[0]['contact_ph'] : '';
                    //$phone      =   ($phone_pre != '') ? $phone_pre : '';
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3. $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_fap as $original){                            
                                                   
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><?php echo $original['poe'];  ?></td>
                                                    
                            <td><?php echo $original['size']; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $original['output']; ?></td>
                            <td><?php echo $original['media']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
          
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($number_of_fap[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $number_of_fap[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $number_of_fap[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($number_of_fap[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($number_of_fap[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($number_of_fap[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($number_of_fap[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($number_of_fap[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($number_of_fap[0]['shipp_comp_1'] == '0') ? '' : $number_of_fap[0]['shipp_comp_1'];
                        $ship_type_2 = ($number_of_fap[0]['shipp_comp_2'] == '0') ? '' : $number_of_fap[0]['shipp_comp_2'];
                        $ship_type_3 = ($number_of_fap[0]['shipp_comp_3'] == '0') ? '' : $number_of_fap[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $number_of_fap[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($number_of_fap[0]['spl_inc_delivery'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $number_of_fap[0]['spl_inc_delivery']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>  
                    <?php
                        }elseif ($number_of_fap[0]['delivery_type_option'] == '3') {                       
                         if(($number_of_fap[0]['shipp_id'] == 'P1') && ($number_of_fap[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($number_of_fap[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($number_of_fap[0]['shipp_id']);  
                            }
                            
                            $cust_add = AddressBookPickupSohoCap($number_of_fap[0]['shipp_id']);
                    ?>   <div>
                            <h2 style="color: #79A70A; font-size: 15px;">FINE ART PRINTING</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">    
                            
                          
                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_3('<?php echo $entered_needed_sets[0]['shipp_id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                WILL PICKUP FROM SOHO REPRO - <?php echo $cust_add[0]['caption']; ?>
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Pickup By: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php                   
                    //$cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    //echo $cust_add[0]['address'];
                    $cust_add_p = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add_p[0]['comp_business_address2'] != '') ? $cust_add_p[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add_p[0]['comp_name'] . '<br>' . $cust_add_p[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add_p[0]['comp_city'] . ',&nbsp;' . $cust_add_p[0]['comp_state'] . '&nbsp;' . $cust_add_p[0]['comp_zipcode'].'<br>'.$cust_add_p[0]['comp_contact_phone'];
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($number_of_fap as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                           <td><?php echo $original['option_id']; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><?php echo $original['poe'];  ?></td>
                            <td><?php echo $original['size']; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $original['output']; ?></td>
                            <td><?php echo $original['media']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
          
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($number_of_fap[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $number_of_fap[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $number_of_fap[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php if($number_of_fap[0]['spl_inc_delivery'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $number_of_fap[0]['spl_inc_delivery']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php
                        }
                        else{ ?>
    
                        <div>
                            <h2 style="color: #FBBC05; font-size: 15px;">FINE ART PRINTING</h2>
                        </div>
    
     <?php 
     $f =1;
     foreach ($entered_needed_sets_fap as $original){ 
         
         if(($original['shipp_id'] == 'P1') && ($original['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($original['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($original['shipp_id']);  
                            }
         ?>
                        <div style="float: left;margin-top: 6px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT <?php echo $f; ?></span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_1('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                RETURN EVERYTHING TO MY OFFICE
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                
 if(($original['shipp_id'] != 'P1') && ($original['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($entered_sets['attention_to'] != "undefined") ? '<br>Attention:  '.$original['attention_to'] : '';
                    $phone  = ($entered_sets['contact_ph'] != "") ? '<br>'.'Tel:  '.$original['contact_ph'] : '';
                    //$phone      =   ($phone_pre == "Tel:") ? $phone_pre : "";
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3 . $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td>                         
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($number_of_fap);
//                        echo '</pre>';
                       
                      
                                $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                                $cust_needed_sets       = $original['print_of_need'];
                               
                                $size         = $original['size'];
                                $output       = $original['output'];
                                $media        = $original['media'];
                                $binding      = $original['binding'];                     
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $f; ?></td>
                            <td><?php echo $original['original']; ?></td>
                            <td><span id="fap_available_<?php echo $original['option_id']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                            <td><?php echo ucwords(strtolower($size)); ?></td>
                            <td><?php echo strtoupper($output); ?></td>
                            <td><?php echo ucfirst($media); ?></td>
                        </tr>
                        <?php
                        
                        ?>
                    </table>
                   
                </div>
                
                
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets_fap[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets_fap[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if (($entered_needed_sets_fap[0]['delivery_type'] == '1') OR ($entered_needed_sets_fap[0]['delivery_type'] == '2')) {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_needed_sets_fap[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_needed_sets_fap[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_needed_sets_fap[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_needed_sets_fap[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_needed_sets_fap[0]['shipp_comp_1'] == '0') ? '' : $entered_needed_sets_fap[0]['shipp_comp_1'];
                        $ship_type_2 = ($entered_needed_sets_fap[0]['shipp_comp_2'] == '0') ? '' : $entered_needed_sets_fap[0]['shipp_comp_2'];
                        $ship_type_3 = ($entered_needed_sets_fap[0]['shipp_comp_3'] == '0') ? '' : $entered_needed_sets_fap[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_needed_sets[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_needed_sets_fap[0]['spl_inc'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets_fap[0]['spl_inc']; ?>
                    </div>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php  
                    $f++; } }
                    
                    }
                        ?>
                </div>
                <!--- FAP END --->
 
                    </div>
                   
                    
    
                        <div style="float:left;width:100%;text-align:right;padding-top: 10px;">                   
                           <input class="addproductActionLink" value="Checkout" style="cursor: pointer; float: right; font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button" onclick="return finalize_recipients();" />
                        </div> 
                 </div>
    
                    </div>

                        
                        <div id="jassim_nmj">
                           
                        </div>
                        
                        
                        
                        
                    </li>
                    
<!--              <li class="clear">
                <span>
                  <div style="height:29px;">
                    &nbsp;
                  </div>
                    
                  <div style="clear:both">
                  </div>
                </span>
              </li>-->
              </ul>
                         <div class="footerSRwapper" style="margin:auto;height:61px;">
                             <div id="body_footer-inner" class="body_wrapper-inner" style="margin-top: 15px;">
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
<!-- <ul class="navigation footer">
 <li><a href="#"><span>About SohoRepro</span></a></li>
 <li><a href="#"><span>FAQs</span></a></li>
 <li><a href="#"><span>Privacy Policy</span></a></li>
 <li><a href="#"><span>Security</span></a></li>
 <li><a href="#"><span>Terms of Use</span></a></li>
 <li><a href="#"><span>Contact</span></a></li>
 <div class="clear"></div>
 </ul>-->
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
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
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
            data: "recipients=9&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed),
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
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
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
            data: "recipients=9&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed),
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
                data: "recipients=4&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE+"&inc_avl_rec_id="+REC_ID+"&need_sets_current_1="+need_sets_1+"&need_sets_current_2="+need_sets_2,
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
 
 function cancel_recipient(USR_ID,COMP_ID)
 {
      $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=9_1&user_session_id="+USR_ID+"&comp_session_id="+COMP_ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').html(option);
            }
        });
 }
 
 function edit_recipient(ID)
 {  
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val();  
    $.ajax
    ({
        type: "POST",
        url: "get_recipients.php",                  
        data: "recipients=7_1&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
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
 
 function edit_recipient_option_1(ID)
 {  
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val();  
    $.ajax
    ({
        type: "POST",
        url: "everything_return.php",                  
        data: "everything_return=OPTION_1&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
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
 
 
  function edit_recipient_option_2(ID)
 {  
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val();  
    $.ajax
    ({
        type: "POST",
        url: "everything_return.php",                  
        data: "everything_return=OPTION_2&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
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
 
 function edit_recipient_option_3(ID)
 {  
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val();  
    
    $.ajax
    ({
        type: "POST",
        url: "everything_return.php",                  
        data: "everything_return=OPTION_3&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&shipp_id="+ID,
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
 
 function edit_recipient_option_4(ID, recip_id)
 {
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val();  
    $.ajax
    ({
        type: "POST",
        url: "everything_return.php",                  
        data: "everything_return=OPTION_4&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&option_4_id="+ID+"&recip_id="+recip_id,
        beforeSend: loadStart,
        complete: loadStop,
        success: function(option)
        {  
            $('#option_4_'+ID).slideDown();
            $('#option_4_'+ID).html(option);
            $('#add_recipients').slideDown();
        }
    });
 }
 
 function update_recipient_dynamic_option_1()
 {
        var shipping_id            = $("#address_book_rp").val();
        var arrange_del            = document.getElementById('arrange_del').checked;
        var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
        var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';

        var date_needed            = $("#date_needed").val();
        var time_needed            = $("#time_picker_icon").val();
        var spl_recipient          = $("#spl_recipient").val();
        var attention_to           = $("#shipp_att").val();
        var contact_ph             = $("#contact_ph").val();   
     
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
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
            url: "everything_return.php",                  
            data: "everything_return=OPTION_1_UPDATE&shipping_id_rec="+encodeURIComponent(shipping_id)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1=&time_needed="+encodeURIComponent(time_needed)+"&attention_to="+encodeURIComponent(attention_to)+"&contact_ph="+encodeURIComponent(contact_ph),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                  
                    $('#multi_recipients').slideDown();
                    $('#multi_recipients').html(option);
            }
        });
     
 }
 
 function update_recipient_dynamic_option_2()
 {
    var shipping_id            = $("#address_book_rp").val();
    var arrange_del            = document.getElementById('arrange_del').checked;
    var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
    var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     var attention_to           = $("#shipp_att").val();
     
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
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
            url: "everything_return.php",                  
            data: "everything_return=OPTION_2_UPDATE&shipping_id_rec="+encodeURIComponent(shipping_id)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1=&time_needed="+encodeURIComponent(time_needed)+"&attention_to="+encodeURIComponent(attention_to),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                  
                    $('#multi_recipients').slideDown();
                    $('#multi_recipients').html(option);
            }
        });
     
 }
 
 function update_recipient_dynamic_option_3()
 {
    var pickup_soho_add             = $("#pickup_soho_add").val(); 
    var date_needed                 = $("#date_needed").val();  
    var time_picker_icon            = $("#time_picker_icon").val();  
    var spl_recipient               = $("#spl_recipient").val();  
    
    $.ajax
    ({
        type: "POST",
        url: "everything_return.php",                  
        data: "everything_return=OPTION_3_UPDATE&pickup_soho_add="+encodeURIComponent(pickup_soho_add)+"&date_needed="+encodeURIComponent(date_needed)+"&time_picker_icon="+encodeURIComponent(time_picker_icon)+"&spl_recipient="+encodeURIComponent(spl_recipient),
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
 
 
 function update_recipient_dynamic_option_4(ID)
 {
    var shipping_id            = $("#address_book_rp").val();
    var arrange_del            = document.getElementById('arrange_del').checked;
    var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
    var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     var attention_to           = $("#shipp_att").val();
     var recip_id               = $("#recip_id").val();
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
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
            url: "everything_return.php",                  
            data: "everything_return=OPTION_4_UPDATE&shipping_id_rec="+encodeURIComponent(shipping_id)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1=&time_needed="+encodeURIComponent(time_needed)+"&attention_to="+encodeURIComponent(attention_to)+"&rec_id="+ID+"&recip_id="+recip_id,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                  
                    $('#option_4_'+ID).slideDown();
                    $('#option_4_'+ID).html(option);
            }
        });
     
 }
 
 function update_recipient_final(ID)
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
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
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
            data: "recipients=6_1&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&edit_recipient_id="+ID+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed),
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
     if(arrange_del == false){          
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

function show_address_option_1()
{
    var shipping_id     = $("#address_book_rp").val();
    {
        $.ajax
            ({
                type: "POST",
                url: "shipp_address_option_1.php",
                data: "shipping_id_rp_1=" + shipping_id,
                success: function(option)
                {  
                    var options_divide = option.split('~');
                    $("#show_address").html(options_divide[0]);
                    $("#shipp_att").val(options_divide[1]);
                }
            });
    }
}

function show_address_option_2()
{
    var shipping_id     = $("#address_book_rp").val();
    {
        $.ajax
            ({
                type: "POST",
                url: "shipp_address_option_1.php",
                data: "shipping_id_rp_2=" + shipping_id,
                success: function(option)
                {  
                    var options_divide = option.split('~');
                    $("#show_address").html(options_divide[0]);
                    $("#shipp_att").val(options_divide[1]);
                }
            });
    }
}


 function check_prefer_delivery()
 {
     var preff_del = document.getElementById('preffer_del').checked;     
     if(preff_del == true){          
     $('#preffered_info').slideDown(); 
     $('#delivery_info').slideUp();
     document.getElementById("arrange_del").checked = false;
    }else{
     $('#preffered_info').slideUp();        
     $('#delivery_info').slideDown();
     document.getElementById("arrange_del").checked = true;
    }    
 }
 
 function field_color()
{
    $("#bill_number").css("background-color", "#F3FA2F");
    $("#bill_number").focus();
}

 function uncheck_delivery()
 {
     var arrange_del = document.getElementById('arrange_del').checked;     
     if(arrange_del == false){          
     $('#preffered_info').slideDown();      
     document.getElementById("preffer_del").checked = true;
    }else{
     $('#preffered_info').slideUp();  
     document.getElementById("preffer_del").checked = false;
    }    
 }
 
 function show_time_return()
{
    $('#time_picker_icon').timepicker({
        'minTime': '8:00am',
        'maxTime': '7:00pm',
        'showDuration': true
    });
}

function date_reveal_return()
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
show_time_return();
}


function finalize_recipients()
{
    
    $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=0_0",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                 
               // $("#jassim_nmj").html(option);
              window.location = "finalize_recipients.php";
            }
        });
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

function other_shipp_type()
{
    $("#shipp_comp_3").attr("checked", true);
}

function asap()
{
    var current_status  =   $("#asap_status").attr('class');
    var change_status   =   (current_status == "asap_orange") ? 'asap_green' : 'asap_orange';
    $("#asap_status").removeClass(current_status);
    $("#asap_status").addClass(change_status);
    
    var current_dte_neede    = $("#date_needed").val();
    var current_time_neede   = $("#time_picker_icon").val();
    var change_date          = (current_dte_neede == 'ASAP') ? '' : 'ASAP';
    var change_time          = (current_time_neede == 'ASAP') ? '' : 'ASAP';
    $("#date_needed").val(change_date);
    $("#time_picker_icon").val(change_time);

}

function close_asap()
{
    $(".modal-overlay").fadeOut();
    $("#asap_popup").slideUp("slow"); 
}

function contact_phone()
{
    $("#contact_ph").mask("999-999-9999");
}
 </script>




 </body>
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
 </html>
