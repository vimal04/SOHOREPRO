/*
 * (c) 2007 Gigantic, Inc., All Rights Reserved
 * $Id: check_fields.js,v 1.1 2007/07/12 04:47:57 tredman Exp $
 */

function check_fields(frm)
{
	var passwd1, passwd2;
	var i, j;
	var flds = new Array("email", "passwd");
	var desc = new Array("Email Address", "Password");
	for (i = 0; i < frm.elements.length; i++) {
		for (j = 0; j < flds.length; j++) {
			if (frm.elements[i].name == flds[j] && frm.elements[i].value == "") {
				alert(desc[j] + " is a required field.");
				return false;
			}
		}
		
	}
	
	return true;
}
