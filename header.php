<?php
 include 'config.php';

 $page = basename($_SERVER['PHP_SELF']);

 switch($page){
   
    case 'single.php';
        $sql = "SELECT * FROM post WHERE post_id ={$_GET['sid']}";
        $result = mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($result);
        $header_title = $row['title'];
    break;

    case 'category.php';
        $sql = "SELECT * FROM category WHERE category_id ={$_GET['cid']}";
        $result = mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($result);
        $header_title = $row['category_name'] . " News";
    break;

    case 'author.php';
        $sql = "SELECT * FROM user WHERE user_id ={$_GET['aid']}";
        $result = mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($result);
        $header_title = "News By " . $row['username'];
    break;

    case 'search.php';
       $header_title = $_GET['search'];
    break;

    default:
    $header_title = "News-Site";
    break;
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $header_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                   include 'config.php';

                   $sql = "SELECT * FROM category WHERE post > 0";
                   $result = mysqli_query($conn, $sql);
                  
                  if(mysqli_num_rows($result) > 0){
                    $active = "";
                ?>
                <ul class='menu'>
                    <li><a href="index.php">Home</a></li>
                    <?php
                      while($row=mysqli_fetch_assoc($result)){

                           if(isset($_GET['cid'])){
                                if($_GET['cid'] == $row['category_id']){
                                    $active = "active";
                                }else{
                                        $active = "";
                                }
                           }
                          echo "<li><a class ='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                      }
                    ?>
                    

                </ul>
                <?php
                  }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
