for(let i=0;  ; i++)
{
  if($('#order_box'+i.toString()).length)
  {
    $('#cancelorder'+i.toString()).click(
        function(){
        //alert('fuck');
        $('#order_box'+i.toString()).css('display',"none");
        $.post("./Controller/order_controller.php", //要執行的php檔
                  {
                      OrderNumber: parseInt($('#orderNumber'+i.toString()).text()),
                      operate:"DELETE"
                  },    //要post給php的資料
                  function(response){
                      console.log(response);  //錯誤拋出或是php echo的內容都會顯示在console
                      result = response;  
                      if(response["status"]==1)
                      {
                          window.location.href = response["msg"];
                      }
                  }
              );
      });
  }
  else{
      break;
  }
}