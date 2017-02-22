<?php        
//print_R($_POST);
//
//$previous_encoding = mb_internal_encoding();
// 
//   //Set the encoding to UTF-8, so when reading files it ignores the BOM       
//   mb_internal_encoding('UTF-8');
// 
//   //Process files...
// 
//   //Finally, return to the previous encoding
//   mb_internal_encoding($previous_encoding);

$refer          = mysql_real_escape_string($_POST['refer']);
$fname          = $_POST['fname']; 
$lname          = $_POST['lname'];
$cname          = $_POST['cname'];
$caddress       = $_POST['caddress'];
$ccity          = $_POST['ccity']; 
$cstate         = $_POST['cstate'];
$czip           = $_POST['czip'];
$cphone         = $_POST['cphone']; 
$email          = $_POST['email'];
$compskype      = $_POST['compskype']; 
$bcontact       = $_POST['bcontact'];
$sign       	= $_POST['sign'];
$cctype         = $_POST['cctype'];
$ccno           = $_POST['ccno'];
$ccname         = $_POST['ccname']; 
$ccexpiry       = $_POST['ccexpiry'];
$cid            = $_POST['cid'];
$ccaddress      = $_POST['ccaddress']; 
$ccphone        = $_POST['ccphone'];
$cccity         = $_POST['cccity'];
$ccstate        = $_POST['ccstate']; 
$cczip          = $_POST['cczip'];
$tcontactname1  = $_POST['tcontactname1'];
$tcontactemail1 = $_POST['tcontactemail1']; 
$tcontactphone1 = $_POST['tcontactphone1'];
$tcontactname2  = $_POST['tcontactname2'];
$tcontactemail2 = $_POST['tcontactemail2']; 
$tcontactphone2 = $_POST['tcontactphone2'];
$stakename1  = $_POST['stakename1'];
$stakeemail1 = $_POST['stakeemail1']; 
$stakephone1 = $_POST['stakephone1'];
$projspecval      = $_POST['projspecval'];
$foldername     = $_POST['foldername'];

if($projspecval == 'yes'){
            if(file_exists('uploads/'.$foldername) && is_dir('uploads/'.$foldername)){
            }else{
                echo "invalid";
                return false;
                }
    }

if($_POST['servicetypval'] == "newtool") {
	$pname = $_POST['sitename'];
	$pfee  = $_POST['projfee'];	
	$projnat = "New project";
}
else if ($_POST['servicetypval'] == "websupport") {
	$pname = $_POST['ws_sitename'];	
	$pfee  = $_POST['ws_projfee'];
	$projnat = "Web support project";
}
else if ($_POST['servicetypval'] == "itsupport") {
	$pname = $_POST['cname'];	
	$pfee  = $_POST['its_projfee'];
	$pbudget = $_POST['its_projbudget'];
	$projnat = "IT support project";
}
else if ($_POST['servicetypval'] == 'monthlyretainer') {
	$mr_itorweb = $_POST['mr_itorweb'];
	if($mr_itorweb == 'IT') {
		$mr_offaddress 	= $_POST['mr_offaddress'];
		$mr_offcity		= $_POST['mr_offcity'];
		$mr_offstate	= $_POST['mr_offstate'];
		$mr_offzip		= $_POST['mr_offzip'];
	} else {
		$mr_webaddress	= $_POST['mr_webaddress'];
	}
	$mr_hours	= $_POST['mr_hours'];
	$mr_rate	= $_POST['mr_rate'];
	$mr_startmonth	= $_POST['mr_startmonth'];
	$mr_startday	= $_POST['mr_startday'];
	
	$pname 		= $_POST['cname'];
	$pfee		= $_POST['mr_rate'];
	$projnat	= "Monthly Retainer - ".$mr_itorweb." Support";
}

/*
//Basecamp

include 'newproject.php';

//Highrise

include 'newcontact.php';

*/

//Freshbooks
//            $pnpayment_c = 1;
//            if (isset($_POST['numinstall']) && $_POST['numinstall'] != "") {
//                    $pnpayment_c = $_POST['numinstall'];
//            }
include_once 'include/FreshBooks/init.dist.php';

//include particular file for entity you need (Client, Invoice, Category...)
include_once "include/FreshBooks/Client.php";

//new Client object
$client = new FreshBooks_Client();

$client->listing($rows,$resultInfo,1,100,array('email'=>$email));
if($rows) {
	// This will update the notes of exsisting client.
	$clientid = $rows[0]->clientId;
	$clnotes  = $rows[0]->notes;
	include 'updclient.php';
}
else {
	include 'newclient.php';
}

