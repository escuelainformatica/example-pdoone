<?php /** @noinspection PhpUnhandledExceptionInspection */

use dBug\dBug;
use eftec\PdoOne;
use mapache_commons\Collection;

include __DIR__.'/common.php';

$pdoOne->truncate('customers','',true);
$pdoOne->resetIdentity('customers');

$pdoOne->truncate('invoices','',true);
$pdoOne->resetIdentity('invoices');

$pdoOne->truncate('invoice_details','',true);
$pdoOne->resetIdentity('invoice_details');

// Creating a new customer********************************

// raw query.
$statement=$pdoOne->runRawQuery('insert into customers(name) values (?)',['John Simple'],false);
$statement->closeCursor(); // it is a pdostatement
$statement=null; 
$idCustomer=$pdoOne->insert_id();
$firstCustomer=$idCustomer;
echo "added user $idCustomer<br>";

// raw query.
$pdoOne->runRawQuery('insert into customers(name) values (?)',['John Simple'],true);
$idCustomer=$pdoOne->insert_id();
echo "added user $idCustomer<br>";

// named raw query
$pdoOne->runRawQuery('insert into customers(name) values (:name)',['name'=>'John Simple'],true);
$idCustomer=$pdoOne->insert_id();
echo "added user $idCustomer<br>";

// *************** list ***********************

// list raw query

$customers=$pdoOne->runRawQuery('select * from customers where name=?',['John Simple']);

echo Collection::generateTable($customers);


// **************** one value **************************************

// raw query

$customer=$pdoOne->runRawQuery('select * from customers where idcustomer=?',[$firstCustomer]);
echo "<pre>";
var_dump($customer[0]);
echo "</pre>";



// Creating an invoice
// -------------------------------------------
$invoice=['IdInvoice'=>1,'Date'=> PdoOne::dateSqlNow(true), 'IdCustomer'=>1];
$pdoOne->runRawQuery('insert into invoices(idinvoice,date,idcustomer) values(:IdInvoice,:Date,:IdCustomer)',$invoice);


// Creating the detail of the invoice
$invoiceDetail=[1,'Cocacola',1000,3];
$query='insert into invoice_details(idinvoice,product,unitprice,quantity) values (?,?,?,?)';
$pdoOne->runRawQuery($query, $invoiceDetail);
$invoiceDetail=[1,'Fanta',2000,5];
$query='insert into invoice_details(idinvoice,product,unitprice,quantity) values (?,?,?,?)';
$pdoOne->runRawQuery($query, $invoiceDetail);

// *********** listing invoice
$invoices=$pdoOne->runRawQuery('select * from invoices');

echo Collection::generateTable($invoices);

// *********** listing invoicedetails
$invoiceDetails=$pdoOne->runRawQuery('select * from invoice_details');

echo Collection::generateTable($invoiceDetails);

// getting all together.

$invoice=$pdoOne->runRawQuery('select * from invoices where idinvoice=?',[1]);
$invoice[0]['details']=$pdoOne->runRawQuery('select * from invoice_details where idinvoice=?',[1]);
new dBug($invoice[0]);


