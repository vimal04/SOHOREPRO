/*
 * (c) 2008 Gigantic, Inc., All Rights Reserved
 * $Id: supplies.js,v 1.5 2009/03/10 03:23:35 tredman Exp $
 */

/* To select category */
function select_current(x)
{
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_category.php?catid="+x;
	new Ajax.Updater("selection_content", url, {method: "get", asynchronous: false});
	url = base_href+"/ajax/ss_title.php?catid="+x;
	new Ajax.Updater("selection_title", url, {method: "get", asynchronous: false});
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
}

/* To show product listing */
function select_category(x)
{
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_product.php?catid="+x;
	new Ajax.Updater("selection_content", url, {method: "get", asynchronous: false});
	url = base_href+"/ajax/ss_title.php?catid="+x;
	new Ajax.Updater("selection_title", url, {method: "get", asynchronous: false});
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
}

/* For View Cart, etc */
function view_cart()
{
	highlightNav();
	highlightButton('viewCartButton');
	
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_viewcart.php";
	new Ajax.Updater("selection_content", url, {asynchronous: false});
	//$("selection_title").update("Shopping Cart");
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
}

/* To commit item quantities to cart */
function add_items(x)
{
	highlightNav();
	highlightButton('viewCartButton');
	
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_additems.php";
	var h = new Hash();
	var input_fields = $$("INPUT.item_qty");
	var i;
	for (i =0; i < input_fields.length; i++) {
		h.set(input_fields[i].id, parseInt(input_fields[i].value));
	}
	new Ajax.Request(url, {method: "post", asynchronous: false, parameters: h.toQueryString()});
	url = base_href+"/ajax/ss_viewcart.php?catid="+x;
	new Ajax.Updater("selection_content", url, {asynchronous: false});
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
	alert("Item(s) added.");
}

function del_items(x)
{
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_viewcart.php?d="+x;
	new Ajax.Updater("selection_content", url, {asynchronous: false});
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
}

function upd_items(x, y) {
	if (y == 0) {
		del_items(x);
	} else {
		$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
		var url = base_href+"/ajax/ss_viewcart.php?u="+x+"&q="+y;
		new Ajax.Updater("selection_content", url, {asynchronous: false});
		url = base_href+"/ajax/ss_cartcontents.php";
		new Ajax.Updater("selection_cart", url, {asynchronous: false});
	}
}

function add_to_cart(id)
{
	inpt = $('pid_'+id);
	qty = inpt.value;
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_additems.php";
	var h = new Hash();
	h.set('pid_'+id, parseInt(inpt.value));	
	new Ajax.Request(url, {method: "post", asynchronous: false, parameters: h.toQueryString()});
	
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
}


/* To checkout */
function checkout()
{
	document.location = "order_supplies2.php";
}

function order_hist()
{
	highlightNav();

	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_viewhist.php";
	new Ajax.Updater("selection_content", url, {asynchronous: false});
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
}

function newOrder()
{
	$("selection_cart").update("<img src='images/ajax-loader.gif' /> Please Wait...");
	var url = base_href+"/ajax/ss_additems.php";
	var h = new Hash();
	var input_fields = $$("INPUT.new-order-amt");
	var i;
	for (i =0; i < input_fields.length; i++) {
		h.set(input_fields[i].id, parseInt(input_fields[i].value));
	}
	new Ajax.Request(url, {method: "post", asynchronous: false, parameters: h.toQueryString()});
	url = base_href+"/ajax/ss_viewcart.php";
	new Ajax.Updater("selection_content", url, {asynchronous: false});
	url = base_href+"/ajax/ss_cartcontents.php";
	new Ajax.Updater("selection_cart", url, {asynchronous: false});
	alert("Item(s) added.");
}


function highlightNav()
{
	highlightButton('');
	
	nav = document.getElementById('storeNav');
	for (i=0; i<nav.childNodes.length; i++)
	{
		node = nav.childNodes[i];
		if (node.nodeName=="LI")
		{
			a = node.childNodes[0];
			if (a.className != 'navHeader') a.className = '';
		}
	}

	
}



function highlightButton(id)
{
	orderHistoryButton = document.getElementById('orderHistoryButton');
	viewCartButton = document.getElementById('viewCartButton');
	checkoutButton = document.getElementById('checkoutButton');

	orderHistoryButton.className = (id == 'orderHistoryButton') ? 'roundedHover' : 'rounded';
	viewCartButton.className = (id == 'viewCartButton') ? 'roundedHover' : 'rounded';
	checkoutButton.className = (id == 'checkoutButton') ? 'roundedHover' : 'rounded';


}
