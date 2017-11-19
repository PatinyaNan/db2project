<!DOCTYPE html>
<?php
include("connection.php");
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
        <link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
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
                $('.modal-title').text("Add Hospital");
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
                        $('#ID_HOSPITAL_NETWORK').val(resp.ID_HOSPITAL_NETWORK);
                        $('#HOS_NAME').val(resp.HOS_NAME);
                        $('#HOS_ADDRESS').val(resp.HOS_ADDRESS);
                        $('#HOS_PHONE_NUMBER').val(resp.HOS_PHONE_NUMBER);
                        $('#HOS_SECTOR').val(resp.HOS_SECTOR);
                        $('#HOS_COUNTY').val(resp.HOS_COUNTY);
                        $('.modal-title').text("Edit Hospital Network");
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
                    return '<tr id="item-'+a.ID_HOSPITAL_NETWORK+'">\n\
                        <td>'+String(a.ID_HOSPITAL_NETWORK)+'</td>\n\
                        <td>'+a.HOS_NAME+'</td>\n\
                        <td>'+a.HOS_ADDRESS+'</td>\n\
                        <td>'+a.HOS_PHONE_NUMBER+'</td>\n\
                        <td>'+a.HOS_SECTOR+'</td>\n\
                        <td>'+a.HOS_COUNTY+'</td>\n\
                        <td>\n\
                            <button type="button" onclick="window.handleUpdate(\''+a.ID_HOSPITAL_NETWORK+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_HOSPITAL_NETWORK+'" data-row-id="'+a.ID_HOSPITAL_NETWORK+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                        </td>\n\
                        <td>\n\
                            <button type="button" onclick="window.handleDelete(\''+a.ID_HOSPITAL_NETWORK+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_HOSPITAL_NETWORK+'" data-row-id="'+a.ID_HOSPITAL_NETWORK+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button>\n\
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
              var form_data = $(this).serialize();
                  if(ID_HOSPITAL_NETWORK != '' && HOS_NAME != '' && HOS_ADDRESS != '' && HOS_PHONE_NUMBER != '' && HOS_SECTOR != '' && HOS_COUNTY != '')
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
                <h1 align="center"><b>ระบบการจัดการโรงพยาบาลในเครือ</b></h1>
            </div>
            <div class="container" align="right">
                <br><br><button id="add_button" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-success" style="border-radius:5px;"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button><br>
            </div>
                <div class="table-responsive">
                 <table id="myTable"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                       <tr class="bg-primary">
                            <td>ID_HOSPITAL</td>
                            <td>HOS_NAME</td>
                            <td>ADDRESS</td>
                            <td>PHONE_NUMBER</td>
                            <td>SECTOR</td>
                            <td>COUNTY</td>
                            <td><center>Edit</center></td>
                            <td><center>Delete</center></td>
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
                        <h4 class="modal-title">Add Hospital Network</h4>
                    </div>
                    <div class="modal-body">
                        <label>ID_Hospital Network</label>
                            <input type="text" name="ID_HOSPITAL_NETWORK" id="ID_HOSPITAL_NETWORK" class="form-control" value='<?php echo $id_hos;?>' disabled/><br />
                        <label>Enter Hospital Name</label>
                            <input type="text" name="HOS_NAME" id="HOS_NAME" class="form-control" /><br />
                        <label>Enter Address</label>
                            <input type="text" name="HOS_ADDRESS" id="HOS_ADDRESS" class="form-control" /><br />
                        <label>Enter Phone Number</label>
                            <input type="number" name="HOS_PHONE_NUMBER" id="HOS_PHONE_NUMBER" class="form-control" /><br />
                        <label>Enter Sector</label>
                            <input type="text" name="HOS_SECTOR" id="HOS_SECTOR" class="form-control" /><br />
                        <label>Enter County</label>
                            <input type="text" name="HOS_COUNTY" id="HOS_COUNTY" class="form-control" /><br />
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
