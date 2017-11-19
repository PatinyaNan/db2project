<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_CI = 0;
         $id_ci ='';
         $data_ci = array();
         $strSQL = "SELECT ID_CI FROM CI ORDER BY ID_CI ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_ci[$row_CI] = $objResult[0];
                 $row_CI++;
             }
                 $data_ci = $data_ci[$row_CI-1];
                 $t = substr($data_ci,2);
                 $new_id = $t+1;

                 if($new_id <= 9 && $new_id >= 1){
                     $id_ci.= "CI00000".$new_id;
                  }
                 else{
                     $id_ci.= "CI0000".$new_id;
                  }

          $LIST_CI = $_POST["LIST_CI"];
          $ID_ADDITIONAL = "AD000010";
          $ID_CATEGORY_CI = $_POST["ID_CATEGORY_CI"];
          $CI_MONEY = $_POST["CI_MONEY"];

          $strSQL = "
           INSERT INTO CI(ID_CI,LIST_CI,ID_ADDITIONAL,ID_CATEGORY_CI,CI_MONEY)
           VALUES ('".$id_ci."', '".$LIST_CI."', '".$ID_ADDITIONAL."', '".$ID_CATEGORY_CI."', ".$CI_MONEY.")
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
          $ID_CI = $_POST["product_id"];
          $LIST_CI = $_POST["LIST_CI"];
          $ID_ADDITIONAL = "AD000010";
          $ID_CATEGORY_CI = $_POST["ID_CATEGORY_CI"];
          $CI_MONEY = $_POST["CI_MONEY"];

          $query = "
           UPDATE CI
           SET ID_CI = '".$ID_CI."',
           LIST_CI = '".$LIST_CI."',
           ID_ADDITIONAL = '".$ID_ADDITIONAL."',
           ID_CATEGORY_CI = '".$ID_CATEGORY_CI."',
           CI_MONEY = ".$CI_MONEY."
           WHERE ID_CI = '".$_POST["product_id"]."'
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
