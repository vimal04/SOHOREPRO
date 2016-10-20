<?php
//include './config.php';
//If directory doesnot exists create it.
$output_dir = "uploads/";

if(isset($_FILES["file"]))
{
	$ret = array();

	$error =$_FILES["file"]["error"];
   {
            $ImageName      = str_replace(' ','-',strtolower($_FILES['file']['name']));
            $ImageType      = $_FILES['file']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'.'.$ImageExt;

            move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir. $NewImageName);
    }
    echo '1';
 
}

?>