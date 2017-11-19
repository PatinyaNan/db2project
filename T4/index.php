<!DOCTYPE html>
<?php
include("connection.php");
$row_cus = 0;
$id_cus ='';
$data_customer = array();
$strSQL = "SELECT MAX(ID_CUSTOMER) FROM CUSTOMER ";
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
                $data_sell[$row_sell] = $objResult[0];
                $row_sell++;
            }
                $data_sell = $data_sell[$row_sell-1];
                $t = substr($data_sell,4);
                $new_id = $t+1;

                $id_sell.= "SELL".$new_id;



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




                $Query="select * from CATEGORY where NOT(CA_NAME) = 'สัญญาเพิ่มเติม'";
                $sql_row1 = oci_parse($connection, $Query);
                oci_execute ($sql_row1,OCI_DEFAULT);


                $Query2="SELECT DISTINCT(A.EMPLOYEEID) , A.FIRSTNAME , A.LASTNAME from EMPLOYEE.EMPLOYEE A JOIN EMPLOYEE.POSITION_EMP B ON (A.POSITION_ID = B.POSITION_ID)JOIN EMPLOYEE.DEPARTMENT C ON (B.DEPARTMENT_ID = B. DEPARTMENT_ID)where (C.DEPARTMENT_ID='DPM05' OR C.DEPARTMENT_ID='DPM06') AND (B.POSITION_ID ='PO050' OR B.POSITION_ID ='PO060') ORDER BY A.EMPLOYEEID ASC";
                $sql_row2 = oci_parse($connection, $Query2);
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

          #customForm fieldset.name {
          	flex: 2 100%;
          }

          #customForm fieldset.name legend {
          	background: #bfffbf;
            width: 140px;
            border-radius: 5px;
          }

          #customForm fieldset.AGE legend {
          	background: #ffffbf;
            width: 180px;
            border-radius: 5px;
          }

          #customForm fieldset.Contect legend {
          	background: #ffbfbf;
            width: 180px;
            border-radius: 5px;
          }

          #customForm div.DTE_Field {
          	padding: 5px;
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
            #customForm fieldset.Address {
            	flex: 2 100%;
            }
            #customForm fieldset.Address legend {
              background: #99FFFF;
              width: 80px;
              border-radius: 5px;
            }
            #customForm fieldset.Insurance legend {
            	background: #ffffbf;
              width: 120px;
              border-radius: 5px;
            }

            #customForm fieldset.Additional legend {
            	background: #ffbfbf;
              width: 160px;
              border-radius: 5px;
            }
            #customForm fieldset.employee legend {
            	background: #ffffbf;
              width: 140px;
              border-radius: 5px;
            }

            #customForm fieldset.sell legend {
            	background: #ffbfbf;
              width: 120px;
              border-radius: 5px;
            }


 </style>

    <script>



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
                //console.log(data);
                return false;
            });
            $('#ID_INSURANCE').change(function() {
                $.ajax({
                    type: 'POST',
                    data: {ID_INSURANCE: $(this).val()},
                    url: 'Additional.php',
                    success: function(data) {
                        //$('#INSURANCE_AFFILIATION').html(data.INSURANCE_AFFILIATION);
                        $('#ID_ADDITIONAL').html(data);
                        console.log(data);
                    }
                });

                //console.log(data);
                return false;
            });
            $('#EMPLOYEEID').change(function() {
                $.ajax({
                    type: 'POST',
                    data: {EMPLOYEEID: $(this).val()},
                    url: 'employee.php',
                    success: function(data) {
                        //$('#INSURANCE_AFFILIATION').html(data.INSURANCE_AFFILIATION);
                        $('#FIRSTNAME').html(data);
                        console.log(data);
                    }
                });

                //console.log(data);
                return false;
            });


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
                    //console.log(data)
                    //console.log(fetchData)
                    //console.log(a.ID_CAREER)
                    //console.log(data-row-id)
            });

            //dataTables
            setTimeout(() => {
                var table = $('#myTable').DataTable();
            },1000);

            //insert
         $(document).on('submit', '#product_form', function(event){
              event.preventDefault();
              var career_id = $('#career_id').val();
              var career_name = $('#career_name').val();
              var form_data = $(this).serialize();
                  if(career_id != '' && career_name != '')
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
                <!--<button type="button" class="btn btn-success">Add</button><br><br>-->
                <!--<button type="button" id="add_button" data-toggle="modal" data-target="#productModal" class="btn btn-info btn-lg">Add</button>-->
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
<div id="productModal" class="modal fade">
     <div class="modal-dialog">
         <div class="container-fluid">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Add Career</h4>
         </div>
               <div class="modal-content">
                   <div class="DTED_Lightbox_Background" style="opacity: 1;">
                       <div></div>
                   </div>
                   <div class="DTED DTED_Lightbox_Wrapper" style="opacity: 1; top: 0px;">
                       <div class="DTED_Lightbox_Container"><div class="DTED_Lightbox_Content_Wrapper">
                           <div class="DTED_Lightbox_Content" style="height: auto;">
                               <div class="DTE DTE_Action_Create">
                                   <div data-dte-e="head" class="DTE_Header">
                                       <div class="DTE_Header_Content"><b>Create new customer & Sale</b></div>
                                   </div>
                                   <div data-dte-e="processing" class="DTE_Processing_Indicator"><span></span></div>
                                   <div data-dte-e="body" class="DTE_Body">
                                       <div data-dte-e="body_content" class="DTE_Body_Content" style="max-height: 580px;">
                                           <div data-dte-e="form_info" class="DTE_Form_Info" style="display: none;"></div>
                                          <form method="post" id="product_form" name="product_form" action="#">
                                               <div data-dte-e="form_content" class="DTE_Form_Content">

                                                   <div id="customForm">

                                                       <fieldset class="sell">
                                                           <legend>การขาย</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสการขาย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_SELL" id="ID_SELL" class="form-control" value='<?php echo $id_sell;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">วันที่ทำการขาย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="text"  name="date"  id="date" class="form-control" value="<?=date('Y-m-d')?>" disabled/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>


                                                       <fieldset class="employee">
                                                           <legend>ผู้ทำการขาย</legend>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">รหัสพนักงาน :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="EMPLOYEEID" id="EMPLOYEEID" class="form-control">
                                                                           <option value="">รหัสพนักงาน</option>
                                                                           <?php
                                                                               while($Result1 = oci_fetch_array($sql_row2,OCI_BOTH)) {
                                                                               ?>
                                                                               <option value="<?php echo $Result1['EMPLOYEEID']; ?>">
                                                                                   <?php echo $Result1['EMPLOYEEID']; ?>
                                                                               </option>
                                                                               <?php
                                                                           }
                                                                           ?>
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">ชื่อ - นามสกุล :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="FIRSTNAME" id="FIRSTNAME" class="form-control" disabled></select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <!-- <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">นามสกุล :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="email" name="EMAIL" id="EMAIL" class="form-control" /><br />
                                                                   </div>
                                                               </div>
                                                           </div> -->

                                                       </fieldset>

                                                       <fieldset class="name">
                                                           <legend>ข้อมูลลูกค้า</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสลูกค้า :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_CUSTOMER" id="ID_CUSTOMER" class="form-control" value='<?php echo $id_cus;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">ชื่อ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="FIRST_NAME" id="FIRST_NAME" class="form-control">
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">นามสกุล:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input type="text" name="LAST_NAME" id="LAST_NAME" class="form-control" />
                                                               </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">สัญชาติ :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input type="text" name="NATIONALITY" id="NATIONALITY" class="form-control" /><br />
                                                               </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">เพศ :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <select name="GENDER" id="GENDER" class="form-control">
                                                                     <option value="Male">ชาย</option>
                                                                     <option value="Female">หญิง</option>
                                                                   </select><br />
                                                               </div>
                                                               </div>
                                                           </div>


                                                           <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">สถานะ :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <select name="STATUST" id="STATUST" class="form-control">
                                                                     <option value="single">โสด</option>
                                                                     <option value="married">สมรส</option>
                                                                   </select><br />
                                                               </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">สถานะการใช้รถจักรยานยนต์ :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <select name="STATUST_BICYCLE" id="STATUST_BICYCLE" class="form-control">
                                                                     <option value="use">ใช้</option>
                                                                     <option value="not_use">ไม่ใช้</option>
                                                                   </select><br />
                                                               </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>


                                                       <fieldset class="AGE">
                                                           <legend>วัน/เดือน/ปีเกิด</legend>

                                                           <editor-field name="extn"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_extn">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_extn">วันเกิด :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                   <input type="hidden" id="date1" value="2017/12/01" />
                                                                   <input type="date" name="BIRTH_DAY" id="BIRTH_DAY" onchange="dateDiff();" class="form-control" /><br />
                                                               </div>
                                                               </div>
                                                           </div>

                                                          <editor-field name="office"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">อายุ :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                 <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="text" name="AGE" id="AGE" class="form-control" readonly="readonly" disabled/><br />
                                                                 </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>


                                                       <fieldset class="Contect">
                                                           <legend>ช่่องทางติดต่อ</legend>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">เบอร์โทรศัพท์ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="text" name="PHONE_NUMBER" id="PHONE_NUMBER" class="form-control" maxlength="10"/><br />
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">อีเมล :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="email" name="EMAIL" id="EMAIL" class="form-control" /><br />
                                                                   </div>
                                                               </div>
                                                           </div>

                                                       </fieldset>


                                                       <fieldset class="Address">
                                                           <legend>ที่อยู่</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">บ้านเลขที่ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="text" name="HOUSE_NUMBER" id="HOUSE_NUMBER" class="form-control" /><br />
                                                                   </div>
                                                                   </div>
                                                               </div>
                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">ตำบล :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="text" name="DISTRICT" id="DISTRICT" class="form-control" /><br />
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">อำเภอ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                      <input type="text" name="COUNTY" id="COUNTY" class="form-control" /><br />
                                                                   </div>

                                                               </div>
                                                           </div>

                                                           <editor-field name="last_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">จังหวัด :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="PROVICE" id="PROVICE" class="form-control">
                                                                         <option value="1">กรุงเทพมหานคร</option>
                                                                         <option value="2">นครราชสีมา</option>
                                                                         <option value="3">เชียงใหม่</option>
                                                                         <option value="4">กาญจนบุรี</option>
                                                                         <option value="5">ตาก</option>
                                                                         <option value="6">อุบลราชธานี</option>
                                                                         <option value="7">สุราษฎร์ธานี</option>
                                                                         <option value="8">ชัยภูมิ</option>
                                                                         <option value="9">แม่ฮ่องสอน</option>
                                                                         <option value="10">เพชรบูรณ์</option>
                                                                         <option value="11">ลำปาง</option>
                                                                         <option value="12">อุดรธานี</option>
                                                                         <option value="13">เชียงราย</option>
                                                                         <option value="14">น่าน</option>
                                                                         <option value="15">เลย</option>
                                                                         <option value="16">ขอนแก่น</option>
                                                                         <option value="17">พิษณุโลก</option>
                                                                         <option value="18">บุรีรัมย์</option>
                                                                         <option value="19">นครศรีธรรมราช</option>
                                                                         <option value="20">สกลนคร</option>
                                                                         <option value="21">นครสวรรค์</option>
                                                                         <option value="22">ศรีสะเกษ</option>
                                                                         <option value="23">กำแพงเพชร</option>
                                                                         <option value="24">ร้อยเอ็ด</option>
                                                                         <option value="25">สุรินทร์</option>
                                                                         <option value="26">อุตรดิตถ์</option>
                                                                         <option value="27">สงขลา</option>
                                                                         <option value="28">สระแก้ว</option>
                                                                         <option value="29">กาฬสินธุ์</option>
                                                                         <option value="30">อุทัยธานี</option>
                                                                         <option value="31">สุโขทัย</option>
                                                                         <option value="32">แพร่</option>
                                                                         <option value="33">ประจวบคีรีขันธ์</option>
                                                                         <option value="34">จันทบุรี</option>
                                                                         <option value="35">พะเยา</option>
                                                                         <option value="36">เพชรบุรี</option>
                                                                         <option value="37">ลพบุรี</option>
                                                                         <option value="38">ชุมพร</option>
                                                                         <option value="39">นครพนม</option>
                                                                         <option value="40">สุพรรณบุรี</option>
                                                                         <option value="41">ฉะเชิงเทรา</option>
                                                                         <option value="42">มหาสารคาม</option>
                                                                         <option value="43">ราชบุรี</option>
                                                                         <option value="44">ตรัง</option>
                                                                         <option value="45">ปราจีนบุรี</option>
                                                                         <option value="46">กระบี่</option>
                                                                         <option value="47">พิจิตร</option>
                                                                         <option value="48">ยะลา</option>
                                                                         <option value="49">ลำพูน</option>
                                                                         <option value="50">นราธิวาส</option>
                                                                         <option value="51">ชลบุรี</option>
                                                                         <option value="52">มุกดาหาร</option>
                                                                         <option value="53">บึงกาฬ</option>
                                                                         <option value="54">พังงา</option>
                                                                         <option value="55">ยโสธร</option>
                                                                         <option value="56">หนองบัวลำภู</option>
                                                                         <option value="57">สระบุรี</option>
                                                                         <option value="58">ระยอง</option>
                                                                         <option value="59">พัทลุง</option>
                                                                         <option value="60">ระนอง</option>
                                                                         <option value="61">อำนาจเจริญ</option>
                                                                         <option value="62">หนองคาย</option>
                                                                         <option value="63">ตราด</option>
                                                                         <option value="64">พระนครศรีอยุธยา</option>
                                                                         <option value="65">สตูล</option>
                                                                         <option value="66">ชัยนาท</option>
                                                                         <option value="67">นครปฐม</option>
                                                                         <option value="68">นครนายก</option>
                                                                         <option value="69">ปัตตานี</option>
                                                                         <option value="70">ปทุมธานี</option>
                                                                         <option value="71">สมุทรปราการ</option>
                                                                         <option value="72">อ่างทอง</option>
                                                                         <option value="73">สมุทรสาคร</option>
                                                                         <option value="74">สิงห์บุรี</option>
                                                                         <option value="75">นนทบุรี</option>
                                                                         <option value="76">ภูเก็ต</option>
                                                                         <option value="77">สมุทรสงคราม</option>
                                                                       </select><br />
                                                                   </div>

                                                               </div>
                                                           </div>
                                                       </fieldset>

                                                       <fieldset class="Insurance">
                                                           <legend>ประกันภัย</legend>

                                                           <editor-field name="office"></editor-field>
                                                            <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                                <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">ประเภท :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                                <div data-dte-e="input" class="DTE_Field_Input">
                                                                  <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
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

                                                           <editor-field name="extn"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_extn">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_extn">ประกันภัย :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                  <select name="ID_INSURANCE" id="ID_INSURANCE"  class="form-control">
                                                                  </select>

                                                               </div>
                                                               </div>
                                                           </div>



                                                           <!-- <editor-field name="office"></editor-field>
                                                            <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office">
                                                                <label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">สังกัด :<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                                <div data-dte-e="input" class="DTE_Field_Input">
                                                                  <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                         <select name="INSURANCE_AFFILIATION" id="INSURANCE_AFFILIATION" class="form-control" ></select>
                                                                  </div>
                                                                </div>
                                                            </div> -->

                                                       </fieldset>


                                                       <fieldset class="Additional">
                                                           <legend>สัญญาเพิ่มเติม</legend>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">สัญญาเพิ่มเติม :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <select name="ID_ADDITIONAL" id="ID_ADDITIONAL" class="form-control" >

                                                                        </select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <!-- <editor-field name="salary"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">ประเภทสัญญาเพิ่มเติม :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="email" name="EMAIL" id="EMAIL" class="form-control" /><br />
                                                                   </div>
                                                               </div>
                                                           </div> -->

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
<script type="text/javascript">

        function dateDiff(){
        var myVar1 = document.getElementById('date1').value;//prompt("Enter a start date: ")
        var myVar2 = document.getElementById('BIRTH_DAY').value;//prompt("Enter a end date: ")

        var first_date = Date.parse(myVar1)
        var last_date = Date.parse(myVar2)
        var diff_date =  first_date - last_date;

        var num_years = diff_date/31536000000;
        var num_months = (diff_date % 31536000000)/2628000000;
        var num_days = ((diff_date % 31536000000) % 2628000000)/86400000;

        var AGE ="";

        AGE +=(" " + Math.floor(num_years) + " ปี\n");
        document.getElementById('AGE').value = AGE;
        }

        function showCompany(catid) {
            document.getElementById("product_form").submit();
        }
</script>

<!-- http://www.thaicreate.com/php/forum/100814.html -->
<!-- http://www.thaicreate.com/community/dependant-listmenu-dropdownlist.html -->
<!-- http://php-for-ecommerce.blogspot.com/2012/02/list-menu-combobox-php-jquery.html -->
