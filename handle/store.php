<?php
require_once '../inc/conn.php';

if(isset($_POST['submit'])){

    extract($_POST);

    $title = trim(htmlspecialchars($title));
    $body = trim(htmlspecialchars($body));

    $errors = [];

    if(empty($title)){
        $errors[] = "title is required";
    }

    if(empty($body)){
        $errors[] = "body is required";
    }

    $image = $_FILES['image'];

    $image_name = $image['name'];
    $temp_name = $image['tmp_name'];
    $image_error = $image['error'];

    $size = $image['size'] / (1024 * 1024);

    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    $ext = ['png', 'jpeg', 'jpg'];

    if($image_error != 0){
        $errors[] = "image not correct";
    }elseif($size > 1){
        $errors[] = "image must be less than 1 mb";
    }elseif(!in_array($image_ext, $ext)){
        $errors[] = "image type must be png, jpeg, jpg";
    }

    $new_name = uniqid() . ".$image_ext";

    if(empty($errors)){

        $query="insert into posts (`title`,`body`,`image`,`user_id`) value('$title','$body','$new_name',1)";
        $result=mysqli_query($conn,$query);
        if($result){

        move_uploaded_file($temp_name,"../uploads/$new_name");

         $_SESSION["success"] = "post  added success ";
         header("Location: ../index.php");

        }else{

        $_SESSION["errors"] = ["error while ad post "];
        header("Location: ../addpost.php");
        exit();

        }
    }else{
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        

        $_SESSION["errors"] = $errors;
        header("Location: ../addpost.php");
        exit();
    }

}else{

    header("Location: ../errors/404.php");
    exit();
}