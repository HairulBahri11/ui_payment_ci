<?php
    $server = "localhost";
	$user = "root";
	$password = "lalasenja2";
	$database = "reminder";

// 	// Koneksi dan memilih database di server
    $mysqli = new mysqli($server, $user, $password, $database);


    //over plan date
    $email_from = "aldi.quarterback@gmail.com";
    $email_to = "";
    $email_subject = "";
    $email_message = "";
    $headers = "";
    $date = date('Y-m-d');
    $parts = explode('-',$date);
	$datenow = $parts[2] . '/' . $parts[1] . '/' . $parts[0];

    $result = $mysqli->query("SELECT * FROM master_project");
    $hasil = $result->num_rows;
    while($row = mysqli_fetch_array($result))	
    {
        $cekover = 0;
        $email_subject = "Email Notifikasi Project " . $row['name'] . " Payment Over Plan Date pada tanggal ".$datenow;

        $result1 = $mysqli->query("SELECT * FROM master_phase WHERE projectid = ".$row['id']."");
        $hasil1 = $result1->num_rows;
        while($row1 = mysqli_fetch_array($result1))	
        {
            if($date > $row1['plandate']){
                $cekover = 1;
            }
        }

        if($cekover == 1) {
            $var = $row['pic'];
            $picparts = explode(',',$var);
            foreach ($picparts as $pic) {
                $email_message = "Dear Mr./Miss " . $pic . ",<br /><br />";
                $email_message .= "Berikut ini detail Project " . $row['name'] . " beserta tahapan fase dan payment :<br /><br />";
                $email_message .= "<table cellpadding='2'>";
                $email_message .= "<tbody>";
                $email_message .= "<tr>";
                $email_message .= "<td>Project ID</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['id'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Project Name</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['name'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Customer</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['customer'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Project Type</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['jenis'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Currency</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['currency'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Total Amount</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . number_format($row['amount'], 0, ".", ".") . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Start Date</td>";
                $email_message .= "<td>:</td>";
                $var = $row['startdate'];
                $parts = explode('-',$var);
                $startdate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                $email_message .= "<td>" . $startdate . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Estimated End Date</td>";
                $email_message .= "<td>:</td>";
                $var = $row['enddate'];
                $parts = explode('-',$var);
                $enddate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                $email_message .= "<td>" . $enddate . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Status</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['status'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "</tbody>";
                $email_message .= "</table><br /><br />";

                $email_message .= "<table border='1' cellpadding='3'>";
                $email_message .= "<thead>";
                $email_message .= "<tr>";
                $email_message .= "<th>No</th>";
                $email_message .= "<th>Phase</th>";
                $email_message .= "<th>Invoice</th>";
                $email_message .= "<th>Invoice Amount</th>";
                $email_message .= "<th>Outstanding Amount</th>";
                $email_message .= "<th>Progress</th>";
                $email_message .= "<th>Plan Finished Date</th>";
                $email_message .= "<th>Due Date</th>";
                $email_message .= "<th>Status</th>";
                $email_message .= "</tr>";
                $email_message .= "</thead>";
                $email_message .= "<tbody>";
                $i = 1;

                $result1 = $mysqli->query("SELECT * FROM master_phase WHERE projectid = ".$row['id']."");
                $hasil1 = $result1->num_rows;
                while($row1 = mysqli_fetch_array($result1))	
                {
                    $email_message .= "<tr>";
                    $email_message .= "<td>".$i."</td>";
                    $email_message .= "<td>".$row1['description']."</td>";
                    $email_message .= "<td>".$row1['inv_no']."</td>";
                    $email_message .= "<td>".number_format($row1['target'], 0, ".", ".")."</td>";
                    $email_message .= "<td>".number_format($row1['outstanding'], 0, ".", ".")."</td>";
                    $email_message .= "<td>".$row1['progress']."%</td>";
                    $var = $row1['plandate'];
                    $parts = explode('-',$var);
                    $plandate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                    $email_message .= "<td>".$plandate."</td>";
                    $var = $row1['duedate'];
                    $parts = explode('-',$var);
                    $duedate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                    $email_message .= "<td>".$duedate."</td>";
                    $email_message .= "<td>".$row1['status']."</td>";
                    $email_message .= "</tr>";
                    echo $row1['description'];
                    $i = $i + 1;
                }

                $email_message .= "</tbody>";
                $email_message .= "</table><br />";

                $email_message .= "Untuk informasi lebih detail dapat dilihat pada <a href=http://localhost:46/bvr/paymentreport>link</a> berikut ini.<br /><br />";

                $email_message .= "Regards,<br />Aldila Hilman.";

                $headers = "From: ".$email_from."\r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

                $result2 = $mysqli->query("SELECT userid FROM employee WHERE name = '" . $pic . "'");
                while($row2 = mysqli_fetch_array($result2))	{
                    $email_to = $row2['userid'];
                    mail($email_to, $email_subject, $email_message, $headers); 
                    sleep(2);
                }
            }
        }
	}


    //overdue
    $email_from = "aldi.quarterback@gmail.com";
    $email_to = "";
    $email_subject = "";
    $email_message = "";
    $headers = "";
    $date = date('Y-m-d');
    $parts = explode('-',$date);
	$datenow = $parts[2] . '/' . $parts[1] . '/' . $parts[0];

    $result = $mysqli->query("SELECT * FROM master_project");
    $hasil = $result->num_rows;
    while($row = mysqli_fetch_array($result))	
    {
        $cekover = 0;
        $email_subject = "Email Notifikasi Project " . $row['name'] . " Payment Overdue pada tanggal ".$datenow;

        $result1 = $mysqli->query("SELECT * FROM master_phase WHERE projectid = ".$row['id']."");
        $hasil1 = $result1->num_rows;
        while($row1 = mysqli_fetch_array($result1))	
        {
            if($date > $row1['duedate']){
                $cekover = 1;
            }
        }

        if($cekover == 1) {
            $var = $row['pic'];
            $picparts = explode(',',$var);
            foreach ($picparts as $pic) {
                $email_message = "Dear Mr./Miss " . $pic . ",<br /><br />";
                $email_message .= "Berikut ini detail Project " . $row['name'] . " beserta tahapan fase dan payment :<br /><br />";
                $email_message .= "<table cellpadding='2'>";
                $email_message .= "<tbody>";
                $email_message .= "<tr>";
                $email_message .= "<td>Project ID</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['id'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Project Name</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['name'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Customer</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['customer'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Project Type</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['jenis'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Currency</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['currency'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Total Amount</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . number_format($row['amount'], 0, ".", ".") . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Start Date</td>";
                $email_message .= "<td>:</td>";
                $var = $row['startdate'];
                $parts = explode('-',$var);
                $startdate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                $email_message .= "<td>" . $startdate . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Estimated End Date</td>";
                $email_message .= "<td>:</td>";
                $var = $row['enddate'];
                $parts = explode('-',$var);
                $enddate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                $email_message .= "<td>" . $enddate . "</td>";
                $email_message .= "</tr>";
                $email_message .= "<tr>";
                $email_message .= "<td>Status</td>";
                $email_message .= "<td>:</td>";
                $email_message .= "<td>" . $row['status'] . "</td>";
                $email_message .= "</tr>";
                $email_message .= "</tbody>";
                $email_message .= "</table><br /><br />";

                $email_message .= "<table border='1' cellpadding='3'>";
                $email_message .= "<thead>";
                $email_message .= "<tr>";
                $email_message .= "<th>No</th>";
                $email_message .= "<th>Phase</th>";
                $email_message .= "<th>Invoice</th>";
                $email_message .= "<th>Invoice Amount</th>";
                $email_message .= "<th>Outstanding Amount</th>";
                $email_message .= "<th>Progress</th>";
                $email_message .= "<th>Plan Finished Date</th>";
                $email_message .= "<th>Due Date</th>";
                $email_message .= "<th>Status</th>";
                $email_message .= "</tr>";
                $email_message .= "</thead>";
                $email_message .= "<tbody>";
                $i = 1;

                $result1 = $mysqli->query("SELECT * FROM master_phase WHERE projectid = ".$row['id']."");
                $hasil1 = $result1->num_rows;
                while($row1 = mysqli_fetch_array($result1))	
                {
                    $email_message .= "<tr>";
                    $email_message .= "<td>".$i."</td>";
                    $email_message .= "<td>".$row1['description']."</td>";
                    $email_message .= "<td>".$row1['inv_no']."</td>";
                    $email_message .= "<td>".number_format($row1['target'], 0, ".", ".")."</td>";
                    $email_message .= "<td>".number_format($row1['outstanding'], 0, ".", ".")."</td>";
                    $email_message .= "<td>".$row1['progress']."%</td>";
                    $var = $row1['plandate'];
                    $parts = explode('-',$var);
                    $plandate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                    $email_message .= "<td>".$plandate."</td>";
                    $var = $row1['duedate'];
                    $parts = explode('-',$var);
                    $duedate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                    $email_message .= "<td>".$duedate."</td>";
                    $email_message .= "<td>".$row1['status']."</td>";
                    $email_message .= "</tr>";
                    echo $row1['description'];
                    $i = $i + 1;
                }

                $email_message .= "</tbody>";
                $email_message .= "</table><br />";

                $email_message .= "Untuk informasi lebih detail dapat dilihat pada <a href=http://localhost:46/bvr/paymentreport>link</a> berikut ini.<br /><br />";

                $email_message .= "Regards,<br />Aldila Hilman.";

                $headers = "From: ".$email_from."\r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

                $result2 = $mysqli->query("SELECT userid FROM employee WHERE name = '" . $pic . "'");
                while($row2 = mysqli_fetch_array($result2))	{
                    $email_to = $row2['userid'];
                    mail($email_to, $email_subject, $email_message, $headers); 
                    sleep(2);
                }
            }
        }
	}

?>