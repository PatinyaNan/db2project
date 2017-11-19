<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM HOSPITAL_NETWORK WHERE ID_HOSPITAL_NETWORK = '".$_POST["product_id"]."' ORDER BY ID_HOSPITAL_NETWORK ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_HOSPITAL_NETWORK"] = $row["ID_HOSPITAL_NETWORK"];
             $output["HOS_NAME"] = $row["HOS_NAME"];
             $output["HOS_ADDRESS"] = $row["HOS_ADDRESS"];
             $output["HOS_PHONE_NUMBER"] = $row["HOS_PHONE_NUMBER"];
             $output["HOS_SECTOR"] = $row["HOS_SECTOR"];
             $output["HOS_COUNTY"] = $row["HOS_COUNTY"];
         }
         echo json_encode($output);
        }

?>
