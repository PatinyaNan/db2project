<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM DEATH_BENEFIT WHERE ID_DEATH_BENEFIT = '".$_POST["product_id"]."' ORDER BY ID_DEATH_BENEFIT ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_DEATH_BENEFIT"] = $row["ID_DEATH_BENEFIT"];
            // $output["DE_START_INSURANCE"] = $row["DE_START_INSURANCE"];
            // $output["DE_END_INSURANCE"] = $row["DE_END_INSURANCE"];
             $output["DE_PERCENT"] = $row["DE_PERCENT"];
             //$output["DE_START_AGE"] = $row["DE_START_AGE"];
             //$output["DE_END_AGE"] = $row["DE_END_AGE"];
             //$output["DE_MONEY"] = $row["DE_MONEY"];
             $output["ID_INSURANCE"] = $row["ID_INSURANCE"];

             if(isset($row["DE_START_INSURANCE"]))
             {
               $output["DE_START_INSURANCE"] = $row["DE_START_INSURANCE"];
             }
             else
             {
               $output["DE_START_INSURANCE"] = "-";
             }

             if(isset($row["DE_END_INSURANCE"]))
             {
               $output["DE_END_INSURANCE"] = $row["DE_END_INSURANCE"];
             }
             else
             {
               $output["DE_END_INSURANCE"] = "-";
             }
             if(isset($row["DE_START_AGE"]))
             {
               $output["DE_START_AGE"] = $row["DE_START_AGE"];
             }
             else
             {
               $output["DE_START_AGE"] = "-";
             }
             if(isset($row["DE_END_AGE"]))
             {
               $output["DE_END_AGE"] = $row["DE_END_AGE"];
             }
             else
             {
               $output["DE_END_AGE"] = "-";
             }
             if(isset($row["DE_MONEY"]))
             {
               $output["DE_MONEY"] = $row["DE_MONEY"];
             }
             else
             {
               $output["DE_MONEY"] = "-";
             }

         }
         echo json_encode($output);
        }

?>
