<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SoHo Reprographics - Plotting, Architectural Copies, Copy Shop, Offset, Scanning - New York City</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

//-->
</script>

<script type="text/javascript">
function check_fields(frm)
{
	var passwd1, passwd2;
	var i, j;
	var flds = new Array("email", "pwhint", "fname", "lname", "passwd1", "passwd2");
	var desc = new Array("E-Mail Address", "Password Hint", "First Name", "Last Name", "Password", "Password Confirmation");
	for (i = 0; i < frm.elements.length; i++) {
		for (j = 0; j < flds.length; j++) {
			if (frm.elements[i].name == flds[j] && frm.elements[i].value == "") {
				alert(desc[j] + " is a required field.");
				return false;
			}
		}
		if (frm.elements[i].name == "passwd1") passwd1 = frm.elements[i].value;
		if (frm.elements[i].name == "passwd2") passwd2 = frm.elements[i].value;
	}
	
	if (passwd1 != passwd2) {
		alert("Password and confirmation do not match.");
		return false;
	}
	
	return true;
}
</script>

<link href="soho.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #5379A4;
	background-image: url(images/bkg2.jpg);
}

.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 20px;
	font-weight: bold;
}
.style4 {
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
	line-height: 16px;
}
.style5 {color: #FF5110; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px;}
.style6 {color: #A7BCD1}
.style16 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.style18 {color: #FFFFFF}
-->
</style>
</head>
<body>
<div id="all">	   
	   <div id="logo"><a href="index.php"><img src="images/spacer.gif" alt="logo" width="172" height="122" border="0"></a></div>
	 
	   <div id="topImage"></div>
 
	   <div id="topNav">
	     <span class="style6"><a href="about.php">About Us</a>&nbsp; | &nbsp;<a href="http://www.sohorepro.com/usr/Category.aspx">Order Supplies</a>&nbsp; | &nbsp;<a href="locations.php">Locations</a>&nbsp; | &nbsp;<a href="downloads.php">Downloads</a>&nbsp; | &nbsp;<a href="contact.php">Contact Us</a></span> </div>
	    
	   <div id="loginStatus">
	   <table width="100%" border="0" cellspacing="0" cellpadding="1">
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><div align="right" class="style16"><?PHP echo $_SESSION['loggedIn'];?><br>
</div></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table>
		 </div>
		 
	    <div id="middleNav">
   <table align="left" border="0" cellpadding="0" cellspacing="0" width="950">
	  <tr>
	   <td><a href="plotting.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('plotting_but','','images/plotting_but_f2.jpg',1);"><img name="plotting_but" src="images/plotting_but.jpg" width="84" height="28" border="0" alt=""></a></td>
	   <td><a href="architectural_copies.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('arch_copies_but','','images/arch_copies_but_f2.jpg',1);"><img name="arch_copies_but" src="images/arch_copies_but.jpg" width="142" height="28" border="0" alt=""></a></td>
	   <td><a href="signs.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('signs_but','','images/signs_but_f2.jpg',1);"><img name="signs_but" src="images/signs_but.jpg" width="118" height="28" border="0" alt=""></a></td>
	   <td><a href="offset_printing.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('offset_but','','images/offset_but_f2.jpg',1);"><img name="offset_but" src="images/offset_but.jpg" width="118" height="28" border="0" alt=""></a></td>
	   <td><a href="copy_shop.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('copy_shop_but','','images/copy_shop_but_f2.jpg',1);"><img name="copy_shop_but" src="images/copy_shop_but.jpg" width="94" height="28" border="0" alt=""></a></td>
	   <td><a href="scanning.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('scanning_but','','images/scanning_but_f2.jpg',1);"><img name="scanning_but" src="images/scanning_but.jpg" width="94" height="28" border="0" alt=""></a></td>
	   <td><a href="mounting.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('mounting_but','','images/mounting_but_f2.jpg',1);"><img name="mounting_but" src="images/mounting_but.jpg" width="162" height="28" border="0" alt=""></a></td>
	   <td><a href="digital_planroom.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('dig_plan_but','','images/dig_plan_but_f2.jpg',1);"><img name="dig_plan_but" src="images/dig_plan_but.jpg" width="138" height="28" border="0" alt=""></a></td>
	  </tr>
	</table>
  </div>
  
  	   <div id="middleImage">
	   
	   <table width="952" border="0" cellpadding="0" cellspacing="0">
	     <tr><td width="172"><img src="images/login-warehouse.jpg" width="175" height="80"/></td>
		 <td width="350"><span class="style1">IN PROGRESS......     </span><br>
		 <br>
  	     <br></td>
	       <td width="430"><span class="style4">•Fast and easy ordering when you sign up for a free account. <br>
• Secure information <br>
• Help save trees. </span></td>
         </tr></table>
	</div>

	
	
   
	   <div id="leftNav">
	   <table align="left" border="0" cellpadding="0" cellspacing="0" width="172">
		   <tr>
		    <td><a href="javascript:;" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('repro_tab','','images/repro_order_tab_f2.jpg',1);"><img name="repro_tab" src="images/repro_order_tab.jpg" width="172" height="66" border="0" alt=""></a></td>
	     </tr>
		  <tr>
		   <td><a href="javascript:;" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('upload_tab','','images/upload_tab_f2.jpg',1);"><img name="upload_tab" src="images/upload_tab.jpg" width="172" height="66" border="0" alt=""></a></td>
		  </tr>
		  <tr>
		   <td><a href="javascript:;" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('order_tab','','images/order_tab_f2.jpg',1);"><img name="order_tab" src="images/order_tab.jpg" width="172" height="66" border="0" alt=""></a></td>
		  </tr>
		  <tr>
		   <td><a href="javascript:;" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('schedule_tab','','images/schedule_tab_f2.jpg',1);"><img name="schedule_tab" src="images/schedule_tab.jpg" width="172" height="66" border="0" alt=""></a></td>
		  </tr>
		  <tr>
		   <td><img src="images/spacer.gif" width="172" height="24" border="0" alt=""></td>
		  </tr>
		</table>
  </div>
		
		
		<div id="mainContent">
	   <div id="mainOrderTable">
	     <div id="setupInfo"></div>
         <span class="bodyWhite">Still in progress.... </span></div>
  </div>	     
	     
</div>
</body>
</html>
