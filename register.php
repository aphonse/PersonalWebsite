<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="styleSignup.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a> |
    <a href="index.php">Login</a>
</nav>
<br>
<br>
<form action="signup.php" method="post">
    <table align="center" border="0" style="font-size: 30px">
           <tr align="center">
               <td height="50" colspan="2" align="center" style="font-size: 40px;color: blue;">
                   <u>Please fill out the details</u> </td>
           </tr>
        <tr>
            <td height="50">User Name</td>
            <td width="400"><input style="font-size: 20px" type="text" name="name" size="40" autofocus required height=""></td>
        </tr>
        <tr>
            <td height="50">Email Address</td>
            <td><input type="email" name="email" style="font-size: 20px" size="40" required></td>
        </tr>
        <tr>
            <td height="50">Password</td>
            <td><input type="password" name="pword" style="font-size: 20px" size="40" required></td>
        </tr>
        <tr>
            <td height="50">Confirm Password</td>
            <td><input type="password" name="pwordconf" style="font-size: 20px" size="40" required></td>
        </tr>
        <tr>
            <td height="50" colspan="2"><input style="font-size: 20px" type="submit" name="submit" value="Register"></td>
        </tr>
    </table>
</form>
</body>
</html>