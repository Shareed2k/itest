<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 11:09
 */

namespace Shareed2k\iTest\Models;


use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Supplier
 * @package Shareed2k\iTest\Models
 */
class Supplier implements XmlDeserializable {

    /**
    <Supplier>
        <Supplier_ID>1094</Supplier_ID>
        <Supplier_Name>0 Platinum g729</Supplier_Name>
        <Prefix>021001</Prefix>
        <Codec>G.729</Codec>
    </Supplier>
     */

    public $id;
    public $name;
    public $prefix;
    public $codec;

    /**
     * @param Reader $reader
     * @return Supplier
     */
    static function xmlDeserialize(Reader $reader):Supplier {
        $supplier = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Supplier_ID'])) {
            $supplier->id = $keyValue['{}Supplier_ID'];
        }
        if (isset($keyValue['{}Supplier_Name'])) {
            $supplier->name = $keyValue['{}Supplier_Name'];
        }
        if (isset($keyValue['{}Prefix'])) {
            $supplier->prefix = $keyValue['{}Prefix'];
        }
        if (isset($keyValue['{}Codec'])) {
            $supplier->codec = $keyValue['{}Codec'];
        }

        return $supplier;
    }
}