<?php

$application_id=$_GET['application_id'];
require './plugins/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = new PHPExcel();

$con = mysqli_connect("localhost", "root", "", "LMS");
if (!$con) {
    echo mysqli_error($con);
    exit;
}
$excel->setActiveSheetIndex(0);

$query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id  WHERE application_id=$application_id");
$dataAPP = mysqli_fetch_object($query);

$date2 = strtotime($dataAPP->application_activateDate);
$date2 = strtotime("+1 day", $date2);
$lastPaymentDatePlusOne = date('Y-m-d', $date2);
$next_day = date('Y-m-d', strtotime($dataAPP->center_date, strtotime($lastPaymentDatePlusOne)));

$loanPerioud = $dataAPP->application_lperiod;
$newDate = $next_day;
$lastPaymentss = "";
$tempdate = "1970-01-01";
$total = 0;
$row = 10;
for ($i = 1; $i < $loanPerioud; $i++) {
    $dailycollectionDate = "not paid";
    if ($lastPaymentss == "") {
        $lastPaymentss = $next_day;
    }

    $query2 = mysqli_query($con, "SELECT*FROM dailycollection  INNER JOIN application ON dailycollection.application_id=application.application_id WHERE application.application_id=$application_id");

    $increment = 0;
    $val = 0;
    $amountToBePaid = 0;

    while ($rows = mysqli_fetch_object($query2)) {
        $dailycollectionDate = $rows->dailycollection_date;
        $amountToBePaid = $rows->dailycollection_amount_paid;
        $loanWithInt = $rows->application_lamountWithInt;


        if ($tempdate < $dailycollectionDate && $lastPaymentss >= $dailycollectionDate) {
            $total = $total + $amountToBePaid;
            $balance = $loanWithInt - $total;

            $excel->getActiveSheet()
                    ->setCellValue('A' . $row, $i)
                    ->setCellValue('B' . $row, $lastPaymentss)
                    ->setCellValue('C' . $row, $lastPaymentss)
                    ->setCellValue('D' . $row, $dailycollectionDate)
                    ->setCellValue('E' . $row, $amountToBePaid)
                    ->setCellValue('F' . $row, $balance);

            $excel->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
                    )
            );

            $val = 1;
        }
        $amountToBePaid = 0;
        $increment++;
    }

    if ($val == 0) {
        $dailycollectionDate = 0;

        $excel->getActiveSheet()
                ->setCellValue('A' . $row, $i)
                ->setCellValue('B' . $row, $lastPaymentss)
                ->setCellValue('C' . $row, $lastPaymentss)
                ->setCellValue('D' . $row, $dailycollectionDate)
                ->setCellValue('E' . $row, $amountToBePaid)
                ->setCellValue('F' . $row, $balance);

        $excel->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray(
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
        );
    }
    $tempdate = $lastPaymentss;

    $date2 = strtotime($newDate);
    $date2 = strtotime("+7 day", $date2);
    $lastPaymentss = date('Y-m-d', $date2);
    $newDate = $lastPaymentss;

    $row++;
}

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(23);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);


$excel->getActiveSheet()
        ->setCellValue('A1', 'Ledger Report')
        ->setCellValue('A3', 'Member Name')
        ->setCellValue('B3', $dataAPP->member_inital . " " . $dataAPP->member_surNmae)
        ->setCellValue('A4', 'Member Name')
        ->setCellValue('B4', $dataAPP->member_number)
        ->setCellValue('A5', 'Center Name')
        ->setCellValue('B5', $dataAPP->center_name)
        ->setCellValue('A6', 'Member NIC')
        ->setCellValue('B6', $dataAPP->member_NIC)
        ->setCellValue('C3', 'Loan Amount')
        ->setCellValue('D3', $dataAPP->application_lamount)
        ->setCellValue('C4', 'Contact Number')
        ->setCellValue('D4', $dataAPP->member_mobileNumber)
        
        ->setCellValue('C5', 'Member Address')
        ->setCellValue('D5', $dataAPP->member_AddressLine1 . "  " . $dataAPP->member_AddressLine2 . "  " . $dataAPP->member_AddressLine3 . "  " . $dataAPP->member_AddressLine4)
        
        ->setCellValue('F9', $dataAPP->application_lamountWithInt)
        ->setCellValue('A8', 'Number Of Installement')
        ->setCellValue('B8', 'Due Date')
        ->setCellValue('C8', 'Due Amount')
        ->setCellValue('D8', 'Collection date')
        ->setCellValue('E8', 'Collection Amount')
        ->setCellValue('F8', 'Balance');


$excel->getActiveSheet()->mergeCells('A1:C1');
$excel->getActiveSheet()->mergeCells('D5:G5');

$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
        array(
            'font' => array(
                'size' => 24,
            )
        )
);
$excel->getActiveSheet()->getStyle('A8:F8')->applyFromArray(
        array(
            'font' => array(
                'bold' => 24,
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        )
);


$date = date('Y-m-d H:i:s');

header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition:attachment;filename=' . $date . 'test.xlsx');
header('Cache-Control:max-age=0');

$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$file->save('php://output');
?>
