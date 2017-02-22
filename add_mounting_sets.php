<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);

// Reference Values
// 9 - Add New Recipients
// 8 - Delete Added Recipients
// 7 - Edit Added Recipients
// 6 - Update Added Recipients
// 
// 5 - Increase the Available Sets
// 4 - Decrease the Available Sets
// Made the Repository 

if ($_POST['all_mounting_sets'] == '1') {   
   //echo $_POST['mounting_select'];
  // echo $_POST['lamination_select'];
  print_r($_POST['mount_data']);
//echo '1';

}


