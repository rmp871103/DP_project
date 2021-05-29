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
    elseif(isset($_POST['operate'])&&$_POST['operate']=="ADD_ORDER")
    {
        $OrderNumber = rand(0,999999999);
        $OrderNumber = AddOrderList($_SESSION['userid'], $OrderNumber);
        $shoppingCart = GetShoppingCart($_SESSION['userid']);
        $total = AddOrderItem($_SESSION['userid'], $shoppingCart, $OrderNumber);
        UpdateOrderTotal($OrderNumber, $total);
        $_SESSION['ShoppingCartNum'] = 0;
        echo json_encode(array("status" => "2","msg" =>"index.php"));
    }
    else
    {
       
        if(!isset($_POST['Bookid']))
        {
            if(isset($_POST['ISBN']))
            {
                echo json_encode(array("status" => "0","msg" =>"Get BookID!".$_POST['ISBN']));
                $BookId = ISBNtoBookID($_POST['ISBN']);
                //echo json_encode(array("status" => "0","msg" =>"Get BookID!".$_POST['ISBN']));
            }
            else
            {
                echo json_encode(array("status" => "0","msg" =>"No bookid and ISBN!"));
            }
        }
        else
        {
            $BookId = $_POST['Bookid'];
        }
        
        if(isset($BookId)&&isset($_POST['operate']))
        {
            switch($_POST['operate'])
            {
                case "ADD":
                    if(!isBookInShoppingCart($_SESSION['userid'],$BookId))
                    {
                        AddShoppingCart($_SESSION['userid'],$BookId);
                        $_SESSION['ShoppingCartNum'] += 1;
                        echo json_encode(array("status" => "0","msg" =>"add successfully!"));
                    }
                    else
                    {
                        echo json_encode(array("status" => "-1","msg" =>"Add repeatedly"));
                    }
                    break;
                case "UPDATE":
                    if(isset($_POST['Quantity'])&&isBookInShoppingCart($_SESSION['userid'],$BookId)&&$_POST['Quantity'] <= GetBookInfo("book",$BookId,"Quantity") &&$_POST['Quantity']>0)
                    {
                        UpdateShoppingCart($_SESSION['userid'],$BookId,$_POST['Quantity']);
                        echo json_encode(array("status" => "0","msg" =>"update successfully!"));
                    }
                    else
                    {
                        echo json_encode(array("status" => "-1","msg" =>"update failed!"));
                    }
                    break;
                case "DELETE":
                    if(isBookInShoppingCart($_SESSION['userid'],$BookId))
                    {
                        DeleteShoppingCart($_SESSION['userid'],$BookId);
                        $_SESSION['ShoppingCartNum'] -= 1;
                        echo json_encode(array("status" => "0","msg" =>"Delete successfully!"));
                    }
                    else
                    {
                        echo json_encode(array("status" => "-1","msg" =>"Book is not found."));
                    }
                    break;
                default:
                    echo json_encode(array("status" => "0","msg" =>"Nothing happened."));
                    break;
            }
        }
        
    }
?>