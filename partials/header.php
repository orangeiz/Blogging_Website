
<?php
require 'config/database.php';
//fetch current user from database
if(isset($_SESSION['user-id'])){
  $id=filter_var($_SESSION['user-id'],FILTER_SANITIZE_NUMBER_INT);
  $query="SELECT avatar FROM users WHERE id=$id";
  $result=mysqli_query($connection,$query);
  $avatar=mysqli_fetch_assoc($result);
}
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
    <link rel="stylesheet" href="<?=ROOT_URL ?>css/style.css">
    </head>
    <body>
    <div id="root">
    <nav>
      <div class=" container nav__container">
        <a href="<?=ROOT_URL ?>" class="nav__logo">Orange</a>
        <ul class="nav_items">
         <li><a href="<?=ROOT_URL ?>blog.php">Blog</a></li>
         <li><a href="<?=ROOT_URL ?>about.php">About</a></li>
         <li><a href="<?=ROOT_URL ?>services.php">Services</a></li>
         <li><a href="<?=ROOT_URL ?>contact.php">Contact</a></li>
         <?php if(isset($_SESSION['user-id'])) : ?>
         <li class="nav_profile">
            <div class="avatar">
            <img src="<?=ROOT_URL . 'images/' . $avatar['avatar'] ?>">
            </div>

              <ul>
              <li><a href="<?=ROOT_URL ?>admin/index.php">Dashboard</a></li>
                <li><a href="<?=ROOT_URL ?>logout.php">Logout</a></li>
               </ul>
               </li>
          <?php else : ?>
          
         <li><a href="<?=ROOT_URL ?>signin.php">Signin</a></li>
         <?php endif ?>
        </ul>
        <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
        <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>

      </div>
    </nav>