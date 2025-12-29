<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Transaction Report
			<small>list Transactions</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Report</a></li>
			<li class="active">Transaction Report</li>
		</ol>
	</section>

	<!-- Left side column. contains the logo and sidebar -->
	<?php if ($this->session->flashdata('alert')): ?>
		<div class="alert alert-success" timeout="5000">
			<?php echo $this->session->flashdata('alert'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
	<?php endif; ?>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Transaction Report</h3>
					</div>
					<!-- /.box-header -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>report/showTrans" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-xs-4">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Start Date</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="datepicker" name="startdate" id="startdate" required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">End Date</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="datepicker1" name="enddate" id="enddate" required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Search Report</button>
									</div>
									<div class="col-xs-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . "report/exportExcel?from=" . $from . "&to=" . $to ?>" class="btn btn-success">Export</a>
									</div>
								</div>
								<div class="table-responsive">
									<table id="exporttrans" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th style="display: none;">No</th>
												<th>Date</th>
												<th><span style="display: none;">No</span> Nota</th>
												<th style="display: none;">Name</th>

												<th class="notPrintable">Notes</th>
												<!-- <th style="display:none;">Phone</th> -->
												<th class="notPrintable">Method</th>
												<th style="display: none;">Payment Method</th>
												<th style="display: none;">Date/TC</th>
												<th style="display: none;">Level</th>
												<th style="display: none;">Month</th>
												<th style="display: none;">Register Fee</th>
												<th style="display: none;">Book</th>
												<th style="display: none;">Agenda Book</th>
												<th style="display: none;">Point Book</th>
												<th style="display: none;">Course Fee</th>
												<th style="display: none;">Excercise Book</th>
												<th>Total Pay</th>
												<th class="notPrintable">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$arr = [
												"id_siswa" => [],
												"date" => []
											];
											if (isset($listTransaction)) {
												foreach ($listTransaction as $row) {
													$var = $row->paydate;
													$parts = explode('-', $var);
													$paydate = $parts[2] . '/' . $parts[1];
													$paydetail = $this->mpaydetail->getPaymentByPaymentId($row->id);
													$prv = $row->explanation;
													$prv = (is_null($prv)) ? '' : $prv;
													$exPrv = explode(' ', $prv);
													$query = $this->db->query("SELECT COUNT(*) as countpy
																				FROM paydetail
																				WHERE paymentid = '" . $row->id . "'");
													$result = $query->num_rows();
													$this->db->select("paydetail.*, s.name , s.phone, p.program");
													$this->db->from("paydetail");
													$this->db->join("student as s", 's.id = paydetail.studentid');
													$this->db->join("price as p", 'p.id = s.priceid');
													$this->db->where('paymentid', $row->id);

													$queryDetails = $this->db->get(); // Eksekusi query untuk mendapatkan hasil
													$paydetails = $queryDetails->result(); // Mengambil hasil sebagai array objek

													// print_r($paydetails);

													$count = $this->db->count_all_results();





													// print_r('paydetail :' . $paydetail->result());


													foreach ($paydetails as $key => $value) {


														if ($result < 1) {
															if ($key + 1 == $count) {
											?>
																<tr>
																	<td style="display: none;"><?= $no++ ?></td>
																	<td><?= $paydate ?></td>
																	<td><?= $row->id ?></td>
																	<td style="display: none;">
																		<?= $value->name ?>
																	</td>
																	<td>
																		<?= $value->name ?>
																	</td>

																	<span id="phone" style="display: none;"><?= $value->phone ?></span>

																	<td><?= $row->method ?></td>
																	<td style="display: none ;">
																		<?php if ($row->method == 'CASH') { ?>
																			<font color='red'><?= $row->method ?></font>
																		<?php } else { ?>
																			<font color='blue'><?= $row->method ?></font>
																		<?php } ?>
																	</td>
																	<td style="display: none ;">
																		<?= $row->method == 'BANK TRANSFER' ? $row->trfdate : $row->number ?>
																	</td>
																	<td style="display: none;"><?= $row->program ?></td>
																	<td style="display: none;">
																		<?php if ($row->level != 'Private') {
																			echo date('M', strtotime($value->monthpay));
																		} else {
																			echo trim($exPrv[0], "()");
																		}
																		?>
																	</td>
																	<td style="display: none;">Rp <?= number_format($row->regist, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->book, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->point_book, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($value->category == 'COURSE' ? $value->amount : 0, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($row->total, 0, ".", ".") ?></td>
																	<td><a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																		<a data-toggle="modal" data-target="#showModal<?php echo $row->id; ?>" data-phone="<?= $value->phone ?>" href="#" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>

																		<a data-toggle="modal" data-target="#showPhone<?php echo $row->id; ?>" data-phone="<?= $value->phone ?>" data-program="<?= $value->program ?>" href="#" class="btn btn-success btn-xs"><i class="fa fa-whatsapp"></i></a>


																	</td>
																</tr>
															<?php
															}
														} else {
															if ($key + 1 == $count) { ?>
																<tr>
																	<td style="display: none;"></td>
																	<td><?= $paydate ?></td>
																	<td><?= $row->id ?></td>
																	<td>
																		<?= $value->name ?>
																	</td>

																	<span id="phone" style="display: none;"><?= $value->phone ?></span>

																	<td style="display: none;">
																		<?= $value->name ?>
																	</td>
																	<td><?= $row->method ?></td>
																	<td style="display: none;">
																		<?php if ($row->method == 'CASH') { ?>
																			<font color='red'><?= $row->method ?></font>
																		<?php } else { ?>
																			<font color='blue'><?= $row->method ?></font>
																		<?php } ?>
																	</td>
																	<td style="display: none;">
																		<?= $row->method == 'BANK TRANSFER' ? $row->trfdate : $row->number ?>
																	</td>
																	<td style="display: none;"><?= $value->program ?></td>
																	<td style="display: none;">
																		<?php if ($row->level != 'Private') {
																			echo date('M', strtotime($value->monthpay));
																		} else {
																			echo trim($exPrv[0], "()");
																		}
																		?>
																	</td>
																	<td style="display: none;">Rp <?= number_format($row->regist, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->book, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->point_book, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($value->category == 'COURSE' ? $value->amount : 0, 0, ".", ".") ?></td>
																	<td style="display: none;">Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($row->total, 0, ".", ".") ?></td>
																	<td><a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																		<a data-toggle="modal" data-target="#showModal<?php echo $row->id; ?>" data-phone="<?= $value->phone ?>" href="#" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>
																		<a data-toggle="modal" data-target="#showPhone<?php echo $row->id; ?>" data-phone="<?= $value->phone ?>" data-program="<?= $value->program ?>" href="#" class="btn btn-success btn-xs"><i class="fa fa-whatsapp"></i></a>
																	</td>
																</tr>

															<?php		} else { ?>
																<tr style="display: none;">
																	<td></td>
																	<td><?= $paydate ?></td>
																	<td><?= $row->id ?></td>
																	<td>
																		<?= $value->name ?>
																	</td>
																	<td>
																		<?= $value->name ?>
																	</td>
																	<td><?= $row->method ?></td>
																	<td>
																		<?php if ($row->method == 'CASH') { ?>
																			<font color='red'><?= $row->method ?></font>
																		<?php } else { ?>
																			<font color='blue'><?= $row->method ?></font>
																		<?php } ?>
																	</td>
																	<td>
																		<?= $row->method == 'BANK TRANSFER' ? $row->trfdate : $row->number ?>
																	</td>
																	<td><?= $value->program ?></td>
																	<td>
																		<?php if ($row->level != 'Private') {
																			echo date('M', strtotime($value->monthpay));
																		} else {
																			echo trim($exPrv[0], "()");
																		}
																		?>
																	</td>
																	<td>Rp <?= number_format($row->regist, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($row->book, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($row->point_book, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($value->category == 'COURSE' ? $value->amount : 0, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
																	<td>Rp <?= number_format(0, 0, ".", ".") ?></td>
																	<td><a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																		<a data-toggle="modal" data-target="#showModal<?php echo $row->id; ?>" data-phone="<?= $value->phone ?>" href="#" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>
																	</td>
																</tr>
											<?php
															}
														}
													}
												}
											}
											?>
										</tbody>

									</table>
								</div>
							</div>
							<!-- /.box-body -->
					</form>
				</div>
				<!-- /.box -->


			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
if (isset($listTransaction)) {
	foreach ($listTransaction as $row) {
?>
		<div class="modal modal-danger fade" id="delModal<?php echo $row->id; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Delete Transaction</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure to delete this selected transaction?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
						<a href="<?= base_url() ?>report/deletePaymentDb/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
<?php
	}
}
?>




<?php
if (isset($listTransaction)) {
	foreach ($listTransaction as $row) {
?>
		<div class="modal modal-default fade" id="showModal<?php echo $row->id; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Detail Payment List</h4>
					</div>
					<div class="modal-body">
						<table id="examples" class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Number</th>
									<th>Name</th>
									<th>Level</th>
									<th>Payment</th>
									<th>Amount</th>
									<th>Voucher</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$payid = 0;
								$program = "";
								foreach ($listDetailPayment->result() as $payment) {
									if ($payment->id == $row->id) {
										$payid = $payment->id;
										$program = $payment->program;
										// var_dump($payment);
										// die;

								?>
										<tr>
											<td><?= $payment->id ?></td>
											<td><?= $payment->name ?></td>
											<td><?= $payment->program ?></td>

											<?php
											if ($payment->category == "COURSE" && $payment->monthpay != "") {
												$var = $payment->monthpay;
												$parts = explode('-', $var);
												$monthpay = $parts[1] . '/' . $parts[0];
												$monthpay =  date("M", strtotime($payment->monthpay));
												$yearpay =  date("y", strtotime($payment->monthpay));
												$category = $payment->category . " (" . $monthpay . " " . $yearpay . ")";
											} else {
												$category = $payment->category;
											}
											?>
											<td><?= $category ?></td>
											<td>Rp <?= number_format($payment->total, 0, ".", ".") ?></td>
											<?php
											if ($payment->voucherid == "" || $payment->voucherid == "0") {
												$voucherid = "NO";
											} else {
												$voucherid = $payment->voucherid;
											}
											?>
											<td><?= $voucherid ?></td>
										</tr>


								<?php

									}
								}
								?>
							</tbody>
						</table>
					</div>

					<a href="" id="getPhone"></a>


					<div class="modal-footer">
						<a href="<?= base_url() ?>report/printTrans/<?= $payid ?>/<?= $program ?>" target="_blank"><button type="button" class="btn btn-secondary">Reprint</button></a>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
<?php
	}
}
?>

<?php
if (isset($listTransaction)) {
	foreach ($listTransaction as $row) {
?>
		<div class="modal fade e-receipt-modal" id="showPhone<?php echo $row->id; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">E-Receipt - <?= $row->id ?></h4>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="recipient-name" class="col-form-label">Phone Number</label>
							<input type="text" class="form-control phone_number" id="phone_number_<?php echo $row->id; ?>" name="phone_number">
						</div>

						<input type="text" id="getProgram" class="form-control" style="display: none;">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn pull-left" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-outline-success send-receipt" data-id="<?php echo $row->id; ?> ">Send E-Receipt</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
<?php
	}
}
?>

<!-- <script>
	$(document).ready(function() {
		$(document).on('shown.bs.modal', function(event) {
			// alert('Modal is shown');
			var triggerElement = $(event.relatedTarget); // Elemen yang digunakan untuk membuka modal
			var program = triggerElement.data('program'); // Mengambil nilai data-program
			var modal = $(event.target); // Modal yang sedang terbuka

			console.log('Program:', program); // Mengisi input di dalam modal dengan program

			// Mengisi input di dalam modal dengan program
			modal.find('#getProgram').val(program);
		});

		$('.send-receipt').click(function() {
			var transactionId = $(this).data('id'); // Ambil ID transaksi
			var phoneNumber = $('#phone_number_' + transactionId).val(); // Ambil nomor telepon
			// Redirect ke URL dengan nomor telepon sebagai parameter
			window.location.href = '<?= base_url() ?>report/eReceipt/' + transactionId + '/' + program + '?phone_number=' + encodeURIComponent(phoneNumber);
		});
	});
</script> -->

<script>
	$(document).ready(function() {
		$(document).on('shown.bs.modal', function(event) {
			var triggerElement = $(event.relatedTarget); // Elemen yang digunakan untuk membuka modal
			var program = triggerElement.data('program'); // Mengambil nilai data-program
			var phone = triggerElement.data('phone'); // Mengambil nilai data-phone
			var modal = $(event.target); // Modal yang sedang terbuka

			// console.log('Program:', program);
			// console.log('Phone:', phone);

			// Mengisi input program dan phone dalam modal yang terbuka
			modal.find('.form-control.phone_number').val(phone);
			modal.find('input[id^="getProgram"]').val(program);
			// Menyimpan nilai program di atribut data pada modal
			modal.data('program', program);

		});

		$(document).on('click', '.send-receipt', function() {
			var transactionId = $(this).data('id'); // Ambil ID transaksi
			var phoneNumber = $('#phone_number_' + transactionId).val(); // Ambil nomor telepon

			// Ambil nilai program dari data modal
			// var program = $(this).closest('.modal').data('program');
			var modal = $(this).closest('.modal');
			var program = modal.data('program');

			// Redirect ke URL dengan nomor telepon sebagai parameter
			window.location.href = '<?= base_url() ?>report/eReceipt/' + transactionId + '/' + program + '?phone_number=' + encodeURIComponent(phoneNumber);
		});
	});
</script>