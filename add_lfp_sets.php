<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);


if ($_POST['service_lfp_add'] == '1') {

    $user_id_add_set = $_SESSION['sohorepro_userid'];
    $company_id_view_plot = $_SESSION['sohorepro_companyid'];

    $job_reference = strtoupper($_POST['reference']);
    $original = $_POST['original'];
    $print_ea = $_POST['print_ea'];
    $size = strtoupper($_POST['size']);
    $size_custom = strtoupper($_POST['size_custom']);
    $output = strtoupper($_POST['output']);
    $output_both = strtoupper($_POST['output_both']);
    $media = strtoupper($_POST['media']);
    $binding = strtoupper($_POST['binding']);
    $special_instruction = $_POST['special_instruction'];
    
    if($_SESSION['use_the_same'] != ''){
    $drop_file          =   $_SESSION['upload_file'];    
    $ftp_link           =   $_SESSION['ftp_link'];
    $ftp_user           =   $_SESSION['user_name'];
    $ftp_pass           =   $_SESSION['password'];
    $schedule_pickup    =   $_SESSION['schedule_pickup'];
    $schedule_place     =   $_SESSION['schedule_place'];
    $dropoff            =   $_SESSION['drop_off_381'];
    }  else {
    $drop_file          = $_POST['drop_file'];    
    $ftp_link           = $_POST['ftp_link'];
    $ftp_user           = $_POST['ftp_user'];
    $ftp_pass           = $_POST['ftp_pass'];
    $schedule_pickup    = $_POST['schedule_pickup_dt'];
    $schedule_place     = $_POST['schedule_place'];
    $dropoff            = $_POST['dropoff'];
    $use_same_alt       = '0';  
    }
    
    

    $add_ml_val = $_POST['add_ml_val'];
    $original_lam = $_POST['original_lam'];
    $mount_lam = $_POST['mount_lam'];
    $mounting_select = $_POST['mounting_select'];
    $lamination_select = $_POST['lamination_select'];
    $width_values = $_POST['width_values'];
    $length_values = $_POST['length_values'];
    $grommets = $_POST['grommets'];
    $ml_splins = $_POST['ml_splins'];

    $sql_option_id = mysql_query("SELECT option_id FROM sohorepro_service_lfp WHERE company_id = '" . $company_id_view_plot . "' AND user_id = '" . $user_id_add_set . "' AND order_id = '0' ORDER BY option_id DESC LIMIT 1");
    $object_option = mysql_fetch_assoc($sql_option_id);

    if (count($object_option['option_id']) > 0) {
        $option_id = ($object_option['option_id'] + 1);
    } else {
        $option_id = '1';
    }

    $query = "INSERT INTO sohorepro_service_lfp
			SET     company_id               = '" . $company_id_view_plot . "',
                                user_id                  = '" . $user_id_add_set . "',
                                option_id                = '" . $option_id . "',
                                original                 = '" . $original . "',
                                print_of_each            = '" . $print_ea . "', 
                                size                     = '" . $size . "', 
                                size_custom              = '" . $size_custom . "', 
                                output                   = '" . $output . "', 
                                output_both_page         = '" . $output_both . "', 
                                media                    = '" . $media . "', 
                                binding                  = '" . $binding . "', 
                                upload_file              = '" . $drop_file . "',
                                ftp_link                 = '" . $ftp_link . "',
                                ftp_user_name            = '" . $ftp_user . "',    
                                ftp_password             = '" . $ftp_pass . "',
                                schedule_pickup          = '" . $schedule_pickup . "',
                                schedule_place           = '" . $schedule_place . "',
                                drop_off_381             = '" . $dropoff . "',
                                use_same_alt             = '" . $use_same_alt . "',
                                special_inc              = '" . $special_instruction . "',
                                reference                = '" . $job_reference . "',
                                ml_active                = '" . $add_ml_val . "',
                                ml_originals             = '" . $original_lam . "',    
                                ml_type                  = '" . $mount_lam . "',
                                ml_mounting              = '" . $mounting_select . "',
                                ml_laminating            = '" . $lamination_select . "',    
                                ml_width                 = '" . $width_values . "',
                                ml_length                = '" . $length_values . "',
                                ml_grommets              = '" . $grommets . "',    
                                mal_splns                = '" . $ml_splins . "' ";
    $sql_result = mysql_query($query);
    
    if($sql_result){
                                $_SESSION['upload_file']        =   '';
                                $_SESSION['ftp_link']           =   '';
                                $_SESSION['user_name']          =   '';
                                $_SESSION['password']           =   '';

                                $_SESSION['schedule_pickup']    =   '';
                                $_SESSION['schedule_place']     =   '';
                                $_SESSION['drop_off_381']       =   '';

                                $_SESSION['use_the_same']       =   '';
    }
    
    $_SESSION['ref_val'] = $_POST['reference'];

    $enteredLFPPrimay = EnteredLFPPrimary($company_id_view_plot, $user_id_add_set);

    $count_option = count($enteredLFPPrimay) + 1;
    
    
    $added_cart_count_pre       =    (count($enteredLFPPrimay) > 0) ? "1" : "0";
    $added_cart_count_session         =    ($_SESSION['cart_count'] != "") ? ($_SESSION['cart_count'] + 1) : "0";
    
    
    $enteredPlotPrimay = EnteredPlotttingPrimary($company_id_view_plot, $user_id_add_set);
    $enteredFineSets = EnteredPlotttingFineArts($company_id_view_plot, $user_id_add_set);
//    if($_SESSION['cart_count'] == ""){
//        
//    }
//    
//    
//    $lower_boundary             =    "1";
//    $upper_boundary             =    "2";
//    
//    if (($added_cart_session >= $lower_boundary) && ($added_cart_session <= $upper_boundary)) {
//        $added_cart_count_session = "2";
//    }
    
//    $added_cart_count_session_p =    ($added_cart_count_pre + $added_cart_session);  
//    $added_cart_count_session   =    ($added_cart_count_session_p > "2") ? "2" : "1";
//        $added_cart_count_session     =     "1";    
    
//    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
//        $added_cart_count_session     =     "3";      
//    }else if ((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1"))  {
//        $added_cart_count_session     =     "2";    
//    }else{
//        $added_cart_count_session     =     "1";      
//    }
//    
//    
//    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
//    $_SESSION['cart_count']     =     "3";      
//    }else if ((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1"))  {
//    $_SESSION['cart_count']     =     "2";    
//    }else{
//    $_SESSION['cart_count']     =     "1";      
//    }
    

    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_count_session     =     "3";      
    }elseif ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $added_cart_count_session = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_count_session = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $added_cart_count_session = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $added_cart_count_session = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $added_cart_count_session = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $added_cart_count_session = "1";
    } 

    
    if((count($enteredLFPPrimay) >= "1") && (count($enteredPlotPrimay)>= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count']     =     "3";      
    }else if ((count($enteredPlotPrimay) >= "1") && (count($enteredLFPPrimay) >= "1")) {
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredPlotPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif((count($enteredLFPPrimay) >= "1") && (count($enteredFineSets) >= "1")){
        $_SESSION['cart_count'] = "2";
    }elseif (count($enteredLFPPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredPlotPrimay) >= "1") {
        $_SESSION['cart_count'] = "1";
    }elseif (count($enteredFineSets) >= "1") {
        $_SESSION['cart_count'] = "1";
    } 
    
    
    $i = 1;
    foreach ($enteredLFPPrimay as $lfp) {
        ?>
        <div class="plot_container" style="width: 860px;float: left;border: 1px #FF7E00 solid;margin-bottom: 20px;">
            <div class="lfp_sets_header">
                <div class="left">
                    Job Option - <?php echo $i; ?>
                </div>
                <div class="right">
                    <span class="lfp_delete_button">DELETE</span>
                </div>
            </div>

            <div class="lfp_sets_body">
                <ul>
                    <li>
                        <label>Originals:</label><?php echo $lfp['original']; ?>
                    </li>
                    <li>
                        <label>Prints of Each:</label><?php echo $lfp['print_of_each']; ?>
                    </li>
                    <li>
                        <label>Size:</label><?php echo $lfp['size']; ?>
                    </li>
                    <?php if ($lfp['size_custom'] != '0') { ?>
                        <li>
                            <label>Custom Size Details:</label><?php echo $lfp['size_custom']; ?>
                        </li>
                    <?php } ?>
                    <li>
                        <label>Output:</label><?php echo $lfp['output']; ?>
                    </li>
                    <?php if ($lfp['output_both_page'] != '0') { ?>
                        <li>
                            <label>Color Page Number:</label><?php echo $lfp['output_both_page']; ?>
                        </li>
                    <?php } ?>
                    <li>
                        <label>Media:</label><?php echo $lfp['media']; ?>
                    </li>
                    <li>
                        <label>Binding:</label><?php echo $lfp['binding']; ?>
                    </li>
                </ul>                        
            </div>

            
            <?php
            if ($lfp['ftp_link'] != '0') {
                $ftp_link = ($lfp['ftp_link'] != "0") ? $lfp['ftp_link'] : "";
                $ftp_user = ($lfp['ftp_user_name'] != "0") ? $lfp['ftp_user_name'] : "";
                $ftp_pass = ($lfp['ftp_password'] != "0") ? $lfp['ftp_password'] : "";
                ?>
                <div class="file_option">
                File Options:
                </div>
                <div class="file_option_content">
                    Provide Link to File:
                </div>
                <div class="file_option_content_source">
                    FTP Link: <?php echo $ftp_link . '<br>'; ?>
                    User Name: <?php echo $ftp_user . '<br>'; ?>
                    Password: <?php echo $ftp_pass . '<br>'; ?>
                </div>
            <?php } ?>   
            <?php
            if ($lfp['schedule_pickup'] != '0') {
                ?>
                <div class="file_option">
                    File Options:
                </div>
                <div class="file_option_content_sc_pick">
                    Schedule a pick up Date/Time: <?php echo $lfp['schedule_pickup']; ?>
                </div>            
            <?php
            if ($lfp['schedule_place'] != '0') {

                $address_dtls = SelectLastEnteredAddress($lfp['schedule_place']);
                $address_2 = ($address_dtls[0]['address_2'] != '') ? $address_dtls[0]['address_2'] . '<br>' : '';
                $address_3 = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'] . '<br>' : '';
                $address_string = $address_dtls[0]['company_name'] . '<br>' . $address_dtls[0]['address_1'] . '<br>' . $address_2.$address_3.$address_dtls[0]['city'] . ',&nbsp;' . StateName($address_dtls[0]['state']) . '&nbsp;' . $address_dtls[0]['zip'];

                $option_sechdule = ($lfp['schedule_place'] == 'my_office') ? '<span style="font-weight: bold">My Office</span>' : '<span style="font-weight: bold">Alternate:</span><br>' . $address_string;
                ?>
<!--                <div class="file_option">
                    File Options:
                </div>-->
                <div style="width: 95%;margin: auto;margin-top: 7px;margin-bottom: 95px;">                    
                    <div style="float: left;width: 22%;margin-top: 5px;font-weight: bold;">Schedule a pick-up Option:</div>
                    <div style="float: left;width: 50%;margin-top: 5px;">                        
                        <div style="float: left;width: 100%;margin-bottom: 10px;"><?php echo $option_sechdule; ?></div>
                    </div> 
                </div>
            <?php } } ?>
             <?php
            if ($lfp['drop_off_381'] != '0') {               
                ?>           
                <div class="file_option">
                    File Options:
                </div>
                <div class="file_option_content_source">
                    Drop off at Soho Repro: <?php echo $lfp['drop_off_381']; ?>                    
                </div>
            <?php } ?>
            
            <?php
            if ($lfp['special_inc'] != '0') {               
                ?>           
                <div class="file_option">
                    Special Instructions:
                </div>
                <div class="file_option_content_source">
                    <?php echo $lfp['special_inc']; ?>                    
                </div>
            <?php } ?>
             <?php
            if ($lfp['ml_active'] != '0') {               
                ?>   
            <div class="ml_container border_gle_ml">
                <div class="ml_header">Mounting / Laminating:</div>
                
                <div class="lfp_sets_ml_body">
                <ul>
                    <li>
                        <label>Originals:</label><?php echo $lfp['ml_originals']; ?>
                    </li>
                    <li>
                        <?php
                        if($lfp['ml_type'] == "M"){
                            $type_ml        =   "Mounting";    
                        }elseif ($lfp['ml_type'] == "L") {
                            $type_ml        =   "Laminating";           
                        }elseif ($lfp['ml_type'] == "Both") {
                            $type_ml        =   "Both";         
                        }
                        ?>
                        <label>Type:</label><?php echo $type_ml; ?>
                    </li>
                    <?php
                    if($lfp['ml_mounting'] != "none"){
                    ?>
                    <li>
                        <label>Mounting:</label><?php echo $lfp['ml_mounting']; ?>
                    </li>
                    <?php 
                    }
                    ?>
                    <?php
                    if($lfp['ml_laminating'] != "none"){
                    ?>
                    <li>
                        <label>Lamination:</label><?php echo $lfp['ml_laminating']; ?>
                    </li>
                    <?php 
                    }
                    ?>
                    <li>
                        <label>Dimensions:</label><?php echo "Width:&nbsp;".$lfp['ml_width'].'&nbsp;&nbsp;Length:&nbsp;'.$lfp['ml_length']; ?>
                    </li>
                    <li>
                        <label>Grommets:</label><?php echo $lfp['ml_grommets']; ?>
                    </li>
                    <?php
                    if($lfp['mal_splns'] != ""){
                    ?>
                    <li>
                        <label>Special Instructions:</label><?php echo $lfp['mal_splns']; ?>
                    </li>                 
                    <?php } ?>
                </ul>
                </div>                
            </div>
            <?php } ?>
        </div>
        <?php
        $i++;
    }
    ?>
    <!--New Job Add Start -->
    <div class="serviceOrderSetHolder">
        <label style="font-weight: bold; margin-bottom: 0px; margin-top: 0px;" for="jo1" class="optional">
            Job Options - <?php echo $count_option; ?>            
<!--            <div style="float:right;font-weight: bold;">
                Option                
            </div>-->
            <input type="hidden" name="optint_count_check" id="optint_count_check" value="0" />
            <input type="hidden" name="optint_count_check_i" id="optint_count_check_i" value="<?php echo $added_cart_count_session; ?>" />
        </label>  
        <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
            <div class="serviceOrderSetWapperInternal">
                <div class="serviceOrderSetDIV">
                    <div style="width: 880px;float: left;padding-top: 10px;margin-bottom: 0px !important;">  
                        
                        
                        <!--JASSIM-->                        
                        <input type="checkbox"  style="width: 2%;margin-bottom: 20px;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set();" /><span id="use_same_check_box_spn">Use the same File as in Job Option <?php echo ($count_option - 1); ?></span>
                        <!--End-->
                        
                        <!--Check Box Start-->
                        <div style="float:left;width:100%;">
                            <!--                                    <ul class="arch_radio">
                                                                    <li><input type="radio" name="plotting_check" id="plotting_check" style="width:2% !important;" value="1" onclick="return active_plot();" /><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">PLOTTING</span></li>
                                                                    <li><input type="radio" name="plotting_check" id="plotting_check_0" style="width:2% !important;" value="0" onclick="return active_arch();" /><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">ARCHITECTURAL COPIES</span></li>
                                                                </ul>-->
                            <span id="errmsg"></span>
                        </div>
                        <!--Check Box End-->

                        <!--Originals Start-->
                        <div>
                            <label>
                                Originals
                            </label>
                            <input class="order_0_set1_0_original" style="width:50px;padding: 3px;" id="original" name="original" type="text" value="" onkeyup="return not_allow_original();" />
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
                            <input class="ymlrequired order_0_set1_0_printOfEach k-input kdText " style="width:80px;padding: 3px;" id="print_ea" name="print_ea" type="text" value="" onkeyup="return not_allow_poe();" />
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
                                    <select class="order_0_set1_0_media kdSelect " style="width: 245px;" id="media" name="media">
                                        <option value="Bond Paper">Bond Paper</option>
                                        <option value="Heavy Weight Bond">Heavy Weight Bond</option>
                                        <option value="Satin Photo">Satin Photo</option>
                                        <option value="Gloss Photo">Gloss Photo</option>
                                        <option value="Transparency">Transparency</option>
                                        <option value="Self Adhesive Fabric">Self Adhesive Fabric</option>
                                        <option value="Stick 2, Polypropylene">Stick 2, Polypropylene</option>
                                        <option value="Banner / Scrim Vinyl">Banner / Scrim Vinyl</option>
                                        <option value="Vellum">Vellum</option>
                                        <option value="Mylar">Mylar</option>
                                        <option value="Bond">Bond</option>
                                        <option value="Presentation Bond - BW Laser Only">Presentation Bond - BW Laser Only</option>
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

                    <div style="">
                        
    <!--                    <input type="checkbox"  style="display: none;width: 2%;" name="use_same_check" id="use_same_check_box" value="1"  onclick="return use_same_set('1');" />-->
                        <div id="options_plott" class="check" style="width:860px;margin-bottom: 0px;">
                            <label id="alt_ops" style="font-weight: bold;height:15px;    border-bottom: 1px solid #FF7E00;">
                                File Options<span style="color: red;">*</span>
                            </label>
                            <div class="spl_option">
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
                      <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 99%;padding-bottom: 10px;" id="up_form">
                        <input type="hidden" name="uploadedfile" id="uploadedfile" value="" /> 
                        <div id="dragandrophandler">Drag & Drop Files Here</div>
                        <br><br>
                        <div id="status1"></div> 
                      </div>
                      <!--File Upload Details End-->

                            <!--FTP Details Start-->
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 99%;padding-bottom: 10px;" id="provide_link">
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
                            <?php
                            $all_days_off = AllDayOff();
                            foreach ($all_days_off as $days_off_split) {
                                $all_days_in[] = $days_off_split['date'];
                            }
                            $all_date = implode(",", $all_days_in);
                            $all_date_exist = str_replace("/", "-", $all_date);
                            ?>
                            <div id="date_time" style="width: 99%;float: left;border: 1px #F99B3E solid;padding: 5px;display:none;">
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
                                        <input style="width: 10% !important;" type="radio" name="my_office_alternate" onclick="my_office();" id="my_office" checked="checked" value="my_office" />My Office
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
                            <div style="padding-top: 10px;border: 1px #FF7E00 solid;margin-top: 7px;display:none;float: left;width: 99%;padding-bottom: 10px;" id="drop_off">
                                <div style="margin: auto;width: 60%;">
                                    <div style="margin: auto;width: 75%;float:right;">
                                        <input style="width: 10% !important;" type="radio" name="drop_val" id="drop_val" value="381 Broome Street" />381 Broome Street
                                        <input style="width: 10% !important;margin-left: 35px !important;" type="radio" name="drop_val" id="drop_val_1" value="307 7th Ave, 5th Floor" />307 7th Ave, 5th Floor
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
                            <div id="sp_inst" style="margin-top:10px;margin-bottom: 0px;">
                                <label style="font-weight: bold;margin-bottom: -4px; margin-top: -10px;">
                                    Special Instructions
                                </label>
                                <br>
                                <textarea name="special_instruction" class="splins" id="special_instruction" rows="4" cols="60" style="min-width: 370px;min-height: 60px;max-height: 60px;max-width: 370px;"><?php echo $entered['spl_instruction']; ?></textarea>
                            </div>
                        </div>
                        <!--Special Instruction End-->

                        <div class="border_gle" style="width: 100%;float: left;font-weight: bold;font-size: 13px;">&nbsp;</div>

                        <div id="add_mount_lam" class="" style="float:left;width: 775px;border: 0px solid #ccc;margin-bottom: 0px;">
                            <div style="float:left;width: 25%;padding: 5px;background-color: #EFEFEF;border-radius: 5px;border: 2px solid #000;padding: 10px;color: #000;font-weight: bold;margin-left: 5px;margin-top: 5px;">
                                <input type="checkbox" name="add_ml" id="add_ml" value="1" style="width: 15px;margin-bottom: 5px !important;margin-top: 5px !important;" onclick="return add_mount_lam();" />    
                                Add Mounting / Laminating
                            </div>
                        </div>                                                 

                        <div id="new_add_mount_form" style="display: none;">

                        </div>

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
            Job Options 
            <div style="float:right;font-weight: bold;">
                Option - <?php echo $count_option; ?>                          
            </div>
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

    <script src="js/new_set_script_lpf.js"></script>