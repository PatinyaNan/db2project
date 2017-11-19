<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_insurance = 0;
         $id_insurance ='';
         $data_insurance = array();
         $strSQL = "SELECT ID_INSURANCE FROM INSURANCE ORDER BY ID_INSURANCE ASC ";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_insurance[$row_insurance] = $objResult[0];
                 $row_insurance++;
             }
                 $data_insurance = $data_insurance[$row_insurance-1];
                 $t = substr($data_insurance,2);
                 $new_id = $t+1;

                 if($new_id <= 99){
                     $id_insurance.= "IN0000".$new_id;
                  }
                else{
                    $id_insurance.= "IN000".$new_id;
                  }

          $IN_NAME = $_POST["IN_NAME"];
          $ID_PROMOTION = $_POST["ID_PROMOTION"];
          $ID_CATEGORY = $_POST["ID_CATEGORY"];
          $CONSIDERATION_CRITERIA = $_POST["CONSIDERATION_CRITERIA"];
          $TAX_BENEFITS = $_POST["TAX_BENEFITS"];
          $NOTE = $_POST["NOTE"];
          $INSURANCE_AFFILIATION = $_POST["INSURANCE_AFFILIATION"];
          $strSQL = "
           INSERT INTO INSURANCE(ID_INSURANCE,IN_NAME,ID_PROMOTION,ID_CATEGORY,CONSIDERATION_CRITERIA,TAX_BENEFITS,NOTE,INSURANCE_AFFILIATION)
           VALUES ('".$id_insurance."', '".$IN_NAME."', '".$ID_PROMOTION."', '".$ID_CATEGORY."', '".$CONSIDERATION_CRITERIA."', '".$TAX_BENEFITS."', '".$NOTE."', '".$INSURANCE_AFFILIATION."')
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
          $ID_INSURANCE = $_POST["product_id"];
          $IN_NAME = $_POST["IN_NAME"];
          $ID_PROMOTION = $_POST["ID_PROMOTION"];
          $ID_CATEGORY = $_POST["ID_CATEGORY"];
          $CONSIDERATION_CRITERIA = $_POST["CONSIDERATION_CRITERIA"];
          $TAX_BENEFITS = $_POST["TAX_BENEFITS"];
          $NOTE = $_POST["NOTE"];
          $INSURANCE_AFFILIATION = $_POST["INSURANCE_AFFILIATION"];
          $query = "
           UPDATE INSURANCE
           SET ID_INSURANCE = '".$ID_INSURANCE."',
           IN_NAME = '".$IN_NAME."',
           ID_PROMOTION = '".$ID_PROMOTION."',
           ID_CATEGORY = '".$ID_CATEGORY."',
           CONSIDERATION_CRITERIA = '".$CONSIDERATION_CRITERIA."',
           TAX_BENEFITS = '".$TAX_BENEFITS."',
           NOTE = '".$NOTE."',
           INSURANCE_AFFILIATION = '".$INSURANCE_AFFILIATION."'
           WHERE ID_INSURANCE = '".$_POST["product_id"]."'
          ";
           $objParse1 = oci_parse($connection, $query);
           oci_execute($objParse1, OCI_DEFAULT);
              if(oci_commit($connection))
              {
                  oci_commit($connection);
                  echo 'Product Updated';
                  //echo $query;
              }
              else echo "Error Save [".$strSQL."";
         }
}
?>
