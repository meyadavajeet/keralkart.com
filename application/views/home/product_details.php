<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-theme.min.css">-->


<div class="container-fluid">
    <?php
  
	foreach ($product as $products):
    $thumbnail1=  $products->thumbnail1;
    $thumbnail2 = $products->thumbnail2;
    $thumbnail3 = $products->thumbnail3;
    $thumbnail4 = $products->thumbnail4;
    $price = $products->price;
    // $mrp = $products->stockPrice;
    // $sp = $products->sellingPrice;
    $color = $products->color;
    $size = $products->size;
    $brandName = $products->brandName;
    $id =  $products->id;
    $productName = $products->productName;
    $features = $products->features;
    $productDescription = $products->productDescription;
    $categoryName=$products->categoryName;
     endforeach;
	?>

    <div class="col-md-7 col-sm-7 col-xs-12 right-section" style="z-index:1">
        <div class="col-md-2 col-sm-4 col-xs-3">
            <ul class="nav section-navs">
                <li class="active">

                    <a data-toggle="tab" href="#image1">
                        <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail1 ?>" />
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#image2">
                        <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail2 ?>" />
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#image3">
                        <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail3 ?>" />
                    </a>
                </li>
                <li>

                    <a data-toggle="tab" href="#image4">
                        <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail4 ?>" />
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-10 col-sm-8 col-xs-9">
            <div class="tab-content">
				
                <div id="image1" class="tab-pane  in active">
                    <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail1 ?>"  class="block__pic imgsize"/>
                </div>
                 <div id="image2" class="tab-pane fade">
                    <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail2 ?>" class="block__pic" />
                </div>
                <div id="image3" class="tab-pane fade">
                    <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail3 ?>" class="block__pic" />
                </div>
                <div id="image4" class="tab-pane fade">
                    <img src="<?= base_url() ?>uploads/product/<?= $products->thumbnail4 ?>" class="block__pic" />
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-5 col-sm-5 col-xs-12 left-section">
        <form method="post" name="Cart" action="<?= base_url() ?>addToCartProduct">
            <h4><?= $products->productName ?></h4>
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
                     <?php foreach ($productInformation as $keys) { 
                            $sp=$keys->sellingPrices;
                            $mrp=$keys->stockPrice;
                         } ?>
            <p class="pd-price">Price : <span class="green price">&#8377; <?= $sp ?>/-</span> <small>&#x20B9;
                    <strike class="strike"><?= $mrp ?></strike></small></p>
            <p class="pd-price">Color: <span class="badge" id="showcolor"
                    style="background-color: <?= $products->color ?>;"></span>
                

                
                
                     <?php foreach ($productInformation as $key) { ?>
                    <input type="radio" value="<?= $key->stockColor ?>" checked="checked" name="color" class="color">
                    <span style="width: 8px;height: 5px;background-color: <?= $key->stockColor ?>;padding-left: 22px;padding-top: 5px"></span>
                    &nbsp; &nbsp; 
                    <?php } ?>
                    
            </p>
           
            <!-- <p class="pd-price">Choosed Size: <span class="" id="showsize"><?= $products->size ?></span>-->
            <p class="pd-price">Size: 

                
                <select name="size" required="" id="size">
                    <!-- <option value="<?= $products->size ?>"><?= $products->size ?></option> -->
                    <?php foreach ($productInformation as $key) { ?>
                    <option value="<?= $key->stockSize ?>"  <?php if($products->size == $key->stockSize) echo "selected"; ?> ><?= $key->stockSize ?></option>
                    <?php } ?>
                </select>
            </p>
          <!--   <p class="pd-price">Brand: <span class="">
    
                        <?php foreach ($productInformation as $key) { 
                            $brandName=$key->productBrandName;
                         } ?>
                    
                    <b><?=$brandName?></b> -->
                   <input type="hidden" id="brand" name="brand" value="<?=$brandName?>">
            </p>

            <input type="hidden" value="<?= $products->thumbnail1 ?>" name="image">
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

                <input type="hidden" readonly="" value="<?= $products->id ?>" name="">
                <input type="hidden" readonly="" value="<?= $this->session->userdata('productId') ?>" name="id" id='productid'>

                <input type="hidden" readonly="" value="<?= $products->productName ?>" name="product_name">
                <!-- <input type="hidden" value="<?= $products->thumbnail1 ?>" name="image">
                     <input type="text" value="<?= $products->size ?>" name="size">
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
                    <div class="col-sm-6 ">
                        <h6><a href="<?=base_url()?>Category/<?=str_replace('+', '-', urlencode($products->categoryName))?>" class="btn btn-warning btn-sm"
                                style="margin-top: -15px;">Continue
                                Shopping</a></h6>
                    </div>
                </div>
                
                
<script type="text/javascript">

