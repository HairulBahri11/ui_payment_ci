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
				<!--<td><? //echo $value->staff_name 
						?></td>-->
				<td><?= $value->name ?></td>
				<!--<td><?= $value->parent_names ?></td>-->
				<td><?= "'" . $value->parent_phones ?></td>
				<td><?= $value->address ?></td>
				<td><?= $value->school ?></td>
				<td><?= $value->birthday ?></td>
				<td><?= $value->know ?></td>
				<td><?= $value->grade ?></td>
				<!--<td><? //echo $value->kind_of_test 
						?></td>-->
				<!--<td><?php //echo $value->date_test != null ? date('d M', strtotime($value->date_test)) : '' 
						?></td>-->
				<!--<td><?php // echo $value->placement_test_result 
						?></td>-->
				<td>
					<?php
					$result = isset($value->result) ? $value->result : '-';
					$dayone = isset($value->dayone) ? substr($value->dayone, 0, 3) : '-';
					$daytwo = isset($value->daytwo) ? substr($value->daytwo, 0, 3) : '-';
					$course_time = isset($value->course_time) ? $value->course_time : '-';
					$teacher_name = isset($value->teacher_name) ? $value->teacher_name : '-';
					?>
					<?= "$result $dayone $daytwo $course_time $teacher_name" ?>
				</td>


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