<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_death = 0;
         $id_death ='';
         $data_death = array();
         $strSQL = "SELECT ID_DEATH_BENEFIT FROM DEATH_BENEFIT ORDER BY ID_DEATH_BENEFIT ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_death[$row_death] = $objResult[0];
                 $row_death++;
             }
                 $data_death = $data_death[$row_death-1];
                 $t = substr($data_death,2);
                 $new_id = $t+1;

                 if($new_id <= 999 && $new_id >= 100){
                     $id_death.= "DE000".$new_id;
                 }
                 else{
                     $id_death.= "DE00".$new_id;
                }

          $DE_START_INSURANCE = $_POST["DE_START_INSURANCE"];
          $DE_END_INSURANCE = $_POST["DE_END_INSURANCE"];
          $DE_PERCENT = $_POST["DE_PERCENT"];
          $DE_START_AGE = $_POST["DE_START_AGE"];
          $DE_END_AGE = $_POST["DE_END_AGE"];
          $DE_MONEY = $_POST["DE_MONEY"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $strSQL = "
           INSERT INTO DEATH_BENEFIT(ID_DEATH_BENEFIT,DE_START_INSURANCE,DE_END_INSURANCE,DE_PERCENT,DE_START_AGE,DE_END_AGE,DE_MONEY,ID_INSURANCE)
           VALUES ('".$id_death."', '".$DE_START_INSURANCE."', '".$DE_END_INSURANCE."', '".$DE_PERCENT."', '".$DE_START_AGE."', '".$DE_END_AGE."', '".$DE_MONEY."', '".$ID_INSURANCE."')
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
          $ID_DEATH_BENEFIT = $_POST["product_id"];
          $DE_START_INSURANCE = $_POST["DE_START_INSURANCE"];
          $DE_END_INSURANCE = $_POST["DE_END_INSURANCE"];
          $DE_PERCENT = $_POST["DE_PERCENT"];
          $DE_START_AGE = $_POST["DE_START_AGE"];
          $DE_END_AGE = $_POST["DE_END_AGE"];
          $DE_MONEY = $_POST["DE_MONEY"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $query = "
           UPDATE DEATH_BENEFIT
           SET ID_DEATH_BENEFIT = '".$ID_DEATH_BENEFIT."',
           DE_START_INSURANCE = '".$DE_START_INSURANCE."',
           DE_END_INSURANCE = '".$DE_END_INSURANCE."',
           DE_PERCENT = '".$DE_PERCENT."',
           DE_START_AGE = '".$DE_START_AGE."',
           DE_END_AGE = '".$DE_END_AGE."',
           DE_MONEY = '".$DE_MONEY."',
           ID_INSURANCE = '".$ID_INSURANCE."'
           WHERE ID_DEATH_BENEFIT = '".$_POST["product_id"]."'
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
