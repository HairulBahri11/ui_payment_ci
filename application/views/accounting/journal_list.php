<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Journal Entry</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Journal</li>
		</ol>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Journal Entries</h3>
				<div class="box-tools pull-right">
					<?php echo form_open('accounting/journal', ['method' => 'post', 'class' => 'form-inline']); ?>
					<input type="date" name="date" class="form-control" required value="<?= $date ?>">
					<button class="btn btn-success">Search</button>
					<!--					<a href="--><?php //= base_url('accounting/createJournal') 
														?><!--" class="btn btn-primary">-->
					<!--						<i class="fa fa-plus"></i> Add Entry-->
					<!--					</a>-->
					<?php echo form_close(); ?>
				</div>
			</div>

			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="110px">Date</th>
								<th>Description</th>
								<th>Ref</th>
								<th>Debit</th>
								<th>Credit</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $entry): ?>
								<?php foreach ($entry['detail'] as $k => $detail): ?>
									<tr <?= $k == 0 ? 'style="background-color:#3c8dbc; color:white"' : '' ?>>
										<td><?= $k == 0 ? date('d-m-Y', strtotime($entry['tanggal'])) : '' ?></td>
										<td <?= $detail->keterangan == 'lawan' ? 'align="center"' : '' ?>>
											<?= $detail->nama_akun ?>
										</td>
										<td><?= $detail->no_akun ?></td>

										<?php if ($detail->tipe == 'KREDIT'): ?>
											<td></td>
											<td class="text-right">Rp. <?= number_format($detail->jumlah, 0, '.', '.') ?></td>
										<?php else: ?>
											<td class="text-right">Rp. <?= number_format($detail->jumlah, 0, '.', '.') ?></td>
											<td></td>
										<?php endif; ?>


									</tr>
								<?php endforeach; ?>
								<tr>
									<th colspan="2"><?= $entry['deskripsi'] ?></th>
									<th colspan="4"></th>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>