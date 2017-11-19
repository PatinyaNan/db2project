<!DOCTYPE html>
<?php
include("connection.php");
//---------------------------------------------------------ID_HOSPITAL_NETWORK--------------------------------------------------------------------
$row_hos = 0;
$id_hos ='';
$data_hos = array();
$strSQL = "SELECT ID_HOSPITAL_NETWORK FROM HOSPITAL_NETWORK ORDER BY ID_HOSPITAL_NETWORK ASC";
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

//---------------------------------------------------------ID_CONDITION_ADDITIONAL--------------------------------------------------------------------
                // $row_con = 0;
                // $id_con ='';
                // $data_con = array();
                // $strSQL = "SELECT MAX(ID_CONDITION_ADDITIONAL) FROM CONDITION_ADDITIONAL";
                // $objParse = oci_parse($connection, $strSQL);
                // oci_execute ($objParse,OCI_DEFAULT);
                //
                //     while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                //     {
                //         $data_con[$row_con] = $objResult[0];
                //         $row_con++;
                //     }
                //         $data_con = $data_con[$row_con-1];
                //         $t = substr($data_con,3);
                //         $new_id = $t+1;
                //         if($new_id <= 9 && $new_id >= 1){
                //             $id_con.= "AGE0000".$new_id;
                //         }
                //         else{
                //             $id_con.= "AGE000".$new_id;
                //         }
                //
                //         // $Query= "SELECT DISTINCT(IN_NAME) , ID_INSURANCE  FROM INSURANCE ORDER BY IN_NAME ASC";
                //         // $sql_row2 = oci_parse($connection, $Query);
                //         // oci_execute ($sql_row2,OCI_DEFAULT);
                //
                //
                        $Query="SELECT DISTINCT(HOS_SECTOR) from HOSPITAL_NETWORK where NOT(HOS_SECTOR) = 'กรุงเทพฯ และปริมลฑล'";
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
   width: 120px;
   border-radius: 5px;
 }

 #customForm fieldset.Hos legend {
     background: #66FF66;
   width: 180px;
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
 <script language=javascript>
     var aa = new Array("ตะวันออกเฉียงเหนือ","เหนือ","ตะวันตก","กลาง","ตะวันออก","ใต้");
     ตะวันออกเฉียงเหนือ = new Array("อำนาจเจริญ", "บึงกาฬ", "บุรีรัมย์", "ชัยภูมิ", "กาฬสินธุ์", "ขอนแก่น", "เลย", "มหาสารคาม", "มุกดาหาร", "นครพนม", "นครราชสีมา", "หนองบัวลำภู", "หนองคาย", "ร้อยเอ็ด", "สกลนคร", "ศรีสะเกษ"," สุรินทร์", "อุบลราชธานี", "อุดรธานี", "ยโสธร");
     เหนือ = new Array("เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "แม่ฮ่องสอน", "น่าน", "พะเยา", "แพร่", "อุตรดิตถ์","ตาก","สุโขทัย", "พิษณุโลก", "พิจิตร", "กำแพงเพชร", "เพชรบูรณ์","นครสวรรค์", "อุทัยธานี");
     ตะวันตก = new Array("อ่างทอง", "ชัยนาท", "พระนครศรีอยุธยา", "กรุงเทพมหานคร", "ลพบุรี", "นครปฐม", "นนทบุรี", "ปทุมธานี", "สมุทรปราการ", "สมุทรสาคร", "สมุทรสงคราม", "สระบุรี", "สิงห์บุรี", "สุพรรณบุรี","นครนายก");
     กลาง = new Array("ฉะเชิงเทรา", "จันทบุรี", "ชลบุรี", "ปราจีนบุรี", "ระยอง", "สระแก้ว", "ตราด");
     ตะวันออก = new Array("กาญจนบุรี", "ราชบุรี","เพชรบุรี", "ประจวบคีรีขันธ์");
     ใต้ = new Array("ชุมพร", "นครศรีธรรมราช", "นราธิวาส", "ปัตตานี", "พัทลุง", "สงขลา", "สุราษฎร์ธานี", "ยะลา","กระบี่", "พังงา", "ภูเก็ต", "ระนอง", "สตูล", "ตรัง");

     function changeval()
     {
        var val1 = document.product_form.HOS_SECTOR.value;
        var optionArray = eval(val1);
              for(var df=0; df<optionArray.length; df++)
              {
                   var ss = document.product_form.HOS_COUNTY;
                   ss.options.length = 0;
                   for(var ff=0; ff<optionArray.length; ff++)
                   {
                        var val = optionArray[ff];
                        ss.options[ff] = new Option(val,val);
                    }
                }
     }
</script>
 <script>
        //ประเภทประกันภัย
        $(document).ready(function(){

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
            var ID_HOSPITAL_NETWORK = $('#ID_HOSPITAL_NETWORK').val();
            var HOS_NAME = $('#HOS_NAME').val();
            var HOS_ADDRESS = $('#HOS_ADDRESS').val();
            var HOS_PHONE_NUMBER = $('#HOS_PHONE_NUMBER').val();
            var HOS_SECTOR = $('#HOS_SECTOR').val();
            var HOS_COUNTY = $('#HOS_COUNTY').val();
            var ID_INSURANCE = $('#ID_INSURANCE').val();
            var form_data = $(this).serialize();

                 if(ID_HOSPITAL_NETWORK != '' && HOS_NAME != '' && HOS_ADDRESS != '' && HOS_PHONE_NUMBER != '' && HOS_SECTOR != ''  && HOS_COUNTY != '' && ID_INSURANCE != '')
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
                                       <div class="DTE_Header_Content"><b>Create Hospital</b></div>
                                   </div>
                                   <div data-dte-e="processing" class="DTE_Processing_Indicator"><span></span></div>
                                   <div data-dte-e="body" class="DTE_Body">
                                       <div data-dte-e="body_content" class="DTE_Body_Content" style="max-height: 520px;">
                                           <div data-dte-e="form_info" class="DTE_Form_Info" style="display: none;"></div>
                                          <form method="post" id="product_form" name="product_form" action="#">
                                               <div data-dte-e="form_content" class="DTE_Form_Content">

                                                   <div id="customForm">

                                                       <fieldset class="insurance">
                                                           <legend>โรงพยาบาลในเครือ</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">รหัสโรงพยาบาลในเครือ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <input itype="text" name="ID_HOSPITAL_NETWORK" id="ID_HOSPITAL_NETWORK" class="form-control" value='<?php echo $id_hos;?>' disabled>
                                                                   </div>
                                                                   </div>
                                                               </div>

                                                               <editor-field name="salary"></editor-field>
                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary">
                                                                   <label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">ชื่อโรงพยาบาล :
                                                                       <div data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
                                                                   <div data-dte-e="input" class="DTE_Field_Input">
                                                                       <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                           <input type="text"  name="HOS_NAME"  id="HOS_NAME" class="form-control" />
                                                                       </div>
                                                                   </div>
                                                               </div>

                                                               <editor-field name="position"></editor-field>
                                                               <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                                   <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">เบอร์โทรศัพท์ :
                                                                       <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                                   </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                       <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                            <input type="text"  name="HOS_PHONE_NUMBER"  id="HOS_PHONE_NUMBER" class="form-control"/>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                       </fieldset>
                                                       <fieldset class="CONDITION_ADDITIONAL">
                                                           <legend>ภาค</legend>
                                                           <editor-field name="first_name"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">ภาค :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label>
                                                               <div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="HOS_SECTOR" id="HOS_SECTOR" onchange=changeval() class="form-control">
                                                                           <option value="">เลือกภูมิภาค</option>
                                                                           <script language=javascript>
                                                                               for(var dd=0; dd<aa.length; dd++)
                                                                               {
                                                                                   document.write("<option value=\""+aa[dd]+"\">"+aa[dd]+"</option>");
                                                                               }
                                                                           </script>
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">จังหวัด :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                       <select name="HOS_COUNTY"  id="HOS_COUNTY"class="form-control">
                                                                            <option value="">เลือกจังหวัด</option>
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                           </div>

                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">ที่อยู่ :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="text"  name="HOS_ADDRESS"  id="HOS_ADDRESS" class="form-control" />
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </fieldset>
                                                       <fieldset class="Hos">
                                                           <legend>สังกัดประกันภัย</legend>
                                                           <editor-field name="position"></editor-field>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">สังกัดประเภทประกันภัย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="text"  name="COVERAGE_STYLE"  id="COVERAGE_STYLE" class="form-control" value ="เพื่อการคุ้มครอง" disabled/>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position">
                                                               <label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">สังกัดประกันภัย :
                                                                   <div data-dte-e="msg-label" class="DTE_Label_Info"></div>
                                                               </label><div data-dte-e="input" class="DTE_Field_Input">
                                                                   <div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;">
                                                                        <input type="text"  name="ID_INSURANCE"  id="ID_INSURANCE" class="form-control" value="PRUhealthy" disabled/>
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
