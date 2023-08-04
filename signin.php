<?php
require 'config/constants.php';
$username_email=$_SESSION['signin-data']['username_email'] ?? null;
$password=$_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
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
        <h2>Sign In</h2>
        <?php if(isset($_SESSION['signup-success'])):?>
        <div class="alert_message success">
            <p>
                <?=$_SESSION['signup-success'];
                unset($_SESSION['signup-success'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['signin'])):?>
        <div class="alert_message error">
            <p>
                <?=$_SESSION['signin'];
                unset($_SESSION['signin'])?>
            </p>
        </div>
        <?php endif?>
        
      
        <form action="<?=ROOT_URL?>signin-logic.php" method="POST" >
            <input type="text" name="username_email" value="<?=$username_email?>" placeholder="Username or Email">
            <input type="password" name ="password" value="<?=$password?>"  placeholder="Password">
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Dont have an account?<a href="signup.php">Sign Up</a></small>


            
        </form>
    </div>
</section>
</body>
</html>