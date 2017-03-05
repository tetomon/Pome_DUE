<?php

$SETTINGS["hostname"] = 'localhost';
$SETTINGS["mysql_user"] = 'root';
$SETTINGS["mysql_pass"] = 'password';
$SETTINGS["mysql_database"] = 'pome_due_db';


/* Connect to MySQL */
$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
mysql_query("SET NAMES UTF8");
?>