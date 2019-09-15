// 按下去  顯示當日日期
//剩餘人數
//下拉式選單可以選
function showInfo(dataNum,total) {
    //抓到場次時間
    $.get('php/resv/getTime.php', { data: 'time' }, function (data) {
        data = $.parseJSON(data);
        $('.data_table_content').html("");
        $.each(data, (i, n) => {
            n.peopleNum=n.max_capacity-total[i];
            /[0-9]+/.test(n.peopleNum)==true? n.peopleNum = n.peopleNum : n.peopleNum = Number(n.max_capacity);
            n.start_time=n.start_time.replace(n.start_time.substr(5),'');

            $('.data_table_content').append(
                `<div class="table_content_row">
                    <span>場次${n.session_no}</span>
                    <span class="show_datatime">${n.start_time}</span>
                    <span >${n.length}</span>
                    <span class="show_datanum">${n.peopleNum}</span>
                </div>`);
        })



        if($('#time_select').children().length>1){
            for(let i=0;i<$('#time_select').children().length;i++){
                $('#time_select').children("option:last").remove();
            }
        }
    
        $('#time_select').attr('disabled', false);
        
        $.each(data, (i, n) => {
            $('#time_select').append(
                `<option value="${n.start_time}">${n.start_time}</option>`
            )
        })
        $('#peoplenum_select').html('<option value="">--選擇人數--</option>');

            $('#time_select').change(function(){
                
                $('#peoplenum_select').html('<option value="">--選擇人數--</option>');
                $('#peoplenum_select').attr('disabled', false);
                let a;
                $.each(data, (i, n) => {
                    if($("#time_select option:selected").val() == n.start_time){
                        a=i;
                    }
                })

                let str='';
                // console.log($('#peoplenum_select').children().length)
                for(let i=1;i<= data[a].peopleNum;i++){
                    str+= `<option value="${i}">${i}</option>`
                }

                $('#peoplenum_select').append(str);
                $("#numRemain").text(`剩餘人數：${data[a].peopleNum}`);
            });
        
    });

    //顯示當日日期
    $('#show_data_title').text((my_month + 1) + "/" + $(dataNum).text() + "日預約導覽時段資訊：");
    
}



function showNumRemain() {
    //整理傳進去的資料 要變成mysql日期格式
    let date;  //日
    let month; //月
    my_month + 1 < 10 ? month = `0${my_month + 1}` : month = my_month + 1;
    $(this).text() < 10 ? date = `0${$(this).text()}` : date = $(this).text();
    let fullDate = `${my_year}-${month}-${date}`;
    // console.log(fullDate);
    //計算剩餘人數
    $.get('php/resv/getTime.php', { data: fullDate }, function (tour_date) {
        //[{"booking_no":"1","booking_date":"2019-09-06","tour_date":"2019-09-10","number_of_booking":"2","order_status":"0","member_id":"1","session_no":"1"}]
        //如果有資料傳回來（那一天有人預約）
        if (tour_date != 'noResv') {
            tour_date = $.parseJSON(tour_date);
            let max = 0;
            for (let i = 0; i < tour_date.length; i++) {
                if (max < tour_date[i].session_no) {
                    max = tour_date[i].session_no;
                }
            }
            let total = Array();
            for (let i = 0; i < max; i++) {
                total.push(0);
            }

            for (let i = 0; i < tour_date.length; i++) {
                num =  Number(tour_date[i].session_no) - 1;
                total[num] += Number(tour_date[i].number_of_booking) ;
            }
            showInfo($(this),total);
            
        }else{
            let total =[0];
            showInfo($(this),total);
        }
    })
}
