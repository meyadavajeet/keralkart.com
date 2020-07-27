<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-theme.min.css">-->

    <!-- share this api -->
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5e48bf41eb84eb00123923fc&product=inline-share-buttons"
        async="async">
    </script>

        <style>
            /* .block__pic{
                width:auto;
                height:1000px !important;
            } */
        </style>

<div class="container-fluid">
    <?php
  
	foreach ($product as $products):
    $thumbnail1 = $products->thumbnail1;
    $thumbnail2 = $products->thumbnail2;
    $thumbnail3 = $products->thumbnail3;
    $thumbnail4 = $products->thumbnail4;
    $price = $products->price;
    $mrp = $products->mrp;
    $color = $products->color;
    $size = $products->size;
    $brandName = $products->brandName;
    $id =  $products->id;
    $productName = $products->productName;
    $features = $products->features;
    $productDescription = $products->productDescription;
    endforeach;
		?>
    <div class="col-md-7 col-sm-7 col-xs-12 right-section" style="z-index:1">
        <div class="col-md-2 col-sm-4 col-xs-3">
            <ul class="nav section-navs">
                <li class="active">

                    <a data-toggle="tab" href="#image1">
                        <img src="<?= base_url() ?>uploads/product/<?= $thumbnail1 ?>" />
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#image2">
                        <img src="<?= base_url() ?>uploads/product/<?= $thumbnail2 ?>" />
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#image3">
                        <img src="<?= base_url() ?>uploads/product/<?= $thumbnail3 ?>" />
                    </a>
                </li>
                <li>

                    <a data-toggle="tab" href="#image4">
                        <img src="<?= base_url() ?>uploads/product/<?= $thumbnail4 ?>" />
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-10 col-sm-8 col-xs-9">
            <div class="tab-content">
				
                <div id="image1" class="tab-pane in active">
                    <img  src="<?= base_url() ?>uploads/product/<?= $thumbnail1 ?>"  class="block__pic"/>
                </div>
                 <div id="image2" class="tab-pane fade">
                    <img src="<?= base_url() ?>uploads/product/<?= $thumbnail2 ?>" class="block__pic" />
                </div>
                <div id="image3" class="tab-pane fade">
                    <img src="<?= base_url() ?>uploads/product/<?= $thumbnail3 ?>" class="block__pic" />
                </div>
                <div id="image4" class="tab-pane fade">
                    <img src="<?= base_url() ?>uploads/product/<?= $thumbnail4 ?>" class="block__pic" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12 left-section">
        <form method="post" name="Cart" action="<?= base_url() ?>addToCartProduct">
            <h4><?= $productName ?></h4>
            <?php foreach($get_avg_rating as $rating){
                $average_rating = $rating->ratings;
            }  ?>
                <h3 id="rating"></h3>	
            <script type="text/javascript">
            $("#rating").rating({
                "value": <?php echo $average_rating ?>,
                'half': true,
                
            });
            </script>
            <!-- <ul class="star-rating">
                <li><span class="fa fa-star checked"></span></li>
                <li><span class="fa fa-star checked"></span></li>
                <li><span class="fa fa-star checked"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li class="review"><a href="#"><span class="fa fa fa-edit"></span></a></li>
                <span class="review-count">( 0 Customer Reviews )</span>
            </ul> -->
            <?php
				$msgYes = "Available";
				$msgNo = "N/A";
				?>
            <!-- <p class="avail-count">Availability :  -->
            <!-- <span class="green"><?php //echo ($products->inStock == 1) ? $msgYes : $msgNo; ?>
                    </span>
                    </p> -->
            <p class="pd-price">Price : <span class="green">&#8377; <?= $price ?>/-</span> <small>&#x20B9;
                    <strike><?= $mrp ?></strike></small></p>
            <p class="pd-price">Color: <span class="badge" id="showcolor"
                    style="background-color: <?= $color ?>;"></span>
                <input type="text" readonly="" id="showcolor1" name="color" value="<?= $color ?>"
                    style="border: none">

                <br>
                <span>More Colors: </span>
                <select required="" id="color">
                    <option value="<?= $color ?>"><?= $color ?></option>
                    <?php foreach ($productInformation as $key) { ?>
                    <option value="<?= $key->stockColor ?>"><?= $key->stockColor ?></option>
                    <?php } ?>
                </select>
            </p>

            <!-- <p class="pd-price">Choosed Size: <span class="" id="showsize"><?= $size ?></span>-->
            <p class="pd-price">Size: <span class=""><input id="showsize" type="text" value="<?= $size ?>"
                        name="size" readonly="" style="border: none;"></span>

                <span>More Sizes:</span>
                <select required="" id="size">
                    <option value="<?= $size ?>"><?= $size ?></option>
                    <?php foreach ($productInformation as $key) { ?>
                    <option value="<?= $key->stockSize ?>"><?= $key->stockSize ?></option>
                    <?php } ?>
                </select>
            </p>
            <p class="pd-price">Choose Brand: <span class="">
                    <!--    <select name="brand" id="brand1" style="border: none; select::-ms-expand {display: none;}" readonly="">
                <option value="<?= $products->brand ?>"><?= $products->brandName ?></option>
            </select>
        &nbsp;&nbsp;</span>  -->
                    <select name="brand" required="" id="brand" style="width: auto;">
                        <option value="<?= $brandName ?>"><?= $brandName ?></option>
                        <?php foreach ($productInformation as $key) { ?>
                        <option value="<?= $key->stockBrand ?>"><?= $key->productBrandName ?></option>
                        <?php } ?>
            </p>

            <input type="hidden" value="<?= $thumbnail1 ?>" name="image">
            <div class="pd-qty">
                <span>QTY</span>
                <select name="qty" id="qty">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>

                <!-- <form method="post" action="<?= base_url() ?>addToCart"> -->

                <input type="hidden" readonly="" value="<?= $id ?>" name="">
                <input type="hidden" readonly="" value="<?= $this->session->userdata('productId') ?>" name="id">

                <input type="hidden" readonly="" value="<?= $productName ?>" name="product_name">
                <!-- <input type="hidden" value="<?= $thumbnail1 ?>" name="image">
                     <input type="text" value="<?= $size ?>" name="size">
                    <span>Size</span>
                    <select name="size" required="" id="size">
                    <?php foreach ($productInformation as $key) { ?>
                            <option value="<?= $key->stockSize ?>"><?= $key->stockSize ?></option>
                      <?php } ?>
                      </select> -->
                <hr>
                <input type="hidden" name="productCode" value="<?= $this->session->userdata('stockProductCode') ?>">
                <!-- <input type="hidden" name="product_name" value="<?= $this->session->userdata('productName') ?>"> -->
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn-info" name="add" id="cartBtnId"><i
                                class="fa fa-shopping-cart"></i> Add to cart
                        </button>
                    </div>
                    <div class="col-sm-6">
                        <h6><a href="<?=base_url()?>Category/<?=str_replace('+', '-', urlencode($products->categoryName))?>" class="btn btn-warning btn-sm"
                                style="margin-top: -15px;">Continue
                                Shopping</a></h6>
                    </div>
                </div>

                <!-- <input type="hidden" name="productCode" value="<?= $product->productCode; ?>" readonly=""> -->
                <!-- <input type="hidden" readonly="" value="<?= $product->id ?>" name="id"> -->
                <!--  <input type="hidden" readonly="" value="<?= $product->productName ?>" name="product_name"> -->
                <!-- <input type="hidden" name="brand" value="<?= $product->brand ?>" readonly> -->
                <!-- <input type="hidden" name="color" value="<?= $product->color ?>" readonly> -->
                <!-- <input type="hidden" value="1" name="qty"> -->
                <!-- <input type="hidden" value="<?= $product->thumbnail1 ?>" name="image"> -->
                <!-- <input type="hidden" value="<?= $product->size ?>" name="size"> -->
                <!-- <button type="submit" class="btn-info add-to-cart" name="add">Add to cart</button> -->
                <br><br>
                <p class="pd-categories">Categories : <span><a style="color:green"
                            href="<?= base_url() ?>Category/<?= str_replace('+', '-', urlencode($products->categoryName)) ?>"><?= $products->categoryName ?></a></span>
                </p>
                <div class="row">

                    <?php foreach ($all_category as $value) { ?>
                    <div class="col-sm-6">
                        <span><a style="color:green"
                                href="<?= base_url() ?>Category/<?= str_replace('+', '-', urlencode($value->categoryName)) ?>"
                                title="<?= $value->categoryName ?>"><?= $value->categoryName ?></a></span>
                    </div>
                    <?php

						} ?>

                </div>


                <!-- <p class="pd-tags">Tags :<span> Lorem, Ipsum</span></p> -->
                <!-- <span class="action"><i class="fa fa-heart"></i> Add to Wishlist</span> -->
                <!-- <span class="action"><i class="fa fa-refresh "></i> Compare</span> -->
                <!-- ul class="links">
						<span>Share :</span>
						<li><a href="#"><i class="fa fa-facebook-f "></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-rss"></i></a></li>
					</ul> -->
            </div>
            <div class="sharethis-inline-share-buttons"></div>
        </form>
    </div>

    <div class="pd-description clearfix">
        <ul class="section-navs col-md-3 col-sm-3" style="color: white;">
            <a data-toggle="tab" href="#description">
                <li class="active">FEATURES</li>
            </a>
            <a data-toggle="tab" href="#information">
                <li>DESCRIPTION</li>
            </a>
            <a data-toggle="tab" href="#review">
                <li>REVIEW</li>
            </a>
        </ul>
        <div class="tab-content col-md-9 col-sm-9">
            <div id="description" class="tab-pane fade in active">
                <?= $features ?>
            </div>
            <div id="information" class="tab-pane fade">
                <?= $productDescription?>
            </div>
            <div id="review" class="tab-pane fade">
                <p>Rating and Review</p>
                <?php foreach($get_rating_review as $review){
                    
                    ?>
                    <span><?=$review->ratings?><i class="fa fa-star " style="color:yellow"></i> by- <b><?=$review->customerName;?></b></span>
                    <p><?=$review->reviews?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
	// endforeach;  
	?>
    <?php foreach ($re_products as $p):
//		echo $p->productName ."<br>";
		?>
    <?php endforeach; ?>
    <!--	for the recommended product -->
    <div class="pd-slider">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <h3 class="rd-prdct">RECOMMENDED PRODUCTS</h3>
            <!-- Indicators -->
            <!-- Left and right controls -->
            <a class="left" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left fa fa-angle-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right  fa fa-angle-right"></span>
                <span class="sr-only">Next</span>
            </a>
            <?php
			$is_active = true;
			$i = 0;
			?>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
				foreach ($re_products as $p):
					//$productName=$product->productName;
					$namePro=urlencode($p->productName);
					$product_name=str_replace('+', '-', $namePro);

					$nameLen = strlen($p->productName);

					if ($nameLen >= 25) {
						$VisibleName = substr($p->productName, 0, 25) . '...';
					} elseif ($nameLen < 22) {
						$VisibleName = $p->productName . '....<br>';
					} else {
						$VisibleName = $p->productName;
					}

					$product_image = $p->thumbnail1;
					if($product_image!=""){
						$thumbnail = $p->thumbnail1;
					}else{
						$thumbnail = "no-image.png";
					}
					?>
                <?php if ($i % 4 == 0): ?>
                <div class="item<?php if ($is_active) echo ' active' ?>">
                    <?php endif ?>
                    <div class="pd-item" style="width: 250px;">
                        <a href="<?= base_url() . 'products/' . $product_name; ?>">
                            <img class="img img-responsive img-thumbnail"
                                src="<?=  base_url() ?>uploads/product/<?= $thumbnail?>"
                                style="height: 230px; width: 200px;" />
                            <div class="text-center">
                            <h4><?= $VisibleName ?></h4>
                                    <h4>Rs.<?= $p->price ?></h4>
                            </div>
                            
                        </a>
                    </div>


                    <?php if (($i + 1) % 4 == 0 || $i == count($re_products) - 1): ?>
                </div>
                <?php endif ?>
                <?php
					$i++;
					if ($is_active) $is_active = false;
				endforeach;
				?>
            </div>

        </div>
    </div>
</div>


<script>
$(function() {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function(event, ui) {
            $("#amount").val("Rs." + ui.values[0] + " - Rs." + ui.values[1]);
        }
    });
    $("#amount").val("Rs." + $("#slider-range").slider("values", 0) +
        " - Rs." + $("#slider-range").slider("values", 1));
});
</script>

