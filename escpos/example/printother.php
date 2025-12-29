<?php
/* Print-outs using the newer graphics print command */

require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$connector = new WindowsPrintConnector('KASIR');
$printer = new Printer($connector);
$server = "localhost";
$user = "root";
$password = "";
$database = "uipayment";

// Koneksi dan memilih database di server
$mysqli = new mysqli($server, $user, $password, $database);
// echo $id;
header("Location: http://serverku.dlinkddns.com/u&i/payment/addother", true, 301);

/* Initialize */
$printer -> initialize();

/* Justification */
$justification = array(
    Printer::JUSTIFY_LEFT,
    Printer::JUSTIFY_CENTER,
    Printer::JUSTIFY_RIGHT);
/* Font modes */
$modes = array(
    Printer::MODE_FONT_B,
    Printer::MODE_EMPHASIZED,
    Printer::MODE_DOUBLE_HEIGHT,
    Printer::MODE_DOUBLE_WIDTH,
    Printer::MODE_UNDERLINE);

$bits = str_pad(decbin(6), count($modes), "0", STR_PAD_LEFT);
$mode = 0;
for ($j = 0; $j < strlen($bits); $j++) {
    if (substr($bits, $j, 1) == "1") {
        $mode |= $modes[$j];
    }
}
$printer -> selectPrintMode($mode);
$printer -> setJustification($justification[1]);
$printer -> text("U&I\n");
$printer -> text("ENGLISH COURSE\n");

$bits = str_pad(decbin(0), count($modes), "0", STR_PAD_LEFT);
$mode = 0;
for ($j = 0; $j < strlen($bits); $j++) {
    if (substr($bits, $j, 1) == "1") {
        $mode |= $modes[$j];
    }
}
$printer -> selectPrintMode($mode);
$printer -> setJustification($justification[1]);
$printer -> text("Sutorejo Prima Utara PDD 18-19,\n");
$printer -> text("Surabaya\n");
$printer -> text("031-58204040/58207070\n");
$printer -> text("\n");
$printer -> text("---------------------------------\n");

