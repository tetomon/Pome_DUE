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

        <title>Project Management - TSAMS</title>
  
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


   <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

<? 
include 'connect_db.php';

$sql_team = "SELECT * from team_tb where team_id =".$_SESSION['team_id']."" ;
$query_sql_team = mysql_query($sql_team) or die('Can not query Team');
$row_team = mysql_fetch_array($query_sql_team);

$sql_engineer = "SELECT * from engineer_tb Where enable_user='yes' and team_id='".$_SESSION['team_id']."'" ;
$query_sql_engineer= mysql_query($sql_engineer) or die('Can not query engineer');

$sql_engineer_2 = "SELECT * from engineer_tb Where enable_user='yes' and team_id='".$_SESSION['team_id']."'" ;
$query_sql_engineer_2= mysql_query($sql_engineer_2) or die('Can not query engineer2');


$role = $_SESSION['role'];
?>



 <script type="text/javascript">
          $(document).ready(function() {



                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "count_status_team.php", //Where to make Ajax calls
                                       dataType:"text",
                                       
                                        success:function(response)
                                        {
                                          
                                         $("#count_status").val(response);

                                         

                                        }

                                        });


      

      $(document).ajaxStart(function(){
        $("#LoadingImage").css({"display": "block","margin": "auto"});
    });
    $(document).ajaxComplete(function(){
        $("#LoadingImage").css("display", "none");
    });
        $( "#team_info" ).load("team_info.php", function(responseTxt, statusTxt, xhr) {



         });
             $( "#result" ).load("team_report_table.php", function(responseTxt, statusTxt, xhr) {
          
                      
                     
                     $('#datatable').dataTable({
                        pageLength: 10,
                        bInfo: false,
                        
                      });
   
      $('#datatable tbody').on('click', '.btn_download', function (e) {
      e.preventDefault();
                var tit = $(this).data('title');
               
                window.location.href = "report_file/"+tit;


          });

                
                var num_info = $('#count_status').val().split('-');
                
                
                var num_waiting=num_info[0];
                var num_on_process=num_info[1];
                var num_late=num_info[2].replace(/\s+/, "") ;
                var num_complete = num_info[3];

   

     var ctx = document.getElementById("pieChart");
    var data = {
                          datasets: [{
                            data: [num_waiting, num_on_process, num_late],
                            backgroundColor: [
                              "orange",
                              "green",
                              "red",
                              
                            ],
                            label: 'My dataset' // for legend
                          }],
                          labels: [
                            "Waiting PM "+"["+num_waiting+"]",
                            "On Process "+"["+num_on_process+"]",
                            "Late "+"["+num_late+"]",
                          ]
                        };
    var pieChart = new Chart(ctx, {
      data: data,
      type: 'pie',
      otpions: {
        legend: false
      }
    });
                
                
                });

           
          
         
       
          
          });

          
             
        </script>
 
        <script type="text/javascript">
          $(function () {
              function reset_scan(){
          $("#sel_engineer").val('');
          $("#sel_customer").val('');
          $("#date_pm").val('');
          $("#date_sent").val('');
          $("#comment").val('');
      };
           
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
               <input type="hidden" id="count_status" name="count_status" value="">
                    Team Report ( <font color="blue"><? echo $row_team['team_name'] ?></font> )
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>


          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
             <div class="x_panel">
              <div class="x_title">
                <h2>Team Member<small></small></h2>
             
                <div class="clearfix"></div>
              </div>
               <div class="x_content" id="team_info">


                </div>
            </div>
            </div>

          
            

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Report Status </h2>
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
                  <h2>Report list</h2>
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
            Metro System Corporation Public Company limited
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

     <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-form" method="POST" action="report_mgmt.php" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Change status report</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" name="edit_id" value="" class="hidden">
                <input type="hidden" id="folder_name" name="folder_name" value="" class="hidden">
                <input type="hidden" id="edit-file_name_old" name="edit_file_name_old" value="" class="hidden">
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Customer name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="readonly" id="customer_modal" name="customer_name_edit"  required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Date PM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="readonly" id="date_pm_modal" name="date_pm_modal"  required>
                </div>
              </div>
               <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10" id='div_sel_status'>
                     <select id="sel_status" name="sel_status" class="form-control" >
                          
                          <option value="">Not yet complete</option>
                          <option value="complete">Complete</option>

                                           
                        </select>
                </div>
                 <div class="col-sm-10" id='div_waiting_status' style="display: none;"><font color="red">Waiting PM ...</font></div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Comment</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="comment_modal" name="comment_edit"  >
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Report file</label>
                <div class="col-sm-10" id='div_file'>
                    <input type="text" id="file_name_edit" readonly="readonly" name="file_name_edit"  class="form-control col-md-6 col-xs-6"> 
                        <input type="file" id="my_file_edit" name="file_edit" style="display: none;">
                        <input type="hidden"  name="submit_import" style="display: none;">
                         
                        <button type="button" class="btn btn-info" id="btn_select_file_edit">Choose file</button><font color="red">(.doc , .docx or zip only)</font>
                </div>
                <div class="col-sm-10" id='div_waiting_status_file' style="display: none;"><font color="red">Waiting PM ...</font></div>
              </div>
            </div>

              
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
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