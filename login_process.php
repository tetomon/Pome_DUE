<?php
 session_start();
 include 'connect_db.php';
 if(isset($_POST['user']) && isset($_POST['password']))
 {
  $username = trim($_POST['user']);
  $password = trim($_POST['password']);
  
  
  
  
   $sql = "SELECT * FROM user_tb WHERE `username` = '".mysql_real_escape_string($username)."' AND `password` = '".mysql_real_escape_string($password)."'";
    $sql_result = mysql_query($sql);
    $user = mysql_fetch_assoc($sql_result);
   

   if(!empty($user))
   {
    
      echo "ok_".$user['role']; // log in
      $_SESSION['name'] = $user['name'];
      $_SESSION['user'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['user_id'] = $user['user_id'];
      
   }
   else{
    
    echo "invalid"; // wrong details 
   }
    
  
  
 }
 else
 {
  echo "empty";
 }

?>