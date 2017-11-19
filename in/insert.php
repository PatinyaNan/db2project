<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
     if($_POST["operation"] == "Add")
     {
         //---------------------------------------------------------ID_INSURANCE--------------------------------------------------------------------
         $row_insurance = 0;
         $id_insurance ='';
         $data_insurance = array();
         $strSQL = "SELECT MAX(ID_INSURANCE) FROM INSURANCE ";
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

         //---------------------------------------------------------ID_CASH_COUPON--------------------------------------------------------------------

          $row_cash = 0;
          $id_cash ='';
          $data_cash = array();
          $strSQL = "SELECT MAX(ID_CASH_COUPON) FROM CASH_COUPON";
          $objParse = oci_parse($connection, $strSQL);
          oci_execute ($objParse,OCI_DEFAULT);

                 while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                 {
                  $data_cash[$row_cash] = $objResult[0];
                  $row_cash++;
                 }
                  $data_cash = $data_cash[$row_cash-1];
                  $t = substr($data_cash,3);
                  $new_id = $t+1;

                  if($new_id <= 99 && $new_id >= 10){
                      $id_cash.= "CAS000".$new_id;
                      }
                 else{
                     $id_cash.= "CAS00".$new_id;
                      }

         //---------------------------------------------------------ID_ISSUE_AGE--------------------------------------------------------------------

         $row_age = 0;
         $id_age ='';
         $data_age = array();
         $strSQL = "SELECT MAX(ID_ISSUE_AGE) FROM ISSUE_AGE";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

               while($objResult = oci_fetch_array($objParse,OCI_BOTH))
               {
                   $data_age[$row_age] = $objResult[0];
                   $row_age++;
               }
                   $data_age = $data_age[$row_age-1];
                   $t = substr($data_age,2);
                   $new_id = $t+1;

                   if($new_id <= 99 && $new_id >= 99){
                       $id_age.= "IS0000".$new_id;
                    }
                   else{
                       $id_age.= "IS000".$new_id;
                    }

         //---------------------------------------------------------ID_SUM_ASSURED--------------------------------------------------------------------

         $row_sum = 0;
         $id_sum ='';
         $data_sum = array();
         $strSQL = "SELECT MAX(ID_SUM_ASSURED) FROM SUM_ASSURED ";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

              while($objResult = oci_fetch_array($objParse,OCI_BOTH))
              {
                    $data_sum[$row_sum] = $objResult[0];
                    $row_sum++;
              }
                   $data_sum = $data_sum[$row_sum-1];
                   $t = substr($data_sum,2);
                   $new_id = $t+1;

               if($new_id <= 99 && $new_id >= 10){
                    $id_sum.= "SU0000".$new_id;
                 }
              else{
                  $id_sum.= "SU000".$new_id;
             }

             //---------------------------------------------------------ID_MATURITY_BENEFIT--------------------------------------------------------------------
         $row_ma = 0;
         $id_ma ='';
         $data_ma = array();
         $strSQL = "SELECT MAX(ID_MATURITY_BENEFIT) FROM MATURITY_BENEFIT";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

             while($objResult = oci_fetch_array($objParse,OCI_BOTH))
             {
                 $data_ma[$row_ma] = $objResult[0];
                 $row_ma++;
             }
                 $data_ma = $data_ma[$row_ma-1];
                 $t = substr($data_ma,2);
                 $new_id = $t+1;

                 if($new_id <= 99){
                      $id_ma.= "MA0000".$new_id;
                 }
                 else{
                      $id_ma.= "MA000".$new_id;
                 }

         //---------------------------------------------------------ID_DEATH_BENEFIT--------------------------------------------------------------------

         $row_death = 0;
         $id_death ='';
         $data_death = array();
         $strSQL = "SELECT MAX(ID_DEATH_BENEFIT) FROM DEATH_BENEFIT";
         $objParse = oci_parse($connection, $strSQL);
         oci_execute ($objParse,OCI_DEFAULT);

                 while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                 {
                     $data_death[$row_death] = $objResult[0];
                     $row_death++;
                 }

                     $data_death = $data_death[$row_death-1];
                     $t = substr($data_death,2);
                     $new_id = $t+1;

                     if($new_id <= 999 && $new_id >= 100){
                         $id_death.= "DE000".$new_id;
                     }
                     else{
                         $id_death.= "DE00".$new_id;
                    }
     //---------------------------------------------------------INSERT_INSURANCE--------------------------------------------------------------------

        //   $ID_CUSTOMER = $_POST["ID_CUSTOMER"];
        $IN_NAME = $_POST["IN_NAME"];
        $ID_PROMOTION = $_POST["ID_PROMOTION"];
        $ID_CATEGORY = $_POST["ID_CATEGORY"];
        $CONSIDERATION_CRITERIA = $_POST["CONSIDERATION_CRITERIA"];
        $TAX_BENEFITS = $_POST["TAX_BENEFITS"];
        $NOTE = $_POST["NOTE"];
        $INSURANCE_AFFILIATION = $_POST["INSURANCE_AFFILIATION"];

        $START_INSURANCE = $_POST["START_INSURANCE"];
        $END_INSURANCE = $_POST["END_INSURANCE"];
        $CASH_PERCENT = $_POST["CASH_PERCENT"];
        $START_AGE_INSURACE = $_POST["START_AGE_INSURACE"];
        $END_AGE_INSURANCE = $_POST["END_AGE_INSURANCE"];

        $START_AGE_MONTH = $_POST["START_AGE_MONTH"];
        $END_AGE_MONTH = $_POST["END_AGE_MONTH"];
        $START_AGE_PREMIUM = $_POST["START_AGE_PREMIUM"];
        $END_AGE_PREMIUM = $_POST["END_AGE_PREMIUM"];

        $MINIMUM_SUM_ASSURED = $_POST["MINIMUM_SUM_ASSURED"];
        $PAYMENT_TERM = $_POST["PAYMENT_TERM"];
        $COVERAGE_TERM = $_POST["COVERAGE_TERM"];
        $MAXIMUM_SUM_ASSURED = $_POST["MAXIMUM_SUM_ASSURED"];
        $DISCOUNT = $_POST["DISCOUNT"];

        $MA_END_PERCENT = $_POST["MA_END_PERCENT"];
        $MA_END_INSURANCE = $_POST["MA_END_INSURANCE"];
        $MA_START_PERCENT = $_POST["MA_START_PERCENT"];
        $MA_END_AGE = $_POST["MA_END_AGE"];

        $DE_START_INSURANCE = $_POST["DE_START_INSURANCE"];
        $DE_END_INSURANCE = $_POST["DE_END_INSURANCE"];
        $DE_PERCENT = $_POST["DE_PERCENT"];
        $DE_START_AGE = $_POST["DE_START_AGE"];
        $DE_END_AGE = $_POST["DE_END_AGE"];
        $DE_MONEY = $_POST["DE_MONEY"];


        $strSQL = "
         INSERT INTO INSURANCE(ID_INSURANCE,IN_NAME,ID_PROMOTION,ID_CATEGORY,CONSIDERATION_CRITERIA,TAX_BENEFITS,NOTE,INSURANCE_AFFILIATION)
         VALUES ('".$id_insurance."', '".$IN_NAME."', '".$ID_PROMOTION."', '".$ID_CATEGORY."', '".$CONSIDERATION_CRITERIA."', '".$TAX_BENEFITS."', '".$NOTE."', '".$INSURANCE_AFFILIATION."')
        ";
        //echo $strSQL;
        $objParse = oci_parse($connection, $strSQL);
        $objExecute = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
        if(!$objExecute) echo "$strSQL<br>";
    //---------------------------------------------------------INSERT_CASH_COUPON--------------------------------------------------------------------


        $strSQL = "
         INSERT INTO CASH_COUPON(ID_CASH_COUPON,START_INSURANCE,END_INSURANCE,CASH_PERCENT,START_AGE_INSURACE,END_AGE_INSURANCE,ID_INSURANCE)
         VALUES ('".$id_cash."', '".$START_INSURANCE."', '".$END_INSURANCE."', '".$CASH_PERCENT."', '".$START_AGE_INSURACE."', '".$END_AGE_INSURANCE."', '".$id_insurance."')
        ";
        //echo $strSQL;
        $objParse = oci_parse($connection, $strSQL);
        $objExecute1 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute1) echo "$strSQL<br>";

    //---------------------------------------------------------INSERT_ISSUE_AGE--------------------------------------------------------------------



        $strSQL = "
         INSERT INTO ISSUE_AGE(ID_ISSUE_AGE,START_AGE_MONTH,END_AGE_MONTH,START_AGE_PREMIUM,END_AGE_PREMIUM,ID_INSURANCE)
         VALUES ('".$id_age."', '".$START_AGE_MONTH."', '".$END_AGE_MONTH."', '".$START_AGE_PREMIUM."', '".$END_AGE_PREMIUM."', '".$id_insurance."')
        ";
        //echo $strSQL;
        $objParse = oci_parse($connection, $strSQL);
        $objExecute3 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute3) echo "$strSQL<br>";
