<?php
$query_slider = "SELECT * FROM posts_slider";
$posts_slider = $db->query($query_slider);

 ?>


<section>
  <div id = "carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="carouselExampleIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <?php
      if ($posts_slider->rowcount()>0) {
        foreach ($posts_slider as $post_slider) {
          $id_post = $post_slider['post_id'];
          $query_posts= "SELECT * FROM posts WHERE id=$id_post";
          $post = $db->query($query_posts)->fetch();
          ?>
          <div class="carousel-item <?php echo ($post_slider['active']) ? "active" : ""; ?>" style="height: 450px">
            <img src="./upload/posts/<?php echo $post['image'] ?>"  class="img-fluid d-block w-100 h-100"alt="">
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $post['title'] ?></h5>
              <p>
                <?php echo substr($post['body'], 0, 200)."..."; ?>
              </p>
              <a href="single.php?post=<?php echo $post['id'] ?>" class="btn btn-danger">مشاهده</a>

            </div>

          </div>
        <?php

        }
      }
      ?>
    </div>





  </div>


</section>
