<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add or Update Slider
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Add or Update Slider</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <!-- <div class="row">

                    <div class="col-sm-8">
                        <p style="color:red;"><strong>Note* :  </strong> Please give 1920 X 1280  pictures for perfect view in slider.</p>  
                    </div>
                    <div class="col-sm-4">

                    </div>
                    <hr>

                </div> -->
                <div id="myCarousel" class="carousel slide" data-ride="carousel" >
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" style="height: 350px;">
                        <div class="item active">
                            <?php if ($projectSliders['slider1'] != '') { ?>
                                <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider1']; ?>" alt="" height="100" width="100%" />
                                <?php
                            } else {
                                echo "Upload a slider1.";
                            } 
                            ?>
                        </div>

                        <div class="item">
                            <?php if ($projectSliders['slider2'] != '') { ?>
                                <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider2']; ?>" alt="" height="100" width="100%" />
                                <?php
                            } else {
                                echo "Upload a slider1.";
                            }
                            ?>
                        </div>
                        <div class="item">
                            <?php if ($projectSliders['slider3'] != '') { ?>
                                <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider3']; ?>" alt="" height="100" width="100%" />
                                <?php
                            } else {
                                echo "Upload a slider1.";
                            }
                            ?>
                        </div>
                        <div class="item">
                            <?php if ($projectSliders['slider4'] != '') { ?>
                                <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider4']; ?>" alt="" height="100" width="100%" />
                                <?php
                            } else {
                                echo "Upload a slider1.";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                       <span class="fa fa-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="fa fa-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="row"> 
        <div class="col-md-12">

            <!-- Horizontal Form -->
            <div class="panel panel-success">

                <div class="row text-center">
                    <div style="text-align:center;color:#ff0000;"><?php echo $this->session->flashdata('message'); ?></div>
                    <?php
                    $edit_project_slider = array('name' => "edit_project_slider", 'class' => "form-horizontal");
                    echo form_open_multipart('Carousal/update_slider', $edit_project_slider);
                    ?>
                    <div class="panel-body col-lg-12"> 
                        <div class="row">

                            <div class="col-md-3">


                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="">Slider1:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="slider1" name="slider1" ><br>
                                        <?php if ($projectSliders['slider1'] != '') { ?>
                                            <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider1']; ?>" alt="" height="100"  width="100%" />
                                            <?php
                                        } else {
                                            echo "Upload a slider1.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="">Slider2:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="slider2" name="slider2" ><br>
                                        <?php if ($projectSliders['slider2'] != '') { ?>
                                            <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider2']; ?>" alt="" height="100"  width="100%"  />
                                            <?php
                                        } else {
                                            echo "Upload a slider2.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="">Slider3:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="slider3" name="slider3" ><br>
                                        <?php if ($projectSliders['slider3'] != '') { ?>
                                            <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider3']; ?>" alt="" height="100"  width="100%" />
                                            <?php
                                        } else {
                                            echo "Upload a slider3.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="">Slider4:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="slider4" name="slider4" ><br>
                                        <?php if ($projectSliders['slider4'] != '') { ?>
                                            <img src="<?php echo base_url(); ?>uploads/admin/sliders/<?php echo $projectSliders['slider4']; ?>" alt="" height="100" width="100%" />
                                            <?php
                                        } else {
                                            echo "Upload a slider4.";
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="form-group"> 
                            <hr>
                           
                            <div class="col-sm-offset-0  col-sm-4 ">
                                <a href="<?php echo base_url(); ?>admin/view-slider" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-sm-offset-4 col-sm-4">
                                <?php echo form_submit('update', 'Update', 'class="btn btn-success btn-block" style=""'); ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
