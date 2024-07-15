<?php

declare(strict_types=1);

spl_autoload_register(function ($class) {
  require __DIR__ . "/src/$class.php";
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

/* The URI used in this code example is structured as follows:
* localhost/website/api/products/
*
* The URI is split into parts using '/' as the delimiter. 
* In my specific case, the URI is split into the following parts:
* $parts[0] = "localhost"
* $parts[1] = "website"
* $parts[2] = "api"
* $parts[3] = "products"
*
* Depending on the user's specific URI, they may need to adjust the index of $parts accordingly:
* - For example, if the user's URI is localhost/products, the URI would be split as follows:
*   $parts[0] = "localhost"
*   $parts[1] = "products"
* - In this case, the user should use $parts[1] instead of $parts[3].
*
* Ensure to adjust the index in the condition below to match the correct part of your URI.
*/
if ($parts[3] != "products") {
  http_response_code(404);
  exit;
}

/* The URI used in this code example is structured as follows:
* localhost/website/api/products/PRODUCT_ID
*
* The URI is split into parts using '/' as the delimiter. 
* In my specific case, the URI is split into the following parts:
* $parts[0] = "localhost"
* $parts[1] = "website"
* $parts[2] = "api"
* $parts[3] = "products"
* $parts[4] = "PRODUCT_ID"
*
* Depending on the user's specific URI, they may need to adjust the index of $parts accordingly:
* - For example, if the user's URI is localhost/products/PRODUCT_ID, the URI would be split as follows:
*   $parts[0] = "localhost"
*   $parts[1] = "products"
*   $parts[2] = "PRODUCT_ID"
* - In this case, the user should use $parts[1] instead of $parts[4].
*
* Ensure to adjust the index in the condition below to match the correct part of your URI.
*/
$id = $parts[4] ?? null;

$database = new Database("localhost", "product_db", "root", "");

$gateway = new ProductGateway($database);

$controller = new ProductController($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