/*
if( !empty($pfee) ){
	if( $pfee && $pnpayment_c>1){
		$pfee_div = $pfee;
		$i = 0;
		while ($pnpayment_c != 1) {
			$invoices[$i] = round(($pfee_div*50)/100);
			$pfee_div = $pfee_div - $invoices[$i];
			$pnpayment_c--;
			$i++;
		}
		$invoices[$i++] = $pfee_div;
	}else if($pnpayment_c==1){
		$invoices[0] = $pfee;
	}
	include 'newinvoice.php';
} elseif( !empty($pbudget) ) {
	$invoices[0] = $pbudget;
	include 'newinvoice.php';
}

//Database Storage
/*include 'connection.php';

$query = "INSERT INTO customer (`project_name`,`project_fee`,`project_npayment`,`note`,`first_name`,`last_name`,`company_name`,`company_address`,`company_city`,`company_state`,`company_zip`,`company_phone`,`email`,`fax`,`billing_contact`,
`card_type`,`card_number`,`card_name`,`card_expiry`,`cid`,`billing_address`,`billing_phone`,`billing_city`,`billing_state`,`zip`,
`contact_name1`,`contact_email1`,`contact_phone1`,`contact_name2`,`contact_email2`,`contact_phone2`,`contact_name3`,`contact_email3`,`contact_phone3`, `folder_name`)
VALUES ('$pname','$pfee', '$pnpayment', '$note', '$fname', '$lname', '$cname', '$caddress', '$ccity', '$cstate', '$czip', '$cphone', '$email', '$fax', '$bcontact', '$cctype', '$ccno', '$ccname', '$ccexpiry', '$cid', '$ccaddress', '$ccphone', 
'$cccity', '$ccstate', '$cczip', '$tcontactname1', '$tcontactemail1', '$tcontactphone1', '$tcontactname2', '$tcontactemail2', '$tcontactphone2', '$tcontactname3', '$tcontactemail3', '$tcontactphone3', '$foldername')";

mysql_query($query);
*/

//SO Pdf creation
require('fpdf/html2fpdf.php');
require('include/class.phpmailer.php');

$mail = new PHPMailer();

