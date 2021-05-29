<?php
    include('../model/model.php');
    session_start();
    
    function cleanSessionValue()
    {
        //初始化錯誤資訊
        unset($_SESSION['Acc_Err']);
        unset($_SESSION['Mail_Err']);
        unset($_SESSION['Mail_Conf_Err']);
        unset($_SESSION['Password_Err']);
        unset($_SESSION['Confirm_Password_Err']);
        unset($_SESSION['Address_Err']);
        unset($_SESSION['Phone_Err']);
        unset($_SESSION['Birth_Err']);
    }

    $_SESSION['Acc_Err'] = null;
    $_SESSION['Mail_Err'] = null;
    $_SESSION['Mail_Conf_Err']= null;
    $_SESSION['Password_Err'] = null;
    $_SESSION['Confirm_Password_Err'] = null;
    $_SESSION['Address_Err'] =null;
    $_SESSION['Phone_Err'] = null;
    $_SESSION['Birth_Err'] = null;
    //接收register網頁輸入內容
    $account = $_POST['account'];
    $mail_address = $_POST['email'];
    $mail_conf = $_POST['email_Conf'];
    $password = $_POST['password'];
    $password_conf = $_POST['password_conf'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    //暫存register輸入內容 若輸入資料不符規定時還原輸入內容至網頁
    $_SESSION['Acc'] = $account;
    $_SESSION['Mail'] = $mail_address;
    $_SESSION['Mail_Conf'] = $mail_conf;
    $_SESSION['Password'] = $password;
    $_SESSION['Confirm_Password'] = $password_conf;
    $_SESSION['Address'] = $_POST['address'];
    $_SESSION['Phone'] = $phone;
    
    $is_right = TRUE;
    //檢查帳號格式
    if(!preg_match("/[0-9a-zA-Z]{4,10}/", $account) || preg_match("/[^0-9A-Za-z]/", $account))
    {
        $is_right = FALSE;
        $_SESSION['Acc_Err'] = "帳號格式不符";
    }
    //若格式正確 查詢是否已用過此帳號
    elseif(IsAccountIn($account))
    {
        $is_right = FALSE;
        $_SESSION['Acc_Err']="帳號已被使用";
    }
    //查詢mail是否存在
    if(!check_is_email_real_exist($mail_address))
    {
        $is_right = FALSE;
        $_SESSION['Mail_Err']="電子郵件地址不存在";
    }
    //若mail存在 則查詢mail是否已被使用
    elseif(IsMailIn($mail_address))
    {
        $is_right = FALSE;
        $_SESSION['Mail_Err']="Mail已被使用";
    }
    //若mail可使用 則檢查二次mail輸入
    elseif($mail_address!=$mail_conf)
    {
        $is_right = FALSE;
        $_SESSION['Mail_Conf_Err'] = "電子郵件不一致";
    }
    //檢查密碼格式
    if((!preg_match("/[0-9{2,}A-Za-z{2,}]{8,12}/", $password)) || preg_match("/[^0-9A-Za-z]/", $password))
    {
        $is_right = FALSE;
        $_SESSION['Password_Err'] = "密碼格式不符";
    }
    //若密碼格式正確 則檢查二次密碼輸入
    elseif($password != $password_conf)
    {
        $is_right = FALSE;
        $_SESSION['Confirm_Password_Err'] = "密碼不一致";
    }
    if(!isset($address))
    {
        $is_right = FALSE;
        $_SESSION['Address_Err'] = "地址不可為空";
    }
    //檢查手機格式
    if(!preg_match("/^[0][9][0-9]{8}/", $phone))
    {
        $is_right = FALSE;
        $_SESSION['Phone_Err'] = "電話格式不符";
    }
    if(preg_match("/[^0-9]/", $day) || !preg_match("/[0-9]{1,2}/", $day))
    {
        echo("error");
        $is_right = FALSE;
        $_SESSION['Birth_Err'] = "日期填寫不全";
    }
    //若正確則跳轉至登錄畫面
    if($is_right)
    {
        cleanSessionValue();
        $date = $year."-".$month."-".$day;
        AddUser($account,$account,$mail_address, $password, $phone, $address, $date);
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"註冊成功\");\r\n";
        echo " location.replace(\"../login.php\");\r\n"; 
        echo "</script>";
    }
    //若有輸入錯誤 則持續更改註冊資料
    else
    {
        header("Location: ../register.php");    
    }
?>