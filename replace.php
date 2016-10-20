<?php

//    $message_pdf .= '<style>';
//    $message_pdf .= '.shaddows{background: white;border-radius: 10px;-webkit-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);-moz-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);box-shadow: 0px 0px 8px rgba(0,0,0,0.3);position: relative;z-index: 90;}';
//    $message_pdf .= '</style>';
    $message_pdf = '<!DOCTYPE html><html>';
    $message_pdf .= '<body>';
    $message_pdf .= '<div style="border:0px solid #FF7E00;width: 90%;float: left;">';
    $message_pdf .= '<table style="width: 100%;">';
    $message_pdf .= '<tr>';
    $message_pdf .= '<td align="left" valign="top" style="padding-left: 10px;">';
    $message_pdf .= '<div style="width: 100%;float: left;font-size: 21px;margin-bottom:5px;">Order Completed: ORDER # ' . $job_reference_final[0]['order_sequence'] . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;font-size: 21px;margin-bottom:5px;">Customer Type: ' . $cus_type . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:7px;"><span style="font-weight:bold;">Customer Reference:</span> ' . $reference . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:7px;"><span style="font-weight:bold;">Date:</span> ' . $Date . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:7px;"><span style="font-weight:bold;">Name:</span> ' . $user_name . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:7px;"><span style="font-weight:bold;">Company:</span> ' . $customer_name . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:7px;"><span style="font-weight:bold;">Email:</span> ' . $user_mail_id_txt . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:7px;"><span style="font-weight:bold;">Phone:</span>&nbsp;' . $phone . '</div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:5px"><span style="font-weight:bold;">Billing Address:</span></div>';
    $message_pdf .= '<div style="width: 100%;float: left;margin-bottom:5px">' . $service_billing_address[0]['comp_name'] . '<br>' . $service_address_1 . $service_address_2 . $service_address_3 . $service_billing_address[0]['comp_city'] . ',&nbsp;' . $service_billing_address[0]['comp_state'] . '&nbsp;' . $service_billing_address[0]['comp_zipcode'] . '</div>';
    $message_pdf .= '</td></tr><tr>';

    $message_pdf .= '<td style="padding-top: 10px;padding-left: 10px;padding-bottom: 10px;">';

    //Original Order Start
    //$message_pdf .= '<div style="width: 95%;float: left;height:2px;background-color: #F99B3E;margin-top: 10px;margin-bottom: 10px"></div>';
    $message_pdf .= '<div style="float: left;margin-bottom: 20px;width: 100%;">';
    $message_pdf .= '<div style="font-weight: bold;padding-top: 3px;width: 95%;float: left;">ORIGINAL ORDER</div>';
    $message_pdf .= '<div style="width: 95%;float: left;margin-top: 10px;margin-bottom: 10px;">';

    $message_pdf .= '<div style="float: left;width: 100%;">';
    if ($entered_needed_sets_final[0]['delivery_type_option'] != '1') {
        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;">Customer Details:</div>';

        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;">';
        $cust_add = getCustomeInfo($_SESSION['sohorepro_companyid']);
        $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2'] . ',<br>' : '';
        $message_pdf .= $cust_add[0]['comp_name'] . '<br>' . $cust_add[0]['comp_business_address1'] . ',<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . ',&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'] . '<br>' . $cust_add[0]['comp_contact_phone'];
        $message_pdf .= '</div>';


        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>';
    }
    $message_pdf .= '<div style="float: left;width: 100%;margin-top: 5px;">';
    //$cust_original_order_pdf = SetsOrderedFinalize($job_reference_final[0]['id']);
    $cust_original_order_pdf = EnteredPlotRecipientsMultiOriginal($user_session_comp, $user_session, $job_reference_final[0]['id']);
    $total_plot_needed = SetsOrderedFinalizeCountOfSets($job_reference_final[0]['id']);
    $cust_original_order_pdf_final = SetsOrderedFinalizeOriginal($job_reference_final[0]['id']);
    $upload_file_exist = UploadFileExistFinalize($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid'], $job_reference_final[0]['id']);
    $cust_needed_sets = ($cust_original_order_pdf[0]['print_ea'] != '0') ? $cust_original_order_pdf[0]['print_ea'] : $cust_original_order_pdf[0]['arch_needed'];
    $cust_order_type = ($cust_original_order_pdf[0]['arch_needed'] != '0') ? 'Architectural Copies' : 'Plotting on Bond';
    $option = ($cust_original_order_pdf[0]['arch_needed'] != '0') ? 'Pickup Options:' : 'File Options:';
    $message_pdf .= '<table border="0" style="width: 100%;">';
    $message_pdf .= '<tr bgcolor="#F99B3E">';
    $message_pdf .= '<td style="font-weight: bold;">Option</td>';
    $message_pdf .= '<td style="font-weight: bold;">Originals</td>';
    $message_pdf .= '<td style="font-weight: bold;">Sets</td>';
    $message_pdf .= '<td style="font-weight: bold;">Order Type</td>';
    $message_pdf .= '<td style="font-weight: bold;">Size</td>';
    $message_pdf .= '<td style="font-weight: bold;">Output</td>';
    $message_pdf .= '<td style="font-weight: bold;">Media</td>';
    $message_pdf .= '<td style="font-weight: bold;">Binding</td>';
    $message_pdf .= '<td style="font-weight: bold;">Folding</td>';
    $message_pdf .= '</tr>';
    foreach ($cust_original_order_pdf as $original) {
        $cust_needed_sets = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
        $cust_order_type = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
        $size = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
        $output = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
        $media = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
        $binding = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
        $folding = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];
        $message_pdf .= '<tr bgcolor="#ffeee1">';
        $message_pdf .= '<td>' . $original['options'] . '</td>';
        $message_pdf .= '<td>' . $original['origininals'] . '</td>';
        $message_pdf .= '<td>' . $cust_needed_sets . '</td>';
        $message_pdf .= '<td>' . $cust_order_type . '</td>';
        $message_pdf .= '<td>' . $size . '</td>';
        $message_pdf .= '<td style="text-transform: uppercase;">' . $output . '</td>';
        $message_pdf .= '<td>' . $media . '</td>';
        $message_pdf .= '<td>' . ucfirst($binding) . '</td>';
        $message_pdf .= '<td>' . ucfirst($folding) . '</td>';
        $message_pdf .= '</tr>';
    }
    $message_pdf .= '</table>';
    $message_pdf .= '</div>';
    $message_pdf .= '</div>';
    $enteredPlot = EnteredPlotRecipientsMultiOriginal($user_session_comp, $user_session, $job_reference_final[0]['id']);

    //New Format Start

    foreach ($cust_original_order_pdf_final as $original) {
        $message_pdf .= '<div style="float:left;width: 95%;margin-top: 10px;">';
        $message_pdf .= '<div style="float:left;width: 95%;font-weight: bold;color: #000;margin-top: 7px;font-weight:bold;"> OPTION&nbsp;' . $original['options'] . '&nbsp;- Details</div>';
        if ($original['size'] == 'Custom') {
            $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Custom Size:&nbsp;' . $original['custome_details'] . '</div>';
        }
        if ($original['output'] == 'Both') {
            $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Color Page Numbers:&nbsp;' . $original['output_both'] . '</div>';
        }
        if ($original['spl_instruction'] != '') {
            $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Special Instructions:&nbsp;' . $original['spl_instruction'] . '</div>';
        }
        if ($original['ftp_link'] != "0") {
            $link = ($original['ftp_link'] != '0') ? $original['ftp_link'] : '';
            $user_name = ($original['user_name'] != '0') ? $original['user_name'] : '';
            $password = ($original['password'] != '0') ? $original['password'] : '';
            if ($original['use_same_alt'] == "0") {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">File Option: Provide Link to a File</div>';
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">FTP Link:&nbsp;' . $link . '</div>';
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">User Name:&nbsp;' . $user_name . '</div>';
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Password:&nbsp;' . $password . '</div>';
            } else {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">File Option: Provide Link to a File</div>';
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Use same file as Option&nbsp;' . $original['use_same_alt'] . '</div>';
            }
        }

        if ($original['upload_file'] != "") {
            if ($original['use_same_alt'] == "0") {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">File Option: Upload a file</div>';
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;"><a href="http://cipldev.com/supply-new.sohorepro.com/uploads/' . $original['upload_file'] . '" target="_blank">' . $original['upload_file'] . '</a></div>';
            } else {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">File Option: Upload a file</div>';
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Use same file as Option&nbsp;' . $original['use_same_alt'] . '</div>';
            }
        }

        if ($original['drop_off'] != "0") {
            if ($original['use_same_alt'] == "0") {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Drop-Off Option:&nbsp;' . $original['drop_off'] . '</div>';
            } else {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Drop-Off Option:&nbsp;Use same file as Option&nbsp;' . $original['use_same_alt'] . '</div>';
            }
        }

        if ($original['pick_up'] != "0") {
            if (($original['pick_up'] == "ASAP") && ($original['pick_up_time'] == "ASAP")) {
                $pickup_details = $original['pick_up'];
            } else {
                $pickup_details = $original['pick_up'] . '&nbsp;' . $original['pick_up_time'];
            }
            if ($original['use_same_alt'] == "0") {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Pickup Option:&nbsp;' . $pickup_details . '</div>';
            } else {
                $message_pdf .= '<div style="float:left;width: 95%;color: #000;margin-top: 7px;">Pickup Option:&nbsp;Use same file as Option&nbsp;' . $original['use_same_alt'] . '</div>';
            }
        }

        $message_pdf .= '</div>';
    }
    // New Format End

    $message_pdf .= '</div>';
    $message_pdf .= '</div>';
    //Original Order End

    if ($entered_needed_sets_final[0]['delivery_type_option'] == '1') {
        $message_pdf .= '<div style="float: left;width: 100%;">';
        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;margin-bottom: 20px;">DELIVERY METHOD: RETURN EVERYTHING TO MY OFFICE</div>';
        $message_pdf .= '</div>';
    } elseif ($entered_needed_sets_final[0]['delivery_type_option'] == '2') {
        $message_pdf .= '<div style="float: left;width: 100%;">';
        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;margin-bottom: 20px;">DELIVERY METHOD: SEND EVERYTHING TO </div>';
        $message_pdf .= '</div>';
    } elseif ($entered_needed_sets_final[0]['delivery_type_option'] == '3') {
        $message_pdf .= '<div style="float: left;width: 100%;">';
        $pickup_from_soho_add = $_SESSION['pickup_from_soho_add'];
        $address_caption = AddressBookPickupSoho($pickup_from_soho_add);
        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;margin-bottom: 20px;">DELIVERY METHOD: WILL PICKUP FROM SOHO REPRO - ' . $address_caption[0]['caption'] . '</div>';
        $message_pdf .= '</div>';
    } else {
        $message_pdf .= '<div style="float: left;width: 100%;">';
        $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;margin-bottom: 20px;">DELIVERY METHOD: DISTRIBUTE TO ONE OR MORE LOCATIONS</div>';
        $message_pdf .= '</div>';
        $message_pdf .= '<hr style="border-top: 1px solid #FF7E00;">';
    }

    if ($entered_needed_sets_final[0]['delivery_type_option'] == '1') {
        $message_pdf .= '<div style="float: left;" class="shaddows">';
        $message_pdf .= '<div class="ribbon" id="ribbon_final" style="font-weight: bold;"><span>RECIPIENT:</span></div>';
        $message_pdf .= '<div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">';
        $message_pdf .= '<div class="details_div">';
        $message_pdf .= '<div style="float: left;width: 65%;margin-top: 7px;font-weight: bold;">Send to: </div>';
        $message_pdf .= '<div style="float: left;width: 65%;text-align:left;">';
        $cust_add = getCustomeInfo($user_session_comp);
        $cust_add_2 = ($cust_add[0]['comp_business_address2'] != '') ? $cust_add[0]['comp_business_address2'] . '<br>' : '';
        $attention_ev = ($_SESSION['attention_every'] != '') ? 'Attention:&nbsp;' . $_SESSION['attention_every'] . '<br>' : '';
        $tel_eve = ($_SESSION['tel_every'] != '') ? 'Tel:&nbsp;' . $_SESSION['tel_every'] . '<br>' : '';
        $message_pdf .= '<div style="float: left;width: 200px;">' . $cust_add[0]['comp_name'] . '<br>' . $attention_ev . $tel_eve . $cust_add[0]['comp_business_address1'] . '<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . '&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'] . '<br>' . $cust_add[0]['comp_contact_phone'] . '</div>';
        $message_pdf .= '</div>';
    } elseif ($entered_needed_sets_final[0]['delivery_type_option'] == '2') {

        if (($entered_needed_sets_final[0]['shipp_id'] == 'P1') && ($entered_needed_sets_final[0]['shipp_id'] == 'P2')) {
            $shipp_add = AddressBookPickupSohoCap($entered_needed_sets_final[0]['shipp_id']);
        } else {
            $shipp_add = editAddressServices($entered_needed_sets_final[0]['shipp_id']);
        }
        $message_pdf .= '<div style="float: left;" class="shaddows">';
        $message_pdf .= '<div class="ribbon" style="font-weight: bold;" id="ribbon_final"><span>RECIPIENT</span></div>';
        $message_pdf .= '<div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">';
        $message_pdf .= '<div class="details_div">';
        $message_pdf .= '<div style="float: left;width: 65%;margin-top: 7px;font-weight: bold;">Send to: </div>';
        $message_pdf .= '<div style="float: left;width: 65%;">';
        if (($entered_needed_sets_final[0]['shipp_id'] != 'P1') && ($entered_needed_sets_final[0]['shipp_id'] != 'P2')) {
            $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . '<br>';
            $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . '<br>';
            $att = ($entered_needed_sets_final[0]['attention_to'] != "undefined") ? '<br>Attention:  ' . $entered_needed_sets_final[0]['attention_to'] : '';
            $phone = ($entered_needed_sets_final[0]['contact_ph'] != "undefined") ? '<br>' . 'Contact:  ' . $entered_needed_sets_final[0]['contact_ph'] : '';
            $message_pdf .= '<div style="float: left;width: 260px;">' . $shipp_add[0]['company_name'] . $att . $phone . '<br>' . $shipp_add[0]['address_1'] . '<br>' . $add_2 . $add_3 . $shipp_add[0]['city'] . '&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'] . '<br>' . $shipp_add[0]['phone'] . '</div>';
        } else {                    //echo $shipp_add[0]['address'];                        
            $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
            $message_pdf .= '<div style="float: left;">' . $shipp_add_p[0]['address'] . '</div>';
        }
        $message_pdf .= '</div>';
        $message_pdf .= '<div style="float: left;width: 65%;margin-top: 7px;">';
        $date_asap = ($entered_needed_sets_final[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets_final[0]['shipp_time'] : '';
        $message_pdf .= '<span style="font-weight: bold;">When Needed: </span>' . $entered_needed_sets_final[0]['shipp_date'] . $date_asap . '</div>';
        if ($entered_needed_sets_final[0]['spl_inc'] != '') {
            $message_pdf .= '<div style="width: 100%;float: left;margin-top: 7px;">';
            $message_pdf .= '<span style="font-weight: bold;">Special Instructions: </span></div>';
            $message_pdf .= '<div style="width: 100%;float: left;margin-top: 7px;">' . $entered_needed_sets_final[0]['spl_inc'] . '</div></div></div></div>';
        }
    } elseif ($entered_needed_sets_final[0]['delivery_type_option'] == '3') {


        $pickup_from_soho_add = $_SESSION['pickup_from_soho_add'];
        $address_caption = AddressBookPickupSoho($pickup_from_soho_add);

        $cust_user_add = UserLoginDtls($_SESSION['sohorepro_userid']);
        $cust_user_name = $cust_user_add[0]['cus_fname'] . '&nbsp;' . $cust_user_add[0]['cus_lname'];
        $cust_mail_id = $cust_user_add[0]['cus_email'];
        $cust_phone_num = $cust_user_add[0]['cus_contact_phone'];
        //$message_pdf .= $cust_user_name . '<br>' . $cust_mail_id . '<br>' . $cust_phone_num;  
        //$message_pdf .= $cust_add[0]['comp_name'] . '<br>' . $cust_add[0]['comp_business_address1'] . ',<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . ',&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'].'<br>'.$cust_add[0]['comp_contact_phone'];

        $message_pdf .= '<div style="float: left;" class="shaddows">';
        $message_pdf .= '<div class="ribbon" id="ribbon_final" style="font-weight: bold;"><span>RECIPIENT</span></div>';
        $message_pdf .= '<div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;"><div class="details_div">';
        $message_pdf .= '<div style="float: left;width: 65%;margin-top: 7px;font-weight: bold;">Pickup at: </div>';
        $message_pdf .= '<div style="float: left;width: 65%;">';
        $message_pdf .= '<div style="float: left;">' . $cust_add[0]['comp_name'] . '<br>' . $cust_add[0]['comp_business_address1'] . ',<br>' . $cust_add_2 . $cust_add[0]['comp_city'] . ',&nbsp;' . $cust_add[0]['comp_state'] . '&nbsp;' . $cust_add[0]['comp_zipcode'] . '<br>' . $cust_add[0]['comp_contact_phone'] . '</div>';

        $message_pdf .= '</div>';
        $message_pdf .= '<div style="float: left;width: 65%;margin-top: 7px;font-weight: bold;">PACKING LIST: </div>';
        $message_pdf .= '<div style="float: left;width: 92%;margin-top: 5px;">';
        $cust_original_order_pdf = EnteredPlotRecipientsMultiOriginal($user_session_comp, $user_session, $job_reference_final[0]['id']);
        $option = ($cust_original_order_pdf[0]['plot_arch'] == '0') ? 'Pickup Options:' : 'File Options:';
        $message_pdf .= '<table border="0" style="width: 100%;">';
        $message_pdf .= '<tr bgcolor="#F99B3E">';
        $message_pdf .= '<td style="font-weight: bold;">Option</td>';
        $message_pdf .= '<td style="font-weight: bold;">Originals</td>';
        $message_pdf .= '<td style="font-weight: bold;">Sets</td>';
        $message_pdf .= '<td style="font-weight: bold;">Order Type</td>';
        $message_pdf .= '<td style="font-weight: bold;">Size</td>';
        $message_pdf .= '<td style="font-weight: bold;">Output</td>';
        $message_pdf .= '<td style="font-weight: bold;">Media</td>';
        $message_pdf .= '<td style="font-weight: bold;">Binding</td>';
        $message_pdf .= '<td style="font-weight: bold;">Folding</td>';
        $message_pdf .= '</tr>';
        foreach ($cust_original_order_pdf as $original) {
            $cust_needed_sets = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
            $cust_order_type = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';
            $size = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
            $output = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
            $media = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
            $binding = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
            $folding = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];
            $message_pdf .= '<tr bgcolor="#ffeee1">';
            $message_pdf .= '<td>' . $original['options'] . '</td>';
            $message_pdf .= '<td>' . $original['origininals'] . '</td>';
            $message_pdf .= '<td>' . $cust_needed_sets . '</td>';
            $message_pdf .= '<td>' . $cust_order_type . '</td>';
            $message_pdf .= '<td>' . $size . '</td>';
            $message_pdf .= '<td style="text-transform: uppercase;">' . $output . '</td>';
            $message_pdf .= '<td>' . $media . '</td>';
            $message_pdf .= '<td>' . ucfirst($binding) . '</td>';
            $message_pdf .= '<td>' . ucfirst($folding) . '</td>';
            $message_pdf .= '</tr>';
        }
        $message_pdf .= '</table>';
        $message_pdf .= '</div>';
        $enteredPlot = EnteredPlotRecipientsMultiOriginal($user_session_comp, $user_session, $job_reference_final[0]['id']);
        
        
        $message_pdf .= '<div style="float: left;width: 65%;margin-top: 7px;">';
        $date_asap = ($entered_needed_sets_final[0]['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_needed_sets_final[0]['shipp_time'] : '';
        $message_pdf .= '<span style="font-weight: bold;">When Needed: </span>' . $entered_needed_sets_final[0]['shipp_date'] . $date_asap . '</div>';
        if ($entered_needed_sets_final[0]['spl_inc'] != '') {
            $message_pdf .= '<div style="width: 100%;float: left;margin-top: 7px;">';
            $message_pdf .= '<span style="font-weight: bold;">Special Instructions: </span></div>';
            $message_pdf .= '<div style="width: 100%;float: left;margin-top: 7px;">' . $entered_needed_sets_final[0]['spl_inc'] . '</div></div></div></div>';
        }
    } else {

        $r = 1;
        foreach ($entered_needed_sets_final as $entered_sets) {
            if (($entered_sets['shipp_id'] == 'P1') && ($entered_sets['shipp_id'] == 'P2')) {
                $shipp_add = AddressBookPickupSohoCap($entered_sets['shipp_id']);
            } else {
                $shipp_add = SelectIdAddressService($entered_sets['shipp_id']);
            }
            $needed_options = $entered_sets['option_id'];
            $needed_sets = ($entered_sets['plot_needed'] != '0') ? $entered_sets['plot_needed'] : $entered_sets['arch_needed'];
            $order_type = ($entered_sets['arch_needed'] != '0') ? 'Architectural Copies' : 'Plotting on Bond';
            $plot_binding = ($entered_sets['binding'] == '0') ? '' : ',' . $entered_sets['binding'];
            $plot_folding = ($entered_sets['folding'] == '0') ? '' : ',' . $entered_sets['folding'];
            $arch_binding = ($entered_sets['arch_binding'] == '0') ? '' : ',' . $entered_sets['arch_binding'];
            $arch_folding = ($entered_sets['arch_folding'] == '0') ? '' : ',' . $entered_sets['arch_folding'];
            $size = ($entered_sets['size'] == 'undefined') ? $entered_sets['arch_size'] : $entered_sets['size'];
            $output = ($entered_sets['output'] == 'undefined') ? $entered_sets['arch_output'] : $entered_sets['output'];
            $media = ($entered_sets['media'] == 'undefined') ? $entered_sets['arch_media'] : $entered_sets['media'];
            $binding = ($entered_sets['binding'] == 'undefined') ? $entered_sets['arch_binding'] : $entered_sets['binding'];
            $folding = ($entered_sets['folding'] == 'undefined') ? $entered_sets['arch_folding'] : $entered_sets['folding'];
            //border: 2px #F99B3E solid;
            //$message_pdf .= '<div style="width: 95%;float: left;height:2px;background-color: #F99B3E;margin-top: 10px;margin-bottom: 10px"></div>';
            $message_pdf .= '<div style="font-weight: bold;padding-top: 3px;width: 95%;float: left;">RECIPIENT ' . $r . '</div>';
            $message_pdf .= '<div style="width: 95%;float: left;margin-bottom: 10px;">';
            $message_pdf .= '<div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;">';
            $message_pdf .= '<div style="float: left;width: 100%;margin-top: 10px;font-weight: bold;">Send to: </div>';
            $message_pdf .= '<div style="float: left;width: 100%">';

            if (($entered_sets['shipp_id'] != 'P1') && ($entered_sets['shipp_id'] != 'P2')) {
                $add_2 = ($shipp_add[0]['address_2'] == '') ? '' : $shipp_add[0]['address_2'] . ',<br>';
                $add_3 = ($shipp_add[0]['address_3'] == '') ? '' : $shipp_add[0]['address_3'] . ',<br>';
                $tel = ($entered_sets['contact_ph'] != '') ? 'Tel:  ' . $entered_sets['contact_ph'] . ',<br>' : '';
                $message_pdf .= $shipp_add[0]['company_name'] . '<br>' . 'Attention: ' . $entered_sets['attention_to'] . '<br>' . $tel . $shipp_add[0]['address_1'] . ',<br>' . $add_2 . $add_3 . $shipp_add[0]['city'] . ',&nbsp;' . StateName($shipp_add[0]['state']) . '&nbsp;' . $shipp_add[0]['zip'];
            } else {                    //echo $shipp_add[0]['address'];                        
                $shipp_add_p = AddressBookPickupSohoCap($entered_sets['shipp_id']);
                $message_pdf .= $shipp_add_p[0]['address'];
            }


            $message_pdf .= '</div>';
            $message_pdf .= '<div style="float: left;width: 100%;margin-top: 7px;font-weight: bold;">PACKING LIST:</div>';
            $message_pdf .= '<div style="float: left;width: 100%;margin-top: 5px;">';

            $message_pdf .= '<table border="0" style="width: 100%;">';
            $message_pdf .= '<tr bgcolor="#F99B3E">';
            $message_pdf .= '<td style="font-weight: bold;">Option</td>';
            $message_pdf .= '<td style="font-weight: bold;">Sets</td>';
            $message_pdf .= '<td style="font-weight: bold;">Order Type</td>';
            $message_pdf .= '<td style="font-weight: bold;">Size</td>';
            $message_pdf .= '<td style="font-weight: bold;">Output</td>';
            $message_pdf .= '<td style="font-weight: bold;">Media</td>';
            $message_pdf .= '<td style="font-weight: bold;">Binding</td>';
            $message_pdf .= '<td style="font-weight: bold;">Folding</td>';
            $message_pdf .= '</tr>';
            if ($entered_sets['plot_needed'] != '0') {
                $message_pdf .= '<tr bgcolor="#ffeee1">';
                $message_pdf .= '<td>' . $needed_options . '</td>';
                $message_pdf .= '<td>' . $needed_sets . '</td>';
                $message_pdf .= '<td>' . $order_type . '</td>';
                $message_pdf .= '<td>' . $size . '</td>';
                $message_pdf .= '<td style="text-transform: uppercase;">' . $output . '</td>';
                $message_pdf .= '<td>' . $media . '</td>';
                $message_pdf .= '<td>' . ucwords(strtolower($binding)) . '</td>';
                $message_pdf .= '<td>' . ucwords(strtolower($folding)) . '</td>';
                $message_pdf .= '</tr>';
            }
            if ($entered_sets['plot_needed'] == '0') {
                $message_pdf .= '<tr bgcolor="#ffeee1">';
                $message_pdf .= '<td>' . $needed_options . '</td>';
                $message_pdf .= '<td>' . $needed_sets . '</td>';
                $message_pdf .= '<td>' . $order_type . '</td>';
                $message_pdf .= '<td>' . $size . '</td>';
                $message_pdf .= '<td style="text-transform: uppercase;">' . $output . '</td>';
                $message_pdf .= '<td>' . $media . '</td>';
                $message_pdf .= '<td>' . ucwords(strtolower($binding)) . '</td>';
                $message_pdf .= '<td>' . ucwords(strtolower($folding)) . '</td>';
                $message_pdf .= '</tr>';
            }

            $message_pdf .= '</table>';
            $message_pdf .= '</div>';

            if ($entered_sets['size'] == 'Custom') {
                $message_pdf .= '<div style="float: left;width: 65%;/*margin-left: 30px;*/margin-top: 5px;">';
                $message_pdf .= '<div style="font-weight: bold;width: 100%;float: left;">Custom Size Details:</div>';
                $message_pdf .= '<div style="padding-top: 3px;">' . $entered_sets['custome_details'] . '</div>';
                $message_pdf .= '</div>';
            }

            if ($entered_sets['output'] == 'Both') {
                $message_pdf .= '<div style="float: left;width: 65%;/*margin-left: 30px;*/margin-top: 5px;">';
                $message_pdf .= '<div style="font-weight: bold;width: 100%;float: left;">Page Number:</div>';
                $message_pdf .= '<div style="padding-top: 3px;">' . $entered_sets['output_page_number'] . '</div>';
                $message_pdf .= '</div>';
            }

            $message_pdf .= '<div style="float: left;width: 65%;/*margin-left: 30px;*/margin-top: 7px;">';
            $date_asap = ($entered_sets['shipp_time'] != 'ASAP') ? '&nbsp;&nbsp;&nbsp;' . $entered_sets['shipp_time'] : '';
            $message_pdf .= '<span style="font-weight: bold;">When Needed:  </span>' . $entered_sets['shipp_date'] . $date_asap;
            $message_pdf .= '</div>';
            if ($entered_sets['delivery_type'] != '0') {
                $message_pdf .= '<div style="width: 100%;float: left;/*margin-left: 30px;*/margin-top: 7px;">';
                $message_pdf .= '<span style="font-weight: bold;">Send Via: </span>';
                $message_pdf .= '</div>';
                $message_pdf .= '<div style="width: 100%;float: left;/*margin-left: 30px;*/margin-top: 7px;">';
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
                $message_pdf .= $ship_type_1 . $ship_type_2 . $ship_type_3 . ',&nbsp;' . $delivery_type . ',&nbsp;Account # ' . $entered_sets['billing_number'];
                $message_pdf .= '</div>';
            } else {
                $message_pdf .= '<div style="width: 100%;float: left;/*margin-left: 30px;*/margin-top: 7px;">';
                $message_pdf .= '<span style="font-weight: bold;">Send Via: </span>';
                $message_pdf .= '</div>';
                $message_pdf .= '<div style="width: 100%;float: left;/*margin-left: 30px;*/margin-top: 7px;">';
                $message_pdf .= 'SOHO TO ARRANGE DELIVERY</div>';
            }
            $message_pdf .= '</div></div>';
            $r++;
            $message_pdf .= '<div style="width: 100%;float: left;">';
            $message_pdf .= '<hr style="border-top: 1px solid #FF7E00;">';
            $message_pdf .= '</div>';
        }
    }

    $message_pdf .='</td>';
    $message_pdf .= '</tr>';
    $message_pdf .= '<tr>';
    $message_pdf .= '<td style="padding-left: 10px;">';
    $message_pdf .= '</td>';
    $message_pdf .= '</tr>';
    $message_pdf .= '</table>';
    $message_pdf .= '</div>';
    $message_pdf .= '</body>';
    $message_pdf .= '</html>';