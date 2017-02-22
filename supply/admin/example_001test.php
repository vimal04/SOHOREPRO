<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
ob_clean();

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
        $pageno = $this->getAliasNumPage();
        $head='<style>
   .table-content-txt th{
   font-size:11px !important;
   border-bottom:1px solid #888;    
   border-top:1px solid #888;
    height:42px;
        vertical-align:middle;
        line-height:30px;        
   }         
        
       
        .header table td, .content-text table td{
   font-size:10px !important;         
   }
        .table-content-body{
            color:red !important;
        }
   </style>
<!-- EXAMPLE OF CSS STYLE -->
<div class="header">
    <table border="0" cellpadding="0" cellsapcing="0">
            <tr>
                <td width="100px"><img src="http://localhost/services.sohorepro.com/supply/admin/images/soho-logo.jpg" alt="logo" style="width: 100px;"></td>
                <td width="320px">
                    <table>
                    <tr>
                        <td><span style="float: left;">381 BROOME STREET, NEW YORK, NY 100013</span></td>
                    </tr>
                    <tr>
                        <td><span style="float: left;text-algin:left;"><img src="http://localhost/services.sohorepro.com/supply/admin/images/phone.png" alt="icon" style="width: 12px;"/></span><span style="float: left;">212.925.7575</span></td>
                    </tr>
        
                    <tr>
                        <td><span style="float: left;"><img src="http://localhost/services.sohorepro.com/supply/admin/images/phone.png" alt="icon" style="width: 12px;"/></span><span style="float: left;">212.925.9741</span></td>
                    </tr>
                    <tr>
                        <td><span style="float: left;"><img src="http://localhost/services.sohorepro.com/supply/admin/images/mail.png" alt="icon" style="width: 12px;"/></span><span style="float: left;">info@sohorepro.com</span></td>
                    </tr>
                    <tr>
                        <td><span style="float: left;"><img src="http://localhost/services.sohorepro.com/supply/admin/images/website.png" alt="icon" style="width: 12px;"/></span><span style="float: left;">www.sohorepro.com</span></td></tr>
                    <tr>
                        <td><span style="float: left; clear: both;">referal tax ID No:133888326</span></td></tr>
                    </table>
                </td>
                <td>
         
                <table>
                <tr> 
                     <td style="border:1px solid #888;height:30px;line-height:30px"><span style="float: left; width: 100%; border-bottom: 1px solid #888; padding: 5px; box-sizing: border-box;"><span style="float: left;">Invoice number:</span><span style="float: left;">99784</span> <span style="float: right;text-align:right;margin-right: 12px;dispaly:block;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Page '.$pageno.'</span></span></td>
                </tr>
                <tr>
                  <td style="border:1px solid #888;height:30px;line-height:30px"><span style="float: left; width: 100%; padding: 5px; box-sizing: border-box;"><span style="float: left;">Date:</span><span style="float: left;">10/31/2016</span> <span style="float: right; margin-right: 12px;"><span> Terms: </span><span> Net 15 Days</span></span></span></td>
                </tr>
                </table>
            </td>
        </tr>
         </table>
         </div>';
        $this->writeHTML($head,true,false,true,false,"");
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

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

 $pageno = $pdf->getAliasNumPage();
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
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

 $html1 = <<<EOF
        <style>
   .table-content-txt th{
   font-size:11px !important;
   border-bottom:1px solid #888;    
   border-top:1px solid #888;
    height:42px;
        vertical-align:middle;
        line-height:30px;        
   }         
        
       
        .header table td, .content-text table td{
   font-size:10px !important;         
   }
        .table-content-body{
            color:red !important;
        }
   </style>
<!-- EXAMPLE OF CSS STYLE -->

         <div class="content-text">
          <table border="0" cellpadding="0" cellsapcing="0">
        <tr><td height="10px" colspan="3"></td></tr>
        <tr>
            <td width="422">
                <table border="0"  cellpadding="0" cellsapcing="0">
                    <tr><td style="text-align:left">GW - Plotting</td></tr>
                    <tr><td>11th Floor</td></tr>
                    <tr><td>146 West 30th Street</td></tr>
                    <tr><td>New York, NY 10001 </td></tr>              
                </table>            
            </td>
        <td style="text-align:left">
                <table>
                    <tr> <td>REMIT TO:</td>  </tr>
        <tr> <td>SOHO REPROGRAPHICS INC</td>  </tr>
        <tr> <td>RO.BOX 2097</td>  </tr>
        <tr> <td>CANAL STREET STATION</td>  </tr>
        <tr> <td>NEW YORK , NY 10013-0875</td>  </tr>
         <tr> <td height="10px"></td>  </tr>
         <tr> <td>PLEASE NOTE ABOVE INVOICE</td>  </tr>
         <tr> <td>NUMBER ON YOUR CHECK</td>  </tr>
   </table>
   </td>
        </tr>
        
    </table>
   
