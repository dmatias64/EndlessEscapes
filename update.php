<?php

require ('admin.php');
require('connect.php');
session_start();
$query = "SELECT * FROM male WHERE AccountID = '$_GET[AccountID]'";
$statement = $db->prepare($query);
$statement->execute();  



if(isset($_POST['update']))
{
	$description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$contactInfo = filter_input(INPUT_POST, 'ContactInfo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$userID = filter_input(INPUT_POST, 'UserID', FILTER_SANITIZE_NUMBER_INT);

	if((strlen($description) > 0) && (strlen($contactInfo) > 0))
	{

		$query = "UPDATE male SET Description = '$_POST[Description]', ContactInfo = '$_POST[ContactInfo]'
 	WHERE AccountID = '$_GET[AccountID]'";  

		$statement = $db->prepare($query);
		$statement->bindValue(':Description', $description);
		$statement->bindValue(':ContactInfo', $contactInfo);
		$statement->bindValue(':UserID', $userID, PDO::PARAM_INT);
		$statement->execute();

		header("Location:index.php");
	}
}

if(isset($_POST['delete']))
{
	$description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$contactInfo = filter_input(INPUT_POST, 'ContactInfo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "DELETE FROM male WHERE AccountID = '$_GET[AccountID]'";  
	$statement = $db->prepare($query);
	$statement->bindValue(':Description', $description);
	$statement->bindValue(':ContactInfo', $contactInfo);
	$statement->execute();
	header("Location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php while($row = $statement->fetch()): ?>
	<title>Edit Proile</title>
	<title><?= $row['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="Index.css">
</head>
<body>
	<div id="headertext">
        <h1>Update Information</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>  
    </div>
	<div>
		<form method="post">
			<h2>Description</h2>        
			<textarea name='Description' COLS='90' ROWS='10'><?= $row['Description']?></textarea>
			<h2>Contact Information</h2> 
			<textarea name='ContactInfo' COLS='90' ROWS='10'><?= $row['ContactInfo']?></textarea>
			<INPUT id='update' type='submit' name='update' value='update' onclick = "return confirm('Are you sure you want to apply the updates to your post?')">
			<INPUT id='update' name='delete' type='submit' value='delete' onclick = "return confirm('Are you sure you want to delete your post?')">
		</form>
	<?php endwhile ?>
	</div>
</body>
</html>