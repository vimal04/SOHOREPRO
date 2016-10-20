<?php
error_reporting(E_ALL ^ E_DEPRECATED);

   error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE);


$currhost=1;

if($currhost==0)
{
    
   $link = mysql_connect('localhost', 'cipldevc_jasim', 'Jasim#123');

    $db_selected = mysql_select_db('cipldevc_soho_new', $link);
    
    $base_url="http://".$_SERVER['SERVER_NAME']."";
}
else 
{    
    $link = mysql_connect('localhost', 'cipldevc_jasim', 'Jasim#123');

    $db_selected = mysql_select_db('cipldevc_soho_new', $link);
    
    $base_url="http://".$_SERVER['SERVER_NAME']."";
}


if (!$db_selected) {
    die('Database not connected : ' . mysql_error());
}
echo mysql_error();


?>
