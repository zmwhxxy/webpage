function showDateTime() {
    var sWeek = new Array("日", "一", "二", "三", "四", "五", "六");
    var myDate = new Date();
    var sYear = myDate.getFullYear();
    var sMonth = myDate.getMonth() + 1;
    var sDate = myDate.getDate();

    var sDay = sWeek[myDate.getDay()];

    var h = myDate.getHours();
    var m = myDate.getMinutes();
    var s = myDate.getSeconds();

    //输入日期和星期
    document.getElementById("date").innerHTML = (sYear + "年" + sMonth + "月" + sDate + "日" + "星期" + sDay + "<br>");

    //转化为2位数字的时间
    h = formatTwoDigits(h);
    m = formatTwoDigits(m);
    s = formatTwoDigits(s);

    //document.write(""+ h + ":" + m + ":" + s + "<br>");

    // 显示时间分钟和秒数
    document.getElementById("msg").innerHTML = (
          imageDigits(h) + " <img src=./images/dot.png > "
        + imageDigits(m) + " <img src=./images/dot.png >"
        + imageDigits(s) + " <br>"
        );

    setTimeout("showDateTime()", 1000);
}

window.onload = showDateTime;

function formatTwoDigits(s) {
    if(s<10) return "0" + s;
    return s;
}

function imageDigits(str) {
    var ret = "";
    var s = new String(str);
    for(var i=0; i<s.length; i++) {
        ret += `<img src="./images/` + s.charAt(i) + `.png">`;
    }
    return ret;
}