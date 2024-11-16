<style>
	table,
	th,
	td {
		border: 1px solid black;
	}
</style>
<table id="example1" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<!-- <th>No</th> -->
			<th>Date</th>
			<th>No Nota</th>
			<th>Name</th>
			<th>Payment Method</th>
			<th>Date/TC</th>
			<th>Level</th>
			<th>Month</th>
			<th>Register Fee</th>
			<th>Book</th>
			<th>Agenda Book</th>
			<th>Point Book</th>
			<th>Course Fee</th>
			<th>Exercise Book</th>
			<th>Total Pay</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		$arr = [
			"date" => [],
			"no_nota" => [],
			"name" => [],
		];
		if (isset($listTransaction)) {
			foreach ($listTransaction as $row) {
				$var = $row->paydate;
				$parts = explode('-', $var);
				$paydate = $parts[2] . '/' . $parts[1];
				$paydetail = $this->mpaydetail->getPaymentByPaymentId($row->id);
				$prv = $row->explanation;
				$query = $this->db->query("SELECT COUNT(*) as countpy
											FROM paydetail
											WHERE paymentid = '" . $row->id . "'");
				$result = $query->num_rows();
				$this->db->select("paydetail.*, s.name, p.program");
				$this->db->from("paydetail");
				$this->db->join("student as s", 's.id = paydetail.studentid');
				$this->db->join("price as p", 'p.id = s.priceid');
				$this->db->where('paymentid', $row->id);
				$count = $this->db->count_all_results();
				foreach ($paydetail->result() as $key => $value) { 
					$arrPayment[$key] = [];
					$arr['date'] =$paydate;
					$arr['no_nota'] = $row->id;
					$arr['name'] =  $value->name;
					// if (in_array($row->id, $arr)) {
					// 	echo 'a';
					// } else {
					// 	echo 'b';
					// }
					
					// echo '<pre>';
					// print_r($arr);
					;?>
					<tr>
						<td><?= $paydate ?></td>
						<td><?= $row->id ?></td>
						<td>
							<?= $value->name ?>
						</td>
						<td>
							<?php if ($row->method == 'CASH') { ?>
								<font><?= $row->method ?></font>
							<?php } else { ?>
								<font color='blue'><?= $row->method ?></font>
							<?php } ?>
						</td>
						<td>
							<?= $row->method == 'BANK TRANSFER' ? $row->trfdate : $row->number ?>
						</td>
						<td><?= $row->program ?></td>
						<td>
							<?php if ($row->level != 'Private') {
								if ($value->monthpay == $var) {
									echo "<font color='black'>" . date('M', strtotime($value->monthpay)) . "</font>";
								} else {
									echo "<font color='red'>" . date('M', strtotime($value->monthpay)) . "</font>";
								}
							} else {
								echo $prv;
							}
							?>
						</td>
						<td>Rp <?= number_format($row->regist, 0, ".", ".") ?></td>
						<td>Rp <?= number_format($row->book, 0, ".", ".") ?></td>
						<td>Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
						<td>Rp <?= number_format($row->point_book, 0, ".", ".") ?></td>
						<td>Rp <?= number_format($value->category == 'COURSE' ? $value->amount : 0, 0, ".", ".") ?></td>
						<td>Rp <?= number_format($row->exercise, 0, ".", ".") ?></td>
						<td style="background-color: greenyellow;">Rp <?= number_format($value->grand_total, 0, ".", ".") ?></td>
					</tr>
		<?php }
			}
		}
		?>
	</tbody>

</table>
