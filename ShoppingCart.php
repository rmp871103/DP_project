<?php
  session_start();
  include("./model/model.php");
  if(!isset($_SESSION['userid'])) header("Location: ./login.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/ShoppingCart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>購物車</title>
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
                    echo "<a class='nav-link' href='./ShoppingCart.php' id='check_out_nav_item'><i class='fas fa-shopping-cart'></i>".strval($_SESSION['ShoppingCartNum'])."結帳</a>";
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
      <?php 
        $ShoppingCartList = GetShoppingCart($_SESSION['userid']);
        $BookInfo = NULL;
        for($i = 0;$i < count($ShoppingCartList); $i++)
        {
          //echo $ShoppingCartList[$i]['Book_ID'];
          $BookInfo = GetBook($ShoppingCartList[$i]['Book_ID']);
          //echo $BookInfo['ISBN'];
      ?>
      <div class="box" id=<?php echo "product_box".strval($i)?>>
        <div class="product">
          <img src=<?php echo $BookInfo['Image_Path']; ?> width= 230px height=230px>
          <ul class="info">
            <li>書名：<?php echo $BookInfo['Name']; ?></li>
            <li id=<?php echo "ISBN".strval($i); ?>>ISBN：<?php echo $BookInfo['ISBN']; ?></li>
            <li>作者： <?php echo $BookInfo['Author']; ?></li>
            <li>出版社：<?php echo $BookInfo['Publisher']; ?></li>
            <li>語言：<?php echo GetBookCategory("category",$ShoppingCartList[$i]['Book_ID'],"Language"); ?></li>
            <li>定價：<span id=<?php echo "price".strval($i)?>><?php echo $BookInfo['Price']; ?></span>元</li>
            <li>庫存：<span id=<?php echo "stock".strval($i)?>><?php echo $BookInfo['Quantity']; ?></span></li>
            <li>
              <div class="minus-plus_box">
                  數量：
                  <button class="button"id=<?php echo "minusBtn".strval($i)?>>−</button>
                  <span id=<?php echo"quantity".strval($i)?> name="quantity"><?php echo $ShoppingCartList[$i]['Quantity'];?></span>
                  <button class="button"id=<?php echo "plusBtn".strval($i)?>>+</button>
              </div>
            </li>
            <li><br>總價格: <span id=<?php echo "total_price".strval($i)?>><?php echo $ShoppingCartList[$i]['Quantity'] * $BookInfo['Price'];?></span></li>
          </ul>
          <div class="cancel_btn">
            <button class="cancel" id=<?php echo "cancel".strval($i)?> title="取消商品"><i class="fa fa-close"></i></button>
          </div>

        </div>
      </div>
      <?php 
        }
      ?>
     <!--<div class="box" id="product_box2">
        <div class="product">
          <img src="./images/big1.png">
          <ul class="info">
            <li>書名：大人的化學教室：透過135堂課全盤掌握化學精髓</li>
            <li>ISBN：9789865111922</li>
            <li>作者： 竹田淳一郎</li>
            <li>出版社：台灣東販</li>
            <li>語言：繁體中文</li>
            <li>定價：<span id="price2">500</span>元</li>
            <li>庫存：<span id="stock2">10</span></li>
            <li>
              <div class="minus-plus_box">
                  數量：
                  <button class="button"id="minusBtn2">−</button>
                  <span id="quantity2" name="quantity">1</span>
                  <button class="button"id="plusBtn2">+</button>
              </div>
            </li>
            <li><br>總價格: <span id="total_price2">500</span></li>
          </ul>
          <div class="cancel_btn">
            <button class="cancel" id="cancel2" title="取消商品"><i class="fa fa-close"></i></button>
          </div>

        </div>
      </div> -->

      
    </div>

    <div class="container">
      <button class="button order_btn" type="button" id = "Send">訂購</button>
    </div>

    <footer class="mt-4">
        <p class="text-center pt-5">Copyright © 北科來, 2019<p>
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
    <script src="./js/ShoppingCart.js"></script>

  </body>
</html>
