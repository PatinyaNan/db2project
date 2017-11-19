<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_hos_details = 0;
         $id_hos_details ='';
         $data_hos_details = array();
         $strSQL = "SELECT ID_HOSPITAL_NETWORK_DETAILS FROM HOSPITAL_NETWORK_DETAILS ORDER BY ID_HOSPITAL_NETWORK_DETAILS ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_hos_details[$row_hos_details] = $objResult[0];
                 $row_hos_details++;
             }
                 $data_hos_details = $data_hos_details[$row_hos_details-1];
                 $t = substr($data_hos_details,1);
                 $new_id = $t+1;

                 if($new_id <= 999 && $new_id <= 100 ){
                      $id_hos_details.= "H0000".$new_id;
                 }
                 else{
                      $id_hos_details.= "H000".$new_id;
                 }

          $ID_HOSPITAL_NETWORK = $_POST["ID_HOSPITAL_NETWORK"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $strSQL = "
           INSERT INTO HOSPITAL_NETWORK_DETAILS(ID_HOSPITAL_NETWORK_DETAILS,ID_HOSPITAL_NETWORK,ID_INSURANCE)
           VALUES ('".$id_hos_details."', '".$ID_HOSPITAL_NETWORK."', '".$ID_INSURANCE."')
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
          $ID_HOSPITAL_NETWORK_DETAILS = $_POST["product_id"];
          $ID_HOSPITAL_NETWORK = $_POST["ID_HOSPITAL_NETWORK"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $query = "
           UPDATE HOSPITAL_NETWORK_DETAILS
           SET ID_HOSPITAL_NETWORK_DETAILS = '".$ID_HOSPITAL_NETWORK_DETAILS."',
           ID_HOSPITAL_NETWORK = '".$ID_HOSPITAL_NETWORK."',
           ID_INSURANCE = '".$ID_INSURANCE."'
           WHERE ID_HOSPITAL_NETWORK_DETAILS = '".$_POST["product_id"]."'
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
