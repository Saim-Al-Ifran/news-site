<?php include "header.php";
  include 'config.php';
 
   

  if($_SESSION['user_role'] == 0){

    $sql2    = "SELECT author FROM post WHERE post_id = {$_GET['pid']}";
    $result2 = mysqli_query($conn ,$sql2);
    $row2 = mysqli_fetch_assoc($result2); 
        
    if($row2['author'] != $_SESSION['user_id'] ){
         header("location: http://localhost/news-site/admin/post.php");
    }
}


?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">

        <?php
                  
                  $sql = "SELECT * FROM post WHERE post_id = {$_GET['pid']} ";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                 
                  $_SESSION['post_img'] = $row['post_img'];
                  $_SESSION['post_id']  = $row['post_id']; 
        
        ?>
            <div class="form-group">
                <input type="hidden" name="old_category"  class="form-control" value="<?php echo $row['category']?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile"></label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                        <?php echo $row['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category" value= "<?php echo $row['category'] ?>">

                  <?php

                   $sql1 = "SELECT * FROM category";
                   $result1 = mysqli_query($conn, $sql1);

                   while($row1 = mysqli_fetch_assoc($result1)){

                         if($row['category'] == $row1['category_id']){
                              $selected = "selected";
                         }else{
                              $selected = "";
                         }

                       echo  "<option  {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";

                   }   
                      
                  
                  ?>
                    
 
                </select>
            </div>
             
            <div class="form-group">
                <label for="">Post Image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $_SESSION['post_img']?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $_SESSION['post_img'] ?>">
                <input type="hidden" name="postid" value ="<?php  echo $_SESSION['post_id'] ?>" >
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
