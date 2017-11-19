<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_sum = 0;
         $id_sum ='';
         $data_sum = array();
         $strSQL = "SELECT ID_SUM_ASSURED FROM SUM_ASSURED ORDER BY ID_SUM_ASSURED ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_sum[$row_sum] = $objResult[0];
                 $row_sum++;
             }
                 $data_sum = $data_sum[$row_sum-1];
                 $t = substr($data_sum,2);
                 $new_id = $t+1;

                 if($new_id <= 99 && $new_id >= 10){
                     $id_sum.= "SU0000".$new_id;
                  }
                else{
                    $id_sum.= "SU000".$new_id;
                  }

          $MINIMUM_SUM_ASSURED = $_POST["MINIMUM_SUM_ASSURED"];
          $PAYMENT_TERM = $_POST["PAYMENT_TERM"];
          $COVERAGE_TERM = $_POST["COVERAGE_TERM"];
          $MAXIMUM_SUM_ASSURED = $_POST["MAXIMUM_SUM_ASSURED"];
          $DISCOUNT = $_POST["DISCOUNT"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $strSQL = "
           INSERT INTO SUM_ASSURED(ID_SUM_ASSURED,MINIMUM_SUM_ASSURED,PAYMENT_TERM,COVERAGE_TERM,MAXIMUM_SUM_ASSURED,DISCOUNT,ID_INSURANCE)
           VALUES ('".$id_sum."', '".$MINIMUM_SUM_ASSURED."', '".$PAYMENT_TERM."', '".$COVERAGE_TERM."', '".$MAXIMUM_SUM_ASSURED."', '".$DISCOUNT."', '".$ID_INSURANCE."')
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
          $ID_SUM_ASSURED = $_POST["product_id"];
          $MINIMUM_SUM_ASSURED = $_POST["MINIMUM_SUM_ASSURED"];
          $PAYMENT_TERM = $_POST["PAYMENT_TERM"];
          $COVERAGE_TERM = $_POST["COVERAGE_TERM"];
          $MAXIMUM_SUM_ASSURED = $_POST["MAXIMUM_SUM_ASSURED"];
          $DISCOUNT = $_POST["DISCOUNT"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $query = "
           UPDATE SUM_ASSURED
           SET ID_SUM_ASSURED = '".$ID_SUM_ASSURED."',
           MINIMUM_SUM_ASSURED = '".$MINIMUM_SUM_ASSURED."',
           PAYMENT_TERM = '".$PAYMENT_TERM."',
           COVERAGE_TERM = '".$COVERAGE_TERM."',
           MAXIMUM_SUM_ASSURED = '".$MAXIMUM_SUM_ASSURED."',
           DISCOUNT = '".$DISCOUNT."',
           ID_INSURANCE = '".$ID_INSURANCE."'
           WHERE ID_SUM_ASSURED = '".$_POST["product_id"]."'
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
