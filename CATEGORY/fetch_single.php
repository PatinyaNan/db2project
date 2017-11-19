<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CATEGORY WHERE ID_CATEGORY = '".$_POST["product_id"]."' ORDER BY ID_CATEGORY ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_CATEGORY"] = $row["ID_CATEGORY"];
             $output["CA_NAME"] = $row["CA_NAME"];
         }
         echo json_encode($output);
        }

?>
