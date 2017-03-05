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

      <title>Report Management - TSAMS</title>
  
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

             $( "#result" ).load("expired_project_table.php", function(responseTxt, statusTxt, xhr) {
           
                     $('#datatable').dataTable({
                        pageLength: 15,
                        
                      });

                    $('#datatable tbody').on('click', '.btn_info', function (e) {
                      e.preventDefault();




                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');
               


                $("#edit-modal").modal('show');
                 if(info[15]=="Yes"){
                 $( "#enable_project_yes" ).prop( "checked", true );
                }else{
                  $( "#enable_project_no" ).prop( "checked", true );
                }
                $("#edit-id").val(info[0]); 
                $("#sel_customer_edit").val(info[2]);
                $("#po_no_edit").val(info[3]);
                $("#start_date_edit").val(info[4]);
                $("#expire_date_edit").val(info[5]);
                $("#sel_service_type_1_edit").val(info[6]);
                $("#sel_service_type_2_edit").val(info[7]);
                if(info[6]=='MA')
                {
                  $("#num_pm_edit").val(info[9]);
                  $("#num_incident_edit").val(info[8]);
                }
                else if(info[6]=='Incident')
                {
                  $( "#div_pm_edit" ).hide();
                  $("#num_incident_edit").val(info[8]);
                }
                else 
                {
                  $( "#div_pm_edit" ).hide();
                  $( "#div_incident_edit" ).hide();
                }
                $("#product_list_edit").val(info[10]);
                $("#cus_name_edit").val(info[11]);
                $("#cus_tel_edit").val(info[12]);
                $("#cus_email_edit").val(info[13]);
                $("#sale_name_edit").val(info[14]);


                    });

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
                    Project Status
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>
              
            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12" id="balance_history">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Project list <font color="#E74C3C">( Service Expired )</font><small></small></h2>
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
              <h4 class="modal-title" id="edit-modal-label">Change information project</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" name="edit_id" value="" class="hidden">

             
            <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Customer <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        
                          <input type="text" class="form-control"  name="sel_customer_edit" id="sel_customer_edit"  readonly="">  
                        
                      </div>
                    </div>
                    <input type="hidden" id="count_status" name="count_status" value="">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Contact Name  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_name_edit" id="cus_name_edit"  readonly="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_email_edit" id="cus_email_edit"  readonly="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tel.  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_tel_edit" id="cus_tel_edit"  readonly="">
                      </div>
                    </div>
                     <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PO No./TOR  <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="po_no_edit" id="po_no_edit"  readonly="">
                      </div>
                    </div>
                     <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Start Date <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" readonly="readonly" class="daterangepicker form-control" id="start_date_edit" placeholder="Select Date PM" >
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Expire Date <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" readonly="readonly" class="daterangepicker form-control" id="expire_date_edit" placeholder="Select Date Sent" >
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Service Type <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-4 col-xs-12">
                        <select id="sel_service_type_1_edit" name="sel_service_type_1_edit" class="form-control" readonly="">
                          <option value="">Select Service Type</option>
                           <option value="MA">MA</option>
                           <option value="Incident">Incident</option> 
                           <option value="Warranty">Warranty</option>                   
                        </select>
                        <select id="sel_service_type_2_edit" name="sel_service_type_2_edit" class="form-control" readonly="">
                           <option value="8*5">8*5</option>
                           <option value="24*7">24*7</option>                 
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="div_pm_edit">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PM Visit <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-4 col-xs-12">
                        <select id="num_pm_edit" name="num_pm_edit" class="form-control" readonly="">
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>                
                        </select>
                        <font color="red">Time/Year</font>
                      </div>
                    </div>
                    <div class="form-group" id="div_incident_edit">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Number Incident <font color="red">*</font>
                      </label>
                      <div class="col-md-4 col-sm-4">
                          <input type="text"  class="form-control" id="num_incident_edit" name="num_incident_edit" placeholder="Enter Number Incident" readonly="">
                      </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product list  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea class="form-control" name="product_list_edit" id="product_list_edit"  rows="7" readonly=""></textarea>
                      
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sale  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="sale_name_edit" id="sale_name_edit"  readonly="">
                      </div>
                    </div>
                    <div class="ln_solid"></div>

              
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
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