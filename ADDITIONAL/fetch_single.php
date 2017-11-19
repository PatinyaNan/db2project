<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."' ORDER BY ID_ADDITIONAL ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
              $output["ID_ADDITIONAL"] = $row["ID_ADDITIONAL"];
              $output["NAME_ADDITIONAL"] = $row["NAME_ADDITIONAL"];
              $output["ID_CATEGORY"] = $row["ID_CATEGORY"];
              $output["COVERAGE_STYLE"] = $row["COVERAGE_STYLE"];
         }
         echo json_encode($output);
        }

?>
