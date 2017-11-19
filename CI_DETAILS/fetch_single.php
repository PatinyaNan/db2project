<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CI_DETAILS WHERE ID_CI_DETAILS = '".$_POST["product_id"]."' ORDER BY ID_CI_DETAILS ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_CI_DETAILS"] = $row["ID_CI_DETAILS"];
             $output["ID_CI"] = $row["ID_CI"];
             $output["ID_DISEASE"] = $row["ID_DISEASE"];
         }
         echo json_encode($output);
        }

?>
