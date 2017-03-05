

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

<script type="text/javascript">
  $('document').ready(function(){
    $("#user").val('');
    $("#password").val('');
    $("#user").focus();

     $("#btn_login").click(function() {    

             login();

           
           });
     $("#login").keypress(function (e) {
             
              
              if (e.which == 13) {
                 login();

              }
                  

    });

     function login(){
      
        $("#btn_login").hide(); 
         $("#LoadingImage").show();
        if($("#user").val().length < 5)
                    {
                     $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Please enter a username is least 5 characters',
                              confirm: function(){
                                $("#btn_login").show(); 
                                $("#LoadingImage").hide();
                            }
                              
                          });
  
                      

                    }
        else if($("#password").val().length < 8)
                    {
                     $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Please enter a password is least 8 characters',
                              confirm: function(){
                                $("#btn_login").show(); 
                                $("#LoadingImage").hide();
                              }
                              
                          });

                      

                    }
      else{

          var myData = 'user='+ $("#user").val()+'&password='+$("#password").val();
                 
                 jQuery.ajax({
                 type: "POST", // HTTP method POST or GET
                 dataType:"text",
                 url: "login_process.php", //Where to make Ajax calls
                 data:myData, //Form variables
                 success:function(response){
                    var info = response.split('_');
                    var role = info[1];
                   
                    if(info[0]=='ok')
                    {
                      $.alert({
                              keyboardEnabled: true,
                              title: 'Welcome',
                              content: 'User : '+'<font color=blue>'+$("#user").val()+'</font>',
                              confirm: function(){
                                
                                setTimeout(' window.location.href = "index.php"; ',1000);
                                
                            }
                              
                          });
                    }
                    else if(response=='invalid')
                    {
                      $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Username or password does not exist',
                              confirm: function(){
                                 location.href = location.href;
                                
                            }
                              
                          });

                    }else if(response=='empty')
                    {
                        $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Login failed',
                              confirm: function(){
                                 location.href = location.href;
                                
                            }
                              
                          });
                    }
                    else
                    {
                      location.href = location.href;
                    }

                      


                  }
             });
          }
    }; 


   
});
</script>

</head>

<body style="background-image: url('images/bg_credit.jpg');background-repeat:no-repeat;
background-size:100%;
">

  <div class="">
   

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form  class="form-signin" method="post" id="login-form">
            <h1 ><font color="white" style="text-shadow: 2px 4px 3px #142025;" ><i>Login</font></i></h1>
            <div>
              <input type="text" class="form-control" id="user" name="user" placeholder="Username"  />
            </div>
            <div>
              <input type="password" class="form-control" id="password" name="password"  placeholder="Password"  />
            </div>
            <div id="div_login">
              <button type="button" id="btn_login" class="btn btn-default" >Log in</button>
              <img src="images/loading.gif" id="LoadingImage" style="display:none" height="42" width="42" />
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              
              <div class="clearfix"></div>
              <br />
              <div>
                <h2><font color="white" style="text-shadow: 2px 4px 3px #142025;"></font></h2>

                
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
     
    </div>
  </div>

</body>

 <script src="js/bootstrap.min.js"></script>

</html>
