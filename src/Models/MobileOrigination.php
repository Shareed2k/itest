<?php
/**
 * Created by PhpStorm.
 * User: shareed2k
 * Date: 09/08/18
 * Time: 13:10
 */

namespace Shareed2k\iTest\Models;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class MobileOrigination
 * @package Shareed2k\iTest\Models
 */
class MobileOrigination implements XmlDeserializable {
    /**
    <Mobile_Origination>
        <Mobile_Origination_List>
            <Status>Not Enabled</Status>
        </Mobile_Origination_List>
    </Mobile_Origination>
     */

    // A list of mobile origination lists.
    public $items = [];

    /**
     * @param Reader $reader
     * @return MobileOrigination
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    static function xmlDeserialize(Reader $reader):MobileOrigination {
        $mlists = new self();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof MobileOriginationList) {
                $mlists->items[] = $child['value'];
            }
        }
        return $mlists;
    }
}