<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
             $row_career = 0;
             $id_career ='';
             $data_customer = array();
             $strSQL = "SELECT ID_CAREER FROM CAREER";
             $objParse = oci_parse($connection, $strSQL);
             oci_execute ($objParse,OCI_DEFAULT);

                 while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                 {
                     $data_career[$row_career] = $objResult[0];
                     $row_career++;
                 }
                     $data_career = $data_career[$row_career-1];
                     $t = substr($data_career,3);
                     $new_id = $t+1;

                     if($new_id <= 99){
                         $id_career.= "CAR000".$new_id;
                      }
                    else{
                        $id_career.= "CAR00".$new_id;
                      }

          $career_name = $_POST["career_name"];
          $strSQL = "
           INSERT INTO CAREER(ID_CAREER,CAR_NAME)
           VALUES ('".$id_career."', '".$career_name."')
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
          $career_id = $_POST["product_id"];
          $career_name =  $_POST["career_name"];
          $query = "
           UPDATE CAREER
           SET ID_CAREER = '".$career_id."',
           CAR_NAME = '".$career_name."'
           WHERE ID_CAREER = '".$_POST["product_id"]."'
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
