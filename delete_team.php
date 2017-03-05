<?php
include 'connect_db.php';
   date_default_timezone_set("Asia/Bangkok");
   mysql_set_charset('utf8');

   //query for insert data into tables

if(isset($_POST['team_id']) && $_POST['team_id']!='')
{

   $team_id = $_POST['team_id'];


         $sql_select_engineer = "SELECT * from engineer_tb where team_id=".$team_id."";
         $query_sql_select_engineer = mysql_query($sql_select_engineer);
         $num_engineer = mysql_num_rows($query_sql_select_engineer);

         if($num_engineer  > 0)
         {
            echo 0;
         }
         else
         {

         $delete_team = "DELETE FROM team_tb WHERE team_id='".$team_id."'";
         $query_delete_team = mysql_query($delete_team) or die("Could not delete team");
        
               if(isset($query_delete_team))
               {
                  
                  echo 1;
               }

         }


          

     
   mysql_close($conn);
}

?>
