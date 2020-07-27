<?php

 
function getCallbackUrl()
{
    // $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    // return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
    return base_url().'orderConfirm';
}
//echo getCallbackUrl();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!-- BOLT Production/Live //-->
<!--<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>-->
<?php
       
        foreach ($get_user_info as  $row) {
            $id = $row->id;
            $customerName = $row->customerName;
            $email = $row->email;
            $mobile = $row->mobile;
            $profileImage = $row->profileImage;
            if($profileImage == ""){
                $showProfileImage = "assets/images/plus.png";
            }else if($profileImage !=null){
                $showProfileImage = "uploads/customers/$profileImage";
            }
            $customerAddress = $row->CustomerAddress;
            $alternateContact = $row->alternateContact;
            $postalCode = $row->postalCode;
            $country = $row->country;
            $state = $row->state;
            $city = $row->city;
            $landmark = $row->landmark;
            // if($customerAddress ==""){
            //     $customerAddress = "N/A";
            // }
           
            // if($alternateContact == ""){
            //     $alternateContact ="N/A";
            // } 
            
            // if($postalCode == ""){
            //     $postalCode ="N/A";
            // } 
           
            // if($country == ""){
            //     $country ="N/A";
            // } 
            
            // if($state == ""){
            //     $state ="N/A";
            // }
            
            // if($city == ""){
            //     $city ="N/A";
            // }
           
            // if($landmark == ""){
            //     $landmark ="N/A";
            // }
        }
    foreach ($productDetail as $pro) {
        $pro->price;
        $priceAll[]=$pro->price;
        $mrpAll[]=$pro->mrp;
    }
    

    
foreach ($this->cart->contents() as $items):

$ProductInArrayId[]=$items['id']; 
$quantityOrder[]=$items['qty'];
endforeach;


?>

