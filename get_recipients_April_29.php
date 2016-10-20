<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);

// Reference Values
// 9 - Add New Recipients
// 8 - Delete Added Recipients
// 7 - Edit Added Recipients
// 6 - Update Added Recipients
// 
// 5 - Increase the Available Sets
// 4 - Decrease the Available Sets

if ($_POST['recipients'] == '1') {
    ?>
<div style="border: 1px #F99B3E solid;margin-bottom: 20px;padding-bottom: 20px;width: 100%;float: left;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT 1</div>
        <div style="float: right;width: 20%;font-weight: bold;cursor: pointer;" title="Delete Recipient" alt="Delete Recipient" onclick="return delete_recipient_empty();">Delete</div>

        <div style="float: left;width: 33%;margin-left: 30px;border: 1px #F99B3E solid;margin-top: 10px;font-weight: bold;">Send to :
            <select  name="address_book_rp" id="address_book_rp" style="width: 75% !important;" onchange="return show_address();">
                <option value="0">Address Book</option>
                <?php
                $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                foreach ($address_book as $address) {
                    ?>                                                                                        
                <option value="<?php echo $address['id']; ?>" ><?php echo $address['company_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <!-- Address Show Start -->
        <div id="show_address" style="float: left;width: 60%;border: 1px #F99B3E solid;margin-top: 10px;margin-left: 5px;height: 20px;font-weight: bold;">
            
        </div>
        <?php 
            $user_id_add_set      = $_SESSION['sohorepro_userid'];
            $company_id_view_plot = $_SESSION['sohorepro_companyid'];
        ?>
        <!-- Address Show End -->
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <div id="sets_grid_new">
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($company_id_view_plot, $user_id_add_set) : ArchSetsNeeded($company_id_view_plot, $user_id_add_set);
                         $plot_exist        = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1');
                         $copy_exist        = EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                    <?php
                    if(count($plot_exist) == ''){                        
                    ?>
                    <tr bgcolor="#ffeee1">
                        <td>Plotting on Bond</td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_8" id="avl_sets_8"  value="0" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl_plot('8','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','1');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_8" id="need_sets_8" value="0" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <?php
                    //if(count($copy_exist) == ''){
                    ?>
<!--                    <tr bgcolor="#fff6f0">
                        <td>Copies</td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_9" id="avl_sets_9"  value="0" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl_copies('9','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','0');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_9" id="need_sets_9" value="0" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>-->
                    <?php   
                    //}
                    ?>
                    <?php
                      $i++;
                     }
                     ?>
                </table>
            </div>
                <?php
                $all_days_off = AllDayOff();                                                        
                foreach ($all_days_off as $days_off_split){
                   $all_days_in[]  = $days_off_split['date'];
                }                                                        
                $all_date  = implode(",", $all_days_in);                                                        
                $all_date_exist = str_replace("/", "-", $all_date);
                 ?>
           
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
            <span style="font-weight: bold;">When Needed : </span>
            <input class="picker_icon" value="ASAP" type="text" name="date_needed" id="date_needed" style="width: 75px;" onclick="date_reveal();" />
            <input id="time_picker_icon" value="ASAP" type="text" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            
            <input type="checkbox" name="arrange_del" id="arrange_del" style="width: 15% !important;" onclick="uncheck_delivery();" /><span style="text-transform: uppercase;">I WANT TO USE MY OWN SHIPPING CARRIER</span>
            
        </div>
        
        <div id="delivery_info" style="width: 65%;float: left;margin-left: 45px;margin-top: 10px;display: none;">
            <div style="border: 1px #F99B3E solid;width: 50%;margin-left: 20px;padding: 5px;">
                <ul>
                    <li>
                        <span style="font-weight: bold;">Delivery : </span>
                        <select  name="delivery_comp" id="delivery_comp" style="width: 45% !important;" onchange="return show_address();">                    
                            <option value="1">Next Day Air</option>
                            <option value="2">Two Day Air</option>
                            <option value="3">Three Day Air</option>
                            <option value="4">Ground</option>
                        </select>
                    </li>
                    <li>
                        <span style="font-weight: bold;">Billing # :</span> <input type="text" name="bill_number" id="bill_number" style="width: 50% !important;margin-bottom: 0px !important;" />
                    </li>
                    <li>
                        <label><span style="font-weight: bold;">Shipping Company : </span></label>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_1" style="width: 10% !important;margin-bottom: 0px !important;" value="FedEx" /> FedEx</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_2" style="width: 10% !important;margin-bottom: 0px !important;" value="UPS" /> UPS</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_3" style="width: 10% !important;margin-bottom: 0px !important;" value="Other" /> Other</span>
                    </li>
                </ul>
            </div>            
        </div>
        
        <div style="font-weight: bold;width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            Special Instructions:            
        </div>        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <textarea name="spl_recipient" id="spl_recipient" rows="3" cols="18" style="width: 200px;height: 40px;"></textarea>
        </div>
        
    </div>
</div>
    <?php
}elseif ($_POST['recipients'] == '9'){
    
    $shipping_id_rec    =   $_POST['shipping_id_rec'];
    $user_session       =   $_POST['user_session'];
    $user_session_comp  =   $_POST['user_session_comp'];
    $date_needed        =   $_POST['date_needed'];
    $spl_recipient      =   $_POST['spl_recipient'];
    
    $avl_sets_1         =   $_POST['avl_sets_1'];
    $need_sets_1        =   $_POST['need_sets_1'];
    $size_sets_1        =   $_POST['size_sets_1'];
    $output_sets_1      =   $_POST['output_sets_1'];
    $binding_sets_1     =   $_POST['binding_sets_1'];
    $folding_sets_1     =   $_POST['folding_sets_1'];
    
    $avl_sets_2         =   $_POST['avl_sets_2'];
    $need_sets_2        =   $_POST['need_sets_2'];
    $size_sets_2        =   $_POST['size_sets_2'];
    $output_sets_2      =   $_POST['output_sets_2'];
    $binding_sets_2     =   $_POST['binding_sets_2'];
    $folding_sets_2     =   $_POST['folding_sets_2'];
    
    $delivery_type      =   $_POST['delivery_type'];
    $bill_number        =   $_POST['bill_number'];
    $shipp_comp_1_f     =   $_POST['shipp_comp_1_f'];
    $shipp_comp_2_f     =   $_POST['shipp_comp_2_f'];
    $shipp_comp_3_f     =   $_POST['shipp_comp_3_f'];    
    
    $query = "INSERT INTO sohorepro_sets_needed
			SET     comp_id         = '" . $user_session_comp . "',
                                usr_id          = '" . $user_session . "',
                                plot_needed     = '" . $need_sets_1 . "',
                                size            = '" . $size_sets_1 . "',
                                output          = '" . $output_sets_1 . "',
                                binding         = '" . $binding_sets_1 . "',
                                folding         = '" . $folding_sets_1 . "',   
                                arch_needed     = '" . $need_sets_2 . "',
                                arch_size       = '" . $size_sets_2 . "',
                                arch_output     = '" . $output_sets_2 . "',
                                arch_binding    = '" . $binding_sets_2 . "',
                                arch_folding    = '" . $folding_sets_2 . "',   
                                shipp_id        = '" . $shipping_id_rec ."',
                                shipp_date      = '" . $date_needed . "',
                                spl_inc         = '" . $spl_recipient. "',
                                delivery_type   = '" . $delivery_type ."',
                                billing_number  = '" . $bill_number  ."',
                                shipp_comp_1    = '" . $shipp_comp_1_f. "',
                                shipp_comp_2    = '" . $shipp_comp_2_f. "',
                                shipp_comp_3    = '" . $shipp_comp_3_f. "' ";
    $sql_result = mysql_query($query);
   
    $entered_needed_sets = NeededSets($user_session_comp, $user_session);
    $r = 1;
    foreach ($entered_needed_sets as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
?>    
<div style="border: 1px #F99B3E solid;height: 225px;margin-bottom: 5px;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient('<?php echo $entered_sets['id']; ?>');">Delete</span>
        </div>
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
        <div style="float: left;width: 33%;margin-left: 30px;">  
            <?php 
            $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
            echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; 
            ?>                   
        </div>
        <!-- Address Show End -->
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
            1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding.$plot_folding; ?></br>
         <!--   2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding; ?> -->
        </div>        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
        </div>        
        <?php
        if($entered_sets['delivery_type'] != '0'){
        ?>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <?php
            if($entered_sets['delivery_type'] == '1'){
            $delivery_type = 'Next Day Air';
            }elseif ($entered_sets['delivery_type'] == '2') {
             $delivery_type = 'Two Day Air';           
            }elseif ($entered_sets['delivery_type'] == '3') {
             $delivery_type = 'Three Day Air';     
            }elseif ($entered_sets['delivery_type'] == '4') {
             $delivery_type = 'Ground';  
            }

            $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
            $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
            $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

            echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
            ?>
        </div>
        <?php }else{ ?>                            
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            Soho Delivery
        </div>    
        <?php } ?>        
    </div>
</div>
    <?php 
    $r++;
    } 
    ?>
    
    <!-- New Recipients Start -->
<div style="border: 1px #F99B3E solid;margin-top: 5px;margin-bottom: 20px;padding-bottom: 20px;width: 100%;float: left;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo (count($entered_needed_sets) + 1); ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient_empty();">Delete</span>
        </div>

        <div style="float: left;width: 33%;margin-left: 30px;border: 1px #F99B3E solid;margin-top: 10px;font-weight: bold;">Send to :
            <select  name="address_book_rp" id="address_book_rp" style="width: 75% !important;" onchange="return show_address();">
                <option value="0">Address Book</option>
                <?php
                $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                foreach ($address_book as $address) {
                    ?>                                                                                        
                <option value="<?php echo $address['id']; ?>" ><?php echo $address['company_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <!-- Address Show Start -->
        <div id="show_address" style="float: left;width: 60%;border: 1px #F99B3E solid;margin-top: 10px;margin-left: 5px;height: 20px;font-weight: bold;">
            
        </div>
        <?php
        $user_id_add_set      = $_SESSION['sohorepro_userid'];
        $company_id_view_plot = $_SESSION['sohorepro_companyid'];
        ?>
        <!-- Address Show End -->
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            
            <div id="sets_grid_new">
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($company_id_view_plot, $user_id_add_set) : ArchSetsNeeded($company_id_view_plot, $user_id_add_set);
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
            </div>
                <?php
                $all_days_off = AllDayOff();                                                        
                foreach ($all_days_off as $days_off_split){
                   $all_days_in[]  = $days_off_split['date'];
                }                                                        
                $all_date  = implode(",", $all_days_in);                                                        
                $all_date_exist = str_replace("/", "-", $all_date);
                 ?>
            
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
            <span style="font-weight: bold;">When Needed : </span>
            <input class="picker_icon" type="text" value="ASAP" name="date_needed" id="date_needed" style="width: 75px;" onclick="date_reveal();" />
            <input id="time_picker_icon" type="text" value="ASAP" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="checkbox" name="arrange_del" id="arrange_del" style="width: 15% !important;" onclick="uncheck_delivery();" /><span style="text-transform: uppercase;">I WANT TO USE MY OWN SHIPPING CARRIER</span>
        </div>
        
        <div id="delivery_info" style="width: 65%;float: left;margin-left: 45px;margin-top: 10px;display: none;">
            <div style="border: 1px #F99B3E solid;width: 50%;margin-left: 20px;padding: 5px;">
                <ul>
                    <li>
                        <span style="font-weight: bold;">Delivery : </span>
                        <select  name="delivery_comp" id="delivery_comp" style="width: 45% !important;" onchange="return show_address();">                    
                            <option value="1">Next Day Air</option> 
                            <option value="2">Two Day Air</option>
                            <option value="3">Three Day Air</option>
                            <option value="4">Ground</option>
                        </select>
                    </li>
                    <li>
                        <span style="font-weight: bold;">Billing # :</span> <input type="text" name="bill_number" id="bill_number" style="width: 50% !important;margin-bottom: 0px !important;" />
                    </li>
                    <li>
                        <label><span style="font-weight: bold;">Shipping Company : </span></label>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_1" style="width: 10% !important;margin-bottom: 0px !important;" value="FedEx" /> FedEx</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_2" style="width: 10% !important;margin-bottom: 0px !important;" value="UPS" /> UPS</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_3" style="width: 10% !important;margin-bottom: 0px !important;" value="Other" /> Other</span>
                    </li>
                </ul>
            </div>            
        </div>
        
        
        <div style="font-weight: bold;width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            Special Instructions:            
        </div>        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <textarea name="spl_recipient" id="spl_recipient" rows="3" cols="18" style="width: 200px;height: 40px;"></textarea>
        </div>
        
    </div>
</div>
    <!-- New Recipients End -->
    
<?php       
}elseif ($_POST['recipients'] == '8'){
    
    $delete_rec_id      =   $_POST['delete_rec_id'];
    $user_session       =   $_POST['user_session'];
    $user_session_comp  =   $_POST['user_session_comp'];
    
    $delete_sql         = "DELETE FROM sohorepro_sets_needed WHERE id = '".$delete_rec_id."' ";
    mysql_query($delete_sql);
    
    $entered_needed_sets = NeededSets($user_session_comp, $user_session);
    $r = 1;
    foreach ($entered_needed_sets as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
    
?>
    <div style="border: 1px #F99B3E solid;height: 225px;margin-bottom: 5px;">
   <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient('<?php echo $entered_sets['id']; ?>');">Delete</span>
        </div>
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
        <div style="float: left;width: 33%;margin-left: 30px;">  
            <?php 
            $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
            echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; ?>                   
        </div>
        <!-- Address Show End -->
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
            1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding.$plot_folding; ?></br>
          <!--  2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding; ?> -->
        </div>        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
        </div>        
        <?php
        if($entered_sets['delivery_type'] != '0'){
        ?>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <?php
            if($entered_sets['delivery_type'] == '1'){
            $delivery_type = 'Next Day Air';
            }elseif ($entered_sets['delivery_type'] == '2') {
             $delivery_type = 'Two Day Air';           
            }elseif ($entered_sets['delivery_type'] == '3') {
             $delivery_type = 'Three Day Air';     
            }elseif ($entered_sets['delivery_type'] == '4') {
             $delivery_type = 'Ground';  
            }

            $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
            $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
            $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

            echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
            ?>
        </div>
        <?php }else{ ?>                            
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            Soho Delivery
        </div>    
        <?php } ?>        
    </div> 
    </div>
    <?php 
    $r++;
    } 
    ?>
    
     <!-- New Recipients Start -->
    <div style="border: 1px #F99B3E solid;height: 320px;margin-top: 5px;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo (count($entered_needed_sets) + 1); ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient_empty();">Delete</span>
        </div>

        <div style="float: left;width: 33%;margin-left: 30px;border: 1px #F99B3E solid;margin-top: 10px;font-weight: bold;">Send to :
            <select  name="address_book_rp" id="address_book_rp" style="width: 75% !important;" onchange="return show_address();">
                <option value="0">Address Book</option>
                <?php
                $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                foreach ($address_book as $address) {
                    ?>                                                                                        
                <option value="<?php echo $address['id']; ?>" ><?php echo $address['company_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <!-- Address Show Start -->
        <div id="show_address" style="float: left;width: 60%;border: 1px #F99B3E solid;margin-top: 10px;margin-left: 5px;height: 20px;font-weight: bold;">
            
        </div>
        <?php
        $user_id_add_set      = $_SESSION['sohorepro_userid'];
        $company_id_view_plot = $_SESSION['sohorepro_companyid'];
        ?>
        <!-- Address Show End -->
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            
            <div id="sets_grid_new">
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($company_id_view_plot, $user_id_add_set) : ArchSetsNeeded($company_id_view_plot, $user_id_add_set);
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
            </div>
            <?php
            $all_days_off = AllDayOff();                                                        
                foreach ($all_days_off as $days_off_split){
                   $all_days_in[]  = $days_off_split['date'];
                }                                                        
                $all_date  = implode(",", $all_days_in);                                                        
                $all_date_exist = str_replace("/", "-", $all_date);            
            ?>
            
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
            <span style="font-weight: bold;">When Needed : </span>
            <input class="picker_icon" type="text" value="ASAP" name="date_needed" id="date_needed" style="width: 75px;" onclick="date_reveal();" />
            <input id="time_picker_icon" type="text" value="ASAP" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="checkbox" name="arrange_del" id="arrange_del" style="width: 15% !important;" /><span style="text-transform: uppercase;">I WANT TO USE MY OWN SHIPPING CARRIER</span>
        </div>
        
        <div style="font-weight: bold;width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            Special Instructions:            
        </div>        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <textarea name="spl_recipient" id="spl_recipient" rows="3" cols="18" style="width: 200px;height: 40px;"></textarea>
        </div>
        
    </div>
    </div> 
    <!-- New Recipients End -->
    
<?php
}elseif ($_POST['recipients'] == '7'){
    $edit_rec_id        =   $_POST['edit_rec_id'];
    $user_session       =   $_POST['user_session'];
    $user_session_comp  =   $_POST['user_session_comp'];
    
    $entered_needed_sets = NeededSets($user_session_comp, $user_session);
    $r = 1;
    foreach ($entered_needed_sets as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_foldding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding']; 
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding']; 
    if($entered_sets['id'] == $edit_rec_id){
        $edit_recipients = EditNeededSets($user_session_comp, $user_session, $edit_rec_id);
    ?>
    <div style="border: 1px #F99B3E solid;margin-top: 5px;padding-bottom: 20px;margin-bottom : 5px;width: 100%;float: left;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">            
            <span title="Update Recipient" alt="Update Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return update_recipient('<?php echo $entered_sets['id']; ?>');">Update</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient('<?php echo $entered_sets['id']; ?>');">Delete</span>
            <input type="hidden" name="recipient_edit_id" id="recipient_edit_id" value="<?php echo $edit_rec_id; ?>" />
        </div>

        <div style="float: left;width: 33%;margin-left: 30px;border: 1px #F99B3E solid;margin-top: 10px;font-weight: bold;">Send to :
            <select  name="address_book_rp" id="address_book_rp" style="width: 75% !important;" onchange="return show_address();">
                <option value="0">Address Book</option>
                <?php
                $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                foreach ($address_book as $address) {
                    if($address['id'] == $edit_recipients[0]['shipp_id']){
                    ?>
                    <option value="<?php echo $address['id']; ?>" selected="selected" ><?php echo $address['company_name']; ?></option>
                    <?php
                    }else{?>
                    <option value="<?php echo $address['id']; ?>" ><?php echo $address['company_name']; ?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </div>
        <!-- Address Show Start -->
        <div id="show_address" style="float: left;width: 60%;border: 1px #F99B3E solid;margin-top: 10px;margin-left: 5px;height: 20px;font-weight: bold;">
            <?php
                $shipp_add = SelectIdAddress($edit_recipients[0]['shipp_id']);  
                $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',  ';
                echo $shipp_add[0]['address_1'].', '.$add_2.$shipp_add[0]['city'].', '.StateName($shipp_add[0]['state']).' '.$shipp_add[0]['zip'];          
            ?>
        </div>
        <?php
        $user_id_add_set      = $_SESSION['sohorepro_userid'];
        $company_id_view_plot = $_SESSION['sohorepro_companyid'];
        ?>
        <!-- Address Show End -->
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            
            <div id="sets_grid_new">
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($company_id_view_plot, $user_id_add_set) : ArchSetsNeeded($company_id_view_plot, $user_id_add_set);
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
            </div>
            
            <?php
            $all_days_off = AllDayOff();                                                        
            foreach ($all_days_off as $days_off_split){
               $all_days_in[]  = $days_off_split['date'];
            }                                                        
            $all_date  = implode(",", $all_days_in);                                                        
            $all_date_exist = str_replace("/", "-", $all_date);
            ?>
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
            <span style="font-weight: bold;">When Needed : </span>
            <input class="picker_icon" type="text" value="ASAP" name="date_needed" id="date_needed" style="width: 75px;" onclick="date_reveal();" value="<?php echo $edit_recipients[0]['shipp_date']; ?>" />
            <input id="time_picker_icon" type="text" value="ASAP" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
        </div>
        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <?php
            $checked = ($edit_recipients[0]['delivery_type'] != '0') ? 'checked' : '';
            $display = ($edit_recipients[0]['delivery_type'] != '0') ? '' : 'display: none;';
            $shipp_comp_1 = ($edit_recipients[0]['shipp_comp_1'] != '0') ? 'checked' : '';
            $shipp_comp_2 = ($edit_recipients[0]['shipp_comp_2'] != '0') ? 'checked' : '';
            $shipp_comp_3 = ($edit_recipients[0]['shipp_comp_3'] != '0') ? 'checked' : '';
            $bill_val     = ($edit_recipients[0]['billing_number'] != '0') ? $edit_recipients[0]['billing_number'] : '';
            ?>
            <input type="checkbox" name="arrange_del" id="arrange_del" <?php echo $checked; ?> style="width: 15% !important;" onclick="uncheck_delivery();" /><span style="text-transform: uppercase;">I WANT TO USE MY OWN SHIPPING CARRIER</span>
        </div>
        
        <div id="delivery_info" style="width: 65%;float: left;margin-left: 45px;margin-top: 10px;<?php echo $display; ?>">
            <div style="border: 1px #F99B3E solid;width: 50%;margin-left: 20px;padding: 5px;">
                <ul>
                    <li>
                        <span style="font-weight: bold;">Delivery : </span>
                        <select  name="delivery_comp" id="delivery_comp" style="width: 45% !important;" onchange="return show_address();">                    
                            <option value="1" <?php if($edit_recipients[0]['delivery_type'] == '1'){?> selected="selected" <?php } ?>>Next Day Air</option> 
                            <option value="2" <?php if($edit_recipients[0]['delivery_type'] == '2'){?> selected="selected" <?php } ?>>Two Day Air</option>
                            <option value="3" <?php if($edit_recipients[0]['delivery_type'] == '3'){?> selected="selected" <?php } ?>>Three Day Air</option>
                            <option value="4" <?php if($edit_recipients[0]['delivery_type'] == '4'){?> selected="selected" <?php } ?>>Ground</option>
                        </select>
                    </li>
                    <li>
                        <span style="font-weight: bold;">Billing # :</span> <input type="text" name="bill_number" id="bill_number" value="<?php echo $bill_val; ?>" style="width: 50% !important;margin-bottom: 0px !important;" />
                    </li>
                    <li>
                        <label><span style="font-weight: bold;">Shipping Company : </span></label>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_1" style="width: 10% !important;margin-bottom: 0px !important;" value="FedEx" <?php echo $shipp_comp_1; ?> /> FedEx</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_2" style="width: 10% !important;margin-bottom: 0px !important;" value="UPS" <?php echo $shipp_comp_2; ?> /> UPS</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_3" style="width: 10% !important;margin-bottom: 0px !important;" value="Other" <?php echo $shipp_comp_3; ?> /> Other</span>
                    </li>
                </ul>
            </div>            
        </div>
        
        <div style="font-weight: bold;width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            Special Instructions:            
        </div>        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <textarea name="spl_recipient" id="spl_recipient" rows="3" cols="18" style="width: 200px;height: 40px;"><?php echo $edit_recipients[0]['spl_inc']; ?></textarea>
        </div>
        
    </div>
    </div>
    <?php 
    }else{
    ?>
    <div style="border: 1px #F99B3E solid;padding-bottom: 20px;margin-bottom : 5px;width: 100%;float: left;">
   <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient('<?php echo $entered_sets['id']; ?>');">Delete</span>
        </div>
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
        <div style="float: left;width: 33%;margin-left: 30px;">  
            <?php 
            $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
            echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; ?>                   
        </div>
        <!-- Address Show End -->
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
            1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding; ?></br>
          <!--  2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding; ?> -->
        </div>        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
        </div>        
        <?php
        if($entered_sets['delivery_type'] != '0'){
        ?>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <?php
            if($entered_sets['delivery_type'] == '1'){
            $delivery_type = 'Next Day Air';
            }elseif ($entered_sets['delivery_type'] == '2') {
             $delivery_type = 'Two Day Air';           
            }elseif ($entered_sets['delivery_type'] == '3') {
             $delivery_type = 'Three Day Air';     
            }elseif ($entered_sets['delivery_type'] == '4') {
             $delivery_type = 'Ground';  
            }

            $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
            $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
            $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

            echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
            ?>
        </div>
        <?php }else{ ?>                            
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            Soho Delivery
        </div>    
        <?php } ?>       
    </div> 
    </div>
    <?php
    }
    $r++;
    } 
    ?>
<?php
}elseif ($_POST['recipients'] == '6'){
    
    $edit_recipient_id  =   $_POST['edit_recipient_id'];
    
    $shipping_id_rec    =   $_POST['shipping_id_rec'];
    $user_session       =   $_POST['user_session'];
    $user_session_comp  =   $_POST['user_session_comp'];
    $date_needed        =   $_POST['date_needed'];
    $spl_recipient      =   $_POST['spl_recipient'];
    
    $avl_sets_1         =   $_POST['avl_sets_1'];
    $need_sets_1        =   $_POST['need_sets_1'];
    $size_sets_1        =   $_POST['size_sets_1'];
    $output_sets_1      =   $_POST['output_sets_1'];
    $binding_sets_1     =   $_POST['binding_sets_1'];
    $folding_sets_1     =   $_POST['folding_sets_1'];
    
    $avl_sets_2         =   $_POST['avl_sets_2'];
    $need_sets_2        =   $_POST['need_sets_2'];
    $size_sets_2        =   $_POST['size_sets_2'];
    $output_sets_2      =   $_POST['output_sets_2'];
    $binding_sets_2     =   $_POST['binding_sets_2'];
    $folding_sets_2     =   $_POST['folding_sets_2'];
    
    $delivery_type      =   $_POST['delivery_type'];
    $bill_number        =   $_POST['bill_number'];
    $shipp_comp_1_f     =   $_POST['shipp_comp_1_f'];
    $shipp_comp_2_f     =   $_POST['shipp_comp_2_f'];
    $shipp_comp_3_f     =   $_POST['shipp_comp_3_f'];    
    
    
    $query = "UPDATE sohorepro_sets_needed
			SET     comp_id         = '" . $user_session_comp . "',
                                usr_id          = '" . $user_session . "',
                                plot_needed     = '" . $need_sets_1 . "',
                                size            = '" . $size_sets_1 . "',
                                output          = '" . $output_sets_1 . "',
                                binding         = '" . $binding_sets_1 . "',
                                folding         = '" . $folding_sets_1 . "',
                                arch_needed     = '" . $need_sets_2 . "',
                                arch_size       = '" . $size_sets_2 . "',
                                arch_output     = '" . $output_sets_2 . "',
                                arch_binding    = '" . $binding_sets_2 . "',
                                arch_folding    = '" . $folding_sets_2 . "',    
                                shipp_id        = '" . $shipping_id_rec ."',
                                shipp_date      = '" . $date_needed . "',
                                spl_inc         = '" . $spl_recipient. "',
                                delivery_type   = '" . $delivery_type ."',
                                billing_number  = '" . $bill_number  ."',
                                shipp_comp_1    = '" . $shipp_comp_1_f. "',
                                shipp_comp_2    = '" . $shipp_comp_2_f. "',
                                shipp_comp_3    = '" . $shipp_comp_3_f. "'  WHERE id = '".$edit_recipient_id."' ";
    
    $sql_result = mysql_query($query);
    
    $entered_needed_sets = NeededSets($user_session_comp, $user_session);
    $r = 1;
    foreach ($entered_needed_sets as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];    
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
?>
<div style="border: 1px #F99B3E solid;height: 225px;margin-bottom: 5px;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient('<?php echo $entered_sets['id']; ?>');">Delete</span>
        </div>
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
        <div style="float: left;width: 33%;margin-left: 30px;">  
            <?php 
            $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
            echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; ?>                   
        </div>
        <!-- Address Show End -->
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
            1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding.$plot_folding; ?></br>
           <!-- 2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding; ?> -->
        </div>        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
        </div>        
        <?php
        if($entered_sets['delivery_type'] != '0'){
        ?>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <?php
            if($entered_sets['delivery_type'] == '1'){
            $delivery_type = 'Next Day Air';
            }elseif ($entered_sets['delivery_type'] == '2') {
             $delivery_type = 'Two Day Air';           
            }elseif ($entered_sets['delivery_type'] == '3') {
             $delivery_type = 'Three Day Air';     
            }elseif ($entered_sets['delivery_type'] == '4') {
             $delivery_type = 'Ground';  
            }

            $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
            $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
            $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

            echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
            ?>
        </div>
        <?php }else{ ?>                            
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            Soho Delivery
        </div>    
        <?php } ?>        
    </div>
</div>
    <?php 
    $r++;
    } 
    ?>
    
    <!-- New Recipients Start -->
<div style="border: 1px #F99B3E solid;height: 320px;margin-top: 5px;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo (count($entered_needed_sets) + 1); ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient_empty();">Delete</span>
        </div>

        <div style="float: left;width: 33%;margin-left: 30px;border: 1px #F99B3E solid;margin-top: 10px;font-weight: bold;">Send to :
            <select  name="address_book_rp" id="address_book_rp" style="width: 75% !important;" onchange="return show_address();">
                <option value="0">Address Book</option>
                <?php
                $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                foreach ($address_book as $address) {
                    ?>                                                                                        
                <option value="<?php echo $address['id']; ?>" ><?php echo $address['company_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <!-- Address Show Start -->
        <div id="show_address" style="float: left;width: 60%;border: 1px #F99B3E solid;margin-top: 10px;margin-left: 5px;height: 20px;font-weight: bold;">
            
        </div>
        <?php
        $user_id_add_set      = $_SESSION['sohorepro_userid'];
        $company_id_view_plot = $_SESSION['sohorepro_companyid'];
        ?>
        <!-- Address Show End -->
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            
            <div id="sets_grid_new">
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($company_id_view_plot, $user_id_add_set) : ArchSetsNeeded($company_id_view_plot, $user_id_add_set);
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
            </div>
            
            <?php
            $all_days_off = AllDayOff();                                                        
            foreach ($all_days_off as $days_off_split){
               $all_days_in[]  = $days_off_split['date'];
            }                                                        
            $all_date  = implode(",", $all_days_in);                                                        
            $all_date_exist = str_replace("/", "-", $all_date);
            ?>
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
            <span style="font-weight: bold;">When Needed : </span>
            <input class="picker_icon" type="text" value="ASAP" name="date_needed" id="date_needed" style="width: 75px;" onclick="date_reveal();" />
            <input id="time_picker_icon" type="text" value="ASAP" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="checkbox" name="arrange_del" id="arrange_del" style="width: 15% !important;" /><span style="text-transform: uppercase;">I WANT TO USE MY OWN SHIPPING CARRIER</span>
        </div>
        
        <div style="font-weight: bold;width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            Special Instructions:            
        </div>        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <textarea name="spl_recipient" id="spl_recipient" rows="3" cols="18" style="width: 200px;height: 40px;"></textarea>
        </div>
        
    </div>
</div>
    <!-- New Recipients End -->
    
<?php
}elseif ($_POST['recipients'] == '5'){    
   
    $user_session       =   $_POST['inc_avl_user_id'];
    $user_session_comp  =   $_POST['inc_avl_comp_id'];
    $type               =   $_POST['inc_avl_type'];
    $row_id             =   $_POST['inc_avl_rec_id'];
    $sets_current_1     =   $_POST['need_sets_current_1'];
    $sets_current_2     =   $_POST['need_sets_current_2'];
    $need_sets_avl_sets =   $_POST['need_sets_avl_sets'];
    
    $sql_last_id        = mysql_query("SELECT id FROM sohorepro_plotting_set ORDER BY id DESC LIMIT 1");
    $object_last_id     = mysql_fetch_assoc($sql_last_id);
    $last_id            =   $object_last_id['id'] + 1;
    
//    $sql_1              =   "CREATE TEMPORARY TABLE tmp SELECT * FROM sohorepro_plotting_set WHERE id = '".$row_id."' ";
//    mysql_query($sql_1);
//    $sql_2              =   "UPDATE tmp SET id = '".$last_id."' WHERE id = '".$row_id."'";
//    mysql_query($sql_2);
    $sql_3              =   "UPDATE sohorepro_plotting_set SET print_ea = '".$need_sets_avl_sets."' WHERE company_id = '".$user_session_comp."' AND user_id = '".$user_session."'  ";
    mysql_query($sql_3);
?>
    <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($user_session_comp, $user_session);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($user_session_comp, $user_session,'1') : EnteredPlotRecipientsCount($user_session_comp, $user_session,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($user_session_comp, $user_session) : ArchSetsNeeded($user_session_comp, $user_session);
                         $need_current      = ($entered['plot_arch'] == '1') ? $sets_current_1 : $sets_current_2; 
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="<?php echo $need_current; ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
    
<?php }elseif ($_POST['recipients'] == '4'){ 
    
    $user_session       =   $_POST['inc_avl_user_id'];
    $user_session_comp  =   $_POST['inc_avl_comp_id'];
    $type               =   $_POST['inc_avl_type'];
    $row_id             =   $_POST['inc_avl_rec_id'];
    $sets_current_1     =   $_POST['need_sets_current_1'];
    $sets_current_2     =   $_POST['need_sets_current_2'];
    $decrese_avl_sets   =   $_POST['decrese_avl_sets'];
    
//    $sql_1              =   "DELETE FROM sohorepro_plotting_set WHERE id = '".$row_id."' ";
//    mysql_query($sql_1); 
    
    $sql_3              =   "UPDATE sohorepro_plotting_set SET print_ea = '".$decrese_avl_sets."' WHERE company_id = '".$user_session_comp."' AND user_id = '".$user_session."'  ";
    mysql_query($sql_3);
    
?>
    <table border="1" style="width: 100%;">
            <tr bgcolor="#F99B3E">
                <td style="font-weight: bold;">Order Type</td>
                <td style="font-weight: bold;">Available</td>
                <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                <td style="font-weight: bold;">Size</td>
                <td style="font-weight: bold;">Output</td>
                <td style="font-weight: bold;">Binding</td>
                <td style="font-weight: bold;">Folding</td>
            </tr> 
            <?php
            $enteredPlot          = EnteredPlotRecipients($user_session_comp, $user_session);                
            $i = 1;
             foreach ($enteredPlot as $entered){
                 $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                 $binding           = strtoupper($entered['binding']);
                 $folding           = strtoupper($entered['folding']);
                 $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                 $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                 $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($user_session_comp, $user_session,'1') : EnteredPlotRecipientsCount($user_session_comp, $user_session,'0');
                 $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($user_session_comp, $user_session) : ArchSetsNeeded($user_session_comp, $user_session);
                 $need_current      = ($entered['plot_arch'] == '1') ? $sets_current_1 : $sets_current_2; 
            ?>
            <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="<?php echo $need_current; ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
            </tr>
             <?php 
              $i++;
             }
             ?>
    </table>
    
<?php    
}elseif ($_POST['recipients'] == '55'){    
   
    $user_session       =   $_POST['inc_avl_user_id'];
    $user_session_comp  =   $_POST['inc_avl_comp_id'];
    $type               =   ($_POST['inc_avl_type'] == '1') ? '0' : '1';
    $change_type        =   ($_POST['inc_avl_type'] == '1') ? '1' : '0';    
    $row_id             =   $_POST['inc_avl_rec_id'];
    
    $sql_last_id        = mysql_query("SELECT id FROM sohorepro_plotting_set ORDER BY id DESC LIMIT 1");
    $object_last_id     = mysql_fetch_assoc($sql_last_id);
    $last_id            =   $object_last_id['id'] + 1;
    
    $sql_1              =   "CREATE TEMPORARY TABLE tmp SELECT * FROM sohorepro_plotting_set WHERE plot_arch = '".$type."' LIMIT 1 ";
    mysql_query($sql_1);
    $sql_2              =   "UPDATE tmp SET id = '".$last_id."', plot_arch = '".$change_type."' WHERE plot_arch = '".$type."'";
    mysql_query($sql_2);
    $sql_3              =   "INSERT INTO sohorepro_plotting_set SELECT * FROM tmp WHERE id = '".$last_id."' ";
    mysql_query($sql_3);
    ?>
    <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($user_session_comp, $user_session);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($user_session_comp, $user_session,'1') : EnteredPlotRecipientsCount($user_session_comp, $user_session,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($user_session_comp, $user_session) : ArchSetsNeeded($user_session_comp, $user_session);
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
<?php    
}elseif ($_POST['recipients'] == 'delete_set'){    
    $delete_set_id = $_POST['delete_set_id'];
    
    $sql_1              =   "DELETE FROM sohorepro_plotting_set WHERE id = '".$delete_set_id."' ";
    $result = mysql_query($sql_1); 
    if($result){
        echo '1';
    }  else {
        echo '0';
    }
    
}elseif ($_POST['recipients'] == 'feedback_0') {
    
    $feedback_input     =   $_POST['feedback_input'];
    $first_name         =   $_POST['first_name'];
    $last_name          =   $_POST['last_name'];
    $user_mail          =   $_POST['user_mail'];
    $phone              =   $_POST['phone'];
    
    //$user_id            =   UserMail($_POST['user_id_logged']);
    
     $query = "INSERT INTO sohorepro_feedback
			SET     first_name          = '" . $first_name . "',
                                last_name           = '" . $last_name . "',
                                email               = '" . $user_mail . "',
                                phone               = '" . $phone . "',
                                feedback        = '" . $feedback_input . "' ";
    $sql_result = mysql_query($query);    
    
    //$mail_id        =   getActiveEmailOrder();
    
    //$mail_id        =   array('jassim.colan@gmail.com', 'n.mohamedjassim@gmail.com', 'chief@pillarsupport.com');
    
    $mail_id        =   array('jassim.colan@gmail.com', 'n.mohamedjassim@gmail.com', 'chief@pillarsupport.com', 'sid@sohorepro.com', 'harvey@sohorepro.com');
        
    foreach ($mail_id as $to) {
        $subject = "Help Request from Website";
        $headers = 'From: '.$user_mail . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-Type: text/html; charset=utf-8\r\n' . "X-Mailer: PHP";
        $headers .= 'Content-Transfer-Encoding: 8bit\r\n\r\n';
        $result = mail($to, stripslashes($subject), stripslashes($feedback_input), $headers);
    }
    
    if($result){
        echo '1';
    }  else {
        echo '0';
    }
    
}elseif ($_POST['recipients'] == 'feedback_1') {
    
    $feedback_input     =   $_POST['feedback_input_logged'];
    $comp_id            =   $_POST['comp_id_logged'];
    $user_id            =   UserMail($_POST['user_id_logged']);
    $customer_name      =   getCompName($comp_id);
    
    
     $query = "INSERT INTO sohorepro_feedback
			SET     comp_id         = '" . $comp_id . "',
                                user_name       = '" . $user_id . "',
                                feedback        = '" . $feedback_input . "' ";
     
    $sql_result = mysql_query($query);    
    $mail_id = getActiveEmailOrder();
    
    foreach ($mail_id as $to) {
        $subject = "Help Request from " . $customer_name;
        $headers = 'From: "SohoRepro" <noreply@sohorepro.com>' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-Type: text/html; charset=utf-8\r\n' . "X-Mailer: PHP";
        $headers .= 'Content-Transfer-Encoding: 8bit\r\n\r\n';
        $result = mail($to['email_id'], stripslashes($subject), stripslashes($feedback_input), $headers);
    }
    
    if($result){
        echo '1';
    }  else {
        echo '0';
    }
    
}elseif ($_POST['recipients'] == '7_1'){
    $edit_rec_id        =   $_POST['edit_rec_id'];
    $user_session       =   $_POST['user_session'];
    $user_session_comp  =   $_POST['user_session_comp'];
    
    $entered_needed_sets = NeededSets($user_session_comp, $user_session);
    $r = 1;
    foreach ($entered_needed_sets as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_foldding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding']; 
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding']; 
    if($entered_sets['id'] == $edit_rec_id){
        $edit_recipients = EditNeededSets($user_session_comp, $user_session, $edit_rec_id);
    ?>
    <div style="border: 1px #F99B3E solid;margin-top: 5px;padding-bottom: 20px;margin-bottom : 5px;width: 100%;float: left;">
    <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">            
            <span title="Update Recipient" alt="Update Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return update_recipient_final('<?php echo $entered_sets['id']; ?>');">Update</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return cancel_recipient('<?php echo $user_session; ?>','<?php echo $user_session_comp; ?>');">Cancel</span>
            <input type="hidden" name="recipient_edit_id" id="recipient_edit_id" value="<?php echo $edit_rec_id; ?>" />
        </div>

        <div style="float: left;width: 33%;margin-left: 30px;border: 1px #F99B3E solid;margin-top: 10px;font-weight: bold;">Send to :
            <select  name="address_book_rp" id="address_book_rp" style="width: 75% !important;" onchange="return show_address();">
                <option value="0">Address Book</option>
                <?php
                $address_book = AddressBookCompany($_SESSION['sohorepro_companyid']);
                foreach ($address_book as $address) {
                    if($address['id'] == $edit_recipients[0]['shipp_id']){
                    ?>
                    <option value="<?php echo $address['id']; ?>" selected="selected" ><?php echo $address['company_name']; ?></option>
                    <?php
                    }else{?>
                    <option value="<?php echo $address['id']; ?>" ><?php echo $address['company_name']; ?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </div>
        <!-- Address Show Start -->
        <div id="show_address" style="float: left;width: 60%;border: 1px #F99B3E solid;margin-top: 10px;margin-left: 5px;height: 20px;font-weight: bold;">
            <?php
                $shipp_add = SelectIdAddress($edit_recipients[0]['shipp_id']);  
                $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',  ';
                echo $shipp_add[0]['address_1'].', '.$add_2.$shipp_add[0]['city'].', '.StateName($shipp_add[0]['state']).' '.$shipp_add[0]['zip'];          
            ?>
        </div>
        <?php
        $user_id_add_set      = $_SESSION['sohorepro_userid'];
        $company_id_view_plot = $_SESSION['sohorepro_companyid'];
        ?>
        <!-- Address Show End -->
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            
            <div id="sets_grid_new">
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Order Type</td>
                        <td style="font-weight: bold;">Available</td>
                        <td style="font-weight: bold;">Sets Needed&nbsp;&nbsp;<span style="color: red;">*</span></td>
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr> 
                    <?php
                    $enteredPlot          = EnteredPlotRecipients($company_id_view_plot, $user_id_add_set);                
                    $i = 1;
                     foreach ($enteredPlot as $entered){
                         $rowColor          = ($i % 2 != 0) ? '#ffeee1' : '#fff6f0';
                         $binding           = strtoupper($entered['binding']);
                         $folding           = strtoupper($entered['folding']);
                         $order_type        = ($entered['plot_arch'] == '1') ? 'Plotting on Bond' : 'Copies';
                         $type              = ($entered['plot_arch'] == '1') ? '1' : '0';
                         $available_order   = ($entered['plot_arch'] == '1') ? EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'1') : EnteredPlotRecipientsCount($company_id_view_plot, $user_id_add_set,'0');
                         $needed_sets       = ($entered['plot_arch'] == '1') ? PlotSetsNeeded($company_id_view_plot, $user_id_add_set) : ArchSetsNeeded($company_id_view_plot, $user_id_add_set);
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>">
                        <td><?php echo $order_type;?></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="avl_sets_<?php echo $i; ?>" id="avl_sets_<?php echo $i; ?>"  value="<?php echo ($available_order[0]['print_ea'] - $needed_sets); ?>" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty_avl('<?php echo $i; ?>','<?php echo $user_id_add_set; ?>','<?php echo $company_id_view_plot; ?>','<?php echo $type; ?>','<?php echo $entered['id']; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><input style="width: 25px;float: left;padding: 2px;" type="text" name="need_sets_<?php echo $i; ?>" id="need_sets_<?php echo $i; ?>" value="1" /><div class="increse_act"><img src="images/plus_icon.png" style="cursor: pointer;" onclick="return increase_qty('<?php echo $i; ?>');" title="Increase Quantity" alt="Increase Quantity" /><img src="images/minus_icon.png" style="cursor: pointer;" onclick="return decrease_qty('<?php echo $i; ?>');" title="Decrease Quantity" alt="Decrease Quantity" /></div></td>
                        <td><?php echo $entered['size']; ?><input type="hidden" name="size_sets_<?php echo $i; ?>" id="size_sets_<?php echo $i; ?>" value="<?php echo $entered['size']; ?>" /></td>
                        <td><?php echo $entered['output']; ?><input type="hidden" name="output_sets_<?php echo $i; ?>" id="output_sets_<?php echo $i; ?>" value="<?php echo $entered['output']; ?>" /></td>
                        <td><?php echo $binding; ?><input type="hidden" name="binding_sets_<?php echo $i; ?>" id="binding_sets_<?php echo $i; ?>" value="<?php echo $binding; ?>" /></td>
                        <td><?php echo $folding; ?><input type="hidden" name="folding_sets_<?php echo $i; ?>" id="folding_sets_<?php echo $i; ?>" value="<?php echo $folding; ?>" /></td>
                    </tr>
                     <?php 
                      $i++;
                     }
                     ?>
                </table>
            </div>
            
            <?php
            $all_days_off = AllDayOff();                                                        
            foreach ($all_days_off as $days_off_split){
               $all_days_in[]  = $days_off_split['date'];
            }                                                        
            $all_date  = implode(",", $all_days_in);                                                        
            $all_date_exist = str_replace("/", "-", $all_date);
            ?>
        </div>
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <input type="hidden" name="all_exist_date" id="all_exist_date" value="<?php echo $all_date_exist; ?>" />
            <span style="font-weight: bold;">When Needed : </span>
            <input class="picker_icon" type="text" value="ASAP" name="date_needed" id="date_needed" style="width: 75px;" onclick="date_reveal();" value="<?php echo $edit_recipients[0]['shipp_date']; ?>" />
            <input id="time_picker_icon" type="text" value="ASAP" style="width: 75px;margin-left: 4px;" class="time time_picker_icon" alt="Time Picker" title="Time Picker" onclick="return show_time();" />
        </div>
        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <?php
            $checked = ($edit_recipients[0]['delivery_type'] != '0') ? 'checked' : '';
            $display = ($edit_recipients[0]['delivery_type'] != '0') ? '' : 'display: none;';
            $shipp_comp_1 = ($edit_recipients[0]['shipp_comp_1'] != '0') ? 'checked' : '';
            $shipp_comp_2 = ($edit_recipients[0]['shipp_comp_2'] != '0') ? 'checked' : '';
            $shipp_comp_3 = ($edit_recipients[0]['shipp_comp_3'] != '0') ? 'checked' : '';
            $bill_val     = ($edit_recipients[0]['billing_number'] != '0') ? $edit_recipients[0]['billing_number'] : '';
            ?>
            <input type="checkbox" name="arrange_del" id="arrange_del" <?php echo $checked; ?> style="width: 15% !important;" onclick="uncheck_delivery();" /><span style="text-transform: uppercase;">I WANT TO USE MY OWN SHIPPING CARRIER</span>
        </div>
        
        <div id="delivery_info" style="width: 65%;float: left;margin-left: 45px;margin-top: 10px;<?php echo $display; ?>">
            <div style="border: 1px #F99B3E solid;width: 50%;margin-left: 20px;padding: 5px;">
                <ul>
                    <li>
                        <span style="font-weight: bold;">Delivery : </span>
                        <select  name="delivery_comp" id="delivery_comp" style="width: 45% !important;" onchange="return show_address();">                    
                            <option value="1" <?php if($edit_recipients[0]['delivery_type'] == '1'){?> selected="selected" <?php } ?>>Next Day Air</option> 
                            <option value="2" <?php if($edit_recipients[0]['delivery_type'] == '2'){?> selected="selected" <?php } ?>>Two Day Air</option>
                            <option value="3" <?php if($edit_recipients[0]['delivery_type'] == '3'){?> selected="selected" <?php } ?>>Three Day Air</option>
                            <option value="4" <?php if($edit_recipients[0]['delivery_type'] == '4'){?> selected="selected" <?php } ?>>Ground</option>
                        </select>
                    </li>
                    <li>
                        <span style="font-weight: bold;">Billing # :</span> <input type="text" name="bill_number" id="bill_number" value="<?php echo $bill_val; ?>" style="width: 50% !important;margin-bottom: 0px !important;" />
                    </li>
                    <li>
                        <label><span style="font-weight: bold;">Shipping Company : </span></label>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_1" style="width: 10% !important;margin-bottom: 0px !important;" value="FedEx" <?php echo $shipp_comp_1; ?> /> FedEx</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_2" style="width: 10% !important;margin-bottom: 0px !important;" value="UPS" <?php echo $shipp_comp_2; ?> /> UPS</span>
                        <span><input type="radio" name="shipp_comp" id="shipp_comp_3" style="width: 10% !important;margin-bottom: 0px !important;" value="Other" <?php echo $shipp_comp_3; ?> /> Other</span>
                    </li>
                </ul>
            </div>            
        </div>
        
        <div style="font-weight: bold;width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            Special Instructions:            
        </div>        
        <div style="width: 95%;float: left;margin-left: 25px;margin-top: 10px;">
            <textarea name="spl_recipient" id="spl_recipient" rows="3" cols="18" style="width: 200px;height: 40px;"><?php echo $edit_recipients[0]['spl_inc']; ?></textarea>
        </div>
        
    </div>
    </div>
    <?php 
    }else{
    ?>
    <div style="border: 1px #F99B3E solid;padding-bottom: 20px;margin-bottom : 5px;width: 100%;float: left;">
   <div style="width: 100%;float: left;margin-top: 10px;">
        <div style="float: left;width: 48%;margin-left: 10px;font-weight: bold;">RECIPIENT <?php echo $r; ?></div>
        <div style="float: right;width: 20%;font-weight: bold;">
            <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>
            <span title="Delete Recipient" alt="Delete Recipient" style="font-weight: bold;cursor: pointer;" onclick="return delete_recipient('<?php echo $entered_sets['id']; ?>');">Delete</span>
        </div>
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
        <div style="float: left;width: 33%;margin-left: 30px;">  
            <?php 
            $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
            echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; ?>                   
        </div>
        <!-- Address Show End -->
        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
            1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding; ?></br>
         <!--   2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding; ?> -->
        </div>        
        <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
        </div>        
        <?php
        if($entered_sets['delivery_type'] != '0'){
        ?>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <?php
            if($entered_sets['delivery_type'] == '1'){
            $delivery_type = 'Next Day Air';
            }elseif ($entered_sets['delivery_type'] == '2') {
             $delivery_type = 'Two Day Air';           
            }elseif ($entered_sets['delivery_type'] == '3') {
             $delivery_type = 'Three Day Air';     
            }elseif ($entered_sets['delivery_type'] == '4') {
             $delivery_type = 'Ground';  
            }

            $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
            $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
            $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

            echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
            ?>
        </div>
        <?php }else{ ?>                            
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            <span style="font-weight: bold;">Send Via :</span>
        </div>
        <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
            Soho Delivery
        </div>    
        <?php } ?>       
    </div> 
    </div>
    <?php
    }
    $r++;
    } 
    ?>
<?php
}elseif ($_POST['recipients'] == '9_1'){ 
                        
        $user_session_comp      = $_POST['comp_session_id'];
        $user_session           = $_POST['user_session_id'];
        $entered_needed_sets = NeededSets($user_session_comp, $user_session);
        $r = 1;
        foreach ($entered_needed_sets as $entered_sets){
        $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
        $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
        $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
        $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
        $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];  
    ?>
    <div style="font-weight: bold;padding-top: 3px;">RECIPIENT <?php echo $r; ?></div>
        <div style="border: 1px #F99B3E solid;height: 225px;margin-bottom: 5px;">
            <div style="width: 100%;float: left;margin-top: 10px;">                            
                <div style="float: right;font-weight: bold;">
                    <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                </div>

                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
                    echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; 
                    ?>                   
                </div>
                <!-- Address Show End -->

                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding.$plot_folding; ?></br>
                  <!--  2. <?php //echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding; ?> -->
                </div>        
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
                </div>        
                <?php
                if($entered_sets['delivery_type'] != '0'){
                ?>
                <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                    <span style="font-weight: bold;">Send Via :</span>
                </div>
                <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                    <?php
                    if($entered_sets['delivery_type'] == '1'){
                    $delivery_type = 'Next Day Air';
                    }elseif ($entered_sets['delivery_type'] == '2') {
                     $delivery_type = 'Two Day Air';           
                    }elseif ($entered_sets['delivery_type'] == '3') {
                     $delivery_type = 'Three Day Air';     
                    }elseif ($entered_sets['delivery_type'] == '4') {
                     $delivery_type = 'Ground';  
                    }

                    $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
                    $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
                    $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

                    echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
                    ?>
                </div>
                <?php }else{ ?>                            
                <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                    <span style="font-weight: bold;">Send Via :</span>
                </div>
                <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                    Soho Delivery
                </div>    
                <?php } ?>        
            </div>
        </div>
   
<?php
 $r++;
} 
}elseif ($_POST['recipients'] == '6_1'){
    
    $edit_recipient_id  =   $_POST['edit_recipient_id'];
    
    $shipping_id_rec    =   $_POST['shipping_id_rec'];
    $user_session       =   $_POST['user_session'];
    $user_session_comp  =   $_POST['user_session_comp'];
    $date_needed        =   $_POST['date_needed'];
    $spl_recipient      =   $_POST['spl_recipient'];
    
    $avl_sets_1         =   $_POST['avl_sets_1'];
    $need_sets_1        =   $_POST['need_sets_1'];
    $size_sets_1        =   $_POST['size_sets_1'];
    $output_sets_1      =   $_POST['output_sets_1'];
    $binding_sets_1     =   $_POST['binding_sets_1'];
    $folding_sets_1     =   $_POST['folding_sets_1'];
    
    $avl_sets_2         =   $_POST['avl_sets_2'];
    $need_sets_2        =   $_POST['need_sets_2'];
    $size_sets_2        =   $_POST['size_sets_2'];
    $output_sets_2      =   $_POST['output_sets_2'];
    $binding_sets_2     =   $_POST['binding_sets_2'];
    $folding_sets_2     =   $_POST['folding_sets_2'];
    
    $delivery_type      =   $_POST['delivery_type'];
    $bill_number        =   $_POST['bill_number'];
    $shipp_comp_1_f     =   $_POST['shipp_comp_1_f'];
    $shipp_comp_2_f     =   $_POST['shipp_comp_2_f'];
    $shipp_comp_3_f     =   $_POST['shipp_comp_3_f'];    
    
    
    $query = "UPDATE sohorepro_sets_needed
			SET     comp_id         = '" . $user_session_comp . "',
                                usr_id          = '" . $user_session . "',
                                plot_needed     = '" . $need_sets_1 . "',
                                size            = '" . $size_sets_1 . "',
                                output          = '" . $output_sets_1 . "',
                                binding         = '" . $binding_sets_1 . "',
                                folding         = '" . $folding_sets_1 . "',
                                arch_needed     = '" . $need_sets_2 . "',
                                arch_size       = '" . $size_sets_2 . "',
                                arch_output     = '" . $output_sets_2 . "',
                                arch_binding    = '" . $binding_sets_2 . "',
                                arch_folding    = '" . $folding_sets_2 . "',    
                                shipp_id        = '" . $shipping_id_rec ."',
                                shipp_date      = '" . $date_needed . "',
                                spl_inc         = '" . $spl_recipient. "',
                                delivery_type   = '" . $delivery_type ."',
                                billing_number  = '" . $bill_number  ."',
                                shipp_comp_1    = '" . $shipp_comp_1_f. "',
                                shipp_comp_2    = '" . $shipp_comp_2_f. "',
                                shipp_comp_3    = '" . $shipp_comp_3_f. "'  WHERE id = '".$edit_recipient_id."' ";
    
    $sql_result = mysql_query($query);
    
    $entered_needed_sets = NeededSets($user_session_comp, $user_session);
    $r = 1;
    foreach ($entered_needed_sets as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];    
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
?>
<div style="font-weight: bold;padding-top: 3px;">RECIPIENT <?php echo $r; ?></div>
                            <div style="border: 1px #F99B3E solid;width: 100%;float: left;margin-bottom: 5px;">
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;font-weight: bold;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;" onclick="return edit_recipient('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>

                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>
                            <div style="float: left;width: 33%;margin-left: 30px;">  
                                <?php 
                                $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
                                echo $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip']; 
                                ?>                   
                            </div>
                            <!-- Address Show End -->

                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                                1. <?php echo  $entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding.$plot_folding; ?></br>
                               <!-- 2. <?php //echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding; ?> -->
                            </div>        
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                                <span style="font-weight: bold;">Due by : </span><?php echo $entered_sets['shipp_date']; ?>            
                            </div>
                            <?php
                            if($entered_sets['delivery_type'] != '0'){
                            ?>
                            <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                                <span style="font-weight: bold;">Send Via :</span>
                            </div>
                            <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                                <?php
                                if($entered_sets['delivery_type'] == '1'){
                                $delivery_type = 'Next Day Air';
                                }elseif ($entered_sets['delivery_type'] == '2') {
                                 $delivery_type = 'Two Day Air';           
                                }elseif ($entered_sets['delivery_type'] == '3') {
                                 $delivery_type = 'Three Day Air';     
                                }elseif ($entered_sets['delivery_type'] == '4') {
                                 $delivery_type = 'Ground';  
                                }
                                
                                $ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
                                $ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
                                $ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];
                                
                                echo $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];
                                ?>
                            </div>
                            <?php } ?>
                                    
                        </div>
                    </div>
    <?php 
    $r++;
    }
}elseif ($_POST['recipients'] == '0_0'){

$reference  = $_SESSION['ref_val'];

$sql_order_sequence = mysql_query("SELECT id,order_sequence FROM sohorepro_order_master ORDER BY id DESC LIMIT 1");
$object_order_sequence = mysql_fetch_assoc($sql_order_sequence);
$sequence_id = $object_order_sequence['id'];
$sequence = $object_order_sequence['order_sequence'];

$new_sequence = ($sequence + 1);

$query_update   =   "UPDATE sohorepro_order_master
			SET     order_sequence         = '" . $new_sequence . "' WHERE id = '".$sequence_id."'";
mysql_query($query_update); 

$sql_plot = "DELETE FROM sohorepro_plotting_set WHERE user_id = '" . $_SESSION['sohorepro_userid'] . "' ";
mysql_query($sql_plot);

$_SESSION['ordere_sequence'] = $new_sequence;

$query = "INSERT INTO sohorepro_order_master_service
			SET     order_sequence  = '" . $new_sequence . "',
                                comp_id         = '" . $_SESSION['sohorepro_companyid'] . "',
                                user_id         = '" . $_SESSION['sohorepro_userid'] . "',
                                reference       = '" . $reference."'   ";
$sql_result = mysql_query($query); 

$order_id_service = mysql_insert_id();
    
$select_fav = "UPDATE sohorepro_sets_needed SET order_id = '".$order_id_service."', ordered = '1' WHERE comp_id = '".$_SESSION['sohorepro_companyid']."' AND usr_id = '".$_SESSION['sohorepro_userid']."' AND ordered = '0' " ;
mysql_query($select_fav); 

$job_reference_final = ShowOrderedSets($_SESSION['ordere_sequence']);


$mail_id = getActiveEmailOrder();  
$entered_needed_sets_final = SetsOrderedFinalize($job_reference_final[0]['id']);
$message .= '<div style="border:3px solid #FF7E00;">';   
$message .= '<table>';
$message .= '<tr>';
$message .= '<td colspan="3" align="left" valign="top" style="padding-top: 30px;padding-left: 10px;color:#FF7E00;">';
$message .= '<div style="width: 100%;float: left;">PLOTTING >> COPY SHOP >> DELIVERY >> CONFIRMATION >> ORDER COMPLETE</div>';
$message .= '<div style="width: 100%;float: left;font-size: 21px;">ORDER COMPLETE : ORDER # '.$job_reference_final[0]['order_sequence'].'</div>';
$message .= '<div style="width: 100%;float: left;">JOB REFERENCE  : '.$reference.'</div>';
$message .= '</td></tr>';

$message .= '<tr>';
$message .= '<td colspan="3" style="padding-top: 30px;padding-left: 10px;padding-bottom: 10px;">';
        
 $r = 1;
foreach ($entered_needed_sets_final as $entered_sets){
    $shipp_add = SelectIdAddress($entered_sets['shipp_id']);  
    $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
    $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
    $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
    $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];    
$message .= '<div style="font-weight: bold;padding-top: 3px;">RECIPIENT '.  $r.'</div>';
$message .= '<div style="border: 1px #F99B3E solid;width: 98%;float: left;margin-bottom: 10px;">';
$message .= '<div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">';
$message .= '<div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to :</div>';
$message .= '<div style="float: left;width: 33%;margin-left: 30px;">'; 
$add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'].',<br>';
$message .= $shipp_add[0]['company_name'].'<br>'.$shipp_add[0]['address_1'].',<br>'.$add_2.$shipp_add[0]['city'].',&nbsp;'.StateName($shipp_add[0]['state']).'&nbsp;'.$shipp_add[0]['zip'];                                   
$message .= '</div>';
$message .= '<div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>';
$message .= '<div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">';
$message .= '<div style="float: left;width: 100%;">1.'.$entered_sets['plot_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['size'].','.$entered_sets['output'].$plot_binding.$plot_folding.'</div>';
//$message .= '<div style="float: left;width: 100%;">2.'.$entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding.'</div>';
$message .= '</div>';        
$message .= '<div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">';
$message .= '<span style="font-weight: bold;">Due by : </span>'.$entered_sets['shipp_date'];
$message .= '</div>';
if($entered_sets['delivery_type'] != '0'){
$message .= '<div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">';
$message .= '<span style="font-weight: bold;">Send Via :</span>';
$message .= '</div>';
$message .= '<div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">';
if($entered_sets['delivery_type'] == '1'){
$delivery_type = 'Next Day Air';
}elseif ($entered_sets['delivery_type'] == '2') {
 $delivery_type = 'Two Day Air';           
}elseif ($entered_sets['delivery_type'] == '3') {
 $delivery_type = 'Three Day Air';     
}elseif ($entered_sets['delivery_type'] == '4') {
 $delivery_type = 'Ground';  
}                                
$ship_type_1    =   ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
$ship_type_2    =   ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
$ship_type_3    =   ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];                                
$message .= $ship_type_1.$ship_type_2.$ship_type_3.',&nbsp;'.$delivery_type.',&nbsp;Billing#'.$entered_sets['billing_number'];                              
$message .= '</div>';
}else{
$message .= '<div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">';
$message .= '<span style="font-weight: bold;">Send Via :</span>';
$message .= '</div>';
$message .= '<div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">';
$message .= 'Soho Delivery</div>';    
}                                    
$message .= '</div></div>';
$r++;
}   
$message .='</td>';
$message .= '</tr>';
$message .= '</table>'; 
$message .= '</div>'; 

$user_mail              = array('email_id' => UserMail($final_usr_id));
//$customer_email = CompanyMail($company_id);
    $customer_email = array('email_id' => CompanyMail($final_comp_id));
    array_push($mail_id, $user_mail, $customer_email);


    foreach ($mail_id as $mails_sent) {
        $pre_filt[] = $mails_sent['email_id'];
    }

    $final_list = array_unique($pre_filt);

    foreach ($final_list as $to) {
        $subject = "Soho Repro Plotting Sets " . $reference;
        $headers = 'From: "SohoRepro" <noreply@sohorepro.com>' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-Type: text/html; charset=utf-8\r\n' . "X-Mailer: PHP";
        $headers .= 'Content-Transfer-Encoding: 8bit\r\n\r\n';
        $result = mail($to, stripslashes($subject), stripslashes($message), $headers);
    }
    
    if ($result == TRUE) {
        echo '1';
    } else {
        echo '0';
    }
    
}elseif ($_POST['recipients'] == '0_1'){
    
    $comp_id_0_1    =   $_POST['comp_id_0_1'];
    $usr_id_0_1     =   $_POST['usr_id_0_1'];
    unset($_SESSION['order_number']);
    unset($_SESSION['shipp_selected_id']);
    unset($_SESSION['final_ord_id']);
    unset($_SESSION['ref_val']);
    echo '1';
}
?>