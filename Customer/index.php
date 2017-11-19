<!DOCTYPE html>
<?php
include("connection.php");
     $row_cus = 0;
     $id_cus ='';
     $data_customer = array();
     $strSQL = "SELECT ID_CUSTOMER FROM CUSTOMER ORDER BY ID_CUSTOMER ASC";
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
                $('.modal-title').text("Add Customer");
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
                        $('#ID_CUSTOMER').val(resp.ID_CUSTOMER);
                        $('#FIRST_NAME').val(resp.FIRST_NAME);
                        $('#LAST_NAME').val(resp.LAST_NAME);
                        $('#AGE').val(resp.AGE);
                        $('#BIRTH_DAY').val(resp.BIRTH_DAY);
                        $('#PHONE_NUMBER').val(resp.PHONE_NUMBER);
                        $('#EMAIL').val(resp.EMAIL);
                        $('#GENDER').val(resp.GENDER);
                        $('#NATIONALITY').val(resp.NATIONALITY);
                        $('#STATUST').val(resp.STATUST);
                        $('#STATUST_BICYCLE').val(resp.STATUST_BICYCLE);
                        $('.modal-title').text("Edit Customer");
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
                    return '<tr id="item-'+a.ID_CUSTOMER+'">\n\
                        <td>'+String(a.ID_CUSTOMER)+'</td>\n\
                        <td>'+a.FIRST_NAME+'</td>\n\
                        <td>'+a.LAST_NAME+'</td>\n\
                        <td>'+a.AGE+'</td>\n\
                        <td>\n\
                            <center><button type="button" onclick="window.handleUpdate(\''+a.ID_CUSTOMER+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_CUSTOMER+'" data-row-id="'+a.ID_CUSTOMER+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                            <button type="button" onclick="window.handleDelete(\''+a.ID_CUSTOMER+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_CUSTOMER+'" data-row-id="'+a.ID_CUSTOMER+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button></center>\n\
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
              var ID_CUSTOMER = $('#ID_CUSTOMER').val();
              var FIRST_NAME = $('#FIRST_NAME').val();
              var LAST_NAME = $('#LAST_NAME').val();
              var AGE = $('#AGE').val();
              var BIRTH_DAY = $('#BIRTH_DAY').val();
              var PHONE_NUMBER = $('#PHONE_NUMBER').val();
              var EMAIL = $('#EMAIL').val();
              var GENDER = $('#GENDER').val();
              var NATIONALITY = $('#NATIONALITY').val();
              var STATUST = $('#STATUST').val();
              var STATUST_BICYCLE = $('#STATUST_BICYCLE').val();
              var form_data = $(this).serialize();
                  if(ID_CUSTOMER != '' && FIRST_NAME != ''&& LAST_NAME != ''&& AGE != ''
                  && BIRTH_DAY != ''&& PHONE_NUMBER != ''&& STATUST_BICYCLE != ''
                  && EMAIL != ''&& GENDER != ''&& NATIONALITY != ''&& STATUST != '')
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
                   //alert("All Fields are Required");
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
                <h1 align="center"><b>ระบบการจัดการลูกค้า (Customer)</b></h1>
            </div>
            <div class="container" align="right">
                <br><br><button id="add_button" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-success" style="border-radius:5px;"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button><br>
            </div>
                <div class="table-responsive">
                 <table id="myTable"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                       <tr class="bg-primary">
                            <td>ID_CUSTOMER</td>
                            <td>FIRST_NAME</td>
                            <td>LAST_NAME</td>
                            <td>AGE</td>

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
          <form method="post" id="product_form">
               <div class="modal-content">
                    <div class="container-fluid">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Customer</h4>
                    </div>
                    <div class="modal-body">
                        <label>ID_CUSTOMER</label>
                            <input type="text" name="ID_CUSTOMER" id="ID_CUSTOMER" class="form-control" value='<?php echo $id_cus;?>' disabled/><br />
                        <label>Enter First Name</label>
                            <input type="text" name="FIRST_NAME" id="FIRST_NAME" class="form-control" /><br />
                        <label>Enter Last Name</label>
                            <input type="text" name="LAST_NAME" id="LAST_NAME" class="form-control" /><br />
                        <label>Enter Age</label>
                            <input type="number" name="AGE" id="AGE" class="form-control" maxlength="2"/><br />
                        <label>Enter Birthe Day</label>
                            <input type="date" name="BIRTH_DAY" id="BIRTH_DAY" class="form-control" /><br />
                        <label>Enter Phone Number</label>
                            <input type="text" name="PHONE_NUMBER" id="PHONE_NUMBER" class="form-control" maxlength="10"/><br />
                        <label>Enter E-mail</label>
                            <input type="email" name="EMAIL" id="EMAIL" class="form-control" /><br />
                        <label>Enter Gender</label>
                            <select name="GENDER" id="GENDER" class="form-control">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select><br />
                        <label>Enter Nationality</label>
                            <input type="text" name="NATIONALITY" id="NATIONALITY" class="form-control" /><br />
                        <label>Enter Statust</label>
                            <select name="STATUST" id="STATUST" class="form-control">
                              <option value="single">โสด</option>
                              <option value="married">สมรส</option>
                            </select><br />
                        <label>Enter Statust Motorcycles</label>
                            <select name="STATUST_BICYCLE" id="STATUST_BICYCLE" class="form-control">
                              <option value="use">ใช้</option>
                              <option value="not_use">ไม่ใช้</option>
                            </select><br />
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
