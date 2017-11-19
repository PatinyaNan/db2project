<?php

 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
 $connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');

$categorie_id = isset($_POST['EMPLOYEEID']) ? $_POST['EMPLOYEEID'] : "";
$Query="SELECT * FROM EMPLOYEE.EMPLOYEE  WHERE EMPLOYEE.EMPLOYEEID='{$categorie_id}'";
$sql_row1 = oci_parse($connection, $Query);
oci_execute ($sql_row1,OCI_DEFAULT);

    while($Result = oci_fetch_array($sql_row1,OCI_BOTH))
    {
        echo "<option value=\"" . $Result['EMPLOYEEID'] . "\">" . $Result['FIRSTNAME'] . "  " . $Result['LASTNAME'] . "</option>";
    }
?>
