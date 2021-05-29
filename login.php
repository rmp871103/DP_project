<?php 
  session_start();
  if(isset($_SESSION['Login_Err'])) $Err = $_SESSION['Login_Err'];
  if(isset($_SESSION['Login_acc'])) $acc = $_SESSION['Login_acc'];

  //釋放session空間
  if(isset($_SESSION['Login_Err'])) unset($_SESSION['Login_Err']);
  if(isset($_SESSION['Login_acc'])) unset($_SESSION['Login_acc']);
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
    <title>北科來|會員登入</title>
  </head>

  <body>
      <!--導覽列-->
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

    <!--內容-->
    <div id="Main">
        <div class = "container">
            <div class="row">
                <div class="col-sm-10 col-md-10">
                  <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">會員登入</div>
                    <div class="card-body text-dark">
                        <form action="./Controller/login_controller.php" method="post">
                          會員帳號<br>
                          <input type="text" name="account" value='<?php if(isset($acc) && $acc!="") echo $acc; ?>'>
                          <br>
                          密碼<br>
                          <input type="password" name="password" value="">
                          <br><?php if(isset($Err)) echo "<font color='red'>".$Err."</font>"; ?><br>
                          <input type="submit" value="登入">
                          <a class="btn btn btn-outline-info" href="./register.php">註冊會員</a>
                        </form> 
                    </div>
                  </div>
                </div>  
            </div>  
        </div>
    </div>

  </body>

  <footer class="mt-4">
    <p class="text-center pt-5">Copyright © 北科來, 2019</p>
  </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9819ff2340.js"></script>
    <script src="./js/nav_active.js"></script>
</html>