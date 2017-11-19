<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<?php
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.60)(PORT = 1521)))(CONNECT_DATA=(SID=prudential)))";
$connection = oci_connect("NONGNAN","nan170740",$db,'AL32UTF8');
?>

<script language="JavaScript">
	function resutName(CusID)
	{
		switch(CusID)
		{
			<?php
			$strSQL = "SELECT * FROM ADDITIONAL ORDER BY ID_ADDITIONAL ASC";
            $objQuery = oci_parse($connection, $strSQL);
            oci_execute ($objQuery,OCI_DEFAULT);
			while($objResult = oci_fetch_array($objQuery,OCI_BOTH))
			{
			?>
				case "<?php echo $objResult["ID_ADDITIONAL"];?>":
				frmMain.txtName.value = "<?php echo $objResult["NAME_ADDITIONAL"];?>";
				break;
			<?php
			}
			?>
			default:
			 frmMain.txtName.value = "";
		}
	}
</script>

<body>
	<form action="page.php" method="post" name="frmMain">
		List Menu
		  <select name="lmName1" OnChange="resutName(this.value);">
			<option value=""><-- Please Select Item --></option>
			<?php
			$strSQL = "SELECT * FROM ADDITIONAL ORDER BY ID_ADDITIONAL ASC";
			$objQuery = moci_parse($connection, $strSQL);
            oci_execute ($objQuery,OCI_DEFAULT);
			while($objResult = oci_fetch_array($objQuery,OCI_BOTH))
			{
			?>
			<option value="<?php echo $objResult["ID_ADDITIONAL"];?>"><?php echo $objResult["ID_ADDITIONAL"];?></option>
			<?php
			}
			?>
		  </select>
		<input name="txtName" type="text" value="">
	</form>
</body>
</html>
<?php
?>
