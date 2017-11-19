<!DOCTYPE html>
<?php
include("connection.php");
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


//---------------------------------------------------------ID_DEATH_BENEFIT--------------------------------------------------------------------

                $output1 ='';
                //$strSQL = "SELECT A.ID_INSURANCE , A.IN_NAME , B.ID_CATEGORY , B.CA_NAME FROM INSURANCE A JOIN CATEGORY B ON (A.ID_CATEGORY = B.ID_CATEGORY)";
                $strSQL = "SELECT ID_INSURANCE , IN_NAME  FROM INSURANCE";
                $objParse3 = oci_parse($connection, $strSQL);
                oci_execute ($objParse3,OCI_DEFAULT);

                while($row = oci_fetch_array($objParse3,OCI_BOTH))
                {
                 $output1 .= '<option value="'.$row["ID_INSURANCE"].'">'.$row["IN_NAME"].'</option>';
                }

                $output2 ='';
                $strSQL = "SELECT ID_CATEGORY , CA_NAME FROM  CATEGORY";
                $objParse3 = oci_parse($connection, $strSQL);
                oci_execute ($objParse3,OCI_DEFAULT);

                while($row = oci_fetch_array($objParse3,OCI_BOTH))
                {
                 $output2 .= '<option value="'.$row["ID_CATEGORY"].'">'.$row["CA_NAME"].'</option>';
                }



                // listbox สัญญาเพิ่มเติม
                $Query="select * from CATEGORY where NOT(CA_NAME) = 'สัญญาเพิ่มเติม'";
                $sql_row1 = oci_parse($connection, $Query);
                oci_execute ($sql_row1,OCI_DEFAULT);

                /* listbox พนักงาน */
                $Query= "SELECT * FROM PROMOTION where PR_START_DATE = (SELECT MAX(PR_START_DATE) from PROMOTION )";
                $sql_row2 = oci_parse($connection, $Query);
                oci_execute ($sql_row2,OCI_DEFAULT);


?>
<html>
    <head>
        <title>Prudential</title>
        <meta charset="utf-8">
        <title></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">

