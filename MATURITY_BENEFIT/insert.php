<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_ma = 0;
         $id_ma ='';
         $data_ma = array();
         $strSQL = "SELECT ID_MATURITY_BENEFIT FROM MATURITY_BENEFIT ORDER BY ID_MATURITY_BENEFIT ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_ma[$row_ma] = $objResult[0];
                 $row_ma++;
             }
                 $data_ma = $data_ma[$row_ma-1];
                 $t = substr($data_ma,2);
                 $new_id = $t+1;

                 if($new_id <= 99){
                      $id_ma.= "MA0000".$new_id;
                 }
                 else{
                      $id_ma.= "MA000".$new_id;
                 }

          $MA_END_PERCENT = $_POST["MA_END_PERCENT"];
          $MA_END_INSURANCE = $_POST["MA_END_INSURANCE"];
          $MA_START_PERCENT = $_POST["MA_START_PERCENT"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $MA_END_AGE = $_POST["MA_END_AGE"];

          $strSQL = "
           INSERT INTO MATURITY_BENEFIT(ID_MATURITY_BENEFIT,MA_END_PERCENT,MA_END_INSURANCE,MA_START_PERCENT,ID_INSURANCE,MA_END_AGE)
           VALUES ('".$id_ma."', '".$MA_END_PERCENT."', '".$MA_END_INSURANCE."', '".$MA_START_PERCENT."', '".$ID_INSURANCE."', '".$MA_END_AGE."')
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
          $ID_MATURITY_BENEFIT = $_POST["product_id"];
          $MA_END_PERCENT = $_POST["MA_END_PERCENT"];
          $MA_END_INSURANCE = $_POST["MA_END_INSURANCE"];
          $MA_START_PERCENT = $_POST["MA_START_PERCENT"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $MA_END_AGE = $_POST["MA_END_AGE"];

          $query = "
           UPDATE MATURITY_BENEFIT
           SET ID_MATURITY_BENEFIT = '".$ID_MATURITY_BENEFIT."',
           MA_END_PERCENT = '".$MA_END_PERCENT."',
           MA_END_INSURANCE = '".$MA_END_INSURANCE."',
           MA_START_PERCENT = '".$MA_START_PERCENT."',
           ID_INSURANCE = '".$ID_INSURANCE."',
           MA_END_AGE = '".$MA_END_AGE."'
           WHERE ID_MATURITY_BENEFIT = '".$_POST["product_id"]."'
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
