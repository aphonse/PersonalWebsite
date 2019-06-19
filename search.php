<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 26-Feb-18
 * Time: 1:33 PM
 */
session_start();
$conn=mysqli_connect("localhost","root","","alphonse");

if (@$_POST['submit']) {
    $itemsearched = mysqli_real_escape_string($conn, $_POST['search']);

    $sql="SELECT * FROM uploads WHERE itemname='$itemsearched'";
    $result=mysqli_query($conn,$sql);
    if ($array=mysqli_fetch_array($result)){
        $_SESSION['searched']=$array['itemname'];
        header("Location:index.php?Search success");
        exit();
    }else{
        $_SESSION['searcherror']="<h4 style='color: red'>Could not find any items</h4>";
        header("Location:index.php?Found no items");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}