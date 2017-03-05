 <?

   if(isset($_POST['date_pm']) && $_POST['date_sent']!='')
{
   
    $date_pm = $_POST['date_pm'];
   $date_sent = $_POST['date_sent'];
$date_pm_cal=date_create("$date_pm");
   $date_sent_cal=date_create("$date_sent");


if ( $date_pm_cal <= $date_sent_cal )
 {
  echo 1;
}
else 
{
  echo 0;
}
                 
                 
}

?>