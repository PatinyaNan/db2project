<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_ci_details = 0;
         $id_ci_details ='';
         $data_ci_details = array();
         $strSQL = "SELECT ID_CI_DETAILS FROM CI_DETAILS ORDER BY ID_CI_DETAILS ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_ci_details[$row_ci_details] = $objResult[0];
                 $row_ci_details++;
             }
                 $data_ci_details = $data_ci_details[$row_ci_details-1];
                 $t = substr($data_ci_details,3);
                 $new_id = $t+1;

                 if($new_id <= 999 && $new_id >= 1){
                     $id_ci_details.= "CID00".$new_id;
                 }
                 else{
                     $id_ci_details.= "CID0".$new_id;
                 }

          $ID_CI = $_POST["ID_CI"];
          $ID_DISEASE = $_POST["ID_DISEASE"];
          $strSQL = "
           INSERT INTO CI_DETAILS(ID_CI_DETAILS,ID_CI,ID_DISEASE)
           VALUES ('".$id_ci_details."', '".$ID_CI."', '".$ID_DISEASE."')
          ";
          //echo $strSQL;
          $objParse = oci_parse($connection, $strSQL);
          $objExecute = oci_execute ($objParse,OCI_DEFAULT);
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
          $ID_CI_DETAILSR = $_POST["product_id"];
          $ID_CI = $_POST["ID_CI"];
          $ID_DISEASE = $_POST["ID_DISEASE"];

          $query = "
           UPDATE CI_DETAILS
           SET ID_CI_DETAILS = '".$ID_CI_DETAILSR."',
           ID_CI = '".$ID_CI."',
           ID_DISEASE = '".$ID_DISEASE."'
           WHERE ID_CI_DETAILS = '".$_POST["product_id"]."'
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
