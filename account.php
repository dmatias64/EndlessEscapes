<?php

require('connect.php');


if($_POST && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Email']) && isset($_POST['FirstName'])  && isset($_POST['LastName']) && isset($_POST['Password2']))
{
$FirstName = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$LastName = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$Username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$Email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
$Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$Password2 = filter_input(INPUT_POST, 'Password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$AccountType = filter_input(INPUT_POST, 'AccountType', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if((strlen($Username) > 0) && (strlen($Password == $Password2) > 0) && (strlen($FirstName) > 0) && (strlen($LastName) > 0) && (strlen($Email) > 0))
{

$query = "INSERT INTO users (Username, Password, Email, FirstName, LastName, AccountType) VALUES (:Username,:Password, :Email, :FirstName,:LastName, :AccountType)";

$statement = $db->prepare($query);

$statement->bindValue(':Username', $Username);
$statement->bindValue(':Password', $Password);
$statement->bindValue(':Email', $Password);
$statement->bindValue(':FirstName', $FirstName);
$statement->bindValue(':LastName', $LastName);
$statement->bindValue(':AccountType', $AccountType);

$statement->execute();
header("refresh:.5; url=index.php");
echo '<script language ="javascript">';
echo 'alert("You are now registered")';
echo '</script>';
}
else
{
echo '<script language ="javascript">';
echo 'alert("Error in registration")';
echo '</script>';
}


}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Now</title>

</head>
<body>

	<form method="post">
  <div class="container">
    <h1>Register to Endless Escapes</h1>
    <hr>

    <label><b>First Name:</b></label>
    <input placeholder= 'first name' id='FirstName' name='FirstName' required>

    <label"><b>Last Name</b></label>
    <input placeholder="Last Name" name='LastName' id='LastName' required>

    <label><b>Username</b></label>
    <input placeholder="Username" name="Username" id="Username" required>

     <label><b>Email</b></label>
    <input type="Email" placeholder="Email" name="Email" id="Email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" id="Password" required>

    <label><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="Password2" id="Password2" required>

    <input type ='hidden' value='Customer' id ='AccountType' name='AccountType'>
    <hr>
    <input id='submit' type='submit'>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>