</div>
    
 
        <div style="float: left; width: 100%; margin: 20px 0px;">
	<table style="width: 100%; border-collapse: collapse; text-align:center;table-layout:fixed;">
		<thead>
			<tr class="table-content-txt"> 
				<th style="border-left:1px solid #888;" >Job Number</th>
				<th style="width:50px;">Date </th>
				<th style="width:120px;">Item Description </th>
				<th>Quantity</th>
				<th style="width:80px;">Unit Price</th>
				<th >Extended Price</th>
				<th >Tax</th>
				<th style="border-right:1px solid #888;">Total</th>				
			</tr>
		</thead>
		<tbody class="table-content-body">
			<tr>
				<td colspan="8" style="text-align: left; height:30px;line-height:30px"><b style="font-style:italic">Reference 13017</b></td>
			</tr>
			 <tr>
				<td style="font-size:10px;height:30px;line-height:30px">589201</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:50px;">9/20</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:120px">Plotting-B&W on Bond</td>
				<td style="font-size:10px;height:30px;line-height:30px">21</td>
				<td style="font-size:10px;width:80px;height:30px;line-height:30px">$13,960</td>
				<td style="font-size:10px;height:30px;line-height:30px">$293.58</td>
				<td style="font-size:10px;height:30px;line-height:30px">$28.00</td>
				<td style="font-size:10px;height:30px;line-height:30px">$319.64</td>				
			</tr>
         	<tr>
				<td style="font-size:10px;height:30px;line-height:30px">589201</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:50px;">9/20</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:120px">Plotting-B&W on Bond</td>
				<td style="font-size:10px;height:30px;line-height:30px">21</td>
				<td style="font-size:10px;width:80px;height:30px;line-height:30px">$13,960</td>
				<td style="font-size:10px;height:30px;line-height:30px">$293.58</td>
				<td style="font-size:10px;height:30px;line-height:30px">$28.00</td>
				<td style="font-size:10px;height:30px;line-height:30px">$319.64</td>				
			</tr>
			
        <tr>
				<td style="font-size:10px;height:30px;line-height:30px">589201</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:50px;">9/20</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:120px">Plotting-B&W on Bond</td>
				<td style="font-size:10px;height:30px;line-height:30px">21</td>
				<td style="font-size:10px;width:80px;height:30px;line-height:30px">$13,960</td>
				<td style="font-size:10px;height:30px;line-height:30px">$293.58</td>
				<td style="font-size:10px;height:30px;line-height:30px">$28.00</td>
				<td style="font-size:10px;height:30px;line-height:30px">$319.64</td>				
			</tr>
              <tr>
				<td style="font-size:10px;height:30px;line-height:30px">589201</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:50px;">9/20</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:120px">Plotting-B&W on Bond</td>
				<td style="font-size:10px;height:30px;line-height:30px">21</td>
				<td style="font-size:10px;width:80px;height:30px;line-height:30px">$13,960</td>
				<td style="font-size:10px;height:30px;line-height:30px">$293.58</td>
				<td style="font-size:10px;height:30px;line-height:30px">$28.00</td>
				<td style="font-size:10px;height:30px;line-height:30px">$319.64</td>				
			</tr>
			
			</tbody>
			<tfoot style="font-weight: bold; height: 46px;">
				<tr>
				<td colspan="5" style="border-top:1px solid #888;height:30px;line-height:30px;text-align:right;">Subtotal</td>
				<td style="font-size:10px;border-top:1px solid #888;height:30px;line-height:30px">$454,41</td>
				<td style="font-size:10px;border-top:1px solid #888;height:30px;line-height:30px">$40.34</td>
				<td style="font-size:10px;border-top:1px solid #888;height:30px;line-height:30px">$494.75</td>
				</tr>
			</tfoot>
		
	</table>
         </div>
          
EOF;
 $pdf->writeHTML($html1, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+