$pdf=new HTML2FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(15);
$pdf->SetTopMargin(5);  
$strContent = '<?xml version="1.0" encoding="iso-8859-1"?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title>Engaging Pillar\'s Technical Services</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		</head>
		<body>
                <div style="margin-top:5px;float:left;width:100%;">
			<table style="margin-top:10px" width="100%" border="0" cellspacing="5" cellpadding="5" align="center">
				<tr>
					<td colspan="3" style="width:100%" align="center">
						<h2>PILLAR LETTER OF AGREEMENT</h2>
					</td>
				</tr>
                                <tr>
					<td colspan="2" height="10"></td> 
				</tr>
                                   <tr>
					<td colspan="2" height="10"></td> 
				</tr>
				<tr>
					<td colspan="2" height="75">
						<b>Pillar Consulting Corporation</b>
						<br>1133 Broadway, Suite 604<br>
						New York, NY 10010<br><b>EIN: 13-3818217</b>
					</td>
				</tr>
			
				<tr>
					<td colspan="2" height="10"></td> 
				</tr>
				<tr>
					<td colspan="2" align="left">
						<b>Project Info</b>
					</td>
				</tr>
				<tr>
					<td>Nature of service : '.$projnat.'</td>
					<td></td>
				</tr>

					
				

					
				<tr>
					<td>Name : '.$pname.'</td>
					<td></td>
				</tr>';
				if ($_POST['servicetypval'] == "newtool") {
					if($projspecval == 'yes'){
					$strContent .= 	'<tr>
									 <td>Detailed Project Specifications provided : '.$projspecval.'</td>
									 <td></td>
									 </tr>';
					}
					$strContent .= '<tr>
									<td colspan="2">Project details : '.$_POST['projcomment'].'</td>
									</tr>
									<tr>
									<td>Is web server available : '.$_POST['wserv_statval'].'</td>
									<td></td>
									</tr>
									<tr>
									<td><b>Fee : $'.str_replace("$", "",$pfee).'</b></td>
									<td># of Payments : '.$pnpayment_c.'</td>
									</tr>
									<tr>
									<td colspan="2">Additional details : '.$_POST['addntcomment'].'</td>
									</tr>
									<tr>
									<td colspan="2">I understand that PILLAR will refuse all CHANGE ORDER requests during development of this project. I understand that if a CHANGE ORDER must be applied, there will be a KILL FEE + CHANGE ORDER FEE and will require a new project agreement.</td>
									</tr>';
				}
				else if ($_POST['servicetypval'] == "websupport") {
					$strContent .= '<tr>
									<td colspan="2">Project details : '.$_POST['ws_projcomment'].'</td>
									</tr>
									<tr>
									<td>Is it a Wordpress site : '.$_POST['wp_stat'].'</td>
									<td></td>
									</tr>
									<tr>
									<td>Do you have FTP login : '.$_POST['ftp_stat'].'</td>
									<td></td>
									</tr>
									<tr>
									<td><b>Fee : $'.str_replace("$", "",$pfee).'</b></td>
									<td></td>
									</tr> 
									<tr>
									<td colspan="2">Additional details : '.$_POST['ws_addntcomment'].'</td>
									</tr>';
				}
				else if ($_POST['servicetypval'] == "itsupport") {
					$strContent .= '<tr>
									<td colspan="2">Project details : '.$_POST['its_projcomment'].'</td>
									</tr>';
					if ($pfee != '') {				
						$strContent .= '<tr>
									<td><b>Fee : $'.str_replace("$", "",$pfee).'</b></td>
									<td></td>
									</tr>';
					}
					if ($pbudget != '') {
						$strContent .= '<tr>
									<td>Budget : $'.$pbudget.'</td>
									<td></td>
									</tr>';
					}
						$strContent .= '<tr>
									<td colspan="2">Additional details : '.$_POST['its_addntcomment'].'</td>
									</tr>';
				}				
				else if ($_POST['servicetypval'] == "monthlyretainer") {
					if ($mr_itorweb == 'IT') :
						$strContent .= '<tr><td colspan="2">Address: '.$mr_offaddress.'</td></tr>
									<tr><td colspan="2">City: '.$mr_offcity.'</td></tr>
									<tr><td colspan="2">State: '.$mr_offstate.'</td></tr>
									<tr><td colspan="2">Zipcode: '.$mr_offzip.'</td></tr>';
					else:
						$strContent .= '<tr><td colspan="2">Website Address: '.$mr_webaddress.'</td></tr>';
					endif;
					$strContent .= '<tr><td colspan="2">Hours per month agreed: '.$mr_hours.'</td></tr>';
					$strContent .= '<tr><td colspan="2">Monthly rate for agreed hours: ' . $mr_rate . '<td></tr>';
					$strContent .= '<tr><td colspan="2">Start Date: ' . ucwords($mr_startmonth) .', '.$mr_startday.'</td></tr>';
				}				
				
	$strContent .= '<tr>
					<td colspan="2" height="10"></td>
				</tr>

				<tr>
					<td colspan="2" align="left">
					<b>Referred By:</b>
					</td>
				</tr>
				
				<tr>
					<td>'.$refer.'</td>
				</tr>	
				
				<tr>
					<td colspan="2" height="10"></td>
				</tr>

					
				<tr>
					<td colspan="2" align="left">
						<b>Company Info</b>
					</td>
				</tr>
				<tr>						
					<td>Name : '.$fname.' '.$lname.'</td>
					<td></td>
				</tr>
				<tr>						
					<td>Company Name : '.$cname.'</td>
					<td>Company Address : '.$caddress.'</td>
				</tr>
				<tr>						
					<td>Company City : '.$ccity.'</td>
					<td>Company State : '.$cstate.'</td>
				</tr>
				<tr>						
					<td>Company Zip : '.$czip.'</td>
					<td>Company Phone : '.$cphone.'</td>
				</tr>
				<tr>						
					<td>E-mail : '.$email.'</td>
					<td>Skype : '.$compskype.'</td>
				</tr>
				<tr>						
					<td>Billing Contact : '.$bcontact.'</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" height="10"></td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<b>Credit Card Info</b>
					</td>
				</tr>
				<tr>						
					<td>Type : '.$cctype.'</td>
					<td>Number : '.$ccno.'</td>
				</tr>
				<tr>						
					<td>Holder\'s Name : '.$ccname.'</td>
					<td>Expiry Date : '.$ccexpiry.'</td>
				</tr>
				<tr>						
					<td>CID : '.$cid.'</td>
				</tr>
				<tr>
					<td colspan="2" height="10"></td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<b>Billing Info</b>
					</td>
				</tr>
				<tr>						
					<td>Address : '.$ccaddress.'</td>
					<td>Phone : '.$ccphone.'</td>
				</tr>
				<tr>						
					<td>City : '.$cccity.'</td>
					<td>State : '.$ccstate.'</td>
				</tr>
				<tr>						
					<td>Zip : '.$cczip.'</td>
					<td></td>
				</tr>
				<tr>						
					<td colspan="2"><br>&nbsp;<br>Acceptance :<br>
						a. Name : '.$fname.' '.$lname.'<br>
						b. Digital Signature : '.$sign.'<br>
						c. Date form was filled : '.date('F jS, Y').'
					</td>
				</tr>
				<tr>
					<td colspan="2" height="35">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<h3>One (1) Additional Stakeholder</h3>
					</td>
				</tr>
				<tr>						
					<td colspan="2">1. '.$stakename1.' ('.$stakeemail1.') ('.$stakephone1.') </td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<h3>Authorized Persons Permitted to Contact Us for Billable Support</h3>
					</td>
				</tr>
				<tr>						
					<td colspan="2">1. '.$tcontactname1.' ('.$tcontactemail1.') ('.$tcontactphone1.') </td>
				</tr>
				<tr>						
					<td colspan="2">2. '.$tcontactname2.' ('.$tcontactemail2.') ('.$tcontactphone2.') </td>
				</tr>
			</table>
                        </div>
		</body>
		</html>';
  $fp = fopen("admin/datafile.txt","r"); 
    $contents = fread($fp,filesize("admin/datafile.txt")); 
    fclose($fp); 
    
