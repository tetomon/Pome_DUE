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


$sql_select_engineer = "SELECT * from engineer_tb where enable_user='yes'";
 $query_sql_select_engineer = mysql_query($sql_select_engineer);
 $num_engineer = mysql_num_rows($query_sql_select_engineer);
 
$sql_select_customer = "SELECT * from customer_tb";
 $query_sql_select_customer = mysql_query($sql_select_customer);
 $num_not_customer = mysql_num_rows($query_sql_select_customer);

 if(isset($_POST['edit_id']) && $_POST['edit_id']!='')
    {
      if ( isset($_FILES["file_edit"])  && !empty($_FILES["file_edit"]["name"]))
      {
        $select_file_name = "SELECT * FROM report_tb WHERE file_name='".$_POST['folder_name'].'/'.$_FILES['file_edit']['name']."'  AND report_id != '".$_POST['edit_id']."'";
        $query_select_file_name = mysql_query($select_file_name) or die("Could not select report");
        $num_select_file= mysql_num_rows( $query_select_file_name); 
        if($num_select_file > 0 )
        {
            echo "<script>alert('This file name same with other report'); </script>";
            print "<meta http-equiv='refresh' content='0;URL=report_mgmt.php'>";  
        }
        else{
        $allowed =  array('doc','docx','zip','rar');
        $file_name = $_FILES['file_edit']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name_change = str_replace(' ', '_', $file_name);
        
        if(!in_array($ext,$allowed) ) 
              {

                  echo "<script>alert('Please select file type doc, docx, zip, rar only'); </script>"; 
              }
        else
            {
            
                if($_FILES['file_edit']['size'] > (25600000)) //can't be larger than 25 MB
                      {
                        echo "<script>alert('Failed!!! , Your file size is to large than 25 MB'); </script>"; 
                        
                      }
                else
                    {
                      
                      if (!file_exists('report_file/'.$_POST['folder_name'])) {
                            
                            mkdir('report_file/'.$_POST['folder_name'], 0777, true);
                          }
                      if(file_exists('report_file/'.$_POST['folder_name'].'/'.$_FILES['file_edit']['name'])) unlink('report_file/'.$_POST['folder_name'].'/'.$_FILES['file_edit']['name']);
                      if(move_uploaded_file($_FILES['file_edit']['tmp_name'], 'report_file/'.$_POST['folder_name'].'/'.$_FILES['file_edit']['name']))
                    {
                        $update_report = "UPDATE report_tb SET ";
                        $update_report .="file_name = '".$_POST['folder_name'].'/'.$_FILES['file_edit']['name']."' ";
                        $update_report .=",comment = '".$_POST['comment_edit']."' ";
                        $update_report .=",remark = '".$_POST['sel_status']."' ";
                        $update_report .="WHERE report_id = '".$_POST['edit_id']."'";
                        $query_update_report = mysql_query($update_report) or die("Could not update report 1");
                            if(isset($query_update_report))
                            {
                          
                               echo "<script>alert('Change report infomation Complete'); </script>"; 
                            }else
                            {
                              echo "<script>alert('Change report infomation Failed!'); </script>"; 
                            }
                     }
                    else {
                        echo "<script>alert('Upload file failed!'); </script>"; 
                    }
                    }
            }
         }
      }
      else
      { 
                        $update_report_2 = "UPDATE report_tb SET ";
                        $update_report_2 .="comment = '".$_POST['comment_edit']."' ";
                        $update_report_2 .=",remark = '".$_POST['sel_status']."' ";
                        $update_report_2 .="WHERE report_id = ".$_POST['edit_id']."";
                        
                        $query_update_report_2 = mysql_query($update_report_2) or die("Could not update report 2");
                            if(isset($query_update_report_2))
                            {
                          
                               echo "<script>alert('Change report infomation Complete'); </script>"; 
                            }else
                            {
                              echo "<script>alert('Change report infomation Failed!'); </script>"; 
                            }

      }
      print "<meta http-equiv='refresh' content='0;URL=report_mgmt.php'>";  
    }


