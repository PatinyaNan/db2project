<!DOCTYPE html>
<?php
include("connection.php");
$row_sum = 0;
$id_sum ='';
$data_sum = array();
$strSQL = "SELECT ID_SUM_ASSURED FROM SUM_ASSURED ORDER BY ID_SUM_ASSURED ASC";
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

         $output2 ='';
         $strSQL = "SELECT * FROM INSURANCE";
         $objParse4 = oci_parse($connection, $strSQL);
         oci_execute ($objParse4,OCI_DEFAULT);

         while($row = oci_fetch_array($objParse4,OCI_BOTH))
         {
          $output2 .= '<option value="'.$row["ID_INSURANCE"].'">'.$row["IN_NAME"].'</option>';
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
                $('.modal-title').text("Add Product");
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
                        $('#ID_SUM_ASSURED').val(resp.ID_SUM_ASSURED);
                        $('#MINIMUM_SUM_ASSURED').val(resp.MINIMUM_SUM_ASSURED);
                        $('#PAYMENT_TERM').val(resp.PAYMENT_TERM);
                        $('#COVERAGE_TERM').val(resp.COVERAGE_TERM);
                        $('#MAXIMUM_SUM_ASSURED').val(resp.MAXIMUM_SUM_ASSURED);
                        $('#DISCOUNT').val(resp.DISCOUNT);
                        $('#ID_INSURANCE').val(resp.ID_INSURANCE);
                        $('.modal-title').text("Edit Sum Assured");
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
                    return '<tr id="item-'+a.ID_SUM_ASSURED+'">\n\
                        <td>'+String(a.ID_SUM_ASSURED)+'</td>\n\
                        <td>'+a.MINIMUM_SUM_ASSURED+'</td>\n\
                        <td>'+a.PAYMENT_TERM+'</td>\n\
                        <td>'+a.COVERAGE_TERM+'</td>\n\
                        <td>'+a.MAXIMUM_SUM_ASSURED+'</td>\n\
                        <td>'+a.DISCOUNT+'</td>\n\
                        <td>'+a.ID_INSURANCE+'</td>\n\
                        <td>\n\
                            <center><button type="button" onclick="window.handleUpdate(\''+a.ID_SUM_ASSURED+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_SUM_ASSURED+'" data-row-id="'+a.ID_SUM_ASSURED+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                            <button type="button" onclick="window.handleDelete(\''+a.ID_SUM_ASSURED+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_SUM_ASSURED+'" data-row-id="'+a.ID_SUM_ASSURED+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button></center>\n\
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
              var ID_SUM_ASSURED = $('#ID_SUM_ASSURED').val();
              var MINIMUM_SUM_ASSURED = $('#MINIMUM_SUM_ASSURED').val();
              var PAYMENT_TERM = $('#PAYMENT_TERM').val();
              var COVERAGE_TERM = $('#COVERAGE_TERM').val();
              var MAXIMUM_SUM_ASSURED = $('#MAXIMUM_SUM_ASSURED').val();
              var DISCOUNT = $('#DISCOUNT').val();
              var ID_INSURANCE = $('#ID_INSURANCE').val();
              var form_data = $(this).serialize();
                  if(ID_SUM_ASSURED != '' && MINIMUM_SUM_ASSURED != '' && PAYMENT_TERM != '' && COVERAGE_TERM != '' && MAXIMUM_SUM_ASSURED != '' && DISCOUNT != '' && ID_INSURANCE != '')
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
                <h1 align="center"><b>ระบบการจัดการ SUM_ASSURED</b></h1>
            </div>
            <div class="container" align="right">
                <br><br><button id="add_button" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-success" style="border-radius:5px;"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button><br>
            </div>
                <div class="table-responsive">
                 <table id="myTable"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                       <tr class="bg-primary">
                            <td>ID</td>
                            <td>MIN</td>
                            <td>PAYMENT</td>
                            <td>COVERAGE</td>
                            <td>MAX</td>
                            <td>DISCOUNT</td>
                            <td>ID_INSURANCE</td>
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
                        <h4 class="modal-title">Add Sum Assured</h4>
                    </div>
                    <div class="modal-body">
                        <label>ID SUM_ASSURED</label>
                            <input type="text" name="ID_SUM_ASSURED" id="ID_SUM_ASSURED" class="form-control" value='<?php echo $id_sum;?>' disabled/><br />
                        <label>Enter  minimum sum assured</label>
                            <input type="text" name="MINIMUM_SUM_ASSURED" id="MINIMUM_SUM_ASSURED" class="form-control" /><br />
                        <label>Enter Payment term</label>
                            <input type="text" name="PAYMENT_TERM" id="PAYMENT_TERM" class="form-control" /><br />
                        <label>Enter Coverage term</label>
                            <input type="text" name="COVERAGE_TERM" id="COVERAGE_TERM" class="form-control" /><br />
                        <label>Enter Maximum sum assured</label>
                            <input type="text" name="MAXIMUM_SUM_ASSURED" id="MAXIMUM_SUM_ASSURED" class="form-control" /><br />
                        <label>Enter Discount</label>
                            <input type="text" name="DISCOUNT" id="DISCOUNT" class="form-control" /><br />
                            <label>Select Insutance</label>
                                 <select name="ID_INSURANCE" id="ID_INSURANCE" class="form-control">
                                         <option value="">Select Insutance</option>
                                         <?php echo $output2; ?>
                                 </select> <br />
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
