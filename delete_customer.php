<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['customer_id']) && $_POST['customer_id']!='')
{

   $customer_id = $_POST['customer_id'];
   $img_name = $_POST['img_name'];

          $sql_select_report = "SELECT * from report_tb where customer_id=".$customer_id."";
         $query_sql_select_report = mysql_query($sql_select_report);
         $num_report = mysql_num_rows($query_sql_select_report);
         if($num_report > 0)
         {
            echo 0;
         }
         else
         {

            $delete_customer = "DELETE FROM customer_tb WHERE customer_id='".$customer_id."'";
         

         $query_delete_customer = mysql_query($delete_customer) or die("Could not delete customer");
        
                  if(isset($query_delete_customer))
                  {
                     
                     
                     unlink('img_customer/'.$img_name);
                     echo 1;
                  }


         }

        

     
   mysql_close($conn);
}

?>
