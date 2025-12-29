<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Student Late Payment
			<small>check student late payment </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="#">Late Payment</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<!-- <h3 class="box-title">List Prices</h3> -->
						<div class="pull-right">
							<a href="#" id="btnSend"><button class="btn btn-primary btn-lg"><i class="fa fa-whatsapp" aria-hidden="true">&nbsp;</i>&nbsp;Broadcast</button></a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th width="5%">Check</th>
										<th>Last Payment</th>
										<th>ID</th>
										<th>Student Name</th>
										<th>Class</th>
										<th>Teacher</th>

										<th>WhatsApp Number</th>

									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($listStudent as $row) {
									?>
										<tr>
											<td><input type="checkbox" name="listId[]" value="<?= $row->id ?>"></td>
											<td style=" font-weight: bold">
												<?= $row->monthpay ? date_format(date_create($row->monthpay), "F Y") : '-(No Payment History)-' ?>
											</td>
											<td><?= $row->id ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->program ?></td>
											<td><?= $row->teacher_name == "" ? "-" : $row->teacher_name ?></td>
											<td>
												<input type="text" name="phone_<?= $row->id ?>" value="<?= $row->phone ?>" class="form-control">
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


<!-- page script -->
<!-- <script>
//    get data from checkbox
$(document).ready(function(){
    $("#btnSend").click(function(){
        var listId = [];
        $('input[name="listId[]"]:checked').each(function() {
            var studentId = $(this).val();
            // Cari data siswa berdasarkan id
            var studentData = findStudentData(studentId); // Fungsi untuk mencari data siswa
            listId.push(studentData);
        });

        if(listId.length > 0){
        //    kirimkan datanya ke controller 
        console.log(listId);
        // Redirect ke URL dengan nomor telepon sebagai parameter
			window.location.href = '<?= base_url() ?>Accounting/broadcast/'+ encodeURIComponent(JSON.stringify(listId));
        } else {
            alert("Silakan pilih siswa");
        }
    });

    // Fungsi untuk mencari data siswa berdasarkan id
    function findStudentData(id) {
        // Ambil data siswa dari array global
        var listStudent = <?php echo json_encode($listStudent); ?>;
        // Ambil nilai terbaru dari input phone
         // Cari data siswa di array listStudent
         var student = listStudent.find(function(student) {
            return student.id == id;
        });
        var updatedPhone = $('input[name="phone_' + id + '"]').val();

        // Kembalikan objek siswa dengan nilai phone yang telah diperbarui
        return {
            id: student.id,
            name: student.name,
            phone: updatedPhone,  // Memperbarui phone dengan nilai yang dimasukkan
            lastpaydate: student.monthpay
        };
    }

});
 </script> -->

 <!-- ini sebelumnya -->
<!-- <script>
	$(document).ready(function() {
		$("#btnSend").click(function() {
			var listId = [];
			console.log(listId);

			$('input[name="listId[]"]:checked').each(function() {
				var studentId = $(this).val();
				var studentData = findStudentData(studentId); // Fungsi untuk mencari data siswa
				listId.push(studentData);
			});

			if (listId.length > 0) {
				// Kirimkan datanya ke controller menggunakan AJAX
				$.ajax({
					url: "<?= base_url() ?>Accounting/broadcast",
					type: "POST",
					data: {
						listId: JSON.stringify(listId)
					},
					success: function(response) {
						console.log("Broadcast berhasil:", response);
						alert("Successfully sent broadcast messages");
						window.location.reload();
					},
					error: function(xhr, status, error) {
						console.error("Terjadi kesalahan:", error);
					}
				});
			} else {
				alert("Silakan pilih siswa");
			}
		});

		// Fungsi untuk mencari data siswa berdasarkan id
		function findStudentData(id) {
			var listStudent = <?php echo json_encode($listStudent); ?>;
			var student = listStudent.find(function(student) {
				return student.id == id;
			});
			var updatedPhone = $('input[name="phone_' + id + '"]').val();
			var studentMonthPay = new Date(student.monthpay).toLocaleDateString('en-US', {
				month: 'short',
				year: 'numeric'
			});

			console.log(studentMonthPay);


			return {
				id: student.id,
				name: student.name,
				phone: updatedPhone, // Perbarui phone dengan input terbaru
				lastpaydate: studentMonthPay,
			};
		}
	});
</script> -->
<!-- ini terbaru -->
<script>
    $(document).ready(function() {
        $("#btnSend").click(function() {
            var listId = [];
            console.log(listId);

            $('input[name="listId[]"]:checked').each(function() {
                var studentId = $(this).val();
                var studentData = findStudentData(studentId); // Fungsi untuk mencari data siswa
                listId.push(studentData);
            });

            if (listId.length > 0) {
                // Kirimkan datanya ke controller menggunakan AJAX
                $.ajax({
                    url: "<?= base_url() ?>Accounting/broadcast",
                    type: "POST",
                    data: {
                        listId: JSON.stringify(listId)
                    },
                    success: function(response) {
                        console.log("Broadcast berhasil:", response);
                        alert("Successfully sent broadcast messages");
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjadi kesalahan:", error);
                    }
                });
            } else {
                alert("Silakan pilih siswa");
            }
        });

        // Fungsi untuk mencari data siswa berdasarkan id
        function findStudentData(id) {
            var listStudent = <?php echo json_encode($listStudent); ?>;
            var student = listStudent.find(function(student) {
                return student.id == id;
            });
            var updatedPhone = $('input[name="phone_' + id + '"]').val();

            // --- PERBAIKAN DIMULAI DI SINI ---
            var dateToFormat;

            // Cek jika student.monthpay tidak ada (null, undefined, atau string kosong)
            if (student.monthpay) {
                // Jika ada data monthpay, gunakan data tersebut
                dateToFormat = new Date(student.monthpay);
            } else {
                // Jika tidak ada data monthpay, gunakan tanggal saat ini tapi bulan sebelumnya
                dateToFormat = new Date();
                dateToFormat.setMonth(dateToFormat.getMonth() - 1);
                console.log("monthpay kosong. Menggunakan bulan sebelumnya:", dateToFormat);
            }

            // Format tanggal yang sudah ditentukan
            var studentMonthPay = dateToFormat.toLocaleDateString('en-US', {
                month: 'short',
                year: 'numeric'
            });
            // --- PERBAIKAN BERAKHIR DI SINI ---

            console.log(studentMonthPay);


            return {
                id: student.id,
                name: student.name,
                phone: updatedPhone, // Perbarui phone dengan input terbaru
                lastpaydate: studentMonthPay,
            };
        }
    });
</script>