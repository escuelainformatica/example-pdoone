<?php
/** @noinspection PhpIncompatibleReturnTypeInspection
 * @noinspection ReturnTypeCanBeDeclaredInspection
 * @noinspection DuplicatedCode
 * @noinspection PhpUnused
 * @noinspection PhpUndefinedMethodInspection
 * @noinspection PhpUnusedLocalVariableInspection
 * @noinspection PhpUnusedAliasInspection
 * @noinspection NullPointerExceptionInspection
 * @noinspection SenselessProxyMethodInspection
 * @noinspection PhpParameterByRefIsNotUsedAsReferenceInspection
 */
namespace example\model;
use eftec\PdoOne;
use Exception;

/**
 * Generated by PdoOne Version 2.2.5 Date generated Sun, 06 Sep 2020 17:11:20 -0400. 
 * DO NOT EDIT THIS CODE. THIS CODE WILL SELF GENERATE.
 * @copyright (c) Jorge Castro C. MIT License  https://github.com/EFTEC/PdoOne
 * Class InvoiceDetail
 * <pre>
 * $code=$pdoOne->generateAbstractModelClass({args});
 * </pre>
 */
abstract class AbstractInvoiceDetail
{
	/** @var int $IdInvoiceDetail  */
	public $IdInvoiceDetail;
	/** @var int $IdInvoice  */
	public $IdInvoice;
	/** @var string $Product  */
	public $Product;
	/** @var float $UnitPrice  */
	public $UnitPrice;
	/** @var int $Quantity  */
	public $Quantity;

	/** @var Invoice $_IdInvoice manytoone */
    public $_IdInvoice;


    /**
     * AbstractInvoiceDetail constructor.
     *
     * @param array|null $array
     */
    public function __construct($array=null)
    {
        if($array===null) {
            return;
        }
        foreach($array as $k=>$v) {
            $this->{$k}=$v;
        }
    }

    //<editor-fold desc="array conversion">
    public static function fromArray($array) {
        if($array===null) {
            return null;
        }
        $obj=new InvoiceDetail();
		$obj->IdInvoiceDetail=isset($array['IdInvoiceDetail']) ?  $array['IdInvoiceDetail'] : null;
		$obj->IdInvoice=isset($array['IdInvoice']) ?  $array['IdInvoice'] : null;
		$obj->Product=isset($array['Product']) ?  $array['Product'] : null;
		$obj->UnitPrice=isset($array['UnitPrice']) ?  $array['UnitPrice'] : null;
		$obj->Quantity=isset($array['Quantity']) ?  $array['Quantity'] : null;
		$obj->_IdInvoice=isset($array['_IdInvoice']) ? 
            $obj->_IdInvoice=Invoice::fromArray($array['_IdInvoice']) 
            : null; // manytoone
		($obj->_IdInvoice !== null) 
            and $obj->_IdInvoice->IdInvoice=&$obj->IdInvoice; // linked manytoone

        return $obj;
    }
    
    /**
     * It converts the current object in an array
     * 
     * @return mixed
     */
    public function toArray() {
        return static::objectToArray($this);
    }
    
    /**
     * It converts an array of arrays into an array of objects.
     * 
     * @param array|null $array
     *
     * @return array|null
     */
    public static function fromArrayMultiple($array) {
        if($array===null) {
            return null;
        }
        $objs=[];
        foreach($array as $v) {
            $objs[]=self::fromArray($v);
        }
        return $objs;
    }
    //</editor-fold>
    
} // end class