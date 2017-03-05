<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['report_id']) && $_POST['report_id']!='')
{

   $report_id = $_POST['customer_id'];


        $delete_report = "DELETE FROM report_tb WHERE report_id='".$report_id."'";
         

         $query_delete_report = mysql_query( $delete_report) or die("Could not delete report");
        
         if(isset($query_delete_report))
         {
            
            echo 1;
         }


     
   mysql_close($conn);
}

?>
