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
    <div class="row">
        <div class="col-sm-3">
            <!-- type form -->
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create New Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?php echo base_url(); ?>Welcome/categoryCreate" id="categoryForm" name="categoryForm" role="form" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="typeName">Choose Type Name</label>
                            <select name="typeId" id="typeId" class="form-control" required="">
                                <option value="">-- Select Type -- </option>
                                <?php foreach ($typeList as $row) : ?>
                                    <option value="<?= $row->id; ?>"><?= $row->typeName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" name="categoryName" placeholder="Category Name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="categoryTumbnail">Category Thumbnail</label>
                            <input type="file" name="categoryTumbnail" id="categoryTumbnail" class="form-control" accept="image/*" required="" onchange="loadImage(event)">
                            <img id="Imagepreview" src="<?= base_url(); ?>uploads/admin/category/noimage.png" width="100" height="100" alt="select Image for previewImg">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-sm-9">
            <!-- type table -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Categories List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataList" class="table table-bordered table-striped text-center">
                        <thead class="text-capitalize">
                            <tr class="bg-success">
                                <th>SNo.</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>thumbnail</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot class="text-capitalize">
                            <tr class="bg-success">
                                <th>SNo.</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>thumbnail</th>
                                <th>Added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1;
                            foreach ($categoryList as $row) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row->typeName; ?></td>
                                    <td><?= $row->categoryName; ?></td>
                                    <td class="img img-thumbnail text-center"><a href="<?= base_url() . 'uploads/admin/category/' . $row->categoryThumbnail; ?>" target="_blank"><img src="<?= base_url() . 'uploads/admin/category/' . $row->categoryThumbnail; ?>" width="50" height="30" alt="No Image"></a></td>
                                    <td><?php $added_at_datetime = new DateTime($row->added_at);
                                        echo $added_at_date = $added_at_datetime->format('d-m-Y'); ?></td>
                                    <td><?php $status = $row->catStatus;
                                        if ($status == 1) {
                                            echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';
                                        } else {
                                            echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';
                                        } ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#myModal<?= $row->id ?>" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit" data-placement="top"><i class="fa fa-pencil-square-o "></i></a>
                                        <?php if ($status == 1) { ?>
                                            <!-- <a href="#" data-toggle="modal" data-target="#statusModal<?= $row->id ?>"
                                        type="button" class="btn btn-danger" data-toggle="tooltip" title="Inactive"
                                        data-placement="top"><i class="fa fa-ban"></i></a>-->
                                            <a href="<?= base_url(); ?>Welcome/categoryStatusUpdate/<?= $row->id ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
                                        <?php } else { ?>
                                            <!-- <a href="#"  data-toggle="modal" data-target="#statusModal<?= $row->id ?>"
                                        type="button" class="btn btn-success" data-toggle="tooltip" title="Active"
                                        data-placement="top"><i class="fa fa-ban"></i></a> -->

                                            <a href="<?= base_url(); ?>Welcome/categoryStatusUpdate/<?= $row->id ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success btn-xs" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
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
                                                <form method="post" name="EditForm" id="EditForm" action="<?= base_url(); ?>Welcome/categoryUpdate" role="form" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                      <select name="typeId" id="typeId" class="form-control" required="">
<!--                                                            <option value="--><?//= $row->typeId; ?><!--">--><?//= $row->typeName; ?><!--</option>-->
                                                            <?php foreach ($typeList as $rows) : ?>
                                                                <option value="<?= $rows->id; ?>" <?php  if($rows->typeName == $row->typeName) echo "selected" ; ?>><?= $row->typeName; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="categoryId" value="<?= $row->id; ?>" class="form-control" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="categoryName">Category Name</label>
                                                        <input type="text" name="categoryName" value="<?= $row->categoryName; ?>" placeholder="Category Name" class="form-control" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="categoryTumbnail">Category Thumbnail</label>
                                                        <!-- <input type="hidden" name="categoryTumbnailAlt" id="categoryTumbnailAlt" value="<?= $row->categoryThumbnail; ?>" class="form-control" accept="image/*"> -->
                                                        <input type="file" name="categoryThumbnail" id="categoryThumbnail" class="form-control" accept="image/*" onchange="loadFile(event)">
                                                        <img id="previewImgFile" src="<?php if($row->categoryThumbnail !="") { echo base_url() . 'uploads/admin/category/' . $row->categoryThumbnail; } else { echo base_url() . 'uploads/admin/category/noimage.png';  } ?>" width="100" height="60" alt="No Image">
                                                    </div>
                                                    <!--                           <div class="form-group">
                                                    <label for="categoryName">Status</label>
                                                    <input type="text" name="status" value="<?= $status; ?>" placeholder="Category Name" class="form-control" required="">
                                                    <h5><small>Chanage status in 0 or 1 form to active or deactivate the category(1 for Enable 0 for disable)</small></h5>
                                                </div> -->
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
                                <!-- Status Modal -->
                                <!--                            <div class="modal fade" id="statusModal<?= $row->id; ?>" role="dialog">
                                  <div class="modal-dialog">

                                       Modal content
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Chagne Status</h4>
                                          </div>
                                          <div class="modal-body text-center">
                                              <p><b>Do you really want to Change Status of <h4><?= $row->typeName; ?></h4>
                                                      .</b></p>
                                              <h3><small class="text-danger">All Product Related to this type will be
                                                      invisiable.</small></h3>
                                          </div>
                                          <div class="modal-footer">
                                              <a type="button" class="btn btn-Danger"
                                                  href="<?= base_url(); ?>Welcome/categoryStatusUpdate/<?= $row->id ?>">YES</a>
                                              &nbsp; <button type="button" class="btn btn-default"
                                                  data-dismiss="modal">Close</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>-->
                                <!-- End of Status Modal -->
                            <?php $i++;
                            endforeach; ?>
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
    });
    var loadFile = function(event) {
        var output1 = document.getElementById('previewImgFile');
        output1.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadImage = function(event) {
        var output = document.getElementById('Imagepreview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>