<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_ci_category = 0;
         $id_ci_category ='';
         $data_ci_category = array();
         $strSQL = "SELECT ID_CATEGORY_CI FROM CI_CATEGORY ORDER BY ID_CATEGORY_CI ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_ci_category[$row_ci_category] = $objResult[0];
                 $row_ci_category++;
             }
                 $data_ci_category = $data_ci_category[$row_ci_category-1];
                 $t = substr($data_ci_category,3);
                 $new_id = $t+1;

                 if($new_id <= 9 &&  $new_id <= 1){
                     $id_ci_category.= "CIC0000".$new_id;
                }
                 else{
                     $id_ci_category.= "CIC000".$new_id;
                  }

          $CI_NAME = $_POST["CI_NAME"];

          $strSQL = "
           INSERT INTO CI_CATEGORY(ID_CATEGORY_CI,CI_NAME)
           VALUES ('".$id_ci_category."', '".$CI_NAME."')
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
          $ID_CATEGORY_CI = $_POST["product_id"];
          $CI_NAME = $_POST["CI_NAME"];

          $query = "
           UPDATE CI_CATEGORY
           SET ID_CATEGORY_CI = '".$ID_CATEGORY_CI."',
           CI_NAME = '".$CI_NAME."'
           WHERE ID_CATEGORY_CI = '".$_POST["product_id"]."'
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
