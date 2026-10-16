<?php
require_once '../inc/conn.php';

if(isset($_POST['submit']) && isset($_GET['id'])){

$id=$_GET['id'];

$query="select * from posts where id=$id";
$result=mysqli_query($conn,$query); 
if(mysqli_num_rows($result)==1){
    $post=mysqli_fetch_assoc($result);
    $old_image=$post['image'];

    $query="delete from posts where id=$id"; 
    $result=mysqli_query($conn,$query);

    if($result){

        if(!empty($old_image)){
            unlink("../uploads/$old_image");
        }

        $_SESSION['success']="post deleted success";
        header("location:../index.php");

    }else{
        $_SESSION['errors']=["error whele delete post"]; 
        header("location:../index.php");
    }

}else{
    header('location:../errors/404.php');

}
}else{
    header('location:../errors/404.php');

}