<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Profit and Loss</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Profit and Loss</li>
		</ol>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Profit and Loss</h3>
				<div class="box-tools pull-right">
					<!-- <?php echo form_open('accounting/profit_loss', ['method' => 'post', 'class' => 'form-inline']); ?>
					<label>Pilih Bulan : </label>&nbsp;
					<select data-plugin-selectTwo class="form-control select2" name="month" id="month" required>
						<option value="">--Select Month--</option>
						<option value="01" <?= $month == '01' ? 'selected' : '' ?> >January</option>
						<option value="02" <?= $month == '02' ? 'selected' : '' ?> >February</option>
						<option value="03" <?= $month == '03' ? 'selected' : '' ?> >March</option>
						<option value="04" <?= $month == '04' ? 'selected' : '' ?> >April</option>
						<option value="05" <?= $month == '05' ? 'selected' : '' ?> >May</option>
						<option value="06" <?= $month == '06' ? 'selected' : '' ?> >June</option>
						<option value="07" <?= $month == '07' ? 'selected' : '' ?> >July</option>
						<option value="08" <?= $month == '08' ? 'selected' : '' ?> >August</option>
						<option value="09" <?= $month == '09' ? 'selected' : '' ?> >September</option>
						<option value="10" <?= $month == '10' ? 'selected' : '' ?> >October</option>
						<option value="11" <?= $month == '11' ? 'selected' : '' ?> >November</option>
						<option value="12" <?= $month == '12' ? 'selected' : '' ?> >December</option>
					</select>
					&nbsp;
					<select data-plugin-selectTwo class="form-control select2" name="year" id="year" required>
						<option value="">--Select Year--</option>
						<?php
						for ($i = date('Y') - 3; $i <= date('Y'); $i++):
						?>
						<option value="<?= $i ?>" <?= $year == $i ? 'selected' : '' ?> > <?= $i ?></option>
						<?php
						endfor;
						?>
					</select>
					<button class="btn btn-success">Search</button>

					<?php echo form_close(); ?> -->


					<?php echo form_open('accounting/profit_loss', ['method' => 'post', 'class' => 'form-inline']); ?>
					<label>Start Date: </label>&nbsp;
					<input type="date" class="form-control" name="start_date" id="start_date" value="<?= isset($start_date) ? $start_date : '' ?>" required>
					&nbsp;
					<label>End Date: </label>&nbsp;
					<input type="date" class="form-control" name="end_date" id="end_date" value="<?= isset($end_date) ? $end_date : '' ?>" required>
					&nbsp;
					<button class="btn btn-success">Search</button>
					<?php echo form_close(); ?>
				</div>
			</div>

			<!-- <div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead style="background-color:#3c8dbc; color:white">
						<tr>
							<th>Income</th>
							<th width="20%"></th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_revenue = $data['pendapatan'] + $data['pendapatan_denda'];
						?>
						<tr>
							<td>Income</td>
							<td><?= number_format($data['pendapatan'], 0, ',', '.') ?></td>
						</tr>
						<tr>
							<td>Penalty Income</td>
							<td><?= number_format($data['pendapatan_denda'], 0, ',', '.') ?></td>
						</tr>

						<tr bgColor="#cad6e3">
							<td>Total Income</td>
							<td><?= number_format($total_revenue, 0, ',', '.') ?></td>
						</tr>
						</tbody>
					</table>
					<table class="table table-bordered">
						<thead class="mt-3" style="background-color:#3c8dbc; color:white">
						<tr>
							<th>Expenses</th>
							<th width="20%"></th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_expense = 0;
						?>
						<?php
						foreach ($data['detail_pengeluaran'] as $key => $value):
							$total_expense += $value->amount;
						?>
						<tr>
							<td><?= $value->explanation ?> </td>
							<td><?= number_format($value->amount, 0, ',', '.') ?></td>
						</tr>
						<?php
						endforeach;
						$profit_loss = $total_revenue - $total_expense;
						?>
						<tr bgColor="#cad6e3">
							<td>Total Expense</td>
							<td><?= number_format($total_expense, 0, ',', '.') ?> </td>
						</tr>
						</tbody>
					</table>

					<table class="table table-bordered">
						<thead style="background-color:#3c8dbc; color:white">
						<tr>
							<th>Profit & Loss</th>
							<th width="20%"><?= number_format($profit_loss, 0, ',', '.') ?></th>
						</tr>
						</thead>
					</table>
				</div>
			</div> -->


			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead style="background-color:#3c8dbc; color:white">
							<tr>
								<th>Category</th>
								<th colspan="2">Details</th>
								<th width="25%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$categories = ['COURSE', 'BOOK', 'EXERCISE', 'BOOKLET', 'REGISTRATION', 'OTHER'];
							$kalkulasi_card = 0;
							$kalkulasi_bank = 0;
							$kalkulasi_cash = 0;
							?>

							<!-- Loop untuk BANK TRANSFER -->
							<tr style="font-weight:bold;">
								<td>Income</td>
								<td>Transfer Transaction</td>
								<td></td>
								<td rowspan="<?= count($categories) + 1 ?>" style="text-align: center; vertical-align: middle;">
									<?= isset($data['group_income']['BANK TRANSFER'])
										? number_format(array_sum($data['group_income']['BANK TRANSFER']), 0, ',', '.')
										: '0' ?>
								</td>
							</tr>

							<?php foreach ($categories as $category): ?>
								<tr>
									<td></td>
									<td>
										<?= $category === 'BOOK' ? 'Text Book' : ($category === 'EXERCISE' ? 'Exercise Book' : ucwords(strtolower($category))) ?>
									</td>
									<td>
										<?= isset($data['group_income']['BANK TRANSFER']) ? number_format($data['group_income']['BANK TRANSFER'][$category] ?? 0, 0, ',', '.') : 0 ?>
									</td>
								</tr>
							<?php endforeach; ?>

							<!-- Loop untuk CARD -->
							<tr style="font-weight:bold;">
								<td></td>
								<td>Card Transaction</td>
								<td></td>
								<td rowspan="<?= count($categories) + 1 ?>" style="text-align: center; vertical-align: middle;">
									<?= isset($data['group_income']['CARD']) ? number_format(array_sum($data['group_income']['CARD']), 0, ',', '.') : '0' ?>
								</td>
							</tr>
							<?php foreach ($categories as $category): ?>
								<tr>
									<td></td>
									<td>
										<?= $category === 'BOOK' ? 'Text Book' : ($category === 'EXERCISE' ? 'Exercise Book' : ucwords(strtolower($category))) ?>
									</td>
									<td>
										<?= isset($data['group_income']['CARD']) ? number_format($data['group_income']['CARD'][$category] ?? 0, 0, ',', '.') : 0 ?>
									</td>
								</tr>
							<?php endforeach; ?>

							<!-- Loop untuk CASH -->
							<tr style="font-weight:bold;">
								<td></td>
								<td>Cash Transaction</td>
								<td></td>
								<td rowspan="<?= count($categories) + 1 ?>" style="text-align: center; vertical-align: middle;">
									<?= isset($data['group_income']['CASH']) ? number_format(array_sum($data['group_income']['CASH']), 0, ',', '.') : '0' ?>
								</td>
							</tr>
							<?php foreach ($categories as $category): ?>
								<tr>
									<td></td>
									<td>
										<?= $category === 'BOOK' ? 'Text Book' : ($category === 'EXERCISE' ? 'Exercise Book' : ucwords(strtolower($category))) ?>
									</td>
									<td>
										<?= isset($data['group_income']['CASH']) ? number_format($data['group_income']['CASH'][$category] ?? 0, 0, ',', '.') : 0 ?>
									</td>
								</tr>
							<?php endforeach; ?>

							<!-- Penalty Income -->
							<tr>
								<td>Penalty Income</td>
								<td colspan="2"></td>
								<td class="text-center" style="font-weight:bold;">
									<?= number_format($data['pendapatan_denda'], 0, ',', '.') ?>
								</td>
							</tr>

							<?php
							// Calculate total income
							$total_income =
								(isset($data['group_income']['CASH']) ? array_sum($data['group_income']['CASH']) : 0) +
								(isset($data['group_income']['CARD']) ? array_sum($data['group_income']['CARD']) : 0) +
								(isset($data['group_income']['BANK TRANSFER']) ? array_sum($data['group_income']['BANK TRANSFER']) : 0) +
								$data['pendapatan_denda'];
							?>

							<!-- Total Income -->
							<tr bgColor="#cad6e3">
								<td>Total Income</td>
								<td colspan="2"></td>
								<td class="text-center" style="font-weight:bold;">
									<?= number_format($total_income, 0, ',', '.') ?>
								</td>
							</tr>

						</tbody>

					</table>
					<table class="table table-bordered">
						<thead class="mt-3" style="background-color:#3c8dbc; color:white">
							<tr>
								<th>Expenses</th>
								<th width="25%"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_expense = 0;
							?>
							<?php
							foreach ($data['detail_pengeluaran'] as $key => $value):
								$total_expense += $value->amount;
							?>
								<tr>
									<td><?= $value->explanation ?> </td>
									<td><?= number_format($value->amount, 0, ',', '.') ?></td>
								</tr>
							<?php
							endforeach;
							$profit_loss = $total_income - $total_expense;
							?>
							<tr bgColor="#cad6e3">
								<td>Total Expense</td>
								<td class="text-center"><?= number_format($total_expense, 0, ',', '.') ?> </td>
							</tr>
						</tbody>
					</table>

					<table class="table table-bordered">
						<thead style="background-color:#3c8dbc; color:white">
							<tr>
								<th>Profit & Loss</th>
								<th width="25%" class="text-center"><?= number_format($profit_loss, 0, ',', '.') ?></th>
							</tr>
						</thead>
					</table>


				</div>
			</div>


		</div>
	</section>
</div>