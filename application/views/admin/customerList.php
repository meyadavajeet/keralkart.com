<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Customer</li>
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
                    <h3 class="box-title">Manage Customer</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTablesIds" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr class="text-capitalize bg-success">
                                <th>Customer Id </th>
                                <th>Customer Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th>status</th>
                                <th>Is Activated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-capitalize bg-success">
                                <th>Customer Id </th>
                                <th>Customer Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th>status</th>
                                <th>Is Activated</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($customerList as  $row): ?>
                            <tr>
                                <td><?=$row->id?></td>
                                <td><?=$row->customerName?></td>
                                <td><?=$row->mobile?></td>
                                <td><?=$row->email?></td>
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
                                    <?php
                                    $isActive = $row->is_activated;
                                    if ($isActive == 1) {
                                        echo '<button type="button" class="btn btn-primary btn-xs" disabled>Varified</button>';
                                    } else{
                                        echo '<button type="button" class="btn btn-warning btn-xs" disabled>Not Varified</button>';
                                    }
                                   

                                    ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#myModal<?= $row->id; ?>" type="button"
                                        class="btn btn-primary btn-sm" data-toggle="tooltip" title="view "
                                        data-placement="top"><i class="fa fa-eye"></i>
                                    </a>
                                    <?php if ($status == 1) { ?>
                                    <a href="<?= base_url(); ?>customer-status-update/<?= $row->id; ?>"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button"
                                        class="btn btn-danger btn-sm" data-toggle="tooltip" title="Inactive"
                                        data-placement="top"><i class="fa fa-ban"></i>
                                    </a>
                                    <?php
                                        } else {  ?>

                                    <a href="<?= base_url(); ?>customer-status-update/<?= $row->id; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-ban"></i>
                                    </a>
                                    <?php } ?>

                                </td>

                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="myModal<?= $row->id; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">View Customer Detail</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Profile Image</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    : <img class="img img-responsive img-thumbnail" src="uploads/customers/<?=$row->profileImage?>" alt="no-image found" height="100" width="100">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Customer Name</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?=$row->customerName?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Customer Mobile Number</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?=$row->mobile?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Customer Eamil</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?=$row->email?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Customer Address</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?=$row->CustomerAddress?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Added On</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?=$row->added_at?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Modified On</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?=$row->modified_at?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Status</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?php if($row->status==1){
                                                      echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';   
                                                    }
                                                    else{
                                                    echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                                    }
                                                    ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Varified</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>: <?php if($row->is_activated == 1)
                                                    {
                                                        echo '<button type="button" class="btn btn-primary btn-xs" disabled>Varified</button>';
                                                    }
                                                    else{ 
                                                        echo '<button type="button" class="btn btn-warning btn-xs" disabled>Not Varified</button>';

                                                        }
                                                        ?>
                                                    
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- View modal End -->
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