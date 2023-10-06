<?php

session_start();

if(isset($_SESSION['auth'])){
    if($_SESSION['auth']==1){
      header("location:index.php");
    }
  }

    $notify = "";
    if(isset($_POST['login_btn'])){
         $email = $_POST['student_email'];
         $pass = $_POST['student_pass'];
         $loggedin = isset($_POST['keep_login'])?1:0;

         //echo "$loggedin";

         if($email == "hello@gmail.com" && $pass == "1234"){
            $_SESSION['auth']=1;
            header("location:index.php");
         }
         else{
            $notify = "Invalid email or Password";
         }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>log in</title>
</head>
<body>
    <form action="<?php
        echo $_SERVER['PHP_SELF'];
    ?>" method="post">
        <label for="">Email:</label><br>
            <input type="email" name="student_email" placeholder="Email"><br>
            <label for="">Password:</label><br>
            <input type="password" name="student_pass" placeholder="Password"><br>
            <label for="">
                <input type="checkbox" name="keep_login">Keep me logged in.
            </label><br><br>
            <input type="submit" name="login_btn" value="login">
    </form>
    <div>
        <?php
            echo $notify;
        ?>
    </div>
</body>
</html>