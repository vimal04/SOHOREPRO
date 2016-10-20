<?php
include("header.inc.php");

/********************************/
/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/
/* Edit the entries below to reflect the appropriate values
/********************************/

$db = new Database();
$fieldseparator = "\t";
$lineseparator = "\n";
$csvfile = "Cust.txt";
/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 0;
/********************************/
/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 0;
$outputfile = "output.sql";
/********************************/


if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
}

$file = fopen($csvfile,"r");

if(!$file) {
	echo "Error opening data file.\n";
	exit;
}

$size = filesize($csvfile);

if(!$size) {
	echo "File is empty.\n";
	exit;
}

$csvcontent = fread($file,$size);


/*
echo "<table>\n";

$row = 0;
//$handle = fopen("mycsvfile.csv", "r");

while (($data = fgetcsv($file)) !== FALSE)
{
    if ($row == 0)
	{
        // this is the first line of the csv file
        // it usually contains titles of columns
        $num = count($data);
        echo "<thead>\n<tr>";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo "<th>" . $data[$c] . "</th>";
        }
        echo "</tr>\n</thead>\n\n<tbody>";
    } else {
        // this handles the rest of the lines of the csv file
        $num = count($data);
        echo "<tr>";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo "<td>" . $data[$c] . "</td>";
        }
        echo "</tr>\n";
    }
}
  echo "</tbody>\n</table>";
 *
 */

fclose($file);




//$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
//@mysql_select_db($databasename) or die(mysql_error());
/**/


//the columns from the import file
//!CUST	0
define('NAME', 1);
define('REFNUM', 2);
define('TIMESTAMP', 3);
define('BADDR1', 4);
define('BADDR2', 5);
define('BADDR3', 6);
define('BADDR4', 7);
define('BADDR5', 8);
define('SADDR1', 9);
define('SADDR2', 10);
define('SADDR3', 11);
define('SADDR4', 12);
define('SADDR5', 13);
define('PHONE1', 14);
define('PHONE2', 15);
define('FAXNUM', 16);
define('EMAIL', 17);
define('NOTE', 18);
define('CONT1', 19);
/*
define(CONT2
define(CTYPE
define(TERMS
define(TAXABLE
define(SALESTAXCODE
LIMIT
RESALENUM
REP
TAXITEM
NOTEPAD
SALUTATION
COMPANYNAME
FIRSTNAME
MIDINIT
LASTNAME
CUSTFLD1
CUSTFLD2
CUSTFLD3
CUSTFLD4
CUSTFLD5
CUSTFLD6
CUSTFLD7
CUSTFLD8
CUSTFLD9
CUSTFLD10
CUSTFLD11
CUSTFLD12
CUSTFLD13
CUSTFLD14
CUSTFLD15
JOBDESC
JOBTYPE
JOBSTATUS
JOBSTART
JOBPROJEND
JOBEND
HIDDEN
DELCOUNT
PRICELEVEL
*/
die();
ob_start();     // buffer output
set_time_limit(200);

echo "<div id='mainContent'>";
//echo "		<table border=1>\n";

$lines = 0;
$queries = "";
$linearray = array();
$allLines = split($lineseparator,$csvcontent);
echo "Importing ".count($allLines)." records.<br />";
foreach($allLines as $line)
{
	$lines++;
	$line = trim($line," \t");
	$line = str_replace("\r","",$line);
	$line = str_replace('"',"",$line);
	$line = str_replace("\\","",$line);

	//************************************
	//This line escapes the special character. remove it if entries are already escaped in the csv file
	//************************************
	$line = str_replace("'","\'",$line);
	//*************************************
	
	$linearray = explode($fieldseparator,$line);

	/*
	echo "<tr>";
    foreach ($linearray as $cell) 
	{
		echo "<td>" . $cell . "</td>";
    }
	echo "</tr>\n";
	*/
	
	if ($lines % 100 == 0)
	{
		echo "Processed $lines records.<br />";
		//ob_end_clean();
		//ob_end_flush();
		ob_flush();
		flush();
	}

	$query = "insert into company (descr, `NAME`,`BADDR1`,`BADDR2`,`BADDR3` ,`BADDR4` ,
					`BADDR5`,`SADDR1`,`SADDR2` ,`SADDR3`,`SADDR4` ,
					`SADDR5`, `PHONE1`,`PHONE2`, `FAXNUM`,`EMAIL` ,`CONT1` )
			values(";

	$query .= "'{$linearray[NAME]}',";
	$query .= "'{$linearray[NAME]}',";
	$query .= "'{$linearray[BADDR1]}',";
	$query .= "'{$linearray[BADDR2]}',";
	$query .= "'{$linearray[BADDR3]}',";
	$query .= "'{$linearray[BADDR4]}',";
	$query .= "'{$linearray[BADDR5]}',";
	$query .= "'{$linearray[SADDR1]}',";
	$query .= "'{$linearray[SADDR2]}',";
	$query .= "'{$linearray[SADDR3]}',";
	$query .= "'{$linearray[SADDR4]}',";
	$query .= "'{$linearray[SADDR5]}',";
	$query .= "'{$linearray[PHONE1]}',";
	$query .= "'{$linearray[PHONE2]}',";
	$query .= "'{$linearray[FAXNUM]}',";
	$query .= "'{$linearray[EMAIL]}',";
	$query .= "'{$linearray[CONT1]}'";
	$query .= ");";
	
	//echo $query."<br>";
	$db->executeSQL($query, __FILE__, __LINE__, false);
	//$queries .= $query . "\n";

	
}

//echo "</table>";
echo "</div>";


if($save) {
	
	if(!is_writable($outputfile)) {
		echo "File is not writable, check permissions.\n";
	}
	
	else {
		$file2 = fopen($outputfile,"w");
		
		if(!$file2) {
			echo "Error writing to the output file.\n";
		}
		else {
			fwrite($file2,$queries);
			fclose($file2);
		}
	}
	
}

echo "Found a total of $lines records in this csv file.\n";


?>
