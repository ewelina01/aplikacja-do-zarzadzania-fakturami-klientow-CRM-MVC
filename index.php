<?php

if ( ! defined( 'PATH' ) ) {
	define( 'PATH', __DIR__ . '/' );
}

require_once PATH . 'config.php';

$database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_CHARSET);

$gateway = new RecordsGateway($database);
global $gateway;

//global variables
$url = $_SERVER['REQUEST_URI'] ?? '/';
$customerId = $_GET['customerId'] ?? null;
$sortInvoicesBy = $_GET['sortInvoicesBy'] ?? null;
$invoicesOrder = $_GET['invoicesOrder'] ?? null;
$sortPaymentsBy = $_GET['sortP'] ?? null;
$paymentsOrder = $_GET['pOrder'] ?? null;

//filter invoices parameters
$iFilters = [
    'iNumber' => $_GET['iNumber'] ?? null,
    'iDate' => $_GET['iDate'] ?? null,
    'iDueDate' => $_GET['iDueDate'] ?? null,
    'iGrossTotal' => $_GET['iGrossTotal'] ?? null,
];


$controller = new Controller($gateway, $url, $customerId, $sortInvoicesBy, $invoicesOrder, $sortPaymentsBy, $paymentsOrder, $iFilters);

