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
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="<?=base_url();?>my-account" class="btn btn-block btn-success btn-sm" type="button">My Account</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?=base_url();?>order-history" class="btn btn-block btn-success btn-sm active" type="button">Order History</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?=base_url();?>active-orders" class="btn btn-block btn-success btn-sm" type="button">Active Orders</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?=base_url();?>my-address" class="btn btn-block btn-success btn-sm" type="button">My Address</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?=base_url();?>track-order" class="btn btn-block btn-success btn-sm" type="button">Track Order</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?=base_url();?>all-notifications" class="btn btn-block btn-success btn-sm" type="button">Notifications</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>