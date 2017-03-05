<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php';

 $current_date = date('Y-M-d');
$sql_select_engineer = "SELECT * from engineer_tb where enable_user='yes' and eng_id != 0 ORDER BY team_id ";
 $query_sql_select_engineer = mysql_query($sql_select_engineer);
 $num_engineer = mysql_num_rows($query_sql_select_engineer);


   
     $i=0; 
while ($row_engineer = mysql_fetch_array($query_sql_select_engineer))
    {
$sql_report_engineer = "SELECT cus.* , eng.first_name firstname ,eng.last_name lastname,  report.report_id report_id , report.date_pm date_pm,report.date_sent date_sent , report.date_create date_create , report.comment comment ,report.file_name file_name,report.remark remark from customer_tb cus , engineer_tb eng , report_tb report WHERE cus.customer_id = report.customer_id and eng.eng_id = report.eng_id and report.eng_id=".$row_engineer["eng_id"]."";
 $query_sql_report_engineer = mysql_query($sql_report_engineer);
 $num_report_engineer = mysql_num_rows($query_sql_report_engineer);

    
    $num_waiting_eng=0;
    $num_other_eng=0;
    $num_late_eng=0;
    
    $num_on_process_eng=0;

if($num_report_engineer > 0){

while ($row_report_engineer = mysql_fetch_array($query_sql_report_engineer))
    {
    $date_pm_eng = $row_report_engineer['date_pm'];
     $date_sent_eng = $row_report_engineer['date_sent'];

     $date_pm_cal_eng=date_create("$date_pm_eng");
     $date_sent_cal_eng=date_create("$date_sent_eng");
     $current_date_cal_eng=date_create("$current_date");   

           if($row_report_engineer['remark']=='complete')
            {
              
            }
            else
            {
               if( $current_date_cal_eng < $date_pm_cal_eng)
                { 
                  $num_waiting_eng=$num_waiting_eng+1;
                }
                elseif(($current_date_cal_eng >= $date_pm_cal_eng) && ($current_date_cal_eng <= $date_sent_cal_eng))
                {
                   $num_on_process_eng=$num_on_process_eng+1;
                }
                elseif(($current_date_cal_eng >= $date_pm_cal_eng))
                {
                  $num_late_eng=$num_late_eng+1;
                }
                else
                {
                  $num_other_eng = $num_other_eng + 1;
                }
            }

    }
    //$myarray[] = array(name => $row_engineer['nick_name'], on_process => $num_on_process_eng, late => $num_late_eng);
    $myarray2[] = array($row_engineer['nick_name'], $num_on_process_eng, $num_late_eng);
}else
{
    //$myarray[] = array(name => $row_engineer['nick_name'], on_process => 0, late => 0);
    $myarray2[] = array($row_engineer['nick_name'],0, 0);
}

 
    
    //append the above created object into the main array.
    $i++;
   }



?>

                       
                 