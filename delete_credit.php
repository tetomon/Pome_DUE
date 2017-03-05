<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['card_id']) && $_POST['card_id']!='')
{

   $card_id = $_POST['card_id'];


        $delete_card = "DELETE FROM credit_card_tb WHERE card_id='".$card_id."'";
         

         $query_delete_card = mysql_query($delete_card) or die("Could not delete card");
        
         if(isset($query_delete_card))
         {
            
            echo 1;
         }


     
   mysql_close($conn);
}

?>
