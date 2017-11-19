
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM PROMOTION WHERE ID_PROMOTION = '".$_POST["product_id"]."' ORDER BY ID_PROMOTION ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_PROMOTION"] = $row["ID_PROMOTION"];
             $output["PR_START_DATE"] = $row["PR_START_DATE"];
             $output["PR_END_DATE"] = $row["PR_END_DATE"];
             $output["PR_PRODUCT"] = $row["PR_PRODUCT"];
         }
         echo json_encode($output);
        }

?>
