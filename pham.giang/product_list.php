<?
	require_once "library/php/functions.php";
	require_once "partials/templates.php";

    $pagelimit = 12;
    $pageoffset = isset($_GET['page'])?$_GET['page']:0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Products</title>
	<?php include "partials/head.html"; ?>
</head>
<body>
	
	<?php include "partials/header.php"; ?>
    
    <div class="content">
        <div class="container pad push-down">
            <h2 class="spacer">Products</h2>
            <div class="grid gap xs-small md-medium">
                <div class="col-xs-12 col-md-8 col-lg-9">
                    <form class="list-search">
                        <input type="search" class="form-input" name="search" placeholder="Search products...">
                    </form>
                </div>
                
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <form class="form-select list-sort">
                        <select class="sort">
                            <option value="" selected disabled hidden style="color: var(--color-neutral);">Sort By</option>
                            <option value="1">Newest</option>
                            <option value="2">Oldest</option>
                            <option value="3">Most Expensive</option>
                            <option value="4">Least Expensive</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="col-xs-12 col-md-9 col-lg-10 push-down">
                <div class="grid gap product-list"></div>
            </div>
        </div>
    </div>
    
    <?php include "partials/footer.php"; ?>

    <script src="js/list.js"></script>

</body>
</html>