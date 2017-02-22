<?php
include "admin/db_connection.php";
if ($_POST['add_customer'] == '1') {
    $custmer_email = $_POST['cust_email'];
    $query = "SELECT * FROM `sohorepro_company` WHERE `comp_contact_email` = '" . $custmer_email. "'";
        $result = mysql_query($query);   
       //echo $query;
         while ($object = mysql_fetch_assoc($result)):
        $value[] = $object;
    endwhile;
echo count($value);

}
?>
