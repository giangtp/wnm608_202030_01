<?

function makeAuth(){
	return[
		"localhost",
		"GiangP1001",
		"Exodus20:1-17",
		"comikz_products"
	];
}

function makePDOAuth() {
	return[
		"mysql:host=localhost;dbname=comikz_products",
		"GiangP1001",
		"Exodus20:1-17",
		[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
	];
}

?>