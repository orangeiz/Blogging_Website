<?php
require 'config/database.php';
if(isset($_POST['submit'])){
    //get form data
    $title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description=filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$title){
        $_SESSION['add-category']="Enter Title";
    }
    elseif(!$description){
        $_SESSION['add-category']="Enter Description";
    }
    //redirect to add category page with form data if any error 
    if(isset($_SESSION['add-category'])){
        $_SESSION['add-category-data']=$_POST;
      header('location: '.ROOT_URL . 'admin/add-category.php' );
      die();
    }
    else{
        //insert category in database 
        $query="INSERT INTO categories (title, description) VALUES ('$title','$description')";
        $result=mysqli_query($connection,$query);
        if(mysqli_errno($connection)){
            $_SESSION['add-category']="Couldnt add category";
            header('location: '.ROOT_URL . 'admin/add-category.php' );
            die();
        }
        else{
            $_SESSION['add-category-success']="Category $title added successfully";
            header('location: '.ROOT_URL . 'admin/manage-categories.php' );
            die();
        }

    }
}
    