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

   $sql_customer = "SELECT * from customer_tb where customer_id!=0" ;
   $query_sql_customer = mysql_query($sql_customer) or die('Can not query customer');
   $num_customer = mysql_num_rows( $query_sql_customer);
  ?>
  <?
  if(isset($_POST['customer_name']) && $_POST['customer_name']!='')
  {

   $customer_name = $_POST['customer_name'];


        $select_customer_2 = "SELECT * FROM customer_tb WHERE customer_name='".$customer_name."'";
         
         $query_select_customer_2 = mysql_query($select_customer_2) or die("Could not select customer");

          $num_select_customer = mysql_num_rows($query_select_customer_2);
        
         if($num_select_customer == 0)
         {
             $check_customer_name = 'ok';
         }
         elseif($num_select_customer > 0)
        {
          echo "<script>alert('Customer : ".$_POST['customer_name']."  is already!'); </script>";          
          print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";
        }

        if($_POST['file_name'] != '')
        {
        $select_customer_3 = "SELECT * FROM customer_tb WHERE img_path='".$_FILES["file"]["name"]."'";
         
         $query_select_customer_3 = mysql_query($select_customer_3) or die("Could not select customer logo");

          $num_select_customer_logo = mysql_num_rows($query_select_customer_3);
        
         if($num_select_customer_logo == 0)
         {
             $check_customer_logo = 'ok';
         }
         elseif($num_select_customer_logo > 0)
        {
          echo "<script>alert('Customer image name : ".$_FILES["file"]["name"]."  is already!'); </script>";          
          print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";
        }
      }
      else
      {
        $check_customer_logo = 'empty';
      }


      if($check_customer_name == 'ok' && $check_customer_logo == 'ok')
      {
        if ( isset($_FILES["file"])  && !empty($_FILES["file"]["name"])) 
          { 
            if(!$_FILES['file']['error'])
             {
                 
                
             $allowed =  array('gif','png','jpg');
             $filename = $_FILES['file']['name'];
             $ext = pathinfo($filename, PATHINFO_EXTENSION);

             if(!in_array($ext,$allowed) ) 
              {

                  echo "<script>alert('Please select file type jpg, png, gif only'); </script>"; 
              }
              else
              { $new_file_name = strtolower($_FILES['file']['tmp_name']); //rename file
                $file_name=$_FILES['file']['name'];
               
                if($_FILES['file']['size'] > (1024000)) //can't be larger than 1 MB
                      {
                        echo "<script>alert('Failed!!! , Your file size is to large than 1 MB'); </script>"; 
                        
                      }
                else
                {
                 if(file_exists('img_customer/'.$_FILES['file']['name'])) unlink('img_customer/'.$_FILES['file']['name']);
                  
                  if(move_uploaded_file($_FILES['file']['tmp_name'], 'img_customer/'.$_FILES['file']['name']))
                    {
                      $insert_customer = "INSERT INTO `customer_tb`
                       (`customer_name`,`img_path`)
                       VALUES
                       ('".$_POST['customer_name']."','".$_FILES['file']['name']."')";
                       
                       $query_insert_customer = mysql_query($insert_customer) or die("Could not insert customer");

                       echo "<script>alert('Add customer complete!'); </script>"; 

                       print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";  
                              }
                    else {
                        echo "<script>alert('Copy image failed!'); </script>"; 
                    }
                }

              }
            }
              
          }
      }
      else if($check_customer_name == 'ok' && $check_customer_logo == 'empty')
      {
          $insert_customer = "INSERT INTO `customer_tb`
                       (`customer_name`)
                       VALUES
                       ('".$_POST['customer_name']."')";
                       
                       $query_insert_customer = mysql_query($insert_customer) or die("Could not insert customer");

                       echo "<script>alert('Add customer complete!'); </script>"; 

                       print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";  
      }

    
      
     

 }


    if(isset($_POST['edit_id']) && $_POST['edit_id']!='')
    {
        $edit_customer = $_POST['customer_name_edit'];
        $old_customer = $_POST['customer_name_old'];
        $edit_path = $_FILES['file_edit']['name'];
        $old_path = $_POST['customer_img_path_old'];
       
         
        if($edit_customer == $old_customer && $old_path == '' )
        {
            print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";
        }
        elseif($edit_customer != $old_customer)
        {
          $select_customer_4 = "SELECT * FROM customer_tb WHERE customer_name='".$edit_customer."'";
         
        $query_select_customer_4 = mysql_query($select_customer_4) or die("Could not select customer");

        $num_select_customer = mysql_num_rows($query_select_customer_4);
            if($num_select_customer > 0)
            {
                echo "<script>alert('Customer : ".$edit_customer."  is already!'); </script>";          
                print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";
            }
            elseif($num_select_customer == 0)
            {
            $update_customer = "UPDATE customer_tb SET ";
            $update_customer .="customer_name = '".$edit_customer."' ";
            $update_customer .="WHERE customer_id = '".$_POST['edit_id']."'";
            $query_update_customer = mysql_query($update_customer) or die("Could not update customer");
                if(isset($query_update_customer))
                {
      
                    
                }
            }

         
        }
        if($edit_path != "" )
            {
              
         
         $select_customer_5 = "SELECT * FROM customer_tb WHERE img_path='".$edit_path."'  AND customer_id != '".$_POST['edit_id']."'";
         
        $query_select_customer_5 = mysql_query($select_customer_5) or die("Could not select customer");

        $num_select_logo= mysql_num_rows($query_select_customer_5);
            if($num_select_logo > 0)
            {
                echo "<script>alert('Customer image name : ".$_FILES["file_edit"]["name"]."  is already!'); </script>";          
              print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";
            }
            elseif($num_select_logo == 0)
            {
           if ( isset($_FILES["file_edit"])  && !empty($_FILES["file_edit"]["name"])) 
          { 
            if(!$_FILES['file_edit']['error'])
             {
                 
                
             $allowed =  array('gif','png','jpg');
             $filename = $_FILES['file_edit']['name'];
             $ext = pathinfo($filename, PATHINFO_EXTENSION);

             if(!in_array($ext,$allowed) ) 
              {

                  echo "<script>alert('Please select file type jpg, png, gif only'); </script>"; 
              }
              else
              { $new_file_name = strtolower($_FILES['file_edit']['tmp_name']); //rename file
                $file_name=$_FILES['file_edit']['name'];
               
                if($_FILES['file_edit']['size'] > (1024000)) //can't be larger than 1 MB
                      {
                        echo "<script>alert('Failed!!! , Your file size is to large than 1 MB'); </script>"; 
                        
                      }
                else
                {
                 if(file_exists('img_customer/'.$_FILES['file_edit']['name'])) unlink('img_customer/'.$_FILES['file_edit']['name']);
                  
                  if(move_uploaded_file($_FILES['file_edit']['tmp_name'], 'img_customer/'.$_FILES['file_edit']['name']))
                    {
                       $update_customer_3 = "UPDATE customer_tb SET ";
                        $update_customer_3 .="img_path = '".$edit_path."' ";
                        $update_customer_3 .="WHERE customer_id = '".$_POST['edit_id']."'";
                        $query_update_customer_2 = mysql_query($update_customer_3) or die("Could not update customer logo");
                            if(isset($query_update_customer_2))
                            {
                          
                               echo "<script>alert('Edit Complete'); </script>"; 
                            }
                         }
                    else {
                        echo "<script>alert('Copy image failed!'); </script>"; 
                    }
                }

              }
            }
              
          }
                 
            }
              

            } 
        
print "<meta http-equiv='refresh' content='0;URL=customer_mgmt.php'>";  
    }

 
    
            

  ?>
