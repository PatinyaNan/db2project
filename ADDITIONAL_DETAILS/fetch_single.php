<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM ADDITIONAL_DETAILS WHERE ID_ADDITIONAL_DETAILS = '".$_POST["product_id"]."' ORDER BY ID_ADDITIONAL_DETAILS ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
              $output["ID_ADDITIONAL_DETAILS"] = $row["ID_ADDITIONAL_DETAILS"];
              $output["ID_ADDITIONAL"] = $row["ID_ADDITIONAL"];
              $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
              $output["ID_CONDITION_ADDITIONAL"] = $row["ID_CONDITION_ADDITIONAL"];
         }
         echo json_encode($output);
        }

?>