<style>
         body
         {
              margin:0;
              padding:0;
              background-color:#f1f1f1;
         }
         #add_button
         {
              cursor:pointer;
          }
          #action
          {
               cursor:pointer;
          }
           .close
          {
                cursor:pointer;
          }
          .container-fluid{
                margin-top: 10px;

          }
          .box
          {
               width:1270px;
               padding:20px;
               background-color:#fff;
               border:1px solid #ccc;
               border-radius:5px;
               margin-top:25px;
          }
          .pull
          {
              background-color:#F5F5F5;
              border:1px solid #ccc;
              margin-top:15px;
              border-radius:5px;
          }
          h1{
              font-size: 26px;
              font-variant: small-caps;
              font-style: italic;
              font-family: Cloud Light;
              margin-top:15px;
          }
          #customForm {
          	display: flex;
          	flex-flow: row wrap;
          }

          #customForm fieldset {
          	flex: 1;
          	border: 1px solid #aaa;
          	margin: 0.5em;
          }

          #customForm fieldset legend {
          	padding: 5px 20px;
          	border: 1px solid #aaa;
          	font-weight: bold;
          }

          /*#customForm fieldset.Age_insurance {
          	flex: 2 100%;
          }*/

          #customForm fieldset.Age_insurance legend {
          	background: #bfffbf;
            width: 140px;
            border-radius: 5px;
          }
          #customForm fieldset.AGE {
             flex: 2 100%;
          }
          #customForm fieldset.AGE legend {
          	background: #ffffbf;
            width: 180px;
            border-radius: 5px;
          }
          #customForm fieldset.treatment {
           flex: 2 100%;
          }
          #customForm fieldset.treatment legend {
          	background: #99CCFF;
            width: 300px;
            border-radius: 5px;
          }

          #customForm div.DTE_Field {
          	padding: 5px;
          }
          #customForm fieldset.Dath {
           flex: 2 100%;
          }
          #customForm fieldset.Dath legend {
            background: #9370DB;
            width: 250px;
            border-radius: 5px;
          }
          #customForm fieldset.Address {
          	flex: 2 100%;
          }
          #customForm fieldset.Address legend {
            background: #99FFFF;
            width: 80px;
            border-radius: 5px;
          }
          /*#customForm fieldset.Insurance {
              flex: 2 100%;
          }
          #customForm fieldset.Insurance legend {
              background: #ffffbf;
            width: 120px;
            border-radius: 5px;
          }*/

          #customForm fieldset.cash legend {
              background: #ffffbf;
            width: 140px;
            border-radius: 5px;
          }
          #customForm fieldset.insurance {
           flex: 2 100%;
          }
          #customForm fieldset.insurance legend {
              background: #ffbfbf;
            width: 120px;
            border-radius: 5px;
          }
          div.close_test {
                          position: absolute;
            top: -11px;
            right: -11px;
            width: 30px;
            height: 30px;
            border: 2px solid white;
            background-color: black;
            text-align: center;
            border-radius: 15px;
            cursor: pointer;
            z-index: 20;
            box-shadow: 2px 2px 6px #111;
          					}
            div.close_test:after {
                content: '\00d7';
                color: white;
                font-weight: bold;
                font-size: 18px;
                line-height: 22px;
                font-family: 'Courier New', Courier, monospace;
                padding-left: 1px;
            }
            _reboot.scss:31
            *, *::before, *::after {
            }
            _reboot.scss:24
            *, ::after, ::before {
                box-sizing: border-box;
            }
            legend{
                font-size: 16px;
                font-family: font-family: Courier New;
                margin-top:15px;
            }
            input{
                border-radius: 3px;
                font-size: 16px;
                font-family: font-family: Courier New;

            }
 </style>

 <script>
        //ประเภทประกันภัย
        $(document).ready(function(){
            $('#ID_CATEGORY').change(function() {
                $.ajax({
                    type: 'POST',
                    data: {ID_CATEGORY: $(this).val()},
                    url: 'Insurance.php',
                    success: function(data) {
                        $('#ID_INSURANCE').html(data);
                    }
                });
                return false;
            });
            //เลือกประกันภัย
            $('#ID_INSURANCE').change(function() {
                $.ajax({
                    type: 'POST',
                    data: {ID_INSURANCE: $(this).val()},
                    url: 'Additional.php',
                    success: function(data) {
                        $('#ID_ADDITIONAL').html(data);
                        console.log(data);
                    }
                });
                return false;
            });
            //เลือกพนักงานเฉพาะฝ่ายขาย
            $('#EMPLOYEEID').change(function() {
                $.ajax({
                    type: 'POST',
                    data: {EMPLOYEEID: $(this).val()},
                    url: 'employee.php',
                    success: function(data) {
                        $('#FIRSTNAME').html(data);
                        console.log(data);
                    }
                });
                return false;
            });

            //ปุ่ม Add
            $('#add_button').click(function(){
                $('#product_form')[0].reset();
                $('.modal-title').text("Add Career");
                $('#action').val("Add");
                $('#operation').val("Add");
            });

            //Edit
            window.handleUpdate = function(id){
                $.ajax({
                    url: "fetch_single.php",
                    method: "POST",
                    data: {
                        product_id: id
                    },
                    dataType:"json",
                    success: function(resp){
                        $('#career_id').val(resp.ID_CAREER);
                        $('#career_name').val(resp.CAR_NAME);
                        $('.modal-title').text("Edit Career");
                        $('#product_id').val(id);
                        $('#action').val("Edit");
                        $('#operation').val("Edit");
                        $('#productModal').modal('show');
                        //console.log(resp)

                    },
                    error: function(err){
                        console.log(err)
                    }
               });

            }


            // Delete
            window.handleDelete = function(id){
                if(confirm("Are you sure you want to delete this?"))
                {
                    $.ajax({
                        url:"delete.php",
                        method:"POST",
                        data:{
                            product_id:id
                        },
                        success:function(data) {
                            console.log('delete success',data)
                            if(data === 'success'){
                                $('#item-'+id).hide();
                                $('#notify').html('<div class="label label-success">Success</div>');
                            }else{
                                $('#notify').html('<div class="label label-danger">Delete failure</div>');
                            }
                        }
                    })
                }
            }

            // Fetch all
            $.get('fetch.php', (data) => {
                const fetchData = JSON.parse(data)
                const html = fetchData.rows.map((a, b) => {
                    return '<tr id="item-'+a.ID_CAREER+'">\n\
                        <td>'+String(a.ID_CAREER)+'</td>\n\
                        <td>'+a.CAR_NAME+'</td>\n\
                        <td>\n\
                            <center><button type="button" onclick="window.handleUpdate(\''+a.ID_CAREER+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_CAREER+'" data-row-id="'+a.ID_CAREER+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                            <button type="button" onclick="window.handleDelete(\''+a.ID_CAREER+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_CAREER+'" data-row-id="'+a.ID_CAREER+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button></center>\n\
                        </td>\n\
                    </tr>';

                });
                $('#myBody').html(html)
            });

            //dataTables
            setTimeout(() => {
                var table = $('#myTable').DataTable();
            },1000);

            //insert
         $(document).on('submit', '#product_form', function(event){
              event.preventDefault();
            var ID_INSURANCE = $('#ID_INSURANCE').val();
            var IN_NAME = $('#IN_NAME').val();
            var TAX_BENEFITS = $('#TAX_BENEFITS').val();
            var CONSIDERATION_CRITERIA = $('#CONSIDERATION_CRITERIA').val();
            var NOTE = $('#NOTE').val();
            var INSURANCE_AFFILIATION = $('#INSURANCE_AFFILIATION').val();
            var ID_PROMOTION = $('#ID_PROMOTION').val();
            var ID_CATEGORY = $('#ID_CATEGORY').val();
            var ID_CASH_COUPON = $('#ID_CASH_COUPON').val();
            var START_INSURANCE = $('#START_INSURANCE').val();
            var END_INSURANCE = $('#END_INSURANCE').val();
            var START_AGE_INSURACE = $('#START_AGE_INSURACE').val();
            var END_AGE_INSURANCE = $('#END_AGE_INSURANCE').val();
            var CASH_PERCENT = $('#CASH_PERCENT').val();
            var ID_ISSUE_AGE = $('#ID_ISSUE_AGE').val();
            var START_AGE_MONTH = $('#START_AGE_MONTH').val();
            var END_AGE_MONTH = $('#END_AGE_MONTH').val();
            var START_AGE_PREMIUM = $('#START_AGE_PREMIUM').val();
            var END_AGE_PREMIUM = $('#END_AGE_PREMIUM').val();
            var ID_SUM_ASSURED = $('#ID_SUM_ASSURED').val();
            var MINIMUM_SUM_ASSURED = $('#MINIMUM_SUM_ASSURED').val();
            var MAXIMUM_SUM_ASSURED = $('#MAXIMUM_SUM_ASSURED').val();
            var PAYMENT_TERM = $('#PAYMENT_TERM').val();
            var COVERAGE_TERM = $('#COVERAGE_TERM').val();
            var DISCOUNT = $('#DISCOUNT').val();
            var ID_MATURITY_BENEFIT = $('#ID_MATURITY_BENEFIT').val();
            var MA_END_INSURANCE = $('#MA_END_INSURANCE').val();
            var MA_END_AGE = $('#MA_END_AGE').val();
            var MA_START_PERCENT = $('#MA_START_PERCENT').val();
            var MA_END_PERCENT = $('#MA_END_PERCENT').val();
            var ID_DEATH_BENEFIT = $('#ID_DEATH_BENEFIT').val();
            var DE_START_INSURANCE = $('#DE_START_INSURANCE').val();
            var DE_END_INSURANCE = $('#DE_END_INSURANCE').val();
            var DE_START_AGE = $('#DE_START_AGE').val();
            var DE_END_AGE = $('#DE_END_AGE').val();
            var DE_PERCENT = $('#DE_PERCENT').val();
            var DE_MONEY = $('#DE_MONEY').val();
            var form_data = $(this).serialize();

                 if(ID_INSURANCE != '' && IN_NAME != '' && INSURANCE_AFFILIATION != '' && ID_CATEGORY != '' && ID_CASH_COUPON != ''
                    && ID_ISSUE_AGE != '' && ID_MATURITY_BENEFIT != '' && ID_DEATH_BENEFIT != '')
                  {
                       $.ajax({
                        url:"insert.php",
                        method:"POST",
                        data:form_data,
                            success:function(data)
                            {
                                //console.log(data-row-id);
                             alert(data);
                             $('#product_form')[0].reset();
                             $('#productModal').modal('hide');
                             window.location.reload()
                            }
                   });
                  }
                  else
                  {
                       alert("All Fields are Required");
                  }
         });


         $(document).on("loaded.rs.jquery.bootgrid", function()
             {
                  productTable.find(".delete").on("click", function(event)
                  {
                       if(confirm("Are you sure you want to delete this?"))
                       {
                            var product_id = $(this).data("row-id");
                                $.ajax({
                                 url:"delete.php",
                                 method:"POST",
                                 data:{product_id:product_id},
                                     success:function(data)
                                     {
                                         //console.log(data-row-id);
                                          alert(data);
                                          //$('#product_data').DataTable('reload');
                                          //$('#myTable').data.reload()
                                          window.location.reload()
                                     }
                            })
                       }
                       else{
                           return false;
                       }
                  });
             });
        });

