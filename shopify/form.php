<?php
require_once('classes/Class.shopify.php');

$show_error = $show_error_create = $show_success = false;

if (isset($_POST['submit'])) {
    
    
    //check all inputs entered, would also normally add JS validation
    if (empty($_POST['title']) || 
        empty($_POST['body_html']) ||
        empty($_POST['price']) ||
        empty($_POST['sku'])) {
            $show_error = true;
    }
    
    if (!$show_error) {
        
        $Shopify = new Shopify();
        
        //prepare post data
        $post['product']['id'] = 0;
        $post['product']['vendor'] = "Lait's Runners";
        $post['product']['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $post['product']['body_html'] = trim($_POST['body_html']);
        $post['product']['product_type'] = filter_var($_POST['product_type'], FILTER_SANITIZE_STRING);
        $post['product']['variants'][0]['price'] = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
        $post['product']['variants'][0]['sku'] = filter_var($_POST['sku'], FILTER_SANITIZE_STRING);  

        $result = $Shopify->create_product($post);
        
        if (isset($result['errors'])) 
            $show_error_create = $result['errors']['product'];
        else if (isset($result['product']['id'])) {
            $show_success = $result['product']['id'];
            unset($_POST);
        }

    }
}

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

    <title>Add Shopify Product</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
      <a class="navbar-brand" href="#">Simon Lait</a>
      <ul class="nav navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="form.php">Add Product <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="all.php">All Products</a>
        </li>
      </ul>
    </nav>

    <div class="container">

        <h1>Add Product</h1>
        <p class="lead">Use this form to add to product to the Shopify store</p>
        
        <form method="post" action="form.php">
        
        <?php
        //all fields validation
        if ($show_error) {
            echo '<div class="alert alert-danger">
              <strong>Warning!</strong> Please enter all fields
            </div>';
        }
        //error creating product validation
        if ($show_error_create) {
            echo '<div class="alert alert-danger">
              <strong>Warning!</strong> ' . $show_error_create . '
            </div>';
        }
        //show success if product has been created
        if ($show_success) {
            echo '<div class="alert alert-success">
              <strong>Success!</strong> Product ID ' . $show_success . ' has been created
            </div>';
        }
        
        ?>
      
        <div class="form-group">
            <label for="InputTitle">Title</label>
            <input class="form-control" id="InputTitle" required aria-describedby="InputTitle" placeholder="Enter Product Title" type="text" name="title" value="<?php echo (isset($_POST['title']) ? $_POST['title'] : '') ?>">
        </div>
        
        <div class="form-group">
            <label for="InputDesc">Description</label>
            <textarea class="form-control" id="InputDesc" required aria-describedby="InputDesc" placeholder="Enter Product Description" name="body_html"><?php echo (isset($_POST['body_html']) ? $_POST['body_html'] : '') ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="InputType">Product Type</label>
            <select class="form-control" id="InputType" aria-describedby="InputType" name="product_type" required>
                <option class="Running Shoe" <?php echo (isset($_POST['product_type']) && $_POST['product_type'] == 'Running Shoe'  ? 'selected' : '') ?>>Running Shoe</option>
                <option class="Cross Country Shoe" <?php echo (isset($_POST['product_type']) && $_POST['product_type'] == 'Cross Country Shoe'  ? 'selected' : '') ?>>Cross Country Shoe</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="InputPrice">Price (£)</label>
            <input class="form-control" id="InputPrice" aria-describedby="InputPrice" required placeholder="Enter Product Price" type="number" name="price" value="<?php echo (isset($_POST['price']) ? $_POST['price'] : '') ?>">
        </div>
        
        <div class="form-group">
            <label for="InputPrice">SKU</label>
            <input class="form-control" id="InputSKU" aria-describedby="InputSKU" required placeholder="Enter Product SKU" type="text" name="sku" value="<?php echo (isset($_POST['sku']) ? $_POST['sku'] : '') ?>">
        </div>
        
        <input type="submit" name="submit" class="btn btn-primary" value="Add Product" />
        
        </form>
        

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>

