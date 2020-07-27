<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;
    margin-top: 20px;
    padding: 20px;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
</style>
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

<div class="container">
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="pull-left">
                    <button class="myorders_number"><?=$OrderId?></button>
                </div>
                <div class="pull-right">
                    <a class=" btn-danger btn-sm" href="<?=base_url()?>active-orders">BACK</a>
                </div>
                <p> &nbsp;</p>
            </div>
            <div class="panel-body">
                <div class="card">
                    <div class="row" style="margin-left:20px;">
                        <label>Delivery Address</label>
                        <p>Name: <?=$customerName?></p>
                        <p>Address: <?=$shippingAddress?></p>
                        <p>Phone Number: <?= $mobile?></p>
                    </div>

                </div>
                <?php
                 foreach ($getProductByOrderId as $row) { 
                    $namePro=urlencode($row->productName);
                    //  $namePros = str_replace('-','+',$namePro);
                        $product_name=str_replace('+', '-', $namePro);
                     
                     ?>
                <div class=" card">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-1">
                                <img class="img img-thumbnail img-responsive"
                                    src="<?=base_url()?>uploads/product/<?=$row->productImage?>"
                                    style="height:80px; width:100px;">
                            </div>
                            <div class="col-sm-3">
                                <p><a href="<?=base_url().'products/'.$product_name?>"> <?=$row->productName?></a></p>
                                <h6>color:<?=$row->color?></h6>
                                <h6>size:<?=$row->size?></h6>
                            </div>
                            <div class="col-sm-8 text-center">
                                <ol class="progtrckr" data-progtrckr-steps="5">
                                    <li class="<?=$btn_class?>"><?=$btn_value?></li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>