<script type="text/javascript">
          $(document).ready(function() {
           
          document.getElementById('btn_select_file').onclick = function() {
              document.getElementById('my_file').click();
        };

        document.getElementById('btn_select_file_edit').onclick = function() {
              document.getElementById('my_file_edit').click();
        };

        $('#my_file').change(function (e) {
        $('#file_name').val($(this).val());
        });
          
        $('#my_file_edit').change(function (e) {
        $('#file_name_edit').val($(this).val());
        });
      });

    
  </script>
                 
<script>
$(function () {

  $(".btn_delete").click(function() { 
                
               
                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');
               
                          $.confirm({
                                    title: 'Are you sure?',
                                    content: 'Delete customer : '+ info[1],
                                    confirmButton: 'Confirm',
                                    confirmButtonClass: 'btn-info',
                                    icon: 'fa fa-question-circle',
                                    animation: 'scale',
                                    animationClose: 'top',
                                    opacity: 0.5,

                                    confirm: function () 
                                    {
                                      var add_data = 'customer_id='+info[0]+'&img_name='+info[2];

                                      jQuery.ajax({
                                       type: "POST", // HTTP method POST or GET
                                       url: "delete_customer.php", //Where to make Ajax calls
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
                                                      content: 'You cannot remove this customer because customer selected to create some report ticket',
                                                      
                                                  });
                                           return false;

                                          }


                                        }

                                        });
                                    }
                                });
        });

    $(".add_customer").click(function(e) { 
                  e.preventDefault();

                  var text_customer =  $("[name='customer_name']").val();
                  

                  if($("[name='customer_name']").val().length == 0)
                  {
                        
                        $.alert({
                              keyboardEnabled: true,
                              title: 'Alert!',
                              content: 'Please insert customer name!',
                              
                        });
                         
                  }
                  
                  else
                  {
                        $('#form_add_customer').submit();
                  }
                   
                 
                              
                });

     $(".btn_edit").click(function(e) { 
                  e.preventDefault();
                var tit = $(this).data('title');
                var info = tit.split('|');
                var id = $(this).closest('tr').data('id');
                $("#edit-modal").modal('show');
                $("#customer_modal").val(info[1]) ;
                $("#edit-name-old").val(info[1]) ;
                $("#edit-id").val(info[0]) ; 
                $("#edit-img_path-old").val(info[2]) ;

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
                    Customer Mananagement
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
                  <h2>Add Customer <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" id="form_add_customer" method="POST" action="customer_mgmt.php"  enctype="multipart/form-data">


                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer name <span class="required"><font color="red">*</font></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="customer" class="form-control col-md-7 col-xs-12"  name="customer_name"  type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer Image <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <input type="text" id="file_name" readonly="readonly" name="file_name"  class="form-control col-md-7 col-xs-12">
                        <input type="file" id="my_file" name="file" style="display: none;">
                        <input type="hidden"  name="submit_import" style="display: none;">
                         
                        <button type="button" class="btn btn-info" id="btn_select_file">Choose file</button>
                      </div>
                      
                      
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                       <button  type="submit" class="btn btn-success add_customer">Add Customer</button>
                        <a  href="customer_mgmt.php" class="btn btn-primary">Cancel</a>
                       
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Total customer <small></small></h2>
                  
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
                        <th class="text-center" style="width: 10%">Image</th>
                        <th class="text-center">Customers</th>
                        <th style="width: 20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                     <? $i=0;
                      while ($row_customer = mysql_fetch_array($query_sql_customer))
                      { $i=$i+1; ?>
                      <tr id="row_<? echo $row_customer['customer_id']; ?>" data-id="<? echo $row_customer['customer_id']; ?>"  >

                        <td style="vertical-align:middle" ><? echo $i ?></td>
                        <? if ($row_customer['img_path'] != '') { ?>
                        <td style="vertical-align:middle" align="center"><img src="img_customer\<?echo $row_customer['img_path']?>"  height=70 width=70></img></td>
                        <?} else {?>
                          <td style="vertical-align:middle" align="center"><img src="img_customer\no_image.jpg"  height=70 width=70></img></td>
                        <? } ?>
                        <td style="vertical-align:middle" align="center"><? echo $row_customer['customer_name']; ?></td>
                        
                        
                        
                        <td style="vertical-align:middle">
                          <button  class="btn btn-info btn-xs btn_edit " data-title="<? echo $row_customer['customer_id']."|".$row_customer['customer_name']."|".$row_customer['img_path'] ?>"><i class="fa fa-pencil"></i> Edit </button>
                          <button  class="btn btn-danger btn-xs btn_delete" data-title="<? echo $row_customer['customer_id']."|".$row_customer['customer_name']."|".$row_customer['img_path'] ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
          <form class="form-horizontal" id="edit-form" method="POST" action="customer_mgmt.php" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit customer</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" name="edit_id" value="" class="hidden">
                <input type="hidden" id="edit-name-old" name="customer_name_old" value="" class="hidden">
                <input type="hidden" id="edit-img_path-old" name="customer_img_path_old" value="" class="hidden">
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Customer name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="customer_modal" name="customer_name_edit" placeholder="customer" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Customer image</label>
                <div class="col-sm-10">
                    <input type="text" id="file_name_edit" readonly="readonly" name="file_name_edit"  class="form-control col-md-7 col-xs-12">
                        <input type="file" id="my_file_edit" name="file_edit" style="display: none;">
                        <input type="hidden"  name="submit_import" style="display: none;">
                         
                        <button type="button" class="btn btn-info" id="btn_select_file_edit">Choose file</button>
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
