<? date_default_timezone_set("Asia/Bangkok");
include 'check_session.php';
include 'connect_db.php'; 
$sql_report = "SELECT cus.* , eng.nick_name nick_name ,eng.last_name lastname,  report.report_id report_id , report.date_pm date_pm,report.date_sent date_sent , report.date_create date_create , report.comment comment ,report.file_name file_name,report.remark remark from customer_tb cus , engineer_tb eng , report_tb report WHERE cus.customer_id = report.customer_id and eng.eng_id = report.eng_id ORDER BY report.date_pm DESC";
 $query_sql_report = mysql_query($sql_report);
 $num_report = mysql_num_rows($query_sql_report);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
?>

<table class="table table-striped responsive-utilities jambo_table bulk_action" id="datatable">
                    <thead>
                      <tr class="headings">
                        
                        <th class="column-title text-center">Customer</th>                
                        <th class="column-title text-center">Engineer </th>
                        <th class="column-title text-center">Date Sent</th>
                        

                        </th>
                       
                      </tr>
                    </thead>
                    <?
                      
                       
                    ?>

                    <tbody>
                    <? $i=0; 
                      while ($row_report = mysql_fetch_array($query_sql_report)) 
                       { 
                        $date_pm = $row_report['date_pm'];
                      $date_sent = $row_report['date_sent'];
                      $date_scan_cal=date_create("$date_scan");
                      $check_not_wait_pm = 0;
                      $num_waiting=0;
                      $num_late=0;
                      $num_complete=0;
                      $num_on_process=0;
                      $date_pm_cal=date_create("$date_pm");
                      $date_sent_cal=date_create("$date_sent");
                      $current_date_cal=date_create("$current_date");
                      $diff_PM_Sent=date_diff($date_pm_cal,$date_sent_cal);
                      $cal_PM_Sent = $diff_PM_Sent->format("%a");
                       $diff_current_Sent=date_diff($current_date_cal,$date_sent_cal);
                      $cal_current_Sent = $diff_current_Sent->format("%a");

                          ?>
                      <? if(($current_date_cal >= $date_pm_cal) && ($current_date_cal <= $date_sent_cal) && ($row_report['remark']!='complete') && ($cal_current_Sent <= 3)) { $i=$i+1; ?>
                      <tr id="row_<? echo $row_report['report_id']; ?>" data-id="<? echo $row_report['report_id']; ?>">
                        <? if($row_report['img_path']!='') {?>
                        <td class="text-center" style="vertical-align:middle"><img src="img_customer\<?echo $row_report['img_path']?>"  height=50 width=50></img><br/><? echo $row_report['customer_name'] ?></td>
                        <? } else { ?>
                          <td class="text-center" style="vertical-align:middle"><img src="img_customer\no_image.jpg"  height=50 width=50></img><br/><? echo $row_report['customer_name'] ?></td>
                        <? }  ?>  
                        <td class="text-center" style="vertical-align:middle"><font color='blue'><? echo $row_report['nick_name'] ?></font></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_report['date_sent'] ?></td>

                     <?  } ?>
               

                      </tr>


                    <? } ?>
                      
                    </tbody>
                  </table>
