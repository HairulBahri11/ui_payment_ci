<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Add Voucher
			<small>add Voucher Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Voucher</a></li>
			<li class="active">Add Voucher</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<!-- <div class="box-header with-border">
              <h3 class="box-title">Add Price Form</h3>
            </div> -->
					<!-- /.box-header -->

					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>voucher/addVoucherDb" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="code" class="col-sm-3 control-label">Voucher Code</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="code" name="code">
								</div>
							</div>

							<div class="form-group">
								<label for="program" class="col-sm-3 control-label">Voucher Type</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="type" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Voucher Type --</option>
										<option value="MGM">(MGM) Member Get Member</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="level" class="col-sm-3 control-label">Voucher Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="amount" placeholder="Enter Voucher Amount" name="amount" required>
								</div>
							</div>
							<!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Submit</button>
								<a href="<?= base_url() ?>voucher"><button type="button" class="btn btn-default">Cancel</button></a>
							</div>
							<!-- /.box-footer -->
					</form>
				</div>
			</div>
			<!-- /.box-body -->



		</div>
		<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	$(document).ready(function() {
		$("#amount").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
	});
</script>