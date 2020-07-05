<?php
     require_once('inc/connection.php');
     
?>
<?php session_start();?>

 <?php
    if(isset($_POST['submit'])){//check the submit button is pressed
        
        $errors= array();////array of errors 
        //check form validation
        if(!isset($_POST['username']) || strlen(trim($_POST['username']))<1){
            $errors[]='username is missing or invalid';
        }
        if(!isset($_POST['first_name']) || strlen(trim($_POST['first_name']))<1){
            $errors[]='firstname is missing or invalid';
        }
        if(!isset($_POST['last_name']) || strlen(trim($_POST['last_name']))<1){
            $errors[]='lastname is missing or invalid';
        }
        if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
            $errors[]='email is missing or invalid';
        }
        if(!isset($_POST['tele_no']) || strlen(trim($_POST['tele_no']))<1){
            $errors[]='telephone number is missing or invalid';
        }
        if(!isset($_POST['password']) || strlen(trim($_POST['password']))<1){
            $errors[]="password is missing or invlid";
        }
        if(!isset($_POST['repeat_password']) || strlen(trim($_POST['repeat_password']))<1){
            $errors[]='repeat password is missing or invalid';
        }
        else{
            //check password and repeat password is equel 
            if($_POST['repeat_password']!=$_POST['password']){
                $errors[]='Password is incorrect!!';
            }

        }

        if(empty($errors)){//if no errors 
            
            //store form data in variables
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
            $email= mysqli_real_escape_string($connection,$_POST['email']);
            $tele_no= mysqli_real_escape_string($connection,$_POST['tele_no']);
            $password = mysqli_real_escape_string($connection,$_POST['repeat_password']);
            $hashed_password = sha1($password);

            //query to check already registered users
            $query1 = "SELECT * FROM customer WHERE email = '{$email}' AND password ='{$password}' AND username = '{$username}'";
            $result_set1 = mysqli_query($connection,$query1);

            if($result_set1){
                
                if(mysqli_num_rows($result_set1)>=1){
                    $errors[] = "The user is already registered";
                }
                else{
                    //store form data in the database (scustomer table)
                    $query2 = "INSERT INTO customer (username,first_name,last_name,email,tele_no,password) VALUES ('{$username}','{$first_name}','{$last_name}','{$email}','{$tele_no}','{$hashed_password}')";
                    $result_set2 = mysqli_query($connection,$query2);

                    if($result_set2){
                        //query to take data to make session
                        $query3 = "SELECT c_id,username FROM customer WHERE email ='{$email}' AND password ='{$hashed_password}'";
                        $result_set3 = mysqli_query($connection,$query3);
                         if($result_set3){
                                $record =mysqli_fetch_assoc($result_set3);
                                //make session 
                                $_SESSION['user_id']= $record['c_id'];
                                $_SESSION['username']=$record['username'];

                                //go to next form page
                                header('Location: customernext.php');
                          }
                         else{
                       
                            $errors[]="invalid username/password";  
                        }

                }

                }
            }
            else{
                
                $errors[] ='query error';
            }
        }

    }


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Regitration</title>
    <link rel="stylesheet" href="css/c_register.css">
    <style>
        div {
                background-image:linear-gradient(rgba(255,255,255,0.75),rgba(15,25,255,0.75)),url('img/backimage.jpg');  
        }
    </style>
</head>
<body>

<?php require_once('inc/header.php'); ?>

<div class="container register">
<form action="cust_reg.php" method="post">
   <h1>Customer Register Form</h1>
   <div class="imgcontainer">
            <img src="img/regimage.png" alt="Avatar" class="avatar">
    </div>
    <hr>
    <label for="username"><b>User Name</b></label>
    <input type="text" placeholder="Enter User Name " name="username"  >

    <label for="first_name"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name " name="first_name"  >

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="last_name"  >

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email"  >

    <label for="tele_no"><b>Telephone Number</b></label>
    <input type="text" placeholder="Enter Telephone Number" name="tele_no"  >

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password"  >

    <label for="psw-repeat"><b>Confirm Password</b></label>
    <input type="password" placeholder="Enter Password Again" name="repeat_password"  >
    <hr>
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

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn" name="submit"  >Register</button>
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    
</form>
</div>
</body>
</html>
<?php
     require_once('inc/connection_close.php'); 
?>