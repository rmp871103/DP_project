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
    <link rel="stylesheet" href="./css/BookInfo.css">
    <title>書籍資訊</title>
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
    <?php
      $bookID = '2001';
      if (isset($_GET['PageID'])){
        $bookID = $_GET['PageID'];
      }            
    ?>
    <!-- 類別鏈接 -->
    <div class="container">
      <a href = "./index.php">北科來</a> > <a href = <?php intotargeturl("./searchList.php",  GetBookCategory("category", $bookID,"Type"));?>><?php echo GetBookCategory("category", $bookID,"Type"); ?></a> > 商品介紹
    </div>

    <!--介紹-->
    <div class="container">
      <div class="detail">
        <div class="picture">
          
          <img src=<?php echo GetBookInfo("book", $bookID,"Image_Path"); ?> width="450" height="400">
        </div>
        
        <div class="info">
          <h5><b><?php echo GetBookInfo("book", $bookID,"Name"); ?> </b></h5>
          <ul>
            <li>作者: <?php echo GetBookInfo("book", $bookID,"Author"); ?></li>
            <li>出版社： <?php echo GetBookInfo("book", $bookID,"Publisher"); ?> </li>
            <li>出版日期：<?php echo GetBookInfo("book", $bookID,"Date"); ?></li>
            <li>語言： <?php echo GetBookCategory("category", $bookID,"Language"); ?></li>
            <li>定價： <?php echo GetBookInfo("book", $bookID,"Price"); ?> 元</li>
            <li>庫存: <?php echo GetBookInfo("book", $bookID,"Quantity"); ?></li>
          </ul>
          <span class="track">可配送點：台灣、蘭嶼、綠島、澎湖、金門、馬祖</span>
          <span class="track">可取貨點：台灣、蘭嶼、綠島、澎湖、金門、馬祖</span>
          <div id="div_bottom">
              <ul id="ul_button">
                <li><button class="button cart" type="button" id="AddShoppingCart">放入購物車</button></li>
                <li><button class="button collect" stype="button">加入收藏</button></li>
              </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- 内容簡介-->
    <div class="container">
            <div class="title">
                <h5 >内容簡介</h5>
            </div>
            <p>     
              <b><?php echo GetBookInfo("book", $bookID,"Introduction");?></b><br>
            </p>
    </div>

    <!-- 作者介紹-->
    <div class="container">
            <div class="title">
                <h5 >作者介紹</h5>
            </div>
            <p>
                <b>作者簡介</b><br><br>

                <b><?php echo GetBookInfo("book", $bookID,"Author"); ?></b><br><br>

                    　　1979年出生於東京。慶應義塾大學理工學部應用化學科畢業，慶應義塾大學研究所畢業。早稻田大學高等學院（高中）教師，早稻田大學教育學部、開放課程講師，氣象預報士、環境計量士。<br><br>

                    　　喜歡教學，平常教的是國中生、高中生，此外也會在實驗教室教導小學生、在大學教導以老師為志願的學生、在開放課程中教導三十歲～八十歲的社會人士，致力於讓各年齡層的人們都能享受科學的樂趣。<br><br>

                    　　目標是利用身邊的教材，以實驗為中心，讓人們能享受到學習的樂趣。<br><br>

                    　　著作包括《給大人的高中化學複習》（講談社Blue Backs）等。<br><br>
            </p>
    </div>

    <!-- 詳細資料 -->
    <div class="container">
        <div class="title">
            <h5>詳細資料</h5>
        </div>
        <p>
            ISBN： <?php echo GetBookInfo("book", $bookID,"ISBN"); ?><br>
            出版地：台灣<br><br>
            本書分類：<a href=<?php intotargeturl("./searchList.php",  GetBookCategory("category", $bookID,"Type"));?>><?php echo GetBookCategory("category", $bookID,"Type"); ?></a>
        </p>
    </div>

    <!-- 購物説明 -->
    <div class="container">
            <div class="title">
                <h5>購物説明</h5>
            </div>
            <p>
                若您具有法人身份為常態性且大量購書者，或有特殊作業需求，建議您可洽詢「企業採購」。<br><br>

                <b>退換貨說明</b> <br><br>

                會員所購買的商品均享有到貨十天的猶豫期（含例假日）。退回之商品必須於猶豫期內寄回。<br><br>

                <b>辦理退換貨時，商品必須是全新狀態與完整包裝(請注意保持商品本體、配件、贈品、保證書、原廠包裝及所有附隨文件或資料的完整性，切勿缺漏任何配件或損毀原廠外盒)。退回商品無法回復原狀者，恐將影響退貨權益或需負擔部分費用。</b> <br><br>

                <b>訂購本商品前請務必詳閱商品退換貨原則。</b>
            </p>
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
    <script src="./js/BookInfo.js"></script>

  </body>
</html>
