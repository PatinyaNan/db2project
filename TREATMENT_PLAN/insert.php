<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_treatment = 0;
         $id_treatment ='';
         $data_treatment = array();
         $strSQL = "SELECT ID_TREATMENT_PLAN FROM TREATMENT_PLAN ORDER BY ID_TREATMENT_PLAN ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_treatment[$row_treatment] = $objResult[0];
                 $row_treatment++;
             }
                 $data_treatment = $data_treatment[$row_treatment-1];
                 $t = substr($data_treatment,1);
                 $new_id = $t+500;
                     $id_treatment.= "P".$new_id;

          $NAME_PLAN = $_POST["NAME_PLAN"];

          $strSQL = "
           INSERT INTO TREATMENT_PLAN(ID_TREATMENT_PLAN,NAME_PLAN)
           VALUES ('".$id_treatment."', '".$NAME_PLAN."')
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
          $ID_TREATMENT_PLAN = $_POST["product_id"];
           $NAME_PLAN = $_POST["NAME_PLAN"];

          $query = "
           UPDATE TREATMENT_PLAN
           SET ID_TREATMENT_PLAN = '".$ID_TREATMENT_PLAN."',
           NAME_PLAN = '".$NAME_PLAN."'
           WHERE ID_TREATMENT_PLAN = '".$_POST["product_id"]."'
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
