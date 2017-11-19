
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM ADDRESS_CUSTOMER WHERE ID_ADDRESS_CUS = '".$_POST["product_id"]."' ORDER BY ID_ADDRESS_CUS ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_ADDRESS_CUS"] = $row["ID_ADDRESS_CUS"];
             $output["HOUSE_NUMBER"] = $row["HOUSE_NUMBER"];
             $output["DISTRICT"] = $row["DISTRICT"];
             $output["COUNTY"] = $row["COUNTY"];
             $output["PROVICE"] = $row["PROVICE"];
             $output["ZIP_CODE_CUS"] = $row["ZIP_CODE_CUS"];
         }
         echo json_encode($output);
        }

?>
