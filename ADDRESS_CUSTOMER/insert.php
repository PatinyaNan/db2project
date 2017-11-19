<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_address_cus = 0;
         $id__address_cus ='';
         $data__address_cus = array();
         $strSQL = "SELECT ID_ADDRESS_CUS FROM ADDRESS_CUSTOMER";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data__address_cus[$row_address_cus] = $objResult[0];
                 $row_address_cus++;
             }
                 $data__address_cus = $data__address_cus[$row_address_cus-1];
                 $t = substr($data__address_cus,3);
                 $new_id = $t+1;

                  if($new_id <= 9999999 && $new_id >= 1000000){
                      $id__address_cus.= "ADC00".$new_id;
                   }
                else{
                    $id__address_cus.= "ADC0".$new_id;
                  }

          $HOUSE_NUMBER = $_POST["HOUSE_NUMBER"];
          $DISTRICT = $_POST["DISTRICT"];
          $COUNTY = $_POST["COUNTY"];
          $PROVICE = $_POST["PROVICE"];
          $ZIP_CODE_CUS = $_POST["ZIP_CODE_CUS"];
          $strSQL = "
           INSERT INTO ADDRESS_CUSTOMER(ID_ADDRESS_CUS,HOUSE_NUMBER,DISTRICT,COUNTY,PROVICE,ZIP_CODE_CUS)
           VALUES ('".$id__address_cus."', '".$HOUSE_NUMBER."', '".$DISTRICT."', '".$COUNTY."', '".$PROVICE."', '".$ZIP_CODE_CUS."')
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
          $ID_ADDRESS_CUS = $_POST["ID_ADDRESS_CUS"];
          $HOUSE_NUMBER = $_POST["HOUSE_NUMBER"];
          $DISTRICT = $_POST["DISTRICT"];
          $COUNTY = $_POST["COUNTY"];
          $PROVICE = $_POST["PROVICE"];
          $ZIP_CODE_CUS = $_POST["ZIP_CODE_CUS"];

          $query = "
           UPDATE ADDRESS_CUSTOMER
           SET ID_ADDRESS_CUS = '".$ID_ADDRESS_CUS."',
           HOUSE_NUMBER = '".$HOUSE_NUMBER."',
           DISTRICT = '".$DISTRICT."',
           COUNTY = '".$COUNTY."',
           PROVICE = '".$PROVICE."',
           ZIP_CODE_CUS = '".$ZIP_CODE_CUS."'
           WHERE ID_ADDRESS_CUS = '".$_POST["product_id"]."'
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
