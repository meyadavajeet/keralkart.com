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
    ?>
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
    <!-- Edit model -->
    <div class="modal fade" id="editProfileModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Information</h4>
                </div>
                <div class="modal-body">

                    <form action="<?=base_url()?>update-user-address" method="POST" role="form">

                        <input type="hidden" name="cusotomerid" id="inputcusotomerid" class="form-control"
                            value="<?=$this->session->userdata('customerId');?>" required="required">

                        <div class="form-group">
                            <label for=""> Full Name </label>
                            <input type="text" class="form-control" id="" name="customerName"
                                value="<?=$customerName?>">
                        </div>
                        <div class="form-group">
                            <label for=""> Email </label>
                            <input type="email" class="form-control" id="" name="email" value="<?=$email?>">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number </label>
                            <input type="text" class="form-control" pattern="\d*" maxlength="10" id="" minlenght="10" name="mobile"
                                value="<?=$mobile?>">
                        </div>
                        <div class="form-group">
                            <label for="">Alternate Phone Number </label>
                            <input type="text" class="form-control" pattern="\d*" maxlength="10" id=""
                                name="altContactNumber" value="<?=$alternateContact?>">
                        </div>
                        <div class="form-group">
                            <label for="">Shipping Adress </label>
                            <textarea  name="customerAddress" class="form-control" rows="3"
                                required="required"><?=$customerAddress?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Landmark </label>
                            <textarea  name="landmark" class="form-control" rows="3"
                                required="required"><?=$landmark?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" class="form-control" id="" name="coutntry"
                                value="<?=$country?>">
                        </div>
                        <div class="form-group">
                            <label for="">State</label>
                            <input type="text" class="form-control" id="" name="state"
                                value="<?=$state?>">
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" class="form-control" id="" name="city"
                                value="<?=$city?>">
                        </div>
                        <div class="form-group">
                            <label for="">Zip Code </label>
                            <input type="text" class="form-control" pattern="\d*" name="postalCode"
                                value="<?=$postalCode?>" maxlength="6">
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
                                <a class="btn btn-primary btn-block" href="<?=base_url()?>address-list"><i
                                        class="fa fa-pencil-square-o"></i> Add or Edit Address</a><br>
                                <a class="btn btn-success  btn-block" href="<?=base_url()?>reset-password"><i
                                        class="fa fa-key"></i> Change Password</a>
                            </div>
                        </div>
                        <div class="col-sm-9">

                            <div class=" card panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add & Edit Address </h3>
                                </div>
                                <div class="panel-body">
                                    <h5>Set Delivery Address</h5>
                                    <div class="col-sm-12 col-xs-12 clearfix bg-green">
                                        <div class="sq-bx">
                                            <h6><?=$customerName?> <span>( Default Address )</span></h6>
                                            <p>
                                                Address : <?=$customerAddress?><br>
                                                Landmark : <?=$landmark?><br>
                                                Alt. Contact : <?=$alternateContact?><br>
                                                Country : <?=$country?><br>
                                                State : <?=$state?><br>
                                                City : <?=$city?><br>
                                                Zip Code : <?=$postalCode?><br>
                                            </p>

                                            <span><a data-toggle="modal" href='#editProfileModel'>Add/Edit</a></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-4 col-xs-12 clearfix bg-green">
                                        <div class="sq-bx bg-white">
                                            <a href="#"><img src="<?=base_url()?>assets/images/plus.png"></a>
                                        </div>
                                    </div> -->
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