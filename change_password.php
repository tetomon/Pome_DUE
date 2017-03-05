<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['new_password']) && $_POST['new_password']!='')
{

  $update_password = "UPDATE user_tb SET ";
            $update_password .="password = '".$_POST['new_password']."' ";
            $update_password .="WHERE user_id = '".$_POST['user_id_pass']."'";
            $query_update_password = mysql_query($update_password) or die("Could not update password");
                if(isset($query_update_password))
                {
      
                   echo 1;
                }

     
   mysql_close($conn);
}

?>
