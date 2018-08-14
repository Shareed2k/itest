<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 13:33
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Test
 * @package Shareed2k\iTest\Models
 */
class Test implements XmlDeserializable {

    /**
    <Test>
        <Test_ID>223503489</Test_ID>
        <Share_URL>https://share.i-test.net/direct/d.php?p=content&t=200&uri=xcxcDHsW8z8YWDkrxcfW74w</Share_URL>
    </Test>
     */

    public $id;
    public $shareUrl;
    public $status;

    /**
     * @param Reader $reader
     * @return Test
     */
    static function xmlDeserialize(Reader $reader):Test {
        $test = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Test_ID'])) {
            $test->id = $keyValue['{}Test_ID'];
        }
        if (isset($keyValue['{}Share_URL'])) {
            $test->shareUrl = $keyValue['{}Share_URL'];
        }if (isset($keyValue['{}Status'])) {
            $test->status = $keyValue['{}Status'];
        }

        return $test;
    }
}