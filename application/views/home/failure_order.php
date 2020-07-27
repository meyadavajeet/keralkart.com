
<!--- Checkout section -->
<div class="container">

	<div class="sucs_box">
		<img src="<?=base_url()?>assets/home/images/failure.png" alt="failure image" />
		<h4 class="text-danger">Sorry Some Issue Please try after sometime</h4>
		<p>Due to some technical issue we can't recieve your order now.
			Sorry for the inconvenience. 
		</p>
	</div>
	<div class="margin-50 clearfix">
		<div class="cr_content col-md-8 col-sm-7 col-xs-12">
			<?php $i = 1; ?>
			        <?php foreach ($this->cart->contents() as $items):
			            $ProductInArrayId[]=$items['id']; 
			            $quantityOrder[]=$items['qty'];
			            $productName= str_replace(' ', '-', $items['name']);
			            $size=$items['options']['size'];
			            $sizes=explode(',', $size);

			        ?>
			        <div class="cr_tab clearfix">
			            <div class="col-sm-3 col-xs-12 text-center">
			                <img src="<?=base_url()?>uploads/product/<?=$items['options']['color']?>" class="img-responsive" alt="">
			            </div>
			            <div class="col-sm-9 col-xs-12"> 
			                    <div class="clearfix cr-info">
			                        <i>Not Returnable*</i>
			                        <h5><a class="text-success links" style="color: #000" href="<?=base_url().'products/'. urlencode(str_replace('_', '&', $productName))?>"><?=str_replace('_', '&', $items['name'])?></a> <span>| </span> <span>(10% OFF)</span></h5>
			                        
			                        <input type="hidden" name="" value="<?=$items['rowid']?>" id="rowid<?=$i?>">
			                        <p>Size :
			                            <select name="size" readonly="" disabled="">
			                                <option value="None">Size</option>
			                            
			                            <?php 
			                                foreach ($sizes as $key) {
			                                    echo '<option value="'.$key.'">'.$key.'</option>';
			                                }
			                            ?>
			                            </select>  
			                        </p>
			                        <span>QTY :  <input type="number" id="qtyId<?=$i?>" value="<?=$items['qty']?>" max="10" min="1" name="" style="width: 50px" readonly="" disabled=""></span>

			                        <p>Delivery Amount : Free</p>
			                        <p>Price :  Rs.<?=$items['price']?> </p>
			                        <i><b>Total Amount: &#8377; <?=$items['subtotal']?> </b></i>
			                    </div>
			                    <div class="clearfix cr-btn">
			                         <!-- <h6><a href="<?=base_url()?>remove/<?=$items['rowid']?>">Remove</a></h6> -->
			                    </div>
			            </div>          
			        </div>
			        <script type="text/javascript">
			            $(document).ready(function () {
			                $('#qtyId<?=$i?>').change(function () {
			                   // alert("fd");
			                    var categoryId = $('#rowid<?=$i?>').val();
			                    var qty = $('#qtyId<?=$i?>').val();
			                    if (categoryId !== '') {
			                        $.ajax({
			                            url: "<?php echo base_url();?>Product/updateCart",
			                            method: "POST",
			                            data: {
			                                rowid: categoryId,
			                                qty: qty
			                            },
			                            success: function(data) {
			                                //alert("Success "+ categoryId + qty);
			                                window.location.href="";
			                            }

			                        });
			                    } else {
			                        $('#subCategoryId').html('<option value="">Select SubCategory</option>');
			                    }
			                });
			            });
			        </script>
			        <?php $i++; ?>

			        <?php endforeach; ?>
		</div>
		<div class="col-md-4 col-sm-5 col-xs-12">
			<div class="brdr-bx">
				<!-- <div class="first-div failure clearfix">
					<h6>Order Details</h6>
					<p>Order ID: <span>xxxxxxxxxxxxxxxx</span></p>
					<p>Order Date: <span>10 June 2018 18:30PM</span></p>
					<p>Total Amount: <span>Rs.1247Rs</span></p>
					<p>Payment Mode: <span>Cash on Delivery</span></p>
				</div>
				<p class="cncl failure"><a href="#">Cancel items(s)</a></p> -->

				<a href="<?=base_url()?>" class="btn btn-danger btn-sm btn-block">  Go Back</a>
			</div>
		</div>
	</div>

</div>

