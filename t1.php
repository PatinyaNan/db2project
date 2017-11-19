<script language=javascript>
var aa = new Array("ตะวันออกเฉียงเหนือ","เหนือ","ตะวันตก","กลาง","ตะวันออก","ใต้");
ตะวันออกเฉียงเหนือ = new Array("อำนาจเจริญ", "บึงกาฬ", "บุรีรัมย์", "ชัยภูมิ", "กาฬสินธุ์", "ขอนแก่น", "เลย", "มหาสารคาม", "มุกดาหาร", "นครพนม", "นครราชสีมา", "หนองบัวลำภู", "หนองคาย", "ร้อยเอ็ด", "สกลนคร", "ศรีสะเกษ"," สุรินทร์", "อุบลราชธานี", "อุดรธานี", "ยโสธร");
เหนือ = new Array("เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "แม่ฮ่องสอน", "น่าน", "พะเยา", "แพร่", "อุตรดิตถ์","ตาก","สุโขทัย", "พิษณุโลก", "พิจิตร", "กำแพงเพชร", "เพชรบูรณ์","นครสวรรค์", "อุทัยธานี");
ตะวันตก = new Array("อ่างทอง", "ชัยนาท", "พระนครศรีอยุธยา", "กรุงเทพมหานคร", "ลพบุรี", "นครปฐม", "นนทบุรี", "ปทุมธานี", "สมุทรปราการ", "สมุทรสาคร", "สมุทรสงคราม", "สระบุรี", "สิงห์บุรี", "สุพรรณบุรี","นครนายก");
กลาง = new Array("ฉะเชิงเทรา", "จันทบุรี", "ชลบุรี", "ปราจีนบุรี", "ระยอง", "สระแก้ว", "ตราด");
ตะวันออก = new Array("กาญจนบุรี", "ราชบุรี","เพชรบุรี", "ประจวบคีรีขันธ์");
ใต้ = new Array("ชุมพร", "นครศรีธรรมราช", "นราธิวาส", "ปัตตานี", "พัทลุง", "สงขลา", "สุราษฎร์ธานี", "ยะลา","กระบี่", "พังงา", "ภูเก็ต", "ระนอง", "สตูล", "ตรัง");

function changeval()
{
 var val1 = document.product_form.HOS_SECTOR.value;
 var optionArray = eval(val1);
 for(var df=0; df<optionArray.length; df++)
 {
  var ss = document.product_form.HOS_COUNTY;
  ss.options.length = 0;
  for(var ff=0; ff<optionArray.length; ff++)
  {
   var val = optionArray[ff];
   ss.options[ff] = new Option(val,val);
  }
 }
}
</script>

<form name="product_form">
<select name="HOS_SECTOR" onchange=changeval()>
<script language=javascript>
for(var dd=0; dd<aa.length; dd++)
{
 document.write("<option value=\""+aa[dd]+"\">"+aa[dd]+"</option>");
}
</script>
</select>

<select name="HOS_COUNTY">
</select>

</form>
