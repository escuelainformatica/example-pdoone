<?php

use eftec\PdoOne;
use mapache_commons\Collection;

include __DIR__.'/common.php';

$pdoOne->truncate('customers','',true);
$pdoOne->resetIdentity('customers');

$pdoOne->truncate('invoices','',true);
$pdoOne->resetIdentity('invoices');

$pdoOne->truncate('invoice_details','',true);
$pdoOne->resetIdentity('invoice_details');

// Creating a new customer


// using method chains
$idCustomer=$pdoOne->from('customers')->set(['name'=>'John Chain #1'])->insert();
echo "Added user $idCustomer<br>";

$idCustomer=$pdoOne->insert('customers',['name'=>'John Chain #2']);
echo "Added user $idCustomer<br>";

// objects
$customer=['name'=>'John Chain #3'];
$idCustomer=$pdoOne->insertObject('customers',$customer);
echo "Added user $idCustomer<br>";
echo "<hr>";
// *************** list ***********************

// list all

$customers=$pdoOne->select('*')
    ->from('customers')
    ->toList(); // end of the chain.
echo Collection::generateTable($customers);


// list using method chain

$customers=$pdoOne->select('*')
    ->from('customers')
    ->where('name=?',['John Chain #1'])
    ->toList(); // end of the chain.
echo Collection::generateTable($customers);

// **************** one value **************************************



// method chains

$customer=$pdoOne->select('*')->from('customers')->where('idcustomer=?',[1])->first();
echo "<pre>";
var_dump($customer);
echo "</pre>";

// Creating an invoice
// -------------------------------------------
$invoice=['IdInvoice'=>1,'Date'=> PdoOne::dateSqlNow(true), 'IdCustomer'=>1];
$pdoOne->set($invoice)->from('invoices')->insert();

// Creating the detail of the invoice
$invoiceDetail=['IdInvoice'=>1,'Product'=>'Cocacola','UnitPrice'=>1000,'Quantity'=>3];
$pdoOne->set($invoiceDetail)->from('invoice_details')->insert();

$invoiceDetail=['IdInvoice'=>1,'Product'=>'Fanta','UnitPrice'=>5000,'Quantity'=>5];
$pdoOne->set($invoiceDetail)->from('invoice_details')->insert();

$invoiceDetails=$pdoOne->select('*')->from('invoice_details')->toList();

echo Collection::generateTable($invoiceDetails);

$invoice=$pdoOne->select('*')->from('invoices')->where('idinvoice=?',1)->first();
$invoice['Details']=$pdoOne->select('*')->from('invoice_details')->where('idinvoice=?',1)->toList();
$invoice['Customer']=$pdoOne->select('*')->from('customers')->where('idcustomer=?',$invoice['IdCustomer'])->first();

new \dBug\dBug($invoice);