</script>


    </head>
    <body>
        <div class="container box">
            <div class="pull" align="right">
                <h1 align="center"><b>การจัดการอาชีพ (Career)</b></h1>
            </div>
            <div class="container" align="right">
                <br><br><button id="add_button" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-success" style="border-radius:5px;"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button><br>
            </div>
                <div class="table-responsive">
                 <table id="myTable"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                       <tr class="bg-primary">
                            <td>ID_CAREER</td>
                            <td>CAREER</td>
                            <td><center>Commands</center></td>
                       </tr>
                  </thead>
                  <tbody id="myBody"></tbody>
                 </table>
             </div>
          <div id="notify"></div>
        </div>
    </body>
</html>

<!-- ฟอร์มสำหรับ insert update  -->

<div id="productModal" class="modal fade">
     <div class="modal-dialog">
               <div class="modal-content">
                   <div class="DTED_Lightbox_Background" style="opacity: 1;">
                       <div></div>
                   </div>
                   <div class="DTED DTED_Lightbox_Wrapper" style="opacity: 1; top: 0px;">
                       <div class="DTED_Lightbox_Container"><div class="DTED_Lightbox_Content_Wrapper">
                           <div class="DTED_Lightbox_Content" style="height: auto;">
                               <div class="DTE DTE_Action_Create">
                                   <div data-dte-e="head" class="DTE_Header">
                                       <div class="DTE_Header_Content"><b>Create Insurance</b></div>
                                   </div>
                                   <div data-dte-e="processing" class="DTE_Processing_Indicator"><span></span></div>
                                   <div data-dte-e="body" class="DTE_Body">
                                       <div data-dte-e="body_content" class="DTE_Body_Content" style="max-height: 520px;">
                                           <div data-dte-e="form_info" class="DTE_Form_Info" style="display: none;"></div>
                                          <form method="post" id="product_form" name="product_form" action="#">
                                               <div data-dte-e="form_content" class="DTE_Form_Content">

                                                   <div id="customForm">

                                                       <fieldset class="insurance">
                                                           <legend>ประกันภัย</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสประกันภัย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_INSURANCE" id="ID_INSURANCE" class="form-control" value='<?php echo $id_insurance;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                               <editor-field name="last_name"></editor-field>
                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                                   <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">ประเภทประกันภัย :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                                   <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="ID_CATEGORY" id="ID_CATEGORY" class="form-control">
                                                                           <option value="">เลือกประเภทประกันภัย</option>
                                                                           <?php
                                                                               while($Result = oci_fetch_array($sql_row1,OCI_BOTH)) {
                                                                               ?>
                                                                               <option value="<?php echo $Result['ID_CATEGORY']; ?>">
                                                                                   <?php echo $Result['CA_NAME']; ?>
                                                                               </option>
                                                                               <?php
                                                                           }
                                                                           ?>
                                                                       </select>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">ชื่อประกันภัย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="text"  name="IN_NAME"  id="IN_NAME" class="form-control"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">สิทธิประโยชน์ทางภาษี :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="text"  name="TAX_BENEFITS"  id="TAX_BENEFITS" class="form-control"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">หลักเกณฑ์การรับพิจารณารับประกันภัย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="text"  name="CONSIDERATION_CRITERIA"  id="CONSIDERATION_CRITERIA" class="form-control"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">หมายเหตุ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="text"  name="NOTE"  id="NOTE" class="form-control"/>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">สังกัด :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="INSURANCE_AFFILIATION" id="INSURANCE_AFFILIATION" class="form-control">
                                                                           <option value="">เลือกสังกัด</option>
                                                                           <option value="Prudential">Prudential</option>
                                                                           <option value="ธนาคารธนชาต">ธนาคารธนชาต</option>
                                                                           <option value="ธนาคารยูโอบี">ธนาคารยูโอบี</option>
                                                                           <option value="ธนาคารTISCO">ธนาคารTISCO</option>
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">โปรโมชั่น:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <select name="ID_PROMOTION" id="ID_PROMOTION" class="form-control">
                                                                       <option value="">เลือกโปรโมชั่น</option>
                                                                       <?php
                                                                           while($Result = oci_fetch_array($sql_row2,OCI_BOTH)) {
                                                                           ?>
                                                                           <option value="<?php echo $Result['ID_PROMOTION']; ?>">
                                                                               <?php echo $Result['PR_PRODUCT']; ?>
                                                                           </option>
                                                                           <?php
                                                                       }
                                                                       ?>
                                                                   </select>
                                                               </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>


                                                       <fieldset class="cash">
                                                           <legend>เงินคืน</legend>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">รหัสเงินคืน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_CASH_COUPON" id="ID_CASH_COUPON" class="form-control" value='<?php echo $id_cash;?>' disabled>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">เริ่มสิ้นปีกรมธรรม์ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="START_INSURANCE"  id="START_INSURANCE" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">สิ้นสุดปีกรมธรรม์ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="END_INSURANCE"  id="END_INSURANCE" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">เริ่มอายุเงินคืน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="START_AGE_INSURACE"  id="START_AGE_INSURACE" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">สิ้นสุดอายุเงินคืน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="END_AGE_INSURANCE"  id="END_AGE_INSURANCE" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">เปอร์เซ็นเงินคืน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="CASH_PERCENT"  id="CASH_PERCENT" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>

                                                       <fieldset class="Age_insurance">
                                                           <legend>อายุรับประกัน</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสอายุรับประกัน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_ISSUE_AGE" id="ID_ISSUE_AGE" class="form-control" value='<?php echo $id_age;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">เริ่มอายุรับประกัน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="START_AGE_MONTH"  id="START_AGE_MONTH" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">สิ้นสุดอายุรับประกัน:
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input type="number"  name="END_AGE_MONTH"  id="END_AGE_MONTH" class="form-control" min="0" max="99"/>
                                                               </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">เริ่มอายุผู้ชำระเบี้ยประกัน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input type="number"  name="START_AGE_PREMIUM"  id="START_AGE_PREMIUM" class="form-control" min="0" max="99"/>
                                                               </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">สิ้นสุดอายุผู้ชำระเบี้ยประกัน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input type="number"  name="END_AGE_PREMIUM"  id="END_AGE_PREMIUM" class="form-control" min="0" max="99"/>
                                                               </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>


                                                       <fieldset class="AGE">
                                                           <legend>ทุนประกันภัย</legend>

                                                           <editor-field name="extn"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_extn">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_extn">รหัสทุนประภัย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input itype="text" name="ID_SUM_ASSURED" id="ID_SUM_ASSURED" class="form-control" value='<?php echo $id_sum;?>' disabled>
                                                               </div>
                                                               </div>
                                                           </div>

                                                          <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">ทุนประกันภัยขั้นต่ำ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                 <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                    <input type="number"  name="MINIMUM_SUM_ASSURED"  id="MINIMUM_SUM_ASSURED" class="form-control" min="0" max="99"/>
                                                                 </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="office"></editor-field>
                                                            <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                                <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">ทุนประกันภัยสูงสุด :
                                                                    <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                                </label>
                                                                <div data-dte-e="input" class="DTE_Field_Input">
                                                                  <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="number"  name="MAXIMUM_SUM_ASSURED"  id="MAXIMUM_SUM_ASSURED" class="form-control" min="0" max="99"/>
                                                                  </div>
                                                                </div>
                                                            </div>

                                                            <editor-field name="office"></editor-field>
                                                             <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                                 <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">ระยะเวลาชำระเบี้ยประกันภัย :
                                                                     <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                                 </label>
                                                                 <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                         <input type="number"  name="PAYMENT_TERM"  id="PAYMENT_TERM" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                                 </div>
                                                             </div>

                                                             <editor-field name="office"></editor-field>
                                                              <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                                  <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">ระยะเวลาเอาประกันภัย :
                                                                      <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                                  </label>
                                                                  <div data-dte-e="input" class="DTE_Field_Input">
                                                                    <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                          <input type="number"  name="COVERAGE_TERM"  id="COVERAGE_TERM" class="form-control" min="0" max="99"/>
                                                                    </div>
                                                                  </div>
                                                              </div>

                                                              <editor-field name="office"></editor-field>
                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                                   <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">อัตราส่วนลดเบี้ยตามทุนประกันภัย 1,000 บาท :
                                                                       <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                                   </label>
                                                                   <div data-dte-e="input" class="DTE_Field_Input">
                                                                     <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                            <input type="number"  name="DISCOUNT"  id="DISCOUNT" class="form-control" min="0" max="99"/>
                                                                     </div>
                                                                   </div>
                                                               </div>
                                                       </fieldset>


                                                       <fieldset class="treatment">
                                                           <legend>ผลประโยชน์เมื่อครบกำหนดสัญญา</legend>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">รหัสผลประโยชน์เมื่อครบกำหนดสัญญา :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input itype="text" name="ID_MATURITY_BENEFIT" id="ID_MATURITY_BENEFIT" class="form-control" value='<?php echo $id_ma;?>' disabled>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">สิ้นสุดสิ้นปีกรมธรรม์กรณีครบกำหนดสัญญา:
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="number"  name="MA_END_INSURANCE"  id="MA_END_INSURANCE" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>


                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">สิ้นสุดอายุณีครบกำหนดสัญญา:
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="number"  name="MA_END_AGE"  id="MA_END_AGE" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>


                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">เปอร์เซ็ตเริ่มต้นเงินคืนกรณีครบกำหนดสัญญา :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="MA_START_PERCENT"  id="MA_START_PERCENT" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>


                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">เปอร์เซ็ตสิ้นสุดเงินคืนกรณีครบกำหนดสัญญา :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="MA_END_PERCENT"  id="MA_END_PERCENT" class="form-control" min="0" max="99"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                       </fieldset>



                                                       <fieldset class="Dath">
                                                           <legend>ผลประโยชน์กรณีเสียชีวิต</legend>

                                                           <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">รหัสผลประโยชน์กรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input itype="text" name="ID_DEATH_BENEFIT" id="ID_DEATH_BENEFIT" class="form-control" value='<?php echo $id_death;?>' disabled>
                                                               </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">เริ่มสิ้นปีกรมธรรม์กรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                     <input type="number"  name="DE_START_INSURANCE"  id="DE_START_INSURANCE" class="form-control" min="0" max="99"/>
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">สิ้นสุดปีกรมธรรม์กรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="number"  name="DE_END_INSURANCE"  id="DE_END_INSURANCE" class="form-control" min="0" max="99"/>
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">เริ่มอายุกรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="number"  name="DE_START_AGE"  id="DE_START_AGE" class="form-control" min="0" max="99"/>
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">สิ้นสุดอายุกรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="number"  name="DE_END_AGE"  id="DE_END_AGE" class="form-control" min="0" max="99"/>
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">เปอร์เซ็นเงินคืนกรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                     <input type="number"  name="DE_PERCENT"  id="DE_PERCENT" class="form-control" min="0" max="99"/>
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">เงินคืนกรณีเสียชีวิต :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                     <input type="number"  name="DE_MONEY"  id="DE_MONEY" class="form-control" min="0" max="99"/>
                                                                   </div>

                                                               </div>
                                                           </div>
                                                       </fieldset>

                                                     </div>
                                                 </div>
                                             </div>
                                           <div data-dte-e="foot" class="DTE_Footer" style="text-indent: -1px;">
                                               <div class="DTE_Footer_Content"></div><div data-dte-e="form_error" class="DTE_Form_Error" style="display: none;"></div>
                                                    <div data-dte-e="form_buttons" class="DTE_Form_Buttons">
                                                        <input type="hidden" name="product_id" id="product_id" />
                                                        <input type="hidden" name="operation" id="operation" />
                                                        <!-- <input type="submit" name="action" id="action" class="btn btn-success" value="Add" /> -->
                                                        <button type="submit" name="action" id="action" class="btn" tabindex="0">Create</button>
                                                    </div>
                                           </div>
                                        </form>
                                   </div>
                                           <div class="close_test" data-dismiss="modal"></div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
     </div>
</div>
