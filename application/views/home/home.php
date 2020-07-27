<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.0);
    transition: 0.3s;
    width: 100%;
   /* margin-top: 20px;*/
    height: 230px;
}

/*.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
}*/
/*.top-view{
    margin-top:-50px;
}*/
.heading{
    height:224px;
}

</style>
<div class="container-fluid "id="top-slider">
    <div class="row" id="home-slider">
        <div>
            <div id="myCarousel"class="carousel slide" data-ride="carousel"  style="z-index: -1;position:relative;" >
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner" >
                    <div class="item active">
                        <?php if ($projectSliders['slider1'] != '') { ?>
                        <img class=""
                            src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider1']; ?>"
                            style="width:100%;">
                        <!-- <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider1']; ?>" alt="" height="100" width="100%" /> -->
                        <?php

                            } else {
                                echo '<img class="" src="<?= base_url() ?>assets/home/image/top_banner1.png"
                        style="width:100%;">';
                        }
                        
                        ?>
                        <!-- <img class="img img-responsive" src="<?= base_url() ?>assets/home/image/top_banner1.png"
                            style="width:100%;"> -->
                    </div>
                    <div class="item">
                        <?php if ($projectSliders['slider2'] != '') { ?>
                        <img class="img img-responsive"
                            src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider2']; ?>"
                            style="width:100%;">
                        <!-- <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider2']; ?>" alt="" height="100" width="100%" /> -->
                        <?php
                            } else {
                                echo '<img class="img img-responsive" src="<?= base_url() ?>assets/home/image/top_banner1.png"
                        style="width:100%;">';
                        }
                        ?>
                    </div>
                    <div class="item">
                        <?php if ($projectSliders['slider3'] != '') { ?>
                        <img class="img img-responsive"
                            src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider3']; ?>"
                            style="width:100%;">
                        <!-- <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider3']; ?>" alt="" height="100" width="100%" /> -->
                        <?php
                            } else {
                                echo '<img class="img img-responsive" src="<?= base_url() ?>assets/home/image/top_banner1.png"
                        style="width:100%;;">';
                        }
                        ?>
                    </div>
                    <div class="item">
                        <?php if ($projectSliders['slider4'] != '') { 
                            ?>
                        <img class="img img-responsive"
                            src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider4']; ?>"
                            style="width:100%;">
                        <!-- <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider4']; ?>" alt="" height="100" width="100%" /> -->
                        <?php
                            } else {
                                echo '<img class="img img-responsive" src="<?= base_url() ?>assets/home/image/top_banner1.png"
                        style="width:100%;">';
                        }
                        ?>
                    </div>
                </div>

               <!--  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a> -->
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .mobile-view{

        display: none;
    } 
    .mobile-view img{
             height:214px;
             margin-left:5px;
        
    }

    .huge-view img{

    height:224px;
    margin-left: 40px;
    }
     @media only screen and (max-width: 600px) {
          .huge-view {
            display: none;
         }
        .mobile-view{
            display:block;
        }

    }
      @media only screen and (max-width: 320px) {
        .huge-view {
            display:none;
         }
        .mobile-view{
            display: block;
        }
    }
     @media only screen and (max-width: 480px) {
         .huge-view{
            display:none;
         }
        .mobile-view{
            display: block;
        }
    }
  
</style>
<br><br>
    <div class="container huge-view">
        <div class="row" id="row4" >
         <center> 
               <img class="img-thumbnail" src="<?php echo  base_url()?>uploads/admin/5.jpeg">
                <img class="img-thumbnail" src="<?php echo  base_url()?>uploads/admin/1.jpg">
           <img class="img-thumbnail " src="<?php echo  base_url()?>uploads/admin/2.jpg">
          <img class="img-thumbnail " src="<?php echo  base_url()?>uploads/admin/3.jpg">
          <img class="img-thumbnail " src="<?php echo  base_url()?>uploads/admin/4.jpg" "> 

          
          </center>
        </div>
    </div>
     <div class="container mobile-view">
        <div class="row" id="row4" >
         <center> <img class="img-thumbnail heading" src="<?php echo  base_url()?>uploads/admin/1.jpg">
           <img class="img-thumbnail heading" src="<?php echo  base_url()?>uploads/admin/2.jpg">
          <img class="img-thumbnail heading" src="<?php echo  base_url()?>uploads/admin/3.jpg">
          <img class="img-thumbnail heading" src="<?php echo  base_url()?>uploads/admin/4.jpg" ">   
            <img class="img-thumbnail" src="<?php echo  base_url()?>uploads/admin/5.jpeg">
          </center>
        </div>
    </div>
