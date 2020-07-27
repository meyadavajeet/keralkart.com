<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Notification</li>
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
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create New Notification</h3>
                </div>
                <!-- form start -->
                <form method="post" action="<?php echo base_url() ?>Welcome/notificationCreate" id="typeForm" name="typeForm"
                      role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="notificationText">Notification Text</label>
                            <textarea name="notificationText"id="notificationText" cols="5" rows="10" class="form-control" required=""></textarea>
                            <!--<input type="text" class="form-control" name="notificationText" id="notificationText" placeholder="Notification Title" required="">-->
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
                    <h3 class="box-title">Notification List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="notificationTable" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th>S.No.</th> 
                                <th>Notification Text</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot class="text-uppercase">
                            <tr>
                                <th>S.No.</th> 
                                <th>Notification Text</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($notificationList as $row):
                                ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= substr($row->notificationText, 2) ;?></td>
                                    <td><?= $row->added_at; ?></td>
                                    <td><?php
                                        $status = $row->status;
                                        if ($status == 1) {
                                            echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';
                                        } else {
                                            echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                        }
                                        ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#myModal<?= $row->id ?>" type="button"
                                           class="btn btn-primary" data-toggle="tooltip" title="Edit"
                                           data-placement="top"><i class="fa fa-pencil-square-o"></i></a>
                                           <?php if ($status == 1) { ?>
                                            <a href="<?= base_url(); ?>Welcome/notificationStatusUpdate/<?= $row->id ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                               type="button" class="btn btn-danger" data-toggle="tooltip" title="Inactive"
                                               data-placement="top"><i class="fa fa-ban"></i></a> 
                                           <?php } else { ?>
                                            <a href="<?= base_url(); ?>Welcome/notificationStatusUpdate/<?= $row->id ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
                                            <a href="<?= base_url(); ?>Welcome/notificationDelete/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Delete?'));" class="btn btn-warning" data-toggle="tooltip" title="Delete" data-placement="top"><i class="fa fa-trash"></i></a>
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
                                            <form method="post" name="EditForm" id="EditForm" action="<?= base_url(); ?>Welcome/notificationUpdate" role="form" enctype="multipart/form-data" autocomplete="off">
                                                <div class="form-group">  
                                                    <input type="hidden" name="id" value="<?= $row->id; ?>" class="form-control" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="categoryName">Notification Text</label>
                                                    <textarea name="notificationText"id="notificationText" cols="5" rows="10"  class="form-control" required=""> <?= $row->notificationText; ?></textarea>
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


    <!-- Edit Modal -->
    <div class="modal fade" id="myModal" role="dialog">
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
                                   value="" required=""><br>
                            <input type="text" class="form-control" name="typeNameEdit"
                                   id="typeNameEdit" value="" required=""><br>
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
    <!-- Status Modal -->
    <div class="modal fade" id="statusModal" role="dialog">
        <form>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Chagne Status</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p><b>Do you really want to Change Status of <h4></h4>
                                .</b></p>
                        <input type="text" name="typeId" id="typeId" class="form-control" placeholder="typeId" readonly>  
                        <input type="text" name="typeNameEdit" id="typeNameEdit" class="form-control" placeholder="typeName" readonly>   
                        <h3><small class="text-danger">All Product Related to this type will be
                                invisiable.</small></h3>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-Danger"
                           href="<?= base_url(); ?>Welcome/typeStatusUpdate/">YES</a>
                        &nbsp; <button type="button" class="btn btn-default"
                                       data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- End of Status Modal -->
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#notificationTable").dataTable({
            "pageLength": 8
        });
    });
</script>