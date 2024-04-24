<?php 
require('includes/config.php');

session_start();

if(@$_POST['formName']=='uploadImages'){

    $imgArr=array();
    for($i=0;$i< count($_FILES['images']['name']);$i++){
        move_uploaded_file( $_FILES['images']['tmp_name'][$i] , '../images/'.$_FILES['images']['name'][$i] );
        array_push($imgArr,$_FILES['images']['name'][$i]);
    }  

    echo json_encode($imgArr);

}

if(@$_POST['formName']=='delete_prod'){
    $prodId=$_POST['prod_id'];
    $query=$dbConn->execute("UPDATE products_data SET prod_status=1 WHERE prod_id=$prodId");
    if($query){
        echo 1;
    }else{
        echo 0;
    }

}

if(@$_POST['formName']=='login'){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query=$dbConn->execute("SELECT user_id,user_type,user_name,user_log_id FROM users WHERE user_email='$email' AND user_password='$password'");
    // $error=mysqli_error($dbConn);
    $id=mysqli_fetch_array($query);
    if($id['user_id']=='' || $id['user_id']=='undefined'){
        echo 1;
    }else{
        $_SESSION['user_id']=$id['user_id'];
        $_SESSION['user_type']=$id['user_type'];
        $_SESSION['user_name']=$id['user_name'];
        $_SESSION['user_log_id']=$id['user_log_id'];
        echo 0;
    }
}


if(@$_POST['formName']=='productUpload'){

    $imgArr=array();
    for($i=0;$i< count($_POST['images']);$i++){
        array_push($imgArr,$_POST['images'][$i]);
    }
    $postData=json_decode($_POST['postData']);
    $imgArrJson=json_encode($imgArr);
    $prodName=$postData->prodName;
    $primColor=$postData->primColor;
    $accentColor=$postData->accentColor;
    $otherIndustry=$postData->otherIndustry;
    $specStyle=$postData->specStyle;
    $finishes=$postData->finishes;
    $priceRange=$postData->priceRange;
    $slabSize1=$postData->slabSize1;
    $slabId1=$postData->slabId1;
    $slabSize2=$postData->slabSize2;
    $slabId2=$postData->slabId2;
    $prefabSize1=$postData->prefabSize1;
    $prefabId1=$postData->prefabId1;
    $prefabSize2=$postData->prefabSize2;
    $prefabId2=$postData->prefabId2;
    $flooringResidential=$postData->flooringResidential;
    $flooringCommercial=$postData->flooringCommercial;
    $counterResidential=$postData->counterResidential;
    $counterCommercial=$postData->counterCommercial;
    $wallResidential=$postData->wallResidential;
    $wallCommercial=$postData->wallCommercial;
    $exterior=$postData->exterior;

    $insertProducts=$dbConn->execute("INSERT INTO `products_data` (`prod_name`,`prod_images`, `prod_primary_color`, `prod_accent_color`, `other_industry`, `prod_spec_style`, `prod_finishes`, `prod_price_range`, `prod_slab_size1`, `prod_slab_id1`, `prod_slab_size2`, `prod_slab_id2`, `prod_prefab_size1`, `prod_prefab_id1`, `prod_prefab_size2`, `prod_prefab_id2`, `prod_floor_residential`, `prod_floor_commercial`, `prod_counter_residential`, `prod_counter_commercial`, `prod_wall_residential`, `prod_wall_commercial`, `exterior`) VALUES ( '$prodName','$imgArrJson', '$primColor', '$accentColor', '$otherIndustry', '$specStyle', '$finishes', '$priceRange', '$slabSize1', '$slabId1', '$slabSize2', '$slabId2', '$prefabSize1', '$prefabId1', '$prefabSize2', '$prefabId2', '$flooringResidential', '$flooringCommercial', '$counterResidential', '$counterCommercial', '$wallResidential', '$wallCommercial', '$exterior')");

    if($insertProducts){
        echo "0";
    }else{
        echo mysqli_error($dbConn->conn);
    }

}

if(@$_POST['formName']=='productUpdate'){

    $imgArr=array();
    for($i=0;$i< count($_POST['images']);$i++){
        array_push($imgArr,$_POST['images'][$i]);
    }
    $postData=json_decode($_POST['postData']);
    $imgArrJson=json_encode($imgArr);
    $prodId=$postData->prodId;
    $prodName=$postData->prodName;
    $primColor=$postData->primColor;
    $accentColor=$postData->accentColor;
    $otherIndustry=$postData->otherIndustry;
    $specStyle=$postData->specStyle;
    $finishes=$postData->finishes;
    $priceRange=$postData->priceRange;
    $slabSize1=$postData->slabSize1;
    $slabId1=$postData->slabId1;
    $slabSize2=$postData->slabSize2;
    $slabId2=$postData->slabId2;
    $prefabSize1=$postData->prefabSize1;
    $prefabId1=$postData->prefabId1;
    $prefabSize2=$postData->prefabSize2;
    $prefabId2=$postData->prefabId2;
    $flooringResidential=$postData->flooringResidential;
    $flooringCommercial=$postData->flooringCommercial;
    $counterResidential=$postData->counterResidential;
    $counterCommercial=$postData->counterCommercial;
    $wallResidential=$postData->wallResidential;
    $wallCommercial=$postData->wallCommercial;
    $exterior=$postData->exterior;

    $updateProducts = $dbConn->execute("
    UPDATE `products_data`
    SET
      `prod_name` = '$prodName',
      `prod_images` = '$imgArrJson',
      `prod_primary_color` = '$primColor',
      `prod_accent_color` = '$accentColor',
      `other_industry` = '$otherIndustry',
      `prod_spec_style` = '$specStyle',
      `prod_finishes` = '$finishes',
      `prod_price_range` = '$priceRange',
      `prod_slab_size1` = '$slabSize1',
      `prod_slab_id1` = '$slabId1',
      `prod_slab_size2` = '$slabSize2',
      `prod_slab_id2` = '$slabId2',
      `prod_prefab_size1` = '$prefabSize1',
      `prod_prefab_id1` = '$prefabId1',
      `prod_prefab_size2` = '$prefabSize2',
      `prod_prefab_id2` = '$prefabId2',
      `prod_floor_residential` = '$flooringResidential',
      `prod_floor_commercial` = '$flooringCommercial',
      `prod_counter_residential` = '$counterResidential',
      `prod_counter_commercial` = '$counterCommercial',
      `prod_wall_residential` = '$wallResidential',
      `prod_wall_commercial` = '$wallCommercial',
      `exterior` = '$exterior'
    WHERE `prod_id` = $prodId
  ");

    if($updateProducts){
        echo "0";
    }else{
        echo mysqli_error($dbConn->conn);
    }

}

?>