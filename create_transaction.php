<?php
include 'connect_db.php';
include 'check_session.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   $current_date = date('Y-M-d');
   
   //query for insert data into tables

if(isset($_POST['user_id']) && $_POST['card_id']!='')
{
   $user_id = $_POST['user_id'];
   $card_id = $_POST['card_id'];
   $amount = $_POST['amount'];
   $reason = $_POST['reason'];
   $type_create = $_POST['type_create'];
   $date_pay = $_POST['date_pay'];

   $insert_log = "INSERT INTO `log_tb`
                       (`card_id`,`date`,`type`,`amount`,`user_id`,`remark`)
                        VALUES
                       ('".$card_id."','".$date_pay."','".$type_create."','".$amount."','".$user_id."','".$reason."')";

          
                       
                       $query_insert_log = mysql_query($insert_log) or die("Could not insert log transaction");

                       echo 1;
                 
}

?>
