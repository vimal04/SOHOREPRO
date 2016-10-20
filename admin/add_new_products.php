<?php
include './config.php';
include './auth.php';
$active_category = getSuperCategoryActive();
$active_sub_category = getSubCategoryActive();
$super_category = getSuperCat();

if ($_REQUEST['new_prod'] == '1') {
    extract($_POST);
    $sql_sk = mysql_query("SELECT sku_id FROM sohorepro_products ORDER BY id DESC LIMIT 1");
    $object = mysql_fetch_assoc($sql_sk);

    if (count($object['sku_id']) > 0) {
        $sku = ($object['sku_id'] + 1);
    } else {
        $sku = "10001";
    }

    $sql_order_id = mysql_query("SELECT id FROM sohorepro_products ORDER BY id DESC LIMIT 1");
    $object = mysql_fetch_assoc($sql_order_id);
    if (count($object['id']) > 0) {
        $sort_id = ($object['id'] + 1);
    } else {
        $sort_id = '1';
    }
    $sql = "INSERT INTO sohorepro_products
			SET     supercategory_id = '" . $supercategory_name . "',                        
                                category_id     = '" . $category_name . "',
                                subcategory_id  = '" . $subcategory_name . "',
                                sku_id          = '" . $sku . "',
                                product_name    = '" . mysql_real_escape_string($product_name) . "',
                                list_price      = '" . $list_price . "',   
                                discount        = '" . $discount . "',  
                                price           = '" . $sell_price . "',   
				status          = '" . $status . "',
                                sort            = '" . $sort_id . "'  ";
    $sql_result = mysql_query($sql);
    if ($sql_result) {
        $result = "success";
    } else {
        $result = "failure";
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Soho-repro</title>
        <link href="style/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="style/switch.css" rel="stylesheet" type="text/css" media="all" />
        
<!--        <link rel="stylesheet" href="docsupport/style.css">-->
        <link rel="stylesheet" href="docsupport/prism.css">
        <link rel="stylesheet" href="docsupport/chosen.css">
        <style type="text/css" media="all">
          .chosen-rtl .chosen-drop { left: -9000px; }
        </style>
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script>
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
            
            
            function speciality_on_off_jassim()
                {
                    var speciality_on_off = document.getElementById("speciality_on_off").checked;
                    if(speciality_on_off == true){
                        $("#top_mask").slideUp();
                    }else{
                        $("#top_mask").slideDown();
                    }

                }
                
                
    function  save_customer_dtls()
    {
        //alert('Jassim');
        var supercategory_name      =   $("#supercategory_name").val();
        var category_name           =   $("#category_name").val();
        var subcategory_name        =   $("#subcategory_name").val();
        var product_name            =   $("#product_name").val();
        var list_price              =   $("#list_price").val();
        var discount                =   $("#discount").val();
        var sell_price              =   $("#sell_price").val();
        var speciality_on_off       =   document.getElementById("speciality_on_off").checked;
        var speciality_on_off_val   =   (speciality_on_off == true) ? "1" : "0";
        var customers_value         =   $(".chosen-choices").html();
        var all_customer            =   (speciality_on_off == true) ? customers_value : "0";
        
        if(supercategory_name == '0'){
            $("#msg6").html("Please select the Super category.");
            return false;
        }else{
            $("#msg6").html("");
        }
        
//        if(category_name == '0'){
//            $("#msg1").html("Please select the category.");
//            return false;
//        }else{
//            $("#msg1").html("");
//        }
                
        if(product_name == ''){
            $("#msg3").html("Please enter the product name.");
            $("#product_name").focus();
            return false;
        }else{
            $("#msg3").html("");
        }
        
        if(list_price == ''){
            $("#msg4").html("Please enter the list price.");
            $("#list_price").focus();
            return false;
        }else{
            $("#msg4").html("");
        }
        
        if(discount == ''){
            $("#msg8").html("Please enter the discount price.");
            $("#discount").focus();
            return false;
        }else{
            $("#msg8").html("");
        }
               
        
        if (supercategory_name != '0')
        {
                $.ajax
                        ({
                            type: "POST",
                            url: "get_child.php",
                            data: "get_all_customers=1&supercategory_name_spl="+supercategory_name+
                                  "&category_name_spl="+category_name+
                                  "&subcategory_name_spl="+subcategory_name+
                                  "&product_name_spl="+encodeURIComponent(product_name)+
                                  "&list_price_spl="+encodeURIComponent(list_price)+
                                  "&discount_spl="+encodeURIComponent(discount)+
                                  "&sell_price_spl="+encodeURIComponent(sell_price)+
                                  "&all_customer_spl="+encodeURIComponent(all_customer)+
                                  "&speciality_on_off_val_spl="+encodeURIComponent(speciality_on_off_val),
                            beforeSend: loadStart,
                            complete: loadStop,
                            success: function(option)
                            {
                                if(option == true){
                                $("#inserted_success").html('Speciality Product Inserted Successfully');
                                setTimeout("location.href=\'products.php\'", 1000);
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
    </head>

    <body>
        <div id="loading" style="display:none;position: fixed;top: 35%;left: 48%;padding: 5px;z-index: 10;">
            <img src="images/login_loader.gif" border="0" style="width: 120px;height: 120px;" />
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" valign="top">
                    <table width="960" border="0" cellspacing="0" cellpadding="0" style="min-width:760px;">
                        <tr>
                            <td width="198" align="left" valign="top" bgcolor="#464646"><table width="198" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="181" align="left" valign="top"><img src="images/logo.jpg" width="198" height="181"  alt=""/></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <?php include "sidebar_menu.php"; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="middle" style="min-height:280px; float:left;"></td>
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
                                            ADD PRODUCTS
                                            <span style="float: right;padding-right: 5px;">Welcome <?php
                                                if ($_SESSION['admin_user_type'] == '1') {
                                                    echo 'admin';
                                                } if ($_SESSION['admin_user_type'] == '2') {
                                                    echo 'Staff User';
                                                }
                                                ?> |<a href="logout.php" style="text-decoration:none;color:#fff;">&nbsp;Logout</a></span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td height="30" align="center" valign="top">
                                            <?php
                                            if ($result == "success") {
                                                ?>
                                                <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Inserted Successfully</div>
                                                <script>setTimeout("location.href=\'products.php\'", 1000);</script>
                                                <?php
                                            } elseif ($result == "failure") {
                                                ?>
                                                <div style="color:#F00; text-align:center; padding-bottom:10px;">Not Successfully</div>
                                                <script>setTimeout("location.href=\'products.php\'", 1000);</script>       
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30" align="center" valign="top">                                            
                                            <div id="inserted_success" style="color:#007F2A; text-align:center; padding-bottom:10px;"></div>
<!--                                                <script>setTimeout("location.href=\'products.php\'", 1000);</script>                                               -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <form name="new_products" id="new_products" method="post" action=""  onsubmit="return validate()" >
                                                <input type="hidden" name="new_prod" value="1" />        
                                                <table width="759" border="0" cellspacing="0" cellpadding="0" class="add_product">
                                                    <tr>
                                                        <td width="180" height="48" align="left" valign="middle" class="add_prod_label">Super Category Name</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                            <select name="supercategory_name" id="supercategory_name" class="select_text" >
                                                                <option value="0">Select Super Category</option>
                                                                <?php foreach ($super_category as $categ) { ?>
                                                                    <option value="<?php echo $categ['id'] ?>"><?php echo $categ['category_name']; ?></option>
<?php } ?>
                                                            </select><div id="msg6" style="color:#FF0000"></div> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" align="left" valign="middle"></td>
                                                        <td height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Category Name</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                            <select name="category_name" id="category_name" class="select_text" /> 
                                                    <option value="0">Select Category</option>
                                                    </select><div id="msg1" style="color:#FF0000"></div> 
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Sub Category Name</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                    <select name="subcategory_name" id="subcategory_name" class="select_text" /> 
                                                    <option value="0">Select Sub Category</option>
                                                    </select><div id="msg2" style="color:#FF0000"></div> 
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" align="left" valign="middle"></td>
                                                        <td height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Product Name</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont"><input type="text" autocomplete="off" name="product_name" id="product_name" value="" ><div id="msg3" style="color:#FF0000"></div> </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" align="left" valign="middle"></td>
                                                        <td height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">List Price</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont"><input type="text" autocomplete="off" name="list_price" id="list_price" value="" ><div id="msg4" style="color:#FF0000"></div> </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Discount</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont"><input type="text" autocomplete="off" name="discount" id="discount" value="" ><div id="msg8" style="color:#FF0000"></div> </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Sell Price</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont"><input type="text" autocomplete="off" name="sell_price" id="sell_price" value="" ><div id="msg9" style="color:#FF0000"></div> </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" align="left" valign="middle"></td>
                                                        <td height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Status</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                            <div style="float:left; margin-top:5px;"><input type="radio" name="status" value="1" checked="checked" ><p>Active</p><input type="radio" name="status" value="0" ><p>Inactive</p>			
                                                            </div><div id="msg5" style="color:#FF0000"></div> 
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_prod_label">Specialty</td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                            <label class="switch">
                                                                <input type="checkbox" id="speciality_on_off" onclick="return speciality_on_off_jassim();">
                                                                <div class="slider round"></div>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    
                                                    
                                                        <tr id="customer_select">
                                                        
                                                            <td height="48" align="left" valign="middle" class="add_prod_label">Customers</td>
                                                            <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                                <div id="top_mask" style="float: left;background-color: #F9F9F9;width: 30%;position: absolute;z-index: 1;height: 30px;">
                                                                    &nbsp;
                                                                </div>
                                                                <div class="side-by-side clearfix" >
                                                            <div>
                                                                <select data-placeholder="Choose a Customer..." class="chosen-select" multiple style="width:350px;" tabindex="4">
                                                                <option value=""></option>
                                                                <?php
                                                                $all_customer = CustomersCount();
                                                                foreach ($all_customer as $customers){
                                                                ?>
                                                                <option value="<?php echo $customers['comp_name']; ?>"><?php echo $customers['comp_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>                                                            
                                                              </select>
                                                            </div>
                                                            </div> 
                                                            </td>
                                                          
                                                        </tr>
                                                   
                                                    <tr>
                                                        <td height="1" align="left" valign="middle"></td>
                                                        <td height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="48" align="left" valign="middle" class="add_produ_btn"></td>
                                                        <td height="48" align="left" valign="middle" class="add_prod_cont">
                                                            <input type="button" name="submit" id="submit" value="Save" onclick="return save_customer_dtls();" /> 
                                                            <input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:window.location = '<?php echo 'products.php'; ?>'" style="margin-left:15px;" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" align="left" valign="middle"></td>
                                                        <td height="1"></td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table></td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td style="background:#464646; text-align:center; color:#fff; line-height:30px;" height="30p">© 2013 sohorepro.com</td>
            </tr>
        </table>
    </body>
</html>

<script language="javascript">
                                                    function validate()
                                                    {
                                                        var str = true;
                                                        document.getElementById("msg1").innerHTML = "";
                                                        document.getElementById("msg2").innerHTML = "";
                                                        document.getElementById("msg3").innerHTML = "";
                                                        document.getElementById("msg4").innerHTML = "";
                                                        document.getElementById("msg5").innerHTML = "";
                                                        document.getElementById("msg6").innerHTML = "";
                                                        document.getElementById("msg8").innerHTML = "";
                                                        document.getElementById("msg9").innerHTML = "";

                                                        if (document.new_products.supercategory_name.value == '0')
                                                        {
                                                            document.getElementById("msg6").innerHTML = "Select the Super Category Name";
                                                            str = false;
                                                        }
//                                                        if (document.new_products.category_name.value == '0')
//                                                        {
//                                                            document.getElementById("msg1").innerHTML = "Select the Category Name";
//                                                            str = false;
//                                                        }
//                                                        if (document.new_products.subcategory_name.value == '0')
//                                                        {
//                                                            document.getElementById("msg2").innerHTML = "Select the Sub-Category Name";
//                                                            str = false;
//                                                        }
                                                        if (document.new_products.product_name.value == '')
                                                        {
                                                            document.getElementById("msg3").innerHTML = "Enter the Product Name";
                                                            str = false;
                                                        }
                                                        if (document.new_products.list_price.value == '')
                                                        {
                                                            document.getElementById("msg4").innerHTML = "Enter the Price";
                                                            str = false;
                                                        }
                                                        if (document.new_products.discount.value == '')
                                                        {
                                                            document.getElementById("msg8").innerHTML = "Enter the Discount";
                                                            str = false;
                                                        }
                                                        if (document.new_products.sell_price.value == '')
                                                        {
                                                            document.getElementById("msg9").innerHTML = "Enter the Sell Price";
                                                            str = false;
                                                        }
                                                        if ((document.new_products.status[0].checked == '') && (document.new_products.status[1].checked == ''))
                                                        {
                                                            document.getElementById("msg5").innerHTML = "Select the Status";
                                                            str = false;
                                                        }

                                                        return str;

                                                    }
</script>
<script type="text/javascript">
    $(document).ready(function()
    {

        $("#supercategory_name").change(function()
        {
            var super_id_prod = $(this).val();
            if (super_id_prod != '0')
            {
                $.ajax
                        ({
                            type: "POST",
                            url: "get_child.php",
                            data: "super_id_prod=" + super_id_prod,
                            success: function(option)
                            {
                                $("#category_name").html(option);
                                $("#subcategory_name").html("<option value='0'>Select Sub Category</option>");
                            }
                        });
            }
            else
            {
                $("#category_name").html("<option value='0'>Select Category Name</option>");
                $("#subcategory_name").html("<option value='0'>Select Sub Category</option>");
            }
            return false;
        });


        $("#category_name").change(function()
        {
            var cate_id = $(this).val();
            var super_id_sub_prod = $('#supercategory_name').val();
            if (super_id_sub_prod != '0')
            {
                $.ajax
                        ({
                            type: "POST",
                            url: "get_child.php",
                            data: "cate_id=" + cate_id + "&super_id_sub_prod=" + super_id_sub_prod,
                            success: function(option)
                            {
                                $("#subcategory_name").html(option);
                            }
                        });
            }
            else
            {
                $("#subcategory_name").html("<option value='0'>Select Subcategory</option>");
            }
            return false;
        });
    });
    
    
</script>

<script src="docsupport/chosen.jquery.js" type="text/javascript"></script>
  <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>


