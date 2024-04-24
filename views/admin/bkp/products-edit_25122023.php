<?php
require('includes/config.php');
session_start();
if(@$_SESSION['user_id']==''){
    header('Location: login.php');
}else{
    
    if(isset($_GET['prod_id'])){
        $prodId=$_GET['prod_id'];
        $selectProd=$dbConn->execute("SELECT * From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 AND prod_id=$prodId");
        if(mysqli_num_rows($selectProd)!=0){
            $selectProdRes=mysqli_fetch_array($selectProd);
        }else{
            header('Location: index.php');    
        }
    }else{
        header('Location: index.php');
    }

?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Product Upload</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->

        <!-- Plugins css -->
        <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <style>
            .page-content{
                padding:calc(0px + 24px) calc(5px / 2) 60px calc(24px / 2)
            }
            .title-card{
                text-align:center;
            }
            .details-card{
                display:none;
                position: absolute;
                top: 0;
                width: 100%;
                /* height: 100%; */
                left: 100%;
            }
            .success-text{
                position: absolute;
                left: 100%;
                top: 3%;
                display:none;
            }
        </style>

    </head>

    <body data-sidebar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">          

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content ms-0">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Upload Products</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                                            <li class="breadcrumb-item active">Upload Products</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12" style="position:absolute">
                                <div class="card" id="images-card">
                                    <div class="card-body">
                                        <div>
                                            <form action="#" id="myDropzone" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple="multiple">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted mdi mdi-cloud-upload-outline"></i>
                                                    </div>
                                                    
                                                    <h4>Drop files here to upload</h4>
                                                </div>
                                            </form>
                                        </div>
        
                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="uploadImages()">Send Files <i class="fas fa-arrow-alt-circle-right"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card details-card">
                                    <form class="card-body row">            
                                    
                                    <div class="col-md-12 mb-2">
                                        <div class="col-md-4">
                                            <label for="product-name">Product Name</label>
                                            <input type="text" id="product-name" name="product-name" class="form-control" placeholder="Product Name">
                                        </div>
                                    </div>
                                    
                                        <div class="col-md-4">
                                        <h6 for="primary-colors" class="title-card">SPECIFICATIONS</h6>    
                                            <div class="col-md-12">
                                                <label for="primary-colors">PRIMARY COLOR(S)</label>
                                                <input type="text" class="form-control" id="primary-color" placeholder="PRIMARY COLOR(S)">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="accent-color">ACCENT COLOR(S)</label>
                                                <input type="text" class="form-control" id="accent-color" placeholder="ACCENT COLOR(S)">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="other-industry">OTHER INDUSTRY</label>
                                                <input type="text" class="form-control" id="other-industry" placeholder="OTHER INDUSTRY">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="spec-style">STYLE</label>
                                                <input type="text" class="form-control" id="spec-style" placeholder="STYLE">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="finishes">AVAILABLE FINISHES</label>
                                                <input type="text" class="form-control" id="finishes" placeholder="AVAILABLE FINISHES">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="price-range">PRICE RANGE</label>
                                                <input type="text" class="form-control" id="price-range" placeholder="PRICE RANGE">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                        <h6 for="primary-colors" class="title-card">SIZES</h6>
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <label for="primary-colors">SLABS</label>
                                                    <input type="text" class="form-control mt-2" id="slab-size1" placeholder="Size">
                                                    <input type="text" class="form-control mt-2" id="slab-id1" placeholder="ID#">
                                                </div>
                                                <div class="col-md-12 mt-4">
                                                    <input type="text" class="form-control mt-2" id="slab-size2" placeholder="Size">
                                                    <input type="text" class="form-control mt-2" id="slab-id2" placeholder="ID#">
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label for="primary-colors">PREFABS</label>
                                                    <input type="text" class="form-control mt-2" id="prefab-size1" placeholder="Size">
                                                    <input type="text" class="form-control mt-2" id="prefab-id1" placeholder="ID#">
                                                </div>
                                                <div class="col-md-12 mt-4">
                                                    <input type="text" class="form-control mt-2" id="prefab-size2" placeholder="Size">
                                                    <input type="text" class="form-control mt-2" id="prefab-id2" placeholder="ID#">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                        <h6 for="primary-colors" class="title-card">APPLICATIONS</h6>
                                            <div class="col-md-12">
                                                <h6 for="primary-colors">FLOORING</h6>
                                                <div class="col-md-12 d-flex mb-2">
                                                    <div class="col">
                                                        <h5 class="font-size-14">Residential</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="flooring-residential" id="flooring-residential-yes" value="0" checked="">
                                                            <label class="form-check-label" for="flooring-residential-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="flooring-residential" id="flooring-residential-no" value="1">
                                                            <label class="form-check-label" for="flooring-residential-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-size-14">Commercial</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="flooring-commercial" id="flooring-commercial-yes" value="0" checked="">
                                                            <label class="form-check-label" for="flooring-commercial-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="flooring-commercial" id="flooring-commercial-no" value="1">
                                                            <label class="form-check-label" for="flooring-commercial-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 for="primary-colors">COUNTERS</h6>
                                                <div class="col-md-12 d-flex">
                                                    <div class="col">
                                                        <h5 class="font-size-14">Residential</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="counter-residential" id="counter-residential-yes" value="0" checked="">
                                                            <label class="form-check-label" for="counter-residential-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="counter-residential" id="counter-residential-no" value="1">
                                                            <label class="form-check-label" for="counter-residential-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-size-14">Commercial</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="counter-commercial" id="counter-commercial-yes" value="0" checked="">
                                                            <label class="form-check-label" for="counter-commercial-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="counter-commercial" id="counter-commercial-no" value="1">
                                                            <label class="form-check-label" for="counter-commercial-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h6 for="primary-colors">WALL</h6>
                                                <div class="col-md-12 d-flex">
                                                    <div class="col">
                                                        <h5 class="font-size-14">Residential</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="wall-residential" id="wall-residential-yes" value="0" checked="">
                                                            <label class="form-check-label" for="wall-residential-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="wall-residential" id="wall-residential-no" value="1">
                                                            <label class="form-check-label" for="wall-residential-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-size-14">Commercial</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="wall-commercial" id="wall-commercial-yes" value="0" checked="">
                                                            <label class="form-check-label" for="wall-commercial-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="wall-commercial" id="wall-commercial-no" value="1">
                                                            <label class="form-check-label" for="wall-commercial-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h6 for="primary-colors">Others</h6>
                                                <div class="col-md-12 d-flex">
                                                    <div class="col">
                                                        <h5 class="font-size-14">Exterior Usage</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="exterior" id="exterior-yes" value="0" checked="">
                                                            <label class="form-check-label" for="exterior-yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="exterior" id="exterior-no" value="1">
                                                            <label class="form-check-label" for="exterior-no">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="detailSubmit()">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="toast-container position-fixed p-3 top-0 end-0" id="toastPlacement" data-original-class="toast-container position-absolute p-3">
                            <div class="fade show">
                                <div id="borderedToast1" class="toast overflow-hidden mt-3 fade hide" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="align-items-center text-white bg-danger border-0 toast-bg">
                                        <div class="d-flex">
                                            <div class="toast-body">
                                                
                                            </div>
                                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                
            </div>
            <!-- end main content-->

        </div>
        <button type="button" class="btn btn-primary d-none" id="borderedToast1Btn">Primary toast</button>
        <!-- END layout-wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <!-- Bootstrap Toasts Js -->
        <script src="../assets/js/pages/bootstrap-toasts.init.js"></script>

        <!-- dropzone js -->
        <script src="../assets/libs/dropzone/min/dropzone.min.js"></script>

        <script src="../assets/js/app.js"></script>

        <script>

            let arrayProd=JSON.parse('<?php echo $selectProdRes['prod_images']; ?>');
            let filesArray = arrayProd.filter(value => value !== null);
            Dropzone.options.myDropzone = {            
                thumbnailWidth: 300,
                thumbnailHeight: 200,
                paramName: "file",
                maxFilesize: 5, 
                addRemoveLinks: true,
                init: function () {
                    let myDropzone = this;

                    for(let i=0;i<filesArray.length;i++){

                    var mockFile = { name: filesArray[i]  ,size: 12345 };
                    let callback = null;
                    let crossOrigin = null;
                    myDropzone.displayExistingFile(mockFile, "../images/"+filesArray[i], callback, crossOrigin);

                    }

                this.on("addedfile", function (file) {
                    if (filesArray.some(existingFile => existingFile.name === file.name)) {
                        this.removeFile(file);
                    } else {
                        filesArray.push(file);
                    }
                });

                this.on("removedfile", function (file) {
                    var index = filesArray.indexOf(file);
                    if (index !== -1) {
                        filesArray.splice(index, 1);
                    }
                    console.log(filesArray);
                });
                },
            };

            const uploadImages=()=>{

                if(filesArray.length==0){

                    $('.toast-bg').addClass('bg-danger'); 
                    $('.toast-body').html('No Images uploaded');
                    $('#borderedToast1Btn').trigger('click');

                }else{

                    $('.details-card').animate({ 'left': '0' }, 100);
                    $('.details-card').show();
                    $('#images-card').hide();

                }

            }

            const detailSubmit = ()=>{

                let prodName=$('#product-name').val();
                let primColor= $('#primary-color').val();
                let accentColor= $('#accent-color').val();
                let otherIndustry= $('#other-industry').val();
                let specStyle= $('#spec-style').val();
                let finishes= $('#finishes').val();
                let priceRange= $('#price-range').val();

                let slabSize1=$('#slab-size1').val();
                let slabId1=$('#slab-id1').val();
                let slabSize2=$('#slab-size2').val();
                let slabId2=$('#slab-id2').val();

                let prefabSize1=$('#prefab-size1').val();
                let prefabId1=$('#prefab-id1').val();
                let prefabSize2=$('#prefab-size2').val();
                let prefabId2=$('#prefab-id2').val();

                let flooringResidential=$('input[name="flooring-residential"]:checked').val();
                let flooringCommercial=$('input[name="flooring-commercial"]:checked').val();
                let counterResidential=$('input[name="counter-residential"]:checked').val();
                let counterCommercial=$('input[name="counter-commercial"]:checked').val();
                let wallResidential=$('input[name="wall-residential"]:checked').val();
                let wallCommercial=$('input[name="wall-commercial"]:checked').val();
                let exterior=$('input[name="exterior"]:checked').val();

                if(prodName=='' || primColor=='' || accentColor=='' || otherIndustry=='' || specStyle=='' || finishes=='' || priceRange=='' || slabSize1=='' || slabId1=='' || slabSize2=='' || slabId2=='' || prefabSize1=='' || prefabId1=='' || prefabSize2=='' || prefabId2=='' ) {

                    if(prodName==''){
                        $('#product-name').css('border','1px solid red');
                    }else{
                        $('#product-name').css('border','');
                    }

                    if(primColor==''){
                        $('#primary-color').css('border','1px solid red');
                    }else{
                        $('#primary-color').css('border','');
                    }

                    if(accentColor==''){
                        $('#accent-color').css('border','1px solid red');
                    }else{
                        $('#accent-color').css('border','');
                    }

                    if(otherIndustry==''){
                        $('#other-industry').css('border','1px solid red');
                    }else{
                        $('#other-industry').css('border','');
                    }

                    if(specStyle==''){
                        $('#spec-style').css('border','1px solid red');
                    }else{
                        $('#spec-style').css('border','');
                    }

                    if(finishes==''){
                        $('#finishes').css('border','1px solid red');
                    }else{
                        $('#finishes').css('border','');
                    }

                    if(priceRange==''){
                        $('#price-range').css('border','1px solid red');
                    }else{
                        $('#price-range').css('border','');
                    }

                    if(slabSize1==''){
                        $('#slab-size1').css('border','1px solid red');
                    }else{
                        $('#slab-size1').css('border','');
                    }

                    if(slabId1==''){
                        $('#slab-id1').css('border','1px solid red');
                    }else{
                        $('#slab-id1').css('border','');
                    }

                    if(slabSize2==''){
                        $('#slab-size2').css('border','1px solid red');
                    }else{
                        $('#slab-size2').css('border','');
                    }

                    if(slabId2==''){
                        $('#slab-id2').css('border','1px solid red');
                    }else{
                        $('#slab-id2').css('border','');
                    }

                    if(prefabSize1==''){
                        $('#prefab-size1').css('border','1px solid red');
                    }else{
                        $('#prefab-size1').css('border','');
                    }

                    if(prefabId1==''){
                        $('#prefab-id1').css('border','1px solid red');
                    }else{
                        $('#prefab-id1').css('border','');
                    }

                    if(prefabSize2==''){
                        $('#prefab-size2').css('border','1px solid red');
                    }else{
                        $('#prefab-size2').css('border','');
                    }

                    if(prefabId2==''){
                        $('#prefab-id2').css('border','1px solid red');
                    }else{
                        $('#prefab-id2').css('border','');
                    }


                }else{

                    let postData={prodName, primColor , accentColor , otherIndustry , specStyle,  finishes, priceRange,slabSize1, slabId1, slabSize2, slabId2, prefabSize1 , prefabId1, prefabSize2, prefabId2, flooringResidential , flooringCommercial , counterResidential , counterCommercial , wallResidential , wallCommercial , exterior , formName : "productUpload" };

                    var formData=new FormData();
                    for(  i=0;i<filesArray.length;i++  ){
                        formData.append('images[]',filesArray[i]);  
                    }
                    $('#images-card').hide();
                                
                    formData.append('postData',JSON.stringify(postData));
                    formData.append('formName','productUpload');                

                    $.ajax({

                        type:'post',
                        data:formData,
                        contentType:false,
                        processData:false,
                        url:'products-ajax.php',
                        success:function(data){
                            
                            if(data==0){
                                $('.toast-bg').removeClass('bg-danger'); 
                                $('.toast-bg').addClass('bg-success'); 
                                $('.toast-body').html('Product added Succefully');
                                $('#borderedToast1Btn').trigger('click');
                                setTimeout(() => {
                                   location.reload(); 
                                }, 1500);
                            }else{
                                alert('Something went Wrong');
                            }

                        }

                    })


                }
 
            }

            $(document).on('focus','input', function(){
                $(this).css('border','');
            })

        </script>

    </body>
</html>
<?php 
}
?>