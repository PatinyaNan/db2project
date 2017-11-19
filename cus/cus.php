
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<div class="container">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Name</th>
                <th>Position</th>
                <th>Name</th>
                <th>Position</th>
                <th>Name</th>
                <th>Position</th>
                <th>Name</th>
                <th>Position</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
					<?php
                    set_time_limit(10000000);
                    ini_set('memory_limit', '256M');
					$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
					$connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');
					$query = "SELECT * FROM (SELECT * FROM CUSTOMER ORDER BY ID_CUSTOMER DESC) WHERE ROWNUM <= 1000";
					$result = oci_parse($connection, $query);
					$output = '';
					oci_execute($result,OCI_DEFAULT);
					while($row = oci_fetch_array($result,OCI_BOTH))
					{
					?>
            <tr>
                <td><?php echo $row["ID_CUSTOMER"]; ?></td>
                <td><?php echo $row["FIRST_NAME"]; ?></td>
                <td><?php echo $row["LAST_NAME"]; ?></td>
                <td><?php echo $row["AGE"]; ?></td>
                <td><?php echo $row["PHONE_NUMBER"]; ?></td>
                <td><?php echo $row["GENDER"]; ?></td>
                <td><?php echo $row["NATIONALITY"]; ?></td>
                <td><?php echo $row["STATUST"]; ?></td>
                <td><?php echo $row["STATUST_BICYCLE"]; ?></td>
                <td><?php echo $row["EMAIL"]; ?></td>
                <td><?php echo$row["BIRTH_DAY"]; ?></td>
            </tr>
					<?php
					}
					?>
        </tbody>
    </table>
</div>
