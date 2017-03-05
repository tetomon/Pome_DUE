<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['eng_id']) && $_POST['eng_id']!='')
{

         $engineer_id = $_POST['eng_id'];

         $sql_select_report = "SELECT * from report_tb where eng_id=".$engineer_id ."";
         $query_sql_select_report = mysql_query($sql_select_report);
         $num_report = mysql_num_rows($query_sql_select_report);

         if($num_report > 0)
         {
            echo 0;
         }
         else
         {
         $delete_engineer = "DELETE FROM engineer_tb WHERE eng_id='".$engineer_id."'";  

         $query_delete_engineer = mysql_query($delete_engineer) or die("Could not delete engineer");
        
               if(isset($query_delete_engineer))
               {
                  
                  echo 1;
               }

         }


          

     
   mysql_close($conn);
}

?>
