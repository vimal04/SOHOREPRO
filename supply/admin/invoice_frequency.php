<?php //echo "dei"; 
include './config.php';
include './auth.php';
require_once('tcpdf_include.php');
$sort_date = ($_REQUEST['sort'] == 'a') ? 'd' : 'a';
$sort_date_img = ($_REQUEST['sort'] == 'a') ? 'down' : 'up';

$sort_jrn = ($_REQUEST['sort'] == 'jna') ? 'jnd' : 'jna';
$sort_jrn_img = ($_REQUEST['sort'] == 'jna') ? 'down' : 'up';

$sort_prc = ($_REQUEST['sort'] == 'pa') ? 'pd' : 'pa';
$sort_prc_img = ($_REQUEST['sort'] == 'pa') ? 'down' : 'up';

$sort_feq = ($_REQUEST['sort'] == 'feq_a') ? 'feq_d' : 'feq_a';
$sort_feq_img = ($_REQUEST['sort'] == 'frq_a') ? 'down' : 'up';

$page = 1; //Default page
$limit = 25; //Records per page
$start = 0; //starts displaying records from 0
if (isset($_GET['page']) && $_GET['page'] != '') {
    $page = $_GET['page'];
}
$start = ($page - 1) * $limit;
if ($_GET['limite']) {
    $limit = $_GET['limite'];
}
$comp_id = $_REQUEST['company'];


//$Orders_org = getClosedOrdersAllFreq($_REQUEST['sort'],$_REQUEST['feq_sort'],$comp_array);



