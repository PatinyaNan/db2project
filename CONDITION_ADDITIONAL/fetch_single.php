<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CONDITION_ADDITIONAL WHERE ID_CONDITION_ADDITIONAL = '".$_POST["product_id"]."' ORDER BY ID_CONDITION_ADDITIONAL ASC";
                //"SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
             $output["ID_CONDITION_ADDITIONAL"] = $row["ID_CONDITION_ADDITIONAL"];
             $output["CON_START_AGE"] = $row["CON_START_AGE"];
             //$output["CON_END_AGE"] = $row["CON_END_AGE"];
                if(isset($row["CON_END_AGE"]))
                {
                  $output["CON_END_AGE"] = $row["CON_END_AGE"];
                }
                else
                {
                  $output["CON_END_AGE"] = "-";
                }

        }
         echo json_encode($output);
        }

?>
