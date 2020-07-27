<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Available Stock</li>
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
        <div class="col-sm-12">
            <div class="box panel panel-primary">
                <div class="box-header panel-heading">
                    <h3 class="box-title">Available Stock</h3>
                    <div class="pull-right">
                        <a href="<?=base_url();?>add-stock" class="btn btn-warning"><i class="fa fa-plus-square"></i>
                            Add New
                            Stock
                          </a>
                    </div>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTablesIds" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr class="text-capitalize bg-success">
                                <th>Sl. No</th>
                                <th>product Code</th>
                               
                                <th>color</th>
                                <th>size</th>
                                <th>price </th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-capitalize bg-success">
                                <th>Sl. No</th>
                                <th>product Code</th>
                          
                                <th>color</th>
                                <th>size</th>
                                <th>price </th>
                                <th>Quantity</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $sl=0;
                             foreach ($available_stock as  $row): ?>
                            <tr>
                                <td><?= ++$sl;?></td>
                                <td><?=$row->productCode?></td>
                             
                                <td><?=$row->color?></td>
                                <td><?=$row->size?></td>
                                <td><?=$row->stockPrice?></td>
                                <td><?=$row->quantity?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $("#dataTablesIds").dataTable({
        "pageLength": 10
    });

});
</script>
