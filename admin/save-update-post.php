<?php
include 'config.php';

if(empty($_FILES['new-image']['name'])){
     $new_name = $_POST['old-image'];
}else{

     $errors = array();

     $file_name = $_FILES['new-image']['name'];
     $file_size = $_FILES['new-image']['size'];
     $file_tmp = $_FILES['new-image']['tmp_name'];
     $file_type = $_FILES['new-image']['type'];
     $explode = explode('.',$file_name);
     $file_ext = strtolower(end($explode));
     $extentions = array("jpeg","jpg","png");

     if(in_array($file_ext,$extentions) === false){
        $errors[] = "This type of extension not allowed, please Choose jpeg,jpg,png";
     }


     if($file_size > 12582912){
        $errors[] = "File must 12mb or lower";
     }

     $new_name = time().'-'.$file_name;


     if(empty($errors) == true){
           move_uploaded_file($file_tmp,"upload/".$new_name);
     }else{
         print_r($errors);
         die();
     }




}

 $title = mysqli_real_escape_string($conn, trim($_POST['post_title']));
 $description = mysqli_real_escape_string($conn, trim($_POST['postdesc']));
 $category = mysqli_real_escape_string($conn, trim($_POST['category']));

 $sql = "UPDATE post SET title = '{$title}',description = '{$description}',category='{$category}',post_img='{$new_name}' WHERE post_id = {$_POST['postid']};";
 
 if($_POST['old_category'] != $_POST['category']){
       $sql .= "UPDATE category SET post = post +1 WHERE category_id = {$_POST['category']} ;";
       $sql .= "UPDATE category SET post = post -1 WHERE category_id ={$_POST['old_category']};";
 }


//  echo $sql;

 $result = mysqli_multi_query($conn, $sql);

 if($result){
    header("location: http://localhost/news-site/admin/post.php");
 }else{
    echo "Query Failed";
 }
 
?>