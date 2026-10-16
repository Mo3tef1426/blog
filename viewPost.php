<?php  
require_once 'inc/header.php' ; 
require_once 'inc/conn.php'; 
 
?> 
 
    <!-- Page Content --> 
    <div class="page-heading products-heading header-text"> 
      <div class="container"> 
        <div class="row"> 
          <div class="col-md-12"> 
            <div class="text-content"> 
              <h4>new Post</h4> 
              <h2>add new personal post</h2> 
            </div> 
          </div> 
        </div> 
      </div> 
    </div> 
    <?php 
//check 
if(isset($_GET['id'])){ 
  $id = $_GET['id']; 
 
 
 
 
}else{ 
   header("location:errors/404.php"); 
} 
    //fetch  
    // $query="select * from posts where id=$id"; 
    $query="select posts .* , users.name as created_by from posts join users on users.id=posts.user_id where posts.id=$id"; 
    //catch 
    $result=mysqli_query($conn,$query); 
    // select one  
    if(mysqli_num_rows($result)==1){ 
      $post=mysqli_fetch_assoc($result); 
 
 
 
    }else{ 
       header("location:errors/404.php"); 
 
    } 
 
 
 
 
 
 
    ?> 
    <div class="best-features about-features"> 
      <div class="container"> 
        <div class="row"> 
          <div class="col-md-12"> 
            <div class="section-heading"> 
              <h2>Our Background</h2> 
            </div> 
          </div> 
          <div class="col-md-6"> 
            <div class="right-image"> 
              <img src="uploads/<?php  echo $post['image']?>" alt=""> 
            </div> 
          </div> 
          <div class="col-md-6"> 
            <div class="left-content"> 
              <h4><?php  echo $post['title']?></h4> 
              <p><?php  echo $post['body']?></p> 
              <p> created at :<?php  echo $post['created_at']?></p> 
              <p>created by <?php  echo $post['created_by']?></p> 

                  <?php if(isset($_SESSION['user_id'])){?>
                  
                    <div class="d-flex justify-content-center"> 
                  <a href="editPost.php?id=<?php echo $post['id'] ?>" class="btn btn-success mr-3 "> edit post</a> 
               
                  <!-- <a href="deletePost.php?id=<?php echo $post['id'] ?> " class="btn btn-danger "> delete post</a>  -->
                   <form action="handle/delete.php?id=<?php echo $post['id'] ?>"  method="post">
                    <button type="submit" class="btn btn-danger" name="submit">Delete post  </button>
                   </form>
              </div> 


                 <?php }  ?>

            
            </div> 
          </div> 
        </div> 
      </div> 
</div> 
 
    <?php require_once 'inc/footer.php' ?>