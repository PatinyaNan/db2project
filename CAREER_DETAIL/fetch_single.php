<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM CAREER_DETAIL WHERE ID_CAREER_DETAIL = '".$_POST["product_id"]."' ORDER BY ID_CAREER_DETAIL ASC";
     echo $strSQL;
     $objParse1 = oci_parse($connection, $strSQL);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse,OCI_BOTH))
         {
              $output["ID_CAREER_DETAIL"] = $row["ID_CAREER_DETAIL"];
              $output["ID_CAREER"] = $row["ID_CAREER"];
              $output["ID_CUSTOMER"] = $row["ID_CUSTOMER"];
              $output["CAREER_CATEGORY"] = $row["CAREER_CATEGORY"];
         }
         echo json_encode($output);
        }

?>
