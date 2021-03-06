<?php
/** @noinspection PhpUnused
 * @noinspection ReturnTypeCanBeDeclaredInspection
 */
namespace example\repo;
use example\model\InvoiceDetail;
use Exception;

/**
 * Generated by PdoOne Version 2.2.5 Date generated Sun, 06 Sep 2020 16:29:57 -0400. 
 * EDIT THIS CODE.
 * @copyright (c) Jorge Castro C. MIT License  https://github.com/EFTEC/PdoOne
 * Class InvoiceDetailRepo
 * <pre>
 * $code=$pdoOne->generateCodeClassRepo(''invoice_details'',''example\repo'','array('customers'=>'CustomerRepo','invoice_details'=>'InvoiceDetailRepo','invoices'=>'InvoiceRepo',)',''example\model\InvoiceDetail'');
 * </pre>
 */
class InvoiceDetailRepo extends AbstractInvoiceDetailRepo
{
    const ME=__CLASS__; 
    const MODEL= InvoiceDetail::class;
  
    
}