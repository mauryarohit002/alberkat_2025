<?php $this->load->view('templates/temp_header_1') ?>

<style>

:root {
    --bg-copper-rose: #9C6f69;
    --bg-umber: #5E503F;
    --bg-turkish-rose: #AE827F;
    --bg-fuzzzy-wuzzy: #C9766E;
}

.bg-um {
    background: var(--bg-umber);
}

.bg-fw {
    background: var(--bg-fuzzzy-wuzzy);
}

.txt-um {
    color: var(--bg-umber);
}

.txt-tr {
    color: var(--bg-turkish-rose);
}

.txt-fw {
    color: var(--bg-fuzzzy-wuzzy);
}

.bg-tr {
    background: var(--bg-turkish-rose);
}

.border-tr {
    border-color: var(--bg-turkish-rose) !important;
}

.border-fw {
    border-color: var(--bg-fuzzzy-wuzzy) !important;
}

.bg-cr {
    background: var(--bg-copper-rose);
}

.ff-ko {
    font-family: Koara Font;
}

.ff-ko-r {
    font-family: Koara Font Regular;
}

.ff-ls {
    font-family: "League Spartan", sans-serif;
}

@media (min-width: 1480px) {
    .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
        max-width: 1420px;
        margin: 0 auto;
    }
}

.banner {
    background: #9C6F69;
    height: 580px;
    padding: 0;
    margin: 0;
    position: relative;
    bottom: -40px;
}

.banner-padding {
    padding-bottom: 150px;
}

.banner-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
}

.banner-text h1 {
    font-family: Koara Font;
    font-size: 79px;
    text-align: center;
    font-weight: 700;
}

p {
    font-family: "League Spartan", sans-serif;
}

.banner-home-second {
    background: url(<?php echo assets('images/banner-2.webp')?>);
    background-size: cover;
    height: auto;
    position: relative;
    /*	top: -40px;*/
}

.banner-cr {
    background: url(<?php echo assets('images/banner-cr.webp')?>);
    background-size: auto;
    height: auto;
    position: relative;
}

.banner-crb {
    background: url(<?php echo assets('images/banner-cr.webp')?>) bottom;
    background-size: cover;
    height: auto;
    position: absolute;
    top: 98%;
    z-index: 3;
    width: 100%;
}

.banner-cenb {
    background: url(<?php echo assets('images/center-achivements-bottom.webp')?>) bottom;
    background-size: cover;
    height: auto;
    position: absolute;
    top: 98%;
    z-index: 3;
    width: 100%;
}

a {
    text-decoration-line: none;
}

.lst-5 {
    letter-spacing: 1.5px;
}

ul.nav.navbar-nav li a {
    text-align: left;
    padding: 9px;
}

ul.nav.navbar-nav li a i {
    position: absolute;
    right: 15px;
}

@keyframes move360 {
    100% {
        transform: rotate(360deg);
    }
}

@keyframes move30 {
    50% {
        transform: rotate(-30deg);
    }
}

.dropdown-item:focus, .dropdown-item:hover {
    color: var(--bs-dropdown-link-hover-color);
    background-color: #373b3e;
}

