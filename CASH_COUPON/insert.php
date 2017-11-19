<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_cash = 0;
         $id_cash ='';
         $data_cash = array();
         $strSQL = "SELECT ID_CASH_COUPON FROM CASH_COUPON";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_cash[$row_cash] = $objResult[0];
                 $row_cash++;
             }
                 $data_cash = $data_cash[$row_cash-1];
                 $t = substr($data_cash,3);
                 $new_id = $t+1;

                 if($new_id <= 99 && $new_id >= 10){
                     $id_cash.= "CAS000".$new_id;
                  }
                else{
                    $id_cash.= "CAS00".$new_id;
                  }

          $START_INSURANCE = $_POST["START_INSURANCE"];
          $END_INSURANCE = $_POST["END_INSURANCE"];
          $CASH_PERCENT = $_POST["CASH_PERCENT"];
          $START_AGE_INSURACE = $_POST["START_AGE_INSURACE"];
          $END_AGE_INSURANCE = $_POST["END_AGE_INSURANCE"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $strSQL = "
           INSERT INTO CASH_COUPON(ID_CASH_COUPON,START_INSURANCE,END_INSURANCE,CASH_PERCENT,START_AGE_INSURACE,END_AGE_INSURANCE,ID_INSURANCE)
           VALUES ('".$id_cash."', '".$START_INSURANCE."', '".$END_INSURANCE."', '".$CASH_PERCENT."', '".$START_AGE_INSURACE."', '".$END_AGE_INSURANCE."', '".$ID_INSURANCE."')
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
          $ID_CASH_COUPON = $_POST["product_id"];
          $START_INSURANCE = $_POST["START_INSURANCE"];
          $END_INSURANCE = $_POST["END_INSURANCE"];
          $CASH_PERCENT = $_POST["CASH_PERCENT"];
          $START_AGE_INSURACE = $_POST["START_AGE_INSURACE"];
          $END_AGE_INSURANCE = $_POST["END_AGE_INSURANCE"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $query = "
           UPDATE CASH_COUPON
           SET ID_CASH_COUPON = '".$ID_CASH_COUPON."',
           START_INSURANCE = '".$START_INSURANCE."',
           END_INSURANCE = '".$END_INSURANCE."',
           CASH_PERCENT = '".$CASH_PERCENT."',
           START_AGE_INSURACE = '".$START_AGE_INSURACE."',
           END_AGE_INSURANCE = '".$END_AGE_INSURANCE."',
           ID_INSURANCE = '".$ID_INSURANCE."'
           WHERE ID_CASH_COUPON = '".$_POST["product_id"]."'
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
