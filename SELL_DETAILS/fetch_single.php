
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM SELL_DETAILS WHERE ID_SELL_DETAILS = '".$_POST["product_id"]."' ORDER BY ID_SELL_DETAILS ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_SELL_DETAILS"] = $row["ID_SELL_DETAILS"];
             $output["FORMAT"] = $row["FORMAT"];
             $output["SELL_PAYMENT"] = $row["SELL_PAYMENT"];
             $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
             $output["ID_SELL"] = $row["ID_SELL"];
         }
         echo json_encode($output);
        }

?>
