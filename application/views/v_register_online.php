<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>U&I | Payment System</title>
	<link rel="icon" type="image/jpg" href="<?php echo base_url() ?>assets/dist/img/ui3.jpg" />
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<style type="text/css">
		.signature-pad {
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 100%;
			height: 260px;
		}

		/* Custom Scrollbar untuk Modal */
		.modal-body.custom-scrollbar {
			max-height: 60vh;
			overflow-y: auto;
		}

		.modal-body.custom-scrollbar::-webkit-scrollbar {
			width: 5px;
		}

		.modal-body.custom-scrollbar::-webkit-scrollbar-thumb {
			background: #3c8dbc;
			border-radius: 10px;
		}

		/* Styling Konten Modal */
		.terms-title {
			font-weight: 800;
			color: #333;
			margin-top: 0;
		}

		.terms-section-header {
			color: #3c8dbc;
			font-weight: bold;
			border-bottom: 2px solid #f4f4f4;
			padding-bottom: 5px;
			margin-bottom: 15px;
		}

		.text-justify {
			text-align: justify;
		}

		/* Footer Modal */
		.modal-footer-custom {
			padding: 20px;
			background: #f9f9f9;
			border-top: 1px solid #eee;
		}

		.agreement-box {
			background: #fff;
			padding: 15px;
			border: 1px solid #ddd;
			border-radius: 8px;
			margin-bottom: 15px;
		}

		.terms-section {
			padding: 0 10px;
		}

		.modal-header .close {
			font-size: 30px;
			/* Agar tombol close lebih mudah ditekan di HP */
		}
	</style>
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<img src="<?php echo base_url() ?>assets/dist/img/logouniV1.png" width="275">
			<br />
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<?php if (isset($error)) : ?>
				<p class="login-box-msg">
					<font color="red"><?= $error ?></font>
				</p>
			<?php else : ?>
				<p class="login-box-msg">Register</p>
			<?php endif; ?>

			<?php if ($this->session->flashdata('success') != null) : ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?= $this->session->flashdata('success') ?>
				</div>
			<?php else : ?>
			<?php endif; ?>


			<form action="<?php echo base_url() ?>OnlineRegistration/store" method="post">
				<div class="form-group has-feedback">
					<label for="">Student's Full Name</label>
					<input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="">Parent's Name</label>
					<input type="text" class="form-control" placeholder="Enter Parent Name" name="parent_name" value="<?php echo set_value('parent_name'); ?>" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group<!--has-feedback-->">
					<label for="">Phone Number</label>
					<div class="input-group">
						<div class="input-group-addon">62</div>
						<input type="number" class="form-control" placeholder="Enter Phone" name="phone" id="phone" onKeyPress="if(this.value.length==13) return false;" value="<?php echo set_value('phone') ? set_value('phone') : ''; ?>" required>
						<div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
						<!--<span class="glyphicon glyphicon-phone form-control-feedback"></span>-->
					</div>
					<div style="color:red">
						<?php echo form_error('phone'); ?>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="">Address</label>
					<input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php echo set_value('address'); ?>" required>
					<span class="glyphicon glyphicon-home form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="">School</label>
					<input type="text" class="form-control" placeholder="Enter School" name="school" value="<?php echo set_value('school'); ?>" required>
					<span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="">Grade</label>
					<input type="text" class="form-control" placeholder="Enter Grade" name="grade" value="<?php echo set_value('grade'); ?>" required>
					<span class="glyphicon glyphicon-blackboard form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="">Birth Day</label>
					<select class="form-control select2" style="width: 100%;" name="date" required>
						<option selected="selected" disabled="disabled" value="">-- Choose Date --</option>
						<?php
						for ($i = 1; $i <= 31; $i++) {
							$selected = set_value('date') == $i ? 'selected' : '';
						?>
							<option value="<?= $i ?>" <?= $selected ?>><?= $i ?></option>
						<?php
						}
						?>
					</select>
					<!-- <span class="glyphicon glyphicon-phone form-control-feedback"></span> -->
				</div>
				<div class="form-group has-feedback">
					<label for="">Birth Month</label>
					<select class="form-control select2" style="width: 100%;" name="month" required>
						<option selected="selected" disabled="disabled" value="">-- Choose month --</option>
						<?php
						$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
						foreach ($months as $month) {
							$selected = set_value('month') == $month ? 'selected' : '';
						?>
							<option value="<?= $month ?>" <?= $selected ?>><?= $month ?></option>
						<?php
						}
						?>
					</select>
					<!-- <span class="glyphicon glyphicon-phone form-control-feedback"></span> -->
				</div>
				<div class="form-group has-feedback">
					<label for="">Birth Year</label>
					<input type="number" class="form-control" placeholder="Enter Birthday Year" name="year" value="<?php echo set_value('year'); ?>" required>
					<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="">U&I Location</label>
					<select name="branch_id" class="form-control select2" style="width: 100%;" id="">
						<option value="">-- Choose Location --</option>
						<option value="1">Surabaya</option>
						<option value="2">Denpasar</option>
					</select>
					<span class=" form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="">How Do You Know U&I English Course</label>
					<select class="form-control select2" style="width: 100%;" name="know" onchange="selectOther()" id="know" required>
						<option selected="selected" disabled="disabled" value="">-- Choose one --</option>
						<?php
						$options = array("Friend", "Family", "Passing By", "Website", "Other");
						foreach ($options as $opt) {
							$selected = set_value('know') == $opt ? 'selected' : '';
						?>
							<option value="<?= $opt ?>" <?= $selected ?>><?= $opt ?></option>
						<?php
						}
						?>
					</select>
					<!-- <span class="glyphicon glyphicon-phone form-control-feedback"></span> -->
				</div>
				<div class="form-group has-feedback" id="others">
					<label for="">Other</label>
					<input type="text" class="form-control" placeholder="Enter Other" name="others" value="<?php echo set_value('others'); ?>">
					<!-- <span class="glyphicon glyphicon-phone form-control-feedback"></span> -->
				</div>
				<div class="form-group has-feedback">
					<label for="">Signature</label>
					<div style="color:red">
						<?php echo form_error('signature'); ?>
					</div>
					<canvas id="signature-pad" class="signature-pad"></canvas>
					<input type="hidden" name="signature" id="signature">
					<button type="button" class="btn btn-default btn-sm" id="undo"><i class="fa fa-undo"></i> Undo</button>
					<button type="button" class="btn btn-danger btn-sm" id="clear"><i class="fa fa-eraser"></i> Clear</button>
					<button type="button" class="btn btn-primary btn-sm" id="save-png"><i class="fa fa-save"></i> Save</button>
					<!-- <span class="glyphicon glyphicon-phone form-control-feedback"></span> -->
				</div>
				<div class="row">
					<!-- /.col -->
					<div class="col-xs-4">
						<!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button> -->
						<button type="button" id="btnShowTerms" class="btn btn-primary btn-block btn-flat">Register</button>
					</div>
					<div class="col-xs-4">
						<button type="reset" class="btn btn-secondary btn-block btn-flat">Reset</button>
					</div>
					<!-- /.col -->
				</div>
			</form>


		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="border-radius: 15px; overflow: hidden;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title terms-title text-primary"><i class="fa fa-shield"></i> SYARAT & KETENTUAN LAYANAN</h4>
					<small class="text-uppercase" style="letter-spacing: 1px;">U&I English Course</small>
				</div>
				<div class="modal-body custom-scrollbar">
					<div class="terms-content" style="font-size: 13px; line-height: 1.6; color: #333;">

						<div class="section-container" style="margin-bottom: 25px;">
							<h5 class="terms-section-header" style="color: #3c8dbc; font-weight: bold; border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 15px;">I. AKADEMIK & OPERASIONAL</h5>
							<div style="text-align: justify; white-space: pre-line;">
								a) Penempatan Level: Tingkatan kelas yang ditentukan berdasarkan hasil placement test awal bersifat final. Segala bentuk perpindahan ke tingkat yang lebih tinggi wajib mengikuti prosedur resmi jump level yang telah ditetapkan oleh U&I ENGLISH COURSE.
								b) Kebijakan Bahasa (Full English Policy): Seluruh proses belajar-mengajar di U&I ENGLISH COURSE dilaksanakan sepenuhnya menggunakan bahasa Inggris (Full English). Siswa/i diwajibkan untuk berkomunikasi dengan menggunakan Bahasa Inggris kepada guru dan staff selama berada di area U&I ENGLISH COURSE. U&I ENGLISH COURSE tidak menerapkan metode pembelajaran bilingual atau penggunaan dua bahasa dalam instruksi kelas maupun penyampaian materi akademiknya.
								c) Kalender Akademik & Event: Orang tua/wali dan siswa/i menyatakan setuju untuk mengikuti seluruh ketetapan kalender akademik, termasuk hari libur lembaga serta seluruh acara resmi yang diselenggarakan oleh U&I ENGLISH COURSE.
								d) Kewajiban Penggunaan Aplikasi Portal: Seluruh orang tua/wali wajib menggunakan aplikasi portal resmi U&I ENGLISH COURSE sebagai pusat informasi utama yang mencakup kalender akademik, kehadiran, nilai, tagihan, dan bukti pembayaran elektronik (e-receipt). Demi efisiensi, administrasi U&I ENGLISH COURSE tidak melayani penyampaian informasi rutin tersebut secara manual atau personal. U&I ENGLISH COURSE tidak bertanggung jawab atas ketertinggalan informasi yang disebabkan oleh kelalaian orang tua/wali dalam mengecek aplikasi secara berkala, kecuali dalam hal penyampaian informasi darurat yang mendadak atau apabila sedang terjadi gangguan teknis pada sistem aplikasi U&I ENGLISH COURSE.
								e) Penggantian Pengajar: Apabila guru utama berhalangan hadir, pihak lembaga akan selalu menugaskan pengajar pengganti (substitute teacher) sehingga kegiatan kelas dipastikan tetap berjalan normal sesuai jadwal tanpa adanya pembatalan sepihak dari U&I ENGLISH COURSE.
								f) Durasi & Transisi Kelas: Guna memastikan kelancaran waktu transisi antar kelas, kelas dengan durasi 1 jam akan diakhiri 5 menit lebih awal, sedangkan kelas berdurasi 2 jam akan diakhiri 10 menit lebih awal. Waktu tersebut didedikasikan sepenuhnya sebagai masa transisi pengajar agar kelas selanjutnya dapat dipersiapkan dan dimulai tepat pada waktunya.
								g) Acara Khusus (Special Events): Sebagai sarana pembelajaran interaktif, U&I ENGLISH COURSE menyelenggarakan acara khusus maksimal 3 kali setahun dengan alokasi waktu kelas selama kurang lebih 1 jam. Siswa Reguler otomatis berpartisipasi dan ketidakhadiran atau ketidakikutsertaan siswa/i dalam acara ini tidak dapat diuangkan (refund) maupun diganti dengan kelas lain. Sedangkan siswa Privat tidak diwajibkan mengikuti namun wajib memberikan konfirmasi kehadiran terlebih dahulu jika ingin berpartisipasi.
								h) Kebijakan Poin: Poin yang sudah ditukarkan dengan souvenir tidak dapat dikembalikan (non-refundable) dalam bentuk poin maupun uang tunai.
								i) Klaim Poin Prestasi (Achievement Points): Siswa/i dapat mengajukan poin tambahan untuk prestasi Bahasa Inggris di luar lembaga dengan menyerahkan bukti fisik asli (kertas ulangan harian, sumatif, ulangan tengah semester, ulangan akhir resmi sekolah atau sertifikat lomba) maksimal 3 bulan sejak tanggal prestasi yang tertera. Perlu diperhatikan bahwa klaim poin hanya berlaku untuk prestasi yang diraih setelah siswa/i berstatus aktif sebagai murid U&I ENGLISH COURSE, sehingga segala bentuk prestasi yang diperoleh sebelum tanggal pendaftaran resmi tidak dapat diklaim.
								j) Rekomendasi & Kalibrasi Tingkat Akademik: Apabila hasil observasi guru menunjukkan ketidaksiapan siswa/i untuk naik ke tingkat selanjutnya, U&I ENGLISH COURSE akan memberikan rekomendasi level yang sesuai; namun jika orang tua/wali tetap menghendaki kenaikan tingkat, pemantauan dilakukan hingga pelaksanaan Test 1, di mana jika nilai tidak mencapai KKM maka siswa/i akan direkomendasikan kembali untuk pindah level, dan apabila tetap ditolak, maka segala risiko kegagalan atau ketidaktuntasan akademik di akhir tingkat tersebut sepenuhnya menjadi tanggung jawab mandiri orang tua/wali.
								k) Prosedur Loncat Tingkat (Jump Level): Fasilitas jump level hanya diperbolehkan maksimal sebanyak 2 (dua) kali per murid selama masa pendidikan di U&I ENGLISH COURSE. Sebelum proses jump level diadakan, harus mendapatkan rekomendasi dari guru kelas serta persetujuan resmi dari pihak manajemen U&I ENGLISH COURSE. Batasan 2 kali tersebut hanya diperbolehkan 1 kali di setiap kategori tingkatan level. Jika permohonan jump level disetujui dan tes telah dilaksanakan, maka hasil dari tes jump level tersebut bersifat mutlak serta final.
								l) [Kelas Privat] Karakteristik Kelas: Program kelas privat tidak menyelenggarakan ujian (test) dan tidak menyediakan sertifikat kelulusan bagi siswa/i.
								m) [Kelas Privat] Prioritas Jam Operasional: Rentang waktu Senin–Jumat pukul 15.00 – 19.00 dan Sabtu pukul 08.00 – 14.00 diprioritaskan secara mutlak untuk Kelas Reguler. Penempatan Kelas Privat pada rentang waktu tersebut bersifat kondisional, di mana U&I ENGLISH COURSE berhak penuh untuk memindahkan jadwal Kelas Privat ke slot waktu lain apabila ketersediaan pengajar dan ruangan pada jam tersebut dibutuhkan untuk Kelas Reguler.
							</div>
						</div>

						<div class="section-container" style="margin-bottom: 25px;">
							<h5 class="terms-section-header" style="color: #3c8dbc; font-weight: bold; border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 15px;">II. KETENTUAN PEMBAYARAN & BIAYA</h5>
							<div style="text-align: justify; white-space: pre-line;">
								a) Penggunaan Promosi: Promosi pendaftaran yang berlaku hanya diperuntukkan bagi calon siswa/i yang belum pernah terdaftar di U&I ENGLISH COURSE.
								b) Ketentuan Hari Libur: Biaya SPP bulanan bersifat tetap dan tidak ada pengurangan harga meskipun terdapat libur panjang, seperti libur Lebaran, atau libur akhir tahun, sesuai dengan kalender akademik yang telah ditetapkan U&I ENGLISH COURSE.
								c) Pembayaran di Muka & Kebijakan Refund: Pembayaran SPP di muka (in advance) dibatasi maksimum untuk jangka waktu 3 (tiga) bulan. Jika siswa/i berhenti di tengah periode tersebut, pengembalian dana (refund) hanya diberikan untuk bulan-bulan yang belum berjalan yang akan diproses maksimal dalam 7 hari kerja. Biaya untuk bulan yang sedang berjalan atau sudah berjalan dianggap hangus dan tidak dapat dikembalikan.
								d) Periode Pembayaran & Pengingat: Biaya kursus bulanan (SPP) sangat disarankan untuk dilunasi pada tanggal 1 – 10 setiap bulannya. Administrasi akan mengirimkan pengingat pertama (first reminder) pada tanggal 11 dan pengingat kedua (second reminder) pada tanggal 16 setiap bulannya. Apabila tanggal tersebut bertepatan dengan hari libur, pengingat akan dikirimkan pada hari kerja berikutnya.
								e) [Kelas Reguler] Ketentuan Denda: Untuk Kelas Reguler, pembayaran yang dilakukan mulai tanggal 21 ke atas dikenakan denda administratif sebesar 10% dari biaya SPP per siswa/i secara mutlak meskipun bertepatan dengan hari libur.
								f) Penangguhan Belajar: Jika tagihan belum lunas hingga akhir bulan berjalan, siswa/i tidak diperkenankan mengikuti kelas mulai tanggal 1 pada bulan berikutnya. Seluruh tunggakan tetap wajib dilunasi sebagai syarat sah pengunduran diri dari U&I ENGLISH COURSE.
								g) Penyesuaian Tarif SPP: Biaya kursus bulanan (SPP) mengacu pada tarif resmi yang sedang berlaku. Tarif ini pada dasarnya bersifat stabil. Namun, guna menjaga kualitas pendidikan dalam jangka panjang, U&I ENGLISH COURSE dapat melakukan penyesuaian harga pada tahun ajaran tertentu. Apabila terdapat perubahan tarif di masa depan, informasi resmi akan disampaikan selambat-lambatnya 1 (satu) bulan sebelum kebijakan tersebut diterapkan.
								h) [Kelas Privat] Ketentuan Denda: Untuk semua program Kelas Privat, pembayaran yang dilakukan mulai tanggal 1 pada bulan berikutnya dikenakan denda administratif sebesar 5% dari biaya SPP per siswa/i secara mutlak meskipun bertepatan dengan hari libur.
								i) [Kelas Privat] Diskon Pembayaran: Tersedia potongan biaya sebesar 5% khusus untuk kelas privat yang dilunasi pada rentang tanggal 1 – 10 setiap bulannya, namun diskon ini tidak berlaku untuk program TOEIC, TOEFL, IELTS, dan kelas Irregular.
								j) [Kelas Privat] Sesi Tambahan: Penambahan jam kelas privat di luar jadwal semula (Irregular Private) dikenakan biaya tambahan sebesar Rp 120.000,- per jam.
								k) [Kelas Privat] Ketentuan Presensi Rendah: Apabila total kehadiran siswa kelas privat dalam dua bulan berturut-turut kurang dari 50%, maka U&I ENGLISH COURSE berhak mencabut slot waktu (hari & jam) tetap siswa/i tersebut dan mengalihkannya untuk siswa/i lain. Siswa/i yang bersangkutan wajib mengatur ulang jadwal baru yang menyesuaikan dengan ketersediaan pengajar.
							</div>
						</div>

						<div class="section-container" style="margin-bottom: 25px;">
							<h5 class="terms-section-header" style="color: #3c8dbc; font-weight: bold; border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 15px;">III. KEHADIRAN, JADWAL & FORMAT KELAS</h5>
							<div style="text-align: justify; white-space: pre-line;">
								a) [Kelas Reguler] Ketentuan Absensi: Karena sistem pendidikan U&I ENGLISH COURSE berbasis kurikulum terjadwal, tidak disediakan kelas pengganti (make-up class) apabila siswa/i kelas reguler berhalangan hadir dengan alasan apa pun.
								b) Kriteria Kehadiran Siswa: Siswa/i dinyatakan hadir (present) apabila berada di dalam ruang kelas serta mengikuti seluruh rangkaian kegiatan belajar-mengajar secara aktif dari awal hingga akhir sesi.
								c) Kebijakan Penggunaan Gawai: Demi menjaga suasana belajar yang kondusif, guru memiliki wewenang untuk menyimpan sementara gawai (smartphone/tablet) milik siswa/i yang tetap menggunakan perangkat tersebut setelah diberikan 3 (tiga) kali peringatan lisan, dan gawai tersebut akan dikembalikan segera setelah sesi kelas berakhir.
								d) Batas Tanggung Jawab Penjemputan: U&I ENGLISH COURSE resmi tutup pada pukul 20.00 (Senin – Jumat) dan pukul 14.00 (Sabtu). Apabila terjadi keterlambatan penjemputan saat gerbang utama sudah harus ditutup, staf U&I ENGLISH COURSE hanya memiliki tanggung jawab untuk menemani siswa/i di luar gedung maksimal selama 15 (lima belas) menit setelah jam tutup. Lebih dari durasi tersebut, keamanan dan keselamatan siswa/i di luar area gedung sepenuhnya merupakan tanggung jawab orang tua/wali.
								e) Pendampingan Orang Tua (Pretoddle 1 – Toddle 1): Khusus bagi siswa/i tingkat Pretoddle 1 hingga Toddle 1, orang tua atau wali sangat direkomendasikan untuk mendampingi di dalam kelas hingga siswa/i dinilai mandiri oleh guru guna membantu kebutuhan personal siswa/i yang berada di luar kapasitas instruksional guru demi menjaga kelancaran proses belajar bagi seluruh siswa.
								f) [Kelas Privat] Ketentuan Pembatalan: Pembatalan jadwal (cancellation) yang dilakukan dalam waktu kurang dari 3 (tiga) jam sebelum kelas dimulai karena alasan atau kondisi apa pun akan tetap dihitung sebagai sesi hangus (charge) dan biaya sesi tetap dikenakan secara penuh, kecuali terdapat ketetapan force majeure yang dinyatakan secara resmi oleh U&I ENGLISH COURSE.
								g) [Kelas Privat] Perubahan Format: Siswa/i yang terdaftar dalam program Kelas Privat tatap muka (offline) tidak diperbolehkan untuk mengubah format pembelajaran menjadi daring (online) dalam kondisi apa pun, dan larangan ini bersifat mutlak serta tidak terikat dengan ketentuan batas waktu pembatalan jadwal, kecuali terdapat ketetapan force majeure yang dinyatakan secara resmi oleh U&I ENGLISH COURSE.
							</div>
						</div>

						<div class="section-container" style="margin-bottom: 25px;">
							<h5 class="terms-section-header" style="color: #3c8dbc; font-weight: bold; border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 15px;">IV. FASILITAS, KEAMANAN & SISTEM POIN</h5>
							<div style="text-align: justify; white-space: pre-line;">
								a) Ketentuan Buku Pelajaran: Siswa/i hanya diperbolehkan untuk membeli buku sesuai dengan program yang diikuti saat itu. Orang tua atau siswa/i tidak diperkenankan untuk menggunakan buku bekas maupun membeli buku untuk level lain di luar program aktif guna mencegah penyalahgunaan materi pembelajaran dan menjaga standar kualitas pendidikan U&I ENGLISH COURSE.
								b) Privasi & Komunikasi Staf: Orang tua/wali tidak diperbolehkan untuk meminta nomor kontak pribadi, akun media sosial, atau jalur komunikasi pribadi lainnya milik guru maupun staf U&I ENGLISH COURSE. Seluruh komunikasi terkait akademik maupun administrasi wajib dilakukan melalui jalur komunikasi resmi lembaga. Pelanggaran akan dikenakan sanksi sesuai dengan prosedur yang berlaku.
								c) Larangan Transaksi Komersial: Siswa/i, orang tua, maupun wali murid dilarang melakukan aktivitas jual-beli dan promosi barang atau jasa dalam bentuk apa pun di dalam gedung U&I ENGLISH COURSE kecuali penitipan penjualan makanan/ minuman yang disetujui oleh pihak kantin.
								d) Tanggung Jawab Fasilitas: Siswa/i, orang tua, maupun wali murid bersedia menanggung biaya perbaikan atau penggantian jika siswa/i terbukti merusak properti atau fasilitas U&I ENGLISH COURSE akibat kelalaian maupun kesengajaan. Segala bentuk biaya parkir yang ditagih oleh pihak eksternal di sekitar area lembaga berada sepenuhnya di luar tanggung jawab U&I ENGLISH COURSE.
								e) Barang Tertinggal (Lost and Found): Barang yang tertinggal di area lembaga akan disimpan dalam kategori Lost and Found. Siswa/i atau orang tua yang ingin mengklaim barang wajib memberikan informasi identitas pengambil yang lengkap kepada administrasi. Apabila barang tidak diklaim hingga pergantian tahun, maka barang tersebut sepenuhnya menjadi hak U&I ENGLISH COURSE untuk didonasikan kepada pihak luar.
								f) Pengawasan CCTV: Demi menjamin keamanan dan keselamatan, U&I ENGLISH COURSE mengoperasikan sistem CCTV di seluruh area gedung dan ruang kelas. Seluruh data rekaman bersifat rahasia dan merupakan hak milik eksklusif internal pengelola. Orang tua/wali tidak diperkenankan meminta salinan (copy) rekaman, dan peninjauan rekaman hanya dapat dilakukan di bawah pengawasan langsung manajemen jika terjadi keadaan darurat yang mendesak.
							</div>
						</div>

						<div class="section-container" style="margin-bottom: 25px;">
							<h5 class="terms-section-header" style="color: #3c8dbc; font-weight: bold; border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 15px;">V. STATUS NON-AKTIF & PENDAFTARAN ULANG</h5>
							<div style="text-align: justify; white-space: pre-line;">
								a) Kriteria Non-Aktif: Siswa/i otomatis dianggap berhenti (non-aktif) apabila absen tanpa kabar selama 1 (satu) bulan penuh, atau memiliki tunggakan pembayaran yang melewati batas akhir bulan berjalan.
								b) Kewajiban Tunggakan: Seluruh tunggakan tetap wajib dilunasi sebagai syarat sah pengunduran diri dari U&I ENGLISH COURSE. Siswa/i yang masih memiliki tunggakan tidak diperbolehkan bergabung kembali sampai seluruh kewajiban tersebut dilunasi.
								c) Prosedur Daftar Ulang: Siswa yang sudah berstatus non-aktif dan ingin kembali bergabung wajib mengikuti prosedur pendaftaran. Siswa yang berhenti dalam kurun waktu 1-3 bulan wajib membayar biaya pendaftaran. Siswa yang berhenti lebih dari 3 bulan wajib mengikuti tes penempatan (placement test) ulang dan membayar biaya pendaftaran.
							</div>
						</div>

						<div class="section-container" style="margin-bottom: 25px;">
							<h5 class="terms-section-header" style="color: #3c8dbc; font-weight: bold; border-bottom: 2px solid #f4f4f4; padding-bottom: 5px; margin-bottom: 15px;">VI. KETENTUAN UMUM & HAK LEMBAGA</h5>
							<div style="text-align: justify; white-space: pre-line;">
								a) Hak Penolakan Layanan: U&I ENGLISH COURSE berhak penuh untuk menolak atau menghentikan layanan pendidikan apabila terjadi pelanggaran ketentuan, ketidaksepahaman serius dengan orang tua/wali, atau jika siswa dinilai membutuhkan penanganan khusus (special needs) yang berada di luar kapasitas, kualifikasi, dan fasilitas tenaga pendidik U&I ENGLISH COURSE.
								b) Keadaan Memaksa (Force Majeure): Dalam situasi darurat di luar kendali lembaga (force majeure), format pembelajaran akan dialihkan dari tatap muka (offline) menjadi daring (online). Perubahan darurat ini tidak memunculkan kewajiban pengembalian dana (refund) kepada pihak siswa/i.
								c) Pembaruan Aturan: U&I ENGLISH COURSE berhak menyesuaikan peraturan di masa mendatang. Setiap perubahan akan diinformasikan sebelumnya, dan melanjutkan penggunaan jasa U&I ENGLISH COURSE dianggap sebagai bentuk persetujuan terhadap aturan baru.
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer-custom">
					<div class="agreement-box">
						<div class="checkbox" style="margin:0;">
							<label style="font-weight: 600; font-size: 12px; color: #555;">
								<input type="checkbox" id="checkAgree"> Saya menyatakan bahwa seluruh data yang diisi adalah benar, serta saya selaku Orang Tua/Wali/Siswa/i telah membaca dan menyetujui Syarat & Ketentuan Layanan <strong>U&I ENGLISH COURSE</strong>.
							</label>
						</div>
					</div>

					<!-- download terms -->
					<a href="<?php echo base_url() ?>assets/TNC.pdf" target="_blank" style="display: inline-block; margin-top: 10px; margin-bottom: 15px;">
						<button class="btn btn-info">
							<i class="fa fa-download"></i> Download Syarat & Ketentuan
						</button>
					</a>

					<div class="row">
						<div class="col-xs-4">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Batal</button>
						</div>
						<div class="col-xs-8">
							<button type="button" id="btnAcceptTerms" class="btn btn-primary btn-block disabled" disabled>SETUJU & LANJUTKAN</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery 3 -->
	<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
	<script>
		$(function() {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		});
		var canvas = document.getElementById('signature-pad');

		// Adjust canvas coordinate space taking into account pixel ratio,
		// to make it look crisp on mobile devices.
		// This also causes canvas to be cleared.
		function resizeCanvas() {
			// When zoomed out to less than 100%, for some very strange reason,
			// some browsers report devicePixelRatio as less than 1
			// and only part of the canvas is cleared then.
			var ratio = Math.max(window.devicePixelRatio || 1, 1);
			canvas.width = canvas.offsetWidth * ratio;
			canvas.height = canvas.offsetHeight * ratio;
			canvas.getContext("2d").scale(ratio, ratio);
		}

		window.onresize = resizeCanvas;
		resizeCanvas();

		var signaturePad = new SignaturePad(canvas, {
			backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
		});

		document.getElementById('save-png').addEventListener('click', function() {
			if (signaturePad.isEmpty()) {
				alert("Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.");
			} else {
				var data = signaturePad.toDataURL('upload/signature');
				$("#signature").val(data);
				console.log(data);
			}
		});

		document.getElementById('clear').addEventListener('click', function() {
			signaturePad.clear();
		});

		document.getElementById('undo').addEventListener('click', function() {
			var data = signaturePad.toData();
			if (data) {
				data.pop(); // remove the last dot or line
				signaturePad.fromData(data);
			}
		});

		$('#others').hide();

		function selectOther() {
			var know = $('#know').val();
			if (know == 'Other') {
				$('#others').show();
			} else {
				$('#others').hide();
			}
		}

		$(document).ready(function() {
			var registrationForm = $('form[action*="OnlineRegistration/store"]');

			// Pastikan iCheck terinisialisasi untuk checkbox di dalam modal
			$('#checkAgree').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				increaseArea: '20%'
			});

			// 1. Munculkan modal saat tombol Register diklik
			$('#btnShowTerms').on('click', function() {
				var name = $('input[name="name"]').val();
				if (name == "") {
					alert("Silahkan isi nama lengkap siswa terlebih dahulu.");
					return;
				}
				$('#termsModal').modal('show');
			});

			// 2. LOGIKA ICHECK: Gunakan 'ifChanged' agar terdeteksi
			$('#checkAgree').on('ifChanged', function(event) {
				if ($(this).is(':checked')) {
					$('#btnAcceptTerms').removeClass('disabled').removeAttr('disabled');
				} else {
					$('#btnAcceptTerms').addClass('disabled').attr('disabled', 'disabled');
				}
			});

			// 3. Eksekusi Submit Form saat tombol Setuju diklik
			$('#btnAcceptTerms').on('click', function() {
				if (signaturePad.isEmpty()) {
					alert("Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.");
					$('#termsModal').modal('hide');
				} else {
					// Ambil data tanda tangan terbaru
					var data = signaturePad.toDataURL('image/png');
					$("#signature").val(data);

					// Kirim form
					registrationForm.submit();
				}
			});
		});
	</script>
</body>

</html>