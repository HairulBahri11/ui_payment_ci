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
			<th>No.</th>
			<!--<th>Number of Guest Book</th>-->
			<th>Name of Student</th>
			<!--<th>Parent Name</th>-->
			<th>Phone Number</th>
			<th>Address</th>
			<th>School</th>
			<th>Birth Day</th>
			<th>How Do You Know U&I English Course</th>
			<th>Grade</th>
			<!--<th>Kind of Test</th>-->
			<!--<th>Placement Test</th>-->
			<th>Result</th>
			<th>Reg.Date</th>
		</tr>
		<!--<tr>-->
		<!--	<th rowspan="2">Date</th>-->
		<!--	<th rowspan="2">Recomended Level</th>-->
		<!--</tr>-->
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($listStudent->result() as $key => $value) {
			$query = $this->db->query("SELECT * FROM paydetail WHERE studentid = " . $value->id . " && category = 'COURSE' ORDER BY monthpay DESC")->result();
		?>
			<tr>
				<td><?= $no++ ?></td>
				<!--<td><? //echo $value->staff_name ?></td>-->
				<td><?= $value->name ?></td>
				<!--<td><?= $value->parent_name ?></td>-->
				<td><?= "'".$value->parent_phone ?></td>
				<td><?= $value->address ?></td>
				<td><?= $value->school ?></td>
				<td><?= $value->birthday ?></td>
				<td><?= $value->know ?></td>
				<td><?= $value->grade ?></td>
				<!--<td><? //echo $value->kind_of_test ?></td>-->
				<!--<td><?php //echo $value->date_test != null ? date('d M', strtotime($value->date_test)) : '' ?></td>-->
				<!--<td><?php // echo $value->placement_test_result ?></td>-->
				<td><?= $value->result . " " . substr($value->dayone, 0, 3) . " " . substr($value->daytwo, 0, 3) . " " . $value->course_time . " " . $value->teacher_name ?></td>
				<td><?php
					if ($query != null) {
						echo date('l, d F Y', strtotime($value->entrydate));
					} else {
						echo "";
					}
					?></td>
			</tr>
		<?php 			} ?>
	</tbody>

</table>