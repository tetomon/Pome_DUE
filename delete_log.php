<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['log_id']) && $_POST['log_id']!='')
{

         $delete_log = "DELETE FROM log_tb WHERE log_id='".$_POST['log_id']."'";  

         $query_delete_log = mysql_query($delete_log) or die("Could not delete log");
        
               if(isset($query_delete_log))
               {
                  
                  echo 1;
               }

   mysql_close($conn);
}

?>
