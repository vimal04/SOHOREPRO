<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);


if ($_POST['service_plotting_add'] == '1') {

    $user_id_add_set            = $_SESSION['sohorepro_userid'];
    $company_id_view_plot       = $_SESSION['sohorepro_companyid'];

    $job_reference              = $_POST['job_reference'];
    $original                   = $_POST['original'];
    $print_ea                   = $_POST['print_ea'];
    $size                       = strtoupper($_POST['size']);
    $output                     = strtoupper($_POST['output']);
    $media                      = strtoupper($_POST['media']);
    $binding                    = strtoupper($_POST['binding']);
    $folding                    = strtoupper($_POST['folding']);
    $plot_arch                  = $_POST['plot_arch'];
    $special_instruction        = $_POST['special_instruction'];
    $size_custom_val            = $_POST['size_custom_val'];
    $output_both_val            = $_POST['output_both_val'];
    $my_office_alt              = $_POST['my_office_alt'];
    
    if($my_office_alt == "alternate"){
    $address_book_se_val        = $_POST['address_book_se_val'];
    }else{
    $address_book_se_val        = "0";   
    }
    
    if($_SESSION['use_the_same'] != ''){
    $uploadedfile_option        = $_SESSION['upload_file'];
    
    $pickup_date                = $_SESSION['pick_up'];
    $pickup_time                = $_SESSION['pick_up_time'];
    
    $drop_val                   = $_SESSION['drop_off'];
    
    $ftp_link_val               = $_SESSION['ftp_link'];
    $user_name_val              = $_SESSION['user_name'];
    $password_val               = $_SESSION['password']; 
    $use_same_alt               = $_SESSION['use_the_same'];
    }  else {        
    $uploadedfile_option        = ($_POST['uploadedfile_option'] != "undefined") ? $_POST['uploadedfile_option'] : '';
    
    $pickup_date                = $_POST['pickup_date'];
    $pickup_time                = $_POST['pickup_time'];
    
    $drop_val                   = ($_POST['drop_val'] == 'undefined') ? '0' : $_POST['drop_val'];
    
    $ftp_link_val               = $_POST['ftp_link_val'];
    $user_name_val              = $_POST['user_name_val'];
    $password_val               = $_POST['password_val'];    
    $use_same_alt               = '0';
    }
    
    
    
    
    $size_custom                = $_POST['size_custom'];
    
    
    
    $sql_option_id = mysql_query("SELECT options FROM sohorepro_plotting_set WHERE company_id = '".$company_id_view_plot."' AND user_id = '".$user_id_add_set."' AND order_id = '0' ORDER BY options DESC LIMIT 1");
    $object_option = mysql_fetch_assoc($sql_option_id);

        if (count($object_option['options']) > 0) {
            $options = ($object_option['options'] + 1);
        } 
        else{
            $options = '1';
        }
    

    $query = "INSERT INTO sohorepro_plotting_set
			SET     referece_id     = '" . $job_reference . "',
                                origininals     = '" . $original . "',
                                options         = '" . $options ."',  
                                print_ea        = '" . $print_ea . "',
                                size            = '" . $size . "',
                                custome_details = '" . $size_custom . "',    
                                output          = '" . $output . "',
                                media           = '" . $media . "',
                                binding         = '" . $binding . "',
                                folding         = '" . $folding . "',
                                plot_arch       = '" . $plot_arch . "',
                                spl_instruction = '" . $special_instruction . "',
                                custom_size     = '" . $size_custom_val . "',
                                output_both     = '" . $output_both_val . "',
                                upload_file     = '" . $uploadedfile_option . "',
                                pick_up         = '" . $pickup_date . "', 
                                pick_up_time    = '" . $pickup_time . "',
                                drop_off        = '" . $drop_val . "',
                                ftp_link        = '" . $ftp_link_val . "', 
                                user_name       = '" . $user_name_val . "',
                                password        = '" . $password_val . "',
                                company_id      = '" . $company_id_view_plot . "',
                                user_id         = '" . $user_id_add_set . "',
                                my_office_alt   = '" . $my_office_alt. "',
                                address_book_id = '" . $address_book_se_val. "',
                                use_same_alt    = '" . $use_same_alt ."'     ";
    $sql_result = mysql_query($query);
    if($sql_result){
                                $_SESSION['upload_file']    =   '';
                                $_SESSION['pick_up']        =   '';
                                $_SESSION['pick_up_time']   =   '';
                                $_SESSION['drop_off']       =   '';
                                $_SESSION['ftp_link']       =   '';
                                $_SESSION['user_name']      =   '';
                                $_SESSION['password']       =   '';
                                $_SESSION['use_the_same']   =   '';
    }
    $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
    $enteredLFPPrimay = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);
    
//    $added_cart_count           =    (count($enteredPlotPrimay) > 0) ? "1" : "0";
//    $added_cart_session         =    ($_SESSION['cart_count'] == "") ? "1" : "1";
    
