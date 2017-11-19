<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
     //---------------------------------------------------------INSERT_CUSTOMER--------------------------------------------------------------------
     $row_cus = 0;
     $id_cus ='';
     $data_customer = array();
     $strSQL = "SELECT MAX(ID_CUSTOMER) FROM CUSTOMER";
     $objParse = oci_parse($connection, $strSQL);
     oci_execute ($objParse,OCI_DEFAULT);

         while($objResult = oci_fetch_array($objParse,OCI_BOTH))
         {
             $data_customer[$row_cus] = $objResult[0];
             $row_cus++;
         }
             $data_customer = $data_customer[$row_cus-1];
             $t = substr($data_customer,3);
             $new_id = $t+1;

                 $id_cus.= "CUS".$new_id;


                 $row_sell = 0;
                 $id_sell ='';
                 $data_sell = array();
                 $strSQL = "SELECT MAX(ID_SELL) FROM SELL";
                 $objParse = oci_parse($connection, $strSQL);
                 oci_execute ($objParse,OCI_DEFAULT);

                     while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                     {
                         $data_career[$row_sell] = $objResult[0];
                         $row_sell++;
                     }
                         $data_career = $data_career[$row_sell-1];
                         $t = substr($data_career,4);
                         $new_id = $t+1;

                             $id_sell.= "SELL".$new_id;

                             $row_sell_details = 0;
                             $id_sell_details ='';
                             $data_sell_details = array();
                             $strSQL = "SELECT MAX(ID_SELL_DETAILS) FROM SELL_DETAILS";
                             $objParse = oci_parse($connection, $strSQL);
                             oci_execute ($objParse,OCI_DEFAULT);

                                 while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                                 {
                                     $data_sell_details[$row_sell_details] = $objResult[0];
                                     $row_sell_details++;
                                 }
                                     $data_sell_details = $data_sell_details[$row_sell_details-1];
                                     $t = substr($data_sell_details,2);
                                     $new_id = $t+1;

                                         $id_sell_details.= "SE".$new_id;
        //   $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
          $FIRST_NAME = $_POST["FIRST_NAME"];
          $LAST_NAME = $_POST["LAST_NAME"];
          $AGE = $_POST["AGE"];
          $PHONE_NUMBER = $_POST["PHONE_NUMBER"];
          $GENDER = $_POST["GENDER"];
          $NATIONALITY = $_POST["NATIONALITY"];
          $STATUST = $_POST["STATUST"];
          $STATUST_BICYCLE = $_POST["STATUST_BICYCLE"];
          $EMAIL = $_POST["EMAIL"];
          $BIRTH_DAY = $_POST["BIRTH_DAY"];

          $SELL_DATE = $_POST["SELL_DATE"];
          $EMPLOYEEID = $_POST["EMPLOYEEID"];

          $FORMAT = $_POST["premium_type"];
          $SELL_PAYMENT = $_POST["premium"];
          $ID_INSURANCE = $_POST["ID_INSURANCE"];

          $HOUSE_NUMBER = $_POST["HOUSE_NUMBER"];
          $DISTRICT = $_POST["DISTRICT"];
          $COUNTY = $_POST["COUNTY"];
          $PROVICE = $_POST["PROVICE"];
          $ZIP_CODE_CUS = $_POST["ZIP_CODE_CUS"];
           $ID_CAREER = $_POST["CAREER_ID"];
           $CAREER_SUP = $_POST["CAREER_SUP"];
           $CAREER_CATEGORY = "อาชีพหลัก";
           $CAREER_CATEGORY2 = "อาชีพเสริม";
           $ID_ADDITIONAL = $_POST["ID_ADDITIONAL"];

          $strSQL = "
           INSERT INTO CUSTOMER(ID_CUSTOMER,FIRST_NAME,LAST_NAME,AGE,BIRTH_DAY,PHONE_NUMBER,EMAIL,GENDER,NATIONALITY,STATUST,STATUST_BICYCLE)
           VALUES ('".$id_cus."', '".$FIRST_NAME."', '".$LAST_NAME."', '".$AGE."',TO_DATE('".$BIRTH_DAY."','YYYY-MM-DD'), '".$PHONE_NUMBER."', '".$EMAIL."', '".$GENDER."', '".$NATIONALITY."', '".$STATUST."', '".$STATUST_BICYCLE."')
          ";
          //echo $strSQL;
          $objParse = oci_parse($connection, $strSQL);
          $objExecute1 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
          if(!$objExecute1) echo "$strSQL<br>";
    //---------------------------------------------------------INSERT_SELL--------------------------------------------------------------------

         $strSQL = "
          INSERT INTO SELL(ID_SELL,SELL_DATE,EMPLOYEEID,ID_CUSTOMER)
          VALUES ('".$id_sell."', TO_DATE('".$SELL_DATE."','YYYY-MM-DD'), '".$EMPLOYEEID."', '".$id_cus."')
         ";
         //echo $strSQL;
         $objParse = oci_parse($connection, $strSQL);
         $objExecute2 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute2) echo "$strSQL<br>";

    //---------------------------------------------------------INSERT_sell details--------------------------------------------------------------------


        //  $FORMAT = $_POST["premium_type"];
        //  $SELL_PAYMENT = $_POST["premium"];
        //  $ID_INSURANCE = $_POST["ID_INSURANCE"];

         $strSQL = "
          INSERT INTO SELL_DETAILS(ID_SELL_DETAILS,FORMAT,SELL_PAYMENT,ID_INSURANCE,ID_SELL)
          VALUES ('".$id_sell_details."', '".$FORMAT."', '".$SELL_PAYMENT."', '".$ID_INSURANCE."', '".$id_sell."')
         ";
         //echo $strSQL;
         $objParse = oci_parse($connection, $strSQL);
         $objExecute3 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute3) echo "$strSQL<br>";
