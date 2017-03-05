<?
date_default_timezone_set("Asia/Bangkok");
include 'connect_db.php'; 
$sql_credit = "SELECT * from credit_card_tb" ;
$query_sql_credit= mysql_query($sql_credit) or die('Can not query credit');

$sql_credit_2 = "SELECT * from credit_card_tb" ;
$query_sql_credit_2= mysql_query($sql_credit_2) or die('Can not query credit2');


 ?>
                  <div class="col-xs-3">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left">
                    <?while ($row_credit = mysql_fetch_array($query_sql_credit))
                    {   ?>
                      <li><a href="#<?echo $row_credit['card_id']?>" data-toggle="tab"><?echo $row_credit['card_name']?></a>
                      </li>
                     
                      <? } ?>
                    </ul>
                  </div>

                  <div class="col-xs-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                     <?while ($row_credit_2 = mysql_fetch_array($query_sql_credit_2))
                    {  


                     ?>
                      <div class="tab-pane " id="<?echo $row_credit_2['card_id']?>">
                       
                           <div class="flex">
                            <ul class="list-inline">
                              <li>
                                <a>

                                </a>
                              </li>
                              <li>
                                <img src="images/card.jpg" alt="..." class="img-circle profile_img">
                              </li>
                              <li>
                                <a>
                                  
                                </a>
                              </li>
                            </ul>
                          </div>
                          <br/>
                           <h3 class="name"><font color='#2471A3' ><? echo $row_credit_2['card_name'] ?></font></h3>

                          <div class="flex">
                            <ul class="list-inline count2">
                              <li>
                                <h3><font color='#F1C40F'><? echo  number_format($row_credit_2['credit_line']);?></font></h3>
                                <span>Credit line</span>
                              </li>
                              <li>
                                <h3><font color='#58D68D'><? echo  number_format($row_credit_2['balance']);?></font></h3>
                                <span>Balance</span>
                              </li>
                              <li>
                                <h3><font color='#E74C3C'><? echo  number_format($row_credit_2['minimum_pay']);?></font></h3>
                                <span>Minimum Pay</span>
                              </li>
                            </ul>
                          </div>

                      </div>
                      <? } ?>
                      
                    </div>
                  </div>

                  <div class="clearfix"></div>