<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url()?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                       <?php  echo $this->db->count_all('order_master'); ?>
                    </h3>
                    <p>
                        Total  Orders
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?=base_url()?>get-all-orders" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php 
                        $this->db->where('satus !=', 5);
                        echo $this->db->count_all_results('order_master'); 
                         ?>

                        <sup style="font-size: 20px"></sup>
                    </h3>
                    <p>
                       Active Orders
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php echo $this->db->count_all('customer_master'); ?>
                    </h3>
                    <p>
                        User Registrations
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?=base_url()?>customer-list" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
           
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                       <?php foreach ($getSum as $key) {
                       echo $key->tAmount;
                       } ?>
                    </h3>
                    <p>
                       Total Sales
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div><!-- /.row -->

    <!-- top row -->
    <div class="row">
        <div class="col-xs-12 connectedSortable">
        <!-- datatables for the active orders -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Active Orders</h3>
                <div class="pull-right">
                    <a class="btn btn-danger" href="<?=base_url()?>get-all-orders" type="button" >View All Orders <i class="fa fa-eye"></i></a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example2" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr class="bg-green">
                            <th>Order_Id</th>
                            <th>Ordered_On </th>
                            <th>Mobile</th>
                            <th>Customer_Name</th>
<!--                            <th>Billing_Address</th>-->
                            <th>Order_Status</th>
                            <th>Update_Status</th>
                            <th>View_Details</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order_Id</th>
                            <th>Ordered_On </th>
                            <th>Mobile</th>
                            <th>Customer_Name</th>
<!--                            <th>Billing_Address</th>-->
                            <th>Order_Status</th>
                            <th>Update_Status</th>
                            <th>View_Details</th>
                        </tr>
                    </tfoot>
                    <tbody>
                           <?php foreach ($activeOrders as $key) { ?>
                              <tr>
                                  <td><?=$key->orderId?></td>
                                   <td><?=$key->added_at?></td>
                                  <td><?=$key->mobile?></td>
                                  <td><?=$key->customerName?></td>
                                  <td>
                                    <?php if($key->satus == 1)
                                    {
                                        echo '<button type="button" disabled class="btn btn-defalut btn-xs">New Order</button>';
                                    }
                                    else if($key->satus == 2)
                                    {
                                         echo '<button type="button" disabled class="btn btn-primary btn-xs">Processing</button>';
                                    }
                                    else if($key->satus == 3)
                                    {
                                        echo '<button type="button" disabled class="btn btn-info btn-xs">Packaging</button>';
                                    }
                                    else if($key->satus == 4){
                                        echo '<button type="button" disabled class="btn btn-warning btn-xs">Out for delivery</button>';
                                    }
                                    else if($key->satus == 5){
                                        echo '<button type="button" disabled class="btn btn-success btn-xs">Delivered</button>';
                                    }
                                    else if($key->satus == 6){
                                        echo '<button type="button" disabled class="btn btn-success btn-xs">Cancelled</button>';
                                    }
                                  ?></td>
                                  <td>
                                      
                                        
                                    <?php 
                                    if($key->satus != 6){
                                        ?>
                                        <select class="form-control ChangeStatus">
                                            <option value="">Update Status </option>
                                            <option value="2">Processing</option>
                                            <option value="3">Packaging</option>
                                            <option value="4">Out For Delivery</option>
                                            <option value="5">Delivered</option>
                                        </select>
                                            <?php
                                    }else{
                                        echo '<b>Cancelled</b>';
                                    }
                                    ?>
                                           

                                      
                                  </td>
                                <td>
                                    <?php 
                                    if($key->satus != 6){
                                        ?>
                                       <a href="<?=base_url()?>view-orders-by-order-id/<?=$key->orderId?>" type="button" class="btn btn-warning btn-sm" title="View order"><i class="fa fa-eye"></i>View Details</a>
                                            <?php
                                    }else{
                                        echo '<b>Cancelled</b>';
                                    }
                                    ?>
                                    

                                </td>
                                  <!-- <td><a href="<?=base_url()?>view-order/<?=$key->orderId?>" type="button" class="btn btn-warning btn-sm" title="View order">View Details <i class="fa fa-eye"></i></a></td> -->
                              </tr>
                          <?php } ?> 
                    </tbody>
                    
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
</section>
<!--content -->

<!-- page script -->
<script type="text/javascript">
$(function() {
        $("#example2").dataTable({
            "order": [[ 1, "desc" ]]
        });
});

$(document).ready(function(){
        $(".ChangeStatus").change(function () {
        var x = $(this).closest("tr");
        var status = this.value;
        var $tds = x.find("td");

        // alert(satus);
        var oid = $tds[0].textContent.trim();
        // alert(oid);
        var mobile = $tds[2].textContent.trim();
        // alert(mobile);
        if (confirm("Are you sure want to change  this order status?")) {
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>change-order-status',
            dataType: 'json',
            data: { status: status, orderId: oid},
            beforeSend: function () {
                //$("#"+id).fadeIn(100);
                // alert(data);
                console.log('checking');
            },
            success: function (data) {
            data = $.parseJSON(data);
                if(data.response==1){
                   // location.reload(); 
                }
            },
            error: function(data){
               console.log(data);
            },
            complete: function(data){
                location.reload();
            }
        });
        }
        else{
            console.log('some error occured in javascript');
        }
    })
});
</script>
