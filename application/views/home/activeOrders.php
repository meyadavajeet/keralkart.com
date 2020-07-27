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
                    <a href="<?=base_url();?>active-orders" class=" btn btn-block btn-success btn-sm"
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
                    <strong> All Active Orders</strong>
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
                                        <th>Track Order</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                    <?php $sl = 0;
                                foreach ($active_orders as $row): 
                                   
                                ?>
                                    <tr>
                                        <td><?= ++$sl; ?></td>
                                        <td><?= $row->orderId; ?></td>
                                        <td><img class="img img-responsive img-thumbnail"
                                                src="<?=base_url()?>uploads/product/<?=$row->productImage?>"
                                                style="height:50px; width:50px;"></td>
                                        <td><?= $row->added_at; ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>get-data-by-orderid-active-orders/<?= $row->orderId; ?>"
                                                type="button" title="View Details"
                                                class="myorders_track btn-success btn-sm">
                                                <i class="fa fa-eye"></i> View Details
                                            </a>
                                        </td>
                                        <td>
                                            <a class="myorders_track btn-success" href="<?=base_url()?>trackOrderByOrderId/<?=$row->orderId?>">
                                                <span class="glyphicon glyphicon-map-marker"></span>
                                                Track</a>
                                        </td>
                                        <td>
                                            <input type="hidden" id="productId<?=$row->orderId?>" value="<?= $row->productId; ?>" name="">
                                            <input type="hidden" id="color<?=$row->orderId?>" value="<?= $row->color; ?>" name="">
                                            <input type="hidden" id="size<?=$row->orderId?>" value="<?= $row->size; ?>" name="">
                                            <input type="hidden" id="qty<?=$row->orderId?>" value="<?= $row->Iqty; ?>" name="">
                                            <input type="hidden" id="orderId<?=$row->orderId?>" value="<?= $row->orderId; ?>" name="">
                                            <select class="form-control" id="ChangeStatus<?=$row->orderId;?>">
                                                <option value="">Select</option>
                                                <option value="6">Cancel order</option>
                                                
                                            </select>
                                        </td>
                                    </tr>
                                  	<script type="text/javascript">
											$('#ChangeStatus<?= $row->orderId; ?>').change(function () {
												// alert("f");
												var pid = $('#productId<?=$row->orderId?>').val();
												var color = $('#color<?=$row->orderId?>').val();
												var size = $('#size<?=$row->orderId?>').val();
												var oid = $('#orderId<?=$row->orderId?>').val();
												var qty = $('#qty<?=$row->orderId?>').val();
												var satus = this.value;
												// console.log(pid+" "+color+" "+size+" "+oid +" "+ qty +" "+ satus);

												if (confirm("Are you sure want to cancel this order?")) {
													$.ajax({
														url: "<?php echo base_url(); ?>change-order-status-user",
														method: "POST",
														data: {
															satus: satus,
															color: color,
															size: size,
															qty: qty,
															pid: pid,
															orderId: oid
														},
														success: function (data) {
															// $('#productCode').val(data);
															// $('#productId').val(categoryId);
															location.reload();
														},
														error: function (data) {
															console.log(data);
														}
													});
												} else {
												let txt = "You pressed Cancel!";
												location.reload();
												}


											});
									</script>
                                    
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

<script type="text/javascript">
    $(document).ready(function(){
    //     $('.ChangeStatus').change(function() {
    //         //alert("f");
    //     var pid = $('#productId').val();
    //     var color = $('#color').val();
    //     var size = $('#size').val();
    //     var oid = $('#orderId').val();
    //     var qty = $('#qty').val();
    //     var satus = this.value;
        
    //     if (confirm("Are you sure want to cancel this order?")) {
    //         $.ajax({
    //             url: "<?php echo base_url(); ?>change-order-status-user",
    //             method: "POST",
    //             data: {
    //                 satus: satus, 
    //                 color: color, 
    //                 size: size, 
    //                 qty: qty, 
    //                 pid: pid, 
    //                 orderId: oid
    //             },
    //             success: function(data) {
    //                 // $('#productCode').val(data);
    //                 // $('#productId').val(categoryId);
    //               location.reload(); 
    //             }
    //         });
    //     } else {
    //       //txt = "You pressed Cancel!";
    //     }
       
            
        
    // });

        $(".ChangeSstatus").change(function () {
        var oid = $('#orderId').val();
        //var oid = $('#orderId').val();
        //var x = $(this).closest("tr");
        var satus = this.value;
        //var $tds = x.find("td");

        // alert(satus);
        //var oid = '202009216369301';
        alert(oid + satus);
        // var mobile = $tds[2].textContent.trim();
        // alert(mobile);
        $.ajax({
            type: "POST",
             url: '<?=base_url()?>change-order-status-user',
            dataType: 'json',
            data: { satus: satus, orderId: oid},
            beforeSend: function () {
                //$("#"+id).fadeIn(100);
                // alert(data);
                console.log('checking');
            },
            success: function (data) {
                alert("success "+data.response);
            data = $.parseJSON(data);
            if(data.response==1){
                alert('1 + ' + data.response);
              // location.reload(); 
            }
            else{
                alert(data.response);
             // location.reload(); 
            }
            
            },
            error: function(data){
                alert("succsess "+data.status);
               console.log(data);
            }
        });
         //location.reload(); 
    });
});
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript">
$(document).ready(function() {
    $("#example1").dataTable({
        "pageLength": 10
    });

});
</script>