//echo "ddd"; exit;
?>
     <style>
   .table-content-txt th{font-size:11px !important; border-bottom:1px solid #888;border-top:1px solid #888;height:42px;vertical-align:middle;line-height:30px;}         
   .header table td, .content-text table td{font-size:9px !important;}
   .table-content-body{color:red !important;}
   </style>
    <?php 
    if(isset($_POST['num'])){
     //   echo "hai"; exit;
       $customers = getComapnyByFreq($_POST['num']);
       //foreach($customers as $customer){
             
      // $company_id_in=$customer['customer_company'];
         $company_id_in='1343';
   
$company_order =getClosedOrderCompany($company_id_in);
//echo "<pre>";
//print_r($company_order);
?>
   
<!-- EXAMPLE OF CSS STYLE -->
 <?php
  // $test_var->Header($company_id_in123);
//ob_start();

// Extend the TCPDF class to create custom Header and Footer

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
      
    public function Header() {
        // Logo
//        $image_file = K_PATH_IMAGES.'logo_example.jpg';
//        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
//        // Set font
//        $this->SetFont('helvetica', 'B', 20);
//        // Title
      // $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $pageno = $this->getAliasNumPage() ." of ". $this->getAliasNbPages();
        //$pageno = $this->getAliasNumPage();
        $head='<style>
   .table-content-txt th{
   font-size:11px !important;
   border-bottom:1px solid #888;    
   border-top:1px solid #888;
    height:42px;
        vertical-align:middle;
        line-height:30px;        
        font-family:Arial, Helvetica, sans-serif;
   }         
        
       
        .header table td, .content-text table td{
   font-size:9px !important;         
   }
        .table-content-body{
            color:red !important;
        }
        *{
font-family:Arial, Helvetica, sans-serif;        
}
   </style>
<!-- EXAMPLE OF CSS STYLE -->
<div class="header">
    <table border="0" cellpadding="0" cellsapcing="0" style="font-family:Arial, Helvetica, sans-serif;"> 
            <tr>
                <td width="120px"><img src="http://cipldev.com/supply-new.sohorepro.com/supply/admin/images/soho-logo.jpg" alt="logo" style="width:114px;"></td>
                <td width="320px">
                    <table>
                    <tr>
                        <td><span style="float: left;">381 BROOME STREET, NEW YORK, NY 100013 </span></td>
                    </tr>
                    <tr>
                        <td><span style="float: left;text-algin:left;margin-right:4px;margin-top:10px;line-height:17px;">P:</span><span style="float: left;margin-left:4px;padding-left:5px;display:block;"> 212.925.7575</span></td>
                    </tr>
        
                    <tr>
                        <td><span style="float: left;margin-right:4px;line-height:17px;">F:</span><span style="float: left;"> 212.925.9741</span></td>
                    </tr>
                    <tr>
                        <td><span style="float: left;margin-right:4px;line-height:17px;"></span><span style="float: left;">info@sohorepro.com</span></td>
                    </tr>
                    <tr>
                        <td><span style="float: left;margin-right:4px;line-height:17px;"></span><span style="float: left;">www.sohorepro.com</span></td></tr>
                    <tr>
                        <td><span style="float: left; clear: both;">Federal Tax ID No.: 13-3856325</span></td></tr>
                    </table>
                </td>
                <td>
         
                <table style="font-family:Arial, Helvetica, sans-serif;">
                <tr> 
                    <td style="border:1px solid #888;height:30px;line-height:30px;"><span style="float: left; width: 100%; border-bottom: 1px solid #888; padding: 5px; box-sizing: border-box;"><span style="float: left; text-align:left;">&nbsp;&nbsp; Invoice number:</span><span style="float: left; text-align:left;"> 99784</span> <span style="float: right;text-align:right;dispaly:block; padding-left:10px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Page '.$pageno.'</span></span></td>
					 
				
                </tr>
                <tr>
                  <td style="border:1px solid #888;height:30px;line-height:30px"><span style="float: left; width: 100%; padding: 5px; box-sizing: border-box;"><span style="float: left;">&nbsp;&nbsp; Date:</span><span style="float: left;">'.date("m/d/Y").'</span> <span style="float: right; margin-right: 12px;"><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terms: </span><span> Net 15 Days</span></span></span></td>
                </tr>
                </table>
            </td>
        </tr>
         </table>
         </div>';
        $this->writeHTML($head,true,false,true,false,'');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->writeHTML('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie.Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a', true, false, true, false, '');
    } 
}

$html1="";
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

 $pageno = $pdf->getAliasNumPage();
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Soho-Invoice');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setPrintHeader(true);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
//$pdf->setPrintHeader(false);
// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

// set some text to print
$company_address_invoice = getInvoiceFreq($company_id_in);
 $html1.= '
        <style>
   .table-content-txt th{
   font-size:9px !important;
   border-bottom:1px solid #888;    
   border-top:1px solid #888;
    height:42px;
        vertical-align:middle;
        line-height:30px;        
   }         
        
       
        .header table td, .content-text table td{
   font-size:9px !important;         
   }
        .table-content-body{
            color:red !important;
        }
             *{
font-family:arial !important;        
}
   </style><div class="content-text">
          <table border="0" cellpadding="0" cellsapcing="0" style="font-family:Arial, Helvetica, sans-serif;"> 
        <tr><td height="10px" colspan="3"></td></tr>
        <tr>
            <td width="442">
                <table border="0"  cellpadding="0" cellsapcing="0">
                    <tr><td style="text-align:left">'.$company_address_invoice[0]["comp_name"].'</td></tr>
                    <tr><td>'.$company_address_invoice[0]["comp_business_address1"].'</td></tr>
                    <tr><td>'.$company_address_invoice[0]["comp_business_address2"].'</td></tr>';
                    if($company_address_invoice[0]["comp_business_address3"]) 
                        {
                    $html1.='<tr><td>'.$company_address_invoice[0]['comp_business_address3'].'</td></tr>'; } 
                   $html1.= '<tr><td>'.$company_address_invoice[0]["comp_city"].', '.$company_address_invoice[0]["comp_state"].' '.$company_address_invoice[0]["comp_zipcode"].'</td></tr>              
                </table>            
            </td>
        <td style="text-align:left; color:#f00;">
                <table>
                    <tr> <td>REMIT TO:</td>  </tr>
        <tr> <td>SOHO REPROGRAPHICS INC</td>  </tr>
        <tr> <td>P.O. Box 2097</td>  </tr>
        <tr> <td>CANAL STREET STATION</td>  </tr>
        <tr> <td>NEW YORK , NY 10013-0875</td>  </tr>
         <tr> <td height="10px"></td>  </tr>
         <tr> <td>PLEASE NOTE ABOVE INVOICE</td>  </tr>
         <tr> <td>NUMBER ON YOUR CHECK</td>  </tr>
   </table>
   </td>
        </tr>
        
    </table>
   
</div>';
    $pdf->writeHTML($html1, true, 0, true, 0);
    $x=1;
    $tmpordlst = array();
    $tmpdatlst = array();
 foreach($company_order as $comp){  
   
     $order_cl = getInvoiceClosedProduct($comp['order_id']);
      if(count($order_cl)>0){
        $html2 ='<style>
   .table-content-txt th{
   font-size:9px !important;
   border-bottom:1px solid #888;    
   border-top:1px solid #888;
    height:42px;
        vertical-align:middle;
        line-height:30px;        
   }         
   .header table td, .content-text table td{
   font-size:9px !important;         
   }
   .table-content-body{
            color:red !important;
        }
   </style><div style="float: left; width: 100%; margin: 20px 0px;">
	<table style="width: 100%; border-collapse: collapse; text-align:center;table-layout:fixed; font-family:Arial, Helvetica, sans-serif;" >
		<thead>
			<tr class="table-content-txt"> 
				<th style="border-left:1px solid #888;  font-weight:bold;" >Job Number</th>
				<th style="width:90px;  font-weight:bold;">Date </th>
				<th style="text-align:left; width:120px;  font-weight:bold;">Item Description </th>
				<th style="font-weight:bold;">Quantity</th>
				<th style="width:70px;  font-weight:bold;">Unit Price</th>
				<th style="width:50px; font-weight:bold; line-height:18px;">Extended Price</th>
				<th style="width:40px;  font-weight:bold;">Tax</th>
				<th style="border-right:1px solid #888;  font-weight:bold;">Total</th>				
			</tr>
		</thead>
		<tbody class="table-content-body">
			<tr>
				<td colspan="8" style="text-align: left; height:30px;line-height:30px"><b style="font-style:italic">Reference '.$comp["order_id"].'</b></td>
			</tr>';
                       
          //$order_cl = getInvoiceClosedProduct($comp['id']);
          $ext_price_c_total="";
          $tax_total_final="";
          $grand_total="";
          foreach($order_cl as $order_c){
      //  echo "<pre>";
              $quantity_c = $order_c['product_quantity'];
              $price_c = $order_c['product_price'];
              $ext_price_c = $quantity_c * $price_c;
              $tax_price_c = number_format(($ext_price_c * $order_c['tax_rate']/100), 2, '.', ''); 
              $total_tax = $ext_price_c + $tax_price_c;
              
             $ext_price_c_total += $ext_price_c;
             $tax_total_final +=$ext_price_c * $order_c['tax_rate']/100;
             $grand_total =number_format($ext_price_c_total + $tax_total_final, 2, '.', ''); 
      //    print_r($order_cl);
     //  echo "</pre>";
    $date_order =explode(" ",$order_c['created_date']);
   // print_r($date_order);
    
                        $dateorderview = date("m/d/Y",strtotime($date_order[0]));
                        if($date_order[0] == '')
                        {
                            $dateorderview = '';
                        }
                        
                        //Group Order Number and Date
                        if(in_array($order_c["order_number"], $tmpordlst))
                        {
                            $pordnum = "";
                            $pdatovw = "";
                        }
                        else
                        {
                            $pordnum = $order_c["order_number"];
                            $pdatovw = $dateorderview;
                        }
                        array_push($tmpordlst, $order_c["order_number"]);

            
			$html2 .='<tr>
				<td style="font-size:9px;height:30px;line-height:30px; text-align: left;">'.$pordnum.'</td>
				<td style="font-size:9px;height:30px;line-height:30px;width:90px;">'.$pdatovw.'</td>
				<td style="text-align:left;font-size:9px;height:30px;line-height:30px;width:120px">'.$order_c['product_name'].'</td>
				<td style="font-size:9px;height:30px;line-height:30px">'.$quantity_c.'</td>
				<td style="font-size:9px;width:70px;height:30px;line-height:30px">$'.number_format($price_c,2).'</td>
				<td style="font-size:9px;width:50px;height:30px;line-height:30px">$'.number_format($ext_price_c,2).'</td>
				<td style="font-size:9px;height:30px;line-height:30px;width:40px;">$'.number_format($tax_price_c,2).'</td>
				<td style="font-size:9px;height:30px;line-height:30px">$'.number_format($total_tax,2).'</td>				
			</tr>';
                        $update_invoice = updateInvoice_order($order_c['order_id']);
                        $update_invoice_temp = updateInvoiceTempOn($order_c['order_id']);
          }
			
			$html2 .='</tbody>
			<tfoot style="font-weight: bold; height: 46px; float:right; font-family:Arial, Helvetica, sans-serif;">
				<tr>
				<td colspan="5" style="height:30px;line-height:30px;text-align:right; font-weight: bold; font-size:10px;">Subtotal</td>
				<td style="font-size:9px;border-top:1px solid #888;height:30px;line-height:30px;  font-weight: bold; ">$'.number_format($ext_price_c_total,2).'</td>
				<td style="font-size:9px;border-top:1px solid #888;height:30px;line-height:30px;  font-weight: bold;">$'.number_format($tax_total_final, 2).'</td>
				<td style="font-size:9px;border-top:1px solid #888;height:30px;line-height:30px;  font-weight: bold;">$'.number_format($grand_total,2).'</td>
				</tr>
				<tr>
				<td colspan="5" style="height:30px;line-height:30px;text-align:right;font-weight: bold; font-size:10px;">Total Invoice</td>
				<td style="font-size:9px;border-top:1px solid #888;height:30px;line-height:30px;  font-weight: bold;">$'.number_format($ext_price_c_total,2).'</td>
				<td style="font-size:9px;border-top:1px solid #888;height:30px;line-height:30px;  font-weight: bold;">$'.number_format($tax_total_final, 2).'</td>
				<td style="font-size:9px;border-top:1px solid #888;height:30px;line-height:30px;  font-weight: bold;">$'.number_format($grand_total,2).'</td>
				</tr>
			</tfoot>
		
	</table>
         </div>';
                if($x>1){
     $pdf->AddPage();
     }  $x++; }
          $pdf->writeHTML($html2, true, 0, true, 0);
         
 }

 
       


// ---------------------------------------------------------
ob_start();

//error_reporting(0);
$filePathUrl = dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")."/invoice";
$addPDFpath = $_SERVER['DOCUMENT_ROOT'] . parse_url($filePathUrl, PHP_URL_PATH);

$companyInvoiceFolder = $addPDFpath."/".$company_id_in;
if (!file_exists($companyInvoiceFolder)) {
    mkdir($companyInvoiceFolder,0777,true);
}
$invoice_name = "invoice_".$company_id_in."_".time().".pdf";
//Close and output PDF document
//header('Content-Type: application/pdf');
$display_path = $filePathUrl ."/".$company_id_in."/invoice_".$company_id_in."_".time().".pdf";
$OutputPdfFileName = $companyInvoiceFolder."/invoice_".$company_id_in."_".time().".pdf";
$pdf->Output($OutputPdfFileName, 'F');
//header("Location:supply_billing.php?success_pdf");
//exit;
//$pdf->Output('D:\xampp\htdocs\services.sohorepro.com\supply\admin\samplesupply.pdf', 'I');
//ob_end_flush();

$Invoice_details = updateInvoiceDetails($invoice_name, $company_id_in );

$update_invoice_name = updateInvoice($Invoice_details);
updateInvoiceTempOff();
      // }
    }
    //$update_invoice = updateInvoiceFileName();
  //$Orders = getClosedOrdersAllFreqInv($_REQUEST['sort'],$_REQUEST['num']);
   // $Orders = getInvoiceFreqFront($_REQUEST['num']);
