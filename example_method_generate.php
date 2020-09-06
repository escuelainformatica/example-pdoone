<?php

use mapache_commons\Collection;

include __DIR__.'/common.php';

$errors=$pdoOne->generateAllClasses(
    [
        'customers'=>['CustomerRepo','Customer'], // table => [repo class, model class]
        'invoice_details'=>['InvoiceDetailRepo','InvoiceDetail'],
        'invoices'=>['InvoiceRepo','Invoice']]
    ,'BaseRepo',['example\repo','example\model'] // namespaces
    ,[__DIR__.'\repo',__DIR__.'\model']); // folders
echo "Errors:<br>";
echo Collection::generateTable($errors);

echo "And now, yo could runs <a href='example_use_generated.php'>example_use_generated.php</a><br>";
echo "Or <a href='example_use_generated_object.php'>example_use_generated_object.php</a><br>";