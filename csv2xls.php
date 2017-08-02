#!/usr/bin/env php
<?php
if ($argc == 1) {
    echo 'Usage: csv2xls.php input.csv [output.xls]';
    exit(-1);
}

$csv_file = $argv[1];
$xls_file = isset($argv[2]) ? $argv[2] : get_xls_file($csv_file);

function get_xls_file($csv_file)
{
    $len = strlen($csv_file);
    if ($len > 4 && substr($csv_file, $len - 4) === '.csv') {
        return substr($csv_file, 0, $len - 4) . '.xls';
    }
    return $csv_file . '.xls';
}

require __DIR__ . '/vendor/autoload.php';

$objReader = PHPExcel_IOFactory::createReader('CSV');
$objReader->setDelimiter(',');
$objReader->setInputEncoding('UTF-8');

$objPHPExcel = $objReader->load($csv_file);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($xls_file);