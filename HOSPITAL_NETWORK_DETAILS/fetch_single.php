
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM HOSPITAL_NETWORK_DETAILS WHERE ID_HOSPITAL_NETWORK_DETAILS = '".$_POST["product_id"]."' ORDER BY ID_HOSPITAL_NETWORK_DETAILS ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_HOSPITAL_NETWORK_DETAILS"] = $row["ID_HOSPITAL_NETWORK_DETAILS"];
             $output["ID_HOSPITAL_NETWORK"] = $row["ID_HOSPITAL_NETWORK"];
             $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
         }
         echo json_encode($output);
        }

?>
