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


  <script src="js/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="css/jquery-confirm.css" />
        <script type="text/javascript" src="js/jquery-confirm.js"></script>



  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

  <? 
  
  include 'connect_db.php';

   $sql_team = "SELECT * from team_tb" ;
   $query_sql_team = mysql_query($sql_team) or die('Can not query team');
   $num_team = mysql_num_rows($query_sql_team);
  ?>
  <?
  if(isset($_POST['team_name']) && $_POST['team_name']!='')
  {

   $team_name = $_POST['team_name'];


        $select_team = "SELECT * FROM team_tb WHERE team_name='".$team_name."'";
         
         $query_select_team = mysql_query($select_team) or die("Could not select team");

          $num_select_team = mysql_num_rows($query_select_team);
        
         if($num_select_team == 0)
         {
             $insert_team = "INSERT INTO `team_tb`
             (`team_name`)
             VALUES
             ('".$_POST['team_name']."')";
             $query_insert_team = mysql_query($insert_team) or die("Could not insert team");

             echo "<script>alert('Add team complete!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=team_mgmt.php'>";         
            

         }
         elseif($num_select_team > 0)
        {
          echo "<script>alert('team : ".$_POST['team_name']."  is already!'); </script>";          
          print "<meta http-equiv='refresh' content='0;URL=team_mgmt.php'>";
        }

     

    }
    if(isset($_POST['edit_id']) && $_POST['edit_id']!='')
    {
        $edit_team = $_POST['team_name_edit'];
        $old_team = $_POST['team_name_old'];
        if($edit_team == $old_team )
        {
            print "<meta http-equiv='refresh' content='0;URL=team_mgmt.php'>";
        }
        else
        {
          $select_team_2 = "SELECT * FROM team_tb WHERE team_name='".$edit_team."'";
         
        $query_select_team_2 = mysql_query($select_team_2) or die("Could not select team");

        $num_select_team = mysql_num_rows($query_select_team_2);
            if($num_select_team > 0)
            {
                echo "<script>alert('Team : ".$edit_team."  is already!'); </script>";          
                print "<meta http-equiv='refresh' content='0;URL=team_mgmt.php'>";
            }
            elseif($num_select_team == 0)
            {
            $update_team = "UPDATE team_tb SET ";
            $update_team .="team_name = '".$edit_team."' ";
            $update_team .="WHERE team_id = '".$_POST['edit_id']."'";
            $query_update_team = mysql_query($update_team) or die("Could not update team");
                if(isset($query_update_team))
                {
      
                    print "<meta http-equiv='refresh' content='0;URL=team_mgmt.php'>";
                }
            }
        }
        

    }

  ?>

                 
<script>
$(function () {

  $(".btn_delete").click(function() { 
                
               
                var tit = $(this).data('title');
                var info = tit.split('-');
                var id = $(this).closest('tr').data('id');

                          $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Delete team : '+ info[1],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,
                                    confirm: function () 
                                    {
                                      var add_data = 'team_id='+info[0];  
                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_team.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if(response == 1)
                                          {
                                          $('#row_'+id).fadeOut();
                                          }
                                          else if(response == 0)
                                          {
                                            $.alert({
                                                      keyboardEnabled: true,
                                                      title: 'Error!',
                                                      content: 'You cannot remove team ,this team seleted by some user',
                                                      
                                                  });
                                           return false;

                                          }



                                        }

                                        });
                                    }
                                });
        });

    $(".add_team").click(function(e) { 
                  e.preventDefault();

                  var text_team =  $("[name='team_name']").val();
                  if($("[name='team_name']").val().length == 0)
                  {
                        $.alert('Please insert team!');
                  }
                  else
                  {
                      
                        $('#form_add_team').submit();
                  }
                   
                 
                              
                });

     $(".btn_edit").click(function(e) { 
                  e.preventDefault();
                var tit = $(this).data('title');
                var info = tit.split('-');
                var id = $(this).closest('tr').data('id');
                $("#edit-modal").modal('show');
                $("#team_modal").val(info[1]) ;
                $("#edit-name-old").val(info[1]) ;
                $("#edit-id").val(info[0]) ; 
                              
                });


                  
                  
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
                    Team Mananagement
                    <small>
                        
                    </small>
                </h3>
            </div>

            
          </div>
          <div class="clearfix"></div>


          <div class="row">

          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Team <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" id="form_add_team" method="POST" action="team_mgmt.php">


                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Team name <span class="required"><font color="red">*</font></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="team_name" class="form-control col-md-7 col-xs-12"  name="team_name"  type="text">
                      </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                       <button  type="submit" class="btn btn-success add_team">Add Team</button>
                        <a  href="team_mgmt.php" class="btn btn-primary">Cancel</a>
                       
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Total Team <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
        <div class="row ">
         

        </div>
        <br>
                  <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead class="headings" >
                      <tr >
                        <th style="width: 10%">#</th>
                        <th class="text-center">Team Name</th>
                        <th style="width: 20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                     <? $i=0;
                      while ($row_team = mysql_fetch_array($query_sql_team))
                      { $i=$i+1; ?>
                      <tr id="row_<? echo $row_team['team_id']; ?>" data-id="<? echo $row_team['team_id']; ?>" >
                        <td><? echo $i; ?></td>
                        <td align="center"><? echo $row_team['team_name']; ?></td>
                        <td>
                          <button  class="btn btn-info btn-xs btn_edit " data-title="<? echo $row_team['team_id']."-".$row_team['team_name'] ?>"><i class="fa fa-pencil"></i> Edit </button>
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo $row_team['team_id']."-".$row_team['team_name'] ?>"><i class="fa fa-trash-o"></i> Delete </button>
                        </td>
                      </tr>
                      <? } ?>
                     
                      
                    </tbody>
                  </table>



                </div>
              </div>
            </div>



          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
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
          <form class="form-horizontal" id="edit-form" method="POST" action="team_mgmt.php" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit Team</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" name="edit_id" value="" class="hidden">
                <input type="hidden" id="edit-name-old" name="team_name_old" value="" class="hidden">
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Team</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="team_modal" name="team_name_edit" placeholder="Team name" required>
                </div>
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
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
</body>

   <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>

  <script src="js/validator/validator.js"></script>
  <script>
    $(document).ready(function() {
  

   
      
      
      
  
});
  </script>


</html>
