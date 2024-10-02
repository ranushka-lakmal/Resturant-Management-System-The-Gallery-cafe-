<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== TRUE) {
    echo '<script>alert("You must be logged in to order food."); window.location.href="login.php";</script>';
    exit();
}

// Database connection
include 'dbCon.php'; // Make sure this file has your database connection logic
$con = connect();

// Handle search
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Fetch all food items from the menu_item table, optionally filtered by search
$sql = "SELECT * FROM `menu_item` WHERE `item_name` LIKE '%$search%'";
$result = $con->query($sql);

// Fetch user details from the session
$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];
?>

<?php include 'template/header.php'; ?>

<head>
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .menu-item-card {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .menu-item-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 15px;
        }

        .menu-info h3 {
            color: #ecf0f1;
            margin-top: 15px;
        }

        .menu-info p {
            color: #bdc3c7;
            margin: 5px 0;
        }

        .menu-info .price {
            color: #e74c3c;
            font-weight: bold;
            margin-top: 10px;
        }

        .order-btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .order-btn:hover {
            background-color: #c0392b;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .search-input {
            border-radius: 25px 0 0 25px;
            border: 1px solid #ced4da;
            padding: 10px 20px;
            width: 70%;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            border-color: #007bff;
            outline: none;
        }

        .search-btn, .reset-btn {
            border-radius: 0 25px 25px 0;
            padding: 13px 20px;
            margin-left: -1px;
            transition: background-color 0.3s;
        }

        .search-btn {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        .search-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .reset-btn {
            background-color: #e74c3c;
            color: white;
            border: 1px solid #e74c3c;
        }

        .reset-btn:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
    </style>
</head>

<body>
    <?php include 'template/nav-bar.php'; ?>

    <section class="home-slider owl-carousel" style="height: 400px;">
        <div class="slider-item" style="background-image: url('images/order1.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center">
                    <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
                        <p class="breadcrumbs">
                            <span class="mr-2"><a href="index.php">Home</a></span>
                            <span>Food Order</span>
                        </p>
                        <h1 class="mb-3">Order Your Favorite Food</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Menu</span>
                    <h2>Explore Our Delicious Menu</h2>
                </div>
            </div>

            <!-- Search bar -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 text-center">
                    <form method="POST" action="" id="search-form">
                        <div class="input-group">
                            <input type="text" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>" class="form-control search-input" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn search-btn">Search</button>
                                <?php if (!empty($search)): // Show "X" icon only if there's a search term ?>
                                <button type="button" class="btn reset-btn" id="reset-search" title="Reset Search">
                                    <span>&times;</span> 
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 dish-menu">
                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()) { 
                            $item_name = $row['item_name'];
                            $price = $row['price'];
                            $image = $row['image']; // Assuming the image filename is stored in the 'image' column
                            $madeby = $row['madeby'];
                            $food_type = $row['food_type'];
                            $cuisine_type = $row['cuisine_type'];
                        ?>
                        <div class="col-md-4 ftco-animate">
                            <div class="menu-item-card">
                                <div class="image-container">
                                    <img src="dashboard/item-image/<?php echo $image; ?>" alt="<?php echo $item_name; ?>">
                                </div>
                                <div class="menu-info">
                                    <h3><?php echo $item_name; ?></h3>
                                    <p>Made by: <?php echo $madeby; ?></p>
                                    <p>Cuisine: <?php echo $cuisine_type; ?></p>
                                    <p>Type: <?php echo $food_type; ?></p>
                                    <h4 class="price">$<?php echo $price; ?></h4>
                                    <input type="number" id="quantity-<?php echo $item_name; ?>" value="1" min="1" style="width: 60px; margin-bottom: 10px;">
                                    <button class="btn btn-primary order-btn" onclick="addToCart('<?php echo $item_name; ?>', <?php echo $price; ?>, document.getElementById('quantity-<?php echo $item_name; ?>').value)">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'template/instagram.php'; ?>
    <?php include 'template/footer.php'; ?>
    <?php include 'template/script.php'; ?>

    <script>
        function addToCart(itemName, price, quantity) {
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart',
                text: quantity + ' x ' + itemName + ' has been added to your cart!',
                showConfirmButton: false,
                timer: 1500
            });
        }

        // Reset search functionality
        document.getElementById('reset-search').onclick = function() {
            // Reset the search input
            document.querySelector('input[name="search"]').value = '';
            // Submit the form to reload the page
            document.getElementById('search-form').submit();
        };
    </script>
</body>

</html>
