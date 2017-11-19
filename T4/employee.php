<?php

/*
 * connection database
 */
 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
 $connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');
/*
 * check POST
 */
$categorie_id = isset($_POST['EMPLOYEEID']) ? $_POST['EMPLOYEEID'] : "";
$Query="SELECT * FROM EMPLOYEE.EMPLOYEE  WHERE EMPLOYEE.EMPLOYEEID='{$categorie_id}'";
$sql_row1 = oci_parse($connection, $Query);
oci_execute ($sql_row1,OCI_DEFAULT);

    while($Result = oci_fetch_array($sql_row1,OCI_BOTH))
    {
        echo "<option value=\"" . $Result['EMPLOYEEID'] . "\">" . $Result['FIRSTNAME'] . "  " . $Result['LASTNAME'] . "</option>";
    }


    //$categorie_id1 = isset($_POST['ID_INSURANCE']) ? $_POST['ID_INSURANCE'] : "";
    /*$Query1="SELECT * FROM INSURANCE WHERE ID_INSURANCE='{$categorie_id1}'";
    $sql_row2 = oci_parse($connection, $Query1);
    oci_execute ($sql_row2,OCI_DEFAULT);

        while($Result = oci_fetch_array($sql_row2,OCI_BOTH))
        {
            echo "<option value=\"" . $Result['ID_INSURANCE'] . "\">" . $Result['INSURANCE_AFFILIATION'] . "</option>";
        }*/

        /*$Query2="SELECT DISTINCT(B.ID_ADDITIONAL),C.NAME_ADDITIONAL FROM INSURANCE A INNER JOIN ADDITIONAL_DETAILS B ON (A.ID_INSURANCE = B.ID_INSURANCE) INNER JOIN ADDITIONAL C ON (B.ID_ADDITIONAL = C.ID_ADDITIONAL)WHERE A.ID_INSURANCE='{$categorie_id1}' ORDER BY B.ID_ADDITIONAL ASC";
        $sql_row3 = oci_parse($connection, $Query2);
        oci_execute ($sql_row3,OCI_DEFAULT);
            while($Result1 = oci_fetch_array($sql_row3,OCI_BOTH))
            {
                echo "<option value=\"" . $Result1['ID_ADDITIONAL'] . "\">" . $Result1['NAME_ADDITIONAL'] . "</option>";
             }*
            ?>
