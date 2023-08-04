
<?php

require 'config/database.php';
//get signup from data if signup button was clicked
if(isset($_POST['submit'])){
    $firstname=filter_var($_POST['firstname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname=filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username=filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    $createpassword=filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword=filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar=$_FILES['avatar'];
  if(!$firstname){
    $_SESSION['signup']="Please enter your First Name";
  }
  elseif(!$lastname){
    $_SESSION['signup']="Please enter your Last Name";
  }
  elseif(!$username){
    $_SESSION['signup']="Please enter your Username";
  }
  elseif(!$email){
    $_SESSION['signup']="Please enter your a valid email";
  }
elseif(strlen($createpassword)<8||strlen($confirmpassword)<8){
    $_SESSION['signup']="Password should be 8+ characters";
}
elseif(!$avatar['name'])
{
    $_SESSION['signup']="Please add avatar";
}
else{
    if($createpassword!==$confirmpassword)
    {
        $_SESSION['signup']="Password do not match ";
    }
    else{
        //hash password
        $hashed_password=password_hash($createpassword,PASSWORD_DEFAULT);
       //check if username or email already exist in database
       $user_check_query="SELECT * FROM users WHERE username='$username' OR email='$email' ";
       $user_check_result=mysqli_query($connection,$user_check_query);
      if(mysqli_num_rows($user_check_result)>0)
      {
        $_SESSION['signup']="Username or Email already exists";
      }
      else{
        $time=time();//make each image name unique using current timestamp
        $avatar_name=$time.$avatar['name'];
        $avatar_tmp_name=$avatar['tmp_name'];
        $avatar_destination_path='images/' . $avatar_name;
        //make sure file is image
        $allowed_files=['png','jpg','jpeg'];
        $extension=explode('.', $avatar_name);
        $extension=end($extension);
        if(in_array($extension,$allowed_files))
        { //make sure image is not too large(1mb+)
            if($avatar['size']<1000000)
            {
                //upload avatar
                move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
            }
            else{
                $_SESSION['signup']="File size too big";
            }

        }
        else{
         $_SESSION['signup']="File should be png,jpg,jpeg ";
        }
      }    
    }
}
//redirect signup page if there was any problem
if(isset($_SESSION['signup'])){
 //pass from data back to signup page
 $_SESSION['signup-data']=$_POST;//All invalid details back to signup page
 header('location: ' . ROOT_URL . 'signup.php');
 die();
}
else{
//insert new user into user table
$insert_user_query="INSERT INTO users SET firstname='$firstname',lastname='$lastname',username='$username',
email='$email',password='$hashed_password',avatar='$avatar_name',is_admin=0";
$insert_user_result=mysqli_query($connection,$insert_user_query);
}
if(!mysqli_errno($connection)){
    //redirect to login page with success message
    $_SESSION['signup-success']="Registration successful.Please Log in";
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}

}
else{
    //if button was not clicked bounce back to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}