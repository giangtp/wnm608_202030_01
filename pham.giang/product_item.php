<?
	require_once "library/php/functions.php";
	require_once "partials/templates.php";

    $data = getRows(makeConn(),
        "SELECT * FROM `products` 
        WHERE `id` = '{$_GET['id']}'"
        );
    $o = $data[0];
    $images = explode(",",$o->image);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $o->title?></title>
	<?php include "partials/head.html"; ?>
</head>
<body>
	<?php include "partials/header.php"; ?>

    <div class="content">
        <div class="container pad">
            <div class="card card-soft card-light">
                <nav class="nav-crumbs">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="product_list.php">Products</a></li>
                        <li><?= $o->title?></li>
                    </ul>
                </nav>

                <div class="product-card">
                    <div class="grid gap xs-small md-large lg-large">
                        <div class="col-xs-12 col-md-12 col-lg-6">
                            <div class="product-image">
                                <img class="card-center" src="images/products/<?= $o->image ?>" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6">
                            <form method="get" action="form_actions.php">
                                <h1><?= $o->title ?></h1>
                                <h3 style="margin-bottom: 0.5em;">By <?= $o->author ?></h3>
                                <h5>&dollar;<?= $o->price ?></h5>
                                <div class="card-section">
                                    <label class="quantity-label">QUANTITY</label>
                                    <div class="form-select quantity-select">
                                        <select name="amount">
                                            <!-- option*10>{$} -->
                                            <option selected="selected">1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-section">
                                    <input type="hidden" name="action" value="add-to-cart">
                                    <input type="hidden" name="id" value="<?= $o->id ?>">
                                    <input type="hidden" name="price" value="<?= $o->price ?>">
                                    <input type="submit" class="form-button card-section" value="Add To Cart">
                                </div>
                            </form>
                            <hr>
                            <div class="product-description card-section">
                                <h3>INFORMATION</h3>
                                <ul class="info">
                                    <li><strong>ISBN</strong>: <?= $o->isbn?></li>
                                    <li><strong>Publisher</strong>: <?= $o->publisher?></li>
                                    <li><strong>Format</strong>: <?= $o->format?></li>
                                    <li><strong>Release Date</strong>: <?= $o->release_date?></li>
                                    <li><strong>Genre</strong>: <?= $o->genre?></li>
                                    <li><strong>Age Rating</strong>: <?= $o->age_rating?></li>
                                    <li><strong>Dimension</strong>: <?= $o->dimension?></li>
                                    <li><strong>Weight</strong>: <?= $o->weight?></li>
                                </ul>
                                <div class="description-text"><?= $o->description ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-flat">
                <h2>Recommended Products</h2>
                <hr class="spacer small">
                <div class="grid gap">
                    <?

                        $recommendations = getData("
                        SELECT * 
                        FROM `products`
                        WHERE id <> '$o->id'
                        ORDER BY rand()
                        LIMIT 4
                        ");

                        echo array_reduce($recommendations,'recommendationTemplate');

                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "partials/footer.php"; ?>
    
</body>
</html>