$(document).ready(function ()
{
  $('.color').change(function ()
{
   var color= $(this).val();
   var productId=$('#productid').val();
   $.ajax({
          url:'<?= base_url()?>color-filter',
          type:'POST',
          dataType:"JSON",
          data:{color: color,productId},
          beforeSend: function() {
            console.log('Inside Before Send');
            console.log(data);
          },
          success: function(response){
    
            var d=response.length;
                $('.price').html(response[0].sellingPrice);
                  $('.strick').html(response[0].stockPrice);
       
          },
          error: function(data){
            console.log('I am failed');
            console.log(data);

          },
          complete: function() {
            console.log('I am completed');
          }

         });
  });  
  });
</script> 

                <!-- <input type="hidden" name="productCode" value="<?= $product->productCode; ?>" readonly=""> -->
                <!-- <input type="hidden" readonly="" value="<?= $product->id ?>" name="id"> -->
                <!-- <input type="hidden" readonly="" value="<?= $product->productName ?>" name="product_name"> -->
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
      <!--          <div class="row">

                    <?php foreach ($all_category as $value) { ?>
                    <div class="col-sm-6">
                        <span><a style="color:green"
                                href="<?= base_url() ?>Category/<?= str_replace('+', '-', urlencode($value->categoryName)) ?>"
                                title="<?= $value->categoryName ?>"><?= $value->categoryName ?></a></span>
                    </div>
                    <?php

						} ?>

                </div> -->


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
            
        </form>
<?php 
// Program to display URL of current page. 
  
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
  
// Here append the common URL characters. 
$link .= "://"; 
  
// Append the host(domain name, ip) to the URL. 
$link .= $_SERVER['HTTP_HOST']; 
  
// Append the requested resource location to the URL 
$link .= $_SERVER['REQUEST_URI']; 
      
// Print the link 
 $link; 

//https://www.facebook.com/plugins/share_button.php?href='.urlencode($link).'&appId=201511064046972

// $finalFBURL='https://www.facebook.com/dialog/feed?app_id=621572568420951&display=touch&link='.urlencode($link).'%2F&redirect_uri='.urlencode($link);
 $finalFBURL='https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fkeralkart.com%2F&appId=427813947821443';

 $linkedinURL='https://www.linkedin.com/shareArticle?mini=true&url='.$link.'&title=LinkedIn%20Developer%20Network&summary=My%20favorite%20developer%20program&source=LinkedIn';
$finalTwitterURL ='https://twitter.com/intent/tweet?url='.$link.'&text=keralkart%20blog';
?>

    <div class="post-shares sticky-shares">
        
        <a href="<?=$finalFBURL?>" id="shareBtn" title="Share to facebook" class="share-facebook"><img src="<?=base_url()?>assets/images/fb.png" width="22" height="22"></a>
        <a href="<?=$finalTwitterURL?>" title="Share to twitter" class="share-twitter"><img src="<?=base_url()?>assets/images/twitter.png" width="22" height="22"></a>
        
        <a title="Share via Whatsapp" href="https://wa.me/?text=<?=urlencode($link)?>" class="share-pinterest"><img src="<?=base_url()?>assets/images/whatsapp.png" width="22" height="22"></a>
        <a href="<?=$linkedinURL?>" target="_blank" title="share to linkedin" class="share-linkedin"><img src="<?=base_url()?>assets/images/icon-linkedin.webp" width="22" height="22"></a>
        <a href="mailto:?subject=Keral Kart&body=I have got a wonderful product for you! Please go through it  <?=$link?>" title="Share link via Email" class="share-envelope"><img src="<?=base_url()?>assets/images/envelope.png" width="22" height="22"></a>
        
    </div>

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
            <div id="description" class="tab-pane fade in active" >
                <?= $products->features ?>
            </div>
            <div id="information" class="tab-pane fade">
                <?= $products->productDescription ?>
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
	//endforeach;
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
                //echo count($re_products);
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
                        <a href="<?= base_url() . 'products/' . $p->slug; ?>">
                            <img class="img img-slides img-responsive img-thumbnail"
                                src="<?=  base_url() ?>uploads/product/<?= $thumbnail?>" />
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
            <style type="text/css">
                .img-slides{
                    height: 230px;
                    width: 200px;
                }
            </style>
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
        //alert('submit handler os working');
        //Your code for AJAX starts

        $.ajax({
            url: "<?php echo base_url() ?>Product/addToCartProduct",
            method: "POST",
            data: $(form).serialize(),
            dataType: "Json",
            // beforeSend: function() {
            //     // console.log($(form).serialize());
            //     // console.log('beforeSend function executes');
            //     $("#cartBtnId").html(
            //         "Checking <i class='fa fa-spin'><span class='fa fa-spinner'></span></span>"
            //     );
            //     $('#cartBtnId').prop('disabled', true);
            // },
            success: function(data) {
                //alert(data.Response);
                if (data.Response == 1) {
                    $("#cartBtnId").html("Added To Cart");
                } else if (data.Response == 0) {
                    $("#cartBtnId").html("Out of Stock");
                    $("#cartBtnId").attr("disabled", "disabled");
                }
location.reload();

                // $("#amountvalue").replaceWith(data);
            },
            error: function(data) {
                console.log(data);
                // data.ResponseText()
                 alert('error' + JSON.stringify(data));
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

                          location.reload();
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
