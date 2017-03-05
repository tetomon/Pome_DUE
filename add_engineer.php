<? 
date_default_timezone_set("Asia/Bangkok");


   $current_date = date('Y-M-d');
   $current_time = date('H:i:s');
   

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

  if(isset($_POST['username']) &&isset($_POST['password']))
  {
     $insert_user = "INSERT INTO `user_tb`
             (`name`,`username`,`password`,`role`)
             VALUES
             ('".$_POST['name']."','".$_POST['username']."','".$_POST['password']."','".$_POST['role']."')";
             $query_insert_user = mysql_query($insert_user) or die("Could not insert user");
      if(isset($query_insert_user))
      {
        echo "<script>alert('Add user complete!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=add_user.php'>"; 

      }else
      {
        echo "<script>alert('Add place failed!'); </script>"; 

             print "<meta http-equiv='refresh' content='0;URL=add_user.php'>"; 

      }
  }
  ?>

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
                    User Mananagement
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

                  <form id="form_add_user" class="form-horizontal form-label-left" method="POST" action="add_user.php">


                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required"><font color="red">*</font></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12"  name="name" required="required" type="text"  >
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
                        <button id="submit_add_user" type="submit" class="btn btn-success">Submit</button>
                        <a href="add_user.php" class="btn btn-primary">Cancel</a>
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
                         <th>Nickname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th style="width: 20%">Action</th>
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
                          <? echo $row_user['nickname'] ?>
                        </td>
                        <td>
                          <? echo $row_user['username'] ?>
                        </td>
                        <td>
                          <? echo $row_user['password'] ?>
                        </td>
                        <td>
                          <? if($row_user['role']=='Admin') { ?>
                          <button type="button" class="btn btn-warning btn-xs"><? echo $row_user['role'] ?></button>

                          <? }else {?>
                          <button type="button" class="btn btn-primary btn-xs"><? echo $row_user['role'] ?></button>
                          <?  } ?>
                        </td>
                        <td>
                          <button  class="btn btn-info btn-xs btn_edit" data-title="<? echo $row_user['user_id']."-".$row_user['name']."-".$row_user['username']."-".$row_user['password']."-".$row_user['role']; ?>"><i class="fa fa-pencil"></i> Edit </button>
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo $row_user['user_id']."-".$row_user['name']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
        function check_user(param)
        {
            
            jQuery.ajax({
                                       async: false,
                                       type: "POST", // HTTP method POST or GET
                                       url: "check_user.php", //Where to make Ajax calls
                                       data:param,
                                        success:function(response)
                                        {  
                                        
                                           $('#check_user').val(response); 
                                           
                                        }

                                        });

          

        }


          var username = $('#username').val();
          var add_data = 'username='+username;
          check_user(add_data);
          var num_user = $('#check_user').val();
          
          
          if($('#username').val().length < 5)
        {
             $.alert({
                theme: 'black',
                title: 'You entered new username least 5 characters!',
                content: ''
                  });
            return false;
        }else if(num_user >0)
         {
          $.alert({
                theme: 'black',
                title: 'Username : '+username+' is already!',
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
      
    
  
});

  </script>


</html>
