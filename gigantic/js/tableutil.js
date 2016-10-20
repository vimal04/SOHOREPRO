/*
 * (c) 2008 Gigantic, Inc., All Rights Reserved
 * $Id: tableutil.js,v 1.3 2009/03/09 19:44:25 tredman Exp $
 */

function focus_row(obj, graybar)
{
	var row = obj.parentNode;
	var i;
	for (i = 0; i < row.childNodes.length; i++) {
		row.childNodes[i].className = "focused";
	}
}

function blur_row(obj, graybar)
{
	var row = obj.parentNode;
	var i;
	for (i = 0; i < row.childNodes.length; i++) {
		row.childNodes[i].className = graybar;
	}
}
