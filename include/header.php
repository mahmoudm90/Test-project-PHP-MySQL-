<?php
include("./include/config.php");
include("./include/db.php");

$query="SELECT * FROM categories";
$categories=$db->query($query);

 ?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Test project</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <a href="index.php" class="navbar-brand order-md-2">Test project</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="#my-nav" class="collapse navbar-collapse">
          <ul class="navbar-nav order-md-1">
            <?php
            if ($categories->rowcount() > 0) {
              foreach ($categories as $category) {
                ?>
                <li class="nav-item <?php echo(isset($_GET['category']) && $category['id']==$_GET['category']) ? "active" : ""; ?>">
                  <a href="index.php?category=<?php echo $category['id'] ?>"><?php echo $category['title'] ?></a>

                </li>
            <?php
              }
            }



              ?>


          </ul>

        </div>

      </div>

    </nav>
