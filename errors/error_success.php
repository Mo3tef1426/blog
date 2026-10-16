<?php
if(isset($_SESSION['errors'])){
    foreach($_SESSION['errors'] as $errors){?>
    <div class="alert alert-danger"><?php echo $errors ?> </div>

    <?php }
    unset($_SESSION['errors']);

}elseif(isset($_SESSION['success'])){?>
<div class="alert alert-success"><?php echo $_SESSION['success']?> </div>
<?php
 unset($_SESSION['success']);

} ?>