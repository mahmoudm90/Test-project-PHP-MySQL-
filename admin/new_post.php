<?php
include("./include/header.php");

$query_categories = "SELECT * FROM categories";
$categories = $db->query($query_categories);

if (isset($_POST['add_post'])) {
  if (trim($_POST['title'])!="" && trim($_POST['author'])!="" && trim($_POST['category_id'])!="" && trim($_POST['body'])!="" && trim($_FILES['image']['name'])!="") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];
    $body = $_POST['body'];

    $name_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($tmp_name, "../upload/posts/$name_image")) {
      echo "Upload Success";
    }else {
      echo "Upload Error";
    }

    $post_insert = $db->prepare("INSERT INTO posts(title, author, category_id, body, image) VALUES (:title, :author, :category_id, :body, :image)");
    $post_insert->execute(['title'=>$title, 'author'=>$author, 'category_id'=>$category_id, 'body'=>$body, 'image'=>$name_image]);

    header("Location:post.php");
    exit();


  }else {
    header("Location:new_post.php?err_msg= تمام فیلدها الزامی است");
    exit();
  }
}
 ?>
<div class="container-fluid">
  <div class="row">
    <?php include("./include/sidebar.php") ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between mt-5">
        <h3>ایجاد مقاله</h3>
      </div>
      <hr>
      <?php
      if (isset($_GET['err_msg'])) {
        ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_GET['err_msg'] ?>
        </div>
        <?php
      }
       ?>
      <form class="mb-5" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="category">عنوان :</label>
          <input type="text" class="form-control" name="title" id="title">
          <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
        </div>
        <div class="form-group">
          <label for="author">نویسنده :</label>
          <input type="text" name="author" id="author" class="form-control">
          <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
        </div>
        <div class="form-group">
          <label for="category">دسته بندی:</label>
          <select class="form-control" name="category_id" id="category">
            <?php
            if ($categories->rowcount()>0) {
              foreach ($categories as $category) {
                ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
                <?php
              }
            }

             ?>

          </select>

        </div>
        <div class="form-group">
          <label for="category">متن مقاله : </label>
          <textarea class="form-control" name="body" id="body" rows="3"></textarea>
          <small class="form-text text-muted">متن مقاله را وارد کنید.</small>

        </div>
        <div class="form-group">
          <label for="author">تصویر :</label>
          <input type="file" name="image" class="form-control" id="image">
          <small class="form-text text-muted">تصویر مقاله را وارد کنید.</small>

        </div>
        <button type="submit" name="add_post" class="btn btn-outline-primary">ایجاد</button>


      </form>
    </main>

  </div>

</div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('body');

</script>
