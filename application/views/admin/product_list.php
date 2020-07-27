<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Product</li>
    </ol>
</section>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <?php if ($this->session->userdata('success_msg')) { ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong class="text-center">
             <?= $this->session->flashdata('success_msg'); ?>
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import product list from excel (.xls or .xlsx)</h4>
            </div>
            <div class="modal-body">
                <?php
                    $output = '';
                    $output .= form_open_multipart('Import/save');
                    $output .= '<div class="row">';
                    $output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
                    $output .= form_label('Import Product', 'image');
                    $data = array(
                        'name' => 'userfile',
                        'id' => 'userfile',
                        'class' => 'form-control filestyle',
                        'value' => '',
                        'data-icon' => 'false'
                    );
                    $output .= form_upload($data);
                    $output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input </span> </div>' ;
                    $output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right ">';
                    $data = array(
                        'name' => 'importfile',
                        'id' => 'importfile-id',
                        'class' => 'btn btn-primary',
                        'value' => 'Import',
                    );
                    $output .= form_submit($data, 'Import Data');
                    $output .= '</div>
                                            </div></div>';
                    $output .= form_close();
                    echo $output;
                    ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (start box) -->
    <div class="row">
        <div class="col-sm-12">
            <div class="box panel-success">
                <div class="box-header panel-heading">
                    <h3 class="box-title">Product List</h3>
                    <div class="pull-right">
                        <a href="<?=base_url();?>product" class="btn btn-success"><i class="fa fa-plus-square"></i> Add
                            New
                            Product</a>
                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info"
                            name="importExcel"><i class="fa fa-download"></i> Import Product Excel File </button>
                    </div>
                </div>

                <div class="box-body table-responsive panel-body">
                    <table id="dataTablesIds" class="table table-bordered table-striped">
                        <thead class="bg-primary">
                            <tr class="text-uppercase">
                                <td> productCode </td>
                                <td> productName </td>
                                <td> thumbnail1 </td>
                                <td>status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tfoot class="bg-primary">
                            <tr class="text-uppercase">
								<td> productCode </td>
								<td> productName </td>
								<td> thumbnail1 </td>
								<td>status</td>
								<td>Action</td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                        $color='';
                        foreach ($productList as $row) :
                            ?>
                            <tr>

                                <td>
                                    <?= $row->productCode; ?>
                                </td>
                                <td>
                                    <?= $row->productName; ?>
                                </td>
                                <td>
                                    <a href="<?=base_url()?>./uploads/product/<?= $row->thumbnail1; ?>"><img
                                            class="img img-responsive img-responsive"
                                            src="<?=base_url()?>./uploads/product/<?= $row->thumbnail1; ?>" height="20"
                                            width="40" alt="thumbnail1 not found">
                                         </a>
                                </td>
                                <td>
                                    <?php
                                      $status = $row->prd_status;
                                    if ($status == 1) {
                                        echo '<button type="button" class="btn btn-success btn-xs" disabled> Active</button>';
                                    } else if($status == 0) {
                                        echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?=base_url()?>view-product/<?=$row->id?>" type="button"
                                        class="btn btn-sm btn-info" title="View" data-placement="top"><i
                                            class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?=base_url()?>edit-product/<?=$row->id?>" type="button"
                                        class="btn btn-sm btn-primary" title="Edit" data-placement="top"><i
                                            class="fa fa-pencil-square-o"></i>
                                    </a>

                                    <?php if ($status == 1) { ?>
                                    <a href="<?= base_url(); ?>product-status-update/<?= $row->id; ?>"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button"
                                        class="btn btn-danger btn-sm" data-toggle="tooltip" title="Inactive"
                                        data-placement="top"><i class="fa fa-ban"></i></a>
                                    <?php
                                    } else {  ?>

                                    <a href="<?= base_url(); ?>product-status-update/<?= $row->id; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-ban"></i></a>

                                    <a href="<?= base_url(); ?>Welcome/productDelete/<?= $row->id; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                        class="btn btn-sm btn-warning" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-trash"></i></a>

                                    <?php } ?>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- type table -->

    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $("#dataTablesIds").dataTable({
        "pageLength": 50
    });
});
</script>
