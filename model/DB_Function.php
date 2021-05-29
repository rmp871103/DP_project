<?php
 /*定義MySQL的登錄帳戶和使用的DataBase*/ 
 define('DB_SERVER','localhost');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', '');
 define('DB_NAME', 'book_store');
 function connectDB(&$link)
 {
     /*定義MySQL的登錄帳戶和使用的DataBase*/ 
     
 
     /*連接資料庫，若無法連接則會在螢幕上顯示*/
     $my_Sqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
     $my_Sqli->query("SET NAMEES 'UTF8'"); //避免中文亂碼，將編碼設置為utf8
     if(!$my_Sqli)
     {
         $link=null;
         die("Can't connect to MySQL");
     }
     else
     {
         $link=$my_Sqli;
     }
 }
 
 //-- login function
 //$account is login.php inputs account.
 //if $account was used then this function will return true.
 function IsAccountIn($account)
 {
     connectDB($link);   //連接DB
     if(!is_null($link)) //確認連接
     {
         $_account = mysqli_real_escape_string($link,$account);  //建立SQL
     }
     if(is_null($_account))
     {
         return false;
     }
     $query = "SELECT * FROM useraccount WHERE Account= '$_account'";
     $link->query($query);
     if($link->affected_rows >0)
     {
         $link->close();
         return true;
     }
     $link->close();
     return false;
 }
 
 //$Mail is login.php inputs mail address.
 //if $account was used then this function will return true.
 function IsMailIn($Mail)
 {
     connectDB($link);   //連接DB
     if(!is_null($link)) //確認連接
     {
         $_Mail = mysqli_real_escape_string($link,$Mail);  //建立SQL
     }
     if(is_null($_Mail))
     {
         return false;
     }
     $query = "SELECT * FROM useraccount WHERE Email= '$_Mail'";
     $link->query($query);
     if($link->affected_rows >0)
     {
         $link->close();
         return true;
     }
     $link->close();
     return false;
 }
 //帳號查詢使用prepare寫法
 /*function IsAccountIn($account)
 {
     connectDB($link);   //連接DB
     if(!is_null($link)) //確認連接
     {
         $_account = mysqli_real_escape_string($link,$account);  //建立SQL
     }
     if(is_null($_account))
     {
         return false;
     }
     $stmt = $link->prepare("SELECT ID FROM useraccount WHERE Account= ?");
     $stmt->bind_param("s",$account);
     $stmt->execute();
     $result = $stmt->get_result();
     if($result->num_rows >0)
     {
         return true;
     }
     return false;
 }*/
 
 //insert a new user into useraccount table.
 function AddUser($acc, $mail, $password, $phone, $address, $birth)
 {
     connectDB($link);
     $id;
     do{
        $id = rand(0,9999999999);
        $_id = mysqli_real_escape_string($link,$id);
        $query = "SELECT * FROM useraccount WHERE ID = '$_id'";
        $link->query($query);
     }while($link->affected_rows>0);
     $_id = mysqli_real_escape_string($link,$id);
     $_acc = mysqli_real_escape_string($link,$acc);
     $_mail = mysqli_real_escape_string($link,$mail);
     $_password = mysqli_real_escape_string($link,$password);
     $_phone = mysqli_real_escape_string($link,$phone);
     $_address = mysqli_real_escape_string($link,$address);
     $_birth = mysqli_real_escape_string($link,$birth);
    
     $query = "INSERT INTO useraccount(ID, Account, Password, Phone, Birth, Address, Email) VALUE( '$_id', '$_acc', '$_password', '$_phone', '$_birth', '$_address', '$_mail')";
     $link->query($query);
     $link->close();
 }
 