$role = $_SESSION['role'];
?>



 <script type="text/javascript">
          $(document).ready(function() {



                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "count_status_all.php", //Where to make Ajax calls
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

     $(document).ajaxStart(function(){
        $("#LoadingImage_2").css({"display": "block","margin": "auto"});
    });
    $(document).ajaxComplete(function(){
        $("#LoadingImage_2").css("display", "none");
    });

    $("#sel_customer").change(function(){
       $("#div_po").hide();
      var sel_customer_id = $("#sel_customer option:selected").attr('value');
      if(sel_customer_id != ''){
       var add_data = 'sel_customer_id='+sel_customer_id;
                                       jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "get_project.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                           if(response == 0)
                                            {
                                                $.alert({
                                                    theme: 'black',
                                                    title: 'Not found project of this customer',
                                                    content: ''
                                                      });
                                               return false;
                                               
                                            }else
                                            {
                                              $("#div_po").show();
                                              $("#div_po_option").html("<select id='sel_project' name='sel_project' class='form-control'><option value=''>Select Project</option>"+response+"</select>")
                                            }
                                         
                                        }

                                        });
      }
                                    
    });



 document.getElementById('btn_select_file_edit').onclick = function() {
              document.getElementById('my_file_edit').click();
        };
             $('#my_file_edit').change(function (e) {
        $('#file_name_edit').val($(this).val());
        });

            $('#date_pm').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MMM-DD',
               
                 
              
              });

            $('#date_sent').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_2",
                format: 'YYYY-MMM-DD',
                 
              
              });
             $( "#result" ).load("report_table.php", function(responseTxt, statusTxt, xhr) {
          
                      
                     
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
                                    content: 'Delete report <br/> Customer : '+ info[1]+'<br/>Date PM : '+ info[2],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'report_id='+info[0];

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_report.php", //Where to make Ajax calls
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

                var folder_split = info[2].split('-');
                var folder_name = folder_split[1]+"_"+folder_split[0]
                var file



                $("#edit-modal").modal('show');
                $("#div_sel_status").show();
                $("#div_file").show();
                $("#div_waiting_status").hide();
                $("#div_waiting_status_file").hide();
                $("#customer_modal").val(info[1]) ;
                $("#date_pm_modal").val(info[2]) ;
                $("#edit-id").val(info[0]) ; 
                $("#edit-file_name_old").val(info[2]) ;
                $("#comment_modal").val(info[5]);
                $("#folder_name").val(folder_name);
                $("#po_modal").val(info[7]);
                if(info[6]==0)
                {
                  
                  $("#div_sel_status").hide();
                  $("#div_waiting_status").show();
                  $("#div_file").hide();
                  $("#div_waiting_status_file").show();
                  
                }

                if(info[4]=='complete')
                {
                  
                document.getElementById("sel_status").value = 'complete';
                }else
                {
                  document.getElementById("sel_status").value = '';
                }


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
                   if($('#sel_project').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please PO No./ TOR!',
                          content: ''
                            });
                     return false;
                     
                  }
                  if($('#sel_engineer').val() == '')
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please select engineer!',
                          content: ''
                            });
                     return false;
                  }
                  if($('#date_pm').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please select date PM!',
                          content: ''
                            });
                     return false;
                 }
                  if($('#date_sent').val() == '')
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please select date sent report!',
                          content: ''
                            });
                     return false;
                 }
                 if($('#date_sent').val() != '' && $('#date_pm').val() != '')
                 {
                  var date_pm = $('#date_pm').val();
                  var date_sent = $('#date_sent').val();
                  var add_data = 'date_pm='+date_pm+'&date_sent='+date_sent;
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
                                              title: 'Date PM and Date sent is invalid!',
                                              content: ''
                                                });
                                         return false;
                                            }else
                                            {
                                              var sel_customer = $('#sel_customer').val();
                                              var sel_project = $('#sel_project').val();
                  var sel_engineer = $('#sel_engineer').val();
                  var date_pm = $('#date_pm').val();
                  var date_sent = $('#date_sent').val();
                  var comment = $('#comment').val();
                   $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Create ticket report',
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'sel_customer='+sel_customer+'&sel_project='+sel_project+'&sel_engineer='+sel_engineer+'&date_pm='+date_pm+'&date_sent='+date_sent+'&comment='+comment;

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "create_report.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if(response==1)
                                          {
                                           
                                            $.confirm({
                                            title: '',
                                            content: 'Create ticket report complete',
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
              function reset_scan(){
          $("#sel_engineer").val('');
          $("#sel_customer").val('');
          $("#sel_project").val('');
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
                    Report Management
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>


          <div class="row">

<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Create ticket report</h2>

                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="form_balance"  class="form-horizontal form-label-left" method="POST">

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
                    <div class="form-group" id="div_po" hidden>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >PO / TOR <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12" id="div_po_option">
                       <img src="images/loading.gif" id="LoadingImage_2" style="display:none;"  />
                      </div>
                    </div>
                    <input type="hidden" id="count_status" name="count_status" value="">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Owner  <font color="red">*</font>
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                       <select id="sel_engineer" name="sel_engineer" class="form-control" >
                          <option value="">Select Engineer</option>
                           <? 
                        while ($row_engineer = mysql_fetch_array($query_sql_select_engineer))
                        { ?>
                          <option value="<?echo $row_engineer['eng_id'];?>"><?echo $row_engineer['first_name'].' '.$row_engineer['last_name'].' ('.$row_engineer['nick_name'].')';?></option>
                          <? } ?>                     
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date PM <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" readonly="readonly" class="daterangepicker form-control" id="date_pm" placeholder="Select Date PM" >
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date sent <font color="red">*</font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" readonly="readonly" class="daterangepicker form-control" id="date_sent" placeholder="Select Date Sent" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Comment
                      </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                           <input type="text" class="form-control"  name="comment" id="comment"  >
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
                  <h2>Report list <small>( All Report )</small></h2>
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
                <label for="mobile" class="col-sm-2 control-label">PO/TOR</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="readonly" id="po_modal" name="po_modal"  required>
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