<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_cus = 0;
         $id_cus ='';
         $data_customer = array();
         $strSQL = "SELECT ID_CUSTOMER FROM CUSTOMER ORDER BY ID_CUSTOMER ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_customer[$row_cus] = $objResult[0];
                 $row_cus++;
             }
                 $data_customer = $data_customer[$row_cus-1];
                 $t = substr($data_customer,3);
                 $new_id = $t+1;

                     $id_cus.= "CUS".$new_id;

          $FIRST_NAME = $_POST["FIRST_NAME"];
          $LAST_NAME = $_POST["LAST_NAME"];
          $AGE = $_POST["AGE"];
          $PHONE_NUMBER = $_POST["PHONE_NUMBER"];
          $GENDER = $_POST["GENDER"];
          $NATIONALITY = $_POST["NATIONALITY"];
          $STATUST = $_POST["STATUST"];
          $STATUST_BICYCLE = $_POST["STATUST_BICYCLE"];
          $EMAIL = $_POST["EMAIL"];
          $BIRTH_DAY = $_POST["BIRTH_DAY"];
          $strSQL = "
           INSERT INTO CUSTOMER(ID_CUSTOMER,FIRST_NAME,LAST_NAME,AGE,BIRTH_DAY,PHONE_NUMBER,EMAIL,GENDER,NATIONALITY,STATUST,STATUST_BICYCLE)
           VALUES ('".$id_cus."', '".$FIRST_NAME."', '".$LAST_NAME."', '".$AGE."',TO_DATE('".$BIRTH_DAY."','YYYY-MM-DD'), '".$PHONE_NUMBER."', '".$EMAIL."', '".$GENDER."', '".$NATIONALITY."', '".$STATUST."', '".$STATUST_BICYCLE."')
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
          $ID_CUSTOMER = $_POST["product_id"];
          $FIRST_NAME = $_POST["FIRST_NAME"];
          $LAST_NAME = $_POST["LAST_NAME"];
          $AGE = $_POST["AGE"];
          $PHONE_NUMBER = $_POST["PHONE_NUMBER"];
          $GENDER = $_POST["GENDER"];
          $NATIONALITY = $_POST["NATIONALITY"];
          $STATUST = $_POST["STATUST"];
          $STATUST_BICYCLE = $_POST["STATUST_BICYCLE"];
          $EMAIL = $_POST["EMAIL"];
          $BIRTH_DAY = $_POST["BIRTH_DAY"];

          $query = "
           UPDATE CUSTOMER
           SET ID_CUSTOMER = '".$ID_CUSTOMER."',
           FIRST_NAME = '".$FIRST_NAME."',
           LAST_NAME = '".$LAST_NAME."',
           AGE = '".$AGE."',
           BIRTH_DAY = '".$BIRTH_DAY."',
           PHONE_NUMBER = '".$PHONE_NUMBER."',
           EMAIL = '".$EMAIL."',
           GENDER = '".$GENDER."',
           NATIONALITY = '".$NATIONALITY."',
           STATUST = '".$STATUST."',
           STATUST_BICYCLE = '".$STATUST_BICYCLE."'
           WHERE ID_CUSTOMER = '".$_POST["product_id"]."'
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