//--login fuction
//登錄判斷使用者資訊
function login_select($account, $password)
{
    connectDB($link);
    $_account = mysqli_real_escape_string($link,$account);
    $_password = mysqli_real_escape_string($link,$password);

    $query = "SELECT * FROM useraccount WHERE Account = '$_account' AND Password = '$_password'";
    $result = $link->query($query);
    if($link->affected_rows > 0)
    {
        $row = $result->fetch_array();
        $result-> free();
        $link->close();
        return $row[0];
    } 
    else
    {
        $link->close();
        return NULL;
    }
}
function isBookInShoppingCart($UserID, $BookID)
{
    connectDB($link);   //連接DB

    $_UserID = mysqli_real_escape_string($link,$UserID); 
    $_BookID = mysqli_real_escape_string($link,$BookID);  
     if(!isset($_UserID) || !isset($_BookID))
     {
         return false;
     }
     $query = "SELECT * FROM shopping_cart WHERE Book_ID = '$_BookID' AND User_ID = '$_UserID'";
     $link->query($query);
     if($link->affected_rows >0)
     {
         $link->close();
         return true;
     }
     $link->close();
     return false;
}
function AddShoppingCart($UserID, $BookID)
{
    connectDB($link);
    $_UserID = mysqli_real_escape_string($link,$UserID); 
    $_BookID = mysqli_real_escape_string($link,$BookID);  

    $query = "INSERT INTO shopping_cart VALUE($_UserID,$_BookID, 1)";
    $link->query($query);
    $link->close();
}

function GetShoppingCart($UserID)
{
    connectDB($link);
    $_UserID = mysqli_real_escape_string($link,$UserID); 
    $query = "SELECT Book_ID, Quantity FROM shopping_cart WHERE User_ID = '$_UserID'";
    $result = $link->query($query);
    $ShoppingCart = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        array_push($ShoppingCart,$row);
    }
    $link->close();
    return $ShoppingCart;
}
function GetBook($BookID)
{
    connectDB($link);
    $_BookID = mysqli_real_escape_string($link,$BookID);
    $query = "SELECT * FROM book WHERE ID = '$_BookID'";
    $result = $link->query($query);
    if($link->affected_rows > 0)
    {
        $Bookinfo = $result->fetch_array(MYSQLI_ASSOC);
        $link->close();
        return $Bookinfo;
    }
    $link->close();
    return NULL;
}
function ISBNtoBookID($ISBN)
{
    connectDB($link);
    $_ISBN = mysqli_real_escape_string($link,$ISBN);
    $query = "SELECT * FROM book WHERE ISBN = '$_ISBN'";
    $result = $link->query($query);
    if($link->affected_rows > 0)
    {
        $BookID = $result->fetch_array(MYSQLI_ASSOC);
        $link->close();
        return $BookID['ID'];
    }
    $link->close();
    return NULL;
}

function UpdateShoppingCart($UserID, $BookID, $Quantity)
{
    connectDB($link);
    $_UserID = mysqli_real_escape_string($link,$UserID); 
    $_BookID = mysqli_real_escape_string($link,$BookID);  
    $_Quantity = mysqli_real_escape_string($link,$Quantity); 
    $query = "UPDATE shopping_cart SET Quantity = '$Quantity' WHERE User_ID = '$_UserID' AND Book_ID = '$_BookID'";
    $link->query($query);
    $link->close();
}
function DeleteShoppingCart($UserID, $BookID)
{
    connectDB($link);
    $_UserID = mysqli_real_escape_string($link,$UserID); 
    $_BookID = mysqli_real_escape_string($link,$BookID);  

    $query = "DELETE FROM shopping_cart WHERE User_ID ='$_UserID' AND Book_ID = $_BookID";
    $link->query($query);
    $link->close();
}

