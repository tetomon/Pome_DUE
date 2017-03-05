<? 
date_default_timezone_set("Asia/Bangkok");


   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
include 'check_session.php';
if($_SESSION['role']!='Admin')

{
    echo "<script>alert('You not authorized view this link!'); </script>";
    print "<meta http-equiv='refresh' content='1;URL=index.php'>";
    exit();
}

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

     $(document).ajaxStart(function(){
        $("#LoadingImage_2").css({"display": "block","margin": "auto"});
    });
    $(document).ajaxComplete(function(){
        $("#LoadingImage_2").css("display", "none");
    });

             $('#date_pay').daterangepicker({

                          singleDatePicker: true,
                          calender_style: "picker_2",
                          format: 'YYYY-MMM-DD',
                          maxDate: new Date,                       
                        });



            $('#date_pm').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MMM-DD',
               
                 
              
              });

             $( "#result" ).load("transaction_admin_table.php", function(responseTxt, statusTxt, xhr) {
          
                      
                     
                     $('#datatable').dataTable({
                        pageLength: 10,
                        bInfo: false,
                        
                      });
                      $('#datatable tbody').on('click', '.btn_delete', function (e) {
        
                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');
               
                          $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Delete transaction log <br/> Credit : '+ info[1]+'<br/>Amount : '+ info[2]+'<br/>Date : '+ info[3],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'log_id='+info[0];

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_log.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          
                                          $('#row_'+id).fadeOut();



                                        }

                                        });
                                    }
                                });
    });
      $('#datatable tbody').on('click', '.btn_change', function (e) {
      
             e.preventDefault();

              $('#date_pay_edit').daterangepicker({

                          singleDatePicker: true,
                          calender_style: "picker_2",
                          format: 'YYYY-MMM-DD',
                          maxDate: new Date,                       
                        });
                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');
                var card_id_edit = info[1];
                var type_edit = info[5];

      
                
                $("#edit-modal").modal('show');
                $("#log_id_edit").val(info[0]) ;
                 $("#sel_credit_edit").val(info[1]) ;
                $("#amount_edit").val(info[2]) ;
                $("#reason_edit").val(info[3]) ;
                $("#date_pay_edit").val(info[4]) ;
                $("#type_edit").val(info[5]) ;


        });
    

   
                
                
                
                });

            


             $("#btn_create").click(function(e) { 
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


            $("#save_change").click(function(e) { 
                  e.preventDefault();
                  if($('#sel_credit_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please select Credit Card!',
                          content: ''
                            });
                     return false;
                     
                  }
                   if($('#amount_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter Amount!',
                          content: ''
                            });
                     return false;
                     
                  }
                   if($('#reason_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter Reason!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#date_pay_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter date!',
                          content: ''
                            });
                     return false;
                     
                  }if($('#type_edit').val() == '')
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
                      var log_id_edit = $('#log_id_edit').val();
                      var amount_edit = $('#amount_edit').val();
                      var reason_edit= $('#reason_edit').val();
                      var date_pay_edit = $('#date_pay_edit').val();
                      var type_edit = $('#type_edit').val();
                      var card_id_edit = $('#sel_credit_edit').val();
                      var card_name_edit = $("#sel_credit_edit option:selected").text();
                     
                         $.confirm({
                                    title: 'Change Transaction Confirm?',
                                    content: '<b>Credit Card </b>: <font color=blue>'+ card_name_edit+'</font><br/> <b>Amount </b>: <font color=blue>'+ amount_edit+'</font><br/> <b>Reason </b> : <font color=blue>'+ reason_edit+'</font><br/> <b>Type </b>: <font color=blue>'+ type_edit+'</font><br/> <b>Date</b>: <font color=blue>'+ date_pay_edit+'</font>',
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'user_id='+user_id+'&card_id='+card_id_edit+'&amount='+amount_edit+'&reason='+reason_edit+'&type_edit='+type_edit+'&date_pay='+date_pay_edit+'&log_id='+log_id_edit;

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "change_transaction.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {

                                          if (response==1) { location.reload();}
                                         
                                            

                                        }

                                        });
                                      
                                    }
                                });
                  }

                   
                       
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
                    Log Management
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>


          <div class="row">

