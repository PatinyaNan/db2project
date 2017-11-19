<?php
//fetch_single.php
include("connection.php");
// $_POST["product_id"] = "1";
// echo $_POST["product_id"];
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CAREER WHERE ID_CAREER = '".$_POST["product_id"]."'";
     $objParse = oci_parse($connection, $strSQL);
     oci_execute ($objParse,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse,OCI_BOTH))
         {
              $output["ID_CAREER"] = $row["ID_CAREER"];
              $output["CAR_NAME"] = $row["CAR_NAME"];
         }
         echo json_encode($output);
        }

?>
