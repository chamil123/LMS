<?php

$serchBoxBranch = $_GET['serchBoxBranch'];
$serchBoxCenter = $_GET['serchBoxCenter'];
$searchCombo = $_GET['searchCombo'];

require './plugins/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = new PHPExcel();

$con = mysqli_connect("localhost", "root", "", "LMS");
if (!$con) {
    echo mysqli_error($con);
    exit;
}
$excel->setActiveSheetIndex(0);

if ($serchBoxBranch == "" && $serchBoxCenter == "") {
    $query = mysqli_query($con, "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id");
} else if ($serchBoxBranch != "" && $serchBoxCenter == "") {
    $query = mysqli_query($con, "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_id=$serchBoxBranch");
} else if ($serchBoxBranch == "" && $serchBoxCenter != "") {
    $query = mysqli_query($con, "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id  WHERE center.center_id=$serchBoxCenter");
} else if ($serchBoxBranch != "" && $serchBoxCenter != "") {
    $query = mysqli_query($con, "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_id=$serchBoxCenter AND branch.branch_id=$serchBoxBranch");
}




$row = 4;
while ($data = mysqli_fetch_object($query)) {
    if ($data->application_status == "activated") {
        $loanActiveDate = $data->application_activateDate;
        $memberName = $data->member_inital . " " . $data->member_surNmae;
        $loanActiveDate = $data->application_activateDate;
        $applicationDue = $data->application_ldue;

        $date = strtotime($loanActiveDate);
        $dd = "91";
        $date = strtotime("+" . $dd . " day", $date);
        $todate = date('Y-m-d', $date);

        $center_day = $data->center_date;

        $date2 = strtotime($loanActiveDate);
        $date2 = strtotime("+1 day", $date2);
        $lastPaymentDatePlusOne = date('Y-m-d', $date2);
        $next_day = date('Y-m-d', strtotime($center_day, strtotime($lastPaymentDatePlusOne)));

        $currentDate = date("Y-m-d");
        $datetime3 = new DateTime($currentDate);
        $datetime4 = new DateTime($next_day);
        $intervalForLastDateToNextDate = $datetime3->diff($datetime4);
        $differanceToNext = $intervalForLastDateToNextDate->format('%a');

        $loan_periouds = floor($differanceToNext / 7);
        if ($next_day > $currentDate) {
            $totalShouldBePaid = ($loan_periouds) * $applicationDue;
        } else if ($next_day < $currentDate) {
            $totalShouldBePaid = ($loan_periouds + 1) * $applicationDue;
        }

        $sql = mysqli_query($con, "SELECT  SUM(dailycollection_amount_paid) AS amt FROM dailycollection WHERE application_id=$data->application_id");
        $data2 = mysqli_fetch_object($sql);
        $application_payAmount = $data2->amt;
        $arrearsAmount = $totalShouldBePaid - $application_payAmount;
        $arrearsRental = $arrearsAmount / $applicationDue;
        if ($arrearsRental < 0) {
            $arrearsRental = 0;
            $arrearsAmount = 0;
        }
        $loanOutstanding = $data->application_lamountWithInt - $application_payAmount;

        if ($searchCombo == "All Active") {

            $excel->getActiveSheet()
                    ->setCellValue('A' . $row, $data->member_code)
                    ->setCellValue('B' . $row, $data->member_number)
                    ->setCellValue('C' . $row, $memberName)
                    ->setCellValue('D' . $row, $loanActiveDate)
                    ->setCellValue('E' . $row, $todate)
                    ->setCellValue('F' . $row, $data->application_lamount)
                    ->setCellValue('G' . $row, round($arrearsRental, 2))
                    ->setCellValue('H' . $row, $arrearsAmount)
                    ->setCellValue('I' . $row, $loanOutstanding);

            $excel->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
                    )
            );
            $row++;
        } else if ($searchCombo == "Arrears only") {
            if ($totalShouldBePaid > $application_payAmount) {
                $excel->getActiveSheet()
                        ->setCellValue('A' . $row, $data->member_code)
                        ->setCellValue('B' . $row, $data->member_number)
                        ->setCellValue('C' . $row, $memberName)
                        ->setCellValue('D' . $row, $loanActiveDate)
                        ->setCellValue('E' . $row, $todate)
                        ->setCellValue('F' . $row, $data->application_lamount)
                        ->setCellValue('G' . $row, round($arrearsRental, 2))
                        ->setCellValue('H' . $row, $arrearsAmount)
                        ->setCellValue('I' . $row, $loanOutstanding);

                $excel->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->applyFromArray(
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
        }
    }
}
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

$excel->getActiveSheet()
        ->setCellValue('A1', 'List of ' . $searchCombo . ' applications')
        ->setCellValue('A3', 'Membercode ')
        ->setCellValue('B3', 'Member number')
        ->setCellValue('C3', 'Member name')
        ->setCellValue('D3', 'Loan date')
        ->setCellValue('E3', 'Expire date')
        ->setCellValue('F3', 'Loan amount')
        ->setCellValue('G3', 'Rental arrears')
        ->setCellValue('H3', 'Total arrears')
        ->setCellValue('I3', 'Loan outstanding');

$excel->getActiveSheet()->mergeCells('A1:C1');

$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
        array(
            'font' => array(
                'size' => 24,
            )
        )
);
$excel->getActiveSheet()->getStyle('A3:I3')->applyFromArray(
        array(
            'font' => array(
                'bold' => 25,
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