<!--- Checkout section -->
<div class="container">
    <form class="frm-fill" id="payment_form" method="post" action="<?=base_url()?>orderConfirm">

        <div class="clearfix col-sm-9 col-xs-12 chk-sctn ">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">LOGIN OR SIGNUP</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse active">
                        <div class="panel-body">
                            <?php if(!$this->session->userdata('user')){?>
                            <form class="frm-fill">
                                <input type="text" name="name" placeholder="Name" required="">
                                <input type="text" name="number" placeholder="Phone" required>
                                <input type="text" name="email" placeholder="Email" required="">
                                <input type="password" name="password" placeholder="Password" required="">
                                <label class="bg pull-left margin-top-20" for="loggedIN" style="font-size: 13px;">
                                    <!--  <i class="fa fa-square-o"></i> <i class="fa fa-check-square-o"></i>
                                  <input id="remember" name="remember" value="1" type="checkbox">
                                  Remember Password -->
                                </label>
                                <input type="submit" name="submit" value="Continue">
                            </form>
                            <?php }else { 
                            echo "<label class='text-success'>Login SuccessFul.</label>";
                        } ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">ADDRESS</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <input type="hidden" readonly="" id="SelectedProducts" name="SelectedProducts"
                                value="<?= implode($ProductInArrayId, ',') ?>">
                            <input type="hidden" readonly="" id="quantityOrder" name="quantityOrder"
                                value="<?= implode($quantityOrder, ',') ?>">
                            <!-- <input type="number" min="0" name="contactNo" placeholder="Contact Number - eg.9090909900" value="
                        <?php
                         // if(!empty($this->session->userdata('mobile'))){ echo $this->session->userdata('mobile');}
                         ?>"
                            > -->
                            <input type="hidden" name="customerId" id="customerId" value="<?=$id?>">
                            <input type="text" minlength="10" id="contactNumber" maxlength="10" value="<?=$mobile ?>" name="contactNumber">
                            <input type="text" min="0" id="alternateContact" maxlength="10" pattern="\d*" value="<?=$alternateContact ?>"
                                name="alternateContact" placeholder="Alternate Contatct Number">
                            <input type="text" value="<?=$customerAddress?>" id="address" name="address" placeholder="Address" required="">
                            <input type="text" value="<?=$landmark?>" name="landmark" id="landmark" pattern="\d*" placeholder="Landmark"   required="">
                            <input type="text" value="<?=$postalCode?>" name="pincode" maxlength="6" id="pincode"
                                placeholder="Pincode eg-835003" required="">
                            <input type="text" value="<?=$country ?>" name="country" id="country"
                                placeholder="Country eg-India" required="">
                            <input type="text" value="<?=$state ?>" name="state" id="state" placeholder="State eg-kerala"
                                required="">
                            <input type="text" value="<?=$city?>" name="city" id="city" placeholder="City" required="">
                            <input type="button" id="addressBtn"  data-toggle="collapse" data-parent="#accordion"
                                href="#collapse3" value="Countinue">

                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">OEDER SUMMARY</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="cr_content">
                                <?php $i = 1; ?>
                                <?php foreach ($this->cart->contents() as $items):

                         $ProductInArrayId[]=$items['id']; 
                         $quantityOrder[]=$items['qty'];

                        $productName= str_replace(' ', '-', $items['name']);
                         $size=$items['options']['size'];
                        // $sizes=explode(',', $size);
                        // print_r($sizes);

                    ?>
                                <div class="cr_tab clearfix">
                                    <div class="col-sm-3 col-xs-12 text-center">
                                        <img src="<?=base_url()?>uploads/product/<?=$items['options']['image']?>"
                                            class="img-responsive" alt="">
                                    </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <div class="clearfix cr-info">
                                            <i>Not Returnable*</i>
                                            <h5><a class="text-success links" style="color: #000"
                                                    href="<?=base_url().'products/'. urlencode(str_replace('_', '&', $productName))?>"><?=str_replace('_', '&', $items['name'])?></a>
                                               </h5>

                                            <input type="hidden" name="" value="<?=$items['rowid']?>" id="rowid<?=$i?>">

                                            <p style="text-decoration: none; font-size: 20px;">Size : <?=$size=$items['options']['size'];?>
                                               
                                       
                                            </p>
                                        <br>    
                                          QTY   &nbsp; :  <input type="number" id="qtyId<?=$i?>"
                                                    value="<?=$items['qty']?>" max="10" min="1" value="" name=""
                                                    style="margin-left:54px;margin-top:-25px"
                                                    readonly="">

                                            <p>Delivery Amount : Free</p>
                                            <p>Price : Rs.<?=$items['price']?> </p>
                                            <i><b>Total Amount: &#8377; <?=$items['subtotal']?> </b></i>
                                        </div>
                                        <!-- <div class="clearfix cr-btn">
                                     <h6><a href="<?=base_url()?>remove/<?=$items['rowid']?>">Remove</a></h6>
                                </div> -->
                                    </div>
                                </div>
                                <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#qtyId<?=$i?>').change(function() {
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
                                                    window.location.href = "";
                                                }

                                            });
                                        } else {
                                            $('#subCategoryId').html(
                                                '<option value="">Select SubCategory</option>');
                                        }
                                    });
                                });
                                </script>
                                <?php $i++; ?>

                                <?php  endforeach;  ?>
                            </div>
                            <!-- <input type="button" name="submit" data-parent="#accordion" value="Countinue"
                                href="#collapse4"> -->
                            <input type="button" name="submit" data-toggle="collapse" data-parent="#accordion"
                                href="#collapse4" value="Countinue">

                        </div>
                    </div>
                </div>
                 <?php 
    #calculation for the cart
         $tempTotal =  $this->cart->total();
         $tempDiscount = array_sum($mrpAll)-array_sum($priceAll);
         $subtotalNew = round($tempTotal) + round($tempDiscount);

     ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">PAYMEMT MODE</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse in">
                        <div class="panel-body">

                          <!--   <label class="container_radio">Online
                                <input type="radio" name="paymentMode" value="OnlinePayment">
                                <span class="checkmark"></span>
                            </label>

                            <label class="container_radio">COD
                                <input type="radio" value="COD" name="paymentMode">
                                <span class="checkmark"></span>
                            </label> -->

                            <span class="text-danger"><span>NOTE* - </span>Please fill all fields.</span>
                            <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                            <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl();?>" />
                            <input type="hidden" id="key" name="key" placeholder="Merchant Key" value="rEO4xfp5" />
                            <input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="O1D32If9jV" />
                            <input type="hidden" id="txnid" name="txnid" value="<?php echo  "Txn" . rand(10000,99999999)?>" />
							<input type="hidden" id="amount" name="amount" value="<?=$tempTotal?>" />
							<input type="hidden" id="pinfo" name="pinfo"  value="<?= implode($ProductInArrayId, ',') ?>" />
							<input type="hidden" id="fname" name="fname" value="<?=$customerName?>" />
							<input type="hidden" id="email" name="email" value="<?=$email?>" />
							<input type="hidden" id="mobile" name="mobile" value="<?=$mobile?>" />
							<input type="hidden" id="hash" name="hash" placeholder="Hash" value="" />
						   <!--  <input class="continue" type="submit" name="submit" value="Continue & Checkout" />
							-->
							<input type="button" class="btn" value="Pay Now &#8377;<?=$tempTotal?>" onclick="launchBOLT(); return false;" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
 
    <div class="clearfix col-sm-3 col-xs-12 right-sctn">
       
        <div class="clearfix cr_price">
            <h5>ORDER SUMMARY <span>(2 Items )</span></h5>
            <!-- <p>Total <span>Rs.<?= array_sum($mrpAll);?></span></p> -->
            <p>Total <span>Rs.<?= $subtotalNew?></span></p>
            <p>Discount <span class="am-clr">-Rs.<?=(array_sum($mrpAll)-array_sum($priceAll));?></span></p>

            <p>Delivery Amount <span class="am-clr">Free</span></p>
            <!--  <p class="tl-amt">Payable Amount (Tax Inc.) <span>Rs.<?php $subtotaNew = $this->cart->format_number($this->cart->total());  echo $subtotaNew; ?></span></p> -->
            <p class="tl-amt">Payable Amount (Tax Inc.) <span><?=$tempTotal?></span>

        </div>
    </div>

