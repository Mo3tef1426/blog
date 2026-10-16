<?php 
require_once '../inc/conn.php';

if(isset($_POST['submit'])){
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['password']));

   $errors=[];

   if(empty($email)){

   $errors[]="email is requered";

   }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="email must be string email @";
    
   };

   if(empty($password)){
    $errors[]="Password is empty";
   }elseif(strlen($password)>6){

   $errors[]="password must be more than   6 char";

   };

   if(empty($errors)){


   $query="select * from users where email = '$email'";
   $result=mysqli_query($conn,$query);
   if(mysqli_num_rows($result)==1){

   $users= mysqli_fetch_assoc($result);
   $old_pass=$users['password'];
   $is_verifed=password_verify($password,$old_pass);
   if($is_verifed){

    $_SESSION['user_id']=$users['id'];

       $_SESSION["success"] = " user  loing success ";
         header("Location: ../index.php");


   }else{
            $_SESSION['errors']=["email or passowrd not correct1"]; 
            header("location:../login.php");
   }
   }else{
             $_SESSION['errors']=["email or passowrd not correct"]; 
             header("location:../login.php");

   }
   }else{
       
              $_SESSION['email']=$email;
            $_SESSION["errors"] = $errors;
            header("Location: ../login.php");

   }
}else{
      header("location:../errors/404.php");
}
?>