function AddOrderList($UserID, $OrderNumber)
{
    connectDB($link);
    $Number = $OrderNumber;
    $_OrderNumber = mysqli_real_escape_string($link,$Number); 
    $query = "SELECT * FROM order_list WHERE Number = '$_OrderNumber'";
    $date=date("Y-m-d");
    $status = "準備中";
    $result = $link->query($query);
    /*if($link->affected_rows==0)
        return "fuck1";*/
    while($result->num_rows > 0){
        $result->close();
        $Number = rand(0,999999999);
        $_OrderNumber = mysqli_real_escape_string($link,$Number);
        $query = "SELECT * FROM order_list WHERE Number = '$_OrderNumber'";
        $result = $link->query($query);
    }
    $_OrderNumber = mysqli_real_escape_string($link,$Number); 
    $_UserID = mysqli_real_escape_string($link,$UserID); 
    $_date = mysqli_real_escape_string($link,$date); 
    $_status = mysqli_real_escape_string($link,$status); 
    $query = "INSERT INTO order_list(User_ID, Number, Status, Date, Cost) VALUE('$_UserID', '$_OrderNumber', '$_status' , '$_date', 0) ";
    $link->query($query);
    $link->close();
    return $Number;
}
function AddOrderItem($UserID, $shoppingCart, $OrderNumber)
{
    connectDB($link);
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber); 
    $total = 0;
    for($i=0;$i<count($shoppingCart);$i++)
    {
        $BookID = $shoppingCart[$i]['Book_ID'];
        $_UserID = mysqli_real_escape_string($link,$UserID);
        $_BookID = mysqli_real_escape_string($link,$BookID);  
        $query = "DELETE FROM shopping_cart WHERE User_ID ='$_UserID'";
        $link->query($query);
        $query = "SELECT * FROM book WHERE ID = '$_BookID'";
        $result = $link->query($query);

        if($link->affected_rows>0)
        {
            $BookInfo = $result->fetch_array(MYSQLI_ASSOC);
            if($shoppingCart[$i]['Quantity']<=$BookInfo['Quantity'])
            {
                $num = $BookInfo['Quantity'] - $shoppingCart[$i]['Quantity'];
                $_num = mysqli_real_escape_string($link,$num); 
                $query = "UPDATE book SET Quantity = '$_num' WHERE ID = '$_BookID'";
                $link->query($query);

                $Quantity = $shoppingCart[$i]['Quantity'];
                $_Quantity = mysqli_real_escape_string($link,$Quantity); 
                $Cost = $shoppingCart[$i]['Quantity'] * $BookInfo['Price'];
                $total += $Cost;
                $_Cost = mysqli_real_escape_string($link,$Cost); 
                $query = "INSERT INTO order_item(Order_Number, Book_ID, Quantity, Cost) VALUE('$_OrderNumber', '$_BookID', '$_Quantity', '$_Cost')";
                $link->query($query);
            }
        }
        
    }
    $link->close();
    return $total;
}

function UpdateOrderTotal($OrderNumber, $total)
{
    connectDB($link);
    $_total = mysqli_real_escape_string($link,$total); 
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber); 
    $query = "UPDATE order_list SET Cost = '$_total' WHERE Number = '$_OrderNumber'";
    $link->query($query);
    $link->close();
}
 //---book
