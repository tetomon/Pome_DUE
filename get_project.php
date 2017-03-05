<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php';

 $current_date = date('Y-M-d');

$customer_id = $_POST['sel_customer_id'];

$sql_project = "SELECT project.* ,cus.customer_id customer_id,cus.customer_name customer_name ,cus.img_path img_path from customer_tb cus ,project_tb project WHERE cus.customer_id = project.customer_id and project.enable='Yes' and project.customer_id=".$customer_id." ORDER BY project.customer_id DESC";
 $query_sql_project = mysql_query($sql_project);
 $num_project = mysql_num_rows($query_sql_project);
 $number_row = 0;

 
while ($row_project = mysql_fetch_array($query_sql_project))
    {
    $date_start = $row_project['start_date'];
    $date_expire = $row_project['expire_date'];

    $date_start_cal=date_create("$date_start");
    $date_expire_cal=date_create("$date_expire");
    $current_date_cal=date_create("$current_date");
    $diff=date_diff($current_date_cal,$date_expire_cal);
    $cal_num_day = $diff->format("%a");   

           if($row_project['enable']!='Yes')
            {
              
            }
            else
            {
               if($current_date_cal < $date_start_cal)
                { 
                 
                }
                elseif(($current_date_cal >= $date_start_cal) && ($current_date_cal <= $date_expire_cal))
                {
                    $number_row =  $number_row +1;
                   echo "<option value=".$row_project['project_id'].">"."".$row_project['po_no']."</option>"; 
                     
                }
                elseif($current_date_cal > $date_expire_cal) 
                {   
                     $number_row =  $number_row +1;
                     echo "<option value=".$row_project['project_id'].">"."".$row_project['po_no'].""." ( Expired )"."</option>"; 
                    
                }
            }

    }

    

     if($number_row > 0)
     {
         echo $number_row;
     }
     else
     {
        echo 0 ; 
     }


?>

                       
                 