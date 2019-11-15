<?php

    require('connect.php');
    $query = "SELECT * FROM male";
    $statement = $db->prepare($query);
    $statement->execute();
    session_start();
    
  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Endless Escapes</title>
    <script src="Index.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="Index.css">
</head>
<body>
    <div id="headertext">
        <h1>Endless Escapes</h1>
    </div>
    <h3><a href="login.php">Login</a></h3>
      <?php if(isset($_SESSION['UserID'])): ?>
        <h2>Hello, <?= $_SESSION['Username'] ?>! </h2>
                <h3><a href="logout.php">Logout</a></h3>
                <h3><a href="insert.php">Post Your Profile</a></h3>
                <h1>People near you</h1>
                <?php while($row = $statement->fetch()): ?>
                    <div>
                        <h3>Photo</h3>  
                        <img><?= substr($row ['Image'],0,500) ?></img>
                        <h3>Name</h3>
                        <p><?= substr($row ['Name'],0,500) ?></p>
                        <h3>Description</h3>
                        <p><?= substr($row ['Description'],0,1000) ?></p>
                        <h3>How to contact me</h3>
                        <p><?= substr($row ['ContactInfo'],0,200) ?></p>                    
                    <?php if($_SESSION['UserID'] == $row['UserID']): ?>
                        <a href="update.php?AccountID=<?=$row['AccountID']?>">Edit</a>
                    <?php endif ?>  
                    </div>
                <?php endwhile ?>
            <?php if($row = $statement->fetch()): ?>
                <?php endif ?>
            <?php else: ?>
                <h3><a href="account.php">Register</a></h3>
            <?php endif ?>
</body>
</html>