</div>
<style type="text/css">
#myModal {
    z-index: 9999999;
}
</style>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content popup">
            <div class="modal-header">

                <h4 class="modal-title">LOGIN OR SIGNUP</h4>
            </div>
            <div class="modal-body">
                <form class="frm-fill">
                    <input type="text" name="name" placeholder="Email or Phone" required="">
                    <label class="bg pull-left margin-top-20" for="loggedIN" style="font-size: 13px;">
                        <i class="fa fa-square-o"></i> <i class="fa fa-check-square-o"></i>
                        <input id="remember" name="remember" value="1" type="checkbox">
                        Remember Password
                    </label>
                    <input type="submit" name="submit" value="Continue">
                </form>
                <p class="text-center">Or Login with</p>
                <span class="btn-fb"><a href="#">Facebook</a></span>
                <span class="btn-gl"><button>Google</button></span>
            </div>
        </div>

    </div>
</div>




<script type="text/javascript">
$(document).ready(function(){
$('#addressBtn').click(function(){
   // alert("hj" + $('#alternateContact').val() + $('#address').val() + $('#landmark').val() + $('#country').val());
    $.ajax({
          url: 'http://localhost/office/keralkart0.8/saveAddress',
          type: 'post',
          data: { 
                alternateContact: $('#alternateContact').val(),
                address: $('#address').val(),
                landmark: $('#landmark').val(),
                country: $('#country').val(),
                state: $('#state').val(),
                city: $('#city').val(),
                pincode: $('#pincode').val()
            },


          success: function(json) {
            // alert("success");
          },
          error:function(json){
            //alert("Fd" +json.status);
          }
        }); 
  });
  });
$(document).ready(function(){
    $.ajax({
          url: 'http://localhost/office/keralkart0.8/generateHash',
          type: 'post',
          data: JSON.stringify({ 
            
            key: $('#key').val(),
            salt: $('#salt').val(),
            txnid: $('#txnid').val(),
            amount: $('#amount').val(),
            pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
            email: $('#email').val(),
            mobile: $('#mobile').val(),
            udf5: $('#udf5').val()
          }),
          contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
             $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
            else if (json['success']) { 
                $('#hash').val(json['success']);
            }
          }
        }); 

});

</script>
<script type="text/javascript">
function launchBOLT()
{
    var pincode=$('#pincode').val();
    if (pincode=='' || pincode==null) {
        alert("Please fill all details");
    }
    else{
            //online payment

            bolt.launch({
            
            key: $('#key').val(),
            txnid: $('#txnid').val(), 
            hash: $('#hash').val(),
            amount: $('#amount').val(),
            firstname: $('#fname').val(),
            email: $('#email').val(),
            phone: $('#mobile').val(),
            productinfo: $('#pinfo').val(),
            udf5: $('#udf5').val(),
            surl : $('#surl').val(),
            furl: $('#surl').val(),
            mode: 'dropout' 
        },{ responseHandler: function(BOLT){
            console.log( BOLT.response.txnStatus );     
            if(BOLT.response.txnStatus != 'CANCEL')
            {
                //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
                '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
                '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
                '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
                '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
                '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
                '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
                '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
                '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
                '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
                '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
                '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
                '</form>';
                var form = jQuery(fr);
                jQuery('body').append(form);                                
                form.submit();
            }
        },
            catchException: function(BOLT){
                alert( BOLT.message );
            }
        });
}
}
//--
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
</script>

