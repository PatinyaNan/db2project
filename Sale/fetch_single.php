
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM SELL WHERE ID_SELL = '".$_POST["product_id"]."' ORDER BY ID_SELL ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_SELL"] = $row["ID_SELL"];
             $output["SELL_DATE"] = $row["SELL_DATE"];
             $output["EMPLOYEEID"] = $row["EMPLOYEEID"];
             $output["ID_CUSTOMER"] = $row["ID_CUSTOMER"];
         }
         echo json_encode($output);
        }

?>
