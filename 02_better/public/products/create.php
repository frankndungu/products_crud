<?php

/** @var $pdo \PDO */
require_once "../../database.php";
require_once "../../functions.php";

$errors = [];

$title = '';
$price = '';
$description = '';
$product = [
  'image' => '' 
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (empty($errors)) {
        
        require_once "../../validate_product.php";
        
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
        VALUES (:title, :image, :description, :price, :date)");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();
        header('Location: index.php');       
    }
}

?>
<?php include_once "../../views/partials/header.php" ?>

<p>
  <a href="index.php" class="btn btn-secondary">Go back to products</a>
</p>

  <h1>Create New Product</h1>

  <?php include_once "../../views/products/form.php" ?>

  </body>
</html>
