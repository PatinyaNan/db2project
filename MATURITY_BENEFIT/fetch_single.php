<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM MATURITY_BENEFIT WHERE ID_MATURITY_BENEFIT = '".$_POST["product_id"]."' ORDER BY ID_MATURITY_BENEFIT ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_MATURITY_BENEFIT"] = $row["ID_MATURITY_BENEFIT"];
             //$output["MA_END_PERCENT"] = $row["MA_END_PERCENT"];
             //$output["MA_END_INSURANCE"] = $row["MA_END_INSURANCE"];
             //$output["MA_START_PERCENT"] = $row["MA_START_PERCENT"];
             $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
             //$output["MA_END_AGE"] = $row["MA_END_AGE"];

             if(isset($row["MA_END_PERCENT"]))
             {
               $output["MA_END_PERCENT"] = $row["MA_END_PERCENT"];
             }
             else
             {
               $output["MA_END_PERCENT"] = "-";
             }

             if(isset($row["MA_END_INSURANCE"]))
             {
               $output["MA_END_INSURANCE"] = $row["MA_END_INSURANCE"];
             }
             else
             {
               $output["MA_END_INSURANCE"] = "-";
             }
             if(isset($row["MA_START_PERCENT"]))
             {
               $output["MA_START_PERCENT"] = $row["MA_START_PERCENT"];
             }
             else
             {
               $output["MA_START_PERCENT"] = "-";
             }
             if(isset($row["MA_END_AGE"]))
             {
               $output["MA_END_AGE"] = $row["MA_END_AGE"];
             }
             else
             {
               $output["MA_END_AGE"] = "-";
             }

         }
         echo json_encode($output);
        }

?>
