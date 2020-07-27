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
            <div class="card">
                <div class="panel panel-success">
                    <div class="panel-heading text-center text-uppercase">user Forget Password</div>
                    <form method="post" action="<?=base_url()?>check-user-email" name="loginForm" id="loginForm">
                        <div class="panel-body">
                            <b style="color: red"><?= $this->session->flashdata('wrong_pass'); ?></b>
                            <div class="form-group">
                                <label>Mobile Number(Registered)</label>
                                <input type="text" name="emailMobile" id="password" class="form-control">
                            </div>
                          
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success btn-search" name="submit" value="Verify">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?=base_url()?>userRegister">
                        <div class="card">
                            <div class="panel">
                                <div class="panel-body text-primary">
                                    New to Keral Kart Register Here..?
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="<?=base_url()?>userLogin">
                        <div class="card">
                            <div class="panel">
                                <div class="panel-body text-primary">
                                Back To Login
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
