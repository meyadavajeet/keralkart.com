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
        <div class="card">
            <div class="row">
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>my-account" class="btn btn-block btn-warning btn-xs" type="button">My
                        Account
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>order-history" class="btn btn-block btn-success btn-xs "
                        type="button">Order
                        History</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>active-orders" class="btn btn-block btn-warning btn-xs"
                        type="button">Active
                        Orders</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>my-address" class="btn btn-block btn-warning btn-xs" type="button">My
                        Address</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>track-order" class="btn btn-block btn-warning btn-xs" type="button">Track
                        Order</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>all-notifications" class="btn btn-block btn-warning btn-xs"
                        type="button">Notifications</a>
                </div>
            </div>
        </div>
    </div>

    <!-- select data on the basis of customer id from order master table -->
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading ">
                <strong>Track your active orders</strong>
            </div>
            <div class="panel-body">
                <div class="">
                    <!--					<h3 style="font-family: 'Roboto', sans-serif;color: #0d6aad; font-weight: bold;">Your All Orders</h3>-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="myorders">
                                <table class="table table-bordered">
                                    <tbody>
                                        <?php $sl = 0;
								foreach ($getAllActiveOrders as $row): ?>
                                        <tr class="myorders-table-header">
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-2 col-lg-2"><button
                                                            class="myorders_number"><?=$row->orderId;?></button></div>
                                                    <div class="col-xs-7 col-lg-7"></div>
                                                    <div class="col-xs-2 col-lg-2"><button class="myorders_track"
                                                            data-toggle="modal" data-target="#trackOrderModal"><span
                                                                class="glyphicon glyphicon-map-marker"></span>
                                                            Track</button></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                        foreach ($getDataByOrderId as $getDataByOrderIds):
                                            if($getDataByOrderIds['orderId']==$row->orderId)
                                            {
                                                ?>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-2 col-lg-2">
                                                        <img src="<?=base_url()?>uploads/product/<?=$row->thumbnail1;?>" class="imgDiv">
                                                    </div>
                                                    <div class="col-xs-4 col-lg-4">
                                                        <p><?=$row->productName;?></p>
                                                        <!-- <p class="seller">Deepak Kumar</p>
                                                        <p class="seller">Seller: RS Electronics</p> -->
                                                    </div>
                                                    <div class="col-xs-2 col-lg-2">Rs.<?=$row->price?></div>
                                                    <!-- <div class="col-xs-4 col-lg-4">Delivered on Fri, Dec 26th '17 <p
                                                            class="seller">Your item has been delivered</p>
                                                    </div> -->
                                                </div>
                                            </td>
                                        </tr>
                                            <?php }
                                            endforeach; 
                                            ?>
                                       
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="myorders-table-header">
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-2 col-lg-2"><button
                                                            class="myorders_number">77458737935</button></div>
                                                    <div class="col-xs-7 col-lg-7"></div>
                                                    <div class="col-xs-2 col-lg-2"><button class="myorders_track"
                                                            data-toggle="modal" data-target="#trackOrderModal"><span
                                                                class="glyphicon glyphicon-map-marker"></span>
                                                            Track</button></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-2 col-lg-2"><img
                                                            src="image/1final_indexpage__107.jpg" class="imgDiv"></div>
                                                    <div class="col-xs-4 col-lg-4">Life is what you make it <p
                                                            class="seller">Deepak Kumar</p>
                                                        <p class="seller">Seller: WS Retail</p>
                                                    </div>
                                                    <div class="col-xs-2 col-lg-2">Rs.200</div>
                                                    <div class="col-xs-4 col-lg-4">Delivered on Fri, Dec 26th '17 <p
                                                            class="seller">Your item has been delivered</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="trackOrderModal" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header ordertracking-header">
                                                        <div class="row">
                                                            <div class="col-xs-4 col-lg-4"></div>
                                                            <div class="col-xs-4 col-lg-4">Order Tracking: 77458737935
                                                            </div>
                                                            <div class="col-xs-4 col-lg-4"></div>
                                                        </div>
                                                        <div class="row ordertracking">
                                                            <div class="col-xs-4 col-lg-4">
                                                                <div class="ordertracking-label">Shipped Via</div>
                                                                <div class="ordertracking-value">RS Tours</div>
                                                            </div>
                                                            <div class="col-xs-4 col-lg-4">
                                                                <div class="ordertracking-label">Status</div>
                                                                <div class="ordertracking-value">Checking Quality</div>
                                                            </div>
                                                            <div class="col-xs-4 col-lg-4">
                                                                <div class="ordertracking-label">Expected Date</div>
                                                                <div class="ordertracking-value">4-DEC-2017</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">

                                                        <ol class="progtrckr" data-progtrckr-steps="5">
                                                            <li class="progtrckr-done">Confirmed Ordered</li>
                                                            <li class="progtrckr-done">Processing Order</li>
                                                            <li class="progtrckr-done">Quality Check</li>
                                                            <li class="progtrckr-todo">Dispatched Item</li>
                                                            <li class="progtrckr-todo">Product Delivered</li>
                                                        </ol>


                                                    </div>
                                                    <!-- <div style="margin:12px;height:20px;width28px;"><i onclick="myFunction(this)" class="fa fa-thumbs-up"></i></div> -->

                                                    <script>
                                                    function myFunction(x) {
                                                        x.classList.toggle("fa-thumbs-down");
                                                    }
                                                    </script>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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