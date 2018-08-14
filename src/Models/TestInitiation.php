<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 13:28
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class TestInitiation
 * @package Shareed2k\iTest\Models
 */
class TestInitiation implements XmlDeserializable {

    /**
    <Test_Initiation>
        <Test>
            <Test_ID>223503489</Test_ID>
            <Share_URL>https://share.i-test.net/direct/d.php?p=content&t=200&uri=xcxcDHsW8z8YWDkrxcfW74w</Share_URL>
        </Test>
    </Test_Initiation>
     */

    /**
     * @var Test
     */
    public $item;

    /**
     * @param Reader $reader
     * @return TestInitiation
     */
    static function xmlDeserialize(Reader $reader):TestInitiation {
        $ti = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Test'])) {
            $ti->item = $keyValue['{}Test'];
        }

        return $ti;
    }
}