<script type="text/javascript">
// $(window).on('load', function() {
//     $('#myModal').modal('show');
// });
// e.preventDefault();
</script>
<script type="text/javascript">
/*=========== bg-fun ==============*/

$(document).ready(function(e) {
    
    $('label.bg').click(function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('input', this).attr('checked', false);
        } else {
            $(this).addClass('active');
            $('input', this).attr('checked', true);
        }
        return false;
    });

    $('label.bg-fun').click(function() {

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('input', this).attr('checked', false);
        } else {
            $(this).addClass('active');
            $('input', this).attr('checked', true);
        }
        return false;
    });
});
$(window).scroll(function() {
    if ($(window).scrollTop() >= 1) {
        $('nav').addClass('fixed-header');
    } else {
        $('nav').removeClass('fixed-header');
    }
});
</script>

<script type="text/javascript">
//show selected size from aviable size  in the choosed size section
$(document).ready(function() {
    $("#size").change(function() {
        $('#showsize').val($("#size").val());
        $("#cartBtnId").html("Add to Cart <i class='fa fa-shopping-cart'></i>");
        $('#cartBtnId').prop('disabled', false);
        $("#cartBtnId").click(addCart);
    });

    $("#color").change(function() {
        $('#showcolor1').val($("#color").val());
        $("#cartBtnId").html("Add to Cart <i class='fa fa-shopping-cart'></i>");
        $('#cartBtnId').prop('disabled', false);
        $("#cartBtnId").click(addCart);
    });

    $("#brand").change(function() {
        $("#cartBtnId").html("Add to Cart <i class='fa fa-shopping-cart'></i>");
        $('#cartBtnId').prop('disabled', false);
        $("#cartBtnId").click(addCart);
    });
    $("#qty").change(function() {
        $("#cartBtnId").html("Add to Cart <i class='fa fa-shopping-cart'></i>");
        $('#cartBtnId').prop('disabled', false);
        $("#cartBtnId").click(addCart);
    });

});
</script>


