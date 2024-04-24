<?php 

require('admin/includes/config.php');

$selectProds=$dbConn->execute("SELECT prod_id,prod_name,prod_primary_color , prod_slab_size1 , prod_slab_size2 ,prod_stone_cat , prod_finishes ,prod_images From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 ORDER BY created_date DESC");

$selectFilter=$dbConn->execute("SELECT prod_primary_color From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 ORDER BY created_date DESC");

$selectSizesFilter=$dbConn->execute("SELECT GROUP_CONCAT(CONCAT(prod_slab_size1, ',', prod_slab_size2) SEPARATOR ',' ) as sizes From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 ORDER BY created_date DESC");

$selectFinishesFilter=$dbConn->execute("SELECT prod_finishes From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 ORDER BY created_date DESC");

$selectStoneFilter=$dbConn->execute("SELECT prod_stone_cat From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 ORDER BY created_date DESC");

?>
<html>
    
    <head>
       <title>Product Collection | Agastya Stones</title>
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
            .prod-gallery .wrap img{
                width: 100%;
                /* cursor: pointer; */
                height: 250px;
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
        
        
        <div class="innerbanner prodpage">
            <div class="main"><div class="content">
               <h1 class="title">Product Collection</h1>
                <div class="desline"></div>
            </div>
            </div>
        </div>
        
        <form class="filterbar" id="filterbar">
            <div class="buttn">
                Colour <i class="fas fa-chevron-down"></i>
                <div class="options option_color">
                    <?php 
                    if(mysqli_num_rows($selectFilter)!=0){
                    while($selectFilterRes = mysqli_fetch_array($selectFilter) ){ ?>
                    <label>
                        <input type="checkbox" class="filter-option" value="<?=$selectFilterRes['prod_primary_color']?>" id="<?=$selectFilterRes['prod_primary_color']?>"> <?=$selectFilterRes['prod_primary_color']?>
                    </label>
                        <?php  } }else{ ?>
                      <label for="">No Colors</label>      
                    <?php } ?>
                </div>
            </div>
            <div class="buttn">
                Material <i class="fas fa-chevron-down"></i>
                <div class="options option_cat">
                    <?php if(mysqli_num_rows($selectStoneFilter)!=0){ ?>
                        <label>
                        <input type="checkbox" value="0"> Granite
                    </label>
                    <label>
                        <input type="checkbox" value="1"> Quartz
                    </label>
                    <label>
                        <input type="checkbox" value="2"> Quartzite
                    </label>
                    <label>
                        <input type="checkbox" value="3"> Marble
                    </label>
                    <label>
                        <input type="checkbox" value="4"> Onyx
                    </label>
                    <label>
                        <input type="checkbox" value="5"> Semi Precious
                    </label>
                    <label>
                        <input type="checkbox" value="6"> Porcelain
                    </label>
                        <?php }else{ ?>
                        <label for="">No Material</label>
                       <?php } ?>
                </div>
            </div>
            <div class="buttn">
                Thickness <i class="fas fa-chevron-down"></i>
                <div class="options option_size">

                <?php
                $selectSizesFilterRes=mysqli_fetch_array($selectSizesFilter);
                if($selectSizesFilterRes['sizes']!=''){
                $sizes=array_unique(explode(',' , $selectSizesFilterRes['sizes']));
                for($l=0;$l<count($sizes);$l++){
                ?>
                    <label>
                        <input type="checkbox" value="<?=$sizes[$l]?>"> <?=$sizes[$l]?>
                    </label>

                    <?php } }else{ ?>
                        <label for="">No Sizes</label>
                    <?php } ?>
                </div>
            </div>
            <div class="buttn">
                Finish <i class="fas fa-chevron-down"></i>
                <div class="options option_finish">
                    <?php if(mysqli_fetch_array($selectFinishesFilter)!=0){ ?>
                    <label>
                        <input type="checkbox" value="0"> Polished
                    </label>
                    <label>
                        <input type="checkbox" value="1"> Honed
                    </label>
                    <label>
                        <input type="checkbox" value="2"> Matte
                    </label>
                    <label>
                        <input type="checkbox" value="3"> Leather
                    </label>
                    <?php }else { ?>
                        <label for="">No Finishes</label>
                    <?php } ?>
                </div>            
            </div>
                    </form>
        
        <div class="prod-gallery">
           <div class="col-12 p-0"><button class="productreset" onclick="resetCall()">Reset <i class="far fa-arrow-alt-circle-right"></i></button></div>
           <?php while($selectProdsRow=mysqli_fetch_array($selectProds)){ ?>

            <a href="products-view.php?data=<?=$selectProdsRow['prod_id']?>" class="wrap" data-color="<?=$selectProdsRow['prod_primary_color']?>" data-finish="<?=$selectProdsRow['prod_finishes']?>" data-cat="<?=$selectProdsRow['prod_stone_cat']?>" data-size1="<?=$selectProdsRow['prod_slab_size1']?>" data-size2="<?=$selectProdsRow['prod_slab_size2']?>" >
                <img src="<?= 'images/'.json_decode($selectProdsRow['prod_images'])[0]?>">
                <h5><?=$selectProdsRow['prod_name']?></h5>
            </a>

           <?php } ?>

            <a href="calcutta-bianco-brand.html" class="wrap">
                <img src="images/quartz/calcutta-bianco-brand.jpg">
                <h5>Calcutta Bianco Brand</h5>
            </a>
            <a href="calcutta-mishti-brand.html" class="wrap">
                <img src="images/quartz/calcutta-mishti-brand.jpg"c>
                <h5>Calcutta Mishti Brand</h5>
            </a>
            <a class="wrap">
                <img src="images/quartz/almond-brand.jpg">
                <h5>Almond Brand</h5>
            </a>
            <a class="wrap">
                <img src="images/quartz/alvester-white-brand.jpg">
                <h5>Alvester White Brand</h5>
            </a>
            <div class="wrap">
                <img src="images/quartz/angelina-venny-brand.jpg">
                <h5>Angelina Venny Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/arabian-brown-brand.jpg">
                <h5>Arabian Brown Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/arabian-night-brand.jpg">
                <h5>Arabian Night Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/arizona-black-brand.jpg">
                <h5>Arizona Black Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/arizona-brown-brand.jpg">
                <h5>Arizona Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/ash-grey-brand.jpg">
                <h5>Ash Grey Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/black-marquina-brand.jpg">
                <h5>Black Marquina Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/calcutta-platinum-brand.jpg">
                <h5>Calcutta Platinum Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/calcutta-premium-brand.jpg">
                <h5>Calcutta Premium Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/calcutta-tuscany-brand.jpg">
                <h5>Calcutta Tuscany Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/calcutta-vegas-brand.jpg">
                <h5>Calcutta Vegas Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/calcutta-classic-brand.jpg">
                <h5>Calcutta Classic Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/carara-giorgio-brand.jpg">
                <h5>Carara Giorgio Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/carrara-caladia-brand.jpg">
                <h5>Carrara Caladia Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/carrara-gloria-brand.jpg">
                <h5>Carrara Gloria Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/carrara-venito-brand.jpg">
                <h5>Carrara Venito Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/carrara-natura-brand.jpg">
                <h5>Carrara Natura Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/carrara-white-brand.jpg">
                <h5>Carrara White Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/cemento-grey-brand.jpg">
                <h5>Cemento Grey Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/cemento-light-brand.jpg">
                <h5>Cemento Light Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/charcoal-brand.jpg">
                <h5>Charcoal Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/choco-dark-brand.jpg">
                <h5>Choco Dark Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/cosmos-brand.jpg">
                <h5>Cosmos Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/cosmos-magma-brand.jpg">
                <h5>Cosmos Magma Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/crystal-white-brand.jpg">
                <h5>Crystal White Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/dove-grey-brand.jpg">
                <h5>Dove Grey Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/dusky-beige-brand.jpg">
                <h5>Dusky Beige Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/dusky-grey-brand.jpg">
                <h5>Dusky Grey Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/essel-brown-brand.jpg">
                <h5>Essel Brown Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/fossil-grey-w-brand.jpg">
                <h5>Fossil Grey Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/fresh-concrete-brand.jpg">
                <h5>Fresh Concrete Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/frost-white-brand.jpg">
                <h5>Frost White Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/giris-brand.jpg">
                <h5>Giris Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/golden-shower-brand.jpg">
                <h5>Golden Shower Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/grey-onyx-brand.jpg">
                <h5>Grey Onyx Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/ice-white-brand.jpg">
                <h5>Ice White Brand</h5>
            </div>
            <div class="wrap">
                <img src="images/quartz/marquina-brown-brand.jpg">
                <h5>Marquina Brown Brand</h5>
            </div>
        </div>
        
        
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

$(document).on('click', '.options input' ,function(){

    filterCall();

})

function filterCall(){

    $('.prod-gallery a').hide();

    var finishes = $('.option_finish input:checked').map(function() {
        $('.prod-gallery a[data-finish="'+$(this).val()+'"]').show();
        return $(this).val();
    }).get();
    var stoneCats = $('.option_cat input:checked').map(function() {
        $('.prod-gallery a[data-cat="'+$(this).val()+'"]').show();
        return $(this).val();
    }).get();
    var colors = $('.option_color input:checked').map(function() {
        $('.prod-gallery a[data-color="'+$(this).val()+'"]').show();
        return $(this).val();
    }).get();
    var sizes = $('.option_size input:checked').map(function() {
        $('.prod-gallery a[data-size1="'+$(this).val()+'"]').show();
        $('.prod-gallery a[data-size2="'+$(this).val()+'"]').show();
        return $(this).val();
    }).get();

    if(finishes.length==0 && stoneCats.length==0 && colors.length==0 && sizes.length==0){
        $('.prod-gallery a').show();
    }
}

function resetCall(){

document.getElementById('filterbar').reset();
filterCall();
}

</script>
        
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
    
</html>