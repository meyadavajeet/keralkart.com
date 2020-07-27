<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Coupon</li>
    </ol>
</section>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
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
    </div>
</div>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (start box) -->
    <div class="row">
        <!-- type table -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Coupon List</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="dataTablesIds" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Coupon Code</th>
                            <th>Amount</th>
                            <th>Valid From</th>
                            <th>Valid To </th>
                            <th>Usage Limit </th>
                            <th>Added_at</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S   .No.</th>
                            <th>Coupon Code</th>
                            <th>Amount</th>
                            <th>Valid From</th>
                            <th>Valid To </th>
                            <th>Usage Limit </th>
                            <th>Added_at</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($couponList as $row) :
                            ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $row->couponCode; ?></td>
                                <td><?= $row->amount; ?></td>
                                <td><?= $row->validFromDate; ?></td>
                                <td><?= $row->validToDate; ?></td>
                                <td><?= $row->usageLimit; ?></td>
                                <td><?= $row->added_at; ?></td>
                                <td>
                                    <?php
                                    $status = $row->status;
                                    if ($status == 1) {
                                        echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#myModal<?= $row->id; ?>" type="button"
                                       class="btn btn-primary" data-toggle="tooltip" title="Edit"
                                       data-placement="top"><i class="fa fa-pencil-square-o"></i></a>
                                       <?php if ($status == 1) { ?>
                                        <a href="<?= base_url(); ?>Welcome/couponStatusUpdate/<?= $row->id; ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button" class="btn btn-danger" data-toggle="tooltip" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
                                        <?php
                                    } else {
                                        ?>

                                        <a href="<?= base_url(); ?>Welcome/couponDelete/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Delete?'));" class="btn btn-warning" data-toggle="tooltip" title="Delete" data-placement="top"><i class="fa fa-trash"></i></a>
                                        <a href="<?= base_url(); ?>Welcome/couponStatusUpdate/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
                                    <?php } ?>
                                </td>

                            </tr>
                            <!-- Edit Modal -->
                        <div class="modal fade" id="myModal<?= $row->id; ?>" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit and Update Coupon</h4>
                                    </div>
                                    <form method="post" name="couponEditForm" action="<?php echo base_url() ?>Welcome/couponUpdate" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="id">Coupon Code</label>
                                                <input type="hidden" class="form-control" name="id" id="id" value="<?= $row->id; ?>" required=""><br>

                                                <input type="text" class="form-control" name="code" id="code" value="<?= $row->couponCode; ?>" required=""><br>

                                            </div>  
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" min="0" class="form-control" value="<?= $row->amount; ?>" name="amount" id="amount" placeholder="Coupon Amount eg:20"  required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="usageLimit">Usage Limit</label>
                                                <input type="number" min="0" class="form-control" value="<?= $row->usageLimit; ?>" name="usageLimit" id="usageLimit" placeholder="eg: 0 or 1"  required="">
                                                <h5><small><strong class="text-danger">0</strong> for unlimited use for per customer OR  <strong class="text-success">1</strong> for only one usage per customer</small></h5>
                                            </div>
                                            <div class="form-group">
                                                <label for="validFromDate">Coupon Valid From Date</label>
                                                <input type="date" class="form-control" name="validFromDate" value="<?= $row->validFromDate; ?>" id="validFromDate" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="validToDate">Coupon Valid To Date</label>
                                                <input type="date" class="form-control" name="validToDate" value="<?= $row->validToDate; ?>" id="validToDate"  required="">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                        <!-- Edit modal End -->
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#dataTablesIds").dataTable({
            "pageLength": 10
        });

    });
</script>
