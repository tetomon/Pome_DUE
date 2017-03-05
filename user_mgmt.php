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

   $sql_user = "SELECT * from user_tb" ;
   $query_sql_user= mysql_query($sql_user) or die('Can not query user');
   
   if(isset($_POST['username']) && isset($_POST['password']))
  {
     $insert_user = "INSERT INTO `user_tb`
             (`name`,`username`,`password`,`role`)
             VALUES
             ('".$_POST['name']."','".$_POST['username']."','".$_POST['password']."','".$_POST['role']."')";
             $query_insert_user = mysql_query($insert_user) or die("Could not insert user");

      if(isset($query_insert_user))
      {
        echo "<script>alert('Add user complete!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=user_mgmt.php'>"; 

      }else
      {
        echo "<script>alert('Add user failed!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=user_mgmt.php'>"; 

      }
  }
  
  ?>
  <?
if(isset($_POST['name_edit']) && isset($_POST['username_edit']))
  {
           $update_user = "UPDATE user_tb SET ";
            $update_user .="name = '".$_POST['name_edit']."' ";
            $update_user .=",username = '".$_POST['username_edit']."' ";
            $update_user .=",role = '".$_POST['role_edit']."' ";
            $update_user .="WHERE user_id = '".$_POST['edit_id']."' ";
            $query_update_user = mysql_query($update_user) or die('Can not edit user');
      if(isset($query_update_user))
        {
        echo "<script>alert('Edit user complete!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=user_mgmt.php'>"; 

      }else
      {
        echo "<script>alert('Edit user failed!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=user_mgmt.php'>"; 

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
                              content: 'Cannot delete this user',
                              
                          });
                   return false;
               } 

                          $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Delete user : '+ info[1],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,
                                    confirm: function () 
                                    {
                                      var add_data = 'user_id='+info[0];  
                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_user.php", //Where to make Ajax calls
                                       dataType:"text",
                                       data:add_data,
                                        success:function(response)
                                        {
                                          if(response == 1)
                                          {
                                          $('#row_'+id).fadeOut();
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
        if($('#name').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter name!',
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
                $("#username_edit").val(info[2]) ;
                $("#edit-user-old").val(info[2]) ;
                if(info[3]=="Admin"){
                 $( "#role_admin_edit" ).prop( "checked", true );
                }else{
                  $( "#role_user_edit" ).prop( "checked", true );
                }

                });

      $('#submit_edit').click(function(e)
                {

                  e.preventDefault();
        if($('#name_edit').val().length==0)
      {
        $.alert({
                theme: 'black',
                title: 'Please enter name!',
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
      }else
      {
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
                    User Manangement
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

                  <form id="form_add_user" class="form-horizontal form-label-left" method="POST" action="user_mgmt.php">

                  <input type="hidden" id="check_user_edit" name="check_user_edit" value="" class="hidden">
                  
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required"><font color="red">*</font></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12"  name="name"  type="text"  >
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
                        <a href="user_mgmt.php" class="btn btn-primary">Cancel</a>
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
                        
                        <th style="width: 15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? $i=0;
                      while ($row_user = mysql_fetch_array($query_sql_user))
                      { $i=$i+1; ?>
                      <tr id="row_<? echo $row_user['user_id']; ?>" data-id="<? echo $row_user['user_id']; ?>" >
                        <td><? echo $i ?></td>
                        <td>
                          <? echo $row_user['name'] ?>
                        </td>
                         <td>
                          <? echo $row_user['username'] ?>
                        </td>
                        <td>
                          <? if($row_user['role']=='Admin') { ?>
                          <button type="button" class="btn btn-warning btn-xs"><? echo $row_user['role'] ?></button>

                          <? }else {?>
                          <button type="button" class="btn btn-primary btn-xs"><? echo $row_user['role'] ?></button>
                          <?  } ?>
                        </td>
                        <td>
                          <button  class="btn btn-info btn-xs btn_edit" data-title="<? echo $row_user['user_id']."|".$row_user['name']."|".$row_user['username']."|".$row_user['role']; ?>"><i class="fa fa-pencil"></i> Edit </button>
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo  $row_user['user_id']."|".$row_user['name']."|".$row_user['username']."|".$row_user['role']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
          <form class="form-horizontal" id="edit-form" method="POST" action="user_mgmt.php" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit user profile</h4>
            </div>
            <div class="modal-body">
                 <input type="hidden" id="edit-user-old" name="edit-user-old" value="" class="hidden">
                <input type="hidden" id="edit_id" name="edit_id" value="" class="hidden">
                <input type="hidden" id="edit-name-old" name="user_name_old" value="" class="hidden">
               
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name_edit" name="name_edit" placeholder="Name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username_edit" name="username_edit" placeholder="Username" required>
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
