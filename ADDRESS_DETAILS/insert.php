<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_address_details = 0;
         $id__address_details ='';
         $data__address_details = array();
         $strSQL = "SELECT ID_ADDRESS_DETAILS FROM ADDRESS_DETAILS ORDER BY ID_ADDRESS_DETAILS ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data__address_details[$row_address_details] = $objResult[0];
                 $row_address_details++;
             }
                 $data__address_details = $data__address_details[$row_address_details-1];
                 $t = substr($data__address_details,3);
                 $new_id = $t+1;

                     $id__address_details.= "ADD".$new_id;

          $ID_ADDRESS_CUS = $_POST["ID_ADDRESS_CUS"];
          $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
          $strSQL = "
           INSERT INTO CUSTOMER(ID_CUSTOMER,FIRST_NAME,LAST_NAME)
           VALUES ('".$id__address_details."', '".$ID_ADDRESS_CUS."', '".$ID_CUSTOMER."')
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
          $ID_ADDRESS_DETAILS = $_POST["product_id"];
          $ID_ADDRESS_CUS = $_POST["ID_ADDRESS_CUS"];
          $ID_CUSTOMER = $_POST["ID_CUSTOMER"];

          $query = "
           UPDATE ADDRESS_DETAILS
           SET ID_ADDRESS_DETAILS = '".$ID_ADDRESS_DETAILS."',
           ID_ADDRESS_CUS = '".$ID_ADDRESS_CUS."',
           ID_CUSTOMER = '".$ID_CUSTOMER."'
           WHERE ID_ADDRESS_DETAILS = '".$_POST["product_id"]."'
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
