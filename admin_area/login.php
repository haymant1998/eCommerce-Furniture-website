<?php
session_start();
if(isset($_SESSION['admin_email'])){
  echo "<script>window.open('index.php','_self')</script>";
}
include ("includes/db.php");
 ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title></title>
  <style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Roboto:300);

  .login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
  }
  .form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
  }
  .form input {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
  }
  .form #button {
    font-family: "Roboto", sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #4CAF50;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
  }
  .form #button:hover,.form #button:active,.form #button:focus {
    background: #43A047;
  }
  .form .message {
    margin: 15px 0 0;
    color: #b3b3b3;
    font-size: 12px;
  }
  .form .message a {
    color: #4CAF50;
    text-decoration: none;
  }
  .form .register-form {
    display: none;
  }
  .container {
    position: relative;
    z-index: 1;
    max-width: 300px;
    margin: 0 auto;
  }
  .container:before, .container:after {
    content: "";
    display: block;
    clear: both;
  }
  .container .info {
    margin: 50px auto;
    text-align: center;
  }
  .container .info h1 {
    margin: 0 0 15px;
    padding: 0;
    font-size: 36px;
    font-weight: 300;
    color: #1a1a1a;
  }
  .container .info span {
    color: #4d4d4d;
    font-size: 12px;
  }
  .container .info span a {
    color: #000000;
    text-decoration: none;
  }
  .container .info span .fa {
    color: #EF3B3A;
  }
  body {
    background: #76b852; /* fallback for old browsers */
    background: -webkit-linear-gradient(right, #76b852, #8DC26F);
    background: -moz-linear-gradient(right, #76b852, #8DC26F);
    background: -o-linear-gradient(right, #76b852, #8DC26F);
    background: linear-gradient(to left, #76b852, #8DC26F);
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
h2{
  color:#67ab5b;
}
  </style>
  <script>
  $('.message a').click(function(){
$('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
  </script>
</head>
<body>
  <div class="login-page">
      <div class="form">
          <form action="" method="post" class="login-form">
            <h2> ADMIN  LOGIN </h2>
              <input type="text" name="admin_email" placeholder="Email" required="required"/>
              <input type="password" name="p" placeholder="Password" required="required"/>
              <input id="button" type="submit" name="login" value="Admin Login"/>
            </form>
    </div>
</div>
<h2 style="color:white;text-align:center;padding:20px"><?php echo @$_GET['logout']; ?></h2>
</body>
</html>
<?php
if(isset($_POST['login'])){
  $user_email=$_POST['admin_email'];
  $user_pass=$_POST['p'];
  $sel_admin="select * from admins where admin_email='$user_email' AND admin_pass='$user_pass'";
  $run_admin=mysqli_query($con,$sel_admin);
  $check_admin=mysqli_num_rows($run_admin);
  if($check_admin==1){
    $_SESSION['admin_email']=$user_email;
    echo "<script>window.open('index.php?logged_in=You successfully logged in!','_self')</script>";
  }
  else{
    echo "<script>alert('Admin Email or Password is incorrect,try again.')</script>";
  }
}



 ?>
