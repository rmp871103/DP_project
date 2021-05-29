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
    <title>北科來</title>
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
            <div id="offset"></div>


            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-9">
                        <div class="row">
                            <div id="book_category_bg" class="col-sm-2 col-md-2">
                                <h6 class="pt-2">書籍分類</h6>
                                <ul class="list-group pl-3">
                                    <li><a href=<?php intotargeturl("./searchList.php", "自然科普") ?> class="book_category">自然科普</a></li>
                                    <li><a href=<?php intotargeturl("./searchList.php", "藝術設計") ?> class="book_category">藝術設計</a></li>
                                    <li><a href=<?php intotargeturl("./searchList.php", "商業理財") ?> class="book_category">商業理財</a></li>
                                    <li><a href=<?php intotargeturl("./searchList.php", "生活風格") ?> class="book_category">生活風格</a></li>
                                    <li><a href=<?php intotargeturl("./searchList.php", "飲食") ?> class="book_category">飲食</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <form>  
                                                <ul style="list-style-type:none">
                                                    <?php
                                                        if (isset($_GET['keyword'])){
                                                            $keyword = $_GET['keyword'];
                                                            $categoryIDList = SearchBook($keyword);
                                                        }
                                                        else if (isset($_GET['PageID'])){
                                                            $category = $_GET['PageID'];
                                                            $categoryIDList = GetCategoryIDList($category);
                                                        }
                                                        else{
                                                            $category = "自然科普";
                                                            $categoryIDList = GetCategoryIDList($category);
                                                        }
                                                        for ($i = 0 ; $i < count($categoryIDList) ; $i++){
                                                    ?>
                                                        <li>
                                                            <div class="card mb-3" style="max-width: 540px;">
                                                                <div class="row no-gutters">
                                                                    <div class="col-md-4">
                                                                    <img src=<?php echo GetBookCategory("category", $categoryIDList[$i],"Image_Path"); ?> class="card-img" alt="xxx">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title"><a href=<?php intotargeturl("./BookInfo.php", $categoryIDList[$i]) ?>> <?php echo GetBookInfo("book", $categoryIDList[$i],"Name");?> </a></h5>
                                                                            <p class="card-text"><small class="text-muted">
                                                                                <?php echo GetBookCategory("category", $categoryIDList[$i],"Language");?>&nbsp;&nbsp;
                                                                                <?php echo GetBookInfo("book", $categoryIDList[$i],"Publisher");?>&nbsp;&nbsp;
                                                                                售價:<?php echo GetBookInfo("book", $categoryIDList[$i],"Price");?>元</small></p>
                                                                            <p class="card-text"><?php echo GetBookInfo("book", $categoryIDList[$i],"Introduction");?></p>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </ul>              
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

  </body>

  <footer class="mt-3 fixed-bottom">
    <h6 class="text-center pt-2 small">Copyright © 北科來, 2019</h6>
  </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9819ff2340.js"></script>
    <script src="./js/nav_active.js"></script>
</html>