
jQuery.validator.addMethod("noRepeat",function(value,element){
    var len = $("#Mytbody").children().length;
    var temp = $("#form2").find("input[name=username2]").val();
    if(value == temp){
    	return true;
    }else{
    	for (var i = 0; i < len; i++) {
            var name = $("#Mytbody").find("tr").eq(i).children().eq(0).text();
            
            if(value == name){
                return false
            }
        }
        return true
    }
    
})