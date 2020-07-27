<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blog
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Publish Blog</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning panel panel-success">
                <div class="box-heading panel-heading">
                    Publish Blog
					<div class="pull-right">
						<a href="<?=base_url()?>blog-list" class="btn btn-warning btn-sm"> <i class="fa fa-eye" > </i> View all blog </a>
					</div>
                </div>
                <div class="box-body panel-body">
                    <?php if ($this->session->userdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissible ">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong> <?= $this->session->flashdata('msg'); ?></strong>
                        <?php
                            $this->session->unset_userdata('msg'); 
                            ?>
                    </div>
                    <?php } ?>

                    <?php if ($this->session->userdata('error_msg')) { ?>
                    <div class="alert alert-danger alert-dismissible ">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong> <?= $this->session->flashdata('error_msg'); ?></strong>
                    </div>
                    <?php } ?>

                    <div class="row">
                        <form method="post" action="<?= base_url() ?>create-blog" autocomplete="off" name="form1"
                            id="form1" enctype="multipart/form-data">
                            <div class="form-group">
								<div class="row">
									<div class="col-sm-10 col-sm-offset-1">
										<div class="col-sm-2">	
										<label>Blog Heading</label>	
										</div>
										<div class="col-sm-10">
											<input type="text" name="blogHeading" class="form-control"
												placeholder="blog heading" required="">
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
											<input type="file" name="blogImage" class="form-control" accept="image/*">
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
											<textarea name="blogContent" id="blogContent" class="form-control" required></textarea>
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
											<input type="submit" class="btn btn-success btn-block" name="submit" value="Publish Blog">
										</div>
									</div>
								</div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function(){
    CKEDITOR.replace('blogContent');
});
</script>
