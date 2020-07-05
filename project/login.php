<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?> 
<?php
    if(isset($_POST['submit'])){//check the submit button is pressed
        $errors= array();
        if(!isset($_POST['username']) || strlen(trim($_POST['username']))<1){
            $errors[]='username is missing or invalid';
        }
        if(!isset($_POST['password']) || strlen(trim($_POST['password']))<1){
            $errors[]="password is missing or invlid";
        }
        if(empty($errors)){
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);
            $hashed_password = sha1($password);

            $query1 = "SELECT * FROM customer WHERE username = '{$username}' AND password ='{$hashed_password}'";
            $result_set1 = mysqli_query($connection,$query1);
            if($result_set1){
                    if(mysqli_num_rows($result_set1)==1){
                        $record =mysqli_fetch_assoc($result_set1);
                        $_SESSION['user_id']= $record['c_id'];
                        $_SESSION['username']=$record['username'];
                        echo $_SESSION['user_id'];
                        header('Location: customernext.php');
                    }
                    else{
                        
                        $errors[]="invalid username/password";  
                    }
            }
            $query2 = "SELECT * FROM studio WHERE username = '{$username}' AND password ='{$hashed_password}'";
            $result_set2 = mysqli_query($connection,$query2);
            if($result_set2){
                if(mysqli_num_rows($result_set2)==1){
                    $record =mysqli_fetch_assoc($result_set2);
                    $_SESSION['user_id']= $record['studio_id'];
                    $_SESSION['username']=$record['username'];
                    header('Location: studionext.php');
                }
                else{
                    
                    $errors[]="invalid username/password";  
                }

            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        div {
                background-image:linear-gradient(rgba(255,255,255,0.75),rgba(10,25,255,0.75)),url('img/backimage.jpg');  
        }
    </style>
</head>
<body>
<?php require_once('inc/header.php'); ?>
<div class="container">
        <h2>Login</h2>

        <form action="login.php" method="post">
        <div class="imgcontainer">
            <img src="img/loginimage.png" alt="Avatar" class="avatar">
        </div>

        
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <?php 
                if(isset($errors) && !empty($errors)){
                    echo '<div class="errormsg ">';
                    foreach($errors as $error){
                        echo $error . '<br>';
                    }
                    echo '</div>';


                }
                else{
                    echo "";
                } 
             ?>
                
            <button type="submit" name="submit" >Login</button>
            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
       

       
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        
        </form>
    </div>
</body>
</html>
<?php require_once('inc/connection_close.php') ?>