//book: ID ISBN Name Date Price Publisher Author Quantity Image_Path
//category: Book_ID = ID Language Type IsEbook
function GetBookInfo($table, $bookID, $GetInfo){
    connectDB($link);
    $booksql = "select $GetInfo from $table where ID = $bookID ";
    $result = mysqli_query($link, $booksql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
        mysqli_close($link);
        return $row[$GetInfo];
    }
}
function GetBookCategory($table, $bookID, $GetInfo){
    connectDB($link);
    $booksql = "select $GetInfo from $table where Book_ID = $bookID ";
    $result = mysqli_query($link, $booksql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
        mysqli_close($link);
        return $row[$GetInfo];
    }
}
function GetCategoryIDList($category){
    connectDB($link);  
    $categorysql = "select Book_ID from category where Type = '$category'";
    $result = mysqli_query($link, $categorysql);
    $IDarray=array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($IDarray,$row['Book_ID']);
    }
    mysqli_close($link);
    return $IDarray;
}
function SearchBook($keyword){
    connectDB($link);  
    $categorysql = "select ID from book where Name like '%$keyword%'";
    $result = mysqli_query($link, $categorysql);
    $IDarray=array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($IDarray,$row['ID']);
    }
    mysqli_close($link);
    return $IDarray;
}
//---url
function intotargeturl($page, $pageName){
    echo $page.'?PageID='.$pageName;
    return $page.'?PageID='.$pageName;
}
//---order
//order_list:User_ID Number Status Date Cost
function GetOrder($OrderNumber, $GetInfo){
    connectDB($link);
    $booksql = "select $GetInfo from order_list where Number = $OrderNumber ";
    $result = mysqli_query($link, $booksql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
        mysqli_close($link);
        return $row[$GetInfo];
    }
}
//order_item:OrderNumber Book_ID Quantity Cost
function GetOrderDetail($OrderNumber,$BookID, $GetInfo){
    connectDB($link);
    $booksql = "select $GetInfo from order_item where Order_Number = $OrderNumber && Book_ID = $BookID";
    $result = mysqli_query($link, $booksql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
        mysqli_close($link);
        return $row[$GetInfo];
    }
}
function GetMamberOrderList($UserID){
    connectDB($link);  
    $categorysql = "select Number from order_list where User_ID = '$UserID'";
    $result = mysqli_query($link, $categorysql);
    $Orderarray=array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($Orderarray,$row['Number']);
    }
    /*
    for($i = 0 ; $i < count($Orderarray); $i++){
        echo $Orderarray[$i];
    }*/
    mysqli_close($link);
    return $Orderarray;
}
function GetAllBookInOrder($OrderNumber){
    connectDB($link);  
    $categorysql = "select Book_ID from order_item where Order_Number = $OrderNumber";
    $result = mysqli_query($link, $categorysql);
    $Orderarray=array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($Orderarray,$row['Book_ID']);
    }
    mysqli_close($link);
    return $Orderarray;
}
function CalculateTotalCost($OrderNumber){
    connectDB($link); 
    $costsql = "select Cost from order_item where Order_Number = $OrderNumber";
    $result = mysqli_query($link, $costsql);
    $total = 60;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $total += $row['Cost'];
    }

    mysqli_close($link);
    return $total;
}
//--order edit
function isOrderNumberInOrderList($UserID, $OrderNumber){
    connectDB($link);
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber);
    $orderlist = "select * from order_list where Number = '$_OrderNumber'";
    $link->query($orderlist);
    if($link->affected_rows > 0){
        mysqli_close($link);
        return true;
    }
    else{
        mysqli_close($link);
        return false;
    }
}
function isOrderNumberInOrderItem($UserID,$OrderNumber){
    connectDB($link);
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber);
    $orderitem = "select * from order_item where Order_Number = '$_OrderNumber'";
    $link->query($orderitem);
    if($link->affected_rows > 0){
        mysqli_close($link);
        return true;
    }
    else{
        mysqli_close($link);
        return false;
    }
}
function returnBook($OrderNumber){
    connectDB($link);
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber);
    $orderitem = "select Book_ID, Quantity from order_item where Order_Number = '$_OrderNumber'";
    $result = $link->query($orderitem);
    $Orderarray=array();
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($Orderarray,$row);
    }
    for ($i = 0 ; $i < count($Orderarray) ; $i++ ){
        $bookID =$Orderarray[$i]['Book_ID'];
        $sqlins="select Quantity from book where ID = '$bookID'";
        $result = $link->query($sqlins);
        $bookQuantity=$result->fetch_array(MYSQLI_ASSOC);
        $NewbookQuantity = $bookQuantity['Quantity'] + $Orderarray[$i]['Quantity'];
        $sqlins="UPDATE book SET Quantity = $NewbookQuantity  where ID = '$bookID'";
        $link->query($sqlins);
    }
    mysqli_close($link);
}
function DeleteOrderItem($UserID,$OrderNumber){
    connectDB($link);
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber);
    $sqlins = "DELETE from order_item where Order_Number = '$_OrderNumber'";
    $link->query($sqlins);
    mysqli_close($link);
}
function DeleteOrderList($UserID,$OrderNumber){
    connectDB($link); 
    $_OrderNumber = mysqli_real_escape_string($link,$OrderNumber);
    $sqlins = "DELETE from order_list where Number = '$_OrderNumber'";
    $link->query($sqlins);
    mysqli_close($link);
}
//Shelves
function GetShelvesList(){
    connectDB($link);
    $bookIDList = "select Name, ID, Price from book";
    $result = $link->query($bookIDList);
    $BookList = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        array_push($BookList,$row);
    }
    mysqli_close($link);
    return $BookList;
}
function intoBookListPage($page,$pageamount,$opra){
    if ($page==null){
        $page=0;
    }
    if ($opra==0){
        return './BookList.php?Pagenum='.$page;
    }
    else if($opra==1){
        if ($page - 1 > -1){
            return './BookList.php?Pagenum='.($page-1);
        }
        else{
            return './BookList.php?Pagenum='.$page;
        }
    }
    else if($opra==2){
        if ($page + 1 < $pageamount){
            return './BookList.php?Pagenum='.($page+1);
        }
        else{
            return './BookList.php?Pagenum='.$page;
        }
    }
}