.dropdown-toggle::after {
    content: '\f078';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    display: inline-block;
    margin: 0;
    vertical-align: 0;
    border: 0;
    font-size: 20px;
    color: #fff;
    right: 4px;
}




	div#menu-icons .btn {
		z-index: 9;
		position: relative;
	}
	.bg-first-head {
		background: url(<?php echo assets('images/our-story.webp')?>);
		background-size: contain;
		background-repeat: no-repeat;
		height: 80vh;
		position: relative;
		width: 100%;
		top: 0px;
	}
	.title-h1 span.start-icons {
		position: relative;
		bottom: 35px;
		left: 20px;
	}
	.title-h1 span.end-icons {
		position: relative;
		top: 25px;
		right: 20px;
	}
	.bell-icons {
		top: 20px;
		right: 70px;
	}
	.leaf-icons {
		width: 3%;
		position: absolute;
		right: 3%;
		bottom: 40%;
	}
	.icon-top-last-section {
		top: -4%;
		left: 0;
	}

	@media(min-width: 992px) {
		.d-m-padding {
			padding-top: 11%;
			width: 75%;
		}
		.d-m-padding h1 {
			left: -5.5%;
		}
		.top-icons-sci {
			top: 28%;
			right: 3%
		}
		section.banner-home-second {
			background-size: cover;
		}
	}
	@media (min-width: 786px) and (max-width:1100px) {
		.container,
		.container-md,
		.container-sm {
			max-width: 95%;
			margin: 0 auto;
		}
		.d-m-padding {
			padding-top: 8%;
			width: 75%;
		}
		.bg-first-head {
			height: auto;
		}
		.position-absolute.top-icons-sci {
			position: absolute;
			right: 0;
			top: 15%;
		}
		.banner-home-second {
			background-size: cover;
		}
	}
	@media(min-width:1480px) {
		.d-m-padding {
			padding-top: 12%;
			width: 80%;
		}
	}
	@media(max-width:786px) {
		.bg-first-head {
			height: auto;
		}
	}
	@media(max-width:786px) {
		.bg-first-head,
		.banner-crb {
			height: auto;
		}
		.top-icons-sci {
			right: 0;
			top: 20px;
			text-align: end;
		}
		.top-icons-sci img {
			width: 50%;
		}
		.d-m-padding {
			padding-top: 50px;
		}
		.title-h1 span.end-icons img,
		.title-h1 span.start-icons img {
			width: 25px;
		}
		.title-h1 span.start-icons img {
			transform: rotate(30deg);
		}
		.title-h1 span.end-icons {
			top: 10px;
			right: 12px;
		}
		.title-h1 span.start-icons {
			bottom: 15px;
			left: 13px;
		}
		.bell-icons {
			top: 5px;
			right: 15px;
		}
		.bell-icons img {
			width: 55% !important;
		}
		.icon-top-last-section {
			display: none;
		}
	}
