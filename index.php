
<?php 

require_once 'inc/header.php' ;
require_once'inc/conn.php';
?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
    

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
               <?php  require_once 'errors/error_success.php' ?>
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>

          <?php 
          $limit = 3 ;
          if(isset($_GET['page'])){
            $page=$_GET['page'];

          }else{
            $page=1;
          }
          $offset= ($page - 1) * $limit;

          $query="select count(id) as total from posts ";
          $result=mysqli_query($conn,$query);
          $total=mysqli_fetch_assoc($result);
          $numOfpages= ceil ($total['total']/$limit);
if($page > $numOfpages){
    header("Location: ".$_SERVER['PHP_SELF']."?page=".$numOfpages);
    exit;
}elseif($page < 1){
    header("Location: ".$_SERVER['PHP_SELF']."?page=1"); 
    exit;
}

          //select all
          //fetch
          //catch
          $query = "SELECT * FROM posts LIMIT $limit OFFSET $offset";

          $result=mysqli_query($conn,$query);
          if(mysqli_num_rows($result)>0){

          $posts=mysqli_fetch_all($result,MYSQLI_ASSOC);
          foreach($posts as $post){ ?>
                 <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="uploads/<?php  echo $post['image']?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?php echo $post['title'] ?></h4></a>
                <h6><?php echo $post['created_at'] ?></h6>
                <p> <?php echo $post['body'] ?></p>
                
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> view</a>
                </div>
                
              </div>
            </div>
          </div>
   

         <?php }


          }else{
            header("location:errors/404.php");
          }
          ?>
     
        </div>
  <ul class="pagination">
  <li class="page-item <?php if($page==1) echo 'disabled'; ?>">
    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'].'?page='.($page-1); ?>">Previous</a>
  </li>
  
  <?php for($i=1; $i<=$numOfpages; $i++) { ?>
    <li class="page-item <?php if($page==$i) echo 'active'; ?>">
      <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'].'?page='.$i; ?>">
        <?php echo $i; ?>
      </a>
    </li>
  <?php } ?>
  
  <li class="page-item <?php if($page==$numOfpages) echo 'disabled'; ?>">
    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'].'?page='.($page+1); ?>">Next</a>
  </li>
</ul>

      </div>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
