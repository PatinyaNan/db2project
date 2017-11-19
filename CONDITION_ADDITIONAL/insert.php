<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_con = 0;
         $id_con ='';
         $data_con = array();
         $strSQL = "SELECT ID_CONDITION_ADDITIONAL FROM CONDITION_ADDITIONAL ORDER BY ID_CONDITION_ADDITIONAL ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_con[$row_con] = $objResult[0];
                 $row_con++;
             }
                 $data_con = $data_con[$row_con-1];
                 $t = substr($data_con,3);
                 $new_id = $t+1;
                 if($new_id <= 9 && $new_id >= 1){
                     $id_con.= "AGE0000".$new_id;
                 }
                 else{
                     $id_con.= "AGE000".$new_id;
                 }

          $CON_START_AGE = $_POST["CON_START_AGE"];
          $CON_END_AGE = $_POST["CON_END_AGE"];
          $strSQL = "
           INSERT INTO CONDITION_ADDITIONAL(ID_CONDITION_ADDITIONAL,CON_START_AGE,CON_END_AGE)
           VALUES ('".$id_con."', '".$CON_START_AGE."', '".$CON_END_AGE."')
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
          $ID_CONDITION_ADDITIONAL = $_POST["product_id"];
          $CON_START_AGE = $_POST["CON_START_AGE"];
          $CON_END_AGE = $_POST["CON_END_AGE"];

          $query = "
           UPDATE CONDITION_ADDITIONAL
           SET ID_CONDITION_ADDITIONAL = '".$ID_CONDITION_ADDITIONAL."',
           CON_START_AGE = '".$CON_START_AGE."',
           CON_END_AGE = '".$CON_END_AGE."'
           WHERE ID_CONDITION_ADDITIONAL = '".$_POST["product_id"]."'
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
