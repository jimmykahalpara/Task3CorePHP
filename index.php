    <?php
    session_start();
    require_once "Utilities/helpers.php";
    $CURRENT_PAGE = "index";

    // code to get profile image url 
    if (isset($_SESSION['user_id'])) {
        $query = "SELECT profile_image_url FROM `User` WHERE id=:id";
        $params = array(
            ":id" => $_SESSION['user_id']
        );

        $result = executeQueryResult($pdo, $query, $params);
        $profile_url = $result[0]['profile_image_url'];


    $query = "SELECT p.id, p.name, p.price, p.category_id, p.image_url, p.quantity, c.user_id FROM Product as p LEFT JOIN Cart as c ON (c.product_id = p.id AND (c.user_id = :id OR c.user_id IS NULL)) WHERE p.category_id = 1 ORDER BY p.id DESC LIMIT 3; ";
    $params = array(
        ":id" => $_SESSION['user_id']
    );
    $mens_products = executeQueryResult($pdo, $query, $params);
    // code to get top 3 womens products
    $query = "SELECT p.id, p.name, p.price, p.category_id, p.image_url, p.quantity, c.user_id FROM Product as p LEFT JOIN Cart as c ON (c.product_id = p.id AND (c.user_id = :id OR c.user_id IS NULL)) WHERE p.category_id = 2 ORDER BY p.id DESC LIMIT 3; ";
    $params = array(
        ":id" => $_SESSION['user_id']
    );
    $womens_products = executeQueryResult($pdo, $query, $params);

    // code to get top 3 kids products
    $query = "SELECT p.id, p.name, p.price, p.category_id, p.image_url, p.quantity, c.user_id FROM Product as p LEFT JOIN Cart as c ON (c.product_id = p.id AND (c.user_id = :id OR c.user_id IS NULL)) WHERE p.category_id = 3 ORDER BY p.id DESC LIMIT 3; ";
    $params = array(
        ":id" => $_SESSION['user_id']
    );
    $kids_products = executeQueryResult($pdo, $query, $params);
} else {
    // top 3 mens products 
    $query = "SELECT * FROM Product WHERE category_id = 1 ORDER BY id DESC LIMIT 3; ";
    $params = array();
    $mens_products = executeQueryResult($pdo, $query, $params);

    // top 3 womens products
    $query = "SELECT * FROM Product WHERE category_id = 2 ORDER BY id DESC LIMIT 3; ";
    $params = array();
    $womens_products = executeQueryResult($pdo, $query, $params);


    // top 3 kids products
    $query = "SELECT * FROM Product WHERE category_id = 3 ORDER BY id DESC LIMIT 3; ";
    $params = array();
    $kids_products = executeQueryResult($pdo, $query, $params);
    


}


// code to get top 3 mens products

// var_dump($mens_products);
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


    <title>Shop</title>
</head>

