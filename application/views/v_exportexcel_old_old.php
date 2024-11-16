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
			<!--<th>No</th> -->
			<!--<th>Date</th>-->
			<th>No Nota</th>
			<th>Name</th>
			<th>Payment Method</th>
			<th>Date/TC</th>
			<th>Level</th>
			<th>Month</th>
			<th>Register Fee</th>
			<th>Book</th>
			<th>Other</th>
			<!-- <th>Agenda Book</th>
			<th>Point Book</th>
			<th>Excercise Book</th>
			<th>Penalty</th> -->

			<th>Course Fee</th>
			<th>Booklet</th>
			<th>Total Pay</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($listTransaction as $key => $value) {
			$queryDetail = $this->db->query("SELECT pd.*, s.name, p.program, p.level, s.id as student_id,
										(SELECT SUM(amount) FROM paydetail WHERE category ='AGENDA' AND studentid = s.id AND paymentid = py.id) as agenda,
										(SELECT SUM(amount) FROM paydetail WHERE category ='COURSE' AND studentid = s.id AND paymentid = py.id) as course,
										(SELECT SUM(amount) FROM paydetail WHERE category ='POINT BOOK' AND studentid = s.id AND paymentid = py.id) as point_book,
										(SELECT SUM(amount) FROM paydetail WHERE category ='BOOK' AND studentid = s.id AND paymentid = py.id) as book,
										(SELECT SUM(amount) FROM paydetail WHERE category ='REGISTRATION' AND studentid = s.id AND paymentid = py.id) as regist,
										(SELECT SUM(amount) FROM paydetail WHERE category ='EXERCISE' AND studentid = s.id AND paymentid = py.id) as exercise,
										(SELECT SUM(amount) FROM paydetail WHERE category ='BOOKLET' AND studentid = s.id AND paymentid = py.id) as booklet,
										-- (SELECT SUM(amount) FROM paydetail WHERE category ='PENALTY' AND studentid = s.id AND paymentid = py.id) as penalty,
										

										FROM paydetail pd
										INNER JOIN student s ON pd.studentid = s.id
										INNER JOIN price p ON p.id = s.priceid
										INNER JOIN payment py ON py.id = pd.paymentid
										WHERE pd.paymentid = '$value->id'
										GROUP BY student_id");
			// GROUP BY MONTH(pd.monthpay),student_id");
			$resultDetail = $queryDetail->result();
			$var = $value->paydate;
			$parts = explode('-', $var);
			$paydate = $parts[2] . '/' . $parts[1];
			$countDetail = count($resultDetail);

			//mencari pembayaran course yang multi bulan dalam satu pembayaran
			$queryGetMonthPay = $this->db->query("SELECT pd.monthpay
										FROM paydetail pd
										INNER JOIN student s ON pd.studentid = s.id
										INNER JOIN price p ON p.id = s.priceid
										INNER JOIN payment py ON py.id = pd.paymentid
										WHERE pd.paymentid = '$value->id'
										AND category = 'COURSE'
										");

			$resultMonthPay = $queryGetMonthPay->result();




			// echo '<pre>';
			// || ($valueDetail->monthpay == null && $valueDetail->point_book != 0) || ($valueDetail->monthpay == null && $valueDetail->regist != 0) || ($valueDetail->monthpay == null && $valueDetail->exercise != 0) || ($valueDetail->monthpay == null && $valueDetail->book != 0)
			// 			<tr>
			//             <th class="tg-0lax" rowspan="2">Nota</th>
			//             <th class="tg-0lax">Nama 1</th>
			//             <th class="tg-0lax">Month 1</th>
			//             <th class="tg-0lax">Period 1</th>
			//             <th class="tg-0lax" rowspan="2">Total pay</th>
			//           </tr>
			//           <tr>
			//             <th class="tg-0lax">Nama 2</th>
			//             <th class="tg-0lax">Month 2</th>
			//             <th class="tg-0lax">Period 2</th>
			//           </tr>
			if ($countDetail > 1) {
				$queryGetMonthPay = $this->db->query("SELECT pd.monthpay
										FROM paydetail pd
										INNER JOIN student s ON pd.studentid = s.id
										INNER JOIN price p ON p.id = s.priceid
										INNER JOIN payment py ON py.id = pd.paymentid
										WHERE pd.paymentid = '$value->id'
										AND category = 'COURSE'
										AND pd.studentid = " . $resultDetail[0]->student_id);

				$resultMonthPay = $queryGetMonthPay->result();

				if (
					$resultDetail[0]->monthpay != null /* false */
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'BOOK')) /* true */
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'POINT BOOK'))
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'AGENDA'))
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'REGISTRATION'))
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'EXERCISE'))
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'BOOKLET'))
					||
					(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'COURSE' && $resultDetail[0]->explanation != null))
				) {
		?>
					<tr>
						<td rowspan="<?= $countDetail ?>"><?= $value->id  ?></td>
						<?php
						// // ambil dua kata terdepan dari nama siswa
						// $student_name = $resultDetail[0]->name;
						// $name = explode(" ", $student_name);
						// $first_two_word = $name[0] . " " . $name[1]; // Concatenate the first two words with a space

						$student_name =
							$resultDetail[0]->name;
						$display_name = '';
						// Split the string into words
						$words = explode(" ", $student_name);

						// Check if the string has more than two words
						if (count($words) >= 2) {
							// Extract the first two words
							$first_two_words = $words[0] . " " . $words[1];
							$display_name = $first_two_words; // Output: "This is"
						} else {
							// If the string has less than two words, output the original string
							$display_name = $student_name;
						}

						?>

						<td><?= $display_name ?></td>
						<td>
							<?php if ($value->method == 'CASH') { ?>
								<font><?= $value->method ?></font>
							<?php } else { ?>
								<font color='blue'><?= $value->method ?></font>
							<?php } ?>
						</td>
						<td>
							<?= $value->method == 'BANK TRANSFER' ? $value->trfdate : $value->number ?>
						</td>
						<td>
							<?= $resultDetail[0]->program ?>
						</td>
						<td>
							<?php if ($resultDetail[0]->level != 'Private') {

								// $month = $valueDetail->monthpay != null ? date('M', strtotime($valueDetail->monthpay)) : '';
								// if ($valueDetail->monthpay == $var) {
								// 	echo "<font color='black'>" . $month . "</font>";
								// } else {
								// 	echo "<font color='red'>" . $month . "</font>";
								// }

								// menampilkan bulan pembayaran, jika bayar untuk lebih dari satu bulan maka akan muncul semua bulan yang dibayar
								if (!empty($resultMonthPay)) {
									foreach ($resultMonthPay as $key => $row) {
										$month = $row->monthpay != null ? date('M', strtotime($row->monthpay)) : '';
										// echo $row->monthpay . ",";
										if (date('m', strtotime($var)) <= date('m', strtotime($row->monthpay))) {
											// gak terlambat = paydate  <= monthpay 
											echo "<font color='black'>" . $month . "</font>";
										} else {
											echo "<font color='red'>" . $month . "</font>";
										}

										if ($key < count($resultMonthPay) - 1) {
											echo ', '; // Add comma
										}
									}
								}
							} else {
								echo $resultDetail[0]->explanation;
							}
							?>
						</td>
						<td>
							<?= number_format($resultDetail[0]->regist, 0, ".", ".") ?>
						</td>
						<td>
							<?= number_format($resultDetail[0]->book, 0, ".", ".") ?>
						</td>

						<!-- perubahan -->
						<td>
							<?= number_format($resultDetail[0]->agenda + $resultDetail[0]->point_book, 0, ".", ".");
							?>
						</td>



						<!-- <td>
        <?php //echo number_format($resultDetail[0]->point_book, 0, ".", ".") 
		?>
      </td> -->
						<td><?= number_format($resultDetail[0]->course, 0, ".", ".") ?>
						</td>
						<td>
							<?= $resultDetail[0]->exercise != 0 ? number_format($resultDetail[0]->exercise, 0, ".", ".") : number_format($resultDetail[0]->booklet, 0, ".", ".") ?>
						</td>
						<td style="background-color: greenyellow;" rowspan="<?= $countDetail ?>">
							Rp <?= number_format($value->total, 0, ".", ".") ?>
						</td>
					</tr>
					<?php
				}
				//   remove first index 
				array_shift($resultDetail);
				foreach ($resultDetail as $keyDetail => $valueDetail) {
					if (
						$valueDetail->monthpay != null
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'BOOK'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'POINT BOOK'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'AGENDA')) || (($valueDetail->monthpay == null && $valueDetail->category == 'REGISTRATION'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'EXERCISE'))
						||
						(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'BOOKLET'))
						||
						(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'COURSE' && $resultDetail[0]->explanation != null))
					) {
					?>
						<tr>
							<!--<td><?= $paydate ?></td>-->
							<?php
							// // ambil dua kata terdepan dari nama siswa
							// $student_name = $resultDetail[0]->name;
							// $name = explode(" ", $student_name);
							// $first_two_word = $name[0] . " " . $name[1]; // Concatenate the first two words with a space

							$student_name =
								$valueDetail->name;
							$display_name = '';
							// Split the string into words
							$words = explode(" ", $student_name);

							// Check if the string has more than two words
							if (count($words) >= 2) {
								// Extract the first two words
								$first_two_words = $words[0] . " " . $words[1];
								$display_name = $first_two_words; // Output: "This is"
							} else {
								// If the string has less than two words, output the original string
								$display_name = $student_name;
							}

							?>

							<td><?= $display_name ?></td>
							<td>
								<?php if ($value->method == 'CASH') { ?>
									<font><?= $value->method ?></font>
								<?php } else { ?>
									<font color='blue'><?= $value->method ?></font>
								<?php } ?>
							</td>
							<td>
								<?= $value->method == 'BANK TRANSFER' ? $value->trfdate : $value->number ?>
							</td>
							<td>
								<?= $valueDetail->program ?>
							</td>
							<td>
								<?php if ($valueDetail->level != 'Private') {
									// $month = $valueDetail->monthpay != null ? date('M', strtotime($valueDetail->monthpay)) : '';
									// if ($valueDetail->monthpay == $var) {
									// 	echo "<font color='black'>" . $month . "</font>";
									// } else {
									// 	echo "<font color='red'>" . $month . "</font>";
									// }

									// menampilkan bulan pembayaran, jika bayar untuk lebih dari satu bulan maka akan muncul semua bulan yang dibayar
									if (!empty($resultMonthPay)) {
										foreach ($resultMonthPay as $key => $row) {
											$month = $row->monthpay != null ? date('M', strtotime($row->monthpay)) : '';
											// echo $row->monthpay . ",";
											if (date('m', strtotime($var)) <= date('m', strtotime($row->monthpay))) {
												// gak terlambat = paydate  <= monthpay 
												echo "<font color='black'>" . $month . "</font>";
											} else {
												echo "<font color='red'>" . $month . "</font>";
											}

											if ($key < count($resultMonthPay) - 1) {
												echo ', '; // Add comma
											}
										}
									}
								} else {
									echo $valueDetail->explanation;
								}
								?>
							</td>
							<td>
								<?= number_format($valueDetail->regist, 0, ".", ".") ?>
							</td>
							<td>
								<?= number_format($valueDetail->book, 0, ".", ".") ?>
							</td>

							<!-- perubahan -->
							<td>
								<?= number_format($resultDetail[0]->agenda + $resultDetail[0]->point_book, 0, ".", ".") ?>
							</td>
							<!-- <td>
        <?php //echo number_format($resultDetail[0]->point_book, 0, ".", ".") 
		?>
      </td> -->
							<td><?= number_format($valueDetail->course, 0, ".", ".") ?></td>
							<td>
								<?= $valueDetail->exercise != 0 ? number_format($valueDetail->exercise, 0, ".", ".") : number_format($valueDetail->booklet, 0, ".", ".") ?>
							</td>
						</tr>
					<?php
					} //end if
				} // end foreach

			} else {
				foreach ($resultDetail as $keyDetail => $valueDetail) {
					if (
						$valueDetail->monthpay != null
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'BOOK'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'POINT BOOK'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'AGENDA'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'REGISTRATION'))
						||
						(($valueDetail->monthpay == null && $valueDetail->category == 'EXERCISE'))
						||
						(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'BOOKLET'))
						||
						(($resultDetail[0]->monthpay == null && $resultDetail[0]->category == 'COURSE' && $resultDetail[0]->explanation != null))
					) {
					?>
						<tr>
							<!--<td><?= $paydate ?></td>-->
							<td><?= $value->id  ?></td>
							<?php
							// // ambil dua kata terdepan dari nama siswa
							// $student_name = $resultDetail[0]->name;
							// $name = explode(" ", $student_name);
							// $first_two_word = $name[0] . " " . $name[1]; // Concatenate the first two words with a space

							$student_name =
								$valueDetail->name;
							$display_name = '';
							// Split the string into words
							$words = explode(" ", $student_name);

							// Check if the string has more than two words
							if (count($words) >= 2) {
								// Extract the first two words
								$first_two_words = $words[0] . " " . $words[1];
								$display_name = $first_two_words; // Output: "This is"
							} else {
								// If the string has less than two words, output the original string
								$display_name = $student_name;
							}

							?>

							<td><?= $display_name ?></td>
							<td>
								<?php if ($value->method == 'CASH') { ?>
									<font><?= $value->method ?></font>
								<?php } else { ?>
									<font color='blue'><?= $value->method ?></font>
								<?php } ?>
							</td>
							<td>
								<?= $value->method == 'BANK TRANSFER' ? $value->trfdate : $value->number ?>
							</td>
							<td>
								<?= $valueDetail->program ?>
							</td>
							<td>
								<?php if ($valueDetail->level != 'Private') {
									// $month = $valueDetail->monthpay != null ? date('M', strtotime($valueDetail->monthpay)) : '';
									// if ($valueDetail->monthpay == $var) {
									// 	echo "<font color='black'>" . $month . "</font>";
									// } else {
									// 	echo "<font color='red'>" . $month . "</font>";
									// }

									// menampilkan bulan pembayaran, jika bayar untuk lebih dari satu bulan maka akan muncul semua bulan yang dibayar
									if (!empty($resultMonthPay)) {
										foreach ($resultMonthPay as $key => $row) {
											$month = $row->monthpay != null ? date('M', strtotime($row->monthpay)) : '';
											// echo $row->monthpay . ",";
											if (date('m', strtotime($var)) <= date('m', strtotime($row->monthpay))) {
												// gak terlambat = paydate  <= monthpay 
												echo "<font color='black'>" . $month . "</font>";
											} else {
												echo "<font color='red'>" . $month . "</font>";
											}

											if ($key < count($resultMonthPay) - 1) {
												echo ', '; // Add comma
											}
										}
									}
								} else {
									echo $valueDetail->explanation;
								}
								?>
							</td>
							<td>
								<?= number_format($valueDetail->regist, 0, ".", ".") ?>
							</td>
							<td>
								<?= number_format($valueDetail->book, 0, ".", ".") ?>
							</td>

							<!-- perubahan -->
							<td>
								<?= number_format($resultDetail[0]->agenda + $resultDetail[0]->point_book, 0, ".", ".") ?>
							</td>
							<!-- <td>
        <?php // echo number_format($valueDetail->agenda, 0, ".", ".") 
		?>
      </td>
      <td>
        <?php // echo number_format($valueDetail->point_book, 0, ".", ".") 
		?>
      </td> -->
							<td> <?= number_format($valueDetail->course, 0, ".", ".") ?></td>
							<td>

								<?= $valueDetail->exercise != 0 ? number_format($valueDetail->exercise, 0, ".", ".") : number_format($valueDetail->booklet, 0, ".", ".") ?>
							</td>
							<td style="background-color: greenyellow;">
								Rp <?= number_format($value->total, 0, ".", ".") ?>
							</td>
						</tr>
			<?php
					} //end if
				} // end foreach

			}

			?>
		<?php
		} // end loop list transaction
		?>
	</tbody>

</table>