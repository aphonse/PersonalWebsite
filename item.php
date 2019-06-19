<?php
session_start();
if ($_SESSION['user']) {
    $conn = mysqli_connect("localhost", "root", "", "alphonse");
    echo "<html>
<head>
    <title>Buy Item</title>
</head>
<body>
<a href=\"index.php\">Home</a><br><br>
</body>

</html>";

    if ($_POST['buy']) {
        $id = $_POST['id'];
        $name1 = $_SESSION['user'];
        //$itemowner=$_SESSION['user'];
        //$src=$_SESSION['src'];
        $sql = "SELECT * FROM uploads WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "error";
        } else {
            $array = mysqli_fetch_array($result);
            $src = $array['pic'];
            $itemowner = $array['email'];
            $price = $array['price'];
            $name = $array['itemname'];
            echo <<<A
        <nav style="font-size: 16px;font-family: Arial">
    <img src='$src' alt="image" width="300" height="400"><br>
    <br>
    <u style="font-size: 20px">Item's Details</u><br>
    Item name:$name
    <br>
    Uploaded by:$itemowner
    <br>
    Price:Kshs.$price
    <br>
    <form action="book.php" method="post">
    <input type="hidden" value='$id' name="id">
    <input type="hidden" value='$src' name="src">
    <input type="hidden" value="$name" name="itemname">
    <input type="hidden" value='$price' name="price">
    <input type="hidden" value="$itemowner" name="owner">
    <input type="submit" value="Buy" name="book">
</form>
</nav>
A;

        }
    } else {
        header("Location:index.php?error buying");
        exit();
    }
} else {
    header("Location:index.php?logging in to purchase");
    exit();
}


?>

