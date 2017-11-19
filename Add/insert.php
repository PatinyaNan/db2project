<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         //---------------------------------------------------------ID_INSURANCE--------------------------------------------------------------------
        //  $row_insurance = 0;
        //  $id_insurance ='';
        //  $data_insurance = array();
        //  $strSQL = "SELECT MAX(ID_INSURANCE) FROM INSURANCE ";
        //  $objParse = oci_parse($connection, $strSQL);
        //  oci_execute ($objParse,OCI_DEFAULT);
         //
        //      while($objResult = oci_fetch_array($objParse,OCI_BOTH))
        //      {
        //          $data_insurance[$row_insurance] = $objResult[0];
        //          $row_insurance++;
        //      }
        //          $data_insurance = $data_insurance[$row_insurance-1];
        //          $t = substr($data_insurance,2);
        //          $new_id = $t+1;
         //
        //          if($new_id <= 99){
        //              $id_insurance.= "IN0000".$new_id;
        //           }
        //         else{
        //             $id_insurance.= "IN000".$new_id;
        //           }

         //---------------------------------------------------------ID_ADDITIONAL--------------------------------------------------------------------

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

         //---------------------------------------------------------ID_ADDITIONAL_DETAILS--------------------------------------------------------------------

         $row_additional_details = 0;
         $id_additional_details =0;
         $data_additional_details = array();
         $strSQL = "SELECT MAX(ID_ADDITIONAL_DETAILS) FROM ADDITIONAL_DETAILS";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_additional_details[$row_additional_details] = $objResult[0];
                 $row_additional_details++;
             }
                 $data_additional_details = $data_additional_details[$row_additional_details-1];
                 $t = substr($data_additional_details,2);
                 $id_additional_details = $t+1;


 //---------------------------------------------------------ID_CONDITION_ADDITIONAL--------------------------------------------------------------------
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


     //---------------------------------------------------------INSERT_ADDITIONAL-------------------------------------------------------------------

         $NAME_ADDITIONAL = $_POST["NAME_ADDITIONAL"];
         $ID_CATEGORY = "CA000006";
         $COVERAGE_STYLE_NUMBER = $_POST["COVERAGE_STYLE"];

         $CON_START_AGE = $_POST["CON_START_AGE"];
         $CON_END_AGE = $_POST["CON_END_AGE"];




         $strSQL = "
          INSERT INTO ADDITIONAL(ID_ADDITIONAL,NAME_ADDITIONAL,ID_CATEGORY,COVERAGE_STYLE)
          VALUES ('".$id_additional."', '".$NAME_ADDITIONAL."', '".$ID_CATEGORY."', '".$COVERAGE_STYLE_NUMBER."')
         ";
         //echo $strSQL;
         $objParse = oci_parse($connection, $strSQL);
         $objExecute = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
        if(!$objExecute) echo "$strSQL<br>";
        //---------------------------------------------------------INSERT_CONDITION_ADDITIONAL-------------------------------------------------------------------




            $strSQL = "
             INSERT INTO CONDITION_ADDITIONAL(ID_CONDITION_ADDITIONAL,CON_START_AGE,CON_END_AGE)
             VALUES ('".$id_con."', '".$CON_START_AGE."', '".$CON_END_AGE."')
            ";
            //echo $strSQL;
            $objParse = oci_parse($connection, $strSQL);
            $objExecute3 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
             if(!$objExecute3) echo "$strSQL<br>";

             else echo "Insert success";
    //---------------------------------------------------------INSERT_ADDITIONAL_DETAILS--------------------------------------------------------------------

        for($i=0; $i < count($_POST["to"]) ; $i++)
        {
           //echo " $i = ".$_POST["to"][$i]."<br>";
           $strSQL = "
            INSERT INTO ADDITIONAL_DETAILS(ID_ADDITIONAL_DETAILS,ID_ADDITIONAL,ID_INSURANCE,ID_CONDITION_ADDITIONAL)
            VALUES ('DE000".$id_additional_details."', '".$id_additional."', '".$_POST["to"][$i]."', '".$id_con."')
           ";
           //echo $strSQL;
           $objParse1 = oci_parse($connection, $strSQL);
           $objExecute1 = oci_execute ($objParse1,OCI_COMMIT_ON_SUCCESS);
           $id_additional_details++;
        }if(!$objExecute1) echo "$strSQL<br>";



    }
}
?>
