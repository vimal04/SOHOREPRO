/*
 * (c) 2009 Gigantic, Inc., All Rights Reserved
 * $Id: credapp_data.js,v 1.4 2009-11-08 07:27:59 tredman Exp $
 */

var INPUTTYPE { TEXT:1, NUMBER:2, CHECKBOX:3, RADIO:4 };

function printField(fld) {
}

function FormOption(n, v) {
	this.optionname = n;
	this.optionvalue = v;
}

function FormField(nam, typ, siz, req, lbl) {
	this.fieldname = nam;
	this.fieldtype = typ;
	this.fieldsize = siz;
	this.fieldvalue = "";
	this.fieldoption = [];
	this.required = req;
	this.fieldlabel = lbl;
}

function Address(prefix, req, lbl) {
	this.addresslabel = lbl;
	this.street = new FormField(prefix+"street", INPUTTYPE.TEXT, 64, req);
	this.city = new FormField(prefix+"city", INPUTTYPE.TEXT, 64, req);
	this.state = new FormField(prefix+"state", INPUTTYPE.TEXT, 5, req);
	this.zip = new FormField(prefix+"zip", INPUTTYPE.TEXT, 10, req);
	this.toString = function() {
		printf("<DIV>");
		printField(this.street);
		printField(this.city);
		printField(this.state);
		printField(this.zip);
		
	}
}

function ContactInfo() {
	this.company = new FormField("company", INPUTTYPE.TEXT, 64, false);
	this.address = new Address("company-", false);
	this.phone = new FormField("company-phone", INPUTTYPE.TEXT, 16, false);
	this.fax = new FormField("company-fax", INPUTTYPE.TEXT, 16, false);
	this.email = new FormField("company-email", INPUTTYPE.TEXT, 64, false);
	this.yearsatloc = new FormField("yearsatloc", INPUTTYPE.NUMBER, 3, false);
	this.billingaddr = new Address("billing-", false);
	this.billphone = new FormField("bill-phone", INPUTTYPE.TEXT, 16, false);
	this.billfax = new FormField("bill-fax", INPUTTYPE.TEXT, 16, false);
}

function OrganizationType() {
	this.orgtype = new FormField("orgtype", INPUTTYPE.RADIO, 1, false);
	this.orgtype.fieldoption[0] = new FormOption("PROP", "Proprietorship");
	this.orgtype.fieldoption[1] = new FormOption("INDV", "Individual");
	this.orgtype.fieldoption[2] = new FormOption("PART", "Partnership");
	this.orgtype.fieldoption[3] = new FormOption("CORP", "Corporation");
	this.parentco = new FormField("parentco", INPUTTYPE.TEXT, 32, false);
	this.since = new FormField("since", INPUTTYPE.TEXT, 16, false);
	this.owneraddr = new Address("owner-", false);
	this.ownerphone = new FormField("owner-phone", INPUTTYPE.TEXT, 16, false);
	this.treasurer = new FormField("treasurer", INPUTTYPE.TEXT, 32, false);
	this.apmanager = new FormField("apmanager", INPUTTYPE.TEXT, 32, false);
}

function OrganizationSize() {
	this.employees = new FormField("employees", INPUTTYPE.RADIO, 1, false);
	this.employees.fieldoption[0] = new FormOption("1", "1-5");
	this.employees,fieldoption[1] = new FormOption("6", "6-15");
	this.employees.fieldoption[2] = new FormOption("16", "16-50");
	this.employees.fieldoption[3] = new FormOption("51", "51-100");
	this.employees.fieldoption[4] = new FormOption("101", "over 100");
}

function BusinessType() {
	this.bustype = new FormField("bustype", INPUTTYPE.RADIO, 1, false);
	this.bustype.fieldoption[0] = new FormOption("ARCH", "Architect");
	this.bustype.fieldoption[1] = new FormOption("DESN", "Ad or Design");
	this.bustype.fieldoption[2] = new FormOption("INDU", "Industrial");
	this.bustype.fieldoption[3] = new FormOption("ENGN", "Engineering");
	this.bustype.fieldoption[4] = new FormOption("MUNI", "Municipal/Federal");
	this.bustype.fieldoption[5] = new FormOption("UNIV", "Schools/Universities");
	this.bustype.fieldoption[6] = new FormOption("GENL", "General Office");
	this.bustype.fieldoption[7] = new FormOption("CNST", "Construction");
	this.bustype.fieldoption[8] = new FormOption("PRNT", "Printing/News/Pub.");
	this.bustype.fieldoption[9] = new FormOption("MISC", "Miscellaneous");
	this.mktgmgr = new FormField("mktgmtr", INPUTTYPE.TEXT, 64, false);
	this.designmgr = new FormField("designmgr", INPUTTYPE.TEXT, 64, false);
	this.officemgr = new FormField("officemgr", INPUTTYPE.TEXT, 64, false);
	this.facilitymgr = new FormField("facilitymgr", INPUTTYPE.TEXT, 64, false);
}

function TradeReference() {
	this.tradename = new FormField("trade-name", INPUTTYPE.TEXT, 64, false);
	this.tradeaddr = new Address("trade-", false);
	this.tradephone = new FormField("trade-phone", INPUTTYPE.TEXT, 16, false);
	this.tradeacct = new FormField("trade-acct", INPUTTYPE.TEXT, 32, false);
}

function BankReference() {
	this.bankname = new FormField("bank-name", INPUTTYPE.TEXT, 64, false);
	this.bankaddr = new Address("bank-", false);
	this.bankphone = new FormField("bank-phone", INPUTTYPE.TEXT, 64, false);
	this.bankofficer = new FormField("bank-officer", INPUTTYPE.TEXT, 64, false);
	this.bankdate = new FormField("bank-date", INPUTTYPE.TEXT, 64, false);
	this.banksig = new FormField("bank-sig", INPUTTYPE.TEXT, 64, false);
}

function Authorization() {
	this.bankacct = new FormField("bank-acct", INPUTTYPE.TEXT, 32, false);
	this.bankacctname = new FormField("bank-acct-name", INPUTTYPE.TEXT, 64, false);
}

function Certification() {
}
