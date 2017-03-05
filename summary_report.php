<? 
date_default_timezone_set("Asia/Bangkok");


   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   
include 'check_session.php';
if($_SESSION['role']!='Admin')

{
    echo "<script>alert('You not authorized view this link!'); </script>";
    print "<meta http-equiv='refresh' content='1;URL=stock_in.php'>";
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

      <title>MG - TBOX Systems</title>

    <!-- Bootstrap core CSS -->

     <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap-select.min.js"></script>

   <link rel="stylesheet" type="text/css" href="css/jquery-confirm.css" />
        <script type="text/javascript" src="js/jquery-confirm.js"></script>


      <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <link href="css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
  



    <!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    $(document).ready(function() {
          

      $(document).ajaxStart(function(){
        $("#LoadingImage").css({"display": "block","margin": "auto"});
    });
    $(document).ajaxComplete(function(){
        $("#LoadingImage").css("display", "none");
    });

    });
  </script>
  <script type="text/javascript">
  $(function(){

    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: 5
      });

    $('#single_date').daterangepicker({

                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MMM-DD',
                 maxDate: new Date()
              
              });

      $('input[type=radio][name=radio_sort]').change(function () {
         $('[name=radio_sort]:checked').val()
        if($('[name=radio_sort]:checked').val()=='date')
        {
            $("#div_date").show();
            $("#div_month").hide();
            $("#div_year").hide();
        }
        else if($('[name=radio_sort]:checked').val()=='month')
        {
             $("#div_date").hide();
            $("#div_month").show();
            $("#div_year").hide();
        }else if($('[name=radio_sort]:checked').val()=='year')
        {
           $("#div_date").hide();
            $("#div_month").hide();
            $("#div_year").show();
        }
      });

      $('#filter_data').click(function(){

          filter_result();
                  
      });


      function filter_result(){
        if($("input[name=radio_sort]:checked").val()=='month')
            {
                if($("#year_month").val()=='' || $("#month").val()=='')
                {
                  $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Please select month and year',
                              
                          });
                }else
                {

                $( "#result_filter" ).load("summary_table.php?month="+$("#year_month").val()+"-"+$("#month").val(), function(responseTxt, statusTxt, xhr) {
                       $("#h_history").html('History (<font color="blue"> Month : '+$("#month option:selected").text()+' / Year : '+$("#year_month").val()+'  </font>)');
                      $('#datatable').dataTable({
                        paging: false,
                        bInfo: false,
                        bSort : false
                      });
                      
                });
              }
                  
           }
         else if($("input[name=radio_sort]:checked").val()=='year')
         {
            if($("#year").val()=='')
                {
                  $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Please select year',
                              
                          });
                }else
                {

                $( "#result_filter" ).load("summary_table.php?year="+$("#year").val(), function(responseTxt, statusTxt, xhr) {
                    $("#h_history").html('History (<font color="blue"> Year : '+$("#year").val()+' </font>)');
                      $('#datatable').dataTable({
                        paging: false,
                        bInfo: false,
                        bSort : false
                      });
                      
                });
              }
         }
         else if($("input[name=radio_sort]:checked").val()=='date')
         {
            if($("#single_date").val()=='')
                {
                  $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Please select date',
                              
                          });
                }else
                {

                $( "#result_filter" ).load("summary_table.php?date="+$("#single_date").val(), function(responseTxt, statusTxt, xhr) {
                  $("#h_history").html('History (<font color="blue"> Date : '+$("#single_date").val()+' </font>)');
                      $('#datatable').dataTable({
                        paging: false,
                        bInfo: false,
                        bSort : false
                      });
                      
                });
              }
         }
      };

    });

  </script>
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
                    Summary Report
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Filter<small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="form_sort_data" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sort by<font color="red"><span class="required">*</span></font>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" checked="" value="date" name="radio_sort">  <label class="" for="last-name"> : Single Date
                      </label>
                        <div class="" id="div_date">
                       <input type="text" readonly="readonly" class="daterangepicker form-control" id="single_date" placeholder="Select Date" >

                          </div>
                      </div>

                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="radio"  value="month" name="radio_sort">   <label class=""> : By Month
                      </label>
                        <div id="div_month" class="" hidden="">
                        <select id="month" class="selectpicker">
                          <option value=''>--Select Month--</option>
                                                  <option value='Jan'>Janaury</option>
                                                  <option value='Feb'>February</option>
                                                  <option value='Mar'>March</option>
                                                  <option value='Apr'>April</option>
                                                  <option value='May'>May</option>
                                                  <option value='Jun'>June</option>
                                                  <option value='Jul'>July</option>
                                                  <option value='Aug'>August</option>
                                                  <option value='Sep'>September</option>
                                                  <option value='Oct'>October</option>
                                                  <option value='Nov'>November</option>
                                                  <option value='Dec'>December</option>
                            </select> :

                            <select id="year_month" class="selectpicker">
                          <option value=''>--Select Year--</option>
                                                  <option value='2016'>2016</option>
                                                  <option value='2017'>2017</option>
                                                  <option value='2018'>2018</option>
                                                  <option value='2019'>2019</option>
                                                  <option value='2020'>2020</option>
                                                  <option value='2021'>2021</option>
                                                  <option value='2022'>2022</option>
                                                  
                            </select>
                          </div>

                      </div>
                      
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="radio"  value="year" name="radio_sort">   <label class="" for="last-name"> : By Year
                      </label>
                        <div class="" id="div_year" hidden="">
                        <select id="year" class="selectpicker">
                          <option value=''>--Select Year--</option>
                                                  <option value='2016'>2016</option>
                                                  <option value='2017'>2017</option>
                                                  <option value='2018'>2018</option>
                                                  <option value='2019'>2019</option>
                                                  <option value='2020'>2020</option>
                                                  <option value='2021'>2021</option>
                                                  <option value='2022'>2022</option>
                                                  
                            </select>
                          </div>
                      </div>
                      
                    </div>

                    
                

                   

                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="button" id="filter_data" class="btn btn-primary">Filter</button>
                        <a  href="summary_report.php" class="btn btn-warning" id="btn_cancel">Cancel</a>
                       
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>


          

            <div class="clearfix"></div>

          <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2 id="h_history">History<small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" id="result_filter">
                  
                   <img src="images/loading.gif" id="LoadingImage" style="display:none;"  />

                </div>
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
            TBOX Systems - SAIC Motor-CP Co.,Ltd. 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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

   <script type="text/javascript" src="js/moment/moment.min.js"></script>
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