<!--
<section class="contact-form padding" id="contact">
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-9">
                       <div class="form">
                           <h2 class="heading">Our Products are Truly Majestic in Every Way</h2>
                            <h6>Ready to get started? Or just have questions?<br>Please reach out to us through this form, and we’ll be in touch shortly.</h6>
                            <div class="wrap half">
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="wrap half">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div class="wrap">
                                <input type="email" placeholder="Email">
                            </div>
                            <div class="wrap">
                                <input type="tel" placeholder="Phone Number">
                            </div>
                            <div class="wrap">
                                <textarea rows="3" placeholder="Message"></textarea>
                            </div>
                            <div class="wrap">
                                <button>Submit</button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            
        </section>
-->
        
        
        <footer>
            
            <div class="container">
                <div class="row">
                   <div class="col-12">
                       <div class="foot-text">
                           <img src="images/logo-white.png" class="footer-logo">
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                       </div>
                   </div>
                    <div class="col-12 col-md-4 col-lg-3">
                       <h3 class="footer-title">
                           Menu
                       </h3>
                        <div class="footer-menu">
                            <a href="index.html">Home</a>
                            <a href="about.html">Our Story</a>
                            <a href="why-agastya-stones.html">Why Us?</a>
                            <a href="products.html">Our Collection</a>
                            <a>Join Franchise</a>
                            <a href="contact.html">Reach Us</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                       <h3 class="footer-title">
                           Our Collection
                       </h3>
                        <div class="footer-menu">
                            <a>Quartz</a>
                            <a>Granite</a>
                            <a>Marble</a>
                            <a>Onyx</a>
                            <a>Quartzite</a>
                            <a>Semi Precious Stones</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                       <h3 class="footer-title">
                           Informational
                       </h3>
                        <div class="footer-menu">
                            <a href="resources.html">Resources</a>
                            <a href="warranty.html">Warranty</a>
                            <a href="care-maintenance.html">Care & Maintenance</a>
                            <a>Privacy Policy</a>
                            <a>Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </div>            

            <div class="bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                           <div class="footer-social-links">
                                <a><i class="fab fa-facebook-f"></i></a>
                                <a><i class="fab fa-instagram"></i></a>
                                <a><i class="fab fa-x-twitter"></i></a>
                                <a><i class="fab fa-pinterest-p"></i></a>
                            </div>
                            © Copyright 2023 Agastya Global Stones. <span class="d-inline-block">All Rights Reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </footer>
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        
        <script>
            AOS.init();
        </script>
        
       <script>
        $(document).ready(function() {
              var owl = $('.productgalcarousel');
              owl.owlCarousel({
                loop: true,
                margin: 0,
                responsiveClass:true,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:1,
                        nav:true
                    },
                    1000:{
                        items:1,
                        nav:true,
                        loop:true
                    }
                }
                });
              
            })
        
        </script>
        
       <script>
        $(document).ready(function() {
              var owl = $('.homeprodcarousel');
              owl.owlCarousel({
                loop: true,
                margin: 30,
                responsiveClass:true,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:2,
                        nav:true
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:true
                    }
                }
                });
              
            })
        
        </script>
        
        <script>
            let mybutton = document.getElementById("topscroll");

            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } 
                else {
                    mybutton.style.display = "none";
                }
            }
            
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
        
        <script>
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
	$(".innerbanner").css({
		backgroundSize: (100 + scroll/15)  + "%",
		top: -(scroll/10)  + "%",

	});
  
});

</script>
        
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>