<? date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php'; 

$sql_card = "SELECT * FROM credit_card_tb";
 $query_sql_card = mysql_query($sql_card);
 $num_card = mysql_num_rows($query_sql_card);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   $sum_balance = 0;
   $sum_minimum_pay = 0;
   
?>


                    <?  
                      while ($row_card = mysql_fetch_array($query_sql_card)) 
                       {  
                           $sum_balance = $sum_balance + $row_card['balance']; 
                           $sum_minimum_pay = $sum_minimum_pay + $row_card['minimum_pay']; 
                       } 
                       echo $sum_balance.'-'.$sum_minimum_pay;
                     ?>
