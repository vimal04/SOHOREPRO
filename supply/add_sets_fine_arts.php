<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);
?>

<?php
if ($_POST['add_fine_arts_services'] == '1') {

    $user_id_add_set = $_SESSION['sohorepro_userid'];
    $company_id_view_plot = $_SESSION['sohorepro_companyid'];

    $original = $_POST['original'];
    $print_ea = $_POST['print_ea'];
    $size = $_POST['size'];
    $output = $_POST['output'];
    $order_0_set1_0_media = $_POST['order_0_set1_0_media'];


    $size_custom = ($_POST['size_custom'] != '') ? $_POST['size_custom'] : '0';
    $output_both = ($_POST['output_both'] != '') ? $_POST['output_both'] : '0';

    $dropoff_val = $_POST['dropoff_val'];
    $ftp_link_val = $_POST['ftp_link_val'];
    $user_name_val = $_POST['user_name_val'];
    $pass_word_val = $_POST['pass_word_val'];

    $time_for_alt = ($_POST['time_for_alt'] != '') ? $_POST['time_for_alt'] : '0';
    $date_for_alt = ($_POST['date_for_alt'] != '') ? $_POST['date_for_alt'] : '0';

    $special_instruction = $_POST['special_instruction'];

    $query = "INSERT INTO sohorepro_fine_arts_sets
			SET     original        = '" . $original . "',
                                poe             = '" . $print_ea . "',
                                size            = '" . $size . "',  
                                output          = '" . $output . "',
                                media           = '" . $order_0_set1_0_media . "',
                                size_custom     = '" . $size_custom . "',    
                                output_both     = '" . $output_both . "',
                                dropoff_val     = '" . $dropoff_val . "',
                                ftp_link_val    = '" . $ftp_link_val . "',
                                user_name_val   = '" . $user_name_val . "',
                                pass_word_val   = '" . $pass_word_val . "',
                                pick_up         = '" . $date_for_alt . "', 
                                pick_up_time    = '" . $time_for_alt . "',
                                special_instruction =   '" . $special_instruction . "',
                                company_id      = '" . $company_id_view_plot . "',
                                user_id         = '" . $user_id_add_set . "' ";

    $sql_result = mysql_query($query);

    $enteredFineSets = EnteredPlotttingFineArts($company_id_view_plot, $user_id_add_set);

    $count_option = count($enteredFineSets) + 1;

    $i = 1;
    foreach ($enteredFineSets as $plot) {
        ?>

        <div style="float: left;width: 100%;border: 1px solid #FF7E00;margin-bottom: 10px;">
            <div style="float: left;width: 100%;margin-bottom: 10px;">
                <div style="float: left;width: 48%;text-align: left;margin-top: 10px;margin-left: 10px;font-weight: bold;">
                    Job Option - <?php echo $i; ?>
                </div>
                <div style="float: left;width: 48%;text-align: right;margin-top: 10px;margin-left: 10px;cursor: pointer;">
                    <span style="background: #D84B36;color: #FFF;padding: 2px 8px;border-radius: 5px;margin-top: 3px;font-weight: bold;">Delete</span>
                </div>
            </div>
            <div style="float: left;width: 98%;margin-left: 8px;">
                <ul>
                    <li><label>Originals:</label><?php echo $plot['original']; ?></li>
                    <li><label>Prints of Each:</label><?php echo $plot['poe']; ?></li>
                    <li><label>Size:</label><?php echo $plot['size']; ?></li>
                    <li><label>Output:</label><?php echo $plot['output']; ?></li>
                    <li><label>Media:</label><?php echo $plot['media']; ?></li>

                    <?php
                    if ($plot['size_custom'] != '0') {
                        ?>
                        <li><label>Custom Size:</label><?php echo $plot['size_custom']; ?></li>
                        <?php
                    }
                    ?>

                    <?php
                    if ($plot['output_both'] != '0') {
                        ?>
                        <li><label>Output Both:</label><?php echo $plot['output_both']; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div style="float: left;width: 100%;margin-bottom: 10px;">
                <div style="float: left;width: 48%;text-align: left;margin-top: 10px;margin-left: 10px;font-weight: bold;">
                    File Options
                </div>
                <div style="float: left;width: 48%;text-align: right;margin-top: 10px;margin-left: 10px;cursor: pointer;">
                    <!--<span style="background: #D84B36;color: #FFF;padding: 2px 8px;border-radius: 5px;margin-top: 3px;font-weight: bold;">Delete</span>-->
                </div>
            </div>
            <?php
            if ($plot['dropoff_val'] != '0') {
                ?>
                <div style="float: left;width: 100%;margin-left: 15px;">
                    <div style="float: left;width: 100%;text-decoration: underline;">Drop off at Soho Repro</div>                       
                    <div style="float: left;width: 100%;margin-bottom: 10px;">Drop off at : 381 Broome Street</div>
                </div>
            <?php } ?>

            <?php
            if ($plot['ftp_link_val'] != '0') {
                ?>
                <div style="float: left;width: 100%;margin-left: 15px;">
                    <div style="float: left;width: 100%;text-decoration: underline;">Provide Link to File</div>
                    <div style="float: left;width: 100%;">FTP Link  : <?php echo $plot['ftp_link_val']; ?></div>
                    <div style="float: left;width: 100%;">User Name : <?php echo $plot['user_name_val']; ?></div>
                    <div style="float: left;width: 100%;">Password  : <?php echo $plot['pass_word_val']; ?></div>
                </div>
            <?php } ?>

            <?php
            if (($plot['pick_up'] != '0') && ($plot['pick_up_time'] != '0')) {
            if (($plot['pick_up'] == 'ASAP') && ($plot['pick_up_time'] == 'ASAP')) {
                ?>
                <div style="float: left;width: 100%;margin-left: 15px;">
                    <div style="float: left;width: 100%;">Schedule a pick up Date/Time: <?php echo $plot['pick_up']; ?></div>                   
                </div>
                <?php
            } else {
                ?>
                <div style="float: left;width: 100%;margin-left: 15px;">
                    <div style="float: left;width: 100%;margin-bottom: 10px;">Schedule a pick up Date/Time: <?php echo $plot['pick_up'] . '&nbsp;' . $plot['pick_up_time']; ?></div>           
                </div>
            <?php } } ?>

            <?php if ($plot['special_instruction'] != '') { ?>
                <div style="float: left;width: 100%;margin-bottom: 10px;">
                    <div style="float: left;width: 48%;text-align: left;margin-top: 10px;margin-left: 10px;font-weight: bold;">
                        Special Instructions
                    </div>
                    <div style="float: left;width: 48%;text-align: right;margin-top: 10px;margin-left: 10px;cursor: pointer;">
                        <!--<span style="background: #D84B36;color: #FFF;padding: 2px 8px;border-radius: 5px;margin-top: 3px;font-weight: bold;">Delete</span>-->
                    </div>
                </div>

                <div style="float: left;width: 100%;margin-left: 15px;">
                    <div style="float: left;width: 100%;"><?php echo $plot['special_instruction']; ?></div>
                </div>
            <?php } ?>            

        </div>

        <?php
        $i++;
    }
    ?>
    <div class="serviceOrderSetHolder">
        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
            Job Options 
            <div style="float:right;font-weight: bold;">
                Option - <?php echo $count_option; ?>                          
            </div>
            <input type="hidden" name="optint_count_check" id="optint_count_check" value="0" />
        </label>  
        <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
            <div class="serviceOrderSetWapperInternal">
                <div class="serviceOrderSetDIV">
                    <div style="width: 100%;float: left;padding-top: 10px;">  

                        <!--Check Box Start-->
                        <div style="float:left;width:100%;">
                            <!--                                    <ul class="arch_radio">
                                                                    <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
                                                                    <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" onclick="return active_arch();" /><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">ARCHITECTURAL COPIES</span></li>
                                                                </ul>-->
                            <span id="errmsg"></span>
                        </div>

                        <!--Originals Start-->
                        <div>
                            <label>
                                Originals
                            </label>
                            <input class="order_0_set1_0_original k-input kdText " style="width:50px;height: 23px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                            <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;height: 23px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
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
                                        <!--                                            <option value="HALF">HALF</option>-->
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
                                        <option value="Color">Color</option>
                                        <option value="B/W">B/W</option>                                        
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
                                    <select class="order_0_set1_0_media kdSelect " style="width:150px;" id="order_0_set1_0_media" name="order[0][set1][0][media]">
                                        <option selected="selected" value="Arches Water Color">Arches Water Color</option>
                                        <option value="Canvas">Canvas</option>
                                        <option value="Archival Photo Matte">Archival Photo Matte</option>
                                        <option value="Archival Photo Luster">Archival Photo Luster</option>
                                    </select>
                                </div>
                                <div class="dropdown_selector">
                                </div>
                            </div>
                        </div>
                        <!--Media End-->

                    </div>
                    <!--Custom Details Start-->
                    <div id="size_custom_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                        <label style="font-weight: bold;">Please Specify Custom Details : </label><textarea name="size_custom" id="size_custom" rows="3" cols="18" style="width: 201px;" placeholder="Custom Size"></textarea>
                    </div>
                    <!--Custom Details End-->
                    <!--Page Number Details Start-->
                    <div id="output_both_div" style="border: 1px #FF7E00 solid;width: 100%;padding: 5px;text-align: center;margin-bottom: 10px;display: none;">
                        <label style="font-weight: bold;">Enter page numbers that are in COLOR (separated by a comma) :</label>
                        <input type="text" name="output_both" id="output_both" style="width: 200px;" placeholder="Enter page numbers" />
                    </div>
                    <!--Page Number Details End-->

                    <div style="width:730px;border-bottom: 1px solid #CCCCCC;float: left;">
                        <label id="alt_ops" style="font-weight: bold;height:28px">
                            File Options<span style="color: red;">*</span>
                        </label>

                        <label id="pick_ops" style="font-weight: bold;height:28px;display: none;">
                            Pickup Options<span style="color: red;">*</span>
                        </label>
    <!--                    <input type="checkbox"  style="display: none;width: 2%;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set('1');" />-->
                        <div id="options_plott" class="check" style="width:775px;border-top: 1px solid #FF7E00;margin-top:-13px;">
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
                                        Drop off at Soho Repro - 381 Broome Street
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
                                    <!--<span>If providing an FTP link, please include username and password.</span> -->
                                    </div>
                                </div>   
                            </div>
                            <!--FTP Details Start-->

                            <!--Pickup Details Start-->

                            <div id="date_time" style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 5px;margin-top: 10px;display:none;">
                                <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />                                
                                <div style="width: 34%;float: left;margin-right: 6px;margin-bottom: 0px;"> 

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;border-bottom: 0px;text-align: center;margin-bottom: 0px;">
                                        <span id="asap_status" class="asap_orange" onclick="return asap();">READY NOW</span>
                                    </div>

                                    <div style="width: 100%;float: left;border: 1px #F99B3E solid;padding: 6px;height: 30px;">
                                        <input class="date_for_alt picker_icon" value="" type="text" name="date_needed" id="date_for_alt" style="width: 75px;" onclick="return date_reveal();" />
                                        <input id="time_for_alt" value="" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
                                    </div>

                                </div>
                                <div style="width: 60%;float: left;border: 1px #F99B3E solid;margin-left: 20px;height: 85px;">
                                    <div style="float: left;width: 45%;margin-left: 30px;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" value="my_office" />My Office
                                    </div>
                                    <div style="float: left;width: 40%;border: 0px #F99B3E solid;margin-top: 30px;">
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="alternate();" id="alternate" value="alternate" />Alternative
                                        <select  name="address_book_se" id="address_book_se" class="remove_current" style="" onchange="return select_alternate();">
                                            <option value="0">Address Book</option>
                                            <?php
                                            $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                            foreach ($address_book as $address) {
                                                ?>                                                                                        
                                                <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!--Pickup Details End-->

                            <!--Drop off Details Start Plotting -->
                            <!--                      <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 100%;padding-bottom: 10px;" id="drop_off">
                                                    <div style="margin: auto;width: 60%;">
                                                        <div style="margin: auto;width: 75%;float:right;">
                                                            <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broome Street" />381 Broome Street
                                                            <input style="width: 10% !important;margin-left: 35px !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
                                                         <select id="drop_val">
                                                                <option value="" selected="selected">Select</option>
                                                                <option value="381 Broom">381 Broome St</option>
                                                                <option value="307 7th Ave, 5th Floor" >307 7th Ave, 5th Floor</option>
                                                            </select> 
                                                        </div>                            
                                                    </div>   
                                                  </div>-->
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
                                    <input class="filetrigger" name="alt_file_option" value="1" id="dropoff"  type="radio" onclick="return drop_sohorepro_arch();" />
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

                        <div style="width: 775px;float:left;border-top: 1px solid #FF7E00;margin-top: 10px;">

                        </div>  
                        <!--Special Instruction Start-->
                        <input type="hidden" name="validate_imp" id="validate_imp" value="" />
                        <div style="float: left;width: 100%;margin-top: 15px;">
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