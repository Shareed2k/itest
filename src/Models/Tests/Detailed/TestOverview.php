<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 12/08/18
 * Time: 08:31
 */

namespace Shareed2k\iTest\Models\Tests\Detailed;


use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class TestOverview
 * @package Shareed2k\iTest\Models\Tests\Detailed
 */
class TestOverview implements XmlDeserializable
{
    /**
    <Test_Overview>
        <Name>Test: 2018080811000003489</Name>
        <Supplier></Supplier>
        <InitBy>R K</InitBy>
        <Init>1533728730</Init>
        <Type>0</Type>
        <Test_ID>2018080811000003489</Test_ID>
    </Test_Overview>
     */

    public $name;
    public $supplier;
    public $initBy;
    public $init;
    public $type;
    public $testId;

    /**
     * @param Reader $reader
     * @return TestOverview
     */
    static function xmlDeserialize(Reader $reader):TestOverview {
        $to = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Name'])) {
            $to->name = $keyValue['{}Name'];
        }
        if (isset($keyValue['{}Supplier'])) {
            $to->supplier = $keyValue['{}Supplier'];
        }
        if (isset($keyValue['{}InitBy'])) {
            $to->initBy = $keyValue['{}InitBy'];
        }
        if (isset($keyValue['{}Init'])) {
            $to->init = $keyValue['{}Init'];
        }
        if (isset($keyValue['{}Type'])) {
            $to->type = $keyValue['{}Type'];
        }
        if (isset($keyValue['{}Test_ID'])) {
            $to->testId = $keyValue['{}Test_ID'];
        }

        return $to;
    }
}