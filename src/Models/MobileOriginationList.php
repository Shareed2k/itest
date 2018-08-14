<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 13:13
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class MobileOriginationList
 * @package Shareed2k\iTest\Models
 */
class MobileOriginationList implements XmlDeserializable {

    /**
    <Mobile_Origination_List>
        <Status>Not Enabled</Status>
    </Mobile_Origination_List>
     */

    public $status;

    /**
     * @param Reader $reader
     * @return MobileOriginationList
     */
    static function xmlDeserialize(Reader $reader):MobileOriginationList {
        $mOL = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Status'])) {
            $mOL->status = $keyValue['{}Status'];
        }

        return $mOL;
    }
}