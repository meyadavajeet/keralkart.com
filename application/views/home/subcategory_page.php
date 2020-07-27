<?php 
// Program to display current page URL. 
#check the url wheather it is in the http or in https format
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
#change the string into array with the explode funtion of php 
$newLink = explode('/', $link);
#get the last object of array by using end() function
// end($newLink);
?> 

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!-- <script src="<?= base_url() ?>assets/home/css/slidebar.css"></script> -->
<!-- <script src="<?= base_url() ?>assets/home/css/jquery-ui.css"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 -->
<link href="<?php echo base_url(); ?>assets/home/css/jquery-ui.css" rel="stylesheet">

<div class="row" id="row5" style="">
    <input type="hidden" name="categoryName" id="categoryName" value="<?=end($newLink)?>">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="
    ">
      

            <div class="list-group left-menu text-center">
             <div class="sub-section">PRICE
    

</div>
             <ul id="myUL">
                 <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="65000" />
                <!-- <p id="amount">1000 - 65000</p> -->
                <!-- <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                <div id="slider-range" style="height: 10px;"></div> -->

                <p id="price_show">0 - 65000</p>
                <div id="price_range" style="height: 10px; margin-left: 15px;"></div>
            </div>  
             </ul>
             <p></p>
               
        <!-- <div class="left-menu">
            <div>
                <label class="sub-section" for="amount">Price range:</label>
                <div id="slider-range"></div>
                <input type="text" id="amount" readonly style="border:0;color:#f6931f;font-weight:bold;width:120px;padding:12px 2px;">
            </div>
        </div> -->
     <!--    <div class="left-menu">
            <div class="sub-section">BRAND</div>

            <ul id="myUL">
              <?php
                foreach($brand_data->result_array() as $row)
                {
                ?>
                  <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['id']; ?>"  > <?php echo $row['brandName']; ?></label>
                </div>
                <?php
                }
            ?>


             
             
            </ul>
            <p></p> -->
            <script>
            function myFunction() {
                var input, filter, ul, li, a, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
            </script>
      <!--   </div> -->
        <div class="left-menu">
            <div class="sub-section">COLOR</div>
              <?php
                foreach($color_data->result_array() as $row)
                {
                ?>
                  <div class="list-group-item checkbox"  style="background-color:<?php echo $row['color']; ?>; height: 10x; width: 10px; margin: 0 5px; display: inline-block;">
                    <label><input type="checkbox" class="common_selector color" style="background-color:<?php echo $row['color']?>;" value="<?php echo $row['color']; ?>" >
                    </label>
                </div>
                <?php
                }
            ?>
       <!--      <div class="brand"><input type="checkbox">&nbsp;Blue</div>
            <div class="brand"><input type="checkbox">&nbsp;Red</div>
            <div class="brand"><input type="checkbox">&nbsp;Green</div>
            <div class="brand"><input type="checkbox">&nbsp;Black</div> -->
        </div>
         
        <div class="left-menu">

            <div class="sub-section">SIZE</div>
            <ul id="showUl">
                <?php
                foreach($size_data->result_array() as $row)
                {
                ?>
                  <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="common_selector size" value="<?php echo $row['size']; ?>" ><?php echo $row['size']; ?></label>
                </div>
                <?php
                }
            ?>

            </ul>
<!--            <div class="showAll"><a href="#" id="showAll">show all</a></div>-->
<!--            <div class="showLess"><a href="#" id="showLess">show less</a></div>-->
        </div>

    </div>



    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-9">
        <div id="breadcrumbContainer"></div>
        <div class="row" style="padding:12px;">
            <!-- <div class="select">
                Short By
                <select>
                    <option value="">Popularity</option>
                    <option value="">Latest Material</option>
                </select>
            </div>
            <div class="select">
                Price
                <select>
                    <option value="">Low to high</option>
                    <option value="">High to low</option>
                </select>
            </div> -->
            <div align="center" id="pagination_link"></div>
        </div>
        <div class="row " style="padding:12px; ">
            <div class="container-fluid filter_data">
             <style>
                #loading {
                    text-align: center;
                    background: url('<?php echo base_url(); ?>asset/loader.gif') no-repeat center;
                    height: 150px;
                }
            </style>

            <?php 

				foreach ($products as $product):

					//$productName=$product->productName;
					$namePro=urlencode($product->productName);
					$product_name=str_replace('+', '-', $namePro);

					$nameLen= strlen($product->productName);

					if ($nameLen>=31) {
						$VisibleName=substr($product->productName,0,20).'...';
					}
					elseif ($nameLen<22) {
						$VisibleName=$product->productName.'<br><br>';
					}
					else{
						$VisibleName=$product->productName;
					}
      	 	 ?>
            <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-2" style="padding-bottom: 15px; ">
                <div class="item">
                    <center>
                        <a href="<?=base_url().'products/'.$product_name?>"><img width="" class="img img-responsive img-thumbnail"
                                src="<?= base_url() ?>uploads/product/<?=$product->thumbnail2?>" style="height: 200px; width: 150px;">
						</a>
					</center>
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
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
 <style>
    #loading {
        text-align: center;
        background: url('<?php echo base_url(); ?>assets/images/loader.gif') no-repeat center;
        height: 150px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
  filter_data(1);

        function filter_data(page) {
            $('.filter_data').html('<div id="loading" style=""></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var brand = get_filter('brand');
            var color = get_filter('color');
            var size = get_filter('size');
            var categoryName = $('#categoryName').val();
            // alert(categoryName);
            // alert(brand);
            // alert(minimum_price);
            // alert(maximum_price);
            // alert(color);
            // alert(size);

            $.ajax({
                url: "<?php echo base_url(); ?>Product_filter_subcategory/fetch_data/" + page,
                method: "POST",
                dataType: "JSON",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    color: color,
                    size: size,
                    categoryName: categoryName
                },
                success: function(data) {
                    $('.filter_data').html(data.product_list);
                    $('#pagination_link').html(data.pagination_link);
                }
            })
        }


        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            filter_data(page);
        });

        $('.common_selector').click(function() {
            filter_data(1);
        });


        $('#price_range').slider({
            range: true,
            min: 0,
            max: 65000,
            values: [0, 65000],
            step: 500,
            stop: function(event, ui) {
                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data(1);
            }

        });

    });
    </script>