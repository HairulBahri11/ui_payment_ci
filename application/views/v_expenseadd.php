<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Expense
			<small>expense Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Expense</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Form Expense</h3>
					</div>

					<!-- form start -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>expense/addExpenseDb" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Date</label>
								<div class="col-sm-9">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker" name="expdate" id="expdate">
									</div>
								</div>
							</div>

							<?php
							if ($user_branch_id == NULL):
							?>
								<div class="form-group">
									<label for="category" class="col-sm-3 control-label">Branch</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="branch_id" id="branch_id" required>
											<option selected="selected" disabled="disabled" value="">-- Choose Branch --</option>
											<?php
											foreach ($branches as $branch):
											?>
												<option value="<?= $branch->id ?>"><?= $branch->location ?></option>
											<?php
											endforeach;
											?>
										</select>
									</div>
								</div>
							<?php
							endif;
							?>

							<div class="form-group">
								<label for="category" class="col-sm-3 control-label">Source</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="id_akun" id="id_akun" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Source --</option>
										<?php
										foreach ($id_akun as $akun):
										?>
											<option value="<?= $akun->id_akun ?>"><?= $akun->no_akun . ' - ' . $akun->nama_akun ?></option>
										<?php
										endforeach;
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="category" class="col-sm-3 control-label">Category</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="category" id="category" onchange="changeCategory()" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Category --</option>
										<option value="OFFICE NEEDS">Office Needs</option>
										<option value="SALARY">Salary</option>
										<option value="SOUVENIR">Souvenir</option>
										<option value="DENPASAR">Denpasar</option>
										<option value="OTHER">Other</option>
									</select>
								</div>
							</div>

							<div class="form-group" id="divother" style="display: none">
								<label for="other" class="col-sm-3 control-label">Expense Other</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="other" name="other">
								</div>
							</div>

							<div class="form-group">
								<label for="explanation" class="col-sm-3 control-label">Explanation</label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" id="explanation" name="explanation" required></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label">Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="amount" name="amount">
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-primary">Add</button>
									<a href="<?= base_url() ?>expense/addexpense"><button type="button" class="btn btn-warning">Clear</button></a>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Date</th>
													<th>Source</th>
													<th>Category</th>
													<th>Explanation</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>

											</tbody>

										</table>
									</div>
								</div>
							</div>

							<form role="form" id="example3" name="example" class="form-horizontal" action="<?php echo base_url() ?>expense/addExpenseDb" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<button type="button" class="btn btn-primary">Submit</button>
										<a href="<?= base_url() ?>expense/addexpense"><button type="button" class="btn btn-danger">Cancel</button></a>
									</div>
								</div>
							</form>

						</div>
						<!-- /.box-body -->

						<!-- <div class="box-footer">
                
              </div> -->
						<!-- /.box-footer -->
					</form>

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

		document.getElementById("amount").value = 0;
		document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
	});

	function changeCategory() {
		if (document.getElementById("category").value == "OTHER") {
			$("#divother").show(750);
		} else {
			$("#divother").hide(750);
		}
	}

	$('#example').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
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
</script>
