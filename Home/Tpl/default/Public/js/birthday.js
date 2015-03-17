// JavaScript Document
function get_day(bmonth){
	var byear=$("#byear").val();

	$.post("/index.php/User/ajax_getday",{ year:byear , month:bmonth } , function(data){ 
var	len;
$("#bday").empty();
if(data.days!=null){
	
	len=data.days.length;
	var str;
	for(var l=1;l<=len;l++){
		str+="<option value='"+l+"'>"+l+"</option>";
	}
	
	$("#bday").append(str);	
}
	 },"json");
}