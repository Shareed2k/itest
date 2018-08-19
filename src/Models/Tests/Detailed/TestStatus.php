<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 16:59
 */

namespace Shareed2k\iTest\Models\Tests\Detailed;


use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class TestStatus
 * @package Shareed2k\iTest\Models\Tests\Detailed
 */
class TestStatus implements XmlDeserializable {

    /**
    <Test_Status>
        <Test_Overview>
            <Name>Test: 2018080811000003489</Name>
            <Supplier></Supplier>
            <InitBy>R K</InitBy>
            <Init>1533728730</Init>
            <Type>0</Type>
            <Test_ID>2018080811000003489</Test_ID>
        </Test_Overview>
        <Call>
            <ID>2018080811000026444</ID>
            <Source>20900651427</Source>
            <Destination>021001972527642377</Destination>
            <Start>1533728732</Start>
            <End>1533728744.260229</End>
            <PDD>1.11693</PDD>
            <MOS>0</MOS>
            <Ring>10.1</Ring>
            <Call>NA</Call>
            <Last_Code>487 Request Terminated</Last_Code>
            <Result>No answer</Result>
            <Result_Code>3</Result_Code>
            <CLI></CLI>
            <FAS>0</FAS>
            <LD_FAS>0</LD_FAS>
            <Dead_Air>0</Dead_Air>
            <No_RBT>0</No_RBT>
            <Viber>0</Viber>
            <F-DLR>0</F-DLR>
        </Call>
    </Test_Status>
     */

    /**
     * @var TestOverview
     */
    public $testOverview;

    /**
     * @var array
     */
    public $calls = [];

    /**
     * @param Reader $reader
     * @return TestStatus
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    static function xmlDeserialize(Reader $reader):TestStatus {
        $ts = new TestStatus();

        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Call) {
                $ts->calls[] = $child['value'];
            }

            if ($child['value'] instanceof TestOverview) {
                $ts->testOverview = $child['value'];
            }
        }

        return $ts;
    }
}