$id = $_GET["id"];
$result = $mysqli->query("SELECT * FROM payment WHERE id = ".$id."");
$hasil = $result->num_rows;
while($row = mysqli_fetch_array($result))	
{
    $printer -> text($row['paytime']."\n");
    $printer -> text($row['username']."\n");
    $printer -> text("No. ".$row['id']."\n");
    $printer -> text("---------------------------------\n");

    $bits = str_pad(decbin(8), count($modes), "0", STR_PAD_LEFT);
    $mode = 0;
    for ($j = 0; $j < strlen($bits); $j++) {
        if (substr($bits, $j, 1) == "1") {
            $mode |= $modes[$j];
        }
    }
    $printer -> selectPrintMode($mode);
    $printer -> text("INVOICE\n");

    $bits = str_pad(decbin(0), count($modes), "0", STR_PAD_LEFT);
    $mode = 0;
    for ($j = 0; $j < strlen($bits); $j++) {
        if (substr($bits, $j, 1) == "1") {
            $mode |= $modes[$j];
        }
    }
    $printer -> selectPrintMode($mode);

    $result1 = $mysqli->query("SELECT py.total, py.method, py.number, py.bank, py.trfdate, pd.id, pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, SUM(pd.amount) as subtotal, s.name, p.program, pd.explanation
                               FROM paydetail pd 
                               INNER JOIN student s ON pd.studentid = s.id
							   INNER JOIN price p ON s.priceid = p.id
                               INNER JOIN payment py ON pd.paymentid = py.id
                               WHERE pd.paymentid = ".$id." 
                               GROUP BY pd.studentid");
    $hasil = $result1->num_rows;
    $subtotal = array();
    $id = array();
    $name = array();
    $level = array();
    $method = array();
    $trfdate = array();
    $number = array();
    $bank = array();
    $i = 0;
    while($row1 = mysqli_fetch_array($result1))	
    {
        $id[] = new item("ID", $row1['studentid']);
        $name[] = new item("NAME", $row1['name']);
        $level[] = new item("LEVEL", $row1['program']);
        $method[] = new item("METHOD", $row1['method']);

        if ($row1['method'] == "BANK TRANSFER") {
            $var = $row1['trfdate'];
            $parts = explode('-',$var);
            $transfer = $parts[2] . '/' . $parts[1]; 
            $row1['trfdate'] = $transfer;
            $trfdate[] = new item("TRANSFER DATE", $row1['trfdate']);
            $number[] = new item("NUMBER", $row1['number']);
        } elseif ($row1['method'] == "DEBIT" || $row1['method'] == "CREDIT" || $row1['method'] == "SWITCHING CARD") {
            $bank[] = new item("BANK", $row1['bank']);
            $number[] = new item("NUMBER", $row1['number']);
        }

        $subtotal[] = new item("Subtotal", "Rp. ".number_format($row1['subtotal'], 0, ".", ".").",00");
        $studentid = $row1['studentid'];
        $payid = $row1['paymentid'];

        $printer -> text($id[$i]);
        $printer -> text($name[$i]);
        $printer -> text($level[$i]);
        $printer -> text($method[$i]);

        if ($row1['method'] == "BANK TRANSFER") {
            $printer -> text($trfdate[$i]);
            $printer -> text($number[$i]);
        } elseif ($row1['method'] == "DEBIT" || $row1['method'] == "CREDIT" || $row1['method'] == "SWITCHING CARD") {
            $printer -> text($bank[$i]);
            $printer -> text($number[$i]);
        }

        $result2 = $mysqli->query("SELECT pd.id, pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, s.name, p.program, pd.explanation
                            FROM paydetail pd 
                            INNER JOIN student s ON pd.studentid = s.id
                            INNER JOIN price p ON s.priceid = p.id
                            WHERE pd.paymentid = ".$payid." AND pd.studentid = ".$studentid."");
        $hasil2 = $result2->num_rows;
        $category = array();
        $amount = array();
        $count = 0;
        while($row2 = mysqli_fetch_array($result2))	
        {
            if ($row2['category'] == "COURSE" && $row2['monthpay'] != "") {
                $var = $row2['monthpay'];
                $parts = explode('-',$var);
                $monthpay =  date("M", strtotime($row2['monthpay']));
                $yearpay =  date("y", strtotime($row2['monthpay']));
                $row2['category'] = $row2['category'] . " (" . $monthpay . " ". $yearpay . ")";
            } else {
                $row2['category'] = $row2['category'];
            }
            if ($count == 0){
                $category[] = new item("PAYMENT", $row2['category']);
            } else {
                $category[] = new item("", $row2['category']);
            }
            $amount[] = new item("", "Rp. ".number_format($row2['amount'], 0, ".", ".").",00");
            $count = $count + 1;
        }
        for ($x = 0; $x < count($category); $x++){   
            $printer -> text($category[$x]);
            $printer -> text($amount[$x]);
        }

        $bits = str_pad(decbin(8), count($modes), "0", STR_PAD_LEFT);
        $mode = 0;
        for ($j = 0; $j < strlen($bits); $j++) {
            if (substr($bits, $j, 1) == "1") {
                $mode |= $modes[$j];
            }
        }
        $printer -> selectPrintMode($mode);

        $printer -> text($subtotal[$i]);

        $bits = str_pad(decbin(0), count($modes), "0", STR_PAD_LEFT);
        $mode = 0;
        for ($j = 0; $j < strlen($bits); $j++) {
            if (substr($bits, $j, 1) == "1") {
                $mode |= $modes[$j];
            }
        }
        $printer -> selectPrintMode($mode);

        $printer -> text("\n");
        $i = $i + 1;

        if ($i == $hasil){
            $bits = str_pad(decbin(8), count($modes), "0", STR_PAD_LEFT);
            $mode = 0;
            for ($j = 0; $j < strlen($bits); $j++) {
                if (substr($bits, $j, 1) == "1") {
                    $mode |= $modes[$j];
                }
            }
            $printer -> selectPrintMode($mode);
            $total = array();
            $total[] = new item("Total", "Rp. ".number_format($row1['total'], 0, ".", ".").",00");
            $printer -> text($total[0]);
            // $printer -> text("\n");
            // $printer -> text("Thank you");
        }

        $bits = str_pad(decbin(0), count($modes), "0", STR_PAD_LEFT);
        $mode = 0;
        for ($j = 0; $j < strlen($bits); $j++) {
            if (substr($bits, $j, 1) == "1") {
                $mode |= $modes[$j];
            }
        }
        $printer -> selectPrintMode($mode);
            
    }
}

// $bits = str_pad(decbin(0), count($modes), "0", STR_PAD_LEFT);
// $mode = 0;
// for ($j = 0; $j < strlen($bits); $j++) {
//     if (substr($bits, $j, 1) == "1") {
//         $mode |= $modes[$j];
//     }
// }
// $printer -> selectPrintMode($mode);
// $printer -> setJustification($justification[1]);
$printer -> text("\n");
$printer -> text("Thank you\n");
   
$printer -> selectPrintMode(); // Reset
$printer -> setJustification(); // Reset
$printer -> cut();

// try {
//     $tux = EscposImage::load("resources/tux.png", false);
    
//     $printer -> graphics($tux);
//     $printer -> text("Regular Tux.\n");
//     $printer -> feed();
    
//     // $printer -> graphics($tux, Printer::IMG_DOUBLE_WIDTH);
//     // $printer -> text("Wide Tux.\n");
//     // $printer -> feed();
    
//     // $printer -> graphics($tux, Printer::IMG_DOUBLE_HEIGHT);
//     // $printer -> text("Tall Tux.\n");
//     // $printer -> feed();
    
//     // $printer -> graphics($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
//     // $printer -> text("Large Tux in correct proportion.\n");
    
//     $printer -> cut();
// } catch (Exception $e) {
//     /* Images not supported on your PHP, or image file not found */
//     $printer -> text($e -> getMessage() . "\n");
// }

$printer -> close();


class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $str = $this -> price;
        $rightCols = 16.5;
        $leftCols = 16.5;
		if (strlen($str) > 15)
			$str = substr($str, 0, 15);
        $left = str_pad($this -> name, $leftCols) ;
        $right = str_pad($str, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

//header("Location: http://192.168.1.129/u&i/payment/addother", true, 301);
