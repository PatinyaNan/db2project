<!DOCTYPE html>
<?php
include("connection.php");
//---------------------------------------------------------ID_ADDITIONAL--------------------------------------------------------------------
$row_addition = 0;
$id_additional ='';
$data_additional = array();
$strSQL = "SELECT MAX(ID_ADDITIONAL) FROM ADDITIONAL";
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

//---------------------------------------------------------ID_CONDITION_ADDITIONAL--------------------------------------------------------------------
                $row_con = 0;
                $id_con ='';
                $data_con = array();
                $strSQL = "SELECT MAX(ID_CONDITION_ADDITIONAL) FROM CONDITION_ADDITIONAL";
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

                        // $Query= "SELECT DISTINCT(IN_NAME) , ID_INSURANCE  FROM INSURANCE ORDER BY IN_NAME ASC";
                        // $sql_row2 = oci_parse($connection, $Query);
                        // oci_execute ($sql_row2,OCI_DEFAULT);


                        $Query="select * from CATEGORY where NOT(CA_NAME) = 'สัญญาเพิ่มเติม'";
                        $sql_row1 = oci_parse($connection, $Query);
                        oci_execute ($sql_row1,OCI_DEFAULT);
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


        <meta name="description" lang="en" content="jQuery multiselect plugin with two sides. The user can select one or more items and send them to the other side."/>
        <meta name="keywords" lang="en" content="jQuery multiselect plugin" />
        <!-- <base href="http://crlcu.github.io/multiselect/" /> -->
        <link rel="icon" type="image/x-icon" href="https://github.com/favicon.ico" />
        <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /> -->
        <!-- <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />
        <link rel="stylesheet" href="css/style.css" /> -->

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


 #customForm div.DTE_Field {
   padding: 5px;
 }

 #customForm fieldset.CONDITION_ADDITIONAL {
   flex: 2 100%;
 }
 #customForm fieldset.CONDITION_ADDITIONAL legend {
   background: #99FFFF;
   width: 220px;
   border-radius: 5px;
 }

 #customForm fieldset.insurance {
  flex: 2 100%;
 }
 #customForm fieldset.insurance legend {
     background: #ffbfbf;
   width: 180px;
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
                        $('#undo_redo').html(data);
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
                    
                        $('#ID_ADDITIONAL').val(resp.ID_ADDITIONAL);
                        $('#NAME_ADDITIONAL').val(resp.NAME_ADDITIONAL);
                        $('#ID_CATEGORY').val(resp.ID_CATEGORY);
                        $('#COVERAGE_STYLE').val(resp.COVERAGE_STYLE);
                        $('#ID_ADDITIONAL_DETAILS').val(resp.ID_ADDITIONAL_DETAILS);
                        $('#ID_INSURANCE').val(resp.ID_INSURANCE);
                        $('#ID_CONDITION_ADDITIONAL').val(resp.ID_CONDITION_ADDITIONAL);
                        $('#CON_START_AGE').val(resp.CON_START_AGE);
                        $('#CON_END_AGE').val(resp.CON_END_AGE);


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
            var ID_ADDITIONAL = $('#ID_ADDITIONAL').val();
            var NAME_ADDITIONAL = $('#NAME_ADDITIONAL').val();
            var ID_CATEGORY = $('#ID_CATEGORY').val();
            var COVERAGE_STYLE = $('#COVERAGE_STYLE').val();
            var ID_ADDITIONAL_DETAILS = $('#ID_ADDITIONAL_DETAILS').val();
            var ID_INSURANCE = $('#undo_redo').val();
            var ID_CONDITION_ADDITIONAL = $('#ID_CONDITION_ADDITIONAL').val();
            var CON_START_AGE = $('#CON_START_AGE').val();
            var CON_END_AGE = $('#CON_END_AGE').val();
            var form_data = $(this).serialize();

                 if(ID_ADDITIONAL != '' && NAME_ADDITIONAL != '' && ID_CATEGORY != '' && COVERAGE_STYLE != '' && ID_INSURANCE != ''  && ID_CONDITION_ADDITIONAL != '')
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
                                       <div class="DTE_Header_Content"><b>Create Additional</b></div>
                                   </div>
                                   <div data-dte-e="processing" class="DTE_Processing_Indicator"><span></span></div>
                                   <div data-dte-e="body" class="DTE_Body">
                                       <div data-dte-e="body_content" class="DTE_Body_Content" style="max-height: 520px;">
                                           <div data-dte-e="form_info" class="DTE_Form_Info" style="display: none;"></div>
                                          <form method="post" id="product_form" name="product_form" action="#">
                                               <div data-dte-e="form_content" class="DTE_Form_Content">

                                                   <div id="customForm">

                                                       <fieldset class="insurance">
                                                           <legend>สัญญาเพิ่มเติม</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสสัญญาเพิ่มเติม :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_ADDITIONAL" id="ID_ADDITIONAL" class="form-control" value='<?php echo $id_additional;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                               <editor-field name="salary"></editor-field>
                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                                   <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">ประเภทสัญญาเพิ่มเติม :
                                                                       <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                                   <div data-dte-e="input" class="DTE_Field_Input">
                                                                       <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                           <input type="text"  name="CATEGORY"  id="CATEGORY" class="form-control" value="สัญญาเพิ่มเติม" disabled />
                                                                       </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">ชื่อสัญญาเพิ่มเติม :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="text"  name="NAME_ADDITIONAL"  id="NAME_ADDITIONAL" class="form-control"/>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">ลักษณะการคุ้มครอง :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="text"  name="COVERAGE_STYLE"  id="COVERAGE_STYLE" class="form-control"/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>
                                                       <fieldset class="insurance">
                                                           <legend>สังกัดประกันภัย</legend>
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

                                                               <editor-field name="salary"></editor-field>

                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                                   <div><label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">ประกันภัย :</label></div></br>
                                                                </div>
                                                            <div style="margin-left:50px;">
                                                               <div data-dte-e="input" class="DTE_Field_Input" style="padding:5px">
                                                                       <div class="row">
                                                                           <div class="col-xs-5">
                                                                               <select name="from[]" id="undo_redo" class="form-control" size="13" style="width:250px;" multiple="multiple">
                                                                              </select>
                                                                           </div>
                                                                           <div class="col-xs-2" style="padding:20px;">
                                                                               <button type="button" id="undo_redo_undo" class="btn">undo</button></br>
                                                                               <button type="button" id="undo_redo_rightAll" class="btn">&nbsp;&nbsp;&nbsp;<i class="fa fa-forward" aria-hidden="true"></i>&nbsp;&nbsp;</button></br>
                                                                               <button type="button" id="undo_redo_rightSelected" class="btn">&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;</i></button></br>
                                                                               <button type="button" id="undo_redo_leftSelected" class="btn">&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-left" aria-hidden="true">&nbsp;&nbsp;&nbsp;</i></button></br>
                                                                               <button type="button" id="undo_redo_leftAll" class="btn">&nbsp;&nbsp;&nbsp;<i class="fa fa-backward" aria-hidden="true">&nbsp;&nbsp;</i></button></br>
                                                                               <button type="button" id="undo_redo_redo" class="btn">&nbsp;redo</button></br>
                                                                           </div>

                                                                           <div class="col-xs-5">
                                                                               <select name="to[]" id="undo_redo_to" class="form-control" size="13" style="width:250px;" multiple="multiple"></select>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>

                                                       </fieldset>
                                                       <fieldset class="CONDITION_ADDITIONAL">
                                                           <legend>เงื่อนไขสัญญาเพิ่มเติม</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสเงื่อนไขสัญญาเพิ่มเติม :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_CONDITION_ADDITIONAL" id="ID_CONDITION_ADDITIONAL" class="form-control" value='<?php echo $id_con;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                               <editor-field name="salary"></editor-field>
                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                                   <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">เริ่มอายุการคุ้มครอง :
                                                                       <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                                   <div data-dte-e="input" class="DTE_Field_Input">
                                                                       <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                           <input type="number"  name="CON_START_AGE"  id="CON_START_AGE" class="form-control"/>
                                                                       </div>
                                                                   </div>
                                                               </div>

                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">สิ้นสุดอายุการคุ้มครอง :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input type="number"  name="CON_END_AGE"  id="CON_END_AGE" class="form-control"/>
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
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script> -->


