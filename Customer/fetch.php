<?php
//fetch.php
include("connection.php");

$query = "SELECT * FROM CUSTOMER where ROWNUM <= 10";
$result = oci_parse($connection, $query);
$output = '';
oci_execute($result,OCI_DEFAULT);
while($row = oci_fetch_array($result,OCI_BOTH))
{
    $results[] = $row;
 //echo "<pre>";print_R($data);die;
}
$output = array(
 'rowCount'  => 10,
 'total'     => count($results),
 'rows'      => $results
);

echo json_encode($output);

?>
