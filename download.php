<?php

require_once 'vendor/autoload.php';

$numberEmployees = $_POST['numberEmployees'];
$minSalary = $_POST['minSalary'];
$maxSalary = $_POST['maxSalary'];
$numberLocations = $_POST['numberLocations'];
$minZipCode = $_POST['minZipCode'];
$maxZipCode = $_POST['maxZipCode'];
$format = $_POST['format'] ?? 'html';

$numberEmployees = (int)$numberEmployees;
$minSalary = (int)$minSalary;
$maxSalary = (int)$maxSalary;
$numberLocations = (int)$numberLocations;
$minZipCode = (int)$minZipCode;
$maxZipCode = (int)$maxZipCode;

if (
    is_null($numberEmployees) ||
    is_null($minSalary) ||
    is_null($maxSalary) ||
    is_null($numberLocations) ||
    is_null($minZipCode) ||
    is_null($maxZipCode) ||
    is_null($format)
) {
    exit("パラメータがありません。");
}

if (!is_numeric($numberEmployees) || $numberEmployees < 1 || $numberEmployees > 20) {
    exit("employeesが数値ではありません。1以上5以下で指定して下さい。");
}

if (!is_numeric($minSalary) || $minSalary < 1 || $minSalary > 100 || $minSalary > $maxSalary) {
    exit("minSalaryが数値ではありません。1以上100以下で指定して下さい。");
}

if (!is_numeric($maxSalary) || $maxSalary < 1 || $maxSalary > 100 || $minSalary > $maxSalary) {
    exit("maxSalaryが数値ではありません。1以上100以下で指定して下さい。");
}

if (!is_numeric($numberLocations) || $numberLocations < 1 || $numberLocations > 5) {
    exit("numberLocationが数値ではありません。1以上5以下で指定して下さい。");
}

if (!is_numeric($minZipCode) || $minZipCode < 1 || $minZipCode > 20 || $minZipCode > $maxZipCode) {
    exit("minZipCodeが数値ではありません。1以上20以下で指定して下さい。");
}

if (!is_numeric($maxZipCode) || $maxZipCode < 1 || $maxZipCode > 20 || $minZipCode > $maxZipCode) {
    exit("maxZipCodeが数値ではありません。1以上20以下で指定して下さい。");
}

$allowFormats = ['html', 'json', 'txt', 'markdown'];
if (!in_array($format, $allowFormats)) {
    exit("利用できるフォーマットではありません。" . implode(', ', $allowFormats) . "のフォーマットが利用できます。");
}

$restaurantChains = \Helpers\RandomGenerator::restaurantChains($minSalary,$maxSalary,$numberEmployees,$minZipCode,$maxZipCode,$numberLocations);

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="result.md"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toMarkdown();
    }

} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="result.json"');
    $restaurantChainsArray = array_map(fn($restaurantChain) => $restaurantChain->toArray(), $restaurantChains);
    echo json_encode($restaurantChainsArray);

} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="result.txt"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toString();
    }

} else {
    header('Content-Type: text/html');
    include "toHTML.php";
}