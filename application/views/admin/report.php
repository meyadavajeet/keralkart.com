<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Income Report
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Report</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row"> 
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <?php if ($this->session->userdata('error_msg')) { ?>
                        <div class="alert alert-danger alert-dismissible ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong> <?= $this->session->flashdata('error_msg'); ?></strong>  
                        </div>
                    <?php } ?>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="expenditureForm" name="expenditureForm" method="post" action="<?=base_url()?>Welcome/get_report" onsubmit="subdata()">                
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12 ">
                                        <label>Account Name</label>
                                        <select name="account_name" id="account_name" class="form-control" required="" >
                                            <option value="">Select Account Name</option>
                                            <?php foreach ($bank_name as $row) { ?>
                                                <option value="<?= $row->bank_name; ?>"><?= $row->bank_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>From Date</label>
                                        <input type="date" class="form-control" name="from_date" id="from_date" required="" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>To Date</label>
                                        <input type="date" class="form-control" name="to_date" id="to_date" required="" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label>Generate Report</label>
                                <input type="submit" class="btn btn-block btn-info" name="submit" id="submit" value="Get Report">
                            </div>
                        </div>

                    </div>
                    <!-- /.box-footer -->
                </form>

                <!-- /.box -->
            </div>
        </div>
    </div>
</section>

