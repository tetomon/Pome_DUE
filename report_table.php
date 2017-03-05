<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php'; 
include 'check_session.php';
if($_SESSION['role']!='Admin')

{
    echo "<script>alert('You not authorized view this link!'); </script>";
    print "<meta http-equiv='refresh' content='1;URL=index.php'>";
    exit();
}
$sql_report = "SELECT cus.* ,project.po_no po_no, eng.first_name firstname ,eng.last_name lastname,  report.report_id report_id , report.date_pm date_pm,report.date_sent date_sent , report.date_create date_create , report.comment comment ,report.file_name file_name,report.remark remark from customer_tb cus , engineer_tb eng , report_tb report , project_tb project WHERE cus.customer_id = report.customer_id and eng.eng_id = report.eng_id and report.project_id = project.project_id ORDER BY report.date_pm DESC";
 $query_sql_report = mysql_query($sql_report);
 $num_report = mysql_num_rows($query_sql_report);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
?>

<table class="table table-striped responsive-utilities jambo_table bulk_action" id="datatable">
                    <thead>
                      <tr class="headings">
                        <th class="column-title text-center">No. </th>
                        <th class="column-title text-center">Customer</th>
                        <th class="column-title text-center">PO/TOR</th>                
                        <th class="column-title text-center">Engineer </th>
                        <th class="column-title text-center">Date PM </th>
                        <th class="column-title text-center">Date Sent</th>
                        <th class="column-title text-center">Status </th>
                        <th class="column-title text-center">Comment</th>
                        <th class="column-title text-center">Report </th> 
                        <th class="column-title text-center">Action </th>

                        </th>
                       
                      </tr>
                    </thead>
                    <?
                      
                       
                    ?>

                    <tbody>
                    <? $i=0; 
                      while ($row_report = mysql_fetch_array($query_sql_report)) 
                       { $i=$i+1; ?>
                      <tr id="row_<? echo $row_report['report_id']; ?>" data-id="<? echo $row_report['report_id']; ?>">
                        <td class="text-center" style="vertical-align:middle"><? echo $i ?></td>
                        <? if($row_report['img_path']!='') {?>
                        <td class="text-center" style="vertical-align:middle"><img src="img_customer\<?echo $row_report['img_path']?>"  height=50 width=50></img><br/><? echo $row_report['customer_name'] ?></td>
                        <? } else { ?>
                          <td class="text-center" style="vertical-align:middle"><img src="img_customer\no_image.jpg"  height=50 width=50></img><br/><? echo $row_report['customer_name'] ?></td>
                        <? }  ?>  
                        <td class="text-center" style="vertical-align:middle"><? echo $row_report['po_no'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_report['firstname']." ".$row_report['lastname'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_report['date_pm'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_report['date_sent'] ?></td>
                        

                     <? 
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

                      $diff=date_diff($current_date_cal,$date_sent_cal);
                      $cal_num_day = $diff->format("%a");
                      //  status ------------------------------
                     if($row_report['remark']=='complete'){ $check_not_wait_pm = 1; $num_complete= $num_complete+1; ?>
                      <td class="text-center" style="vertical-align:middle"><span class="label label-primary">Complete</span></td>
                     <? } else {  
                     if( $current_date_cal < $date_pm_cal){ $num_waiting=$num_waiting+1; ?>
                      <td class="text-center" style="vertical-align:middle"><span class="label label-warning">Waiting PM</span></td>
                        <? } elseif(($current_date_cal >= $date_pm_cal) && ($current_date_cal <= $date_sent_cal)) { $check_not_wait_pm = 1; $num_on_process=$num_on_process+1; ?>
                          <td class="text-center" style="vertical-align:middle"><span class="label label-success">On Process<?echo " [".$cal_num_day."]";?></span></td>
                       <? } elseif(($current_date_cal >= $date_pm_cal)) { $check_not_wait_pm = 1; $num_late=$num_late+1; ?>
                          <td class="text-center" style="vertical-align:middle"><span class="label label-danger">Late</span></td>
                        <? }else { ?>
                          <td class="text-center" style="vertical-align:middle"><span class="label label-default">Other</span></td>
                        <? } ?>

                    <? } ?>
                    <!--   end status       -->
                        <td class="text-center" style="vertical-align:middle"><? echo $row_report['comment'] ?></td>
                    <!--   file download   -->
                   <? if($row_report['file_name']!=''){ ?>
                    <td class="text-center" style="vertical-align:middle"> 
                         
                          <button  class="btn btn-info btn-xs btn_download" data-title="<? echo $row_report['file_name'] ?>"><i class="fa fa-download"></i> Download  </button>
                        </td>
                    <? } else {  ?>
                        <td class="text-center" style="vertical-align:middle"> - </td>
                      <? } ?>
                    <!--  end  file download   -->
                    <!--   Action   -->
                       <td   style="vertical-align:middle">
                          <button  class="btn btn-primary btn-xs btn_change " data-title="<? echo $row_report['report_id']."|".$row_report['customer_name']."|".$row_report['date_pm']."|".$row_report['file_name']."|".$row_report['remark']."|".$row_report['comment']."|".$check_not_wait_pm."|".$row_report['po_no'] ?>"><i class="fa fa-pencil"></i> Change </button>
                         <? if($row_report['remark']!='complete'){ ?>
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo $row_report['report_id']."|".$row_report['customer_name']."|".$row_report['date_pm'] ?>"><i class="fa fa-trash-o"></i> Delete </button>
                          <? } ?>
                        </td>
                     <!-- End  Action   -->

                      </tr>


                    <? } ?>
                      
                    </tbody>
                  </table>