<body>
    <?php require_once "Views/navbar.php" ?>
    <div class="container px-md-5" id="firstContainer">
        <img scr="images/exploreImages2.jpeg">
        <div class="row mx-md-n5">
            <div class="col-12 col-lg-6 w-100 p-md-2">
                <div class="" id="firstContainerItems1">
                    <div class="firstContainerDataItem w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white" id="firstDataItem1">
                        <div id="flCont">
                            <span class="largeText">We are Hexashop</span>
                            <p class="itallic">Aewsome, clean & creative HTML5 template</p>
                            <button>Purchase Now</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12 col-lg-6 p-md-2">
                        <div class="" id="firstContainerItems2">
                            <div class="firstContainerDataItem w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white" id="firstDataItem2">
                                <span class="mediumText">Women</span>
                                <p class="itallic">Best Clothes for Women</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-md-2">
                        <div class="" id="firstContainerItems3">
                            <div class="firstContainerDataItem w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white" id="firstDataItem3">
                                <span class="mediumText">Men</span>
                                <p class="itallic">Best Clothes for Men</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 p-md-2">
                        <div class="" id="firstContainerItems4">
                            <div class="firstContainerDataItem w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white" id="firstDataItem4">
                                <span class="mediumText">Kids</span>
                                <p class="itallic">Best Clothes for Kids</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-md-2">
                        <div class="" id="firstContainerItems5">
                            <div class="firstContainerDataItem w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white" id="firstDataItem5">
                                <span class="mediumText">Accessories</span>
                                <p class="itallic">Best Trend Accessories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- <hr class="afterFirst"> -->

    <div class="mensContainer d-flex flex-row justify-content-between" id="menSection">
        <div class="arrow1 d-none d-md-flex justify-content-center align-items-center">
            <i class="material-icons">&#xe5cb;</i>
        </div>
        <div class="arrowItems h-100 w-100">
            <h1>Men's Latest</h1>
            <p class="itallic color-grey no-margins">
                Details to details is what makes Hexashop different from the other themes
            </p>
            <div class="imageListContainer row mx-auto">
                <?php
                foreach ($mens_products as $product) {
                    require "Views/productTile.php";
                }

                ?>


            </div>
        </div>
        <div class="arrow3 d-none d-md-flex justify-content-center align-items-center" id="menarrow3">
            <i class="material-icons">&#xe5cc;</i>
        </div>
    </div>

    <div class="mensContainer d-flex flex-row justify-content-between" id="menSection">
        <div class="arrow1 d-none d-md-flex justify-content-center align-items-center">
            <i class="material-icons">&#xe5cb;</i>
        </div>
        <div class="arrowItems h-100 w-100">
            <h1>Women's Latest</h1>
            <p class="itallic color-grey no-margins">
                Details to details is what makes Hexashop different from the other themes
            </p>
            <div class="imageListContainer row mx-auto">
                <?php
                foreach ($womens_products as $product) {
                    require "Views/productTile.php";
                }

                ?>
            </div>
        </div>
        <div class="arrow3 d-none d-md-flex justify-content-center align-items-center" id="menarrow3">
            <i class="material-icons">&#xe5cc;</i>
        </div>
    </div>


    <!-- ---------------------------- -->
    <div class="mensContainer d-flex flex-row justify-content-between" id="menSection">
        <div class="arrow1 d-none d-md-flex justify-content-center align-items-center">
            <i class="material-icons">&#xe5cb;</i>
        </div>
        <div class="arrowItems h-100 w-100">
            <h1>Kids's Latest</h1>
            <p class="itallic color-grey no-margins">
                Details to details is what makes Hexashop different from the other themes
            </p>
            <div class="imageListContainer row mx-auto">
                <?php
                foreach ($kids_products as $product) {
                    require "Views/productTile.php";
                }

                ?>
            </div>
        </div>
        <div class="arrow3 d-none d-md-flex justify-content-center align-items-center" id="menarrow3">
            <i class="material-icons">&#xe5cc;</i>
        </div>
    </div>

    <div class="row justify-content-between exploreContainer1 mx-auto">
        <div class="col-12 col-lg-6" id="exploreItem11">
            <h1 class="ml-5 ml-md-auto">Explore Our Products</h1>
            <p class="color-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam corporis ut consequuntur
                delectus harum ea eos! Iusto accusamus vel blanditiis earum odit dignissimos?</p>
            <p class="quotationMark1">
                <img src="images/quotation.png" alt="">
            <p class="itallic" id="quote1">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum dolor
                sit.</p>
            </p>
            <p class="color-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam corporis ut consequuntur
                delectus harum ea eos! Iusto accusamus vel blanditiis earum odit dignissimos? Lorem ipsum dolor sit
                <br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, vero consequuntur fugit incidunt
                repellat rem sequi provident delectus eos molestias accus
            </p>
            <button>Discover More</button>
        </div>
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12 col-md-6 px-0 py-1 py-md-0" id="exploreItem21">
                    <h2>Leather Bags</h2>
                    <p class="color-grey itallic">Latest Collection</p>
                </div>
                <div class="col-12 col-md-6 px-0 py-1 py-md-0" id="exploreItem31">
                    <img class="w-100" src="images/exploreImages2.jpeg" alt="leather bags">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 px-0 py-1 py-md-0 order-2 order-md-1" id="exploreItem41">
                    <img class="w-100" src="images/exploreImages.jpeg" alt="Accessories">
                </div>
                <div class="col-12 col-md-6 px-0 py-1 py-md-0 order-1 order-md-2" id="exploreItem51">
                    <h2>Different Types</h2>
                    <p class="color-grey itallic">Over 304 products</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ----------------- explore section ------------ -->

    <div class="socialMedia" id="socialMediaCnt">
        <h1>Social Media</h1>
        <p class="no-margins color-grey itallic">Detail to details is what makes hexashop different from other themes
        </p>
        <div class="socialImageList row">
            <img class="col-6 col-md-2 px-2 p-md-0" src="images/mediaImage1.jpeg" alt="mediaImage1">
            <img class="col-6 col-md-2 px-2 p-md-0" src="images/mediaImage2.jpg" alt="mediaImage2">
            <img class="col-6 col-md-2 px-2 p-md-0" src="images/mediaImage3.jpg" alt="mediaImage3">
            <img class="col-6 col-md-2 px-2 p-md-0" src="images/mediaImage4.jpg" alt="mediaImage4">
            <img class="col-6 col-md-2 px-2 p-md-0" src="images/mediaImage5.jpeg" alt="mediaImage5">
            <img class="col-6 col-md-2 px-2 p-md-0" src="images/mediaImage6.jpg" alt="mediaImage6">
        </div>
    </div>

    <div id="contactContainer" class="row">
        <div class="col-12 col-lg-8 contactItems d-flex justify-content-center flex-column align-items-center" id="contactItem1">
            <div class="bigText w-100 w-md-50">
                By Subscribing To Our Newsletter Your Can Get 30% Off
            </div>
            <p class="no-margins color-grey itallic">Detail to details is what makes hexashop different from other
                themes</p>
            <form action="" id="newsLetterForm">
                <input type="text" name="name" id="newsLetterForm_input_name" placeholder="Enter Your Name">
                <input type="email" name="email" id="newsLetterForm_input_email" placeholder="Enter Your Email">
                <button class="mx-5 px-5 ml-lg-auto px-lg-3"><i style="font-size:24px" class="fa">&#xf1d8;</i></button>

            </form>
        </div>
        <div class="col-12 col-md-6 col-lg-2 contactItems m-0 pt-3 p-lg-0" id="contactItem2">
            <div class="detailItems" id="detailItems1">
                <p class="mediumBoldText">Store Location:</p>
                <p class="color-grey smallText">Sunny Isles Beach, Fl, 33160, United States</p>
            </div>
            <div class="detailItems" id="detailItems2">
                <p class="mediumBoldText">Phone:</p>
                <p class="color-grey smallText">909-239-2938</p>
            </div>
            <div class="detailItems" id="detailItems3">

                <p class="mediumBoldText">Office Location:</p>
                <p class="color-grey smallText">North Miami Beach</p>
            </div>

        </div>
        <div class="contactItems col-12 col-md-6 col-lg-2 m-0 pt-3 p-lg-0" id="contactItem3">
            <div class="detailItems" id="detailItems1">
                <p class="mediumBoldText">Work Hours:</p>
                <p class="color-grey smallText">07:30 AM - 9:30 PM Daily</p>
            </div>
            <div class="detailItems" id="detailItems3">
                <p class="mediumBoldText">Email:</p>
                <p class="color-grey smallText">info@company.com</p>
            </div>
            <div class="detailItems" id="detailItems2">
                <p class="mediumBoldText">Social Media:</p>
                <p class="color-grey smallText">Facebook, Instagram, Behance, Linkedin</p>
            </div>




        </div>
    </div>



    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script> -->

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
                updateCartCount();

            });
        });
    </script>

</body>

</html>