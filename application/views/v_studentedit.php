<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Edit Student
			<small>edit Student Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Student</a></li>
			<li class="active">Edit Student</li>
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
					foreach ($student->result() as $student) {
						$studentid = $student->id;
					?>
						<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>student/updateStudentDb" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">Full Name</label>
									<div class="col-sm-9">
										<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $student->sid; ?>">
										<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="<?php echo $student->name; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="birthday" class="col-sm-3 control-label">Birthday</label>
									<div class="col-sm-9">
										<div class="row">
											<div class="col-xs-6">
												<select class="form-control select2" style="width: 100%;" name="date" required>
													<option selected="selected" disabled="disabled" value="">-- Choose Date --</option>
													<?php
													for ($i = 1; $i <= 31; $i++) {
														$parts = explode(' ', $student->birthday);
														$birthday = $parts[1];
														if ($birthday == $i) {
													?>
															<option selected="selected" value="<?= $i ?>"><?= $i ?></option>
														<?php
														} else {
														?>
															<option value="<?= $i ?>"><?= $i ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
											<div class="col-xs-6">
												<select class="form-control select2" style="width: 100%;" name="month" required>
													<option disabled="disabled" value="">-- Choose month --</option>
													<?php
													$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
													foreach ($months as $month) {
														$parts = explode(' ', $student->birthday);
														$birthmonth = $parts[0];
														if ($birthmonth == $month) {
													?>
															<option selected="selected" value="<?= $month ?>"><?= $month ?></option>
														<?php
														} else {
														?>
															<option value="<?= $month ?>"><?= $month ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="phone" class="col-sm-3 control-label">Phone Number</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="<?php echo $student->phone; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="adjusment" class="col-sm-3 control-label">Adjusment</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="adjusment" name="adjusment" value="Rp <?php echo number_format($student->adjusment, 0, ".", "."); ?>" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="penalty" class="col-sm-3 control-label">Penalty</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="penalty" name="penalty" value="Rp <?php echo number_format($student->penalty, 0, ".", "."); ?>" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="balance" class="col-sm-3 control-label">Balance</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="balance" name="balance" value="Rp <?php echo number_format($student->balance, 0, ".", "."); ?>" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="program" class="col-sm-3 control-label">Level</label>
									<div class="col-sm-9">
										<select class="form-control select2" name="<?= $this->session->userdata('level') != 1 ? '' : 'program' ?>" <?= $this->session->userdata('level') != 1 ? 'disabled' : '' ?>>
											<option disabled="disabled" value="">-- Choose Level --</option>
											<?php
											foreach ($listPrice->result() as $row) {
												if ($student->priceid == $row->id) {
											?>
													<option selected="selected" value="<?= $row->id ?>"><?= $row->program ?></option>
												<?php
												} else {
												?>
													<option value="<?= $row->id ?>"><?= $row->program ?></option>
											<?php
												}
											}
											?>
										</select>
										<?php
										if ($this->session->userdata('level') != 1) { ?>
											<input type="hidden" name="program" value="<?= $student->priceid ?>">
										<?php }
										?>
									</div>
									<input type="hidden" name="programId" value="<?= $student->priceid ?>">
								</div>

								<div class="form-group">
									<label for="status" class="col-sm-3 control-label">Status</label>
									<div class="col-sm-9">
										<input type="hidden" class="form-control" id="cond" name="cond">
										<select class="form-control select2" style="width: 100%;" id="status" name="status" required>
											<option disabled="disabled" value="">-- Choose Status --</option>
											<?php
											if ($student->status == "ACTIVE") {
											?>
												<option selected="selected" value="ACTIVE">ACTIVE</option>
												<option value="INACTIVE">INACTIVE</option>
											<?php
											} else {
											?>
												<option value="ACTIVE">ACTIVE</option>
												<option selected="selected" value="INACTIVE">INACTIVE</option>
											<?php
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="note" class="col-sm-3 control-label">Note</label>
									<div class="col-sm-9">
										<textarea name="note" rows="3" class="form-control"><?= $student->note ?></textarea>
									</div>
								</div>

							</div>
							<!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Submit</button>
								<a href="<?= base_url() ?>student"><button type="button" class="btn btn-default">Cancel</button></a>
							</div>
							<!-- /.box-footer -->
						</form>

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.col -->

			<div class="col-xs-5">
				<!-- <div class="box"> -->
				<div class="box box-success">
					<form role="form" id="example1" name="example1" class="form-horizontal">
						<div class="box-body">

							<div class="form-group">
								<label for="status" class="col-sm-4 control-label">Price Condition</label>
								<div class="col-sm-8">
									<select class="form-control select2" style="width: 100%;" name="condition" id="condition" onchange="hide()">
										<?php
										if ($student->condition == "CHANGE") {
										?>
											<option value="DEFAULT">Default Price</option>
											<option selected="selected" value="CHANGE">Change Price</option>
										<?php
										} else {
										?>
											<option selected="selected" value="DEFAULT">Default Price</option>
											<option value="CHANGE">Change Price</option>
										<?php
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group" id="nprice" style="display: none">
								<label for="newprice" class="col-sm-4 control-label">New Price</label>
								<div class="col-sm-8">
									<?php
									if ($student->condition == "CHANGE") {
									?>
										<input type="text" class="form-control" id="newprice" placeholder="Enter New Price" name="newprice" value="Rp <?php echo number_format($student->adjusment, 0, ".", "."); ?>">
									<?php
									} else {
									?>
										<input type="text" class="form-control" id="newprice" placeholder="Enter New Price" name="newprice">
									<?php
									}
									?>
								</div>
							</div>

						</div>
						<!-- /.box-body -->

					</form>
				<?php
					}
				?>
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
		$(".select['name=program']").attr("readonly", "readonly");
		// $(".select2level").select2("readonly", true);
		$("#newprice").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#adjusment").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#penalty").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#balance").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});

		if (document.example1.condition.value === "CHANGE") {
			document.getElementById("newprice").value = document.getElementById("adjusment").value;
			$("#nprice").show(750);
		} else {
			document.getElementById("newprice").value = 0;
			document.getElementById("newprice").value = "Rp " + FormatDuit(document.getElementById("newprice").value);
			$("#nprice").hide(750);
		}
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

	$('#example1').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	$("#newprice").on('keyup', function(e) {
		if (e.keyCode == 13) {
			document.getElementById("adjusment").value = document.getElementById("newprice").value;
		}
	});

	$("#example").submit(function() {
		if (document.example1.condition.value === "CHANGE") {
			document.getElementById("adjusment").value = document.getElementById("newprice").value;
		}
		document.getElementById("cond").value = document.getElementById("condition").value;
	});

	function hide() {
		if (document.example1.condition.value === "CHANGE") {
			$("#nprice").show(750);
			document.getElementById("newprice").value = 0;
			document.getElementById("newprice").value = "Rp " + FormatDuit(document.getElementById("newprice").value);
		} else {
			$("#nprice").hide(750);
			document.getElementById("adjusment").value = 0;
			document.getElementById("adjusment").value = "Rp " + FormatDuit(document.getElementById("adjusment").value);
		}
	}
</script>