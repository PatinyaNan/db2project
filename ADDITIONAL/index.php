<!DOCTYPE html>
<?php
include("connection.php");
     $row_addition = 0;
     $id_additional ='';
     $data_additional = array();
     $strSQL = "SELECT ID_ADDITIONAL FROM ADDITIONAL ORDER BY ID_ADDITIONAL ASC";
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
                $('.modal-title').text("Add Additional");
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
                        $('.modal-title').text("Edit Additional");
                        $('#product_id').val(id);
                        $('#action').val("Edit");
                        $('#operation').val("Edit");
                        $('#productModal').modal('show');
                        console.log(resp)

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
                                $('#notify').html('<div class="label label-success"></div>');
                            }else{
                                $('#notify').html('<div class="label label-danger"></div>');
                            }
                        }
                    })
                }
            }

            // Fetch all
            $.get('fetch.php', (data) => {
                const fetchData = JSON.parse(data)
                const html = fetchData.rows.map((a, b) => {
                    return '<tr id="item-'+a.ID_ADDITIONAL+'">\n\
                        <td>'+String(a.ID_ADDITIONAL)+'</td>\n\
                        <td>'+a.NAME_ADDITIONAL+'</td>\n\
                        <td>'+a.ID_CATEGORY+'</td>\n\
                        <td>'+a.COVERAGE_STYLE+'</td>\n\
                        <td>\n\
                            <button type="button" onclick="window.handleUpdate(\''+a.ID_ADDITIONAL+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_ADDITIONAL+'" data-row-id="'+a.ID_ADDITIONAL+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                        </td>\n\
                        <td>\n\
                            <button type="button" onclick="window.handleDelete(\''+a.ID_ADDITIONAL+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_ADDITIONAL+'" data-row-id="'+a.ID_ADDITIONAL+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button>\n\
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
              var form_data = $(this).serialize();
                  if(ID_ADDITIONAL != '' && NAME_ADDITIONAL != '' && ID_CATEGORY != '' && COVERAGE_STYLE != '')
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
                <h1 align="center"><b>ระบบการจัดการสัญญาเพิ่มเติม</b></h1>
            </div>
            <div class="container" align="right">
                <br><br><button id="add_button" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-success" style="border-radius:5px;"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button><br>
            </div>
                <div class="table-responsive">
                 <table id="myTable"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                       <tr class="bg-primary">
                            <td>ID_ADDITIONAL</td>
                            <td>NAME_ADDITIONAL</td>
                            <td>ID_CATEGORY</td>
                            <td>COVERAGE_STYLE</td>
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
                        <h4 class="modal-title">Add Additional</h4>
                    </div>
                    <div class="modal-body">
                        <label>ID_ADDITIONAL</label>
                            <input type="text" name="ID_ADDITIONAL" id="ID_ADDITIONAL" class="form-control" value='<?php echo $id_additional;?>' disabled/><br />
                        <label>Enter Name Additional</label>
                            <input type="text" name="NAME_ADDITIONAL" id="NAME_ADDITIONAL" class="form-control" /><br />
                        <label>Enter Additional Category</label>
                            <input type="text" name="ID_CATEGORY" id="ID_CATEGORY" class="form-control" value='CA000006' disabled/><br />
                        <label>Enter Converage Style</label>
                            <input type="text" name="COVERAGE_STYLE" id="COVERAGE_STYLE" class="form-control" /><br />
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
