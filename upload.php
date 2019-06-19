<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 22-Feb-18
 * Time: 11:34 PM
 */
session_start();
if (@$_SESSION['user']) {
    if ($_POST['upload']) {
        $conn = mysqli_connect("localhost", "root", "", "alphonse");

        $itemname = mysqli_real_escape_string($conn, $_POST['name']);
        $price = $_POST['price'];
        $filename = $_FILES['file']['name'];
        $tmpname = $_FILES['file']['tmp_name'];

        $email = $_SESSION['user'];

        if (copy("$tmpname", "uploads/$filename")) {
            $location = "uploads/$filename";
            $sql = "INSERT INTO `uploads`(`itemname`, `email`, `pic`, `price`) VALUES ('$itemname','$email','$location',$price)";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                header("Location:uploadfile.php?Could not insert to database");
                exit();
            } else {
                header("Location:index.php?Upload success");
                exit();
            }
        } else {
            header("Location:uploadfile.php?Upload error");
            exit();
        }
    } else {
        header("Location:index.php");
        exit();
    }
}else{
    header("Location:index.php?login to upload");
    exit();
}
