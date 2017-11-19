<?php
include("connection.php");
$row_career = 0;
$id_career ='';
$data_customer = array();
$strSQL = "SELECT ID_CAREER FROM CAREER";
$objParse = oci_parse($connection, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);

    while($objResult = oci_fetch_array($objParse,OCI_BOTH))
    {
        $data_career[$row_career] = $objResult[0];
        $row_career++;
    }
        $data_career = $data_career[$row_career-1];
        $t = substr($data_career,3);
        $new_id = $t+1;

        if($new_id <= 99){
            $id_career.= "CAR000".$new_id;
         }
       else{
           $id_career.= "CAR00".$new_id;
         }
?>
<html>
 <head>
  <title>Prudential</title>




  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
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
                      $('#career_id').val(resp.ID_CAREER);
                      $('#career_name').val(resp.CAR_NAME);
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
                  return '<tr id="item-'+a.ID_CAREER+'">\n\
                      <td>'+String(a.ID_CAREER)+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>'+a.CAR_NAME+'</td>\n\
                      <td>\n\
                          <button type="button" onclick="window.handleUpdate(\''+a.ID_CAREER+'\')" class="btn btn-warning btn-xs update" id="product-edit-'+a.ID_CAREER+'" data-row-id="'+a.ID_CAREER+'"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Edit</button>\n\
                          <button type="button" onclick="window.handleDelete(\''+a.ID_CAREER+'\')" class="btn btn-danger btn-xs delete" id="product-delete-'+a.ID_CAREER+'" data-row-id="'+a.ID_CAREER+'"><span class="fa fa-trash-o"></span>&nbsp;&nbsp;Delete</button>\n\
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
              var table = $('#product_data').DataTable();
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
                                        //$('#product_data').data.reload()
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
        <h1 align="center">Career</h1>
        <div align="right">
            <br><br><button id="add_button" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-success"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button><br><br>
            <!--<button type="button" class="btn btn-success">Add</button><br><br>-->
            <!--<button type="button" id="add_button" data-toggle="modal" data-target="#productModal" class="btn btn-info btn-lg">Add</button>-->
        </div>
        <div class="table-responsive">
         <table id="product_data"  class="table table-striped table-bordered">
          <thead>
               <tr class="bg-primary">
                    <td>ID_CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td>CAREER</td>
                    <td><center>Commands</center></td>
               </tr>
          </thead>
          <tbody id="myBody"></tbody>
         </table>
     </div>
    </div>
</body>
</html>
<div id="productModal" class="modal fade">
 <div class="modal-dialog">
      <form method="post" id="product_form">
           <div class="modal-content">
                <div class="container-fluid">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Career</h4>
                </div>
                <div class="modal-body">
                    <label>ID Career</label>
                             <input type="text" name="career_id" id="career_id" class="form-control" value='<?php echo $id_career;?>' disabled/>
                         <br />
                     <label>Enter Career Name</label>
                        <input type="text" name="career_name" id="career_name" class="form-control" />
                        <br />
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
