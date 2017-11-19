<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<form action="insert.php" method="post" name="form1">
List Menu 1<br>
  <select name="lmName1">
	<option value="a">a</option>
    <option value="b">b</option>
    <option value="c">c</option>
  </select>
  <hr>
List Menu 2<br>
  <select name="lmName2" size="5">
	<option value="a">a</option>
    <option value="b">b</option>
    <option value="c">c</option>
  </select>
  <hr>
List Menu 3<br>
  <select name="lmName3[]" size="5" multiple>
	<option value="x">x</option>
    <option value="y">y</option>
    <option value="z">z</option>
  </select><br>
<input name="btnSubmit" type="submit" value="Submit">
</form>
</body>
</html>
