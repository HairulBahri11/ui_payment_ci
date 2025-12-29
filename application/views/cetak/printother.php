<?php
$this->load->library("PDF_JavaScript");
$width = 80 - 2;
$height = 200;
$ln = 5;
class PDF_AutoPrint extends PDF_JavaScript
{
	function AutoPrint($printer = '')
	{
		// Open the print dialog
		if ($printer) {
			$printer = str_replace('\\', '\\\\', $printer);
			$script = "var pp = getPrintParams();";
			$script .= "pp.interactive = pp.constants.interactionLevel.full;";
			$script .= "pp.printerName = '$printer'";
			$script .= "print(pp);";
		} else
			$script = 'print(true);';
		$this->IncludeJS($script);
	}
}
$pdf = new PDF_AutoPrint('P', 'mm', array($width, $height));
$pdf->AddPage();
$margin = 8;
$width = $width - (2 * $margin);
$pdf->SetLeftMargin($margin - 1);
$pdf->SetFont('Arial', 'B', 18);
$pdf->ln(-9);
// Tambahkan background gambar
$pdf->Image('assets/logoui.png', 28, 0, 20, 20);
$pdf->ln(15);
// $pdf->Cell($width, 5, 'U&I', 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, 'ENGLISH COURSE', 0, 0, 'C', false);
$pdf->SetFont('Arial', '', 10);
$pdf->ln($ln);
$pdf->Cell($width, 5, 'Sutorejo Prima Utara PDD 18-19', 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, 'Surabaya', 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, '031-58204040/58207070', 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, str_pad("", $width + 20, "-"), 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, $pay->paytime, 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, $pay->username, 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, 'NO. ' . $pay->id, 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, str_pad("", $width + 20, "-"), 0, 0, 'C', false);
$pdf->ln($ln);
$pdf->Cell($width, 5, 'INVOICE', 0, 0, 'C', false);
$query1 = "select py.total, py.method, py.number, py.bank, py.trfdate, pd.id, pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, SUM(pd.amount) as subtotal, s.name, p.program, pd.explanation
                           FROM paydetail pd
                           INNER JOIN student s ON pd.studentid = s.id
                           INNER JOIN price p ON s.priceid = p.id
                           INNER JOIN payment py ON pd.paymentid = py.id
                           WHERE pd.paymentid = " . $id . "
                           GROUP BY pd.studentid";
$row1 = $this->db->query($query1)->result();
$total = 0;
foreach ($row1 as $data1) {
	$pdf->ln($ln);
	$pdf->Cell($width / 2, 5, 'ID', 0, 0, 'L', false);
	$pdf->Cell($width / 2, 5, $data1->studentid, 0, 0, 'R', false);
	$pdf->ln($ln);
	$pdf->Cell($width / 2, 5, 'NAME', 0, 0, 'L', false);
	$pdf->Cell($width / 2, 5, $data1->name, 0, 0, 'R', false);
	$pdf->ln($ln);
	$pdf->Cell($width / 2, 5, 'LEVEL', 0, 0, 'L', false);
	$pdf->Cell($width / 2, 5, $data1->program, 0, 0, 'R', false);
	$pdf->ln($ln);
	$pdf->Cell($width / 2, 5, 'METHOD', 0, 0, 'L', false);
	$pdf->Cell($width / 2, 5, $data1->method, 0, 0, 'R', false);
	if ($data1->method == 'DEBIT' || $data1->method == 'CREDIT' || $data1->method == 'SWITCHING CARD' || $data1->method == 'QRIS') {
		$pdf->ln($ln);
		$pdf->Cell($width / 2, 5, 'BANK', 0, 0, 'L', false);
		$pdf->Cell($width / 2, 5, $data1->bank, 0, 0, 'R', false);
		$pdf->ln($ln);
		$pdf->Cell($width / 2, 5, 'NUMBER', 0, 0, 'L', false);
		$pdf->Cell($width / 2, 5, $data1->number, 0, 0, 'R', false);
	} else {
		$pdf->ln($ln);
		$pdf->Cell($width / 2, 5, 'TRANSFER DATE', 0, 0, 'L', false);
		$pdf->Cell($width / 2, 5, $data1->trfdate, 0, 0, 'R', false);
	}



	$query2 = "select pd.id, pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, s.name, p.program, pd.explanation
                       FROM paydetail pd
                       INNER JOIN student s ON pd.studentid = s.id
                       INNER JOIN price p ON s.priceid = p.id
                       WHERE pd.paymentid = " . $data1->paymentid . " and pd.studentid = " . $data1->studentid;
	$row2 = $this->db->query($query2)->result();
	$i = 0;
	foreach ($row2 as $data2) {
		$pdf->ln($ln);
		if ($i == 0) {
			$pdf->Cell($width / 2, 5, 'PAYMENT', 0, 0, 'L', false);
		} else {
			$pdf->Cell($width / 2, 5, '', 0, 0, 'L', false);
		}
		if ($data2->category == 'COURSE') {
			$var = $data2->monthpay;
			$parts = explode('-', $var);
			$monthpay =  date("M", strtotime($data2->monthpay));
			$yearpay =  date("y", strtotime($data2->monthpay));
			$pdf->Cell($width / 2, 5, $data2->category . " ( " . $monthpay . " " . $yearpay . " )", 0, 0, 'R', false);
		} else {
			$pdf->Cell($width / 2, 5, $data2->category, 0, 0, 'R', false);
		}
		$pdf->ln($ln);
		$pdf->Cell($width / 2, 5, '', 0, 0, 'L', false);
		$pdf->Cell($width / 2, 5, "Rp. " . number_format($data2->amount, 0, ',', '.') . ",00", 0, 0, 'R', false);
		$total += $data2->amount;
		$i++;
	}
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->ln($ln);
$pdf->Cell($width / 2, 5, 'Sub Total', 0, 0, 'L', false);
$pdf->Cell($width / 2, 5, "Rp. " . number_format($total, 0, ',', '.') . ",00", 0, 0, 'R', false);

$pdf->ln(10);
$pdf->Cell($width / 2, 5, 'Total', 0, 0, 'L', false);
$pdf->Cell($width / 2, 5, "Rp. " . number_format($data1->total, 0, ',', '.') . ",00", 0, 0, 'R', false);
$pdf->ln($ln + 2);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell($width, 5, 'Thank You', 0, 0, 'C', false);
$pdf->AutoPrint();
$pdf->Output();
