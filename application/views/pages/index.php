<?php
    $this->load->view('templates/temp_header');
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <style type="text/css">
        /** {
            margin: 0;
            padding: 0;
        }
        .imgbox {
            display: grid;
            height: 100%;
        }
        .center-fit {
            max-width: 100%;
            max-height: 100vh;
            margin: auto;
        }*/

        * {box-sizing:border-box}

        /* Slideshow container */
        .slideshow-container {
          max-width: 1000px;
          position: relative;
          margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
          display: none;
        }

        /* Next & previous buttons */
        .prev, .next {
          cursor: pointer;
          position: absolute;
          top: 50%;
          width: auto;
          margin-top: -22px;
          padding: 16px;
          color: white;
          font-weight: bold;
          font-size: 18px;
          transition: 0.6s ease;
          border-radius: 0 3px 3px 0;
          user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
          right: 0;
          border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
          background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
          color: #f2f2f2;
          font-size: 15px;
          padding: 8px 12px;
          position: absolute;
          bottom: 8px;
          width: 100%;
          text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
          color: #f2f2f2;
          font-size: 12px;
          padding: 8px 12px;
          position: absolute;
          top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
          cursor: pointer;
          height: 15px;
          width: 15px;
          margin: 0 2px;
          background-color: #bbb;
          border-radius: 50%;
          display: inline-block;
          transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
          background-color: #717171;
        }

/* Fading animation */
    </style>
   <!--  <div style="margin-top: -16px;" class="">
        <div id="carousel-example" class="carousel slide container-fluid" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item animated rotateInDownLeft active imgbox">
                    <a href="#"><img src="<?php echo assets('images/banner1.jpg')?>" class="center-fit" /></a>
                </div>
                <div class="item animated rotateInDownLeft">
                    <a href="#"><img src="<?php echo assets('images/banner21.jpg')?>" class="center-fit" /></a>
                </div>
                <div class="item animated rotateInDownLeft">
                    <a href="#"><img src="<?php echo assets('images/banner31.jpg')?>" class="center-fit" /></a>
                </div>
                <div class="item animated rotateInDownRight">
                    <a href="#"><img src="<?php echo assets('images/banner41.jpg')?>" class="center-fit" /></a>
                </div>
                <div class="item animated rotateInDownRight">
                    <a href="#"><img src="<?php echo assets('images/banner51.jpg')?>" class="center-fit" /></a>
                </div>
                <div class="item animated rotateInDownRight">
                    <a href="#"><img src="<?php echo assets('images/banner61.jpg')?>" class="center-fit" /></a>
                </div>
            </div>

            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div> -->

  <!-- Full-width images with number and caption text -->
    <div style="margin-top: -15px;">
      <div class="mySlides animated rotateInDownLeft">
        <img src="<?php echo assets('images/banner1.png')?>" style="width:100%">
      </div>

      <div class="mySlides animated rotateInDownRight">
        <img src="<?php echo assets('images/banner2.png')?>" style="width:100%">
      </div>

      <div class="mySlides animated rotateInDownLeft">
        <img src="<?php echo assets('images/banner3.png')?>" style="width:100%">
      </div>

      <div class="mySlides animated rotateInDownRight">
        <img src="<?php echo assets('images/banner4.png')?>" style="width:100%">
      </div>

      <div class="mySlides animated rotateInDownLeft">
        <img src="<?php echo assets('images/banner5.png')?>" style="width:100%">
      </div>

      <div class="mySlides animated rotateInDownRight">
        <img src="<?php echo assets('images/banner6.png')?>" style="width:100%">
      </div>

      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <!-- The dots/circles -->

    <script type="text/javascript">
        var slideIndex = 0;
        showSlides();

        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}
          slides[slideIndex-1].style.display = "block";
          setTimeout(showSlides, 3000); // Change image every 2 seconds
        }
    </script>
<?php
	$this->load->view('templates/temp_footer');
?>