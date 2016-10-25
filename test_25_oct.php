<?php


    
    /*****---LFP Start *************/
    
     $html_5 .= '<div style="width: 100%;float: left;margin-top: 10px;margin-bottom: 10px;font-weight: bold;">PACKING LIST:  LARGE FORMAT COLOR & BW </div>';
    $html_5 .= '<table border="0" style="width: 100%;float: left;">';

    $cust_original_order_pdf_lfp = EnteredLFPPrimaryPdf($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid']);
    //$total_plot_needed_pdf = SetsOrderedFinalizeCountOfSets($job_reference_final[0]['id']);
   // $cust_original_order_final_pdf_lfp = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid'],$_SESSION['ref_val']);
    //$upload_file_exist_pdf = UploadFileExistFinalize($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid'], $job_reference_final[0]['id']);
    //$cust_needed_sets_pdf = ($cust_original_order_pdf[0]['print_ea'] != '0') ? $cust_original_order_pdf[0]['print_ea'] : $cust_original_order_pdf[0]['arch_needed'];
    //$cust_order_type_pdf = ($cust_original_order_pdf[0]['arch_needed'] != '0') ? 'Architectural Copies' : 'Plotting on Bond';
    //$option_pdf = ($cust_original_order_pdf[0]['arch_needed'] != '0') ? 'Pickup Options:' : 'File Options:';
 
    $html_5 .= '<tr style="background-color: #002369;color: #FFF;">
                        <td style="font-weight: bold;">Option</td> 
                            <td style="">Originals</td> 
                            <td style="">Sets</td> 
                            <td style="width: 20%;">Order Type</td>                            
                            <td style="">Size</td>
                            <td style="">Output</td>
                            <td style="">Media</td>
                            <td style="">Binding</td>
                </tr>';
    foreach ($cust_original_order_pdf_lfp as $original_pdf_lfp) {
        
            $cust_needed_sets_lfp       = $original_pdf_lfp['print_of_each'];
                                $cust_order_type_lfp        = "LFP";  
                                $size_lfp         = ucwords(strtolower($original_pdf_lfp['size']));
                                $output_lfp       = $original_pdf_lfp['output'];
                                $media_lfp        = $original_pdf_lfp['media'];
                                $binding_lfp      = $original_pdf_lfp['binding']; 
        
        
        $html_5 .= '<tr style="background-color: #FFF;color: #000;">';
        $html_5 .= '<td>' . $original_pdf_lfp['option_id'] . '</td>';
        $html_5 .= '<td>' . $original_pdf_lfp['original'] . '</td>';
        $html_5 .= '<td>' . $cust_needed_sets_lfp . '</td>';
        $html_5 .= '<td>' . $cust_order_type_lfp . '</td>';
        $html_5 .= '<td>' . $size_lfp . '</td>';
        $html_5 .= '<td style="text-transform: uppercase;">' . $output_lfp . '</td>';
        $html_5 .= '<td>' . ucfirst($media_lfp) . '</td>';
        $html_5 .= '<td>' . ucfirst($binding_lfp) . '</td>';
        $html_5 .= '</tr>';
    }
    $html_5 .= '</table>';
     
    $html_5 .= '<table border="0" style="width: 100%;float: left;">';
    foreach ($cust_original_order_pdf_lfp as $original_lfp) {
        $html_5 .= '<tr>';
        $html_5 .= '<td>&nbsp;</td>';
        $html_5 .= '</tr>';
        $html_5 .= '<tr style="font-weight: bold;color: #000;">';
        $html_5 .= '<td> OPTION&nbsp;'.$original_lfp['options'].'&nbsp;- Details</td>';
        $html_5 .= '</tr><br>';
        if ($original_lfp['size'] == 'CUSTOM') {
        $html_5 .= '<tr>';
        $html_5 .= '<td><b>Custom Size:</b>&nbsp;'.$original_lfp['size_custom'].'</td>';
        $html_5 .= '</tr><br>';
        }
        if ($original_lfp['output'] == 'BOTH') {
        $html_5 .= '<tr>';
        $html_5 .= '<td><b>Color Page Numbers:</b>&nbsp;'.$original_lfp['output_both_page'].'</td>';
        $html_5 .= '</tr><br>';
        }
        if ($original_lfp['special_inc'] != '') {
        $html_5 .= '<tr>';
        $html_5 .= '<td><b>Special Instructions:</b>&nbsp;'.$original_lfp['special_inc'].'</td>';
        $html_5 .= '</tr><br>';
        }
        if ($original_lfp['ftp_link'] != "0") {
            $link = ($original_lfp['ftp_link'] != '0') ? $original_lfp['ftp_link'] : '';
            $user_name_ftp = ($original_lfp['user_name'] != '0') ? $original_lfp['user_name'] : '';
            $password = ($original_lfp['password'] != '0') ? $original_lfp['password'] : '';
            if ($original_lfp['use_same_alt'] == "0") {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>File Option: Provide Link to a File</b><br>';
        $html_5 .= '<b>FTP Link:</b>&nbsp;'.$link.'<br>';
        $html_5 .= '<b>User Name:</b>&nbsp;'.$user_name_ftp.'<br>'; 
        $html_5 .= '<b>Password:</b>&nbsp;'.$password;
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';
        } else {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>File Option: Provide Link to a File</b><br>';
        $html_5 .= '<b>Use same file as Option</b>&nbsp;'.$original_lfp['use_same_alt'];
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';
            }
        }
        if ($original_lfp['upload_file'] != "0") {
            if ($original_lfp['use_same_alt'] == "0") {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>File Option: Upload a file</b><br>';
        $html_5 .= '<a href="http://cipldev.com/supply-new.sohorepro.com/uploads/'.$original_lfp['upload_file'].'"  target="_blank">'.$original_lfp['upload_file'].'</a>';
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';
        } else {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>File Option: Upload a file</b><br>';
        $html_5 .= 'Use same file as Option&nbsp;'.$original_lfp['use_same_alt'];
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';
        }
        }
        if ($original_lfp['drop_off_381'] != "0") {
            if ($original_lfp['use_same_alt'] == "0") {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>Drop-Off Option:</b>&nbsp;'.$original_lfp['drop_off_381'];
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>'; 
        } else {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>Drop-Off Option:</b>&nbsp;Use same file as Option&nbsp;'.$original_lfp['use_same_alt'];
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';
            }
        }
        if ($original_lfp['schedule_pickup'] != "0") {
            if (($original_lfp['schedule_pickup'] == "ASAP") && ($original_lfp['pick_up_time'] == "ASAP")) {
                $pickup_details = $original_lfp['schedule_pickup'];
            } else {
                $pickup_details = $original_lfp['schedule_pickup'] . '&nbsp;' . $original_lfp['pick_up_time'];
            }
            if ($original_lfp['use_same_alt'] == "0") {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>Pickup Option:</b>&nbsp;'.$pickup_details;
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';               
        } else {
        $html_5 .= '<tr>';
        $html_5 .= '<td>';
        $html_5 .= '<b>Pickup Option:</b>&nbsp;Use same file as Option&nbsp;'.$original_lfp['use_same_alt'];
        $html_5 .= '</td>';
        $html_5 .= '</tr><br>';
            }
        }
        
        //Alternate Start
        
        if ($original_lfp['my_office_alt'] != "0") {
           
            $address_dtls    = SelectLastEnteredAddress($original_lfp['address_book_id']);
            $address_3       = ($address_dtls[0]['address_3'] != '') ? $address_dtls[0]['address_3'].'<br>' : '';
            $address_string  = $address_dtls[0]['company_name'].'<br>'.$address_dtls[0]['address_1'].'<br>'.$address_dtls[0]['address_2'].'<br>'.$address_3.$address_dtls[0]['city'].',&nbsp;'.StateName($address_dtls[0]['state']).'&nbsp;'.$address_dtls[0]['zip'];

            $option_sechdule = ($original['my_office_alt'] == 'my_office') ? '<span>My Office</span>' : '<br><span>Alternate:</span><br>'.$address_string;
            
            $html_5 .= '<tr>';
            $html_5 .= '<td>';
            $html_5 .= '<span style="font-weight: bold">Schedule a Pick-up Option:</span>&nbsp;' . $option_sechdule;
            $html_5 .= '</td>';
            $html_5 .= '</tr><br>'; 
            
        }  
        //Alternate End
                
    }
    
    
    /*****---Mounting and Lamination Star ************/
    
        /*****M&L End************/
    
    
    /*****---LFP End ************/
    
    