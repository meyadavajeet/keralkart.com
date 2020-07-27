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
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create New Coupon</h3>
                </div>
                <!-- form start -->
                <form method="post" action="<?php echo base_url() ?>Welcome/couponCreate"  role="form" autocomplete="off">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="eg:HAPPYNEWYEAR" required="">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" min="0" class="form-control" name="amount" id="amount" placeholder="Coupon Amount eg:20"  required="">
                        </div>
                        <div class="form-group">
                            <label for="usageLimit">Usage Limit</label>
                            <input type="number" min="0" class="form-control" name="usageLimit" id="usageLimit" placeholder="eg: 0 or 1"  required="">
                            <h5><small><strong class="text-danger">0</strong> for unlimited use for per customer OR  <strong class="text-success">1</strong> for only one usage per customer</small></h5>
                        </div>
                        <div class="form-group">
                            <label for="validFromDate">Coupon Valid From Date</label>
                            <input type="date" class="form-control" name="validFromDate" id="validFromDate" required="">
                        </div>
                        <div class="form-group">
                            <label for="validToDate">Coupon Valid To Date</label>
                            <input type="date" class="form-control" name="validToDate" id="validToDate"  required="">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-block ">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-sm-3"></div>

    </div>
</section>

