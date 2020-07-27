<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;
    margin-top: 20px;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

.card1 {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;
    /*margin-top: 20px;*/
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <a href="<?=base_url();?>edit-profile" class=" btn btn-block btn-warning btn-sm" type="button">My
                        Information</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>active-orders" class=" btn btn-block btn-warning btn-sm"
                        type="button">Active
                        Orders</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>order-history" class=" btn btn-block btn-success btn-sm "
                        type="button">Order
                        History</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>my-account" class=" btn btn-block btn-warning btn-sm" type="button">Rating
                        & Review
                    </a>
                </div>
                <!-- <div class="col-sm-2">
                    <a href="<?=base_url();?>all-notifications" class="btn btn-block btn-warning btn-sm"
                        type="button">Notifications</a>
                </div> -->
            </div>
        </div>
    </div>

    <!-- select data on the basis of customer id from order master table -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading ">
                    <strong>Your All Orders</strong>
                </div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <!--<h3 style="font-family: 'Roboto', sans-serif;color: #0d6aad; font-weight: bold;">Your All Orders</h3>-->
                        <div class="table table-responsive">
                            <table id="example1" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr class="bg-success">
                                        <th>serialNo</th>
                                        <th>Order Id</th>
                                        <th>Product</th>
                                        <th>Ordered_on</th>
                                        <th>View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl = 0;
								foreach ($order_history as $row): ?>
                                    <tr>
                                        <td><?= ++$sl; ?></td>
                                        <td><?= $row->orderId; ?></td>
                                        <td><img class="img img-responsive img-thumbnail"
                                                src="<?=base_url()?>uploads/product/<?=$row->productImage?>"
                                                style="height:50px; width:50px;"></td>
                                        <td><?= $row->added_at; ?></td>
                                        <td>

                                        <?php 
                                            if($row->ostatus != 6){
                                                ?>
                                               <a href="<?= base_url() ?>get-data-by-orderid/<?= $row->orderId; ?>"
                                                type="button" title="View Details" class="btn-success btn-sm">
                                                <i class="fa fa-eye"></i> View Details
                                            </a>
                                                    <?php
                                            }else{
                                                echo '<b>Cancelled</b>';
                                            }
                                    ?>
                                            
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript">
$(document).ready(function() {
    $("#example1").dataTable({
        "pageLength": 10
    });

});
</script>