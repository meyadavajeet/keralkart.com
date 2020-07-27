<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Administration</li>
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
    <!-- Small boxes (start box) -->
    <div class="row">
        <div class="col-sm-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create New Administration</h3>
                </div>
                <!-- form start -->
                <form method="post" action="<?php echo base_url() ?>Welcome/administrationCreate" id="administrationForm" name="administrationForm" role="form" autocomplete="off">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" name="username" id="username" required="">
                            <!--<span id="username_result"></span>-->
                            <label class="text-danger username_result"><span class="glyphicon glyphicon-remove"></span> UserName Already Taken!!.</span></label>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"  required="">
                            <span id="email_result"></span>

                        </div>
                        <div class="form-group">
                            <label for="ePassword">Password</label>
                            <input type="password" class="form-control" name="ePassword" id="ePassword"  required="">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="btnSubmit" name="submit" class="btn btn-primary btn-block ">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-sm-8">
            <!-- type table -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Notification List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTablesIds" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th>Sl.No.</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot class="text-uppercase">
                            <tr>
                                <th>Sl.No.</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            $i = 0;
                            foreach ($administrationList as $row) :
                                ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $row->username; ?></td>
                                    <td><?= $row->email; ?></td>
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
                                        <?php if ($status == 1) { ?>
                                            <a href="<?= base_url(); ?>Welcome/administrationStatusUpdate/<?= $row->id; ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button" class="btn btn-danger" data-toggle="tooltip" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?= base_url(); ?>Welcome/administrationStatusUpdate/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
                                            <?php } ?>
                                    </td>

                                </tr>

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
        $("#dataTablesIds").dataTable({
            "pageLength": 10
        });
        $('#email').change(function () {
            var email = $('#email').val();
            if (email !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_admin_email_avalibility",
                    method: "POST",
                    data: {email: email},
                    success: function (data) {
                        $('#email_result').html(data);
                    }
                });
            }
        });
        $('.username_result').hide();
        $('#username').change(function () {
            var username = $('#username').val();
            if (username !== '')
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>Welcome/check_admin_username_avalibility",
                    method: "POST",
                    data: {username: username},
                    dataType: "JSON",
                    success: function (data) {
//                        console.log(data);
                     var myObj = data;
//                       alert(myObj.response[0]);
                        if (myObj.response[0] === "0") {
                            $("#btnSubmit").attr("disabled", true);
                                $('.username_result').show();
                        }

//                        $('#username_result').html(data);

                    },
                    error: function (data) {
                        console.log(data);
                    }

                });
            }
        });


    });
</script>