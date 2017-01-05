<?php
require_once('classes/Class.shopify.php');

$Shopify = new Shopify();
$products = $Shopify->get_products();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="favicon.ico">-->

    <title>All Shopify Products</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-dark bg-inverse">
      <a class="navbar-brand" href="#">Simon Lait</a>
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="form.php">Add Product</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="all.php" >All Products <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </nav>

    <div class="container">

        <h1>All Products</h1>
        <p class="lead">All products in the shopify store</p>
        
        <a href="form.php" class="btn btn-primary">Add New Product</a>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Type</th>
                <th>Price</th>
                <th>SKU</th>
            </tr>
            <?php
            
            if (is_array($products['products']) && count($products['products']) > 0) {
                foreach ($products['products'] as $product) { ?>
            <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['body_html'] ?></td>
                <td><?php echo $product['product_type'] ?></td>
                <td><?php echo $product['variants'][0]['price'] ?></td>
                <td><?php echo $product['variants'][0]['sku'] ?></td>
                <!-- Edit / Delete Links would go here -->
            <?php
                }
            }
            ?>
    </div><!-- /.container -->

  </body>
</html>

