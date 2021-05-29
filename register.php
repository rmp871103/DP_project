<?php
  session_start();
  include("./model/model.php");
  //接收錯誤資訊
  if(isset($_SESSION['Acc_Err'])) $Acc_Err = $_SESSION['Acc_Err'];
  if(isset($_SESSION['Mail_Err'])) $Mail_Err = $_SESSION['Mail_Err'];
  if(isset($_SESSION['Mail_Conf_Err'])) $Mail_Conf_Err = $_SESSION['Mail_Conf_Err'];
  if(isset($_SESSION['Password_Err'])) $Password_Err = $_SESSION['Password_Err'];
  if(isset($_SESSION['Confirm_Password_Err'])) $Confirm_Password_Err = $_SESSION['Confirm_Password_Err'];
  if(isset($_SESSION['Address_Err'])) $Address_Err = $_SESSION['Address_Err'];
  if(isset($_SESSION['Phone_Err'])) $Phone_Err = $_SESSION['Phone_Err'];
  if(isset($_SESSION['Birth_Err'])) $Birth_Err = $_SESSION['Birth_Err'];

  if(isset($_SESSION['Acc'])) $Acc = $_SESSION['Acc'];
  if(isset($_SESSION['Mail'])) $Mail = $_SESSION['Mail'];
  if(isset($_SESSION['Mail_Conf'])) $Mail_Conf = $_SESSION['Mail_Conf'];
  if(isset($_SESSION['Password'])) $Password = $_SESSION['Password'];
  if(isset($_SESSION['Confirm_Password'])) $Confirm_Password = $_SESSION['Confirm_Password'];
  if(isset($_SESSION['Address'])) $Address = $_SESSION['Address'];
  if(isset($_SESSION['Phone'])) $Phone = $_SESSION['Phone'];

  if(isset($_SESSION['Acc_Err'])) unset($_SESSION['Acc_Err']);
  if(isset($_SESSION['Mail_Err'])) unset($_SESSION['Mail_Err']);
  if(isset($_SESSION['Mail_Conf_Err'])) unset($_SESSION['Mail_Conf_Err']);
  if(isset($_SESSION['Password_Err'])) unset($_SESSION['Password_Err']);
  if(isset($_SESSION['Confirm_Password_Err'])) unset($_SESSION['Confirm_Password_Err']);
  if(isset($_SESSION['Phone_Err'])) unset($_SESSION['Phone_Err']);
  if(isset($_SESSION['Birth_Err'])) unset($_SESSION['Birth_Err']);
  if(isset($_SESSION['Acc'])) unset($_SESSION['Acc']);
  if(isset($_SESSION['Mail'])) unset($_SESSION['Mail']);
  if(isset($_SESSION['Mail_Conf'])) unset($_SESSION['Mail_Conf']);
  if(isset($_SESSION['Password'])) unset($_SESSION['Password']);
  if(isset($_SESSION['Confirm_Password'])) unset($_SESSION['Confirm_Password']);
  if(isset($_SESSION['Address'])) unset($_SESSION['Address']);
  if(isset($_SESSION['Phone'])) unset($_SESSION['Phone']);
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
    <title>北科來|註冊會員</title>
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
    <div id="Main2">
        <div class = "container">
            <div class="row">
                <div class="col-sm-10 col-md-10">
                  <div class="card border-drk  mb-3" style="max-width: 40rem;">
                    <div class="card-header">註冊會員</div>
                    <div class="card-body text-drk ">
                        <form action="./Controller/register_controller.php" method="post">
                          會員帳號<dfn>Your ID</dfn><br>
                          <input type="text" name="account" value="<?php if(isset($Acc) && $Acc!="") echo $Acc ?>"  min="4" max="10"><?php if(isset($Acc_Err)) echo "<font color='red'>".$Acc_Err."</font>";?>
                          <br>
                          <p><dfn>請以半形輸入，4-10個英、數字組合。<br>帳號設定不能同密碼。</dfn></p>

                          電子郵件<dfn>Your E-mail</dfn><br>
                          <input type="email" name="email" value="<?php if(isset($Mail) && $Mail!="") echo $Mail ?>"> <?php if(isset($Mail_Err)) echo "<font color='red'>".$Mail_Err."</font>";?>
                          <br>
                          <p><dfn>請以半形輸入，e-mail不能重複註冊。</dfn></p>

                          確認電子郵件<dfn>Confirm Your E-mail</dfn><br>
                          <input type="email" name="email_Conf" value="<?php if(isset($Mail_Conf) && $Mail_Conf != "") echo $Mail_Conf ?>"><?php if(isset($Mail_Conf_Err)) echo "<font color='red'>".$Mail_Conf_Err."</font>";?>
                          <br>
                          <br>

                          密碼<dfn>password</dfn><br>
                          <input type="password" name="password" value="<?php if(isset($Password) && $Password != "") echo $Password ?>" min="8" max="12"><?php if(isset($Password_Err)) echo "<font color='red'>".$Password_Err."</font>";?>
                          <br>
                          <p><dfn>8-12字元，至少2個英文與2個數字<br>
                          不含空白、雙引號、單引號、星號<br>
                          注意密碼不與其他網站相同，確保帳戶安全</dfn></p>

                          確認密碼<dfn>Confirm Your password</dfn><br>
                          <input type="password" name="password_conf" value="<?php if(isset($Confirm_Password) && $Confirm_Password != "") echo $Confirm_Password ?>" min="8" max="12"><?php if(isset($Confirm_Password_Err)) echo "<font color='red'>".$Confirm_Password_Err."</font>";?>
                          <br><br>

                          地址<dfn>address</dfn><br>
                          <input type="text" name="address" value="<?php if(isset($Address) && $Address != "") echo $Address ?>" size="60"><?php if(isset($Address_Err)) echo "<font color='red'>".$Address_Err."</font>";?>
                          <br><br>

                          手機電話<dfn>phone</dfn><br>
                          <input type="text" name="phone" value="<?php if(isset($Phone) && $Phone != "") echo $Phone ?>" ><?php if(isset($Phone_Err)) echo "<font color='red'>".$Phone_Err."</font>";?>
                          <br><br>

                          生日<dfn>birth</dfn><br>
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
                                        <option>1999 </option> <option>1998 </option>
                                        <option>1997 </option> <option>1996 </option>   
                                    </select>年<dfn>year</dfn><?php if(isset($Birth_Err)) echo "<font color='red'>".$Birth_Err."</font>";?>
                          <br><br>
                          <input type="submit" value="註冊">
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
    <script src="./js/register.js"></script>
</html>