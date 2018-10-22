<?php

require './plugins/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = new PHPExcel();

$con = mysqli_connect("localhost", "root", "", "LMS");
if (!$con) {
    echo mysqli_error($con);
    exit;
}
$excel->setActiveSheetIndex(0);

$query = mysqli_query($con, "SELECT*FROM member INNER JOIN application ON member.member_id=application.member_id ORDER BY member.member_group");
$row = 5;
$i = 1;
$tem = 0;
while ($data = mysqli_fetch_object($query)) {
    $excel->getActiveSheet()
            ->setCellValue('A' . $row, $i)
            ->setCellValue('B' . $row, $data->member_number)
            ->setCellValue('C' . $row, $data->member_inital . " " . $data->member_surNmae)
            ->setCellValue('D' . $row, $data->application_lamount);

    $group = $data->member_group;
    if ($tem == $group) {
        
    } else {
        $tem = $group;
        $row++;
        $excel->getActiveSheet()->mergeCells('B' . $row . ':D' . $row)
                ->setCellValue('B' . $row, 'Group : ' . $group);


        $excel->getActiveSheet()
                ->getStyle('A' . $row . ':D' . $row)
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('a6a6a6');

//        $excel->getActiveSheet()
//                ->setCellValue('E' . $row, $group);
    }
    $row++;
    $i++;
}
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);

$excel->getActiveSheet()
        ->setCellValue('A1', 'List of centers')
        ->setCellValue('A3', 'No')
        ->setCellValue('B3', 'Member No')
        ->setCellValue('C3', 'Member Name')
        ->setCellValue('D3', 'Loan amount');

$excel->getActiveSheet()->mergeCells('A1:C1');
$excel->getActiveSheet()->mergeCells('A3:A4');
$excel->getActiveSheet()->mergeCells('B3:B4');
$excel->getActiveSheet()->mergeCells('C3:C4');
$excel->getActiveSheet()->mergeCells('D3:D4');


// Set Orientation, size and scaling
//$excel->setActiveSheetIndex(0);
//$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
//$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//$excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
//$excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
//$excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);


$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
        array(
            'font' => array(
                'size' => 24,
            )
        )
);
$excel->getActiveSheet()->getStyle('A3:D3')->applyFromArray(
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
$excel->getActiveSheet()->getStyle('A4:D4')->applyFromArray(
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
