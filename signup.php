<?php
require 'config/constants.php';
//get back form data if there was a registration error
$firstname=$_SESSION['signup-data']['firstname'] ?? null;
$lastname=$_SESSION['signup-data']['lastname'] ?? null;
$username=$_SESSION['signup-data']['username'] ?? null;
$email=$_SESSION['signup-data']['email'] ?? null;
$createpassword=$_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword=$_SESSION['signup-data']['confirmpassword'] ?? null;
unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv= "x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Complete Responsive Multipage Blog Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release-pro/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Sign Up</h2>
        <?php if(isset($_SESSION['signup'])): ?>
        <div class="alert_message error">
            <p>
                <?=$_SESSION['signup'];
                unset($_SESSION['signup']);
                ?>
            </p>
        </div>
        <?php endif?>
        <form action="<?=ROOT_URL ?>signup-logic.php"enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?=$firstname?>" placeholder="First Name">
            <input type="text"name="lastname"value="<?=$lastname?>"placeholder="Last Name">
            <input type="text"name="username"value="<?=$username?>" placeholder="Username">
            <input type="email"name="email"value="<?=$email?>" placeholder="Email">
            <input type="password"name="createpassword"value="<?=$createpassword?>"placeholder="Create Password">
            <input type="password"name="confirmpassword"value="<?=$confirmpassword?>" placeholder="Confirm Password">
            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file"name="avatar" id="avatar">
            </div>
             <button type="submit" name="submit" class="btn">Sign Up</button>
             <small>Already have an account?<a href="signin.php">Sign In</a></small>


            
        </form>
    </div>
</section>
</body>
</html>