<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CI_CATEGORY WHERE ID_CATEGORY_CI = '".$_POST["product_id"]."' ORDER BY ID_CATEGORY_CI ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_CATEGORY_CI"] = $row["ID_CATEGORY_CI"];
             $output["CI_NAME"] = $row["CI_NAME"];
         }
         echo json_encode($output);
        }

?>
