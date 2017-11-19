<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_hos = 0;
         $id_hos ='';
         $data_hos = array();
         $strSQL = "SELECT ID_HOSPITAL_NETWORK FROM HOSPITAL_NETWORK ORDER BY ID_HOSPITAL_NETWORK ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_hos[$row_hos] = $objResult[0];
                 $row_hos++;
             }
                 $data_hos = $data_hos[$row_hos-1];
                 $t = substr($data_hos,3);
                 $new_id = $t+1;

                 if($new_id <= 999 && $new_id <= 100){
                         $id_hos.= "HOS00".$new_id;
                  }
                  else{
                         $id_hos.= "HOS0".$new_id;
                  }

          $HOS_NAME = $_POST["HOS_NAME"];
          $HOS_ADDRESS = $_POST["HOS_ADDRESS"];
          $HOS_PHONE_NUMBER = $_POST["HOS_PHONE_NUMBER"];
          $HOS_SECTOR = $_POST["HOS_SECTOR"];
          $HOS_COUNTY = $_POST["HOS_COUNTY"];

          $strSQL = "
           INSERT INTO HOSPITAL_NETWORK(ID_HOSPITAL_NETWORK,HOS_NAME,HOS_ADDRESS,HOS_PHONE_NUMBER,HOS_SECTOR,HOS_COUNTY)
           VALUES ('".$id_hos."', '".$HOS_NAME."', '".$HOS_ADDRESS."', '".$HOS_PHONE_NUMBER."', '".$HOS_SECTOR."', '".$HOS_COUNTY."')
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
          $ID_HOSPITAL_NETWORK = $_POST["product_id"];
          $HOS_NAME = $_POST["HOS_NAME"];
          $HOS_ADDRESS = $_POST["HOS_ADDRESS"];
          $HOS_PHONE_NUMBER = $_POST["HOS_PHONE_NUMBER"];
          $HOS_SECTOR = $_POST["HOS_SECTOR"];
          $HOS_COUNTY = $_POST["HOS_COUNTY"];

          $query = "
           UPDATE HOSPITAL_NETWORK
           SET ID_HOSPITAL_NETWORK = '".$ID_HOSPITAL_NETWORK."',
           HOS_NAME = '".$HOS_NAME."',
           HOS_ADDRESS = '".$HOS_ADDRESS."',
           HOS_PHONE_NUMBER = '".$HOS_PHONE_NUMBER."',
           HOS_SECTOR = '".$HOS_SECTOR."',
           HOS_COUNTY = '".$HOS_COUNTY."'
           WHERE ID_HOSPITAL_NETWORK = '".$_POST["product_id"]."'
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
