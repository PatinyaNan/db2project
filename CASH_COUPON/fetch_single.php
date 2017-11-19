<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CASH_COUPON WHERE ID_CASH_COUPON = '".$_POST["product_id"]."' ORDER BY ID_CASH_COUPON ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
              $output["ID_CASH_COUPON"] = $row["ID_CASH_COUPON"];
              //$output["START_INSURANCE"] = $row["START_INSURANCE"];
              //$output["END_INSURANCE"] = $row["END_INSURANCE"];
              $output["CASH_PERCENT"] = $row["CASH_PERCENT"];
              //$output["START_AGE_INSURACE"] = $row["START_AGE_INSURACE"];
              //$output["END_AGE_INSURANCE"] = $row["END_AGE_INSURANCE"];
              $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
              if(isset($row["START_INSURANCE"]))
             {
               $output["START_INSURANCE"] = $row["START_INSURANCE"];
             }
             else
             {
               $output["START_INSURANCE"] = "-";
             }

             if(isset($row["END_INSURANCE"]))
             {
               $output["END_INSURANCE"] = $row["END_INSURANCE"];
             }
             else
             {
               $output["END_INSURANCE"] = "-";
             }
             if(isset($row["START_AGE_INSURACE"]))
             {
               $output["START_AGE_INSURACE"] = $row["START_AGE_INSURACE"];
             }
             else
             {
               $output["START_AGE_INSURACE"] = "-";
             }
             if(isset($row["END_AGE_INSURANCE"]))
             {
               $output["END_AGE_INSURANCE"] = $row["END_AGE_INSURANCE"];
             }
             else
             {
               $output["END_AGE_INSURANCE"] = "-";
             }

         }
         echo json_encode($output);
        }

?>
