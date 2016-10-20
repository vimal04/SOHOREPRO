<?php
/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: setup_process.php,v 1.1 2007/07/25 01:58:57 tredman Exp $
 */

//require_once("include/user.class.php");
//require_once("include/company.class.php");

require_once($_SERVER["DOCUMENT_ROOT"]. "/include/user.class.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/include/company.class.php");

$email = trim($_REQUEST["email"]);
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$pwhint = $_REQUEST["pwhint"];
$gender = $_REQUEST["gender"];
$zipcode = $_REQUEST["zipcode"];
$passwd = $_REQUEST["passwd1"];



//first need to check for existance of user email already in the db
$checkUser = new User(0, $email);
if ($checkUser->id > 0)
{	
	
	$result = 'The supplied email is already in our system. Use your browser back button to try again.';
	
}
else 
{
	
	$user = new User();
	
	$user->lname = $lname;
	$user->fname = $fname;
	$user->set_password($passwd);
	$user->login_email = $email;
	$user->pwhint = $pwhint;
	$user->zipcode = $zipcode;
	$user->gender = $gender;
	
	$user->save();
	
	//get email domain
	$emailDomain = explode('@', $email);
	$emailDomain = $emailDomain[1];
	
	//check for a company record with the email domain of the user
	$companies = new Companies();
	$comps = $companies->search(array('email_domain'=>$emailDomain));
	//set the user to the company
	if (!empty($comps))
	{
		$company = new Company($comps[0]['id']);
		$company->add_user($user->id);
	}
	
	
	$headers = sprintf("From: %s\r\n", ADM_EMAIL);
	
	$full_email = sprintf("%s %s <%s>", $user->fname, $user->lname, $user->login_email);
	
	$msg = sprintf("Dear %s,\n\n", $user->fname);
	$msg .= sprintf("Thank you for creating a new account on the SoHo Reprographics web site. ");
	$msg .= sprintf("In order to active your newly created account, you must click on the following ");
	$msg .= sprintf("URL, or cut and paste it into your browser:\n\n");
	$msg .= sprintf("http://%s%s?c=%s\n\n",
		$_SERVER["SERVER_NAME"], 
		preg_replace("/process/", "confirm", $_SERVER["PHP_SELF"]),
		strtoupper(md5($user->login_email)));
	$msg .= sprintf("Once you've done that, your account ");
	$msg .= sprintf("will be ready to log in to.\n\n");
	$msg .= sprintf("Your user name is: %s\n", $email);
	$msg .= sprintf("Your password is: %s\n\n", $passwd);
	$msg .= sprintf("Thank you for visiting our web site.  We hope you enjoy it.");
	
	$result = mail($full_email, "[SoHo Reprographics] New Account Setup", wordwrap($msg), $headers);
	if ($result) 
	{
		$result = "	A confirmation email has been sent to <b>$email</b>.
				Please read the instructions in that email to activate your account.";
	}
	else 
	{	$result ="There was a problem sending your confirmation E-mail to <b>$email</b>.
				Please contact SoHo Reprographics.";
	}
}


require_once("header.inc.php");
?>
<div id="middleImage">
	<table width="952" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="172"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
			<td width="350">
				<span class="style1">CREATED AN ACCOUNT</span><br>
				<span class="style5">Please check your E-mail.</span>
			</td>
			<td width="430">
				<span class="style4">
					<ul>
						<li>Fast and easy ordering when you sign up for a free account.</li>
						<li>Secure information</li>
						<li>Help save trees.</li>
					</ul>
				</span>
			</td>
		</tr>
	</table>
</div>
<div id="mainContent" class="bodyWhite">
<?php	echo $result;?>
</div>
<?php require_once("footer.inc.php");?>