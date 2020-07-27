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
.btn-sm {
    font-size: 14.2px !important;
}
</style>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <div class="row">
                <div class="col-sm-2">
                    <a href="<?=base_url();?>edit-profile" class=" btn btn-block btn-success btn-sm" type="button">My
                        Information</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>active-orders" class=" btn btn-block btn-danger btn-sm"
                        type="button">Active
                        Orders</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>order-history" class=" btn btn-block btn-info btn-sm "
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
<br>
    <!-- select data on the basis of customer id from order master table -->
    <?php
        foreach ($get_user_info as  $row) {
            $customerName = $row->customerName;
            $email = $row->email;
            $mobile = $row->mobile;
            $profileImage = $row->profileImage;
            if($profileImage == ""){
                $showProfileImage = "assets/images/plus.png";
            }else if($profileImage !=null){
                $showProfileImage = "uploads/customers/$profileImage";
            }
        }
    ?>

    <!-- Edit model -->
    <div class="modal fade" id="editProfileModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Information</h4>
                </div>
                <div class="modal-body">

                    <form action="<?=base_url()?>update-user-profile" method="POST" role="form">

                        <input type="hidden" name="cusotomerid" id="inputcusotomerid" class="form-control"
                            value="<?=$this->session->userdata('customerId');?>" required="required">

                        <div class="form-group">
                            <label for=""> Full Name </label>
                            <input type="text" class="form-control" id="" name="customerName"
                                value="<?=$customerName?>">
                        </div>
                        <div class="form-group">
                            <label for=""> Email </label>
                            <input type="text" class="form-control" id="" name="email" value="<?=$email?>">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number </label>
                            <input type="text" class="form-control" pattern="\d*" maxlength="10" id="" name="mobile"
                                value="<?=$mobile?>">
                        </div>

                        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="update" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Model -->
    <!-- Edit model -->
    <div class="modal fade" id="editProfilePicture">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit ProfilePicure</h4>
                </div>
                <div class="modal-body">

                    <form action="<?=base_url()?>update-user-profile-picture" method="POST" role="form" enctype="multipart/form-data">

                        <input type="hidden" name="cusotomerid" id="inputcusotomerid" class="form-control"
                            value="<?=$this->session->userdata('customerId');?>" required="required">

                        <div class="form-group">
                            <label for=""> Update Profile Picture </label>
                            <input type="file" class="form-control" id="" name="profilePicture">
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="update" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Model -->


    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading ">
                    <strong>My Information </strong>/ <small>Edit Profile</small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="">
                                <a class="btn btn-primary btn-block" href="<?=base_url()?>edit-profile"><i
                                        class="fa fa-pencil-square-o"></i> Edit Profile</a><br>
                                <a class="btn btn-success btn-block" href="<?=base_url()?>address-list"><i
                                        class="fa fa-pencil-square-o"></i> Add or Edit Address</a><br>
                                <a class="btn btn-success  btn-block" href="<?=base_url()?>reset-password"><i
                                        class="fa fa-key"></i> Change Password</a>
                            </div>
                        </div>
                        <div class="col-sm-9">

                            <div class="card panel panel-success">

                                <div class="panel-body">
                                    <div class="col-sm-4 col-xs-12 clearfix bg-green">
                                        <div class="sq-bx">
                                            <h6><?=$customerName?><span> &nbsp;</span></h6>
                                            <p>Email : <?=$email?></p>
                                            <p>Mobile : <?=$mobile?></p>
                                            <span><a data-toggle="modal" href='#editProfileModel'>Edit</a></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12 clearfix bg-green">
                                        <div class=" bg-white">
                                            <img class="img img-responsive img-thumbnail" style="height:200px; width:100%;"
                                                src="<?=base_url()?><?=$showProfileImage;?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12 clearfix bg-green">
                                        <span><a data-toggle="modal" href='#editProfilePicture'
                                                class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Change
                                                Profile Picture</a></span>
                                    </div>
                                </div>
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