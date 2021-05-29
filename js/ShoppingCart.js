for(let i=0;;i++)
{
  if($('#product_box'+i.toString()).length)
  {
    /*var $minusButton = $('#minusBtn'+i.toString());
    var $plusButton = $('#plusBtn'+i.toString());
    var $quantity = $('#quantity'+i.toString());
    var $stock = $('#stock'+i.toString());
    var $price = $('#price'+i.toString());
    var $total_price = $('#total_price'+i.toString());
    var $cancel = $('#cancel'+i.toString());
    var $product_box = $('#product_box'+i.toString());*/
    
    $('#minusBtn'+i.toString()).click(
      function() {
      var currentValue = parseInt($('#quantity'+i.toString()).text());
      //alert($('#quantity'+i.toString()).text());
      if(currentValue > 1 && currentValue < parseInt($('#stock'+i.toString()).text())){
        $('#quantity'+i.toString()).text((currentValue - 1).toString());
        $('#total_price'+i.toString()).text((parseInt($('#quantity'+i.toString()).text()) * parseInt($('#price'+i.toString()).text())).toString());
      }
      else
      {
        $('#quantity'+i.toString()).text("1");
        $('#total_price'+i.toString()).text((parseInt($('#quantity'+i.toString()).text()) * parseInt($('#price'+i.toString()).text())).toString());
      }
      //var ISBN=$('#ISBN'+i.toString()).text().split('：')[1];
      //alert(ISBN);
      $.post("./Controller/ShoppingCart_controller.php", //要執行的php檔
                {
                    ISBN:parseInt($('#ISBN'+i.toString()).text().split('：')[1]),
                    operate:"UPDATE",
                    Quantity:parseInt($('#quantity'+i.toString()).text())
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

    $('#plusBtn'+i.toString()).click(
      function() {
      var currentValue = parseInt($('#quantity'+i.toString()).text());
      if(currentValue < parseInt($('#stock'+i.toString()).text())&&currentValue>0){
        $('#quantity'+i.toString()).text((currentValue + 1).toString());;
        $('#total_price'+i.toString()).text((parseInt($('#quantity'+i.toString()).text()) * parseInt($('#price'+i.toString()).text())).toString());
      }
      else
      {
        $('#quantity'+i.toString()).text("1");
        $('#total_price'+i.toString()).text((parseInt($('#quantity'+i.toString()).text()) * parseInt($('#price'+i.toString()).text())).toString());
      }
      $.post("./Controller/ShoppingCart_controller.php", //要執行的php檔
                {
                    ISBN:parseInt($('#ISBN'+i.toString()).text().split('：')[1]),
                    operate:"UPDATE",
                    Quantity:parseInt($('#quantity'+i.toString()).text())

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
    
    $('#cancel'+i.toString()).click(
      function(){
      //alert('fuck');
      $('#product_box'+i.toString()).css('display',"none");
     
      //$('#check_out_nav_item').text((parseInt($('#check_out_nav_item').text())+1).toString());
      $.post("./Controller/ShoppingCart_controller.php", //要執行的php檔
                {
                    ISBN:parseInt($('#ISBN'+i.toString()).text().split('：')[1]),
                    operate:"DELETE",
                    Quantity:parseInt($('#quantity'+i.toString()).text())

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
$('#Send').click(
  function()
  {
    $.post("./Controller/ShoppingCart_controller.php", //要執行的php檔
    {
        operate:"ADD_ORDER"
    },    //要post給php的資料
    function(response){
        console.log(response);  //錯誤拋出或是php echo的內容都會顯示在console
        result = response;  
        if(response["status"]==1)
        {
            window.location.href = response["msg"];
        }
        else if(response["status"]==2)
        {
          alert("訂購成功");
          window.location.href = response["msg"];
        }
    }
);
  }
);