<!-- <script type="text/javascript" src="js/multiselect.js"></script> -->
<!-- <script type="text/javascript" src="https://raw.githubusercontent.com/crlcu/multiselect/master/dist/js/multiselect.min.js"></script> -->

<!-- <script type="text/javascript" src="dist/js/multiselect.min.js"></script> -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-39934286-1', 'github.com');
    ga('send', 'pageview');
</script>

 <script type="text/javascript">
$(document).ready(function() {
    // make code pretty
    window.prettyPrint && prettyPrint();

    $('#undo_redo').multiselect();
});
</script>
<script>
/*
 * @license
 *
 * Multiselect v2.1.1
 * https://crlcu.github.io/multiselect/
 *
 * Copyright (c) 2015 Adrian Crisan
 * Licensed under the MIT license (https://github.com/crlcu/multiselect/blob/master/LICENSE)
 */
if (typeof jQuery === "undefined") { throw new Error("multiselect requires jQuery") } (function ($) { "use strict"; var version = $.fn.jquery.split(" ")[0].split("."); if (version[0] < 2 && version[1] < 7) { throw new Error("multiselect requires jQuery version 1.7 or higher") } })(jQuery); (function (factory) { if (typeof define === "function" && define.amd) { define(["jquery"], factory) } else { factory(jQuery) } })(function ($) { "use strict"; var Multiselect = function ($) { function Multiselect($select, settings) { var id = $select.prop("id"); this.left = $select; this.right = $(settings.right).length ? $(settings.right) : $("#" + id + "_to"); this.actions = { leftAll: $(settings.leftAll).length ? $(settings.leftAll) : $("#" + id + "_leftAll"), rightAll: $(settings.rightAll).length ? $(settings.rightAll) : $("#" + id + "_rightAll"), leftSelected: $(settings.leftSelected).length ? $(settings.leftSelected) : $("#" + id + "_leftSelected"), rightSelected: $(settings.rightSelected).length ? $(settings.rightSelected) : $("#" + id + "_rightSelected"), undo: $(settings.undo).length ? $(settings.undo) : $("#" + id + "_undo"), redo: $(settings.redo).length ? $(settings.redo) : $("#" + id + "_redo") }; delete settings.leftAll; delete settings.leftSelected; delete settings.right; delete settings.rightAll; delete settings.rightSelected; this.options = { keepRenderingSort: settings.keepRenderingSort }; delete settings.keepRenderingSort; this.callbacks = settings; this.init() } Multiselect.prototype = { undoStack: [], redoStack: [], init: function () { var self = this; if (self.options.keepRenderingSort) { self.skipInitSort = true; self.callbacks.sort = function (a, b) { return $(a).data("position") > $(b).data("position") ? 1 : -1 }; self.left.find("option").each(function (index, option) { $(option).data("position", index) }); self.right.find("option").each(function (index, option) { $(option).data("position", index) }) } if (typeof self.callbacks.startUp == "function") { self.callbacks.startUp(self.left, self.right) } if (!self.skipInitSort && typeof self.callbacks.sort == "function") { self.left.find("option").sort(self.callbacks.sort).appendTo(self.left); self.right.each(function (i, select) { $(select).find("option").sort(self.callbacks.sort).appendTo(select) }) } self.events(self.actions) }, events: function (actions) { var self = this; self.left.on("dblclick", "option", function (e) { e.preventDefault(); self.moveToRight(this, e) }); self.right.on("dblclick", "option", function (e) { e.preventDefault(); self.moveToLeft(this, e) }); self.right.closest("form").on("submit", function (e) { self.left.children().prop("selected", true); self.right.children().prop("selected", true) }); if (navigator.userAgent.match(/MSIE/i) || navigator.userAgent.indexOf("Trident/") > 0 || navigator.userAgent.indexOf("Edge/") > 0) { self.left.dblclick(function (e) { actions.rightSelected.trigger("click") }); self.right.dblclick(function (e) { actions.leftSelected.trigger("click") }) } actions.rightSelected.on("click", function (e) { e.preventDefault(); var options = self.left.find("option:selected"); if (options) { self.moveToRight(options, e) } $(this).blur() }); actions.leftSelected.on("click", function (e) { e.preventDefault(); var options = self.right.find("option:selected"); if (options) { self.moveToLeft(options, e) } $(this).blur() }); actions.rightAll.on("click", function (e) { e.preventDefault(); var options = self.left.find("option"); if (options) { self.moveToRight(options, e) } $(this).blur() }); actions.leftAll.on("click", function (e) { e.preventDefault(); var options = self.right.find("option"); if (options) { self.moveToLeft(options, e) } $(this).blur() }); actions.undo.on("click", function (e) { e.preventDefault(); self.undo(e) }); actions.redo.on("click", function (e) { e.preventDefault(); self.redo(e) }) }, moveToRight: function (options, event, silent, skipStack) { var self = this; if (typeof self.callbacks.moveToRight == "function") { return self.callbacks.moveToRight(self, options, event, silent, skipStack) } else { if (typeof self.callbacks.beforeMoveToRight == "function" && !silent) { if (!self.callbacks.beforeMoveToRight(self.left, self.right, options)) { return false } } self.right.append(options); if (!skipStack) { self.undoStack.push(["right", options]); self.redoStack = [] } if (typeof self.callbacks.sort == "function" && !silent) { self.right.find("option").sort(self.callbacks.sort).appendTo(self.right) } if (typeof self.callbacks.afterMoveToRight == "function" && !silent) { self.callbacks.afterMoveToRight(self.left, self.right, options) } return self } }, moveToLeft: function (options, event, silent, skipStack) { var self = this; if (typeof self.callbacks.moveToLeft == "function") { return self.callbacks.moveToLeft(self, options, event, silent, skipStack) } else { if (typeof self.callbacks.beforeMoveToLeft == "function" && !silent) { if (!self.callbacks.beforeMoveToLeft(self.left, self.right, options)) { return false } } self.left.append(options); if (!skipStack) { self.undoStack.push(["left", options]); self.redoStack = [] } if (typeof self.callbacks.sort == "function" && !silent) { self.left.find("option").sort(self.callbacks.sort).appendTo(self.left) } if (typeof self.callbacks.afterMoveToLeft == "function" && !silent) { self.callbacks.afterMoveToLeft(self.left, self.right, options) } return self } }, undo: function (event) { var self = this; var last = self.undoStack.pop(); if (last) { self.redoStack.push(last); switch (last[0]) { case "left": self.moveToRight(last[1], event, false, true); break; case "right": self.moveToLeft(last[1], event, false, true); break } } }, redo: function (event) { var self = this; var last = self.redoStack.pop(); if (last) { self.undoStack.push(last); switch (last[0]) { case "left": self.moveToLeft(last[1], event, false, true); break; case "right": self.moveToRight(last[1], event, false, true); break } } } }; return Multiselect }($); $.multiselect = { defaults: { startUp: function ($left, $right) { $right.find("option").each(function (index, option) { $left.find('option[value="' + option.value + '"]').remove() }) }, beforeMoveToRight: function ($left, $right, options) { return true }, afterMoveToRight: function ($left, $right, options) { }, beforeMoveToLeft: function ($left, $right, option) { return true }, afterMoveToLeft: function ($left, $right, option) { }, sort: function (a, b) { if (a.innerHTML == "NA") { return 1 } else if (b.innerHTML == "NA") { return -1 } return a.innerHTML > b.innerHTML ? 1 : -1 } } }; $.fn.multiselect = function (options) { return this.each(function () { var $this = $(this), data = $this.data(); var settings = $.extend({}, $.multiselect.defaults, data, options); return new Multiselect($this, settings) }) } });

jQuery(document).ready(function($) {
	$('#multiselect').multiselect();
});
</script>
