<?php
include 'connect_db.php';
include 'check_session.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   $current_date = date('Y-M-d');
   
   //query for insert data into tables

if(isset($_POST['sel_customer']) && $_POST['sel_customer']!='')
{
   $sel_customer = $_POST['sel_customer'];
   $sel_project = $_POST['sel_project'];
   $sel_engineer = $_POST['sel_engineer'];
   $date_pm = $_POST['date_pm'];
   $date_sent = $_POST['date_sent'];
   $comment = $_POST['comment'];

   $insert_report = "INSERT INTO `report_tb`
                       (`customer_id`,`project_id`,`eng_id`,`date_pm`,`date_sent`,`date_create`,`comment`)
                        VALUES
                       ('".$sel_customer."','".$sel_project."','".$sel_engineer."','".$date_pm."','".$date_sent."','".$current_date."','".$comment."')";


                       
                       $query_insert_report = mysql_query($insert_report) or die("Could not insert report");

                       echo 1;
                 
}

?>
