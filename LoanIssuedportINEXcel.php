<?php

$serchBoxBranch = $_GET['serchBoxBranch'];
$serchBoxCenter = $_GET['serchBoxCenter'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];


require './plugins/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = new PHPExcel();

$con = mysqli_connect("localhost", "root", "", "LMS");
if (!$con) {
    echo mysqli_error($con);
    exit;
}
$excel->setActiveSheetIndex(0);

if ($serchBoxBranch == "" && $serchBoxCenter == "" && $from_date == "" & $to_date == "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id");
} else if ($serchBoxBranch != "" && $serchBoxCenter == "" && $from_date == "" & $to_date == "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch");
} else if ($serchBoxBranch == "" && $serchBoxCenter != "" && $from_date == "" & $to_date == "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_code=$serchBoxCenter");
} else if ($serchBoxBranch != "" && $serchBoxCenter != "" && $from_date == "" & $to_date == "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch AND center.center_code=$serchBoxCenter");
} else if ($serchBoxBranch == "" && $serchBoxCenter == "" && $from_date != "" & $to_date != "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE application.application_date BETWEEN '$from_date' AND '$to_date'");
} else if ($serchBoxBranch != "" && $serchBoxCenter == "" && $from_date != "" & $to_date != "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch  AND application.application_date BETWEEN '$from_date' AND '$to_date'");
} else if ($serchBoxBranch == "" && $serchBoxCenter != "" && $from_date != "" & $to_date != "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_code=$serchBoxCenter  AND application.application_date BETWEEN '$from_date' AND '$to_date'");
} else if ($serchBoxBranch != "" && $serchBoxCenter != "" && $from_date != "" & $to_date != "") {
    $query = mysqli_query($con, "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch AND center.center_code=$serchBoxCenter AND application.application_date BETWEEN '$from_date' AND '$to_date'");
}


$row = 4;
while ($data = mysqli_fetch_object($query)) {

//    $sql = mysqli_query($con, "SELECT  SUM(dailycollection_amount_paid) AS amt FROM dailycollection WHERE application_id=$data->application_id");
//    $data2 = mysqli_fetch_object($sql);
//    $application_payAmount = $data2->amt;


    $sql = mysqli_query($con, "SELECT * from charges WHERE application_id=$data->application_id");
    $data2 = mysqli_fetch_object($sql);
    $doc_chrgs = 0;
    $member_fee = 0;
    $sec_ser = 0;
    if ($data2 != null) {
        $doc_chrgs = $data2->charges_documentCharges;
        $member_fee = $data2->charges_memberFee;
        $sec_ser= $data2->charges_securityService;
    } else {
        $doc_chrgs = 0;
        $member_fee = 0;
        $sec_ser = 0;
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
            ->setCellValue('I' . $row, $doc_chrgs)
            ->setCellValue('J' . $row, $sec_ser)
            ->setCellValue('K' . $row, $member_fee);
    
    $excel->getActiveSheet()->getStyle('A' . $row . ':K' . $row)->applyFromArray(
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
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(12);

$excel->getActiveSheet()
        ->setCellValue('A1', 'Details Of Loan Issued')
        ->setCellValue('A3', 'Center name')
        ->setCellValue('B3', 'Client code')
        ->setCellValue('C3', 'Member No')
        ->setCellValue('D3', 'Member Name')
        ->setCellValue('E3', 'Loan term')
        ->setCellValue('F3', 'Loan date')
        ->setCellValue('G3', 'Loan Amount')
        ->setCellValue('H3', 'Total Amount')
        ->setCellValue('I3', 'Document charges')
        ->setCellValue('J3', 'Document Charges')
        ->setCellValue('K3', 'Member Fee');


$excel->getActiveSheet()->mergeCells('A1:C1');

$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
        array(
            'font' => array(
                'size' => 22,
            )
        )
);
$excel->getActiveSheet()->getStyle('A3:K3')->applyFromArray(
        array(
            'font' => array(
                'bold' => 23,
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
