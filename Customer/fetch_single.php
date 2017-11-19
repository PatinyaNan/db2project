
<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CUSTOMER WHERE ID_CUSTOMER = '".$_POST["product_id"]."' ORDER BY ID_CUSTOMER ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_CUSTOMER"] = $row["ID_CUSTOMER"];
             $output["FIRST_NAME"] = $row["FIRST_NAME"];
             $output["LAST_NAME"] = $row["LAST_NAME"];
             $output["AGE"] = $row["AGE"];
            // $output["BIRTH_DAY"] = $row["BIRTH_DAY"];
             $output["GENDER"] = $row["GENDER"];
             $output["PHONE_NUMBER"] = $row["PHONE_NUMBER"];
             $output["EMAIL"] = $row["EMAIL"];
             $output["NATIONALITY"] = $row["NATIONALITY"];
             $output["STATUST"] = $row["STATUST"];
             $output["STATUST_BICYCLE"] = $row["STATUST_BICYCLE"];

         }
         echo json_encode($output);
        }

?>
