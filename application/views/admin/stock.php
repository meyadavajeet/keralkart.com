<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Stock</li>
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
<!-- model code for import product -->
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
                    $output .= form_open_multipart('StockImport/save');
                    $output .= '<div class="row">';
                    $output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
                    $output .= form_label('Import Stock', 'image');
                    $data = array(
                        'name' => 'userfile',
                        'id' => 'userfile',
                        'class' => 'form-control filestyle',
                        'value' => '',
                        'data-icon' => 'false'
                    );
                    $output .= form_upload($data);
                    $output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input</span></div>';
                    $output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
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
<!-- model code end -->
<!-- Main content -->
<section class="content">
    <!-- Small boxes (start box) -->
    <div class="row">
        <!-- type table -->
        <div class="col-sm-12">
            <div class="box panel panel-primary">
                <div class="box-header panel-heading">
                    <h3 class="box-title">Manage Stock</h3>
                    <div class="pull-right">
                        <a href="<?=base_url();?>add-stock" class="btn btn-warning"><i class="fa fa-plus-square"></i>
                            Add New
                            Stock</a>
                        <!--<button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal"-->
                        <!--    name="importExcel"><i class="fa fa-file"></i> Import Stock Excel File </button>-->
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
                                <th>status</th>
                                <th>Action</th>
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
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $sl=0;
                             foreach ($stockList as  $row): ?>
                            <tr>
                                <td><?= ++$sl;?></td>
                                <td><?=$row->productCode?></td>
                             
                                <td><?=$row->color?></td>
                                <td><?=$row->size?></td>
                                <td><?=$row->stockPrice?></td>
                                <td><?=$row->quantity?></td>
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
                                        data-placement="top"><i class="fa fa-pencil-square-o"></i>
                                    </a>

                                    <?php if ($status == 1) { ?>
                                    <a href="<?= base_url(); ?>stock-status-update/<?= $row->id; ?>"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button"
                                        class="btn btn-danger btn-sm" data-toggle="tooltip" title="Inactive"
                                        data-placement="top"><i class="fa fa-ban"></i></a>
                                    <?php
                                        } else {  ?>

                                    <a href="<?= base_url(); ?>stock-status-update/<?= $row->id; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-ban"></i></a>

                                    <!--   <a href="<?= base_url(); ?>Welcome/stockDelete/<?= $row->id; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                        class="btn btn-sm btn-warning" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-trash"></i></a> -->

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
                                            <h4 class="modal-title">Update Stock</h4>
                                        </div>
                                        <form method="post" name="typeEditForm"
                                            action="<?php echo base_url() ?>Welcome/stockUpdate" role="form">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input class="form-control" type="hidden" name="id"
                                                        value="<?=$row->id?>">
                                                    <label>Product Code </label>
                                                    <input class="form-control" type="text" name="productCode"
                                                        value="<?=$row->productCode?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <input id="color" class="form-control" type="text" name="color"
                                                        value="<?=$row->color?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="size">Size</label>
                                                    <input id="size" class="form-control" type="text" name="size"
                                                        value="<?=$row->size?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="stockPrice">Stock Price</label>
                                                    <input id="stockPrice" class="form-control" type="number"
                                                        name="stockPrice" min="0" value="<?=$row->stockPrice;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input id="quantity" class="form-control" type="number"
                                                        name="quantity" min="0" value="<?=$row->quantity?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="">Select Options</option>
                                                        <?php
                                                            if ($row->status=='1') {
                                                                ?><option selected="" value="1">Yes</option>
                                                        <option value="0">No</option><?php
                                                            }
                                                            elseif($row->status=='0'){
                                                                ?><option selected="" value="0">No </option>
                                                        <option value="1">Yes</option><?php
                                                            }else{
                                                                ?>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                        <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block"
                                                        name="update">Update</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                            <!-- Edit modal End -->
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
