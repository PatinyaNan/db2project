<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
/*	function age(birthDay) {
		var nDate = new Date();
		var nYear = nDate.getFullYear();
		var bDate = new Date(birthDay);
		var bYear = bDate.getFullYear();

		alert(nYear-bYear + ' years old.');
	}*/
        /*function handler(e){
            var d = new Date('2017-11-08');
            var bYear = e.target.value;
            alert(d-bYear);
        }*/

        function dateDiff(){


        <!--

        var myVar1 = document.getElementById('date1').value;//prompt("Enter a start date: ")
        var myVar2 = document.getElementById('date2').value;//prompt("Enter a end date: ")

        var first_date = Date.parse(myVar1)
        var last_date = Date.parse(myVar2)
        var diff_date =  first_date - last_date;

        var num_years = diff_date/31536000000;
        var num_months = (diff_date % 31536000000)/2628000000;
        var num_days = ((diff_date % 31536000000) % 2628000000)/86400000;

        var result ="";

        result +=(" " + Math.floor(num_years) + " ปี\n");
        /*result +=(" " + Math.floor(num_months) + " ดือน\n");
        result +=(" " + Math.floor(num_days) + " วัน");*/
        //alert(result);
        document.getElementById('result').value = result;
        //-->
        }
</script>
</head>

<body onload="">
        <div>
            <input type="hidden" id="date1" value="2017/12/01" />
            <input type="date" id="date2" onchange="dateDiff();" />
            age :<input type="text" id="result" readonly="readonly"> years
        </div>
</body>
</html>
