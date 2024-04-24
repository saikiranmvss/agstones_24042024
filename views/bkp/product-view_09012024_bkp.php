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
       <title>Calcutta Nova Brand | Quartz | Agastya Stones</title>
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
                            <a href="products.php" class="link">View Collection</a>
                            <a href="our-process.html" class="link">Our Process</a>
<!--                            <a class="link">Join Franchise</a>-->
                            <a href="locations.html" class="link">Locations</a>
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
            <div class="main"><div class="content">
                <h6>

                <?php
                
                $stoneCat=array('Granite','Quartz','Quartzite','Marble','Onyx','Semi Precious','Porcelain');
                echo $stoneCat[$selectProdImgRes['prod_stone_cat']];

                ?>

                </h6>
                <h1 class="title"><?=$selectProdImgRes['prod_name']?></h1><div class="desline"></div></div></div>
        </section>
   
        
        <section class="prodcontent">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <div class="row gallimg">
                            <div class="col-12 col-md-6">
                                <img src="
                                images/<?php 
                                if(@$images[1]){
                                    echo $images[1];
                                }else{
                                    echo $images[0];
                                }
                                ?> 
                                ">
                            </div>
                            <div class="col-12 col-md-6">
                                <img src="
                                images/<?php 
                                if(@$images[2]){
                                    echo $images[2];
                                }else{
                                    echo $images[0];
                                }
                                ?> 
                                ">
                            </div>
                        </div>
                        <h3>Applications</h3>
                        <div class="applic">
                        <?php
                        $quartzType1=array(0,1,2,3,4,5);
                         if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType1)){
                         ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-1.png">
                                <h5>Bathroom or Bathroom Vanity</h5>
                            </div>
                            <?php } ?>
                            
                            <?php
                                $quartzType2=array(0,1,2,3,5,6);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType2)){
                                ?>
                           <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-2.png">
                                <h5>Flooring</h5>
                            </div>
                            <?php } ?>

                            <?php
                                $quartzType3=array(0,1,2,3,5,6);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType3)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-3.png">
                                <h5>Countertops</h5>
                            </div>
                            <?php } ?>

                            <?php
                                $quartzType4=array(0,1,2,3,6);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType4)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-4.png">
                                <h5>Fireplace Hearth</h5>
                            </div>
                            <?php } ?>

                            <?php
                                $quartzType5=array(0,1,2,3,4,5);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType5)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-5.png">
                                <h5>Commercial Applications</h5>
                            </div>
                            <?php } ?>

                            <?php
                                $quartzType6=array(1,3,4,5,6);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType6)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-9.png">
                                <h5>Decorative</h5>
                            </div>
                            <?php } ?>

                            <?php
                                $quartzType7=array(0,1,2,3,4,5,6);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType7)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-6.png">
                                <h5>Tables</h5>
                            </div>
                            <?php } ?>

                            
                            <?php
                                $quartzType8=array(1,2);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType8)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-7.png">
                                <h5>Burn/Heat Resistant</h5>
                            </div>
                            <?php } ?>
                            <?php
                                $quartzType9=array(1,3,4,5);
                                if(in_array($selectProdImgRes['prod_stone_cat'],$quartzType9)){
                                ?>
                            <div class="wrap">
                                <img src="images/product-pages/quartzite/icon-8.png">
                                <h5>Wall Cladding</h5>
                            </div>
                            
                            <?php } ?>
                        </div>
                        <h3>How can AG Stones Help you?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="prodspecif side">
                            <div class="wrap">
                                <h6>PRIMARY COLOR(S)</h6>
                                <p><?=$selectProdImgRes['prod_primary_color']?></p>
                            </div>
                            <div class="wrap">
                                <h6>Origin</h6>
                                <p><?=$selectProdImgRes['prod_origin']?></p>
                            </div>
                            <div class="wrap">
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
                                <h6>SLABS</h6>
                                <p>Size: <?=$selectProdImgRes['prod_slab_size1'].' , '.$selectProdImgRes['prod_slab_size2']?></p>
                            </div>
                        </div>
                        <img src="images/visualizer-3.gif" class="w-100 mt-4 pt-2 mb-3">
                        <a class="normbtn w-100 text-center">Try our Visualizer</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="pt-5 pb-5 hunset" style="background: #f4f4f4;">
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
                            <a href="products.php">Our Collection</a>
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
                            <a href="locations.html">Our Locations</a>
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