// JavaScript Document
function check_search(){
	var vin_number=$("#vin_number").val();
	var chepai_diqu=$("#chepai_diqu").val();
	var chepai_num=$("#chepai_num").val();
	if(vin_number==""){
		alert("请填写VIN码！")
		return false;
	}
	else if(chepai_diqu==""){
		alert("请选择车牌号所属地区！");
		return false;
	}
	else if(chepai_num==""){
		alert("请填写车牌号码！");
		return false;
	}
}