<?php 
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);

$entered_needed_sets_lfp = SetsOrderedFinalize('125');
if($entered_needed_sets_lfp){
echo 'Working'; 
}else{
    echo "not wrking";
}

           
                        if($entered_needed_sets[0]['delivery_type_option'] == '1'){
                         ?>
                        <div>
                            <h2 style="color: #79A70A; font-size: 15px;">PLOTTING & ARCHITECTURAL COPIES</h2>
                        </div>
                  
                        <div style="float: left;margin-top: 6px;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_1('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                RETURN EVERYTHING TO MY OFFICE
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($entered_needed_sets[0]['shipp_id'] != 'P1') && ($entered_needed_sets[0]['shipp_id'] != "P2")){
                    $cust_add = getCustomeInfo($entered_needed_sets[0]['shipp_id']);
                    $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';
                    $attention_ev   =   ($_SESSION['attention_every'] != '') ? 'Attention:&nbsp;'.$_SESSION['attention_every'].'<br>' : '';
                    $tel_eve       =   ($_SESSION['tel_every'] != '') ? 'Tel:&nbsp;'.$_SESSION['tel_every'].'<br>' : '';
                    echo $cust_add[0]['comp_name'] . '<br>' .$attention_ev.$tel_eve. $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . '&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];                    
                    }else{
                    $pic_address = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                    echo $pic_address[0]['address'];
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
             
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_needed_sets[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_needed_sets[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_needed_sets[0]['shipp_comp_1'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_1'];
                        $ship_type_2 = ($entered_needed_sets[0]['shipp_comp_2'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_2'];
                        $ship_type_3 = ($entered_needed_sets[0]['shipp_comp_3'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_needed_sets[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_needed_sets[0]['spl_inc'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets[0]['spl_inc']; ?>
                    </div>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                    
                </div>
                        </div>
                    </div>
                    <?php  
                        }elseif ($entered_needed_sets[0]['delivery_type_option'] == '2') {
                            if(($entered_needed_sets[0]['shipp_id'] == 'P1') && ($entered_needed_sets[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_needed_sets[0]['shipp_id']);  
                            }
                    ?>   <div>
                            <h2 style="color:#79A70A;; font-size: 15px;">PLOTTING & ARCHITECTURAL COPIES</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_2('<?php echo $entered_sets['id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                SEND EVERYTHING TO
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Send to: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php 
                    if(($entered_needed_sets[0]['shipp_id'] != 'P1') && ($entered_needed_sets[0]['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($entered_needed_sets[0]['attention_to'] != "undefined") ? '<br>Attention:  '.$entered_needed_sets[0]['attention_to'] : '';
                    $phone  = ($entered_needed_sets[0]['contact_ph'] != "") ? '<br>'.'Tel:  '.$entered_needed_sets[0]['contact_ph'] : '';
                    //$phone      =   ($phone_pre != '') ? $phone_pre : '';
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3. $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
                
          
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_needed_sets[0]['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_needed_sets[0]['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_needed_sets[0]['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_needed_sets[0]['shipp_comp_1'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_1'];
                        $ship_type_2 = ($entered_needed_sets[0]['shipp_comp_2'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_2'];
                        $ship_type_3 = ($entered_needed_sets[0]['shipp_comp_3'] == '0') ? '' : $entered_needed_sets[0]['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_needed_sets[0]['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_needed_sets[0]['spl_inc'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets[0]['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>  
                    <?php
                        }elseif ($entered_needed_sets[0]['delivery_type_option'] == '3') {                       
                         if(($entered_needed_sets[0]['shipp_id'] == 'P1') && ($entered_needed_sets[0]['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_needed_sets[0]['shipp_id']);  
                            }
                            
                            $cust_add = AddressBookPickupSohoCap($entered_needed_sets[0]['shipp_id']);
                    ?>   <div>
                            <h2 style="color: #79A70A; font-size: 15px;">PLOTTING & ARCHITECTURAL COPIES</h2>
                        </div>
                         <div style="float: left;" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT</span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">    
                            
                          
                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_3('<?php echo $entered_needed_sets[0]['shipp_id']; ?>');">Edit</span>                               
                            </div>
                            
<!--                            <div style="float:left;width: 100%;text-align: center;font-weight: bold;">
                                WILL PICKUP FROM SOHO REPRO - <?php echo $cust_add[0]['caption']; ?>
                            </div>-->
                            
                            <div class="details_div">
                    
                <!-- Customer Details Start -->
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">Pickup By: </div>
                
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php                   
                    //$cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2']. '<br>'  : '';                    
                    //echo $cust_add[0]['address'];
                    $cust_add_p = getCustomeInfo($user_session_comp);
                    $cust_add_2 = ($cust_add_p[0]['comp_business_address2'] != '') ? $cust_add_p[0]['comp_business_address2']. '<br>'  : '';                    
                    echo $cust_add_p[0]['comp_name'] . '<br>' . $cust_add_p[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add_p[0]['comp_city'] . ',&nbsp;' . $cust_add_p[0]['comp_state'] . '&nbsp;' . $cust_add_p[0]['comp_zipcode'].'<br>'.$cust_add_p[0]['comp_contact_phone'];
                    ?>                   
                </div>                
                <!-- Customer Details End -->                    
                                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 92%;margin-left: 30px;margin-top: 5px;">
                    <?php
                    $cust_original_order    = EnteredPlotRecipients($user_session_comp, $user_session);
                    
                    //$cust_needed_originals  = $cust_original_order[0]['origininals'];
                    
                    //$cust_needed_sets       = ($cust_original_order[0]['print_ea'] != '0') ? $cust_original_order[0]['print_ea'] : $cust_original_order[0]['arch_needed'];
                    //$cust_order_type        = ($cust_original_order[0]['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
                    $option                 = ($cust_original_order[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';  
                    ?>
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Originals</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <?php
//                        echo '<pre>';
//                        print_r($cust_original_order);
//                        echo '</pre>';
                        
                        foreach ($cust_original_order as $original){                            
                            $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                            $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';                               
                            $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                            $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                            $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                            $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                            $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];                            
                        ?>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $original['options']; ?></td>
                            <td><?php echo $original['origininals']; ?></td>
                            <td><?php echo $cust_needed_sets; ?></td>
                            <td><?php echo $cust_order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucfirst($binding); ?></td>
                            <td><?php echo ucfirst($folding); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                   
                </div>
          
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_needed_sets[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets[0]['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_needed_sets[0]['shipp_date'].$date_asap; ?>            
                </div>        
                <?php if($entered_needed_sets[0]['spl_inc'] != ''){ ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_needed_sets[0]['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php
                        }else{    
                            if($entered_needed_sets){
                    ?>
                        <div class="def_class" style=";margin-bottom: 10px;margin-top: 10px;color: #4285F4;font-weight: bold; font-size: 17px;">
                PLOTTING &amp; ARCHITECTURAL COPIES
            </div>
                    <?php                        
                       
                        $r = 1;
                        foreach ($entered_needed_sets as $entered_sets){
                            if(($entered_sets['shipp_id'] == 'P1') && ($entered_sets['shipp_id'] == 'P2')){
                                $shipp_add = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                            }else{
                                $shipp_add = editAddressServices($entered_sets['shipp_id']);  
                            }
                        $needed_options  =   $entered_sets['option_id'];
                        $needed_sets  = ($entered_sets['plot_needed'] != '0') ? $entered_sets['plot_needed'] : $entered_sets['arch_needed'];
                        $order_type   = ($entered_sets['arch_needed'] != '0') ? 'Architectural Copies' : 'Plotting on Bond';
                        $plot_binding = ($entered_sets['binding'] == '0') ? '' : ','.$entered_sets['binding'];
                        $plot_folding = ($entered_sets['folding'] == '0') ? '' : ','.$entered_sets['folding'];
                        $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ','.$entered_sets['arch_binding'];
                        $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ','.$entered_sets['arch_folding'];
                        $size         = ($entered_sets['size'] == 'undefined') ? $entered_sets['arch_size'] : $entered_sets['size'];
                        $output       = ($entered_sets['output'] == 'undefined') ? $entered_sets['arch_output'] : $entered_sets['output'];
                        $media        = ($entered_sets['media'] == 'undefined') ? $entered_sets['arch_media'] : $entered_sets['media'];
                        $binding      = ($entered_sets['binding'] == 'undefined') ? $entered_sets['arch_binding'] : $entered_sets['binding'];
                        $folding      = ($entered_sets['folding'] == 'undefined') ? $entered_sets['arch_folding'] : $entered_sets['folding'];
                    ?> 
                            
                        <div style="float: left;" id="option_4_<?php echo $entered_sets['id']; ?>" class="shaddows">
                            <div class="ribbon" id="ribbon_final"><span>RECIPIENT <?php echo $r; ?></span></div>
                        <div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">                            
                            <div style="float: right;">
                                <span title="Edit Recipient" alt="Edit Recipient" style="font-weight: bold;cursor: pointer;padding-right: 15px;font-weight: bold;padding-right: 15px;background: #009C58;color: #FFF;padding: 2px 10px;border-radius: 5px;margin-top: 3px;margin-right: 15px;" onclick="return edit_recipient_option_4('<?php echo $entered_sets['id']; ?>', '<?php echo $r; ?>');">Edit</span>                               
                            </div>
                            <div class="details_div">
                            <div style="float: left;width: 65%;margin-left: 30px;margin-top: 10px;font-weight: bold;">Send to: </div>
                <div style="float: left;width: 33%;margin-left: 30px;">  
                    <?php
                    if(($entered_sets['shipp_id'] != 'P1') && ($entered_sets['shipp_id'] != 'P2')){
                    $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
                    $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
                    $att    = ($entered_sets['attention_to'] != "undefined") ? '<br>Attention:  '.$entered_sets['attention_to'] : '';
                    $phone  = ($entered_sets['contact_ph'] != "") ? '<br>'.'Tel:  '.$entered_sets['contact_ph'] : '';
                    //$phone      =   ($phone_pre == "Tel:") ? $phone_pre : "";
                    echo $shipp_add[0]['company_name'].$att.$phone.'<br>'. $shipp_add[0]['address_1'] . '<br>' . $add_2.$add_3 . $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'].'<br>'.$shipp_add[0]['phone'];
                    }  else {                    //echo $shipp_add[0]['address'];                        
                    $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                    echo $shipp_add_p[0]['address'];   
                    }
                    ?>                   
                </div>
                <!-- Address Show End -->

                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    
                    <table border="1" style="width: 100%;">
                        <tr bgcolor="#BFC5CD">
                            <td style="font-weight: bold;">Option</td> 
                            <td style="font-weight: bold;">Sets</td> 
                            <td style="font-weight: bold;">Order Type</td>                            
                            <td style="font-weight: bold;">Size</td>
                            <td style="font-weight: bold;">Output</td>
                            <td style="font-weight: bold;">Media</td>
                            <td style="font-weight: bold;">Binding</td>
                            <td style="font-weight: bold;">Folding</td>
                        </tr>
                        <tr bgcolor="#F8F8F8">
                            <td><?php echo $needed_options; ?></td>
                            <td><?php echo $needed_sets; ?></td>
                            <td><?php echo $order_type; ?></td>                            
                            <td><?php echo $size; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $output; ?></td>
                            <td><?php echo $media; ?></td>
                            <td><?php echo ucwords(strtolower($binding)); ?></td>
                            <td><?php echo ucwords(strtolower($folding)); ?></td>
                        </tr>
                    </table>
                    
                    <!--   1. <?php // echo $entered_sets['plot_needed'] . '&nbsp;Sets Plotting on Bond,' . $entered_sets['size'] . ',' . $entered_sets['output'] . $plot_binding . $plot_folding; ?></br>-->
                    <!--   2. <?php // echo  $entered_sets['arch_needed'].'&nbsp;Sets Plotting on Bond,'. $entered_sets['arch_size'].','.$entered_sets['arch_output'].$arch_binding.$arch_folding;   ?> -->
                </div>
                
                <?php 
                if($entered_sets['size'] == 'Custom'){
                ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    <div style="font-weight: bold;width: 100%;float: left;">
                        Custom Size Details: 
                    </div>
                    <div style="padding-top: 3px;">                    
                        <?php echo $entered_sets['custome_details']; ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php 
                if($entered_sets['output'] == 'Both'){
                ?>
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 5px;">
                    <div style="font-weight: bold;width: 100%;float: left;">
                        Color Page Number:
                    </div>
                    <div style="padding-top: 3px;">                    
                        <?php echo $entered_sets['output_page_number']; ?>
                    </div>
                </div>
                <?php } ?>
                
                <div style="float: left;width: 65%;margin-left: 30px;margin-top: 7px;">
                    <?php
                    $date_asap  = ($entered_sets['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_sets['shipp_time'] : '';
                    ?>
                    <span style="font-weight: bold;">When Needed: </span><?php echo $entered_sets['shipp_date'].$date_asap; ?>            
                </div>        
                <?php
                if ($entered_sets['delivery_type'] != '0') {
                    ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php
                        if ($entered_sets['delivery_type'] == '1') {
                            $delivery_type = 'Next Day Air';
                        } elseif ($entered_sets['delivery_type'] == '2') {
                            $delivery_type = 'Two Day Air';
                        } elseif ($entered_sets['delivery_type'] == '3') {
                            $delivery_type = 'Three Day Air';
                        } elseif ($entered_sets['delivery_type'] == '4') {
                            $delivery_type = 'Ground';
                        }

                        $ship_type_1 = ($entered_sets['shipp_comp_1'] == '0') ? '' : $entered_sets['shipp_comp_1'];
                        $ship_type_2 = ($entered_sets['shipp_comp_2'] == '0') ? '' : $entered_sets['shipp_comp_2'];
                        $ship_type_3 = ($entered_sets['shipp_comp_3'] == '0') ? '' : $entered_sets['shipp_comp_3'];

                        echo $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_sets['billing_number'];
                        ?>
                    </div>
                <?php } else { ?>                            
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Send Via: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        SOHO TO ARRANGE DELIVERY
                    </div>    
                <?php }if($entered_sets['spl_inc'] != ''){  ?>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <span style="font-weight: bold;">Special Instructions: </span>
                    </div>
                    <div style="width: 100%;float: left;margin-left: 30px;margin-top: 7px;">
                        <?php echo $entered_sets['spl_inc']; ?>
                    </div>
                <?php } ?>
                        </div>
                        </div>
                    </div>
                    <?php 
                    $r++;
                    } 
                        } }

















?>