<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Edit Price
			<small>edit selected Price</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Price</a></li>
			<li class="active">Edit Price</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">

					<!-- form start -->
					<?php
					foreach ($price->result() as $price) {
						$priceid = $price->id;
					?>
						<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>price/updatePriceDb" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="program" class="col-sm-3 control-label">Program</label>
									<div class="col-sm-9">
										<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $price->id; ?>">
										<input type="text" class="form-control" id="program" placeholder="Enter Program" name="program" value="<?php echo $price->program; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="level" class="col-sm-3 control-label">Level</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="level" placeholder="Enter Level" name="level" value="<?php echo $price->level; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="pointbook" class="col-sm-3 control-label">Point Book</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="pointbook" placeholder="Enter Point Book Price" name="pointbook" value="Rp <?php echo number_format($price->pointbook, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label">Registration</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="registration" placeholder="Enter Registration Fee" name="registration" value="Rp <?php echo number_format($price->registration, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="book" class="col-sm-3 control-label">Book</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="book" placeholder="Enter Book Price" name="book" value="Rp <?php echo number_format($price->book, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="agenda" class="col-sm-3 control-label">Agenda</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="agenda" placeholder="Enter Agenda Price" name="agenda" value="Rp <?php echo number_format($price->agenda, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="course" class="col-sm-3 control-label">Course</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="course" placeholder="Enter Course Price" name="course" value="Rp <?php echo number_format($price->course, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="priceperday" class="col-sm-3 control-label">Price/Day</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="priceperday" placeholder="Enter Price/Day" name="priceperday" value="Rp <?php echo number_format($price->priceperday, 0, ".", "."); ?>" required>
									</div>
								</div>

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Submit</button>
								<a href="<?= base_url() ?>price"><button type="button" class="btn btn-default">Cancel</button></a>
							</div>
							<!-- /.box-footer -->
						</form>

					<?php
					}
					?>
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
		$("#pointbook").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#registration").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#book").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#agenda").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#course").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#priceperday").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
	});
</script>