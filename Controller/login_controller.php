<?php
    include("../model/model.php");
    session_start();
    $account = $_POST['account'];
    $password = $_POST['password'];
    $is_right = TRUE;
    if(!preg_match("/[0-9a-zA-Z]{4,10}/", $account) || preg_match("/[^0-9A-Za-z]/", $account))
    {
        $is_right = FALSE;
    }
    elseif((!preg_match("/[0-9{2,}A-Za-z{2,}]{8,12}/", $password)) || preg_match("/[^0-9A-Za-z]/", $password))
    {
        $is_right = FALSE;
    }
    $id = login_select($account,$password);
    if(!isset($id))
    {
        $is_right = FALSE;
    }
    if($is_right)
    {
        if(isset($_SESSION['Login_Err'])) unset($_SESSION['Login_Err']);
        if(isset($_SESSION['Login_acc'])) unset($_SESSION['Login_acc']);
        $_SESSION['user'] = $account;
        $_SESSION['userid'] = $id;
        $ShoppingCartList = GetShoppingCart($_SESSION['userid']);
        $_SESSION['ShoppingCartNum'] = count($ShoppingCartList);
        header("Location: ../index.php");
    }
    else
    {
        $_SESSION['Login_acc'] = $account;
        $_SESSION['Login_Err'] = "帳號或密碼錯誤";
        header("Location: ../login.php");
    }
?>