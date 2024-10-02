<?php
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== TRUE) {
    echo '<script>alert("You must be logged in to order food."); window.location.href="login.php";</script>';
    exit();
}

// Database connection
include 'dbCon.php';
$con = connect();

// Handle search
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Fetch all food items from the menu_item table, filtered by search
$sql = "SELECT * FROM `menu_item` WHERE `item_name` LIKE '%$search%' ORDER BY FIELD(food_type, 'Main Cuisine', 'Dessert', 'Drink')";
$result = $con->query($sql);

// Fetch user details from the session
$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];
$user_phone = $_SESSION['phone'];


?>

<?php include 'template/header.php'; ?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

        .nav-tabs .nav-link {
            transition: all 0.3s ease;
            border: none;
            color: #fff;
            background-color: #2c3e50;
        }

        .nav-tabs .nav-link.active {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>

<body>
    <?php include 'template/nav-bar.php'; ?>

    <section class="home-slider owl-carousel" style="height: 400px;">
        <div class="slider-item" style="background-image: url('images/order1.jpg');"
            data-stellar-background-ratio="0.5">
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




            <!-- Menu tabs -->
            <ul class="nav nav-tabs justify-content-center" id="menuTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="main-cuisine-tab" data-toggle="tab" href="#main-cuisine" role="tab"
                        aria-controls="main-cuisine" aria-selected="true">Main Cuisine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dessert-tab" data-toggle="tab" href="#dessert" role="tab"
                        aria-controls="dessert" aria-selected="false">Dessert</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="drink-tab" data-toggle="tab" href="#drink" role="tab" aria-controls="drink"
                        aria-selected="false">Drink</a>
                </li>
            </ul>

            <br>
            <div class="tab-content" id="menuTabContent">
                <!-- Search bar -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8 text-center">
                        <form method="POST" action="" id="search-form">
                            <div class="input-group">
                                <input type="text" name="search" placeholder="Search by name"
                                    value="<?php echo htmlspecialchars($search); ?>" class="form-control search-input"
                                    required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn search-btn">Search</button>
                                    <?php if (!empty($search)): ?>
                                        <button type="button" class="btn reset-btn" id="reset-search" title="Reset Search">
                                            <span>&times;</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="main-cuisine" role="tabpanel"
                    aria-labelledby="main-cuisine-tab">
                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()) {
                            if ($row['food_type'] === 'Main Cuisine') {
                                echo renderMenuItem($row);
                            }
                        } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="dessert" role="tabpanel" aria-labelledby="dessert-tab">
                    <div class="row">
                        <?php mysqli_data_seek($result, 0); // Reset result pointer
                        while ($row = $result->fetch_assoc()) {
                            if ($row['food_type'] === 'Dessert') {
                                echo renderMenuItem($row);
                            }
                        } ?>

                    </div>
                </div>
                <div class="tab-pane fade" id="drink" role="tabpanel" aria-labelledby="drink-tab">
                    <div class="row">
                        <?php mysqli_data_seek($result, 0);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['food_type'] === 'Drink') {
                                echo renderMenuItem($row);
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
    <div class="row">
        <!-- Left panel for cart -->
        <div class="col-md-4">
    <h3>Your Cart</h3>
    <div id="cart-items" style="background-color: #f8f9fa; padding: 15px; border-radius: 10px;">
        <p id="empty-cart-msg">Your cart is empty.</p>
        <ul id="cart-list" class="list-group"></ul>
        <div id="cart-total" style="margin-top: 20px;">
            <h5>Total: $<span id="total-price">0.00</span></h5>
        </div>
        <button id="checkout-btn" class="btn btn-success" style="display: none;">Checkout</button> <!-- The checkout button -->
    </div>
</div>


        <!-- Right panel for menu items -->
        <div class="col-md-8">
            <!-- Your existing menu item code -->
            <div class="tab-content" id="menuTabContent">
                <!-- The rest of your tabs code goes here -->
            </div>
        </div>
    </div>
</div>
    </section>





    <?php include 'template/instagram.php'; ?>
    <?php include 'template/footer.php'; ?>
    <?php include 'template/script.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

        document.getElementById('reset-search').onclick = function () {
            document.querySelector('input[name="search"]').value = '';
            document.getElementById('search-form').submit();
        };
    </script>

    <script>
        let cart = [];  // This will store the items in the cart
        let totalPrice = 0;  // To keep track of the total price

        // Function to add item to the cart
        function addToCart(itemName, price, quantity) {
    quantity = parseInt(quantity);  // Ensure quantity is a number

    // Check if item is already in the cart
    const existingItem = cart.find(item => item.name === itemName);

    if (existingItem) {
        existingItem.quantity += quantity;  // Increase the quantity
    } else {
        cart.push({ name: itemName, price: parseFloat(price), quantity: quantity });
    }

    // Update total price
    totalPrice += parseFloat(price) * quantity;

    // Update cart display
    updateCartDisplay();

    // Show success message
    Swal.fire({
        icon: 'success',
        title: 'Added to Cart',
        text: quantity + ' x ' + itemName + ' has been added to your cart!',
        showConfirmButton: false,
        timer: 1500
    });
}

        // Function to remove item from the cart
        function removeFromCart(index) {
            const removedItem = cart.splice(index, 1)[0];  // Remove the item from the cart
            totalPrice -= removedItem.price * removedItem.quantity;  // Update the total price

            updateCartDisplay();  // Update the cart display
        }

        // Function to update the cart display
        function updateCartDisplay() {
    const cartList = document.getElementById('cart-list');
    const totalPriceElement = document.getElementById('total-price');
    const emptyCartMsg = document.getElementById('empty-cart-msg');
    const checkoutBtn = document.getElementById('checkout-btn');

    cartList.innerHTML = '';  // Clear the cart list

    // If cart is empty
    if (cart.length === 0) {
        emptyCartMsg.style.display = 'block';
        checkoutBtn.style.display = 'none';
    } else {
        emptyCartMsg.style.display = 'none';
        checkoutBtn.style.display = 'block';  // Show the checkout button

        // Loop through the cart and display each item
        cart.forEach((item, index) => {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.innerHTML = `
            ${item.quantity} x ${item.name} - $${item.price.toFixed(2)}
            <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">&times;</button>
        `;
            cartList.appendChild(listItem);
        });
    }

    // Update the total price display
    totalPriceElement.textContent = totalPrice.toFixed(2);
}

    </script>

    <!-- Add this JS function to handle checkout -->
    <!-- Ensure jQuery is loaded before your custom scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    window.onload = function() {
        document.getElementById('checkout-btn').onclick = checkoutCart;
    };

    function checkoutCart() {
    if (cart.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Your cart is empty',
            text: 'Please add items to the cart before checking out.',
        });
        return;
    }

    const cartData = {
        customer_name: "<?php echo $user_name; ?>",
        customer_email: "<?php echo $user_email; ?>",
        customer_phone: "<?php echo $user_phone; ?>",
        items: cart  // Include items with quantity
    };

    $.ajax({
        url: 'checkout.php',
        method: 'POST',
        data: JSON.stringify(cartData),
        contentType: 'application/json',
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Order placed successfully!',
                text: 'Thank you for your order!',
                confirmButtonText: 'OK'
            }).then(() => {
                cart = [];
                totalPrice = 0;
                updateCartDisplay();
            });
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Order failed',
                text: 'There was an error processing your order. Please try again.',
            });
        }
    });
}

</script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {
        // Now you can use $jq instead of $ to avoid conflicts
        $jq.ajax({
            url: 'checkout.php',
            method: 'POST',
            data: JSON.stringify(cartData),
            contentType: 'application/json',
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>



</body>

</html>

<?php
function renderMenuItem($row)
{
    $item_name = $row['item_name'];
    $price = $row['price'];
    $image = $row['image'];
    $madeby = $row['madeby'];
    $food_type = $row['food_type'];
    $cuisine_type = $row['cuisine_type'];

    return '
    <div class="col-md-4 ftco-animate">
        <div class="menu-item-card">
            <div class="image-container">
                <img src="dashboard/item-image/' . $image . '" alt="' . $item_name . '">
            </div>
            <div class="menu-info">
                <h3>' . $item_name . '</h3>
                <p>Made By: ' . $madeby . '</p>
                <p>Cuisine: ' . $cuisine_type . '</p>
                <p class="price">$' . $price . '</p>
                <button class="order-btn" onclick="addToCart(\'' . $item_name . '\', \'' . $price . '\', 1)">Order Now</button>
            </div>
        </div>
    </div>';
}
?>