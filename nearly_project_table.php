<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php'; 
include 'check_session.php';
if($_SESSION['role']!='Admin')

{
    echo "<script>alert('You not authorized view this link!'); </script>";
    print "<meta http-equiv='refresh' content='1;URL=index.php'>";
    exit();
}
$sql_project = "SELECT project.* ,cus.customer_id customer_id,cus.customer_name customer_name ,cus.img_path img_path from customer_tb cus ,project_tb project WHERE cus.customer_id = project.customer_id ORDER BY project.customer_id DESC";
 $query_sql_project = mysql_query($sql_project);
 $num_project = mysql_num_rows($query_sql_project);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
?>

<table class="table table-striped responsive-utilities jambo_table bulk_action" id="datatable">
                    <thead>
                      <tr class="headings">
                        <th class="column-title text-center">No. </th>
                        <th class="column-title text-center">Customer</th>                
                        <th class="column-title text-center">PO No./TOR </th>
                        <th class="column-title text-center">Start </th>
                        <th class="column-title text-center">Expired</th>
                        <th class="column-title text-center">Date</th>
                        <th class="column-title text-center">Service Type</th>
                         <th class="column-title text-center">Product</th>
                        <th class="column-title text-center">Action </th>

                        
                       
                      </tr>
                    </thead>
                    <?
                      
                       
                    ?>

                    <tbody>
                    <? $i=0; 
                      while ($row_project = mysql_fetch_array($query_sql_project)) 
                       { ?>
                      

                     <? 
                      $date_start = $row_project['start_date'];
                      $date_expire = $row_project['expire_date'];
                      $num_date_expire=0;
                      $date_start_cal=date_create("$date_start");
                      $date_expire_cal=date_create("$date_expire");
                      $current_date_cal=date_create("$current_date");

                      $diff=date_diff($current_date_cal,$date_expire_cal);
                      $cal_num_day = $diff->format("%a");
                      //  status ------------------------------
                     if($row_project['enable']!='Yes'){ ?>
                    
                     <? } else 
                      {  
                     if( $current_date_cal < $date_start_cal) { ?>
                      
                        <? } elseif(($current_date_cal >= $date_start_cal) && ($current_date_cal <= $date_expire_cal)) { $i=$i+1;  ?>
                            
                        
                           <?    if($cal_num_day < 30 ) {  ?>
                        <tr id="row_<? echo $row_project['project_id']; ?>" data-id="<? echo $row_project['project_id']; ?>">
                        <td class="text-center" style="vertical-align:middle"><? echo $i ?></td>
                        <? if($row_project['img_path']!='') {?>
                        <td class="text-center" style="vertical-align:middle"><img src="img_customer\<?echo $row_project['img_path']?>"  height=50 width=50></img><br/><? echo $row_project['customer_name'] ?></td>
                        <? } else { ?>
                          <td class="text-center" style="vertical-align:middle"><img src="img_customer\no_image.jpg"  height=50 width=50></img><br/><? echo $row_project['customer_name'] ?></td>
                        <? }  ?>  
                        <td class="text-center" style="vertical-align:middle"><? echo $row_project['po_no'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_project['start_date'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_project['expire_date'] ?></td>
                          <td class="text-center" style="vertical-align:middle"><span class="label label-warning"><? echo $cal_num_day.' days';?></span></td>
                           <td class="text-center" style="vertical-align:middle"><b><font color="blue"><? echo $row_project['service_type_1'].'</font><br/>'.$row_project['service_type_2'].'</b>' ?></td>
                         <td class="text-center" style="vertical-align:middle"><? echo $row_project['product'] ?></td>
                           <td   style="vertical-align:middle">

                          <button  class="btn btn-info btn-xs btn_info " data-title="<? echo $row_project['project_id']."|".$row_project['customer_id']."|".$row_project['customer_name']."|".$row_project['po_no']."|".$row_project['start_date']."|".$row_project['expire_date']."|".$row_project['service_type_1']."|".$row_project['service_type_2']."|".$row_project['incident']."|".$row_project['pm']."|".$row_project['product']."|".$row_project['cus_name']."|".$row_project['cus_tel']."|".$row_project['cus_email']."|".$row_project['sale']."|".$row_project['enable']."|".$check_not_wait_pm ?>"><i class="fa fa-search"></i> Detail </button>

                         
                        </td>
                          <? } elseif(($cal_num_day >= 30) && ($cal_num_day <= 60)) { ?>
                          
                          <? } elseif($cal_num_day > 60) {   ?>
                         
                          <? } ?>
                       

                    <? } elseif($current_date_cal > $date_expire_cal) { ?>
                      
                    <? } ?>
                    <? } ?>


                      </tr>


                    <? } ?>
                      
                    </tbody>
                  </table>
