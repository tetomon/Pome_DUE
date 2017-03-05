<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Asia/Bangkok');

/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';


$inputFileName = 'test.xls';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
//  Get worksheet dimensions

$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
 


$array_data = array();
foreach($rowIterator as $row){
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
    if(1 == $row->getRowIndex ()) continue;//skip first row
    $rowIndex = $row->getRowIndex ();
    $array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');
     
    foreach ($cellIterator as $cell) {
        if('A' == $cell->getColumn())
        {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } 
        else if('B' == $cell->getColumn())
        {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } 
        else if('C' == $cell->getColumn())
        {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } 
        else if('D' == $cell->getColumn())
        {
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        }
    }
}
$count = count($array_data);

for($i=2;$i<count($array_data);$i++)
{
    echo $array_data[$i]['A']." ".$array_data[$i]['B']." ".$array_data[$i]['C']." ".$array_data[$i]['D']."<br/>";
}





?>
