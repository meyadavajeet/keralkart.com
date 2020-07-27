
<!--- Checkout section -->
<div class="container">

	<div class="sucs_box">
		<img src="<?=base_url()?>assets/home/images/success.png" alt="success image" />
		<h4>Thank you for your order</h4>
		<p>The order has been successfully placed and being proccessed. When the item(s) are shipped you will receive an email with the details. You can track your order throungh <a href="#">My Orders</a> link.</p>
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
			                <img src="<?=base_url()?>uploads/product/<?=$items['options']['image']?>" class="img-responsive" alt="">
			            </div>
			            <div class="col-sm-9 col-xs-12"> 
			                    <div class="clearfix cr-info">
			                        <i>Not Returnable*</i>
			                        <h5><a class="text-success links" style="color: #000" href="<?=base_url().'products/'. urlencode(str_replace('_', '&', $productName))?>"><?=str_replace('_', '&', $items['name'])?></a> </h5>
			                        
			                        <input type="hidden" name="" value="<?=$items['rowid']?>" id="rowid<?=$i?>">
			                        <p>Size :
			                        	<b style="font-size: 20px;"><?=$items['options']['size']?></b>
			                            <!-- <select name="size">
			                                <option value="None">Size</option>
			                            	
			                            <?php 
			                                // foreach ($sizes as $key) {
			                                //     echo '<option value="'.$key.'">'.$key.'</option>';
			                                // }
			                            ?>
			                            </select>   -->
			                        </p>
			                        <span>QTY : <b><?=$items['qty']?></b> 
			                        <!-- 	<input type="text" id="qtyId<?=$i?>" value="<?=$items['qty']?>" max="5" min="1" style="width: 50px"> -->
			                        </span>

			                        <p>Delivery Amount : Free</p>
			                        <p>Price :  Rs.<?=$items['price']?> </p>
			                        <i><b>Total Amount: &#8377; <?=$items['subtotal']?> </b></i>
			                    </div>
			                    <!-- <div class="clearfix cr-btn">
			                         <h6><a href="<?=base_url()?>remove/<?=$items['rowid']?>">Remove</a></h6>
			                    </div> -->
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
			<div class="first-div clearfix">
				<?php  
						// $customerName = $this->session->userdata('customerName');
						// $orderId = $this->session->userdata('orderId');
						$paymentMode = $this->session->userdata('paymentMode');
						$added_at = $this->session->userdata('added_at');
						$subtotal = $this->session->userdata('subtotal');
						$userMobile = $this->session->userdata('userMobile');
					?>
				<h6>Order Details</h6> 
				<p>Order ID: <span><?=$this->session->userdata('orderId');?></span></p>
				<p>Order Date: <span><?=$this->session->userdata('added_at');?></span></p>
				<p>Total Amount: <span>Rs.<?=$this->session->userdata('subtotal');?></span></p>
				<p>Payment Mode: <span><?=$paymentMode?></span></p>
			</div>
			<div class="second-div clearfix">
				<h6>Address</h6>
				<p>Name : <?=$this->session->userdata('customerName')?></p>
				<p> Shipping Address: <?=$this->session->userdata('myAddress');?></p>
                <p>Landmark: <?=$this->session->userdata('landmark');?></p>
                <p>Pincode: <?=$this->session->userdata('pincode');?></p>
                <p>City: <?=$this->session->userdata('city');?></p>
				<p>Phone <?=$this->session->userdata('userMobile')?></p>
				
				<?php if(!empty($this->session->userdata('alternateContact'))){?>
				<p>Alternate Number:  <?=$this->session->userdata('alternateContact')?>  </p>
				<?php } ?>
				<p>Delivery expected within 5 - 7 working days.</p>
			</div>
			<a href="<?=base_url()?>clear-cart-item" class="btn btn-danger btn-sm btn-block">  Go Back</a>
			</div>
		</div>
	</div>
<br>
</div>