//---------------------------------------------------------INSERT_SUM_ASSURED-------------------------------------------------------------------

        $strSQL = "
         INSERT INTO SUM_ASSURED(ID_SUM_ASSURED,MINIMUM_SUM_ASSURED,PAYMENT_TERM,COVERAGE_TERM,MAXIMUM_SUM_ASSURED,DISCOUNT,ID_INSURANCE)
         VALUES ('".$id_sum."', '".$MINIMUM_SUM_ASSURED."', '".$PAYMENT_TERM."', '".$COVERAGE_TERM."', '".$MAXIMUM_SUM_ASSURED."', '".$DISCOUNT."', '".$id_insurance."')
        ";
        //echo $strSQL;
        $objParse = oci_parse($connection, $strSQL);
        $objExecute4 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute4) echo "$strSQL<br>";
        //---------------------------------------------------------INSERT_MATURITY_BENEFIT-------------------------------------------------------------------



        $strSQL = "
         INSERT INTO MATURITY_BENEFIT(ID_MATURITY_BENEFIT,MA_END_PERCENT,MA_END_INSURANCE,MA_START_PERCENT,ID_INSURANCE,MA_END_AGE)
         VALUES ('".$id_ma."', '".$MA_END_PERCENT."', '".$MA_END_INSURANCE."', '".$MA_START_PERCENT."', '".$id_insurance."', '".$MA_END_AGE."')
        ";
        //echo $strSQL;
        $objParse = oci_parse($connection, $strSQL);
        $objExecute5 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
         if(!$objExecute5) echo "$strSQL<br>";
     //---------------------------------------------------------INSERT_DEATH_BENEFIT-------------------------------------------------------------------




     $strSQL = "
      INSERT INTO DEATH_BENEFIT(ID_DEATH_BENEFIT,DE_START_INSURANCE,DE_END_INSURANCE,DE_PERCENT,DE_START_AGE,DE_END_AGE,DE_MONEY,ID_INSURANCE)
      VALUES ('".$id_death."', '".$DE_START_INSURANCE."', '".$DE_END_INSURANCE."', '".$DE_PERCENT."', '".$DE_START_AGE."', '".$DE_END_AGE."', '".$DE_MONEY."', '".$id_insurance."')
     ";
     //echo $strSQL;
     $objParse = oci_parse($connection, $strSQL);
     $objExecute6 = oci_execute ($objParse,OCI_COMMIT_ON_SUCCESS);
      if(!$objExecute6) echo "$strSQL<br>";

         else echo "Insert success";
    }
}
?>
