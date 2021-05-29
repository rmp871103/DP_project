<?php
  session_start();
  include("./model/model.php");
  //接收錯誤資訊
  if(isset($_SESSION['BookID_Err'])) $BookID_Err = $_SESSION['BookID_Err'];
  if(isset($_SESSION['BookName_Err'])) $BookName_Err = $_SESSION['BookName_Err'];
  if(isset($_SESSION['ISBN_Err'])) $ISBN_Err = $_SESSION['ISBN_Err'];
  if(isset($_SESSION['Category_Err'])) $Category_Err = $_SESSION['Category_Err'];
  if(isset($_SESSION['Author_Err'])) $Author_Err = $_SESSION['Author_Err'];
  if(isset($_SESSION['Publish_Err'])) $Publish_Err = $_SESSION['Publish_Err'];
  if(isset($_SESSION['Publish_Date_Err'])) $Publish_Date_Err = $_SESSION['Publish_Date_Err'];
  if(isset($_SESSION['Language_Err'])) $Language_Err = $_SESSION['Language_Err'];
  if(isset($_SESSION['Price_Err'])) $Price_Err = $_SESSION['Price_Err'];
  if(isset($_SESSION['Quantity_Err'])) $Quantity_Err = $_SESSION['Quantity_Err'];
  if(isset($_SESSION['Introduction_Err'])) $Introduction_Err = $_SESSION['Introduction_Err'];

  if(isset($_SESSION['BookID'])) $BookID = $_SESSION['BookID'];
  if(isset($_SESSION['BookName'])) $BookName = $_SESSION['BookName'];
  if(isset($_SESSION['ISBN'])) $ISBN = $_SESSION['ISBN'];
  if(isset($_SESSION['Author'])) $Author = $_SESSION['Author'];
  if(isset($_SESSION['Publish'])) $Publish = $_SESSION['Publish'];
  if(isset($_SESSION['Publish_Date'])) $Publish_Date = $_SESSION['Publish_Date'];
  if(isset($_SESSION['Language'])) $Language = $_SESSION['Language'];
  if(isset($_SESSION['Price'])) $Price = $_SESSION['Price'];
  if(isset($_SESSION['Quantity'])) $Quantity = $_SESSION['Quantity'];
  if(isset($_SESSION['Introduction'])) $Introduction = $_SESSION['Introduction'];

  if(isset($_SESSION['BookID_Err'])) unset($_SESSION['BookID_Err']);
  if(isset($_SESSION['BookName_Err'])) unset($_SESSION['BookName_Err']);
  if(isset($_SESSION['ISBN_Err'])) unset($_SESSION['ISBN_Err']);
  if(isset($_SESSION['Category_Err'])) unset($_SESSION['Category_Err']);
  if(isset($_SESSION['Author_Err'])) unset($_SESSION['Author_Err']);
  if(isset($_SESSION['Publish_Err'])) unset($_SESSION['Publish_Err']);
  if(isset($_SESSION['Publish_Date_Err'])) unset($_SESSION['Publish_Date_Err']);
  if(isset($_SESSION['Language_Err'])) unset($_SESSION['Language_Err']);
  if(isset($_SESSION['Price_Err'])) unset($_SESSION['Price_Err']);
  if(isset($_SESSION['Quantity_Err'])) unset($_SESSION['Quantity_Err']);
  if(isset($_SESSION['Introduction_Err'])) unset($_SESSION['Introduction_Err']);
  if(isset($_SESSION['BookID'])) unset($_SESSION['BookID']);  
  if(isset($_SESSION['BookName'])) unset($_SESSION['BookName']);
  if(isset($_SESSION['ISBN'])) unset($_SESSION['ISBN']);
  if(isset($_SESSION['Category'])) unset($_SESSION['Category']);
  if(isset($_SESSION['Author'])) unset($_SESSION['Author']);
  if(isset($_SESSION['Publish'])) unset($_SESSION['Publish']);
  if(isset($_SESSION['Publish_Date'])) unset($_SESSION['Publish_Date']);
  if(isset($_SESSION['Language'])) unset($_SESSION['Language']);
  if(isset($_SESSION['Price'])) unset($_SESSION['Price']);
  if(isset($_SESSION['Quantity'])) unset($_SESSION['Quantity']);
  if(isset($_SESSION['Introduction'])) unset($_SESSION['Introduction']);
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

    <link rel="stylesheet" href="./css/bootstrap2.min.css">
    <link rel="stylesheet" href="./css/bootstrap-datetimepicker.css" />
    <link rel="stylesheet" href="./css/pmd-datetimepicker.css" />
    <link rel="stylesheet" href="./css/index.css">
    
    
    <title>北科來|上架書籍</title>
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
    <div class="row col-sm-12 col-md-12 d-flex justify-content-center mt-4"></div>
    <div class="row col-sm-12 col-md-12 d-flex justify-content-center" id="test">
        <div class="card border-drk mb-3" style="max-width: 40rem;">
        <div class="card-header">上架書籍</div>
        <div class="card-body text-drk">
            <form action="./Controller/NewBook_controller.php" method="post" enctype="multipart/form-data">
                Book_ID<br>
                <input class="mt-1 mb-2" type="text" name="bookID" value="<?php if(isset($BookID) && $BookID!="") echo $BookID ?>">
                <?php if(isset($BookID_Err)) echo "<font color='red'>".$BookID_Err."</font>";?>
                <br>

                書名<br>
                <input class="mt-1 mb-2" type="text" name="bookName" value="<?php if(isset($BookName) && $BookName!="") echo $BookName ?>">
                <?php if(isset($BookName_Err)) echo "<font color='red'>".$BookName_Err."</font>";?>
                <br>

                ISBN<br>
                <input class="mt-1 mb-2" type="text" name="bookISBN" value="<?php if(isset($ISBN) && $ISBN!="") echo $ISBN ?>">
                <?php if(isset($ISBN_Err)) echo "<font color='red'>".$ISBN_Err."</font>";?>
                <br>
                
                書籍分類<br>
                <select name="bookCategory" class="mt-1 mb-2">
                    <option selected>請選擇</option>
                    <option>自然科普</option>
                    <option>藝術設計</option>
                    <option>商業理財</option>
                    <option>生活風格</option>
                    <option>飲食</option> 

                </select><?php if(isset($Category_Err)) echo "<font color='red'>".$Category_Err."</font>";?><br>

                作者<br>
                <input class="mt-1 mb-2" type="text" name="author" value="<?php if(isset($Author) && $Author!="") echo $Author ?>">
                <?php if(isset($Author_Err)) echo "<font color='red'>".$Author_Err."</font>";?>
                <br>

                出版地<br>
                <input class="mt-1 mb-2" type="text" name="publish" value="<?php if(isset($Publish) && $Publish!="") echo $Publish ?>">
                <?php if(isset($Publish_Err)) echo "<font color='red'>".$Publish_Err."</font>";?>
                <br>

                出版日期<br>
                        <select name="day" id="day_sel">
                        </select>日<dfn>day</dfn>  &nbsp;&nbsp;
                        <select name="month" id="month_sel">
                            <option selected>請選擇 </option>
                            <option>1 </option> <option>2 </option>
                            <option>3 </option> <option>4 </option>
                            <option>5 </option> <option>6 </option>
                            <option>7 </option> <option>8 </option>
                            <option>9 </option> <option>10 </option>
                            <option>11 </option> <option>12 </option>   
                        </select>月<dfn>month</dfn> &nbsp;&nbsp;
                        <select name="year" id="year_sel">
                                <option selected>請選擇 </option>
                                <option>2019</option> <option>2020</option>   
                        </select>年<dfn>year</dfn><?php if(isset($Publish_Date_Err)) echo "<font color='red'>".$Publish_Date_Err."</font>";?>
                <br>
                語言<br>
                <input class="mt-1 mb-2" type="text" name="language" value="<?php if(isset($Language) && $Language!="") echo $Language ?>">
                <?php if(isset($Language_Err)) echo "<font color='red'>".$Language_Err."</font>";?>
                <br>

                定價<br>
                <input class="mt-1 mb-2" type="text" name="price" value="<?php if(isset($Price) && $Price!="") echo $Price ?>">
                <?php if(isset($Price_Err)) echo "<font color='red'>".$Price_Err."</font>";?>
                <br>

                庫存<br>
                <input class="mt-1 mb-2" type="text" name="stock" value="<?php if(isset($Quantity) && $Quantity!="") echo $Quantity ?>">
                <?php if(isset($Quantity_Err)) echo "<font color='red'>".$Quantity_Err."</font>";?>
                <br>

                內容簡介<br>
                <textarea class="mt-1 mb-2" cols="60" rows="5" name="bookContent"></textarea>
                <?php if(isset($Introduction_Err)) echo "<font color='red'>".$Introduction_Err."</font>";?>
                <br>

                
                <div class="row py-4">
                        <div class="col-sm-12 col-md-12">
                
                            <!-- Upload image input-->
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <input id="upload" type="file" name="file" onchange="readURL(this);" class="form-control border-0">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted"></label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">上傳圖片</small></label>
                                </div>
                            </div>
                
                            <!-- Uploaded image area-->
                            圖片預覽：<br>
                            <div class="image-area"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                
                        </div>
                    </div>

                <input type="submit" value="上架">
            </form> 
        </div>
        </div>
    </div>  


    <footer class="mt-3  fixed-bottom">
        <h6 class="text-center pt-2 small">Copyright © 北科來, 2019</h6>
    </footer>
    
  </body>
  <script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="./js/propeller.min.js"></script>
    <script type="text/javascript" src="./js/moment-with-locales.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9819ff2340.js"></script>
    
    <script src="./js/zh-tw.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./js/nav_active.js"></script>
    <script src="./js/register.js"></script>
</html>