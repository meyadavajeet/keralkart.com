<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage FAQ</li>
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
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manage FAQ</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="dataTablesIds" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                          
                            <th> Date</th>
                              <th>status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($Contact_message as $row) :
                            ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $row->firstname; ?></td>
                                <td><?= $row->lastname; ?></td>
                                <td><?= $row->email; ?></td>
                                <td><?= $row->subject; ?></td>
                                <td><?= $row->message; ?></td>
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
                               

                            </tr>
                           
                        <!-- Edit modal End -->
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>     
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#dataTablesIds").dataTable({
            "pageLength": 10
        });

    });
</script>
