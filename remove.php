<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 27-Feb-18
 * Time: 8:29 PM
 */
session_start();
if (@$_SESSION['user']) {
    if (@$_POST['remove']) {
        $conn = mysqli_connect("Localhost", "root", "", "alphonse");

        $location = $_POST['location'];
        $itemname = $_POST['itemname'];
        $email2 = $_POST['email'];
        $price = $_POST['price'];
        $id = $_POST['id'];
        $name=$email2.time().".jpg";
        $newname="uploads/".$name;
       // echo $location;
        if (copy($location,$newname)) {
            $sql = "INSERT INTO `uploads`(`itemname`, `email`, `pic`, `price`) VALUES ('$itemname','$email2','$newname','$price')";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                $sql2 = "DELETE FROM `booked` WHERE id='$id'";
                $result2 = mysqli_query($conn, $sql2);
                unlink($location);
                header("Location:profile.php?Item was removed from cart");
                exit();
            } else {
                header("Location:profile.php?could not return item");
                exit();
            }
        } else {
            echo $newname;
            echo "<br>";
            echo $location;
            header("Location:index.php?Cart error");
            exit();
        }
    }
}
