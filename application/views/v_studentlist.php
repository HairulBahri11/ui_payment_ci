<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Student
			<small>List Students</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Student</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<!-- <h3 class="box-title">List Prices</h3> -->
						<div class="pull-right">
							<a href="<?= base_url() ?>student/addStudent"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i>&nbsp;Add New Student</button></a>
						</div>
						<!-- <div class="pull-left">
							<button class="btn btn-primary" id="showstudentall">ALL</button>&nbsp;<button class="btn btn-success" id="hideInactive">Student Active</button>&nbsp;<button class="btn btn-danger" id="hideActive">Student Inactive</button>
						</div> -->
					</div>
					<br>
					<!-- ambil data dari flash dengan nama alert -->

					<?php if ($this->session->flashdata('alert')): ?>
						<div class="alert alert-success" timeout="100">
							<?php echo $this->session->flashdata('alert'); ?>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
					<?php endif; ?>

					<script>
						setTimeout(() => {
							const alert = document.querySelector('.alert');
							if (alert) {
								alert.style.display = 'none';
							}
						}, 2000); // 3000ms = 3 seconds
					</script>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Telephone</th>
										<th>Birthday</th>
										<!--  <th>Last Payment</th> -->
										<th>Program</th>
										<!--<th>Course Fee</th>-->
										<!-- <th>Note</th> -->
										<th>Status</th>
										<th class="notPrintable" width="10%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php


									foreach ($listStudent->result() as $row) {

									?>

										<tr class="status<?= $row->status ?>">
											<td><?= $row->sid ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->phone ?></td>
											<td><?= $row->birthday ?></td>
											<?php /*
                  if ($row->monthpay != null) {
                    $var = $row->monthpay;
                    $parts = explode('-',$var);
                    $paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                    echo "<td>".$paydate."</td>";
                  }else{
                    echo "<td>-</td>";
                  }*/
											?>
											<?php
											if ($row->program != null) {
												echo "<td>" . $row->program . "</td>";
											} else {
												echo "<td>-</td>";
											}
											?>

											<!-- <td><?= $row->note ?></td> -->


											<?php
											//if ($row->level != "Private") {
											//if ($row->condition == "DEFAULT") {
											?>
											<!--<td><span class="badge bg-yellow">Default: Rp <?= number_format($row->course, 0, ".", ".") ?></span></td>-->
											<?php
											//} elseif ($row->condition == "CHANGE") {
											?>
											<!--<td><span class="badge bg-light-blue">Change: Rp <?= number_format($row->course, 0, ".", ".") ?></span></td>-->
											<?php
											//} else {
											//	echo "<td>-</td>";
											//}
											//} else {
											?>
											<!--<td>-</td>-->
											<?php
											//}
											?>
											<?php
											if ($row->status == "ACTIVE") {
											?>
												<td><span class="badge bg-yellow"><?= $row->status ?></span></td>
											<?php
											} elseif ($row->status == "INACTIVE") {
											?>
												<td><span class="badge bg-red"><?= $row->status ?></span></td>
											<?php
											} else {
												echo "<td>-</td>";
											}
											?>
											<td>
												<a href="<?= base_url() ?>student/updateStudent/<?= $row->sid ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
												<!-- <a data-toggle="modal" data-target="#delModal" onclick="showModalData('<?= $row->sid ?>','<?= $row->name ?>')" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> -->
												<!-- <a data-toggle="modal" data-target="#delModal<?php echo $row->sid; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> -->
												<!-- <a data-toggle="modal" data-target="#showModal<?php echo $row->sid; ?>" href="#" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a> -->
												<a href="<?= base_url('student/detailPayment/') ?><?= $row->sid; ?>/<?= $row->name; ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>

												<?php if ($row->status == "ACTIVE") { ?>
													<a data-toggle="modal"
														data-target="#delModal"
														data-id="<?= $row->sid ?>"
														data-name="<?= $row->name ?>"
														data-program="<?= $row->program ?>"
														data-id_teacher="<?= $row->id_teacher ?>"
														data-status="<?= $row->status ?>"
														href="#"
														class="btn btn-danger btn-xs openModal">
														<i class="fa fa-check"></i>
													</a>
												<?php } else { ?>
													<a href="<?= base_url() ?>student/activateStudent/<?= $row->sid ?>/<?= $row->status ?>"
														class="btn btn-warning btn-xs"
														onclick="return confirm('Are you sure you want to activate or deactivate this student?');">
														<i class="fa fa-check"></i>
													</a>
												<?php } ?>

											</td>
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
				<!-- /.box -->


			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal modal fade" id="delModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="deleteStudentForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalTitle"></h4>
				</div>
				<div class="modal-body">
					<p id="textModal"></p>
					<input type="hidden" name="idstudent" id="idModal" style="color:#000">
					<input type="hidden" name="program" id="programNya" class="form-control">
					<input type="hidden" name="id_teacher" id="id_teacherNya" class="form-control">
					<input type="hidden" name="name" id="name" class="form-control">
					<div class="form-group mt-3">
						<label for="choose_alasan">Why did she/he leave from U&I English Course?</label>
						<select name="review_id" id="choose_alasan" class="form-control">
							<?php
							// Query database
							$data_query = $this->db->get('category_review')->result();

							// Cek apakah ada data
							if (!empty($data_query)) {
								foreach ($data_query as $key => $value) {
							?>
									<option value="<?= $value->id ?>"><?= $value->category_name ?></option>
							<?php
								}
							} else {
								echo '<option value="">No data available</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="date">Date Inactive</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="date" class="form-control pull-right" id="date" name="date">
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->

<!-- <script type="text/javascript">
    function showModalData(id, name, program, id_teacher, status) {
        // Set nilai untuk input form
		// Tampilkan modal
		$('#delModal').modal('show');
        $('#idModal').val(id);
        $('#programNya').val(program);
        $('#id_teacherNya').val(id_teacher);
		$('#nameNya').val(name);

		console.log(status, name, id_teacher, program, id);
		

        // Update form action URL
        const formAction = `<?= base_url() ?>student/activateStudent/${id}/${status}`;
        $('#deleteStudentForm').attr('action', formAction);

        // Set teks di modal jika diperlukan
        $('#textModal').html(`Are you sure to activate or deactivate student: ${name}?`);
    
    }
</script> -->

<script>
	$(document).ready(function() {
		// Ketika tombol dengan class .openModal diklik
		$('.openModal').on('click', function() {
			// Ambil data dari atribut data-*
			const id = $(this).data('id');
			const name = $(this).data('name');
			const program = $(this).data('program');
			const id_teacher = $(this).data('id_teacher');
			const status = $(this).data('status');

			// Debug data ke konsol
			console.log({
				id,
				name,
				program,
				id_teacher,
				status
			});

			// Isi form di dalam modal
			$('#idModal').val(id);
			$('#programNya').val(program);
			$('#id_teacherNya').val(id_teacher);
			$('#name').val(name);

			// Perbarui form action URL di dalam modal
			const formAction = `<?= base_url() ?>student/activateStudent/${id}/${status}`;
			$('#deleteStudentForm').attr('action', formAction);

			// Tampilkan teks konfirmasi di modal
			$('#myModalTitle').html(`Are you sure to deactivate student: ${name}?`);
		});
	});
</script>

<?php
/*foreach ($listStudent->result() as $row) { 
  ?>
  <div class="modal modal-danger fade" id="delModal<?php echo $row->sid;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Student</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete student <?= $row->name ?>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
          <a href="<?= base_url() ?>student/deleteStudentDb/<?= $row->sid ?>"><button type="button" class="btn btn-outline">Delete</button></a>
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

  <?php
/*    foreach ($listStudent->result() as $row) { 
  ?>
  <div class="modal modal-default fade" id="showModal<?php echo $row->sid;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Student Payment List</h4>
        </div>
        <div class="modal-body">
          <table id="examples" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>Nota</th>
              <th>Payment</th>
              <th>Method</th>
              <th>Pay Date</th>
              <th>Amount</th>
              <th>Voucher</th>
            </tr>
            </thead>
            <tbody>
            <?php
              foreach ($listStudentPayment->result() as $payment) { 
                if ($payment->studentid == $row->sid) {
            ?>
            <tr>
              <td><?= $payment->id ?></td>
              <?php
                if ($payment->category == "COURSE" && $payment->monthpay != "") {
                  $var = $payment->monthpay;
                  $parts = explode('-',$var);
                  $monthpay = $parts[1] . '/' . $parts[0]; 
                  $monthpay =  date("M", strtotime($payment->monthpay));
                  $yearpay =  date("y", strtotime($payment->monthpay));
                  $category = $payment->category . " (" . $monthpay . " ". $yearpay . ")";
                } else {
                  $category = $payment->category;
                }
              ?>
              <td><?= $category ?></td>
              <td><?= $payment->method ?></td>
              <?php
                $var = $payment->paydate;
                $parts = explode('-',$var);
                $paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
              ?>
              <td><?= $paydate ?></td>  
              <td>Rp <?= number_format($payment->amount, 0, ".", ".") ?></td>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php
    }*/
?>