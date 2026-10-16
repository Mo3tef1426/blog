<?php
require_once '../inc/conn.php';

if(isset($_POST['submit'])){

$name=trim(htmlspecialchars($_POST['name']));
$email=trim(htmlspecialchars($_POST['email']));
$password=trim(htmlspecialchars($_POST['password']));
$phone=trim(htmlspecialchars($_POST['phone']));


$errors=[];

if(empty($name)){
    $errors[]="name is requered";
}elseif(is_numeric($name)){
    $errors[]="name must be string requered";
}


if(empty($email)){
    $errors[]=" email is requered";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[]="email must be string email @";
}



if(empty($password)){
    $errors[]="password is requered";
}elseif(strlen($password)<6){
    $errors[]="password must be more than   6 char";
}



if(empty($phone)){
    $errors[]="phone is requered";
}elseif(!is_numeric($phone)){
    $errors[]="phone must be number";
}


$password = password_hash($password,PASSWORD_DEFAULT);

if(empty($errors)){
    $query="insert into users (`name`,`email`,`password`,`phone`) value ('$name','$email','$password','$phone')";
    $result=mysqli_query($conn,$query);
    if($result){

        $_SESSION['success']="users  register success";
            header("location:../login.php");

    }else{
            $_SESSION['errors']=["error whele register user"]; 
            header("location:../register.php");
    }
}else{
                 $_SESSION['name']=$name;
                $_SESSION['email']=$email;
                $_SESSION['phone']=$phone;
                

            $_SESSION["errors"] = $errors;
            header("Location: ../register.php");
            exit();
    }







}else{
    header("location:../errors/404.php");

}