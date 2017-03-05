<?php
include 'connect_db.php';
include 'check_session.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   $current_date = date('Y-M-d');
   
   //query for insert data into tables

if(isset($_POST['user_id']) && $_POST['card_id']!='')
{

  $log_id = $_POST['log_id'];
   $user_id = $_POST['user_id'];
   $card_id = $_POST['card_id'];
   $amount = $_POST['amount'];
   $reason = $_POST['reason'];
   $type_edit = $_POST['type_edit'];
   $date_pay = $_POST['date_pay'];

  $update_log = "UPDATE log_tb SET ";
                        $update_log .="card_id = '".$card_id."' ";
                        $update_log .=",date = '".$date_pay."' ";
                        $update_log .=",type = '".$type_edit."' ";
                        $update_log .=",amount = '".$amount."' ";
                        $update_log .=",user_id = '".$user_id."' ";
                        $update_log .=",remark = '".$reason."' ";
                        $update_log .="WHERE log_id = ".$log_id."";
                        
                        $query_update_log = mysql_query($update_log) or die("Could not update log");
                            if(isset($query_update_log))
                            {
                          
                               echo 1; 
                            }else
                            {
                              echo 0; 
                            }
                 
}
  
?>
