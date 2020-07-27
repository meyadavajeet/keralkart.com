<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;
    /* margin-top: 20px; */
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
                    <a href="<?= base_url(); ?>my-account" class="btn btn-block btn-warning btn-xs" type="button">My
                        Account
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>order-history" class="btn btn-block btn-warning btn-xs "
                        type="button">Order
                        History</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>active-orders" class="btn btn-block btn-warning btn-xs"
                        type="button">Active
                        Orders</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?= base_url(); ?>my-address" class="btn btn-block btn-success btn-xs" type="button">My
                        Address</a>
                </div>
                <!-- <div class="col-sm-2">
                    <a href="<?= base_url(); ?>track-order" class="btn btn-block btn-warning btn-xs" type="button">Track
                        Order</a>
                </div> -->
                <!-- <div class="col-sm-2">
                    <a href="<?= base_url(); ?>all-notifications" class="btn btn-block btn-warning btn-xs"
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
                    <strong>My Information </strong>
                </div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="">
                                    <a class="btn btn-success btn-block" href="<?=base_url()?>edit-profile"><i class="fa fa-pencil-square-o"></i> Edit Profile</a><br>
                                    <a class="btn btn-success btn-block" href="<?=base_url()?>address-list" ><i class="fa fa-pencil-square-o"></i> Add or Edit Address</a><br>
                                    <a class="btn btn-success  btn-block" href="<?=base_url()?>reset-password" ><i class="fa fa-key"></i> Change Password</a>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="card">
                                    for the profile section 
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