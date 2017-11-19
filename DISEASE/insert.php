<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_DISEASE = 0;
         $id_DISEASE ='';
         $data_DISEASE = array();
         $strSQL = "SELECT ID_DISEASE FROM DISEASE ORDER BY ID_DISEASE ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_DISEASE[$row_DISEASE] = $objResult[0];
                 $row_DISEASE++;
             }
                 $data_DISEASE = $data_DISEASE[$row_DISEASE-1];
                 $t = substr($data_DISEASE,3);
                 $new_id = $t+1;

                 if($new_id <= 99  && $new_id >= 10){
                     $id_DISEASE.= "DIS000".$new_id;
                  }
                  else{
                     $id_DISEASE.= "DIS00".$new_id;
                  }

          $DISEASE_NAME = $_POST["DISEASE_NAME"];

          $strSQL = "
           INSERT INTO DISEASE(ID_DISEASE,DISEASE_NAME)
           VALUES ('".$id_DISEASE."', '".$DISEASE_NAME."')
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
          $ID_DISEASE = $_POST["product_id"];
          $DISEASE_NAME = $_POST["DISEASE_NAME"];

          $query = "
           UPDATE DISEASE
           SET ID_DISEASE = '".$ID_DISEASE."',
           DISEASE_NAME = '".$DISEASE_NAME."'
           WHERE ID_DISEASE = '".$_POST["product_id"]."'
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
