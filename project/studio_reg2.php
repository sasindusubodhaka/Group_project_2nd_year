<?php
     require_once('inc/connection.php');
     
?>
<?php session_start();?>


 <?php

    if(isset($_POST['submit2'])){//check the submit button is pressed
        $errors= array(); //make an array of errors 
        
        //check form validation
        if(!isset($_POST['first_name']) || strlen(trim($_POST['first_name']))<1){
            $errors[]='firstname is missing or invalid';
        }
        if(!isset($_POST['last_name']) || strlen(trim($_POST['last_name']))<1){
            $errors[]='lastname is missing or invalid';
        }
        if(!isset($_POST['h_email']) || strlen(trim($_POST['h_email']))<1){
            $errors[]='owner email is missing or invalid';
        }
        if(!isset($_POST['h_tele_no']) || strlen(trim($_POST['h_tele_no']))<1){
            $errors[]='owner telephone number is missing or invalid';
        }

        if(empty($errors)){//if no errors 

            //store form data in variables           
            $first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
            $h_address_line1 = mysqli_real_escape_string($connection,$_POST['h_address_1']);
            $h_address_line2 = mysqli_real_escape_string($connection,$_POST['h_address_2']);
            $h_city = mysqli_real_escape_string($connection,$_POST['h_city']);
            $h_email= mysqli_real_escape_string($connection,$_POST['h_email']);
            $h_tele_no= mysqli_real_escape_string($connection,$_POST['h_tele_no']);
            
        //query to take the studio_id   
        $query1 = "SELECT * FROM studio WHERE studio_id = '{$_SESSION['user_id']}'";
        $result_set1 = mysqli_query($connection,$query1);

            
            if($result_set1){
                if(mysqli_num_rows($result_set1)>1){
                    $errors[] = "The user is already registered";
                }
                else{
                    //query to store form data in relevent row in database(studio table)
                    $query2 = "UPDATE studio SET first_name='{$first_name}',last_name='{$last_name}',h_address_line1='{$h_address_line1}',h_address_line2='{$h_address_line2}',h_city='{$h_city}',h_email='{$h_email}',h_tele_no='{$h_tele_no}'
                     WHERE studio_id = '{$_SESSION['user_id']}'";
                    
                    $result_set2 = mysqli_query($connection,$query2);
                   

                    if($result_set2){
                        //go to next page 
                         header('Location: studionext.php');
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

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Owner Regitration</title>
    <link rel="stylesheet" href="css/c_register.css">
    <style>
        div {
                background-image:linear-gradient(rgba(255,255,255,0.75),rgba(255,10,255,0.75)), url('img/backimage.jpg');  
        }
    </style>
</head>
<body>
<?php require_once('inc/header.php'); ?>
<div class="container register">
<form action="studio_reg2.php" method="post">
   <h1>Owner Details</h1>
   <div class="imgcontainer">
            <img src="img/regimage.png" alt="Avatar" class="avatar">
    </div>
    <hr>

    <label for="first_name"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name " name="first_name"  >

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="last_name"  >

    <label for="h_address"><b>Home Address</b></label>
    <input type="text" placeholder="Address line 1" name="h_address_1"  >

    <input type="text" placeholder="Address line 2" name="h_address_2"  >

    <input type="text" placeholder="City" name="h_city"  >

    <label for="h_email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="h_email"  >

    <label for="h_tele_no"><b>Telephone Number</b></label>
    <input type="text" placeholder="Enter Telephone Number" name="h_tele_no"  >



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
        else{
            echo "";
        } 
    ?>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn" name="submit2"  >Register</button>
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    
</form>
</div>
</body>
</html>
<?php
     require_once('inc/connection_close.php'); 
?>