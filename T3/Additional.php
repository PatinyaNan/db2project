<?php

 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
 $connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');

    $categorie_id1 = isset($_POST['ID_INSURANCE']) ? $_POST['ID_INSURANCE'] : "";
        $output1='';
        $Query2="SELECT DISTINCT(B.ID_ADDITIONAL),C.NAME_ADDITIONAL FROM INSURANCE A INNER JOIN ADDITIONAL_DETAILS B ON (A.ID_INSURANCE = B.ID_INSURANCE) INNER JOIN ADDITIONAL C ON (B.ID_ADDITIONAL = C.ID_ADDITIONAL)WHERE A.ID_INSURANCE='{$categorie_id1}' ORDER BY B.ID_ADDITIONAL ASC";
        $sql_row3 = oci_parse($connection, $Query2);
        oci_execute ($sql_row3,OCI_DEFAULT);
        $output1.= "<option value=\"\">เลือกสัญญาเพิ่มเติม</option>";
            while($Result1 = oci_fetch_array($sql_row3,OCI_BOTH))
            {
                $output1.= "<option value=\"" . $Result1['ID_ADDITIONAL'] . "\">" . $Result1['NAME_ADDITIONAL'] . "</option>";
             }
             echo $output1;

?>
