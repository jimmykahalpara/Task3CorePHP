<?php
session_start();
require_once "Utilities/helpers.php";
$CURRENT_PAGE = "mens";

// code to get profile image url 
if (isset($_GET['filter_set'])){

    $condition = "";

    // if (is)

    
} else if (isset($_SESSION['user_id'])) {
    $query = "SELECT profile_image_url FROM `User` WHERE id=:id";
    $params = array(
        ":id" => $_SESSION['user_id']
    );

    $result = executeQueryResult($pdo, $query, $params);
    $profile_url = $result[0]['profile_image_url'];


    $query = "SELECT p.id, p.name, p.price, p.category_id, p.image_url, p.quantity, c.user_id FROM Product as p LEFT JOIN Cart as c ON (c.product_id = p.id AND (c.user_id = :id OR c.user_id IS NULL)) WHERE p.category_id = 1 ORDER BY p.id DESC; ";
    $params = array(
        ":id" => $_SESSION['user_id']
    );
    
} else {
    $query = "SELECT * FROM Product WHERE category_id = 1 ORDER BY id DESC;";
    $params = array();
    
}






$mens_products = executeQueryResult($pdo, $query, $params);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/indexStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
    <?php importBootstrapCSS(); ?>


    <title>Mens - <?php echo $title ?></title>
</head>

<body>

    <body>
        <?php require_once "Views/navbar.php" ?>
        <div class="mensContainerCart d-flex flex-row justify-content-between" id="menSection">
            <div class="arrowItems h-100 w-100">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" name="search" placeholder="Search Text" value="<?php if (isset($_GET['search'])){ echo $_GET['search']; } ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="filter_set" value="filter_set">Search</button>
                            <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#filterContainerId">
                                Filters
                            </button>
                        </div>
                    </div>
                    <div class="filterContainer border border-secondary p-3 collapse" id="filterContainerId">
                        <div class="form-group">
                            <label>Price Range:</label>
                            <div class="row m-0">
                                <input type="number" name="min_price" id="input_min_price" placeholder="Min" class="form-control col-6" value="<?php if (isset($_GET['min_price'])){ echo $_GET['min_price']; } ?>">
                                <input type="number" name="max_price" id="input_max_price" placeholder="Max" class="form-control col-6" value="<?php if (isset($_GET['max_price'])){ echo $_GET['max_price']; } ?>">

                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary" name="filter_set" value="filter_set">Filter</button>
                            <button class="btn btn-info" type="button">Reset</button>
                        </div>
                    </div>
                </form>
                <h1 class="py-3">Men's Latest</h1>

                <div class="imageListContainer row mx-auto">
                    <?php
                    foreach ($mens_products as $product) {
                        require "Views/productTile.php";
                    }

                    ?>


                </div>
            </div>
        </div>
        <?php require_once "Views/footer.php";
        importBootstrapJS(); ?>

        <script>
            $(document).ready(function() {
                $(".cart-button").click(function(e) {
                    $element = $(this);
                    $id = $element.attr("data-id");
                    if ($element.hasClass("added")) {
                        $.ajax({
                            url: "toCart.php",
                            method: "POST",
                            data: {
                                action: "remove",
                                product_id: $id
                            },
                            success: function(response) {
                                // if (response == "success") {
                                $element.removeClass("added");
                                $element.html("&#xe854;");
                                console.log(response);
                                // }
                            }
                        });
                    } else {
                        $.ajax({
                            url: "toCart.php",
                            method: "POST",
                            data: {
                                action: "add",
                                product_id: $id
                            },
                            success: function(response) {
                                // if (response == "success") {
                                $element.addClass("added");
                                $element.html("&#xe928;");
                                console.log(response);
                                // }
                            }
                        });
                    }

                });
            });
        </script>

    </body>

</html>