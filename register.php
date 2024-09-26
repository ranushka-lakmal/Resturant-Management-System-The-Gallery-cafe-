<?php include 'template/header.php'; ?>
  <body>
    
    <?php include 'template/nav-bar.php'; ?>
    
    <section class="home-slider owl-carousel" style="height: 400px;">
      <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
              <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Register</span></p>
              <h1 class="mb-3">Register</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Register</span>
            <h2>Register In Our Site</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 dish-menu">

            <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="flaticon-meat"></span> Register as User</a>
            </div>

            <!--register as customer-->
            <div class="tab-content py-5" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-8">
                    <div class="menus d-flex ftco-animate" style="background: white;">
                      <div class="row" style="width: 100%">
                        <div class="col-md-12">
                          <!-- Register as User -->
                          <form action="manage-insert.php" method="POST" enctype="multipart/form-data">
                            <!-- Username -->
                            <div class="form-group">
                              <input type="text" name="username" class="form-control" required="" placeholder="Your Name">
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                              <input type="email" name="email" class="form-control" required="" placeholder="Your Email">
                            </div>
                            <!-- Phone -->
                            <div class="form-group">
                              <input type="text" name="phone" class="form-control" required="" placeholder="Your Phone">
                            </div>
                            <!-- Address -->
                            <div class="form-group">
                              <textarea name="address" cols="30" rows="2" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <!-- Gender -->
                            <div class="form-group">
                              <select name="gender" class="form-control" required="">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                              </select>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                              <input type="password" name="password" class="form-control" required="" placeholder="Your Password">
                            </div>
                            <!-- Submit Button -->
                            <div class="form-group">
                              <input type="submit" value="Register" name="regUser" class="btn btn-primary py-3 px-5">
                            </div>
                          </form>
                          <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- END -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include 'template/instagram.php'; ?>
    <?php include 'template/footer.php'; ?>
    <?php include 'template/script.php'; ?>
    
  </body>
</html>
