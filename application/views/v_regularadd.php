<?php
if (isset($_GET['print'])) {
	$idprint = $_GET['print'];
} else {
	$idprint = 0;
}

$url = base_url() . "cetak/printregular/";
?>
<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Regular Payment
			<small>regular payment Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Payment</a></li>
			<li class="active">Regular Payment</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-6">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Payment System (Regular)</h3>
					</div>
					<!-- /.box-header

            <!-- /.box-header -->
					<!-- form start -->
					<div class="box-body">
						<!-- <form role="form" id="example" name="example" class="form-horizontal"> -->
						<form role="form" id="example3" name="example3" class="form-horizontal" action="<?php echo base_url() ?>payment/addRegularDb" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="program" class="col-sm-3 control-label">Student's ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="studentid" name="studentid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''  ?>">
									<input type="hidden" class="form-control" id="spriceid" name="spriceid" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Student's Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="sname" name="sname" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="level" class="col-sm-3 control-label">Level</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="level" name="level" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="pointbook" class="col-sm-3 control-label">Payment Category</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="category" id="category" onchange="fillAmount()" required>
										<!-- <option selected="selected" disabled="disabled" value="">-- Choose Category --</option> -->
										<option selected="selected" value="COURSE">Course Fee</option>
										<!-- <option value="POINT BOOK">Point Book</option> -->
										<option value="BOOK">Text-book</option>
										<!-- <option value="AGENDA">Agenda</option> -->
										<option value="REGISTRATION">Registration</option>
										<option value="EXERCISE">Exercise Book</option>
										<option value="BOOKLET">Booklet</option>
										<option value="OTHER">Other</option>
									</select>
								</div>
							</div>

							<div class="form-group" id="divother" style="display: none">
								<label for="other" class="col-sm-3 control-label">Payment Other</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="other" name="other_detail">
								</div>
							</div>

							<div class="form-group" id="perioddiv" style="display:none;">
								<label for="period" class="col-sm-3 control-label">Day or Month</label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input type="radio" name="period" id="period1" value="month" checked>
											Month
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="period" id="period2" value="day">
											Day
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="period" id="period3" value="hour">
											Hour
										</label>
									</div>
								</div>
							</div>

							<div class="form-group" id="monthdiv" style="display:none;">
								<label for="registration" class="col-sm-3 control-label">Month Pay</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="monthpay" id="monthpay">

									</select>
									<!-- <input type="text" class="form-control" id="monthpay" name="monthpay" readonly> -->
								</div>
							</div>

							<div id="daydiv" style="display:none;">
								<div class="form-group">
									<label id="labelattn" for="attendance" class="col-sm-3 control-label">Attendance</label>
									<label id="labelhour" style="display:none;" for="attendance" class="col-sm-3 control-label">Hour</label>
									<div class="col-sm-9">
										<input type="number" class="form-control" id="attendance" name="attendance">
									</div>
								</div>

								<div class="form-group">
									<label id="labelprice" for="priceattn" class="col-sm-3 control-label">Price per Attendance</label>
									<label id="labelphour" style="display:none;" for="priceattn" class="col-sm-3 control-label">Price per Hour</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="priceattn" name="priceattn" readonly>
									</div>
								</div>
							</div>

							<div class="form-group" id="penaltydiv" style="display:none;">
								<label for="period" class="col-sm-3 control-label">Use Penalty</label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input type="radio" name="penalty" id="penalty1" value="no" checked>
											No
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="penalty" id="penalty2" value="yes">
											Yes
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label">Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="amount" name="amount" readonly>
								</div>
							</div>

							<input type="hidden" class="form-control" id="vid" name="vid" value="">
							<input type="hidden" class="form-control" id="vamount" name="vamount">

							<input type="hidden" class="form-control" id="amount_penalty" name="amount_penalty">

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<button onclick="addDetail()" type="button" class="btn btn-primary">Add</button>
									<a href="<?= base_url() ?>payment/addregular"><button type="button" class="btn btn-warning">Clear</button></a>
									<a id="voucherdiv" style="display:none;" data-toggle="modal" data-target="#voucherModal" href="#" class="btn btn-primary pull-right"><i class="fa fa-credit-card"></i>&nbsp;Use Voucher</a>

								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="paytab" name="paytab" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Name</th>
													<th>Level</th>
													<th>Payment</th>
													<th>Month</th>
													<th>Voucher</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>


										</table>
									</div>
								</div>
							</div>
							<!-- </form> -->

							<!-- <form role="form" id="example3" name="example" class="form-horizontal" action="<?php echo base_url() ?>payment/addRegularDb" method="post" enctype="multipart/form-data"> -->
							<div id="dpayment" style="display: none">
								<?php
								if ($this->session->userdata('level') == 1):
								?>
									<div class="form-group">
										<label for="category" class="col-sm-3 control-label">Branch</label>
										<div class="col-sm-9">
											<select class="form-control select2" style="width: 100%;" name="branch_id" id="branch_id" required>
												<option selected="selected" disabled="disabled" value="">-- Choose Branch --</option>
												<option value="1">Surabaya</option>
												<option value="2">Bali</option>
											</select>
										</div>
									</div>
								<?php
								endif;
								?>
								<div class="form-group">
									<label for="date" class="col-sm-3 control-label">Date</label>
									<div class="col-sm-9">
										<input type="date" class="form-control" id="date" name="date" required>
									</div>
								</div>
								<div class="form-group">
									<label for="no_hp" class="col-sm-3 control-label">No Handphone</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="no_hp" name="no_hp" required>
									</div>
								</div>

								<div class="form-group">
									<label for="total" class="col-sm-3 control-label">Total Amount</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="total" name="total" readonly>
									</div>
								</div>

								<input type="hidden" class="form-control" id="total_penalty" name="total_penalty">

								<div class="form-group">
									<label for="method" class="col-sm-3 control-label">Payment Method</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="method" id="method" onchange="changeMethod()" required>
											<option selected="selected" disabled="disabled" value="">-- Choose Method --</option>
											<option value="CASH">Cash</option>
											<option value="SWITCHING CARD">Switching Card</option>
											<option value="BANK TRANSFER">Bank Transfer</option>
											<option value="DEBIT">Debit</option>
											<option value="CREDIT">Credit</option>
											<option value="QRIS">QRIS BCA</option> <!--TAMBAHAN DISINI -->
										</select>
									</div>
								</div>

								<div class="form-group" id="dtrfdate" style="display: none">
									<label for="inputPassword3" class="col-sm-3 control-label">Transfer Date</label>
									<div class="col-sm-9">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="datepicker" name="trfdate" id="trfdate">
										</div>
									</div>
								</div>

								<div class="form-group" id="dbank" style="display: none">
									<label for="method" class="col-sm-3 control-label">Bank</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="bank" id="bank" onchange="changeBank()">
											<option selected="selected" disabled="disabled" value="">-- Choose Bank --</option>
											<option value="BCA CARD">BCA Card</option>
											<option value="VISA CARD">Visa Card</option>
											<option value="VISA BCA">Visa BCA</option>
											<option value="MASTER CARD">Master Card</option>
											<option value="MAESTRO CARD">Maestro Card</option>
											<option value="JCB">JCB</option>
											<option value="AMERICAN EXPRESS">American Express</option>
											<option value="OVO">OVO</option>
											<option value="GOPAY">GOPAY</option>
											<option value="SHOPEE PAY">SHOPEE PAY</option>
											<option value="DANA">DANA</option>
											<option value="LINK AJA">LINK AJA</option>
											<option value="OCTO MOBILE">OCTO MOBILE</option>
											<option value="BCA MOBILE">BCA MOBILE</option>
											<option value="OTHER">Other</option>
										</select>
									</div>
								</div>

								<!-- PILIHAN BANK -->
								<div class="form-group" id="emoney" style="display: none">
									<label for="method" class="col-sm-3 control-label">E-Money</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="bank" id="bank" onchange="changeBank()">
											<option selected="selected" disabled="disabled" value="">-- Choose E-Money --</option>
											<option value="OVO">OVO</option>
											<option value="GOPAY">GOPAY</option>
											<option value="SHOPEE PAY">SHOPEE PAY</option>
											<option value="DANA">DANA</option>
											<option value="LINK AJA">LINK AJA</option>
											<option value="OCTO MOBILE">OCTO MOBILE</option>
											<option value="BCA MOBILE">BCA MOBILE</option>
											<option value="OTHER">Other</option>
										</select>
									</div>
								</div>
								<!-- BANK SELANJUTNYA -->

								<div class="form-group" id="dnumber" style="display: none">
									<label for="number" class="col-sm-3 control-label">Number</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="number" name="number">
									</div>
								</div>

								<div class="form-group" id="dcut" style="display: none">
									<label for="cash" class="col-sm-3 control-label">Bank Payment Cut</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="paymentcut" name="paymentcut" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="cash" class="col-sm-3 control-label">Cash</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="cash" name="cash">
									</div>
								</div>

								<div class="form-group">
									<label for="cashback" class="col-sm-3 control-label">Cashback</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="cashback" name="cashback" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary">Submit</button>
										<a href="<?= base_url() ?>payment/addregular"><button type="button" class="btn btn-danger">Cancel</button></a>
									</div>
								</div>
							</div>
						</form>

					</div>
					<!-- /.box-body -->

				</div>
				<!-- /.box-body -->

			</div>
			<!-- /.col -->

			<div class="col-xs-6">
				<!-- <div class="box"> -->
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Select Student</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">

							<table id="example2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th style="display:none;">priceid</th>
										<th>Name</th>
										<th>Program</th>
										<th>Course Fee</th>
										<th>U&I Place</th>
										<th style="display:none;">Phone</th>
									</tr>
								</thead>
								<tbody>

									<?php
									// var_dump($allStudent);
									// die;
									foreach ($allStudent as $row) {
									?>
										<tr>

											<td id="id"><?= $row['sid'] ?></td>
											<td id="priceid" style="display:none;"><?= $row['priceid'] ?></td>
											<td id="name"><?= $row['name'] ?></td>
											<td id="program"><?= $row['program'] ?></td>
											<td id="course"><?= $row['course'] ?></td>
											<td id="place"><?= $row['branch_id'] == "1" ? "Surabaya" : "Bali" ?></td>
											<td id="phone" style="display:none;"><?= $row['phone'] ?></td>
										</tr>


									<?php

									}
									?>
								</tbody>

							</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>

			</div>
			<!-- /.col -->


		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal modal-default fade" id="voucherModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Choose Voucher</h4>
			</div>
			<div class="modal-body">
				<table id="example5" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Voucher Code</th>
							<th>Voucher Type</th>
							<th>Amount</th>
							<th>Usable</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($listVoucher->result() as $row) {
						?>
							<tr>
								<td id="voucherid"><?= $row->id ?></td>
								<td><?= $row->type ?></td>
								<td id="voucheramount">Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
								<td><?= $row->isused ?></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	var penalty = 0;
	var condition = "";
	var adjusment = 0;
	var monthpay = "";
	var totalpay = 0;
	var totalpenalty = 0;
	var paymentcut = 0.00;
	var selectedcell = 0;
	var selectedamount = "";
	// var table = $('#paytab').DataTable();

	$(document).ready(function() {
		// t = $("#example2").DataTable({});
		// 		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
		//         {
		//             return {
		//               "iStart": oSettings._iDisplayStart,
		//               "iEnd": oSettings.fnDisplayEnd(),
		//               "iLength": oSettings._iDisplayLength,
		//               "iTotal": oSettings.fnRecordsTotal(),
		//               "iFilteredTotal": oSettings.fnRecordsDisplay(),
		//               "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
		//               "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		//             };
		//         };
		//         t = $("#example2").DataTable({
		//             initComplete: function() {
		//                 var api = this.api();
		//                 $('#mytable_filter input')
		//                 .off('.DT')
		//                 .on('keyup.DT', function(e) {
		//                     if (e.keyCode == 13) {
		//                         api.search(this.value).draw();
		//                     }
		//                 });
		//             },
		//             oLanguage: {
		//                 sProcessing: "loading..."
		//             },
		//             // ordering: true,
		//             processing: true,
		//             serverSide: false,
		//             ajax: {"url": "getStudentRegular", "type": "POST"},
		//             columns: [
		//                 {
		//                   "data": "sid"
		//                 },{"data": "priceid", 'class':'hide'},{"data": "name"},{"data": "program"},{"data": "course"}
		//             ],
		//             // order: [[0, 'asc']],
		//             "order": [], //Initial no order.
		//             "columnDefs": [
		//                 { 
		//                     "targets": [ 0 ], //first column / numbering column
		//                     "orderable": false, //set not orderable
		//                 },
		//             ],
		//             rowCallback: function(row, data, iDisplayIndex) {
		// 				// console.log(data);
		//               var info = this.fnPagingInfo();
		//               var page = info.iPage;
		//               var length = info.iLength;
		//               $('td:eq(0)', row).html();
		//             }
		//         });
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
		$("#cash").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#cashback").maskMoney({
			prefix: '-Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#priceattn").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});

		document.getElementById("amount").value = 0;
		document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		document.getElementById("cash").value = 0;
		document.getElementById("cash").value = "Rp " + FormatDuit(document.getElementById("cash").value);
		document.getElementById("cashback").value = 0;
		document.getElementById("cashback").value = "Rp " + FormatDuit(document.getElementById("cashback").value);
		$('input[type=radio][name=period]').change(function() {
			fillAmount();
		});

		$('input[type=radio][name=penalty]').change(function() {
			fillAmount();
		});

		document.getElementById("attendance").value = 0;
	});

	$('#example3').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	function addDetail() {
		var x = document.getElementById("studentid").value;
		if (x == "") {
			alert("Please select a student first.");
		}

		var paytab = document.getElementById("paytab");
		var tbody = document.createElement("tbody");
		var tr = document.createElement("tr");

		var nametab = document.getElementById("sname").value;
		var leveltab = document.getElementById("level").value;
		var categorytab = document.getElementById("category").value;
		var monthtab = document.getElementById("monthpay").value;
		var vouchertab = document.getElementById("vid").value;
		var amounttab = document.getElementById("amount").value;
		var sidtab = document.getElementById("studentid").value;

		var td = document.createElement("td");
		var txt = document.createTextNode(nametab);
		td.appendChild(txt);
		tr.appendChild(td);

		var td = document.createElement("td");
		var txt = document.createTextNode(leveltab);
		td.appendChild(txt);
		tr.appendChild(td);

		var td = document.createElement("td");
		var txt = document.createTextNode(categorytab);
		td.appendChild(txt);
		tr.appendChild(td);

		if (categorytab == "COURSE") {
			var month3 = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			var res = monthtab.split("-");
			monthtab = month3[parseInt(res[0]) - 1];
			monthtab = monthtab.concat(" ");
			monthtab = monthtab.concat(res[1]);
			var td = document.createElement("td");
			var txt = document.createTextNode(monthtab);
			td.appendChild(txt);
			tr.appendChild(td);
		} else {
			var td = document.createElement("td");
			var txt = document.createTextNode("");
			td.appendChild(txt);
			tr.appendChild(td);
		}

		var td = document.createElement("td");
		var txt = document.createTextNode(vouchertab);
		td.appendChild(txt);
		tr.appendChild(td);

		var td = document.createElement("td");
		var txt = document.createTextNode(amounttab);
		td.appendChild(txt);
		tr.appendChild(td);

		var td = document.createElement('td');
		var txt = '<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
		td.innerHTML = txt;
		tr.appendChild(td);

		var td = document.createElement("td");
		var txt = document.createTextNode(sidtab);
		td.appendChild(txt);
		td.style.display = 'none';
		tr.appendChild(td);

		tbody.appendChild(tr);
		paytab.appendChild(tbody);

		document.getElementById("vid").value = "";
		document.getElementById("vamount").value = "";

		var amount = document.getElementById("amount").value.replace(/\./g, '');
		var amount = amount.replace("Rp ", "");
		totalpay = parseInt(totalpay) + parseInt(amount);
		document.getElementById("total").value = totalpay;
		document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);

		var amount_penaly = document.getElementById("amount_penalty").value.replace(/\./g, '');
		var amount_penaly = amount_penaly.replace("Rp ", "");
		totalpenalty = parseInt(totalpenalty) + parseInt(amount_penaly);
		document.getElementById("total_penalty").value = totalpenalty;
		document.getElementById("total_penalty").value = "Rp " + FormatDuit(document.getElementById("total_penalty").value);

		$("#dpayment").show(750);

		return false;
	}

	$("#paytab").on('click', 'tr', function() {
		if (selectedcell == 6) {
			var values = $(this).find('td').map(function() {
				return $(this).text();
			}).get();
			selectedamount = values[5];
			var amount = selectedamount.replace(/\./g, '');
			var amount = amount.replace("Rp ", "");
			totalpay = parseInt(totalpay) - parseInt(amount);
			document.getElementById("total").value = totalpay;
			document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);

			$("tr").eq($("tr").index(this)).remove();
		}

		// alert($("tr").index(this));
	});

	$("#paytab").on('click', 'td', function() {
		selectedcell = $(this).index();
	});

	$("#example2").on('click', 'tr', function() {
		// alert('<?php echo "hi"; ?>');
		document.getElementById("studentid").value = $(this).find("#id").text();
		document.getElementById("spriceid").value = $(this).find("#priceid").text();
		document.getElementById("sname").value = $(this).find("#name").text();
		document.getElementById("level").value = $(this).find("#program").text();
		document.getElementById("no_hp").value = $(this).find("#phone").text();
		// 		document.getElementById("studentid").value = t.row( this ).data().sid;
		//         document.getElementById("spriceid").value = t.row( this ).data().priceid;
		//         document.getElementById("sname").value = t.row( this ).data().name;
		//         document.getElementById("level").value = t.row( this ).data().program;
		fillAmount();
		$("#voucherdiv").show(750);
	});

	$("#studentid").on('keyup', function(e) {
		var checksid = 0;
		if (e.keyCode == 13) {
			<?php
			foreach ($listStudent as $student) {
			?>
				if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
					document.getElementById("spriceid").value = <?= $student->priceid ?>;
					document.getElementById("sname").value = "<?= $student->name ?>";
					document.getElementById("level").value = "<?= $student->program ?>";
					checksid = 1;
					fillAmount();
					$("#voucherdiv").show(750);
				}
			<?php
			}
			?>
			if (checksid == 0) {
				alert("Student ID not found");
			}
		}
	});

	$("#example5").on('click', 'tr', function() {
		$('#voucherModal').modal('hide');

		document.getElementById("vid").value = $(this).find("#voucherid").text();
		document.getElementById("vamount").value = $(this).find("#voucheramount").text();

		//alert(document.getElementById("vamount").value);
		fillAmount();
	});

	function setPenalty(penalty, selected) {
		var selected = $("input[name=penalty]:checked").val();

		<?php
		foreach ($listStudent as $student) {
		?>
			if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
				penalty = <?= $student->penalty ?>;
			}
		<?php
		}
		?>
	}

	function fillAmount() {
		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("spriceid").value == <?= $price->id ?>) {
				if (document.getElementById("category").value === "COURSE") {
					<?php
					foreach ($listStudent as $student) {
					?>
						if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
							penalty = <?= $student->penalty ?>;
							condition = "<?= $student->condition ?>";
							adjusment = <?= $student->adjusment ?>;
							monthpay = "<?= $student->monthpay ?>";
						}
					<?php
					}
					?>
					// Ubah `monthpay` ke format baru
					// var monthpay = "2022-12"; // Contoh nilai awal "YYYY-MM"
					var parts = monthpay.split("-"); // Pisahkan string berdasarkan "-"
					var lastBulan = parseInt(parts[1]); // Ambil bulan dari last payment
					var lastTahun = parseInt(parts[0]); // Ambil tahun dari last payment

					// Ambil bulan dan tahun sekarang
					var now = new Date();
					var currentBulan = now.getMonth() + 1; // Bulan saat ini (0-11, +1 untuk 1-12)
					var currentTahun = now.getFullYear(); // Tahun saat ini

					// Array nama bulan dalam bahasa Inggris
					var namaBulan = [
						"January", "February", "March", "April", "May", "June",
						"July", "August", "September", "October", "November", "December"
					];

					// Elemen <select> dengan ID 'monthpay'
					var select = document.getElementById('monthpay');

					// Logika untuk menentukan titik awal
					var startBulan, startTahun;

					if (lastTahun < currentTahun - 1 || (lastTahun === currentTahun - 1 && lastBulan < currentBulan)) {
						// Jika tahun terakhir lebih dari 1 tahun sebelum tahun sekarang
						startBulan = currentBulan; // Mulai dari bulan ini
						startTahun = currentTahun;
					} else {
						// Jika tahun terakhir masih relevan
						startBulan = lastBulan + 1; // Mulai dari bulan berikutnya
						startTahun = lastTahun;
						if (startBulan > 12) {
							startBulan = 1; // Reset ke Januari jika bulan > 12
							startTahun++; // Tambah tahun
						}
					}

					// Fungsi untuk menghitung 12 bulan berikutnya dan menambahkannya ke <select>
					function generateNextMonths(bulan, tahun) {
						// Hapus semua opsi sebelumnya
						select.innerHTML = ""; // Reset elemen <select>

						for (let i = 0; i < 12; i++) {
							// Hitung bulan dan tahun
							let currentMonth = bulan + i; // Tambah i ke bulan
							let currentYear = tahun;

							if (currentMonth > 12) {
								currentMonth -= 12; // Reset ke Januari jika bulan > 12
								currentYear++; // Tambahkan tahun
							}

							// Format nama bulan dan tahun
							let monthName = namaBulan[currentMonth - 1]; // Nama bulan
							let monthpay = `${monthName} ${currentYear}`;
							let value_option = `${String(currentMonth).padStart(2, '0')}-${currentYear}`; // Format MM-YYYY

							// Buat elemen <option>
							let option = document.createElement('option');
							option.value = value_option;
							option.text = monthpay;

							// Tambahkan opsi ke elemen <select>
							select.add(option);
						}
					}

					// Panggil fungsi untuk menambahkan 12 bulan berikutnya
					generateNextMonths(startBulan, startTahun);



					// Ubah `monthpay` ke format baru
					// Ubah `monthpay` ke format baru
					// var monthpay = "2024-12"; // Contoh nilai awal "YYYY-MM"
					// var parts = monthpay.split("-"); // Pisahkan string berdasarkan "-"
					// var bulan = parseInt(parts[1]); // Ambil bulan
					// var tahun = parseInt(parts[0]); // Ambil tahun

					// // Array nama bulan dalam bahasa Inggris
					// var namaBulan = [
					//   "January", "February", "March", "April", "May", "June",
					//   "July", "August", "September", "October", "November", "December"
					// ];

					// // Elemen <select> dengan ID 'monthpay'
					// var select = document.getElementById('monthpay');

					// // Fungsi untuk menghitung 12 bulan berikutnya, dimulai dari 1 bulan setelah `last payment`
					// function generateNextMonths(bulan, tahun) {
					//   // Hapus semua opsi sebelumnya
					//   select.innerHTML = ""; // Reset elemen <select>
					// //   hitung range tahun dari tahun ini
					// $range_year = $tahun
					//   for (let i = 1; i <= 12; i++) { // Mulai dari 1 bulan berikutnya
					//     // Hitung bulan dan tahun
					//     let currentMonth = bulan + i; // Tambah i ke bulan
					//     let currentYear = tahun;

					//     if (currentMonth > 12) {
					//       currentMonth -= 12; // Reset ke Januari jika bulan > 12
					//       currentYear++; // Tambahkan tahun
					//     }

					//     // Format nama bulan dan tahun
					//     let monthName = namaBulan[currentMonth - 1]; // Nama bulan
					//     let monthpay = `${monthName} ${currentYear}`;
					//     let value_option = `${String(currentMonth).padStart(2, '0')}-${currentYear}`; // Format MM-YYYY

					//     // Buat elemen <option>
					//     let option = document.createElement('option');
					//     option.value = value_option;
					//     option.text = monthpay;

					//     // Tambahkan opsi ke elemen <select>
					//     select.add(option);
					//   }


					// }

					// // Panggil fungsi untuk menambahkan 12 bulan berikutnya
					// generateNextMonths(bulan, tahun);





					// // Ubah `monthpay` ke format baru (Desember 2024)
					// var parts = monthpay.split("-"); // Pisahkan string berdasarkan "-"
					// var bulan = parseInt(parts[1]); // Ambil bulan
					// var tahun = parseInt(parts[0]); // Ambil tahun

					// // Array nama bulan dalam bahasa inggris

					// var namaBulan = [
					// 	"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
					// ];

					// // Format bulan sekarang
					// var formattedDate = namaBulan[bulan - 1] + " " + tahun;
					// console.log("Last Payment:", formattedDate); // Output: Desember 2024

					// // Tambahkan 1 bulan ke `monthpay`
					// var nextMonth = new Date(tahun, bulan, 1); // Bulan `bulan` otomatis dihitung 0-11
					// nextMonth.setMonth(nextMonth.getMonth()); // Tambah 1 bulan

					// // Format ulang menjadi DD-MM-YYYY
					// var day = "01"; // Tetap tanggal 01
					// var newMonth = String(nextMonth.getMonth() + 1).padStart(2, '0'); // Bulan (ditambah 1 dan zero-padded)
					// var newYear = nextMonth.getFullYear();// Tahun baru

					// // ubah newMonth menjadi nama bulan
					// var monthName = namaBulan[newMonth - 1];

					// // Set nilai baru ke `monthpay`
					// monthpay = `${monthName} ${newYear}`;
					// var value_option = `${newMonth}-${newYear}`;
					// console.log("Next Month:", monthpay); // Output: 01-01-2025

					// // document.getElementById('monthpay').value = monthpay;
					// // saya ingin menambahkan nilai monthpay ke select option

					// var select = document.getElementById('monthpay');
					// // Hapus semua opsi sebelumnya
					// select.innerHTML = ""; // Menghapus semua opsi di elemen <select>
					// var option = document.createElement('option');
					// option.value = value_option;
					// option.text = monthpay;
					// select.add(option);
					// // addoption






					// 					var monthPay = '';
					// 					var month = 0;
					// 					if (monthpay != "") {
					// 						var res = monthpay.split("-");
					// 						month = parseInt(res[1]);
					// 					} else {
					// 						var mon = (new Date()).getMonth();
					// 						month = parseInt(mon);
					// 					}

					// 					// var year = (new Date()).getFullYear();
					// 					var years = (new Date()).getFullYear();
					// var yearArray = [years - 1, years]; // Tahun 2024 dan 2025

					// var monthpay = document.getElementById('monthpay');
					// var length = monthpay.options.length;

					// // Hapus semua opsi sebelumnya
					// for (i = length - 1; i >= 0; i--) {
					//     monthpay.remove(i);
					// }

					// // Nama-nama bulan
					// var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

					// // Loop untuk setiap tahun dan bulan
					// for (var y = 0; y < yearArray.length; y++) {
					//     var year = yearArray[y];
					//     for (var i = 0; i < 12; i++) {
					//         var option = document.createElement("option");
					//         var monthValue = (i + 1 < 10 ? "0" : "") + (i + 1); // Format bulan jadi 01, 02, dst.
					//         option.value = monthValue + "-" + year;
					//         option.text = months[i] + " " + year;
					//         monthpay.add(option);
					//     }
					// }

					// // Set nilai default (opsional)
					// document.getElementById('monthpay').value = "01-" + years; // Set ke Januari tahun saat ini


					$("#perioddiv").show(750);
					$("#penaltydiv").show(750);

					selected_value = $("input[name=period]:checked").val();
					if (selected_value === "month") {
						if (condition == "DEFAULT") {
							document.getElementById("amount").value = "Rp <?php echo number_format($price->course, 0, ".", "."); ?>";
						} else {
							document.getElementById("amount").value = "Rp " + FormatDuit(adjusment);
						}
						var selected_penalty = $("input[name=penalty]:checked").val();
						if (selected_penalty == "no") {
							if (condition == "DEFAULT") {
								document.getElementById("amount").value = "Rp <?php echo number_format($price->course, 0, ".", "."); ?>";
							} else {
								// document.getElementById("amount").value = "Rp " + FormatDuit(adjusment);
								document.getElementById("amount").value = "Rp <?php echo number_format($price->course, 0, ".", "."); ?>";
							}
						} else if (selected_penalty == "yes") {
							var amount = document.getElementById("amount").value.replace(/\./g, '');
							var amount = amount.replace("Rp ", "");
							document.getElementById("amount").value = parseInt(amount) + parseInt(penalty);
							document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
							document.getElementById("amount_penalty").value = parseInt(penalty);
						}

						$("#monthdiv").show(750);
						$("#daydiv").hide(750);
						$("#divother").hide(750);
					} else if (selected_value === "day" || selected_value === "hour") {
						document.getElementById("priceattn").value = "Rp <?php echo number_format($price->priceperday, 0, ".", "."); ?>";
						document.getElementById("amount").value = document.getElementById("attendance").value * <?= $price->priceperday ?>;
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						var selected_penalty = $("input[name=penalty]:checked").val();
						if (selected_penalty == "no") {
							document.getElementById("amount").value = document.getElementById("attendance").value * <?= $price->priceperday ?>;
							document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						} else if (selected_penalty == "yes") {
							var amount = document.getElementById("amount").value.replace(/\./g, '');
							var amount = amount.replace("Rp ", "");
							document.getElementById("amount").value = parseInt(amount) + parseInt(penalty);
							document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);

							document.getElementById("amount_penalty").value = parseInt(penalty);
						}
						if (selected_value === "day") {
							$("#labelhour").hide(750);
							$("#labelphour").hide(750);
							$("#labelattn").show(750);
							$("#labelprice").show(750);
						} else if (selected_value === "hour") {
							$("#labelattn").hide(750);
							$("#labelprice").hide(750);
							$("#labelhour").show(750);
							$("#labelphour").show(750);
						}
						$("#monthdiv").hide(750);

						$("#daydiv").show(750);
					}
				} else if (document.getElementById("category").value === "POINT BOOK") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->pointbook, 0, ".", "."); ?>";
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").hide(750);

				} else if (document.getElementById("category").value === "REGISTRATION") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->registration, 0, ".", "."); ?>";
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").hide(750);

				} else if (document.getElementById("category").value === "BOOK") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->book, 0, ".", "."); ?>";
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").hide(750);

				} else if (document.getElementById("category").value === "AGENDA") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->agenda, 0, ".", "."); ?>";
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").hide(750);

				} else if (document.getElementById("category").value === "EXERCISE") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->exercisebook, 0, ".", "."); ?>";
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").hide(750);

				} else if (document.getElementById("category").value === "BOOKLET") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->booklet, 0, ".", "."); ?>";
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").hide(750);

				} else if (document.getElementById("category").value === "OTHER") {
					document.getElementById("amount").value = 0;
					document.getElementById("amount").removeAttribute("readonly");
					$("#perioddiv").hide(750);
					$("#penaltydiv").hide(750);
					$("#monthdiv").hide(750);
					$("#daydiv").hide(750);
					$("#divother").show(750);

				}


				if (document.getElementById("amount").value != "") {
					var amount = document.getElementById("amount").value.replace(/\./g, '');
					amount = amount.replace("Rp ", "");
					if (parseInt(amount) < 0) {
						amount = 0;
					}
				} else {
					var amount = 0;
				}

				if (document.getElementById("vamount").value != "") {
					var vamount = document.getElementById("vamount").value.replace(/\./g, '');
					vamount = vamount.replace("Rp ", "");
					document.getElementById("amount").value = parseInt(amount) - parseInt(vamount);
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
				}
			}
		<?php
		}
		?>
	}

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

	$("#attendance").on('keyup', function(e) {
		// if (e.keyCode == 13) {
		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("spriceid").value == <?= $price->id ?>) {
				document.getElementById("amount").value = document.getElementById("attendance").value * <?= $price->priceperday ?>;
				document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
				var selected_penalty = $("input[name=penalty]:checked").val();
				if (selected_penalty == "no") {
					document.getElementById("amount").value = document.getElementById("attendance").value * <?= $price->priceperday ?>;
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
				} else if (selected_penalty == "yes") {
					var amount = document.getElementById("amount").value.replace(/\./g, '');
					var amount = amount.replace("Rp ", "");

					<?php
					foreach ($listStudent as $student) {
					?>
						if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
							var penalty = <?= $student->penalty ?>;
						}
					<?php
					}
					?>

					document.getElementById("amount").value = parseInt(amount) + parseInt(penalty);
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
				}

				if (document.getElementById("amount").value != "") {
					var amount = document.getElementById("amount").value.replace(/\./g, '');
					amount = amount.replace("Rp ", "");
					if (parseInt(amount) < 0) {
						amount = 0;
					}
				} else {
					var amount = 0;
				}

				if (document.getElementById("vamount").value != "") {
					var vamount = document.getElementById("vamount").value.replace(/\./g, '');
					vamount = vamount.replace("Rp ", "");
					document.getElementById("amount").value = parseInt(amount) - parseInt(vamount);
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
				}
			}
		<?php
		}
		?>
		// }
	});

	function changeMethod() {
		var amount = document.getElementById("total").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");

		if (document.getElementById("method").value == "CASH") {
			$("#dtrfdate").hide(750);
			$("#dbank").hide(750);
			$("#dcut").hide(750);
			$("#dnumber").hide(750);

		} else if (document.getElementById("method").value == "BANK TRANSFER") {
			$("#dtrfdate").hide(750);
			$("#dnumber").show(750);
			$("#dbank").hide(750);
			$("#dcut").hide(750);
		} else if (document.getElementById("method").value == "DEBIT") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);
			$("#dtrfdate").hide(750);
			if (document.getElementById("bank").value == "BCA Card") {
				paymentcut = parseInt(amount) * 0.15 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 1 / 100;
			}
		} else if (document.getElementById("method").value == "CREDIT" || document.getElementById("method").value == "MASTER CARD" || document.getElementById("method").value == "VISA CARD" || document.getElementById("method").value == "BCA CARD") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);
			$("#dtrfdate").hide(750);
			if (document.getElementById("bank").value == "BCA CARD") {
				paymentcut = parseInt(amount) * 0.9 / 100;
			} else if (document.getElementById("bank").value == "AMERICAN EXPRESS") {
				paymentcut = parseInt(amount) * 3.25 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 2 / 100;
			}
		} else if (document.getElementById("method").value == "SWITCHING CARD") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);
			$("#dtrfdate").hide(750);
			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.75 / 100;
			}
		} else if (document.getElementById("method").value == "QRIS") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);

			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.6 / 100;
			}
		}

		document.getElementById("paymentcut").value = parseInt(paymentcut);
		document.getElementById("paymentcut").value = "Rp " + FormatDuit(document.getElementById("paymentcut").value);
	}

	function changeBank() {
		var amount = document.getElementById("total").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");

		if (document.getElementById("method").value == "DEBIT") {
			if (document.getElementById("bank").value == "BCA CARD") {
				paymentcut = parseInt(amount) * 0.15 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 1 / 100;
			}
		} else if (document.getElementById("method").value == "CREDIT") {
			if (document.getElementById("bank").value == "BCA CARD") {
				paymentcut = parseInt(amount) * 0.9 / 100;
			} else if (document.getElementById("bank").value == "AMERICAN EXPRESS") {
				paymentcut = parseInt(amount) * 3.25 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 2 / 100;
			}
		} else if (document.getElementById("method").value == "SWITCHING CARD") {
			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.75 / 100;
			}
		} else if (document.getElementById("method").value == "QRIS") {
			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.6 / 100;
			}
		}

		document.getElementById("paymentcut").value = parseInt(paymentcut);
		document.getElementById("paymentcut").value = "Rp " + FormatDuit(document.getElementById("paymentcut").value);
	}

	$("#example3").submit(function() {
		// $(this).preventDefault();
		var example3 = document.getElementById("example3");
		var paytab = document.getElementById("paytab");
		var recordnum = 0;

		for (var i = 1, row; row = paytab.rows[i]; i++) {
			var fieldname = "name";
			var fieldname = fieldname.concat(i);
			var value = row.cells[0].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "level";
			var fieldname = fieldname.concat(i);
			var value = row.cells[1].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "payment";
			var fieldname = fieldname.concat(i);
			var value = row.cells[2].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "month";
			var fieldname = fieldname.concat(i);
			var value = row.cells[3].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "voucher";
			var fieldname = fieldname.concat(i);
			var value = row.cells[4].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "amount";
			var fieldname = fieldname.concat(i);
			var value = row.cells[5].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "studentid";
			var fieldname = fieldname.concat(i);
			var value = row.cells[7].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			recordnum = recordnum + 1;
		}

		var fieldname = "recordnum";
		var field = document.createElement("INPUT");
		field.setAttribute("type", "hidden");
		field.setAttribute("name", fieldname);
		field.setAttribute("value", recordnum);
		example3.appendChild(field);

		var amount = document.getElementById("total").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");
		var paymentcut = document.getElementById("paymentcut").value.replace(/\./g, '');
		paymentcut = paymentcut.replace("Rp ", "");
		document.getElementById("total").value = parseInt(amount) - parseInt(paymentcut);
		document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);
		// alert('Add regular payment successful.');
	});

	var idprint = <?= $idprint; ?>;

	function Printdata() {
		my_window = window.open("<?= $url; ?>" + idprint, "mywindow", "status=1,width=0,height=10");
		setTimeout(function() {
			my_window.close();
		}, 100000);
	}
	if (idprint > 0) {
		$(document).ready(function() {
			Printdata();
		});
	}
</script>