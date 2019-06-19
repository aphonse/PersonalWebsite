<?php
session_start();
if (@$_SESSION['user']) {
    $conn = mysqli_connect("localhost", "root", "", "alphonse");
    echo <<<A
<html>
<head>
    <title>My Profile</title>
</head>
<body>
<nav style="font-size: 28px;font-family: 'Times New Roman';text-align: center">
    <a href="index.php">Homepage</a> |
    <a href="">Logout</a>
</nav>
<h3 align="center" style="text-decoration: underline"><i style="font-size: 23px">E</i><i>dit your profile,manage your uploaded files and view booked items</i></h3>
<nav>
    <h3>Change your username and password</h3>
<form action="changedetails.php" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pword" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Change" name="change"></td>
        </tr>
    </table>
</form>
</nav>

</body>
</html>
A;

    ?>

    <?php
    $email = $_SESSION['user'];
    $sql = "SELECT * FROM booked WHERE bookedBy='$email'";
    $result = mysqli_query($conn, $sql);
    echo "<h3>Items in cart</h3>";
    while ($rows = mysqli_fetch_array($result)) {
        $src = $rows['pic'];
        $location = "booked/$src";
        $itemname = $rows['itemname'];
        $email2 = $rows['email'];
        $price = $rows['price'];
        $id = $rows['id'];

        echo <<<A
<table style='float: left;background-color: #ffe794' border='2'>
    <tr>
        <td>
            <br>
            <a href='$location'><img src='$location' alt="Upload" width="360" height="400"></a><br>
                <form action="remove.php" method="post" enctype="multipart/form-data">
                    <input type='hidden' value="$itemname" name='itemname'>
                    <input type='hidden' value="$location" name='location'>
                    <input type='hidden' value="$email2" name='email'>
                    <input type='hidden' value="$id" name='id'>
                    <input type='hidden' value="$price" name='price'>
                    <input type="submit" name="remove" value="Remove from Cart">
                </form>
        </td>
    </tr>
</table>
A;

    }
}else{
    header("Location:index.php?Login to view profile");
    exit();
}