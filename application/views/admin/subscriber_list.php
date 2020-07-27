<section class="content-header">
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=base_url()?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Subscriber</li>
	</ol>
</section>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<?php if ($this->session->userdata('success_msg')) { ?>
			<div class="alert alert-info alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
				<strong>
					<center> <?= $this->session->flashdata('success_msg'); ?> </center>
				</strong>

			</div>

		<?php } ?>
		<?php if ($this->session->userdata('error_msg')) { ?>
			<div class="alert alert-danger alert-dismissible ">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
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
		<div class="col-sm-12">
			<!-- type table -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Subscribers List</h3>
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<table id="dataTablesId" class="table table-bordered table-striped">
						<thead class="text-uppercase">
						<tr class="bg-primary">
							<th>SNo.</th>
							<th>email</th>
							<th>added_at</th>
							<th>status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>SNo.</th>
							<th>email</th>
							<th>added_at</th>
							<th>status</th>
							<th>Action</th>
						</tr>
						</tfoot>
						<tbody>
						<?php
						$i=0;
						foreach ($subscriber_list as  $row) :?>
							<tr>
								<td><?=++$i;?></td>
								<td><?=$row->email;?></td>
								<td><?=$row->added_at;?></td>
								<td>
									<?php $status =$row->status; if($status==1){echo '<button type="button" class="btn btn-success btn-xs" disabled>Active</button>';}else{echo '<button type="button" class="btn btn-danger btn-xs" disabled>InActive</button>';}?>
								</td>
								<td>
									<?php if($status==1){?>
										<a href="<?= base_url(); ?>Welcome/subscriberStatusUpdate/<?= $row->id; ?>" onclick="return(confirm('Are You Sure want to Chanage Status?'));" type="button" class="btn btn-danger" data-toggle="tooltip" title="Inactive" data-placement="top"><i class="fa fa-ban"></i></a>
									<?php } else { ?>
										<a href="<?= base_url(); ?>Welcome/subscriberStatusUpdate/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Chanage Status?'));" class="btn btn-success" data-toggle="tooltip" title="Active" data-placement="top"><i class="fa fa-ban"></i></a>
										<a href="<?= base_url(); ?>Welcome/subscriberDelete/<?= $row->id; ?>" type="button" onclick="return(confirm('Are You Sure want to Delete?'));" class="btn btn-warning" data-toggle="tooltip" title="Delete" data-placement="top"><i class="fa fa-trash"></i></a>
									<?php } ?>
								</td>

							</tr>
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
		$("#dataTablesId").dataTable();
	});
</script>
