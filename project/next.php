<?php require_once('inc/connection.php');?>
<?php session_start();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css" class="">
</head>
<body>
<header >

    <div class="loggedin"> Welcome <?php echo $_SESSION['username']?><a href="logout.php" >Log out</a></div>
 </header>
    
</body>
</html>
<?php  require_once('inc/connection_close.php')?>