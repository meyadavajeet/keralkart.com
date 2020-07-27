<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>
        Order Details
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order Details</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-body">
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
                        $customerAddress = $row->CustomerAddress;
                        $alternateContact = $row->alternateContact;
                        $postalCode = $row->postalCode;
                        $country = $row->country;
                        $state = $row->state;
                        $city = $row->city;
                        $landmark = $row->landmark;
                        if($satus == 1){
                            $btn_class = "progtrckr-done";
                            $btn_value=" New Order";
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

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="pull-left">
                                        Invoice ID: <button class="myorders_number bg-light-blue-gradient btn"
                                            disabled><?=$OrderId?></button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!--<div class="text-cemter">-->
                                    <!--    <a class="btn btn-warning"-->
                                    <!--        href="<?=base_url()?>generate-invoice-by-invoice-id/<?=$OrderId?>">-->
                                    <!--        Generate Invoice <i class="fa fa-file-pdf-o"></i>-->
                                    <!--    </a>-->
                                    <!--</div>-->
                                </div>
                                <div class="col-sm-3">
                                    <div class="pull-right">
                                        <a class="btn  btn-danger btn-sm" href="<?=base_url()?>dashboard"><i
                                                class="fa fa-angle-left"></i>BACK</a>
                                    </div>
                                    <p> &nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="card">
                                <div class="row" style="margin-left:20px;">
                                    <label>Delivery Address</label>
                                    <p>Name: <b><?=$customerName?></b></p>
                                    <p>Address: <?=$shippingAddress?></p>
                                    <p>Landmark: <?=$landmark?></p>
                                    <p>Phone Number: <?= $mobile?> | Alternate Contact: <?=$alternateContact?></p>
                                    <p>Country: <?=$country?> | State: <?=$state?></p>
                                    <p>City: <?=$city?> | Postal Code: <?=$postalCode?></p>
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
                                        <div class="col-sm-2">
                                            <img class="img img-thumbnail img-responsive"
                                                src="<?=base_url()?>uploads/product/<?=$row->productImage?>"
                                                style="height:100px; width:100px;">
                                        </div>
                                        <div class="col-sm-3">
                                            <p>
                                                
                                                    <?=$row->productName?>
                                               
                                            </p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h6>Ordered Quantitiy:<?=$row->orderedQuantity?></h6>
                                        </div>
                                        <div class="col-sm-1">
                                            <h6>color:<?=$row->color?></h6>
                                            <span class="badge" id="showcolor"
                                            style="background-color: <?= $row->color ?>; height:30px; width:30px;">
                                                
                                            </span>
                                        </div>
                                        <div class="col-sm-1">
                                            <h6>size: <strong><?=$row->size?></strong> </h6>
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <!-- <ol class="progtrckr" data-progtrckr-steps="5">
                                                <li class="<?=$btn_class?>"><?=$btn_value?></li>
                                            </ol> -->
                                            Status
                                            <i class="fa fa-check-circle-o fa-2x">
                                                <?=$btn_value?>
                                            </i>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                         <h6>Total Price: <strong><?=$row->Totals;?></strong></h6> 
                                    </div>
                                </div>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $("#example1").dataTable({
        "pageLength": 10,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

});
</script>