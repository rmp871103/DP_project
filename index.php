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
                                <div class="carousel-item active">
                                    <a href=""><img class="d-block w-100 image-75" src="./images/main_1.jpg" alt="First slide"></a> 
                                </div>
                                <div class="carousel-item">
                                    <a href=""><img class="d-block w-100 image-75" src="./images/main_2.jpg" alt="First slide"></a> 
                                </div>
                            </div>
        
        
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-3 col-md-3 border">
                <h6 class="pt-2 text-center orange_text">每日推薦</h6>
                <div class="col-sm-12 col-md-12">
                    <a href=""><img src="./images/daily_recommendation.jpg" class="img-fluid"></a>
                </div>
                <h6 class="small font-weight-bold pt-2"><a href="" class="book_name_a">科學的40堂公開課：從仰望星空到觀察細胞及DNA，從原子結構到宇宙生成，人類對宇宙及生命最深刻的提問</a></h6>
                <h6 class="small">這本引人入勝的書，講述了一個偉大的冒險故事：科學的歷史。</h6>
                <h6 class="small text-center pt-2">價格：$ <span class="text-danger font-weight-bold">360</span> 元</h6>
                
                
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">

            <div class="col-sm-9 col-md-9">
                <div class="col-sm-12 col-md-12 border-hot-list" ></div>
                <ul id="hot_list_bg" class="nav hot_list_nav" role="tablist">
                    <li id="hot_list_topic" class="border-right orange_text pl-4 pr-4">暢銷熱賣</li>
                    <li role="presentation" class="hot_list active pl-2 pr-2 border-right" ><a class="hot_list_text link_disable" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab">自然科普</a></li>
                    <li role="presentation" class="hot_list pl-2 pr-2 border-right"><a class="hot_list_text link_disable" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab">藝術設計</a></li>
                    <li role="presentation" class="hot_list pl-2 pr-2 border-right"><a class="hot_list_text link_disable" href="#tab-03" aria-controls="tab-03" role="tab" data-toggle="tab">商業理財</a></li>
                    <li role="presentation" class="hot_list pl-2 pr-2 border-right"><a class="hot_list_text link_disable" href="#tab-04" aria-controls="tab-04" role="tab" data-toggle="tab">生活風格</a></li>
                    <li role="presentation" class="hot_list pl-2 pr-2 border-right"><a class="hot_list_text link_disable" href="#tab-05" aria-controls="tab-05" role="tab" data-toggle="tab">飲食</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab-01">
                        <div class="row">
                            <?php
                                $category = "自然科普";
                                $categoryIDList = GetCategoryIDList($category);
                                for ($i = 0 ; $i < 3 ; $i++){
                            ?>
                            <div class="col-sm-4 col-md-4">
                                <h6 class="pt-2 text-center"><a href=<?php intotargeturl("./BookInfo.php", $categoryIDList[$i]) ?> class="hot_list_book_name_a small"><?php echo GetBookInfo("book", $categoryIDList[$i],"Name");?></a></h6>
                                <div class="col-sm-12 col-md-12">
                                    <a href=""><img src=<?php echo GetBookCategory("category", $categoryIDList[$i],"Image_Path"); ?> class="img-fluid"></a>
                                </div>
                                <h6 class="small hot_list_book_content pt-2"><?php echo GetBookInfo("book", $categoryIDList[$i],"Introduction");?></h6>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-02">
                        <div class="row">
                            <?php
                                $category = "藝術設計";
                                $categoryIDList = GetCategoryIDList($category);
                                for ($i = 0 ; $i < 3 ; $i++){
                            ?>
                            <div class="col-sm-4 col-md-4">
                                <h6 class="pt-2 text-center"><a href=<?php intotargeturl("./BookInfo.php", $categoryIDList[$i]) ?> class="hot_list_book_name_a small"><?php echo GetBookInfo("book", $categoryIDList[$i],"Name");?></a></h6>
                                <div class="col-sm-12 col-md-12">
                                    <a href=""><img src=<?php echo GetBookCategory("category", $categoryIDList[$i],"Image_Path"); ?> class="img-fluid"></a>
                                </div>
                                <h6 class="small hot_list_book_content pt-2"><?php echo GetBookInfo("book", $categoryIDList[$i],"Introduction");?></h6>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-03">
                        <div class="row">
                            <?php
                                $category = "商業理財";
                                $categoryIDList = GetCategoryIDList($category);
                                for ($i = 0 ; $i < 3 ; $i++){
                            ?>
                            <div class="col-sm-4 col-md-4">
                                <h6 class="pt-2 text-center"><a href=<?php intotargeturl("./BookInfo.php", $categoryIDList[$i]) ?> class="hot_list_book_name_a small"><?php echo GetBookInfo("book", $categoryIDList[$i],"Name");?></a></h6>
                                <div class="col-sm-12 col-md-12">
                                    <a href=""><img src=<?php echo GetBookCategory("category", $categoryIDList[$i],"Image_Path"); ?> class="img-fluid"></a>
                                </div>
                                <h6 class="small hot_list_book_content pt-2"><?php echo GetBookInfo("book", $categoryIDList[$i],"Introduction");?></h6>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-04">
                        <div class="row">
                            <?php
                                $category = "生活風格";
                                $categoryIDList = GetCategoryIDList($category);
                                for ($i = 0 ; $i < 3 ; $i++){
                            ?>
                            <div class="col-sm-4 col-md-4">
                                <h6 class="pt-2 text-center"><a href=<?php intotargeturl("./BookInfo.php", $categoryIDList[$i]) ?> class="hot_list_book_name_a small"><?php echo GetBookInfo("book", $categoryIDList[$i],"Name");?></a></h6>
                                <div class="col-sm-12 col-md-12">
                                    <a href=""><img src=<?php echo GetBookCategory("category", $categoryIDList[$i],"Image_Path"); ?> class="img-fluid"></a>
                                </div>
                                <h6 class="small hot_list_book_content pt-2"><?php echo GetBookInfo("book", $categoryIDList[$i],"Introduction");?></h6>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-05">
                        <div class="row">
                            <?php
                                $category = "飲食";
                                $categoryIDList = GetCategoryIDList($category);
                                for ($i = 0 ; $i < 3 ; $i++){
                            ?>
                            <div class="col-sm-4 col-md-4">
                                <h6 class="pt-2 text-center"><a href=<?php intotargeturl("./BookInfo.php", $categoryIDList[$i]) ?> class="hot_list_book_name_a small"><?php echo GetBookInfo("book", $categoryIDList[$i],"Name");?></a></h6>
                                <div class="col-sm-12 col-md-12">
                                    <a href=""><img src=<?php echo GetBookCategory("category", $categoryIDList[$i],"Image_Path"); ?> class="img-fluid"></a>
                                </div>
                                <h6 class="small hot_list_book_content pt-2"><?php echo GetBookInfo("book", $categoryIDList[$i],"Introduction");?></h6>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-3 col-md-3 border">
                    <h6 class="pt-2 text-center orange_text">今日66折</h6>
                    <div class="col-sm-12 col-md-12">
                        <a href=""><img src="./images/daily_discount.jpg" class="img-fluid"></a>
                    </div>
                    <h6 class="small font-weight-bold pt-2"><a href="" class="book_name_a">配色設計學：從理論到應用，零基礎的入門指南</a></h6>
                    <h6 class="small">「沒有不好的顏色，只有不好的搭配。」——梵谷</h6>
                    <h6 class="small text-center pt-2">66折優惠價：$ <span class="text-danger font-weight-bold">297</span> 元</h6>
                    
            </div>

        </div>
    </div>

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
  </body>
</html>