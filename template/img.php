<style>
  .instagram {
    background-color: #f9f9f9;
    padding: 60px 0;
}

.instagram .heading-section h2 {
    font-size: 36px;
    color: #333;
    margin-bottom: 20px;
    position: relative;
}

.instagram .heading-section h2 span {
    position: relative;
    display: inline-block;
}

.instagram .heading-section h2 span::after {
    content: '';
    display: block;
    height: 3px;
    width: 60px;
    background: #ff5e14; /* Change this color as needed */
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.insta-img {
    position: relative;
    overflow: hidden;
    border-radius: 10px; /* Rounded corners */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.insta-img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.insta-img .icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.insta-img:hover .icon {
    opacity: 1; /* Show icon on hover */
}

.icon-instagram {
    font-size: 40px; /* Adjust icon size */
    color: #fff; /* Change icon color */
    transition: transform 0.3s ease;
}

.insta-img:hover .icon-instagram {
    transform: scale(1.2); /* Slightly enlarge icon on hover */
}

/* Optional: Add media queries for responsive design */
@media (max-width: 768px) {
    .instagram .heading-section h2 {
        font-size: 28px;
    }
    .icon-instagram {
        font-size: 30px; /* Adjust icon size for smaller screens */
    }
}

</style>
<section class="instagram">
    <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
              <h2><span>Our Gallery</span></h2>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-1.jpg" class="insta-img image-popup" style="background-image: url(images/insta-1.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-2.jpg" class="insta-img image-popup" style="background-image: url(images/insta-2.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-3.jpg" class="insta-img image-popup" style="background-image: url(images/insta-3.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-4.jpg" class="insta-img image-popup" style="background-image: url(images/insta-4.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ftco-animate">
                <a href="images/insta-5.jpg" class="insta-img image-popup" style="background-image: url(images/insta-5.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="icon-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
