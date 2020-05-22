<?php
require_once "library/php/functions.php";

function makeCartBadge() {
    if(!isset($_SESSION['cart']) || !count($_SESSION['cart'])) {
        return "0";
    } else return array_reduce($_SESSION['cart'],function($r,$o){
        return $r + $o->amount;
    },0);
}

//function borrowed from https://stackoverflow.com/questions/15963757/how-to-set-current-page-active-in-php/15963906

function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active';
  } 
}

?>

<header class="header">
	<div class="container pad">
		<div class="main-nav display-flex flex-center">
			<a href="index.php" class="logo large">
				<img src="images/general/comikz logo.png" alt="Logo">
			</a>
			<input type="search" class="hotdog form-input" placeholder="Search..." style="margin: 0 1.5em;">
			<a href="product_cart.php" class="icon large position-relative">
				<img src="images/general/cart.png" alt="Cart">
				<div class="cart-badge"><span><?= makeCartBadge() ?></span></div>
			</a>
		</div>
	</div>
<nav class="navbar">
	<div class="container">
		<div class="nav-material">
			<ul>
				<li class="<?php active('index.php');?>"><a href="index.php">HOME</a></li>
				<li class="<?php active('product_list.php');?>"><a href="product_list.php">PRODUCTS</a></li>
				<li class="<?php active('about.php');?>"><a href="about.php">ABOUT</a></li>
			</ul>
		</div>
	</div>
	<script>
		$(()=>{
			$("[class*='nav'] a").on("click", function(e){
				$(this).closest("li").addClass("active")
					.siblings().removeClass("active");
			})
		})
	</script>
</nav>
</header>