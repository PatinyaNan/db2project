<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_category = 0;
         $id_category ='';
         $data_category = array();
         $strSQL = "SELECT ID_CATEGORY FROM CATEGORY ORDER BY ID_CATEGORY ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_category[$row_category] = $objResult[0];
                 $row_category++;
             }
                 $data_category = $data_category[$row_category-1];
                 $t = substr($data_category,2);
                 $new_id = $t+1;

                 if($new_id <= 9 && $new_id >= 1){
                     $id_category.= "CA00000".$new_id;
                  }
                else{
                    $id_category.= "CA0000".$new_id;
                  }

          $CA_NAME = $_POST["CA_NAME"];
          $strSQL = "
           INSERT INTO CATEGORY(ID_CATEGORY,CA_NAME)
           VALUES ('".$id_category."', '".$CA_NAME."')
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
          $ID_CATEGORY = $_POST["product_id"];
          $CA_NAME = $_POST["CA_NAME"];

          $query = "
           UPDATE CATEGORY
           SET ID_CATEGORY = '".$ID_CATEGORY."',
           CA_NAME = '".$CA_NAME."'
           WHERE ID_CATEGORY = '".$_POST["product_id"]."'
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
