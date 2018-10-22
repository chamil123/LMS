<?php

$serchBoxBranch = $_GET['serchBoxBranch'];
$serchBoxCenter = $_GET['serchBoxCenter'];



require './plugins/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = new PHPExcel();

$con = mysqli_connect("localhost", "root", "", "LMS");
if (!$con) {
    echo mysqli_error($con);
    exit;
}
$excel->setActiveSheetIndex(0);


if ($serchBoxBranch == "" && $serchBoxCenter == "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id");
} else if ($serchBoxBranch != "" && $serchBoxCenter == "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch");
} else if ($serchBoxBranch == "" && $serchBoxCenter != "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_code=$serchBoxCenter");
} else if ($serchBoxBranch != "" && $serchBoxCenter != "" ) {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch AND center.center_code=$serchBoxCenter");
} 


$row = 4;
while ($data = mysqli_fetch_object($query)) {

//    $sql = mysqli_query($con, "SELECT  SUM(dailycollection_amount_paid) AS amt FROM dailycollection WHERE application_id=$data->application_id");
//    $data2 = mysqli_fetch_object($sql);
//    $application_payAmount = $data2->amt;


    $sql = mysqli_query($con, "SELECT  SUM(dailycollection_amount_paid) AS amt FROM dailycollection WHERE application_id=$data->application_id");
    $data2 = mysqli_fetch_object($sql);
    $doc_chrgs = 0;
    $member_fee = 0;
    if ($data2 != null) {
        $totalPaid = $data2->amt;
        $totalAmount = $data->application_lamountWithInt;
        $amtToBeClt=$totalAmount-$totalPaid;
    } else {
        $doc_chrgs = 0;
        $member_fee = 0;
    }
    $excel->getActiveSheet()
            ->setCellValue('A' . $row, $data->center_name)
            ->setCellValue('B' . $row, $data->member_code)
            ->setCellValue('C' . $row, $data->member_number)
            ->setCellValue('D' . $row, $data->member_inital . " " . $data->member_surNmae)
            ->setCellValue('E' . $row, $data->application_lterm)
            ->setCellValue('F' . $row, $data->application_date)
            ->setCellValue('G' . $row, $data->application_lamount)
            ->setCellValue('H' . $row, $data->application_lamountWithInt)
            ->setCellValue('I' . $row, $totalPaid)
            ->setCellValue('J' . $row, $amtToBeClt);
    
    $excel->getActiveSheet()->getStyle('A' . $row . ':J' . $row)->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
    );

    $row++;
}
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

$excel->getActiveSheet()
        ->setCellValue('A1', 'Details Of Loan Outstanding')
        ->setCellValue('A3', 'Center name')
        ->setCellValue('B3', 'Client code')
        ->setCellValue('C3', 'Member No')
        ->setCellValue('D3', 'Member Name')
        ->setCellValue('E3', 'Loan term')
        ->setCellValue('F3', 'Loan date')
        ->setCellValue('G3', 'Loan Amount')
        ->setCellValue('H3', 'Total Amount')
        ->setCellValue('I3', 'Total Paid')
        ->setCellValue('J3', 'Amount to be Collect');

$excel->getActiveSheet()->mergeCells('A1:C1');

$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
        array(
            'font' => array(
                'size' => 24,
            )
        )
);
$excel->getActiveSheet()->getStyle('A3:J3')->applyFromArray(
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
header('Content-Disposition:attachment;filename=' . $date . 'LoanOutstanding.xlsx');
header('Cache-Control:max-age=0');

$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$file->save('php://output');
?>
