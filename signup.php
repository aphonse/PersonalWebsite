<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 22-Feb-18
 * Time: 7:23 PM
 */
session_start();
if (isset($_POST['submit'])) {
    $conn = mysqli_connect("localhost", "root", "", "alphonse");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pword']);
    $passwordconf = mysqli_real_escape_string($conn, $_POST['pwordconf']);
    //Check the passwords
    if (!($password==$passwordconf)){
        $_SESSION['passworderror']="Passwords don't match!";
        header("Location:register.php?Signup=Passwords dont match");
        exit();
    }else{
        //check whether email has already been used
        $sql= "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)>0) {
            $_SESSION['emailerror']="Email already used!";
            header("Location:register.php?Signup=Email already used");
            exit();
        }else{
            //hash password
            $hashedpwd=password_hash($password,PASSWORD_DEFAULT);
            $sql2="INSERT INTO `users`(`name`, `password`, `email`) VALUES ('$name','$hashedpwd','$email')";
            $result2=mysqli_query($conn,$sql2);
            $affected=mysqli_affected_rows($conn);
            if (!$affected){
                $_SESSION['signuperror']="Signup was unsuccessful";
                header("Location:register.php?Signup=Unsuccessful");
                exit();
            }else{

                header("Location:index.php?Signup=Success");
                exit();
            }

        }
    }
} else{
    header("Location:register.php");
    exit();
}