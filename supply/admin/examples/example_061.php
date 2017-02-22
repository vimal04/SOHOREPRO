<?php
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
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
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
ob_clean();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 061');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
        <style>
   .table-content-txt th{
   font-size:11px !important;
   border-bottom:1px solid #888;    
   border-top:1px solid #888;
    height:42px;
        vertical-align:middle;
        line-height:30px;        
   }         
        
       
        .header table td{
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
        <tr><td>
           <span style="float: left;">381 BROOME STREET, NEW YORK, NY 100013</span>
   </td></tr>
                      
        <tr><td>
   <span style="float: left;text-algin:left;">
<img src="http://localhost/services.sohorepro.com/supply/admin/images/phone.png" alt="icon" style="width: 12px;"/>
</span><span style="float: left;">212.925.7575</span>         
   </td></tr>
        
          <tr><td>
              <span style="float: left;">
<img src="http://localhost/services.sohorepro.com/supply/admin/images/phone.png" alt="icon" style="width: 12px;"/>
</span><span style="float: left;">212.925.9741</span>
    </td></tr>
        <tr><td>
         <span style="float: left;">
<img src="http://localhost/services.sohorepro.com/supply/admin/images/mail.png" alt="icon" style="width: 12px;"/>
</span><span style="float: left;">info@sohorepro.com</span>   
   </td></tr>
        <tr><td>
   <span style="float: left;">
<img src="http://localhost/services.sohorepro.com/supply/admin/images/website.png" alt="icon" style="width: 12px;"/>
</span><span style="float: left;">www.sohorepro.com</span>         
   </td></tr>
        <tr><td>
            <span style="float: left; clear: both;">referal tax ID No:133888326</span>
   </td></tr>
                    </table>
                </td>
        <td>
            <table>
            <tr>
                <td style="border:1px solid #888;height:30px;line-height:30px">
                   
   <span style="float: left; width: 100%; border-bottom: 1px solid #888; padding: 5px; box-sizing: border-box;"><span style="float: left;">Invoice number:</span><span style="float: left;">99784</span> <span style="float: right;text-align:right;margin-right: 12px;dispaly:block;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Page 1</span></span></td>
   </tr>
        <tr>
                <td style="border:1px solid #888;height:30px;line-height:30px"><span style="float: left; width: 100%; padding: 5px; box-sizing: border-box;"><span style="float: left;">Date:</span><span style="float: left;">10/31/2016</span> <span style="float: right; margin-right: 12px;"><span> Terms: </span><span> Net 15 Days</span></span></span></td>
   </tr>
        </table>
   </td>
   </tr>
        <tr><td height="30px" colspan="3"></td></tr>
       <tr>
            <td colspan="2">
                <table border="0"  cellpadding="0" cellsapcing="0">
                    <tr><td style="text-align:left">GW - Plotting</td></tr>
        <tr><td>11th Floor</td></tr>
        <tr><td>146 West 30th Street</td></tr>
        <tr><td>New York, NY 10001 </td></tr>              
                </table>            
   </td>
        <td colspan="1" style="text-align:left">
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
				<th style="text-align:right;width:80px;">Unit Price</th>
				<th style="text-align:right">Extended Price</th>
				<th style="text-align:right">Tax</th>
				<th style="text-align:center;border-right:1px solid #888;">Total</th>				
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
				<td style="text-align:right;font-size:10px;width:80px;height:30px;line-height:30px">$13,960</td>
				<td style="text-align:right;font-size:10px;height:30px;line-height:30px">$293.58</td>
				<td style="text-align:right;font-size:10px;height:30px;line-height:30px">$28.00</td>
				<td style="text-align:right;font-size:10px;height:30px;line-height:30px">$319.64</td>				
			</tr>
			
        <tr>
				<td style="font-size:10px;height:30px;line-height:30px">589201</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:50px;">9/20</td>
				<td style="font-size:10px;height:30px;line-height:30px;width:120px">Plotting-B&W on Bond</td>
				<td style="font-size:10px;height:30px;line-height:30px">21</td>
				<td style="text-align:right;font-size:10px;width:80px;height:30px;line-height:30px">$13,960</td>
				<td style="text-align:right;font-size:10px;height:30px;line-height:30px">$293.58</td>
				<td style="text-align:right;font-size:10px;height:30px;line-height:30px">$28.00</td>
				<td style="text-align:right;font-size:10px;height:30px;line-height:30px">$319.64</td>				
			</tr>
			
			</tbody>
			<tfoot style="font-weight: bold; height: 46px;">
				<tr>
				<td colspan="5" style="text-align:right;border-top:1px solid #888;height:30px;line-height:30px">Subtotal</td>
				<td style="text-align:right;font-size:10px;border-top:1px solid #888;height:30px;line-height:30px">$454,41</td>
				<td style="text-align:right;font-size:10px;border-top:1px solid #888;height:30px;line-height:30px">$40.34</td>
				<td style="text-align:right;font-size:10px;border-top:1px solid #888;height:30px;line-height:30px">$494.75</td>
				</tr>
			</tfoot>
		
	</table>
</div>

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
$pdf->AddPage();

$html = '
<h1>HTML TIPS & TRICKS</h1>

<h3>REMOVE CELL PADDING</h3>
<pre>$pdf->SetCellPadding(0);</pre>
This is used to remove any additional vertical space inside a single cell of text.

<h3>REMOVE TAG TOP AND BOTTOM MARGINS</h3>
<pre>$tagvs = array(\'p\' => array(0 => array(\'h\' => 0, \'n\' => 0), 1 => array(\'h\' => 0, \'n\' => 0)));
$pdf->setHtmlVSpace($tagvs);</pre>
Since the CSS margin command is not yet implemented on TCPDF, you need to set the spacing of block tags using the following method.

<h3>SET LINE HEIGHT</h3>
<pre>$pdf->setCellHeightRatio(1.25);</pre>
You can use the following method to fine tune the line height (the number is a percentage relative to font height).

<h3>CHANGE THE PIXEL CONVERSION RATIO</h3>
<pre>$pdf->setImageScale(0.47);</pre>
This is used to adjust the conversion ratio between pixels and document units. Increase the value to get smaller objects.<br />
Since you are using pixel unit, this method is important to set theright zoom factor.<br /><br />
Suppose that you want to print a web page larger 1024 pixels to fill all the available page width.<br />
An A4 page is larger 210mm equivalent to 8.268 inches, if you subtract 13mm (0.512") of margins for each side, the remaining space is 184mm (7.244 inches).<br />
The default resolution for a PDF document is 300 DPI (dots per inch), so you have 7.244 * 300 = 2173.2 dots (this is the maximum number of points you can print at 300 DPI for the given width).<br />
The conversion ratio is approximatively 1024 / 2173.2 = 0.47 px/dots<br />
If the web page is larger 1280 pixels, on the same A4 page the conversion ratio to use is 1280 / 2173.2 = 0.59 pixels/dots';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
