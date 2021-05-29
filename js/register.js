function dayOptionSet()
{
    var m=parseInt($("#month_sel option:selected").text());
    var y=parseInt($("#year_sel option:selected").text());

    $("#day_sel").empty(); //起初都先清空day選項
    
    if(!isNaN(m) && !isNaN(y))  //如果m或y在請選擇選項 則字串轉整數函數則會回傳Nan
    { 
        var NumberOfDay=new Date(y,m,0).getDate();  //取得在yyyy年mm月有幾天
        var i;
        $("#day_sel").append("<option>請選擇</option>"); //加入請選擇表示可選day
        //alert("i="+NumberOfDay.toString());
        for(i=1;i<=NumberOfDay;i++)
        {
            $("#day_sel").append("<option>"+ i.toString()+"</option>");  //加入天數選項
        }
    }
}
//若月份選項有更動 呼叫dayOptionSet函數更改月份選項
$("#month_sel").change(function()
{
    dayOptionSet();
});

//若年份選項有更動 呼叫dayOptionSet函數更改月份選項
$("#year_sel").change(function()
{
    dayOptionSet();
});