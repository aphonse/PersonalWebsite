<?php
session_start();
if ($_POST['submit']) {
    $conn = mysqli_connect("localhost", "root", "", "alphonse");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql="SELECT * FROM users WHERE email='$name' OR name='$name'";
    $result=mysqli_query($conn,$sql);
    $retval=mysqli_fetch_array($result);
    echo $retval['password'];
    if (!$retval){
        header("Location:index.php?Invalid Username or password");
        exit();
    }else{
        //de-hash the password
        $verifypwd=password_verify($password,$retval['password']);
        if ($verifypwd== false){
            header("Location:index.php?Passwords don't match");
            exit();
        }else{
            $_SESSION['user']=$retval['email'];
            $_SESSION['name']=$retval['name'];
            header("Location:index.php?Login Success");
            exit();
        }
    }
}else{
    header("Location:index.php?Login=empty");
    exit();
}
