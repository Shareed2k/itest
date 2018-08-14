<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 11:27
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Breakout
 * @package Shareed2k\iTest\Models
 */
class Breakout implements XmlDeserializable {

    /**
    <Breakout>
        <Country_Name>COUNTRY 1</Country_Name>
        <Country_ID>COUNTRY ID</Country_ID>
        <Breakout_Name>BREAKOUT Name</Breakout_Name>
        <Breakout_ID>BREAKOUT ID</Breakout_ID>
    </Breakout>
     */

    public $countryId;
    public $countryName;
    public $breakoutName;
    public $breakoutId;
    public $mccMnc;

    /**
     * @param Reader $reader
     * @return Breakout
     */
    static function xmlDeserialize(Reader $reader):Breakout {
        $breakout = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Country_Name'])) {
            $breakout->countryName = $keyValue['{}Country_Name'];
        }
        if (isset($keyValue['{}Country_ID'])) {
            $breakout->countryId = $keyValue['{}Country_ID'];
        }
        if (isset($keyValue['{}Breakout_Name'])) {
            $breakout->breakoutName = $keyValue['{}Breakout_Name'];
        }
        if (isset($keyValue['{}Breakout_ID'])) {
            $breakout->breakoutId = $keyValue['{}Breakout_ID'];
        }
        if (isset($keyValue['{}MCC_MNC'])) {
            $breakout->mccMnc = $keyValue['{}MCC_MNC'];
        }

        return $breakout;
    }
}