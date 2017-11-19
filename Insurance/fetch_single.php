<?php
//fetch_single.php
include("connection.php");
// $_POST["product_id"] = "1";
// echo $_POST["product_id"];
if(isset($_POST["product_id"]))
{
 //$output = array();
     $strSQL = "SELECT * FROM INSURANCE WHERE ID_INSURANCE = '".$_POST["product_id"]."' ORDER BY ID_INSURANCE ASC";
     $objParse = oci_parse($connection, $strSQL);
     oci_execute ($objParse,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse,OCI_BOTH))
         {
              $output["ID_INSURANCE"] = $row["ID_INSURANCE"];
              $output["IN_NAME"] = $row["IN_NAME"];
              $output["ID_PROMOTION"] = $row["ID_PROMOTION"];
              $output["ID_CATEGORY"] = $row["ID_CATEGORY"];
              //$output["CONSIDERATION_CRITERIA"] = $row["CONSIDERATION_CRITERIA"];
              if(isset($row["TAX_BENEFITS"]))
                $output["TAX_BENEFITS"] = $row["TAX_BENEFITS"];

                else{
                $output["TAX_BENEFITS"] = "-";
                }
                if(isset($row["NOTE"]))
                  $output["NOTE"] = $row["NOTE"];

                  else{
                  $output["NOTE"] = "-";
                  }
                  if(isset($row["INSURANCE_AFFILIATION"]))
                    $output["INSURANCE_AFFILIATION"] = $row["INSURANCE_AFFILIATION"];

                    else{
                    $output["INSURANCE_AFFILIATION"] = "-";
                    }
         }
         echo json_encode($output);
        }

?>
