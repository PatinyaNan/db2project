<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         $row_career_details = 0;
         $id_career_details='';
         $data_career_details = array();
         $strSQL = "SELECT ID_CAREER_DETAIL FROM CAREER_DETAIL";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_customer_details[$row_career_details] = $objResult[0];
                 $row_career_details++;
             }
                 $data_customer_details = $data_customer_details[$row_career_details-1];
                 $t = substr($data_customer_details,4);
                 $new_id = $t+1;
                     $id_career_details.= "CARD".$new_id;

          $ID_CAREER = $_POST["ID_CAREER"];
          $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
          $CAREER_CATEGORY = $_POST["CAREER_CATEGORY"];
          $strSQL = "
           INSERT INTO CAREER_DETAIL(ID_CAREER_DETAIL,ID_CAREER,ID_CUSTOMER,CAREER_CATEGORY)
           VALUES ('".$id_career_details."', '".$FIRST_NAME."', '".$LAST_NAME."', '".$STATUST_BICYCLE."')
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
          $ID_CAREER_DETAIL = $_POST["product_id"];
          $ID_CAREER = $_POST["ID_CAREER"];
          $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
          $CAREER_CATEGORY = $_POST["CAREER_CATEGORY"];

          $query = "
           UPDATE CAREER_DETAIL
           SET ID_CAREER_DETAIL = '".$ID_CAREER_DETAIL."',
           ID_CAREER = '".$ID_CAREER."',
           ID_CUSTOMER = '".$ID_CUSTOMER."',
           CAREER_CATEGORY = '".$CAREER_CATEGORY."',
           STATUST_BICYCLE = '".$STATUST_BICYCLE."'
           WHERE ID_CAREER_DETAIL = '".$_POST["product_id"]."'
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