$pdf->WriteHTML($strContent);
$pdf->AddPage();
$pdf->SetFont('Times','',8);
$pdf->SetLeftMargin(15);
$pdf->SetTopMargin(15);
$reportSubtitle = stripslashes(str_replace("\\","",$contents));
//$reportSubtitle = iconv('UTF-8', 'windows-1252', $reportSubtitle);

$strContent2 = '<?xml version="1.0" encoding="iso-8859-1"?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<title>Engaging Pillar\'s Technical Services</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		</head>
		<body><h3 align="center">PILLAR TERMS AND CONDITIONS</h3><br>'.nl2br(str_replace("ï»¿","",$reportSubtitle)).'
		</body>
		</html>';
//$strContent2 = iconv('UTF-8', 'windows-1252', $strContent2);
$pdf->WriteHTML($strContent2); 
//$pdf->Output("sample.pdf");
//$doc = $pdf->Output('agreements/'.$cname.' Letter of Agreement.pdf', 'F');
$doc = $pdf->Output('agreements/'.$cname.' Letter of Agreement.pdf', 'F');
//$pdf->Output('agreements/'.$cname.' Letter of Agreement.pdf', 'F');
//exit;
//EO Pdf creation			

//Mailing

$to = 'chief@pillarsupport.com'; 
//$to = 'vip.vimal04@gmail.com'; 

// subject
$subject = 'New Client Added';

// message
$message = "A New Client has been added \n
            First Name: ".$fname." \n
            Last Name: ".$lname." \n";
if($projspecval == 'yes' && !empty($foldername)){ 
	$message .= "Files are located at ".$foldername." \n";
}
if($_POST['wp_statval'] == 'Yes'){ 
	$message .= "Wordpress admin URL - ".$_POST['wpadminurl']." \n"
				."Username - ".$_POST['wpuname']."\n"
				."Password - ".$_POST['wppass']."\n";
}
if($_POST['ftp_statval'] == 'Yes'){ 
	$message .= "FTP host - ".$_POST['ftphost']." \n"
				."Username - ".$_POST['ftpuname']."\n"
				."Password - ".$_POST['ftppass']."\n";
}
$fp = fopen("admin/emailfile.txt","r");
$email_contents = fread($fp,filesize("admin/emailfile.txt"));
fclose($fp);

$client_message = "Hi ".$fname." ".$lname.", \n\n".$email_contents;

$mail->SetFrom('noreply@pillarsupport.com','Pillar Support');
$mail->AddAddress($to);
$mail->Subject = "New Client Added"; 
$mail->Body = $message;
//$mail->AddStringAttachment($doc, $cname.' Letter of Agreement.pdf', 'base64', 'application/pdf');
$mail->AddAttachment('agreements/'.$cname.' Letter of Agreement.pdf');
$mail->Send();	

if($email != ''){
$mail->AddAddress($email);	
$mail->Subject = "Engaging Pillar's Technical Services";
$mail->Body = $client_message; 	
$mail->Send();
}
?>
