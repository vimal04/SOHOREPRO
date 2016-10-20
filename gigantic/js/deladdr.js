function rem_addr(e)
{
	if (window.event) {
		t = window.event.srcElement;
	} else {
		t = e.target;
	}
	var td = t.parentNode;
	var tr = td.parentNode;
	var tbody = tr.parentNode;
	var table = tbody.parentNode;
	table.removeChild(tbody);
}

function cloneLast(table)
{
	var tbody, tr, td, labels, txt, hr, ids, rowid, sizes, maxlengths, inputtext, br, i, grc, inputbutton;
	tbody = document.createElement("TBODY");
	rowid = table.tBodies.length;
	tr = document.createElement("TR");
	td = document.createElement("TD");
	hr = document.createElement("HR");
	td.colSpan = 2;
	td.appendChild(hr);
	tr.appendChild(td);
	tbody.appendChild(tr);

	tr = document.createElement("TR");
	td = document.createElement("TD");
	td.colSpan = 2;
	inputbutton = document.createElement("INPUT");
	inputbutton.type = "button";
	inputbutton.value = "REMOVE THIS ADDRESS";
	inputbutton.onclick = rem_addr;
	td.appendChild(inputbutton);
	tr.appendChild(td);
	tbody.appendChild(tr);

	sel = document.getElementById("shipto_select00").cloneNode(true);
	idx = "00"+String(document.getElementsByName("shipto_select").length);
	sel.id = "shipto_select"+idx.substr(idx.length - 2, 2);
	tr = document.createElement("TR");
	td = document.createElement("TD");
	txt = document.createTextNode("Previous Address");
	td.appendChild(txt);
	tr.appendChild(td);
	td = document.createElement("TD");
	td.appendChild(sel);
	tr.appendChild(td);
	tbody.appendChild(tr);

	labels = new Array("Company", "Attention", "Address", " ", "City", "State", "ZIP");
	ids = new Array("shipto_company", "shipto_attention", "shipto_address1", "shipto_address2", "shipto_city", "shipto_state", "shipto_zip");
	sizes = new Array(32, 32, 32, 32, 32, 5, 10, 3, 3, 4, 6);
	maxlengths = new Array(64, 64, 64, 64, 64, 5, 10, 3, 3, 4, 6);
	for (i = 0; i < labels.length; i++) {
		tr = document.createElement("TR");
		td = document.createElement("TD");
		txt = document.createTextNode(labels[i]);
		td.appendChild(txt);
		tr.appendChild(td);
		td = document.createElement("TD");
		inputtext = document.createElement("INPUT");
		inputtext.name = ids[i]+"[]";
		idx = "00"+String(document.getElementsByName(ids[i]+"[]").length);
		inputtext.id = ids[i]+idx.substr(idx.length - 2, 2);
		inputtext.type = "text";
		inputtext.size = sizes[i];
		inputtext.maxLength = maxlengths[i];
		inputtext.value = "";
		td.appendChild(inputtext);
		tr.appendChild(td);
		tbody.appendChild(tr);
	}
	
	tr = document.createElement("TR");
	td = document.createElement("TD");
	txt = document.createTextNode("Phone");
	td.appendChild(txt);
	tr.appendChild(td);
	td = document.createElement("TD");
	nodes = new Array("(", "shipto_phone_ac", ")", "shipto_phone_pr", "-", "shipto_phone_su", " Ext. ", "shipto_phone_ex");
	sizes = new Array(0, 3, 0, 3, 0, 4, 0, 6);
	for (i = 0; i < nodes.length; i++) {
		if (sizes[i] == 0) {
			txt = document.createTextNode(nodes[i]);
			td.appendChild(txt);
		} else {
			inputtext = document.createElement("INPUT");
			inputtext.name = nodes[i]+"[]";
			idx = "00"+String(document.getElementsByName(nodes[i]+"[]").length);
			var idCounter = idx.substr(idx.length - 2, 2);
			inputtext.id = nodes[i]+idx.substr(idx.length - 2, 2);
			inputtext.type = "text";
			inputtext.size = sizes[i];
			inputtext.maxLength = sizes[i];
			inputtext.value = "";
			//inputtext.onkeyup=tabTo(this, nodes[i]+"[]");
			
			if (nodes[i] == 'shipto_phone_ac')
			{				
				inputtext.onkeyup= new Function ("tabTo('" + inputtext.id + "', 'shipto_phone_pr"+ idCounter+ "')");				 
			}
			
			if (nodes[i] == 'shipto_phone_pr')
			{				
				inputtext.onkeyup= new Function ("tabTo('" + inputtext.id + "', 'shipto_phone_su"+ idCounter+ "')");				 
			}
			
			if (nodes[i] == 'shipto_phone_su')
			{				
				inputtext.onkeyup= new Function ("tabTo('" + inputtext.id + "', 'shipto_phone_ex"+ idCounter+ "')");				 
			}
			
			
			td.appendChild(inputtext);
		}
	}
	tr.appendChild(td);
	tbody.appendChild(tr);
	
	tr = document.createElement("TR");
	td = document.createElement("TD");
	txt = document.createTextNode("Copies");
	td.appendChild(txt);
	tr.appendChild(td);
	td = document.createElement("TD");
	for (i = 0; i < copy_count.length; i++) {
		inputtext = document.createElement("INPUT");
		inputtext.name = "shipto_copies_"+i+"[]";
		inputtext.id = "shipto_copies_"+i+"_"+rowid;
		grc = get_remaining_copies(i);
		inputtext.value = (grc < 0 ? 0 : grc);
		inputtext.type = "text";
		inputtext.size = "6";
		inputtext.maxLength = "6";
		td.appendChild(inputtext);
		txt = document.createTextNode("  "+copy_sizes[i]+" ("+copy_method[i]+")");
		td.appendChild(txt);
		br = document.createElement("BR");
		td.appendChild(br);
	}
	tr.appendChild(td);
	tbody.appendChild(tr);
	table.appendChild(tbody);
}

