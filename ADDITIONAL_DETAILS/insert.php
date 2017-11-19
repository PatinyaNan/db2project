<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_additional_details = 0;
         $id_additional_details ='';
         $data_additional_details = array();
         $strSQL = "SELECT ID_ADDITIONAL_DETAILS FROM ADDITIONAL_DETAILS ORDER BY ID_ADDITIONAL_DETAILS ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_additional_details[$row_additional_details] = $objResult[0];
                 $row_additional_details++;
             }
                 $data_additional_details = $data_additional_details[$row_additional_details-1];
                 $t = substr($data_additional_details,2);
                 $new_id = $t+1;
                 if($new_id <= 199 && $new_id >= 100 ){
                     $id_additional_details.= "DE000".$new_id;
                  }
                 else{
                    $id_additional_details.= "DE00".$new_id;
                  }

          $ID_ADDITIONAL = $_POST["ID_ADDITIONAL"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $ID_CONDITION_ADDITIONAL = $_POST["ID_CONDITION_ADDITIONAL"];
          $strSQL = "
           INSERT INTO ADDITIONAL_DETAILS(ID_ADDITIONAL_DETAILS,ID_ADDITIONAL,ID_INSURANCE,ID_CONDITION_ADDITIONAL)
           VALUES ('".$id_additional_details."', '".$ID_ADDITIONAL."', '".$ID_INSURANCE."', '".$ID_CONDITION_ADDITIONAL."')
          ";
          //echo $strSQL;
          $objParse1 = oci_parse($connection, $strSQL);
          $objExecute = oci_execute ($objParse1,OCI_DEFAULT);
              if($objExecute)
              {
                    oci_commit($connection);
                    echo 'Product Inserted';
              }
              else{
                    echo "Error Save [".$strSQL."";
              }
    }
     if($_POST["operation"] == "Edit")
     {
          $ID_ADDITIONAL_DETAILS = $_POST["product_id"];
          $ID_ADDITIONAL = $_POST["ID_ADDITIONAL"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $ID_CONDITION_ADDITIONAL = $_POST["ID_CONDITION_ADDITIONAL"];

          $query = "
           UPDATE ADDITIONAL_DETAILS
           SET ID_ADDITIONAL_DETAILS = '".$ID_ADDITIONAL_DETAILS."',
           ID_ADDITIONAL = '".$ID_ADDITIONAL."',
           ID_INSURANCE = '".$ID_INSURANCE."',
           ID_CONDITION_ADDITIONAL = '".$ID_CONDITION_ADDITIONAL."'
           WHERE ID_ADDITIONAL_DETAILS = '".$_POST["product_id"]."'
          ";
           $objParse1 = oci_parse($connection, $query);
           oci_execute($objParse1, OCI_DEFAULT);
              if(oci_commit($connection))
              {
                  oci_commit($connection);
                  echo 'Product Updated';
                  //echo $query;
              }
         }
}
?>
