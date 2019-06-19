<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 27-Feb-18
 * Time: 10:57 PM
 */
session_start();
if (@$_SESSION['user']) {
    $conn = mysqli_connect("localhost", "root", "", "alphonse");

}else{
    header("Location:index.php?Login to edit profile");
    exit();
}