//    $added_cart_count_session_p =    ($added_cart_count + $added_cart_session);  
//    
//    $added_cart_count_session   =    ($added_cart_count_session_p > "2") ? "2" : "1";
    
    if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $added_cart_session = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $added_cart_session = "2";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $added_cart_session = "1";
    } 

    
    if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $_SESSION['cart_count'] = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $_SESSION['cart_count'] = "2";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    } 
    
    $_SESSION['cart_count']     =     $added_cart_session;
    
    
    //$_SESSION['cart_count'] =   $added_cart_count;
    
    $count_option = count($enteredPlotPrimay) + 1;

    $_SESSION['ref_val'] = $_POST['job_reference'];

    $i = 1;
    foreach ($enteredPlotPrimay as $plot) {
        $job_type = ($plot['plot_arch'] == '1') ? 'Plotting' : 'Architectural Copies';
        $file_upload_exist = UploadFileExist($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid']);
        $output = ($plot['output'] == 'Both') ? $plot['output'].' <b>B&W and COLOR</b>' : $plot['output'];
        ?>
        <div class="plot_container" style="width: 100%;float: left;border: 1px #FF7E00 solid;margin-bottom: 20px;">
            <div class="plot_wrap" style="padding: 5px;">
                <div style="width: 100%;float: left;margin-bottom: 10px;">
                    <div style="float: left;width: 45%;font-weight: bold;">Job Option - <?php echo $i; ?></div>
                    <div style="float: left;width: 50%;font-weight: bold;text-align: right;cursor: pointer;" onclick="return delete_added_job(<?php echo $plot['id']; ?>);"><span style="background: #D84B36;color: #FFF;padding: 2px 8px;border-radius: 5px;margin-top: 3px;font-weight: bold;">Delete</span></div>
                </div>
                <ul>
                    <li>
                        <label>Job Type: </label>
                        <p id="job_type_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_job_type('<?php echo $plot['id']; ?>');"><?php echo $job_type; ?></p>
                        <select class="none" id="job_type_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_job_type('<?php echo $plot['id']; ?>');">
                            <option <?php if($plot['plot_arch'] == '1'){ ?> selected="selected" <?php } ?> value="1">Plotting</option>
                            <option <?php if($plot['plot_arch'] == '0'){ ?> selected="selected" <?php } ?> value="0">Architectural Copies</option>
                        </select>
                    </li>
                    <li>
                        <label>Originals:</label>
                        <p id="original_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_original_option('<?php echo $plot['id']; ?>');"><?php echo $plot['origininals']; ?></p>                        
                        <input type="text" name="original_txt_<?php echo $plot['id']; ?>" id="original_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['origininals']; ?>" class="none" style="width: 40px;float: left;" />
                        <div id="action_original_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                            <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_original('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                            <img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_original('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                        </div>                        
                    </li>
                    <li>
                        <label>Prints of Each:</label>
                        <p id="poe_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_poe_option('<?php echo $plot['id']; ?>');"><?php echo $plot['print_ea']; ?></p>
                        <input type="text" name="poe_txt_<?php echo $plot['id']; ?>" id="poe_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['print_ea']; ?>" class="none" style="width: 40px;float: left;" />
                        <div id="action_poe_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                            <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_poe('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                            <img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_poe('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                        </div>
                    </li>
                    <li>
                        <label>Size:</label>
                        <p id="size_p_<?php echo $plot['id']; ?>" onclick="return edit_size_option('<?php echo $plot['id']; ?>');" style="cursor: pointer;"><?php echo $plot['size']; ?></p>
                        <select class="none" id="size_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_size('<?php echo $plot['id']; ?>');">
                            <option <?php if($plot['size'] == strtoupper('FULL')){ ?> selected="selected" <?php } ?> value="FULL" >FULL</option>
                            <option <?php if($plot['size'] == strtoupper('HALF')){ ?> selected="selected" <?php } ?> value="HALF">HALF</option>
                            <option <?php if($plot['size'] == strtoupper('Reduce To 11 X 17')){ ?> selected="selected" <?php } ?> value="Reduce to 11 X 17">Reduce to 11 X 17</option>
                            <option <?php if($plot['size'] == strtoupper('Custom')){ ?> selected="selected" <?php } ?> value="Custom">Custom</option>  
                        </select>
                    </li>
                    <li>
                        <label>Output:</label>
                        <p id="output_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_output_option('<?php echo $plot['id']; ?>');"><?php echo $output; ?></p>
                        <select class="none" id="output_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_output('<?php echo $plot['id']; ?>');">
                            <option <?php if($output == strtoupper('B/W')){ ?> selected="selected" <?php } ?>  value="B/W">B/W</option>
                            <option <?php if($output == strtoupper('Color')){ ?> selected="selected" <?php } ?> value="Color">Color</option>
                            <option <?php if($output == strtoupper('Both')){ ?> selected="selected" <?php } ?> value="Both">Both</option>
                        </select>
                    </li>
                    <li>
                        <label>Media:</label>
                        <p id="media_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_media_option('<?php echo $plot['id']; ?>');"><?php echo $plot['media']; ?></p>
                        <select class="none" id="media_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_media('<?php echo $plot['id']; ?>');">
                            <option <?php if($plot['media'] == strtoupper('Bond')){ ?> selected="selected" <?php } ?>  value="Bond">Bond</option>
                            <option <?php if($plot['media'] == strtoupper('Vellum')){ ?> selected="selected" <?php } ?> value="Vellum">Vellum</option>
                            <option <?php if($plot['media'] == strtoupper('Mylar')){ ?> selected="selected" <?php } ?> value="Mylar">Mylar</option>       
                        </select>
                    </li>
                    <li>
                        <label>Binding:</label>
                        <p id="binding_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_binding_option('<?php echo $plot['id']; ?>');"><?php echo $plot['binding']; ?></p>
                        <select class="none" id="binding_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_binding('<?php echo $plot['id']; ?>');">
                            <option <?php if($plot['binding'] == strtoupper('none')){ ?> selected="selected" <?php } ?> value="none">None</option>                                      
                            <option <?php if($plot['binding'] == strtoupper('Bind All')){ ?> selected="selected" <?php } ?> value="Bind All">Bind All</option>                          
                            <option <?php if($plot['binding'] == strtoupper('Bind by Discipline')){ ?> selected="selected" <?php } ?> value="Bind by Discipline">Bind by Discipline</option>
                            <option <?php if($plot['binding'] == strtoupper('Screw Post')){ ?> selected="selected" <?php } ?> value="Screw Post">Screw Post</option>     
                        </select>
                    </li>
                    <li>
                        <label>Folding:</label>
                        <p id="folding_p_<?php echo $plot['id']; ?>" style="cursor: pointer;" onclick="return edit_folding_option('<?php echo $plot['id']; ?>');"><?php echo $plot['folding']; ?></p>
                        <select class="none" id="folding_drop_<?php echo $plot['id']; ?>" style="width: 150px;" onchange="return update_folding('<?php echo $plot['id']; ?>');">
                            <option <?php if($plot['folding'] == strtoupper('None')){ ?> selected="selected" <?php } ?> value="None">None</option>
                            <option <?php if($plot['folding'] == strtoupper('Yes')){ ?> selected="selected" <?php } ?> value="Yes">Yes</option>    
                        </select>
                    </li>
                </ul>
                <ul style="margin-left: 20px;">
                    <div id="custome_details_<?php echo $plot['id']; ?>">
                    <?php
                    if ($plot['size'] == strtoupper('Custom')) {
                        ?>
                    
                        <li>
                            <label>Custom Size Details: </label>
                            <p style="cursor: pointer;" id="custome_dtls_<?php echo $plot['id']; ?>" onclick="return edit_custome('<?php echo $plot['id']; ?>');"><?php echo $plot['custome_details']; ?></p>
                            <input type="text" name="cust_dtls_txt_<?php echo $plot['id']; ?>" id="cust_dtls_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['custome_details']; ?>" class="none" style="width: 60px;float: left;" />
                            <div id="action_cust_dtls_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                                <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_cust_details('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                                <!--<img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_cust_dtls('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">-->
                            </div>
                        </li>                        
                    <?php } ?>
                    </div>
                </ul>
                <ul id="color_page_dtls_<?php echo $plot['id']; ?>">
                    <?php
                    if ($plot['output'] == strtoupper('Both')) { ?>
                    <li>
                        <label>Color Page Number:</label>
                        <p style="cursor: pointer;" id="custome_page_dtls_<?php echo $plot['id']; ?>" onclick="return edit_custome_page('<?php echo $plot['id']; ?>');"><?php echo $plot['output_both']; ?></p>
                        <input type="text" name="cust_page_dtls_txt_<?php echo $plot['id']; ?>" id="cust_page_dtls_txt_<?php echo $plot['id']; ?>" value="<?php echo $plot['output_both']; ?>" class="none" style="width: 60px;float: left;" />
                        <div id="action_cust_page_dtls_<?php echo $plot['id']; ?>" style="float: left;margin-left: 5px;display: none;cursor: pointer;">
                            <img src="admin/images/like_icon.png" style="" alt="Update" title="Update" width="22" height="16" onclick="return update_cust_page_details('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">
                            <!--<img src="admin/images/cancel_icon.png" style="" alt="Cancel" title="Cancel" width="22" height="16" onclick="return cancel_cust_dtls('<?php echo $plot['id']; ?>');" class="ad1_update" style="cursor: pointer;" id="">-->
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <div style="width: 100%;float: left;margin-top: 5px;">
                    <?php if(($file_upload_exist[0]['job_id'] != '') || ($plot['ftp_link'] != '0') || ($plot['pick_up'] != '0') || ($plot['drop_off'] != '0')){ ?>
                    <div style="float: left;width: 100%;margin-top: 5px;font-weight: bold;">File Options</div>
                    <?php } ?>
                    <?php
                    if($plot['use_same_alt'] == '0'){
                    if ($plot['upload_file'] != '') {
                        ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Upload File</div>                            
                            <div style="float: left;width: 100%;"><?php echo $plot['upload_file']; ?></div>                               
                        </div>
                    <?php } elseif ($plot['ftp_link'] != '0') {
                            $link       = ($plot['ftp_link'] != '0') ? $plot['ftp_link'] : '';
                            $user_name  = ($plot['user_name'] != '0') ? $plot['user_name'] : '';
                            $password   = ($plot['password'] != '0') ? $plot['password'] : '';
                        ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Provide Link to File</div>
                            <div style="float: left;width: 100%;">FTP Link  : <?php echo $link; ?></div>
                            <div style="float: left;width: 100%;">User Name : <?php echo $user_name; ?></div>
                            <div style="float: left;width: 100%;">Password  : <?php echo $password; ?></div>
                        </div>
                    <?php } elseif ($plot['pick_up'] != '0') {
                            if(($plot['pick_up'] == 'ASAP') && ($plot['pick_up_time'] == 'ASAP')){
                          ?>
                            <div style="float: left;width: 100%;">
                                  <div style="float: left;width: 100%;">Schedule a pick up Date/Time: <?php echo $plot['pick_up']; ?></div>
                                  <!--<div style="float: left;width: 100%;">Pickup Date : <?php echo $plot['pick_up']; ?></div>-->
<!--                                  <div style="float: left;width: 100%;">Pickup Time  : <?php //echo $plot['pick_up_time']; ?></div>-->
                            </div>
                          <?php
                            }else{
                        ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;margin-bottom: 10px;">Schedule a pick up Date/Time: <?php echo $plot['pick_up'].'&nbsp;'.$plot['pick_up_time']; ?></div>
<!--                            <div style="float: left;width: 100%;">Pickup Date : <?php //echo $plot['pick_up']; ?></div>
                            <div style="float: left;width: 100%;">Pickup Time  : <?php //echo $plot['pick_up_time']; ?></div>-->
                        </div>
                            <?php }} elseif ($plot['drop_off'] != '0') { ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Drop off at Soho Repro</div>                       
                            <div style="float: left;width: 100%;margin-bottom: 10px;">Drop off at : <?php echo $plot['drop_off']; ?></div>
                        </div>   
                    <?php
                    }
                    }else{
                    ?>
                    <div style="float: left;width: 100%;">
                        <div style="float: left;width: 100%;margin-bottom: 10px;">Use the Same File as in Job Option <?php echo ($plot['use_same_alt']); ?></div>
                    </div>   
                    <?php
                    }
                    ?>
                    
                </div>
                
                <?php if($plot['my_office_alt'] != '0'){ 
                    
                    $address_dtls    = SelectLastEnteredAddress($plot['address_book_id']);
                    $address_2       = ($address_dtls[0]['address_2'] != '') ? $address_dtls[0]['address_2'].'<br>' : '';
                    $address_3       = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'].'<br>' : '';
                    $address_string  = $address_dtls[0]['company_name'].'<br>'.$address_dtls[0]['address_1'].'<br>'.$address_2.$address_3.$address_dtls[0]['city'].',&nbsp;'.StateName($address_dtls[0]['state']).'&nbsp;'.$address_dtls[0]['zip'];
                    
                    $option_sechdule = ($plot['my_office_alt'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>'.$address_string;
                    
                    ?>
                <div style="width: 100%;float: left;margin-top: 7px;">                    
                    <div style="float: left;width: 22%;margin-top: 5px;font-weight: bold;">Schedule a pick-up Option:</div>
                    <div style="float: left;width: 50%;margin-top: 5px;">                        
                        <div style="float: left;width: 100%;"><?php echo $option_sechdule; ?></div>
                    </div> 
                </div>
                    <?php } ?>
                
                
                    <?php if($plot['spl_instruction'] != ''){ ?>
                <div style="width: 100%;float: left;margin-top: 7px;">                    
                    <div style="float: left;width: 100%;margin-top: 5px;font-weight: bold;">Special Instructions</div>
                    <div style="float: left;width: 100%;">                        
                        <div style="float: left;width: 100%;"><?php echo $plot['spl_instruction']; ?></div>
                    </div> 
                </div>
                    <?php } ?>
                
            </div>
        </div>
        <?php
        $i++;
    }
    ?>
    <!--New Job Add Start -->
    <div class="serviceOrderSetHolder">
        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
            Job Options - Option <?php echo $count_option; ?>
            <div style="float:right;font-weight: bold;">                                          
            </div>
        </label>  
        <input type="hidden" name="optint_count_check" id="optint_count_check" value="<?php echo count($enteredPlotPrimay); ?>" />
        <input type="hidden" name="optint_count_check_i" id="optint_count_check_i" value="<?php echo $added_cart_session; ?>" />
        
        <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
            <div class="serviceOrderSetWapperInternal">
                <div class="serviceOrderSetDIV">
                    <div style="width: 100%;float: left;padding-top: 10px;">  
                        
                        <!--JASSIM-->                        
                        <input type="checkbox"  style="width: 2%;margin-bottom: 20px;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set();" /><span id="use_same_check_box_spn">Use the same File as in Job Option <?php echo ($count_option - 1); ?></span>
                        <!--End-->
                        
                        <!--Check Box Start-->
                        <div style="float:left;width:100%;">
                            <ul class="arch_radio">
                                <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot_new();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
                                <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" onclick="return active_arch();" /><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">ARCHITECTURAL COPIES</span></li>
                            </ul>
                            <span id="errmsg"></span>
                        </div>
                        <!--Check Box End-->

                        <!--Originals Start-->
                        <div>
                            <label>
                                Originals
                            </label>
                            <input class="order_0_set1_0_original k-input kdText " style="width:50px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
                        </div>
                        <!--Originals End-->

                        <!--POE Start-->
                        <div>
                            <label>
                                Prints of Each<span style="color: red;">*</span>
              <!--                                  <span style="font-weight:bold;color:#cc0000">
                                  *
                                </span>-->
                            </label>
                            <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
                        </div>
                        <!--POE End-->

                        <!--Size Start-->
                        <div>
                            <label>
                                Size<span style="color: red;">*</span>
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_size kdSelect" style="width: 135px;" id="size" name="size" onchange="return custome_size();">                            
                                        <option value="FULL">FULL</option>
                                        <option value="HALF">HALF</option>
                                        <option value="Reduce to 11 X 17">Reduce to 11 X 17</option>
                                        <option value="Custom">Custom</option>                          
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Size End-->

                        <!--Output Start-->
                        <div>
                            <label>
                                Output<span style="color: red;">*</span>
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_output kdSelect " style="width: 65px;" id="output" name="output" onchange="return custome_output();">
                                        <option value="B/W">B/W</option>
                                        <option value="Color">Color</option>
                                        <option value="Both">Both</option>
                                    </select>

                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Size End-->

                        <!--Media Start-->
                        <div>
                            <label>
                                Media<span style="color: red;">*</span>
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_media kdSelect " style="width: 70px;" id="media" name="media">
                                        <option value="Bond">Bond</option>
                                        <option value="Vellum">Vellum</option>
                                        <option value="Mylar">Mylar</option>                          
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Media End-->

                        <!--Binding Start-->
                        <div>
                            <label>
                                Binding
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_binding kdSelect " style="width: 130px;" id="binding" name="binding">
                                        <option value="none">None</option>                                      
                                        <option value="Bind All">Bind All</option>                          
                                        <option value="Bind by Discipline">Bind by Discipline</option>
                                        <option value="Screw Post">Screw Post</option>
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Binding End-->

                        <!--Folding Start-->
                        <div>
                            <label>
                                Folding
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_folding kdSelect " style="width: 100px;" id="folding" name="folding">
                                        <option value="none">None</option>
                                        <option value="Yes">Yes</option>                          
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Folding End-->
                    </div>
                    <!--Custom Details Start-->
                    <div id="size_custom_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                        <label>Please Specify Custom Details : </label><textarea name="size_custom" id="size_custom" rows="3" cols="18" style="width: 201px;" placeholder="Custom Size"></textarea>
                    </div>
                    <!--Custom Details End-->
                    <!--Page Number Details Start-->
                    <div id="output_both_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                        <label>Enter page numbers that are in COLOR (separated by a comma) :</label>
                        <input type="text" name="output_both" id="output_both" style="width: 200px;" />
                    </div>
                    <!--Page Number Details End-->

                    <div style="width:730px;border-bottom: 1px solid #CCCCCC;float: left;">
                        
<!--                        <label style="font-weight: bold;height:28px">
                            Alternative File Options<span style="color: red;">*</span>
                        </label>
                        <input type="checkbox"  style="width: 2%;margin-bottom: 20px;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set();" /><span id="use_same_check_box_spn">Use the same File Option as in Job Option <?php echo ($count_option - 1); ?></span>-->
                        <div id="options_plott" class="check" style="/*margin-top: 5px;*/">
                            <label id="alt_ops" style="font-weight: bold;">
                                File Options<span style="color: red;">*</span>
                            </label>
                            <div style="width:730px;border-top: 1px solid #FF7E00;">                                
                            </div>
                            <div class="spl_option" style="float: 100%;">
                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="drop_file"  type="radio" onclick="return upload_soho();" />
                                    <label for="drop" >
                                        Upload File
                                    </label>                    
                                </div>

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="link"  type="radio" onclick="return provide_link();" />
                                    <label for="drop" >
                                        Provide Link to File
                                    </label>                    
                                </div>   

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="pickUp" id="pick"  type="radio" onclick="return show_date_picker();" />
                                    <label for="pick" >
                                        Schedule a pick up
                                    </label></br>
                                    <?php
                                    $all_days_off = AllDayOff();
                                    foreach ($all_days_off as $days_off_split) {
                                        $all_days_in[] = $days_off_split['date'];
                                    }
                                    $all_date = implode(",", $all_days_in);
                                    $all_date_exist = str_replace("/", "-", $all_date);
                                    ?>

                                </div>

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro();" />
                                    <label for="drop" >
                                        Drop off at Soho Repro
                                    </label>                    
                                </div>                               
                            </div>
                            <br>

                            <!--File Upload Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="up_form">
                                <input type="hidden" name="uploadedfile" id="uploadedfile" value="" /> 
                                <div id="dragandrophandler">Drag & Drop Files Here</div>
                                <br><br>
                                <div id="status1"></div> 
                            </div>
                            <!--File Upload Details End-->

                            <!--FTP Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="provide_link">
                                <div style="margin: auto;width: 60%;">
                                    <div style="margin: auto;width: 60%;float:right;">
                                    <!--<textarea name="provide_link" id="provide_link_text" rows="3" cols="18" style="width: 201px;"></textarea>-->
                                        <input type="text" name="ftp_link" id="ftp_link" placeholder="FTP Link" />
                                        <input type="text" name="user_name" id="user_name" placeholder="User Name" />
                                        <input type="text" name="password" id="pass_word" placeholder="Password" />
                                    </div>
                                    <div style="margin: auto;width: 60%;float:right;padding-top: 5px;">
                                        <span>If providing an FTP link, please include username and password.</span>
                                    </div>
                                </div>   
                            </div>
                            <!--FTP Details Start-->

                            <!--Pickup Details Start-->
                            <div id="date_time" style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                <div style="width: 34%;float: left;"> 

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;">
                                        <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                    </div>

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                        <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_revele();" />
                                        <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                    </div>

                                </div>
                                
                                <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: auto;">
                                    <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" value="my_office" />My Office
                                    </div>
                                    <div style="float: left;width: 45%;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                        <select style="margin-bottom: 10px;"  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
                                            <option value="0">Address Book</option>
                                            <option value="N" style="border-bottom: 1px solid #000;">Add New Address</option>
                                            <option value="NL" style="width: 100%;" disabled>---------------------------</option>
                                            <?php
                                            $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                            foreach ($address_book as $address) { ?>                                                                                        
                                            <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div id="alt_new_address_main" style="float: left;width: 100%;display: none;">
                                        <div style="float: left;width: 40%;border: 0px #F99B3E solid;">&nbsp;</div>
                                        <div style="float: left;width: 55%;border: 1px #F99B3E solid;margin-top: 5px;margin-bottom: 5px;">
                                            <div class="alt_new_address_container_hdr">
                                                Add New Address
                                            </div>
                                            <div class="alt_new_address_container">
                                                <ul>
                                                    <li><label>Company Name:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_name" class="alt_new_address_container_val" /></li>
                                                    <li><label>Attention_To:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_att" class="alt_new_address_container_val" /></li>
                                                    <li><label>Address 1:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_add1" class="alt_new_address_container_val" /></li>
                                                    <li><label>Address 2:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_add2" class="alt_new_address_container_val" /></li>
                                                    <li><label>Address 3:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_add3" class="alt_new_address_container_val" /></li>
                                                    <li><label>City:</label><input type="text" name="alt_new_comp_name" id="alt_new_comp_city" class="alt_new_address_container_val" /></li>
                                                    <li>
                                                        <label>State:</label>
                                                        <select name="state" id="alt_new_comp_state" class="required reginput comp_det_view" style="width: 50px;" tabindex="12" >
                                                            <option value="">----</option>
                                                            <?php
                                                            $sel_state = mysql_query("select * from sohorepro_states");
                                                            while ($fth_states = mysql_fetch_array($sel_state)) {
                                                                ?>
                                                            <option value="<?php echo $fth_states['state_abbr']; ?>" <?php if($fth_states['state_abbr'] == "NY"){ ?>selected="selected"<?php } ?>><?php echo $fth_states['state_abbr']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </li>
                                                    <li><label>Zip:</label><input type="text" name="alt_new_comp_zip" id="alt_new_comp_zip" class="alt_new_address_container_val" /></li>
                                                    <li><label>Phone:</label><input type="text" name="alt_new_comp_phone" id="alt_new_comp_phone" class="alt_new_address_container_val" /></li>
                                                </ul>
                                            </div>
                                            <div class="alt_new_address_container_ftr">
                                                <span class="alt_new_address_container_ftr_can" onclick="return can_alt();">Cancel</span>
                                                <span class="alt_new_address_container_ftr_sav" onclick="return save_alt();">Save</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!--Pickup Details End-->

                            <!--Drop off Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off">
                                <div style="margin: auto;width: 60%;">
                                    <div style="margin: auto;width: 75%;float:right;">
                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broome Street" />381 Broome Street
                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                                    <!-- <select id="drop_val">
                                            <option value="" selected="selected">Select</option>
                                            <option value="381 Broom">381 Broome St</option>
                                            <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                        </select> -->
                                    </div>                             
                                </div>   
                            </div>
                            <!--Drop off Details End-->

                        </div>

                        <div id="options_arch" class="check none" style="width:730px;border-top: 1px solid #FF7E00;">
                            <div class="spl_option" style="float: 100%;">
                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="pickUp" id="pick"  type="radio" onclick="return show_date_picker_arch();" />
                                    <label for="pick" >
                                        Schedule a pick up
                                    </label></br>
                                    <?php
                                    $all_days_off = AllDayOff();
                                    foreach ($all_days_off as $days_off_split) {
                                        $all_days_in[] = $days_off_split['date'];
                                    }
                                    $all_date = implode(",", $all_days_in);
                                    $all_date_exist = str_replace("/", "-", $all_date);
                                    ?>

                                </div>

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro_arch();" />
                                    <label for="drop" >
                                        Drop off at Soho Repro
                                    </label>                    
                                </div>                               
                            </div>
                            <br>

                            <!--Pickup Details Start-->

                            <div id="date_time_arch" style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;display:none;">
                            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                            <div style="width: 34%;float: left;"> 

                                <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;">
                                    <span id="asap_status_arch" class="asap_orange" onclick="return asap_arc();">READY NOW</span>
                                </div>

                                <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                    <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt_arc" style="width: 75px;" onclick="return date_reveal();" />
                                    <input id="time_for_alt_arc" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                </div>

                            </div>
                        </div>
                            <!--Pickup Details End-->

                            <!--Drop off Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off_arch">
                                <div style="margin: auto;width: 60%;">
                                    <div style="margin: auto;width: 75%;float:right;">
                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val_arc" value="381 Broome Street" />381 Broome Street
                                        <input style="width: 10% !important;margin-left: 35px !important;" type="radio" name="drop_val" id="drop_val_arc_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                                    <!-- <select id="drop_val">
                                            <option value="" selected="selected">Select</option>
                                            <option value="381 Broom">381 Broome St</option>
                                            <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                        </select> -->
                                    </div>                            
                                </div>   
                            </div>
                            <!--Drop off Details End-->

                        </div>
                        
                        <!--Special Instruction Start-->
                        <input type="hidden" name="validate_imp" id="validate_imp" value="" />
                        <div style="float: left;width: 100%;">
                            <div id="sp_inst" style="margin-top:10px;">
                                <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                                    Special Instructions
                                </label>
                                <br>
                                <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"><?php echo $entered['spl_instruction']; ?></textarea>
                            </div>
                        </div>
                        <!--Special Instruction End-->
                    </div>
                </div>

            </div>  
        </div>
    </div>
    <!--New Job Add End-->
    <?php
} elseif ($_POST['service_plotting_add'] == '0') {

    $delete_set_id = $_POST['delete_set_id'];

    $sql = "DELETE FROM sohorepro_plotting_set WHERE id = '" . $delete_set_id . "' ";
    $result = mysql_query($sql);

    $sql_delete_file = "DELETE FROM sohorepro_upload_files_set WHERE order_id = '0' AND comp_id = '" . $_SESSION['sohorepro_companyid'] . "' AND user_id = '" . $_SESSION['sohorepro_userid'] . "' ";
    mysql_query($sql_delete_file);

    $user_id_add_set = $_SESSION['sohorepro_userid'];
    $company_id_view_plot = $_SESSION['sohorepro_companyid'];
    $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
    $count_option = count($enteredPlotPrimay) + 1;
    $i = 1;
    foreach ($enteredPlotPrimay as $plot) {
        $job_type = ($plot['plot_arch'] == '1') ? 'Plotting' : 'Architecture';
        ?>
        <div class="plot_container" style="width: 100%;float: left;border: 1px #FF7E00 solid;margin-bottom: 5px;">
            <div class="plot_wrap" style="padding: 5px;">
                <div style="width: 100%;float: left;margin-bottom: 10px;">
                    <div style="float: left;width: 45%;font-weight: bold;">Job Option - <?php echo $i; ?></div>
                    <div style="float: left;width: 50%;font-weight: bold;text-align: right;cursor: pointer;" onclick="return delete_added_job(<?php echo $plot['id']; ?>);">Delete</div>
                </div>
                <ul>
                    <li><label>Job Type </label><p>: <?php echo $job_type; ?></p></li>
                    <li><label>Originals</label><p>: <?php echo $plot['origininals']; ?></p></li>
                    <li><label>Prints of Each</label><p>: <?php echo $plot['print_ea']; ?></p></li>
                    <li><label>Size</label><p>: <?php echo $plot['size']; ?></p></li>
                    <li><label>Output</label><p>: <?php echo $plot['output']; ?></p></li>
                    <li><label>Media</label><p>: <?php echo $plot['media']; ?></p></li>
                    <li><label>Binding</label><p>: <?php echo $plot['binding']; ?></p></li>
                    <li><label>Folding</label><p>: <?php echo $plot['folding']; ?></p></li>
                </ul>

                <div style="width: 100%;float: left;margin-top: 5px;">
                    <div style="float: left;width: 100%;margin-top: 5px;font-weight: bold;">File Options</div>
                    <?php
                    if ($file_upload_exist[0]['job_id'] != '') {
                        ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Upload File</div>
                            <div style="float: left;width: 100%;"><?php echo $file_upload_exist[0]['file_name']; ?></div>
                        </div>
                    <?php } elseif ($plot['ftp_link'] != '0') { ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Provide Link to File</div>
                            <div style="float: left;width: 100%;">FTP Link  : <?php echo $plot['ftp_link']; ?></div>
                            <div style="float: left;width: 100%;">User Name : <?php echo $plot['user_name']; ?></div>
                            <div style="float: left;width: 100%;">Password  : <?php echo $plot['password']; ?></div>
                        </div>
                    <?php } elseif ($plot['pick_up'] != '0') { ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Schedule a pick up</div>
                            <div style="float: left;width: 100%;">Pickup Date : <?php echo $plot['pick_up']; ?></div>
                            <div style="float: left;width: 100%;">Pickup Time  : <?php echo $plot['pick_up_time']; ?></div>
                        </div>
                    <?php } elseif ($plot['drop_off'] != '0') { ?>
                        <div style="float: left;width: 100%;">
                            <div style="float: left;width: 100%;text-decoration: underline;">Drop off at Soho Repro</div>                       
                            <div style="float: left;width: 100%;">Drop off at : <?php echo $plot['drop_off']; ?></div>
                        </div>   
                    <?php } ?>
                </div>

                <div style="width: 100%;float: left;margin-top: 7px;">                    
                    <div style="float: left;width: 100%;margin-top: 5px;font-weight: bold;">Special Instructions</div>
                    <div style="float: left;width: 100%;">                        
                        <div style="float: left;width: 100%;"><?php echo $plot['spl_instruction']; ?></div>
                    </div> 
                </div>

            </div>
        </div>
        <?php
        $i++;
    }
    ?>
    <div class="serviceOrderSetHolder">
        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
            Job Options - Option <?php echo $count_option; ?> 
            <div style="float:right;font-weight: bold;">&nbsp;</div>
        </label>  
        <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
            <div class="serviceOrderSetWapperInternal">
                <div class="serviceOrderSetDIV">
                    <div style="width: 100%;float: left;padding-top: 10px;">  

                        <!--Check Box Start-->
                        <div style="float:left;width:100%;">
                            <ul class="arch_radio">
                                <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" value="1" checked="checked" /><span style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
                                <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" /><span style="font-size: 13px;padding-left: 7px;font-weight: bold;">ARCHITECTURAL COPIES</span></li>
                            </ul>
                            <span id="errmsg"></span>
                        </div>
                        <!--Check Box End-->

                        <!--Originals Start-->
                        <div>
                            <label>
                                Originals
                            </label>
                            <input class="order_0_set1_0_original k-input kdText " style="width:65px;" id="original" name="original" type="text" value="" />
                        </div>
                        <!--Originals End-->

                        <!--POE Start-->
                        <div>
                            <label>
                                Prints of Each<span style="color: red;">*</span>
              <!--                                  <span style="font-weight:bold;color:#cc0000">
                                  *
                                </span>-->
                            </label>
                            <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;" id="print_ea" name="print_ea" type="text" value="" />
                        </div>
                        <!--POE End-->

                        <!--Size Start-->
                        <div>
                            <label>
                                Size<span style="color: red;">*</span>
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_size kdSelect" style="width: 135px;" id="size" name="size" onchange="return custome_size();">                            
                                        <option value="FULL">FULL</option>
                                        <option value="HALF">HALF</option>
                                        <option value="Reduce to 11 X 17">Reduce to 11 X 17</option>
                                        <option value="Custom">Custom</option>                          
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Size End-->

                        <!--Output Start-->
                        <div>
                            <label>
                                Output<span style="color: red;">*</span>
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_output kdSelect " style="width: 90px;" id="output" name="output" onchange="return custome_output();">
                                        <option value="B/W">B/W</option>
                                        <option value="Color">Color</option>
                                        <option value="Both">Both</option>
                                    </select>

                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Size End-->

                        <!--Media Start-->
                        <div>
                            <label>
                                Media<span style="color: red;">*</span>
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_media kdSelect " style="width: 100px;" id="media" name="media">
                                        <option value="Bond">Bond</option>
                                        <option value="Vellum">Vellum</option>
                                        <option value="Mylar">Mylar</option>                          
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Media End-->

                        <!--Binding Start-->
                        <div>
                            <label>
                                Binding
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_binding kdSelect " style="width: 80px;" id="binding" name="binding">
                                        <option value="none">None</option>                                      
                                        <option value="Bind All">Bind All</option>                          
                                        <option value="Bind by Discipline">Bind by Discipline</option>
                                        <option value="Screw Post">Screw Post</option>
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Binding End-->

                        <!--Folding Start-->
                        <div>
                            <label>
                                Folding
                            </label>
                            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                                <div style="float:left;margin-right:0px;">
                                    <select class="order_0_set1_0_folding kdSelect " style="width: 100px;" id="folding" name="folding">
                                        <option value="none">None</option>
                                        <option value="Yes">Yes</option>                          
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Folding End-->
                    </div>
                    <!--Custom Details Start-->
                    <div id="size_custom_div" style="border: 1px #FF7E00 solid;width: 30%;padding: 5px;margin: auto;margin-left: 145px;display: none;">
                        <label>Please Specify Custom Details : </label><textarea name="size_custom" id="size_custom" rows="3" cols="18" style="width: 201px;" placeholder="Custom Size"></textarea>
                    </div>
                    <!--Custom Details End-->
                    <!--Page Number Details Start-->
                    <div id="output_both_div" style="border: 1px #FF7E00 solid;width: 55%;padding: 5px;margin-left: 247px;display: none;">
                        <label>Enter page numbers that are in COLOR (separated by a comma) :</label>
                        <input type="text" name="output_both" id="output_both" style="width: 200px;" />
                    </div>
                    <!--Page Number Details End-->

                    <div style="width:730px;border-bottom: 1px solid #CCCCCC;float: left;">
                        <label style="font-weight: bold;height:28px">
                            File Options<span style="color: red;">*</span>
                        </label>
                        <input type="checkbox"  style="display: none;width: 2%;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set('1');" />
                        <div class="check" style="width:730px;border-top: 1px solid #FF7E00;margin-top:-13px;">
                            <div class="spl_option" style="float: 100%;">
                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="drop_file"  type="radio" onclick="return upload_soho();" />
                                    <label for="drop" >
                                        Upload File
                                    </label>                    
                                </div>

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="link"  type="radio" onclick="return provide_link();" />
                                    <label for="drop" >
                                        Provide Link to File
                                    </label>                    
                                </div>   

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="pickUp" id="pick"  type="radio" onclick="return show_date_picker();" />
                                    <label for="pick" >
                                        Schedule a pick up
                                    </label></br>
                                    <?php
                                    $all_days_off = AllDayOff();
                                    foreach ($all_days_off as $days_off_split) {
                                        $all_days_in[] = $days_off_split['date'];
                                    }
                                    $all_date = implode(",", $all_days_in);
                                    $all_date_exist = str_replace("/", "-", $all_date);
                                    ?>

                                </div>

                                <div>
                                    <input class="filetrigger" name="alt_file_option" value="dropOff" id="dropoff"  type="radio" onclick="return drop_sohorepro();" />
                                    <label for="drop" >
                                        Drop off at Soho Repro
                                    </label>                    
                                </div>                               
                            </div>
                            <br>

                            <!--File Upload Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="up_form">
                                <input type="hidden" name="uploadedfile" id="uploadedfile" value="1" /> 
                                <div id="dragandrophandler">Drag & Drop Files Here</div>
                                <br><br>
                                <div id="status1"></div> 
                            </div>
                            <!--File Upload Details End-->

                            <!--FTP Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="provide_link">
                                <div style="margin: auto;width: 60%;">
                                    <div style="margin: auto;width: 60%;float:right;">
                                    <!--<textarea name="provide_link" id="provide_link_text" rows="3" cols="18" style="width: 201px;"></textarea>-->
                                        <input type="text" name="ftp_link" id="ftp_link" placeholder="FTP Link" />
                                        <input type="text" name="user_name" id="user_name" placeholder="User Name" />
                                        <input type="text" name="password" id="pass_word" placeholder="Password" />
                                    </div>
                                    <div style="margin: auto;width: 60%;float:right;padding-top: 5px;">
                                        <span>If providing an FTP link, please include username and password.</span>
                                    </div>
                                </div>   
                            </div>
                            <!--FTP Details Start-->

                            <!--Pickup Details Start-->
                            <div id="date_time" style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;float: left;width: 30%;padding-bottom: 10px;display:none;">
                                <div style="width: 100%;">
                                    <input style="margin-left: 75px;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" name="ready_now" value="READY NOW" id="ready_now" onclick="return ready_now();" />
                                </div>                      

                                <div style="border: 1px #CCC solid;width: 95%;margin-left: 5px;margin-bottom: 10px;"></div>

                                <div style="padding: 5px;">
                                    <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
                                    <input type="text" name="date_for_alt" id="date_for_alt" style="width: 30%;margin-left: 5px;" class="date_for_alt picker_icon" onclick="date_revele();" />                        

                                    <input id="time_for_alt" type="text" style="width: 30%;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" />
                                </div>                        
                            </div>
                            <!--Pickup Details End-->

                            <!--Drop off Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off">
                                <div style="margin: auto;width: 60%;">
                                    <div style="margin: auto;width: 75%;float:right;">
                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broom" />381 Broom
                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                                    <!-- <select id="drop_val">
                                            <option value="" selected="selected">Select</option>
                                            <option value="381 Broom">381 Broome St</option>
                                            <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                        </select> -->
                                    </div>                             
                                </div>   
                            </div>
                            <!--Drop off Details End-->

                        </div>

                        <!--Special Instruction Start-->
                        <div style="float: left;width: 100%;">
                            <div id="sp_inst" style="margin-top:10px;">
                                <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                                    Special Instructions
                                </label>
                                <br>
                                <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"><?php echo $entered['spl_instruction']; ?></textarea>
                            </div>
                        </div>
                        <!--Special Instruction End-->
                    </div>
                </div>

            </div>  
        </div>
    </div>
    <?php
}
?>

<script src="js/new_set_script.js"></script>