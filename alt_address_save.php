<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);


if ($_POST['alt_address_save'] == '1') {

    $comp_name_ship = mysql_real_escape_string($_POST['alt_new_comp_name']);
    $attention_to_ship = mysql_real_escape_string($_POST['alt_new_comp_att']);
    $address_1_ship = mysql_real_escape_string($_POST['alt_new_comp_add1']);
    $address_2_ship = mysql_real_escape_string($_POST['alt_new_comp_add2']);
    $address_3_ship = mysql_real_escape_string($_POST['alt_new_comp_add3']);
    $city_ship = mysql_real_escape_string($_POST['alt_new_comp_city']);
    $state_ship = mysql_real_escape_string($_POST['alt_new_comp_state']);
    $zip_ship = mysql_real_escape_string($_POST['alt_new_comp_zip']);
    $plus_4_ship = mysql_real_escape_string($_POST['plus_4_ship']);
    $phone_ship = mysql_real_escape_string($_POST['alt_new_comp_phone']);
    $phone_plus_4_ship = mysql_real_escape_string($_POST['phone_plus_4_ship']);


    $query = "INSERT INTO sohorepro_address_service
			SET     company_name      = '" . $comp_name_ship . "',
                                attention_to      = '" . $attention_to_ship . "',
                                address_1         = '" . $address_1_ship . "',
                                address_2         = '" . $address_2_ship . "',
                                address_3         = '" . $address_3_ship . "',
                                city              = '" . $city_ship . "',
                                state             = '" . $state_ship . "',
                                zip               = '" . $zip_ship . "',
                                zip_ext           = '" . $plus_4_ship . "',
                                phone             = '" . $phone_ship . "',
                                extension         = '" . $phone_plus_4_ship . "',    
                                comp_id           = '" . $_SESSION['sohorepro_companyid'] . "',
                                type              = '1'";

    $ship_address = mysql_query($query);
    $address_id_last_inserted = mysql_insert_id();

    echo '1~';
    $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
}
foreach ($address_book as $address) {
    ?>                                                                                        
    <option value="<?php echo $address['id']; ?>" <?php if ($address['id'] == $address_id_last_inserted) { ?> selected="selected" <?php } ?>><?php echo $address['company_name']; ?></option>
    <?php
}
?>

