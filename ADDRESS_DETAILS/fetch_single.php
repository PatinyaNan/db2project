
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM ADDRESS_DETAILS WHERE ID_ADDRESS_DETAILS = '".$_POST["product_id"]."' ORDER BY ID_ADDRESS_DETAILS ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_ADDRESS_DETAILS"] = $row["ID_ADDRESS_DETAILS"];
             $output["ID_ADDRESS_CUS"] = $row["ID_ADDRESS_CUS"];
             $output["ID_CUSTOMER"] = $row["ID_CUSTOMER"];
         }
         echo json_encode($output);
        }

?>
