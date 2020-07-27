<div style="background-color:green;height:2px;width:96%;margin-left:26px;"></div>
<div class="container-fluid" >
	<div class="row" id="row10">
		<div class="footer-widget">
			<div class="container-fluid">
				<div class="row">

                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-1">
                       
                    </div>

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
						<div class="single-widget">
							<h2>Information</h2>
							<ul class="footer nav-pills nav-stacked">
                                <li><a href="<?=base_url()?>About">About</a></li>
                                <li><a href="<?=base_url()?>contact-us">Contact</a></li>
                                <li><a href="<?=base_url()?>contact-us">Faq</a></li>
								<li><a href="tel:+918080306224">80803 06224</a></li>
								<li><a href="mailto:keralkart@gmail.com">keralkart@gmail.com</a></li>
								
							</ul>
                            <hr>
                            <h2>User</h2>
                               <ul class="footer nav-pills nav-stacked">
                                <li><a href="<?=base_url()?>userLogin">Login</a></li>
                                <li><a href="<?=base_url()?>userRegister">Register</a></li>
                              
                            </ul>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
						<div class="single-widget">
							<h2>Policies</h2>
                            <h5>General</h5>
							<ul class="footer nav-pills nav-stacked">
                                <br>
                                <li><a href="<?=base_url()?>security-policy">Security</a></li>
						       <li><a href="<?=base_url()?>Privacy-Policy">Privacy Policy</a></li>
                                <li><a href="<?=base_url()?>Shipping-Policy">Shipping Policy</a></li>
                                
                                <li><a href="<?=base_url()?>Cancellation-and-Return">Cancellation &amp; Returns</a></li>
                    </ul>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
						<div class="single-widget">
							<h2>Where To Find Us </h2>
							 <p><strong>Sector 19.</strong><br>Ulwe<br>Navi Mumbai<br>Maharashtra<br><strong>India</strong></p><a href="<?=base_url()?>contact-us"style="color:#4fbfa8">Go to contact page</a>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
						<div class="single-widget">
							<h2>Be In Touch</h2>
							<!--							<div class="input-group" style="margin-top:20px;">-->
							<!--								<input type="text" class="form-control" placeholder="Search All Categories"-->
							<!--									   style="border-radius:4px;width:100%;">-->
							<!--								<span class="input-group-btn">-->
							<!--								<button class="btn btn-search" type="button"><i class="fa fa-search fa-fw"></i> Subscribe</button>-->
							<!--							</span>-->
							<!--							</div>-->
							<div class="row">
								<div class="col-sm-12 col-sx-12">
									<div class="row">
										<form method="post" name="subscribe_form" id="subscribe_form">
											<div class="col-sm-8 col-xs-8">
												<input type="email" name="subscribe_email" id="subscribe_email"
													   class="form-control"
													   placeholder="example@gmail.com" required>
											</div>
											<div class="col-sm-4 col-xs-4">
												<button type="submit" class=" btn-info" id="subscribe_btn"
														name="submit"
														style="height: 35px; margin-left: -30px;">
													<i class="fa fa-envelope"></i> Subscribe
												</button>
											</div>
											<div class="row">
												<span style="margin-left: 30px;" id="email_result"></span>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
							<div style="color: black;font-family:'Roboto',sans-serif;font-size:16px;font-weight:600;margin:36px 2px;">&nbsp;&nbsp;&nbsp;Stay in touch</div>

							<ul class="footer nav-pills nav-stacked">
								<li>
									<a href="#">
										<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
											<a href="#" class="fa fa-facebook"></a>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
											<a href="#" class="fa fa-twitter"></a>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
											<a href="#" class="fa fa-linkedin"></a>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
											<a href="#" class="fa fa-skype"></a>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	
	<div class="row" style="background:#122112;padding:20px;margin-top:-66px;">
		<div class="col-xs-7 col-sm-4 col-md-4 col-lg-4">
			<span style="color:#ffffff;">Copyright
			               	&copy;<?php echo  date('Y') ?> Keral Kart All Rights Reserved.</span>
		</div>
		<div class="col-xs-8 col-sm-4 col-md-4 col-lg-5"></div>
		<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
			<img src="<?= base_url() ?>assets/home/image/payment.png" class="img img-responsive">
		</div>
	</div>
</div>
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
<script type="text/javascript">
	var data="";
	$(document).ready(function () {
		$('#subscribe_email').on('input', function () {
			$("#subscribe_btn").prop('disabled', false);
			var subscribe_email = $('#subscribe_email').val();
			if (subscribe_email !== '') {
				$.ajax({
					url: "<?php echo base_url(); ?>SubscribeEmail/check_email_avaibility",
					method: "POST",
					data: {subscribe_email: subscribe_email},
					success: function (data) {
						$('#email_result').html(data);
					}
				});
			}
			if (subscribe_email == '') {
				$('#email_result').html(data);
				$("#subscribe_btn").prop('disabled', true);
			}
		});


		$("#subscribe_form").validate({
			rules:
				{
					email: {
						required: true
					}
				},
			// Specify validation error messages
			messages: {},

			submitHandler: function (form) {
				$.ajax({
					url: "<?php echo base_url() ?>SubscribeEmail/subscribe_email",
					method: "POST",
					data: $(form).serialize(),
					success: function (data) {
						// console.log(data);
						// alert(data);
						alert("Thank you for subscribing.");
						$("#subscribe_btn").prop('disabled', true);
						$("#subscribe_form")[0].reset();
// $("#amountvalue").replaceWith(data);
					},
					error: function (data) {
						alert('error' + data);
					}
				});

			}
		});
	});
</script>
</body>
</html>

