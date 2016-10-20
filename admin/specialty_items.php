<?php
include './config.php';
include './auth.php';
$comp_id = $_GET['comp_id'];
$editfav = SpecialtyProducts();

//echo '<pre>';
//print_r($editfav);
//echo '</pre>';


if (isset($_REQUEST['Delete'])) {
    $cnt = array();
    $cnt = count($_POST['delete_val']);
    for ($i = 0; $i < $cnt; $i++) {
        $id = $_POST['delete_val'][$i];
        $query_fav = "DELETE FROM sohorepro_favorites WHERE product_id = '" . $id . "'";
        mysql_query($query_fav);
        $query = "DELETE FROM sohorepro_products WHERE id = '" . $id . "'";
        $result = mysql_query($query);
        if ($result) {
            ?>
            <script> window.top.location = "specialty_items.php";</script>
            <?php
        }
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Specialty Items</title>
        <link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="style/pagination.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
        <script src="../js/jquery.js" type="text/javascript" ></script>
        <!--<script src="js/core.js" type="text/javascript"></script>-->
         <script src="js/jquery.tablednd_0_5.js" type="text/javascript"></script>
        <link rel="stylesheet" href="docsupport/prism.css">
        <link rel="stylesheet" href="docsupport/chosen.css">
         <style>
             .std_spl{
                background-color: #CCC;
                width: 80%;
                border-radius: 5px;
                padding: 3px;
                color: #FFF;
                font-weight: bold;
                cursor: pointer;
             }
             
             .spl_std{
                background-color: #34A853;
                width: 80%;
                border-radius: 5px;
                padding: 3px;
                color: #FFF;
                font-weight: bold;
                cursor: pointer; 
             }
             .assi_cus_container{
                 margin: auto;
                 width: 80%;
                 margin-top: 10px;
                 margin-bottom: 5px;
             }
             .assi_cus_container ul li{
                 margin-bottom: 15px;
             }
             .assi_cus_container ul li label{
                 width: 200px;
                 float: left;
             }
             .assi_cus_container ul li input[type = "text"]{
                background: white;               
                height:23px; 
                width: 320px;
             }   
             .assi_cus_container ul li input[type = "button"]{
                background: #FF7E00;
                color: #FFF;
                padding: 5px 10px;
                border-radius: 6px;
                font-weight: bold;
                cursor: pointer;
                border: 0px;
             }   
             .chosen-container{
                 width: 320px !important;
             }             
             .none{
                 display: none;
             }
             .success_class{
                 float: left;
                 width: 100%;
                 color: #34A853;
                 font-weight: bold;
                 font-size: 18px;
                 text-align: center;
                 margin-bottom: 7px;
                 margin-top: 5px;                 
             }
         </style>
         
         <script>
             
             function edit_inline_temp(ID)
             {
                 $("#fav_list_spn_"+ID).hide(500);
                 $("#fav_disc_spn_"+ID).hide(500);
                 $("#fav_sell_spn_"+ID).hide(500);
                 $("#delete_chk_"+ID).hide(500);
                 $("#fav_list_txt_"+ID).show(500);
                 $("#fav_disc_txt_"+ID).show(500);
                 $("#fav_sell_txt_"+ID).show(500);
                 $("#update_fav_"+ID).show(500);
             }
             
             function update_faverites(ID)
             {
                var list        = document.getElementById('fav_list_txt_'+ID).value;
                var discount    = document.getElementById('fav_disc_txt_'+ID).value;
                var sell        = document.getElementById('fav_sell_txt_'+ID).value;
                
                if(sell != ''){
                $.ajax
                ({
                    type: "POST",
                    url: "inline_edit_favorites.php",
                    data: "inline_edit_fav=1&list_amount="+list+"&discount_amount="+discount+"&sell_amount="+sell+"&product_id="+ID,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {   
                        $("#fav_list_spn_"+ID).html(list);
                        $("#fav_disc_spn_"+ID).html(option);
                        $("#fav_sell_spn_"+ID).html(sell);
                                                
                        $("#fav_list_spn_"+ID).show(500);
                        $("#fav_disc_spn_"+ID).show(500);
                        $("#fav_sell_spn_"+ID).show(500);
                        $("#delete_chk_"+ID).show(500);
                        
                        $("#fav_list_txt_"+ID).hide(500);
                        $("#fav_disc_txt_"+ID).hide(500);
                        $("#fav_sell_txt_"+ID).hide(500);
                        $("#update_fav_"+ID).hide(500);
                    }
                });
                }else{
                    return false;
                }
             }
                          
             function list_change(ID)
             {                
                var list = document.getElementById('fav_list_txt_'+ID).value;
                var discount = document.getElementById('fav_disc_txt_'+ID).value;
                var discount_price = (discount == '') ? '0' : discount;
                var price = (discount * (list / 100));
                var sell_price = (list - price);
                $("#fav_disc_txt_"+ID).val(discount_price);
                $("#fav_sell_txt_"+ID).val(sell_price.toFixed(2));
             }
             
             function disc_change(ID)
             {                
                var list = document.getElementById('fav_list_txt_'+ID).value;
                var discount = document.getElementById('fav_disc_txt_'+ID).value;
                var price = (discount * (list / 100));
                var sell_price = (list - price);
                $("#fav_disc_txt_"+ID).val(discount);
                $("#fav_sell_txt_"+ID).val(sell_price.toFixed(2));
             }
             
             function sell_change(ID)
             {                
                var list = document.getElementById('fav_list_txt_'+ID).value;
                var selling = document.getElementById('fav_sell_txt_'+ID).value;
                var discount = (((list - selling) / list) * 100);
                $("#fav_disc_txt_"+ID).val(discount);
                $("#fav_sell_txt_"+ID).val(selling.toFixed(2));
             }
             
             
            function loadStart() {
            $('#loading').show();
            }

            function loadStop() {
            $('#loading').hide();
            }
            
             $(document).ready(function() {
                
                 $('#list_price').keyup(function(event) {
                    var list = document.getElementById('list_price').value;
                    var discount = document.getElementById('discount').value;
                    var discount_price = (discount == '') ? '0' : discount;
                    var price = (discount * (list / 100));
                    var sell_price = (list - price);
                    $("#discount").val(discount_price);
                    $("#sell_price").val(sell_price.toFixed(2));
                });
                
                $('#discount').keyup(function(event) {
                    var list = document.getElementById('list_price').value;
                    var discount = document.getElementById('discount').value;
                    var price = (discount * (list / 100));
                    var sell_price = (list - price);
                    $("#discount").val(discount);
                    $("#sell_price").val(sell_price.toFixed(2));
                });

                $('#sell_price').keyup(function(event) {
                    var list = document.getElementById('list_price').value;
                    var selling = document.getElementById('sell_price').value;
                    var discount = (((list - selling) / list) * 100);
                    $("#discount").val(discount);
                    $("#sell_price").val(selling.toFixed(2));
                });

                $('#list_price').keydown(function(event) {                  
                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }

                    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

                    } else {
                        event.preventDefault();
                    }

                    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190 && event.keyCode == 110)
                        event.preventDefault();
                });

                $('#discount').keydown(function(event) {

                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }

                    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

                    } else {
                        event.preventDefault();
                    }

                    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190 && event.keyCode == 110)
                        event.preventDefault();
                });

                $('#sell_price').keydown(function(event) {

                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }

                    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

                    } else {
                        event.preventDefault();
                    }

                    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190 && event.keyCode == 110)
                        event.preventDefault();
                });

            });
            
            
             
             $(document).ready(function() {
                
                 $('.list_list').keydown(function(event) {                  
                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }

                    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

                    } else {
                        event.preventDefault();
                    }

                    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190 && event.keyCode == 110)
                        event.preventDefault();
                });

                $('.disc_disc').keydown(function(event) {

                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }

                    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

                    } else {
                        event.preventDefault();
                    }

                    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190 && event.keyCode == 110)
                        event.preventDefault();
                });

                $('.sell_sell').keydown(function(event) {

                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }

                    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

                    } else {
                        event.preventDefault();
                    }

                    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190 && event.keyCode == 110)
                        event.preventDefault();
                });  
                 
              });
              
            
            function change_std_to_spl(ID){ 
                var spl_text    =   $("#spl_text_"+ID).val();
                if(ID){
                     $.ajax
                        ({
                        type: "POST",
                        url: "get_child.php",
                        data: "std_spl=1&fav_product_id="+ID+"&spl_text="+spl_text,
                        beforeSend: loadStart,
                        complete: loadStop,
                        success: function(option)
                        {   
                            var res = option.split("~");
                            if(res[0] == "1"){                                    
                                $("#std_spl_"+ID).html(''); 
                                $("#std_spl_"+ID).html(res[1]);
                                $("#std_spl_"+ID).removeClass('std_spl');
                                $("#std_spl_"+ID).addClass('spl_std');
                            }else if(res[0] == "9"){                               
                                $("#std_spl_"+ID).html('');  
                                $("#std_spl_"+ID).html(res[1]); 
                                 $("#std_spl_"+ID).removeClass('spl_std');
                                $("#std_spl_"+ID).addClass('std_spl');
                            }
                        }
                    });
                }
            }
            
            function show_splty_dtls(ID)
            {
                var acc_hide    =   $("#acc_hide_"+ID).val();                
                if(acc_hide != '1'){ 
                     $.ajax
                        ({
                        type: "POST",
                        url: "get_customer_selected.php",
                        data: "customer_selected=1&customer_id="+ID,
                        beforeSend: loadStart,
                        complete: loadStop,
                        success: function(option)
                        {   
                              
                            $(".splty_dtls_class").slideUp();
                            $("#splty_dtls_"+ID).slideDown();
                            $(".acc_hide_class").val('0');
                            $("#acc_hide_"+ID).val('1');   
                            $("#assigned_customers_"+ID).val(option);                            
                            apply_customer(ID);   
                        }
                    });
                } 
            }
            
            function update_product_to_customer(ID)
            {   
                var product_name             =   $("#product_name_"+ID).val();
                var list_price               =   $("#list_price_"+ID).val(); 
                var discount                 =   $("#discount_"+ID).val(); 
                var sell_price               =   $("#sell_price_"+ID).val(); 
                var customers_value          =   $("#customer_list_"+ID+"_chosen").html();
                $.ajax
                   ({
                   type: "POST",
                   url: "get_customer_selected.php",
                   data: "update_product_customer=1&customers_value="+encodeURIComponent(customers_value)+
                         "&product_name="+encodeURIComponent(product_name)+
                         "&list_price="+encodeURIComponent(list_price)+
                         "&discount="+encodeURIComponent(discount)+
                         "&sell_price="+encodeURIComponent(sell_price)+"&product_id="+ID,
                   beforeSend: loadStart,
                   complete: loadStop,
                   success: function(option)
                   {   
                        if(option == true){
                            
                            var list_price_pre   = parseFloat(list_price).toFixed(2);
                            var discount_pre     = parseFloat(discount).toFixed(2);
                            var sell_price_pre   = parseFloat(sell_price).toFixed(2);
                            
                            
                            $("#list_price_"+ID).val(list_price_pre); 
                            $("#discount_"+ID).val(discount_pre); 
                            $("#sell_price_"+ID).val(sell_price_pre); 
                            
                            $("#fav_prod_spn_"+ID).html(product_name);
                            $("#fav_list_spn_"+ID).html(list_price_pre);
                            $("#fav_disc_spn_"+ID).html(discount_pre+"%");
                            $("#fav_sell_spn_"+ID).html(sell_price_pre);
                            $("#success_msg_"+ID).html("Updated successfully.");
                            $("#success_msg_"+ID).slideDown(1200);
                            $("#success_msg_"+ID).slideUp(1200);
                        }
                   }
               });
            }
         </script>         
    </head>

    <body>
        
        <div id="loading" class="none"  style="position: fixed;top: 35%;left: 48%;padding: 5px;z-index: 10;">
         <img src="images/login_loader.gif" border="0" />
        </div>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" valign="top">
                    <table width="960" border="0" cellspacing="0" cellpadding="0" style="min-width:760px;">
                        <tr>
                            <td width="198" align="left" valign="top" bgcolor="#464646"><table width="198" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="185" align="left" valign="top"><img src="images/logo.jpg" width="198" height="181"  alt=""/></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">

                                            <?php include "sidebar_menu.php"; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="middle" style="height:280px; float:left;"></td>
                                    </tr>
                                </table></td>
                            <td width="3" align="left" valign="top" bgcolor="#FFFFFF"></td>
                            <td width="759" align="left" valign="top" bgcolor="#FFFFFF"><table width="759" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="48" align="center" valign="middle" bgcolor="#5f5f5f" class="heading">
                                            ADMINISTRATOR PAGE
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="38" align="center" valign="middle" bgcolor="#8b8b8b" class="sub_heading">
                                            Specialty Items
                                            <span style="float: right;padding-right: 5px;">Welcome <?php if ($_SESSION['admin_user_type'] == '1') {
                                                echo 'admin';
                                            } if ($_SESSION['admin_user_type'] == '2') {
                                                echo 'Staff User';
                                            } ?> |<a href="logout.php" style="text-decoration:none;color:#fff;">&nbsp;Logout</a></span>
                                        </td>
                                    </tr>

                                    <tr><td></td></tr>
                                    <tr>
                                        <td align="right" valign="top">

                                            <form name="new_email" id="new_email" method="post" action="" onsubmit="return validate()" >
                                                <input type="hidden" name="edi_mail" value="1" />       
                                                <input type="hidden" name="page" id="page" value="<?php echo $_GET['page']; ?>" />
                                                <input type="hidden" name="cus_id" id="cus_id" value="<?php echo $_GET['comp_id']; ?>" />
                                                <input type="hidden" name="comp_id_order" id="comp_id_order" value="<?php echo $comp_id; ?>" />
                                                <input type="hidden" name="comp_name" id="comp_name" value="<?php echo getCompName($comp_id); ?>" />
                                                
                                                <div style="float: left;width: 100%;"> 
                                                    <div style="float: left;width: 19%;text-align: left;padding-bottom: 10px;padding-top: 10px;padding-left: 10px;"><input type="button" onclick="return back_to_customer();" name="Back" value="BACK" style="background: #FF7E00;color: #FFF;padding: 5px 10px;border-radius: 6px;font-weight: bold;cursor: pointer;border: 0px;" /></div>
                                                    <div style="float: left;width: 38%;text-align: center;padding-bottom: 10px;padding-top: 10px;"><h2><?php echo getCompName($comp_id); ?></h2></div>                                                    
                                                    
                                                    <!--<div style="float: left;width: 19%;padding-bottom: 10px;padding-top: 10px;padding-left: 10px;margin-top: 5px;"><a href="print_fav_screen.php?comp_id=<?php echo $comp_id; ?>" target="_blank" style="text-decoration: none;"><span style="background: #FF7E00;color: #FFF;padding: 5px 10px;border-radius: 6px;font-weight: bold;cursor: pointer;border: 0px;">PRINT</span></a></div>-->
                                                    <div style="float: left;width: 38%;text-align: right;padding-bottom: 10px;padding-top: 10px;"><input type="submit" name="Delete" value="REMOVE" style="background: #FF7E00;color: #FFF;padding: 5px 10px;border-radius: 6px;font-weight: bold;cursor: pointer;border: 0px;" /></div>
                                                </div>
                                                <div style="float: left;width: 100%;"><div id="msg" style="color:#007F2A; font-size: 13px;text-align: center;"></div></div>
                                                <table align="left" width="100%">
                                                    <tr bgcolor="#ff7e00">
                                                        <td height="28" width="80" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">S.No</td>
                                                        <td height="28" width="335" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">Product Name</td>
                                                        <td height="28" width="85" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">LIST PRICE</td>
                                                        <td height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">DISCOUNT</td>
                                                        <td height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">SELL PRICE</td>
                                                        <td height="28" width="40" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">&nbsp;</td>
                                                        <td height="28" width="80" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e">STATUS</td>
                                                    </tr>
                                                </table>
                                                <table align="left" width="100%" class="">
                                                    <?php
                                                    $i = 1;
                                                    foreach ($editfav as $fav) {
                                                        $rowColor = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                                                        $id = $fav['id'];
                                                        $product_name       = getProName($fav['id']);
                                                        $list_price         = number_format($fav['list_price'], 2, '.', '');
                                                        $discount_price     = number_format($fav['discount'], 2, '.', '')."%";
                                                        $discount_price_dtl = number_format($fav['discount'], 2, '.', '');
                                                        $sell_price         = number_format($fav['price'], 2, '.', '');
                                                        $super_id           = getsuper($fav['id']);
                                                        $cat_id             = getcat($fav['id']);
                                                        $sub_id             = getsub($fav['id']);
                                                        $super_name         = (getsuperN($super_id) != '') ? getsuperN($super_id) : '';
                                                        $cat_name_pre       = (getcatN($cat_id) != '') ? getcatN($cat_id) : '';
                                                        $cat_name           = ($cat_name_pre != '') ? '>>' . $cat_name_pre : $cat_name_pre;
                                                        $sub_name_pre       = (getsubN($sub_id) != '') ? getsubN($sub_id) : '';
                                                        $sub_name           = ($sub_name_pre != '') ? '>>' . $sub_name_pre : $sub_name_pre;
                                                        $speciality         = ($fav['speciality'] == '1') ? 'SPL' : 'STD';
                                                        $speciality_title   = ($fav['speciality'] == '1') ? 'Specialty Item' : 'Standard Item';
                                                        $special_class      = ($fav['speciality'] == '1') ? 'spl_std'  : 'std_spl';
                                                        ?>
                                                    <tr  bgcolor="<?php echo $rowColor; ?>" id="order_<?php echo $id; ?>" style="cursor: pointer;" onclick="return show_splty_dtls('<?php echo $id; ?>');">
                                                    <input type="hidden" name="spl_text" id="spl_text_<?php echo $id; ?>" value="<?php echo $fav['speciality']; ?>" />
                                                    <input type="hidden" name="acc_hide" class="acc_hide_class" id="acc_hide_<?php echo $id; ?>" value="" />
                                                            <td height="28" width="80" align="center" valign="middle" class="brdr_1" ><?php echo $i; ?></td>
                                                            <td height="28" width="325" valign="middle" class="brdr_1" style="font-size: 15px;padding-left: 10px;">
                                                                <span id="fav_prod_spn_<?php echo $id; ?>"><?php echo $product_name; ?></span>
                                                                <?php echo '<br>'; ?>
                                                                <span class="trail" style="font-size: 11px;color: #2a9be3;"><?php echo $super_name . $cat_name . $sub_name; ?></span>  
                                                            </td>
                                                            <td height="28" valign="middle" width="85" class="brdr_1" align="center" onclick="return edit_inline(<?php echo $id; ?>);">
                                                                <span id="fav_list_spn_<?php echo $id; ?>"><?php echo $list_price; ?></span>
                                                                <input class="none list_list" type="text" id="fav_list_txt_<?php echo $id; ?>" style="width: 40px;" value="<?php echo $list_price; ?>" onkeyup="return list_change('<?php echo $id; ?>');" />
                                                            </td>
                                                            <td height="28" valign="middle" width="73" class="brdr_1" align="center" onclick="return edit_inline(<?php echo $id; ?>);">
                                                                <span id="fav_disc_spn_<?php echo $id; ?>"><?php echo $discount_price; ?></span>
                                                                <input class="none disc_disc" type="text" id="fav_disc_txt_<?php echo $id; ?>" style="width: 40px;" value="<?php echo $discount_price; ?>" onkeyup="return disc_change('<?php echo $id; ?>');" />
                                                            </td>
                                                            <td height="28"  valign="middle" class="brdr_1" align="center" onclick="return edit_inline(<?php echo $id; ?>);">
                                                                <span id="fav_sell_spn_<?php echo $id; ?>"><?php echo $sell_price; ?></span>
                                                                <input class="none sell_sell" type="text" id="fav_sell_txt_<?php echo $id; ?>" style="width: 40px;" value="<?php echo $sell_price; ?>" onkeyup="return sell_change('<?php echo $id; ?>');" />
                                                            </td>
                                                            <td height="28" width="40" align="center" valign="middle" >
                                                                <input class="check_val" id="delete_chk_<?php echo $id; ?>" type="checkbox" name="delete_val[]" value="<?php echo $id; ?>" />
                                                                <img class="none" style="cursor:pointer;" src="images/like_icon.png" id="update_fav_<?php echo $id; ?>" onclick="update_faverites(<?php echo $id; ?>);"  alt="Delete Faverites" title="Delete Faverites" width="22" height="22" class="mar_lft"/>
                                                            </td>
                                                            <td height="28" width="50" style="width: 80px;" align="center" valign="middle" >
                                                                <div title="<?php echo $speciality_title; ?>" alt="<?php echo $speciality_title; ?>" id="std_spl_<?php echo $id; ?>" class="<?php echo $special_class; ?>" onclick="return change_std_to_spl('<?php echo $id; ?>');"><?php echo $speciality; ?></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7"> 
                                                                <div class="none splty_dtls_class" id="splty_dtls_<?php echo $id; ?>" style="width: 95%;margin: auto;border: 2px solid #F99B3E;margin-top: 3px;margin-bottom: 3px;">
                                                                    <div id="success_msg_<?php echo $id; ?>" class="success_class none"></div>
                                                                    <div class="assi_cus_container">
                                                                        <ul>
                                                                            <li>
                                                                                <label>Product Name:</label>
                                                                                <input type="text" autocomplete="off" name="product_name" class="" id="product_name_<?php echo $fav['id']; ?>" value="<?php echo $product_name; ?>" />
                                                                            </li>
                                                                            <li>
                                                                                <label>List Price:</label>
                                                                                <input type="text" autocomplete="off" name="product_name" class="list_list" onkeyup="return list_price('<?php echo $fav['id']; ?>');" id="list_price_<?php echo $fav['id']; ?>" value="<?php echo $list_price; ?>" />
                                                                            </li>
                                                                            <li>
                                                                                <label>Discount:</label>
                                                                                <input type="text" autocomplete="off" name="product_name" class="disc_disc" onkeyup="return discount_price('<?php echo $fav['id']; ?>');" id="discount_<?php echo $fav['id']; ?>" value="<?php echo $discount_price_dtl; ?>" />
                                                                            </li>
                                                                            <li>
                                                                                <label>Sell Price:</label>
                                                                                <input type="text" autocomplete="off" name="product_name" class="sell_sell" onkeyup="return sell_price('<?php echo $fav['id']; ?>');" id="sell_price_<?php echo $fav['id']; ?>" value="<?php echo $sell_price; ?>" />
                                                                            </li>
                                                                            <li>
                                                                                <label>Assigned Customers:</label>                                                                               
                                                                                <input type="hidden" id="assigned_customers_<?php echo $fav['id']; ?>" value=""/>
                                                                                <select data-placeholder="Choose a Customer..." id="customer_list_<?php echo $fav['id']; ?>" multiple >
                                                                                    <?php
                                                                                    $all_customer = CustomersCount();
                                                                                    foreach ($all_customer as $customers){
                                                                                    ?>
                                                                                    <option value="<?php echo $customers['comp_name']; ?>"><?php echo $customers['comp_name']; ?></option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>   
                                                                                </select>
                                                                            </li>
                                                                            <li>
                                                                                <label>&nbsp;</label>
                                                                                <input type="button" name="update_fav_dtls" id="update_fav_dtls" value="UPDATE" onclick="return update_product_to_customer('<?php echo $fav['id']; ?>');" />
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td> 
                                                        </tr>
                                                        <?php 
                                                        $i++;
                                                        } 
                                                        ?>
                                                </table>
                                            </form>



                                        </td>
                                    </tr>

                                </table></td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td style="background:#464646; text-align:center; color:#fff; line-height:30px;" height="30p">© <?php echo date('Y'); ?> sohorepro.com</td>
            </tr>
        </table>
    </body>
</html>

<script type="text/javascript">
    function autosubmit()
    {
        var page = document.getElementById("sortOrder").value;
        if (page != 0)
        {
            window.location = "reports.php?limite=" + document.getElementById("sortOrder").value;
        }
    }
</script>                


<script type="text/javascript">
    $(document).ready(function()
    {
        $("#category_name").change(function()
        {
            var pc_id = $(this).val();
            if (pc_id != '0')
            {
                $.ajax
                        ({
                            type: "POST",
                            url: "get_child.php",
                            data: "pc_id=" + pc_id,
                            success: function(option)
                            {
                                $("#subcategory_name").html(option);
                            }
                        });
            }
            else
            {
                $("#subcategory_name").html("<option value=''>-- No subcategory selected --</option>");
            }
            return false;
        });
    });
</script>

<script language="javascript">
    function validate()
    {

        if (document.filter.category_name.value == '0')
        {
            document.getElementById("msg1").innerHTML = "Select category name";
            return false;
        }
        else
        {
            document.getElementById("msg1").innerHTML = "";
        }

        return true;

    }



    $(function() {
        $(".tbl_repeatpro tbody").tableDnD({            
            onDrop: function(table, row) {
                var orders = $.tableDnD.serialize();
                var comp_id = $("#comp_id_order").val();
                $.post('orderfavpro.php', {orders: orders,comp_id: comp_id});
                if (comp_id != '') {
                    //alert('Products order sorting');
                    $("#msg").html('Favorites products order sorted successfully');
                    window.location = "edit_fav.php?comp_id=<?php echo $comp_id; ?>";
                }
            }
        });

    });

function back_to_customer()
{
   var page         = document.getElementById("page").value;
   var cus_id       = document.getElementById("cus_id").value; 
   //var comp_name    = document.getElementById("comp_name").value; 
   window.location = "products.php"; 
}
</script>

<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="js/jquery.autocomplete.css" type="text/css" />

<script type="text/javascript">


                        function load_userinfo()
                        {
                            var cname = $("#search_val").val();

                            //alert(cname);
                            var request = $.ajax({
                                url: "load_user.php",
                                type: "POST",
                                data: {cid: cname},
                                dataType: "html"
                            });

                            request.done(function(msg) {
                                //alert( msg );
                                if (msg != '')
                                {
                                    $('#load_userdata').html(msg);
                                }
                                else
                                {
                                    $('#load_userdata').html(msg);
                                }
                            });

                            request.fail(function(jqXHR, textStatus) {

                            });

                        }


                        function findValue(li) {
                            if (li == null)
                                return alert("No match!");

                            // if coming from an AJAX call, let's use the CityId as the value
                            if (!!li.extra)
                                var sValue = li.extra[0];

                            // otherwise, let's just display the value in the text box
                            else
                                var sValue = li.selectValue;

                            //alert("The value you selected was: " + sValue);
                        }

                        function selectItem(li) {
                            findValue(li);
                        }

                        function formatItem(row) {
                            return row[0];
                        }

                        function lookupAjax() {
                            var oSuggest = $("#search_val")[0].autocompleter;
                            oSuggest.findValue();
                            return false;
                        }


                        $("#search_val").keypress(function() {

                            var phoneval = $("#search_val").val();
                            //var test=phoneval.indexOf('_');
                            //console.log( test );

//alert(phoneval.length);    
//console.log( phoneval.length );
                            $("#search_val").autocomplete(
                                    "load_user.php",
                                    {
                                        delay: 5,
                                        minChars: 1,
                                        matchSubset: 1,
                                        matchContains: 1,
                                        cacheLength: 10,
                                        onItemSelect: selectItem,
                                        onFindValue: findValue,
                                        formatItem: formatItem,
                                        autoFill: true
                                    }
                            );


                        });


                function list_price(ID){
                    var list = document.getElementById('list_price_'+ID).value;
                    var discount = document.getElementById('discount_'+ID).value;
                    var discount_price = (discount == '') ? '0' : discount;
                    var price = (discount * (list / 100));
                    var sell_price = (list - price);
                    $("#discount_"+ID).val(discount_price);
                    $("#sell_price_"+ID).val(sell_price.toFixed(2));
                }
                
                function discount_price(ID){
                    var list = document.getElementById('list_price_'+ID).value;
                    var discount = document.getElementById('discount_'+ID).value;
                    var price = (discount * (list / 100));
                    var sell_price = (list - price);
                    $("#discount_"+ID).val(discount);
                    $("#sell_price_"+ID).val(sell_price.toFixed(2));
                }

                function sell_price(ID){
                    var list = document.getElementById('list_price_'+ID).value;
                    var selling = document.getElementById('sell_price_'+ID).value;
                    var discount = (((list - selling) / list) * 100);
                    $("#discount_"+ID).val(discount);
                    $("#sell_price_"+ID).val(selling.toFixed(2));
                }

  
function apply_customer(ID)
{
    var assigned_customers = document.getElementById("assigned_customers_"+ID).value;

    var str_array = assigned_customers.split(",");

    for (var i = 0; i < str_array.length; i++) {
        str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
    }
    $("#customer_list_"+ID).chosen();
    $("#customer_list_"+ID).val(str_array).trigger("chosen:updated");
}
</script>    
<script src="docsupport/chosen.jquery.js" type="text/javascript"></script>
<script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>