//$startDate = $Orders[count($Orders)-1]['created_date'];

//$time = strtotime($startDate);
//$myFormatForView = date("m/d/Y", $time);

//$rows = count($Orders);
    ?>

<table>
                                    <tr>
                                        <td colspan="6" class="billing_container">
                                     
                                            <div class="section_week">
                                                <span class="invoice-customer">
                                          
                                                        <a class="billing-return" href="supply_billing.php" >Return to billing</a>
                                                      </span>
                                                <?php 
                                                
                                                $cl = closedOrderBillable($_REQUEST['num']);
                                                 ?>
                                                <div class="custom">
                                                    <div class="cus-left">
                                                   
                                                    
                                                    <div class="bill_cont">
                                                        <label class="billable_c">Total Billable:</label><span><?php  $grand = getGrandTotalClosed($_REQUEST['num'],$_GET['company']); echo '$' . number_format(($grand[0]['grandtotal']), 2, '.', ','); ?></span>
                                                     </div>
                                                        <div class="bill_cont"><label class="billable_c">Total # to be Printed:</label><span><?php echo '45';?></span></div>
                                                         <div class="bill_cont"><label class="billable_c">Total # to be Emailed:</label><span><?php echo '45';?></span></div>
                                                
                                                    </div>
                                                    
                                                  
                                                 
                                              
                                                </div>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td align="left" valign="top"><table width="759" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="supply_billing.php?<?php echo $f_sort . $company_sort;?>sort=<?php echo $sort_jrn; ?>">INVOICE NUMBER&nbsp;<img src="images/<?php echo $sort_jrn_img; ?>.png"  alt="" width="10px" height="5px"/></a></td>
                                                    <td width="250" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="supply_billing.php?<?php echo $f_sort . $company_sort;?>sort=<?php echo $sort_date; ?>">INVOICE DATE &nbsp;<img src="images/<?php echo $sort_date_img; ?>.png"  alt="" width="10px" height="5px"/></a></td>                
                                                    <td width="189" height="28" align="center" valign="middle" class="td_brdr" bgcolor="#f99b3e"><a style="text-decoration: none; color: #fff;" href="supply_billing.php?<?php echo $f_sort . $company_sort;?>sort=<?php echo $sort_prc; ?>">Customer&nbsp;<img src="images/<?php echo $sort_prc_img; ?>.png"  alt="" width="10px" height="5px"/></a></td>
                                                      
                                                    <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="supply_billing.php?<?php echo $f_sort . $company_sort;?>sort=<?php echo $sort_feq; ?>">INVOICE FREQUENCY&nbsp;<img src="images/<?php echo $sort_feq_img; ?>.png"  alt="" width="10px" height="5px"/></a></td>  
                                                    <td width="258" valign="middle" height="28" bgcolor="#f99b3e" align="center" class="td_brdr"><a style="text-decoration: none; color: #fff;" href="supply_billing.php?<?php echo $f_sort . $company_sort;?>sort=<?php echo $sort_jrn; ?>">PDF&nbsp;<img src="images/<?php echo $sort_jrn_img; ?>.png"  alt="" width="10px" height="5px"/></a></td>   
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $Orders = getInvoiceFreqFront($_REQUEST['num']);
                                                $rows = count($Orders);
                                                if (count($Orders) > 0) {
                                                    foreach ($Orders as $order) {
                                                        $rowColor = ($i % 2 != 0) ? '#dfdfdf' : '#eeeeee';
                                                        $rowColor1 = ($i % 2 != 0) ? '#eeeeee' : '#f6f2f2';
                                                        $invoice_number = $order['invoice_number'];
                                                        $current_time = $order['invoice_date'];
                                                        $datew = new DateTime($current_time, new DateTimeZone('America/New_York'));
                                                        date_default_timezone_set('America/New_York');
                                                        $temp_times = date("Y-m-d h:iA", $datew->format('U'));
                                                        $date = date("m/d/Y", strtotime($order['invoice_date'])) . ' ' . date("h:iA", strtotime("-0 minutes", strtotime($temp_times)));
                                                        $customer = $order['customer_company_name'];
                                                        if($order['invoice_type']=="14"){
                                                            $invoice_period= "Bi-Monthly";
                                                        }
                                                        else if($order['invoice_type']=="30"){
                                                             $invoice_period = "Monthly";
                                                        }
                                                        else{
                                                             $invoice_period = "Weekly";
                                                        }
                                                    
                                                        ?>
                                               
                                                        <tr class="trigger"  id="<?php echo $id; ?>"> 
                                                            <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor; ?>"   valign="middle"><?php echo $invoice_number; ?></td>             
                                                            <td width="250" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>"  valign="middle"><?php echo $date; ?></td>                                    
                                                            <td width="109" height="36" align="center" bgcolor="<?php echo $rowColor; ?>"   valign="middle"><span id="customer_name_<?php echo $id; ?>"><?php echo $customer; ?></span></td>                
                                                             
                                                            <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor1; ?>"  valign="middle"><span class="refj_<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $invoice_period; ?></span></td>
                                                            <td width="210" height="36" align="center" bgcolor="<?php echo $rowColor; ?>" valign="middle"><a target="_blank"href="<?php echo getBaseUrl()."invoice/".$company_id_in."/".$order['invoice_name'];?>"><img src="<?php echo getBaseUrl(). "images/pdf.png"; ?>" /></a></td>
                                                        </tr>
                                                            
                                                        
                                                        
                                           
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr  bgcolor="<?php echo $rowColor; ?>">
                                            <td colspan="4" align="center">There is no orders</td>
                                        </tr>              
                                    <?php } ?>

                                </table></td>
                        </tr>
                                  
                        <tr align="right">
                            <td><?php echo Paginations($limit, $page, 'open_orders.php?page=', $rows); ?></td>
                        </tr>
                         
                   
</table>


            
            
      