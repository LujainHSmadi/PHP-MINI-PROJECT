<?php

@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_product'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;

    if (empty($product_name) || empty($product_price) || empty($product_image)) {
        $message[] = 'please fill out all!';
    } else {

        $update_data = "UPDATE products SET name='$product_name', price='$product_price', image='$product_image'  WHERE id = '$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            header('location:admin_page.php');
        } else {
            $message[] = 'please fill out all!';
        }

    }
}
;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style2.css">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Furnato.com</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view.php">View</a>
      </li>

      </li>

    </ul>

  </div>
</nav>
</header>
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<span class="message">' . $message . '</span>';
    }
}
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php

$select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
while ($row = mysqli_fetch_assoc($select)) {

    ?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="enter the product name">
      <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="enter the product price">
      <input type="file" class="box" name="product_image"  accept="image/*">
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="admin_page.php" class="btn">go back!</a>
   </form>



   <?php }
;?>



</div>

</div>

    <footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
   
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="#">Furnato.com</a>
  </div>
  <!-- Copyright -->
</footer>
</body>
</html>