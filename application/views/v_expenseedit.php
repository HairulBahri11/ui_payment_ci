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
					<?php
					foreach ($expense->result() as $exp) {
					?>
						<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>expense/updateExpenseDb/<?= $exp->id ?>" method="post" enctype="multipart/form-data">
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
										<textarea class="form-control" rows="3" id="explanation" name="explanation"></textarea>
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
										<a href="<?= base_url() ?>expense/updateexpense/<?= $exp->id ?>"><button type="button" class="btn btn-warning">Clear</button></a>
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
													<?php
													if (isset($listExpdetail)) {
														foreach ($listExpdetail->result() as $row) {
													?>
															<tr>
																<?php
																$var = $row->expdate;
																$parts = explode('-', $var);
																$expdate = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
																?>
																<td><?= $expdate ?></td>
																<td><?= $row->nama_akun ?></td>
																<td><?= $row->category ?></td>
																<td><?= $row->explanation ?></td>
																<td>Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
																<td><a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
															</tr>
													<?php
														}
													}
													?>
												</tbody>

											</table>
										</div>
									</div>
								</div>
						</form>

						<form role="form" id="example3" name="example" class="form-horizontal" action="<?php echo base_url() ?>expense/submitExpenseDb/<?= $exp->id ?>" method="post" enctype="multipart/form-data">
							<div id="dpayment" style="display: none">
								<div class="form-group">
									<label for="total" class="col-sm-3 control-label">Total Amount</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="total" name="total" readonly>
										<input type="hidden" class="form-control" id="branch_id_submit" name="branch_id_submit">

									</div>
								</div>

								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary">Submit</button>
										<a href="<?= base_url() ?>expense/addexpense"><button type="button" class="btn btn-danger">Cancel</button></a>
									</div>
								</div>
							</div>
						</form>

				</div>
				<!-- /.box-body -->

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


<?php
foreach ($listExpdetail->result() as $row) {
?>
	<div class="modal modal-danger fade" id="delModal<?php echo $row->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Expense Detail</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure to delete this selected expense?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<a href="<?= base_url() ?>expense/deleteExpdetailDb/<?= $row->expenseid ?>/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php
}
?>


<script type="text/javascript">
	$(document).ready(function() {
		$("#branch_id").change(function() {
			$("#branch_id_submit").val($(this).val());
		});

		$("#amount").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#total").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});

		document.getElementById("amount").value = 0;
		document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);

		$("#dpayment").show(750);

		<?php
		$totalexp = 0;
		foreach ($listExpdetail->result() as $expdet) {
			$totalexp = $totalexp + $expdet->amount;
		}
		?>
		document.getElementById("total").value = "Rp <?php echo number_format($totalexp, 0, ".", "."); ?>";
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

	$("#example3").submit(function() {
		alert('Add expense payment successful.');
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