//---------------------------------------------------------INSERT_Address _CUSTOMRT-------------------------------------------------------------------
            $row_address_cus = 0;
            $id__address_cus ='';
            $data__address_cus = array();
            $strSQL = "SELECT MAX(ID_ADDRESS_CUS) FROM ADDRESS_CUSTOMER";
            $objParse = oci_parse($connection, $strSQL);
            oci_execute ($objParse,OCI_DEFAULT);

                while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                {
                    $data__address_cus[$row_address_cus] = $objResult[0];
                    $row_address_cus++;
                }
                    $data__address_cus = $data__address_cus[$row_address_cus-1];
                    $t = substr($data__address_cus,3);
                    $new_id = $t+1;

                     if($new_id <= 9999999 && $new_id >= 1000000){
                         $id__address_cus.= "ADC00".$new_id;
                      }
                   else{
                       $id__address_cus.= "ADC0".$new_id;
                     }


             $strSQL = "
              INSERT INTO ADDRESS_CUSTOMER(ID_ADDRESS_CUS,HOUSE_NUMBER,DISTRICT,COUNTY,PROVICE,ZIP_CODE_CUS)
              VALUES ('".$id__address_cus."', '".$HOUSE_NUMBER."', '".$DISTRICT."', '".$COUNTY."', '".$PROVICE."', '".$ZIP_CODE_CUS."')
             ";
             //echo $strSQL;
             $objParse = oci_parse($connection, $strSQL);
             $objExecute4 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
             if(!$objExecute4) echo "$strSQL<br>";
        //---------------------------------------------------------INSERT_Address Deyails-------------------------------------------------------------------

        $row_address_details = 0;
        $id__address_details ='';
        $data__address_details = array();
        $strSQL = "SELECT MAX(ID_ADDRESS_DETAILS) FROM ADDRESS_DETAILS";
        $objParse = oci_parse($connection, $strSQL);
        oci_execute ($objParse,OCI_DEFAULT);

            while($objResult = oci_fetch_array($objParse,OCI_BOTH))
            {
                $data__address_details[$row_address_details] = $objResult[0];
                $row_address_details++;
            }
                $data__address_details = $data__address_details[$row_address_details-1];
                $t = substr($data__address_details,3);
                $new_id = $t+1;

                    $id__address_details.= "ADD".$new_id;


         $strSQL = "
          INSERT INTO ADDRESS_DETAILS(ID_ADDRESS_DETAILS,ID_ADDRESS_CUS,ID_CUSTOMER)
          VALUES ('".$id__address_details."', '".$id__address_cus."', '".$id_cus."')
         ";
         //echo $strSQL;
         $objParse = oci_parse($connection, $strSQL);
         $objExecute5 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute5) echo "$strSQL<br>";
     //---------------------------------------------------------INSERT_Career_Detail-------------------------------------------------------------------

     $row_career_details = 0;
     $id_career_details='';
     $data_career_details = array();
     $strSQL = "SELECT MAX(ID_CAREER_DETAIL) FROM CAREER_DETAIL";
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

      $strSQL = "
       INSERT INTO CAREER_DETAIL(ID_CAREER_DETAIL,ID_CAREER,ID_CUSTOMER,CAREER_CATEGORY)
       VALUES ('".$id_career_details."', '".$ID_CAREER."', '".$id_cus."', '".$CAREER_CATEGORY."')
      ";
      //echo $strSQL;
      $objParse = oci_parse($connection, $strSQL);
      $objExecute6 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
      if(!$objExecute6) echo "$strSQL<br>";
          //---------------------------------------------------------INSERT_Career_Detail sup-------------------------------------------------------------------

          $row_career_details1 = 0;
          $id_career_details1='';
          $data_career_details1 = array();
          $strSQL2 = "SELECT MAX(ID_CAREER_DETAIL) FROM CAREER_DETAIL";
          $objParse2 = oci_parse($connection, $strSQL2);
          oci_execute ($objParse2,OCI_DEFAULT);

              while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH))
              {
                  $data_customer_details1[$row_career_details1] = $objResult2[0];
                  $row_career_details1++;
              }
                  $data_customer_details1 = $data_customer_details1[$row_career_details1-1];
                  $t = substr($data_customer_details1,4);
                  $new_id1 = $t+1;
                      $id_career_details1.= "CARD".$new_id1;

