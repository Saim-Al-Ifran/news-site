<?php

include 'config.php';





if(isset($_FILES['fileToUpload'])){
       $errors = array();

       $file_name = $_FILES['fileToUpload']['name'];
       $file_size = $_FILES['fileToUpload']['size'];
       $file_temp = $_FILES['fileToUpload']['tmp_name'];
       $file_type = $_FILES['fileToUpload']['type'];
        $explode   = explode('.',$file_name);
       $file_ext  = strtolower(end($explode));
       $extentions= array("jpeg","jpg","png");
       
       if(in_array($file_ext,$extentions) === false){
             $errors[] = "This type of extention not allowed, Please Choose jpeg,jpg,png";
       }
       
       if($file_size > 12582912){
             $errors[] ="File must 12mb OR lower";
       }
        
       $new_name = time().'-'.basename($file_name);
       if(empty($errors) == true){
                move_uploaded_file($file_temp,"upload/".$new_name);
       }else{
            print_r($errors);
            die();
       }

}


session_start();
$ptitle   = mysqli_real_escape_string($conn, trim($_POST['post_title']));
$postdesc = mysqli_real_escape_string($conn, trim($_POST['postdesc']));
$category = mysqli_real_escape_string($conn, trim($_POST['category']));
$date     = date("d M,Y");
$author   = $_SESSION['user_id'];


$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$ptitle}','{$postdesc}','{$category }','{$date}','{$author}','{$file_name}');";
 

$sql .= "UPDATE category SET post = post + 1  WHERE category_id = {$category}";




$result = mysqli_multi_query($conn, $sql);


if($result){
    header("location: http://localhost/news-site/admin/post.php");
}else{
    echo "Query Failed";
}
 
 ?>

   