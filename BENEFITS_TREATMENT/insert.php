<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_benefits = 0;
         $id_benefits ='';
         $data_benefitsr = array();
         $strSQL = "SELECT ID_BENEFITS_TREATMENT FROM BENEFITS_TREATMENT";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_benefitsr[$row_benefits] = $objResult[0];
                 $row_benefits++;
             }
                 $data_benefitsr = $data_benefitsr[$row_benefits-1];
                 $t = substr($data_benefitsr,2);
                 $new_id = $t+1;

                 if($new_id <= 99 && $new_id >= 10){
                     $id_benefits.= "BE0000".$new_id;
                  }
                  else if($new_id <= 999 && $new_id >= 100){
                      $id_benefits.= "BE000".$new_id;
                   }
                 else{
                    $id_benefits.= "BE000".$new_id;
                   }

          $LIST_BENEFITS = $_POST["LIST_BENEFITS"];
          $ID_ADDITIONAL =  "AD000007";
          $ID_TREATMENT_PLAN = $_POST["ID_TREATMENT_PLAN"];
          $BENEFITS_MONEY = $_POST["BENEFITS_MONEY"];
          $strSQL = "
           INSERT INTO BENEFITS_TREATMENT(ID_BENEFITS_TREATMENT,LIST_BENEFITS,ID_ADDITIONAL,ID_TREATMENT_PLAN,BENEFITS_MONEY)
           VALUES ('".$id_benefits."', '".$LIST_BENEFITS."', '".$ID_ADDITIONAL."', '".$ID_TREATMENT_PLAN."', ".$BENEFITS_MONEY.")
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
          $ID_BENEFITS_TREATMENT = $_POST["product_id"];
          $LIST_BENEFITS = $_POST["LIST_BENEFITS"];
          $ID_ADDITIONAL = "AD000007";
          $ID_TREATMENT_PLAN = $_POST["ID_TREATMENT_PLAN"];
          $BENEFITS_MONEY = $_POST["BENEFITS_MONEY"];

          $query = "
           UPDATE BENEFITS_TREATMENT
           SET ID_BENEFITS_TREATMENT = '".$ID_BENEFITS_TREATMENT."',
           LIST_BENEFITS = '".$LIST_BENEFITS."',
           ID_ADDITIONAL = '".$ID_ADDITIONAL."',
           ID_TREATMENT_PLAN = '".$ID_TREATMENT_PLAN."',
           BENEFITS_MONEY = '".$BENEFITS_MONEY."'
           WHERE ID_BENEFITS_TREATMENT = '".$_POST["product_id"]."'
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
