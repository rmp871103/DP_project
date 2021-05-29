var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

$('#AddShoppingCart').click(
    function()
    {
        var $this = $(this);
        var BookId = getUrlParameter('PageID');
        var result;
        if($this.text()=="放入購物車")
        {
            $.post("./Controller/ShoppingCart_controller.php", //要執行的php檔
                {
                    Bookid:BookId,
                    operate:"ADD"
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
        }
    }
);