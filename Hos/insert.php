<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         //---------------------------------------------------------ID_HOSPITAL_NETWORK--------------------------------------------------------------------
         $row_hos = 0;
         $id_hos ='';
         $data_hos = array();
         $strSQL = "SELECT MAX(ID_HOSPITAL_NETWORK) FROM HOSPITAL_NETWORK";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_hos[$row_hos] = $objResult[0];
                 $row_hos++;
             }
                 $data_hos = $data_hos[$row_hos-1];
                 $t = substr($data_hos,3);
                 $new_id = $t+1;

                 if($new_id <= 999 && $new_id <= 100){
                         $id_hos.= "HOS00".$new_id;
                  }
                  else{
                         $id_hos.= "HOS0".$new_id;
                  }

         //---------------------------------------------------------ID_HOSPITAL_NETWORK_DETAILS--------------------------------------------------------------------

         $row_hos_details = 0;
         $id_hos_details ='';
         $data_hos_details = array();
         $strSQL = "SELECT MAX(ID_HOSPITAL_NETWORK_DETAILS) FROM HOSPITAL_NETWORK_DETAILS";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_hos_details[$row_hos_details] = $objResult[0];
                 $row_hos_details++;
             }
                 $data_hos_details = $data_hos_details[$row_hos_details-1];
                 $t = substr($data_hos_details,1);
                 $new_id = $t+1;

                 if($new_id <= 999 && $new_id <= 100 ){
                      $id_hos_details.= "H0000".$new_id;
                 }
                 else{
                      $id_hos_details.= "H000".$new_id;
                 }


     //---------------------------------------------------------INSERT_ADDITIONAL-------------------------------------------------------------------

         $HOS_NAME = $_POST["HOS_NAME"];
         $HOS_ADDRESS = $_POST["HOS_ADDRESS"];
         $HOS_PHONE_NUMBER = $_POST["HOS_PHONE_NUMBER"];
         $HOS_SECTOR = $_POST["HOS_SECTOR"];
         $HOS_COUNTY = $_POST["HOS_COUNTY"];

         $ID_INSURANCE = "IN000016";

         $strSQL = "
          INSERT INTO HOSPITAL_NETWORK(ID_HOSPITAL_NETWORK,HOS_NAME,HOS_ADDRESS,HOS_PHONE_NUMBER,HOS_SECTOR,HOS_COUNTY)
          VALUES ('".$id_hos."', '".$HOS_NAME."', '".$HOS_ADDRESS."', '".$HOS_PHONE_NUMBER."', '".$HOS_SECTOR."', '".$HOS_COUNTY."')
         ";
         //echo $strSQL;
         $objParse = oci_parse($connection, $strSQL);
         $objExecute = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
        if(!$objExecute) echo "$strSQL<br>";

        //---------------------------------------------------------INSERT_CONDITION_ADDITIONAL-------------------------------------------------------------------



            $strSQL = "
             INSERT INTO HOSPITAL_NETWORK_DETAILS(ID_HOSPITAL_NETWORK_DETAILS,ID_HOSPITAL_NETWORK,ID_INSURANCE)
             VALUES ('".$id_hos_details."', '".$id_hos."', '".$ID_INSURANCE."')
            ";
            //echo $strSQL;
            $objParse = oci_parse($connection, $strSQL);
            $objExecute3 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
             if(!$objExecute3) echo "$strSQL<br>";
             else echo "Insert success";




    }
}
?>
