<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);


if ($_POST['edit_original'] == '1') {

    $original_val = $_POST['original_val'];
    $option_id = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET origininals = '" . $original_val . "' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $original_val;
}

if ($_POST['edit_poe'] == '1') {

    $poe_val = $_POST['poe_val'];
    $option_id = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET print_ea = '" . $poe_val . "' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $poe_val;
}

if ($_POST['edit_job_type'] == '1') {

    $job_type_drop = $_POST['job_type_drop'];
    $option_id = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET plot_arch = '" . $job_type_drop . "' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    $job_type = ($job_type_drop == '1') ? 'Plotting' : 'Architectural Copies';
    echo $job_type;
}

if ($_POST['edit_cust_dtls'] == '1') {

    $cust_dtls  = $_POST['cust_dtls'];
    $size_drop  = $_POST['size_drop'];
    
    $option_id = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET custome_details = '" . $cust_dtls . "', size = '".$size_drop."' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $cust_dtls;
}

if ($_POST['edit_cust_page_dtls'] == '1') {

    $cust_page_dtls = $_POST['cust_page_dtls'];
    $output_drop    = $_POST['output_drop'];
    
    $option_id = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET output_both = '" . $cust_page_dtls . "' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $cust_page_dtls;
}

if ($_POST['get_custome_element'] == '1') {

    $option_id = $_POST['option_id'];
    $sets_details = SetsForId($option_id);  
    $cust_details = ($sets_details[0]['custome_details'] == '0') ? '' : $sets_details[0]['custome_details'];
    ?>
    <li>
        <label>Custom Size Details: </label>
        <p style="cursor: pointer;" id="custome_dtls_<?php echo $option_id; ?>" onclick="return edit_custome('<?php echo $option_id; ?>');"><?php echo $sets_details[0]['custome_details']; ?></p>
        <input type="text" name="cust_dtls_txt_<?php echo $option_id; ?>" id="cust_dtls_txt_<?php echo $option_id; ?>" value="<?php echo $cust_details; ?>" class="none" style="width: 60px;float: left;" />
        <div id="action_cust_dtls_<?php echo $option_id; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
            <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_cust_details('<?php echo $option_id; ?>');" class="ad1_update" style="cursor: pointer;" id="">
            <!--<img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_cust_dtls('<?php echo $option_id; ?>');" class="ad1_update" style="cursor: pointer;" id="">-->
        </div>
    </li>
    <?php
}

if ($_POST['get_custome_element_option'] == '1') {

    $size_drop  = $_POST['size_drop'];
    $option_id = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET size = '".$size_drop."' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $cust_dtls;
}

if ($_POST['edit_media'] == '1') {

    $media_drop     = $_POST['media_drop'];
    $option_id      = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET media = '".$media_drop."' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $media_drop;
}

if ($_POST['edit_binding'] == '1') {

    $binding_dro     = $_POST['binding_drop'];
    $option_id      = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET binding = '".$binding_dro."' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $binding_dro;
}


if ($_POST['edit_folding'] == '1') {

    $folding_drop       = $_POST['folding_drop'];
    $option_id          = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET folding = '".$folding_drop."' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $folding_drop;
}



if ($_POST['edit_output'] == '1') {

    $output_drop        = $_POST['output_drop'];
    $option_id          = $_POST['option_id'];

    $query = "UPDATE sohorepro_plotting_set SET output = '".$output_drop."' WHERE id = '" . $option_id . "' ";
    $sql_result = mysql_query($query);
    echo $output_drop;
}