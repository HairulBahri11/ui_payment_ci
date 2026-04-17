<!-- Content Wrapper -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Student Late Payment
			<small>check student late payment</small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">

					<div class="box-header">
						<div class="pull-right">
							<a href="#" id="btnSend">
								<button class="btn btn-primary btn-lg">
									<i class="fa fa-whatsapp"></i> Broadcast
								</button>
							</a>
						</div>
					</div>

					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="5%">
											<input type="checkbox" id="checkAll">
										</th>
										<th>Last Payment</th>
										<th>ID</th>
										<th>Student Name</th>
										<th>Class</th>
										<th>Teacher</th>
										<th>WhatsApp Number</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach ($listStudent as $row) { ?>
										<tr>
											<td>
												<input type="checkbox" name="listId[]" value="<?= $row->id ?>">
											</td>

											<td>
												<?= $row->monthpay ? date_format(date_create($row->monthpay), "F Y") : '-(No Payment History)-' ?>
											</td>

											<td><?= $row->id ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->program ?></td>
											<td><?= $row->teacher_name ?: "-" ?></td>

											<td>
												<input type="text" name="phone_<?= $row->id ?>" value="<?= $row->phone ?>" class="form-control">
											</td>
										</tr>
									<?php } ?>
								</tbody>

							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready(function() {

		// =========================
		// HILANGKAN ERROR DATATABLE
		// =========================
		$.fn.dataTable.ext.errMode = 'none';

		var selectedIds = [];

		// =========================
		// INIT DATATABLE
		// =========================
		var table = $('#example1').DataTable({
			destroy: true
		});

		// =========================
		// AUTO CHECK ALL SAAT LOAD (SUPER FIX)
		// =========================
		setTimeout(function() {

			// tampilkan semua row sementara
			var oldLength = table.page.len();
			table.page.len(-1).draw();

			setTimeout(function() {

				$('input[name="listId[]"]').each(function() {
					var id = $(this).val();

					$(this).prop('checked', true);

					if (!selectedIds.includes(id)) {
						selectedIds.push(id);
					}
				});

				$("#checkAll").prop('checked', true);

				// balikin pagination
				table.page.len(oldLength).draw();

				console.log("AUTO SELECT:", selectedIds.length);

			}, 100);

		}, 200);

		// =========================
		// CHECK ALL MANUAL
		// =========================
		$("#checkAll").on('click', function() {
			var isChecked = this.checked;

			$('input[name="listId[]"]').each(function() {
				var id = $(this).val();

				$(this).prop('checked', isChecked);

				if (isChecked) {
					if (!selectedIds.includes(id)) {
						selectedIds.push(id);
					}
				}
			});

			if (!isChecked) {
				selectedIds = [];
			}
		});

		// =========================
		// CHECK PER ITEM
		// =========================
		$('#example1 tbody').on('change', 'input[name="listId[]"]', function() {
			var id = $(this).val();

			if (this.checked) {
				if (!selectedIds.includes(id)) {
					selectedIds.push(id);
				}
			} else {
				selectedIds = selectedIds.filter(function(item) {
					return item != id;
				});
			}

			$("#checkAll").prop(
				'checked',
				selectedIds.length === table.rows().count()
			);
		});

		// =========================
		// SYNC SAAT PINDAH PAGE
		// =========================
		table.on('draw', function() {
			$('input[name="listId[]"]').each(function() {
				var id = $(this).val();
				$(this).prop('checked', selectedIds.includes(id));
			});
		});

		// =========================
		// BUTTON BROADCAST
		// =========================
		$("#btnSend").click(function(e) {
			e.preventDefault();

			var btn = $(this);

			// disable tombol + ubah tampilan
			btn.prop('disabled', true);
			btn.html('<i class="fa fa-spinner fa-spin"></i> Sending...');

			var listId = [];

			selectedIds.forEach(function(id) {
				var studentData = findStudentData(id);
				listId.push(studentData);
			});

			// console.table(listId);
			// return;


			$.ajax({
				url: "<?= base_url() ?>Accounting/broadcast",
				type: "POST",
				data: {
					listId: JSON.stringify(listId)
				},
				success: function(response) {
					alert("Successfully sent broadcast messages");
					window.location.reload();
				},
				error: function() {
					btn.show();
				}
			});

		});

		// =========================
		// FUNCTION AMBIL DATA
		// =========================
		function findStudentData(id) {
			var listStudent = <?php echo json_encode($listStudent); ?>;

			var student = listStudent.find(function(student) {
				return student.id == id;
			});

			var updatedPhone = table.$('input[name="phone_' + id + '"]').val();

			var dateToFormat;

			if (student.monthpay) {
				dateToFormat = new Date(student.monthpay);
			} else {
				dateToFormat = new Date();
				dateToFormat.setMonth(dateToFormat.getMonth() - 1);
			}

			var studentMonthPay = dateToFormat.toLocaleDateString('en-US', {
				month: 'short',
				year: 'numeric'
			});

			return {
				id: student.id,
				name: student.name,
				phone: updatedPhone,
				lastpaydate: studentMonthPay,
			};
		}

	});
</script>