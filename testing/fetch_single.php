<?php
//fetch_single.php
include("connection.php");
// $_POST["product_id"] = "1";
// echo $_POST["product_id"];
if(isset($_POST["product_id"]))
{
 //$output = array();
 $query = "SELECT * FROM ADDITIONAL WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'";
 $objParse1 = oci_parse($connection, $query);
     oci_execute ($objParse1,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse1,OCI_BOTH))
         {
              //$output["CONSIDERATION_CRITERIA"] = $row["CONSIDERATION_CRITERIA"];
              if(isset($row["ID_ADDITIONAL"]))
                $output["ID_ADDITIONAL"] = $row["ID_ADDITIONAL"];

                else{
                $output["ID_ADDITIONAL"] = "-";
                }
                if(isset($row["NAME_ADDITIONAL"]))
                  $output["NAME_ADDITIONAL"] = $row["NAME_ADDITIONAL"];

                  else{
                  $output["NAME_ADDITIONAL"] = "-";
                  }
                  if(isset($row["ID_CATEGORY"]))
                    $output["ID_CATEGORY"] = $row["ID_CATEGORY"];

                    else{
                    $output["ID_CATEGORY"] = "-";
                    }
                    if(isset($row["COVERAGE_STYLE"]))
                      $output["COVERAGE_STYLE"] = $row["COVERAGE_STYLE"];

                      else{
                      $output["COVERAGE_STYLE"] = "-";
                      }
         }
         echo json_encode($output);
        }

?>
