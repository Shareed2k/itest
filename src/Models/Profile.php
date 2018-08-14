<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 10:28
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Profile
 * @package Shareed2k\iTest\Models
 */
class Profile implements XmlDeserializable {

    /**
    </Profile>
        <Profile>
        <Profile_ID>4492</Profile_ID>
        <Profile_Name>Singapore</Profile_Name>
        <Profile_IP>12.54.12.32</Profile_IP>
        <Profile_Port>5060</Profile_Port>
        <Profile_Src_Number>xxxxxxxxxxx</Profile_Src_Number>
    </Profile>
     */

    public $id;
    public $name;
    public $ip;
    public $port;
    public $srcNumber;

    /**
     * @param Reader $reader
     * @return Profile
     */
    static function xmlDeserialize(Reader $reader):Profile {
        $profile = new self();

        // Borrowing a parser from the KeyValue class.
        $keyValue = KeyValue::xmlDeserialize($reader);

        if (isset($keyValue['{}Profile_ID'])) {
            $profile->id = $keyValue['{}Profile_ID'];
        }
        if (isset($keyValue['{}Profile_Name'])) {
            $profile->name = $keyValue['{}Profile_Name'];
        }
        if (isset($keyValue['{}Profile_IP'])) {
            $profile->ip = $keyValue['{}Profile_IP'];
        }
        if (isset($keyValue['{}Profile_Port'])) {
            $profile->port = $keyValue['{}Profile_Port'];
        }
        if (isset($keyValue['{}Profile_Src_Number'])) {
            $profile->srcNumber = $keyValue['{}Profile_Src_Number'];
        }

        return $profile;
    }
}