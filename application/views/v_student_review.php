<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Student Inactive Review
			<small>check student inactive explanation </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="#">inactive</a></li>
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
							<!-- <a href="#" id="btnSend"><button class="btn btn-primary btn-lg"><i class="fa fa-whatsapp" aria-hidden="true">&nbsp;</i>&nbsp;Broadcast</button></a> -->
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Student Id</th>
										<th>Name</th>
										<th>Last Program</th>
										<th>Why student inactive</th>
										<th>Date Inactive</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($listStudentReview as $row) {
									?>
										<tr>
											<td><?= $row->id ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->program ?></td>
											<td><?= $row->category_name ?></td>
											<td><?= date_format(date_create($row->date_inactive), "d F Y") ?></td>


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

<script>
	$(document).ready(function() {
		$("#btnSend").click(function() {
			var listId = [];
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

			return {
				id: student.id,
				name: student.name,
				phone: updatedPhone, // Perbarui phone dengan input terbaru
				lastpaydate: studentMonthPay,
			};
		}
	});
</script>