<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM BENEFITS_TREATMENT WHERE ID_BENEFITS_TREATMENT = '".$_POST["product_id"]."' ORDER BY ID_BENEFITS_TREATMENT ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_BENEFITS_TREATMENT"] = $row["ID_BENEFITS_TREATMENT"];
             $output["LIST_BENEFITS"] = $row["LIST_BENEFITS"];
             $output["ID_ADDITIONAL"] = $row["ID_ADDITIONAL"];
             $output["ID_TREATMENT_PLAN"] = $row["ID_TREATMENT_PLAN"];
             $output["BENEFITS_MONEY"] = $row["BENEFITS_MONEY"];
         }
         echo json_encode($output);
        }

?>
