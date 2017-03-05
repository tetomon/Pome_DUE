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
   $query_sql_team = mysql_query($sql_team) or die('Can not query Team');

   $sql_engineer = "SELECT * from engineer_tb eng, team_tb team Where team.team_id=eng.team_id Order by enable_user DESC" ;
   $query_sql_engineer= mysql_query($sql_engineer) or die('Can not query engineer');
   
   if(isset($_POST['username']) && isset($_POST['password']))
  {
     $insert_engineer = "INSERT INTO `engineer_tb`
             (`first_name`,`last_name`,`nick_name`,`email`,`username`,`password`,`role`,`team_id`)
             VALUES
             ('".$_POST['f_name']."','".$_POST['l_name']."','".$_POST['n_name']."','".$_POST['email']."','".$_POST['username']."','".$_POST['password']."','".$_POST['role']."',".$_POST['sel_team'].")";
             echo $insert_engineer;
             $query_insert_engineer = mysql_query($insert_engineer) or die("Could not insert user");

      if(isset($query_insert_engineer))
      {
        echo "<script>alert('Add engineer complete!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=engineer_mgmt.php'>"; 

      }else
      {
        echo "<script>alert('Add engineer failed!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=engineer_mgmt.php'>"; 

      }
  }
  
  ?>
  <?
if(isset($_POST['f_name_edit']) && isset($_POST['username_edit']))
  {
           $update_engineer = "UPDATE engineer_tb SET ";
            $update_engineer .="first_name = '".$_POST['f_name_edit']."' ";
            $update_engineer .=",last_name = '".$_POST['l_name_edit']."' ";
            $update_engineer .=",nick_name = '".$_POST['n_name_edit']."' ";
            $update_engineer .=",username = '".$_POST['username_edit']."' ";
            $update_engineer .=",email = '".$_POST['email_edit']."' ";
            $update_engineer .=",team_id = '".$_POST['sel_team_edit']."' ";
            $update_engineer .=",role = '".$_POST['role_edit']."' ";
            $update_engineer .=",enable_user = '".$_POST['enable_user']."' ";
            $update_engineer .="WHERE eng_id = '".$_POST['edit_id']."' ";
            $query_update_engineer = mysql_query($update_engineer) or die('Can not edit engineer');
      if(isset($query_update_engineer))
        {
        echo "<script>alert('Edit engineer complete!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=engineer_mgmt.php'>"; 

      }else
      {
        echo "<script>alert('Edit engineer failed!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=engineer_mgmt.php'>"; 

      }
  }

     

  ?>

