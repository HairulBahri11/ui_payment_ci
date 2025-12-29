<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Add Price Data
			<small>add Price Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Price</a></li>
			<li class="active">Add Price Data</li>
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
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>price/addPriceDb" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="program" class="col-sm-3 control-label">Program</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="program" placeholder="Enter Program" name="program" required>
								</div>
							</div>

							<div class="form-group">
								<label for="level" class="col-sm-3 control-label">Level</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="level" placeholder="Enter Level" name="level" required>
								</div>
							</div>

							<div class="form-group">
								<label for="pointbook" class="col-sm-3 control-label">Point Book</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="pointbook" placeholder="Enter Point Book Price" name="pointbook" required>
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label">Registration</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="registration" placeholder="Enter Registration Fee" name="registration" required>
								</div>
							</div>

							<div class="form-group">
								<label for="book" class="col-sm-3 control-label">Book</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="book" placeholder="Enter Book Price" name="book" required>
								</div>
							</div>

							<div class="form-group">
								<label for="agenda" class="col-sm-3 control-label">Agenda</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="agenda" placeholder="Enter Agenda Price" name="agenda" required>
								</div>
							</div>

							<div class="form-group">
								<label for="course" class="col-sm-3 control-label">Course</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="course" placeholder="Enter Course Price" name="course" required>
								</div>
							</div>

							<div class="form-group">
								<label for="priceperday" class="col-sm-3 control-label">Price/Day</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="priceperday" placeholder="Enter Price/Day" name="priceperday" required>
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

		document.getElementById("pointbook").value = 0;
		document.getElementById("pointbook").value = "Rp " + FormatDuit(document.getElementById("pointbook").value);
		document.getElementById("registration").value = 0;
		document.getElementById("registration").value = "Rp " + FormatDuit(document.getElementById("registration").value);
		document.getElementById("book").value = 0;
		document.getElementById("book").value = "Rp " + FormatDuit(document.getElementById("book").value);
		document.getElementById("agenda").value = 0;
		document.getElementById("agenda").value = "Rp " + FormatDuit(document.getElementById("agenda").value);
		document.getElementById("course").value = 0;
		document.getElementById("course").value = "Rp " + FormatDuit(document.getElementById("course").value);
		document.getElementById("priceperday").value = 0;
		document.getElementById("priceperday").value = "Rp " + FormatDuit(document.getElementById("priceperday").value);
	});

	function FormatDuit(x) {
		var tmp_num;
		var negatif = false;
		if (x < 0) {
			negatif = true;
			tmp_num = Math.abs(x);
		} else {
			tmp_num = x;
		}

		var num = tmp_num.toString();
		for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
			num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
		if (negatif) {
			num = '-' + num;
		}
		return (num);
	}
</script>