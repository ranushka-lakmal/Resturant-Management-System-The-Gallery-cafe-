<?php
// Assuming $con is your database connection

// Pagination settings
$limit = 12; // Number of items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Main Cuisine Pagination
$totalQueryMain = "SELECT COUNT(*) as total FROM `menu_item` WHERE food_type = 'Main Cuisine'";
$totalResultMain = $con->query($totalQueryMain);
$totalItemsMain = $totalResultMain->fetch_assoc()['total'];
$totalPagesMain = ceil($totalItemsMain / $limit);

// Dessert Pagination
$totalQueryDessert = "SELECT COUNT(*) as total FROM `menu_item` WHERE food_type = 'Dessert'";
$totalResultDessert = $con->query($totalQueryDessert);
$totalItemsDessert = $totalResultDessert->fetch_assoc()['total'];
$totalPagesDessert = ceil($totalItemsDessert / $limit);

// Drink Pagination
$totalQueryDrink = "SELECT COUNT(*) as total FROM `menu_item` WHERE food_type = 'Drink'";
$totalResultDrink = $con->query($totalQueryDrink);
$totalItemsDrink = $totalResultDrink->fetch_assoc()['total'];
$totalPagesDrink = ceil($totalItemsDrink / $limit);
?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Menu</span>
                <h2>Discover Our Menu</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dish-menu">

                <!-- Navigation for Tabs -->
                <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" onclick="resetCuisineSelection()">
                        <span class="flaticon-meat"></span> Main
                    </a>
                    <a class="nav-link py-3 px-4" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" onclick="resetCuisineSelection('dessert')">
                        <span class="flaticon-cutlery"></span> Dessert
                    </a>
                    <a class="nav-link py-3 px-4" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" onclick="resetCuisineSelection('drink')">
                        <span class="flaticon-cheers"></span> Drinks
                    </a>
                </div>

                <!-- Tab Content for Each Menu -->
                <div class="tab-content py-5" id="v-pills-tabContent">

                    <!-- Main Menu -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <!-- Dropdown for Cuisine Types -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle py-3 px-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Cuisine
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" onclick="filterCuisine('Srilankan', event)">Sri Lankan</a>
                                        <a class="dropdown-item" href="#" onclick="filterCuisine('Chinese', event)">Chinese</a>
                                        <a class="dropdown-item" href="#" onclick="filterCuisine('Italian', event)">Italian</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Main dishes content -->
                            <?php
                            $sql2 = "SELECT * FROM `menu_item` WHERE food_type = 'Main Cuisine' LIMIT $limit OFFSET $offset";
                            $result2 = $con->query($sql2);
                            if ($result2->num_rows > 0) {
                                while ($r2 = $result2->fetch_assoc()) {
                            ?>
                                    <div class="col-lg-6 cuisine-<?php echo strtolower($r2['cuisine_type']); ?>">
                                        <div class="menus d-flex ftco-animate">
                                            <div class="menu-img" style="background-image: url(dashboard/item-image/<?php echo $r2['image']; ?>);"></div>
                                            <div class="text d-flex">
                                                <div class="one-half">
                                                    <h3><?php echo $r2['item_name']; ?></h3>
                                                    <p><span><?php echo $r2['madeby']; ?></span></p>
                                                </div>
                                                <div class="one-forth">
                                                    <span class="price">LKR <?php echo $r2['price']; ?></span><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p>No main cuisine items found.</p>";
                            }
                            ?>
                        </div>

                        <!-- Pagination Controls for Main -->
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $totalPagesMain; $i++): ?>
                                            <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $totalPagesMain): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Dessert Menu -->
<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="row">
        <!-- Dessert items content -->
        <?php
        $sqlDessert = "SELECT * FROM `menu_item` WHERE food_type = 'Dessert' LIMIT $limit OFFSET $offset"; 
        $resultDessert = $con->query($sqlDessert);
        if ($resultDessert->num_rows > 0) {
            while ($rDessert = $resultDessert->fetch_assoc()) {
        ?>
                <div class="col-lg-6">
                    <div class="menus d-flex ftco-animate">
                        <div class="menu-img" style="background-image: url(dashboard/item-image/<?php echo $rDessert['image']; ?>);"></div>
                        <div class="text d-flex">
                            <div class="one-half">
                                <h3><?php echo $rDessert['item_name']; ?></h3>
                                <p><span><?php echo $rDessert['madeby']; ?></span></p>
                            </div>
                            <div class="one-forth">
                                <span class="price">LKR <?php echo $rDessert['price']; ?></span><br>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>No dessert items found.</p>";
        }
        ?>
    </div>

    <!-- Pagination Controls for Dessert -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($totalItemsDessert > $limit): ?>
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPagesDessert; $i++): ?>
                            <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPagesDessert): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>


                    <!-- Drink Menu -->
<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <div class="row">
        <!-- Drink items content -->
        <?php
        $sqlDrink = "SELECT * FROM `menu_item` WHERE food_type = 'Drink' LIMIT $limit OFFSET $offset"; 
        $resultDrink = $con->query($sqlDrink);
        if ($resultDrink->num_rows > 0) {
            while ($rDrink = $resultDrink->fetch_assoc()) {
        ?>
                <div class="col-lg-6">
                    <div class="menus d-flex ftco-animate">
                        <div class="menu-img" style="background-image: url(dashboard/item-image/<?php echo $rDrink['image']; ?>);"></div>
                        <div class="text d-flex">
                            <div class="one-half">
                                <h3><?php echo $rDrink['item_name']; ?></h3>
                                <p><span><?php echo $rDrink['madeby']; ?></span></p>
                            </div>
                            <div class="one-forth">
                                <span class="price">LKR <?php echo $rDrink['price']; ?></span><br>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>No drink items found.</p>";
        }
        ?>
    </div>

    <!-- Pagination Controls for Drinks -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($totalItemsDrink > $limit): ?>
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPagesDrink; $i++): ?>
                            <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPagesDrink): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>


                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function filterCuisine(cuisine, event) {
        event.preventDefault();
        // Logic to filter items based on selected cuisine
        const allItems = document.querySelectorAll('.tab-pane .col-lg-6');
        allItems.forEach(item => item.style.display = 'none');

        const selectedCuisineItems = document.querySelectorAll(`.tab-pane .cuisine-${cuisine.toLowerCase()}`);
        selectedCuisineItems.forEach(item => item.style.display = 'block');

        // Reset dropdown button text
        const dropdownButton = document.getElementById('dropdownMenuButton');
        dropdownButton.innerText = cuisine; // Set to selected cuisine
    }

    function resetCuisineSelection(type = '') {
        const allItems = document.querySelectorAll('.tab-pane .col-lg-6');
        allItems.forEach(item => item.style.display = 'block');

        // Reset the active cuisine filter in the dropdown
        const dropdownButton = document.getElementById('dropdownMenuButton');
        dropdownButton.innerText = "Select Cuisine"; // Reset button text
    }
</script>
