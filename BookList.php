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
    
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9819ff2340.js"></script>
    <script type="text/javascript" src="./js/jquery.bootpag.min.js"></script>
    <!-- <script type="text/javascript" src="./js/jquery.bootpag.js"></script> -->
    <script src="./js/nav_active.js"></script>

    <title>北科來|已上架書籍</title>
  </head>
  <body>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <a id="logo" class="navbar-brand" href="./index.php"> <i class="fas fa-book-open" id="logo_icon"></i> 北科來</a>

        <input id="search" class="form-control mr-sm-1 ml-auto" type="search" placeholder="搜尋書籍" aria-label="Search">
        <button id="search_btn" class="btn my-2 my-sm-0" type="button" onclick="location.href='./searchList.php'"><i class="fas fa-search"></i></button>

        <ul class="navbar-nav  ml-auto">
            <!--
            <li class="nav-item">
                <a class="nav-link" href="" id="check_out_nav_item"><i class="fas fa-shopping-cart"></i> 0 結帳</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./login.html">登入</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="./register.html" id="register_nav_item">註冊</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="./orders.html">訂單查詢</a>
            </li>
            -->
        </ul>
    </nav>

    <div id="offset"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 pb-2">
                <h4>已上架書籍</h4>
            </div>

            

            <div id="content" class="col-sm-12 col-md-12">


                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">

                        <thead class="thead-Secondary bottom-thead">
                            <tr>
                            <th scope="col" style="width: 40%">書名</th>
                            <th scope="col" style="width: 30%">ID</th>
                            <th scope="col" style="width: 15%">價格</th>
                            <th scope="col" style="width: 15%">操作</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $totalbook = GetShelvesList();
                                $PageNum=0;
                                if (isset($_GET['Pagenum'])){
                                    $PageNum = $_GET['Pagenum']; 
                                }
                                if ((count($totalbook) - $PageNum*10) >= 10){
                                    $left= 10;
                                }
                                else{
                                    $left = (count($totalbook) - $PageNum*10)%10;
                                }
                                for($booki = 0 ; $booki < $left ; $booki++){               
                                ?>
                                <tr id=<?php echo "bookList_box".strval($booki)?>>
                                    <td class="text-left"><a href="" class="book_name_a"><u><?php echo $totalbook[$booki+$PageNum*10]['Name']; ?></u></a></td>
                                    <td class="text-center" id=<?php echo "bookNumber".strval($booki); ?>><?php echo $totalbook[$booki+$PageNum*10]['ID']; ?></td>
                                    <td class="text-center"><?php echo $totalbook[$booki+$PageNum*10]['Price']; ?></td>
                                    <td class="text-center" ><a href="" id=<?php echo "cancelbook".strval($booki)?>>下架</a></td>
                                </tr>

                                <?php
                                    }
                                ?>
                        </tbody>

                    </table>
                </div>  
            </div>
            <ul class="pagination pagination-sm">
                <?php
                    if (count($totalbook) <= 10){
                        $pageamount = 1;
                    }
                    else if (count($totalbook)%10 == 0){
                        $pageamount = intval(count($totalbook) / 10);
                    }
                    else{
                        $pageamount = intval(count($totalbook) / 10) + 1;
                    }
                    if (isset($_GET['Pagenum'])){
                        $PageNum = $_GET['Pagenum']; 
                    }
                ?>
                <li><a href= <?php echo intoBookListPage($PageNum, $pageamount, 1)?>>&laquo;</a></li>
                <?php
                    for($pagei = 0; $pagei < $pageamount ; $pagei++ ){
                ?>
                <li><a href=<?php echo intoBookListPage($pagei, $pageamount,0)?>> <?php echo $pagei+1?> </a></li>
                <?php
                    }
                ?>
                <li><a href= <?php echo intoBookListPage($PageNum, $pageamount, 2)?>>&raquo;</a></li>
            </ul>
        </div>
    </div>


    <footer class="mt-3  fixed-bottom">
        <h6 class="text-center pt-2 small">Copyright © 北科來, 2019</h6>
    </footer>
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <script src="./js/BookList.js"></script>
    
  </body>
</html>