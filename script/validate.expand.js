/**
 * Created by Administrator on 2017/7/11.
 */
jQuery.validator.addMethod("noRepeat",function(value,element){
    var len = $("#Mytbody").children().length;
    for (var i = 0; i < len; i++) {
        var name = $("#Mytbody").find("tr").eq(i).children().eq(1).attr("name");
        if(value == name){
            return false
        }
    }
    return true
})