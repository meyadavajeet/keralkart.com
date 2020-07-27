<!-- all stock -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Orders Report
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders Report</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?php if ($this->session->userdata('error_msg')) { ?>
                        <div class="alert alert-danger alert-dismissible ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong> <?= $this->session->flashdata('error_msg'); ?></strong>  
                        </div>
                    <?php } ?>
                </div>
                <form method="post" action="<?php echo base_url()?>get-orders-by-date">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="from-date">From Date</label>
                                    <input id="from-date" class="form-control" type="date" name="fromDate" required="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="to-date">To Date</label>
                                    <input id="to-date" class="form-control" type="date" name="toDate" required="">
                                </div>
                            </div>
                        <!--     <div class="col-sm-3">

                                <div class="form-group">
                                    <label> &nbsp;</label>
                                      <select class="form-control" name="orderStatus">
                                            <option value="">Choose Order status</option>
                                            <option value="1">New Orders</option>
                                            <option value="2">Processing</option>
                                            <option value="3">Packaging</option>
                                            <option value="4">Out For Delivery</option>
                                            <option value="5">Delivered</option>
                                        </select>   
                                </div>
                            </div> -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> &nbsp;</label>
                                    <input type="submit" class="btn btn-warning btn-block" name="submit" value="Generate Report">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-body">
                     <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr class="bg-aqua">
                            <th>Order_Id</th>
                            <th>Ordered_On </th>
                            <th>Mobile</th>
                            <th>Customer_Name</th>
                            <th>Billing_Address</th>
                            <th>Total</th>
                            <th>Ordered_Status</th>
                            <th>View_Details</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-aqua">
                            <th>Order_Id</th>
                            <th>Ordered_On </th>
                            <th>Mobile</th>
                            <th>Customer_Name</th>
                            <th>Billing_Address</th>
                            <th>Total</th>
                            <th>Ordered_Status</th>
                            <th>View_Details</th>
                        </tr>
                    </tfoot>
                    <tbody>
                           <?php foreach ($getAllOrders as $key) { ?>
                              <tr>
                                  <td><?=$key->orderId?></td>
                                   <td><?=$key->added_at?></td>
                                  <td><?=$key->mobile?></td>
                                  <td><?=$key->customerName?></td>
                                  <td><?=$key->shippingAddress?></td>
                                  <td><?=$key->total;?></td>
                                 
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
                                  ?></td>
                                  <td><a href="<?=base_url()?>view-order/<?=$key->orderId?>" type="button" class="btn btn-warning btn-sm" title="View order">View Details <i class="fa fa-eye"></i></a></td>
                              </tr>
                          <?php } ?> 
                    </tbody>
                </table>
            </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $("#example1").dataTable({
        "pageLength": 10,
         dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
    });

});
</script>