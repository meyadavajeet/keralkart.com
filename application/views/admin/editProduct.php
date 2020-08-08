<style type="text/css">
.upload {
    border: 1px dashed #bbb;
    width: 100px;
    padding: 3%;
    border-radius: 10px 10px;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Publish Product</li>
    </ol>
</section>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <?php if ($this->session->userdata('success_msg')) { ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>
                <center> <?= $this->session->flashdata('success_msg'); ?> </center>
            </strong>
        </div>
        <?php } ?>
        <?php if ($this->session->userdata('error_msg')) { ?>
        <div class="alert alert-danger alert-dismissible ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> <?= $this->session->flashdata('error_msg'); ?></strong>
        </div>
        <?php } ?>
    </div>
</div>
<div class="col-sm-2"></div>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Product</h3>
                </div>
                <?php 
                foreach ($products as $productsList):?>
                <form class="form-horizontal" id="incomeForm" name="myForm" method="post"
                    action="<?= base_url() ?>update-product" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $productsList->id;?>" name="id">
                            <label class="col-sm-3 control-label">Category Name</label>
                            <div class="col-sm-9">
                                <select id="categoryId" name="categoryId" class="form-control">
                                    <option value="<?=$productsList->categoryId;?>"><?=$productsList->categoryName;?>
                                    </option>
                                    <?php foreach ($categoryListData as $key => $value):
                                       ?>
                                    <option value="<?=$value->id;?>"><?=$value->categoryName?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Subcategory Name </label>
                            <div class="col-sm-9">
                                <select class="form-control" id="subCategoryId" name="subcategory">
                                    <option value="<?=$productsList->subcategoryId;?>"><?=$productsList->subCategoryName?>
                                    </option>
                                </select>
                            </div>
                        </div>
<!-- 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Brand </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="brand">
                                    <option value="<?=$productsList->brid?>"><?=$productsList->brName;?></option>
                                    <?php foreach ($brandList as $key => $value):
                                       ?>
                                    <option value="<?=$value->id?>"><?=$value->brandName?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Product Name </label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $productsList->productName;?>" class="form-control"
                                    id="" name="productName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Product Code </label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $productsList->productCode;?>" class="form-control" id="" name="productCode">
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-sm-3 control-label">M.R.P </label>
							<div class="col-sm-9">
								<input type="number" value="<?php echo $productsList->mrp;?>" class="form-control" id=""
									   name="mrp">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Selling price </label>
							<div class="col-sm-9">
								<input type="number" value="<?php echo $productsList->price;?>" class="form-control"
									   id="" name="price">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Delivery Charge </label>
							<div class="col-sm-9">
								<input type="number" value="<?php echo $productsList->delivery_charge;?>" class="form-control"
									   id="" name="delivery_charge">
							</div>
						</div>


						<div class="form-group">
                            <label class="col-sm-3 control-label">Weight </label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $productsList->weight;?>" class="form-control"
                                    id="" name="weight">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"> </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Is it a Premium Product?</label>
                                        <select name="premium" class="form-control">
                                            <option value="">Select Options</option>
                                            <?php 
                                                    if ($productsList->premium=='1') {
                                                        ?><option selected="" value="1">Yes</option>
                                            <option value="0">No</option><?php
                                                    }
                                                    elseif($productsList->premium=='0'){
                                                        ?><option selected="" value="0">No </option>
                                            <option value="1">Yes</option><?php
                                                    }else{
                                                        ?>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                            <?php
                                                    }
                                                    ?>

                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Is it a Hot Deal product?</label>
                                        <select name="hotdeal" class="form-control">
                                            <option value="">Select Options</option>
                                            <?php 
                                                    if ($productsList->hotdeal=='1') {
                                                        ?><option selected="" value="1">Yes</option>
                                            <option value="0">No</option><?php
                                                    }
                                                    elseif($productsList->hotdeal=='0'){
                                                        ?><option selected="" value="0">No </option>
                                            <option value="1">Yes</option><?php
                                                    }else{
                                                        ?>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                            <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">

                                        <label>Is it in stock?</label>
                                        <select name="inStock" class="form-control">
                                            <option value="">Select Options</option>
                                            <?php 
                                                    if ($productsList->inStock=='1') {
                                                        ?><option selected="" value="1">Yes</option>
                                            <option value="0">No</option><?php
                                                    }
                                                    elseif($productsList->inStock=='0'){
                                                        ?><option selected="" value="0">No </option>
                                            <option value="1">Yes</option><?php
                                                    }else{
                                                        ?>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                            <?php
                                                    }
                                                    ?>
                                        </select>

                                    </div>
                                    <div class="col-sm-3">

                                        <label>Is it a latest collection?</label>
                                        <select name="latestCollection" class="form-control">
                                            <option value="">Select Options</option>
                                            <?php 
                                                    if ($productsList->latestCollection=='1') {
                                                        ?><option selected="" value="1">Yes</option>
                                            <option value="0">No</option><?php
                                                    }
                                                    elseif($productsList->latestCollection=='0'){
                                                        ?><option selected="" value="0">No </option>
                                            <option value="1">Yes</option><?php
                                                    }else{
                                                        ?>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                            <?php
                                                    }
                                                    ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                                if (empty($productsList->thumbnail1) || ($productsList->thumbnail1=='NULL')) {
                                    $thumbnail1='no-image.png';
                                }
                                else{
                                    $thumbnail1=$productsList->thumbnail1;
                                }
                                if (empty($productsList->thumbnail2) || ($productsList->thumbnail2=='NULL')) {
                                    $thumbnail2='no-image.png';
                                }
                                else{
                                    $thumbnail2=$productsList->thumbnail2;
                                }

                                if (empty($productsList->thumbnail3) || ($productsList->thumbnail3=='NULL')) {
                                    $thumbnail3='no-image.png';
                                }
                                else{
                                    $thumbnail3=$productsList->thumbnail3;
                                }

                                if (empty($productsList->thumbnail4) || ($productsList->thumbnail4=='NULL')) {
                                    $thumbnail4='no-image.png';
                                }
                                else{
                                    $thumbnail4=$productsList->thumbnail4;
                                }
                                ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Upload Images </label>
                            <div class="col-sm-9">

                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img class="file1" id="img1"
                                                src="<?=base_url()?>uploads/product/<?=$thumbnail1?>" width="80px">
                                            <input type="file" name="thumbnail1" onchange="readURL1(this)" id="my_file1"
                                                value="hello.jpg" style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img id="img2" class="file2"
                                                src="<?=base_url()?>uploads/product/<?=$thumbnail2?>" width="80px">
                                            <input type="file" name="thumbnail2" onchange="readURL2(this)" id="my_file2"
                                                style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img class="file3" id="img3"
                                                src="<?=base_url()?>uploads/product/<?=$thumbnail3?>" width="80px">
                                            <input type="file" accept="image" name="thumbnail3" id="my_file3"
                                                onchange="readURL3(this)" style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img class="file4" id="img4"
                                                src="<?=base_url()?>uploads/product/<?=$thumbnail4?>" width="80px">
                                            <input type="file" name="thumbnail4" id="my_file4" onchange="readURL4(this)"
                                                style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Small Description </label>
                            <div class="col-sm-9">
                                <textarea class="form-control"
                                    name="smallDescription"><?php echo $productsList->smallDiscription;?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Features</label>
                            <div class="col-sm-9">
                                <textarea id="features" name="features" class="form-control"
                                    rows="10"><?php echo $productsList->productDescription;?></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description"
                                    rows="10"><?php echo $productsList->features;?></textarea>

                            </div>
                        </div>
                    
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?= base_url() ?>dashboard"><button type="button"
                                class="btn btn-danger ">Cancel</button></a>
                        <button type="submit" class="btn btn-info pull-right" name="update" id="submit">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <?php 
                endforeach;
                ?>
                <!--form Ends here-->
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img4').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script type="text/javascript">
$(".file1").click(function() {
    $("input[id='my_file1']").click();
});

$(".file2").click(function() {
    $("input[id='my_file2']").click();
});

$(".file3").click(function() {
    $("input[id='my_file3']").click();
});

$(".file4").click(function() {
    $("input[id='my_file4']").click();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    CKEDITOR.replace('description');
    CKEDITOR.replace('features');
    $('#categoryId').change(function() {
        var categoryId = $('#categoryId').val();
        if (categoryId !== '') {
            $.ajax({
                url: "<?php echo base_url(); ?>Welcome/fetch_subcategory",
                method: "POST",
                data: {
                    categoryId: categoryId
                },
                success: function(data) {
                    $('#subCategoryId').html(data);
                }
            });
        } else {
            $('#subCategoryId').html('<option value="">Select SubCategory</option>');
        }
    });

});

// calculate discount from mrp to selling price on the discount percentage
// Reusable helper functions
const calculateSale = (listPrice, discount) => {
  listPrice = parseFloat(listPrice);
  discount  = parseFloat(discount);
  return (listPrice - ( listPrice * discount / 100 )).toFixed(2); // Sale price
}
const calculateDiscount = (listPrice, salePrice) => {
  listPrice = parseFloat(listPrice);
  salePrice = parseFloat(salePrice);
  return 100 - (salePrice * 100 / listPrice); // Discount percentage
}

// Our use case
const $list = $('input[name="mrp"]'),
      $disc = $('input[name="discount"]'), 
      $sale = $('input[name="price"]'); 
    
$list.add( $disc ).on('input', () => { // List and Discount inputs events
  let sale = $list.val();              // Default to List price
  if ( $disc.val().length ) {          // if value is entered- calculate sale price
    sale = calculateSale($list.val(), $disc.val());
  }
  $sale.val( sale );
});

$sale.on('input', () => {      // Sale input events
  let disc = 0;                // Default to 0%
  if ( $sale.val().length ) {  // if value is entered- calculate the discount
    disc = calculateDiscount($list.val(), $sale.val());
  }
  $disc.val( disc );
});

// Init!
$list.trigger('input');
</script>
