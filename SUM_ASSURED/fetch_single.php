<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM SUM_ASSURED WHERE ID_SUM_ASSURED = '".$_POST["product_id"]."' ORDER BY ID_SUM_ASSURED ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_SUM_ASSURED"] = $row["ID_SUM_ASSURED"];
            // $output["MINIMUM_SUM_ASSURED"] = $row["MINIMUM_SUM_ASSURED"];
             $output["PAYMENT_TERM"] = $row["PAYMENT_TERM"];
             $output["COVERAGE_TERM"] = $row["COVERAGE_TERM"];
             //$output["MAXIMUM_SUM_ASSURED"] = $row["MAXIMUM_SUM_ASSURED"];
             //$output["DISCOUNT"] = $row["DISCOUNT"];
             $output["ID_INSURANCE"] = $row["ID_INSURANCE"];

             if(isset($row["MINIMUM_SUM_ASSURED"]))
             {
               $output["MINIMUM_SUM_ASSURED"] = $row["MINIMUM_SUM_ASSURED"];
             }
             else
             {
               $output["MINIMUM_SUM_ASSURED"] = "-";
             }

             if(isset($row["MAXIMUM_SUM_ASSURED"]))
             {
               $output["MAXIMUM_SUM_ASSURED"] = $row["MAXIMUM_SUM_ASSURED"];
             }
             else
             {
               $output["MAXIMUM_SUM_ASSURED"] = "-";
             }
             if(isset($row["DISCOUNT"]))
             {
               $output["DISCOUNT"] = $row["DISCOUNT"];
             }
             else
             {
               $output["DISCOUNT"] = "-";
             }

         }
         echo json_encode($output);
        }

?>
