var current =new Date();
var currentYears=current.getFullYear();
var currentMonth =current.getMonth();
var currentDate=current.getDate();
function dateAndBirthday(emp){
		var  obj_year =$('year');//document.getElementById('year');
		var obj_month =$('month');//document.getElementById('month');
		var obj_date=$('date');//document.getElementById('date');
		var val_year =obj_year.options[obj_year.selectedIndex].value
		var val_mon =obj_month.options[obj_month.selectedIndex].value
		var val_date=obj_date.options[obj_date.selectedIndex].value
		if(emp) calDate(val_year,val_mon,val_date);
		calBirthday(val_year,val_mon-1,val_date);
}

function calBirthday(year,mon,date){
var newCurrent =new Date();
newCurrent.setDate(newCurrent.getDate()-date+1);
newCurrent.setMonth(newCurrent.getMonth()-mon);
newCurrent.setFullYear(newCurrent.getFullYear()-year);
year_birthday=(newCurrent.getFullYear() <0)?0:newCurrent.getFullYear();
$('age').value=year_birthday
$('showAge').innerHTML=$F('age');

}
function calDate(year,mon,date){

		daysOfMonth =new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
		div4 =year%4;
		div100=year%100 ;
		div400 =year%400;
		 if((div4==0 || div100==0) && div400!=0 ){
			daysOfMonth[2]=29;
		}
	$('date').options.length=0
		if(date>daysOfMonth[mon]) date=1;
	  for(var i=1; i<=daysOfMonth[mon];i++){
		  if(i==(date))
			  $('date').options[i] =new Option( (i),(i),true,true);
			else
				$('date').options[i] =new Option((i),(i),false,false);
	  }
}
function setDate(year,month,date){

		 var listmonth =new Array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		for(var i=0; i<12; i++){
			if(month == i)
			$('month').options[i] =new Option( listmonth[i],(i+1),true,true);
			else
			$('month').options[i] =new Option( listmonth[i],(i+1),false,false);
		}
		for(var i=0; i<100;i++){
			var  setyear =current.getFullYear()-i
			var yesrB =setyear+543
			if(setyear==year)
			$('year').options[i]=new Option(yesrB,setyear, true, true)
			else
			$('year').options[i]=new Option(yesrB,setyear, false, false)
		}
			calDate(year,(month+1),date);
			calBirthday(year,month,date);
}

function initDate(){
	setDate(current.getFullYear(),current.getMonth(),current.getDate())
}
