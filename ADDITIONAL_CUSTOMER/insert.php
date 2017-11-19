<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_add_detail = 0;
         $id_add_detail ='';
         $data_add_detail = array();
         $strSQL = "SELECT ID_ADDITIONAL_CUSTOMER FROM ADDITIONAL_CUSTOMER ORDER BY ID_ADDITIONAL_CUSTOMER ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_add_detail[$row_add_detail] = $objResult[0];
                 $row_add_detail++;
             }
                 $data_add_detail = $data_add_detail[$row_add_detail-1];
                 $t = substr($data_add_detail,3);
                 $new_id = $t+1;

                     $id_add_detail.= "ADC".$new_id;

          $ID_SELL_DETAILS = $_POST["ID_SELL_DETAILS"];
          $ID_ADDITIONAL = $_POST["ID_ADDITIONAL"];
          $strSQL = "
           INSERT INTO ADDITIONAL_CUSTOMER(ID_ADDITIONAL_CUSTOMER,ID_SELL_DETAILS,ID_ADDITIONAL)
           VALUES ('".$id_add_detail."', '".$ID_SELL_DETAILS."', '".$ID_ADDITIONAL."')
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
          $ID_ADDITIONAL_CUSTOMER = $_POST["product_id"];
          $ID_SELL_DETAILS = $_POST["ID_SELL_DETAILS"];
          $ID_ADDITIONAL = $_POST["ID_ADDITIONAL"];

          $query = "
           UPDATE ADDITIONAL_CUSTOMER
           SET ID_ADDITIONAL_CUSTOMER = '".$ID_ADDITIONAL_CUSTOMER."',
           ID_SELL_DETAILS = '".$ID_SELL_DETAILS."',
           ID_ADDITIONAL = '".$ID_ADDITIONAL."'
           WHERE ID_ADDITIONAL_CUSTOMER = '".$_POST["product_id"]."'
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
