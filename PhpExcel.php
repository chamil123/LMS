<?php

require './plugins/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = new PHPExcel();

$con = mysqli_connect("localhost", "root", "", "LMS");
if (!$con) {
    echo mysqli_error($con);
    exit;
}
$excel->setActiveSheetIndex(0);

$query = mysqli_query($con, "SELECT*FROM center");
$row = 3;
while ($data = mysqli_fetch_object($query)) {
    $excel->getActiveSheet()
            ->setCellValue('A' . $row, $data->center_code)
            ->setCellValue('B' . $row, $data->center_name)
            ->setCellValue('C' . $row, $data->center_date);
    $row++;
}
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);

$excel->getActiveSheet()
        ->setCellValue('A1', 'List of centers')
        ->setCellValue('A3', 'center_code')
        ->setCellValue('B3', 'center_name')
        ->setCellValue('C3', 'center_date');

$excel->getActiveSheet()->mergeCells('A1:C1');

$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
        array(
            'font' => array(
                'size' => 24,
            )
        )
);
$excel->getActiveSheet()->getStyle('A3:C3')->applyFromArray(
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
