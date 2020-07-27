<!-- customer_dashboard -->

		
		<div class="row">
			<div class="col-lg-3 accordion">
				<div class="accordion-section" style="border-bottom:1px solid white;border-top:1px solid white;">
					<a class="accordion-section-title" style="width:100%;background:#6bc76b;color:white;" href="#accordion-1">Accounts</a>
					<div id="accordion-1" class="accordion-section-content" style="width:100%;background:#98ef98;">
						<div class="left-submenu" style="width:100%;height:4%;border-bottom:1px solid white;border-top:1px solid white;padding-left:25px;"><a id="editProfileButtonId" href="#" style="color:green;">Edit Profile</a></div>
						<div class="left-submenu" style="width:100%;height:4%;padding-left:25px;"><a id="changeAddress" href="#" style="color:green;">Add/Change Default Address</a></div>
						<div class="left-submenu" style="width:100%;height:4%;border:1px solid white;padding-left:25px;"><a  id="changePasswordButtonId" href="#" style="color:green;">Change Password</a></div>
					</div>
				</div>
				<div class="accordion-section" style="border-bottom:1px solid white;">
					<a class="accordion-section-title" style="width:100%;background:#6bc76b;color:white;" id="myOrdersButtonId" href="#accordion-2">My Orders</a>
				</div>
				<div class="accordion-section" style="border-bottom:1px solid white;">
					<a class="accordion-section-title" style="width:100%;background:#6bc76b;color:white;" href="#accordion-3">Track Orders</a>
				</div>
				<div class="accordion-section" style="border-bottom:1px solid white;" data-toggle="modal" data-target="#myModal"><a class="accordion-section-title" style="width:100%;background:#6bc76b;color:white;" href="#accordion-4">Logout</a></div>
			</div>
			
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Do you want to Log out</h4>
						</div>
						<div class="modal-body">
							<button class="btn btn-success">Yes</button>
							<button class="btn btn-danger" class="close" data-dismiss="modal">No</button>
						</div>
					</div>
				</div>
			</div>
						
			<div class="col-lg-8 main">
				<div id="breadcrumbContainer"></div>
				<div style="padding:16px;"></div>
				<div id="dashboard-form">
					<form id="editProfileId" action="">
					    <div class="form-row userInformation">
							<div class="form-group input-group col-md-5 col-lg-6">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="name" class="form-control" id="inputEmail4" placeholder="Name">
							</div>
							<div class="form-group input-group col-md-5 col-lg-6">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							  <input type="mobile" class="form-control" id="inputPassword4" placeholder="Mobile No">
							</div>
							<div class="form-group input-group col-md-5 col-lg-6">
								<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
								<input type="country" class="form-control" id="inputEmail4" placeholder="Country">
							</div>
							<div class="form-group input-group col-md-5 col-lg-6">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							  <input type="state" class="form-control" id="inputPassword4" placeholder="State">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								
							</div>
						</div>
						
						<div id="addressDiv1">
							<div class="form-row separator">
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									<input class="form-check-input" type="checkbox"> Set as default
								</div>
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									<a href="#"><i class="glyphicon glyphicon-edit"></i>  Edit</a>
								</div>
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
									<a href="#" id="addAddressButton1"><i class="glyphicon glyphicon-plus"></i>  Add</a>
								</div>
							</div>
							<div class="form-row"><div class="form-group col-md-9"></div></div>
							<div class="form-row separator">
								<textarea class="form-control" placeholder="Address"></textarea>
							</div>
						</div>
						
						<div id="addressDiv2">
							
						</div>
						
						<div id="addressDiv3">
							
						</div>
						
						
						
						<div class="form-group separator">   
							<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-ok"></i> Save</button>
						</div>
					</form>
					 
					<form class="form-horizontal col-lg-12" id="changePasswordId" action="">
						<div class="form-group input-group col-md-5 col-lg-6">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="oldPassword" class="form-control" id="oldPassword" placeholder="Enter Old Password">
						</div>
						<div class="form-group input-group col-md-5 col-lg-6">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="newpassword" class="form-control" id="newpassword" placeholder="Enter New Password">
						</div>
						<div class="form-group separator">   
							<button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-ok"></i> Save</button>
						</div>
					</form>
				</div>
				
				<div id="myorders">
					<table class="table table-bordered">
						<tbody>
							<tr class="myorders-table-header">
								<td>
									<div class="row">
										<div class="col-xs-2 col-lg-2"><button class="myorders_number">77458737935</button></div>
										<div class="col-xs-7 col-lg-7"></div>
										<div class="col-xs-2 col-lg-2"><button class="myorders_track" data-toggle="modal" data-target="#trackOrderModal"><span class="glyphicon glyphicon-map-marker"></span> Track</button></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row">
										<div class="col-xs-2 col-lg-2"><img src="image/1final_indexpage__62.jpg" class="imgDiv"></div>
										<div class="col-xs-4 col-lg-4"><p>Zenith PC</p> <p class="seller">Deepak Kumar</p> <p class="seller">Seller: RS Electronics</p></div>
										<div class="col-xs-2 col-lg-2">Rs.42000</div>
										<div class="col-xs-4 col-lg-4">Delivered on Fri, Dec 26th '17 <p class="seller">Your item has been delivered</p></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row">
										<div class="col-xs-2 col-lg-2"><img src="image/1final_indexpage__16.jpg" class="imgDiv"></div>
										<div class="col-xs-4 col-lg-4"><p>Indian Polity</p>  <p class="seller">Anuradha Kumari</p> <p class="seller">Seller: RS Electronics</p></div>
										<div class="col-xs-2 col-lg-2">Rs.15000</div>
										<div class="col-xs-4 col-lg-4">Delivered on Fri, Dec 26th '17 <p class="seller">Your item has been delivered</p></div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered">
						<tbody>
							<tr class="myorders-table-header">
								<td>
									<div class="row">
										<div class="col-xs-2 col-lg-2"><button class="myorders_number">77458737935</button></div>
										<div class="col-xs-7 col-lg-7"></div>
										<div class="col-xs-2 col-lg-2"><button class="myorders_track" data-toggle="modal" data-target="#trackOrderModal"><span class="glyphicon glyphicon-map-marker"></span> Track</button></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row">
										<div class="col-xs-2 col-lg-2"><img src="image/1final_indexpage__107.jpg" class="imgDiv"></div>
										<div class="col-xs-4 col-lg-4">Life is what you make it <p class="seller">Deepak Kumar</p> <p class="seller">Seller: WS Retail</p></div>
										<div class="col-xs-2 col-lg-2">Rs.200</div>
										<div class="col-xs-4 col-lg-4">Delivered on Fri, Dec 26th '17 <p class="seller">Your item has been delivered</p></div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- Modal -->
	  <div class="modal fade" id="trackOrderModal" role="dialog">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header ordertracking-header">
				<div class="row">
					<div class="col-xs-4 col-lg-4"></div>
					<div class="col-xs-4 col-lg-4">Order Tracking: 77458737935</div>
					<div class="col-xs-4 col-lg-4"></div>
				</div>
				<div class="row ordertracking">
					<div class="col-xs-4 col-lg-4"><div class="ordertracking-label">Shipped Via</div><div class="ordertracking-value">RS Tours</div></div>
					<div class="col-xs-4 col-lg-4"><div class="ordertracking-label">Status</div><div class="ordertracking-value">Checking Quality</div></div>
					<div class="col-xs-4 col-lg-4"><div class="ordertracking-label">Expected Date</div><div class="ordertracking-value">4-DEC-2017</div></div>
				</div>
			</div>
			<div class="modal-body">
				
				<ol class="progtrckr" data-progtrckr-steps="5">
					<li class="progtrckr-done">Confirmed Ordered</li>
					<li class="progtrckr-done">Processing Order</li>
					<li class="progtrckr-done">Quality Check</li>
					<li class="progtrckr-todo">Dispatched Item</li>
					<li class="progtrckr-todo">Product Delivered</li>
				</ol>
				
				
			</div>
			<!-- <div style="margin:12px;height:20px;width28px;"><i onclick="myFunction(this)" class="fa fa-thumbs-up"></i></div> -->

			<script>
			function myFunction(x) {
				x.classList.toggle("fa-thumbs-down");
			}
			</script>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
			</div>
		  </div>
		</div>
	</div>