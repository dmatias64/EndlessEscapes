<?php

  require ('admin.php');
  require('connect.php');

  session_start();

  if(isset($_POST['Description']) && isset($_POST['ContactInfo'])) 
  {
    $description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contactInfo = filter_input(INPUT_POST, 'ContactInfo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $users = $_SESSION['UserID'];
    $name = $_SESSION['FirstName'];

    if((strlen($description) > 0) && (strlen($contactInfo) > 0))
    { 

      $query = "INSERT INTO male (UserID, Name, Description, ContactInfo) VALUES (:UserID, :Name, :Description, :ContactInfo)";
      $statement = $db->prepare($query);
      $statement->bindValue(':Description', $description);
      $statement->bindValue(':ContactInfo', $contactInfo);
      $statement->bindValue(':UserID', $users);
      $statement->bindValue(':Name', $name);
      $statement->execute();
      
      header("Location:index.php");      
    }
    else
    {
        header("processing.php");
    }
  }           

  //FILE UPLOAD CODE

?>

<!DOCTYPE html>
<html>
<head>
  <title>New Post</title>
  <link rel="stylesheet" type="text/css" href="Index.css">
</head>
<body>
  <div id="headertext">
    <h1>Post Your Profile</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
      </ul>
    </nav>
  </div>
  <div>
    <form method="post" action="insert.php">
      <h2>Description</h2>  
      <textarea name='Description' COLS='90' ROWS='10'></textarea>
      <h2>Contact Info</h2>  
      <textarea name='ContactInfo' COLS='90' ROWS='10'></textarea>
      <form method="post" enctype="multipart/form-data">
      <INPUT id='submit' type='submit'>
    </form>

    <form method="post">
Select image :
<input type="file" name="file"><br/>
<input type="submit" value="Upload" name="Submit1"> <br/> 
</form>
  </div>
</body>
</html>