<? 
date_default_timezone_set("Asia/Bangkok");


   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
include 'check_session.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>POME Money Management</title>
  
    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">

    <link href="css/bootstrap-switch.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <script src="js/bootstrap-switch.js"></script>
        <script src="js/jquery.numeric.js"></script>

    <link rel="stylesheet" type="text/css" href="css/jquery-confirm.css" />
        <script type="text/javascript" src="js/jquery-confirm.js"></script>
    <style>
  .daterangepicker{z-index:1151 !important;}
</style>

   <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

<? 
include 'connect_db.php';

$sql_card = "SELECT * FROM credit_card_tb";
 $query_sql_card = mysql_query($sql_card);
 $num_card = mysql_num_rows($query_sql_card);

 $sql_card_2 = "SELECT * FROM credit_card_tb";
 $query_sql_card_2 = mysql_query($sql_card_2);
 $num_card_2 = mysql_num_rows($query_sql_card_2);

   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   $sum_balance = 0;
   $sum_minimum_pay = 0;
   
 
                      while ($row_card = mysql_fetch_array($query_sql_card)) 
                       {  
                           $sum_balance = $sum_balance + $row_card['balance']; 
                           $sum_minimum_pay = $sum_minimum_pay + $row_card['minimum_pay']; 
                       } 




$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

