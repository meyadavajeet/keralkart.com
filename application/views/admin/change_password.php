<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Change Password
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Change Password</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Change Password
                </div>
                <div class="panel-body">
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
                    <form method="post" action="<?= base_url() ?>Welcome/change_password_process" autocomplete="off" name="form1" id="form1">
                        <label>Old Password :</label>
                        <input type="password" name="old_pass" id="name" placeholder="Old Pass" class="form-control" required=""/><br />
                        <label>New Password :</label>
                        <input type="password" name="new_pass" id="password" placeholder="New Password" class="form-control" required=""/><br/>
                        <label>Confirm Password :</label>
                        <input type="password" name="confirm_pass" id="password" class="form-control" placeholder="Confirm Password" required=""/><br/>
                        <input type="submit" value="Change Password" class="btn btn-dropbox btn-danger" name="change_pass"/><br />
                    </form> 
                </div>
            </div>
        </div>
    </div>
</section>