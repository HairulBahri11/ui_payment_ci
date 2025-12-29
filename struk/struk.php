<?php
require('pdf_js.php');
$width = 75 -2;
$height = 110;
$ln = 3;
class PDF_AutoPrint extends PDF_JavaScript
{
	function AutoPrint($printer='')
	{
		// Open the print dialog
		if($printer)
		{
			$printer = str_replace('\\', '\\\\', $printer);
			$script = "var pp = getPrintParams();";
			$script .= "pp.interactive = pp.constants.interactionLevel.full;";
			$script .= "pp.printerName = '$printer'";
			$script .= "print(pp);";
		}
		else
			$script = 'print(true);';
		$this->IncludeJS($script);
	}
}
$pdf = new PDF_AutoPrint('P','mm',array($width,$height));
$pdf->AddPage();
$margin = 4;
$width = $width - (2*$margin);
$pdf->SetLeftMargin($margin-1);
$pdf->SetFont('Arial','B',10);
$pdf->ln(-5);
$pdf->Cell($width,5,'U&I',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,'ENGLISH COURSE',0,0,'C',false);
$pdf->SetFont('Arial','',8);
$pdf->ln($ln);
$pdf->Cell($width,5,'Sutorejo Prima Utara PDD 18-19',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,'Surabaya',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,'031-58204040/58207070',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,str_pad("", $width + 20,"-"),0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,date('d/m/Y H:i:s'),0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,'Front Desk 1',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,'NO. 123456',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,str_pad("", $width + 20 ,"-"),0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width,5,'INVOICE',0,0,'C',false);
$pdf->ln($ln);
$pdf->Cell($width /2,5,'NAME',0,0,'L',false);
$pdf->Cell($width /2,5,'Gabriel Kimiko',0,0,'R',false);
$pdf->ln($ln);
$pdf->Cell($width/2,5,'LEVEL',0,0,'L',false);
$pdf->Cell($width/2,5,'Kid 4',0,0,'R',false);
$pdf->ln($ln);
$pdf->Cell($width/2,5,'METHOD',0,0,'L',false);
$pdf->Cell($width/2,5,'CASH',0,0,'R',false);
$pdf->ln($ln);
$pdf->Cell($width/2,5,'TRANSFER DATE',0,0,'L',false);
$pdf->Cell($width/2,5,'CASH',0,0,'R',false);
$pdf->ln($ln);
$pdf->Cell($width/2,5,'PAYMENT',0,0,'L',false);
$pdf->Cell($width/2,5,'COURSE (May)',0,0,'R',false);
$pdf->ln($ln);
$pdf->Cell($width/2,5,'',0,0,'L',false);
$pdf->Cell($width/2,5,'Rp. 250.000,00',0,0,'R',false);
$pdf->SetFont('Arial','B',8);
$pdf->ln($ln);
$pdf->Cell($width/2,5,'Sub Total',0,0,'L',false);
$pdf->Cell($width/2,5,'Rp. 250.000,00',0,0,'R',false);
$pdf->ln(10);
$pdf->Cell($width/2,5,'Total',0,0,'L',false);
$pdf->Cell($width/2,5,'Rp. 250.000,00',0,0,'R',false);
$pdf->ln($ln + 2);
$pdf->SetFont('Arial','I',8);
$pdf->Cell($width,5,'Thank You',0,0,'C',false);
$pdf->AutoPrint();
$pdf->Output();
?>
