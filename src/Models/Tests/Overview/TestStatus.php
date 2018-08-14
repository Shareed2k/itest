<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 16:52
 */

namespace Shareed2k\iTest\Models\Tests\Overview;


use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class TestStatus
 * @package Shareed2k\iTest\Models\Tests\Overview
 */
class TestStatus implements XmlDeserializable {

    /**
    <Test_Status>
        <Job>
            <ID>454767603279</ID>
            <Init>15376892</Init>
            <Name>Test: 454767603279</Name>
            <InitBy>R K</InitBy>
            <Supplier></Supplier>
            <Type>0</Type>
            <t>1</t>
            <c>1</c>
            <s>0</s>
            <n>1</n>
            <f>0</f>
            <PDD>0.84</PDD>
        </Job>
    </Test_Status>
     */

    public $job;

    /**
     * @param Reader $reader
     * @return TestStatus
     */
    static function xmlDeserialize(Reader $reader):TestStatus {
        $ts = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Job'])) {
            $ts->job = $keyValue['{}Job'];
        }

        return $ts;
    }
}