if($CAREER_SUP != ""){
           $strSQL = "
            INSERT INTO CAREER_DETAIL(ID_CAREER_DETAIL,ID_CAREER,ID_CUSTOMER,CAREER_CATEGORY)
            VALUES ('".$id_career_details1."', '".$CAREER_SUP."', '".$id_cus."', '".$CAREER_CATEGORY2."')
           ";
           //echo $strSQL;
           $objParse = oci_parse($connection, $strSQL);
           $objExecute7 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
           if(!$objExecute7) echo "$strSQL<br>";
}

          //---------------------------------------------------------INSERT_Addiional Customer-------------------------------------------------------------------
if($ID_ADDITIONAL != ""){
          $row_add_detail = 0;
          $id_add_detail ='';
          $data_add_detail = array();
          $strSQL = "SELECT MAX(ID_ADDITIONAL_CUSTOMER) FROM ADDITIONAL_CUSTOMER";
          $objParse = oci_parse($connection, $strSQL);
          oci_execute ($objParse,OCI_DEFAULT);

              while($objResult = oci_fetch_array($objParse,OCI_BOTH))
              {
                  $data_add_detail[$row_add_detail] = $objResult[0];
                  $row_add_detail++;
              }
                  $data_add_detail = $data_add_detail[$row_add_detail-1];
                  $t = substr($data_add_detail,3);
                  $new_id = $t+1;

                      $id_add_detail.= "ADC".$new_id;


           $strSQL = "
            INSERT INTO ADDITIONAL_CUSTOMER(ID_ADDITIONAL_CUSTOMER,ID_SELL_DETAILS,ID_ADDITIONAL)
            VALUES ('".$id_add_detail."', '".$id_sell_details."', '".$ID_ADDITIONAL."')
           ";
           //echo $strSQL;
           $objParse = oci_parse($connection, $strSQL);
           $objExecute8 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
           if(!$objExecute8) echo "$strSQL<br>";
       }
           else echo "Insert success";
    }
}
?>
