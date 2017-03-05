<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php'; 

$sql_card = "SELECT * FROM credit_card_tb";
 $query_sql_card = mysql_query($sql_card);
 $num_card = mysql_num_rows($query_sql_card);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
?>

<table class="table table-striped responsive-utilities jambo_table bulk_action" id="datatable">
                    <thead>
                      <tr class="headings">
                        <th class="column-title text-center">No. </th>
                        <th class="column-title text-center">Card Name</th>               
                        <th class="column-title text-center">Credit line</th>
                        <th class="column-title text-center">Balance</th>
                        <th class="column-title text-center">Minimum Pay</th>
                        <th class="column-title text-center">Interest/Month</th>
                        <th class="column-title text-center">Action </th>

                        </th>
                       
                      </tr>
                    </thead>
                    <?
                      
                       
                    ?>

                    <tbody>
                    <? $i=0; 
                      while ($row_card = mysql_fetch_array($query_sql_card)) 
                       { $i=$i+1; ?>
                      <tr id="row_<? echo $row_card['card_id']; ?>" data-id="<? echo $row_card['card_id']; ?>">
                        <td class="text-center" style="vertical-align:middle"><? echo $i ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_card['card_name'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_card['credit_line'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_card['balance'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_card['minimum_pay'] ?></td>
                        <td class="text-center" style="vertical-align:middle"><? echo $row_card['interest_per_month'] ?></td>
                        <td   style="vertical-align:middle">
                          <button  class="btn btn-primary btn-xs btn_change " data-title="<? echo $row_card['card_id']."|".$row_card['card_name']."|".$row_card['card_num']."|".$row_card['credit_line']."|".$row_card['balance']."|".$row_card['minimum_pay']."|".$row_card['interest_per_month']; ?>"><i class="fa fa-pencil"></i> Change </button>
                         
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo  $row_card['card_id']."|".$row_card['card_name']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
                       
                        </td>

                      </tr>


                    <? } ?>
                      
                    </tbody>
                  </table>
