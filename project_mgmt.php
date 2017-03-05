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

 
$sql_select_customer = "SELECT * from customer_tb";
 $query_sql_select_customer = mysql_query($sql_select_customer);
 $num_not_customer = mysql_num_rows($query_sql_select_customer);

$sql_select_customer_2 = "SELECT * from customer_tb";
 $query_sql_select_customer_2 = mysql_query($sql_select_customer_2);
 $num_not_customer_2 = mysql_num_rows($query_sql_select_customer_2);

$role = $_SESSION['role'];
?>



 <script type="text/javascript">
          $(document).ready(function() {

            $("#num_incident").numeric({negative : false});

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "count_project_status.php", //Where to make Ajax calls
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


    $( "#div_pm" ).hide();
    $( "#div_incident" ).hide();
    $("#num_incident").val('');
    $("#num_pm").val(0);
    $("#sel_service_type_1").change(function () {
        
        $("#num_incident").val('');
        $("#num_pm").val(0);
        if($("#sel_service_type_1").val()=='MA')
        {
            $( "#div_pm" ).show();
            $( "#div_incident" ).show();
        }
        else if($("#sel_service_type_1").val()=='Incident')
        {
            $( "#div_pm" ).hide();
            $( "#div_incident" ).show();
        }else 
        {
           $( "#div_pm" ).hide();
            $( "#div_incident" ).hide();
        }
      });
        $("#sel_service_type_1_edit").change(function () {
        
        if($("#sel_service_type_1_edit").val()=='MA')
        {
            $( "#div_pm_edit" ).show();
            $( "#div_incident_edit" ).show();
        }
        else if($("#sel_service_type_1_edit").val()=='Incident')
        {
            $( "#div_pm_edit" ).hide();
            $( "#div_incident_edit" ).show();
        }else 
        {
           $( "#div_pm_edit" ).hide();
            $( "#div_incident_edit" ).hide();
        }
      });


            $('#start_date').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MMM-DD',
               
                 
              
              });

            $('#expire_date').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_2",
                format: 'YYYY-MMM-DD',
                 
              
              });
            $('#start_date_edit').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MMM-DD',
               
                 
              
              });

            $('#expire_date_edit').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_2",
                format: 'YYYY-MMM-DD',
                 
              
              });
             $( "#result" ).load("project_table.php", function(responseTxt, statusTxt, xhr) {
          
                      
                     
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
                                    content: '<b><font color="red"> Delete project</font></b> <br/> <b>Customer </b>: '+ info[1]+'<br/> <b>PO No./TOR </b> : '+ info[2],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'project_id='+info[0];

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_project.php", //Where to make Ajax calls
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
                $("#num_incident_edit").numeric({negative : false});

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
                $("#sel_customer_edit").val(info[1]);
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
     

                
                var num_info = $('#count_status').val().split('-');
          
                
                var num_waiting=num_info[0];
                var num_on_time=num_info[1];
                var num_nearly=num_info[2];
                var num_expire=num_info[3];
                var num_expire=num_info[3].replace(/\s+/, "") ;
                
                

     var ctx = document.getElementById("pieChart");
    var data = {
                          datasets: [{
                            data: [num_waiting, num_on_time, num_nearly, num_expire],
                            backgroundColor: [
                              "blue",
                              "green",
                              "orange",
                              "red",
                              
                            ],
                            label: 'My dataset' // for legend
                          }],
                          labels: [
                            "Waiting"+"[ "+num_waiting+" ]",
                            "On Time"+"[ "+num_on_time+" ]",
                            "Exp. Soon"+"[ "+num_nearly+" ]",
                            "Expire"+"[ "+num_expire+" ]",
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
                $('#btn_test').click(function(e)
                {
                  $("#create-modal").modal('show');
                });
            


             $('#btn_create').click(function(e)
                {
                 
                  e.preventDefault();
                 if($('#sel_customer').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please select customer!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#po_no').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter PO Number or TOR!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#start_date').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please select start date!',
                          content: ''
                            });
                     return false;
                 }
                  if($('#expire_date').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please select expire date!',
                          content: ''
                            });
                     return false;
                 }
                 if($('#sel_service_type_1').val() == 'MA')
                 {
                    if($('#num_pm').val() == '0')
                    {
                    $.alert({
                          theme: 'black',
                          title: 'Please select number PM Visit!',
                          content: ''
                            });
                     return false;
                    }
                 }
                 if($('#sel_service_type_1').val() == 'Incident')
                 {
                    $('#num_pm').val(0);
                    if($('#num_incident').val() == '')
                    {
                    $.alert({
                          theme: 'black',
                          title: 'Please enter number Incident!',
                          content: ''
                            });
                     return false;
                    }
                 }
                 if($('#sel_service_type_1').val() == 'Warranty')
                 {
                    $('#num_pm').val(0);
                    $('#num_incident').val(0);
                 }
                 if($('#product_list').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please enter product list!',
                          content: ''
                            });
                     return false;
                 }
                  if($('#expire_date').val() != '' && $('#start_date').val() != '')
                 {

                  var start_date = $('#start_date').val();
                  var expire_date = $('#expire_date').val();
                  var add_data = 'date_pm='+start_date+'&date_sent='+expire_date;
                                     jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "check_date_valid.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                           if(response==0)
                                           {
                                            $.alert({
                                              theme: 'black',
                                              title: 'Start date and Expire date is invalid!',
                                              content: ''
                                                });
                                         return false;
                                            }else
                                            {
                                            var sel_customer = $('#sel_customer').val();
                                            var cus_name = $('#cus_name').val();
                                            var cus_tel = $('#cus_tel').val();
                                            var cus_email = $('#cus_email').val();
                                            var po_no = $('#po_no').val();
                                            var start_date = $('#start_date').val();
                                            var expire_date = $('#expire_date').val();
                                            var service_type_1= $('#sel_service_type_1').val();
                                            var service_type_2= $('#sel_service_type_2').val();
                                            var num_pm= $('#num_pm').val();
                                            var num_incident= $('#num_incident').val();
                                            var product_list= $('#product_list').val();
                                            var sale_name= $('#sale_name').val();
                                           
                                    $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Create new project of '+sel_customer,
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'sel_customer='+sel_customer+'&cus_name='+cus_name+'&cus_tel='+cus_tel+'&cus_email='+cus_email+'&po_no='+po_no+'&start_date='+start_date+'&expire_date='+expire_date+'&service_type_1='+service_type_1+'&service_type_2='+service_type_2+'&num_pm='+num_pm+'&num_incident='+num_incident+'&product_list='+product_list+'&sale_name='+sale_name;

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "create_project.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if(response==1)
                                          {
                                           
                                            $.confirm({
                                            title: '',
                                            content: 'Create project complete',
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
                                    }
                                }
                            });

                 }

                

             });
              
               $('#btn_edit_complete').click(function(e)
                {                 
                  e.preventDefault();
                 if($('#sel_customer_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please select customer!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#po_no_edit').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter PO Number or TOR!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#start_date_edit').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please select start date!',
                          content: ''
                            });
                     return false;
                 }
                  if($('#expire_date_edit').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please select expire date!',
                          content: ''
                            });
                     return false;
                 }
                 if($('#sel_service_type_1_edit').val() == 'MA')
                 {
                    if($('#num_pm_edit').val() == '0')
                    {
                    $.alert({
                          theme: 'black',
                          title: 'Please select number PM Visit!',
                          content: ''
                            });
                     return false;
                    }
                 }
                 if($('#sel_service_type_1_edit').val() == 'Incident')
                 {
                    $('#num_pm_edit').val(0);
                    if($('#num_incident_edit').val() == '')
                    {
                    $.alert({
                          theme: 'black',
                          title: 'Please enter number Incident!',
                          content: ''
                            });
                     return false;
                    }
                 }
                 if($('#sel_service_type_1_edit').val() == 'Warranty')
                 {
                    $('#num_pm_edit').val(0);
                    $('#num_incident_edit').val(0);
                 }
                 if($('#product_list_edit').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please enter product list!',
                          content: ''
                            });
                     return false;
                 }
                  if($('#expire_date_edit').val() != '' && $('#start_date_edit').val() != '')
                 {

                  var start_date_edit = $('#start_date_edit').val();
                  var expire_date_edit = $('#expire_date_edit').val();
                  var add_data = 'date_pm='+start_date_edit+'&date_sent='+expire_date_edit;
                                     jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "check_date_valid.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                           if(response==0)
                                           {
                                            $.alert({
                                              theme: 'black',
                                              title: 'Start date and Expire date is invalid!',
                                              content: ''
                                                });
                                         return false;
                                            }else
                                            {
                                            var sel_customer = $('#sel_customer_edit').val();
                                            var cus_name = $('#cus_name_edit').val();
                                            var cus_tel = $('#cus_tel_edit').val();
                                            var cus_email = $('#cus_email_edit').val();
                                            var po_no = $('#po_no_edit').val();
                                            var start_date = $('#start_date_edit').val();
                                            var expire_date = $('#expire_date_edit').val();
                                            var service_type_1= $('#sel_service_type_1_edit').val();
                                            var service_type_2= $('#sel_service_type_2_edit').val();
                                            var num_pm= $('#num_pm_edit').val();
                                            var num_incident= $('#num_incident_edit').val();
                                            var product_list= $('#product_list_edit').val();
                                            var sale_name= $('#sale_name_edit').val();
                                            var edit_id = $("#edit-id").val(); 
                                            var enable_project = $("input[name=enable_project]:checked"). val();
                                    
                                    $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Change information this project',
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'sel_customer='+sel_customer+'&cus_name='+cus_name+'&cus_tel='+cus_tel+'&cus_email='+cus_email+'&po_no='+po_no+'&start_date='+start_date+'&expire_date='+expire_date+'&service_type_1='+service_type_1+'&service_type_2='+service_type_2+'&num_pm='+num_pm+'&num_incident='+num_incident+'&product_list='+product_list+'&sale_name='+sale_name+'&edit_id='+edit_id+'&enable='+enable_project;

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "change_project.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if(response==1)
                                          {
                                           
                                            $.confirm({
                                            title: '',
                                            content: 'Change project complete',
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
                                    }
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
                    Project Management
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>


          <div class="row">

<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Create New Project</h2>

                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="form_balance"  class="form-horizontal form-label-left" method="POST">

                    <div class="form-group">
                      <label class="control-label col-md-5 col-xs-12" >Create Project 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <button type="button" class="btn btn-primary" id="btn_test">Click to create</button>
                      </div>
                    </div>
                    <input type="hidden" id="count_status" name="count_status" value="">

                    
                    </form>
                </div>
              </div>
            </div>
          
            

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Project Status<small></small></h2>
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
                  <h2>Project list <small></small></h2>
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

     

    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-form" method="POST" action="report_mgmt.php" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Create new Project</h4>
            </div>
            <div class="modal-body">
               
             <div class="form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Customer <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="sel_customer" name="sel_customer" class="form-control" >
                          <option value="">Select Customer</option>
                           <? 
                        while ($row_customer = mysql_fetch_array($query_sql_select_customer))
                        { ?>
                          <option value="<?echo $row_customer['customer_id'];?>"><?echo $row_customer['customer_name'];?></option>
                          <? } ?>                     
                        </select>
                      </div>
                    </div>
                    <input type="hidden" id="count_status" name="count_status" value="">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Contact Name  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_name" id="cus_name"  >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_email" id="cus_email"  >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tel.  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_tel" id="cus_tel"  >
                      </div>
                    </div>
                     <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PO No./TOR <font color="red">*</font> 
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="po_no" id="po_no"  >
                      </div>
                    </div>
                     <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Start Date <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" readonly="readonly" class="daterangepicker form-control" id="start_date" placeholder="Select Date PM" >
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Expire Date <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" readonly="readonly" class="daterangepicker form-control" id="expire_date" placeholder="Select Date Sent" >
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Service Type <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-4 col-xs-12">
                        <select id="sel_service_type_1" name="sel_service_type_1" class="form-control" >
                          <option value="">Select Service Type</option>
                           <option value="MA">MA</option>
                           <option value="Incident">Incident</option> 
                           <option value="Warranty">Warranty</option>                   
                        </select>
                        <select id="sel_service_type_2" name="sel_service_type_2" class="form-control" >
                           <option value="8*5">8*5</option>
                           <option value="24*7">24*7</option>                 
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="div_pm">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PM Visit <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-4 col-xs-12">
                        <select id="num_pm" name="num_pm" class="form-control" >
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
                    <div class="form-group" id="div_incident">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Number Incident <font color="red">*</font>
                      </label>
                      <div class="col-md-4 col-sm-4">
                          <input type="text"  class="form-control" id="num_incident" name="num_incident" placeholder="Enter Number Incident" >
                      </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product list  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea class="form-control" name="product_list" id="product_list"  rows="7"></textarea>
                      
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sale  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="sale_name" id="sale_name"  >
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                   
            </div>

              
            
            <div class="modal-footer">
              <button type="button"  data-target=".bs-example-modal-sm" class="btn btn-primary btn_create" id="btn_create">Create</button >
                        <img src="images/loading.gif" id="LoadingImage" style="display:none" height="42" width="42" />

                        <a href="project_mgmt.php" class="btn btn-success">Cancel</a>
            </div>
            </form>
        </div>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Enable 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="radio" class="flat" name="enable_project" id="enable_project_yes" value="Yes" /> Yes<br/>
                     
                      <input type="radio" class="flat" name="enable_project" id="enable_project_no" value="No"  /> No
                      </div>
                    </div>
             
            <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Customer <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="sel_customer_edit" name="sel_customer_edit" class="form-control" >
                          <option value="">Select Customer</option>
                           <? 
                        while ($row_customer_2 = mysql_fetch_array($query_sql_select_customer_2))
                        { ?>
                          <option value="<?echo $row_customer_2['customer_id'];?>"><?echo $row_customer_2['customer_name'];?></option>
                          <? } ?>                     
                        </select>
                      </div>
                    </div>
                    <input type="hidden" id="count_status" name="count_status" value="">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Contact Name  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_name_edit" id="cus_name_edit"  >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_email_edit" id="cus_email_edit"  >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tel.  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="cus_tel_edit" id="cus_tel_edit"  >
                      </div>
                    </div>
                     <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PO No./TOR  <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="po_no_edit" id="po_no_edit"  >
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
                        <select id="sel_service_type_1_edit" name="sel_service_type_1_edit" class="form-control" >
                          <option value="">Select Service Type</option>
                           <option value="MA">MA</option>
                           <option value="Incident">Incident</option> 
                           <option value="Warranty">Warranty</option>                   
                        </select>
                        <select id="sel_service_type_2_edit" name="sel_service_type_2_edit" class="form-control" >
                           <option value="8*5">8*5</option>
                           <option value="24*7">24*7</option>                 
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="div_pm_edit">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PM Visit <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-4 col-xs-12">
                        <select id="num_pm_edit" name="num_pm_edit" class="form-control" >
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
                          <input type="text"  class="form-control" id="num_incident_edit" name="num_incident_edit" placeholder="Enter Number Incident" >
                      </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product list  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea class="form-control" name="product_list_edit" id="product_list_edit"  rows="7"></textarea>
                      
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sale  
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"  name="sale_name_edit" id="sale_name_edit"  >
                      </div>
                    </div>
                    <div class="ln_solid"></div>

              
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button"  data-target=".bs-example-modal-sm" class="btn btn-primary btn_edit_complete" id="btn_edit_complete">Save changes</button >
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