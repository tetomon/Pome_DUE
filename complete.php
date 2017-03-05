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

             $( "#result" ).load("complete_table.php", function(responseTxt, statusTxt, xhr) {
           
                     $('#datatable').dataTable({
                        pageLength: 15,
                        
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
                    Report Summary
                    
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>
              
            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12" id="balance_history">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Report list <font color="#5DADE2">( Complete )</font><small></small></h2>
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