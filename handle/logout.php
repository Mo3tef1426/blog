<?php
session_start();
if(!isset($_SESSION['user_id'])){


    header("location:../login.php");
}
unset($_SESSION['user_id']);
header("location:../login.php");

