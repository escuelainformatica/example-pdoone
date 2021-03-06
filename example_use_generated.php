<?php

use dBug\dBug;
use eftec\PdoOne;
use example\repo\BaseRepo;
use example\repo\CustomerRepo;
use example\repo\InvoiceDetailRepo;
use example\repo\InvoiceRepo;
use mapache_commons\Collection;

include __DIR__.'/vendor/autoload.php';

include __DIR__.'/common.php';

if(!file_exists(__DIR__.'/model/AbstractCustomer.php')) {
    echo "you must execute <a href='example_method_generated.php'>example_method_generated.php</a> first";
    die(1);
}

// you don't need to add those includes manually, you could use an autoinclude.
include __DIR__.'/model/AbstractCustomer.php';
include __DIR__.'/model/AbstractInvoice.php';
include __DIR__.'/model/AbstractInvoiceDetail.php';
include __DIR__.'/model/Customer.php';
include __DIR__.'/model/Invoice.php';
include __DIR__.'/model/InvoiceDetail.php';

include __DIR__.'/repo/BaseRepo.php';
include __DIR__.'/repo/AbstractCustomerRepo.php';
include __DIR__.'/repo/AbstractInvoiceRepo.php';
include __DIR__.'/repo/AbstractInvoiceDetailRepo.php';
include __DIR__.'/repo/CustomerRepo.php';
include __DIR__.'/repo/InvoiceRepo.php';
include __DIR__.'/repo/InvoiceDetailRepo.php';

$pdoOne->truncate('customers','',true);
$pdoOne->resetIdentity('customers');

$pdoOne->truncate('invoices','',true);
$pdoOne->resetIdentity('invoices');

$pdoOne->truncate('invoice_details','',true);
$pdoOne->resetIdentity('invoice_details');







BaseRepo::$useModel=false; // we want the input and output use arrays instead of objects.
$cus=CustomerRepo::setRecursive('*')::factory(['Name' => 'John Generated #1 (Array)']);
CustomerRepo::insert($cus);
new dBug($cus);

$cus=CustomerRepo::factory(['Name' => 'John Generated #2 (Array)']);
CustomerRepo::insert($cus);
new dBug($cus);


$r=CustomerRepo::toList();
echo Collection::generateTable($r);

// Creating an invoice ****************************************
$invoice=InvoiceRepo::setRecursive('*')::factory();
$invoice['IdInvoice']=1;
$invoice['Date']=PdoOne::dateSqlNow(true);
$invoice['IdCustomer']=1;

// InvoiceDetailRepo: IdInvoice islinked automatically, and IdInvoiceDetail is identity.
$invoice['_invoice_details']=[
        InvoiceDetailRepo::factory(['Product' => 'Cocacola','UnitPrice' => 1000,'Quantity' => 3]), 
        InvoiceDetailRepo::factory(['Product' => 'Fanta','UnitPrice' => 5000,'Quantity' => 2])
];
echo "<hr>First insertion:<br>";
new dBug($invoice);
InvoiceRepo::setRecursive('*')::insert($invoice);
new dBug($invoice);

unset($invoice['_invoice_details'][0]);
$invoice['_invoice_details'][]=InvoiceDetailRepo::factory(['Product' => 'Sprite','UnitPrice' => 7000,'Quantity' => 3]);
echo "<hr>Before update:<br>";
new dBug($invoice);

InvoiceRepo::setRecursive('*')::update($invoice);


$invoice=InvoiceRepo::setRecursive('*')::first(1);
echo "<hr>After update:<br>";
new dBug($invoice);

