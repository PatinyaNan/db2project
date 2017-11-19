<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM ISSUE_AGE WHERE ID_ISSUE_AGE = '".$_POST["product_id"]."' ORDER BY ID_ISSUE_AGE ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_ISSUE_AGE"] = $row["ID_ISSUE_AGE"];
            // $output["START_AGE_MONTH"] = $row["START_AGE_MONTH"];
             //$output["END_AGE_MONTH"] = $row["END_AGE_MONTH"];
             //$output["START_AGE_PREMIUM"] = $row["START_AGE_PREMIUM"];
             //$output["END_AGE_PREMIUM"] = $row["END_AGE_PREMIUM"];
             $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
             if(isset($row["START_AGE_MONTH"]))
             {
               $output["START_AGE_MONTH"] = $row["START_AGE_MONTH"];
             }
             else
             {
               $output["START_AGE_MONTH"] = "-";
             }

             if(isset($row["END_AGE_MONTH"]))
             {
               $output["END_AGE_MONTH"] = $row["END_AGE_MONTH"];
             }
             else
             {
               $output["END_AGE_MONTH"] = "-";
             }
             if(isset($row["END_AGE_PREMIUM"]))
             {
               $output["END_AGE_PREMIUM"] = $row["END_AGE_PREMIUM"];
             }
             else
             {
               $output["END_AGE_PREMIUM"] = "-";
             }

         }
         echo json_encode($output);
        }

?>
