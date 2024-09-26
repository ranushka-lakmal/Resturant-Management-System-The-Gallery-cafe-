<?php 
session_start();
include 'template/header.php'; 

if (!isset($_SESSION['isLoggedIn'])) {
    echo '<script>window.location="login.php"</script>';
    exit;
}
?>
<body>
<section class="body">

    <!-- start: header -->
    <?php include 'template/top-bar.php'; ?>
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <?php include 'template/left-bar.php'; ?>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Food Menu</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.php">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Food Menu</span></li>
                        <li><span>Add Menu</span></li>
                    </ol>

                    <a class="sidebar-right-toggle" data-open="sidebar-right"></a>
                </div>
            </header>

            <!-- start: page -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form action="manage-insert.php" method="POST" enctype="multipart/form-data">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Menu Item</h2>
                                <p class="panel-subtitle">
                                    To add a <code>Menu Item</code>, please fill out all fields.
                                </p>
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Item Name</label>
                                            <input type="text" name="itemname" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Price</label>
                                            <input type="number" name="price" class="form-control" required min="0" step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Food Made By</label>
                                            <textarea class="form-control" name="madeby" rows="1" id="textareaDefault"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Food Type</label>
                                            <select id="areaDropdown" class="form-control populate" name="food_type" required>
                                                <option value=""> -Select- </option>
                                                <option value="Main Cuisine">Main Cuisine</option>
                                                <option value="Dessert">Dessert</option>
                                                <option value="Drink">Drink</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Cuisine Type</label>
                                            <select id="cousinTypeDropdown" class="form-control populate" name="cuisine_type" required>
                                                <option value=""> -Select- </option>
                                                <option value="Srilankan">Sri-Lankan</option>
                                                <option value="Chinese">Chinese</option>
                                                <option value="Italian">Italian</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" name="image" class="form-control" id="imageInput" required accept="image/*">
                                            <img id="imagePreview" src="" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%; height:auto;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <input type="submit" name="addItem" class="btn btn-primary" value="Add Item">
                            </footer>
                        </section>
                    </form>    
                </div>
            </div>
            <!-- end: page -->
        </section>
    </div>

    <?php include 'template/right-bar.php'; ?>
</section>


<!-- Vendor Scripts -->
<script src="assets/vendor/jquery/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="assets/vendor/select2/select2.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="assets/javascripts/theme.init.js"></script>

<!-- Custom Script to enable/disable Cuisine Type -->
<script>
    document.getElementById('areaDropdown').addEventListener('change', function() {
        var areaValue = this.value;
        var cousinDropdown = document.getElementById('cousinTypeDropdown');

        cousinDropdown.disabled = areaValue !== 'Main Cuisine'; // Enable/disable cuisine type dropdown based on area selection
        if (cousinDropdown.disabled) {
            cousinDropdown.value = ''; // Clear selection when disabled
        }
    });

    // Trigger change event on page load to ensure dropdown is set correctly
    document.getElementById('areaDropdown').dispatchEvent(new Event('change'));

    // Image preview functionality
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the preview
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>