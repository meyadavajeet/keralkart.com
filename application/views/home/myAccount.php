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
        <div class="">
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
                    <a href="<?=base_url();?>order-history" class=" btn btn-block btn-warning btn-sm "
                        type="button">Order
                        History</a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=base_url();?>my-account" class=" btn btn-block btn-success btn-sm" type="button">Rating
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
    <div class="row text-center">
        <div class="col-sm-10 col-sm-offset-1">
            <?php if ($this->session->userdata('success_msg')) { ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>
                    <center> <?= $this->session->flashdata('success_msg'); ?> </center>
                </strong>
            </div>
            <?php } ?>
            <?php if ($this->session->userdata('error_msg')) { ?>
            <div class="alert alert-danger alert-dismissible ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong> <?= $this->session->flashdata('error_msg'); ?></strong>
            </div>
            <?php } ?>
            <div id="msg"></div>
        </div>
    </div>
    <!-- Feedback Form With Rating Code -->
    <div class="modal" id="myModal" style="margin-top:50px;">
        <div class="modal-dialog ">

            <?php if($this->session->flashdata('already'))
            //foreach($msgS as $row)
              echo '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <b>Success!</b> '.$this->session->flashdata('msgS').'</div>';
              ?>
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Rating & Review </h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <label>We would love to hear your thoughts, concerns or problems with anything so we can
                        improve!</label>

                    <center> <span class="fas fa-smile"></span>
                        <div>
                            <h1 id="review"></h1>
                        </div>
                        <b id="show_selected_rating">Rating 2.0</b>
                    </center><br>

                    <input type="hidden" id="starsInput" class="form-control form-control-sm">
                    <input type="hidden" id="product_id" class="form-control form-control-sm">
                    <label><b>Please Leave Your FeedBack </b></label>

                    <textarea class="form-control" id="message"  maxlength="250"></textarea>


                    <button class="btn btn-info" id="submit"><i class="fa fa-paper-plane"></i>SUBMIT</button>

                </div>
            </div>
        </div>
    </div>

    <!-- End Rating  -->
    <!-- select data on the basis of customer id from order master table -->

    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading ">
                <strong>Your All Orders</strong>
            </div>
            <div class="panel-body">
                <div class="table table-responsive">
                    <table class="table-bordered table-hover" id="example1">
                        <thead>
                            <tr class="bg-success">
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Ordered On</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <!-- <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Ordered On</th>
                                <th>Review</th>
                            </tr> -->

                        </tfoot>
                        <tbody>
                            <?php 
                            $sl = 0;
                                foreach($all_ordered_products as $all_ordered_product){
                                    ?>
                            <tr>
                                <td><?=++$sl;?></td>
                                <td><?=$all_ordered_product->productName;?></td>
                                <td><?=$all_ordered_product->Iqty;?></td>
                                <td><?=$all_ordered_product->price;?></td>
                                <td><?=$all_ordered_product->orderedOn;?></td>
                                <td>
                                    <button class="btn-danger btn-sm" data-toggle="modal" data-target="#myModal"
                                        onclick="openform(<?php echo $all_ordered_product->pid?>);">Rating <i
                                            class="fa fa-star"></i>
                                    </button>

                                </td>

                            </tr>
                            <?php
                                }
                           ?>
                        </tbody>
                    </table>
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

function openform(product_id) {
    var product_id = product_id;
    $("#product_id").val(product_id);
}

$("#submit").click(function() {
    /*   alert("hii");*/
    var message = $("#message").val();
    var es = $("#starsInput").val();
    var product_id = $("#product_id").val();
    if (es == '') {
        alert("please click on rating");
    } else if (message == '') {
        alert('Please write somefeedback.')
    } else {
        $.ajax({
            url: '<?php echo base_url();?>add-rating',
            data: {
                rating: es,
                product_id: product_id,
                feedback: message
            },
            method: 'POST',
            dataType: "JSON",
            success: function(response) {
                // console.log("Success");
                alert('Thank you for your feedback');
                // location.reload();
                console.log(response);
                $("#message").val('');
                $("#starsInput").val('');
                $("#product_id").val('');
                $('#myModal').modal('hide');
                if (response.Response == 1) {
                    $("#msg").html("Thank you for your feedback.");
                } else if (response.Response == 0) {
                    $("#msg").html("Product is already rated.");

                }

            },
            error: function(response) {
                $("#message").val('');
                $("#starsInput").val('');
                $("#product_id").val('');
                console.log("Error");
                console.log(response);
                $('#myModal').modal('hide');
            }

        });
    }


});
</script>

<script type="text/javascript">
$("#review").rating({
    "value": 2,
    'half': true,
    "click": function(e) {
        console.log(e);
        $("#starsInput").val(e.stars);
        $("#show_selected_rating").html(e.stars);
    }
});
</script>