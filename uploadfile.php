<?php
session_start();
$_SESSION['user2']="upload";
if (isset($_SESSION['user'])) {
    ?>

    <html>
    <head>
        <title>Upload Images</title>
        <style type="text/css">
            body {
                background-color: lightblue;
            }

            form {

            }
        </style>
    </head>
    <body>
    <nav>
        <a href="index.php" style="background-color: wheat;font-size: 18px;font-family: Arial">Back to Homepage</a>
    </nav>
    <h4 align="center">Fill in the details of the item you want to sell</h4>
    <nav>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <table border="0" align="center" style="background-color: white" width="500">
                <tr>
                    <td>Name of Item</td>
                    <td><input type="text" name="name" size="20" required></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" required>Kshs</td>
                </tr>
                <tr>
                    <td colspan="2"><input type="file" required name="file"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Upload" name="upload"></td>
                </tr>
            </table>
        </form>
    </nav>
    </body>
    </html>
    <?php
}
else {header("Location:index.php?upload error");}
    ?>