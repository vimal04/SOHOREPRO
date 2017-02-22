<?php
include './config.php';
include './db_connection.php';

if(isset($_POST['search'])){
$customer_name        =       $_POST['search'];

$auto_customer        =       AutoCustomer($customer_name);
if(count($auto_customer) > 0){
?>   
<ul class="auto_reference">
<?php
foreach ($auto_customer as $ref){
    $cus_name = mysql_real_escape_string($ref['comp_name']);
?>
    <li><span onclick="return get_customer_name('<?php echo $cus_name; ?>');"><?php echo $ref['comp_name']; ?></span></li>
<?php
}
?>
</ul>
<?php
}

}
if(isset($_POST['search_orders'])){
$customer_name        =       $_POST['search_orders'];

$auto_customer        =       AutoSupplyOrders($customer_name);
if(count($auto_customer) > 0){
?>   
<ul class="auto_reference">
<?php
foreach ($auto_customer as $ref){
    $cus_name = mysql_real_escape_string($ref['order_number']);
?>
    <li><span onclick="return get_customer_name('<?php echo $ref['order_number']; ?>');"><?php echo $ref['order_number']; ?></span></li>
<?php
}
?>
</ul>
<?php
}

}
