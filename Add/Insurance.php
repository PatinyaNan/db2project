<?php

 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
 $connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');

$categorie_id = isset($_POST['ID_CATEGORY']) ? $_POST['ID_CATEGORY'] : "";
$Query="SELECT * FROM INSURANCE  WHERE ID_CATEGORY='{$categorie_id}'";
$sql_row1 = oci_parse($connection, $Query);
oci_execute ($sql_row1,OCI_DEFAULT);

    while($Result = oci_fetch_array($sql_row1,OCI_BOTH))
    {
        echo "<option value=\"" . $Result['ID_INSURANCE'] . "\">" . $Result['IN_NAME'] . "</option>";
    }

?>
