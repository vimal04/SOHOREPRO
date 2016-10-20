<?php
include './config.php';

if(isset($_POST['comp_id']) && $_POST['comp_id'] != '')
{
    $company_id                 = $_POST['comp_id'];
    $e_billing                  = $_POST['e_billing_val'];
    $update_e_billing_customer  = "UPDATE sohorepro_company SET e_billing = '".$e_billing."' WHERE comp_id = '".$company_id."' ";
    $e_billing_status           = mysql_query($update_e_billing_customer);
    if($e_billing_status){
        echo '1';
    }
}