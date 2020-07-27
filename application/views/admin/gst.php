<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage GST</li>
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
<div class="col-sm-1"></div>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-4">
            <!-- type form -->
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create GST</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?= base_url(); ?>GstController/gstCreate" id="brandForm" name="brandForm"
                      role="form" enctype="multipart/form-data" autocomplete="off">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="gst_name">GST Name</label>
                            <input type="text" name="gst_name" id="gst_name" placeholder="GST Name" class="form-control" required="">
                            <span id="gst_name_result"></span>
                        </div>
                        <div class="form-group">
                            <label for="brandName">GST Rate (%) </label>
                            <input type="text" name="gst_rate" id="gst_rate" placeholder="GST Rate in %" class="form-control" required="">
                            <span id="gst_rate_result"></span>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-sm-8">
            <!-- type table -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">GST List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataList" class="table table-bordered table-striped text-center">
                        <thead class="text-capitalize">
                            <tr class="bg-success">
                                <th>S.No.</th>
                                <th>GST_Name</th>
                                <th>GST_Value (%)</th>
                                <th>Added_At</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot class="text-capitalize">
                            <tr>
                              <th>S.No.</th>
                              <th>GST Name</th>
                              <th>GST Value (%)</th>
                              <th>Added_At</th>
                              <th>status</th>
                              <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody class="text-center">
                            <?php
                            $i = 0;
                            foreach ($gst_list as $row):
                                ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $row->gst_name; ?></td>
                                    <td><?= $row->gst_rate; ?></td>
                                    <td><?= $row->added_at; ?></td>
                                    <td><?php
                                        $status = $row->status;
                                        if ($status == 1) {
                                            echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';
                                        } else {
                                            echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                        }
                                        ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#myModal<?= $row->gst_id ?>" type="button"
                                           class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit"
                                           data-placement="top"><i class="fa fa-pencil-square-o"></i></a>
                                           <?php if ($status == 1) { ?>
                                            <a href="<?= base_url(); ?>GstController/gstStatusUpdate/<?= $row->gst_id ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                               type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Inactive"
                                               data-placement="top"><i class="fa fa-ban"></i></a>
                                           <?php } else { ?>
                                            <a href="<?= base_url(); ?>GstController/gstStatusUpdate/<?= $row->gst_id ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success btn-xs" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
                                            <a href="<?= base_url(); ?>GstController/gstDelete/<?= $row->gst_id; ?>" type="button" onclick="return(confirm('Are You Sure want to Delete?'));" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Delete" data-placement="top"><i class="fa fa-trash"></i></a>
                                        <?php } ?></td>
                                </tr>
                                <!-- Edit Modal -->
                            <div class="modal fade" id="myModal<?= $row->gst_id; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit & Update</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" name="EditForm" id="EditForm" action="<?= base_url(); ?>GstController/gstUpdate" role="form" enctype="multipart/form-data" autocomplete="off">
                                                <div class="form-group">
                                                    <input type="hidden" name="gst_id" value="<?= $row->gst_id; ?>" class="form-control" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="categoryName">Gst Name</label>
                                                    <input type="text" name="gst_name" id="" value="<?= $row->gst_name; ?>" placeholder="GST Name" class="form-control" required="">
                                                    <span id="brand_name_result"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="categoryName">Gst Rate</label>
                                                    <input type="text" name="gst_rate" id="" value="<?= $row->gst_rate; ?>" placeholder="GST Rate" class="form-control" required="">
                                                    <span id="brand_name_result"></span>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
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
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#dataList").dataTable({
            "pageLength": 10
        });
        $('#brandName').on('input',function () {
            var brandName = $('#brandName').val();
            if (brandName !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_brand_avalibility",
                    method: "POST",
                    data: {brandName: brandName},
                    success: function (data) {
                        $('#brand_result').html(data);
                    }
                });
            }
        });
        $('#brandNameEdit').on('input',function () {
            var brandName = $('#brandNameEdit').val();
            if (brandName !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_brand_avalibility",
                    method: "POST",
                    data: {brandName: brandName},
                    success: function (data) {
                        $('#brand_name_result').html(data);
                    }
                });
            }
        });
    });
</script>
