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
   $enable = $_POST['enable'];
   $edit_id = $_POST['edit_id'];
   


                        $update_project = "UPDATE project_tb SET ";
                        $update_project .="customer_id = '".$sel_customer."' ";
                        $update_project .=",po_no = '".$po_no."' ";
                        $update_project .=",start_date = '".$start_date."' ";
                        $update_project .=",expire_date = '".$expire_date."' ";
                        $update_project .=",service_type_1 = '".$service_type_1."' ";
                        $update_project .=",service_type_2 = '".$service_type_2."' ";
                        $update_project .=",incident= '".$num_incident."' ";
                        $update_project .=",pm = '".$num_pm."' ";
                        $update_project .=",cus_name = '".$cus_name."' ";
                        $update_project .=",cus_tel = '".$cus_tel."' ";
                        $update_project .=",cus_email = '".$cus_email."' ";
                        $update_project .=",sale = '".$sale_name."' ";
                        $update_project .=",product = '".$product_list."' ";
                        $update_project .=",enable = '".$enable."' ";
                        $update_project .="WHERE project_id = '".$edit_id."'";
                       
                       $query_update_project = mysql_query($update_project ) or die("Could not update project");

                    if(isset($query_update_project))
                    {
                       echo 1;
                     }
                 
}

?>
