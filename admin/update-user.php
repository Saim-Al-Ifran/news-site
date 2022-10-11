
<?php


session_start();

if($_SESSION['user_role'] != 1){
    header("location: http://localhost/news-site/admin/post.php");
}
if(isset($_POST['submit'])){
    
    include 'config.php';
     
    $f_name    = mysqli_real_escape_string($conn,trim($_POST['f_name']));
    $l_name    = mysqli_real_escape_string($conn,trim($_POST['l_name']));
    $username  = mysqli_real_escape_string($conn,trim($_POST['username']));
    $role      = mysqli_real_escape_string($conn,trim($_POST['role']));
    
     $sql1 ="UPDATE user SET   first_name ='$f_name',last_name = '$l_name',username ='$username',role = '$role' WHERE user_id = {$_GET['uid']}" or die("error");
    $result1 = mysqli_query($conn, $sql1);

    if(isset($result1)){
        header("Location: http://localhost/news-site/admin/users.php");
    }else{
          echo "Connection Error";
    }
}

?>



<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php

                   include'config.php';
                   $sql = "SELECT * FROM user WHERE user_id = {$_GET['uid']}";
                   $result = mysqli_query($conn,$sql);
                   $row= mysqli_fetch_assoc($result);
                  
                  ?>
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                        
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="1" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                                 <?php
                                     if($row['role'] == 0){
                                          echo "<option value='0' selected >normal User</option>
                                                <option value='1'>Admin</option>
                                                <option value='2'>kodu</option>
                                                <option value='3'>bokachoda</option>";
                                                
                                     }elseif($row['role'] == 1){
                                        echo "<option value='0' >normal User</option>
                                        <option value='1' selected >Admin</option>
                                        <option value='2'>kodu</option>
                                        <option value='3'>bokachoda</option>";
                                     }elseif($row['role'] == 2){
                                        echo "<option value='0' >normal User</option>
                                        <option value='1' >Admin</option>
                                        <option value='2'  selected>kodu</option>
                                        <option value='3'>bokachoda</option>";
                                     }else{
                                        echo "<option value='0' >normal User</option>
                                        <option value='1' >Admin</option>
                                        <option value='2' >kodu</option>
                                        <option value='3' selected'>bokachoda</option>";
                                     }
                                 ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