<script type="text/javascript">
//Script for adding cart using validatejs ajax
$("form[name='Cart']").validate({


    submitHandler: function(form) {
        //debugger
        // alert('submit handler os working');
        //Your code for AJAX starts
        $.ajax({
            url: "<?php echo base_url() ?>Product/addToCartProduct",
            method: "POST",
            data: $(form).serialize(),
            dataType: "Json",
            beforeSend: function() {
                // console.log($(form).serialize());
                // console.log('beforeSend function executes');
                $("#cartBtnId").html(
                    "Checking <i class='fa fa-spin'><span class='fa fa-spinner'></span></span>"
                );
                $('#cartBtnId').prop('disabled', true);
            },
            success: function(data) {
                if (data.Response == 1) {
                    $("#cartBtnId").html("Added To Cart");
                } else if (data.Response == 0) {
                    $("#cartBtnId").html("Out of Stock");
                    $("#cartBtnId").attr("disabled", "disabled");
                }

                // $("#amountvalue").replaceWith(data);
            },
            error: function(data) {
                console.log(data);
                // data.ResponseText()
                // alert('error' + JSON.stringify(data));
            }
        });

    }
});
</script>
<script type="text/javascript">
function addCart() {
    // alert("this function works");
    //Script for adding cart using validatejs ajax
    $("form[name='Cart']").validate({


        submitHandler: function(form) {
            //debugger
            // alert('submit handler os working');
            //Your code for AJAX starts
            $.ajax({
                url: "<?php echo base_url() ?>Product/addToCartProduct",
                method: "POST",
                data: $(form).serialize(),
                dataType: "Json",
                beforeSend: function() {
                    // console.log($(form).serialize());
                    // console.log('beforeSend function executes');
                    $("#cartBtnId").html(
                        "Checking <i class='fa fa-spin'><span class='fa fa-spinner'></span></span>"
                    );
                    $("#cartBtnId").attr("disabled", "disabled");
                },
                success: function(data) {
                    if (data.Response == 1) {
                        $("#cartBtnId").html("Added To Cart");
                    } else if (data.Response == 0) {
                        $("#cartBtnId").html("Out of Stock");
                        $("#cartBtnId").attr("disabled", "disabled");
                    }

                    // $("#amountvalue").replaceWith(data);
                },
                error: function(data) {
                    console.log(data);
                    // data.ResponseText()
                    // alert('error' + JSON.stringify(data));
                }
            });

        }
    });
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="<?=base_url()?>assets/home/plugins/js/zoomsl.js"></script>
<script src="<?=base_url()?>assets/home/plugins/js/script.js"></script>