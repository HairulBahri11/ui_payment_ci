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
						<option value="2">Bali</option>
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
						<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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
	</script>
</body>

</html>