<?php
     require_once('inc/connection.php');
     
?>
<?php session_start();?>
<?php 
    if(isset($_POST['submit1'])){//check the submit button is pressed

        $errors= array(); //array of errors 
        if(!isset($_POST['studio_name']) || strlen(trim($_POST['studio_name']))<1){
            $errors[]='studio name is missing or invalid';
        }
        if(!isset($_POST['s_address_1']) || strlen(trim($_POST['s_address_1']))<1){
            $errors[]='studio address is missing or invalid';
        }
        if(!isset($_POST['distric']) || strlen(trim($_POST['distric']))<1){
            $errors[]='distric is missing or invalid';
        }
        if(!isset($_POST['postalcode']) || strlen(trim($_POST['postalcode']))<1){
            $errors[]='postalcode is missing or invalid';
        }
        if(!isset($_POST['s_email']) || strlen(trim($_POST['s_email']))<1){
            $errors[]='studio email is missing or invalid';
        }
        if(!isset($_POST['s_tele_no']) || strlen(trim($_POST['s_tele_no']))<1){
            $errors[]='studio telephone number is missing or invalid';
        }
        if(!isset($_POST['username']) || strlen(trim($_POST['username']))<1){
            $errors[]='username is missing or invalid';
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
    
        
        if(empty($errors)){ //if no errors 

            //store form data in variables 
            $studio_name = mysqli_real_escape_string($connection,$_POST['studio_name']);
            $s_address_line1 = mysqli_real_escape_string($connection,$_POST['s_address_1']);
            $s_address_line2 = mysqli_real_escape_string($connection,$_POST['s_address_2']);
            $s_city = mysqli_real_escape_string($connection,$_POST['s_city']);
            $distric = mysqli_real_escape_string($connection,$_POST['s_city']);
            $postalcode = mysqli_real_escape_string($connection,$_POST['postalcode']);
            $s_email = mysqli_real_escape_string($connection,$_POST['s_email']);
            $s_tele_no = mysqli_real_escape_string($connection,$_POST['s_tele_no']);
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $password = mysqli_real_escape_string($connection,$_POST['repeat_password']);
            $hashed_password = sha1($password);
            
            //query to check already registered users
            $query1 = "SELECT * FROM studio WHERE   password ='{$hashed_password}' AND username = '{$username}'";
            $result_set1 = mysqli_query($connection,$query1);

            if($result_set1){
                if(mysqli_num_rows($result_set1)>=1){
                    $errors[] = "The user is already registered";
                }
                else{
                    //store form data in the database (studio table)
                    $query2 = "INSERT INTO studio (studio_name,s_address_line1,s_address_line2,s_city,distric,postalcode,s_email,s_tele_no,username,password) 
                                VALUES ('{$studio_name}','{$s_address_line1}','{$s_address_line2}','{$s_city}','{$distric}','{$postalcode}','{$s_email}','{$s_tele_no}','{$username}','{$hashed_password}')";
                    $result_set2 = mysqli_query($connection,$query2);
                    

                    if($result_set2){
                        //query to take data to make session 
                        $query3 = "SELECT studio_id,studio_name FROM studio WHERE s_email ='{$s_email}' AND password ='{$hashed_password}'";
                        $result_set3 = mysqli_query($connection,$query3);
                         if($result_set3){
                                $record =mysqli_fetch_assoc($result_set3);
                                //make session 
                                $_SESSION['user_id']= $record['studio_id'];
                                $_SESSION['studio_name']=$record['studio_name'];
                                //go to next form page
                                header('Location: studio_reg2.php');
                          }
                         else{
                       
                            $errors[]="invalid username/password";  
                        }

                }
                else{
                    
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
    <title>Studio Regitration</title>
    <link rel="stylesheet" href="css/c_register.css">
    <style>
        div {
                background-image:linear-gradient(rgba(255,255,255,0.75),rgba(10,55,255,0.75)), url('img/backimage.jpg');  
        }
    </style>
</head>
<body>
<?php require_once('inc/header.php'); ?>
<div class="container register">
<form action="studio_reg.php" method="post">
   <h1>Studio Register Form</h1>
   <div class="imgcontainer">
            <img src="img/regimage.png" alt="Avatar" class="avatar">
    </div>
    <hr>
    <label for="studio_name"><b>Studio Name</b></label>
    <input type="text" placeholder="Enter Studio Name " name="studio_name"  >

    <label for="Address"><b>Local Address</b></label>
    <input type="text" placeholder="Address line 1" name="s_address_1"  >

    <input type="text" placeholder="Address line 2" name="s_address_2"  >

    <input type="text" placeholder="City" name="s_city"  >

    <label for="distric"><b>Distric</b></label>
    <input type="text" placeholder="Distric" name="distric"  >

    <label for="city"><b>Postal Code</b></label>
    <input type="text" placeholder="Postal Code" name="postalcode"  >

    <label for="email"><b>Studio Email</b></label>
    <input type="text" placeholder="Enter Email" name="s_email"  >

    <label for="tele_no"><b>Telephone Number</b></label>
    <input type="text" placeholder="Enter Telephone Number" name="s_tele_no"  >

    <hr>
    <label for="username"><b>User Name</b></label>
    <input type="text" placeholder="Enter User Name " name="username"  >

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password"  >

    <label for="psw-repeat"><b>Confirm Password</b></label>
    <input type="password" placeholder="Enter Password Again" name="repeat_password"  >
    
    <hr>
    <?php
    //echo errors
    if(isset($errors) && !empty($errors)){
                echo '<div class="errormsg ">';
                foreach($errors as $error){
                    echo $error . '<br>';
                }
                echo '</div>';
    
    
            }
    ?>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="nextbutton" name="submit1"  >Next</button>
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    
</form>
</div>
</body>
</html>

<?php
     require_once('inc/connection_close.php'); 
?>