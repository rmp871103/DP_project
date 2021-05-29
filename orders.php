<?php
  session_start();
  include("./model/model.php");
  //關閉session並將資料清除
  //cleanSession();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
    <title>北科來|訂單查詢</title>
  </head>
  <body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <a id="logo" class="navbar-brand" href="./index.php"> <i class="fas fa-book-open" id="logo_icon"></i> 北科來</a>

        <form class="form-inline" role="form" method="GET" action="./searchList.php">
            <input id="search" class="form-control mr-sm-1 ml-auto" type="search" placeholder="搜尋書籍" aria-label="Search" name='keyword'>
            <button id="search_btn" class="btn my-2 my-sm-0" type="button" onclick="location.href='./searchList.php'"><i class="fas fa-search"></i></button>
        </form>

        <ul class="navbar-nav  ml-auto">
            <?php
                if(isset($_SESSION['user']))
                {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='./ShoppingCart.php' id='check_out_nav_item'><i class='fas fa-shopping-cart'></i> 0 結帳</a>";
                    echo "</li>";
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="./orders.php">訂單查詢</a>';
                    echo '</li>';
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href=''>".$_SESSION['user']."</a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='./Controller/logout.php'>登出</a>";
                    echo "</li>";
                    
                }
                else
                {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='./login.php'>登入</a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='./register.php' id='register_nav_item'>註冊</a>";
                    echo "</li>";
                }
            ?>     
    </nav>

    <div id="offset"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 pb-2">
                <h4>訂單查詢</h4>
            </div>

            <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                    <?php
                        $UserID=$_SESSION['userid'];
                        $OrderList = GetMamberOrderList($UserID);
                        for ($i = 0 ; $i < count($OrderList) ; $i++){
                    ?>

                        <table class="table  table-bordered" id=<?php echo "order_box".strval($i)?> width="100%">
                            
                            <thead class="thead-Secondary top-thead">
                                <tr>
                                    <th colspan="2" class="th-text-left">訂單編號：<span class="order_number" id=<?php echo "orderNumber".strval($i); ?> ><?php echo $OrderList[$i];?></span></th>
                                    <th colspan="3" class="th-text-left th-middle">訂購時間：<span class="order_number"><?php echo GetOrder($OrderList[$i], 'Date');?></span></th>
                                    <th colspan="1" class="th-text-right" ><a href="" id=<?php echo "cancelorder".strval($i)?> >取消訂單</a></th>
                                </tr>
                            </thead>

                            <thead class="thead-Secondary bottom-thead">
                                <tr>
                                <th scope="col" style="width: 5%" class="text-nowrap"></th>
                                <th scope="col" style="width: 40%">商品名稱</th>
                                <th scope="col" style="width: 13.5%">單價</th>
                                <th scope="col" style="width: 7.5%">數量</th>
                                <th scope="col" style="width: 15%">商品總額</th>
                                <th scope="col" style="width: 19%">處理狀態</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $BookIDList = GetAllBookInOrder($OrderList[$i]);
                                    for ($j = 0 ; $j < count($BookIDList) ; $j++){
                                ?>
                                    <tr>
                                        <th><?php echo $j+1;?></th>
                                        <td class="text-left"><a href=<?php intotargeturl("./BookInfo.php", $BookIDList[$j]) ?> class="book_name_a"><u><?php echo GetBookInfo("book", $BookIDList[$j],"Name") ?></u></a></td>
                                        <td class="text-center text-danger"><?php echo GetBookInfo("book", $BookIDList[$j],"Price") ?></td>
                                        <td class="text-center"><?php echo GetOrderDetail($OrderList[$i],$BookIDList[$j], 'Quantity');?></td>
                                        <td class="text-center text-danger"><?php echo GetOrderDetail($OrderList[$i],$BookIDList[$j], 'Cost');?></td>
                                        <td class="text-center"><?php echo GetOrder($OrderList[$i], 'Status');?></td>
                                    </tr>
                                <?php
                                    }
                                ?>    

                                <tr class="tfoot-color">
                                    <td class="text-right" colspan="6">處理費：<span class="text-danger"><b>60</b></span> 元</td>
                                </tr>

                                <tr class="tfoot-color-bottom">
                                    <td class="text-right" colspan="6">訂單總額：<span class="text-danger"><b><?php echo CalculateTotalCost($OrderList[$i])?></b></span> 元</td>
                                </tr>

                            </tbody>

                        </table>
                    <?php
                        }
                    ?>        
                </div>
            </div>
        </div>
    </div>


    <footer class="mt-3  fixed-bottom">
        <h6 class="text-center pt-2 small">Copyright © 北科來, 2019</h6>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9819ff2340.js"></script>
    <script src="./js/nav_active.js"></script>
    <script src="./js/order.js"></script>
  </body>
</html>