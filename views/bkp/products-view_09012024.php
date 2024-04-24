<?php 

require('admin/includes/config.php');

if(@$_GET['data']){

    $prodId=$_GET['data'];
    $selectProdImg=$dbConn->execute("SELECT * FROM products_data WHERE prod_status!=1 AND prod_images IS NOT NULL AND prod_id=$prodId");
    $selectProdImgRes=mysqli_fetch_array($selectProdImg);

    $selectCaurosalProd=$dbConn->execute("SELECT prod_id,prod_images,prod_name FROM products_data WHERE prod_status!=1 AND prod_images IS NOT NULL");

?>
<html>
    
    <head>
       <title>Calcutta Bianco Brand | Quartz | Agastya Stones</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <style>
            
            .owl-carousel .owl-item img {
                display: block;
                width: 100%;
                object-fit: cover;
                height: 20%;
            }

            .carousel-item img{ 
            height: 95%;
            object-position: center bottom;
            object-fit: cover;
            }
            
        </style>
    </head>
    
    <body>
        
        <button onclick="topFunction()" id="topscroll" title="Go to top"><i class="fas fa-chevron-up"></i></button>
<header>
           
           <div class="container">
               
               <div class="row">
                   
                   <div class="col-12">
                       
                       <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
                       
                       <div class="menuicon">
                           <div class="wrap">
<!--                               <a href="#contact">Contact</a> -->
                               <div class="icon" data-bs-toggle="modal" data-bs-target="#menutrig">
                                   <span></span>
                                   <span></span>
                                   <span></span>
                               </div>
                           </div>
                        </div>
                       
                   </div>
                   
               </div>
               
           </div>
            
            
            
        </header>
        
       <div class="modal menubox" id="menutrig" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="termsLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">  
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close <i class="fas fa-times"></i></button>
                        <img src="images/logo-black.png" class="logo">
                        <div class="nav-links">
                            <a href="index.html" class="link">Home</a>
                             <a href="about.html" class="link">Our Story</a> 
<!--                            <a href="why-agastya-stones.html" class="link">Why Us?</a>-->
                            <a href="products.html" class="link">View Collection</a>
                            <a href="our-process.html" class="link">Our Process</a>
<!--                            <a class="link">Join Franchise</a>-->
                            <a class="link" href="locations.html">Locations</a>
                            <a href="resources.html" class="link">Resources</a>
                            <a href="contact.html" class="link">Reach Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <section class="prodpagebanner">
        
            <div id="carouselExampleIndicators" class="carousel slide pointer-event" data-bs-ride="carousel">
                <div class="carousel-inner">

                <?php
                
                $images=json_decode($selectProdImgRes['prod_images']);
                $stoneCat=array('Granite','Quartz','Quartzite','Marble','Onyx','Semi Precious','Porcelain');
                $finishes=array('Polished','Honed','Matte','Leather');
                                        
                for($j=0;$j<count($images);$j++){

                ?>

                    <div class="carousel-item <?= $j==0 ? 'active' : ''?>" style="position: relative;">
                      
                      <img src="images/<?=$images[$j]?>" class="w-100 d-none d-lg-block" style="height:95%">
                      <img src="images/<?=$images[$j]?>" class="w-100 d-lg-none">

                   </div>
                
                <?php

                }

                ?>

                </div>
                
                <span class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev"><i class="fas fa-chevron-left"></i></span>
                
                <span class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next"><i class="fas fa-chevron-right"></i></span>
                
            </div>
            <div class="main"><div class="content"><h6>Quartz</h6><h1 class="title"><?=$selectProdImgRes['prod_name']?></h1><div class="desline"></div></div></div>
        </section>
        
        
        <section class="hunset p-4">
            <div class="col-12 p-0">
                <div class="owl-carousel proddispcarousel">
                    <?php
                                        
                    for($i=0;$i<count($images);$i++){

                    ?>

                    <div class="wrap">
                        <img src="images/<?=$images[$i]?>">
                    </div>
                    
                    <?php

                    }

                    ?>
                </div>
            </div>
        </section>
        
        <section class="hunset padding" style="background: #1c1c1c;">
            <div class="container pb-md-4">
                <div class="row prodspecif">
                    <div class="col-12 text-center">
                        <h2 class="heading mb-2">Product Information</h2>
                    </div>
                    <div class="col-md-4">
                        <h4>Specifications</h4>
                        <div class="wrap">
                            <h6>PRIMARY COLOR(S)</h6>
                            <p><?=$selectProdImgRes['prod_primary_color']?></p>
                        </div>
                        <div class="wrap">
                            <h6>Origin</h6>
                            <p><?=$selectProdImgRes['prod_origin']?></p>
                        </div>
                        <div class="wrap d-none">
                            <h6>SKU</h6>
                            <p><?=$selectProdImgRes['prod_sku']?></p>
                        </div>
                        <div class="wrap">
                            <h6>SERIES</h6>
                            <p><?=$selectProdImgRes['prod_series']?></p>
                        </div>
                        <div class="wrap">
                            <h6>AVAILABLE FINISHES</h6>
                            <p>
                                                                <?php 
                                $finishArr=json_decode($selectProdImgRes['prod_finishes']);
                                for($k=0;$k<count($finishArr);$k++){
                                    echo $finishes[$finishArr[$k]].'<br>';
                                }                                    
                                ?>
                            </p>
                        </div>
                        <div class="wrap">
                            <h6>PRICE RANGE</h6>
                            <p><?=$selectProdImgRes['prod_price_range']?></p>
                        </div>
                        <div class="wrap">
                            <h6>Cateogry</h6>
                            <p><?=$stoneCat[$selectProdImgRes['prod_stone_cat']]?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <h4>Sizes</h4>
                        <div class="wrap">
                            <h6>SLABS</h6>
                            <p>Size: <?=$selectProdImgRes['prod_slab_size1']?></p>
                            <p>Size: <?=$selectProdImgRes['prod_slab_size2']?></p>
                            <p>ID#: <?=$selectProdImgRes['prod_slab_id1']?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <h4>Applications</h4>
                        <div class="wrap">
                            <h6>FLOORING</h6>
                            <p>Residential: <?=$selectProdImgRes['prod_floor_residential']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                            <p>Commercial: <?=$selectProdImgRes['prod_floor_commercial']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                        </div>
                        <div class="wrap">
                            <h6>COUNTERS</h6>
                            <p>Residential: <?=$selectProdImgRes['prod_counter_residential']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                            <p>Commercial: <?=$selectProdImgRes['prod_counter_commercial']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                        </div>
                        <div class="wrap">
                            <h6>WALL</h6>
                            <p>Residential: <?=$selectProdImgRes['prod_wall_residential']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                            <p>Commercial: <?=$selectProdImgRes['prod_wall_commercial']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                        </div>
                        <div class="wrap">
                            <h6>OTHER</h6>
                            <p>Exterior Usage: <?=$selectProdImgRes['exterior']==0 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'  ?></p>
                        </div>
<!--
                        <div class="wrap">
                            <h6></h6>
                            <p></p>
                        </div>
-->
                        
                    </div>
                </div>
            </div>
        </section>
        
        <section class="padding hunset">
            <div class="col-12 ps-md-4 ps-3 pe-md-4 pe-3">
                <h2 class="heading">
                    Similar Styles
                </h2>
                <div class="owl-carousel similarprodcarousel">

                <?php 
                
                while($selectCaurosalProdRes=mysqli_fetch_array($selectCaurosalProd)){
                    $prods_id=$selectCaurosalProdRes['prod_id'];
                ?>

                    <div class="wrap" onclick="window.location.href='products-view.php?data=<?=$prods_id?>'">
                        <img src="images/<?=json_decode($selectCaurosalProdRes['prod_images'])[0]?>">
                        <h6><?=$selectCaurosalProdRes['prod_name']?></h6>
                    </div>

                <?php    

                }

                ?>
                </div>
            </div>
        </section>
        
<!--
        <section class="hunset padding" style="background: #f4f4f4;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tips-sec">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h3 class="heading">
                                        Tips from the Experts
                                    </h3>
                                    <ol>
                                        <li><span>1</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</li>
                                        <li><span>2</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</li>
                                        <li><span>3</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</li>
                                    </ol>
                                </div>
                                <div class="col-lg-6">
                                    <div class="owl-carousel tipscarousel">
                                        <div class="wrap">
                                            <img src="images/icons/dummy-img.jpg">
                                        </div>
                                        <div class="wrap">
                                            <img src="images/icons/dummy-img.jpg">
                                        </div>
                                        <div class="wrap">
                                            <img src="images/icons/dummy-img.jpg">
                                        </div>
                                        <div class="wrap">
                                            <img src="images/icons/dummy-img.jpg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h3 class="mb-3">Virtual Kitchen Design Tool</h3>
                                    <p class="mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                </div>
                                <div class="col-md-8 pe-md-0">
                                    <img src="images/quartz/calcutta-nova/visualizer.jpg" class="w-100">
                                </div>
                                <div class="col-md-4 align-items-center d-flex" style="background: #ececec;">
                                    <a class="normbtn">Try our Visualizer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
-->
        
<!--
        <section class="hunset pt-5 pb-5">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-6 col-md-3">
                        <div class="brandlog">
                            <img src="images/icons/brand-logo.jpg">
                            <h6>Logo 1</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="brandlog">
                            <img src="images/icons/brand-logo.jpg">
                            <h6>Logo 2</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="brandlog">
                            <img src="images/icons/brand-logo.jpg">
                            <h6>Logo 3</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="brandlog">
                            <img src="images/icons/brand-logo.jpg">
                            <h6>Logo 4</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
-->
        
        <footer>
            
            <div class="container">
                <div class="row">
                   <div class="col-lg-4">
                       <div class="foot-text">
                           <img src="images/logo-white.png" class="footer-logo">
                       </div>
                            <div class="footer-social-links">
                                <a><i class="fab fa-facebook-f"></i></a>
                                <a><i class="fab fa-instagram"></i></a>
                                <a><i class="fab fa-x-twitter"></i></a>
                                <a><i class="fab fa-pinterest-p"></i></a>
                            </div>
                       
                   </div>
                    <div class="col-12 col-md-4 col-lg-2">
                       <h3 class="footer-title">
                           Menu
                       </h3>
                        <div class="footer-menu">
                            <a href="index.html">Home</a>
                            <a href="about.html">Our Story</a>
                            <a href="products.html">Our Collection</a>
                            <a href="our-process.html">Our Process</a>
                            <a href="gallery-collection.html">Gallery</a>
                            <a href="contact.html">Reach Us</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                       <h3 class="footer-title">
                           Our Collection
                       </h3>
                        <div class="footer-menu">
                            <a href="quartzite.html">Quartzite</a>
                            <a href="quartz.html">Quartz</a>
                            <a href="granite.html">Granite</a>
                            <a href="marble.html">Marble</a>
                            <a href="onyx.html">Onyx</a>
                            <a href="semi-precious-stones.html">Semi Precious Stones</a>
                            <a href="porcelain.html">Porcelain</a>
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
                            <a href="privacy-policy.html">Privacy Policy</a>
                            <a href="terms-and-conditions.html">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </div>            

            <div class="bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                           
                            © Copyright 2023 Agastya Global Stones. <span class="d-inline-block">All Rights Reserved.</span><div class="btfootaddress"><i class="fas fa-map-marker-alt"></i> 459 Herndon Pkwy STE 18 Herndon, <span class="d-inline-block">VA 20170</span></div>
                            
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
              var owl = $('.proddispcarousel');
              owl.owlCarousel({
                loop: true,
                margin: 30,
                responsiveClass:true,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:2,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:true
                    },
                    1000:{
                        items:5,
                        nav:true,
                        loop:true
                    }
                }
                });
              
            })
        
        </script>
        
        <script>
        $(document).ready(function() {
              var owl = $('.similarprodcarousel');
              owl.owlCarousel({
                loop: true,
                margin: 20,
                responsiveClass:true,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:2,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:true
                    },
                    1000:{
                        items:5,
                        nav:true,
                        loop:true
                    }
                }
                });
              
            })
        
        </script>
        
        <script>
        $(document).ready(function() {
              var owl = $('.tipscarousel');
              owl.owlCarousel({
                loop: true,
                margin: 20,
                responsiveClass:true,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:2,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:true
                    },
                    1000:{
                        items:4,
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

        
    </body>
    
</html>

<?php 
} else{
    header('Location: products.php');
}
?>