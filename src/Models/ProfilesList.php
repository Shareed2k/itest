<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 10:40
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Profiles
 * @package Shareed2k\iTest\Models
 */
class ProfilesList implements XmlDeserializable {

    /**
    <Profiles_List>
        <Profile>
            <Profile_ID>6004</Profile_ID>
            <Profile_Name>eu2</Profile_Name>
            <Profile_IP>45.56.45.56</Profile_IP>
            <Profile_Port>5060</Profile_Port>
            <Profile_Src_Number>xxxxxxxxxxx</Profile_Src_Number>
        </Profile>
            <Profile>
            <Profile_ID>4492</Profile_ID>
            <Profile_Name>Singapore</Profile_Name>
            <Profile_IP>12.54.12.32</Profile_IP>
            <Profile_Port>5060</Profile_Port>
            <Profile_Src_Number>xxxxxxxxxxx</Profile_Src_Number>
        </Profile>
    </Profiles_List>
     */

    // A list of profiles.
    public $items = [];

    /**
     * @param Reader $reader
     * @return ProfilesList
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    static function xmlDeserialize(Reader $reader):ProfilesList {
        $profiles = new self();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Profile) {
                $profiles->items[] = $child['value'];
            }
        }
        return $profiles;
    }
}