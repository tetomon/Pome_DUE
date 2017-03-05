<? date_default_timezone_set("Asia/Bangkok");
include 'check_session.php';
include 'connect_db.php'; 
$sql_log= "SELECT log.* , credit.card_name card_name ,user.name name from log_tb log , user_tb user , credit_card_tb credit WHERE log.card_id  = credit.card_id and log.user_id = user.user_id ORDER BY log.date DESC";
 $query_sql_log= mysql_query($sql_log);
 $num_log = mysql_num_rows($query_sql_log);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
?>

<table class="table table-striped responsive-utilities jambo_table bulk_action" id="datatable">
                    <thead>
                      <tr class="headings">
                        <th class="column-title text-center">No.</th>
                        <th class="column-title text-center">Card</th>                
                        <th class="column-title text-center">Amount</th>
                        <th class="column-title text-center">Reason </th>
                        <th class="column-title text-center">Date</th>
                        <th class="column-title text-center">Type </th>
                        <th class="column-title text-center">Action </th>
                        </th>
                       
                      </tr>
                    </thead>
                    <?
                      
                       
                    ?>

                    <tbody>
                    <? $i=0; 
                      while ($row_log = mysql_fetch_array($query_sql_log)) 
                       { 
                        $i=$i+1;
                        $amount = $row_log['amount'];
                        $amount_tran = number_format($amount);

                          ?>
                      
                      <tr id="row_<? echo $row_log['log_id']; ?>" data-id="<? echo $row_log['log_id']; ?>">
                        <td class="text-center" style="vertical-align:middle"><? echo $i ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_log['card_name'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $amount_tran ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_log['remark'] ?></td>
                         <td class="text-center" style="vertical-align:middle"><? echo $row_log['date'] ?></td>
                         <?if($row_log['type']=='deposit') {?>
                         <td class="text-center" style="vertical-align:middle"><span class="label label-success">Deposit</span></td>
                          <?} else {?>
                          <td class="text-center" style="vertical-align:middle"><span class="label label-danger">Withdrawl</span></td>
                          <?}?>

                      <td  class="text-center"  style="vertical-align:middle">
                          <button  class="btn btn-primary btn-xs btn_change " data-title="<? echo $row_log['log_id']."|".$row_log['card_id']."|".$row_log['amount']."|".$row_log['remark']."|".$row_log['date']."|".$row_log['type'] ?>"><i class="fa fa-pencil"></i> Change </button>
                         
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo $row_log['log_id']."|".$row_log['card_name']."|".$row_log['amount']."|".$row_log['date']?>"><i class="fa fa-trash-o"></i> Delete </button>
                          
                        </td>
               

                      </tr>


                    <? } ?>
                      
                    </tbody>
                  </table>
