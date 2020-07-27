<?php 
// Program to display current page URL. 
#check the url wheather it is in the http or in https format
// $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
//                 "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
//                 $_SERVER['REQUEST_URI']; 
// #change the string into array with the explode funtion of php 
// $newLink = explode('?', $link);
#get the last object of array by using end() function
// end($newLink);
?> 

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="<?php echo base_url(); ?>assets/home/css/jquery-ui.css" rel="stylesheet">

<div class="row" id="row5" style="">
    <input type="hidden" name="categoryName" id="categoryName" value="<?=$this->session->userdata('searchKeyword')?>">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="">
        <!-- <div style="font-size:12px;font-weight:500;text-transform:uppercase;color:#212121;font-weight:bold;margin:14px 2px;">CATEGORIES</div> -->
        <div class="left-menu">
            <div class="sub-section">CATEGORIES</div>
            <div class="accordions">
                   <?php
                     foreach ($type as  $view) {
                         $type_id=$view->id; 
                         // echo $type_id; 
                    ?>
                <div class="accordions-section">
                    <a class="accordions-section-title" href="#accordions-<?=$type_id?>"><?=$view->typeName;?></a>
                        <?php 
                         $sl =0;
                        foreach ($category_list as $key => $cat) {?>
                             <div id="accordions-<?=$type_id?>" class="accordions-section-content">
                                <?php 
                             if($cat->typeId==$view->id){
                          ?>
                        <div class="left-submenu"><?=++$sl ?>. <a href="<?=base_url()?>Category/<?=str_replace('+', '-', urlencode($cat->categoryName))?>"><?php echo $cat->categoryName;?></a><br></div>
                    <?php } ?>
                    </div>
                    <?php } ?>
                </div>

                <?php } ?>
            </div>
        </div>

            <div class="list-group left-menu text-center">
             <div class="sub-section">PRICE</div>
             <ul id="myUL">
                 <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="65000" />
                <p id="price_show">0 - 65000</p>
                <div id="price_range" style="height: 10px;  margin-left: 15px;"></div>
            </div>  
             </ul>
    <!--     <div class="left-menu">
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
            </ul> -->
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
       <!--  </div> -->
        <div class="left-menu">
            <div class="sub-section">COLOR</div>
              <?php
                foreach($color_data->result_array() as $row)
                {
                ?>
                  <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="common_selector color" value="<?php echo $row['color']; ?>" ><?php echo $row['color']; ?></label>
                </div>
                <?php
                }
            ?>
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
        </div>

    </div>



    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-9">
        <div id="breadcrumbContainer"></div>
        <div class="row" style="padding:12px;">
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
                url: "<?php echo base_url(); ?>Product_filter/fetch_data/" + page,
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
