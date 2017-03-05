<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Asia/Bangkok');

/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';


if (!file_exists("test.xls")) {
	exit("Please run 14excel5.php first.\n");
}




$objReader= new PHPExcel_Reader_Excel5();
$objReader->setReadDataOnly(true);

$objPHPExcel = $objReader->load( dirname(__FILE__) . '/test.xls' );

$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();






$array_data2 = array();
foreach($rowIterator as $row){
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
    if(1 == $row->getRowIndex ()) continue;//skip first row
    $rowIndex = $row->getRowIndex ();
    $array_data2[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');
     
    foreach ($cellIterator as $cell) {
        if('A' == $cell->getColumn()){
            $array_data2[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } else if('B' == $cell->getColumn()){
            $array_data2[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } else if('C' == $cell->getColumn()){
            $array_data2[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } else if('D' == $cell->getColumn()){
            $array_data2[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        }
    }
}

print_r($array_data2);


?>
