<?

include_once "../library/php/functions.php";

$empty_product = (object)[
	"title" => "Berserk Deluxe Edition Volume 1",
	"author" => "Kentaro Miura",
	"price" => "30.99",
	"isbn" => "9781506715223",
	"publisher" => "DARK HORSE",
	"format" => "Hardcover",
	"release_date" => "",
	"genre" => "Action, Adventure, Drama, Fantasy, Horror",
	"age_rating" => "17+",
	"dimension" => "10 x 7 x 10.2 in",
	"weight" => "3.8lb",
	"image" => "berserk.jpg",
	"description" => "Berserk Deluxe Edition Volume 1 collects the first 3 volumes of the critically acclaimed and widely successful dark fantasy series into one oversized premium hardcover book. From the momment of his birth being born from a corpse, Guts' life has been filled with nothing but trauma and misery. When he finally found a friend he could trust and a place to belong, he was betrayed and stripped of everything he knew and loved. Now he is out for revenge. Marked for death, Guts has to fight his ways through bloodthirsty demons and his own cursed fate. Will his quest for vengence succeed or will more tragedy and misery await him ahead?"
];



/* LOGIC ACTIONS */

try {
	$conn = makePDOConn();
	switch(@$_GET['action']) {
		case "update":
		$statement = $conn->prepare("UPDATE
			`products`
			SET
			`title` = ?,
			`author`= ?,
			`price`= ?,
			`isbn`= ?,
			`publisher`= ?,
			`format` =?,
			`release_date`= ?,
			`genre`= ?,
			`age_rating`= ?,
			`dimension`= ?,
			`weight` = ?,
			`image`= ?,
			`description` = ?
			WHERE `id` = ?
			");
		$statement->execute([
			$_POST['title'], 
			$_POST['author'],
			$_POST['price'],
			$_POST['isbn'],
			$_POST['publisher'],
			$_POST['format'],
			$_POST['release_date'],
			$_POST['genre'],
			$_POST['age_rating'],
			$_POST['dimension'],
			$_POST['weight'],
			$_POST['image'],
			$_POST['description'],
			$_GET['id']
		]);

		//header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
		header("location:{$_SERVER['PHP_SELF']}");
		break;

		case "create":
		$statement = $conn->prepare("INSERT INTO
			`products`
			(
				`title`,
				`author`,
				`price`,
				`isbn`,
				`publisher`,
				`format`,
				`release_date`,
				`genre`,
				`age_rating`,
				`dimension`,
				`weight`,
				`image`,
				`description`
			)
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)
			");
		$statement->execute([
			$_POST['title'], 
			$_POST['author'],
			$_POST['price'],
			$_POST['isbn'],
			$_POST['publisher'],
			$_POST['format'],
			$_POST['release_date'],
			$_POST['genre'],
			$_POST['age_rating'],
			$_POST['dimension'],
			$_POST['weight'],
			$_POST['image'],
			$_POST['description']
		]);
		$id = $conn->lastInsertId();

		//header("location:{$_SERVER['PHP_SELF']}?id=$id");
		header("location:{$_SERVER['PHP_SELF']}");
		break;

		case "delete":
		$statement = $conn->prepare("DELETE FROM `products` WHERE `id`=?");
        $statement->execute([$_GET['id']]);

        header("location:{$_SERVER['PHP_SELF']}");

		default: break;
	}
} catch(PDOException $e) {
	die($e->getMessage());
}


/* TEMPLATES */

function makeListItemTemplate($carry,$item){
	return $carry.<<<HTML
	<div class="col-xs-12 col-md-12 col-lg-6">
		<div class='card-soft card-light display-flex list-item'>
			<div class="flex-none image-thumbnail">
				<img src="images/products/$item->image">
			</div>
			<div class="item-info display-flex">
				<div class="flex-stretch position-relative">
					<div><strong>$item->title</strong></div>
					<div>by $item->author</div>
					<hr class="spacer">
					<nav class="nav-crumbs item-modification bottom">
						<ul>
							<li><a href="product_item.php?id=$item->id">View</a></li>
							<li><a href="admin/?id=$item->id">Edit</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
HTML;
}

function makeProductForm($o){
	$id = $_GET['id'];
	$addoredit = $id=='new' ? 'Add' : 'Edit';
	$createorupdate = $id=='new' ? 'create' : 'update';

	echo <<<HTML
	<div class="display-flex flex-bottom">
		<h2 class="flex-stretch push-down">$addoredit Product</h2>
		<nav class="nav-crumbs item-modification flex-none">
			<ul>
				<li><a href="admin/">Back</a></li>
				<li><a href="admin/?id=$id&action=delete">Delete</a></li>
			</ul>
		</nav>
	</div>

	<form class="card card-light card-soft push-down" method="post" action="admin/?id=$id&action=$createorupdate">

		<div class="form-control">
			<label class="form-label" for="title">Title</label>
			<input class="form-input" id="title" name="title" type="text" value="$o->title" required>
		</div>
		<div class="form-control">
			<label class="form-label" for="author">Author</label>
			<input class="form-input" id="author" name="author" type="text" value="$o->author" required>
		</div>

		<div class="display-flex flex-bottom form-control">
			<div class="form-half">
				<label class="form-label" for="price">Price</label>
				<input class="form-input" id="price" name="price" type="number" value="$o->price" min="0.01" max="1000" step="0.01" placeholder="0.00" required>
			</div>
			<hr class="vertical-spacer">
			<div class="form-half">
				<label class="form-label" for="isbn">ISBN</label>
				<input class="form-input" id="isbn" name="isbn" type="text" pattern="[9]{1}[0-9]{12}" value="$o->isbn" placeholder="90000000000000" required>
			</div>
		</div>
		<div class="display-flex flex-bottom form-control">
			<div class="form-half">
				<label class="form-label" for="release_date">Release Date</label>
				<input class="form-input" id="release_date" name="release_date" type="date" value="$o->release_date" required>
			</div>
			<hr class="vertical-spacer">
			<div class="form-half">
				<label class="form-label" for="age_rating">Age Rating</label>
				<input class="form-input" id="age_rating" name="age_rating" type="text" value="$o->age_rating" required>
			</div>
		</div>
		<div class="form-control">
			<label class="form-label" for="publisher">Publisher</label>
			<input class="form-input" id="publisher" name="publisher" type="text" value="$o->publisher" required>
		</div>
		<div class="form-control">
			<label class="form-label" for="format">Format</label>
			<input class="form-input" id="format" name="format" type="text" value="$o->format" required>
		</div>
		<div class="form-control">
			<label class="form-label" for="genre">Genre</label>
			<input class="form-input" id="genre" name="genre" type="text" value="$o->genre" required>
		</div>

		<div class="display-flex flex-bottom">
			<div class="form-half">
				<label class="form-label" for="dimension">Dimension</label>
				<input class="form-input" id="dimension" name="dimension" type="text" value="$o->dimension" placeholder="weight x height x length" required>
			</div>
			<hr class="vertical-spacer">
			<div class="form-half">
				<label class="form-label" for="weight">Weight</label>
				<input class="form-input" id="weight" name="weight" type="text" value="$o->weight" placeholder="0lb" required>
			</div>
		</div>
		<div class="form-control">
			<label class="form-label" for="image">Image</label>
			<input class="form-input" id="image" name="image" type="text" value="$o->image" placeholder="example.jpg" required>
		</div>
		<div class="form-control">
			<label class="form-label" for="description">Description</label>
			<textarea class="form-input form-textarea" id="description" name="description" required>$o->description</textarea>
		</div>

		<hr class="spacer">

		<div class="form-control">
			<div class="grid gap xs-medium md-large">
				<div class="col-xs-12 col-md-6">
					<input class="form-button" type="submit" value="Confirm">
				</div>
				<div class="col-xs-12 col-md-6">
					<input class="form-button secondary" type="reset" value="Reset">
				</div>
			</div>
		</div>
	</form>

HTML;

}


/* layout */

$website_url = "/aau/wnm608_01/pham.giang";
$root_url = "http://".$_SERVER['HTTP_HOST'].$website_url;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product Admin</title>
	<? include "../partials/head.html"; ?>
</head>
<body>

	<header class="header">
	<div class="container pad">
		<div class="secondary-nav display-flex flex-center">
			<div class="flex-stretch">
				<a href="index.php" class="logo small">
					<img src="images/general/comikz logo.png" alt="Logo">
				</a>
			</div>
			<div class="flex-none">
				<h4><a href="admin/">Product Admin</a></h4>
			</div>
		</div>
	</div>
	</header>

	<div class="content">
		<div class="container pad">
	        <?
	            if(isset($_GET['id'])) {
	                if($_GET['id']=="new") {
	                    makeProductForm($empty_product);
	                } else {
	                    $data = getData("SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'");
	                    makeProductForm($data[0]);
	                }
	            } else {
	                ?>
					<div class="display-flex flex-bottom">
						<h2 class="flex-stretch push-down">Product List</h2>
						<nav class="nav-crumbs item-modification flex-none">
							<ul>
								<li><a href="admin/?id=new">Add New Product</a></li>
							</ul>
						</nav>
					</div>

					
						<div class="push-down grid gap">

		                    <? 
		                    $data = getData("SELECT * FROM `products`ORDER BY `id` ASC");
		                    echo array_reduce($data,'makeListItemTemplate');
		                    ?>

						</div>
					</div>
	        <?
	            }

	        ?>
		</div>
	</div>

	<footer class="footer"></footer>
	
</body>
</html>