<!-- all stock -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Stock Report
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Stock Report</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<?php if ($this->session->userdata('error_msg')) { ?>
						<div class="alert alert-danger alert-dismissible ">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong> <?= $this->session->flashdata('error_msg'); ?></strong>
						</div>
					<?php } ?>
				</div>
				<form method="post" action="<?= base_url() ?>get-stock-by-date">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<label for="from-date">From Date</label>
									<input id="from-date" class="form-control" type="date" name="fromDate" required="">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label for="to-date">To Date</label>
									<input id="to-date" class="form-control" type="date" name="toDate" required="">
								</div>
							</div>
							<div class="col-sm-3">

								<div class="form-group">
									<label> &nbsp;</label>
									<select name="stockType" class="form-control" required="">
										<option value="">Choose Stock Type</option>
										<option value="1">Stock In</option>
										<option value="2">Stock Out</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label> &nbsp;</label>
									<input type="submit" class="btn btn-warning btn-block" name="submit"
										   value="Generate Report">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-warning">
				<div class="box-body">
					<div class="table table-responsive">
						<table id="dataTablesIds" class="table table-bordered table-striped text-center">
							<thead>
							<tr class="text-capitalize bg-success">
								<th>product Code</th>
								<th>color</th>
								<th>size</th>
								<th>Quantity</th>
								<th>status</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$quantites = 0;
							foreach ($stockList as $row) : ?>
								<tr>
									<td><?= $row->productCode ?></td>
									<td><?= $row->color ?></td>
									<td><?= $row->size ?></td>
									<td><?= $quantity = $row->quantity ?></td>
									<td>
										<?php
										$status = $row->status;
										if ($status == 1) {
											echo '<button type="button" class="btn btn-success btn-xs" disabled>Stock In </button>';
										} else {
											echo '<button type="button" class="btn btn-danger btn-xs" disabled>Stock Out</button>';
										}
										?>
									</td>
								</tr>
								<?php $quantites += $quantity; endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$("#dataTablesIds").dataTable({
			"pageLength": 10,
			dom: 'Bfrtip',
			buttons: [
				'excel', 'pdf', 'print'
			]
		});
		new $.fn.dataTable.FixedHeader(table);
	});
</script>
