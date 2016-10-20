<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//THIS UPDATES A DATABASE
//create DB connection

$handle=fopen($_GET['fieldname'] . ".txt", "w+");
fwrite($handle, stripslashes($_GET['content']));
fclose($handle);

//update from table set $fieldname = $content where userID = $_COOKIE['userID']
$fieldname = $_GET['fieldname'];
echo stripslashes(strip_tags($_GET['content'],"<br><p><img><a><br /><strong><em>"));
?>