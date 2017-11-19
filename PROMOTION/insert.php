<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_promotion = 0;
         $id_promotion ='';
         $data_promotion = array();
         $strSQL = "SELECT ID_PROMOTION FROM PROMOTION ORDER BY ID_PROMOTION ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_promotion[$row_promotion] = $objResult[0];
                 $row_promotion++;
             }
                 $data_promotion = $data_promotion[$row_promotion-1];
                 $t = substr($data_promotion,1);
                 $new_id = $t+1;

                 if($new_id <= 99 && $new_id >= 10){
                     $id_promotion.= "P00000".$new_id;
                  }
                else{
                    $id_promotion.= "P0000".$new_id;
                  }

          $PR_START_DATE = $_POST["PR_START_DATE"];
          $PR_END_DATE = $_POST["PR_END_DATE"];
          $PR_PRODUCT = $_POST["PR_PRODUCT"];

          $strSQL = "
           INSERT INTO PROMOTION(ID_PROMOTION,PR_START_DATE,PR_END_DATE,PR_PRODUCT)
           VALUES ('".$id_promotion."', '".$PR_START_DATE."', '".$PR_END_DATE."', '".$PR_PRODUCT."')
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
          $ID_PROMOTION = $_POST["product_id"];
          $PR_START_DATE = $_POST["PR_START_DATE"];
          $PR_END_DATE = $_POST["PR_END_DATE"];
          $PR_PRODUCT = $_POST["PR_PRODUCT"];

          $query = "
           UPDATE PROMOTION
           SET ID_PROMOTION = '".$ID_PROMOTION."',
           PR_START_DATE = '".$PR_START_DATE."',
           PR_END_DATE = '".$PR_END_DATE."',
           PR_PRODUCT = '".$PR_PRODUCT."'
           WHERE ID_PROMOTION = '".$_POST["product_id"]."'
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
