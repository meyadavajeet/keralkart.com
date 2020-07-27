<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;
    margin-top: 20px;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
</style>
<div class="container">
    <div class="row">
        <div class=" col-sm-offset-3 col-sm-6 ">
            <!-- <div class="row">
                <div class="col-sm-12">
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
            </div> -->
            <div class="card">
                <div class="panel panel-success">
                    <div class="panel-heading text-center text-uppercase">User Sign Up</div>
                    <form method="post" action="<?= base_url() ?>Users/userCreate" name="signupForm" id="signupForm">
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="customerName" id="customerName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" pattern="d\*" min="0" maxlength="10" minlenght="10" name="mobile" id="mobile" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success btn-search" name="submit" value="Sign Up">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="<?=base_url()?>userLogin">
                        <div class="card">
                            <div class="panel">
                                <div class="panel-body text-primary">
                                    Already Registered Login Here..?
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <br>
        <br>
    </div>
</div>

<script>
$("#signupForm").validate({
    rules: {
        customerName: {
            required: true
        },
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,

        },
        email: {
            required: true,
        },
        password: {
            required: true
        }

    },

    messages: {
    }
});
</script>