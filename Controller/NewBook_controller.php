<?php
    include('../model/model.php');
    session_start();
    
    function cleanSessionValue()
    {
        //初始化錯誤資訊
        if(isset($_SESSION['BookID_Err'])) unset($_SESSION['BookID_Err']);
        if(isset($_SESSION['BookName_Err'])) unset($_SESSION['BookName_Err']);
        if(isset($_SESSION['ISBN_Err'])) unset($_SESSION['ISBN_Err']);
        if(isset($_SESSION['Category_Err'])) unset($_SESSION['Category_Err']);
        if(isset($_SESSION['Author_Err'])) unset($_SESSION['Author_Err']);
        if(isset($_SESSION['Publish_Err'])) unset($_SESSION['Publish_Err']);
        if(isset($_SESSION['Publish_Date_Err'])) unset($_SESSION['Publish_Date_Err']);
        if(isset($_SESSION['Language_Err'])) unset($_SESSION['Language_Err']);
        if(isset($_SESSION['Price_Err'])) unset($_SESSION['Price_Err']);
        if(isset($_SESSION['Quantity_Err'])) unset($_SESSION['Quantity_Err']);
        if(isset($_SESSION['Introduction_Err'])) unset($_SESSION['Introduction_Err']);
        if(isset($_SESSION['BookID'])) unset($_SESSION['BookID']);  
        if(isset($_SESSION['BookName'])) unset($_SESSION['BookName']);
        if(isset($_SESSION['ISBN'])) unset($_SESSION['ISBN']);
        if(isset($_SESSION['Category'])) unset($_SESSION['Category']);
        if(isset($_SESSION['Author'])) unset($_SESSION['Author']);
        if(isset($_SESSION['Publish'])) unset($_SESSION['Publish']);
        if(isset($_SESSION['Publish_Date'])) unset($_SESSION['Publish_Date']);
        if(isset($_SESSION['Language'])) unset($_SESSION['Language']);
        if(isset($_SESSION['Price'])) unset($_SESSION['Price']);
        if(isset($_SESSION['Quantity'])) unset($_SESSION['Quantity']);
        if(isset($_SESSION['Introduction'])) unset($_SESSION['Introduction']);
    }
    $_SESSION['BookID_Err'] = null;
    $_SESSION['BookName_Err'] = null;
    $_SESSION['ISBN_Err'] = null;
    $_SESSION['Category_Err'] = null;
    $_SESSION['Author_Err'] = null;
    $_SESSION['Publish_Err'] = null;
    $_SESSION['Language_Err'] = null;
    $_SESSION['Price_Err'] = null;
    $_SESSION['Quantity_Err'] = null;
    $_SESSION['Introduction_Err'] = null;
    $_SESSION['Publish_Date_Err'] = null;
    //輸入
    $BookID = $_POST['bookID'];
    $BookName = $_POST['bookName'];
    $ISBN = $_POST['bookISBN'];
    $Category = $_POST['bookCategory'];
    $Author = $_POST['author'];
    $Publish = $_POST['publish'];
    $Language = $_POST['language'];
    $Price = $_POST['price'];
    $Quantity = $_POST['stock'];
    $Introduction = $_POST['bookContent'];

    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    //暫存輸入內容 若輸入資料不符規定時還原輸入內容至網頁
    $_SESSION['BookID'] = $BookID;
    $_SESSION['BookName'] = $BookName;
    $_SESSION['ISBN'] = $ISBN;
    $_SESSION['Author'] = $Author;
    $_SESSION['Publish'] = $Publish;
    $_SESSION['Language'] = $Language;
    $_SESSION['Price'] = $Price ;
    $_SESSION['Quantity'] = $Quantity;
    $_SESSION['Introduction'] = $Introduction;
    
    $is_right = TRUE;
    if(!preg_match("/^[0-9]{4,10}$/", $BookID) || IsIDinBook($BookID))
    {
        $is_right = FALSE;
        $_SESSION['BookID_Err'] = "ID格式不符";
    }

    if(!preg_match("/^.{3,50}$/",$BookName)){
        $is_right = FALSE;
        $_SESSION['BookName_Err'] = "書名格式不符";
    }

    if(!preg_match("/^[0-9]{13}$/",$ISBN) || IsISBNinBook($ISBN)){
        $is_right = FALSE;
        $_SESSION['ISBN_Err'] = "ISBN格式不符";
    }
    if(preg_match("/^請選擇$/",$Category)){
        $is_right = FALSE;
        $_SESSION['Category_Err'] = "未選類別";
    }

    if(!preg_match("/^.{1,40}$/",$Author)){
        $is_right = FALSE;
        $_SESSION['Author_Err'] = "作者格式不符";
    }
    if(!preg_match("/^.{1,40}$/",$Publish)){
        $is_right = FALSE;
        $_SESSION['Publish_Err'] = "出版社格式不符";
    }

    if(preg_match("/[^\x{4e00}-\x{9fa5}]/u",$Language) || ! preg_match("/^.{1,9}$/",$Language)){
        $is_right = FALSE;
        $_SESSION['Language_Err'] = "語言格式不符";
    }
    if(!preg_match("/^[0-9]{1,8}$/",$Price) || preg_match("/^0/",$Price)){
        $is_right = FALSE;
        $_SESSION['Price_Err'] = "價格格式不符";
    }
    if(!preg_match("/^[0-9]{1,3}$/",$Quantity) || preg_match("/^0/",$Quantity)){
        $is_right = FALSE;
        $_SESSION['Quantity_Err'] = "數量格式不符";
    }
    if(!preg_match("/^.{5,40}$/",$Introduction)){
        $is_right = FALSE;
        $_SESSION['Introduction_Err'] = "介紹格式不符".$Introduction;
    }

    if(preg_match("/[^0-9]/", $day) || !preg_match("/[0-9]{1,2}/", $day))
    {
        echo("error");
        $is_right = FALSE;
        $_SESSION['Publish_Date_Err'] = "日期填寫不全";
    }

    if ($is_right && ($_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/jpeg")){
        if (file_exists("../images/".$BookID."_1".".jpg")) {
            echo $_FILES["file"]["name"] . " already exists. ";
            $is_right = FALSE;
        }
        else {
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
            $jpg2 = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                "../images/". $BookID."_1".".jpg");
            imagejpeg(
                $jpg2,
                "../images/".$cate.$BookID."_2".".jpg");    
        }    
    }
    else {
        $is_right = FALSE;
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"file type error\");\r\n"; 
        echo "</script>";
    }

    if($is_right)
    {
        cleanSessionValue();
        $date = $year."-".$month."-".$day;
        AddBook($BookID,$ISBN,$BookName,$date,$Price,$Publish,$Author,$Quantity,$Introduction);
        AddCategory($BookID,$Language,$Category);
        
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"加入成功\");\r\n";
        echo " location.replace(\"../BookList.php\");\r\n"; 
        echo "</script>";
    }
    else
    {
        header("Location: ../NewBook.php");    
    }
?>