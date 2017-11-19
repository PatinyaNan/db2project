<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM TREATMENT_PLAN WHERE ID_TREATMENT_PLAN = '".$_POST["product_id"]."' ORDER BY ID_TREATMENT_PLAN ASC";
    //  echo $strSQL;
     $objParse5 = oci_parse($connection, $strSQL);
     oci_execute ($objParse5,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse5,OCI_BOTH))
         {
              $output["ID_TREATMENT_PLAN"] = $row["ID_TREATMENT_PLAN"];
              $output["NAME_PLAN"] = $row["NAME_PLAN"];
         }
         echo json_encode($output);
        }

?>
