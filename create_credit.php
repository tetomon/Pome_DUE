<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   $current_date = date('Y-M-d');
   
   //query for insert data into tables

if(isset($_POST['card_name']) && $_POST['card_name']!='')
{
   $card_name = $_POST['card_name'];
   $card_num = $_POST['card_num'];
   $credit_line = $_POST['credit_line'];
   $balance = $_POST['balance'];
   $minimum_pay = $_POST['minimum_pay'];
   $interest = $_POST['interest'];


   $insert_card = "INSERT INTO `credit_card_tb`
                       (`card_number`,`card_name`,`credit_line`,`balance`,`minimum_pay`,`interest_per_month`)
                        VALUES
                       ('".$card_num."','".$card_name."','".$credit_line."','".$balance."','".$minimum_pay."','".$interest."')";

                      
                       
                       $query_insert_card = mysql_query($insert_card) or die("Could not insert card");

                       echo 1;
                 
}

?>