function get_remaining_copies(idx)
{
	var i, elem, running_count;
	running_count = 0;
	elem = document.getElementsByTagName("INPUT");
	for (i = 0; i < elem.length; i++) {
		if (elem[i].name.substr(0, 14) == "shipto_copies_") {
			if (parseInt(elem[i].name.substr(14,3)) == idx) {
				running_count += parseInt(elem[i].value);
			}
		}
	}
	return (copy_count[idx] - running_count);
}

function check_totals()
{
	var grc, i;
	for (i = 0; i < copy_count.length; i++) {
		grc = get_remaining_copies(i);
		if (grc != 0) {
			alert("Your total for "+copy_sizes[i]+" ("+ (copy_count[i] - grc) +") is incorrect.  Please make sure all entires for "+copy_sizes[i]+" add up to "+copy_count[i]+".");
			return false;
		}
	}
	if (!check_upload()) {
		alert("You have indicated that you are uploading the document to be processed.  Please fill in the form field for your file upload.")
		return false;
	}
	if (check_addresses()) {
		return true;
	} else {
		alert("Some of your addresses aren't filled in completely.  Please enter complete address, or click REMOVE ADDRESS to delete empty ones.");
		return false;
	}
}

function check_addresses()
{
	var i, elem, running_count;
	running_count = 0;
	elem = document.getElementsByTagName("INPUT");
	for (i = 0; i < elem.length; i++) {
		if (elem[i].name.substr(0, 15) == "shipto_address1") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
		if (elem[i].name.substr(0, 14) == "shipto_company") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
		if (elem[i].name.substr(0, 11) == "shipto_city") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
		if (elem[i].name.substr(0, 12) == "shipto_state") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
		if (elem[i].name.substr(0, 15) == "shipto_phone_ac") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
		if (elem[i].name.substr(0, 15) == "shipto_phone_pr") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
		if (elem[i].name.substr(0, 15) == "shipto_phone_su") {
			if (elem[i].value == "") {
				running_count++;
			}
		}
	}
	if (running_count > 0) {
		return false;
	} else {
		return true;
	}
}

function check_upload()
{
	var fld = document.getElementById("uploadfile");
	if (fld.value == "" && !upload_exists) {
		return false;
	}
	return true;
}