?>



 <script type="text/javascript">
          $(document).ready(function() {




      

      $(document).ajaxStart(function(){
        $("#LoadingImage").css({"display": "block","margin": "auto"});
    });
    $(document).ajaxComplete(function(){
        $("#LoadingImage").css("display", "none");
    });
        $( "#credit_list" ).load("credit_list_info.php", function(responseTxt, statusTxt, xhr) {



         });
             $( "#result" ).load("transaction_table.php", function(responseTxt, statusTxt, xhr) {
          
                      
                     
                     $('#datatable').dataTable({
                        pageLength: 10,
                        bInfo: false,
                        
                      });
   
  

                
                
                });
                  $("#submit_create").click(function(e) { 
                  e.preventDefault();
                  if($('#sel_credit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please select Credit Card!',
                          content: ''
                            });
                     return false;
                     
                  }
                   if($('#amount_create').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter Amount!',
                          content: ''
                            });
                     return false;
                     
                  }
                   if($('#reason_create').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter Reason!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#date_pay').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter date!',
                          content: ''
                            });
                     return false;
                     
                  }if($('#type_create').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please select Type!',
                          content: ''
                            });
                     return false;
                     
                  }else 
                  {
                      var user_id = <? echo $user_id ?>;
                      var amount = $('#amount_create').val();
                      var reason= $('#reason_create').val();
                      var date_pay = $('#date_pay').val();
                      var type_create = $('#type_create').val();
                      var card_id = $('#sel_credit').val();
                      var card_name = $("#sel_credit option:selected").text();
                     
                         $.confirm({
                                    title: 'Create Transaction Confirm?',
                                    content: '<b>Credit Card </b>: <font color=blue>'+ card_name+'</font><br/> <b>Amount </b>: <font color=blue>'+ amount+'</font><br/> <b>Reason </b> : <font color=blue>'+ reason+'</font><br/> <b>Type </b>: <font color=blue>'+ type_create+'</font><br/> <b>Date</b>: <font color=blue>'+ date_pay+'</font>',
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'user_id='+user_id+'&card_id='+card_id+'&amount='+amount+'&reason='+reason+'&type_create='+type_create+'&date_pay='+date_pay;

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "create_transaction.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if (response==1) { alert ('Add log transaction complete!'); location.reload();}
                                         
                                            

                                        }

                                        });
                                      
                                    }
                                });
                  }

                   
                       
                });

           
          
         var sum_balance = <?echo $sum_balance?>;
         var sum_minimum_pay = <?echo $sum_minimum_pay?>;


 document.getElementById('sum_balance').innerHTML = '<h3><i class="fa fa-check blue"></i>Summary Balance:  <font color="#5DADE2">'+sum_balance.toLocaleString()+'</font></h3><br/><h3><i class="fa fa-table red"></i> Minimum pay/month:  <font color="#C0392B">'+sum_minimum_pay.toLocaleString()+'</font></h3>'; 
          
                 $("#create").click(function(e) { 
                  e.preventDefault();
                   
                      $('#date_pay').daterangepicker({

                          singleDatePicker: true,
                          calender_style: "picker_2",
                          format: 'YYYY-MMM-DD',
                          maxDate: new Date,                       
                        });
                      $("#amount_create").numeric({negative : false});
                      $("#create-modal").modal('show');
                       
                });
             
           
          });

  

          
             
        </script>
 
        <script type="text/javascript">
          $(function () {
 
            });



        </script>




    <!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body class="nav-md">

    <div class="container body">


      <div class="main_container">

        <? include "sidebar.php" ?>

        <!-- top navigation -->
        <? include "header.php" ?>
        <!-- /top navigation -->

        <!-- page content -->
       <div class="right_col" role="main" style=" min-height:1000px; height: auto;">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
               <input type="hidden" id="sum" name="sum" value="">
                    Summary infomation
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>


          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
             <div class="x_panel">
              <div class="x_title">
                <h2>Credit card list<small></small></h2>
             
                <div class="clearfix"></div>
              </div>
               <div class="x_content" id="credit_list">


                </div>
            </div>
            </div>

          
            

            <div class="col-md-6 col-sm-12 col-xs-12">
             <div class="x_panel">
              <div class="x_title">
                <h2>Summary<small></small></h2>
             
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="bs-example" data-example-id="simple-jumbotron">
                  <div class="jumbotron" id='sum_balance'>
                    
                    
                  </div>
                </div>

              </div>
            </div>
            </div>
          </div>

         
              
            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12" id="balance_history">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Transaction</h2>
                  <div class="clearfix"></div>
                </div>
                 
                        <button id="create" type="button" class="btn btn-success">Create</button>
                        
                      
                
                  <div id="result" class="x_content">
        
                  <br>
                Please wait...<img src="images/loading.gif" id="LoadingImage" style="display:none;"  />

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer >
          <div class="pull-right">
          
            POME Money Management
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
      <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="create-form" method="POST" action="index.php" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Create Transaction</h4>
            </div>
            <div class="modal-body">
                 <input type="hidden" id="user_id_create" name="user_id_create" value="" class="hidden">
                  <div class="form-group" >
                      <label class="col-sm-2 control-label" >Credit Card<font color="red">*</font>
                      </label>
                      <div class="col-sm-10">
                       <select id="sel_credit" name="sel_credit" class="form-control" >
                          <option value="">Select Credit Card</option>
                           <? 
                        while ($row_credit = mysql_fetch_array($query_sql_card_2))
                        { ?>
                          <option value="<? echo $row_credit['card_id']; ?>"><?echo $row_credit['card_name'];?></option>
                          <? } ?>                     
                        </select>
                        
                      </div>
                    </div>
               
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Amount<font color="red">*</font></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="amount_create" name="amount_create" placeholder="Amount" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Reason<font color="red">*</font></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="reason_create" name="reason_create" placeholder="Reason" required>
                </div>
              </div>
               <div class="form-group">
                      <label class="col-sm-2 control-label" >Date<font color="red">*</font>
                      </label>
                      <div class="col-sm-10">
                          <input type="text" readonly="readonly" class="daterangepicker form-control" id="date_pay" placeholder="Select Date " >
                      </div>
                    </div>
               <div class="form-group" id="div_pm_edit">
                      <label class="col-sm-2 control-label" >Type<font color="red">*</font>
                      </label>
                      <div class="col-sm-10">
                        <select id="type_create" name="type_create" class="form-control" >
                          <option value="">Select Type</option>
                          <option value="withdrawl">Withdrawl(ถอน)</option>
                          <option value="deposit">Deposit(ฝาก/จ่าย)</option>              
                        </select>
                        
                      </div>
                    </div>
              
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submit_create" >Save</button>
            </div>
            </form>
        </div>
      </div>
    </div>



    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/moment/moment.min.js"></script>
  <script src="js/chartjs/chart.min.js"></script>
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/pace/pace.min.js"></script>

   <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

    <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>

    
  </body>


    
</html>