@media(min-width: 680px){
	.navbar-nav{
        flex-direction: unset;
	}
}
@media(max-width: 680px){
.navbar-header {
    width: 100%;
}
}
</style>
<!--<div class="position-absolute top-0 w-100">-->
<!--	<img src="<?php echo assets('images/about-us.webp')?>" alt="About Us" class="w-100 d-none d-md-block">-->
<!--	<img src="<?php echo assets('images/about-us-mobile.webp')?>" alt="About Us" class="w-100 d-block d-md-none">-->
<!--</div>-->
<main>
	<section class="">
		<div class="position-relative">
			<div class="bg-first-head">
				<div class="position-absolute top-icons-sci"><img src="<?php echo assets('images/science-library.webp')?>" alt="icons"></div>
				<div class="container d-m-padding pb-md-5">
					<!--<p class="txt-tr"><a href="index.php" class="txt-tr">HOME</a> <i class="fas fa-long-arrow-alt-right"></i> <a href="about-us.php" class="txt-tr">ABOUT US</a></p>-->
					<div class="d-none d-md-block">
						<h1 class="ff-ko display-4 mb-3 title-h1 position-relative" style="color: #5E503F;"><span class="start-icons"><img src="<?php echo assets('images/title-start.svg')?>"></span>A SMALL OVERVIEW<span class="end-icons"><img src="<?php echo assets('images/title-end.svg')?>"></span></h1>
					</div>
					<div class="d-block d-md-none">
						<h1 class="ff-ko fs-1 mb-3 title-h1 text-center position-relative" style="color: #5E503F;"><span class="start-icons"><img src="<?php echo assets('images/title-start.svg')?>"></span>A SMALL OVERVIEW<span class="end-icons"><img src="<?php echo assets('images/title-end.svg')?>"></span></h1>
					</div>
					<p class="ff-1s txt-tr fs-5">OUR STORY</p>
					<p class="ff-1s txt-tr fs-5">1.	The Rehbar Foundation established in the year 2000 is registered under the Bombay Public Trust Act. It has successfully created a strong imprint of its ideology through the Al-Barkaat Malik Muhammad Islam English School. </p>
					<p class="ff-1s txt-tr fs-5">The Rehbar Foundation is one of the most dedicated charitable trusts working towards 360-degree development and up-bringing the future leaders through Quality Education. With the aim of providing Quality Education for Students alongside extracurricular facilities, The Al-Barkaat Malik Muhammad Islam English School operates under the patronage of the Rehbar Foundation to achieve its aim of Educating Students for Better Tomorrow.</p>
				</div>
			</div>
		</div>
	</section>
	<!--	<section class="banner-home-second bottom-campus">-->
	<section class="banner-home-second">
		<div class="position-relative">
			<span class="position-absolute d-none d-md-block" style="top: 20px;left: 1%;transform: rotate(65deg);"><img src="<?php echo assets('images/science-library.webp')?>" alt="icons"></span>
		</div>
		<div class="container">
			<div class="row gx-0 pt-md-5 align-items-center">
				<div class="col-md-6 mt-5 my-md-5 mt-md-5 pt-md-5" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
					<img src="<?php echo assets('images/welcome.webp')?>" alt="Welcome To Our School" class="w-100">
				</div>
				<div class="col-md-6 ps-md-5">
					<h2 class="text-white ff-ko display-1 mb-2 mb-md-3">Welcome to<br> Our School</h2>
				</div>
			</div>
			<div class="row gx-0 align-items-center">
				<div class="col-md-6 ps-md-5 order-2 order-md-1">
					<h2 class="text-white ff-ko display-2 mb-2 mb-md-3">Giving Wings<br> to Education</h2>
					<p class="text-white pe-md-5 fs-5">A good education is always a boon to mankind! Since 2006, Al-Barkaat Malik Muhammad Islam English School has been providing education to more than 5500 students. The school is affiliated with the Central Board of Secondary Education (C.B.S.E) in Delhi and is equipped with state-of-the-art 40 AV classrooms together with Modern Science Lab &Hi-Tech Computer Lab to ensure Creative Learning.</p>
				</div>
				<div class="col-md-6 my-2 my-md-5 order-1 order-md-2" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
					<img src="<?php echo assets('images/giving-wings-of-education.webp')?>" alt="Giving Wings of Education" class="w-100">
				</div>
			</div>
		</div>
		<div class="position-relative d-none d-md-block">
			<img src="<?php echo assets('images/send-icon.webp')?>" alt="send icon" class="position-absolute bottom-0" style="left: 5px;width:10%;">
		</div>
	</section>
	<section class="">
		<div class="position-relative">
			<div class="position-absolute bell-icons">
				<img src="<?php echo assets('images/bell-icons.webp')?>" alt="bell icons" class="w-100">
			</div>
			<div class="container">
				<div class="row gx-0 pt-md-5 align-items-center">
					<div class="col-md-6 mt-5 my-md-5  mt-md-5 pt-md-5" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
						<img src="<?php echo assets('images/integrating-unity-through-sports.webp')?>" alt="Integrating Unity Through Sports" class="w-100">
					</div>
					<div class="col-md-6 ps-md-5">
						<h2 class="txt-tr ff-ko display-2 mb-2 mb-md-3">Integrating Unity<br> Through Sports</h2>
						<p class="txt-tr pe-md-5 fs-5 mb-1">Sports build both body and mind. Al-Barkaat Malik Muhammad Islam English School is well renowned within the school fraternity for its outstanding contributions to various sports, such as Cricket, Foot-Ball,Carrom & Table-Tennis. Over the years, the school has received numerous awards in both indoor & out-door games, including but not limited to the Harris Shield, Giles Shield, and Coca-Cola Cup. We train young talent under the tutelage of professional coaches who monitor their growth and development.</p>
					</div>
				</div>
				<div class="leaf-icons"><img src="<?php echo assets('images/leaf-right-side.webp')?>" alt="Leaf Right" class="w-100"></div>
				<div class="row gx-0 align-items-center">
					<div class="col-md-6 ps-md-5 order-2 order-md-1">
						<h2 class="txt-tr ff-ko display-2 mb-2 mb-md-3">Technology is<br> For All</h2>
						<p class="txt-tr pe-md-5 fs-5">We believe in technological evolution and are prepared to stand strong for a technological revolution. The Rehbar Foundation integrates the spirit of e-learning through the latest &smart technology.  The Al-Barkaat Malik Muhammad Islam English School, equipped with futuristic Educational Smart Board Panels under the CCTV surveillance in Classrooms to succeed in this fast-moving world. The e-learning module at Al-Barkaat Malik Muhammad Islam English School was introduce to help students Learn, Unlearn, and Relearn.</p>
					</div>
					<div class="col-md-6 my-2 my-md-5 order-1 order-md-2" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
						<img src="<?php echo assets('images/technology-is-for-all.webp')?>" alt="Technology is For All" class="w-100">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--	<section class="banner-home-second bottom-campus">-->
	<section class="banner-home-second">
		<div class="banner-cenb"></div>
		<div class="container">
			<div class="row gx-0 pt-md-5 align-items-center">
				<div class="col-md-6 mt-5 my-md-5 mt-md-5 pt-md-5" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
					<img src="<?php echo assets('images/the-innovative-click.webp')?>" alt="The Innovative Click" class="w-100">
				</div>
				<div class="col-md-6 ps-md-5">
					<h2 class="text-white ff-ko display-2 mb-2 mb-md-3">The Innovative<br> Click</h2>
					<p class="text-white pe-md-5 fs-5 mb-1">Al-Barkaat Malik Muhammad Islam English School is equipped withHigh-Tech Computer Lab installed with an in-depth Educational Softwareto upskillstudents to learn an advanced version of their current syllabus. Learning their syllabus through software gains confidence in students and makes them smarter and tech-savvy and prepares them to learn through Information-Technology System. The lab is enabled with modern technology with an aim to empower the students to foresee future technology.</p>
				</div>
			</div>
			<div class="row gx-0 align-items-center">
				<div class="col-md-6 ps-md-5 order-2 order-md-1">
					<h2 class="text-white ff-ko display-2 mb-2 mb-md-3">Creating<br> Strong Paths</h2>
					<p class="text-white pe-md-5 fs-5">Guidance provides a pathway that leads to SUCCESS! The Rehbar Foundation conducts regular seminar on career counseling, helping students choose the right direction for their careers. Al-Barkaat Malik Muhammad Islam English School has an excellent panel of professional and motivators to discover the potential and aptitude of its students. The school aims not only to develop the students studying at Al-Barkaat Malik Muhammad Islam English School but also to support other needy students </p>
				</div>
				<div class="col-md-6 my-2 my-md-5 order-1 order-md-2" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
					<img src="<?php echo assets('images/creating-strong-paths.webp')?>" alt="Creating Strong Paths for Students" class="w-100">
				</div>
			</div>
		</div>
		<div class="position-relative d-none d-md-block" style="position: relative; z-index: 3;">
			<img src="<?php echo assets('images/secondary-students-count.webp')?>" alt="heart icon" class="position-absolute" style="top: 10px; right: 0; width: 10%;">
		</div>
		<div class="container">
			<div class="row gx-0 align-items-center">
				<div class="col-md-6 my-2 my-md-5" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
					<img src="<?php echo assets('images/the-reading-bank.webp')?>" alt="The Reading Bank" class="w-100">
				</div>
				<div class="col-md-6 ps-md-5">
					<h2 class="text-white ff-ko display-2 mb-2 mb-md-3">The Reading<br> Bank</h2>
					<p class="text-white pe-md-5 fs-5">A book is the best friend of everyone. Rehbar Foundation enhances the quality of education for all students at Al-Barkaat Malik Muhammad Islam English School. The school has a fully equipped library, named HajianiAishabi Ghulam Nabi Library, which comrising approximately 25,000 books across all subjects. Additionally, Al-Barkaat Malik Muhammad Islam English School features state-of-the-art facilities, including a Digital Library that focuses on the concept of e-learning, with various subscriptions to e-books. A book truly is the best friend of everyone.</p>
				</div>
			</div>
		</div>
		<div class="position-relative d-none d-md-block" style="position: relative; z-index: 3;">
			<img src="<?php echo assets('images/heart.webp')?>" alt="heart icon" class="position-absolute" style="bottom: 20px; left: 5px; width: 3%;">
		</div>
		<div class="position-absolute icon-top-last-section top" style="">
			<img src="<?php echo assets('images/years-of-history.webp')?>" alt="Years of History" class="w-50">
		</div>
	</section>
</main>
 <script>
window.addEventListener('load', function() {
    var links = document.querySelectorAll('link[rel="stylesheet"]');
    links.forEach(function(link) {
        if (link.href.includes('bootstrap.min.css') && !link.href.includes('cdn.jsdelivr.net')) {
            link.parentElement.removeChild(link); // Remove Bootstrap 3.3.4
        }
    });
});
</script>
    <!-- jQuery 2.1.4 -->
    <script src="https://albarkaatadmissions.com/2025/public/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.js"></script>
</body>
</html>

