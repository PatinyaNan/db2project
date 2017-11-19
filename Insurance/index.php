<!DOCTYPE html>
<?php
include("connection.php");
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
              $output1 ='';
              $strSQL = "SELECT * FROM PROMOTION";
              $objParse3 = oci_parse($connection, $strSQL);
              oci_execute ($objParse3,OCI_DEFAULT);

              while($row = oci_fetch_array($objParse3,OCI_BOTH))
              {
               $output1 .= '<option value="'.$row["ID_PROMOTION"].'">'.$row["PR_PRODUCT"].'</option>';
              }

              $output2 ='';
              $strSQL = "SELECT * FROM CATEGORY";
              $objParse4 = oci_parse($connection, $strSQL);
              oci_execute ($objParse4,OCI_DEFAULT);

              while($row = oci_fetch_array($objParse4,OCI_BOTH))
              {
               $output2 .= '<option value="'.$row["ID_CATEGORY"].'">'.$row["CA_NAME"].'</option>';
              }
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
 </style>

    <script>



        $(document).ready(function(){

            $('#add_button').click(function(){
                $('#product_form')[0].reset();
                $('.modal-title').text("Add Insurance");
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
                        $('#ID_INSURANCE').val(resp.ID_INSURANCE);
                        $('#IN_NAME').val(resp.IN_NAME);
                        $('#ID_PROMOTION').val(resp.ID_PROMOTION);
                        $('#ID_CATEGORY').val(resp.ID_CATEGORY);
                        $('#CONSIDERATION_CRITERIA').val(resp.CONSIDERATION_CRITERIA);
                        $('#TAX_BENEFITS').val(resp.TAX_BENEFITS);
                        $('#NOTE').val(resp.NOTE);
                        $('#INSURANCE_AFFILIATION').val(resp.INSURANCE_AFFILIATION);
                        $('.modal-title').text("Edit Product");
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
                    return '<tr id="item-'+a.ID_INSURANCE+'">\n\
                        <td>'+String(a.ID_INSURANCE)+'</td>\n\
                        <td>'+a.IN_NAME+'</td>\n\
                        <td>'+a.TAX_BENEFITS+'</td>\n\
                        <td>'+a.NOTE+'</td>\n\
                        <td>'+a.INSURANCE_AFFILIATION+'</td>\n\
                        <td>\n\
                            <button type="button" onclick="window.handleUpdate(\''+a.ID_INSURANCE+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_INSURANCE+'" data-row-id="'+a.ID_INSURANCE+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                        </td>\n\
                        <td>\n\
                            <button type="button" onclick="window.handleDelete(\''+a.ID_INSURANCE+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_INSURANCE+'" data-row-id="'+a.ID_INSURANCE+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button>\n\
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
              var ID_PROMOTION = $('#ID_PROMOTION').val();
              var ID_CATEGORY = $('#ID_CATEGORY').val();
              var CONSIDERATION_CRITERIA = $('#CONSIDERATION_CRITERIA').val();
              var TAX_BENEFITS = $('#TAX_BENEFITS').val();
              var NOTE = $('#NOTE').val();
              var INSURANCE_AFFILIATION = $('#INSURANCE_AFFILIATION').val();
              var form_data = $(this).serialize();
                  if(ID_INSURANCE != '' && IN_NAME != '' && ID_PROMOTION != '' && ID_CATEGORY != '' && CONSIDERATION_CRITERIA != '' && TAX_BENEFITS != '' && NOTE != '' && INSURANCE_AFFILIATION != '' )
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
                <h1 align="center"><b>ระบบการจัดการประกันภัย (Career)</b></h1>
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
                            <td>ID</td>
                            <td>NAME</td>
                            <td>TAX</td>
                            <td>NOTE</td>
                            <td>AFFILIATION</td>
                            <td><center>Edit</center></td>
                            <td><center>delete</center></td>
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
          <form method="post" id="product_form">
               <div class="modal-content">
                    <div class="container-fluid">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Insurance</h4>
                    </div>
                    <div class="modal-body">
                        <label>ID_Insurance</label>
                            <input type="text" name="ID_INSURANCE" id="ID_INSURANCE" class="form-control" value='<?php echo $id_insurance;?>' disabled/><br />
                        <label>Enter Insurace Name</label>
                            <input type="text" name="IN_NAME" id="IN_NAME" class="form-control" /><br />
                        <label>Select  Promotion</label>
                              <select name="ID_PROMOTION" id="ID_PROMOTION" class="form-control">
                                   <option value="">Select  Promotion</option>
                                   <?php echo $output2; ?>
                              </select> <br />
                        <label>Select  Insurace Category</label>
                              <select name="ID_CATEGORY" id="ID_CATEGORY" class="form-control">
                                   <option value="">Select  Insurace Category</option>
                                   <?php echo $output1; ?>
                              </select> <br />
                        <label>Enter Consideration Criteria</label>
                            <input type="text" name="CONSIDERATION_CRITERIA" id="CONSIDERATION_CRITERIA" class="form-control" /><br />
                        <label>Enter Tax Benefits</label>
                            <input type="text" name="TAX_BENEFITS" id="TAX_BENEFITS" class="form-control" /><br />
                        <label>Enter Note</label>
                            <input type="text" name="NOTE" id="NOTE" class="form-control" /><br />
                        <label>Enter Affilations</label>
                            <input type="text" name="INSURANCE_AFFILIATION" id="INSURANCE_AFFILIATION" class="form-control" /><br />
                    </div>
                    <div class="modal-footer">
                         <input type="hidden" name="product_id" id="product_id" />
                         <input type="hidden" name="operation" id="operation" />
                         <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    </div>
               </div>
          </form>
     </div>
</div>
