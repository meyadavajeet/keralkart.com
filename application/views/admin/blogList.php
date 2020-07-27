<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Blog</li>
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
        <div class="col-md-12">
            <div class="box panel panel-warning">
                <div class="box-header panel-heading">
                    <h3 class="box-title">Blog List</h3>
                    <div class="pull-right">
                        <a href="<?=base_url()?>blog" class="btn btn-warning">Create New Blog</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body panel-body table-responsive">
                    <table id="dataTablesIds" class="table table-bordered table-striped">
                        <thead>
                            <tr class="bg-success">
                                <th>Id</th>
                                <th>Blog Heading</th>
                                <th>Blog Content</th>
                                <th>Blog Image</th>
                                <th>Publisher</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-success">
                                <th>Id</th>
                                <th>Blog Heading</th>
                                <th>Blog Content</th>
                                <th>Blog Image</th>
                                <th>Publisher</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            $i = 0;
                            foreach ($blogList  as $row) :
                                ?>
                            <tr>
                                <td><?= $row->blogId ?></td>
                                <td><?= $row->blogHeading; ?></td>
                                <td><?= substr(htmlspecialchars_decode($row->blogContent), 0, 200); ?></td>
                                <td><a href="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>">
                                        <img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>" style="width:100px; height:100px;">
                                    </a>
                                </td>
                                <td><?= $row->createdBy?></td>
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
                                    <a href="#" data-toggle="modal" data-target="#myModal<?= $row->blogId; ?>"
                                        type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit"
                                        data-placement="top"><i class="fa fa-pencil-square-o"></i></a>

                                    <a href="#" data-toggle="modal" data-target="#myModals<?= $row->blogId; ?>"
                                        type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="View"
                                        data-placement="top"><i class="fa fa-eye"></i></a>

                                    <?php if ($status == 1) { ?>
                                    <a href="<?= base_url(); ?>blog-change-status/<?= $row->blogId; ?>"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button"
                                        class="btn btn-danger btn-sm " data-toggle="tooltip" title="Inactive"
                                        data-placement="top"><i class="fa fa-ban"></i></a>

                                    <?php
                                        } else {
                                            ?>

                                    <a href="<?= base_url(); ?>blog-delete/<?= $row->blogId; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Delete?'));"
                                        class="btn btn-warning btn-sm" data-toggle="tooltip" title="Delete"
                                        data-placement="top"><i class="fa fa-trash"></i></a>

                                    <a href="<?= base_url(); ?>blog-change-status/<?= $row->blogId; ?>" type="button"
                                        onclick="return(confirm('Are You Sure want to Chanage Status?'));"
                                        class="btn btn-success btn-sm" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-ban"></i></a>

                                    <?php } ?>
                                </td>

                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="myModal<?= $row->blogId; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit and Update Blog</h4>
                                        </div>
                                        <form method="post" action="<?= base_url() ?>update-blog" autocomplete="off"
                                            name="form1" id="form1" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">
                                                            <label>Blog Heading</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="hidden"  name="blogId" class="form-control" value="<?=$row->blogId;?>" readonly="ture">
                                                            <input type="text" name="blogHeading" class="form-control"
                                                                placeholder="blog heading"
                                                                value="<?=$row->blogHeading?>" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">
                                                            <label>Blog Image </label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="blog_image" class="form-control" id="blog_image" accept="image/*">
                                                            <span><img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>" style="width:100px; height:100px"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">
                                                            <label>Blog Content </label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <textarea name="blogContent" id="blogContent2<?=$row->blogId?>" class="form-control" required><?=$row->blogContent?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">

                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="submit" class="btn btn-warning btn-block"
                                                                name="update" value=" Update Blog ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- Edit modal End -->

                             <!-- View Modal -->
                             <div class="modal fade" id="myModals<?= $row->blogId; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">View Blog</h4>
                                        </div>
                                        <form method="post" action="<?= base_url() ?>update-blog" autocomplete="off"
                                            name="form1" id="form1">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">
                                                            <label>Blog Heading</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                        <?=$row->blogHeading;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">
                                                            <label>Blog Image </label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <!-- <input type="file" name="blogImage" class="form-control"
                                                                accept="image/*"> -->
                                                            <span><img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>" style="width:100px; height:100px;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="col-sm-2">
                                                            <label>Blog Content </label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <?=htmlspecialchars_decode($row->blogContent);?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    CKEDITOR.replace('blogContent2<?=$row->blogId?>');
                                });
                            </script>
                            <!-- View modal End -->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    $("#dataTablesIds").dataTable({
        "pageLength": 10
    });
});
</script>