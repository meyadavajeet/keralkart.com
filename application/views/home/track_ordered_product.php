<?php
    foreach ($getProductByOrderId as $row) { 
       
        $OrderId = $row->orderId;
        $customerName = $row->customerName;
        $shippingAddress = $row->shipping_address;
        $mobile = $row->mobile;
         $satus = $row->satus;
         if($satus == 1){
             $btn_class = "progtrckr-done";
             $btn_value="Confirmed Ordered";
         }
         else if($satus == 2){
            $btn_class = "progtrckr-done"; 
            $btn_value="Processing Order";
         }
         else if($satus == 3){
            $btn_class = "progtrckr-done"; 
            $btn_value="Packaging Product";
         }
         else if($satus == 4){
            $btn_class = "progtrckr-done"; 
            $btn_value="Out for Deleviery";
         }
         else if($satus == 4){
            $btn_class = "progtrckr-done"; 
            $btn_value="Product Delivered";
         }else{
            $btn_class = "progtrckr-todo";  
            $btn_value="Waiting for confirmation";
         }
    }
        ?>
<!-- <li class="progtrckr-done">Confirmed Ordered</li>
<li class="progtrckr-done">Processing Order</li>
<li class="progtrckr-done">Packaging Product</li>
<li class="progtrckr-done">Out for Deleviery</li>
<li class="progtrckr-done">Product Delivered</li> -->
<div class="container">
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">

                <div class="row">
                    <div class="col-xs-4 col-lg-4"></div>
                    <div class="col-xs-4 col-lg-4">
                    Order Tracking:
                    <button class="myorders_number" readonly><?=$OrderId?></button>
                    </div>
                    <div class="col-xs-4 col-lg-4">
                        <div class="row pull-right">
                            <a class=" btn btn-xm btn-danger" href="<?=base_url()?>active-orders">
                                <span class="fa fa-back-left"></span>
                                BACK</a>
                        </div>

                    </div>
                </div>
                <div class="row ordertracking text-center">
                    <div class="col-xs-4 col-lg-4">
                        <div class="ordertracking-label">Shipped To</div>
                        <div class="ordertracking-value"><?=$customerName?></div>
                    </div>
                    <div class="col-xs-4 col-lg-4">
                        <div class="ordertracking-label">Shipped Address</div>
                        <div class="ordertracking-value"><?=$shippingAddress?></div>
                    </div>
                    <div class="col-xs-4 col-lg-4">
                        <div class="ordertracking-label">Mobile Number</div>
                        <div class="ordertracking-value"><?=$mobile?></div>
                    </div>
                </div>
            </div>
            <div class="panel-body text-center">
                <ol class="progtrckr" data-progtrckr-steps="5">
                    <li class="<?=$btn_class?>"><?=$btn_value?></li>
                </ol>


            </div>
            <!-- <div style="margin:12px;height:20px;width28px;"><i onclick="myFunction(this)" class="fa fa-thumbs-up"></i></div> -->

            <script>
            function myFunction(x) {
                x.classList.toggle("fa-thumbs-down");
            }
            </script>
        </div>
    </div>

</div>
</div>