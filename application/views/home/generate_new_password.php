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
                    <div class="panel-heading text-center text-uppercase">New Password </div>
                    <form method="post" action="<?=base_url()?>Update-password" name="passwordForm" id="passwordForm">
                        <div class="panel-body">
                            <b style="color: red"><?= $this->session->flashdata('wrong_pass'); ?></b>
                            
                            <div class="form-group">
                                <label>New  Password </label>
                             <input type="text" name="newpassword" id="Password" class="form-control newpassword">
                            </div>
                             <div class="form-group">
                                <label>Confirm Password <span class="match text-success"></span> <span class="Nmatch text-danger"></span></label>
                             <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success btn-search" id="btndisable" name="submit" value="Save">
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
<script type="text/javascript">
    $("#confirmpassword").change(function (e) {
       var n= $('.newpassword').val();
       var c= $('#confirmpassword').val();
       //alert(n+c);
       if(n==c){
         $(".match").html("!Match");    
       }
       else{
            $(".Nmatch").html('!Not Match');
            $("#btndisable").attr("disabled", true);
       }
    });
</script>
