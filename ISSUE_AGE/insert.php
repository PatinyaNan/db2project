<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_age = 0;
         $id_age ='';
         $data_age = array();
         $strSQL = "SELECT ID_ISSUE_AGE FROM ISSUE_AGE ORDER BY ID_ISSUE_AGE ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_age[$row_age] = $objResult[0];
                 $row_age++;
             }
                 $data_age = $data_age[$row_age-1];
                 $t = substr($data_age,2);
                 $new_id = $t+1;

                 if($new_id <= 99 && $new_id >= 99){
                     $id_age.= "IS0000".$new_id;
                  }
                 else{
                     $id_age.= "IS000".$new_id;
                  }

          $START_AGE_MONTH = $_POST["START_AGE_MONTH"];
          $END_AGE_MONTH = $_POST["END_AGE_MONTH"];
          $START_AGE_PREMIUM = $_POST["START_AGE_PREMIUM"];
          $END_AGE_PREMIUM = $_POST["END_AGE_PREMIUM"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];
          $strSQL = "
           INSERT INTO ISSUE_AGE(ID_ISSUE_AGE,START_AGE_MONTH,END_AGE_MONTH,START_AGE_PREMIUM,END_AGE_PREMIUM,ID_INSURANCE)
           VALUES ('".$id_age."', '".$START_AGE_MONTH."', '".$END_AGE_MONTH."', '".$START_AGE_PREMIUM."', '".$END_AGE_PREMIUM."', '".$ID_INSURANCE."')
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
          $ID_ISSUE_AGE = $_POST["product_id"];
          $START_AGE_MONTH = $_POST["START_AGE_MONTH"];
          $END_AGE_MONTH = $_POST["END_AGE_MONTH"];
          $START_AGE_PREMIUM = $_POST["START_AGE_PREMIUM"];
          $END_AGE_PREMIUM = $_POST["END_AGE_PREMIUM"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $query = "
           UPDATE ISSUE_AGE
           SET ID_ISSUE_AGE = '".$ID_ISSUE_AGE."',
           START_AGE_MONTH = '".$START_AGE_MONTH."',
           END_AGE_MONTH = '".$END_AGE_MONTH."',
           START_AGE_PREMIUM = '".$START_AGE_PREMIUM."',
           END_AGE_PREMIUM = '".$END_AGE_PREMIUM."',
           ID_INSURANCE = '".$ID_INSURANCE."'
           WHERE ID_ISSUE_AGE = '".$_POST["product_id"]."'
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
