/**
 * Created by owenbaoguojie on 2017/7/9.
 */
var countPage;
var nowPag = 1;
var pageSize;
var countSize;

var starIndex;
var endIndex;

// ????????
var name;
var sex;
var age;

// ?????§Ü?
var num = 1;

$(document).ready(function() {
    // ??????????????
    $("#submit").click(function() {
        // ?????????????
        name = $("#name").val();
        sex = $("input[name='sex']:checked").val();
        age = $("#age").val();
        pageSize = $("#selectSize option:selected").val();
        // alert(name+sex+age+pageSize);

        // ??????????tr????
        $tr = $("<tr class='data' ></tr>");
        $td1 = $("<td></td>");
        $td2 = $("<td></td>");
        $td3 = $("<td></td>");
        $td4 = $("<td></td>");
        $td5 = $("<td></td>");

        $tr.append($td1.append("<input type='checkbox'>"));
        $tr.append($td2.append(name));
        $tr.append($td3.append(sex));
        $tr.append($td4.append(age));
        $tr.append($td5.append("<input type='button' value='???'>"));

        $("#show").append($tr);
        pageNation();

    });
    // ??????????????????
    $("#selectSize").change(function() {
        pageSize = $("#selectSize option:selected").val();
        pageNation();
    });

    // ???????????????????
    $("#first").click(pageNation);
    $("#back").click(pageNation);
    $("#next").click(pageNation);
    $("#last").click(pageNation);

});

// ????????????
var pageNation = function() {
    // ??????§Ö?????????
    countSize = $("#show tr").length;
    // ????????
    countPage = Math.ceil(countSize / pageSize);

    // ??????????
    if (this.nodeType == 1) {
        var idValue = $(this).attr("id");
        if ("first" == idValue) {
            // alert(idValue);
            nowPag = 1;
        } else if ("back" == idValue) {
            // alert(nowPag);
            if (nowPag > 1) {
                nowPag--;
            }

        } else if ("next" == idValue) {
            // alert(idValue);
            if (nowPag < countPage) {
                nowPag++;
            }
        } else if ("last" == idValue) {
            // alert(idValue);
            nowPag = countPage;
        }

    }
    // alert(pageSize);
    // ?????????????????¡À?
    starIndex = (nowPag - 1) * pageSize + 1;
    endIndex = nowPag * pageSize;

    if (endIndex > countSize) {
        // alert("?¡À??????????"+endIndex);
        endIndex = countSize;
    }

    if (countSize < pageSize) {
        // alert("??????§³§³?????????????"+endIndex);
        endIndex = countSize;
    }

    // alert(starIndex);

    if (starIndex == endIndex) {
        // ????????
        $("#show tr:eq(" + (starIndex - 1) + ")").show();
        $("#show tr:lt(" + (starIndex - 1) + ")").hide();
    } else {
        // ????????
        $("#show tr:gt(" + (starIndex - 1) + ")").show();
        $("#show tr:lt(" + (endIndex - 1) + ")").show();

        // ????????
        $("#show tr:lt(" + (starIndex - 1) + ")").hide();
        $("#show tr:gt(" + (endIndex - 1) + ")").hide();
    }
    // ????????????
    $("#sizeInfo")
        .html(
        "?????" + starIndex + "??????" + endIndex + "?????,??" + countSize
        + "?????.");
    $("#pageInfo").html("??????" + nowPag + "?,??" + countPage + "?.");
};