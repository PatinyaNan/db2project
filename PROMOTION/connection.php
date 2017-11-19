<?php
//database.php
//$connection = mysqli_connect("localhost", "root", "", "testing1");
set_time_limit(1000000000);
ini_set('memory_limit', '25600M');
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
$connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');
?>