<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Create Log</h2>

                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="form_balance"  class="form-horizontal form-label-left" method="POST">
                    
                    <input type="hidden" id="user_id_create" name="user_id_create" value="" class="hidden">
                  <div class="form-group" id="div_pm_edit">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Credit Card<font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <select id="sel_credit" name="sel_credit" class="form-control" >
                          <option value="">Select Credit Card</option>
                           <? 
                        while ($row_credit = mysql_fetch_array($query_sql_card))
                        { ?>
                          <option value="<? echo $row_credit['card_id']; ?>"><?echo $row_credit['card_name'];?></option>
                          <? } ?>                     
                        </select>
                        
                      </div>
                    </div>
               
              <div class="form-group">
                <label for="mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Amount<font color="red">*</font></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" id="amount_create" name="amount_create" placeholder="Amount" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="control-label col-md-3 col-sm-3 col-xs-12">Reason<font color="red">*</font></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" id="reason_create" name="reason_create" placeholder="Reason" required>
                </div>
              </div>
               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date<font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" readonly="readonly" class="daterangepicker form-control" id="date_pay" placeholder="Select Date " >
                      </div>
                    </div>
               <div class="form-group" id="div_pm_edit">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Type<font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="type_create" name="type_create" class="form-control" >
                          <option value="">Select Type</option>
                          <option value="withdrawl">Withdrawl(ถอน)</option>
                          <option value="deposit">Deposit(ฝาก/จ่าย)</option>              
                        </select>
                        
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         <button type="button"  data-target=".bs-example-modal-sm" class="btn btn-primary btn_create" id="btn_create">Create</button >
                        <img src="images/loading.gif" id="LoadingImage" style="display:none" height="42" width="42" />

                        <a href="report_mgmt.php" class="btn btn-success">Cancel</a>
                      </div>
                     </div>
                    </form>
                </div>
              </div>
            </div>
          
            

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Report Status<small></small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <canvas id="pieChart"></canvas>
                </div>
              </div>
            </div>
          </div>

         
              
            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12" id="balance_history">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Transaction <small>( All log )</small></h2>
                  <div class="clearfix"></div>
                </div>

                
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

     <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-form" method="POST"  enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Change status report</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="log_id_edit" name="log_id_edit" value="" class="hidden">
                  <div class="form-group" id="div_pm_edit">
                      <label class="col-sm-2 control-label" >Credit Card<font color="red">*</font>
                      </label>
                      <div class="col-sm-10">
                       <select id="sel_credit_edit" name="sel_credit_edit" class="form-control" >
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
                    <input type="text" class="form-control" id="amount_edit" name="amount_edit" placeholder="Amount" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Reason<font color="red">*</font></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="reason_edit" name="reason_edit" placeholder="Reason" required>
                </div>
              </div>
               <div class="form-group">
                      <label class="col-sm-2 control-label" >Date<font color="red">*</font>
                      </label>
                      <div class="col-sm-10">
                          <input type="text" readonly="readonly" class="daterangepicker form-control" id="date_pay_edit" placeholder="Select Date " >
                      </div>
                    </div>
               <div class="form-group" id="div_pm_edit">
                      <label class="col-sm-2 control-label" >Type<font color="red">*</font>
                      </label>
                      <div class="col-sm-10">
                        <select id="type_edit" name="type_edit" class="form-control" >
                          <option value="">Select Type</option>
                          <option value="withdrawl">Withdrawl(ถอน)</option>
                          <option value="deposit">Deposit(ฝาก/จ่าย)</option>              
                        </select>
                        
                      </div>
                </div>
            </div>

              
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="save_change">Save changes</button>
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

  <script>


    
  </script>
    
</html>