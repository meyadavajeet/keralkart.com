<!-- all stock -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Sales   Report
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Report</li>
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
                <form method="post" action="<?=base_url()?>get-sales-by-date">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> &nbsp;</label>
                                    <input type="submit" class="btn btn-info btn-block" name="submit" value="Generate Report">
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
                    <div class="table table-responsive">
                        <table id="dataTablesIds" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr class="text-capitalize bg-success">
                                    <th>Invoice</th>
                                    <th>Item_Name</th>
                                    <th>Quantity</th>
                                    <th>color</th>
                                    <th>size</th>
                                    <th>brand</th>
                                    <th>Selling_Price</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                <?php
                                $sellingPrice=0;
                                $totalSoldQuantity = 0;
                                 foreach ($getAllSales as $row) : ?>
                                <tr>
                                    <td><?= $row->orderId ?></td>
                                    <td><?= $row->productName ?></td>
                                    <td><?= $soldQuantity =  $row->itemQuantity ?></td>
                                    <td><?= $row->itemColor ?></td>
                                    <td><?= $row->itemSize ?></td>
                                    <td><?= $row->brandName ?></td>
                                    <td><?=  $itemPrice = $row->itemPrice ?></td>
                                </tr>
                                <?php
                                    $sellingPrice += $itemPrice;
                                    $totalSoldQuantity +=$soldQuantity;
                                 endforeach ?>
                            </tbody>
                             <tfoot>
                                <tr class="text-capitalize bg-success">
                                    <td></td>
                                    <td><b> Sold_quanity:</b></td>
                                    <td><strong><?=$totalSoldQuantity?></strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong> Total_Price :</strong></td>
                                    <td><b><?=$sellingPrice?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $("#dataTablesIds").dataTable({
        "pageLength": 10,
        dom: 'Bfrtip',
         buttons: [
            { extend: 'excelHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true },
            { extend: 'print', footer: true}
        ]
    });

});
</script>