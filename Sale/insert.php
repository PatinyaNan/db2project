<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_sell = 0;
         $id_sell ='';
         $data_sell = array();
         $strSQL = "SELECT ID_SELL FROM SELL";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_career[$row_sell] = $objResult[0];
                 $row_sell++;
             }
                 $data_career = $data_career[$row_sell-1];
                 $t = substr($data_career,4);
                 $new_id = $t+1;

                     $id_sell.= "SELL".$new_id;

          $SELL_DATE = $_POST["SELL_DATE"];
          $EMPLOYEEID = $_POST["EMPLOYEEID"];
          $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
          $strSQL = "
           INSERT INTO SELL(ID_SELL,SELL_DATE,EMPLOYEEID,ID_CUSTOMER)
           VALUES ('".$id_sell."', '".$SELL_DATE."', '".$EMPLOYEEID."', '".$ID_CUSTOMER."')
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
         $ID_SELL = $_POST["product_id"];
         $SELL_DATE = $_POST["SELL_DATE"];
         $EMPLOYEEID = $_POST["EMPLOYEEID"];
         $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
          $query = "
           UPDATE SELL
           SET ID_SELL = '".$ID_SELL."',
           SELL_DATE = '".$SELL_DATE."',
           EMPLOYEEID = '".$EMPLOYEEID."',
           ID_CUSTOMER = '".$ID_CUSTOMER."'
           WHERE ID_SELL = '".$_POST["product_id"]."'
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
