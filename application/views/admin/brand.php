<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Brand</li>
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
                    <h3 class="box-title">Create New Brand</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?= base_url(); ?>Welcome/brandCreate" id="brandForm" name="brandForm" role="form" enctype="multipart/form-data" autocomplete="off">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="brandName">Brand Name</label>
                            <input type="text" name="brandName" id="brandName" placeholder="Brand Name" class="form-control" required="">
                            <span id="brand_result"></span>
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
                    <h3 class="box-title">Brand List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataList" class="table table-bordered table-striped text-center">
                        <thead class="text-capitalize bg-success">
                            <tr>
                                <th>S.No.</th>
                                <th>Brand Name</th>
                                <th>Added At</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot class="text-capitalize bg-success">
                            <tr>
                                <th>S.No.</th>
                                <th>Brand Name</th>
                                <th>Added At</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($brandList as $row) :
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $row->brandName; ?></td>
                                    <td><?php $added_at_datetime = new DateTime($row->added_at);
                                        echo $added_at_date = $added_at_datetime->format('d-m-Y'); ?></td>
                                    <td><?php
                                        $status = $row->status;
                                        if ($status == 1) {
                                            echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';
                                        } else {
                                            echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                        }
                                        ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#myModal<?= $row->id ?>" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit" data-placement="top"><i class="fa fa-pencil-square-o"></i></a>
                                        <?php if ($status == 1) { ?>
                                            <a href="<?= base_url(); ?>Welcome/brandStatusUpdate/<?= $row->id ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
                                        <?php } else { ?>
                                            <a href="<?= base_url(); ?>Welcome/brandStatusUpdate/<?= $row->id ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success btn-xs" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
                                            <a href="<?= base_url(); ?>Welcome/brandDelete/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Delete?'));" class="btn btn-warning" data-toggle="tooltip" title="Delete" data-placement="top"><i class="fa fa-trash"></i></a>
                                        <?php } ?></td>
                                </tr>
                                <!-- Edit Modal -->
                                <div class="modal fade" id="myModal<?= $row->id; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit & Update</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" name="EditForm" id="EditForm" action="<?= base_url(); ?>Welcome/brandUpdate" role="form" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?= $row->id; ?>" class="form-control" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="categoryName">Brand Name</label>
                                                        <input type="text" name="brandNameEdit" id="brandNameEdit" value="<?= $row->brandName; ?>" placeholder="Brand Name" class="form-control" required="">
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
    $(document).ready(function() {
        $("#dataList").dataTable({
            "pageLength": 10
        });
        $('#brandName').on('input', function() {
            var brandName = $('#brandName').val();
            if (brandName !== '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_brand_avalibility",
                    method: "POST",
                    data: {
                        brandName: brandName
                    },
                    success: function(data) {
                        $('#brand_result').html(data);
                    }
                });
            }
        });
        $('#brandNameEdit').on('input', function() {
            var brandName = $('#brandNameEdit').val();
            if (brandName !== '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_brand_avalibility",
                    method: "POST",
                    data: {
                        brandName: brandName
                    },
                    success: function(data) {
                        $('#brand_name_result').html(data);
                    }
                });
            }
        });
    });
</script>