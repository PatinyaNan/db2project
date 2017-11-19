<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_addition = 0;
         $id_additional ='';
         $data_additional = array();
         $strSQL = "SELECT ID_ADDITIONAL FROM ADDITIONAL ORDER BY ID_ADDITIONAL ASC";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_additional[$row_addition] = $objResult[0];
                 $row_addition++;
             }
                 $data_additional = $data_additional[$row_addition-1];
                 $t = substr($data_additional,2);
                 $new_id = $t+1;

                      if($new_id <= 99){
                              $id_additional.= "AD0000".$new_id;
                       }
                     else{
                             $id_additional.= "AD000".$new_id;
                         }

          $NAME_ADDITIONAL = $_POST["NAME_ADDITIONAL"];
          $ID_CATEGORY = $_POST["ID_CATEGORY"];
          $COVERAGE_STYLE_NUMBER = $_POST["COVERAGE_STYLE"];
          $strSQL = "
           INSERT INTO ADDITIONAL(ID_ADDITIONAL,NAME_ADDITIONAL,ID_CATEGORY,COVERAGE_STYLE)
           VALUES ('".$id_additional."', '".$NAME_ADDITIONAL."', '".$ID_CATEGORY."', '".$COVERAGE_STYLE_NUMBER."')
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
          $ID_ADDITIONAL["product_id"];
          $NAME_ADDITIONAL = $_POST["NAME_ADDITIONAL"];
          $ID_CATEGORY = $_POST["ID_CATEGORY"];
          $COVERAGE_STYLE_NUMBER = $_POST["COVERAGE_STYLE"];

          $query = "
           UPDATE ADDITIONAL
           SET ID_ADDITIONAL = '".$ID_ADDITIONAL."',
           NAME_ADDITIONAL = '".$NAME_ADDITIONAL."',
           ID_CATEGORY = '".$ID_CATEGORY."',
           COVERAGE_STYLE = '".$COVERAGE_STYLE_NUMBER."'
           WHERE ID_ADDITIONAL = '".$_POST["product_id"]."'
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
