<!-- Content Header (Page header) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url()?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Type</li>
    </ol>
</section>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <?php if ($this->session->userdata('success_msg')) { ?>
        <div class="alert alert-info alert-dismissible">
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
<div class="col-sm-2"></div>


<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-4">
            <!-- type form -->
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create New SubCategory</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post"  action="<?php echo base_url() ?>Welcome/subCategoryCreate" id="typeForm" name="typeForm"
                    role="form"  >
                    <div class="box-body">
                   <div class="form-group">
                            <label for="categoryName">Choose Category Name</label>
                            <select name="categoryId" id="categoryId" class="select2 select2-hidden-accessible" required="" style="width: 100%;" >
                                <option value="" selected="selected">-- Select Category -- </option>

                                <?php foreach ($categoryListData as $row): ?>
                                    <option value="<?=$row->id;?>"><?=$row->categoryName;?> (<?=$row->typeName;?>)</option>
                                 <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subCategoryName"> Sub-Category</label>
                            <input type="text" name="subCategoryName" id="subCategoryName" class="
                            form-control" placeholder="Sub-Category Name" required="">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-outline-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div class="col-sm-8">
            <!-- type table -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sub-Category List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTablesId" class="table table-bordered table-striped">
                        <thead class="text-uppercase">
                            <tr>
                                <th>SNo.</th>
                                <th>Sub-Category</th>
                                <th>category</th>
                                <th>added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SNo.</th>
                                <th>Sub-Category</th>
                                <th>category</th>
                                <th>added_at</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $i=0; foreach ($subCategoryList as  $row) :?>
                            <tr>
                                <td><?=++$i;?></td>
                                <td><?=$row->subCategoryName;?></td>
                                <td><?=$row->categoryName;?></td>
                                <td><?=$row->added_at;?></td>
                                <td>
                                    <?php $status =$row->status; if($status==1){echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';}else{echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';}?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#myModal<?= $row->subCatId; ?>" type="button"
                                        class="btn btn-primary" data-toggle="tooltip" title="Edit"
                                        data-placement="top"><i class="fa fa-pencil-square-o"></i></a>
                                    <?php if($status==1){?>
                                    <a href="<?= base_url(); ?>Welcome/subCategoryStatusUpdate/<?= $row->subCatId; ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button" class="btn btn-danger" data-toggle="tooltip" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
                                    <?php } else { ?>
                                    <a href="<?= base_url(); ?>Welcome/subCategoryStatusUpdate/<?= $row->subCatId; ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
                                    <?php } ?>
                                </td>

                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="myModal<?= $row->subCatId; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update Type</h4>
                                        </div>
                                        <form method="post" name="typeEditForm" action="<?php echo base_url() ?>Welcome/subCategoryUpdate" role="form">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="categoryId">Choose Type Name</label>
                                                    <select name="categoryId" id="categoryId" class="form-control select2 select2-hidden-accessible " required=""style="width:100%">
                                                        <!-- <option value="<?=$row->categoryId;?>"><?=$row->categoryName;?></option> -->
                                                         <?php foreach ($categoryListData as $rows): ?> 
                                                            <option value="<?=$rows->id;?>" <?php if($rows->id == $row->categoryId) echo "selected"; ?>> <?php echo $rows->categoryName;?></option>
                                                         <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id">Sub-Category Name</label>
                                                    <input type="hidden" class="form-control" name="id" id="id"
                                                        value="<?=$row->subCatId;?>" required=""><br>
                                                        
                                                    <input type="text" class="form-control" name="subCategoryName"
                                                        id="subCategoryName" value="<?=$row->subCategoryName;?>" required=""><br>
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
  $(document).ready(function() {
   
});

      
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#dataTablesId").dataTable();

    // select2 script
     $('.select2').select2({
         closeOnSelect: false
    });
});
</script>
