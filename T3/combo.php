<?php
/*
 * connection database
 */
 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
 $connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');

/*
 * select data
 */
 $Query="SELECT DISTINCT(A.EMPLOYEEID) , A.FIRSTNAME , A.LASTNAME from EMPLOYEE.EMPLOYEE A JOIN EMPLOYEE.POSITION_EMP B ON (A.POSITION_ID = B.POSITION_ID)JOIN EMPLOYEE.DEPARTMENT C ON (B.DEPARTMENT_ID = B. DEPARTMENT_ID)where (C.DEPARTMENT_ID='DPM05' OR C.DEPARTMENT_ID='DPM06') AND (B.POSITION_ID ='PO050' OR B.POSITION_ID ='PO060') ORDER BY A.EMPLOYEEID ASC";
 $sql_row1 = oci_parse($connection, $Query);
 oci_execute ($sql_row1,OCI_DEFAULT);
// while($sql_res1 = oci_fetch_array($sql_row1,OCI_BOTH))
// $Query = mysql_query('SELECT * FROM ml_categories') or die('Error query #12');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>itOffside.com</title>
        <script src="jquery-1.11.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                //console.log(categories);
                $('#categories').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {categories: $(this).val()},
                        url: 'employee.php',
                        success: function(data) {
                            $('#products').html(data);
                            console.log(data);
                        }
                    });
                    //console.log(data);
                    return false;
                });
                $('#products').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {products: $(this).val()},
                        url: 'g.php',
                        success: function(data) {
                            $('#s').html(data);
                        }
                    });
                    //console.log(data);
                    return false;
                });

            });
        </script>
    </head>
    <body style="width: 100%;padding-top: 50px;">
        <form name="multilistbox" method="POST">
            <table border="0" width="500" cellpadding="5" style="margin: 0 auto;">
                <tr>
                    <td style="text-align: right; width: 200px;">หมวดหมู่</td>
                    <td>
                        <select name="categories" id="categories">
                            <option value="">เลือกข้อมูลหมวดหมู่</option>
                            <?php
                                while($Result = oci_fetch_array($sql_row1,OCI_BOTH)) {
                                ?>
                                <option value="<?php echo $Result['EMPLOYEEID']; ?>">
                                    <?php echo $Result['EMPLOYEEID']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">สินค้า</td>
                    <td>
                        <select name="products" id="products"></select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;">สินsdsdsdsdค้า</td>
                    <td>
                        <select name="s" id="s"></select>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
