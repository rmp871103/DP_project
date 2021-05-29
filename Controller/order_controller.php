<?php
    header('Content-Type: application/json');
    session_start();
    include("../model/model.php");
    //header("Content-Type: application/json", true);
    
    /*function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }*/

    if(!isset($_SESSION['userid']))
    {
        $send = array("status" => "1","msg" =>"login.php");
        echo json_encode($send);
        //header("Location: ../login.php");
    }
    else
    {
       
        if(!isset($_POST['OrderNumber']))
        {
            echo json_encode(array("status" => "1","msg" =>"No OrderNumber!"));
        }
        else
        {
            $OrderNumber = $_POST['OrderNumber'];
        }
        
        if(isset($OrderNumber))
        {
            switch($_POST['operate'])
            {
                case "DELETE":
                    if(isOrderNumberInOrderList($_SESSION['userid'],$OrderNumber))
                    {
                        if(isOrderNumberInOrderItem($_SESSION['userid'],$OrderNumber))
                        {
                            returnBook($OrderNumber);
                            DeleteOrderItem($_SESSION['userid'],$OrderNumber);
                            DeleteOrderList($_SESSION['userid'],$OrderNumber);
                            echo json_encode(array("status" => "0","msg" =>"success"));
                        }
                        else
                        {
                            echo json_encode(array("status" => "1","msg" =>"$OrderNumber not in orderitem"));
                        }
                    }
                    else
                    {
                        echo json_encode(array("status" => "1","msg" =>"number not in orderlist"));
                    }
                    break;
                default:
                    echo json_encode(array("status" => "1","msg" =>"Nothing happened."));
                    break;
            }
        }
    }
?>