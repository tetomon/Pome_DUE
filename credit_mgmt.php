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



 if(isset($_POST['edit_id']) && $_POST['edit_id']!='')
    {                   
                        $update_credit = "UPDATE credit_card_tb SET ";
                        $update_credit  .="card_name = '".$_POST['card_name_edit']."' ";
                        $update_credit  .=",credit_line = '".$_POST['credit_line_edit']."' ";
                        $update_credit  .=",balance = '".$_POST['balance_edit']."' ";
                        $update_credit  .=",minimum_pay = '".$_POST['minimum_pay_edit']."' ";
                        $update_credit  .=",interest_per_month = '".$_POST['interest_edit']."' ";
                        $update_credit  .="WHERE card_id = ".$_POST['edit_id']."";
                       
                        
                        $query_update_credit = mysql_query($update_credit) or die("Could not update credit");
                            if(isset($query_update_credit))
                            {
                          
                               echo "<script>alert('Change credit infomation Complete'); </script>"; 
                            }else
                            {
                              echo "<script>alert('Change credit infomation Failed!'); </script>"; 
                            }

      print "<meta http-equiv='refresh' content='0;URL=credit_mgmt.php'>";  
    }


$role = $_SESSION['role'];
?>



 <script type="text/javascript">
          $(document).ready(function() {

            $("#card_num").numeric({negative : false});
            $("#credit_line").numeric({negative : false});
            $("#balance").numeric({negative : false});
            $("#minimum_pay").numeric({negative : false});
            $("#interest").numeric({negative : false});
                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "sum.php", //Where to make Ajax calls
                                       dataType:"text",
                                       
                                        success:function(response)
                                        {
                                          
                                         $("#sum").val(response);

                                         

                                        }

                                        });


      

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





             $( "#result" ).load("credit_table.php", function(responseTxt, statusTxt, xhr) {
          
                      
                     
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
                                    content: 'Delete Credit Card Name : '+ info[1],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'card_id='+info[0];

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_credit.php", //Where to make Ajax calls
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
                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');

            $("#credit_line_edit").numeric({negative : false});
            $("#balance_edit").numeric({negative : false});
            $("#minimum_pay_edit").numeric({negative : false});
            $("#interest_edit").numeric({negative : false});


                $("#edit-modal").modal('show');
                $("#edit-id").val(info[0]);
                $("#card_name_edit").val(info[1]);
                $("#credit_line_edit").val(info[3]);
                $("#balance_edit").val(info[4]);
                $("#minimum_pay_edit").val(info[5]);
                $("#interest_edit").val(info[6]);
        });

                
                
    });

            


             $('#btn_create').click(function(e)
                {
                 
                  e.preventDefault();
                 if($('#card_name').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter card name!',
                          content: ''
                            });
                     return false;
                     
                  }
                  else
                  {
                    var card_name = $('#card_name').val();
                    var card_num = $('#card_num').val();
                    var credit_line = $('#credit_line').val();
                    var balance = $('#balance').val();
                    var minimum_pay = $('#minimum_pay').val();
                    var interest = $('#interest').val();
                    var add_data = 'card_name='+card_name+'&card_num='+card_num+'&credit_line='+credit_line+'&balance='+balance+'&minimum_pay='+minimum_pay+'&interest='+interest;

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "create_credit.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {

                                          if(response==1)
                                          {
                                           
                                            $.confirm({
                                            title: '',
                                            content: 'Create credit card complete',
                                            cancelButton: false ,
                                                    confirm: function () 
                                            {
                                              location.reload();
                                            }
                                           
                                           });
                                          
                                       
                                          
                                          }
                                          

                                        }

                                        });
                  }

                   
                 
                 

             });
             $('#save_change_btn').click(function(e)
                {
                 
                  e.preventDefault();
                 if($('#card_name_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter card name!',
                          content: ''
                            });
                     return false;
                     
                  }
                  else
                  {
                    $('#edit-form').submit();
                    
                  }

                   
                 
                 

             });
                         
          
          });

          
             
        </script>
 
        <script type="text/javascript">
          



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
                    Credit Management
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>


          <div class="row">

<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Create Credit Card</h2>

                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="form_balance"  class="form-horizontal form-label-left" method="POST">
                  <input type="hidden" id="sum" name="sum" value="" class="hidden">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Card Name <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                           <input type="text" class="form-control"  name="card_name" id="card_name"  >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Credit line <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                           <input type="text" class="form-control"  name="credit_line" id="credit_line"  >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Balance <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                           <input type="text" class="form-control"  name="balance" id="balance"  >
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Minimum Pay <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                           <input type="text" class="form-control"  name="minimum_pay" id="minimum_pay"  >
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Interest per month <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                           <input type="text" class="form-control"  name="interest" id="interest"  >
                      </div>
                    </div>
                   

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         <button type="button"  data-target=".bs-example-modal-sm" class="btn btn-primary btn_create" id="btn_create">Create</button >
                        <img src="images/loading.gif" id="LoadingImage" style="display:none" height="42" width="42" />

                        <a href="credit_mgmt.php" class="btn btn-success">Cancel</a>
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
                  <h2>Credit card list <small>( All credit card )</small></h2>
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
          <form class="form-horizontal" id="edit-form" method="POST" action="credit_mgmt.php" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Change Credit card Infomation</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" name="edit_id" value="" class="hidden">
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Card Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="card_name_edit" name="card_name_edit"  required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Credit line</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="credit_line_edit" name="customer_name_edit"  required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Balance </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="balance_edit" name="balance_edit"  required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Minimum Pay </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="minimum_pay_edit" name="minimum_pay_edit"  required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Interest per month </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="interest_edit" name="interest_edit"  required>
                </div>
              </div>
 
 
    
            </div>

              
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="save_change_btn">Save changes</button>
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