<div class="container-fluid">
    <div class="row" id="row5" style="">
        <?php 
    foreach ($allProducts as $product):

        //$productName=$product->productName;
       $namePro=urlencode($product->productName);
        $product_name=str_replace('+', '-', $namePro);
        $nameLen= strlen($product->productName);

        if ($nameLen>=34) {
            $VisibleName=substr($product->productName,0,34).'...';
        }
        elseif ($nameLen<22) {
            $VisibleName=$product->productName.'<br><br>';
        }
        else{
            $VisibleName=$product->productName;
        }

        ?>

        <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2">
            <div class="item">
                <center><a href="<?=base_url().'products/'.$product_name?>"><img width="" class="img-responsive"
                            src="<?= base_url() ?>uploads/product/<?=$product->thumbnail1?>"></a></center>
                <div align="center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <h4 style="text-align:center"><small><strike>&#8377;<?=$product->mrp?></strike></small>
                    <b>&#8377;<?=$product->price?></b></h4>
                <p style="text-align:center"><?=$VisibleName?></p>
                <div class="text-center">
                    <form method="post" action="<?=base_url()?>addToCart">
                       
                        <input type="hidden" readonly="" value="<?=$product->id?>" name="id">

                       
                        <input type="hidden" readonly="" value="<?=$product->productName?>" name="product_name">

                       
                        
                        <input type="hidden" value="1" name="qty">

                        <input type="hidden" value="<?=$product->thumbnail1?>" name="image">
                        <input type="hidden" value="<?=$product->size?>" name="size">


                        <button type="submit" class="btn-info add-to-cart" name="add">Add to cart</button>
                    </form>
                </div>
            </div>
        </div> -->
        <?php  
    endforeach;
    ?>
    </div>
</div>
<br>
<style type="text/css">
.view-all-btn,
.view-all-btn>a:visited {
    float: right;
    color: black;
}

a {
    color: black;
}

.category-name {
    padding: 14px;
    width: 100%;
    margin-right: 12px;
    float: right;
    border-radius: 4px;
    font-weight: bold;
    font-size: 15px;
    border: 2px solid #f36c3bcc;
}

@media screen and (max-width: 540px) {
    .category-name {
        padding: 14px;
        width: 90%;
        margin-right: 12px;
        float: right;
        border-radius: 4px;
        font-weight: bold;
        font-size: 15px;
        border: 2px solid #f36c3bcc;
    }
}
</style>
<div class="container-fluid">
    <?php 
    
        foreach ($Category as $category):
             $product_data= count($Category);
            // foreach ($Products as $product){
            //     if(sizeof($) > 0){
            //         echo "Data doesnot exit";
            // }
            // }
            
    ?>
    <br>
    <?php if(($product_data)>=0){
            ?>
    <hr>
      
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="text-align: right;">
            <img src="<?= base_url() ?>uploads/admin/category/<?=$category->categoryThumbnail;?>" width="50">
        </div>
      
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
            <div class="category-name">
                <?=$category->categoryName;?> <span class="view-all-btn"><a
                        href="<?=base_url()?>Category/<?=$category->url_slug?>">View
                        All <i class="fa fa-angle-double-right"></i> </a></span></div>
        </div>
       
    </div>
     <?php }
        else{

        }?>
    <hr>
    <br>
    <div class="row" id="row6" style="padding:12px;">
        <div class="col-lg-1"></div>
        <?php 
        $i=1;

        foreach ($Products as $product):
            if($product->categoryId==$category->id && $i<=5)
            {


            //$productName=$product->productName;
             $namePro=urlencode($product->productName);
            //  $namePros = str_replace('-','+',$namePro);
             $product_name=str_replace('+', '-', $namePro);

            $nameLen= strlen($product->productName);

            if ($nameLen>=34) {
                $VisibleName=substr($product->productName,0,34).'...';
            }
            elseif ($nameLen<22) {
                $VisibleName=$product->productName.'<br><br>';
            }
            else{
                $VisibleName=$product->productName;
            }

            ?>


        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2">
            <div class="item" style="border:0px;">
                <center>
                    <a href="<?=base_url().'products/'.$product->slug?>">
                        <img width="" class="img-responsive "
                            src="<?= base_url() ?>uploads/product/<?=$product->thumbnail1?>" style="height: 200px;">
                    </a>
                </center>
                <div align="center">
                    <br>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <!-- <span style="text-align:center" >Size: <?=$product->size;?></span> -->
                <!-- <span style="height: 10px; width: 20px; background: <?=$product->color;?>"></span> -->
                <h4 style="text-align:center"><small><strike>&#8377;<?=$product->mrp;?></strike></small>
                    <b>&#8377;<?=$product->price?></b></h4>
                <p style="text-align:center;opacity: 0.4"> <a href="<?=base_url().'products/'.$product->slug?>"><b><?=$VisibleName?></b></a></p>
                <div class="text-center">
                    <form method="post" action="<?=base_url()?>addToCart">
                        <input type="hidden" name="productCode" value="<?=$product->productCode;?>" readonly="">
                        <input type="hidden" readonly="" value="<?=$product->id?>" name="id">
                        <input type="hidden" readonly="" value="<?=$product->productName?>" name="product_name">
                        <input type="hidden" name="brand" value="<?=$product->brand?>" readonly>
                        <input type="hidden" name="color" value="<?=$product->color?>" readonly>
                        <input type="hidden" value="1" name="qty">
                        <input type="hidden" value="<?=$product->thumbnail1?>" name="image">
                        <input type="hidden" value="<?=$product->size?>" name="size">
                        <!-- <button type="submit" class="btn-info add-to-cart" name="add">Add to cart</button> -->
                    </form>
                </div>
            </div>
        </div>
        <?php 
            $i++;
            } 
        endforeach;
        ?>
<div class="col-lg-1"></div>

        <div class="clearfix"> </div>
    </div>

    <?php
   
        endforeach;
    ?>




</div>