for(let i=0;  ; i++)
{
  if($('#bookList_box'+i.toString()).length)
  {
    $('#cancelbook'+i.toString()).click(
        function(){
        //alert('fuck');
        $('#bookList_box'+i.toString()).css('display',"none");
        $.post("./Controller/BookList_controller.php", //要執行的php檔
                  {
                      BookNumber: $('#bookNumber'+i.toString()).text(),
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