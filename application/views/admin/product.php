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
        <li><a href="<?=base_url()?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Publish Product</li>
    </ol>
</section>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <?php if ($this->session->userdata('success_msg')) {?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>
                <center> <a href="<?=base_url()?>add-stock"><?=$this->session->flashdata('success_msg');?> </a></center>
            </strong>
        </div>
        <?php }?>
        <?php if ($this->session->userdata('error_msg')) {?>
        <div class="alert alert-danger alert-dismissible ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> <?=$this->session->flashdata('error_msg');?></strong>
        </div>
        <?php }?>
    </div>
</div>
<div class="col-sm-2"></div>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary panel-success">
                <div class="box-header panel-heading">
                    <h3 class="box-title">Add New Product</h3>
                    <a href="<?=base_url();?>product-list" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> Product List </a>
                </div>
                <form class="form-horizontal" id="incomeForm" name="myForm" method="post"
                    action="<?=base_url()?>Welcome/addProduct" enctype="multipart/form-data">
                    <div class="box-body panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select id="categoryId" name="categoryId" class="form-control">
                                    <option value="">Select Category </option>
                                    <?php foreach ($categoryListData as $key => $value): ?>
                                    <option value="<?=$value->id?>"><?=$value->categoryName?>(<?=$value->typeName?>)</option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Subcategory Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="subCategoryId" name="subcategory">
                                    <option value="0">Select Sub-Category</option>
                                </select>
                            </div>
                        </div>
                       <!--  <div class="form-group">
                            <label class="col-sm-3 control-label">Brand </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="brand" required="">
                                    <option>Select Brand</option>
                                    <?php foreach ($brandList as $key => $value): ?>
                                    <option value="<?=$value->id?>"><?=$value->brandName?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="productName" required="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Product Code <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="productCode" required="">
                            </div>
                        </div>


                        <!-- <div class="form-group">
                            <label class="col-sm-3 control-label">M.R.P </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="mrp" name="mrp" required="">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label class="col-sm-3 control-label">Discount </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="discount" placeholder="in %" name="discount">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label class="col-sm-3 control-label">Selling price </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="price" name="price" required="">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">Quantity </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="" name="quantity" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Color </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="color">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label class="col-sm-3 control-label">Size </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="size" required="">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Weight </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="weight" placeholder="20kg">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"> </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Is it a Premium Product?<span class="text-danger">*</span></label>
                                        <select name="premium" class="form-control" required="">
                                            <option value="">Select Options</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Is it a Hot Deal product?<span class="text-danger">*</span></label>
                                        <select name="hotdeal" class="form-control" required="">
                                            <option value="">Select Options</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">

                                        <label>Is it in stock?<span class="text-danger">*</span></label>
                                        <select name="inStock" class="form-control" required="">
                                            <option value="">Select Options</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                    </div>
                                    <div class="col-sm-3">

                                        <label>Is it a latest collection?</label>
                                        <select name="latestCollection" class="form-control" required="">
                                            <option value="">Select Options</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Upload Images  </label>
                            <div class="col-sm-9">

                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img class="file1" id="img1"
                                                src="<?=base_url()?>assets/images/upload-image.png" width="80px">
                                            <input type="file" name="images1" onchange="readURL1(this)" id="my_file1"
                                                style="display: none;" required="" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img id="img2" class="file2"
                                                src="<?=base_url()?>assets/images/upload-image.png" width="80px">
                                            <input type="file" name="images2" onchange="readURL2(this)" id="my_file2"
                                                style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img class="file3" id="img3"
                                                src="<?=base_url()?>assets/images/upload-image.png" width="80px">
                                            <input type="file" accept="image" name="images3" id="my_file3"
                                                onchange="readURL3(this)" style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="upload">
                                            <img class="file4" id="img4"
                                                src="<?=base_url()?>assets/images/upload-image.png" width="80px">
                                            <input type="file" name="images4" id="my_file4" onchange="readURL4(this)"
                                                style="display: none;" /><br>
                                            <small>Upload Photos</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Small Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="smallDescription"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Features <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea id="features" name="features" class="form-control" rows="10"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description" rows="10"></textarea>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer panel-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="<?=base_url()?>dashboard"><button type="button"
                                        class="btn btn-danger btn-block ">Cancel</button></a>
                            </div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-info btn-block  pull-right" name="submit"
                                    id="submit">Submit</button>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-footer -->
                </form>
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
                url: "<?php echo base_url(); ?>allCategory",
                method: "POST",
                data: {
                    categoryId: categoryId
                },
                success: function(data) {
                    $('#subCategoryId').html(data);
                }
            });
        } else {
            $('#subCategoryId').html('<option value="0">Select SubCategory</option>');
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