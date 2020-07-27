<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;

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
                    <a href="<?=base_url();?>edit-profile" class=" btn btn-block btn-success btn-sm" type="button">My
                        Information</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>active-orders" class=" btn btn-block btn-warning btn-sm"
                        type="button">Active
                        Orders</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>order-history" class=" btn btn-block btn-warning btn-sm "
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
                    <strong>My Information </strong>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="">
                                <a class="btn btn-success btn-block" href="<?=base_url()?>edit-profile"><i
                                        class="fa fa-pencil-square-o"></i> Edit Profile</a><br>
                                <a class="btn btn-success btn-block" href="<?=base_url()?>address-list"><i
                                        class="fa fa-pencil-square-o"></i> Add or Edit Address</a><br>
                                <a class="btn btn-primary  btn-block" href="<?=base_url()?>reset-password"><i
                                        class="fa fa-key"></i> Change Password</a>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="card">

                                <section class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    Change Password
                                                </div>
                                                <div class="panel-body">
                                                    <form method="post"
                                                        action="<?= base_url() ?>Users/change_password_process"
                                                        autocomplete="off" name="form1" id="form1">
                                                        <label>Old Password :</label>
                                                        <input type="password" name="old_pass" id="name"
                                                            placeholder="Old Pass" class="form-control"
                                                            required="" /><br />
                                                        <label>New Password :</label>
                                                        <input type="password" name="new_pass" id="password"
                                                            placeholder="New Password" class="form-control"
                                                            required="" /><br />
                                                        <label>Confirm Password :</label>
                                                        <input type="password" name="confirm_pass" id="password"
                                                            class="form-control" placeholder="Confirm Password"
                                                            required="" /><br />
                                                        <input type="submit" value="Change Password"
                                                            class="btn btn-dropbox btn-danger"
                                                            name="change_pass" /><br />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
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


});
</script>