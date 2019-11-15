<?php

require('connect.php');
session_start();

    if($_POST && isset($_POST['submit']) && isset($_POST['Username']) && isset($_POST['Password']))
    {
        $query = "SELECT * FROM users WHERE Username = '$_POST[Username]' AND Password = '$_POST[Password]'";
        $statement = $db->prepare($query);
        $statement->execute();
        $Username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    	$Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($statement->RowCount() >= 1)
        {
            while($row = $statement->fetch()) 
            {

                $_SESSION['UserID'] =  $row['UserID'];
                $_SESSION['Username'] =  $row['Username'];
                $_SESSION['FirstName'] =  $row['FirstName'];
                $_SESSION['AccountType'] = $row['AccountType'];
            }
            header("refresh:.1; url=index.php");
        }
        else
        {
            echo '<script language ="javascript">';
            echo 'alert("Incorrect username or password")'; 
              echo '</script>';
        }
    }


?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="Index.css">
</head>
<body>

	<form method="post">
  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="Username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" required>
    <INPUT name='submit' id='submit' type='submit'>
    <button> <a href ="index.php">Back</a></button>
  </div>
</form>

</body>
</html>