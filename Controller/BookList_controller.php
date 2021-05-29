<?php
    header('Content-Type: application/json');
    session_start();
    include("../model/model.php");
    //header("Content-Type: application/json", true);
    
    /*function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }*/


    if(!isset($_POST['BookNumber']))
    {
        echo json_encode(array("status" => "1","msg" =>"No BookNumber!"));
    }
    else
    {
        $BookNumber = $_POST['BookNumber'];
    }
    
    if(isset($BookNumber))
    {
        switch($_POST['operate'])
        {
            case "DELETE":
                DeleteBookINShopingCart($BookNumber);
                DeleteBook($BookNumber);
                break;
            default:
                echo json_encode(array("status" => "1","msg" =>"Nothing happened."));
                break;
        }
    }
?>