//兩種不同年的年份
var month_olympic = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; //閏年
var month_normal = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; //平年
var month_name = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

var holder = document.getElementById("days"); //<ul id='day'>
var prev = document.getElementById("prev");
var next = document.getElementById("next");
var ctitle = document.getElementById("calendar_month");
var cyear = document.getElementById("calendar_year");

var my_date = new Date(); //獲取當前時間
var my_year = my_date.getFullYear(); //獲取當前年份
var my_month = my_date.getMonth(); //獲取當前月份
var my_day = my_date.getDate(); //獲取當前日期  

//獲取某年某月的第一天是星期幾
function day_start(month, year) {
    var tmpDate = new Date(year, month, 2);
    // new Date(year, month[, day]);
    console.log(tmpDate.getDay());
    return (tmpDate.getDay());
}
//計算是不是閏年（前年份除以4的餘數）
/*
 1.西元年份除以4不可整除，為平年。
 2.西元年份除以4可整除，且除以100不可整除，為閏年。
 3.西元年份除以100可整除，且除以400不可整除，為平年。
 4.西元年份除以400可整除，為閏年。
*/
function days_month(month, year) {
    var tmp = year % 4;
    if (tmp == 0) {
        return (month_olympic[month]);
    } else {
        return (month_normal[month]);
    }
}

//前月
prev.onclick = function (e) {
    e.preventDefault();
    my_month--;
    if (my_month < 0) {
        my_year--;
        my_month = 11;
    }
    refresh_date();
}
//後月
next.onclick = function (e) {
    e.preventDefault();
    my_month++;
    if (my_month > 11) {
        my_year++;
        my_month = 0;
    }
    refresh_date();
}

function refresh_date() {
    var str = "";  //設置日期顯示，預設為空 line153
    var totalDay = days_month(my_month, my_year); //獲取該月天數
    var firstDay = day_start(my_month, my_year); //獲取該月第一天星期幾
    var myclass; //設置css
    for (var i = 1; i < firstDay; i++) {
        str += "<li> </li>"; //期使日期之前空白
    }
    for (var i = 1; i <= totalDay; i++) {
        if ((i < my_day && my_year == my_date.getFullYear() && my_month == my_date.getMonth()) || my_year < my_date.getFullYear() || (my_year == my_date.getFullYear() && my_month < my_date.getMonth())) {
            myclass = " class='lightgrey dispointer'"; //在當日期今天之前，灰色字
        } else if (i == my_day && my_year == my_date.getFullYear() && my_month == my_date.getMonth()) {
            myclass = " class='fontColor colorbox pointer'"; //當天日期背景顯示
        } else {
            myclass = " class='curday_after pointer'"; //在當日期今天之後，黑色字
        }
        str += "<li" + myclass + ">" + i + "</li>"; //創建日期節點
    }
    holder.innerHTML = str; //設置日期顯示
    ctitle.innerHTML = month_name[my_month]; //設置英文月份顯示
    cyear.innerHTML = my_year; //設置年份顯示
}

window.addEventListener('load', refresh_date) //執行函數