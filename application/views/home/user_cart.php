
<style type="text/css">
    .links,h5, h5>a{
        color: green;
    }
</style>
<div class="container">
    <?php 
        $cartCount=count($this->cart->contents());
        if ($cartCount==0) {
            ?>
            <div class="clearfix cr-btn">
                        
            <h6>Cart is empty. Explore our latest products <a href="<?=base_url()?>"> Click here</a></h6></div>
            <?php
        }else{
            //echo $cartCount;
            ?>
    <h3 class="cr-tag col-md-8 col-sm-7 col-xs-12">My Shopping Cart</h3>
    <br>
<button type="button" id="clear_cart" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span> Clear Cart <span class="fa fa-shopping-cart"></span> </button>

        
        <?php
            }
        ?>
    <div class="cr_content col-md-8 col-sm-7 col-xs-12">
        
        <?php $i = 1; ?>
        <?php foreach ($this->cart->contents() as $items):
            $ProductInArrayId[]=$items['id']; 
            $quantityOrder[]=$items['qty'];
            $productName= str_replace(' ', '-', $items['name']);
            $sizes=$items['options']['size'];
             // $sizes=explode(',', $size);

        ?>
        <div class="cr_tab clearfix">
            <div class="col-sm-3 col-xs-12 text-center">
                <img src="<?=base_url()?>uploads/product/<?=$items['options']['image']?>" class="img-responsive" alt="">
            </div>
            <div class="col-sm-9 col-xs-12"> 
                    <div class="clearfix cr-info">
                        <i>Not Returnable*</i>
                        <h5><a class="text-success links" style="color: #000" href="<?=base_url().'products/'. urlencode(str_replace('_', '&', $productName))?>"><?=str_replace('_', '&', $items['name'])?></a> <span>| </span> <!-- <span>(10% OFF)</span> --></h5>
                        
                        <input type="hidden" name="" value="<?=$items['rowid']?>" id="rowid<?=$i?>">
                        <p>Size : <b><?=$sizes?></b>
                           <select name="size" style="width: 50px; height: 25px;">
                                <option value="None" >Size</option>
                            
                            <?php 
                                foreach ($sizes as $key) {
                                    echo '<option value="'.$key.'">'.$key.'</option>';
                                }
                            ?>
                            </select>
                        </p>
                       
                        <span>QTY :  <input type="number" id="qtyId<?=$i?>" value="<?=$items['qty']?>" max="10" min="1"  value="" name="" style="width: 50px"></span>

                        <p>Delivery Amount : Free</p>
                        <p>Price :  Rs.<?=$items['price']?> </p>
                        <i><b>Total Amount: &#8377; <?=$items['subtotal']?> </b></i>
                        <p>Color : </p><span style="display: inline-block; background-color:<?=$items['options']['color'];?>; width:15px; height:15px; border: 1px solid black;" ></span>
                    </div>
                    <div class="clearfix cr-btn">
                         <h6><a href="<?=base_url()?>remove/<?=$items['rowid']?>">Remove</a></h6>
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
                    }
                });
            });
        </script>
        <?php $i++; ?>

        <?php endforeach; ?>
        
    </div>
    <div class="cr_price col-md-4 col-sm-5 col-xs-12">
    <div class="padding-left-30 padding-right-30">
        <form method="POST" action="<?=base_url()?>checkout">
            <input type="hidden" name="SelectedProducts" value="<?= implode($ProductInArrayId, ',') ?>" >
            <input type="hidden" name="quantityOrder" value="<?= implode($quantityOrder, ',') ?>" >
            <?php
                foreach ($productDetail as $pro) {
                    
                    $priceAll[]=$pro->price;
                    $mrpAll[]=$pro->mrp;
                          
            ?>
        
        <?php } ?>


        <?php
        #adding number
             $tempTotal =  $this->cart->total();
             $tempDiscount = array_sum($mrpAll)-array_sum($priceAll);
             $totalFinal = round($tempTotal) + round($tempDiscount);

         ?>
            <h4>Price Details</h4>
            <!-- <p>Total <span>Rs.<?= array_sum($mrpAll);?></span></p> -->
            <p>Total <span>Rs.<?= $totalFinal?></span></p>
            <!-- <p>Discount <span class="am-clr">-Rs.<?=(array_sum($mrpAll)-array_sum($priceAll));?></span></p> -->
            <p>Discount <span class="am-clr">-Rs.<?=$tempDiscount?></span></p>
            <!-- <input type="text" name="deliveryAmount" value="<?='30'?>" style="width: 40px; border: none;"> -->
            <p>Delivery Amount: <span class="am-clr"> Free </span></p>
            <p class="tl-amt">Payable Amount (Tax Inc.) <span>Rs.<?php echo $tempTotal; ?></span></p>
            <?php
         if (!$this->session->userdata('user')) { 
             ?>
             <label class="text-danger">Please login to order this product</label>
            <a href="<?=base_url()?>userLogin" class="btn btn-warning btn-block"><i class="fa fa-sign-in"></i> Login</a>
         <?php }  else {?>
            <a class="btn btn-success btn-block" href="<?=base_url()?>checkout" name="place_order">Place Order</a>

        <?php } ?>
            <h6><a href="<?=base_url()?>" class="btn btn-default btn-block">Continue Shopping</a></h6>
<br>
<br>
<br>
<br>
        </form>
    </div>
    </div>
   
</div>

<script type="text/javascript">
    $(document).ready(function(){
         $(document).on('click', '#clear_cart', function(){
          if(confirm("Are you sure you want to clear cart?"))
          {
           $.ajax({
            url:"<?php echo base_url(); ?>Product/clear",
            success:function(data)
            {
             alert("Your cart has been clear...");
             $('#cart_details').html(data);
              window.location.href="<?=base_url()?>";
            }
           });
          }
          else
          {
           return false;
          }
         });
    });
</script>
