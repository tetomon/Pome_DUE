<?php
include 'connect_db.php';
include 'check_session.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   $current_date = date('Y-M-d');
   
   //query for insert data into tables



if(isset($_POST['sel_customer']) && $_POST['service_type_1']!='')
{
   $sel_customer = $_POST['sel_customer'];
   $po_no = $_POST['po_no'];
   $cus_name = $_POST['cus_name'];
   $cus_tel = $_POST['cus_tel'];
   $cus_email = $_POST['cus_email'];
   $start_date = $_POST['start_date'];
   $expire_date = $_POST['expire_date'];
   $service_type_1 = $_POST['service_type_1'];
   $service_type_2 = $_POST['service_type_2'];
   $num_pm = $_POST['num_pm'];
   $num_incident = $_POST['num_incident'];
   $product_list = $_POST['product_list'];
   $sale_name = $_POST['sale_name'];
   

   $insert_project = "INSERT INTO `project_tb`
                       (`customer_id`,`po_no`,`start_date`,`expire_date`,`service_type_1`,`service_type_2`,`incident`,`pm`,`cus_name`,`cus_tel`,`cus_email`,`sale`,`product`)
                        VALUES
                       ('".$sel_customer."','".$po_no."','".$start_date."','".$expire_date."','".$service_type_1."','".$service_type_2."','".$num_incident."','".$num_pm."','".$cus_name."','".$cus_tel."','".$cus_email."','".$sale_name."','".$product_list."')";


                       
                       $query_insert_project = mysql_query($insert_project) or die("Could not insert project");

                    if(isset($query_insert_project))
                    {
                       echo 1;
                     }
                 
}

?>