function DeleteBook($BookNumber){
    connectDB($link);
    $_BookNumber = mysqli_real_escape_string($link,$BookNumber);
    $sqlins = "DELETE from book where ID like '$_BookNumber'";
    $link->query($sqlins);
    mysqli_close($link);
}

function DeleteBookINShopingCart($BookNumber){
    connectDB($link);
    $_BookNumber = mysqli_real_escape_string($link,$BookNumber);
    $sqlins = "DELETE from shopping_cart where Book_ID like '$_BookNumber'";
    $link->query($sqlins);
    mysqli_close($link);
}
//Newbook
function AddBook($BookID,$ISBN,$BookName,$date,$Price,$Publish,$Author,$Quantity,$Introduction){
    connectDB($link);
    $_BookID = mysqli_real_escape_string($link,$BookID);
    $_ISBN = mysqli_real_escape_string($link,$ISBN);
    $_BookName = mysqli_real_escape_string($link,$BookName);
    $_date = mysqli_real_escape_string($link,$date);
    $_Price = mysqli_real_escape_string($link,$Price);
    $_Publish = mysqli_real_escape_string($link,$Publish);
    $_Author = mysqli_real_escape_string($link,$Author);
    $_Quantity = mysqli_real_escape_string($link,$Quantity);
    $ImagePath = "images/".$_BookID."_1".".jpg";
    $_Introduction = mysqli_real_escape_string($link,$Introduction);
    
    $query = "INSERT INTO book (ID, ISBN, Name, Date, Price, Publisher, Author, Quantity, Image_Path, Introduction) VALUES( '$_BookID', '$_ISBN', '$_BookName', '$_date', '$_Price', '$_Publish', '$_Author', '$_Quantity', '$ImagePath', '$_Introduction')";
    $link->query($query);
    $link->close();
}
function AddCategory($BookID,$Language,$Category){
    connectDB($link);
    $_BookID = mysqli_real_escape_string($link,$BookID);
    $_Language = mysqli_real_escape_string($link,$Language);
    $_Category = mysqli_real_escape_string($link,$Category);
    if($Category=="自然科普"){
        $cate = "Nature/";
    }
    else if($Category=="藝術設計"){
        $cate = "Art/";
    }
    else if($Category=="商業理財"){
        $cate = "Business/";
    }
    else if($Category=="生活風格"){
        $cate = "Life/";
    }
    else if($Category=="飲食"){
        $cate = "Food/";
    }

    $ImagePath = "images/".$cate.$_BookID."_2".".jpg";

    $query = "INSERT INTO category (Book_ID, Language, Type, Image_Path, IsEBook) VALUES( '$_BookID', '$_Language', '$_Category', '$ImagePath', 0)";
    $link->query($query);
    $link->close();
}

function IsIDinBook($BookID){
    connectDB($link);
    $_BookID = mysqli_real_escape_string($link,$BookID);
    $query = "SELECT * FROM book WHERE ID = '$_BookID'";
    $link->query($query);
    if($link->affected_rows > 0)
    {
        $link->close();
         return true;
    }
    $link->close();
    return false;
}
function IsISBNinBook($ISBN){
    connectDB($link);
    $_ISBN = mysqli_real_escape_string($link,$ISBN);
    $query = "SELECT * FROM book WHERE ISBN = '$_ISBN'";
    $link->query($query);
    if($link->affected_rows > 0)
    {
        $link->close();
        return true;
    }
    $link->close();
    return false;
}
?>