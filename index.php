<?php
session_start();

?>

<html>
<head>
    <title>Alphonse Website</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <?php
    if (isset($_SESSION['user'])) {
        $name = $_SESSION['name'];
        echo "<u style='font-size: xx-large'>Welcome $name </u>";
        echo <<<A
            <nav style="float: right;font-size: 20px;font-family: Arial">
            <a style="float: left" href="profile.php"><button>My Profile</button></a>
            <a style="float: left" href="uploadfile.php"><button>Upload Files</button></a>
            <form style="float: right" method="post" action="logout.php">
            <input type="submit" value="Logout" name="logout">
            </form>
            </nav>
                        
A;


    } else {
        echo <<<A
            <table border="1" style="float: right;background-color: white">
            <tr><td height="100">
                 <nav>
        <div class="wrapper">
        <div class="login">
            <form action="login.php" method="post">
                <input type="text" size="35" placeholder="Email or Username" name="name" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="submit" name="submit" value="Login">
            </form>
           <a href="register.php"><button>Create account</button></a>
        </div>
        </div>
        </nav></td>
        </tr>
        </table>
<table>
<tr>
<td style="font-size: 80px">Homepage</td>
</tr>
</table><br>
<table border="0">
<tr>
<td height="80" style="font-size: 30px" bgcolor="#ffcb69"><i>Welcome to my Aphonse' Website for full experience please login, new members can create an account and start shopping
now</i> </td>
</tr>
</table><br>
A;

    }
    ?>


</header>
<section>
    <nav>
        <p style="font-size: 20px; float: left">Looking for an item to purchase? Find it below and book it</p>
        <label style="float: right">Search for the item
            <form action="search.php" method="post">
                <input type="search" name="search">
                <input type="submit" value="Search" name="submit">
            </form>
        </label>
    </nav>
    <br><br><br><br>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "alphonse");
    $sql = "SELECT * FROM uploads";
    $result = mysqli_query($conn, $sql);
    if (!@$_SESSION['searched']) {
        @$error = $_SESSION['searcherror'];
        echo $error;
        unset($_SESSION['searcherror']);

    } else {
        $searcheditem = $_SESSION['searched'];
        $sql2 = "SELECT * FROM uploads WHERE itemname='$searcheditem'";
        $result2 = mysqli_query($conn, $sql2);
        $numrows = mysqli_affected_rows($conn);
        echo "<h3>Found the $numrows items</h3><br>";
        while ($rows = mysqli_fetch_array($result2)) {
            @$src2 = $rows['pic'];
            @$email2 = $rows['email'];
            echo "
<table style='float: left;background-color: #ffe794' border='2'>
   
    <tr>
        
    </tr>
    <tr>
        <td>
            <br>
            <a href=$src2><img src=$src2 alt=\"Upload\" width=\"360\" height=\"400\"></a><br>
            <form action=\"item.php\" method=\"post\" enctype=\"multipart/form-data\">
                <input type=\"submit\" name=\"buy\" value=\"Purchase Item\">
            </form>
        </td>
    </tr>
</table>";
        }

        echo "<br><br>";
        session_unset($_SESSION['searched']);

        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
    echo "<h2>All items</h2>";

    while ($array = mysqli_fetch_array($result)) {
        $src = $array['pic'];
        $email = $array['email'];
        $id = $array['id'];
        $_SESSION['itemowner'] = $email;
        $_SESSION['src'] = $src;

            echo "<table style='float: left;background-color: #ffe794' border='2'>
         <tr>
            <td>
                <br>
                <a href='$src'><img src='$src' alt=\"Upload\" width=\"360\" height=\"400\"></a><br>
                <nav style=\"float:\">
<form action=\"item.php\" method=\"post\" enctype=\"multipart/form-data\">
    <input type='hidden' value=$id name='id'>
    <input type=\"submit\" name=\"buy\" value=\"Purchase Item\">
</form>
            </td>
        </tr>
    </table>";
            echo "";
            // mysqli_free_result($result);


    }

    ?>
</section>

</body>
</html>
