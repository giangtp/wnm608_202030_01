<?

include_once "../library/php/functions.php";

$output = [];

if(!isset($_GET['type'])) {
    $output['error'] = "No Type";
} else
switch($_GET['type']) {

    case "products-all":
        $output['result'] = getData(
            "SELECT *
            FROM `products`
            ORDER BY id ASC"
        );
        break;

    case "products-one":
        if(!isset($_POST['id']))
            $output['error'] = "No ID";
        $output['result'] = getData(
            "SELECT *
            FROM `products`
            WHERE `id` = `{$_POST['id']}`"
        );
        break;

    case "products-search":
        if(!isset($_POST['search']))
            $output['error'] = "No Search Term";
        $output['result'] = getData(
            "SELECT *
            FROM `products`
            WHERE
                `title` LIKE '%{$_POST['search']}%' OR
                `description` LIKE '%{$_POST['search']}%' OR
                `genre` LIKE '%{$_POST['search']}%'
            ORDER BY id ASC"
        );
        break;

    case "products-filter":
        if(!isset($_POST['type']) || !isset($_POST['value']))
            $output['error'] = "Incorrect Data";
        $output['result'] = getData(
            "SELECT *
            FROM `products`
            WHERE `{$_POST['type']}` = '{$_POST['value']}'
            ORDER BY id ASC"
        );
        break;

    case "products-sort":
        if(!isset($_POST['type']) || !isset($_POST['dir']))
            $output['error'] = "Incorrect Data";
        $output['result'] = getData(
            "SELECT *
            FROM `products`
            ORDER BY `{$_POST['type']}` {$_POST['dir']}"
        );
        break;
}


die(json_encode(
    $output,
    JSON_UNESCAPED_UNICODE, // was missing the comma
    JSON_NUMERIC_CHECK
));


?>