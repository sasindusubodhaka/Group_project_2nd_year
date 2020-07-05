<?php
     require_once('inc/connection.php');
     
?>
<?php session_start();?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign UP</title>
     <?php require_once('inc/header.php'); ?>
     <link rel="stylesheet" href="css/sign_up.css">
    <style>
         .column {
          float: left;
          width: 50%;
          padding : 80px;
          height: 300px; /* Should be removed. Only for demonstration */
          }

          /* Clear floats after the columns */
          .row :after {
          padding right:20px;
          content: "";
          display: table;
          clear: both;
}
    </style>
    
</head>
<body>
                    <div class="row">
                    <div class="column" >
                    <ul>
                    <p><a class="studio" href="studio_reg.php">Register my studio</a></p>
                    <h5>You will have a best profit</h5>
                    </div>
                    <div class="column" >
                    <ul>
                    <p><a class="customer" href="cust_reg.php">Looking for a studio</a></p>
                    <h5>You will have the Best Studio</h5>
                    </div>
                    </div>      
    


</body>
</html>

<?php
     require_once('inc/connection_close.php'); 
?>