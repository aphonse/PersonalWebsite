<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 * Date: 22-Feb-18
 * Time: 10:52 PM
 */
session_start();
if ($_POST['logout']){
    session_destroy();
    header("Location:index.php");
    exit();
}else{
    header("Location:index.php");
    exit();
}
