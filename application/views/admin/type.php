<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Type</li>
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
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-4">
            <!-- type form -->
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add Type</h3>
                    <h6><small>Example:- Electronics, Men, Women, etc...</small></h6>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo base_url() ?>Welcome/typeCreate" id="typeForm" name="typeForm" role="form"autocomplete="off">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="typeName">Type Name</label>
                            <input type="text" class="form-control" name="typeName" id="typeName" placeholder="Enter Type Name" required="">
                            <span id="type_result"></span>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-sm-8">
            <!-- type table -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Type List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="typeTable" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th>TypeName</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot class="text-uppercase">
                            <tr>
                                <th>TypeName</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody id="typeListData">

                            <?php foreach ($typeList as $row) : ?>
                                <tr>
                                    <td><?= $row->typeName; ?></td>
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
                                        <a href="#" data-toggle="modal" data-target="#myModal<?= $row->id ?>" type="button"
                                           class="btn btn-primary" data-toggle="tooltip" title="Edit"
                                           data-placement="top"><i class="fa fa-pencil-square-o"></i></a>
                                           <?php if ($status == 1) { ?>
                                            <a href="<?=base_url();?>Welcome/typeStatusUpdate/<?=$row->id;?>"  type="button" class="btn btn-danger" data-toggle="tooltip" onclick="return(confirm('Are You Sure want to Chanage Status?'));" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
                                           <?php } else { ?>
                                            <a href="<?=base_url();?>Welcome/typeStatusUpdate/<?=$row->id;?>" type="button" class="btn btn-success" data-toggle="tooltip" onclick="return(confirm('Are You Sure want to Chanage Status?'));" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
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
                                            <h4 class="modal-title">Update Type</h4>
                                        </div>
                                        <form method="post" name="typeEditForm"
                                              action="<?php echo base_url() ?>Welcome/typeUpdate" role="form">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="typeName">Type Name</label>
                                                    <input type="hidden" class="form-control" name="id" id="id"
                                                           value="<?= $row->id; ?>" required="">
                                                    <br>
                                                    <input type="text" class="form-control" name="typeNameEdit"
                                                           id="typeNameEdit" value="<?= $row->typeName; ?>" required=""><br>
                                                    <button type="submit" class="btn btn-primary btn-block"
                                                            name="update">Update</button>
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
    </div>

</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#typeTable").dataTable({
            "pageLength": 8
        });
        $('#typeName').on('input', function () {
            var typeName = $('#typeName').val();
            if (typeName !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_type_avalibility",
                    method: "POST",
                    data: {typeName: typeName},
                    success: function (data) {
                        $('#type_result').html(data);
                    }
                });
            }
        });
        $('#typeNameEdit').on('input', function () {
            var typeName = $('#typeNameEdit').val();
            if (typeName !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_type_avalibility",
                    method: "POST",
                    data: {typeName: typeName},
                    success: function (data) {
                        $('#type_name_result').html(data);
                    }
                });
            }
        });
    });
</script>