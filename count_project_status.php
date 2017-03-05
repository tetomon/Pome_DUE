<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php';

 $current_date = date('Y-M-d');

$sql_project = "SELECT project.* ,cus.customer_id customer_id,cus.customer_name customer_name ,cus.img_path img_path from customer_tb cus ,project_tb project WHERE cus.customer_id = project.customer_id and project.enable='Yes' ORDER BY project.customer_id DESC";
 $query_sql_project = mysql_query($sql_project);
 $num_project = mysql_num_rows($query_sql_project);

    
    $num_waiting=0;
    $num_expire=0;
    $num_nearly=0;
    $num_on_time=0;

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
                 $num_waiting = $num_waiting+1;
                }
                elseif(($current_date_cal >= $date_start_cal) && ($current_date_cal <= $date_expire_cal))
                {
                    if($cal_num_day < 30 ) 
                    {
                        $num_nearly = $num_nearly +1;
                        $num_on_time = $num_on_time + 1;
                    }
                    elseif(($cal_num_day >= 30) && ($cal_num_day <= 60))
                    {
                        $num_nearly = $num_nearly +1;
                        $num_on_time = $num_on_time + 1;
                    }
                    elseif($cal_num_day > 60) 
                    { 
                        $num_on_time = $num_on_time + 1;
                    }
                }
                elseif($current_date_cal > $date_expire_cal) 
                {
                    $num_expire = $num_expire+1;
                }
            }

    }


echo $num_waiting."-".$num_on_time."-".$num_nearly."-".$num_expire;
 
    
    



?>

                       
                 