<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add New Stock</li>
    </ol>
</section>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
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

<!-- Main content -->
<section class="content">
    <!-- Small boxes (start box) -->
    <div class="row">
        <div class="col-sm-6">
            <!-- general form elements -->
            <div class="box box-primary panel panel-success">
                <div class="box-header panel-heading">
                    <h3 class="box-title">
                        Add New Stock
                    </h3>
                    <div class="pull-right">
                    <a href="<?=base_url();?>stock" class="btn btn-warning"><i class="fa fa-eye"></i>
                            Stock List
                    </a>
                    </div>
                </div>
                <!-- form start -->
                <form method="post" action="<?php echo base_url() ?>Welcome/stockCreate" role="form">
                    <div class="box-body panel-body">
                        

                        <div class="form-group">
                            <label for="categoryId">Select Product</label>
                            <select name="productId" id="brandId" class="form-control brandId">
                                <option value=""> Select Product to add in stock </option>
                                <?php foreach ($productList as $rows): ?>
                                <option value="<?=$rows->id;?>"><?=$rows->productName;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Product Code </label>
                            <input class="form-control" id="productCode" type="text" readonly="" name="productCode" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">M.R.P </label>
                            <div>
                                <input type="number" class="form-control" id="mrp" name="mrp" required="">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Discount </label>
                            <div >
                                <input type="number" class="form-control" id="discount" placeholder="in %" name="discount">
                            </div>
                        </div> 

                         <div class="form-group">
                            <label class="control-label">Selling price </label>
                            <div >
                                <input type="text" class="form-control" id="price" name="price" required="">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label">Quantity </label>
                            <div >
                                <input type="number" class="form-control" id="" name="quantity" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Color </label>
                            <div >
                                <input type="color" class="form-control" id="" name="color">
                            </div>
                        </div> 

                       
                        
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input id="size" class="form-control" type="text" name="size">
                        </div>
						<div class="form-group">
							<label for="delivery_charge">Delivery Charge</label>
							<input id="delivery_charge" class="form-control" min="0" type="number" name="delivery_charge">
						</div>
                      
                        <div class="form-group">
                            <label>Status </label>
                            <select name="status" id="status" class="form-control" required="required">
                                <option value="">Select Status </option>
                                <option value="1">YES</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-block ">Submit</button>
                    </div>
                </form>
            </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    	$(document).ready(function() {
		$('.brandId').select2();
	});
   
    $('#brandId').change(function() {
        var categoryId = $('#brandId').val();
        //alert(categoryId);
        if (categoryId != '') {
            $.ajax({
                url: "<?php echo base_url(); ?>Welcome/fetch_productCode",
                method: "POST",
                data: {
                    categoryId: categoryId
                },
                success: function(data) {
                    $('#productCode').val(data);
                    $('#productId').val(categoryId);
                   // alert(data);
                }
            });
        } else {
            $('#productCode').val(data);
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