</head>
<script>
    $(document).ready(function() {

      $(".btn_delete").click(function(e) { 
                e.preventDefault();
                
                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');

                if(info[0] ==0)
               {
                   $.alert({
                              keyboardEnabled: true,
                              title: 'Warning!',
                              content: 'Cannot delete this engineer',
                              
                          });
                   return false;
               } 

                          $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Delete Engineer : '+ info[1]+ ' ' +info[2],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,
                                    confirm: function () 
                                    {
                                      var add_data = 'eng_id='+info[0];  
                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_engineer.php", //Where to make Ajax calls
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
                                                      content: 'You cannot remove this user because user assigned to report ticket',
                                                      
                                                  });
                                           return false;

                                          }

                                        }

                                        });
                                    }
                                });
        });

      $('#edit-modal').on('hidden.bs.modal', function () {
              location.reload();
        });

      $('#submit_add_user').click(function(e) {
        e.preventDefault();
        if($('#f_name').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter first name!',
                content: ''
                  });

        return false;

       
      }
      if($('#l_name').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter last name!',
                content: ''
                  });

        return false;

       
      }
      if($('#n_name').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter nickname!',
                content: ''
                  });

        return false;

       
      }
      if($('#email').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter Email!',
                content: ''
                  });

        return false;

       
      }
       if($('#sel_team').val()=='')
      {
        $.alert({
                theme: 'black',
                title: 'Please select team!',
                content: ''
                  });

        return false;

       
      }
      if($('#username').val().length==0) 
      {
         $.alert({
                theme: 'black',
                title: 'Please enter username!',
                content: ''
                  });
            return false;
      }
      if($('#username').val().length!=0)
      {
          if($('#username').val().length < 5)
        {
             $.alert({
                theme: 'black',
                title: 'You entered new username least 5 characters!',
                content: ''
                  });
            return false;
        }
      }
        if($('#password').val().length == 0)
        {
            $.alert({
                theme: 'black',
                title: 'Please enter password!',
                content: ''
                  });
           return false;
           
        }if($('#password').val().length < 8)
        {
            $.alert({
                theme: 'black',
                title: 'You entered password least 8 characters!',
                content: ''
                  });
           return false;
        }
       if($('#password2').val().length == 0)
       {
          $.alert({
                theme: 'black',
                title: 'Please enter repeat password!',
                content: ''
                  });
           return false;
       }
       if($('#password2').val().length != 0)
       {  
          var password1= $('#password').val();
          var password2= $('#password2').val();

         if(password1 != password2)
         {
            $.alert({
                theme: 'black',
                title: 'Password do not match!',
                content: ''
                  });
           return false;
         }
         else
         {
             $( "#form_add_user" ).submit();
         }
         
       }


       });


       $(".btn_edit").click(function(e) { 
                  e.preventDefault();
                 var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');
                $("#edit-modal").modal('show');
                $("#edit_id").val(info[0]) ;
                $("#name_edit").val(info[1]) ;
                $("#username_edit").val(info[6]) ;
                $("#edit-user-old").val(info[6]) ;
                if(info[7]=="Admin"){
                 $( "#role_admin_edit" ).prop( "checked", true );
                }else{
                  $( "#role_user_edit" ).prop( "checked", true );
                }
              

                });


      $(".btn_change_pass").click(function(e) { 
                 e.preventDefault();
                $('#user_id_pass').val($("#edit_id").val());
                $("#edit-password").modal('show');
                $('#new_pass').val('');
                $('#re_pass').val('');

                });
      $('#submit_change_pass').click(function(e)
                {
                  e.preventDefault();
                 if($('#new_pass').val().length == 0)
                  {
                      $.alert({
                          theme: 'black',
                          title: 'Please enter new password!',
                          content: ''
                            });
                     return false;
                     
                  }if($('#new_pass').val().length < 8)
                  {
                      $.alert({
                          theme: 'black',
                          title: 'You entered new password least 8 characters!',
                          content: ''
                            });
                     return false;
                  }
                  if($('#re_pass').val().length == 0)
                 {
                    $.alert({
                          theme: 'black',
                          title: 'Please enter repeat password!',
                          content: ''
                            });
                     return false;
                 }
                 if($('#re_pass').val().length != 0)
                 {  
                    var password1= $('#new_pass').val();
                    var password2= $('#re_pass').val();

                   if(password1 != password2)
                   {
                      $.alert({
                          theme: 'black',
                          title: 'Password do not match!',
                          content: ''
                            });
                     return false;
                   }
                   else
                   {
                      var user_edit = $("#edit_id").val();
                      var add_data = 'new_password='+password1+'&user_id_pass='+user_edit; 
                      
                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "change_password.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if(response==1)
                                          {
                                            
                                            alert('Change password Complete!');
                                            $("#edit-password").modal('hide');
                                          }else
                                          {
                                            alert('Change password failed!');
                                          }

                                        }

                                        });
                       
                   }
                 }



                });

      $('#submit_edit').click(function(e)
                {

                  e.preventDefault();
        if($('#f_name_edit').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter first name!',
                content: ''
                  });

        return false;

       
      }
      if($('#l_name_edit').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter last name!',
                content: ''
                  });

        return false;

       
      }
      if($('#n_name_edit').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter nickname!',
                content: ''
                  });

        return false;

       
      }
      if($('#email_edit').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter Email!',
                content: ''
                  });

        return false;

       
      }
       if($('#sel_team_edit').val()=='')
      {
        $.alert({
                theme: 'black',
                title: 'Please select team!',
                content: ''
                  });

        return false;

       
      }
      if($('#username_edit').val().length==0) 
      {
         $.alert({
                theme: 'black',
                title: 'Please enter username!',
                content: ''
                  });
            return false;
      }
      
       if($("#edit-user-old").val()!= $("#username_edit").val())
                  { 

                    function check_user(param)
                              {
                                  
                                  jQuery.ajax({
                                                             async: false,
                                                             type: "POST", // HTTP method POST or GET
                                                             url: "check_user.php", //Where to make Ajax calls
                                                             data:param,
                                                              success:function(response)
                                                              {  
                                                              
                                                                 $('#check_user_edit').val(response); 
                                                                 
                                                              }

                                                              });

                                

                              }


                                var username = $('#username_edit').val();
                                var add_data = 'username='+username;
                               
                                check_user(add_data);
                                var num_user = $('#check_user_edit').val();

                        if(num_user > 0)
                        {
                           $.alert({
                                  theme: 'black',
                                  title: 'Username : '+username+' is already!',
                                  content: ''
                                    });
                              return false;

                        }else
                        {

                          $( "#edit-form" ).submit();
                        }

                     
                     
                  }else{
                    $( "#edit-form" ).submit();
                  }


       });



      });
     


      </script>


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
                    Engineer Manangement
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
                  <h2>Add New Account <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form id="form_add_user" class="form-horizontal form-label-left" method="POST" action="engineer_mgmt.php">

                  <input type="hidden" id="check_user_edit" name="check_user_edit" value="" class="hidden">
                  
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required"><font color="red">*</font></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="f_name" class="form-control col-md-7 col-xs-12"  name="name"  type="text"  >
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Username <span class="required"><font color="red">*</font></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="username" name="username"  class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="check_user" name="check_user" value="" class="hidden">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password" class="control-label col-md-3">Password <span class="required"><font color="red">*</font></span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password" type="password" name="password"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password <span class="required"><font color="red">*</font></span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password2" type="password" name="password2"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <font color="red">*</font></label>
                      <p>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="radio" class="flat" name="role" id="role_admin" value="Admin" /> Admin<br/>
                     
                      <input type="radio" class="flat" name="role" id="role_user" value="User" checked="" /> User
                      </div>
                    </p>

                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="submit_add_user" type="submit" class="btn btn-success">Create</button>
                        <a href="engineer_mgmt.php" class="btn btn-primary">Cancel</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead class="headings" >
                      <tr >
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width: 15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? $i=0;
                      while ($row_engineer = mysql_fetch_array($query_sql_engineer))
                      { $i=$i+1; ?>
                      <tr id="row_<? echo $row_engineer['eng_id']; ?>" data-id="<? echo $row_engineer['eng_id']; ?>" >
                        <td><? echo $i ?></td>
                        <td>
                          <? echo $row_engineer['name'] ?>
                        </td>
                        
                        <td>
                          <? if($row_engineer['role']=='Admin') { ?>
                          <button type="button" class="btn btn-warning btn-xs"><? echo $row_engineer['role'] ?></button>

                          <? }else {?>
                          <button type="button" class="btn btn-primary btn-xs"><? echo $row_engineer['role'] ?></button>
                          <?  } ?>
                        </td>
                        <td>
                          <button  class="btn btn-info btn-xs btn_edit" data-title="<? echo $row_engineer['eng_id']."|".$row_engineer['first_name']."|".$row_engineer['last_name']."|".$row_engineer['nick_name']."|".$row_engineer['email']."|".$row_engineer['team_id']."|".$row_engineer['username']."|".$row_engineer['role']."|".$row_engineer['enable_user']; ?>"><i class="fa fa-pencil"></i> Edit </button>
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo $row_engineer['eng_id']."|".$row_engineer['first_name']."|".$row_engineer['last_name']."|".$row_engineer['nick_name']."|".$row_engineer['email']."|".$row_engineer['team_id']."|".$row_engineer['username']."|".$row_engineer['role']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
                        </td>
                      </tr>

                    <? } ?>                    
                      
                      
                    </tbody>
                  </table>


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
          <form class="form-horizontal" id="edit-form" method="POST" action="engineer_mgmt.php" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit engineer profile</h4>
            </div>
            <div class="modal-body">
                 <input type="hidden" id="edit-user-old" name="edit-user-old" value="" class="hidden">
                <input type="hidden" id="edit_id" name="edit_id" value="" class="hidden">
                <input type="hidden" id="edit-name-old" name="engineer_name_old" value="" class="hidden">
               
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="f_name_edit" name="f_name_edit" placeholder="First Name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username_edit" name="username_edit" placeholder="Username" required>
                </div>
              </div>
               <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                   <button type="button" class="btn btn-warning btn_change_pass" data-dismiss="modal">Reset Password</button>
                </div>
              </div>
              <div class="item form-group">
                      <label for="mobile" class="col-sm-2 control-label">Role <font color="red">*</font></label>
                      <p>
                      <div class="col-sm-10">
                      <input type="radio" class="flat" name="role_edit" id="role_admin_edit" value="Admin" /> Admin<br/>
                     
                      <input type="radio" class="flat" name="role_edit" id="role_user_edit" value="User" checked="" /> User
                      </div>
                    </p>

               </div>
              
             
            </div>
            
              
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="submit_edit" >Save changes</button>
            </div>
            </form>
        </div>
      </div>
    </div>


    <div class="modal fade" id="edit-password" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="form-edit-password" method="POST" action="edit_user.php" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Change Password</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="change_pass" name="change_pass" value="change" class="hidden">
                <input type="hidden" id="change-pass-id" name="change_pass_id" value="" class="hidden">
                <input type="hidden" id="user_id_pass" name="user_id_pass" value="" class="hidden">
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="new password">
                </div>
             </div>
             <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Repeat Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="re_pass" name="re_pass" placeholder="Repeat Password">
                </div>
             </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_change_pass" class="btn btn-primary">Save changes</button>
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
  


</html>
