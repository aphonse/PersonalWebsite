<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 27-Feb-18
 * Time: 3:23 PM
 */
session_start();
$conn=mysqli_connect("localhost","root","","alphonse");
if (($_SESSION['user'])){
    if ($_POST['book']){
        $email=$_SESSION['user'];
        $src=$_POST['src'];
        $itemname=$_POST['itemname'];
        $price=$_POST['price'];
        $owner=$_POST['owner'];
        $type="jpg";
        $newname=$email.time().".".$type;
        if (copy($src,"booked/$newname")) {
            $id = $_POST['id'];
            $_SESSION['source']=$src;
            $sql = "INSERT INTO `booked`(`bookedBy`,`email`,`itemname`, `pic`,`price`) VALUES ('$email','$owner','$itemname','$newname','$price')";
            $result=mysqli_query($conn,$sql);
            if ($result) {
                $sql2="DELETE FROM `uploads` WHERE id='$id'";
                $result2=mysqli_query($conn,$sql2);
                unlink($src);
                $name = $_SESSION['user'];
                $_SESSION['booked'] = $name;
                header("Location:index.php");
                exit();
            }else{
                header("Location:index.php?error booking");
                exit();
            }
        }else{
            header("Location:index.php?copying error");
            exit();
        }
    }else{
        header("Location:index.php?Booking error");
        exit();
    }
}else{
    header("Location:index.php?You need to be logged in to book");
    exit();
}