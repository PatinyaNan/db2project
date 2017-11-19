<?php
//fetch.php
include("connection.php");
$strSQL1 = "SELECT * FROM SELL_DETAILS WHERE ROWNUM <= 10000";
$objParse1 = oci_parse($connection, $strSQL1);
oci_execute ($objParse1, OCI_DEFAULT);
//$total_records = oci_fetch_all ($objParse1,$res);
$results= array();
while($row =  oci_fetch_array($objParse1, OCI_BOTH))
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
