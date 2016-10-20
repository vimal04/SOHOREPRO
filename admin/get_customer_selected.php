<?php

include './config.php';

if ($_POST['customer_selected'] == "1") {
    $product_id = $_POST['customer_id'];
    $fav_comp_id = GetCompIdFav($product_id);
    foreach ($fav_comp_id as $fav_name) {
        $fav_name_sel[] = getCompName($fav_name['comp_id']);
        $fav_all_name = implode(",", $fav_name_sel);
    }
    echo $fav_all_name;
}

if ($_POST['update_product_customer'] == "1") {
    
    $product_name        =   $_POST["product_name"];
    $list_price          =   $_POST["list_price"];
    $discount            =   $_POST["discount"];
    $sell_price          =   $_POST["sell_price"];
    $product_id          =   $_POST["product_id"];
    
    function cleanSpaces($string) {
        while (substr($string, 0, 1) == " ") {
            $string = substr($string, 1);
            cleanSpaces($string);
        }
        while (substr($string, -1) == " ") {
            $string = substr($string, 0, -1);
            cleanSpaces($string);
        }
        return $string;
    }
    
    function InsertSpecialtyDtls($product_name, $list_price, $discount, $sell_price, $product_id, $comp_id){
        $query_fav = "INSERT INTO sohorepro_favorites SET          
                            product_id       = '" . $product_id . "',
                            comp_id          = '".$comp_id."',            
                            list_price       = '" . $list_price . "',
                            discount_price   = '" . $discount . "',
                            sell_price       = '" . $sell_price . "' ";
        mysql_query($query_fav);   
        
        $query_update_pro = "UPDATE sohorepro_products SET  
                            product_name     = '" . $product_name . "',
                            list_price       = '" . $list_price . "',
                            discount         = '" . $discount . "',
                            price            = '" . $sell_price . "' WHERE id = '" . $product_id . "' ";
        mysql_query($query_update_pro);  
    }
    
    function UpdateSpecialtyDtls($product_name, $list_price, $discount, $sell_price, $product_id, $comp_id){
        $query_fav = "UPDATE sohorepro_favorites SET  
                            list_price       = '" . $list_price . "',
                            discount_price   = '" . $discount . "',
                            sell_price       = '" . $sell_price . "' WHERE product_id = '" . $product_id . "' AND comp_id          = '".$comp_id."'";
        mysql_query($query_fav);   
        
        $query_update_pro = "UPDATE sohorepro_products SET  
                            product_name     = '" . $product_name . "',
                            list_price       = '" . $list_price . "',
                            discount         = '" . $discount . "',
                            price            = '" . $sell_price . "' WHERE id = '" . $product_id . "' ";
        mysql_query($query_update_pro); 
    }
    
    
    // Clean the customers Name and Customer ID Start

    $all_customer = $_POST['customers_value'];

    $split_cus = explode('<li class="search-choice"><span>', $all_customer);
    $arr = $split_cus;
        
    $arr_1 = implode(" ", $arr);

    $second_half = explode('</span>', $arr_1);
    $arr_2 = implode(" ", $second_half);

    $third_half = explode('</a></li>', $arr_2);
    array_pop($third_half);

    $fourth_half = implode(" ", $third_half);
    $replace_fourth = str_replace('class="search-choice-close">', '', $fourth_half);

    $last_split = explode('<a data-option-array-index', $fourth_half);
    $last_split_j = implode(" ", $last_split);

    $last_split_k = explode('class=', $last_split_j);
    array_pop($last_split_k);

    $replace_fourth_k = str_replace('<a', '', $last_split_k);

    $not_least_string_l = implode(" ", $replace_fourth_k);

    $not_least_string_m = explode('"', $not_least_string_l);

    $replace_fourth_m = str_replace('>', '', $not_least_string_m);

    $to_remove = array('search-choice-close');

    $result = array_diff($replace_fourth_m, $to_remove);

    $replace_fourth_p = str_replace('data-option-array-index=', '', $result);

    $not_least_string = implode(" ", $last_split);

    $not_least_array = explode('=', $not_least_string);



    $not_least_array_1 = implode(' ', $not_least_array);

    $not_least_array_2 = explode('"', $not_least_array_1);

    foreach ($replace_fourth_p as $key => $val) {
        if (!is_numeric($val)) {
            $array_customer[] = cleanSpaces($val);
        }
    }

    $final_customer_array = array_values(array_filter($array_customer));
    $replace_final_customer_array = str_replace('=', '', $final_customer_array);
    $all_customer_output = array_slice($replace_final_customer_array, 2); 
    
    
    foreach ($all_customer_output as $customers_output){
         $sanitize_value = str_replace("&amp;","&",$customers_output);
         $comp_id   = compName($sanitize_value);
         $check_exist = CompanyExistSplty($comp_id, $product_id);
         if(count($check_exist) == "0"){
             $resutl_insert = InsertSpecialtyDtls($product_name, $list_price, $discount, $sell_price, $product_id, $comp_id);
             if($resutl_insert){
                 echo "1~".$product_name."~".$list_price."~".$discount."~".$sell_price."~".$product_id;
             }
         }
         if(count($check_exist) > "0"){
             $$resutl_update = UpdateSpecialtyDtls($product_name, $list_price, $discount, $sell_price, $product_id, $comp_id);
             if($$resutl_update){
                 echo "1~".$product_name."~".$list_price."~".$discount."~".$sell_price."~".$product_id;
             }
         }
    }    
    
    echo '1';
}
?>