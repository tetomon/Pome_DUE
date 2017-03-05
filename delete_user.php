<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['user_id']) && $_POST['user_id']!='')
{

         $delete_user = "DELETE FROM user_tb WHERE user_id='".$_POST['user_id']."'";  

         $query_delete_user = mysql_query($delete_user) or die("Could not delete user");
        
               if(isset($query_delete_user))
               {
                  
                  echo 1;
               }

   mysql_close($conn);
}

?>
