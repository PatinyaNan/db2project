<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_sell_details = 0;
         $id_sell_details ='';
         $data_sell_details = array();
         $strSQL = "SELECT ID_SELL_DETAILS FROM SELL_DETAILS ORDER BY ID_SELL_DETAILS ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_sell_details[$row_sell_details] = $objResult[0];
                 $row_sell_details++;
             }
                 $data_sell_details = $data_sell_details[$row_sell_details-1];
                 $t = substr($data_sell_details,2);
                 $new_id = $t+1;

                     $id_sell_details.= "SE".$new_id;

          $FORMAT = $_POST["FORMAT"];
          $SELL_PAYMENT = $_POST["SELL_PAYMENT"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $ID_SELL = $_POST["ID_SELL"];

          $strSQL = "
           INSERT INTO SELL_DETAILS(ID_SELL_DETAILS,FORMAT,SELL_PAYMENT,ID_INSURANCE,ID_SELL)
           VALUES ('".$id_sell_details."', '".$FORMAT."', '".$SELL_PAYMENT."', '".$ID_INSURANCE."', '".$ID_SELL."')
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
          $ID_SELL_DETAILS = $_POST["product_id"];
          $FORMAT = $_POST["FORMAT"];
          $SELL_PAYMENT = $_POST["SELL_PAYMENT"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $ID_SELL = $_POST["ID_SELL"];

          $query = "
           UPDATE SELL_DETAILS
           SET ID_SELL_DETAILS = '".$ID_SELL_DETAILS."',
           FORMAT = '".$FORMAT."',
           SELL_PAYMENT = '".$SELL_PAYMENT."',
           ID_INSURANCE = '".$ID_INSURANCE."',
           ID_SELL = '".$ID_SELL."'
           WHERE ID_SELL_DETAILS = '".$_POST["product_id"]."'
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
